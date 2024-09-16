<?php
    include('../config/constant.php');
    unset($_SESSION['st_id']); 
    
    header('location:../login.php'); 

?>