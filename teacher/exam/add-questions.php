<?php include('../../config/constant.php') ?>

<?php
    if(isset($_POST['submit'])){
        
        $ex_id = $_POST['ex_id'];
        $question = $_POST['question'];
        $ans_01 = $_POST['ans_01'];
        $ans_02 = $_POST['ans_02'];
        $ans_03 = $_POST['ans_03'];
        $ans_04 = $_POST['ans_04'];
        $correct_answer = $_POST['correct_answer'];

        
        $sql2 = "INSERT INTO questions SET
            ex_id = '$ex_id',
            question = '$question',
            ans_01 = '$ans_01',
            ans_02 = '$ans_02',
            ans_03 = '$ans_03',
            ans_04 = '$ans_04',
            correct_answer = '$correct_answer'
        ";
        
        $res2 = mysqli_query($conn, $sql2);

        $sql3 = "SELECT * FROM questions ORDER BY id DESC LIMIT 1";

        $res3 = mysqli_query($conn, $sql3);
        $count3 = mysqli_num_rows($res3);

        if($count3>0){
            while($row=mysqli_fetch_assoc($res3)){
                $id = $row['id'];
            }}

            $id1 = "QUS".$id;

        $sql4 = "UPDATE questions SET q_id= '$id1' WHERE id = $id";

        $res4 = mysqli_query($conn, $sql4);

        if($res2 == true){
            header('location: ./question.php');
        }
        else
        {
            $_SESSION['q-add-error'] = "error";
            header('location: ./question.php');
        }
    }
    else{

        $_SESSION['q-add-error'] = "error";
        header('location: ./question.php');
    }
?>