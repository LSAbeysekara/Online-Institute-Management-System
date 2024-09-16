<?php include('config/constant.php'); ?>

<?php

if (isset($_GET['hw_id']) && $_GET['cl_id']) {
    $hw_id = $_GET['hw_id'];
    $cl_id = $_GET['cl_id'];

    $_SESSION['hw_id_view01'] = $hw_id;
    $_SESSION['cl_id_view01'] = $cl_id;
    header('location: ./hw-view.php');
}
else{
    $_SESSION['not-hw-id'] = "error";
    header('location: ./homework.php');
}

?>