<?php include('config/constant.php') ?>

<?php
    if(isset($_POST['update']))
    {
        //get all the details from the form
        $em_id = $_POST['em_id'];
        $em_name = $_POST['name'];
        $em_dob = $_POST['date'];
        $em_address = $_POST['address'];
        $em_email = $_POST['email'];
        $em_phone = $_POST['mobile'];

        //initialize image name to current image
        $image_name = $_POST['current_image'];

        //upload the image selected

        //check whether upload button is clicked or not
        if(isset($_FILES['pic']['name']))
        {
            //upload button clicked
            $new_image_name = $_FILES['pic']['name'];//new image's name

            //check whether the file is available or not
            if($new_image_name!="")
            {
                //image is available
                //uploading the new image

                //rename the image name
                $ext = end(explode('.',$new_image_name));
                $image_name = "Admin-Name-".rand(0000, 9999).'.'.$ext; //new name of the new image

                //get the destination path
                $src_path = $_FILES['pic']['tmp_name'];//source path
                $dest_path = "../images/employee/".$image_name;//destination path

                //upload the image
                $upload = move_uploaded_file($src_path, $dest_path);

                //check whether the image is uploaded or not
                if($upload == false)
                {
                    //failed to upload
                    $_SESSION['update_image-error'] = "<div class='error'>Failed To Upload The Image.</div></br></br>";
                    header('location: ./profile.php');
                    die();
                }
            }
        }

        // Only update the image if a new one was uploaded
        $update_img_sql = "";
        if ($image_name != $_POST['current_image']) {
            $update_img_sql = "em_img = '$image_name',";
        }

        //update the employee details in the database 
        $sql = "UPDATE employee SET
                em_name = '$em_name',
                em_dob = '$em_dob',
                em_address = '$em_address',
                $update_img_sql
                em_email = '$em_email',
                em_phone = '$em_phone'
                WHERE em_id='$em_id' 
            ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query is executed successfully or not
        if($res==true){
            //query executed and details updated
            $_SESSION['admin-update-ok'] = "<div class='success'>Employee details updated successfully.</div></br></br>"; 
            header('location:profile.php');
        }
        else
        {
            //failed to update
            $_SESSION['admin-update-error'] = "<div class='error'>Error updating employee details.</div></br></br>";
            header('location:profile.php');
        }
    }
?>
