<?php
    require("../config/conexion.php");
    $query = "select * from navieras";
    $result = $db -> prepare($query);
    $result -> execute();
    $navieras = $result -> fetchAll();
?>

<?php if(isset($_POST["nid"])){?>
<!DOCTYPE html>
<html lang="en">

<?php
    include "../components/head.php"
?>

<body>
    <?php
        include "../components/header.php"
    ?>

    <div class="container-fluid">

        <div class="text-center">
            <h1>Naviera</h1>
        </div>

        <?php
            print_r($_POST)
        ?>




    </div>
    <?php
        include "../components/footer.php";
    ?>
</body>

</html>

<?php
} else {
    header("Location: /~grupo16/consultas/navieras.php");
    exit();
}?>