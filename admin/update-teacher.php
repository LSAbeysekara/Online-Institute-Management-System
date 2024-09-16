<?php include('config/constant.php') ?>

<?php
    if(isset($_POST['update']))
    {
        $em_id = $_POST['em_id'];

        $name = $_POST['name'];
        $date = $_POST['date'];
        $address = $_POST['address'];
        $image = $_POST['image'];
        $time_table = $_POST['time-table'];
        $qualification = $_POST['qualification'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $status = $_POST['status'];

        if(isset($_FILES['image01']['name']))
        {
            $image_name01 = $_FILES['image01']['name'];

            if($image_name01!="")
            {
                $ext = end(explode('.',$image_name01));
                $image_name01 = "Teacher-Name-".rand(0000, 9999).'.'.$ext;

                //ge the destination path
                $src_path = $_FILES['image01']['tmp_name'];//source path
                $dest_path = "../images/employee/".$image_name01;//destination path

                //upload the image
                $upload = move_uploaded_file($src_path, $dest_path);

                //check whether the image is uploaded or not
                if($upload == false)
                {
                    //failed to upload
                    $_SESSION['update_image-error'] = "<div class='error'>Failed To Upload The Image.</div></br></br>";
                    header('location: ./teacher.php');
                    die();
                }

                // remove the current image if available
                if($image!="")
                {
                    $remove_path = "../images/employee/".$image;
                    $remove = unlink($remove_path);

                    //check whether image is removed or not
                    if($remove == false)
                    {
                        //failed to remove current image
                        $_SESSION['update_image-error'] = "<div class='error'>Failed To Remove The Current Image.</div></br></br>";
                        header('location: ./teacher.php');
                        die();
                    }
                }
                
            }
            else
            {
                $image_name01 = $image;
            }
        }
        else
        {
            $image_name01 = $image;
        }


        if(isset($_FILES['time-table01']['name']))
        {
            $image_name = $_FILES['time-table01']['name'];

            if($image_name!="")
            {
                $ext = end(explode('.',$image_name));
                $image_name02 = "Time-Table-".rand(0000, 9999).'.'.$ext;

                //ge the destination path
                $src_path = $_FILES['time-table01']['tmp_name'];//source path
                $dest_path = "../images/Time-table/".$image_name02;//destination path

                //upload the image
                $upload = move_uploaded_file($src_path, $dest_path);

                //check whether the image is uploaded or not
                if($upload == false)
                {
                    //failed to upload
                    $_SESSION['update_image-error'] = "<div class='error'>Failed To Upload The Image.</div></br></br>";
                    header('location: ./teacher.php');
                    die();
                }

                // remove the current image if available
                if($time_table!="")
                {
                    $remove_path = "../images/Time-table/".$time_table;
                    $remove = unlink($remove_path);

                    //check whether image is removed or not
                    if($remove == false)
                    {
                        //failed to remove current image
                        $_SESSION['update_image-error'] = "<div class='error'>Failed To Remove The Current Image.</div></br></br>";
                        header('location: ./teacher.php');
                        die();
                    }
                }
                
            }
            else
            {
                $image_name02 = $time_table;
            }
        }
        else
        {
            $image_name02 = $time_table;
        }


        $sql = "UPDATE employee SET
            em_name = '$name',
            em_dob = '$date',
            em_img = '$image_name01',
            em_tt = '$image_name02',
            em_address = '$address',
            em_qualification = '$qualification',
            em_email = '$email',
            em_phone = '$mobile',
            status = '$status',
            status = '$status'
            WHERE em_id= '$em_id' 
        ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query is executed or not
        
        if($res==true){
            //query executed and food updated
            $_SESSION['t-update-all-ok'] = "<div class='success'>Ok</div></br></br>"; 
            header('location:teacher.php'); ?>
            <!-- <meta http-equiv = "refresh" content = "0; url =manage-food.php" /> -->
        <?php
        }
        else
        {
            //failed to update
            $_SESSION['t-update-all-error'] = "<div class='error'>Error</div></br></br>";
            header('location:teacher.php');
        }

        //redirect to manage food with session message 
    }
    else{
        $_SESSION['t-update-error'] = "<div class='error'>Error</div></br></br>";
        header('location:teacher.php');
    }
?>