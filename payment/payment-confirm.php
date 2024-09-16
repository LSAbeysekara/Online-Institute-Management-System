<?php include('../config/constant.php'); ?>
<?php include('../student/login-check.php'); ?>

<?php
    $st_id = "0";
    if(isset($_SESSION['st_id'])){
        $st_id = $_SESSION['st_id'];
    }

    if($st_id == "0"){
        header('location: ../login.php');
    }
?>


<?php
$amount = $_GET['amount'];
$st_enr_id = $_GET['st_enr_id'];
$order_id = $_GET['order_id'];

$paid_month = date('Y-m');

date_default_timezone_set('Asia/Colombo');
$currentDateTime = date('Y-m-d H:i:s');


$sql = "SELECT * FROM student_enroll WHERE st_enr_id = '$st_enr_id'";

$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);

if($count>0){
    while($row=mysqli_fetch_assoc($res)){
        $cl_id = $row['cl_id'];
    }}

$sql2 = "INSERT INTO payments SET
    order_id = '$order_id',
    st_id = '$st_id',
    amount = '$amount',
    payment_date = '$currentDateTime',
    paid_type = 'Online',
    payment_status = 'Completed',
    payment_method = 'Online Payment',
    cl_id = '$cl_id'
";

$res2 = mysqli_query($conn, $sql2);


$sql3 = "SELECT * FROM payments ORDER BY id DESC LIMIT 1";
$res3 = mysqli_query($conn, $sql3);
$count3 = mysqli_num_rows($res3);

if($count3>0){
    while($row=mysqli_fetch_assoc($res3)){
        $id = $row['id'];
    }}

    $id1 = "P".$id;

$sql4 = "UPDATE payments SET p_id= '$id1' WHERE id = $id";

$res4 = mysqli_query($conn, $sql4);

if($res4 == TRUE) {

    $sql5 = "UPDATE student_enroll SET paid_month = '$paid_month', status = 'Paid' WHERE st_enr_id = '$st_enr_id'";

    $res5 = mysqli_query($conn, $sql5);

    if($res4 == TRUE) {
        $_SESSION['payment-add-ok'] = "ok";
        header('location: ./index.php');
    }else{
        $_SESSION['payment-add-error'] = "error";
        header('location: ./index.php');
    }
}else{
    $_SESSION['payment-add-error'] = "error";
    header('location: ./index.php');
}






?>
