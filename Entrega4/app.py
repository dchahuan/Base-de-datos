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
    
    if body.get("id1") or body.get("id2"):
        if body.get("id1") and body.get("id2"):
            pass
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
    data = {key:request.json[key] for key in MENSAJE_KEYS}

    # Falta chequear data
    db.mensajes.insert_one(data)

    return json.jsonify({"success":True})

@app.route("/messages/<int:mid>", methods = ["DELETE"])
def delete_mensaje(mid):
    mid = request.json[mid]
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
if __name__ == "__main__":
    app.run(debug=True)
