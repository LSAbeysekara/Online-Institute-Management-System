<?php include('config/constant.php'); 

if(isset($_GET['req_id']))
    {
        //process to delete
        $req_id = $_GET['req_id'];

        //delete from database
        $sql = "DELETE FROM request WHERE req_id='$req_id'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whethtr the query exetued or not
        if($res==true)
        {
            //food dleted
            $_SESSION['req-delete-ok'] = "Ok";
            header('location:./index.php');
        }
        else
        {
            $_SESSION['req-delete-error'] = "Error";
            header('location:./index.php');
        }

        //redirect to manage food with session message
    }
    else
    {
        $_SESSION['req-delete-error'] = "Error";
        header('location:./index.php');
    }



?>