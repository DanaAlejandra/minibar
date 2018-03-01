<?php
include('header.php'); 
$idp = $_GET['piso_id']; 
$sql = "SELECT ps_id, ps_numero FROM piso WHERE ps_id=$idp"; 
//CONSULTA NUMERO DE PISOS
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
          $query = "SELECT h_id, h_numero, fk_piso FROM  habitaciones WHERE fk_piso ='$idp'";
          $consulta =mysqli_query($con, $query); 
    
          while ($valores = mysqli_fetch_array($consulta)) {
           
            echo ' <a class="btn btn-primary" href="registro.php?habitacion_id='.$valores['h_id'].'&piso='.$valores['fk_piso'].'&habitacion_num='.$valores['h_numero'].'">'.$valores['h_numero'].'</a>';   
          } 
      ?> 
      </form>
      </div>
    </div>
  </div> 


</body>
</html>



































