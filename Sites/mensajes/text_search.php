<?php

session_start();

if (isset($_SESSION["pasaport"])){
    include "../components/head.php";
    include "../components/header.php";
    require("../config/conexion.php");
    require("../config/conexion_2.php");
?>


<div class="container">
    <h3 class = "text-center"> 
        Text-Search Resultados
    </h3>
        <?php
            if (isset($POST["name"])){
                echo "Mensajes";
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