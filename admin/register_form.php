<?php include('reg-check.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="admin/sweetalert.min.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-image: url('./images/background-img/reg-back-02.jpg');
    background-size: cover;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 15px;
    text-align: center;
}

form{
    height: 640px;
    width: 800px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}

form table{
    padding: 0.5em;
    width: 100%;
}

form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}

input[type="file"]{
    background-color = none;
}

::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 20px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}

.link a{
    text-decoration: none;
    color: grey;
}

.success{
    color: green;
}

.error{
    color: red;
}


</style>
</head>
<body>

<div class="form-container">

<form autocomplete="off" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" id="action" value="register">
   <h3>Register Now</h3>
   <table>
      <tr>
         <td>
            <input type="text" name="st_username" required placeholder="Enter your username" id="username">
            <span id="usernameCheck"></span>
        </td>
         <td><input type="email" name="g_email" required placeholder="Enter your email"></td>
      </tr>
      <tr>
         <td><input type="password" name="pass" required placeholder="Enter your password"></td>
         <td><input type="password" name="cpass" required placeholder="confirm your password"></td>
      </tr>
      <tr>
         <td><input type="text" name="st_name" required placeholder="Enter your full name"></td>
         <td><input type="date" name="st_dob" required></td>
      </tr>
      <tr>
         <td><input type="text" name="g_name" required placeholder="Enter guardian's first name"></td>
         <td><input type="mobile_no" name="st_phone" required placeholder="Enter your mobile number"></td>
      </tr>
      <tr>
         <td colspan=2 ><input type="text" col="30" name="st_address" required placeholder="Enter your address"></td>
      </tr>
      <tr>
         <td colspan=2><button type="submit" name="submit" id="register">Register</button></td>
      </tr>
   </table>
   <p class="link">Already have an account? <a href="login.php">Login now</a></p>
</form>

</div>

</body>
</html>


    <?php if(isset($_SESSION['add-error'])){ ?>
        <script>
            swal("Registration Failed!", "Please try again!", "error");
        </script>
    <?php   unset($_SESSION['add-error']); } ?>

    <?php if(isset($_SESSION['pass-match'])){ ?>
        <script>
            swal("Registration Failed!", "Passwords don't match!", "error");
        </script>
    <?php   unset($_SESSION['pass-match']); } ?>



<?php
if(isset($_POST['submit'])){

$st_username = $_POST['st_username'];
$g_email = $_POST['g_email'];
$pass = md5($_POST['pass']);
$cpass = md5($_POST['cpass']);
$st_name = $_POST['st_name'];
$st_dob = $_POST['st_dob'];
$st_address = $_POST['st_address'];
$st_phone = $_POST['st_phone'];
$g_name = $_POST['g_name'];

if(isset($_FILES['image']['name'])){
    //get the details of the selected image
    $image_name = $_FILES['image']['name'];

    //check whether the image is selected or not and upload image only if slected
    if($image_name!=""){
        //image is selected
        //rename the image 
        //get the extension selected(lpg, png, jpeg, etc.)
        $ext = end(explode('.', $image_name));

        //create new name for image
        $image_name = "Student-Name-".rand(0000,9999).".".$ext; //new image name

        //upload the image
        //get the source path and destination path

        //source path is the current location of the image
        $src = $_FILES['image']['tmp_name'];

        //Destination path for the image to be uploaded
        $dst = "./images/profile-pic/".$image_name;

        //finaly upload the food image
        $upload = move_uploaded_file($src, $dst);

        //check whether image uploaded or not
        if($upload == false)
        {
            //failed to upload the image
            //redirect to add food page with message
            
            //stop the process
            die();
        }
    }
}
else
{
    $image_name = ""; //selected defalut value as blank
}

if($cpass == $pass){

    date_default_timezone_set('Asia/Colombo');
    $cdate = date('y-m-d');

    $st_age = date_diff(date_create($st_dob), date_create($cdate));
    $st_age1 = $st_age ->format("%y");

    $sql = " SELECT * FROM student WHERE st_username = '$st_username' && st_password = '$pass' ";

    $res = mysqli_query($conn, $sql);

      $insert = "INSERT INTO student(st_username, g_email, st_password, st_name, st_dob, st_age, st_address, st_img, st_phone, g_name, status) VALUES('$st_username','$g_email','$pass', '$st_name','$st_dob','$st_age1','$st_address', '$image_name','$st_phone','$g_name','Active')";
      mysqli_query($conn, $insert);

        $sql3 = "SELECT * FROM student ORDER BY id DESC LIMIT 1";

        //execute the query
        $res3 = mysqli_query($conn, $sql3);

        //count the rows to check whether we have foods or not
        $count3 = mysqli_num_rows($res3);

        if($count3>0){
            //we have food in database
            //get the foods from database and display
            while($row=mysqli_fetch_assoc($res3)){
                //get the value from individual columns
                $id = $row['id'];
            }};
         
            $id1 = "S".$id;

            $sql4 = "UPDATE student SET st_id= '$id1' WHERE id = $id";

             $res4 = mysqli_query($conn, $sql4);

            if($res4 == true){
            //data inserted successfully
                 $_SESSION['add-success'] = "Ok";
                 echo "<script> window.location.replace('login.php');</script>";
             ?>
             <?php
             }
             else
            {
               $_SESSION['add-error'] = "error";
               echo "<script> window.location.replace('register_form.php');</script>";
               die();
              
             }

}else{
    $_SESSION['pass-match'] = "error";
    echo "<script> window.location.replace('register_form.php');</script>";
}
}
?>

    



<script type="text/javascript">
    $(document).ready(function(){
        $('#username').blur(function(){
            var username = $(this).val();

            $.ajax({
                url:'reg-check.php',
                method: "POST",
                data: {user_name: username},
                success: function(data){
                    if(data != 0)
                    {
                        $('#usernameCheck').html('<span class="error">User Already Exists.</span>');
                        $('#register').attr("disabled", true);
                    }
                    else
                    {
                        $('#usernameCheck').html('<span class="success">Username available</span>');
                        $('#register').attr("disabled", false);
                    }
                }
            
        })
    });
});
</script>