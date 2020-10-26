<?php
    require("../config/conexion_2.php");
    $patente_barco = $_POST['patente_barco']; 
    $fecha_atraque = $_POST['fecha_atraque']; 
    $fecha_salida = $_POST['fecha_salida'];
    $nombre_puerto = $_POST['nombre_puerto'];
    $tipo_instalacion = $_POST['tipo_instalacion'];
    // añadimos el procedimiento almacenado que retorna una tabla
    $stored_procedure = "SELECT * FROM calcular_capacidad(?, ?, ?), Instalaciones WHERE iid = id_instalacion";
    $result_procedure = $db_2 -> prepare($stored_procedure);
    $result_procedure -> execute([$nombre_puerto, $fecha_atraque, $fecha_salida]);
    $capacidad_instalaciones = $result_procedure -> fetchAll();
?>
<?php
    include "../components/head.php"
?>

<body>
    <?php
        include "../components/header.php"
    ?>

    <div class="container-fluid">

        <div class="text-center m-2">
            <h1>
                <?php
                    echo "Puerto ".$nombre_puerto;
                ?>
            </h1>
            <p>
                <?php
                    echo "Rango de fechas seleccionadas: ".$fecha_atraque." y ".$fecha_salida;
                ?>
            </p>
            <p>
                <?php
                    echo "Tipo instalación: ".$tipo_instalacion;
                ?>
            </p>
            <p>
                <?php
                    echo "Patente barco: ".$patente_barco;
                ?>
            </p>
        </div>
        <div class='container'>

        </div>
    </div>
    <?php
        include "../components/footer.php";
    ?>
</body>

</html>
