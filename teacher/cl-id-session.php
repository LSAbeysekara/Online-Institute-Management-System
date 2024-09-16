<?php include('../config/constant.php'); 

if (isset($_GET['cl_id'])) {
    $cl_id = $_GET['cl_id'];

    $_SESSION['cl_id_teacher'] = $cl_id;
    header('location: ./class-view.php');
}
else{
    $_SESSION['not-cl-id'] = "error";
    header('location: ./index.php');
}

