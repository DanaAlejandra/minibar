<?php
include('php/conexion.php'); 
session_start();
$user=$_POST['user'];
$pass=$_POST['pass'];

$sql= "SELECT u_id, u_nombre FROM `usuario` WHERE u_username= '$user' and u_password='$pass'"; 
$consulta =mysqli_query($con, $sql); 

$fila = $consulta->num_rows;

if( $fila > 0)
{ 
	$re = mysqli_fetch_array($consulta); 
    $_SESSION['u_id'] = $re['u_id']; 
	$_SESSION['u_nombre'] = $re['u_nombre']; 
	header("location:menu_principal.php");
	exit(); 
}

else

{
   echo '<script>alert("Usuario o Contraseña Incorrecta.");</script>';
   echo '<script>window.location="login.php";</script>';
} 

mysqli_close($con);

?>