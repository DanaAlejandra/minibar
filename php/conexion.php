<?php
	// Parametros a configurar para la conexion de la base de datos
	$host = "localhost";    // sera el valor de nuestra BD
	$basededatos = "minibar";    // sera el valor de nuestra BD
	$usuariodb = "root";    // sera el valor de nuestra BD
	$clavedb = "";    // sera el valor de nuestra BD

	//error_reporting(0); //No me muestra errores

	$con = new mysqli($host,$usuariodb,$clavedb, $basededatos);

	if ($con-> connect_errno) {
	    echo "Nuestro sitio experimenta fallos....";
	    exit();
	}

?>
