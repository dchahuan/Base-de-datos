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

function get_valid_user($uid){
    $res = file_get_contents(
        sprintf("https://entrega5-bdd.herokuapp.com/users/%d",$uid)
    );
    $res = json_decode($res);
    
    if (isset($res->error)){
        return FALSE;
    }

    return TRUE;
}

function send_message($message, $sender, $receptant, $lat, $long, $date){
    $url = 'https://entrega5-bdd.herokuapp.com/messages';
    $data = array('message' => $message, 
                'sender' => inval($sender),
                'receptant' => $receptant,
                'lat' => $lat,
                'long' => $long,
                'date' => $date);

    // use key 'http' even if you send the request to https://...
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
    if (isset($result->error)){
        return FALSE;
    }
    return TRUE;
}

function rand_float($st_num=.276865,$end_num=.97999,$mul=10000000000)
    {
    return rand($st_num*$mul,$end_num*$mul)/$mul;
    }
?>