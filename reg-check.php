<?php include('config/constant.php'); ?>

<?php

if (isset($_POST['user_name'])) {
    $username = mysqli_real_escape_string($conn, $_POST['user_name']);
    $query = "SELECT * FROM student WHERE st_username = '".$username."'";
    $result = mysqli_query($conn, $query);
    echo mysqli_num_rows($result);
}