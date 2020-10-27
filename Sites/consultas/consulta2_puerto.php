<?php
    require("../config/conexion_2.php");
    $patente_barco = $_POST['patente_barco'];
    $tipo_instalacion = $_POST['tipo_instalacion'];
    $fecha_atraque = $_POST['fecha_atraque'];
    $fecha_atraque_2 = new DateTime($_POST['fecha_atraque']);
    if ($tipo_instalacion == 'muelle'){
        $fecha_salida = $fecha_atraque;
    } elseif ($tipo_instalacion == 'astillero'){
        $fecha_salida = $_POST['fecha_salida'];
    }
    $fecha_salida_2 = new DateTime($_POST['fecha_salida']);
    $nombre_puerto = $_POST['nombre_puerto'];
    $interval = $fecha_atraque_2->diff($fecha_salida_2);
    $days_diff = $interval->days 
    // añadimos el procedimiento almacenado que retorna una tabla
    $stored_procedure = "SELECT Instalaciones.id_instalacion, dias FROM calcular_capacidad(?, ?, ?), Instalaciones WHERE iid = id_instalacion AND tipo_instalacion = ? ORDER BY id_instalacion";
    $result_procedure = $db_2 -> prepare($stored_procedure);
    $result_procedure -> execute([$nombre_puerto, $fecha_atraque, $fecha_salida, $tipo_instalacion]);
    $capacidad_instalaciones = $result_procedure -> fetchAll();
    // para añadir a permisos necesito: 
    // Permisos_Astilleros -> id_instalacion, patente_barco, fecha_atraque, fecha_salida
    // Permisos_Muelles	-> id_instalacion, patente_barco, fecha_atraque, descripcion_actividad	
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
                    echo "Las siguientes instalaciones de tipo $tipo_instalacion tienen capacidad para la/s fecha/s seleccionada/s";
                ?>
            </p>
            <p>
                <?php
                    echo "Se generará un permiso de tipo $tipo_instalacion para la instalación x en las fechas seleccionadas, dias diferencia = $days_diff";
                ?>
            </p>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID Instalación</th>
                        <th scope="col">Días</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($capacidad_instalaciones as $c){
                        echo 
                        "<tr>
                            <td>$c[0]</td>
                            <td>$c[1]</td>
                        </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        include "../components/footer.php";
    ?>
</body>

</html>
