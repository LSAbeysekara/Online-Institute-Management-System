<?php 
    include('config/constant.php');
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $not_id = $_GET['id'];
        $image_name = $_GET['image_name'];
        if($image_name!="")
        {
            $path = "../images/notification/".$image_name;
            $remove = unlink($path);

            if($remove==false)
            {
                die();
            }
        }

        $sql = "DELETE FROM notification WHERE not_id='$not_id'";

        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            $_SESSION['notifi-delete-ok'] = "<div class='success'>Drink Deleted Successfully.</div></br></br>";
            header('location:./notification.php');
        }
        else
        {
            $_SESSION['notifi-delete-error'] = "<div class='error'>Failed To Delete Drink.</div></br></br>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    }
    else
    {
        $_SESSION['notifi-delete-error'] = "<div class='error'>Unauthorized Access.</div></br></br>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }



?>