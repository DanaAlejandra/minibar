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

<div class="panel panel-default">
  <div class="panel-heading">  Habitación <?php echo $h_numero;?> </div>
  <div class="panel-body">
    <?php  
    include 'php/conexion.php'; 
    $idRegistro = $_GET['id_registro']; 
    $sql= "SELECT `r_id`, `r_fecha`, `r_indicacion` FROM `registro` WHERE r_id='$idRegistro'"; 
    $indicacion = $con->query($sql);
    $result=mysqli_fetch_array($indicacion); 
    if($result['r_indicacion'] != null){
     echo 'Observación: <br>';
     echo '      '.$result['r_indicacion'].'.<br>';
    }
    else{
      echo "no hay observaciones<br>";
    }

    $query="SELECT `f_id`, `fk_evaluacion`, `ev_descripcion`, `f_fk_registro` FROM `frigobar` JOIN `evaluacion` ON fk_evaluacion=ev_id WHERE f_fk_registro='$idRegistro'"; 
    $resp=$con->query($query);
    $evaluacion=mysqli_fetch_array($resp);
    if($evaluacion['ev_descripcion'] != null){
    echo 'Estado frigobar : '.$evaluacion['ev_descripcion'].'.<br>'; 
    }
    else
    {
       echo 'Frigobar no presenta cambios';
    }  
    ?>    
  </div>
</div>


<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"> Modificar Registro Habitacion <?php echo $h_numero; ?> :</div>
      <div class="panel-body">

    <form name="FormNewRegistro" id="FormNewRegistro" class="form-horizontal" method="post" action="modificarRegistro.php?piso_id=<?php $idPiso=$_GET['piso_id']; echo $idPiso;?>&habitacion_num=<?php $numHab=$_GET['habitacion_num']; echo $numHab;?>&habitacion_id=<?php $idHab=$_GET['habitacion_id']; echo $idHab;?>&id_registro=<?php echo $idRegistro;?>">

      <?php 
        include 'php/conexion.php'; 
        $fecha=date("Y-m-d");
        $idHabitacion = $_GET['habitacion_id'];
        $idRegistro=$_GET['id_registro']; 
        $sql = "SELECT `s_id`,`pd_id`, `pd_nombre`,`e_id`, `e_sigla`,  `e_descripcion`, `fk_registro` FROM `stock` JOIN `productos` ON fk_producto = pd_id JOIN `estado` ON fk_estado=e_id WHERE fk_registro='$idRegistro'"; 
        $result = $con -> query($sql); 
        $total= mysqli_num_rows($result); 

     if($total > 0){
      echo '<div class="contenedor_tabla"><table class="table" id="productTable">
          <thead>
            <tr>
              <th hidden="true">Registro</th>
              <th hidden="true">Id</th> 
              <th >Producto</th>
              <th >Estado</th>                        
            </tr>
          </thead>
          <tbody>';
      
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
        
        echo '</div><div class="contenedor_tabla_otros pull pull-right">
          <table class="table" id="productTable">
          <thead>
            <tr>
              <th hidden="true">Registro</th>
              <th hidden="true">Id</th> 
              <th >Producto</th>
              <th >Estado</th>                        
            </tr>
          </thead>
          <tbody>';
      
        $sql = "SELECT `s_id`,`pd_id`, `pd_nombre`,`e_id`, `e_sigla`,  `e_descripcion`, `fk_registro` FROM `stock` JOIN `productos` ON fk_producto = pd_id JOIN `estado` ON fk_estado=e_id WHERE fk_registro='$idRegistro' AND pd_categoria <> 'Bebidas'"; 
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
        echo'</tbody></table></div>'; 
     }
     else
     {
      echo '<div class="panel panel-default"><div class="panel-body">No existen productos ingresados en la habitación '.$h_numero.'<br></div></div>';
     }
  
    ?>   
      
<br>
        <div class="div-action pull pull-right col-md-3" style="padding-bottom:20px;">
          <div class="pull-left">
              <a class="btn btn-default" href="eliminarRegistro.php?piso_id=<?php $idPiso=$_GET['piso_id']; echo $idPiso;?>&habitacion_num=<?php $numHab=$_GET['habitacion_num']; echo $numHab;?>&habitacion_id=<?php $idHab=$_GET['habitacion_id']; echo $idHab;?>" id="editRegistroBtn"><i class="glyphicon glyphicon-ok"></i> Eliminar </a>
          </div>
          <div class="pull-right">
              <button class="btn btn-default " id="editRegistroBtn"> <i class="glyphicon glyphicon-ok"></i> Modificar</button>
          </div>
        
        </div> 
         </form>
        </div><!--FIN PANEL DE PRODUCTOS-->      
      </div>
