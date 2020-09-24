<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
</head>

<body>

    <?php
        include "components/header.php";
      
    ?>
    <div class="container-fluid">

        <div class="row">
            <?php
        include "components/sidebar.php";
        ?>

            <div class="mx-auto mt-3">
                <h1>Esquema</h1>

                <div class="text-justify"> Para diseñar el esquema nosotros utilizamos el siguiente diagrama relacional:
                </div>
                <img src="" alt="">


                <div class="text-justify">Lo que resulto en el siguiente esquema:</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Navieras(nid Primary Key int, nombre varchar(255), npais varchar(255),
                        giro varchar(255) )</li>
                    <li class="list-group-item">Buques(patente varchar(255) Primary key , nombre varchar(255), tipo
                        varchar(255), bpais varchar(255))</li>
                    <li class="list-group-item">Pesqueros(patente varchar(255) Primary key , tipo_pesca varchar(255),
                        foreign key patente)</li>
                    <li class="list-group-item">Petroleros(patente varchar(255) Primary key , max_lit int, foreign key
                        patente)</li>
                    <li class="list-group-item">Carga(patente varchar(255) Primary Key, max_container int, max_ton
                        float, foreign key patente )</li>
                    <li class="list-group-item">Pertenece(patente varchar(255) Primary Key, nid int, Foreign Keys (nid,
                        patente))</li>
                    <li class="list-group-item">Personal(pasaporte varchar(255) Primary Key , nombre varchar(255),
                        genero varchar(255),edad int, nacionalidad varchar(255) )</li>
                    <li class="list-group-item">Trabaja_en (pasaporte varchar(255) primary key, patente varchar(255),
                        Foreign Keys (patente, pasaporte))</li>
                    <li class="list-group-item">Capitan(Foreign Keys (patente, pasaporte))</li>
                    <li class="list-group-item">Atracos(puerto varchar(255),patente varchar(255), fecha_salida
                        timestamp, fecha_llegada timestamp, Primary Key(Patente,fecha_llegada))</li>
                    <li class="list-group-item">Proximo_itenerario(puerto varchar(255),patente varchar(255),
                        fecha_llegada timestamp, Primary Key(patente,fecha_llegada))</li>
                </ul>
            </div>


        </div>
    </div>
</body>

</html>