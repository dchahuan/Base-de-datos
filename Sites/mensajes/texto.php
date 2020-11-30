<?php
  session_start();
        

if (isset($_SESSION["pasaporte"])){
    include "components/head.php";
    include "components/header.php";
    require("config/conexion.php");
    require("config/conexion_2.php");


    $query_nombre_ususario = "select nombre from usuarios where pasaporte = ?";
    $resultado_usuario = $db -> prepare($query_nombre_ususario);
    $resultado_usuario ->execute([$_SESSION["pasaporte"]]);
    $data_nombre = $resultado_usuario -> fetchAll();
    $data_nombre = $data_nombre[0];
?>


<div class="container">
    <h3 class = "text-center"> 
        Menu Mensajes
    </h3>

    <ul>
        <div class="card">
        <div class="list-group">
            
            <a href="/~grupo16/recibidos.php" class="list-group-item list-group-item-action d-flex align-items-center">
                <img src = "/~grupo16/img/icons/inbox.png" style = "max-width: 50px"></img>
                <h3 class = "mx-4">Ver mensajes recibidos</h3>
                
            </a>
            <a href="/~grupo16/enviados.php" class="list-group-item list-group-item-action d-flex align-items-center">
                <img src = "/~grupo16/img/icons/outbox.png" style = "max-width: 50px"></img>
                <h3 class = "mx-4">Ver mensajes enviados</h3>
                
            </a>
            <a href="/~grupo16/enviar.php" class="list-group-item list-group-item-action d-flex align-items-center">
                <img src = "/~grupo16/img/icons/enviar.png" style = "max-width: 50px"></img>
                <h3 class = "mx-4">Enviar mensaje</h3>
                
            </a>
            <a href="/~grupo16/texto.php" class="list-group-item list-group-item-action d-flex align-items-center">
                <img src = "/~grupo16/img/icons/lupa.png" style = "max-width: 50px"></img>
                <h3 class = "mx-4">Buscar mensajes por texto</h3>
                
            </a>
        </div>
        </div>
    
    </ul>


</div>

<?php
 } else {
    header("Location: /~grupo16/index.php?error=nouser");
    exit();
}?>
