<?php
include('php/conexion.php');
include('php/inicio.php');
// Datos previos al registro 

$id_user = $_SESSION['u_id']; 
$fecha = date ("Y-m-d"); 
$id_hab = $_SESSION['id_habitacion'];

$id_p = $_POST['id']; 
$nombre_p = $_POST['nombre']; 
$estado_p = $_POST['estado'];
$evaluacion_f = $_POST['evaluacion'];
$i = 0; 
   
    $sql = "INSERT INTO `registro`(`r_id`, `r_fecha`, `fk_usuario`, `fk_habitacion`) VALUES ('','$fecha','$id_user', '$id_hab')";

       if ($registro = $con -> query($sql)) {
        $last_id = mysqli_insert_id($con);

        while ( $i < count($id_p)) {

           if($estado_p[$i] > 0){

           $mysql="INSERT INTO `stock`(`s_id`, `fk_estado`, `fk_producto`, `fk_registro`) VALUES ('','$estado_p[$i]','$id_p[$i]','$last_id')";

           if ($re = $con -> query($mysql)) {
               echo 'Registro de producto '.$nombre_p[$i].' Exitoso<br>';
             }             
           else {
               echo 'No hay consumo de productos<br>';
             }
            }
            else{
                  echo 'No hay consumo que registar Habitacion<br>';
            }//FIN VALIDACION PRODUCTOS
            
            $i++; 
           }// CIERRE DEL WHILE RECORRE PRODUCTOS POR HABITACION
           
           if ($evaluacion_f > 1) {
            $mysql = "INSERT INTO  `frigobar`(`f_id`, `fk_evaluacion`, `fk_registro`)  VALUES ('', '$evaluacion_f', '$last_id')"; 

                       if ($nuevo =  $con -> query($mysql)) {
                       echo 'Registo exitoso Frigobar'.$id_hab.' Habitacion estado'.$evaluacion_f.'<br>';
                       }
                       else{
                        echo 'ERROR';
                       }
          }
          else{
            echo 'No hay cambios que registrar en Frigobar de la Habitacion<br>';
          }
        

            
          } //FIN REGISTRO
          
mysqli_close($con); 
?>