<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

<?php
include('php/header.php'); 

// DATOS PARA EL MENU DINAMINO
$idp = $_GET['piso']; 
$h_numero = $_GET['habitacion_num']; 
$_SESSION['id_habitacion'] = $_GET['habitacion_id']; 
 
$sql = "SELECT ps_id, ps_numero FROM piso WHERE ps_id=$idp"; 
//CONSULTA NUMERO DE PISOS
  if ($consulta = $con -> query($sql)) {
    $selection = mysqli_fetch_array($consulta); 
    echo '<ol class="breadcrumb">
      <li><a href="menuprincipal_user.php">Inicio</a></li>     
      <li><a href="mostrar_piso.php?piso_id='.$idp.'" >Piso '.$selection['ps_numero'].'</a></li> 
      <li class="active">Habitacion '.$h_numero.'</li>
      </ol>'; 
  }
?>

<div class="container container-fluider">
<!--MODAL NUEVO REGISTRO-->
<div class="modal fade" id="addRegistroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="modal-title" id="exampleModalLabel">Ingreso Consumo Habitación</span>
      </div>
  <div class="modal-body">

  <div id="respuesta"></div>
  
<form class="" id="FormularioNuevoRegistro" method="post" action="registro_stock.php">
  <table class="table" id="productTable">
          <thead>
            <tr>                
              <th style="width:10%;">Id</th>             
              <th style="width:40%;">Producto</th>
              <th style="width:20%;">Estado</th>                        
            </tr>
          </thead>
          <tbody>
        <?php 
        include 'php/conexion.php'; 
        $sql = "SELECT pd_id, pd_nombre FROM `productos`"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr>
            <td><input class="form-control form-control-md" type="text" name="IdNew[]" id="IdNew[]" value="'.$product['pd_id'].'"></td>
            <td><input class="form-control form-control-md" type="text" name="NombreNew[]" id="NombreNew[]" value="'.$product['pd_nombre'].'" disabled></td>
            <td><select  class="custom-select form-control"  name ="EstadoNew[]">
                 <option selected value="0">Selecione.... </option>
                 <option  value="1">CR</option>
                 <option  value="2">R</option>
                 <option  value="3">SS</option>
          </select></td></tr>';
        }
        echo'</tbody></table>'; 
        ?>   
</form>  
</div> <!--FINAL MODAL BODY-->
<div class="modal-footer">    
      <div class="div-action pull pull-right" style="padding-bottom:20px;">
          <button class="btn btn-default"  id="registroBtn" href="registro_stock.php?piso=$idp&habitacion=$h_numero"><i class="glyphicon glyphicon-ok"></i> Guardar </button>
      </div> 
</div>
</div> </div> </div> <!--FIN MODAL NUEVO REGISTRO-->



 <!--PANEL DE HABITACIONES-->
<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"> Consumo Habitación  </div>
      <div class="panel-body">
       
    <form name="FormNewRegistro" id="FormNewRegistro" class="form-horizontal" method="" action="">
     <table class="table" id="productTable">
          <thead>
            <tr>              
              <th style="width:40%;">Producto</th>
              
              <th style="width:20%;">Estado</th>                        
            </tr>
          </thead>
          <tbody>
        <?php 
        include 'php/conexion.php'; 
        $fecha = date ("Y-m-d");
        $numero = $_GET['habitacion_num'];
        $sql = "SELECT r_id ,pd_nombre ,e_sigla, pd_id, h_numero, e_id FROM `habitaciones` JOIN `registro` ON fk_habitacion = h_id JOIN `stock` ON fk_registro=r_id JOIN `productos` ON fk_producto= pd_id JOIN `estado` ON fk_estado=e_id WHERE r_fecha='$fecha' AND h_numero='$numero'"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr><td><input class="form-control form-control-md" type="text" name="nombre[]" id="nombre[]" value="'.$product['pd_nombre'].'" disabled></td>
            <td><select  class="custom-select form-control"  name ="estado[]">
                 <option selected value="'.$product['e_id'].'">'.$product['e_sigla'].'</option>
                 <option  value="1">CR</option>
                 <option  value="2">R</option>
                 <option  value="3">SS</option>
          </select></td></tr>';
        }

        echo'</tbody></table><br>'; 
        ?>

        <div class="div-action pull pull-right" style="padding-bottom:20px;">
          <button class="btn btn-default " id="editRegistroBtn"> <i class="glyphicon glyphicon-wrench"></i> Modificar </button>
        </div> 
         </form>
        </div><!--FIN PANEL DE PRODUCTOS-->      
      </div>
</div>  <!--FIN CONTENEDOR PRODUCTOS-->



  <!--PANEL DE REGISTRO FRIGOBAR-->
<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"> Estado Frigobar  </div>
      <div class="panel-body">  
      <div id="mensaje"></div>    

    <form name="FormNewRegistroFrigobar" id="FormNewRegistroFrigobar" class="form-horizontal" method="" action="">
        <?php 
        include 'php/conexion.php'; 
        $fecha = date ("Y-m-d");
        $numero = $_GET['habitacion_num'];
        $sql = "SELECT ev_id, ev_descripcion FROM evaluacion"; 
        $result = $con -> query($sql); 
         echo '<select  class="custom-select form-control"  name ="evaluacionFrigobar">';
        while($product = mysqli_fetch_array($result)){
        echo '<option  value="'.$product['ev_id'].'">'.$product['ev_descripcion'].'</option>';
        }
        echo'</select><br>'; 
        ?>

        <div class="div-action pull pull-right" style="padding-bottom:20px;">
          <button class="btn btn-default " id="newFrigobarBtn"> <i class="glyphicon glyphicon-ok"></i> Guardar </button>
        </div> 
         </form>
        </div><!--FIN PANEL DE PRODUCTOS-->      
      </div>
</div>  <!--FIN CONTENEDOR PRODUCTOS-->


</div>
</body>
</html>