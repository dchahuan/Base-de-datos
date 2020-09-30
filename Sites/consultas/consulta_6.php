<?php
require("../config/conexion.php");


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
                <h1>Consulta 6</h1>
                Para esta consulta se nos pidio encontrar todos los buques que tienen la mayor cantidad de trabajadores.
                <form action="/~grupo16/consultas/consulta_6.php" method="get">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="hombre" value="pesquero" checked>
                        <label class="form-check-label" for="hombre">
                            Pesquero
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="hombre2" value="petrolero">
                        <label class="form-check-label" for="hombre2">
                            Petrolero
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="hombre1" value="carga">
                        <label class="form-check-label" for="hombre1">
                            Carga
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
                <?php
                    if (isset($_GET) && array_key_exists('tipo',$_GET)){
                        $query = "select buques.nombre, buques.patente, buques.tipo, buques.bpais from buques where patente in (select patente from (select * from buques natural join trabaja_en where tipo = '".$_GET['tipo']."' union select * from buques natural join capitanes where tipo = '".$_GET['tipo']."') as foo group by patente having count(*) >= ALL  (select count(*) from (select * from buques natural join trabaja_en where tipo = '".$_GET['tipo']."' union select * from buques natural join capitanes where tipo = '".$_GET['tipo']."') as foo1 group by patente));";
                        $result = $db -> prepare($query);
                        $result -> execute();
                        $buques = $result -> fetchAll();
                        echo "<table class='table table-striped my-3'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Nombre</th>
                                        <th scope='col'>Patente</th>
                                        <th scope='col'>Pais</th>
                                        <th scope='col'>tipo</th>
                                    </tr>
                                </thead>
                                <tbody>";

                                    foreach ($buques as $b){
                                    echo "<tr>
                                        <td>$b[0]</td>
                                        <td>$b[1]</td>
                                        <td>$b[2]</td>
                                        <td>$b[3]</td>
                                    </tr>";

                                    }

                                echo "</tbody>
                            </table>";
                    }
                ?>
            </div>


        </div>
    </div>
</body>

</html>


</html>