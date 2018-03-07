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
<script type="text/javascript" src="js/script.js"></script>
<div class="container container-fluider">
<!--PANEL PRODUCTOS-->
<br>
<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"> Consumo Habitación  </div>
      <div class="panel-body">

<div class="div-action pull pull-right" style="padding-bottom:20px;">
          <button class="btn btn-default" data-toggle="modal" data-target="#addRegistroModal"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar Productos </button>
</div>
       

    <form name="FormNewProduct" id="FormNewProduct" class="form-horizontal" method="" action="">
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
        $numero = $_GET['habitacion_num'];
        $sql = "SELECT r_id ,pd_nombre ,e_sigla, pd_id, h_numero, e_id FROM `habitaciones` JOIN `registro` ON fk_habitacion = h_id JOIN `stock` ON fk_registro=r_id JOIN `productos` ON fk_producto= pd_id JOIN `estado` ON fk_estado=e_id WHERE r_fecha='2018-02-06'AND h_numero='$numero'"; 
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

       
    
<!--
    //MOSTRAR FRIGOBAR 
   if ($registro_f = $con ->  query($sql_ev)) {
        echo '<label>Estado Frigobar</label><select  class="custom-select form-control"  name ="evaluacion"><option selected value="0">Seleccione.... </option>'; 
         while ( $evaluacion = mysqli_fetch_array($registro_f)) {
           echo '<label>Estado</label>
                 <option  value="'.$evaluacion['ev_id'].'">'.$evaluacion['ev_descripcion'].'</option>';
         } //FIN DEL WHILE EVALUACION FRIGOBAR
         echo '</select><br>';
        } //FIN DEL IF     
        ?>  -->
        <div class="div-action pull pull-right" style="padding-bottom:20px;">
          <button class="btn btn-default " id="editRegistroBtn"> <i class="glyphicon glyphicon-wrench"></i> Modificar </button>
      </div> <br>
         </form>
        </div><!--FIN PANEL DE PRODUCTOS-->
        
      </div>
      
  </div>  <!--FIN CONTENEDOR PRODUCTOS-->
</div>  <!--FIN CONTENEDOR PRINCIPAL-->

<!--MODAL NUEVO REGISTRO CONSUMO HABITACION-->
<div class="modal fade" id="addRegistroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="modal-title" id="exampleModalLabel">Ingreso Consumo Habitación</span>
      </div>
  <div class="modal-body">

  <div id="respuesta"></div>
  
<form class="" id="FormularioNuevoRegistro">
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
          <button class="btn btn-default" id="newRegistroBtn" onclick="newRegistro();"> <i class="glyphicon glyphicon-ok"></i> Guardar </button>
      </div> 
</div>
</div> </div> </div> <!--FIN MODA NUEVO REGISTRO-->





