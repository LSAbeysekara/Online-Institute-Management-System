<?php include('config/constant.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Login</title>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="./sweetalert.min.js"></script>
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}


form{
    height: 550px;
    width: 400px;
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
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
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
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
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

    </style>
</head>
<body>
    <form action="" method="post">
        <h3>Login Here</h3>
        
        <label for="username">Username</label>
        <input type="text" placeholder="Enter your Username" name="username" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" required>

        <button type="submit" name="submit">Log In</button>
        <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
    </form>
    <?php
        if(isset($_SESSION['login-status-02'])){ ?>
        <script>
            swal("Login Failed!", "Invalid Username or Password", "error");
        </script>
    <?php   unset($_SESSION['login-status-02']); } ?>

    <?php
        if(isset($_SESSION['login-status-03'])){ ?>
        <script>
            swal("Login Failed!", "Something went wrong!", "warning");
        </script>
    <?php   unset($_SESSION['login-status-03']); } ?>

    <?php
        if(isset($_SESSION['add-success'])){ ?>
        <script>
            swal("Successfully Registrated!", "","success");
        </script>
    <?php   unset($_SESSION['add-success']); } ?>

</body>
</html>




<?php

    if(isset($_POST['submit'])){

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM employee WHERE em_username ='$username' AND em_password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1){
            
            while($row=mysqli_fetch_assoc($res)){
                
                $em_id = $row['em_id'];
                $em_position = $row['em_position'];
            }
                if($em_position == "Admin"){       

                    $_SESSION['em_id'] = $em_id; // pass the id
                    $_SESSION['login-status-01'] = "ok";
                    header('location: index.php');

                }else{
                    
                    $_SESSION['em_id_teacher'] = $em_id; // pass the id
                    $_SESSION['login-status-01'] = "ok";
                    header('location: ../teacher/index.php');

                }
        }
        else
        {
            $_SESSION['login-status-02'] = "error";
            header('location:login.php');
        }

    }

?>

