<?php
    include "../components/head.php"
?>

<body>
    <div class="bg-dark vh-100">
        <div class="container mx-auto rounded border border-dark bg-light   ">
            <div class="container text-center ">

                <h1>Signup<h1>

            </div>

            <hr style="border:1px solid black;">

            <form action="/~grupo16/login/scripts/singup.php" method="post">
                <div class="form">
                    <div class="form-group">
                        <label for="name" class="col-3 control-label">Nombre: </label>
                        <input type="text" name="name" class="col-9 form-control" placeholder="Username" id="name">
                    </div>
                    <div class="form-group">
                        <label for="edad" class="col-3 control label">Edad: </label>
                        <input type="num" min="0" step="1" class="col-9 form-control" name="edad" placeholder="Edad"
                            id="edad">
                    </div>
                    <div class="form-group">
                        <label for="pasaporte" class="col-3 control-label">Numero de pasaporte: </label>
                        <input type="text" name="pasaporte" class="col-9 form-control" placeholder="Numero de pasaporte"
                            id="pasaporte">
                    </div>
                    <div class="form-group">
                        <label for="nacionalidad" class="col-3 control-label">Nacionalidad </label>
                        <input type="text" name="nacionalidad" class="col-9 form-control" placeholder="Nacionalidad"
                            id="nacionalidad">
                    </div>
                    <fieldset class="form-group">
                        <div class="row mx-1">
                            <legend class="col-form-label col-sm-2 pt-0">Genero</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="hombre" value="hombre"
                                        checked>
                                    <label class="form-check-label" for="hombre">
                                        Hombre
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="mujer" value="mujer">
                                    <label class="form-check-label" for="mujer">
                                        Mujer
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <label for="pwd" class="col-3 control-label">Contraseña:</label>
                        <input type="password" class="col-9 form-control" name="pwd" placeholder="Password" id="pwd">
                    </div>
                    <div class="form-group">
                        <label for="pwd-r" class="col-3 control-label">Repita su contraseña: </label>
                        <input type="password" class="col-9 form-control" name="pwd-r"
                            placeholder="Reapeat your password">
                    </div>
                </div>


                <button type="submit" name="signup-submit" class="btn btn-dark btn-block my-1">Register</button>


            </form>

            <?php
        if (isset($_GET["error"])){
            echo "<h7 class = 'text-danger'>";
            if ($_GET["error"] == "emptyfields"){
                echo "Alguno de los items esta vacio";
            } else if ($_GET["error"] == "pwd_mismatch"){
                echo "Las claves no son iguales";
            } else if ($_GET["error"] == "invalid_passport"){
                echo "Su numero de pasaporte ya fue usado por otra cuenta";
            } else if ($_GET["error"] == "edad_no_int"){
                echo "La edad no es un numero entero.";
            }
            echo "</h7>";
        } else if (isset($_GET["signup"])){
            echo "<h7 class = 'text-success'>Se ha registrado correctamente</h7>";
            echo "<a class='btn btn-light my-sm-0 my-2 mr-2' href='/~grupo16/home.php' role='button'>Home</a>";
        }
    ?>

        </div>
    </div>



</body>

</html>