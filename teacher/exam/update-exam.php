<?php include('../../config/constant.php') ?>

<?php
if(isset($_POST['update_ex']))
    {
        $ex_id = $_POST['ex_id'];
        $ex_title = $_POST['ex_title'];
        $ex_time = $_POST['ex_time'];
        $ex_date = $_POST['date'];
        $ex_rules = $_POST['rules'];
        $ex_status = $_POST['ex_status'];

        $sql4 = "UPDATE exams SET
            ex_title = '$ex_title',
            ex_time = '$ex_time',
            ex_date_time = '$ex_date',
            ex_rules = '$ex_rules',
            ex_status = '$ex_status'
            WHERE ex_id='$ex_id' 
        ";

        $res4 = mysqli_query($conn, $sql4);
        
        if($res4==true){
            $_SESSION['update-exm-ok'] = "<div class='success'>Ok</div></br></br>"; 
            header('location:./index.php');
            exit();
        }
        else
        {
            $_SESSION['update-exm-error'] = "<div class='error'>Error</div></br></br>";
            header('location:./index.php');
            exit();
        }
    }else{
        $_SESSION['update-exm-error'] = "<div class='error'>Error</div></br></br>";
        header('location:./index.php');
        exit();
    }

?>