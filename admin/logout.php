<?php
    include('config/constant.php');
    // Destroy the session
    unset($_SESSION['em_id']); //unset session
    
    // redirect ot login page
    header('location:login.php'); 

?>