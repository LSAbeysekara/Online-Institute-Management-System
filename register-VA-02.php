<?php include('config/constant.php'); ?>

<?php

$VA = "1";

if(isset($_SESSION['VA'])){ 
  
  $VA = $_SESSION['VA'];

}?>

<?php

if(isset($_SESSION['user'])){
    $username = $_SESSION['user']; 
    
    if($username == ""){
        echo "<script> window.location.replace('register-VA-01.php');</script>";
    }else{
    } 
}
?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ලියාපදිංචි කරන්න - මුරපදය</title>
        <style>
            body{
                background-color: #f0f0f0;
                margin-bottom: 0;
            }

            .cont {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                margin-top: 0;
                display: flex;
                align-items: top;
                justify-content: center;
                min-height: 30vh;
                font: optional;
            }

            .container {
                background-color: #fff;
                border-radius: 10px;
                border: 2px solid #ccc;
                padding: 40px;
                width: 500px;
                text-align: center;
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
                font-size: 23px;
            }

            label {
                font-weight: bold;
                margin-bottom: 15px;
                display: block;
            }

            input[type="password"] {
                width: 100%;
                padding: 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-bottom: 25px;
                box-sizing: border-box;
                font-size: 23px;
            }

            input[type="submit"] {
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                padding: 15px 25px;
                cursor: pointer;
                font-weight: bold;
                transition: background-color 0.3s ease;
                font-size: 23px;
            }

            input[type="submit"]:hover {
                background-color: #0056b3;
            }

            #VA input[type="submit"] {
                max-width:250px;
                font-size: 14px;
                background-color: #dc3545;
                transition: background-color 0.3s ease;
            }

            #VA input[type="submit"]:hover {
                background-color: #c82333;
            }

            #VA-02 input[type="submit"] {
                max-width:250px;
                font-size: 14px;
                background-color: green;
                transition: background-color 0.3s ease;
            }

            #VA-02 input[type="submit"]:hover {
                background-color: #4CBB17;
            }

            #audioPlayer {
                display: none;
            }
            #playButtonLabel {
                display: inline-block;
                background-color: #f1f1f1;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
            }

            #audioPlayer01 {
                display: none;
            }
            #playButtonLabel01 {
                display: inline-block;
                background-color: #f1f1f1;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>

        <br><h1 style="font-size: 45px; text-align: center;">ලියාපදිංචි කරන්න</h1>
        
        <div class="cont">
            <div class="container">

            <?php

            if($VA != "0"){
            ?>

            <form action="#" method="post" id="VA">
                <input type="submit" name="VA" value="හඩ සහායකයා අක්‍රීය කරන්න">
            </form><br>

            <?php }else{ ?>

            <form action="#" method="post" id="VA-02">
                <input type="submit" name="VA1" value="හඩ සහායකයා සක්‍රීය කරන්න">
            </form><br>

            <?php } ?>


            <form action="#" method="post" id="UD" onsubmit="return validatePassword()">
                <p><label>මුරපදය</label></p>
                <input type="password" name="pass" id="pass" required placeholder="ඔබගේ මුරපදය ඇතුලත් කරන්න">
                <p><label>මුරපදය තහවුරු කරන්න</label></p>
                <input type="password" name="cpass" id="cpass" required placeholder="ඔබගේ මුරපදය තහවුරු කරන්න" onkeyup="checkPasswordMatch()">
                <p id="passwordMatchMessage" style="color: red;"></p>
                <input type="hidden" name="user" value="<?php echo $username; ?>">
                <p><input type="submit" name="password" id="submitBtn" value="ඉදිරියට යන්න" disabled></p>
            </form>
            </div>
        </div>
        

        <?php
        if($VA != "0"){ ?>

        <?php if(isset($_SESSION['reg-02-sin'])){ ?>
            <audio id="audioPlayer" controls autoplay>
                <source src="./VA/mp3/password-02-01.mp3" type="audio/mpeg">
            </audio>
        <?php unset($_SESSION['reg-02-sin']); }else{ ?>

        <audio id="audioPlayer01" controls>
            <source src="./VA/mp3/reg-02-02.mp3" type="audio/mpeg">
        </audio>

        <?php }} ?>

        <script>
            setTimeout(function() {
                const audioPlayer01 = document.getElementById('audioPlayer01');
                audioPlayer01.play();
            }, 2000); 
        </script>

    <script>
        function checkPasswordMatch() {
            var password = document.getElementById("pass").value;
            var confirmPassword = document.getElementById("cpass").value;
            var submitBtn = document.getElementById("submitBtn");
            var message = document.getElementById("passwordMatchMessage");

            if (password !== confirmPassword) {
                message.textContent = "මුරපද දෙක නොගැලපේ.";
                submitBtn.disabled = true;
            } else {
                message.textContent = "";
                submitBtn.disabled = false;
            }
        }
    </script>
    </body>
</html>

<?php  ?>


<?php if(isset($_POST['password'])){
    $username = $_POST['user'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    if($pass == $cpass){

        $sql = "SELECT * FROM student WHERE st_username='$username'";

       
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1){
            $username = $username.rand(0000,9999);
        }

        $_SESSION['reg-username'] = $username;
        $_SESSION['reg-password'] = $pass;
        echo "<script> window.location.replace('register-VA-03.php');</script>";

    }else{
        $_SESSION['reg-02-sin'] = "Error";
        echo "<script> window.location.replace('register-VA-02.php');</script>";
    }
}


if(isset($_POST['VA'])){
    
    $_SESSION['VA'] = "0";
    echo "<script> window.location.replace('register-VA-02.php');</script>";
    
}

if(isset($_POST['VA1'])){
    
  $_SESSION['VA'] = "1";
  echo "<script> window.location.replace('register-VA-02.php');</script>";
  
}

?>

