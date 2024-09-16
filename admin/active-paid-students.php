<?php include('config/constant.php') ?>
 
<?php
    $currentYearMonth = date('Y-m');

    $sql10 = "SELECT * FROM student_enroll WHERE paid_month = '$currentYearMonth' AND status = 'Not Paid'";

    $res10 = mysqli_query($conn, $sql10);

    $count10 = mysqli_num_rows($res10);

    if($count10>0){
        while($row=mysqli_fetch_assoc($res10)){
            $cl_id = $row['cl_id'];
            $st_id = $row['st_id'];

            $sql = "UPDATE student_enroll SET
                status = 'Paid'
                WHERE st_id='$st_id' AND cl_id='$cl_id'";

            $res = mysqli_query($conn, $sql);

        }

        if($res==true){
            $_SESSION['padi-st-update-all-ok'] = "<div class='success'>Ok</div></br></br>"; 
            header('location:payment.php'); ?>
        <?php
        }
        else
        {
            $_SESSION['padi-st-update-ok-all-error'] = "<div class='error'>Error</div></br></br>";
            header('location:payment.php');
        }
    }

    if($count10 <= 0){
        header('location:payment.php');
    }
?>