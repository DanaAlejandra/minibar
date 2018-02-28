<?php
     session_start();

     if(isset($_SESSION['username'])){
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
  <script type="text/javascript" src="mainjava.js"></script>
  <title>Hoteles de los Andes: Modulo MiniBar -> Módulo Principal</title>

<!-- Estilo -->
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
  <img src="img/logohotel.jpg" class="img" width="120px" height="120px" >
</div>
</header>

<?php
include('php/conexion.php'); 
$fecha = date ("j/n/Y");
$idp = $_GET[piso]; 

//CONSULTA NUMERO DE PISOS
$sql = "SELECT ps_numero FROM piso WHERE ps_id = '$idp'";

echo '<span class="form-control"> Bienvenido '.$_SESSION['username'].' Fecha '.$fecha.'<a href="cerrar_sesion.php" class="">Salir</a></span>';
echo '<br>'; 

  if ($consulta = $con -> query($sql)) {
    $selection = mysqli_fetch_array($consulta); 
    echo ' <ol class="breadcrumb">
      <li><a href="menu_principal.php">Inicio</a></li>     
      <li class="active">Piso '.$selection['ps_numero'].'</li> 
      <li class="active">Habitaciones</li>
      </ol>'; 
  }

 
?>

<div class="container">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"> Habitaciones </div>
      <div class="panel-body">

      <form name="form-habitacion" id="form-habitacion" method="GET" action="registro.php">
      <span>Seleccione numero de habitación</span>
      <br>
      <br>

      
      <?php
         include('php/conexion.php');         
          $query = "SELECT h_numero, fk_piso FROM  habitaciones WHERE fk_piso ='$idp'";
          $consulta =mysqli_query($con, $query); 
    
          while ($valores = mysqli_fetch_array($consulta)) {
           
            echo ' <a class="btn btn-primary" href="registro.php?habitacion='.$valores['h_numero'].'&piso='.$valores['fk_piso'].'">'.$valores['h_numero'].'</a>';   
          } 
      ?> 
      </form>
      </div>
    </div>
  </div> 


</body>
</html>



































