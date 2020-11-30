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
?>