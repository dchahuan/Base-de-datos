<?php

session_start();

if (isset($_SESSION["pasaporte"])){
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
            if (isset($_POST["name"])){
                echo "Mensajes";
                echo trim($_POST["d"]) !== "" ? 'true' : 'false';
                echo isset($_POST["f"]) ? 'true' : 'false';
                echo isset($_POST["r"]) ? 'true' : 'false';
                
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