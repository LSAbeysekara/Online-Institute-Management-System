<?php include('config/constant.php'); ?>

<?php

$VA = "1";

if(isset($_SESSION['VA'])){ 
  
  $VA = $_SESSION['VA'];

}?>

<?php

if(isset($_SESSION['user-login'])){ 
    $username = $_SESSION['user-login']; 
    
    if($username == ""){
        echo "<script> window.location.replace('login-VA-01.php');</script>";
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Username</title>
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

            #popup {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                padding: 20px;
                border: 1px solid #ccc;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                z-index: 9999;
            }
        </style>
    </head>
    <body>
        <br><h1 style="font-size: 45px; text-align: center;">පද්ධතියට ඇතුලත් වන්න</h1>
        
        <div class="cont">

            <div class="container">
                <?php
                
                if($VA != "0"){
                ?>
        
                <form action="#" method="post" id="VA">
                    <input type="submit" name="VA" value="හඩ සහායකයා අක්‍රීය කරන්න">
                </form>
                
                <?php }else{ ?>
        
                <form action="#" method="post" id="VA-02">
                    <input type="submit" name="VA1" value="හඩ සහායකයා සක්‍රීය කරන්න">
                </form>
        
                <?php } ?>

                <form action="#" method="post">
                    <p><label>මුරපදය</label></p>
                    <input type="password" name="password" required placeholder="ඔබගේ මුරපදය ඇතුලත් කරන්න">
                    <input type="hidden" name="user" value="<?php echo $username; ?>">
                    <input type="submit" name="pass" value="ඉදිරියට යන්න">
                </form>

                <?php
                if($VA != "0"){ ?>
                    <audio id="audioPlayer" controls>
                        <source src="./VA/mp3/login-02-01.mp3" type="audio/mpeg">
                    </audio>
                <?php } ?>
            </div>
        </div>

        <script>
            setTimeout(function() {
                const audioPlayer = document.getElementById('audioPlayer');
                audioPlayer.play();
            }, 2000); 
        </script>
        
    </body>
</html>

<?php
}else{
    header('Location: login-VA-01.php');
}
?>


<?php if(isset($_POST['pass'])){
    $username = $_POST['user'];
    $password = md5($_POST['password']);

    

    $sql = "SELECT * FROM student WHERE st_username='$username' AND st_password='$password'";

  

    $res = mysqli_query($conn, $sql);

  

    $count = mysqli_num_rows($res);

    if($count==1){
        
        while($row=mysqli_fetch_assoc($res)){
            
            $st_id = $row['st_id'];
            $VA = $row['VA'];
        }
            if($VA == '0'){
        
            $sql2 = "UPDATE student SET VA = '1' WHERE st_id='$st_id'";

            $res2 = mysqli_query($conn, $sql2);
            }
        
            $_SESSION['st_id'] = $st_id; 
            $_SESSION['not_show'] = "1";
            $_SESSION['login-status-01-sin'] = "ok";
            $_SESSION['login-teacher-sin'] = "ok";
            $_SESSION['login-cls-sin'] = "ok";
            echo "<script> window.location.replace('index.php');</script>";
            
    }
    else
    {
        $_SESSION['login-status-02-sin'] = "Error";
        echo "<script> window.location.replace('login-VA-01.php');</script>";
    }
}
?>

<?php

if(isset($_POST['VA'])){
    
    $_SESSION['VA'] = "0";
    echo "<script> window.location.replace('login-VA-02.php');</script>";
    
}

if(isset($_POST['VA1'])){
    
  $_SESSION['VA'] = "1";
  echo "<script> window.location.replace('login-VA-02.php');</script>";
  
}
?>