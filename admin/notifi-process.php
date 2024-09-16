<?php include('config/constant.php'); ?>

<?php
if (isset($_POST['item'])) {
    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $query = "SELECT * FROM notification WHERE not_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $item);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Fetch the appointment details
    $cl_details = $result->fetch_assoc();

    // Send the appointment details as JSON response
    header('Content-Type: application/json');
    echo json_encode($cl_details); // Make sure $cl_details contains valid data
}
?>
