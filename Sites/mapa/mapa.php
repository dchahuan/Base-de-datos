<?php
  session_start();
        

if (isset($_SESSION["pasaporte"])){
    include "../components/head.php";
    include "../components/header.php";
    require("../config/conexion.php");
    require("../config/conexion_2.php");
    require("scripts/funciones_mapa.php");


    $query_nombre_ususario = "select nombre from usuarios where pasaporte = ?";
    $resultado_usuario = $db -> prepare($query_nombre_ususario);
    $resultado_usuario ->execute([$_SESSION["pasaporte"]]);
    $data_nombre = $resultado_usuario -> fetchAll();
    $data_nombre = $data_nombre[0];

    $date_range = $POST["data_range"];
    $uid = $POST["usuario"];
    $required = $POST["required"];
    $nombre = $POST["name"]
?>

<body>
<div class="container m-2">
    <h3 class = "text-center"> 
        Mapa Mensajes
    </h3>

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

  var marker = L.marker([-38, -90.5]).addTo(map);

</script>

</body>

<?php
} else {
    header("Location: /~grupo16/index.php?error=nouser");
    exit();
}?>