</div>  <!--FIN CONTENEDOR PRODUCTOS-->



 <!--PANEL DE HABITACIONES-->
<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"> Registro diario Habitación <?php echo $id_Hab;  ?>  </div>
      <div class="panel-body">
      
    <form name="FormEditRegistro" id="FormViewRegistro" class="form-horizontal" method="GET" action="">

<?php 
        include 'php/conexion.php'; 
        $fecha=date("Y-m-d");
        $idHabitacion = $_GET['habitacion_id'];
        $idRegistro=$_GET['id_registro']; 
        $sql = "SELECT `s_id`,`pd_id`, `pd_nombre`,`e_id`, `e_sigla`,  `e_descripcion`, `fk_registro` FROM `stock` JOIN `productos` ON fk_producto = pd_id JOIN `estado` ON fk_estado=e_id WHERE fk_registro='$idRegistro'"; 
        $result = $con -> query($sql); 
        $total= mysqli_num_rows($result); 
      
if($total > 0){
      echo '<div class="contenedor_tabla"><table class="table" id="productTable">
          <thead>
            <tr>
              <th hidden="true">Registro</th>
              <th hidden="true">Id</th> 
              <th >Producto</th>
              <th >Estado</th>                        
            </tr>
          </thead>
          <tbody>';
      
       $sql = "SELECT `s_id`,`pd_id`, `pd_nombre`,`e_id`, `e_sigla`,  `e_descripcion`, `fk_registro` FROM `stock` JOIN `productos` ON fk_producto = pd_id JOIN `estado` ON fk_estado=e_id WHERE fk_registro='$idRegistro' AND pd_categoria='Bebidas'"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr>
            <td hidden="true"><input class="form-control form-control-md"  type="text" name="idStockEdit[]" id="idStockEdit[]" value="'.$product['s_id'].'"></td>
            <td hidden="true"><input class="form-control form-control-md"  type="text" name="idEdit[]" id="idEdit[]" value="'.$product['pd_id'].'"></td>
            <td><input class="form-control form-control-md" type="text" name="nombreEdit[]" id="nombreEdit[]" value="'.$product['pd_nombre'].'" disabled></td>
            <td><input class="form-control form-control-md" type="text" name="nombreEdit[]" id="nombreEdit[]" value="'.$product['e_descripcion'].'" disabled></td></tr>';
        }
        echo'</tbody></table>'; 
        
        echo '</div><div class="contenedor_tabla_otros pull pull-right">
          <table class="table" id="productTable">
          <thead>
            <tr>
              <th hidden="true">Registro</th>
              <th hidden="true">Id</th> 
              <th >Producto</th>
              <th >Estado</th>                        
            </tr>
          </thead>
          <tbody>';
      
        $sql = "SELECT `s_id`,`pd_id`, `pd_nombre`,`e_id`, `e_sigla`,  `e_descripcion`, `fk_registro` FROM `stock` JOIN `productos` ON fk_producto = pd_id JOIN `estado` ON fk_estado=e_id WHERE fk_registro='$idRegistro' AND pd_categoria <> 'Bebidas'"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr>
            <td hidden="true"><input class="form-control form-control-md"  type="text" name="idStockEdit[]" id="idStockEdit[]" value="'.$product['s_id'].'"></td>
            <td hidden="true"><input class="form-control form-control-md"  type="text" name="idEdit[]" id="idEdit[]" value="'.$product['pd_id'].'"></td>
            <td><input class="form-control form-control-md" type="text" name="nombreEdit[]" id="nombreEdit[]" value="'.$product['pd_nombre'].'" disabled></td>
            <td><input class="form-control form-control-md" type="text" name="nombreEdit[]" id="nombreEdit[]" value="'.$product['e_descripcion'].'" disabled></td></tr>';
        }
        echo'</tbody></table></div>'; 
     }
     else
     {
      echo '<div class="panel panel-default"><div class="panel-body">No existen productos ingresados en la habitación '.$h_numero.'<br></div></div>';
     }
  
    ?>   
<!--  
        <div class="col-md-3 pull pull-right">
        <div class="div-action pull pull-right">
          <a class="btn btn-default" href="eliminarRegistro.php?piso_id=<?php $idPiso=$_GET['piso_id']; echo $idPiso;?>&habitacion_num=<?php $numHab=$_GET['habitacion_num']; echo $numHab;?>&habitacion_id=<?php $idHab=$_GET['habitacion_id']; echo $idHab;?>" id="editRegistroBtn"><i class="glyphicon glyphicon-ok"></i> Eliminar </a>
        </div> 
        </div> -->    
         </form>
        </div><!--FIN PANEL DE PRODUCTOS-->      
      </div>
</div>  <!--FIN CONTENEDOR PRODUCTOS-->
</div>
</body>
</html>