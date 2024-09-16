<?php include('../../config/constant.php'); ?>

<?php
    
    if(isset($_POST['update_hw_grading'])){

        $hw_id = $_POST['hw_id'];
        $result_status = $_POST['result_status'];

        $sql1 = "UPDATE homework SET grading_status='$result_status' WHERE hw_id = '$hw_id'";

        $res1 = mysqli_query($conn, $sql1);

        if($res1 == true){
            $_SESSION['hw-grading-add-ok'] = "OK";
            header('location: hw-grading.php');
        }
        else
        {
           
            $_SESSION['hw-grading-add-error'] = "error";
            header('location: hw-grading.php');
        }
       
    }
    else{
        $_SESSION['hw-grading-add-error'] = "error";
        header('location: hw-grading.php');
    }
?>