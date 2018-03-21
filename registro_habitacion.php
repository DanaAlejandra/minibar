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

    <form name="FormNewRegistro" id="FormNewRegistro" class="form-horizontal" method="post" action="nuevoRegistro.php?piso_id=<?php $idPiso=$_GET['piso_id']; echo $idPiso;?>&habitacion_num=<?php $numHab=$_GET['habitacion_num']; echo $numHab;?>&habitacion_id=<?php $idHab=$_GET['habitacion_id']; echo $idHab;?>">
     
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
        $sql = "SELECT pd_id, pd_nombre FROM `productos` WHERE pd_categoria <> 'Bebidas'"; 
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

  <div>
     <label>Indicaciones : </label>
     <textarea class="form-control" rows="3" id="indicacionNew" name="indicacionNew"></textarea>
  </div>
  <br>
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
      <div class="panel-heading"> Registro Habitacion <?php echo $h_numero; ?> </div>
      <div class="panel-body">
      <form name="FormEditRegistro" id="FormViewRegistro" class="form-horizontal" method="GET" action="">

      <?php 
        include 'php/conexion.php'; 
        $fecha = date ("Y-m-d");
        $numero = $_GET['habitacion_num'];
        $id_Hab = $_GET['habitacion_id']; 
        //CONSULTAR PARA VERIFICAR EL TIPO DE REGISTRO
        $mysql= "SELECT  r_id, r_indicacion, h_numero FROM `habitaciones` JOIN `registro` ON fk_habitacion = h_id WHERE r_fecha='$fecha' AND h_id='$id_Hab'"; 
        $registro = $con->query($mysql); 
        $result= mysqli_fetch_array($registro);
        $idRegistro=$result['r_id']; 

        $sql = "SELECT s_id, r_id ,pd_nombre ,e_sigla, e_descripcion,  pd_id, h_numero, e_id, s_id FROM `habitaciones` JOIN `registro` ON fk_habitacion = h_id JOIN `stock` ON fk_registro=r_id JOIN `productos` ON fk_producto= pd_id JOIN `estado` ON fk_estado=e_id WHERE r_fecha='$fecha' AND h_numero='$numero'"; 
        $stock = $con -> query($sql); 
        $total = mysqli_num_rows ($stock);

        $consulta="SELECT f_id, r_id, r_indicacion, h_numero, ev_descripcion  FROM `habitaciones` JOIN `registro` ON fk_habitacion = h_id JOIN `frigobar` ON f_fk_registro=r_id JOIN `evaluacion` ON fk_evaluacion=ev_id  WHERE r_fecha='$fecha' AND h_id='$id_Hab'";
        $frigobar = $con -> query($consulta); 
        $evaluacion= mysqli_fetch_array($frigobar);


        if(($total == 0) && ($evaluacion['ev_descripcion'] == null))
          {
          if($result['r_indicacion'] != null){
          echo '<div class="panel panel-default"><div class="panel-body"> No existen registro de productos ni frigobar dado que '.$result['r_indicacion'].'.<br>
          </div></div><br>'; 
             } 
          }
        elseif (($total > 0) && ($evaluacion['ev_descripcion'] == null)) {

         if($result['r_indicacion'] != null){
          echo '<div class="panel panel-default"><div class="panel-body"> Indicaciones:  '.$result['r_indicacion'].'<br></div></div><br>'; 
        } 

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
         elseif (($total > 0) && ($evaluacion['ev_descripcion'] != null)) {

         if($result['r_indicacion'] != null){
          echo '<div class="panel panel-default"><div class="panel-body"> Indicaciones:  '.$result['r_indicacion'].'<br>Estado Frigobar : '.$evaluacion['ev_descripcion'].'<br>
          </div></div><br>'; 
        }
        else
        {
          echo '<div class="panel panel-default"><div class="panel-body"> Estado Frigobar : '.$evaluacion['ev_descripcion'].'<br></div></div><br>'; 
        }
        
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

        elseif (($total == 0) && ($evaluacion['ev_descripcion'] != null)) {
     
        if($result['r_indicacion'] != null){
        echo '<div class="panel panel-default"><div class="panel-body"> Indicaciones : '.$result['r_indicacion'].'<br>Estado Frigobar : '.$evaluacion['ev_descripcion'].'<br></div></div><br>'; 
        }
        else{
          echo '<div class="panel panel-default"><div class="panel-body">Estado Frigobar : '.$evaluacion['ev_descripcion'].'<br></div></div><br>'; 
        }
        }
        else          
        {
           if($result['r_indicacion'] != null){
          echo '<div class="panel panel-default"><div class="panel-body"> Indicaciones : '.$result['r_indicacion'].'<br>Estado Frigobar : '.$evaluacion['ev_descripcion'].'<br></div></div><br>'; 
          } 
          
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
          
        ?>
      
  <div class="div-action pull pull-right">
          <a class="btn btn-default" href="modificar_registro.php?piso_id=<?php $idPiso=$_GET['piso_id']; echo $idPiso;?>&habitacion_num=<?php $numHab=$_GET['habitacion_num']; echo $numHab;?>&habitacion_id=<?php $idHab=$_GET['habitacion_id']; echo $idHab;?>&id_registro=<?php  echo $idRegistro;?>" id="editRegistroBtn"><i class="glyphicon glyphicon-ok"></i> Modificar</a>
  </div> 
    
         </form>
        </div><!--FIN PANEL DE PRODUCTOS-->      
      </div>
</div>  <!--FIN CONTENEDOR PRODUCTOS-->
</div>
</body>
</html>