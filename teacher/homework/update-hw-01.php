<?php include('../../config/constant.php'); 

if(isset($_POST['update_hw_01']))
{
   
    $hw_id = $_POST['hw_id'];
    $hw_expire = $_POST['hw_expire'];

    $sql = "UPDATE homework SET
        hw_expire = '$hw_expire'
        WHERE hw_id='$hw_id' 
    ";

    $res = mysqli_query($conn, $sql);

    if($res==true){
        $_SESSION['update-hw-ok'] = "Ok"; 
        header('location:./hw-view.php');
    }
    else
    {
        $_SESSION['update-hw-error'] = "Error";
        header('location:./hw-view.php');
    }

}else{
    $_SESSION['update-hw-error'] = "Error";
    header('location:./hw-view.php');
}