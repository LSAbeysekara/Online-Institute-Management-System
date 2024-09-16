<?php include('config/constant.php'); ?>

<?php

$VA = "1";

if(isset($_SESSION['VA'])){ 
  
  $VA = $_SESSION['VA'];

}?>

<!DOCTYPE html>
<html>
<head>
  <title>ලියාපදිංචි කරන්න - පරිශීලක නාමය</title>
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

        input[type="text"] {
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
    
    <div id="popup">
        <p>මයික්‍රෆෝනය සඳහා අවසරය ලබා දී නොමැත. කරුණාකර මයික්‍රෆෝනයට ප්‍රවේශය දෙන්න.</p>
        <button id="grantPermissionButton">අවසර දෙන්න</button>
        <button id="closePopupButton">අවසර දෙන්න එපා</button>
    </div>

    <script>
        function checkMicrophonePermission() {
            
            if ('mediaDevices' in navigator && 'getUserMedia' in navigator.mediaDevices) {
                navigator.mediaDevices.getUserMedia({ audio: true })
                    .then(function(stream) {
                       
                    })
                    .catch(function(error) {
                       
                        document.getElementById("popup").style.display = "block";
                    });
            } else {
                alert("Your browser does not support microphone permission checking.");
            }
        }

       
        window.addEventListener('load', checkMicrophonePermission);

        document.getElementById("grantPermissionButton").addEventListener("click", function() {
            
            location.reload();
        });

        
        document.getElementById("closePopupButton").addEventListener("click", function() {
            
            document.getElementById("popup").style.display = "none";
        });
    </script>

    
    <br><h1 style="font-size: 45px; text-align: center;">ලියාපදිංචි කරන්න</h1>

    <div class="cont">
        <div class="container">
            <?php if ($VA != "0") { ?>
                <form action="#" method="post" id="VA">
                    <input type="submit" name="VA" value="හඩ සහායකයා අක්‍රීය කරන්න">
                </form><br><br>
            <?php } else { ?>
                <form action="#" method="post" id="VA-02">
                    <input type="submit" name="VA1" value="හඩ සහායකයා සක්‍රීය කරන්න">
                </form><br><br>
            <?php } ?>

            <form action="#" method="post" id="UD">
                <label for="speechInput">පරිශීලක නාමය </label>
                <input type="text" name="username" id="speechInput" placeholder="පරිශීලක නාමය ඇතුළත් කරන්න" required>
                <input type="submit" name="user" value="ඉදිරියට යන්න">
            </form>

            <?php if ($VA != "0") { ?>
                <audio id="audioPlayer" controls>
                    <source src="./VA/mp3/username01.mp3" type="audio/mpeg">
                </audio>
            <?php } ?>
        </div>
    </div>

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
            }, 12000);
            } else {
            
            alert('Your browser does not support speech recognition.');
            }
        }
        setTimeout(function() {
            startSpeechRecognition();
        }, 12000);
    </script>

    <script>
        setTimeout(function() {
            const audioPlayer = document.getElementById('audioPlayer');
            audioPlayer.play();
        }, 2000); 
    </script>

<!-- <?php
    if (isset($_POST['user'])) {
        $username = $_POST['username'];
        $apiKey = 'AIzaSyDJTUeFC8y3lq6cjkPKe_odpNEf_DU7oq4'; // Replace with your API key
        $sinhalaWord = urlencode($username);
        $targetLanguage = 'en';

        $url = "https://translation.googleapis.com/language/translate/v3?key=$apiKey&q=$sinhalaWord&target=$targetLanguage";

        // Make sure cURL is available and initialized
        if (function_exists('curl_version')) {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
        } else {
            // If cURL is not available, use file_get_contents (may not work in some environments)
            $response = file_get_contents($url);
        }

        if ($response !== false) {
            $data = json_decode($response, true);

            if (isset($data['data']['translations'][0]['translatedText'])) {
                $translatedText = $data['data']['translations'][0]['translatedText'];
                $_SESSION['user'] = $translatedText;
                header('Location: register-VA-02.php');
                exit;
            }
        } else {
            // Handle error when translation request fails
            header('Location: register-VA-01.php?error=Translation failed');
            exit;
        }
    } 
    ?>
    -->

    <?php
    if (isset($_POST['VA'])) {
        $_SESSION['VA'] = "0";
        echo "<script>window.location.href = 'register-VA-01.php';</script>";
        exit;
    }

    if (isset($_POST['VA1'])) {
        $_SESSION['VA'] = "1";
        echo "<script>window.location.href = 'register-VA-01.php';</script>";
        exit;
    }
    ?>


</body>
</html>

<?php
    if(isset($_POST['VA'])){
        
        $_SESSION['VA'] = "0";
        echo "<script> window.location.replace('register-VA-01.php');</script>";
        
    }

    if(isset($_POST['VA1'])){
        
    $_SESSION['VA'] = "1";
    echo "<script> window.location.replace('register-VA-01.php');</script>";
    
    }
?>


<?php

if(isset($_POST['user'])){
    $username = $_POST['username'];

    $apiKey = 'AIzaSyDJTUeFC8y3lq6cjkPKe_odpNEf_DU7oq4';
    $name = $username;
    $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($name) . '&source=si&target=en';

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);                 
    $responseDecoded = json_decode($response, true);
    curl_close($handle);

    if(isset($responseDecoded['data']['translations'][0]['translatedText'])){
        // Extract translated text
        $translatedText = $responseDecoded['data']['translations'][0]['translatedText'];
        // Set the translated username into the session
        $_SESSION['user'] = $translatedText;
        
        // Redirect to the next page
        echo "<script>window.location.href = 'register-VA-02.php';</script>";
        exit;
    } else {
        // Handle translation error
        echo "Translation error: Unable to translate the text.";
    }
}
?>
