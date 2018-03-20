<?php  
include 'php/conexion.php';
include 'php/header.php';
?>
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
  <div class="container container-fluider">
    <div class="panel panel-default">
  <div class="panel-heading">Inventario Productos en Habitaciones</div>
  <div class="panel-body">

    <div class="contenedor_tabla">
      <table class="table" id="productTable">
          <thead>
            <tr> 
              <th hidden="true"> Id </th> 
              <th > Producto </th>
              <th > Stock Total</th>                        
            </tr>
          </thead>
          <tbody>
        <?php 
        include 'php/conexion.php'; 
        $sql = "SELECT `in_fk_producto`, `pd_nombre`, COUNT(h_id) as Total FROM `inventario`JOIN `productos` ON in_fk_producto=pd_id JOIN `habitaciones` ON in_fk_habitacion=h_id JOIN `piso` ON fk_piso=ps_id WHERE in_fk_habitacion=h_id AND fk_total='1' AND in_fk_producto=pd_id AND pd_categoria='Bebidas' GROUP BY pd_nombre ORDER BY in_fk_producto ASC"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr>
            <td hidden="true">'.$product['in_fk_producto'].'</td>
            <td>'.$product['pd_nombre'].'</td>
            <td>'.$product['Total'].'</td></tr>';
        }
        echo'</tbody></table>'; 
        ?> 
    </div>

  <div class="contenedor_tabla_otros pull pull-right">
      <table class="table" id="productTable">
          <thead>
            <tr> 
              <th hidden="true"> Id </th> 
              <th > Producto </th>
              <th > Stock Total</th>                        
            </tr>
          </thead>
          <tbody>
        <?php 
        include 'php/conexion.php'; 
        $sql = "SELECT `in_fk_producto`, `pd_nombre`, COUNT(h_id) as Total FROM `inventario`JOIN `productos` ON in_fk_producto=pd_id JOIN `habitaciones` ON in_fk_habitacion=h_id JOIN `piso` ON fk_piso=ps_id WHERE in_fk_habitacion=h_id AND fk_total='1' AND in_fk_producto=pd_id AND pd_categoria <> 'Bebidas'  GROUP BY pd_nombre ORDER BY in_fk_producto ASC"; 
        $result = $con -> query($sql); 
        while($product = mysqli_fetch_array($result)){
        echo '<tr>
            <td hidden="true">'.$product['in_fk_producto'].'</td>
            <td>'.$product['pd_nombre'].'</td>
            <td>'.$product['Total'].'</td></tr>';
        }
        echo'</tbody></table>'; 
        ?> 
    </div>



    

  </div>
</div>
  </div>


	


</body>
</html>

