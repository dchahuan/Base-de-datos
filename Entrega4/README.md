# Tarea 1: Visualización de Información :eyes: :memo:

## Consideraciones generales :memo:

* Para una mejor comprensión del codigo, añadimos una pequeña descripción al inicio de todas las funciones y así sea más facil la corrección.

### Cosas implementadas y no implementadas :white_check_mark: :x:

* Parte 1 - GET:
    * Ruta "/messages":
	* 1) /messages?id1=x&id2=y: Hecha completa
	* 2) Si no se incluye una request en el body: Hecha completa
    * Ruta "/messages/<int:mid>": Hecha completa
    * Ruta "/users": Hecha completa
    * Ruta "/users/<int:uid>": Hecha completa
    
* Parte 2 - POST:
    * Ruta "/messages": Hecha completa
    * Encabezado: Hecha completa
    * Imagenes: Hecha completa
    * Contenedores: Hecha completa
    
* Parte 3: DELETE
    * Ruta "/message/<int:mid>": Hecha completa

* Parte 4: TEXT-SEARCH
    * Desired: Hecha completa
    * Required: Hecha completa
    * Forbidden: Hecha completa 
    * User_id: Hecha completa

## Ejecución :computer:
El módulo principal de la tarea a ejecutar es  ```app.py```. Además se deben tener en cuenta los siguientes archivos:

1. ```Pipfile```
2. ```Pipfile.lock```

Estos dos están específicamente relacionados con el virtual environment y contienen la información necesaria para poder correr la aplicación (incluyendo librerias o qué versión de python utilizamos)

## Referencias de código externo :book:

Las referencias de codigo que usamos para esta tarea son exclusivamente de la página oficial del curso (Ayudantías).

