<?php

function get_user_id($name){
    $res = file_get_contents("https://entrega5-bdd.herokuapp.com/users");
    $res = json_decode($res);
    print_r($res);
    $uid;

    foreach($res as $user){
        print_r($user);
    }

    return $uid;
}


?>