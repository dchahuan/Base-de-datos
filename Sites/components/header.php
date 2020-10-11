<header>
    <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
        <a class="navbar-brand link-personalizado" href="/~grupo16/index.php">Entrega 3 Grupos 16 y 45</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item" id="nav-naviera">
                    <a class="nav-link" href="/~grupo16/consultas/navieras.php">Navieras <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" id="nav-puerto">
                    <a class="nav-link" href="/~grupo16/consultas/puertos.php">Puertos</a>
                </li>
            </ul>
            <?php if (isset($_SESSION["pasaporte"])){
                echo "<a class='btn btn-light my-sm-0 my-2 mr-2' href='/~grupo16/home.php' role='button'>Home</a><a class='btn btn-light my-sm-0 my-2' href='/~grupo16/login/script/logout.php' role='button'>Logout</a>";
            } else {
                echo '<a class="btn btn-light my-sm-0 my-2 mr-2" href="/~grupo16/login/login_form.php" role="button">Login</a>
                <a class="btn btn-light my-sm-0 my-2" href="/~grupo16/login/signup_form.php" role="button">Register</a>';
            }?>


        </div>
    </nav>

</header>