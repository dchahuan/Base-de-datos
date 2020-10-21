<?php
    require("../config/conexion_2.php");
    $query = "SELECT * FROM Puertos";
    $result = $db_2 -> prepare($query);
    $result -> execute();
    $puertos = $result -> fetchAll();
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
            <h1>Puertos</h1>
        </div>
        <div class="row justify-content-around">
            <?php
            foreach($puertos as $p){
                
                echo "<div class='card col-xs-12 col-sm-6 col-md-4 col-lg-2 cole-xl-1 mx-2 mt-2' style='width: 18rem;'>
                <div class='card-body'>
                  <h5 class='card-title'>$p[0]</h5>
                  <h6 class='card-subtitle mb-2 text-muted'>$p[1], Región de $p[2], Chile</h6>
                <form method = 'POST' action = 'puerto.php'>
                    <input value='$p[0]' name='name' class = 'd-none' type='text' disable>
                    <button type='submit' class='btn btn-dark'>Mas info</button>
                </form>
                </div>
              </div>";
                
            }
        ?>
        </div>


    </div>
    <?php
        include "../components/footer.php"
    ?>
</body>

</html>