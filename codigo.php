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
  <title>Hoteles de los Andes: Modulo MiniBar</title>
    <!-- bootstrap -->
  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

<style type="text/css">
  .img{
  margin: 0.8em; 
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
//MENSAJE DE BIENVENIDA AL USUARIO 
$fecha = date ("Y-m-d");
echo '<span class="form-control"> Bienvenido '.$_SESSION['username'].' Fecha '.$fecha.'<a href="cerrar_sesion.php" class="">Salir</a></span>';
echo  '<br>';
// DATOS PARA EL MENU DINAMINO
$datop = $_GET[piso]; 
$datoh = $_GET[habitacion]; 
$sqlh = "SELECT h_numero, h_id FROM habitaciones WHERE h_numero = '$datoh'";
$sqlp = "SELECT ps_numero, ps_id FROM piso WHERE ps_id = '$datop'";

  if (($consultap = $con -> query($sqlp)) && ($consultah = $con -> query($sqlh)) ) {
    $selection = mysqli_fetch_array($consultap); 
    $selectionh = mysqli_fetch_array($consultah); 
    echo ' <ol class="breadcrumb">
      <li><a href="menu_principal.php">Inicio</a></li>     
      <li><a href="mostrar_piso.php?piso='.$selection['ps_id'].'">Piso '.$selection['ps_numero'].'</a></li> 
      <li class="active">Habitaciones '.$selectionh['h_numero'].'</li>
      </ol>'; 
      $_SESSION['id_habitacion'] = $selectionh['h_id'];
  }

 
?>

<div class="container">
<!-- INGRESO ESTADO DE FRIGOBAR-->
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"> Registro Frigobar </div>
      <div class="panel-body">
        <form name="form-frigobar" method="POST" action="registro_frigobar.php?habitacion=$habitacion"><br> 
        <br>
        <span> Estado: </span>
        <br>
        <input type="radio" name="estado" id="estado" value="1"> Sin Cambio
        <input type="radio" name="estado" id="estado" value="2"> Mal Estado
        <input type="radio" name="estado" id="estado" value="3"> Nuevo
        <br>
        <br>
        <input type="submit" class="btn btn-primary" name="guardar" id="guardar" value="Guardar">
    </form>
  </div>
 </div>  
</div>
       
<!--INGRESO DE CONSUMO DE PRODUCTOS-->
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">Registro de Consumo de Habitación </div>
      <div class="panel-body">
        <form name="form-product" id="form-product" method="POST" action="registro_stock.php"> 
        <br>
        <table class="table table-bordered">
          <thead>
            <th> Id </th>
            <th> Producto </th>
            <th> Estado </th>
          </thead>
          <tbody>
          <?php  
      //MOSTRAR PRODUCTOS EXISTENTES
           include ('php/conexion.php'); 

        $sql = "SELECT pd_id, pd_nombre FROM `productos`"; 
        $item = $con -> query($sql); 
        
        while($product = mysqli_fetch_array($item)){
        echo '<tr>
             <td>'.$product['pd_id'].'</td>
             <td><input class="form-control form-control-md" type="text" name="product_id[]" id="product_id[]" value="'.$product['pd_nombre'].'">
             </td>
             <td><select  class="custom-select form-control"  name ="product_ev[]">
                 <option selected>Seleccione...</option>
                 <option name="evaluacion" value="1">CR</option>
                 <option name="evaluacion" value="2">R</option>
                 <option name="evaluacion" value="3">SS</option>
                 </select></td> 
                 </tr>'; 
                 }
        ?>  
          </tbody>
          </table><br>
          <input type="submit" class="btn btn-primary"  name="enviar" value="Agregar">
         
         </form>
      </div>
    </div>
  </div>  <!--FIN PANEL DE PRODUCTOS-->

</body>
</html>