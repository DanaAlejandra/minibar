<?php
include 'php/conexion.php'; 
include 'php/inicio.php'; 

$id_user = $_SESSION['u_id']; 
$fecha = date ("Y-m-d"); 
$id_hab = $_SESSION['id_habitacion']; 
$evaluacion = $_POST['evaluacion']; 
if ($evaluacion > 1) {

     $sql = "INSERT INTO `registro`(`r_id`, `r_fecha`, `fk_usuario`, `fk_habitacion`) VALUES ('','$fecha','$id_user', '$id_hab')"; 
 
       if ($in = $con -> query($sql)) {
       $last_id = mysqli_insert_id($con);

       $mysql = "INSERT INTO  `frigobar`(`f_id`, `fk_evaluacion`, `fk_registro`)  VALUES ('', '$evaluacion_frigobar', '$last_id')"; 

       if ($nuevo =  $con -> query($mysql)) {
        echo 'Registo exitoso';
       }


       
               
} 
       
    
}


mysqli_close($con); 
?>