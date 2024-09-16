<?php include('../config/constant.php'); 

if(isset($_GET['ano_id']))
    {
       
        $ano_id = $_GET['ano_id'];

        $sql = "DELETE FROM announcement WHERE ano_id='$ano_id'";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['ano-delete-ok'] = "ok";
            header('location:./class-view.php');
        }
        else
        {
            $_SESSION['ano-delete-error'] = "error";
            header('location:./class-view.php');
        }

    }
    else
    {
        $_SESSION['ano-delete-error'] = "error";
        header('location:./class-view.php');
    }



?>

