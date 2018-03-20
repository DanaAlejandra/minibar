<?php
include('php/conexion.php');
include('php/inicio.php');
// Datos previos al registro 
$id_hab = $_GET['habitacion_id']; 
$idPs=$_GET['piso_id'];
$numHab=$_GET['habitacion_num'];  
$id_user = $_SESSION['u_id']; 
$fecha = date ("Y-m-d"); 
//Variables extraidas de formulario
$idPr=$_POST['idNew'];
$estadoPr = $_POST['estadoNew'];
$evaluacionPr = $_POST['evaluacionNew'];
//Inicializando variables para recorrido de array
$contador=0; 
$nulosProductos=0; 
$modificadosProductos=0; 
$i = 0;  
  
 $query = "SELECT r_id FROM `registro` WHERE r_fecha ='$fecha' AND fk_habitacion='$id_hab'";
 $consulta =mysqli_query($con, $query); 
 $registro=mysqli_fetch_array($consulta); 

  if($registro['r_id'] != null){
     echo '<script>alert("No se puede realizar el registro, ya existen datos");</script>';
      echo '<script>window.location="mostrar_piso.php?piso_id='.$idPs.'";</script>'; 
  }
  else{
    //REGISTRO DE PRODUCTOS Y FRIGOBAR
    $sql = "INSERT INTO `registro`(`r_id`, `r_fecha`, `fk_usuario`, `fk_habitacion`) VALUES ('','$fecha','$id_user', '$id_hab')";
      $registro = $con -> query($sql); 
       if ($registro != null) {
        $last_id = mysqli_insert_id($con);

       //VALIDACION FRIGOBAR 
        if ($evaluacionPr > 1) {
           $mysqlFr = "INSERT INTO  `frigobar`(`f_id`, `fk_evaluacion`, `f_fk_registro`)  VALUES ('', '$evaluacionPr', '$last_id')";
             if ($nuevo = $con -> query($mysqlFr)) {
               $mensaje="Cambios guardados correctamente"; 
             }
        }
        else{
          $mensaje = "No hay cambios que registrar"; 
        } //FIN VALICACION DE FRIGOBAR
        
  //VALIDACION DE PRODUCTOS
while ( $i < count($idPr)) {
  if($estadoPr[$i] > 0) {
    //MODIFICAR ESTADO INVENTARIO POR HABITACION           
    if($estadoPr[$i] == 3){
        $actualizar="UPDATE `inventario` SET `in_fecha_registro`='$fecha', `fk_total`= '2' WHERE in_fk_habitacion='$id_hab' AND in_fk_producto='$idPr[$i]'"; 
       if ($consulta=$con->query($actualizar)){
        $modificadosProductos++;
       }
       else{
          $resp='No hay modificaciones en los productos';
       }
     } 
     else{
      $actualizar="UPDATE `inventario` SET `in_fecha_registro`='$fecha', `fk_total`= '1' WHERE in_fk_habitacion='$id_hab' AND in_fk_producto='$idPr[$i]'"; 
       if ($consulta=$con->query($actualizar)){
          $resp='No hay modificaciones en los productos';
       }
      }
     
     //INICIO DE INSERCION DE DATOS A BD
       $mysqlPr="INSERT INTO `stock`(`s_id`, `fk_estado`, `fk_producto`, `fk_registro`) VALUES ('','$estadoPr[$i]','$idPr[$i]','$last_id')";
            
           if ($insertar = $con -> query($mysqlPr)) {
                  $contador++;               
             }  
           else {
                 //echo '<script>alert("Error");</script>';
                 //';
           }
     } //CIERRE CONSULTAR ESTADOS DE PRODUCTOS
     else
     {
       $nulosProductos++; 
     }
           
  $i++; 
}//CIERRE WHILE

//EN CASO QUE NO SE IGRESARAN PRODUCTOS VERIFICAMOS: 
if ($nulosProductos == 12) {
      
       $eliminar="DELETE FROM `registro` WHERE `r_id` = '$last_id'";
       $delete= $con->query($eliminar);

      echo '<script>alert("No hay productos ingresados ni modificados / frigobar '.$mensaje.'");</script>';
      echo '<script>window.location="registro_habitacion.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>'; 
      }
      else
      {
      echo '<script>alert("Registro Exitoso, Total Productos Agregados ' .$contador.' / frigobar '.$mensaje.'/ Inventario Productos Moficados '.$modificadosProductos.'");</script>';
      echo '<script>window.location="registro_habitacion.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>'; 
} 
          } //CIERRE REGISTRO 
  
      
      } //CIERRE IF VERIFICACION DE EXISTENCIA REGISTRO DIARIO


  

mysqli_close($con); 
?>