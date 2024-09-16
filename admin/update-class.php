<?php include('config/constant.php') ?>

<?php
    if(isset($_POST['update']))
    {
        $cl_id = $_POST['cl_id'];
        $cl_title = $_POST['title'];
        $cl_description = $_POST['description'];
        $cl_grade = $_POST['grade'];
        $cl_fee = $_POST['cl_fee'];
        $em_id = $_POST['em_id'];
        $cl_day = $_POST['day'];
        $cl_time = $_POST['time'];
        $cl_duration = $_POST['duration'];
        $cl_lan = $_POST['language'];
        $cl_status = $_POST['status'];
        $cl_img = $_POST['cl_img'];

        if(isset($_FILES['image01']['name']))
        {
            $image_name = $_FILES['image01']['name'];

            if($image_name!="")
            {
                $ext = end(explode('.',$image_name));
                $image_name = "Class-Name-".rand(0000, 9999).'.'.$ext;

                //ge the destination path
                $src_path = $_FILES['image01']['tmp_name'];//source path
                $dest_path = "../images/class/".$image_name;//destination path

                //upload the image
                $upload = move_uploaded_file($src_path, $dest_path);

                //check whether the image is uploaded or not
                if($upload == false)
                {
                    //failed to upload
                    $_SESSION['update_image-error'] = "<div class='error'>Failed To Upload The Image.</div></br></br>";
                    header('location: admin/class.php');
                    die();
                }

                // remove the current image if available
                if($cl_img!="")
                {
                    //cureent image is available
                    //remove the image if uploaded
                    $remove_path = "../images/class/".$cl_img;
                    $remove = unlink($remove_path);

                    //check whether image is removed or not
                    if($remove == false)
                    {
                        //failed to remove current image
                        $_SESSION['update_image-error'] = "<div class='error'>Failed To Remove The Current Image.</div></br></br>";
                        header('location:'.SITEURL.'admin/class.php');
                        die();
                    }
                }
                
            }
            else
            {
                $image_name = $cl_img;
            }
        }
        else
        {
            $image_name = $cl_img;
        }

        $sql = "UPDATE class SET
            cl_title = '$cl_title',
            cl_description = '$cl_description',
            cl_status = '$cl_status',
            cl_grade = '$cl_grade',
            cl_fee = '$cl_fee',
            cl_img = '$image_name',
            em_id = '$em_id',
            cl_duration = '$cl_duration',
            cl_time = '$cl_time',
            cl_day = '$cl_day',
            cl_lan = '$cl_lan'
            WHERE cl_id='$cl_id' 
        ";

        $res = mysqli_query($conn, $sql);

        
        if($res==true){

            $sql2 = "UPDATE teacher_enroll SET
                    em_id = '$em_id'
                    WHERE cl_id='$cl_id' 
                    ";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            if($res2 == true){
                $_SESSION['update_image-ok'] = "<div class='success'>Ok</div></br></br>"; 
                header('location:class.php');
            } else{
                $_SESSION['update_image-error'] = "<div class='error'>Error</div></br></br>";
                header('location:class.php');
            }
            
            ?>
            <!-- <meta http-equiv = "refresh" content = "0; url =manage-food.php" /> -->
        <?php
        }
        else
        {
            //failed to update
            $_SESSION['update_image-error'] = "<div class='error'>Error</div></br></br>";
            header('location:class.php');
        }

    }
?>