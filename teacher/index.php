<?php include('../config/constant.php'); ?>
<?php include('login-check.php'); ?>

<?php
    $em_id_teacher = "0";
    if(isset($_SESSION['em_id_teacher'])){
        $em_id_teacher = $_SESSION['em_id_teacher'];
    }

    if($em_id_teacher == "0"){
        $_SESSION['login-status-03'] = "error";
        header('location: ../admin/login.php');
    }else{
        $sql1 = "SELECT * FROM employee WHERE em_id='$em_id_teacher'";

        $res1 = mysqli_query($conn, $sql1);

        $count1 = mysqli_num_rows($res1);

        if($count1>0){
            
            while($row=mysqli_fetch_assoc($res1)){
            
                $em_id01 = $row['em_id'];
                $em_username01 = $row['em_username'];
                $em_img01 = $row['em_img'];

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
                <a href="#" class="active"><span class="material-symbols-outlined"> menu_book </span><h3>Classes</h3></a>
                <a href="./exam/index.php"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="#"><span class="material-symbols-outlined"> payments </span><h3>Payments</h3></a>
                <div class="dropdown">
                    <a href="#" class="dropbtn"><span class="material-symbols-outlined">lab_profile</span><h3>Reports</h3><i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="#">Attendance Reports</a>
                        <a href="#">Classes Details</a>
                        <a href="#">Payment Details</a>
                    </div>
                </div>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>



        <main>
            <div class="insights">

            <?php

            $sql2 = "SELECT * FROM teacher_enroll WHERE em_id = '$em_id_teacher'";

            $res2 = mysqli_query($conn, $sql2);

                   
            $count2 = mysqli_num_rows($res2);

            if($count2>0)
            {

                while($row=mysqli_fetch_assoc($res2))
                {

                    $em_enr_id = $row['em_enr_id'];
                    $cl_id = $row['cl_id'];
                    $sql3 = "SELECT * FROM class WHERE cl_id = '$cl_id' AND cl_status = 'Active'";

                    $res3 = mysqli_query($conn, $sql3);

                    $count3 = mysqli_num_rows($res3);

                    if($count3>0)
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
                            
                            $cl_duration = $row['cl_duration']; ?>

                            <div class="classes">
                                <div class="row-01">
                                    <img src="../images/class/<?php echo $cl_img; ?>" alt="Class image"><br>
                                </div>
                                <div class="row-02">
                                    <a href="cl-id-session.php?cl_id=<?php echo $cl_id; ?>"><h2 class="btn" style="color: #ff7782;"><?php echo $cl_id; ?> - <?php echo $cl_title; ?></h2></a>
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
                    
                        <a href="profile.php">
                            <div class="profile">
                                <div class="info">
                                    <p>Hey, <b><?php echo $em_username01; ?></b></p>
                                    <small class="text-muted">Admin</small>
                                </div>
                                <div class="profile-photo">
                                    <img src="../images/employee/<?php echo $em_img01; ?>" alt="profile picture">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </main>
      
        
    </div>

    
    <script src="teacher.js"></script>

    <?php if(isset($_SESSION['login-status-01'])){ ?>
        <script>
            swal({
                title: "Successfully Logged in",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['login-status-01']); } ?>

    <?php if(isset($_SESSION['not-cl-id'])){ ?>
        <script>
            swal({
                title: "Something went wrong, Please try again!",
                icon: "warning",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['not-cl-id']); } ?>

</body>
</html>