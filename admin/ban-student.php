<?php include('../config/constant.php') ?>

<?php

$st_id = $_POST['st_id'];
$cl_id = $_POST['cl_id'];


$sql = "UPDATE student_enroll SET status = 'Not Paid' WHERE cl_id = '$cl_id' AND st_id = '$st_id'";

$res = mysqli_query($conn, $sql);


if ($res === TRUE) {
    echo "Banned";
} else {
    echo "Failed to ban";
}
?>
