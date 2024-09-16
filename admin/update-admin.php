<?php include('config/constant.php') ?>

<?php
    if(isset($_POST['update']))
    {
        //get all the details from the form
        $em_id = $_POST['em_id'];
        $em_username = $_POST['username'];
        $em_name = $_POST['name'];
        $opass = md5($_POST['opass']);
        $pass = md5($_POST['pass']);
        $cpass = md5($_POST['cpass']);
        $em_dob = $_POST['dob'];
        $em_address = $_POST['address'];
        $em_img = $_POST['em_img'];
        $em_email = $_POST['email'];
        $em_phone = $_POST['mobile'];
        $status = $_POST['status'];

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
                $image_name = "Class-Name-".rand(0000, 9999).'.'.$ext; //new name of the new image

                //ge the destination path
                $src_path = $_FILES['image01']['tmp_name'];//source path
                $dest_path = "../images/employee/".$image_name;//destination path

                //upload the image
                $upload = move_uploaded_file($src_path, $dest_path);

                //check whether the image is uploaded or not
                if($upload == false)
                {
                    //failed to upload
                    $_SESSION['update_image-error'] = "<div class='error'>Failed To Upload The Image.</div></br></br>";
                    header('location: admin/admin.php');
                    die();
                }

                // remove the current image if available
                if($em_img!="")
                {
                    //cureent image is available
                    //remove the image if uploaded
                    $remove_path = "../images/employee/".$em_img;
                    $remove = unlink($remove_path);

                    //check whether image is removed or not
                    if($remove == false)
                    {
                        //failed to remove current image
                        $_SESSION['update_image-error'] = "<div class='error'>Failed To Remove The Current Image.</div></br></br>";
                        header('location:'.SITEURL.'admin/admin.php');
                        die();
                    }
                }
                
            }
            else
            {
                $image_name = $em_img;
            }
        }
        else
        {
            $image_name = $em_img;
        }

        //============================================== check passwords================================

        if($opass!=="" && $pass!=="" && $cpass!==""){

            $sql = "SELECT * FROM employee WHERE em_id = '$em_id'";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //count the rows to check whether we have foods or not
            $count = mysqli_num_rows($res);

            if($count>0){
                //we have food in database
                //get the foods from database and display
                while($row=mysqli_fetch_assoc($res)){
                    //get the value from individual columns
                    $current_password = $row['em_password'];
                }
            }

            if($opass == $current_password){
                
                
                if($pass == $cpass){

                    //update the food in database 
                        $sql2 = "UPDATE employee SET
                        em_username = '$em_username',
                        em_name = '$em_name',
                        em_dob = '$em_dob',
                        em_address = '$em_address',
                        em_img = '$em_img',
                        em_password = '$pass',
                        em_email = '$em_email',
                        em_phone = '$em_phone',
                        status = '$status'
                        WHERE em_id='$em_id' 
                    ";

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether the query is executed or not
                    
                    if($res2==true){
                        //query executed and food updated
                        $_SESSION['admin-update-ok'] = "<div class='success'>Ok</div></br></br>"; 
                        header('location:admin.php'); ?>
                    <?php
                    }
                    else
                    {
                        //failed to update
                        $_SESSION['admin-update-error'] = "<div class='error'>Error</div></br></br>";
                        header('location:admin.php');
                    }

                }else{
                    $_SESSION['admin-pass-error'] = "<div class='error'>Error</div></br></br>";
                    header('location:admin.php');
                }
            }

        }else if($opass=="" && $pass=="" && $cpass==""){
            
                //update the food in database 
                $sql2 = "UPDATE employee SET
                em_username = '$em_username',
                em_name = '$em_name',
                em_dob = '$em_dob',
                em_address = '$em_address',
                em_img = '$em_img',
                em_email = '$em_email',
                em_phone = '$em_phone',
                status = '$status'
                WHERE em_id='$em_id' 
            ";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //check whether the query is executed or not

            if($res2==true){
                //query executed and food updated
                $_SESSION['admin-update-ok'] = "<div class='success'>Ok</div></br></br>"; 
                header('location:admin.php');

            }
        }else{
            $_SESSION['admin-pass-error-02'] = "<div class='error'>Error</div></br></br>";
            header('location:admin.php');
        }
                        //redirect to manage food with session message 
    }
?>