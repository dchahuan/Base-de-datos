<?php

function get_user_id($name){

    $name = str_replace(' ', '%20', $name);
    $res = file_get_contents(
        sprintf("https://entrega5-bdd.herokuapp.com/users/name/%s",$name)
    );
    $res = json_decode($res);
    $uid = $res[0]->uid;

    return $uid;
}

function get_message_sent($name){

    $uid = get_user_id($name);

    $mensajes = file_get_contents(sprintf("https://entrega5-bdd.herokuapp.com/messages/sent/%d",$uid));
    $mensajes = json_decode($mensajes);
    return $mensajes;
}


function get_message_received($name){
    $uid = get_user_id($name);
    $mensajes = file_get_contents(sprintf("https://entrega5-bdd.herokuapp.com/messages/received/%d",$uid));
    $mensajes = json_decode($mensajes);
    return $mensajes;
}

?>