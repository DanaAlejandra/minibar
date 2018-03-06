<?php require_once 'header_admin.php'; ?>

<div class="container" id="principal">
<br>
<table class="table table-striped form-group-md">
    <tr>
      <th scope="col">Usuario </th>
      <th scope="col">Fecha</th>
      <th scope="col">Piso</th>
      <th scope="col">Nro Habitacion</th>
      <th scope="col">Producto</th>
      <th scope="col">Estadon</th>
      <th scope="col">Accion</th>
    </tr>
<?php 
include('php/conexion.php');
$id_dpto = $_SESSION['d_id']; 
$busqueda = "SELECT u_nombre, r_fecha, ps_numero, h_numero, pd_nombre, e_descripcion  FROM `usuario` JOIN `registro` ON fk_usuario = u_id JOIN `stock` ON fk_registro=r_id JOIN `productos` ON fk_producto=pd_id JOIN `estado` ON fk_estado=e_id JOIN `habitaciones` ON fk_habitacion = h_id JOIN `piso` on fk_piso = ps_id WHERE r_fecha='2018-02-06'  ";
$consulta =mysqli_query($con, $busqueda); 

 while($registro = mysqli_fetch_array($consulta)){
    echo '<tr>
            <td>'.$registro['u_nombre'].'</td>
            <td>'.$registro['r_fecha'].'</td>
            <td>'.$registro['ps_numero'].'</td>
            <td>'.$registro['h_numero'].'</td>
            <td>'.$registro['pd_nombre'].'</td>
            <td>'.$registro['e_descripcion'].'</td>
            <td><div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acción<span class="caret"></span></button><ul class="dropdown-menu"><li><a type="button" data-toggle="modal" data-target="#editRegistroModal" onclick="editregistro()"> <i class="glyphicon glyphicon-search"></i> Editar</a></li><li><a type="button" data-toggle="modal" data-target="#deleteRegistroModal" onclick="deleteregistro()"><i class="glyphicon glyphicon-print"></i>  Eliminar</a></li><li></ul></div></td></tr>';
  }