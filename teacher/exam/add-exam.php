<?php include('../../config/constant.php') ?>

<?php
    if(isset($_POST['submit'])){
        
        $ex_title = $_POST['title'];
        $cl_id = $_POST['cl_id'];
        $em_id = $_POST['em_id'];
        $ex_time = $_POST['time'];
        $ex_date = $_POST['date'];
        $ex_status = $_POST['status'];
        $ex_rules = $_POST['rules'];

        
        $sql2 = "INSERT INTO exams SET
            ex_id = '$ex_id',
            ex_title = '$ex_title',
            ex_time = '$ex_time',
            ex_date_time = '$ex_date',
            cl_id = '$cl_id',
            ex_rules = '$ex_rules',
            created = '$em_id',
            ex_status = '$ex_status'
        ";
        
        $res2 = mysqli_query($conn, $sql2);

        $sql3 = "SELECT * FROM exams ORDER BY id DESC LIMIT 1";

        $res3 = mysqli_query($conn, $sql3);

        $count3 = mysqli_num_rows($res3);

        if($count3>0){
            while($row=mysqli_fetch_assoc($res3)){
                $id = $row['id'];
            }}

            $id1 = "EX".$id;

        $sql4 = "UPDATE exams SET ex_id= '$id1' WHERE id = '$id'";

        $res4 = mysqli_query($conn, $sql4);

        if($res2 == true){
            $_SESSION['exam-add-ok'] = "ok";
            header('location: ./index.php');
        }
        else
        {
            $_SESSION['exam-add-error'] = "error";
            header('location: ./index.php');
        }
    }
    else{

        $_SESSION['exam-add-error'] = "error";
        header('location: ./index.php');
    }
?>