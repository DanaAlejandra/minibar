

 <?php

include('php/conexion.php');
include('php/inicio.php');
// Datos previos al registro 
$id_hab = $_GET['habitacion_id']; 
$idPs=$_GET['piso_id'];
$numHab=$_GET['habitacion_num'];  
$id_user = $_SESSION['u_id']; 
$fecha = date ("Y-m-d"); 


$idPr=$_POST['idNew'];
$estadoPr = $_POST['estadoNew'];
$evaluacionPr = $_POST['evaluacionNew'];

$contador=0; 
$i = 0;  

    $sql = "INSERT INTO `registro`(`r_id`, `r_fecha`, `fk_usuario`, `fk_habitacion`) VALUES ('','$fecha','$id_user', '$id_hab')";

       if ($registro = $con -> query($sql)) {
        $last_id = mysqli_insert_id($con);

       //VALIDACION FRIGOBAR 
        if ($evaluacionPr > 1) {
           $mysqlFr = "INSERT INTO  `frigobar`(`f_id`, `fk_evaluacion`, `fk_registro`)  VALUES ('', '$evaluacionPr', '$last_id')";
             if ($nuevo = $con -> query($mysqlFr)) {
               $mensaje="Cambios guardados correctamente"; 
             }
        }
        else{
        	$mensaje = "No hay cambios que registrar"; 
        }
        
        //VALIDACION DE PRODUCTOS
        while ( $i < count($idPr)) {
           if($estadoPr[$i] > 0) {

           $mysqlPr="INSERT INTO `stock`(`s_id`, `fk_estado`, `fk_producto`, `fk_registro`) VALUES ('','$estadoPr[$i]','$idPr[$i]','$last_id')";

           if ($insertar = $con -> query($mysqlPr)) {
                  $contador++;               
             }  
           else {
                 echo '<script>alert("Error");</script>';
                 echo '<script>window.location="registro_antiguo.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>';
           } //FIN IF REGISTRO
           } //FIN DE VALIDACION DE CONSUMO
           else{
                 //echo '<script>alert("No se han ingresado productos");</script>';
                 //echo '<script>window.location="registro_antiguo.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>';
           }


          $i++; 
          } //FIN WHILE

       } // FIN IF REGISTRO PARA OBTENER LAST_ID

       echo '<script>alert("Registro Exitoso, Total Productos Agregados' .$contador.', frigobar '.$mensaje.'");</script>';
       echo '<script>window.location="registro_antiguo.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>';

mysqli_close($con); 
?>