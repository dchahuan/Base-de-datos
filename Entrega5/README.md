# Entrega 5: Deploy y consumo de la API :memo: :iphone:

## Consideraciones generales :memo:

* Para una mejor comprensión del codigo, añadimos una pequeña descripción al inicio de todas las funciones y así sea más facil la corrección.
* Se añadieron nuevas rutas a la API, especificadas más adelante.

### Cosas implementadas y no implementadas :white_check_mark: :x:

* Parte 1 - Deploy de la Web API:
    
* Parte 2 - Consumir la API desde PHP:
    * Para esta parte se crearon 3 nuevas rutas: 
	1) ```messsages/sent/<int:uid>```
	2) ```messages/received/<int:uid>```
	3) ```users/name/<string:name>```

    * Funcionalidades Básicas: Una vez inicia sesión un usuario en particular, a nuestro navbar se le añade la opción ```Mensajes```. Está bien explicito en la página web como utilizar cada sección.
    * Funcionalidades PDI: Una vez inicia sesión un usuario en particular, a nuestro navbar se le añade la opción ```Mapa```. Aquí podemos poner un rango de fechas en específico y opcionalmente UID y/o una o más palabras claves. 

## Ejecución :computer:

Para esta entrega no es necesario correr ningún codigo pues la API, por su parte, está subida a heroku y la página en PHP, en el servidor.

## Librerías :books:
### Librerías externas utilizadas

La tarea está fundamentalmente hecha con la librería ```Flask``` y ```MongoDB```.
En específico se utilizó lo siguiente (notar que cada una tiene más funciones):

1. ```flask```: ```Flask```, ```json```, ```request```
2. ```flask.json```: ```jsonify```
3. ```pymongo```: ```MongoClient```

Además para todo lo relacionado con la página web se utiliza HTML, CSS y Javascript.

## Referencias de código externo :book:

Las referencias de codigo que usamos para esta tarea son exclusivamente de la página oficial del curso (Ayudantías).

