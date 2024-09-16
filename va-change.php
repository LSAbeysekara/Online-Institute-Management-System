<?php include('./config/constant.php'); 


if(isset($_GET['VA'])){
    $VA = $_GET['VA'];
    $st_id = $_GET['st_id'];

    $sql = "UPDATE student SET VA = '$VA' WHERE st_id='$st_id'";

    $res = mysqli_query($conn, $sql);
    
    if($res==true){
        if($VA == 1){
            $_SESSION['VA-on'] = "On";
        }
        header('location:./index.php');
    }else{
        $_SESSION['change-VA-error'] = "Error"; 
        header('location:/index.php');
    }

}