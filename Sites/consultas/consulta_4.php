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

            <div class="mx-auto mt-3 col-xl-7">
                <h1>Consulta 4</h1>
                <p>En esta consulta se nos pidio encontras los buques que estuvieron en un puerto (Ej:"Mejillones") al
                    mismo tiempo que
                    un buque (Ej:"Magnolia").</p>
                <form action="/~grupo16/consultas/consulta_4.php" method="get">
                    <div class="form-group">
                        <label for="puerto">Puerto:</label>
                        <input type="text" class="form-control" name="puerto">
                    </div>
                    <div class="form-group">
                        <label for="ano">Buque:</label>
                        <input type="text" class="form-control" name="buque">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <?php
                    if (isset($_GET) && array_key_exists('puerto',$_GET) &&  array_key_exists('buque',$_GET)){
                        $query = "select buques.nombre, buques.patente, buques.tipo, buques.bpais from buques where patente in (select atracos.patente from atracos,(select * from atracos where patente in (select patente from buques where lower(nombre) like lower('%".$_GET['buque']."%'))) as foo where lower(atracos.puerto) like lower('%".$_GET['puerto']."%') and ((atracos.fecha_llegada > foo.fecha_llegada and atracos.fecha_llegada < foo.fecha_salida) or (atracos.fecha_salida> foo.fecha_llegada and atracos.fecha_salida < foo.fecha_salida)));";
                        
                        $result = $db -> prepare($query);
                        $result -> execute();
                        $buques= $result -> fetchAll();
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