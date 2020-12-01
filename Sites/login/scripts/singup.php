<?php

function api_signup($name, $edad){
    $url = 'https://entrega5-bdd.herokuapp.com/users';
    $data = array('name' => $name, 'age' => $edad,'description' => "");

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
};



if (isset($_POST["signup-submit"])){
    require("../../config/conexion.php");

    $username = $_POST["name"];
    $pwd = $_POST["pwd"];
    $pwd_r = $_POST["pwd-r"];
    $edad = $_POST["edad"];
    $sexo = $_POST["sexo"];
    $n_pasaporte = $_POST["pasaporte"];
    $pais = $_POST["nacionalidad"];

    if (empty($username) || empty($pwd) || empty($pwd_r) || empty($edad) || empty($sexo) || empty($n_pasaporte) || empty($pais)){
        header("Location: /~grupo16/login/signup_form.php?error=emptyfields");
        exit();
    } else if (!($pwd_r == $pwd)){
        header("Location: /~grupo16/login/signup_form.php?error=pwd_mismatch");
        exit();
    } else if (!filter_var($edad, FILTER_VALIDATE_INT)){
        header("Location: /~grupo16/login/signup_form.php?error=edad_no_int");
        exit();
    }else {
        $query = "select name from usuarios where pasaport = :pasaporte";
        $result = $db -> prepare($query);
        $result -> execute(["pasaporte" => $_POST["pasaporte"]]);
        $usuarios = $result->fetchAll();

        if (count($usuarios) > 0){
            header("Location:  /~grupo16/login/signup_form.php?error=invalid_passport");
            exit();
        } else {
            $api_result = api_signup($username, $edad);

            if ($api_result == TRUE){
                $query = "insert into usuarios(nombre,pasaporte,edad,nacionalidad,sexo,pwd) values (?,?,?,?,?,?);";           
                $db -> prepare($query) -> execute([$username,$n_pasaporte,$edad,$pais,$sexo,$pwd]);
                header("Location:  /~grupo16/login/signup_form.php?signup=success");
                exit();
            } else {
                header("Location: /~grupo16/login/signup_form.php?error=er_i");
                exit();
            }
            

        }
    }
} else {
    header("Location: /~grupo16/login/signup_form.php");
    exit();
}