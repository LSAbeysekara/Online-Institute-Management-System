<?php 
    include('config/constant.php');
    if(isset($_GET['id']))
    {
        $em_id = $_GET['id'];
        $sql = "DELETE FROM employee WHERE em_id='$em_id'";
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            $_SESSION['delete-teacher-ok'] = "<div class='success'>Deleted Successfully.</div></br></br>";
            header('location:./teacher.php');
        }
        else
        {
            $_SESSION['delete-teacher-error'] = "<div class='success'>Error</div></br></br>";
            header('location:./teacher.php');
        }

    }
    else
    {
        $_SESSION['delete-teacher-error'] = "<div class='success'>Error</div></br></br>";
        header('location:./teacher.php');
    }



?>