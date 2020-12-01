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
    $data_nombre = $data_nombre[0];
?>


<div class="container">
    <h3 class = "text-center"> 
        Enviar mensajes
    </h3>

    <form action="/~grupo16/mensajes/scripts/enviar_menajes.php" method = "POST">

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Escriba el mensaje:</label>

            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
        </div>

        <div class="form-group">
            <label for="name" class="control-label">Uid del receptor: </label>
            <input type="text" name="pasaporte" class="form-control" placeholder="Uid" id="name">
        </div>

        <button type="submit" class = "btn btn-dark">Enviar</button>

    </form>
    
</div>

<?php
 } else {
    header("Location: /~grupo16/index.php?error=nouser");
    exit();
}?>
