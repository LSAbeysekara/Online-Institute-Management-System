<?php include('../../config/constant.php'); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the AJAX request
    $hw_a_id = $_POST['act_id'];
    $st_id = $_POST['username'];
    $grading = $_POST['grading'];
    $comment = $_POST['comment'];
    $status = $_POST['status'];

    // Update grading, comments, and status in the database
    $sql = "UPDATE homework_answers SET grading = '$grading', comment = '$comment', g_status = '$status' WHERE hw_a_id = '$hw_a_id' AND st_id = '$st_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
}

?>