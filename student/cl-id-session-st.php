<?php include('../config/constant.php'); 

if (isset($_GET['cl_id'])) {
    $cl_id = $_GET['cl_id'];

    $_SESSION['cl_id_student'] = $cl_id;
    header('location: ./class-view-st.php');
}
else{
    $_SESSION['not-cl-id-st'] = "error";
    header('location: ./index.php');
}

