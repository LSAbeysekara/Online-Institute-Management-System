<?php include('../../config/constant.php'); ?>

<?php

if (isset($_GET['ex_id'])) {
    $ex_id = $_GET['ex_id'];

    $_SESSION['ex_id'] = $ex_id;
    header('location: ./question.php');
}
else{
    $_SESSION['ex-id-error'] = "error";
    header('location: ./index.php');
}

?>