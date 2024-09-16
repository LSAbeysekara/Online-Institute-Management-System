<?php include('../config/constant.php') ?>

<?php
    if(isset($_POST['submit'])){
        $em_username = $_POST['username'];
        $em_name = $_POST['name'];
        $em_password = md5($_POST['pass']);
        $cpass = md5($_POST['cpass']);
        $em_dob = $_POST['date'];
        $em_address = $_POST['address'];
        $em_email = $_POST['email'];
        $em_mobile = $_POST['mobile'];
        $status = $_POST['status'];
        if(isset($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];
            if($image_name!=""){
                $ext = end(explode('.', $image_name));

                $image_name = "Admin-Name-".rand(0000,9999).".".$ext; 

                $src = $_FILES['image']['tmp_name'];

                $dst = "../images/employee/".$image_name;

                $upload = move_uploaded_file($src, $dst);

                if($upload == false)
                {
                    die();
                }
            }
        }
        else
        {
            $image_name = ""; 
        }

        $sql5 = "SELECT * FROM employee WHERE em_username = '$em_username'";

        $res5 = mysqli_query($conn, $sql5);

        $count5 = mysqli_num_rows($res5);

        if($count5>0){
            
            $_SESSION['admin-add-user-error'] = "error";
            header('location: admin.php');
        
        }
        else{

        
            if($em_password==$cpass){
                $sql2 = "INSERT INTO employee SET
                    em_username = '$em_username',
                    em_name = '$em_name',
                    em_dob = '$em_dob',
                    em_address = '$em_address',
                    em_img = '$image_name',
                    em_password = '$em_password',
                    em_email = '$em_email',
                    em_phone = '$em_mobile',
                    em_position = 'Admin',
                    status = '$status'
                ";
                $res2 = mysqli_query($conn, $sql2);

                $sql3 = "SELECT * FROM employee ORDER BY id DESC LIMIT 1";

                $res3 = mysqli_query($conn, $sql3);

                $count3 = mysqli_num_rows($res3);

                if($count3>0){
                    
                    while($row=mysqli_fetch_assoc($res3)){
                        
                        $id = $row['id'];
                    }}

                    $id1 = "E".$id;

                $sql4 = "UPDATE employee SET em_id= '$id1' WHERE id = $id";

                $res4 = mysqli_query($conn, $sql4);

                if($res2 == true){

                    if($res4 == true){
                    $_SESSION['add'] = "<div class='success'>Added Successfully.</div></br></br>";
                    header('location: admin.php');

                    }else{
                        $_SESSION['add-error'] = "error";
                        header('location: admin.php');
                    }
                    ?>
                <?php
                }
                else
                {
                    $_SESSION['add-error'] = "error";
                    header('location: admin.php');
                    
                }
            }else{
                
                $_SESSION['add-error'] = "error";
                header('location: admin.php');
            }
        }
    }
?>