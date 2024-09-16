<?php

    if(!isset($_SESSION['st_id'])){
        $_SESSION['no-login-message'] = "<div class='error text-center'> Please Login First.</div></br></br>";
        header('location: ../login.php');
    }
?> 