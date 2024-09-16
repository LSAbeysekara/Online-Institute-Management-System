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
                <li><a href="class-view-st.php"><?php echo $cl_title; ?></a></li>
                <li><a href="#0" class="active-nav">Homework</a></li>
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
            
            
            <div class="hw">
            <div class="hw"><h2>HOMEWORKS</h2></div><br>

        
            <?php
            $sql4 = "SELECT * FROM homework WHERE cl_id='$cl_id' AND hw_status = 'Active' ORDER BY id DESC";

            $res4 = mysqli_query($conn, $sql4);
            $count4 = mysqli_num_rows($res4);

            if($count4>0){ ?>

                    <div class="hw" style="margin-left: 12px;">

                    <?php
                    while($row=mysqli_fetch_assoc($res4)){
                        $hw_id = $row['hw_id'];
                        $hw_title = $row['hw_title'];
                        $hw_expire = $row['hw_expire']; ?>

                            <div class="hw hw-view" style="margin-left: 5px;">
                                <a href="hw-view-st-session.php?hw_id=<?php echo $hw_id; ?>"><h3 style="display: inline-block; text-align: left; width: 50%;"><?php echo $hw_title; ?></h3>
                                <h3 style="display: inline-block; text-align: left; width: 30%;"><?php echo $hw_expire; ?></h3>
                                </h3 style="display: inline-block; text-align: right; width: 20%;">
                                    <?php
                                        date_default_timezone_set('Asia/Colombo');
                                        $currentDateTime = new DateTime();
                                        $hw_expire01 = new DateTime($hw_expire);
                                        $timeDifference = $currentDateTime->diff($hw_expire01);
                                        
                                        if ($currentDateTime > $hw_expire01) {
                                            // If the expiration date and time are in the past
                                            echo "Expired ";
                                        
                                            if ($timeDifference->d > 0) {
                                                echo abs($timeDifference->d) . ' day(s)';
                                            } elseif ($timeDifference->h > 0) {
                                                echo abs($timeDifference->h) . ' hour(s)';
                                            } elseif ($timeDifference->i > 0) {
                                                echo abs($timeDifference->i) . ' minute(s)';
                                            } else {
                                                echo abs($timeDifference->s) . ' second(s)';
                                            }
                                            echo " ago.";
                                        } else {
                                            // If the expiration date and time are in the future
                                            echo "More ";
                                        
                                            if ($timeDifference->d > 0) {
                                                echo $timeDifference->d . ' day(s)';
                                            } elseif ($timeDifference->h > 0) {
                                                echo $timeDifference->h . ' hour(s)';
                                            } elseif ($timeDifference->i > 0) {
                                                echo $timeDifference->i . ' minute(s)';
                                            } else {
                                                echo $timeDifference->s . ' second(s)';
                                            }
                                            echo " to go.";
                                        }
                                        
                                        
                                    ?>
                                <h3>
                                </a>
                            </div>
                            
                    <?php
                        
                    }?>

                    </div>
                </div>
            <?php
            }else{
            ?>

            <div class="hw" style="color: red; text-align: center;">
                <h3>No howeworks found.</h3>
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
