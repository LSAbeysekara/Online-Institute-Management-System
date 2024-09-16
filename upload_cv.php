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
            header('location:./index.php');
        } else {
            $_SESSION['file-not-error'] = "Error"; 
            header('location:/teacher_cv.php');
        }
    }
}
?>