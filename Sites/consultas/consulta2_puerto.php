<?php
    require("../config/conexion_2.php");
    $instalacion_a_usar = 0;
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
    $days_diff = $interval->days + 1;
    // añadimos el procedimiento almacenado que retorna una tabla
    $stored_procedure = "SELECT Instalaciones.id_instalacion, dias FROM calcular_capacidad(?, ?, ?), Instalaciones WHERE iid = id_instalacion AND tipo_instalacion = ? ORDER BY id_instalacion, dias";
    $result_procedure = $db_2 -> prepare($stored_procedure);
    $result_procedure -> execute([$nombre_puerto, $fecha_atraque, $fecha_salida, $tipo_instalacion]);
    $capacidad_instalaciones = $result_procedure -> fetchAll();
    // Segunda query
    $query_2 = "SELECT iid, COUNT(iid) FROM calcular_capacidad(?, ?, ?), Instalaciones WHERE iid = id_instalacion and tipo_instalacion = ? GROUP BY iid";
    $query_result = $db_2 -> prepare($query_2);
    $query_result -> execute([$nombre_puerto, $fecha_atraque, $fecha_salida, $tipo_instalacion]);
    $count_iid = $query_result -> fetchAll();
    // Tercera query (verificar si la patente pertenece a algún barco)
    $query_barcos = "SELECT patente_barco FROM Barcos";
    $result_barcos = $db_2 -> prepare($query_barcos);
    $result_barcos -> execute();
    $barcos = $result_barcos -> fetchAll();
    $esta_la_patente = FALSE;
    foreach ($barcos as $bar){
        if ($bar[0] == $patente_barco){
            $esta_la_patente = TRUE;
        }
    }
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

        <div>
            <h1 class='text-center m-2'>
                <?php
                    echo "Puerto ".$nombre_puerto;
                ?>
            </h1>
        </div>
        <div class='container'>
            <ul class='my-4' style='font-size: 18px'>
                <li>
                    <?php
                        foreach ($capacidad_instalaciones as $c){
                            while ($instalacion_a_usar == 0){
                                foreach ($count_iid as $i){
                                    if ($c[0] == $i[0]){
                                        if ($i[1] == $days_diff){
                                            $instalacion_a_usar = $i[0];
                                        }
                                    }
                                }
                                if ($instalacion_a_usar == 0){
                                    $instalacion_a_usar = 1;
                                }
                            }
                        }
                        if ($instalacion_a_usar != 1 and $esta_la_patente == TRUE){
                            echo "Se generará un permiso para el barco de patente <span class='bg-dark text-white'>$patente_barco</span> en la instalación <span class='bg-dark text-white'>$instalacion_a_usar</span> de tipo <span class='bg-dark text-white'>$tipo_instalacion</span> en la/s fecha/s seleccionada/s";
                            try{
                                $db_2 -> beginTransaction();
                                if ($tipo_instalacion == 'astillero'){
                                    $query_astillero = "INSERT INTO permisos_astilleros VALUES (?, ?, ?, ?)";
                                    $resultado_astilleros = $db_2 -> prepare($query_astillero); 
                                    $resultado_astilleros -> execute([$instalacion_a_usar, $patente_barco, $fecha_atraque, $fecha_salida]);
                                } elseif ($tipo_instalacion == 'muelle'){
                                    $query_muelle = "INSERT INTO permisos_muelles VALUES (?, ?, ?, ?)";
                                    $resultado_muelle = $db_2 -> prepare($query_muelle); 
                                    $resultado_muelle -> execute([$instalacion_a_usar, $patente_barco, $fecha_atraque, "descarga de pescados"]);
                                }
                                $db_2 -> commit();
                            } catch (Exception $e){
                                $db_2 ->rollback();
                                throw $e;
                            }
                        } elseif ($instalacion_a_usar == 1){
                            echo "Lamentablemente no hemos podido encontrar ninguna instalacion con capacidad para la/s fecha/s que elegiste!, vuelve a intentarlo con otras fechas por favor";
                        } elseif ($esta_la_patente == FALSE){
                            echo "La patente no está presente en nuestra base de datos! intenta con otra por favor";
                        }
                    ?>
                </li>
                <li>
                    <?php
                        echo "Las siguientes instalaciones de tipo <span class='bg-dark text-white'>$tipo_instalacion</span> tienen capacidad para las fechas específicadas en la columna de la derecha:";
                    ?>
                </li>
                <li>
                    ¡IMPORTANTE! Recuerda que las intalaciones de tipo astillero necesitan que todas las fechas estén disponibles entre la fecha de atraque y salida. Por el contrario, las de tipo muelle solo nececitas tener capacidad en la fecha de atraque.
                </li>
            </ul>
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
