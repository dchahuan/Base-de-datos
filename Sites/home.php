<?php
require("config/conexion.php");
if (isset($_SESSION["pasaporte"])){
    include "components/head.php";
    include "components/header.php";
    echo "hello ". $_SESSION["pasaporte"];
?>







<?php } else {
    header("/~grupo16/index.php?error=nouser");
    exit();

}?>