<?php
include('php/conexion.php');
include('php/inicio.php');
// Datos previos al registro 
$id_hab = $_GET['habitacion_id']; 
$idPs=$_GET['piso_id'];
$numHab=$_GET['habitacion_num'];  
$id_user = $_SESSION['u_id']; 
$fecha = date ("Y-m-d"); 
//Variables extraidas de formulario
$idStock=$_POST['idStockEdit'];
$idPr=$_POST['idEdit'];
$estadoPr = $_POST['estadoEdit'];
$idRegistro=$_GET['id_registro']; 
//Inicializando variables para recorrido de array
$contador=0; 
$i = 0;  

while ( $i < count($idPr)) {
  if($estadoPr[$i] > 0) {
    //MODIFICAR ESTADO INVENTARIO POR HABITACION           
    if($estadoPr[$i] == 3){
        $actualizar="UPDATE `inventario` SET `in_fecha_registro`='$fecha', `fk_total`= '2' WHERE in_fk_habitacion='$id_hab' AND in_fk_producto='$idPr[$i]'"; 
       if ($consulta=$con->query($actualizar)){
         $resp='Inventario Modificado';
       }
       else{
          $resp='Error';
       }
     } 
     else{
      $actualizar="UPDATE `inventario` SET `in_fecha_registro`='$fecha', `fk_total`= '1' WHERE in_fk_habitacion='$id_hab' AND in_fk_producto='$idPr[$i]'"; 
       if ($consulta=$con->query($actualizar)){
         $resp='Inventario Modificado';
       }
       else{
          $resp='Error';
       }
      }
     
     //INICIO DE INSERCION DE DATOS A BD
       $actualizar= "UPDATE `stock` SET `fk_estado`='$estadoPr[$i]' WHERE s_id='$idStock[$i]'"; 
    
           if ($insertar = $con -> query($actualizar)) {
                  $contador++;               
             }  
           else {
                 //echo '<script>alert("Error");</script>';
                 //';
           }
     } //CIERRE CONSULTAR ESTADOS DE PRODUCTOS
           
  $i++; 
}//CIERRE WHILE 


      echo '<script>alert("Cambios Guardados Exitosamente, Total Productos Modificados '.$contador.'/ Inventario '.$resp.'");</script>';
      echo '<script>window.location="modificar_registro.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'&id_registro='.$idRegistro.'";</script>'; 

?>