<?php include('../../config/constant.php'); 

if(isset($_GET['ex_id']))
    {
        $ex_id = $_GET['ex_id'];

        $sql = "DELETE FROM exams WHERE ex_id='$ex_id'";

        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            $sql2 = "DELETE FROM questions WHERE ex_id='$ex_id'";
            $res2 = mysqli_query($conn, $sql2);

            if($res2 == true){
                $_SESSION['ex-delete-ok'] = "ok";
                header('location:./index.php');
                
            }else{
                $_SESSION['ex-delete-error'] = "error";
                header('location:./index.php');
            }
            
        }
        else
        {
            $_SESSION['ex-delete-error'] = "error";
            header('location:./index.php');
        }
    }
    else
    {
        $_SESSION['ex-delete-error'] = "error";
        header('location:./index.php');
    }



?>

