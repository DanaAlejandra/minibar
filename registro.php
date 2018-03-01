 <?php
include('header.php'); 
// DATOS PARA EL MENU DINAMINO
$idp = $_GET['piso']; 
$h_numero = $_GET['habitacion_num']; 
$_SESSION['id_habitacion'] = $_GET['habitacion_id']; 
 
$sql = "SELECT ps_id, ps_numero FROM piso WHERE ps_id=$idp"; 
//CONSULTA NUMERO DE PISOS
  if ($consulta = $con -> query($sql)) {
    $selection = mysqli_fetch_array($consulta); 
    echo ' <ol class="breadcrumb">
      <li><a href="menu_principal.php">Inicio</a></li>     
      <li class="active" href="menu_principal.php?piso='.$idp.'" >Piso '.$selection['ps_numero'].'</li> 
      <li class="active">Habitacion '.$h_numero.'</li>
      </ol>'; 
  }


?>
<div class="container">       
<!--INGRESO DE CONSUMO DE PRODUCTOS-->
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"> Registro </div>
      <div class="panel-body">
        <form name="form-product" id="form-product" method="POST" action="registro_final.php"> 
        <br>
      <div class="form-row">
          <div class="form-group col-md-2">
          <label> Id  </label> 
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
          <label> Nombre  </label> 
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
          <label> Estado  </label> 
          </div>
        </div>
      <br>
      <br>

      <?php  
      //MOSTRAR PRODUCTOS EXISTENTES
           include ('php/conexion.php'); 

        $sql = "SELECT pd_id, pd_nombre FROM `productos`"; 
        $sql_ev= "SELECT ev_id, ev_descripcion FROM `evaluacion`";
        $item = $con -> query($sql); 
        
        while($product = mysqli_fetch_array($item)){
        echo '<div class="form-row">
               <div class="form-group col-md-2">
               <input class="form-control form-control-md" type="text" name="id[]" id="id[]" value="'.$product['pd_id'].'">
               </div>

        <div class="form-row">
          <div class="form-group col-md-6">
         <input class="form-control form-control-md" type="text" name="nombre[]" id="nombre[]" value="'.$product['pd_nombre'].'">
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
          <select  class="custom-select form-control"  name ="estado[]">
                 <option selected value="0">Seleccione...</option>
                 <option  value="1">CR</option>
                 <option  value="2">R</option>
                 <option  value="3">SS</option>
                 </select>
        </div>'; 
         } //FIN DEL WHILE
        
        if ($registro_f = $con ->  query($sql_ev)) {
        echo '<label>Estado Frigobar</label><select  class="custom-select form-control"  name ="evaluacion"><option selected value="0">Seleccione...</option>'; 
         while ( $evaluacion = mysqli_fetch_array($registro_f)) {
           echo '<label>Estado</label>
                 <option  value="'.$evaluacion['ev_id'].'">'.$evaluacion['ev_descripcion'].'</option>';
         } //FIN DEL WHILE EVALUACION FRIGOBAR
         echo '</select><br><br>';
        } //FIN DEL IF     
        ?>    

        <input type="submit" class="btn btn-primary" name="guardar" id="guardar" value="Guardar">       
         </form>
      </div>
    </div>
  </div>  <!--FIN PANEL DE PRODUCTOS-->

