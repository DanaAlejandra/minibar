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

<link rel="stylesheet" type="text/css" href="css/style_menu.css">
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
          $fecha = date ("Y-m-d");
          $query = "SELECT h_id, h_numero, fk_piso FROM  habitaciones WHERE fk_piso ='$idp'";
          $consulta =mysqli_query($con, $query); 
     
          while ($valores = mysqli_fetch_array($consulta)){
        echo '<a class="btn" href="registro_habitacion.php?habitacion_id='.$valores['h_id'].'&piso_id='.$valores['fk_piso'].'&habitacion_num='.$valores['h_numero'].'">'.$valores['h_numero'].'</a>';                 
           }                 
      ?> 
      </div>

      <span> Habitaciones Revisadas :</span>
      <br>
      <br>
      <div class="box">         
      <?php
         include('php/conexion.php'); 
          $fecha = date ("Y-m-d");
          $visitado = "SELECT r_id, h_numero, h_id, fk_piso FROM `registro` JOIN `habitaciones` ON fk_habitacion=h_id JOIN `piso` ON fk_piso=ps_id WHERE r_fecha='$fecha' AND ps_id='$idp'";
          $control = $con->query($visitado); 
     
      while ($registro = mysqli_fetch_array($control)){

        echo '<a class="btn" href="modificar_registro.php?habitacion_id='.$registro['h_id'].'&piso_id='.$registro['fk_piso'].'&habitacion_num='.$registro['h_numero'].'&id_registro='.$registro['r_id'].'">'.$registro['h_numero'].'</a>';             
           }                 
      ?> 
      </div>


    
      </form>
      </div>
    </div>
  </div> 




































