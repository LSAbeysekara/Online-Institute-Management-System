<?php include('../../config/constant.php') ?>

<?php
    if(isset($_POST['submit'])){
        
        $ex_id = $_POST['ex_id'];
        $q_id = $_POST['q_id'];
        $question = $_POST['question'];
        $ans_01 = $_POST['ans_01'];
        $ans_02 = $_POST['ans_02'];
        $ans_03 = $_POST['ans_03'];
        $ans_04 = $_POST['ans_04'];
        $correct_answer = $_POST['correct_answer'];

        $new_q_num = $_POST['new_q_num'];
        $new_q_id = $_POST['new_q_id'];

        $sql2 = "UPDATE questions SET
            question = '" . mysqli_real_escape_string($conn, $question) . "',
            ans_01 = '" . mysqli_real_escape_string($conn, $ans_01) . "',
            ans_02 = '" . mysqli_real_escape_string($conn, $ans_02) . "',
            ans_03 = '" . mysqli_real_escape_string($conn, $ans_03) . "',
            ans_04 = '" . mysqli_real_escape_string($conn, $ans_04) . "',
            correct_answer = '" . mysqli_real_escape_string($conn, $correct_answer) . "'
            WHERE q_id='$q_id' 
        ";

        
        $res2 = mysqli_query($conn, $sql2);

        if($res2 == true){
            if($new_q_id != "0"){
                $_SESSION['q_num'] = $new_q_num;
                $_SESSION['q_id'] = $new_q_id;
                header('location: ./question-edit.php');
            }else{
                header('location: ./question.php');
            }
            
        }
        else
        {
            $_SESSION['q-update-error'] = "error";
            header('location: ./question-edit.php');
        }

        
        $sql7 = "SELECT * FROM questions WHERE ex_id='$ex_id'";
        $res7 = mysqli_query($conn, $sql7);

        $count7 = mysqli_num_rows($res7);

        $sql8 = "UPDATE exams SET
            question_count = '$count4'
            WHERE ex_id='$ex_id' 
        ";

        $res8 = mysqli_query($conn, $sql8);
    
       
    }
    else{

        $_SESSION['q-update-error'] = "error";
        header('location: ./question-edit.php');
    }
?>