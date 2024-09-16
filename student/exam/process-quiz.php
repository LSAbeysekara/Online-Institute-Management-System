<?php include('../../config/constant.php') ?>

<?php
    if(isset($_POST['submit'])){
        
        $answer = "0";

        $q_id = $_POST['q_id'];
        $st_id = $_POST['st_id'];
        $ex_id = $_POST['ex_id'];

        $finish = "No";
        if(isset($_POST['finish'])){
            $finish = $_POST['finish'];
        }

        if(isset($_POST['answer'])){
        $answer = $_POST['answer'];
        }

        $correct_answer = $_POST['correct_answer'];

        $new_q_id = $_POST['new_q_id'];
        $new_q_num = $_POST['new_q_num'];

        if($correct_answer == $answer){
            $correct = "Yes";
        }else{
            $correct = "No";
        }

        $sql3 = "SELECT * FROM answer WHERE q_id='$q_id' AND st_id='$st_id'";

        $res3 = mysqli_query($conn, $sql3);    
        
        $count3 = mysqli_num_rows($res3);

        if($count3>0){

            $sql2 = "UPDATE answer SET
            correct = '$correct',
            ex_id = '$ex_id',
            st_answer = '$answer',
            st_id = '$st_id'
            WHERE q_id='$q_id' 
            ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2 == true){

                if($finish == "Finished"){
                    $_SESSION['ex_id_finished'] = $ex_id;
                    $_SESSION['st_id_finished'] = $st_id;
                    header('location: ./exam-submit.php');
                    exit();
                }

                if($new_q_id != "0"){
                    $_SESSION['q_num'] = $new_q_num;
                    $_SESSION['q_id'] = $new_q_id;
                    header('location: ./exam-view.php');
                }else{
                    header('location: ./exam-view.php');
                }
            }
            else
            {
                $_SESSION['q-update-error'] = "error";
                header('location: ./exam-view.php');
            }

        }else{

            $sql4 = "INSERT INTO answer SET
            ex_id = '$ex_id',
            q_id = '$q_id',
            st_id = '$st_id',
            st_answer = '$answer',
            correct = '$correct'
            ";
            
            $res4 = mysqli_query($conn, $sql4);

            if($res4 == TRUE){

                $sql5 = "SELECT * FROM answer ORDER BY id DESC LIMIT 1";
                $res5 = mysqli_query($conn, $sql5);
                $count5 = mysqli_num_rows($res5);

                if($count5>0){
                    while($row=mysqli_fetch_assoc($res5)){
                        $id = $row['id'];
                    }}

                    $id1 = "EA".$id;

                $sql6 = "UPDATE answer SET ans_id = '$id1' WHERE id = $id";

                $res6 = mysqli_query($conn, $sql6);

                if($res6 == TRUE){

                    if($finish == "Finished"){
                        $_SESSION['ex_id_finished'] = $ex_id;
                        $_SESSION['st_id_finished'] = $st_id;
                        header('location: ./exam-submit.php');
                        exit();
                    }

                    if($new_q_id != "0"){
                        $_SESSION['q_num'] = $new_q_num;
                        $_SESSION['q_id'] = $new_q_id;
                        header('location: ./exam-view.php');
                    }else{
                        header('location: ./exam-view.php');
                    }
                }else{
                    header('location: ./exam-view.php');
                }
            }
        }

        
    }
    else{
        $_SESSION['q-update-error'] = "error";
        header('location: ./exam-view.php');
    }
?>