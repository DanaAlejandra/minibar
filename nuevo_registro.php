

 <?php

include('php/conexion.php');
include('php/inicio.php');
// Datos previos al registro 
$id_hab = $_GET['habitacion_id']; 
$idPs=$_GET['piso_id'];
$numHab=$_GET['habitacion_num'];  
$id_user = $_SESSION['u_id']; 
//$fecha = date ("Y-m-d"); 
$fecha = '2018-03-02'; 

$idPr=$_POST['idNew'];
$estadoPr = $_POST['estadoNew'];
$evaluacionPr = $_POST['evaluacionNew'];

$contador=0; 
$i = 0;  
     
      //REGISTRO DE PRODUCTOS Y FRIGOBAR
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
        } //FIN VALICACION DE FRIGOBAR
        
  //VALIDACION DE PRODUCTOS
        while ( $i < count($idPr)) {
           if($estadoPr[$i] > 0) {
    //MODIFICAR ESTADO INVENTARIO POR HABITACION           
    if($estadoPr[$i] == 3){
        $actualizar="UPDATE `inventario` SET `in_fecha_registro`='$fecha', `fk_total`= '2' WHERE in_fk_habitacion='$id_hab' AND in_fk_producto='$idPr[$i]'"; 
       if ($consulta=$con->query($actualizar)){
         $resp='Inventario Modificado';
       }
       else{
          $resp='Error';
       }
     } 
     else{
      $actualizar="UPDATE `inventario` SET `in_fecha_registro`='$fecha', `fk_total`= '1' WHERE in_fk_habitacion='$id_hab' AND in_fk_producto='$idPr[$i]'"; 
       if ($consulta=$con->query($actualizar)){
         $resp='Inventario Modificado';
       }
       else{
          $resp='Error';
       }
      }
     } //CIERRE IF MODIFICAR PRODUCTOS

//INICIO DE INSERCION DE DATOS A BD
          $mysqlPr="INSERT INTO `stock`(`s_id`, `fk_estado`, `fk_producto`, `fk_registro`) VALUES ('','$estadoPr[$i]','$idPr[$i]','$last_id')";
            
           if ($insertar = $con -> query($mysqlPr)) {
                  $contador++;               
             }  
           else {
                 //echo '<script>alert("Error");</script>';
                 //echo '<script>window.location="registro_antiguo.php?habitacion_id='.$id_hab.'&piso_id='.$idPs.'&habitacion_num='.$numHab.'";</script>';
           }
            $i++; 
        }//CIERRE WHILE 
     
          } //CIERRE REGISTRO
  

       echo '<script>alert("Registro Exitoso, Total Productos Agregados ' .$contador.' / frigobar '.$mensaje.'/ Inventario '.$resp.'");</script>';
       header("location:registro_antiguo.php?habitacion_id=$id_hab&piso_id=$idPs&habitacion_num=$numHab");

mysqli_close($con); 
?>