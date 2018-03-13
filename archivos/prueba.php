<?php 

require_once 'php/inicio.php';
include 'php/conexion.php';

$startDate = $_POST['startDate'];
$date = date("Y-m-d", strtotime($startDate)); 
$dia = date("Y-m-d"); 

if($startDate == $dia)
{
	echo 'Reporte día '.$dia .'<br>'; 
}
else{
	echo 'Reporte día '.$date.'<br>'; 
}
 ?>