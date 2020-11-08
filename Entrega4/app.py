from flask import Flask,json, request
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

@app.route("/messages")
def get_mensajes():
    data = list(db.mensajes.find({},{"_id":0}))
    return json.jsonify(data)


@app.route("/messages/<int:uid>")
def get_mensaje_individual(uid):
    data = list(db.mensajes.find({"uid":uid},{"_id":0}))
    return json.jsonify(data)

@app.route("/mensajes", methods = ["POST"])
def post_mensaje():
    data = {key:request.json[key] for key in MENSAJE_KEYS}

    # Falta chequear data
    db.mensajes.insert_one(data)

    return json.jsonify({"success":True})

@app.route("/message/<int:mid>")
def delete_mensaje(mid):
    uid = request.json[mid]
    return json.jsonify({"success":True})
if __name__ == "__main__":
    app.run(debug=True)
