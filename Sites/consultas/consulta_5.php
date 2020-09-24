<?php
require("../config/conexion.php");
$query = "select * from personal where pasaporte in (select distinct pasaporte from buques, capitanes where buques.patente in (select patente from atracos where lower(puerto) like '%talcahuano%') and capitanes.patente = buques.patente)  and genero like 'mujer';";
$result = $db -> prepare($query);
$result -> execute();
$capitanes= $result -> fetchAll();
?>
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
        include "../components/header.php";
        
    ?>
    <div class="container-fluid">

        <div class="row">
            <?php
        include "../components/sidebar.php";
        ?>

            <div class="mx-auto mt-3">
                <h1>Consulta 5</h1>
                <table class="table table-striped my-3">
                    <thead>
                        <tr>
                            <th scope="col">Pasaporte</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Genero</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Nacionalidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($capitanes as $c){
                            echo "<tr><td>$c[0]</td><td>$c[1]</td><td>$c[2]</td><td>$c[3]</td><td>$c[4]</td></tr>";
                            
                        }
                        ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</body>

</html>

</html>