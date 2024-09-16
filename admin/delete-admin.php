<?php 

    include('config/constant.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        
        $em_id = $_GET['id'];
        $image_name = $_GET['image_name'];

        
        if($image_name!="")
        {
            
            $path = "../images/employee/".$image_name;

            
            $remove = unlink($path);

            
            if($remove==false)
            {
                die();
            }
        }

        $sql = "DELETE FROM employee WHERE em_id='$em_id'";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['admin-delete-ok'] = "<div class='success'>OK</div></br></br>";
            header('location:./admin.php');
        }
        else
        {
            $_SESSION['admin-delete-error'] = "<div class='error'>Error</div></br></br>";
            header('location:./admin.php');
        }

    }
    else
    {
        $_SESSION['login-status-02'] = "<div class='error'>Error</div></br></br>";
        header('location:./login.php');
    }



?>