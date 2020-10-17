<?php
    include "components/head.php";
    include "components/header.php";

if (isset($_SESSION["pasaporte"])){

    require("config/conexion.php");


    $query_data_ususario = "select id,nombre,pasaporte,edad,nacionalidad,sexo from usuarios where pasaporte = ?";
    $resultado_usuario = $db -> prepare($query_data_ususario);
    $resultado_usuario ->execute([$_SESSION["pasaporte"]]);
    $data_usuario = $resultado_usuario -> fetchAll();
    $data_usuario = $data_usuario[0];
?>



<div class="container  flex-grow-1 container-p-y">
            <?php 

                echo '<div class="media align-items-center py-3 mb-3">';

                if (data_usuario[5] == "hombre") {
                    
                } else {
                    echo ' <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" class="d-block ui-w-100 rounded-circle">';
                }
                
             
              echo '<div class="media-body ml-4">
                <h4 class="font-weight-bold mb-0">'.$data_usuario[1].'<span class="text-muted font-weight-normal">@'.$data_usuario[2].'</span></h4>
                <div class="text-muted mb-2">ID:'.$data_usuario[0].'</div>
              </div>
            </div>
                ';

             ?>
            

            <div class="card mb-2">
              <div class="card-body">
                <h6 class="mt-4 mb-3">Personal info</h6>
                <?php 

                    echo '<table class="table user-view-table m-0">
                  <tbody>
                    <tr>
                      <td>Numero de pasaporte</td>
                      <td>'.$data_usuario[2].'</td>
                    </tr>
                    <tr>
                      <td>Edad:</td>
                      <td>'.$data_usuario[3].'</td>
                    </tr>
                    <tr>
                      <td>Nacionalidad:</td>
                      <td>'.$data_usuario[4].'</td>
                    </tr>
                    <tr>
                      <td>Genero:</td>
                      <td>'.$data_usuario[5].'</td>
                    </tr>
                  </tbody>
                </table>';

                 ?>
                

            </div>

          </div>





<?php 
    $query_es_capitan = "select * from capitanes where pasaporte = ?";
    $result = $db -> prepare($query_es_capitan);
    $result -> execute([$_SESSION["pasaporte"]]);
    $es_capitan = $result -> fetchAll();


    if (count($es_capitan) > 0 ){
        $patente = $es_capitan[0][0];

 ?>

 <div class="card">
     
     <div class="card-body">
        <h6 class="mt-4 mb-3">Buque: </h6>
        <?php 

                    echo '<table class="table user-view-table m-0">
                  <tbody>
                    <tr>
                      <td>Patente: </td>
                      <td>'.$patente.'</td>
                    </tr>
                  </tbody>
                </table>';

        ?>
        <h6 class="mt-4 mb-3">Proximo itinerario: </h6>
         <?php 


                $query_data_prox = "select puerto, fecha_llegada from proximo_itenerario where patente = ?";
                $resultado_prox = $db -> prepare($query_data_prox);
                $resultado_prox -> execute([$patente]);
                $proximos_itinerario = $resultado_prox -> fetchAll();

                if (count($proximos_itinerario) > 0){
                    echo '<table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Puerto:</th>
                        <th scope="col">Fecha de llegada</th>

                    </tr>
                </thead>
                <tbody>';
                ?>

                <?php
                    foreach($proximos_itinerario as $p){
                        echo "<tr><td>$p[0]</td><td>$p[1]</td></tr>";
                    };
                echo '</tbody>
            </table>';
                } else {
                    echo "<p>No hay proximo itinerario</p>";
                }   
        ?>

                    
        <h6 class="mt-4 mb-3">Ultimos 5 atracos: </h6>
        <?php 
            $query_ultimos_atracos = "select puerto,fecha_llegada, fecha_salida from atracos where patente = ? order by fecha_llegada desc limit 5;";
            $resultado_atracos = $db -> prepare($query_ultimos_atracos);
            $resultado_atracos -> execute([$patente]);
            $ultimos_5_atracos = $resultado_atracos -> fetchAll();




            echo '<table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Puerto</th>
                        <th scope="col">Fecha de llegada</th>
                        <th scope="col">Fecha de salida</th>
                    </tr>   
                </thead>
                <tbody>';
                ?>

                <?php

                    foreach($ultimos_5_atracos as $u){
                        echo "<tr><td>$u[0]</td><td>$u[1]</td><td>$u[2]</td></tr>";
                    };
                echo '</tbody>
            </table>';


         ?>
     </div> 
 </div>

<?php }else {
    echo "";
    }

 } else {
    header("/~grupo16/index.php?error=nouser");
    exit();

}?>