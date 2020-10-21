<?php
    try {
        #Pide las variables para conectarse a la base de datos.
        require('data_2.php'); 
        # Se crea la instancia de PDO
        $db_2 = new PDO("pgsql:dbname=$databaseName;host=localhost;port=5432;user=$user;password=$password");
    } catch (Exception $e) {
        echo "No se pudo conectar a la base de datos: $e";
    }
?>