<?php

if (isset($_POST["login-submit"])){
    require("../../config/conexion.php");


    $n_pass = $_POST["pasaporte"];
    $pwd = $_POST["pwd"];
    

    if (empty($pwd) || empty($n_pass)){
        header("Location: /~grupo16/login/login_form.php?error=empty");
        exit();
    } else {

        try{
            $query = "select pwd from usuarios where pasaporte = :pwd";
            $reults = $db -> prepare($query); 
            $results -> execute(["pwd" => $_POST["pwd"]]);
            $usuario = $results -> fetchAll();
        } catch (Exception $e) {
            echo "$pwd";
        }
        

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