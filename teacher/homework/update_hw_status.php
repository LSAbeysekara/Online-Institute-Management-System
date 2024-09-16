<?php

include('../../config/constant.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $status = $_POST['status'];
    $hw_id = $_POST['hw_id'];

    $sql = "UPDATE homework SET
        hw_status = '$status'
        WHERE hw_id='$hw_id' 
    ";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo 'Database updated successfully';
    } else {
        echo 'Error updating database';

    }
} else {
    echo "Not working";
}

?>