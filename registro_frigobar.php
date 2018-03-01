<?php
session_start();
include('php/conexion.php'); 

$id_hab = $_SESSION['id_habitacion'];  // deberia venir como un dato get de formulario 
$id_user = $_SESSION['u_id']; 
$evaluacion = $_POST['evaluacion'];  
$fecha = date ("Y-m-d"); 

if ($evaluacion > 1) {

     $sql = "INSERT INTO `registro`(`r_id`, `r_fecha`, `fk_usuario`, `fk_habitacion`) VALUES ('','$fecha','$id_user', '$id_hab')"; 
 
       if ($in = $con -> query($sql)) {
       $last_id = mysqli_insert_id($con);

       $mysql = "INSERT INTO  `frigobar`(`f_id`, `fk_evaluacion`, `fk_registro`)  VALUES ('', '$evaluacion', '$last_id')"; 

       if ($nuevo =  $con -> query($mysql)) {
        echo 'Registo exitoso';

       //verificación de variables
    echo 'Los datos ingresados son : '; 
    echo 'Id Habitacion '.$id_hab.'<br>'; 
    echo 'Usuario '.$id_user.'<br>';
    echo 'Estado Frigobar '.$evaluacion.'<br>';
    echo 'Fecha '.$fecha.'<br>';
       }


       
               
} 
       
    
}
//echo 'Habitacion '.$hab.'<br>'; 
//echo 'Id Habitacion '.$id_hab.'<br>'; 
//echo 'Usuario '.$id_user.'<br>';
//echo 'Estado Frigobar '.$estado.'<br>';
//echo 'Id Piso '.$id_p.'<br>';
//echo 'Fecha '.$fecha.'<br>';

mysqli_close($con); 
?>