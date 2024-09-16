<?php include('../../config/constant.php'); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the AJAX request
    $res_id = $_POST['res_id'];
    $st_id_g = $_POST['username'];
    $grading = $_POST['grading'];
    $status = $_POST['status'];

    // Update grading and status in the database
    $sql = "UPDATE exam_results SET act_result = '$grading', status = '$status' WHERE res_id = '$res_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
}

?>
