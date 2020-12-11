<?php

function mapa($palabras, $fechas, $uid){
    $data = array();
    $data["date_range"] = $fechas;

    if (trim($palabras) !== ""){
        $data["required"] = explode(",",$palabras);
    }

    if (trim($uid) !== ""){
        if (filter_var($uid, FILTER_VALIDATE_INT)){
            $data["uid"] = intval($uid);
        }
    }

    $url = "https://entrega5-bdd.herokuapp.com/mapa";

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json",
            'method'  => 'POST',
            'content' => json_encode($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $result = json_decode($result);

    return $result;
}


?>