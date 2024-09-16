<?php include('../../config/constant.php'); ?>

<?php

if (isset($_GET['hw_id'])) {
    $hw_id = $_GET['hw_id'];

    $_SESSION['hw_id_teacher_view'] = $hw_id;
    header('location: ./hw-view.php');
}
else{
    $_SESSION['not-hw-id'] = "error";
    header('location: ./hw-creation.php');
}

?>