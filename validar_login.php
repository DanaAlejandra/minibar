<?php
include('php/conexion.php'); 
session_start();
$user=$_POST['user'];
$pass=$_POST['pass'];



$sql_user= "SELECT u_id, u_nombre, t_tipo FROM `usuario` JOIN `tipo` ON fk_tipo= t_id WHERE u_username= '$user' and u_password='$pass' and t_tipo='Usuario'"; 
$consulta_user =mysqli_query($con, $sql_user); 

$fila_user = $consulta_user->num_rows;

if( $fila_user > 0)
{ 
	$re = mysqli_fetch_array($consulta_user); 
    $_SESSION['u_id'] = $re['u_id']; 
	$_SESSION['u_nombre'] = $re['u_nombre']; 
	$_SESSION['t_tipo'] = $re['t_tipo']; 
	header("location:menuprincipal.php");
	exit(); 
}
else

{ 
   echo '<script>alert("Usuario o Contraseña Incorrecta.");</script>';
   header("location: index.php");
} 
 
mysqli_close($con);

?>