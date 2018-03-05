<?php
     session_start();

     if(isset($_SESSION['u_id']) && isset($_SESSION['t_tipo']) ){
     }
     else{
       header("Location:index.php");
     }
  ?>
