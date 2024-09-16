<?php include('config/constant.php') ?>

<?php
    if(isset($_POST['update']))
    {
        $ex_id = $_POST['ex_id'];
        $status = $_POST['status'];

        $sql = "UPDATE exams SET
            ex_status = '$status'
            WHERE ex_id='$ex_id' 
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true){
            $_SESSION['ex-update-ok'] = "<div class='success'>Ok</div></br></br>"; 
            header('location:exam.php'); ?>
            <!-- <meta http-equiv = "refresh" content = "0; url =manage-food.php" /> -->
        <?php
        }
        else
        {
            $_SESSION['ex-update-error'] = "<div class='success'>Error</div></br></br>"; 
            header('location:exam.php');
        }

    }
    else{
        $_SESSION['ex-update-error'] = "<div class='success'>Error</div></br></br>"; 
        header('location:exam.php');
    }
?>