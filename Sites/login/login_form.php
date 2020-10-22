<?php
    include "../components/head.php"
?>

<body>
    <div class="bg-dark vh-100">
        <div class="container mx-auto rounded border border-dark bg-light">
            <div class="container text-center ">

                <h1>Login<h1>

            </div>


            <hr style="border:1px solid black;">

            <form action="/~grupo16/login/scripts/login_checker.php" method="post">
                <div class="form my-3">
                    <div class="form-group">
                        <label for="name" class="col-3 control-label">Numero de patente: </label>
                        <input type="text" name="pasaporte" class="col-9 form-control" placeholder="Numero de pasaporte"
                            id="name">
                    </div>
                    <div class="form-group">
                        <label for="edad" class="col-3 control label">Password: </label>
                        <input type="password" class="col-9 form-control" name="pwd" placeholder="Password" id="edad">
                    </div>
                </div>


                <button type="submit" name="login-submit" class="btn btn-dark btn-block mb-3">Login</button>


            </form>



            <?php
                if (isset($_GET["error"])){
                    echo "<h7 class = 'text-danger'>";
                    if($_GET["error"] == "wrongpwd"){

                        echo "Su usuario o su clave no existen en la base de datos";
                    } else if ($_GET["error"] == "empty"){
                        echo "No ha rellenado todos los items del form";
                    }

                    echo "</h7>";
                }
                
            
            
            ?>
        </div>
    </div>

</body>

</html>