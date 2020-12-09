<?php

session_start();

if (isset($_SESSION["pasaporte"])){
    include "../components/head.php";
    include "../components/header.php";
    require("../config/conexion.php");
    require("../config/conexion_2.php");
    $query_nombre_ususario = "select nombre from usuarios where pasaporte = ?";
    $resultado_usuario = $db -> prepare($query_nombre_ususario);
    $resultado_usuario ->execute([$_SESSION["pasaporte"]]);
    $data_nombre = $resultado_usuario -> fetchAll();
    $data_nombre = $data_nombre[0]["nombre"];
?>


<div class="container">
    <h3 class = "text-center"> 
        Text-Search Resultados
    </h3>
        <?php
            if (isset($_POST["name"])){
                echo "Mensajes";
                $d = trim($_POST["d"]);
                $r = trim($_POST["r"]);
                $f = trim($_POST["f"]);
                $mensajes = text_search($d,$r,$f,$data_nombre);
                
                print_r($mensajes);
                
            } else{
                echo "<h3 class = 'text-danger'>Tienes que entrar a este link por el form</h3>";
            }
        
        ?>
    
    
    
    
    </form>


</div>

<?php
}else{
    header("Location: /~grupo16/home.php");
    exit();
}


?>