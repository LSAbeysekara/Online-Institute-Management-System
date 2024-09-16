<?php include('config/constant.php') ?>

<?php
    if(isset($_POST['update']))
    {
        $hw_id = $_POST['hw_id'];
        $status = $_POST['status'];

        $sql = "UPDATE homework SET
            hw_status = '$status'
            WHERE hw_id='$hw_id' 
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true){
            $_SESSION['hw-update-ok'] = "<div class='success'>Ok</div></br></br>"; 
            header('location:homework.php'); ?>
            <!-- <meta http-equiv = "refresh" content = "0; url =manage-food.php" /> -->
        <?php
        }
        else
        {
            $_SESSION['hw-update-error'] = "<div class='success'>Error</div></br></br>"; 
            header('location:homework.php');
        }

    }
    else{
        $_SESSION['hw-update-error'] = "<div class='success'>Error</div></br></br>"; 
        header('location:homework.php');
    }
?>