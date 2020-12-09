<?php

session_start();

if (isset($_SESSION["pasaport"])){
    include "../components/head.php";
    include "../components/header.php";
    require("../config/conexion.php");
    require("../config/conexion_2.php");


    $query_nombre_ususario = "select nombre from usuarios where pasaporte = ?";
    $resultado_usuario = $db -> prepare($query_nombre_ususario);
    $resultado_usuario ->execute([$_SESSION["pasaporte"]]);
    $data_nombre = $resultado_usuario -> fetchAll();
    $data_nombre = $data_nombre[0];
?>


<div class="container">
    <h3 class = "text-center"> 
        Text-Search Resultados
    </h3>

    
    
    
    
    </form>


</div>

<?php
}else{
    header("Location: /~grupo16/home.php");
    exit();
}


?>