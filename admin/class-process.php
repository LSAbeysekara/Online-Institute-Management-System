<?php include('config/constant.php'); ?>

<?php
if (isset($_POST['item'])) {
    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $query = "SELECT * FROM class WHERE cl_id = '".$item."'";
    $result = mysqli_query($conn, $query);
    $cl_details = $result->fetch_assoc();
    header('Content-Type: application/json');
    echo json_encode($cl_details); 
}
?>