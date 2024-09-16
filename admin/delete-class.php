<?php 
    include('config/constant.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $cl_id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name!="")
        {
            
            $path = "../images/class/".$image_name;

            
            $remove = unlink($path);
            
            if($remove==false)
            {
                die();
            }
        }
        $sql = "DELETE FROM class WHERE cl_id='$cl_id'";
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Drink Deleted Successfully.</div></br></br>";
            header('location:./class.php');
        }
        else
        {
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    }
    else
    {
        header('location:'.SITEURL.'admin/manage-food.php');
    }



?>