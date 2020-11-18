import re
from flask import Flask,json, request
from flask.json import jsonify
from pymongo import MongoClient


USER = "grupo16"
PASS = "grupo16"
DATABASE = "grupo16"
MENSAJE_KEYS = ["message","sender","receptant","lat","long","date"]

URL = f"mongodb://{USER}:{PASS}@gray.ing.puc.cl/{DATABASE}?authSource=admin"
client = MongoClient(URL)

app = Flask(__name__)
db = client.get_database()

@app.route("/")
def home():
    return "<h1>Hello world</h1>"

#### RUTA MENSAJES ####

@app.route("/messages")
def get_mensajes():

    '''
        Retorna los mensajes entre dos usuarios ssi se le pasan paremetros como- /messages?id1=433&id2=355
        sino devuelve toda la base de datos de mensajes

    '''

    body = request.args.to_dict()
    
    id1 = body.get("id1")
    id2 = body.get("id2")
    
    if id1 or id2:
        if id1 and id2:
            usuario_1 = list(db.usuarios.find({"uid":int(id1)},{"_id":0}))
            usuario_2 = list(db.usuarios.find({"uid":int(id2)},{"_id":0}))
            if usuario_1 and usuario_2:
                data = list(db.mensajes.find({"$or":[{"sender":int(id1),"receptant":int(id2)},{"sender":int(id2),"receptant":int(id1)}]},{"_id":0}))
                return json.jsonify(data)
            else:
                if not usuario_1 and not usuario_2:
                    return json.jsonify({"error":"Ni uno de los usuarios ingresados existe"})
                elif not usuario_1:
                    return json.jsonify({"error":"Solo existe el usuario 2"})
                else:
                    return json.jsonify({"error":"Solo existe el usuario 1"})
        else:
            return json.jsonify({"error": "Alguno de los parametros esta faltando"})

    data = list(db.mensajes.find({},{"_id":0}))
    return json.jsonify(data)


@app.route("/messages/<int:mid>")
def get_mensaje_individual(mid):
    '''
        Retorna el mensaje con id = mid de la base de datos
    '''
    data = list(db.mensajes.find({"mid":mid},{"_id":0}))
    if len(data) == 0:
        return json.jsonify({"error": "El id del mensaje colocado no existe"})
    return json.jsonify(data)

@app.route("/messages", methods = ["POST"])
def post_mensaje():
    '''
        Inserta mensaje a la base de datos si los parametros son correctos
    '''
    
    sobran = False
    for llave in request.json:
        if llave not in MENSAJE_KEYS:
            sobran = True
            break

    largo_lista_filtrada = len(list(filter(lambda x: x in MENSAJE_KEYS, list(request.json.keys()))))

    if sobran or largo_lista_filtrada != len(MENSAJE_KEYS):
        return json.jsonify({"error":"Algun parametro que deberia estar no existe o tienes un parametro que sobra"})

    data = {key:request.json[key] for key in MENSAJE_KEYS}
    
    # Falta chequear data
    mid_query = list(db.mensajes.find({},{"mid": 1, "_id": 0}).sort([("mid", -1)]).limit(1))
    mid = mid_query[0]["mid"]
    nuevo_mid = int(mid) + 1

    data["mid"] = nuevo_mid

    db.mensajes.insert_one(data)

    return json.jsonify({"success":True})

@app.route("/message/<int:mid>", methods = ["DELETE"])
def delete_mensaje(mid):
    '''
        Borra el mensaje con id = mid de la base de datos. 
    '''

    data = list(db.mensajes.find({"mid":mid},{"_id":0}))
    if len(data) == 0:
        return json.jsonify({"error":"No existe el mensaje pedido"})
    
    db.mensajes.remove({"mid":mid})

    return json.jsonify({"success":True})


#### RUTA USERS ####

@app.route("/users")
def get_users():
    '''
        Retorna todos los usuarios de la base de datos
    '''
    data = list(db.usuarios.find({},{"_id":0}))
    return json.jsonify(data)

@app.route("/users/<int:uid>")
def get_user(uid):
    '''
        Retorna al usurio con id = uid de la base de datos
        Además debe retornar todos los mensajes emitidos por él
    '''
    data = list(db.usuarios.find({"uid":uid},{"_id":0}))
    data_mensajes = list(db.mensajes.find({"sender":uid},{"_id":0}))
    if len(data) == 0:
        return json.jsonify({"error": "El id del usuario colocado no existe"})
    return json.jsonify(data, data_mensajes)

#### RUTA TEXTO ####
@app.route("/text-search")
def text_search():
    data = request.json
    
    desired = data.get("desired")
    required = data.get("required")
    forbidden = data.get("forbidden")
    userId = data.get("userId")
    string_consulta = ""

    if desired:
        for i in desired:
            string_consulta += f"{i}"
    
    ## Solo funciona esta
    if required:
        for i in required:
            string_consulta += f" \"{i}\" "
    
    if forbidden:
        for i in forbidden:
            string_consulta += f" -\"{i}\" "






    if userId:
        if string_consulta == "":
            return json.jsonify(list(db.mensajes.find({"sender":userId},{"_id":0})))
        if forbidden and not required and not desired:
            data_tmp = set(db.mensajes.find({"sender":userId},{"_id":0}))
            for i in forbidden:
                data_palabra_forbiden = list(db.mensajes.find({'$text':{'$search':f"\"{i}\""},"sender":userId},{"_id":0}))
                data_tmp = list(filter(lambda x: x not in data_palabra_forbiden,data_tmp))
            return json.jsonify(data_tmp)
        data_return = db.mensajes.find({'$text':{'$search':string_consulta},"sender":userId},{"_id":0})
    else:
        if string_consulta == "":
            return json.jsonify(list(db.mensajes.find({},{"_id":0})))
        if forbidden and not required and not desired:
            data_tmp =  list(db.mensajes.find({},{"_id":0}))
            for i in forbidden:
                data_palabra_forbiden = list(db.mensajes.find({'$text':{'$search':f"\"{i}\""}},{"_id":0}))
                data_tmp = list(filter(lambda x: x not in data_palabra_forbiden,data_tmp))
            return json.jsonify(data_tmp)
        data_return = db.mensajes.find({'$text':{'$search':string_consulta}},{"_id":0})

    data_return = list(data_return)
    return json.jsonify(data_return)


if __name__ == "__main__":
    app.run(debug=True)
