<?php
  session_start();
        

if (isset($_SESSION["pasaporte"])){
    include "../components/head.php";
    include "../components/header.php";
    require("scripts/funciones_mensajes.php");
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
        Mensajes Enviados
    </h3>

    <?php
        $array_mesajes = get_message_sent($data_nombre);
        if (count($array_mesajes) == 0){
            echo "<h5>No tienes mensajes enviados :(</h5>";
        } else {
            $uid_actual = $array_mesajes[0]->receptant;
            echo "<div class = 'card'>";
            echo "<h3>Mensajes recibidos de ".$uid_actual."</h3></br>";

            foreach($array_mesajes as $mensaje){
                if ($mensaje->receptant != $uid_actual){
                    $uid_actual = $mensaje->receptant;
                    echo "</div>";
                    echo "<div class = 'card'>";
                    echo "<h3>Mensajes recibidos de".$uid_actual."</h3></br>";
                }

                echo '<p>'.$mensaje->receptant.'</p>';
                echo '<p>'.$mensaje->message.'</p>';
                echo '<p>'.$mensaje->lat.'</p>';
                echo '<p>'.$mensaje->long.'</p>';
                echo '<p>'.$mensaje->date.'</p>';



            }
            
        }
        echo "</div>";
    ?>
</div>

<?php
 } else {
    header("Location: /~grupo16/index.php?error=nouser");
    exit();
}?>
