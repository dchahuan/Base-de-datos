<?php
include "components/head.php";
include "components/header.php";
require("config/conexion.php");
if (isset($_SESSION["pasaporte"])){
    echo "hello ". $_SESSION["pasaporte"];
?>







<?php } else {
    header("/~grupo16/index.php?error=nouser");
    exit();

}?>