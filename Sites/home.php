<?php
    include "components/head.php";
    include "components/header.php";




if (isset($_SESSION["pasaporte"])){
    require("config/conexion.php");
    echo "hello ". $_SESSION["pasaporte"];


    $query_es_capitan = "select * from capitanes where pasaporte = ?";
    $result = $db -> prepare($query_es_capitan) ;
    $result -> execute([$_SESSION["pasaporte"]]) ;
    $es_capitan = $result -> fetchAll();

    if (count($result) > 0 ){
        $patente = $result["patente"];
        echo $patente;

        $query_itinerarios_pasados = "select * from intinerarios where patente = ? order by fecha_salida limit 5";
        $resultados_itinerarios = $db -> prepare($query_itinerarios_pasados) -> execute($patente);


        #Programar tabla
        foreach($resultados_itinerarios as $i){
            #continue 
        }
    }
    
?>




<?php } else {
    header("/~grupo16/index.php?error=nouser");
    exit();

}?>