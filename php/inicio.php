<?php
     session_start();

     if(isset($_SESSION['u_id']) && isset($_SESSION['u_nombre']) ){
     }
     else{
       header("Location:login.php");
     }
  ?>
