<?php
session_start();
        

if (isset($_SESSION["pasaporte"])){

    require("../../config/conexion.php");
    require("../../config/conexion_2.php");
    require("funciones_mensajes.php");

    $text = $_POST["mensaje"];
    $uid_receptor = $_POST["uid"];
    $uid_sender;
    $date = date("Y-m-d");

    if (empty($text) || empty($uid_receptor)){
        header("Location: /~grupo16/mensajes/enviar.php?error=empty".$uid_receptor);
        exit();
    } else if (!filter_var($uid_receptor, FILTER_VALIDATE_INT)){
        header("Location: /~grupo16/mensajes/enviar.php?error=non_int_uid");
        exit();
    } else if (!get_valid_user($uid_receptor)){
        header("Location: /~grupo16/mensajes/enviar.php?error=non_valid_uid");
        exit();
    } else{
        $query_nombre_ususario = "select nombre from usuarios where pasaporte = ?";
        $resultado_usuario = $db -> prepare($query_nombre_ususario);
        $resultado_usuario ->execute([$_SESSION["pasaporte"]]);
        $data_nombre = $resultado_usuario -> fetchAll();
        $data_nombre = $data_nombre[0]["nombre"];
        
        $uid_sender = get_user_id($data_nombre);

        $query_es_capitan = "select * from capitanes where pasaporte = ?";
        $result = $db -> prepare($query_es_capitan);
        $result -> execute([$_SESSION["pasaporte"]]);
        $es_capitan = $result -> fetchAll();

        $query_es_jefe = "select Instalaciones.id_instalacion, rut_jefe, tipo_instalacion, nombre_puerto  from personal, instalaciones, esta_en where rut_jefe = rut and esta_en.id_instalacion = instalaciones.id_instalacion and rut_jefe = ?";
        $resultado_jefe = $db_2 -> prepare($query_es_jefe);
        $resultado_jefe -> execute([$_SESSION["pasaporte"]]);
        $es_jefe = $resultado_jefe -> fetchAll();
        
        if (count($es_capitan) > 0 ){
            $longitud = (-1)*(90 + rand_float());
            $latitud = (-1)*(rand_float(27.374641, 50.291406));
            $validez = send_message($text,$uid_sender,intval($uid_receptor),$latitud,$longitud,$date);
        } else if (count($es_jefe) > 0){
            $puerto = $es_jefe[0][3];
            $puerto = $puerto.trim(" ");

            ### Faltan querys de long y lat
            $query_coords = "select latitud, longitud from ubicacion where puerto = ?;";
            $resultado = $db-> prepare($query_coords);
            $resultado -> execute([$puerto]);
            

            $data = $resultado ->fetchAll();

            $data = $data[0];

            $latitud = $data[0];
            $longitud = $data[1];

            $validez = send_message($text, $uid_sender, $uid_receptor,$latitud,$longitud,$date);

        } else {
            # Coordenadas de santiago segun https://www.geodatos.net/coordenadas/chile/santiago
            $longitud = -70.64827;
            $latitud = -33.45694;
            $validez = send_message($text,$uid_sender,$uid_receptor,$latitud,$longitud,$date);
        }

        if ($validez == TRUE){
            header("Location: /~grupo16/mensajes/enviar.php?error=success");
            exit();
        } else {
            header("Location: /~grupo16/mensajes/enviar.php?error=unknown");
            exit();
        }
    }

} else {
    header("Location: /~grupo16/home.php");
    exit();
}

