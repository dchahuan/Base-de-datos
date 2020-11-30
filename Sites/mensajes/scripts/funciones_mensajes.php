<?php

function get_user_id($name){
    $res = file_get_contents("https://entrega5-bdd.herokuapp.com/users");
    $res = json_decode($res);
    $uid;
    print_r($res[0]);

    foreach($res as $user){
        
    }

    return $uid;
}


?>