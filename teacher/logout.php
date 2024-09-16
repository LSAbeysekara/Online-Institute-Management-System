<?php
    include('../config/constant.php');
    
    unset($_SESSION['em_id_teacher']); 
    unset($_SESSION['not-cl-id']); 
   
    header('location:../admin/login.php'); 

?>