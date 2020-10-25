<?php
    require("../config/conexion_2.php");
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
            echo "Rango de fechas seleccionadas: ". $_POST['date_range'];
            ?>
            </h1>
        </div>
    </div>
    <?php
        include "../components/footer.php";
    ?>
</body>

</html>
