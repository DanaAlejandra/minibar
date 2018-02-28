<?php
session_start();
include('php/conexion.php'); 
// Datos previos al registro 


$id_user = $_SESSION['user_id']; 
$fecha = date ("j/n/Y");
$id_hab = $_SESSION['id_hab'];

// Datos ingreso de productos y estado 
$evaluacion = $_POST['estado'];  
$nombre = $_POST['nombre']; 

     $sql = "INSERT INTO `registro`(`r_id`, `r_fecha`, `fk_usuario`, `fk_habitacion`) VALUES ('','$fecha','$id_user', '$id_hab')"; 
 
       if ($in = $con -> query($sql)) {
       $last_id = mysqli_insert_id($con);
       
      //Consulta de id producto ingresado
          $query_p = "SELECT `pd_id` FROM `productos` WHERE pd_nombre='$nombre'"; 
          if ($consulta_p = $con -> query($query_p) ) {
            $result_p = mysqli_fetch_array($consulta_p); 
            $id_product = $result_p['pd_id']; 
          }

      //Consulta id evaluacion 
          $query_e = "SELECT `ev_id` FROM `evaluacion` WHERE ev_descripcion='$evaluacion'"; 

          if ($consulta = $con -> query($query_e)) {
            $result_e = mysqli_fetch_array($consulta); 
            $id_evaluacion = $result_e['ev_id']; 
          
    echo 'Los datos ingresados son : '; 
    echo 'Id Habitacion '.$id_hab.'<br>'; 
    echo 'Usuario '.$id_user.'<br>';
    echo 'Estado evaluacion '.$id_evaluacion.'<br>';
    echo 'Fecha '.$fecha.'<br>';
    echo 'Productos '.$id_product.'<br>';
          }
        }
/*
          }
          else
          {
            echo 'No valida'; 
          }


            if ($estado > 0) {    
           $mysql = "INSERT INTO `stock`(`s_id`, `fk_estado`, `fk_producto`, `fk_registro`) VALUES('', '$evaluacion', '$id_producto', '$last_id')"; 

               if ($nuevo =  $con -> query($mysql)) {
              echo 'Registo exitoso';


       //verificación de variables

       }              
} 
       
    
}

*/
mysqli_close($con); 
?>