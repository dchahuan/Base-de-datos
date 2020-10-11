<?php

if (isset($_POST["login-submit"])){
    require("../../config/conexion.php");


    $n_pass = $_POST["pasaporte"];
    $pwd = $_POST["pwd"];
    

    if (empty($pwd) || empty($n_pass)){
        header("Location: /~grupo16/login/login_form.php?error=empty");
        exit();
    } else {
        $query = "SELECT pwd FROM usuarios WHERE pasaporte = ?";
        $db -> prepare($query); 
        $results -> execute([$n_pass]);
        $usuario = $results -> fetchAll();

        if ($usuario["pwd"] == $pwd){
            session_start();
            $_SESSION["pasaporte"] = $n_pass;
            
            header("Location: \~grupo16\home.php ");
            exit();
        } else{
            header("Location: /~grupo16/login/login_form.php?error=wrongpwd");
            exit();
        }
    }
} else {
    header("Location: /~grupo16/login/login_form.php");
    exit();
    
}