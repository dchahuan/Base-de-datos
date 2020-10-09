<?php if(isset($_POST["nid"])){?>
<?php
    require("../config/conexion.php");
    $query = "select * from buques join pertenece on pertenece.patente = buques.patente and pertenece.nid =".$_POST['nid']." order by tipo;";
    $result = $db -> prepare($query);
    $result -> execute();
    $buques = $result -> fetchAll();
?>
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
            <h1>
                <?php
            echo "Naviera ". $_POST['name'];
        ?>
            </h1>
        </div>
        <div class="container">
            <table class="table">
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
                    foreach($buques as $b){
                    echo "<tr><td>$b[1]</td><td>$b[0]</td><td>$b[3]</td><td>$b[2]</td></tr>";
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

<?php
} else {
    header("Location: /~grupo16/consultas/navieras.php");
    exit();
}?>