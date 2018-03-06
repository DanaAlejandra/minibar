<?php
include('php/conexion.php'); 
session_start();
$user=$_POST['user'];
$pass=$_POST['pass'];

$sql_admin= "SELECT u_id, u_nombre, t_tipo FROM `usuario` JOIN `tipo` ON fk_tipo= t_id WHERE u_username= '$user' and u_password='$pass' and t_tipo='Administrador'"; 
$consulta_admin =mysqli_query($con, $sql_admin); 

$sql_user= "SELECT u_id, u_nombre, t_tipo FROM `usuario` JOIN `tipo` ON fk_tipo= t_id WHERE u_username= '$user' and u_password='$pass' and t_tipo='Usuario'"; 
$consulta_user =mysqli_query($con, $sql_user); 

$fila_admin = $consulta_admin->num_rows;
$fila_user = $consulta_user->num_rows;

if( $fila_user > 0)
{ 
	$re = mysqli_fetch_array($consulta_user); 
    $_SESSION['u_id'] = $re['u_id']; 
	$_SESSION['u_nombre'] = $re['u_nombre']; 
	$_SESSION['t_tipo'] = $re['t_tipo']; 
	header("location:menuprincipal_user.php");
	exit(); 
}
elseif ($fila_admin > 0 ) {
	$re = mysqli_fetch_array($consulta_admin); 
    $_SESSION['u_id'] = $re['u_id']; 
	$_SESSION['u_nombre'] = $re['u_nombre']; 
	$_SESSION['t_tipo'] = $re['t_tipo']; 
	header("location:menuprincipal_admin.php");
	exit(); 
}
else

{
   echo '<script>alert("Usuario o Contraseña Incorrecta.");</script>';
   echo '<script>window.location="index.php";</script>';
} 

mysqli_close($con);

?>