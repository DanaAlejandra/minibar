<?php
	// Parametros a configurar para la conexion de la base de datos
	$host = "localhost";    // sera el valor de nuestra BD
	$basededatos = "minibar_semifinal";    // sera el valor de nuestra BD
	$usuariodb = "root";    // sera el valor de nuestra BD
	$clavedb = "";    // sera el valor de nuestra BD

	//error_reporting(0); //No me muestra errores

	$con = new mysqli($host,$usuariodb,$clavedb, $basededatos);
	mysqli_set_charset($con,"utf8");
	if ($con-> connect_errno) {
	    echo "Nuestro sitio experimenta fallos....";
	    exit();
	}

?>
