<?php

function get_user_id($name){
    $res = file_get_contents("https://entrega5-bdd.herokuapp.com/users");
    $res = json_decode($res);
    $uid;
    foreach($res as $user){
        if ($user->name == $name){
            $uid = $user->uid;
        } 
    }

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