<?php
    require("../config/conexion_2.php");
    // La siguiente funcion divide el rango de fechas en dos.
    function trim_value(&$value) 
    { 
        $value = trim($value); 
    }
    //
    $fecha_array = explode("/", $_POST['date_range']);
    array_walk($fecha_array, 'trim_value');
    $fecha_inicio = $fecha_array[0]; 
    $fecha_fin = $fecha_array[1];
    $nombre_puerto = $_POST['nombre_puerto'];
    // añadimos la query
    $query = "SELECT Instalaciones.id_instalacion, tipo_instalacion, capacidad_instalacion, nombre_puerto FROM instalaciones, Esta_en WHERE Instalaciones.id_instalacion = Esta_en.id_instalacion AND Esta_en.nombre_puerto = ?";
    $result = $db_2 -> prepare($query);
    $result -> execute([$nombre_puerto]);
    $instalaciones = $result -> fetchAll();
    // añadimos el procedimiento almacenado que retorna una tabla
    $stored_procedure = "SELECT * FROM calcular_capacidad(?, ?, ?)";
    $result_procedure = $db_2 -> prepare($stored_procedure);
    $result_procedure -> execute([$nombre_puerto, $fecha_inicio, $fecha_fin]);
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
                    echo "Rango de fechas seleccionadas: ".$fecha_inicio." y ".$fecha_fin;
                ?>
            </p>
        </div>
        <div class='container'>
            <?php
            foreach ($instalaciones as $i){
                $suma_capacidades = 0;
                $cantidad_instalaciones = 0;
                echo
                "<div class='text-center my-4'>
                    <h2>
                        Instalacion $i[0]
                    </h2>
                </div>
                <table class='table'>
                    <thead class='thead-dark'>
                        <tr>
                            <th scope='col'>Dias con capacidad</th>
                            <th scope='col'>Capacidad (%)</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach($capacidad_instalaciones as $c){ //aqui meter el procedimiento almacenado
                            if ($c[0] == $i[0]){
                                $suma_capacidades += $c[2];
                                $cantidad_instalaciones += 1;
                                echo 
                                "<tr>
                                    <td>$c[1]</td>
                                    <td>$c[2]</td>
                                </tr>";
                            }
                        };
            ?>
            <?php
            $promedio = $suma_capacidades / $cantidad_instalaciones;
                    echo 
                    "</tbody>
                </table>
                <ul class='m-2' style='font-size: 20px'> 
                    <li> Promedio de ocupación entre $fecha_inicio y $fecha_fin: $promedio% </li>
                </ul>";
            };
            ?>
        </div>
    </div>
    <?php
        include "../components/footer.php";
    ?>
</body>

</html>
