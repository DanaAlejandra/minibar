<link rel="stylesheet" type="text/css" href="css/style_menu.css">
<?php
include('php/header.php'); 
$idp = $_GET['piso_id']; 
$sql = "SELECT ps_id, ps_numero FROM piso WHERE ps_id=$idp"; 
//CONSULTA NUMERO DE PISOS
  if ($consulta = $con -> query($sql)) {
    $selection = mysqli_fetch_array($consulta); 
    echo ' <ol class="breadcrumb">
      <li><a href="menuprincipal.php">Inicio</a></li>     
      <li class="active">Piso '.$selection['ps_numero'].'</li> 
      <li class="active">Habitaciones</li>
      </ol>'; 
  }

 
?>

<div class="container  container-fluider">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"> Habitaciones </div>
      <div class="panel-body">

      <form name="form-habitacion" id="form-habitacion" method="GET" action="">
      <span>Seleccione numero de habitación</span>
      <br>
      <br>
      <div class="box">         
      <?php
         include('php/conexion.php');         
          $query = "SELECT h_id, h_numero, fk_piso FROM  habitaciones WHERE fk_piso ='$idp'";
          $consulta =mysqli_query($con, $query); 
    
          while ($valores = mysqli_fetch_array($consulta)) {
           
            echo '<a class="btn btn-lg" href="registro_antiguo.php?habitacion_id='.$valores['h_id'].'&piso_id='.$valores['fk_piso'].'&habitacion_num='.$valores['h_numero'].'">'.$valores['h_numero'].'</a>';   
          } 
      ?> 
      </div>

    
      </form>
      </div>
    </div>
  </div> 




































