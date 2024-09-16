<?php include('../../config/constant.php');

if (isset($_GET['ex_id'])) {
    $ex_id = $_GET['ex_id'];
    $q_num = 1;

    $sql = "SELECT * FROM questions WHERE ex_id='$ex_id'";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);

        if ($row) {
            $q_id = $row['q_id'];
            $_SESSION['q_id'] = $q_id;
            $_SESSION['q_num'] = $q_num;
            $_SESSION['ex_id'] = $ex_id;
            header('location: ./exam-view.php');
            exit(); 
        } else {
            $_SESSION['ex-id-error-que'] = "No questions found for this exam.";
            header('location: ./index.php');
            exit();
        }
    } else {
        $_SESSION['ex-id-error'] = "Database error. Please try again later.";
        header('location: ./attempt.php');
        exit();
    }
} else {
    $_SESSION['ex-id-error'] = "Invalid exam ID.";
    header('location: ./attempt.php');
    exit();
}
?>
