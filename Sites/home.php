<?php
    include "components/head.php";
    include "components/header.php";




if (isset($_SESSION["pasaporte"])){
    require("config/conexion.php");



    $query_es_capitan = "select * from capitanes where pasaporte = ?";
    $result = $db -> prepare($query_es_capitan) ;
    $result -> execute([$_SESSION["pasaporte"]]) ;
    $es_capitan = $result -> fetchAll();

    $query_data_ususario = "select nombre,pasaporte,edad,nacionalidad,sexo from usuarios where pasaporte = ?";
    $resultado_usuario = $db -> prepare($query_data_ususario) ->execute([$_SESSION["pasaporte"]])
    $data_usuario = $resultado_usuario -> fetchAll();



    
?>







<?php 
    if (count($es_capitan) > 0 ){
        $patente = $es_capitan["patente"];
        echo "Felicitacion encontraste un capitan";

        #$query_itinerarios_pasados = "select * from intinerarios where patente = ? order by fecha_salida limit 5";
        #$resultados_itinerarios = $db -> prepare($query_itinerarios_pasados) -> execute($patente);


        #Programar tabla
        #foreach($resultados_itinerarios as $i){
            #continue 
        #}
    }

 ?>


<?php } else {
    header("/~grupo16/index.php?error=nouser");
    exit();

}?>