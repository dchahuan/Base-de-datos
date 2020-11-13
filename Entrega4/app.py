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
    data = list(db.mensajes.find({"mid":mid},{"_id":0}))
    if len(data) == 0:
        return json.jsonify({"error": "El id del mensaje colocado no existe"})
    return json.jsonify(data)

@app.route("/messages", methods = ["POST"])
def post_mensaje():
    
    sobran = False
    for llave in request.json.keys():
        if llave not in MENSAJE_KEYS:
            sobran = True
            break

    largo_lista_filtrada = len(list(filter(lambda x: x in MENSAJE_KEYS, list(request.json.keys()))))

    if sobran or largo_lista_filtrada != len(MENSAJE_KEYS):
        return json.jsonify({"error":"Algun parametro que deberia estar no existe o tienes un parametro que sobra"})

    data = {key:request.json[key] for key in MENSAJE_KEYS}

    print(type(request.json))
    # Falta chequear data
    print(len(list(data.keys())))

    return json.jsonify({"success":True})

@app.route("/message/<int:mid>", methods = ["DELETE"])
def delete_mensaje(mid):

    data = list(db.mensajes.find({"mid":mid},{"_id":0}))
    if len(data) == 0:
        return json.jsonify({"error":"No existe el mensaje pedido"})
    
    db.mensajes.remove({"mid":mid})

    return json.jsonify({"success":True})


#### RUTA USERS ####

@app.route("/users")
def get_users():
    data = list(db.usuarios.find({},{"_id":0}))
    return json.jsonify(data)

@app.route("/users/<int:uid>")
def get_user(uid):
    data = list(db.usuarios.find({"uid":uid},{"_id":0}))
    if len(data) == 0:
        return json.jsonify({"error": "El id del usuario colocado no existe"})
    return json.jsonify(data)

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
        string_consulta += " ".join(desired)
    
    ## Solo funciona esta
    if required:
        for i in required:
            string_consulta += f" \"{i}\" "
    
    if forbidden:
        for i in forbidden:
            string_consulta += f" -\"{i}\" "

    if string_consulta == "":
        return json.jsonify(list(db.mensajes.find({},{"_id":0})))

    if userId:
        data_return = db.mensajes.find({'$text':{'$search':string_consulta},"sender":userId},{"_id":0})
    else:
        data_return = db.mensajes.find({'$text':{'$search':string_consulta}},{"_id":0})
    data_return = list(data_return)
    return json.jsonify(data_return)
if __name__ == "__main__":
    app.run(debug=True)
