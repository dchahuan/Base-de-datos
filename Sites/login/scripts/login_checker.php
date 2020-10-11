<?php

if (isset($_POST["login-submit"])){
    require("../../config/conexion.php");


    $n_pass = $_POST["pasaporte"];
    $pwd = $_POST["pwd"];
    

    if (empty($pwd) || empty($n_pass)){
        header("Location: /~grupo16/login/login_form.php?error=empty");
        exit();
    } else {
        $query = "select pwd from usuarios where pasaporte = :pasaporte";
        $results = $db -> prepare($query); 
        $results -> execute(["pasaporte" => $_POST["pasaporte"]]);
        $usuario = $results -> fetchAll();


        if ($usuario[0] == $_POST["pwd"]){
            session_start();
            $_SESSION["pasaporte"] = $n_pass;
            
            header("Location: \~grupo16\home.php ");
            exit();
        } else{
            $a = $usuario[0];
            header("Location: /~grupo16/login/login_form.php?error=wrongpwd&db=$a");
            exit();
        }
    }
} else {
    header("Location: /~grupo16/login/login_form.php");
    exit();
    
}