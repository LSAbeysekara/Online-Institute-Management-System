<?php

include('../config/constant.php');

if (isset($_POST['submit'])) {

    $hw_id = $_POST['hw_id'];
    $st_id = $_POST['st_id'];
    $ans_content = $_FILES["submit_image"]["name"];

    $targetFolder = '../teacher/homework-files/' . $hw_id . '/';

    if (!file_exists($targetFolder)) {
        mkdir($targetFolder, 0777, true); 
    }

    $targetFile = $targetFolder . basename($_FILES['submit_image']['name']);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedExtensions = array('jpg', 'jpeg', 'png');

    if (!in_array($fileType, $allowedExtensions)) {
        $_SESSION['file-type-error'] = "error";
        header('location:./hw-view-st.php');
        exit();

    } elseif (move_uploaded_file($_FILES['submit_image']['tmp_name'], $targetFile)) {

        $sql = "SELECT * FROM homework_answers WHERE hw_id = '$hw_id' AND st_id = '$st_id'";

        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res)){
                $hw_a_id = $row['hw_a_id'];
            }

            $sql2 = "UPDATE homework_answers SET
            ans_content = '$ans_content'
            WHERE hw_a_id='$hw_a_id' 
            ";
            $res2 = mysqli_query($conn, $sql2);

            if($res2 == TRUE) {
                $_SESSION['ans-upload-ok'] = "ok";
                header('location:./hw-view-st.php');
            }else{
                $_SESSION['ans-upload-error'] = "error";
                header('Location: ./hw-view-st.php');
                exit();
            }

        }else{
            $sql2 = "INSERT INTO homework_answers SET
            hw_id = '$hw_id',
            st_id = '$st_id',
            ans_type = 'Image',
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
                $_SESSION['ans-upload-error'] = "error";
                header('Location: ./hw-view-st.php');
                exit();
            }

        }

    } else {
        $_SESSION['ans-upload-error'] = "error";
        header('Location: ./hw-view-st.php');
        exit();

    }
}
?>
