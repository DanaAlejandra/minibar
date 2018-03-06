<?php 
require_once 'php/inicio.php';
include 'php/conexion.php';

$startDate = $_POST['startDate'];
//$date = DateTime::createFromFormat("Y-m-d", $startDate);
$date =date("d-m-Y",strtotime($startDate));

echo 'Reporte día '.$date .'<br>'; 
echo 'Encargado Minibar '.$_SESSION['u_nombre'] .'<br>';
?>
<!--TABLA CONSUMO DE PRODUCTOS-->
<br>
<label>Consumo de productos por habitación : </label><br><br>
<table border="1" cellspacing="0" cellpadding="0" style="width:100%;"><tr>
			<th>Habitacion</th>
			<th>Producto </th>
			<th>Estado</th>
			
		</tr>

<?php
include 'php/conexion.php';
if($_POST) {
	$startDate = $_POST['startDate'];
	//$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$date =date("Y-m-d",strtotime($startDate));
	
        $query = "SELECT r_id, r_fecha, pd_nombre, e_descripcion, h_numero FROM `estado` JOIN `stock` on fk_estado = e_id JOIN `productos` on fk_producto = pd_id JOIN `registro` on fk_registro = r_id JOIN habitaciones on fk_habitacion = h_id WHERE r_fecha='$date'";
        $consulta = $con -> query($query); 

		while ($result = mysqli_fetch_array($consulta)) {
			echo '<tr>
				<td><center>'.$result['h_numero'].'</center></td>
				<td><center>'.$result['pd_nombre'].'</center></td>
				<td><center>'.$result['e_descripcion'].'</center></td>
			    </tr>';	
		}	
		} //FIN DEL IF PRINCIPAL 
?>
</table>

<!--TABLA RESUMEN FRIGOBAR-->
<table border="1" cellspacing="0" cellpadding="0" style="width:100%;"><tr>
			<th>Habitacion</th>
			<th>Evaluacion</th>	
		</tr>
<?php
include 'php/conexion.php';
if($_POST) {
	$startDate = $_POST['startDate'];
	//$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$date =date("Y-m-d",strtotime($startDate));
	echo '<br> Evaluación de frigobar por habitaciones : <br>';
        $query = "SELECT r_id, r_fecha, f_id, ev_descripcion, h_numero FROM `evaluacion` JOIN `frigobar` on fk_evaluacion = ev_id JOIN `registro` on fk_registro = r_id JOIN habitaciones on fk_habitacion = h_id WHERE r_fecha = '$date'";
        $consulta = $con -> query($query); 

		while ($result = mysqli_fetch_array($consulta)) {
			echo '<tr>
                <td><center>'.$result['h_numero'].'</center></td>
				<td><center>'.$result['ev_descripcion'].'</center></td>
			    </tr>';	
		}	
		} //FIN DEL IF PRINCIPAL 
?>
</table>