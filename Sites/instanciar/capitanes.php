<?php 
require("../config/conexion.php");




$query = "select pasaporte from capitanes";
$results = $db -> prepare($query);
$results -> execute();
$pasaporte_capites = $results -> fetchAll();

$query2 = "select * from personal where pasaporte = ?";
try{
	$db -> beginTransaction();
	foreach($pasaporte_capites as $num_pass){
	    $results = $db -> prepare($query2);
	    $results -> execute([$num_pass[0]]);
	    $data = $results -> fetchAll();
	    
	    $d = $data[0];

	    $query3 = "insert into usuarios(nombre,pasaporte,edad,nacionalidad,sexo,pwd) values values (?,?,?,?,?,?);";
	    $db -> prepare($query3) -> execute([$d[1],$d[0],$d[3],$d[4],$d[2],"a"]);
	}
	$db -> commit();
	echo "Transaccion terminada";
} catch (Exception $e){
    $db->rollback();
    throw $e;
}



?>


