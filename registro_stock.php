<?php
session_start();
include('php/conexion.php'); 
// Datos previos al registro 


$id_user = $_SESSION['user_id']; 
$fecha = date ("Y-m-d"); 
$id_hab = $_SESSION['id_habitacion'];

$id_p = $_POST['id']; 
$nombre_p = $_POST['nombre']; 
$evaluacion_p = $_POST['evaluacion'];
$i = 0; 
   
    $sql = "INSERT INTO `registro`(`r_id`, `r_fecha`, `fk_usuario`, `fk_habitacion`) VALUES ('','$fecha','$id_user', '$id_hab')";

       if ($registro = $con -> query($sql)) {
        $last_id = mysqli_insert_id($con);

        while ( $i <= count($id_p)) {
           if($evaluacion_p[$i] > 0){

           $mysql="INSERT INTO `stock`(`s_id`, `fk_estado`, `fk_producto`, `fk_registro`) VALUES ('','$evaluacion_p[$i]','$id_p[$i]','$last_id')";

           if ($re = $con -> query($mysql)) {
               echo 'Registro de producto '.$nombre_p[$i].' Exitoso<br>';
             }  
           else {
              echo 'Error en ingreso en producto '.$nombre_p[$i].'<br>';
           } //FIN IF REGISTRO

           } //FIN DE VALIDACION DE CONSUMO  
          $i++; 
          } //FIN WHILE

       } // FIN IF REGISTRO PARA OBTENER LAST_ID

mysqli_close($con); 
?>