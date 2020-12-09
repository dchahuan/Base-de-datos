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
        Text-Search Resultados
    </h3>
        <?php
            if (isset($_POST["name"])){
                $d = trim($_POST["d"]);
                $r = trim($_POST["r"]);
                $f = trim($_POST["f"]);
                $array_mesajes = text_search($d,$r,$f,$data_nombre);
                if (count($array_mesajes) == 0){
                    echo "<h5>No has enviado mensajes :(</h5>";
                } else {
                    $uid_actual = $array_mesajes[0]["receptant"];
                    echo "<div class = 'card mb-2'>";
                    echo '<div class="card-body">';
                    echo "<h3>Mensajes enviados a ".get_user_name($uid_actual)."</h3></br>";
                    $contador = 0;
                    foreach($array_mesajes as $mensaje){
                        if ($mensaje->receptant != $uid_actual){
                            $uid_actual = $mensaje->receptant;
                            $contador  = 0;
                            echo "</div>";
                            echo "</div>";
                            echo "<div class = 'card'>";
                            echo '<div class="card-body">';
                            echo "<h3>Mensajes enviados a ".get_user_name($uid_actual)."</h3></br>";
                        }
                        echo "<h5>Mensaje #$contador</h5>";
                        echo '<table class="table user-view-table m-0">
                        <tbody>
                        <tr>
                            <td>Mensaje</td>
                            <td>'.$mensaje["message"].'</td>
                        </tr>
                        <tr>
                            <td>Latitud:</td>
                            <td>'.$mensaje["lat"].'</td>
                        </tr>
                                            
                        <tr>
                            <td>Longitud:</td>
                            <td>'.$mensaje["long"].'</td>
                        </tr>
                        <tr>
                            <td>Fecha de emision:</td>
                            <td>'.$mensaje["date"].'</td>
                        </tr>
                        </tbody>
                        </table>';
                        $contador++;
                    }
                    
                }
                echo "</div>";
                echo "</div>";
                        
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