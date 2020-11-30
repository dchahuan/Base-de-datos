# Entrega 4: Desarrollo de una Web API :memo: :iphone:

## Consideraciones generales :memo:

* Para una mejor comprensión del codigo, añadimos una pequeña descripción al inicio de todas las funciones y así sea más facil la corrección.

### Cosas implementadas y no implementadas :white_check_mark: :x:

* Parte 1 - GET:
    * Ruta ```/messages```:
    * A) De tipo ```/messages?id1=x&id2=y```: Hecha completa
    * B) Si no se incluye una request en el body: Hecha completa
    * Ruta ```/messages/<int:mid>```: Hecha completa
    * Ruta ```/users```: Hecha completa
    * Ruta ```/users/<int:uid>```: Hecha completa
    
* Parte 2 - POST:
    * Ruta ```/messages```: Hecha completa
    
* Parte 3: DELETE
    * Ruta ```/message/<int:mid>```: Hecha completa

* Parte 4: TEXT-SEARCH
    * ```Desired```: Hecha completa
    * ```Required```: Hecha completa
    * ```Forbidden```: Hecha completa 
    * ```User_id```: Hecha completa

## Ejecución :computer:
El módulo principal de la tarea a ejecutar es  ```app.py```. Además se deben tener en cuenta los siguientes archivos:

1. ```Pipfile```
2. ```Pipfile.lock```

Estos dos están específicamente relacionados con el virtual environment y contienen la información necesaria para poder correr la aplicación (incluyendo librerias o qué versión de python utilizamos).
Específicamente el ayudante debe hacer uso del comando ```pipenv install``` para instalar los paquetes incluidos en estos dos archivos. Posterior a esto se usa el comando ```pipenv shell``` y finalmente ```python app.py```. (o en su defecto ```flask run```).

## Librerías :books:
### Librerías externas utilizadas

La tarea está fundamentalmente hecha con la librería ```Flask``` y ```MongoDB```.
En específico se utilizó lo siguiente (notar que cada una tiene más funciones):

1. ```flask```: ```Flask```, ```json```, ```request```
2. ```flask.json```: ```jsonify```
3. ```pymongo```: ```MongoClient```

## Referencias de código externo :book:

Las referencias de codigo que usamos para esta tarea son exclusivamente de la página oficial del curso (Ayudantías).

