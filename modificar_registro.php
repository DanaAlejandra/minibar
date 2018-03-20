<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
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
$idRegistro=$_GET['id_registro']; 
 
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
      <div class="panel-heading"> Consumo  Ingresado :</div>
      <div class="panel-body">

    <form name="FormNewRegistro" id="FormNewRegistro" class="form-horizontal" method="post" action="modificarRegistro.php?piso_id=<?php $idPiso=$_GET['piso_id']; echo $idPiso;?>&habitacion_num=<?php $numHab=$_GET['habitacion_num']; echo $numHab;?>&habitacion_id=<?php $idHab=$_GET['habitacion_id']; echo $idHab;?>&id_registro=<?php echo $idRegistro;?>">
    
<div class="contenedor_tabla">
  <table class="table" id="productTable">
          <thead>
            <tr>
              <th hidden="true">Registro</th>
              <th hidden="true">Id</th> 
              <th >Producto</th>
              <th >Estado</th>                        
            </tr>
          </thead>
          <tbody>
        <?php 
        include 'php/conexion.php'; 
        $fecha=date("Y-m-d");
        $idHabitacion = $_GET['habitacion_id'];
        $idRegistro=$_GET['id_registro']; 
        $sql = "SELECT `s_id`,`pd_id`, `pd_nombre`,`e_id`, `e_sigla`,  `e_descripcion`, `fk_registro` FROM `stock` JOIN `productos` ON fk_producto = pd_id JOIN `estado` ON fk_estado=e_id WHERE fk_registro='$idRegistro' AND pd_categoria='Bebidas'"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr>
            <td hidden="true"><input class="form-control form-control-md"  type="text" name="idStockEdit[]" id="idStockEdit[]" value="'.$product['s_id'].'"></td>
            <td hidden="true"><input class="form-control form-control-md"  type="text" name="idEdit[]" id="idEdit[]" value="'.$product['pd_id'].'"></td>
            <td><input class="form-control form-control-md" type="text" name="nombreEdit[]" id="nombreEdit[]" value="'.$product['pd_nombre'].'" disabled></td>
            <td><select  class="custom-select form-control"  name ="estadoEdit[]">
                 <option selected value="'.$product['e_id'].'">'.$product['e_sigla'].'</option>
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
              <th hidden="true">Registro</th>            
              <th hidden="true" >Id</th> 
              <th > Producto </th>
              <th > Estado </th>                       
            </tr>
          </thead>
          <tbody>
        <?php 
        include 'php/conexion.php';
        $idHabitacion = $_GET['habitacion_id'];
        $fecha=date("Y-m-d");
        $idRegistro=$_GET['id_registro']; 
        $sql = "SELECT `s_id`,`pd_id`, `pd_nombre`,`e_id`, `e_sigla`, `e_descripcion`, `fk_registro` FROM `stock` JOIN `productos` ON fk_producto = pd_id JOIN `estado` ON fk_estado=e_id WHERE fk_registro='$idRegistro' AND  pd_categoria='Dulces' OR  pd_categoria='Tragos'"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr>
            <td hidden="false"><input class="form-control form-control-md"  type="text" name="idStockEdit[]" id="idStockEdit[]" value="'.$product['s_id'].'" ></td>
             <td hidden="true"><input class="form-control form-control-md"  type="text" name="idEdit[]" id="idEdit[]" value="'.$product['pd_id'].'"></td>
            <td><input class="form-control form-control-md" type="text" name="nombreEdit[]" id="nombreEdit[]" value="'.$product['pd_nombre'].'" disabled></td>
            <td><select  class="custom-select form-control"  name ="estadoEdit[]">
                 <option selected value="'.$product['e_id'].'">'.$product['e_sigla'].'</option>
                 <option  value="1">CR</option>
                 <option  value="2">R</option>
                 <option  value="3">SS</option>
          </select></td></tr>';
        }
        echo'</tbody></table>'; 
        ?>   
</div>

        <div class="div-action pull pull-right" style="padding-bottom:20px;">
          <button class="btn btn-default " id="editRegistroBtn"> <i class="glyphicon glyphicon-ok"></i> Modificar</button>
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
              <th hidden="true">Id</th>              
              <th>Producto</th>
              <th>Estado</th>                   
            </tr>
          </thead>
          <tbody>


        <?php 
        include 'php/conexion.php'; 
        $fecha = date ("Y-m-d");
        $numero = $_GET['habitacion_num'];
  $sql = "SELECT s_id, r_id ,pd_nombre ,e_sigla, e_descripcion,  pd_id, h_numero, e_id, s_id FROM `habitaciones` JOIN `registro` ON fk_habitacion = h_id JOIN `stock` ON fk_registro=r_id JOIN `productos` ON fk_producto= pd_id JOIN `estado` ON fk_estado=e_id WHERE r_fecha='$fecha' AND h_numero='$numero'"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr><td hidden="true" ><input class="form-control form-control-md" type="text" name="id[]" id="id[]" value="'.$product['s_id'].'"></td>
          <td><input class="form-control form-control-md" type="text" name="nombre[]" id="nombre[]" value="'.$product['pd_nombre'].'" disabled></td>
          <td><input class="form-control form-control-md" type="text" name="estado[]" id="estado[]" value="'.$product['e_descripcion'].'" disabled></td>
          </tr> ';
        }
        
        echo'</tbody></table><br>'; 
        ?>
        <div class="col-md-3 pull pull-right">

        <div class="div-action pull pull-right">
          <a class="btn btn-default" href="eliminarRegistro.php?piso_id=<?php $idPiso=$_GET['piso_id']; echo $idPiso;?>&habitacion_num=<?php $numHab=$_GET['habitacion_num']; echo $numHab;?>&habitacion_id=<?php $idHab=$_GET['habitacion_id']; echo $idHab;?>" id="editRegistroBtn"><i class="glyphicon glyphicon-ok"></i> Eliminar </a>
        </div> 
        </div>
      
         </form>
        </div><!--FIN PANEL DE PRODUCTOS-->      
      </div>
</div>  <!--FIN CONTENEDOR PRODUCTOS-->
</div>
</body>
</html>