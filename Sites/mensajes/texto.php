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
        Text-Search
    </h3>
    <div class="card">
        <div class="card-body">
            <h3> Data </h3>
            <hr>
            <form action="/~grupo16/mensajes/scripts/text_search.php" method = "GET" >
                
                <div class="form-group">
                    <label for="d" class="control-label">Desired: </label>
                    <input type="text" name="d" class="form-control" placeholder="Word1,Word2,Word3...." id="d">
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Required: </label>
                    <input type="text" name="r" class="form-control" placeholder="Word1,Word2,Word3...." id="r">
                </div>

                <div class="form-group">
                    <label for="f" class="control-label">Forbidden: </label>
                    <input type="text" name="f" class="form-control" placeholder="Word1,Word2,Word3...." id="f">
                </div>



            </form>
        </div>
    
    </div>


</div>

<?php
 } else {
    header("Location: /~grupo16/index.php?error=nouser");
    exit();
}?>
