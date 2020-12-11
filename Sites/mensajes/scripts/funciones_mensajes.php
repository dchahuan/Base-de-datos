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

function get_user_name($uid){
    $res = file_get_contents(
        sprintf("https://entrega5-bdd.herokuapp.com/users/%d",$uid)
    );
    $res = json_decode($res);
    if (isset($res->error)){
        return "";
    }
    $name = $res[0][0]->name;
    return $name;
}

function send_message($message, $sender, $receptant, $lat, $long, $date){
    $url = 'https://entrega5-bdd.herokuapp.com/messages';
    $data = array('message' => $message, 
                'sender' => intval($sender),
                'receptant' => intval($receptant),
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

function text_search($desired = "",$required = "",$forbidden  = "", $name){
    $uid = get_user_id($name);

    $data = array('userId' => intval($uid));

    if ($desired !== ""){
        $data['desired'] = explode(",",$desired);
        
    }
    
    if ($required !== ""){
        $data['required'] = explode(",",$required);
        
    }

    if ($forbidden !== ""){
        $data['forbidden'] = explode(",",$forbidden);
        
    }

    $options = array(
        'http' => array(
        'method'  => 'GET',
        'content' => json_encode( $data ),
        'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
        )
    );
    
    $context  = stream_context_create( $options );
    $result = file_get_contents( 'https://entrega5-bdd.herokuapp.com/text-search', false, $context );
    $response = json_decode($result, true);
    return $response;
    
    

}
?>