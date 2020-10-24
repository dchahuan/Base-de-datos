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

        <div class="text-center mt-4 mb-5">
            <h1>
                <?php
            echo "Puerto ". $nombre_puerto;
        ?>
            </h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="border p-4" style="margin-left: 15%; margin-right: 0%">
                        <h2 style="color:black; text-align: center;" class="center mb-4">Capacidad y porcentaje de ocupación</h2>
                        <ul>
                            <li> Para revisar que instalaciones tienen capacidad en una fecha en específico, ingresa un rango a continuación!</li>
                        </ul>
                        <form action="consulta1_puerto.php" method="POST">
                            <div class="form-group mt-3">
                                <label>Selecciona fechas:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="date_range" name="date_range" class="form-control pull-right">
                                    <span class="input-group-btn">

                                        <button class="btn btn-dark btn-flat" type="submit" name="submitRangeDates">Enviar</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!-- Aqui enviar los datos a consulta1_puertos.php para ejecutarlo -->
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="border p-4" style="margin-left: 5%; margin-right: 15%">
                        <h2 class="center mb-4" style="color:black; text-align: center;">Generar Permiso</h2>
                        <ul>
                            <li> Para saber si algun tipo de instalacion tiene capacidad para tu barco en una fecha en específico, ingresa los siguientes datos: </li>
                            <li> IMPORTANTE: Recuerda que si alguna instalacion tiene capacidad, se generará un permiso para que puedas usarla! </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <?php
        include "../components/footer.php";
    ?>
</body>

</html>