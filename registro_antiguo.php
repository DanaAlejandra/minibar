<!DOCTYPE html>
<html>
<head>
  <title></title>

<style>
.contenedor_tabla{
  padding: 20px; 
  display: inline-table;
  width: 50%; 
  }

.contenedor_tabla_otros{
  padding: 20px; 
  display: inline-table;
  width: 50%; 
}

</style>

</head>
<body>

<?php
include('php/header.php'); 

// DATOS PARA EL MENU DINAMINO
$idp = $_GET['piso_id']; 
$h_numero = $_GET['habitacion_num']; 
$id_Hab = $_GET['habitacion_id']; 
 
$sql = "SELECT ps_id, ps_numero FROM piso WHERE ps_id=$idp"; 
//CONSULTA NUMERO DE PISOS
  if ($consulta = $con -> query($sql)) {
    $selection = mysqli_fetch_array($consulta); 
    echo '<ol class="breadcrumb">
      <li><a href="menuprincipal.php">Inicio</a></li>     
      <li><a href="mostrar_piso.php?piso_id='.$idp.'" >Piso '.$selection['ps_numero'].'</a></li> 
      <li class="active">Habitacion '.$h_numero.'</li>
      </ol>'; 
  }
?>

<div class="container container-fluider">
 <!--PANEL DE HABITACIONES-->
<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"> Consumo Habitación  </div>
      <div class="panel-body">

    <form name="FormNewRegistro" id="FormNewRegistro" class="form-horizontal" method="post" action="nuevo_registro.php?piso_id=<?php $idPiso=$_GET['piso_id']; echo $idPiso;?>&habitacion_num=<?php $numHab=$_GET['habitacion_num']; echo $numHab;?>&habitacion_id=<?php $idHab=$_GET['habitacion_id']; echo $idHab;?>">
     
    <label>Estado Frigobar</label>
     <?php  
        include 'php/conexion.php'; 
       $sql = "SELECT ev_id, ev_descripcion FROM evaluacion"; 
        $result = $con -> query($sql); 
         echo '<select  class="custom-select form-control"  name ="evaluacionNew" id="evaluacionNew">';
        while($product = mysqli_fetch_array($result)){
        echo '<option  value="'.$product['ev_id'].'">'.$product['ev_descripcion'].'</option>';
        }
        echo'</select><br>'; 
     ?>

<div class="contenedor_tabla">
  <table class="table" id="productTable">
          <thead>
            <tr> 
              <th hidden="true">Id</th> 
              <th >Producto</th>
              <th >Estado</th>                        
            </tr>
          </thead>
          <tbody>
        <?php 
        include 'php/conexion.php'; 
        $sql = "SELECT pd_id, pd_nombre FROM `productos` WHERE pd_categoria='Bebidas'"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr>
            <td hidden="true"><input class="form-control form-control-md"  type="text" name="idNew[]" id="idNew[]" value="'.$product['pd_id'].'" ></td>
            <td><input class="form-control form-control-md" type="text" name="nombreNew[]" id="nombreNew[]" value="'.$product['pd_nombre'].'" disabled></td>
            <td><select  class="custom-select form-control"  name ="estadoNew[]">
                 <option selected value="0">Selecione.... </option>
                 <option  value="1">CR</option>
                 <option  value="2">R</option>
                 <option  value="3">SS</option>
          </select></td></tr>';
        }
        echo'</tbody></table>'; 
        ?>   
</div>

<div class="contenedor_tabla_otros pull pull-right">
  <table class="table" id="productTable">
          <thead>
            <tr> 
              <th hidden="true" >Id</th> 
              <th > Producto </th>
              <th > Estado </th>                       
            </tr>
          </thead>
          <tbody>
        <?php 
        include 'php/conexion.php'; 
        $sql = "SELECT pd_id, pd_nombre FROM `productos` WHERE pd_categoria='Tragos' OR pd_categoria='Dulces'"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr>
            <td hidden="true"><input class="form-control form-control-md"  type="text" name="idNew[]" id="idNew[]" value="'.$product['pd_id'].'" ></td>
            <td><input class="form-control form-control-md" type="text" name="nombreNew[]" id="nombreNew[]" value="'.$product['pd_nombre'].'" disabled></td>
            <td><select  class="custom-select form-control"  name ="estadoNew[]">
                 <option selected value="0">Selecione.... </option>
                 <option  value="1">CR</option>
                 <option  value="2">R</option>
                 <option  value="3">SS</option>
          </select></td></tr>';
        }
        echo'</tbody></table>'; 
        ?>   
</div>

        <div class="div-action pull pull-right" style="padding-bottom:20px;">
          <button class="btn btn-default " id="editRegistroBtn"> <i class="glyphicon glyphicon-ok"></i> Agregar </button>
        </div> 
         </form>
        </div><!--FIN PANEL DE PRODUCTOS-->      
      </div>
</div>  <!--FIN CONTENEDOR PRODUCTOS-->



 <!--PANEL DE HABITACIONES-->
<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"> Consumo Habitación  </div>
      <div class="panel-body">
      
    <form name="FormEditRegistro" id="FormViewRegistro" class="form-horizontal" method="GET" action="">

     <table class="table" id="productTable">
          <thead>
            <tr>              
              <th>Producto</th>
              <th>Estado</th>
              <th>Opcion</th>                       
            </tr>
          </thead>
          <tbody>


        <?php 
        include 'php/conexion.php'; 
        $fecha = date ("Y-m-d");
        $numero = $_GET['habitacion_num'];
        $sql = "SELECT r_id ,pd_nombre ,e_sigla, e_descripcion,  pd_id, h_numero, e_id, s_id FROM `habitaciones` JOIN `registro` ON fk_habitacion = h_id JOIN `stock` ON fk_registro=r_id JOIN `productos` ON fk_producto= pd_id JOIN `estado` ON fk_estado=e_id WHERE r_fecha='$fecha' AND h_numero='$numero'"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr><td><input class="form-control form-control-md" type="text" name="nombre[]" id="nombre[]" value="'.$product['pd_nombre'].'" disabled></td>
          <td><input class="form-control form-control-md" type="text" name="estado[]" id="estado[]" value="'.$product['e_descripcion'].'" disabled></td>
          <td><a class="btn btn-primary" href="eliminar_stock.php?piso_id='.$idp.'&habitacion_num='.$h_numero.'&habitacion_id='.$id_Hab.'&stock_id='.$product['s_id'].'"><i class="glyphicon glyphicon-remove"></i></a></td>
          </tr> ';
        }
        
        echo'</tbody></table><br>'; 
        ?>
         </form>
        </div><!--FIN PANEL DE PRODUCTOS-->      
      </div>
</div>  <!--FIN CONTENEDOR PRODUCTOS-->
</div>
</body>
</html>