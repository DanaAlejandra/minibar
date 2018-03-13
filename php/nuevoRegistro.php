<?php

include('php/conexion.php');
include('php/inicio.php');
// Datos previos al registro 


$id_user = $_SESSION['u_id']; 
//$fecha = date ("Y-m-d"); 
$fecha = date ("Y-m-d"); 
$id_hab = $_SESSION['id_habitacion'];

$idPr= $_POST['id']; 
$estadoPr = $_POST['estado'];

$contador=0; 
$i = 0;   
    $sql = "INSERT INTO `registro`(`r_id`, `r_fecha`, `fk_usuario`, `fk_habitacion`) VALUES ('','$fecha','$id_user', '$id_hab')";

       if ($registro = $con -> query($sql)) {
        $last_id = mysqli_insert_id($con);

        while ( $i < count($idPr)) {
           if($estadoPr[$i] > 0) {

           $mysql="INSERT INTO `stock`(`s_id`, `fk_estado`, `fk_producto`, `fk_registro`) VALUES ('','$estadoPr[$i]','$idPr[$i]','$last_id')";

           if ($insertar = $con -> query($mysql)) {
                  $contador++;               
             }  
           else {
                 echo '<script>alert("Error");</script>';
                 echo '<script>window.location="menuprincipal_user.php";</script>';
           } //FIN IF REGISTRO

           } //FIN DE VALIDACION DE CONSUMO  
          $i++; 
          } //FIN WHILE
       } // FIN IF REGISTRO PARA OBTENER LAST_ID

       echo '<script>alert("Registro Exitoso, Total Productos' .$contador.'");</script>';
       echo '<script>window.location="menuprincipal_user.php";</script>';

mysqli_close($con); 
?>


