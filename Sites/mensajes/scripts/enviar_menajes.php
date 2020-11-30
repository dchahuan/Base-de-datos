<?php
session_start();
        

if (isset($_SESSION["pasaporte"])){
    
} else {
    header("Location: /~grupo16/home.php");
    exit();
}

