<?php include('config/constant.php') ?>

<?php
    if(isset($_POST['update']))
    {
        //get all the details from the form
        $not_id = $_POST['not_id'];
        $active = $_POST['active'];
        $not_img = $_POST['not_img'];

        //upload the image selected

        //check whether upload button is clecked or not
        if(isset($_FILES['image01']['name']))
        {
            //upload button clicked
            $image_name = $_FILES['image01']['name'];//new image;s name

            //ckeck whether the file is availabe or not
            if($image_name!="")
            {
                //image is available
                //uploading the new image

                //rename the image name
                $ext = end(explode('.',$image_name));
                $image_name = "Notifi-Name-".rand(0000, 9999).'.'.$ext; //new name of the new image

                //ge the destination path
                $src_path = $_FILES['image01']['tmp_name'];//source path
                $dest_path = "../images/notification/".$image_name;//destination path

                //upload the image
                $upload = move_uploaded_file($src_path, $dest_path);

                //check whether the image is uploaded or not
                if($upload == false)
                {
                    //failed to upload
                    $_SESSION['notifi-update_image-error'] = "<div class='error'>Failed To Upload The Image.</div></br></br>";
                    header('location: admin/index.php');
                    die();
                }

                // remove the current image if available
                if($not_img!="")
                {
                    //cureent image is available
                    //remove the image if uploaded
                    $remove_path = "../images/notification/".$not_img;
                    $remove = unlink($remove_path);

                    //check whether image is removed or not
                    if($remove == false)
                    {
                        //failed to remove current image
                        $_SESSION['notifi-update_image-error'] = "<div class='error'>Failed To Remove The Current Image.</div></br></br>";
                        header('location:'.SITEURL.'admin/notification.php');
                        die();
                    }
                }
                
            }
            else
            {
                $image_name = $not_img;
            }
        }
        else
        {
            $image_name = $not_img;
        }

        //update the food in database 
        $sql = "UPDATE notification SET
            not_img = '$image_name',
            active = '$active'
            WHERE not_id='$not_id' 
        ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query is executed or not
        
        if($res==true){
            //query executed and food updated
            $_SESSION['notifi-update_image-ok'] = "<div class='success'>Ok</div></br></br>"; 
            header('location:notification.php'); ?>
            <!-- <meta http-equiv = "refresh" content = "0; url =manage-food.php" /> -->
        <?php
        }
        else
        {
            //failed to update
            $_SESSION['notifi-update_image-error'] = "<div class='error'>Error</div></br></br>";
            header('location:index.php');
        }

        //redirect to manage food with session message 
    }
?>