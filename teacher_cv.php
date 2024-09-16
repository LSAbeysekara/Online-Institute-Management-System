<?php include('config/constant.php') ?>

<?php
if(isset($_POST['submit'])){
    $target_dir = "./admin/teacherCV/";
    $target_file = $target_dir. basename($_FILES["cv"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if($imageFileType!= "pdf") {
        $_SESSION['file-type-error'] = "Error"; 
        header('location:/teacher_cv.php');
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $_SESSION['file-not-error'] = "Error"; 
        header('location:/teacher_cv.php');

    } else {
        if (move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) {
            $_SESSION['file-ok'] = "ok"; 
            header('location:/index.php');
        } else {
            $_SESSION['file-not-error'] = "Error"; 
            header('location:/teacher_cv.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a teacher</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="./admin/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lugrasimo&display=swap');
        body {
            background-image: url('teacher.jpg');
            background-size: cover;
            background-position: center center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            overflow: hidden;
            font-family: "Lugrasimo", cursive;
        }
        h1 {
            text-align: center;
            color: black;
            font-size: 6rem;
            margin-bottom: 2rem;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: scale(1);
        }
        input[type="file"] {
            font-size: 1rem;
            margin-bottom: 1rem;
            padding: 0.5rem;
            border: 2px solid #ccc;
            border-radius: 0.25rem;
            width: 100%;
            cursor: pointer;
            transition: border-color 0.2s ease;
        }&:focus {
            outline: none;
            border-color: #333;
        }&:valid {
            border-color: #4caf50;
        }
        button {
            font-size: 1.2rem;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            transition: background-color 0.2s ease;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s ease; /* add transition for smooth animation */
            transform: translateY(0); /* reset button position */
        }

        .jumping-button {
            transition: transform 0.2s ease;
            transform: translateY(0);
        }

        .jumping-button:hover {
            animation: jumping 1s ease-in-out infinite;
        }

        @keyframes jumping {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0);
            }
        }


        #backButton {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #backButton:hover {
            background-color: #64820E;
        }

    </style>
</head>
<body>
    <h1 class="headline">Become a teacher</h1>
    <h4>Upload your CV here:</h4>
    <form action="upload_cv.php" method="post" enctype="multipart/form-data">
        <input type="file" name="cv" id="cv" accept=".pdf" required>
        <button type="submit" name="submit" class="jumping-button">Upload CV</button>
    </form>

    <button id="backButton">&larr; Back</button>
    <script src="script.js"></script>

    <script>
        document.getElementById("backButton").addEventListener("click", function() {
            window.history.back();
        });
    </script>
</body>
</html>

    <?php if(isset($_SESSION['file-not-error'])){ ?>
        <script>
            swal({
                title: "Failed to upload the CV. Please try again",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['file-not-error']); } ?>

    <?php if(isset($_SESSION['file-type-error'])){ ?>
        <script>
            swal({
                title: "Only accepted pdf files. Please try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['file-type-error']); } ?>