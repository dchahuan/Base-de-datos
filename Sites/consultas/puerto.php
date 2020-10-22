<?php
    require("../config/conexion_2.php");
    $nombre_puerto = $_POST['name'];
    $query = "SELECT Instalaciones.id_instalacion, tipo_instalacion, capacidad_instalacion, nombre_puerto FROM instalaciones, Esta_en WHERE Instalaciones.id_instalacion = Esta_en.id_instalacion AND Esta_en.nombre_puerto = ?";
    $result = $db_2 -> prepare($query);
    $result -> execute([$nombre_puerto]);
    $instalaciones = $result -> fetchAll();
?>
<?php
    include "../components/head.php"
?>

<body>
    <?php
        include "../components/header.php"
    ?>

    <div class="container-fluid">

        <div class="text-center mt-2">
            <h1>
                <?php
            echo "Puerto ". $nombre_puerto;
        ?>
            </h1>
        </div>
        <div class="container">
            <ul>
                <li> Para revisar que instalaciones tienen capacidad en una fecha en específico, ingresa un rango a continuación!</li>
            </ul>
            <div class="row">
                <form action="puerto.php" method="POST" class = "w-100">
                    <div class="form-group">
                        <label>Selecciona fechas:</label>
                        <div class="input-group w-75">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="date_range" name="date_range" class="form-control pull-right w-50">
                            <span class="input-group-btn">

                                <button class="btn btn-dark btn-flat" type="submit" name="submitRangeDates">Enviar</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <?php if(isset($_POST["date_range"])){
                echo "La fechas son:". $_POST["date_range"];
            }?>
                
            <!-- Aqui crear tabla con php en base a los rangos de fecha entregados en la variable "submitRangeDates de POST" -->
            <table class="table mt-5">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Patente</th>
                        <th scope="col">Pais</th>
                        <th scope="col">Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($instalaciones as $i){
                    echo "<tr><td>$i[1]</td><td>$i[0]</td><td>$i[3]</td><td>$i[2]</td></tr>";
                    };?>
                </tbody>
            </table>
        </div>




    </div>
    <?php
        include "../components/footer.php";
    ?>
</body>

</html>