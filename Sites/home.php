<?php
if (isset($_SESSION["pasaporte"])){
    include "components/head.php";
    require("config/conexion.php");
    include "components/header.php";


?>





<?php } else {
    header("/~grupo16/index.php?error=nouser");
    exit();

}?>