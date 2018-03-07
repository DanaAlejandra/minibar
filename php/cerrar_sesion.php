<?php
session_start();
session_destroy();
// echo 'cerraste Sesion';

// echo "<script>if(confirm('¿Desea Usted realmente salir?')){
// document.location='login.php';}
// else{ alert('Operacion Cancelada');
// }</script>";

echo '<script>window.location="index.php";</script>';

// echo '<script>window.location="login.php";</script>';
 ?>