<?php include('../../config/constant.php'); ?>

<?php
    if(isset($_POST['submit'])){
        $em_id = $_POST['em_id'];
        $cl_id = $_POST['cl_id'];
        $hw_title = $_POST['title'];
        $hw_content = $_POST['content'];
        $hw_expire = $_POST['ex_date'];
        $hw_status = $_POST['hw_status'];
        $ans_type = $_POST['ans_type'];

        date_default_timezone_set('Asia/Colombo');
        
        $currentDateTime = date('Y-m-d H:i:s');
        
        $sql2 = "INSERT INTO homework SET
            cl_id = '$cl_id',
            hw_created = '$currentDateTime',
            hw_title = '$hw_title',
            hw_content = '$hw_content',
            ans_type = '$ans_type',
            hw_expire = '$hw_expire',
            hw_status = '$hw_status'
        ";
        $res2 = mysqli_query($conn, $sql2);

        $sql3 = "SELECT * FROM homework ORDER BY id DESC LIMIT 1";

        $res3 = mysqli_query($conn, $sql3);

        $count3 = mysqli_num_rows($res3);

        if($count3>0){
            while($row=mysqli_fetch_assoc($res3)){
                $id = $row['id'];
            }}

            $id1 = "HW".$id;

        $sql4 = "UPDATE homework SET hw_id= '$id1' WHERE id = $id";

        $res4 = mysqli_query($conn, $sql4);

        if($res2 == true){

            if($ans_type == 'PDF' || $ans_type == 'Image'){

                $folderPath = '../homework-files/'. $id1;

                if (!is_dir($folderPath)) {
                    if (mkdir($folderPath, 0777, true)) {

                    $_SESSION['hw-add-ok'] = "OK";
                    header('location: hw-creation.php');

                } else {

                    $_SESSION['hw-add-error'] = "error";
                    header('location: hw-creation.php');
                }
                } else {
                    $_SESSION['hw-add-error'] = "error";
                    header('location: hw-creation.php');
                }
            }

            $_SESSION['hw-add-ok'] = "OK";
            header('location: hw-creation.php');
        }
        else
        {
            $_SESSION['hw-add-error'] = "error";
            header('location: hw-creation.php');
        }
    }
    else{
        $_SESSION['hw-add-error'] = "error";
        header('location: hw-creation.php');
    }
?>