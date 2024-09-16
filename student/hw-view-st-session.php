<?php include('../config/constant.php'); ?>

<?php

if (isset($_GET['hw_id'])) {
    $hw_id = $_GET['hw_id'];

    $_SESSION['hw_id_st_view'] = $hw_id;
    header('location: ./hw-view-st.php');
}
else{
    $_SESSION['not-hw-st-id'] = "error";
    header('location: ./class-view-st.php');
}

?>