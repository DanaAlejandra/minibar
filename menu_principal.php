<?php
     session_start();

     if(isset($_SESSION['username']) && isset($_SESSION['user_id']) ){
     }
     else{
       header("Location:login.php");
     }
  ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Hoteles de los Andes: Modulo MiniBar -> Módulo Principal</title>

<style type="text/css">
  .img{
  margin: 0.8em; 
  height: 120px;
  width: 120px; 
}
</style>



</head>
<body>

<header>
  <div>
  <img src="img/logohotel.jpg" class="img" >
</div>

<?php

include('php/conexion.php');

$fecha = date ("j/n/Y");

echo '<span class="form-control"> Bienvenido '.$_SESSION['username'].' Fecha '.$fecha.'   <a href="cerrar_sesion.php" class="">Salir</a></span>';

echo '<br>';

?>

</header>


<!--onclick="mostrarhabitaciones(1)-->

<div class="container">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">Pisos </div>
      <div class="panel-body">

      <form name="form-piso" id="form-piso" method="GET" action="mostrar_piso.php">
      <span>Seleccione numero de piso</span>
      <br>
      <br>
      <div class="form-row container">

      <div class="form-group">
        <a class="btn btn-primary" href="mostrar_piso.php?piso=1">Piso 6</a>
        <a class="btn btn-primary" href="mostrar_piso.php?piso=2">Piso 7</a>
        <a class="btn btn-primary" href="mostrar_piso.php?piso=3">Piso 8</a>
        <a class="btn btn-primary" href="mostrar_piso.php?piso=4">Piso 9</a>
        <a class="btn btn-primary" href="mostrar_piso.php?piso=5">Piso 10</a>
      </div>

       <div class="form-group ">
         <a class="btn btn-primary" href="mostrar_piso.php?piso=6">Piso 11</a>
         <a class="btn btn-primary" href="mostrar_piso.php?piso=7">Piso 12</a>
         <a class="btn btn-primary" href="mostrar_piso.php?piso=8">Piso 14</a>
         <a class="btn btn-primary" href="mostrar_piso.php?piso=9">Piso 15</a>
         <a class="btn btn-primary" href="mostrar_piso.php?piso=10">Piso 16</a>
       </div>
       <br>
      </div>
    
      </form>

      </div>
    </div>
  </div> 

</body>
</html>