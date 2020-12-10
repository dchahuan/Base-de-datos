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

<body>
<div class="container">
    <h3 class = "text-center"> 
        Mapa Mensajes
    </h3>
    <div class="card">
        <div class="card-body">
            <h4> Palabras claves: </h4>
            <hr>

            <form action="/~grupo16/mensajes/text_search.php" method = "POST" >

                <div class="form-group mt-3">

                  <label>Selecciona fechas:</label>

                  <div class="input-group">

                      <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" id="date_range" name="date_range" class="form-control pull-right" required>
                      <?php
                          // echo "<input value= '$nombre_puerto' name='nombre_puerto' class = 'd-none' type='text' disable>";
                      ?>

                  </div>

                </div>
                
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

                <div class="form-group">
                    <?php
                        echo "<input value='$data_nombre' name='name' class = 'd-none' type='text' disable>"
                    ?>
                    
                </div>

                <button type="submit" class = "btn btn-dark">Enviar</button>

            </form>
        </div>
    </div>

    <hr>

    <div id = "mapid">
    </div>
</div>

<script>

  // initialize the map
  var map = L.map('mapid').setView([-38, -90.5], 4);

  // load a tile layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

  </script>

</body>

<?php
} else {
    header("Location: /~grupo16/index.php?error=nouser");
    exit();
}?>
