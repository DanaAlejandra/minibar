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

  $eliminar="DELETE FROM `stock` WHERE `fk_registro` = '$id_registro'";
  if( $stock = $con->query($eliminar))
  { 

  $remover="DELETE FROM `frigobar` WHERE `f_fk_registro` = '$id_registro'";
  $frigobar = $con->query($remover);  

  $delete="DELETE FROM `registro` WHERE `r_id` = '$id_registro'";
     if ($registro=$con->query($delete)) {
        echo '<script>alert("Registro eliminado");</script>';
        echo '<script>window.location="registro_habitacion.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>';
     }
     else
     {
      echo '<script>alert("Error");</script>';
        echo '<script>window.location="modificar_registro.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>';
     }
  }
}
  
 mysqli_close($con); 

?>
