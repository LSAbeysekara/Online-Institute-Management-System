<?php include('config/constant.php'); ?>





<!DOCTYPE html>
<html lang="en">
<head>
 
    <title>Login</title>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="admin/sweetalert.min.js"></script>
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

.modal {
    display: none; 
    position: fixed; 
    z-index: 9999; 
    left: 0;
    top: 10%;
    width: 100%;
    height: 100%;
    overflow: auto; 
    background-color: rgba(0, 0, 0, 0.5); 
    transition: transform 0.4s, top 0.4s;
}

.modal-content {
    background-color: var(--color-background);
    margin: 2% auto; 
    padding: 20px;
    padding-bottom: 3%;
    border: 1px solid #888;
    width: 50%; 
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}
.container {
    text-align: center;
    padding: 20px;
    background-color: #f0f0f0; 
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    max-width: 100%;
    margin: 0 auto;
}

#text {
    color: red;
    font-size: 24px;
    margin-bottom: 20px;
}

.button-container {
    display: flex;
    justify-content: center;
    margin-top: 20px; 
}

button {
    padding: 15px 30px; 
    font-size: 18px; 
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-right: 10px; 
}

#playButtonLabel {
    background-color: #28a745; 
    color: #fff;
}

#playButtonLabel:hover {
    background-color: #218838; 
}

#close {
    background-color: #dc3545; 
    color: #fff;
}

#close:hover {
    background-color: #c82333;
}

#audioPlayer {
    display: none;
}

.popm {
    display: flex; 
    justify-content: space-between; 
}

.popm a {
    display: inline-block;
    padding: 15px 30px; 
    font-size: 27px; 
    border: none;
    border-radius: 4px;
    cursor: pointer;
    height: 80px;
    transition: background-color 0.3s ease;
    text-decoration: none; 
    color: #fff; 
}

.popm a:nth-child(1) {
    background-color: #007BFF;
}

.popm a:nth-child(2) {
    background-color: #C9EA37;
}

.popm a:hover {
    filter: brightness(1.2);
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
        <br>
        <p class="link">Need to register? <a href="register_form.php">Register now</a></p>
    </form>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modalContent" class="popm">
                <div class="container">
                    <h1 id="text" style="color:red;">අපගේ සිංහල හඬ ආධාර සේවාව සමඟ ඉදිරියට යාමට ඔබට අවශ්‍යද?</h1>
                    <button onclick="closeModal()" id="playButtonLabel" for="audioPlayer">ඔව්</button>
                        <audio id="audioPlayer" controls>
                            <source src="./VA/mp3/login.mp3" type="audio/mpeg">
                        </audio>
                    <button onclick="closeModal0()" id="close">නැත</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="myModal1">
        <div class="modal-content">
        <div class="container" style="height: 40vh;">
            <h1 id="text" style="color:red; font-size: 40px;">ඔබ දැනටමත් මෙම පද්ධතියට ලියාපදිංචි වී තිබේද?</h1><br>
                <div class="popm">
                    <p><a href="./login-VA-00.php">ඔව්, දැනටමත් ලියාපදිංචි වී ඇත.</a></p>
                    <p><a href="./register-VA-00.php">ලියාපදිංචි වී නොමැත</a></p>
                </div>
            </div>
        </div>
    </div>

    <?php
        if(isset($_SESSION['login-status-02'])){ ?>
        <script>
            swal("Login Failed!", "Invalid Username or Password", "error");
        </script>
    <?php   unset($_SESSION['login-status-02']); } ?>

    <?php
        if(isset($_SESSION['add-success'])){ ?>
        <script>
            swal("Successfully Registrated!", "","success");
        </script>
    <?php   unset($_SESSION['add-success']); } ?>


    <script>
       
        var modal = document.getElementById("myModal");

        function openModal() {
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
            openModal1();
        }

        function closeModal0() {
            modal.style.display = "none";
        }

        function delayLoadContent() {
            setTimeout(openModal, 2000); 
        }

        delayLoadContent();
    </script>

    <script>
       
        function showModal() {
        document.getElementById("myModal1").style.display = "block";
        }

        function hideModal() {
        document.getElementById("myModal1").style.display = "none";
        }

        document.getElementById("playButtonLabel").addEventListener("click", function() {
        setTimeout(showModal, 8000); 
        });
    </script>

    <script>

        document.getElementById("playButtonLabel").addEventListener("click", function () {
            document.getElementById("audioPlayer").play();
        });
    </script>

</body>
</html>




<?php
    //check whether the submit button is clicked or not

    if(isset($_POST['submit'])){
        //get the data from form

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //check whether username and password exist or not

        $sql = "SELECT * FROM student WHERE st_username='$username' AND st_password='$password'";

        //Execute the query

        $res = mysqli_query($conn, $sql);

        //count rows to check whether username and password exist or not

        $count = mysqli_num_rows($res);

        if($count==1){
            
            while($row=mysqli_fetch_assoc($res)){
                //get the details of categories
                $st_id = $row['st_id'];
            }
            
                $_SESSION['st_id'] = $st_id; // pass the id
                $_SESSION['not_show'] = "1";
                $_SESSION['login-status-01'] = "ok";
                echo "<script> window.location.replace('index.php');</script>";
            
        }
        else
        {
            //user not available and login fail
            $_SESSION['login-status-02'] = "qq";
            echo "<script> window.location.replace('login.php');</script>";
        }

    }

?>


