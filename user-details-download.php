<?php include('config/constant.php'); ?>

<?php
$VA = "1";

if (isset($_SESSION['VA'])) {
    $VA = $_SESSION['VA'];
}

if (isset($_POST['export']) && $_POST['export'] === '1') {
    if (
        isset($_SESSION['reg-03-sin-username']) &&
        isset($_SESSION['reg-03-sin-password'])
    ) {
        
        $username = $_SESSION['reg-03-sin-username'];
        $password = $_SESSION['reg-03-sin-password'];

        $filename = 'පරිශීලක_නාමය_සහ_මුරපදය_' . date('Ymd') . '.txt';

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen("Username: $username\nPassword: $password"));

        
        echo "Username: $username\nPassword: $password";

        
        exit();
    } else {
        $_SESSION['reg-04-sin-add-error'] = "error";
        echo "<script> window.location.replace('register-VA-01.php');</script>";
        die();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Session Data Export</title>
    
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
            width: 50%;
            text-align: center;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            font-size: 23px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 80%;
            margin: 20px auto;
            background-color: #f5f5f5;
            border: 2px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        tr {
            border-bottom: 1px solid #ccc;
        }

        td {
            padding: 10px;
        }

        td:first-child {
            font-weight: bold;
            background-color: #007bff;
            color: white;
            width: 40%;
            text-align: right;
            padding-right: 10px;
        }

        td:last-child {
            width: 60%;
        }

        input[type="tel"] {
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

        .fcc-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .fcc-btn:hover {
            background-color: #0056b3;
        }

        #download{
            position: absolute;
            top: 20px;
            right: 15px;
        }

        #download > input{
            background-color: #FA8072;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-size: 23px;
        }

        #download > input:hover{
            background-color: #CD5C5C;
        }

        #VA input[type="submit"] {
            background-color: #dc3545;
            transition: background-color 0.3s ease;
        }

        #VA input[type="submit"]:hover {
            background-color: #c82333;
        }

        #VA-02 input[type="submit"] {
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
            if ($VA != "0") {
            ?>
                <form action="#" method="post" id="VA">
                    <input type="submit" name="VA" value="හඩ සහායකයා අක්‍රීය කරන්න">
                </form><br><br>
            <?php
            } else {
            ?>
                <form action="#" method="post" id="VA-02">
                    <input type="submit" name="VA1" value="හඩ සහායකයා සක්‍රීය කරන්න">
                </form><br>
            <?php
            }
            ?>

            <?php if ($VA != "0") { ?>
                <audio id="audioPlayer" controls>
                    <source src="./VA/mp3/details-download-01.mp3" type="audio/mpeg">
                </audio>
            <?php } ?>

            <form id="exportForm" action="#" method="post" id="UD">
                <input type="tel" id="mobileInput" name="num" placeholder="ඔබගේ ජංගම දුරකථන අංකය ඇතුලත් කරන්න">
                <input type="submit" name="mobile" value="පරිශීලක නාමය සහ මුරපදය යවන්න" onclick="validateMobileNumber()">
            </form><br>
            
            <form id="download" action="#" method="post" id="UD">
                <input type="hidden" name="export" value="1">
                <input type="submit" value="පරිශීලක නාමය සහ මුරපදය බාගතකරගන්න">
            </form>
            
            <br><br>
            <a class="fcc-btn" href="./login-VA-01.php">ඉදිරියට යන්න</a>
        </div>
    </div>


    <script>
        function validateMobileNumber() {
        const mobileInput = document.getElementById('mobileInput').value;
        
        const mobileNumberPattern = /^\d{10}$/; 
        if (mobileNumberPattern.test(mobileInput)) {

        } else {
            alert('Invalid mobile number');
        }
        }
    </script>

    <script>
        setTimeout(function() {
            const audioPlayer = document.getElementById('audioPlayer');
            audioPlayer.play();
        }, 1000); 
    </script>
</body>
</html>

<?php
if(isset($_POST['VA'])){
    
    $_SESSION['VA'] = "0";
    echo "<script> window.location.replace('user-details-download.php');</script>";
    
}

if(isset($_POST['VA1'])){
    
  $_SESSION['VA'] = "1";
  echo "<script> window.location.replace('user-details-download.php');</script>";
  
}



if (isset($_POST['mobile'])) {
    $num = $_POST['num'];

    if(isset($_SESSION['reg-03-sin-username'])){
        $username = $_SESSION['reg-03-sin-username'];
    }

    

}