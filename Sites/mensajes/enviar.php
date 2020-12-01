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

    <form action="/~grupo16/mensajes/scripts/enviar_menajes.php">
        <div class="form-group">
            <label for="textarea">Escriba mensaje</label>
            <textarea name="mensaje" id="textarea" rows="10"></textarea>
        </div>
        <div class="form-control">
            <label for="uid">Escriba el uid:</label>
            <input type="text" class="form-control" id = "uid" name = "uid">
        </div>

        <button type="submit" class = "btn btn-dark">Enviar</button>

    </form>
    
</div>

<?php
 } else {
    header("Location: /~grupo16/index.php?error=nouser");
    exit();
}?>
