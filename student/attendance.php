<?php

include('../config/constant.php');

if (isset($_GET['cl_id']) && isset($_GET['st_id']) && isset($_GET['cl_link'])) {
        $cl_id = $_GET['cl_id'];
        $st_id = $_GET['st_id'];
        $cl_date = $_GET['cl_date'];
        $cl_link = htmlspecialchars($_GET['cl_link']);

        date_default_timezone_set('Asia/Colombo');

        $Date = $cl_date;
        $currentDate = new DateTime();

        $providedDateObj = DateTime::createFromFormat('Y-m-d', $Date);
        if ($providedDateObj < $currentDate) {
            $_SESSION['atd-upload-date'] = "error";
            header('Location: ./class-view-st.php');
            exit;
        }



        $sql = "SELECT * FROM attendance WHERE cl_id = '$cl_id' AND cl_date = '$cl_date' AND st_id = '$st_id'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count>0)
        {
            header('Location:'.$cl_link);
            exit();

        }else{

            date_default_timezone_set('Asia/Colombo');
            $Date = $cl_date;
            $currentDate = new DateTime();
            $providedDateObj = DateTime::createFromFormat('Y-m-d', $Date);
            if ($providedDateObj < $currentDate) {
                $_SESSION['atd-upload-date'] = "error";
                header('Location: ./class-view-st.php');

            } elseif ($providedDateObj == $currentDate) {
                $sql2 = "INSERT INTO attendance SET
                cl_id = '$cl_id',
                st_id = '$st_id',
                cl_date = '$cl_date'
                ";
               
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == TRUE){
                    $sql3 = "SELECT * FROM attendance ORDER BY id DESC LIMIT 1";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);

                    if($count3>0){
                        while($row=mysqli_fetch_assoc($res3)){
                            $id = $row['id'];
                        }}

                        $id1 = "ATD".$id;

                    $sql4 = "UPDATE attendance SET atd_id= '$id1' WHERE id = $id";

                    $res4 = mysqli_query($conn, $sql4);

                    if($res4 == TRUE) {
                        header('Location:'.$cl_link);
                        exit();

                    }else{
                        $_SESSION['atd-upload-error'] = "error";
                        header('Location: ./class-view-st.php');
                        exit();
                    }
                }else{
                    $_SESSION['atd-upload-error'] = "error";
                    header('Location: ./class-view-st.php');
                    exit();
                }
            } else {
                $sql2 = "INSERT INTO attendance SET
                cl_id = '$cl_id',
                st_id = '$st_id',
                cl_date = '$cl_date'
                ";
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == TRUE){
                    $sql3 = "SELECT * FROM attendance ORDER BY id DESC LIMIT 1";

                    $res3 = mysqli_query($conn, $sql3);

                    $count3 = mysqli_num_rows($res3);

                    if($count3>0){
                        while($row=mysqli_fetch_assoc($res3)){
                            $id = $row['id'];
                        }}

                        $id1 = "ATD".$id;

                    $sql4 = "UPDATE attendance SET atd_id= '$id1' WHERE id = $id";

                    $res4 = mysqli_query($conn, $sql4);

                    if($res4 == TRUE) {
                        header('Location:'.$cl_link);
                        exit();

                    }else{
                        $_SESSION['atd-upload-error'] = "error";
                        header('Location: ./class-view-st.php');
                        exit();
                    }
                }else{
                    $_SESSION['atd-upload-error'] = "error";
                    header('Location: ./class-view-st.php');
                    exit();
                }
            }
        }

    } else {
        $_SESSION['atd-upload-error'] = "error";
        header('Location: ./class-view-st.php');
        exit();

    }
?>
