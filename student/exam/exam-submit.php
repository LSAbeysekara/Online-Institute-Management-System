<?php include('../../config/constant.php') ?>
<?php include('../login-check.php'); ?>

<?php
    $st_id = "0";
    if(isset($_SESSION['st_id'])){
        $st_id = $_SESSION['st_id'];
    }

    if($st_id == "0"){
        header('location: ../../login.php');
    }
?>

<?php

    if(isset($_GET['ex_id']) && isset($_GET['st_id'])){

        $ex_id01 = $_GET['ex_id'];
        $st_id01 = $_GET['st_id'];

    } elseif(isset($_SESSION['ex_id_finished']) && isset($_SESSION['st_id_finished'])){

        $ex_id01 = $_SESSION['ex_id_finished'];
        $st_id01 = $_SESSION['st_id_finished'];

    } else {
        header('location: ./exam-view.php');
    }
        
        $sql = "INSERT INTO exam_enroll SET
        ex_id = '$ex_id01',
        st_id = '$st_id01',
        enrolled = 'Yes'
        ";
        
        $res = mysqli_query($conn, $sql);

        if($res == TRUE){

            $sql2 = "SELECT * FROM exam_enroll ORDER BY id DESC LIMIT 1";

            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);

            if($count2>0){
                
                while($row=mysqli_fetch_assoc($res2)){
                    $id = $row['id'];
                }}

                $id1 = "EE".$id;

            $sql4 = "UPDATE exam_enroll SET ex_enr_id= '$id1' WHERE id = $id";

            $res4 = mysqli_query($conn, $sql4);

            if($res4 == true){

                $sql6 = "SELECT * FROM answer WHERE ex_id = '$ex_id01' AND st_id = '$st_id01' AND correct = 'Yes'";

                $res6 = mysqli_query($conn, $sql6);

                $count6 = mysqli_num_rows($res6);



                $sql7 = "SELECT * FROM exams WHERE ex_id = '$ex_id01'";

                $res7 = mysqli_query($conn, $sql7);

                $count7 = mysqli_num_rows($res7);

                if($count7>0){
                    
                    while($row=mysqli_fetch_assoc($res7)){
                        $q_count = $row['question_count'];
                    }
                }

                $ress = $count6."/".$q_count;


                $sql5 = "INSERT INTO exam_results SET
                    st_id = '$st_id01',
                    ex_id = '$ex_id01',
                    result = '$ress',
                    status = 'Inactive'
                ";

                $res5 = mysqli_query($conn, $sql5);



                $sql8 = "SELECT * FROM exam_results ORDER BY id DESC LIMIT 1";

                $res8 = mysqli_query($conn, $sql8);

                $count8 = mysqli_num_rows($res8);

                if($count8>0){
                    
                    while($row=mysqli_fetch_assoc($res8)){
                        $id = $row['id'];
                    }}

                    $id4 = "ER".$id;


                $sql9 = "UPDATE exam_results SET res_id = '$id4' WHERE id = $id";

                $res9 = mysqli_query($conn, $sql9);

                if($res9 == true){
                    
                    $_SESSION['exam-finished-ok'] = "ok";
                    header('location: ./index.php');

                }else{

                    $_SESSION['exam-finished-error'] = "error";
                    header('location: ./index.php');

                }
            }
            else
            {
                $_SESSION['exam-finished-error'] = "error";
                header('location: ./index.php');
            }
        }

?>