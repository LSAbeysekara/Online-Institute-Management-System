<?php
    
    if(!isset($_SESSION['em_id_teacher'])){
        $_SESSION['no-login-message'] = "<div class='error text-center'> Please Login to access Admin Panel.</div></br></br>";
        header('location: login.php');
    }
?> 