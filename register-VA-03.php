<?php include('config/constant.php'); ?>

<?php

$VA = "1";

if(isset($_SESSION['VA'])){ 
  
  $VA = $_SESSION['VA'];

}?>

<?php

if (isset($_SESSION['reg-username']) && isset($_SESSION['reg-password'])) {
    
    $username = $_SESSION['reg-username'];
    $password = $_SESSION['reg-password']; ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ලියාපදිංචි කරන්න - වයස</title>
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
                width: 70%;
                text-align: center;
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
                font-size: 23px;
            }

            label {
                font-weight: bold;
                margin-bottom: 15px;
                display: block;
            }

            input[type="number"] {
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

            .cube-container {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                grid-gap: 10px;
                justify-content: center;
                align-items: center;
            }

            .cube {
                max-width: 100px;
                max-height: 100px;
                background-color: #007bff;
                color: white;
                font-size: 24px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 10px;
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body>

        <br><h1 style="font-size: 45px; text-align: center;">ලියාපදිංචි කරන්න</h1>
        
        <div class="cont">

            <div class="container">
                <?php
                if ($VA != "0") {
                ?>
                <form action="#" method="post" id="VA">
                    <input type="submit" name="VA" value="හඩ සහායකයා අක්‍රීය කරන්න">
                </form><br>
                <?php
                } else {
                ?>
                <form action="#" method="post" id="VA-02">
                    <input type="submit" name="VA1" value="හඩ සහායකයා සක්‍රීය කරන්න">
                </form><br>
                <?php
                }
                ?>
            
                <p><label>පන්ති සදහා සහභාගී වන්නාගේ වයස ඇතුලත් කරන්න.</label></p>
                <div class="cube-container">
                    <?php
                    for ($i = 4; $i <= 18; $i++) { ?>
                        <div class="cube">
                            <form action="#" method="post">
                                <input type="submit" value="<?php echo $i; ?>" name="age1">
                                <input type="hidden" value="<?php echo $username; ?>" name="username">
                                <input type="hidden" value="<?php echo $password; ?>" name="password">
                            </form>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="cube">
                        <form action="#" method="post">
                            <input type="submit" value="<?php echo "Adult"; ?>" name="age1">
                            <input type="hidden" value="<?php echo $username; ?>" name="username">
                            <input type="hidden" value="<?php echo $password; ?>" name="password">
                        </form>
                    </div>
                </div>

                <?php
                if ($VA != "0") {
                ?>
                <?php if (isset($_SESSION['reg-03-sin'])) { ?>
                <audio id="audioPlayer" controls autoplay>
                    <source src="./VA/mp3/login-VA-01-02.mp3" type="audio/mpeg">
                </audio>
                <?php unset($_SESSION['reg-03-sin']); } else { ?>

                    <audio id="audioPlayer" controls autoplay>
                        <source src="./VA/mp3/register-03-01.mp3" type="audio/mpeg">
                    </audio>
                <?php }} ?>
            </div>
        </div>

        <script>
            document.getElementById("audioPlayer").addEventListener("load", function () {
                setTimeout(function () {
                    document.getElementById("audioPlayer").play();
                }, 2000);
            });
        </script>

        <script>
            function startSpeechRecognition() {
            const speechInput = document.getElementById('speechInput');

            
            if ('webkitSpeechRecognition' in window) {
                const recognition = new webkitSpeechRecognition();

                recognition.lang = 'si-LK';

                recognition.onresult = function(event) {
                const speechResult = event.results[0][0].transcript;
                speechInput.value = speechResult;
                };

                setTimeout(function() {
                recognition.start();
                }, 3000);
            } else {
                alert('Your browser does not support speech recognition.');
            }
            }

            setTimeout(function() {
            startSpeechRecognition();
            }, 3000);
        </script>
    </body>
</html>

<?php
}
?>


<?php if(isset($_POST['age1'])){
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $age = $_POST['age1'];

    if($age == "Adult"){
        $age = 0;
    }

    date_default_timezone_set('Asia/Colombo');
    $currentDateTime = new DateTime();
    $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

    $pass1 = md5($pass);

    if($age != ""){

        $sql5 = "SELECT * FROM student WHERE st_username='$username'";

        
        $res5 = mysqli_query($conn, $sql5);

        $count5 = mysqli_num_rows($res5);

        if($count5==1){
            $username = $username.rand(000,999);
        }
        

        $insert = "INSERT INTO student(st_username, st_password, st_age, VA, reg_date,status) VALUES('$username','$pass1', '$age', '1', '$formattedDateTime','Active')";
        
        mysqli_query($conn, $insert);

        $sql3 = "SELECT * FROM student ORDER BY id DESC LIMIT 1";

        
        $res3 = mysqli_query($conn, $sql3);

        $count3 = mysqli_num_rows($res3);

        if($count3>0){
           
            while($row=mysqli_fetch_assoc($res3)){
                
                $id = $row['id'];
            }};
         
            $id1 = "S".$id;

            $sql4 = "UPDATE student SET st_id= '$id1' WHERE id = $id";

             $res4 = mysqli_query($conn, $sql4);

            if($res4 == true){
            
                 $_SESSION['reg-03-sin-add-ok'] = "Ok";
                 $_SESSION['reg-03-sin-username'] = $username;
                 $_SESSION['reg-03-sin-password'] = $pass;
                 echo "<script> window.location.replace('user-details-download.php');</script>";
             ?>
             <?php
             }
             else
            {
               $_SESSION['reg-03-sin-add-error'] = "error";
               echo "<script> window.location.replace('register-VA-03.php');</script>";
               die();
              
             }

    }else{
        $_SESSION['reg-03-sin'] = "Error";
        echo "<script> window.location.replace('register-VA-03.php');</script>";
    }
}

if(isset($_POST['VA'])){
    
    $_SESSION['VA'] = "0";
    echo "<script> window.location.replace('register-VA-03.php');</script>";
    
}

if(isset($_POST['VA1'])){
    
  $_SESSION['VA'] = "1";
  echo "<script> window.location.replace('register-VA-03.php');</script>";
  
}

?>
