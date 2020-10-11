<?php
    require("../config/conexion.php");
    $query = "select * from navieras";
    $result = $db -> prepare($query);
    $result -> execute();
    $navieras = $result -> fetchAll();
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
            <h1>Navieras</h1>
        </div>

        <div class="row justify-content-around">
            <?php
            foreach($navieras as $nav){
                
                echo "<div class='card col-xs-12 col-sm-6 col-md-4 col-lg-2 cole-xl-1 mx-2 mt-2' style='width: 18rem;'>
                <div class='card-body'>
                  <h5 class='card-title'>$nav[1]</h5>
                  <h6 class='card-subtitle mb-2 text-muted'>$nav[2]</h6>
                  <p class='card-text'>$nav[3].</p>
                <form method = 'POST' action = 'naviera.php'>
                    <input value='$nav[0]' name='nid' class = 'd-none' type='text' disable>
                    <input value='$nav[1]' name='name' class = 'd-none' type='text' disable>
                    <button type='submit' class='btn btn-dark'>Mas info</button>
                </form>
                </div>
              </div>";
                
            }
        ?>
        </div>


    </div>
    <?php
        include "../components/footer.php";
    ?>
</body>

</html>