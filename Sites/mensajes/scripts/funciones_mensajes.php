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

    $mensajes = file_get_contents("https://entrega5-bdd.herokuapp.com/messages");
    $mensajes = json_decode($mensajes);

    $array_mesajes = [];


    foreach($mensajes as $m){
        if ($m->sender == $uid){
            array_push($array_mesajes, $m);
        }

    }

    return $array_mesajes;
}
?>