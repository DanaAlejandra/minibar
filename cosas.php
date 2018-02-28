

$id_user= "SELECT u_id FROM usuario WHERE u_username = '$user'"; 
$id_usuario = $con -> query($id_user); 

$id_hab= "SELECT h_id FROM habitacion WHERE h_numero = '$hab'"; 
$id_habitacion = $con -> query($id_user);


if ($estado != 1) {
	$insertar = mysql_query("INSERT INTO `registro`(`r_fecha`, `r_fk_habitacion`, `r_fk_usuario`) 
	VALUES('$fecha','$id_habitacion','$id_usuario')", $con); 

	$insertar =  mysql_query("INSERT INTO  `frigobar`(`f_id`, `fk_registro`)  VALUES ('$estado','$insertar->insert_id')", $con);
	             
}

header("Location:menu_principal.php"); 