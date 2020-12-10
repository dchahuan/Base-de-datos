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
    <div class="row">
        <div class="col-sm-6">
            <div class="border p-4" style="margin-left: 15%; margin-right: 0%">
                <h2 style="color:black; text-align: center;" class="center mb-4">Capacidad y porcentaje de ocupación</h2>
                <ul>
                    <li> Para revisar que instalaciones tienen capacidad en una fecha en específico, ingresa un rango a continuación!</li>
                </ul>
                <form action="consulta1_puerto.php" method="POST">
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
                            <span class="input-group-btn">
                                <button class="btn btn-dark btn-flat" type="submit" name="submitRangeDates">Consultar</button>
                            </span>
                        </div>
                    </div>
                </form>
                <!-- Aqui enviar los datos a consulta1_puertos.php para ejecutarlo -->
            </div>
        </div>
    </div>
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
