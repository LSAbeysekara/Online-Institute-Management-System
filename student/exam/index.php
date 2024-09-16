<?php include('../../config/constant.php'); ?>
<?php include('../login-check.php'); ?>

<?php
    $st_id = "0";
    $enrolled = "0";
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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="../../admin/sweetalert.min.js"></script>
</head>
<body>
    <div class="container-02">
        <aside>
            <a href="../index.php">
                <div class="top">
                    <div class="logo">
                        <img src="../../images/logos/logo.png">
                        <h2>ONLINE<span class="danger">INSTITUTE</span></h2>
                    </div>
                    <div class="close" id="close-btn">
                        <span class="material-symbols-outlined"> close </span>
                    </div>
                </div>
            </a>
            <div class="sidebar">
                <a href="../../index.php"><span class="material-symbols-outlined"> menu_book </span><h3>Home</h3></a>
                <a href="../index.php"><span class="material-symbols-outlined"> menu_book </span><h3>Dashboard</h3></a>
                <a href="#" class="active"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="../logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

        <main>
            
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
                            <img src="../../images/profile-pic/<?php echo $st_img; ?>" alt="profile picture">
                        </div>
                    </div>
                </div>
            </div>


            <h1><strong>EXAMS</strong></h1><br>

            <div class="hw" style="text-align: center;">
                    
                <?php
                $ss = 1;
                $test = "";

                $sql3 = "SELECT * FROM student_enroll WHERE st_id = '$st_id'";
                $res3 = mysqli_query($conn, $sql3);

                $count3 = mysqli_num_rows($res3);

                if($count3>0){ 

                    while($row=mysqli_fetch_assoc($res3)){
                        
                        $cl_id = $row['cl_id'];



                        $sql4 = "SELECT * FROM exams WHERE cl_id = '$cl_id' AND ex_status = 'Active' ORDER BY ex_date_time DESC";

                        $res4 = mysqli_query($conn, $sql4);

                        $count4 = mysqli_num_rows($res4);

                        if($count4>0){ 

                            while($row=mysqli_fetch_assoc($res4)){
                                
                                $ex_id = $row['ex_id'];
                                $ex_title = $row['ex_title'];
                                $ex_date = $row['ex_date_time'];   



                                $sql7 = "SELECT * FROM student_enroll WHERE cl_id = '$cl_id' AND st_id = '$st_id'";

                                $res7 = mysqli_query($conn, $sql7);

                                $count7 = mysqli_num_rows($res7);

                                if($count7>0)
                                {
                                    while($row=mysqli_fetch_assoc($res7))
                                    {
                                        $pay_status = $row['status'];
                                        $paid_month = $row['paid_month'];
                                    }
                                }
                                

                                $sql6 = "SELECT * FROM exam_enroll WHERE ex_id = '$ex_id' AND st_id = '$st_id' AND enrolled = 'Yes'";

                                $res6 = mysqli_query($conn, $sql6);

                                $count6 = mysqli_num_rows($res6);

                                if($count6>0){
                                    continue;

                                }else{ 
                                    ?>
                                    <div class="hw hw-view">
                                        <?php if ($pay_status == "Not Paid" || $paid_month == NULL) { ?>
                                            <a href="../../payment/index.php"><h3 style="display: inline-block; text-align: left; width: 40%; font-size: 19px;"><?php echo $ex_title; ?></h3>
                                        <?php }else{ ?>
                                            <a href="attempt.php?ex_id=<?php echo $ex_id; ?>"><h3 style="display: inline-block; text-align: left; width: 40%; font-size: 19px;"><?php echo $ex_title; ?></h3>
                                        <?php } ?>

                                        <h3 style="display: inline-block; width: 25%;"><?php echo $ex_date; ?></h3>
                                        <h3 style="display: inline-block; text-align: right; width: 25%;">
                                            <?php

                                                $sql5 = "SELECT * FROM class WHERE cl_id = '$cl_id'";
                        
                                                $res5 = mysqli_query($conn, $sql5);
                        
                                                $count5 = mysqli_num_rows($res5);
                        
                                                if($count5>0){ 
                        
                                                    while($row=mysqli_fetch_assoc($res5)){
                                                        $cl_title = $row['cl_title'];
                                                        $cl_lan = $row['cl_lan'];
                                                    }
                                                }

                                                echo $cl_title." - ".$cl_lan;
                                            ?>
                                        </h3>
                                    </a>
                                </div>
                                <?php
                                }
                            }
                        }
                        
                    }

                }
                ?>
                
            </div>
                
        </main>
    </div>

    
    <script src="../student.js"></script>

    <?php if(isset($_SESSION['ex-id-error'])){ ?>
        <script>
            swal({
                title: "Failed to Load exam! Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ex-id-error']); } ?>

    <?php if(isset($_SESSION['ex-id-error-que'])){ ?>
        <script>
            swal({
                title: "No questions found for this exam.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ex-id-error-que']); } ?>

    <?php if(isset($_SESSION['exam-finished-ok'])){ ?>
        <script>
            swal({
                title: "Congratulations! You have successfully completed the test.",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['exam-finished-ok']); } ?>

    <?php if(isset($_SESSION['exam-finished-error'])){ ?>
        <script>
            swal({
                title: "Failed to save the answers.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['exam-finished-error']); } ?>

</body>
</html>
