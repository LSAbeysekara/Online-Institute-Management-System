<?php include('../config/constant.php'); ?>
<?php include('login-check.php'); ?>


<?php
    $st_id = "0";
    if(isset($_SESSION['st_id'])){
        $st_id = $_SESSION['st_id'];
    }

    if($st_id == "0"){
        header('location: ../login.php');

    }else{
        $sql1 = "SELECT * FROM student WHERE st_id='$st_id'";
        $res1 = mysqli_query($conn, $sql1);

        $count1 = mysqli_num_rows($res1);

        if($count1>0){
            while($row=mysqli_fetch_assoc($res1)){
                $st_id = $row['st_id'];
                $st_username = $row['st_username'];
                $st_img = $row['st_img'];

            }
        }

        $cl_id = "0";
        if(isset($_SESSION['cl_id_student'])){
            $cl_id = $_SESSION['cl_id_student'];
        }

        if($cl_id == "0"){
            header('location: ./login.php');
        }
    }
?>

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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cl_title; ?></title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="../admin/sweetalert.min.js"></script>
</head>
<body>
    <div class="container-02">
        <aside>
            <a href="../index.php">
                <div class="top">
                    <div class="logo">
                        <img src="../images/logos/logo.png">
                        <h2>ONLINE<span class="danger">INSTITUTE</span></h2>
                    </div>
                    <div class="close" id="close-btn">
                        <span class="material-symbols-outlined"> close </span>
                    </div>
                </div>
            </a>
            <div class="sidebar">
                <a href="../index.php"><span class="material-symbols-outlined"> menu_book </span><h3>Home</h3></a>
                <a href="./index.php"><span class="material-symbols-outlined"> menu_book </span><h3>Dashboard</h3></a>
                <a href="./exam/index.php"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>


        <main>

            <ul>
                <li><a href="#" class="active-nav"><?php echo $cl_title; ?></a></li>
                <li><a href="homeworks.php">Homework</a></li>
            </ul><br>
            
            
            
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
                            <p>Hey, <b><?php echo $st_username; ?></b></p>
                            <small class="text-muted">Student</small>
                        </div>
                        <div class="profile-photo">
                            <img src="../images/profile-pic/<?php echo $st_img; ?>" alt="profile picture">
                        </div>
                    </div>
                </div>
            </div>

            <h1 style="color: #ff7782;"><?php echo $cl_title;?> - <?php echo $cl_lan; ?></h1><br>
            
            <?php

                    $sql3 = "SELECT * FROM announcement WHERE cl_id='$cl_id' AND ano_status = 'Active' ORDER BY id DESC";

                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);

                    if($count3>0){  ?>

                    <div class="hw">
                    <h2>Notices</h2><br>

                    <?php
                        while($row=mysqli_fetch_assoc($res3)){
                            $ano_content = $row['ano_content'];  ?>

                            <div class="hw">
                                <?php echo $ano_content; ?>
                            </div>

                        <?php
                        } ?>
                    </div>
                    <?php
                    }
                        ?>


            

            <?php
            
            date_default_timezone_set('Asia/Colombo');
            $current_date = date('Y-m-d');
            $css_class = (strtotime($cl_link_date) < strtotime($current_date)) ? 'red' : 'green';
            ?>

            <div class="hw">
                <div class="hw"><h2>LINK FOR THE CLASS</h2></div>
                <div class="hw">
                    <div class="<?php echo $css_class; ?>" style="height: 170px; position: relative;">
                        <table class="link-update-table" style="text-align: center; height: 170px;">
                            <tr>
                                <td>
                                    <h3><?php echo $cl_link_date; ?></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="attendance.php?cl_id=<?php echo $cl_id; ?> &st_id=<?php echo $st_id; ?> &cl_link=<?php echo $cl_link; ?> &cl_date=<?php echo $cl_link_date; ?>" class="link-update-table copy-button">Attend Class</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <br>

                <div class="hw">
                <div class="hw"><h2>HOMEWORKS</h2></div><br>

            
                <?php
                $sql4 = "SELECT * FROM homework WHERE cl_id='$cl_id' AND hw_status = 'Active' LIMIT 5";
                $res4 = mysqli_query($conn, $sql4);

                $count4 = mysqli_num_rows($res4);

                if($count4>0){ ?>

                        <div class="hw" style="margin-left: 12px;">

                        <?php
                        while($row=mysqli_fetch_assoc($res4)){
                            $hw_id = $row['hw_id'];
                            $hw_title = $row['hw_title'];
                            $hw_expire = $row['hw_expire']; 

                            $timezone = new DateTimeZone('Asia/Colombo');
                            $new_hw_expire = new DateTime($hw_expire, $timezone);
                            $currentDateTimeObj = new DateTime('now', $timezone);
                            $timeDifference = $currentDateTimeObj->diff($new_hw_expire);

                            if ($timeDifference->invert == 1) {

                            }else{ ?>

                                <div class="hw hw-view" style="margin-left: 5px;">
                                    <a href="hw-view-st-session.php?hw_id=<?php echo $hw_id; ?>"><h3 style="display: inline-block; text-align: left; width: 50%;"><?php echo $hw_title; ?></h3>
                                    <h3 style="display: inline-block; text-align: left; width: 30%;"><?php echo $hw_expire; ?></h3>
                                    </h3 style="display: inline-block; text-align: right; width: 20%;">
                                        <?php
                                          
                                            date_default_timezone_set('Asia/Colombo');
                                            $currentDateTime = new DateTime();
                                            $hw_expire01 = new DateTime($hw_expire);
                                            $timeDifference = $currentDateTime->diff($hw_expire01);
                                            $totalSeconds = $timeDifference->s + $timeDifference->i * 60 + $timeDifference->h * 3600 + $timeDifference->d * 86400;
                                           
                                            if ($timeDifference->d > 0) {
                                                echo $timeDifference->d . ' days';
                                            } elseif ($timeDifference->h > 0) {
                                                echo $timeDifference->h . ' hours';
                                            } elseif ($timeDifference->i > 0) {
                                                echo $timeDifference->i . ' minutes';
                                            } else {
                                                echo $totalSeconds . ' seconds';
                                            }
                                            echo " left.";
                                                            
                                        ?>
                                    <h3>
                                    </a>
                                </div>
                                
                        <?php
                            }
                        }?>

                        <br>
                        <a href="homeworks.php" style="color: #E2583A; text-align: center;"><h3>Show All</h3></a>
                        </div>
                    </div>
                <?php
                }else{
                ?>

                <div class="hw" style="color: red; text-align: center;">
                    <h3>No new howeworks</h3>
                </div>

                <?php } ?>
                </div>
   
        </main>
        
    </div>

    
    <script src="student.js"></script>

    <?php if(isset($_SESSION['not-hw-st-id'])){ ?>
        <script>
            swal({
                title: "Failed to load homework. Please try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['not-hw-st-id']); } ?>

    <?php if(isset($_SESSION['atd-upload-error'])){ ?>
        <script>
            swal({
                title: "Failed to attend the class. Please try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['atd-upload-error']); } ?>

    <?php if(isset($_SESSION['atd-upload-date'])){ ?>
        <script>
            swal({
                title: "The link has expired",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['atd-upload-date']); } ?>

</body>
</html>
