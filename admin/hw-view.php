<?php include('config/constant.php'); ?>
<?php include('login-check.php'); ?>

<?php
    $em_id = "0";
    if(isset($_SESSION['em_id'])){
        $em_id = $_SESSION['em_id'];
    }

    if($em_id == "0"){
        $_SESSION['login-status-03'] = "error";
        header('location: login.php');
    }else{
        $sql10 = "SELECT * FROM employee WHERE em_id='$em_id'";
        $res10 = mysqli_query($conn, $sql10);
        $count10 = mysqli_num_rows($res10);

        if($count10>0){
            while($row=mysqli_fetch_assoc($res10)){
                $em_id01 = $row['em_id'];
                $em_username01 = $row['em_username'];
                $em_img01 = $row['em_img'];

            }
        }

        $hw_id = "0";
        if (isset($_SESSION['hw_id_view01']) && $_SESSION['cl_id_view01']) {
            $hw_id = $_SESSION['hw_id_view01'];
            $cl_id = $_SESSION['cl_id_view01'];

        }

        if($hw_id == "0"){
            $_SESSION['hw-id-error'] = "error";
            header('location: ./homework.php');
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    <div class="container-02">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="../images/logos/logo.png">
                    <h2>ONLINE<span class="danger">INSTITUTE</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-outlined"> close </span>
                </div>
            </div>
            <div class="sidebar">
                <a href="index.php"><span class="material-symbols-outlined"> grid_view </span><h3>Dashboard</h3></a>
                <a href="class.php"><span class="material-symbols-outlined"> menu_book </span><h3>Classes</h3></a>
                <a href="teacher.php"><span class="material-symbols-outlined"> group </span><h3>Teacher Panel</h3></a>
                <a href="student.php"><span class="material-symbols-outlined"> groups </span><h3>Student Panel</h3></a>
                <a href="homework.php" class="active"><span class="material-symbols-outlined">library_books</span><h3>Homework</h3></a>
                <a href="payment.php"><span class="material-symbols-outlined"> payments </span><h3>Payments</h3></a>
                <a href="account.php"><span class="material-symbols-outlined"> account_balance </span><h3>Accounting Section</h3></a>
                <a href="exam.php"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="feedback.php"><span class="material-symbols-outlined"> feedback </span><h3>Feedback</h3><span class="message-count">20</span></a>
                <a href="notification.php"><span class="material-symbols-outlined">campaign</span><h3>Notification Panel</h3></a>
                <a href="admin.php"><span class="material-symbols-outlined">shield_person</span><h3>Admin</h3></a>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

        <main>

            <?php

            $sql2 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if($count2>0)
            {
                while($row=mysqli_fetch_assoc($res2))
                {
                    $cl_title = $row['cl_title'];
                    $cl_grade = $row['cl_grade'];
                    $cl_img = $row['cl_img'];
                    $cl_day = $row['cl_day'];
                    $cl_time = $row['cl_time'];
                    $cl_link = $row['cl_link'];
                    $cl_lan = $row['cl_lan'];
                    $cl_link_date = $row['cl_link_date'];

                    $time_obj = new DateTime($cl_time);
                    $formatted_time = $time_obj->format('H:i'); 
                    
                    $cl_duration = $row['cl_duration']; ?>
                
                <?php
                }
            } ?>
            
            <div class="profile-st">
                <div class="top">
                    <button id="menu-btn">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <div class="profile">
                        <div class="theme-toggler">
                            <span class="material-symbols-outlined active">light_mode</span>
                            <span class="material-symbols-outlined">dark_mode</span>
                        </div>
                    
                        <div class="info">
                            <p>Hey, <b><?php echo $em_username01; ?></b></p>
                            <small class="text-muted">Teacher</small>
                        </div>
                        <div class="profile-photo">
                            <img src="../../images/employee/<?php echo $em_img01; ?>" alt="profile picture">
                        </div>
                    </div>
                </div>
            </div>

            <h1 style="color: #ff7782;"><?php echo $cl_id;?> - <?php echo $cl_title;?> - <?php echo $cl_lan; ?></h1><br>

            <?php

            $sql3 = "SELECT * FROM homework WHERE hw_id = '$hw_id'";

            $res3 = mysqli_query($conn, $sql3);
            $count3 = mysqli_num_rows($res3);
            if($count3>0)
            {
                while($row=mysqli_fetch_assoc($res3))
                {
                    $hw_created = $row['hw_created'];
                    $hw_title = $row['hw_title'];
                    $hw_content = $row['hw_content'];
                    $hw_expire = $row['hw_expire'];
                    $hw_status = $row['hw_status'];
                    ?>
                
                <?php
                }
            } ?>

            <h1>HOMEWORK</h1><br>
            <h2 style="text-align: center;"><?php echo $hw_title; ?></h2><br>
            
            <div class="hw">
                <table class="link-update-table">
                    <tr>
                        <td><h3>Creaded On: </h3> </td>
                        <td><h3><?php echo $hw_created; ?></h3></td>
                    </tr>
                    <tr>
                        <td><h3>Expired On: </h3></td>
                        <td onclick="loadContent01('<?php echo $hw_id; ?>')">
                            <?php
                                $timezone = new DateTimeZone('Asia/Colombo');
                                $new_hw_expire = new DateTime($hw_expire, $timezone);
                                $currentDateTimeObj = new DateTime('now', $timezone);

                                $timeDifference = $currentDateTimeObj->diff($new_hw_expire);

                                if ($timeDifference->invert == 1) {
                                    echo '<h3 style="color: #C70039;">' . $hw_expire . '</h3>';
                                } else {
                                    echo '<h3 style="color: #41f1b6;">' . $hw_expire . '</h3>';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><h3>Status:</h3></td>
                        <td onclick="loadContent('<?php echo $hw_id; ?>')">
                            <h3>
                                <?php 
                                    if($hw_status=="Active"){ ?>
                                        <div class="success">
                                            <?php echo $hw_status; ?>
                                        </div> <?php
                                    }
                                    else{ ?>
                                        <div class="error">
                                            <?php echo $hw_status; ?>
                                        </div> <?php
                                    }
                                ?>
                            </h3>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="hw">
                <table>
                    <tr>
                        <td><?php echo $hw_content; ?></td>
                    </tr>
                </table>
            </div>

            <h2 style="color: red; text-align: center;">RESULTS</h2>
            <div class="hw">
                <table>
                    <tr>
                        <td>
                            
                        </td>
                    </tr>
                </table>
            </div>

        </main>   
    </div>
    
    <script src="index.js"></script>

</body>
</html>
