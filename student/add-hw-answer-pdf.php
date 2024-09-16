<?php

include('../config/constant.php');

if (isset($_POST['submit'])) {
    $hw_id = $_POST['hw_id'];
    $st_id = $_POST['st_id'];

    $targetFolder = '../teacher/homework-files/' . $hw_id . '/';

    if (!file_exists($targetFolder)) {
        mkdir($targetFolder, 0777, true); 
    }

    $targetFile = $targetFolder . basename($_FILES['pdf']['name']);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $ans_content = basename($_FILES['pdf']['name']);

    if ($fileType !== 'pdf') {
        $_SESSION['hw-add-error'] = "Only PDF files are allowed.";
        header('location:./hw-view-st.php');
    } elseif (move_uploaded_file($_FILES['pdf']['tmp_name'], $targetFile)) {

        $timezone = new DateTimeZone('Asia/Colombo');
        $current_datetime = new DateTime('now', $timezone);
        $current_datetime = $current_datetime->format('Y-m-d H:i:s');


        $sql = "SELECT * FROM homework_answers WHERE hw_id = '$hw_id' AND st_id = '$st_id'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count>0)
        { 
            $sql5 = "UPDATE homework_answers SET upl_date ='$current_datetime', ans_content = '$ans_content' WHERE hw_id = '$hw_id' AND st_id = '$st_id'";
            $res5 = mysqli_query($conn, $sql5);

            if($res2 == TRUE){
                $_SESSION['ans-upload-ok'] = "ok";
                header('location:./hw-view-st.php');
            }else{
                $_SESSION['hw-add-error'] = "Error uploading the file.";
                header('location:./hw-view-st.php');
            }

        }else{

            $sql2 = "INSERT INTO homework_answers SET
                hw_id = '$hw_id',
                st_id = '$st_id',
                ans_type = 'PDF',
                upl_date = '$current_datetime',
                ans_content = '$ans_content'
            ";
            $res2 = mysqli_query($conn, $sql2);

            if($res2 == TRUE){
                $sql3 = "SELECT * FROM homework_answers ORDER BY id DESC LIMIT 1";
                $res3 = mysqli_query($conn, $sql3);
                $count3 = mysqli_num_rows($res3);

                if($count3>0){
                    while($row=mysqli_fetch_assoc($res3)){
                        $id = $row['id'];
                    }}

                    $id1 = "ANS".$id;

                $sql4 = "UPDATE homework_answers SET hw_a_id= '$id1' WHERE id = $id";

                $res4 = mysqli_query($conn, $sql4);

                if($res4 == TRUE) {
                    $_SESSION['ans-upload-ok'] = "ok";
                    header('location:./hw-view-st.php');
                }else{
                    $_SESSION['ans-upload-error'] = "error";
                    header('Location: ./hw-view-st.php');
                    exit();
                }
            }else{
                $_SESSION['hw-add-error'] = "Error uploading the file.";
                header('location:./hw-view-st.php');
            }


        }

    } else {
        $_SESSION['hw-add-error'] = "Error uploading the file.";
        header('location:./hw-view-st.php');
    }

} else {
    $_SESSION['ans-upload-error'] = "Invalid form submission.";
    header('Location: ./hw-view-st.php'); 
    exit();
}
?>
