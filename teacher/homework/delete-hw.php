<?php include('../../config/constant.php'); 

if(isset($_GET['hw_id']))
    {
        $sql3 = "SELECT * FROM homework WHERE hw_id='$hw_id'";

        $res3 = mysqli_query($conn, $sql3);

        $count3 = mysqli_num_rows($res3);

        if($count3>0){

            while($row=mysqli_fetch_assoc($res)){
                $ans_type = $row['ans_type'];
            }}

        $hw_id = $_GET['hw_id'];

        $sql = "DELETE FROM homework WHERE hw_id='$hw_id'";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            if($ans_type=='PDF' || $ans_type=='Image'){

                $folderPath = '../homework-files/'. $hw_id;

                if (is_dir($folderPath)) {
                    if (rmdir($folderPath)) {
                        $_SESSION['hw-delete-ok'] = "ok";
                        header('location:./hw-creation.php');
                    } else {
                        $_SESSION['hw-delete-error'] = "error";
                        header('location:./hw-creation.php');
                    }
                }
            
            }else{
                $_SESSION['hw-delete-ok'] = "ok";
                header('location:./hw-creation.php');
            }

        }else{
            $_SESSION['hw-delete-error'] = "error";
            header('location:./hw-creation.php');
        }
    }
    else
    {
        $_SESSION['hw-delete-error'] = "error";
        header('location:./hw-creation.php');
    }



?>

