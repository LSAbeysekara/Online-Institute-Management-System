<?php include('config/constant.php') ?>

<?php
    if(isset($_POST['update']))
    {
        $st_id = $_POST['st_id'];
        $cl_id = $_POST['cl_id'];
        $status = $_POST['status'];


        $sql = "UPDATE student_enroll SET
            status = '$status'
            WHERE st_id='$st_id' AND cl_id='$cl_id'";

        $res = mysqli_query($conn, $sql);

        
        if($res==true){
            $_SESSION['padi-st-update-ok'] = "<div class='success'>Ok</div></br></br>"; 
            header('location:payment.php'); ?>
            <!-- <meta http-equiv = "refresh" content = "0; url =manage-food.php" /> -->
        <?php
        }
        else
        {
            $_SESSION['padi-st-update-ok-error'] = "<div class='error'>Error</div></br></br>";
            header('location:payment.php');
        }

    }
    else{
        $_SESSION['padi-st-update-ok-error'] = "<div class='error'>Error</div></br></br>";
        header('location:payment.php');
    }
?>