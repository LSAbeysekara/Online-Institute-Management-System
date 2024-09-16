<?php include('../config/constant.php'); ?>

<?php
    if(isset($_POST['submit'])){
        $st_id = $_POST['st_id'];
        $hw_id = $_POST['hw_id'];
        $ans_content = $_POST['content'];

        $sql = "SELECT * FROM homework_answers WHERE hw_id = '$hw_id' AND st_id = '$st_id'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        
        if($count>0)
        { 
            $sql5 = "UPDATE homework_answers SET ans_content = '$ans_content' WHERE hw_id = '$hw_id' AND st_id = '$st_id'";
            $res5 = mysqli_query($conn, $sql5);

            if($res2 == TRUE){
                $_SESSION['ans-upload-ok'] = "ok";
                header('location:./hw-view-st.php');
            }else{
                $_SESSION['hw-add-error'] = "Error uploading the file.";
                header('location:./hw-view-st.php');
            }

        }else{

            $timezone = new DateTimeZone('Asia/Colombo');
            $current_datetime = new DateTime('now', $timezone);
            $current_datetime = $current_datetime->format('Y-m-d H:i:s');


            $sql2 = "INSERT INTO homework_answers SET
                hw_id = '$hw_id',
                st_id = '$st_id',
                ans_type = 'Text',
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

    }
    else{
        $_SESSION['hw-add-error'] = "error";
        header('location: hw-creation.php');
    }
?>