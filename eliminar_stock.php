<?php
include 'php/conexion.php';
$id=$_GET['stock_id'];
$id_hab = $_GET['habitacion_id']; 
$idPs=$_GET['piso_id'];
$numHab=$_GET['habitacion_num']; 
$sql="DELETE FROM `stock` WHERE s_id='$id'"; 

if($delete=$con->query($sql))
{
       echo '<script>window.location="registro_antiguo.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>';
}
else{
       //echo '<script>alert("Error al eliminar registro");</script>';
       //echo '<script>window.location="registro_antiguo.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>';
		header("location:registro_antiguo.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'");
}
mysql_close($con); 

?>