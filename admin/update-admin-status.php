<?php include('config/constant.php'); ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['status']) && isset($_POST['em_id'])) {
        
        $status = $_POST['status'];
        $em_id = $_POST['em_id'];

        $sql = "UPDATE employee SET status = ? WHERE em_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $em_id);

        if ($stmt->execute()) {
            $_SESSION['update-admin-status-ok'] = "OK";
            header('location: ./admin.php');

        } else {
            $_SESSION['update-admin-status-error'] = "error";
            header('location: ./admin.php');
            
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        $_SESSION['update-admin-status-error'] = "error";
        header('location: ./admin.php');
    }
}
?>