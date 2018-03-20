<?php
include 'php/conexion.php';
$id_hab = $_GET['habitacion_id']; 
$idPs=$_GET['piso_id'];
$numHab=$_GET['habitacion_num']; 
$fecha = date ("Y-m-d");
$sql="SELECT r_id FROM `registro` WHERE r_fecha='$fecha' AND fk_habitacion='$id_hab'"; 

if($result=$con->query($sql))
{
	$registro = mysqli_fetch_array($result); 
  $id_registro=$registro['r_id'];
  
   $eliminar = "DELETE `stock`, `frigobar`, `registro` FROM `registro` JOIN `stock` ON `stock`.`fk_registro` = `registro`.
   `r_id` JOIN `frigobar` ON `frigobar`.`f_fk_registro`=`registro`.`r_id` WHERE `registro`.`r_id`='$id_registro' AND `stock`.`fk_registro`='$id_registro' AND `frigobar`.`f_fk_registro`='$id_registro'"; 

       if($delete= $con->query($eliminar))
       {
       	echo '<script>alert("Registro eliminado");</script>';
       	echo '<script>window.location="registro_antiguo.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>';
       }
       else{
       	echo '<script>alert("Error");</script>';
       	echo '<script>window.location="registro_antiguo.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>';
       }     
}
else
{
     	echo '<script>window.location="registro_antiguo.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>';
}

mysqli_close($con); 
?>
