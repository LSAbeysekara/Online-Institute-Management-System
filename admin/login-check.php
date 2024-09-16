<?php
    //Authorization - access control
    //check whether the user is logged in or not

    if(!isset($_SESSION['em_id'])){
        $_SESSION['no-login-message'] = "<div class='error text-center'> Please Login to access Admin Panel.</div></br></br>";
        header('location: login.php');
    }
?> 