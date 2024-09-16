<?php include('config/constant.php'); ?>

<?php
if (isset($_POST['item'])) {
    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $query = "SELECT * FROM homework WHERE hw_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "s", $item);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $cl_details = $result->fetch_assoc();

    header('Content-Type: application/json');
    echo json_encode($cl_details);
}
?>
