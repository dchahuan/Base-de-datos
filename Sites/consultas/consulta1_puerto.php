<?php
    function trim_value(&$value) 
    { 
        $value = trim($value); 
    }
    require("../config/conexion_2.php");
    $fecha_array = explode("-", $_POST['date_range']);
    array_walk($fecha_array, 'trim_value');
    $fecha_inicio = $fecha_array[0]; 
    $fecha_fin = $fecha_array[1];
    // añadir query y procedimiento almacenado
?>
<?php
    include "../components/head.php"
?>

<body>
    <?php
        include "../components/header.php"
    ?>

    <div class="container-fluid">

        <div class="text-center">
            <h1>
                <?php
                    echo "Puerto ". $_POST['nombre_puerto'];
                ?>
            </h1>
            <p>
                <?php
                    echo "Rango de fechas seleccionadas: ". $fecha_inicio . "y ".$fecha_fin;
                ?>
            </p>
        </div>
    </div>
    <?php
        include "../components/footer.php";
    ?>
</body>

</html>
