<?php
    include "components/head.php";
    include "components/header.php";


require("config/conexion.php");
if (isset($_SESSION["pasaporte"])){
    $query = "select nombre, pasaporte, edad, nacionalidad,sexo from usuarios where pasaporte = ?";
    $result = $db -> prepare($query);
    $result -> execute([$_SESSION["pasaporte"]]);
    $data = $result -> fetchAll();
    print_r($data[0]);
?>







<?php } else {
    header("/~grupo16/index.php?error=nouser");
    exit();

}?>