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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                <a href="#" class="active"><span class="material-symbols-outlined"> menu_book </span><h3>Dashboard</h3></a>
                <a href="./exam/index.php"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

        <main>

            <div class="insights">

            <?php
            $currentYearMonth = date('Y-m');

            $sql2 = "SELECT * FROM student_enroll WHERE st_id = '$st_id'";

            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if($count2>0)
            {
                while($row=mysqli_fetch_assoc($res2))
                {
                    $st_enr_id = $row['st_enr_id'];
                    $cl_id = $row['cl_id'];


                    $sql3 = "SELECT * FROM class WHERE cl_id = '$cl_id' AND cl_status = 'Active'";

                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);
                    {
                        while($row=mysqli_fetch_assoc($res3))
                        {
                            $cl_title = $row['cl_title'];
                            $cl_grade = $row['cl_grade'];
                            $cl_img = $row['cl_img'];
                            $cl_day = $row['cl_day'];
                            $cl_time = $row['cl_time'];

                            $time_obj = new DateTime($cl_time);
                            $formatted_time = $time_obj->format('H:i'); 
                            
                            $cl_duration = $row['cl_duration']; 
                            


                            $sql4 = "SELECT * FROM student_enroll WHERE cl_id = '$cl_id' AND st_id = '$st_id'";

                            $res4 = mysqli_query($conn, $sql4);

                            $count4 = mysqli_num_rows($res4);

                            if($count4>0)
                            {
                                while($row=mysqli_fetch_assoc($res4))
                                {
                                    $pay_status = $row['status'];
                                    $paid_month = $row['paid_month'];
                                }
                            }
                            ?>

                            <?php 
                                date_default_timezone_set('Asia/Colombo');

                                $currentYear = date('Y');
                                $currentMonth = date('m');
                                
                                $yearMonth = $currentYear . '-' . $currentMonth;
                            ?>

                            <div class="classes">
                                <div class="row-01">
                                    <img src="../images/class/<?php echo $cl_img; ?>" alt="Class image"><br>
                                </div>
                                <div class="row-02">
                                    <?php if ($pay_status == "Not Paid" || $paid_month == NULL || $paid_month != $yearMonth) { ?>
                                        <a href="../payment/index.php"><h2 class="btn" style="color: #ff7782;"><?php echo $cl_title; ?></h2></a>
                                    <?php }else{ ?>
                                        <a href="cl-id-session-st.php?cl_id=<?php echo $cl_id; ?>"><h2 class="btn" style="color: #ff7782;"><?php echo $cl_title; ?></h2></a>
                                    <?php } ?>
                                    <h3 style="color: #7380ec;">Grade: <?php echo $cl_grade; ?></h3>
                                    <h3><?php echo $cl_day; ?> - <?php echo $formatted_time; ?></h3>
                                    <h3>Duration: <?php echo $cl_duration; ?></h3>
                                </div>
                            </div>

                        
                        <?php
                        }
                    }
                    
                }
            }else{ ?>
                <h2 style="text-align: center;">Not classes added yet.</h2>
            <?php
            }
            ?>
            </div>
            
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

        </main>
        
    </div>

    
    <script src="student.js"></script>

    <?php if(isset($_SESSION['not-cl-id-st'])){ ?>
        <script>
            swal({
                title: "Something went wrong! Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['not-cl-id-st']); } ?>

</body>
</html>