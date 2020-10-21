<?php 
require("../config/conexion.php");
require("../config/conexion_2.php");




$query = "select nombre, rut, edad, sexo from personal, instalaciones where rut_jefe = rut;";
$results = $db_2 -> prepare($query);
$results -> execute();
$jefes = $results -> fetchAll();

try{
	$db -> beginTransaction();
	foreach($jefes as $j){

	    $query2 = "insert into usuarios(nombre,pasaporte,edad,nacionalidad,sexo,pwd) values (?,?,?,?,?,?);";
	    $resutls = $db -> prepare($query2); 
	    $resutls -> execute([$j[0],$j[1],$j[2],"Chilena",$j[3],"a"]);
	}
	$db -> commit();
	echo "Transaccion terminada";
} catch (Exception $e){
    $db->rollback();
    throw $e;
}



?>


