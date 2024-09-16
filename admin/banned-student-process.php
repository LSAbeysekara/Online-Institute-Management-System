<?php include('config/constant.php'); ?>

<?php
if (isset($_POST['cl_id']) && isset($_POST['st_id'])) {
    $cl_id = mysqli_real_escape_string($conn, $_POST['cl_id']);
    $st_id = mysqli_real_escape_string($conn, $_POST['st_id']);

    $query = "SELECT * FROM student_enroll WHERE cl_id = '$cl_id' AND st_id = '$st_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $enrollment_details = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($enrollment_details); 
    } else {
        echo json_encode(['error' => 'Failed to fetch enrollment details']);
    }
} else {
    echo json_encode(['error' => 'cl_id or st_id not provided']);
}

?>