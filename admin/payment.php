<?php include('config/constant.php'); ?>
<?php include('./login-check.php'); ?>

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

        //execute the query
        $res10 = mysqli_query($conn, $sql10);

        //count the rows to check whether we have foods or not
        $count10 = mysqli_num_rows($res10);

        if($count10>0){
            //we have food in database
            //get the foods from database and display
            while($row=mysqli_fetch_assoc($res10)){
                //get the value from individual columns
                $em_id01 = $row['em_id'];
                $em_username01 = $row['em_username'];
                $em_img01 = $row['em_img'];

            }
        }
    }
?>

<?php
$currentYearMonth = date('Y-m');
$paid_month_check = "";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./sweetalert.min.js"></script>
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
                <a href="homework.php"><span class="material-symbols-outlined">library_books</span><h3>Homework</h3></a>
                <a href="#0" class="active"><span class="material-symbols-outlined"> payments </span><h3>Payments</h3></a>
                <!-- <a href="account.php"><span class="material-symbols-outlined"> account_balance </span><h3>Accounting Section</h3></a> -->
                <a href="exam.php"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="feedback.php"><span class="material-symbols-outlined"> feedback </span><h3>Feedback</h3><span class="message-count">20</span></a>
                <a href="notification.php"><span class="material-symbols-outlined">campaign</span><h3>Notification Panel</h3></a>
                <a href="admin.php"><span class="material-symbols-outlined">shield_person</span><h3>Admin</h3></a>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

        <main>
            <h1>PAYMENT MANAGEMENT</h1>

            <div class="insights">
                <div class="due">
                    <span class="material-symbols-outlined">attach_money</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Remaining payments</h3>
                            <h1>
                                <?php
                                    $sql11 = "SELECT * FROM student_enroll WHERE paid_month != '$currentYearMonth' OR paid_month IS NULL";
                                    $res11 = mysqli_query($conn, $sql11);

                                    $count11 = mysqli_num_rows($res11);

                                    echo $count11;
                                ?>
                            </h1>
                        </div>
                    </div>
                    <small class="text-muted">This month</small>
                </div>
                <!---------------------END OF EXPENSES---------------------->

                <div class="income">
                    <span class="material-symbols-outlined">price_check</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Paid Students</h3>
                            <h1>
                                <?php
                                    $sql12 = "SELECT * FROM student_enroll WHERE paid_month = '$currentYearMonth'";
                                    $res12 = mysqli_query($conn, $sql12);

                                    $count12 = mysqli_num_rows($res12);

                                    echo $count12;
                                ?>
                            </h1>
                        </div>
                    </div>
                    <small class="text-muted">This month</small>
                </div>

                <!---------------------END OF INCOME---------------------->
                <div class="t-income">
                    <span class="material-symbols-outlined">payments</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Income</h3>
                            <h1>
                                <?php
                                    $income_total = 0;

                                    $sql13 = "SELECT * FROM student_enroll WHERE paid_month = '$currentYearMonth'";
                                    $res13 = mysqli_query($conn, $sql13);

                                    $count13 = mysqli_num_rows($res13);

                                    if($count13>0){
                                        while($row=mysqli_fetch_assoc($res13)){
                                            $st_id = $row['st_id'];
                                            $cl_id = $row['cl_id'];

                                            $sql14 = "SELECT * FROM payments WHERE st_id = '$st_id' AND cl_id = '$cl_id'";
                                            $res14 = mysqli_query($conn, $sql14);

                                            $count14 = mysqli_num_rows($res14);

                                            if($count14>0){
                                                while($row=mysqli_fetch_assoc($res14)){
                                                    $amount = $row['amount'];

                                                    $income_total = $income_total + $amount;
                                                }
                                            }
                                        }
                                    }

                                    echo "RS. ".$income_total;
                                ?>
                            </h1>
                        </div>
                    </div>
                    <small class="text-muted">This month</small>
                </div>
            </div>


            <div class="recent-requests">
                <h2 style="margin-top: 5px; margin-bottom: 8px;">Pending Payments</h2>
                <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Username</th>
                        <th>Class ID</th>
                        <th>Class</th>
                        <th>Payable</th>
                        <th>Last Paid</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $sql = "SELECT * FROM student_enroll WHERE status = 'Paid' AND paid_month != '$currentYearMonth' LIMIT 5";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $st_id = $row['st_id'];
                            $cl_id = $row['cl_id'];
                            $paid_month = $row['paid_month'];


                            $sql2 = "SELECT * FROM student WHERE st_id = '$st_id'";

                            $res2 = mysqli_query($conn, $sql2);

                            $count2 = mysqli_num_rows($res2);

                            if($count2>0){
                                while($row=mysqli_fetch_assoc($res2)){
                                    $st_username = $row['st_username'];

                                }
                            }

                            $sql3 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

                            $res3 = mysqli_query($conn, $sql3);

                            $count3 = mysqli_num_rows($res3);

                            if($count3>0){
                                while($row=mysqli_fetch_assoc($res3)){
                                    $cl_title = $row['cl_title'];
                                    $cl_fee = $row['cl_fee'];
                                }
                            } ?>

                        <tr>
                            <td><?php echo $st_id; ?></td>
                            <td><?php echo $st_username; ?></td>
                            <td><?php echo $cl_id; ?></td>
                            <td><?php echo $cl_title; ?></td>
                            <td style="color: red;"><?php echo $cl_fee; ?></td>
                            <td>
                                <?php
                                    if($paid_month == ""){ ?>
                                        <h3 style="color: #A2CB55;">New Student</h3>
                                    <?php
                                    }else{ ?>
                                        <?php echo $paid_month; ?>
                                    <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <div onclick="loadContent01('<?php echo $cl_id; ?>', '<?php echo $st_id; ?>')" class="edit-btn-02">
                                    <button>Edit</button>
                                </div>
                            </td>
                        </tr>

                    <?php
                        }
                    ?>

                    <tr>
                        <td colspan="3">
                            <div class="edit-btn-04" >
                                <button style="margin-right: 10px; width: 100px;" onclick="openPopup()">Show all</button>
                            </div>
                        </td>
                        <td colspan="4">
                            <div class="edit-btn" >
                                <button style="margin-right: 10px; width: 120px; background-color:red;">Restrict all</button>
                            </div>
                        </td>

                    </tr>

                    <?php }else{ ?>
                        <tr>
                            <td colspan=7>
                                <h3 style="text-align: center; color: red;">No payments pending students found</h3>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                </table>



                <h2>Bank Slips</h2>
                    <table class="Category">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Classes</th>
                                <th>Bank Slip</th>
                                <th>Uploaded Date and Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                                $sql19 = "SELECT * FROM payments WHERE payment_method = 'Bank Deposit' ORDER BY id DESC LIMIT 5";

                                $res19 = mysqli_query($conn, $sql19);

                                $count19 = mysqli_num_rows($res19);

                                if($count19>0){
                                    while($row=mysqli_fetch_assoc($res19)){
                                        $st_id001 = $row['st_id'];
                                        $classes = $row['classes'];
                                        $Bslip = $row['transaction_id'];
                                        $DT = $row['payment_date'];
                                        $payment_status = $row['payment_status'];
                                         ?>

                                        
                                        <?php if($payment_status == "Pending"){ ?>
                                            <tr style="background-color: #21618C;">

                                        <?php }elseif($payment_status == "Completed"){ ?>
                                            <tr style="background-color: #117864;">

                                        <?php }else{ ?>
                                            <tr style="background-color: #C0392B;"> <?php } ?>
                                            
                                                <td><?php echo $st_id001; ?></td>
                                                <td><?php echo $classes; ?></td>
                                                <td style="cursor: pointer;">
                                                    <div onclick="loadContent02('<?php echo $Bslip; ?>')" class="edit-btn-02">
                                                        <div class="cl-img02"><img src="../images/payment-slip/<?php echo $Bslip; ?>" width="45px" height="35px"></div>
                                                    </div>
                                                </td>
                                                <td><?php echo $DT; ?></td>
                                                <td>
                                                    <div onclick="loadContent('<?php echo $cl_id; ?>', '<?php echo $st_id; ?>')" class="edit-btn-02">
                                                        <button>Edit</button>
                                                    </div>
                                                </td>
                                            </tr>

                                        <?php 
                                        }
                                    } 
                                    ?>

                            <?php if($paid_month_check == $currentYearMonth){ ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="edit-btn-04" >
                                            <button style="margin-right: 10px; width: 100px;" onclick="openPopup2()">Show all</button>
                                        </div>
                                    </td>
                                    <td colspan="4">
                                        <div class="edit-btn" >
                                            <a href="active-paid-students.php">
                                                <button style="margin-right: 10px; width: 160px; background-color:#D68910;">Active paid students</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php }else{ ?>
                                    <tr>
                                    <td colspan="9">
                                        <div class="edit-btn-04" >
                                            <button style="margin-right: 10px; width: 100px;" onclick="openPopup2()">Show all</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>



                <h2>Restricted Students</h2>
                    <table class="Category">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Username</th>
                                <th>Pending Total</th>
                                <th>Class</th>
                                <th>Mob no.</th>
                                <th>P. Name</th>
                                <th>P. Email</th>
                                <th>Last Paid</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                                $sql8 = "SELECT * FROM student_enroll WHERE status = 'Not Paid' ORDER BY id DESC LIMIT 5";

                                $res8 = mysqli_query($conn, $sql8);

                                $count8 = mysqli_num_rows($res8);

                                if($count8>0){
                                    while($row=mysqli_fetch_assoc($res8)){
                                        $st_id = $row['st_id'];
                                        $cl_id = $row['cl_id'];
                                        $paid_month_check = $row['paid_month'];

                                        $sql9 = "SELECT * FROM student WHERE st_id = '$st_id'";

                                        //execute the query
                                        $res9 = mysqli_query($conn, $sql9);

                                        $count9 = mysqli_num_rows($res9);

                                        if($count9>0){
                                            while($row=mysqli_fetch_assoc($res9)){
                                                $st_username = $row['st_username'];
                                                $st_phone = $row['st_phone'];
                                                $g_name = $row['g_name'];
                                                $g_email = $row['g_email'];
                                                $status = $row['status']; ?>

                                                <?php if($paid_month_check == $currentYearMonth){ ?>
                                                    <tr style="background-color: #641E16;">
                                                        <td><?php echo $st_id; ?></td>
                                                        <td><?php echo $st_username; ?></td>
                                                        <td>
                                                            <?php
                                                                $sql10 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

                                                                $res10 = mysqli_query($conn, $sql10);

                                                                $count10 = mysqli_num_rows($res10);

                                                                if($count10>0){
                                                                    while($row=mysqli_fetch_assoc($res10)){
                                                                        $cl_fee = $row['cl_fee'];
                                                                    }
                                                                }

                                                                echo $cl_fee;
                                                            ?>
                                                        </td>
                                                        <td><?php echo $cl_id; ?></td>
                                                        <td><?php echo $st_phone; ?></td>
                                                        <td><?php echo $g_name; ?></td>
                                                        <td><?php echo $g_email; ?></td>
                                                        <td>
                                                            <?php
                                                            if($paid_month_check == NULL){ ?>
                                                                <h3 style="color: #A2CB55;">New Student</h3>
                                                            <?php
                                                            }else{
                                                                echo $paid_month_check;
                                                            }?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if($status=="Active"){ ?>
                                                                    <div class="success">
                                                                        <?php echo $status; ?>
                                                                    </div> <?php
                                                                }
                                                                else{ ?>
                                                                    <div class="error">
                                                                        <?php echo $status; ?>
                                                                    </div> <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div onclick="loadContent('<?php echo $cl_id; ?>', '<?php echo $st_id; ?>')" class="edit-btn-02">
                                                                <button>Edit</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }else{ ?>

                                                    <tr>
                                                        <td><?php echo $st_id; ?></td>
                                                        <td><?php echo $st_username; ?></td>
                                                        <td>
                                                            <?php
                                                                $sql10 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

                                                                $res10 = mysqli_query($conn, $sql10);

                                                                $count10 = mysqli_num_rows($res10);

                                                                if($count10>0){
                                                                    while($row=mysqli_fetch_assoc($res10)){
                                                                        $cl_fee = $row['cl_fee'];
                                                                    }
                                                                }

                                                                echo $cl_fee;
                                                            ?>
                                                        </td>
                                                        <td><?php echo $cl_id; ?></td>
                                                        <td><?php echo $st_phone; ?></td>
                                                        <td><?php echo $g_name; ?></td>
                                                        <td><?php echo $g_email; ?></td>
                                                        <td>
                                                            <?php
                                                            if($paid_month_check == NULL){ ?>
                                                                <h3 style="color: #A2CB55;">New Student</h3>
                                                            <?php
                                                            }else{
                                                                echo $paid_month_check;
                                                            }?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if($status=="Active"){ ?>
                                                                    <div class="success">
                                                                        <?php echo $status; ?>
                                                                    </div> <?php
                                                                }
                                                                else{ ?>
                                                                    <div class="error">
                                                                        <?php echo $status; ?>
                                                                    </div> <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div onclick="loadContent('<?php echo $cl_id; ?>', '<?php echo $st_id; ?>')" class="edit-btn-02">
                                                                <button>Edit</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                        }

                                    }
                                }
                            ?>

                            <?php if($paid_month_check == $currentYearMonth){ ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="edit-btn-04" >
                                            <button style="margin-right: 10px; width: 100px;" onclick="openPopup2()">Show all</button>
                                        </div>
                                    </td>
                                    <td colspan="4">
                                        <div class="edit-btn" >
                                            <a href="active-paid-students.php">
                                                <button style="margin-right: 10px; width: 160px; background-color:#D68910;">Active paid students</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php }else{ ?>
                                    <tr>
                                    <td colspan="9">
                                        <div class="edit-btn-04" >
                                            <button style="margin-right: 10px; width: 100px;" onclick="openPopup2()">Show all</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                <h2>Paid Students</h2>
                    <table class="Category">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Paid Ammount</th>
                            <th>Date & Time</th>
                            <th>Paid Type</th>
                            <th>Class</th>
                            <th>Paid Month</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                    $sql15 = "SELECT * FROM student_enroll WHERE status = 'Paid' AND paid_month = '$currentYearMonth' ORDER BY id DESC LIMIT 5";

                    //execute the query
                    $res15 = mysqli_query($conn, $sql15);

                    $count15 = mysqli_num_rows($res15);

                    if($count15>0){
                        while($row=mysqli_fetch_assoc($res15)){
                            $st_id02 = $row['st_id'];
                            $cl_id = $row['cl_id'];
                            $paid_month = $row['paid_month'];


                            $sql16 = "SELECT * FROM student WHERE st_id = '$st_id02'";

                            $res16 = mysqli_query($conn, $sql16);

                            $count16 = mysqli_num_rows($res16);

                            if($count16>0){
                                while($row=mysqli_fetch_assoc($res16)){
                                    $st_username = $row['st_username'];

                                }
                            }

                            $sql17 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

                            $res17 = mysqli_query($conn, $sql17);

                            $count17 = mysqli_num_rows($res17);

                            if($count17>0){
                                while($row=mysqli_fetch_assoc($res17)){
                                    $cl_title = $row['cl_title'];
                                    $cl_fee = $row['cl_fee'];
                                }
                            }


                            $sql18 = "SELECT * FROM payments WHERE st_id = '$st_id' AND cl_id = '$cl_id'";

                            $res18 = mysqli_query($conn, $sql18);

                            $count18 = mysqli_num_rows($res18);

                            if($count18>0){
                                while($row=mysqli_fetch_assoc($res18)){
                                    $payment_date = $row['payment_date'];
                                    $paid_type = $row['paid_type'];
                                }
                            }

                            ?>

                        <tr>
                            <td><?php echo $st_id; ?></td>
                            <td><?php echo $st_username; ?></td>
                            <td><?php echo $cl_fee; ?></td>
                            <td><?php echo $payment_date; ?></td>
                            <td><?php echo $paid_type; ?></td>
                            <td><?php echo $cl_title; ?></td>
                            <td>
                                <?php
                                    if($paid_month == ""){ ?>
                                        <h3 style="color: #A2CB55;">New Student</h3>
                                    <?php
                                    }else{ ?>
                                        <?php echo $paid_month; ?>
                                    <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <div onclick="loadContent('<?php echo $cl_id; ?>', '<?php echo $st_id; ?>')" class="edit-btn-02">
                                    <button>Edit</button>
                                </div>
                            </td>
                        </tr>

                    <?php
                        }
                    }
                    ?>

                        <tr>
                            <td colspan="9">
                                <div class="edit-btn-04" >
                                    <button style="margin-right: 10px; width: 100px;" onclick="openPopup3()">Show all</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="pop_container">
                <div class="popup" id="popup">
                    <table class="Category">
                        <h2>DUE PAYMENTS</h2>
                        <thead>
                            <tr>
                                <th>S. ID</th>
                                <th>Username</th>
                                <th>Class</th>
                                <th>Teacher ID</th>
                                <th>Last Paid</th>
                                <th>Payable</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql4 = "SELECT * FROM student_enroll WHERE status = 'Paid' AND paid_month != '$currentYearMonth'";
                                //execute the query
                                $res4 = mysqli_query($conn, $sql4);

                                //count rows to check whether the category is available or not
                                $count4 = mysqli_num_rows($res4);

                                if($count4>0){
                                //categories available
                                while($row=mysqli_fetch_assoc($res4))
                                {
                                    $st_id = $row['st_id'];
                                    $cl_id = $row['cl_id'];
                                    $paid_month = $row['paid_month'];


                                    $sql5 = "SELECT * FROM student WHERE st_id = '$st_id'";
                                    //execute the query
                                    $res5 = mysqli_query($conn, $sql5);

                                    //count rows to check whether the category is available or not
                                    $count5 = mysqli_num_rows($res5);

                                    if($count5>0){

                                    while($row=mysqli_fetch_assoc($res5))
                                    {
                                        $st_username = $row['st_username'];

                                        $sql6 = "SELECT * FROM class WHERE cl_id = '$cl_id'";
                                        //execute the query
                                        $res6 = mysqli_query($conn, $sql6);

                                        $count6 = mysqli_num_rows($res6);

                                        if($count6>0){

                                        while($row=mysqli_fetch_assoc($res6))
                                        {
                                            $cl_title = $row['cl_title'];
                                            $cl_fee = $row['cl_fee'];
                                            $teacher_id = $row['em_id'];



                                            $sql7 = "SELECT * FROM student_enroll WHERE cl_id = '$cl_id' AND st_id = '$st_id'";

                                            $res7 = mysqli_query($conn, $sql7);

                                            $count7 = mysqli_num_rows($res7);

                                            if($count7>0){
                                                while($row=mysqli_fetch_assoc($res7))
                                                {
                                                    $paid_month01 = $row['paid_month'];
                                                }}
                                            ?>

                                        <tr>
                                            <td><?php echo $st_id; ?></td>
                                            <td><?php echo $st_username; ?></td>
                                            <td><?php echo $cl_id." - ".$cl_title; ?></td>
                                            <td><?php echo $teacher_id; ?></td>
                                            <td>
                                                <?php
                                                    if($paid_month == ""){ ?>
                                                        <h3 style="color: #A2CB55;">New Student</h3>
                                                    <?php
                                                    }else{ ?>
                                                        <?php echo $paid_month; ?>
                                                    <?php
                                                    }
                                                ?>
                                            </td>
                                            <td style="color: red;"><?php echo $cl_fee; ?></td>
                                            <td>
                                                <div onclick="loadContent01('<?php echo $cl_id; ?>', '<?php echo $st_id; ?>')" class="edit-btn-04">
                                                    <button>Edit</button>
                                                </div>
                                            </td>
                                        </tr>
                            <?php
                                }} }}

                             } }else{ ?>

                                <tr>
                                    <td colspan="7" class="warning">No due payments found.</td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                    <button class="error" type="button" onclick="closePopup()" style="background-color: #C70039;">Close</button>
                </div>
            </div>

            <div class="pop_container">
                <div class="popup2" id="popup2">
                    <table class="Category">
                        <h2>RESTRICTED STUDENTS</h2>
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Username</th>
                                <th>Pending Total</th>
                                <th>Class</th>
                                <th>Mob no.</th>
                                <th>P. Name</th>
                                <th>P. Email</th>
                                <th>Last Paid</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql8 = "SELECT * FROM student_enroll WHERE status = 'Not Paid' ORDER BY id DESC";

                                $res8 = mysqli_query($conn, $sql8);

                                $count8 = mysqli_num_rows($res8);

                                if($count8>0){
                                    while($row=mysqli_fetch_assoc($res8)){
                                        $st_id = $row['st_id'];
                                        $cl_id = $row['cl_id'];
                                        $paid_month_check = $row['paid_month'];

                                        $sql9 = "SELECT * FROM student WHERE st_id = '$st_id'";

                                        //execute the query
                                        $res9 = mysqli_query($conn, $sql9);

                                        $count9 = mysqli_num_rows($res9);

                                        if($count9>0){
                                            while($row=mysqli_fetch_assoc($res9)){
                                                $st_username = $row['st_username'];
                                                $st_phone = $row['st_phone'];
                                                $g_name = $row['g_name'];
                                                $g_email = $row['g_email'];
                                                $status01 = $row['status']; ?>

                                                <?php if($paid_month_check == $currentYearMonth){ ?>
                                                    <tr style="background-color: #641E16;">
                                                        <td><?php echo $st_id; ?></td>
                                                        <td><?php echo $st_username; ?></td>
                                                        <td>
                                                            <?php
                                                                $sql10 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

                                                                $res10 = mysqli_query($conn, $sql10);

                                                                $count10 = mysqli_num_rows($res10);

                                                                if($count10>0){
                                                                    while($row=mysqli_fetch_assoc($res10)){
                                                                        $cl_fee = $row['cl_fee'];
                                                                    }
                                                                }

                                                                echo $cl_fee;
                                                            ?>
                                                        </td>
                                                        <td><?php echo $cl_id; ?></td>
                                                        <td><?php echo $st_phone; ?></td>
                                                        <td><?php echo $g_name; ?></td>
                                                        <td><?php echo $g_email; ?></td>
                                                        <td>
                                                            <?php
                                                                if($paid_month_check == ""){ ?>
                                                                    <h3 style="color: #A2CB55;">New Student</h3>
                                                                <?php
                                                                }else{ ?>
                                                                    <?php echo $paid_month_check; ?>
                                                                <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if($status01=="Active"){ ?>
                                                                    <div class="success">
                                                                        <?php echo $status01; ?>
                                                                    </div> <?php
                                                                }
                                                                else{ ?>
                                                                    <div class="error">
                                                                        <?php echo $status01; ?>
                                                                    </div>
                                                                <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div onclick="loadContent('<?php echo $cl_id; ?>', '<?php echo $st_id; ?>')" class="edit-btn-01">
                                                                <button>Edit</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }else{ ?>

                                                    <tr>
                                                        <td><?php echo $st_id; ?></td>
                                                        <td><?php echo $st_username; ?></td>
                                                        <td>
                                                            <?php
                                                                $sql10 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

                                                                $res10 = mysqli_query($conn, $sql10);

                                                                $count10 = mysqli_num_rows($res10);

                                                                if($count10>0){
                                                                    while($row=mysqli_fetch_assoc($res10)){
                                                                        $cl_fee = $row['cl_fee'];
                                                                    }
                                                                }

                                                                echo $cl_fee;
                                                            ?>
                                                        </td>
                                                        <td><?php echo $cl_id; ?></td>
                                                        <td><?php echo $st_phone; ?></td>
                                                        <td><?php echo $g_name; ?></td>
                                                        <td><?php echo $g_email; ?></td>
                                                        <td>
                                                            <?php
                                                                if($paid_month_check == ""){ ?>
                                                                    <h3 style="color: #A2CB55;">New Student</h3>
                                                                <?php
                                                                }else{ ?>
                                                                    <?php echo $paid_month_check; ?>
                                                                <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if($status=="Active"){ ?>
                                                                    <div class="success">
                                                                        <?php echo $status; ?>
                                                                    </div> <?php
                                                                }
                                                                else{ ?>
                                                                    <div class="error">
                                                                        <?php echo $status; ?>
                                                                    </div> <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div onclick="loadContent('<?php echo $cl_id; ?>', '<?php echo $st_id; ?>')" class="edit-btn-01">
                                                                <button>Edit</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                        }

                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <button class="error" type="button" onclick="closePopup2()" style="background-color: #C70039;">Close</button>
                    <div class="edit-btn" >
                        <a href="active-paid-students.php">
                            <button style="margin-right: 10px; width: 160px; background-color:#D68910;">Active paid students</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="pop_container">
                <div class="popup3" id="popup3">
                    <h2>PAID STUDENTS</h2>
                    <table class="Category">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Paid Ammount</th>
                                <th>Date & Time</th>
                                <th>Paid Type</th>
                                <th>Class</th>
                                <th>Paid Month</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                        $sql15 = "SELECT * FROM student_enroll WHERE status = 'Paid' AND paid_month = '$currentYearMonth' ORDER BY id DESC";

                        //execute the query
                        $res15 = mysqli_query($conn, $sql15);

                        $count15 = mysqli_num_rows($res15);

                        if($count15>0){
                            while($row=mysqli_fetch_assoc($res15)){
                                $st_id = $row['st_id'];
                                $cl_id = $row['cl_id'];
                                $paid_month = $row['paid_month'];


                                $sql16 = "SELECT * FROM student WHERE st_id = '$st_id'";

                                $res16 = mysqli_query($conn, $sql16);

                                $count16 = mysqli_num_rows($res16);

                                if($count16>0){
                                    while($row=mysqli_fetch_assoc($res16)){
                                        $st_username = $row['st_username'];

                                    }
                                }

                                $sql17 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

                                $res17 = mysqli_query($conn, $sql17);

                                $count17 = mysqli_num_rows($res17);

                                if($count17>0){
                                    while($row=mysqli_fetch_assoc($res17)){
                                        $cl_title = $row['cl_title'];
                                        $cl_fee = $row['cl_fee'];
                                    }
                                }


                                $sql18 = "SELECT * FROM payments WHERE st_id = '$st_id' AND cl_id = '$cl_id'";

                                $res18 = mysqli_query($conn, $sql18);

                                $count18 = mysqli_num_rows($res18);

                                if($count18>0){
                                    while($row=mysqli_fetch_assoc($res18)){
                                        $payment_date = $row['payment_date'];
                                        $paid_type = $row['paid_type'];
                                    }
                                }

                                ?>

                            <tr>
                                <td><?php echo $st_id; ?></td>
                                <td><?php echo $st_username; ?></td>
                                <td><?php echo $cl_fee; ?></td>
                                <td><?php echo $payment_date; ?></td>
                                <td><?php echo $paid_type; ?></td>
                                <td><?php echo $cl_title; ?></td>
                                <td>
                                    <?php
                                        if($paid_month == ""){ ?>
                                            <h3 style="color: #A2CB55;">New Student</h3>
                                        <?php
                                        }else{ ?>
                                            <?php echo $paid_month; ?>
                                        <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <div onclick="loadContent('<?php echo $cl_id; ?>', '<?php echo $st_id; ?>')" class="edit-btn-02">
                                        <button>Edit</button>
                                    </div>
                                </td>
                            </tr>

                        <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <button class="error" type="button" onclick="closePopup3()" style="background-color: #C70039;">Close</button>
                </div>
            </div>

            <!---------------------END OF MAIN---------------------->
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

<!---------------------------------------------------------- Modal ---------------------------------------------------------->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div id="modalContent">
                        <!-- Class details will be displayed here -->
                    </div>
                </div>
            </div>

<!---------------------------------------------------------- End of Modal ----------------------------------------------------->

<!---------------------------------------------------------- Modal ---------------------------------------------------------->
            <div id="myModal01" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal01()">&times;</span>
                    <div id="modalContent01">
                        <!-- Class details will be displayed here -->
                    </div>
                </div>
            </div>

<!---------------------------------------------------------- End of Modal ----------------------------------------------------->

<!---------------------------------------------------------- Modal ---------------------------------------------------------->
            <div id="myModal02" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal02()">&times;</span>
                    <div id="modalContent02">
                        <!-- Class details will be displayed here -->
                    </div>
                </div>
            </div>

<!---------------------------------------------------------- End of Modal ----------------------------------------------------->

        </main>
    </div>

    <script src="./index.js"></script>

    <script>

        let popup = document.getElementById("popup");

        function openPopup(){
            popup.classList.add("open-popup");
        }

        function closePopup(){
            popup.classList.remove("open-popup");
        }



        let popup1 = document.getElementById("popup1");

        function openPopup1(){
            popup1.classList.add("open-popup1");
        }

        function closePopup1(){
            popup1.classList.remove("open-popup1");
        }



        let popup2 = document.getElementById("popup2");

        function openPopup2(){
            popup2.classList.add("open-popup2");
        }

        function closePopup2(){
            popup2.classList.remove("open-popup2");
        }


        let popup3 = document.getElementById("popup3");

        function openPopup3(){
            popup3.classList.add("open-popup3");
        }

        function closePopup3(){
            popup3.classList.remove("open-popup3");
        }

    </script>

    <script>
        $(document).ready(function() {
            $('#banButton').click(function(e) {
                e.preventDefault(); // Prevent the default click behavior (refreshing the page)

                var st_id = $(this).data('student-id');
                var cl_id = $(this).data('class-id');

                // Send data to ban-student.php using AJAX
                $.ajax({
                    type: 'POST',
                    url: 'ban-student.php',
                    data: {
                        st_id: st_id,
                        cl_id: cl_id
                    },
                    success: function(response) {
                        // Update the confirmation message with the response from ban-student.php
                        $('#confirmationMessage').html(response);
                    }
                });
            });
        });
    </script>

    <script>
        // Get the modal element
        var modal = document.getElementById("myModal");

        // Function to open the modal
        function openModal() {
            modal.style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Function to load content into the modal
        function loadContent(cl_id, st_id) {
            var modalContent = document.getElementById("modalContent");

            $.ajax({
                url: 'banned-student-process.php',
                method: "POST",
                data: { cl_id: cl_id, st_id: st_id }, // Pass both cl_id and st_id
                success: function (response) {
                    // Check if response is valid
                    if (typeof response === 'object' && response !== null) {
                        // Populate the modal with the retrieved content
                        modalContent.innerHTML = `
                            <div class="popup1">
                                <h2>UPDATE RESTRICTED STUDENTS</h2>
                                <form action="update-ban-student.php" method="post">
                                    <table>
                                        <tr>
                                            <td>Status: </td>
                                            <td>
                                                <select name="status" required>
                                                    <option value="${response.status}">${response.status}</option>
                                                    <option value="Paid">Paid</option>
                                                    <option value="Not Paid">Not Paid</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <input type="hidden" name="cl_id" value="${response.cl_id}">
                                        <input type="hidden" name="st_id" value="${response.st_id}">
                                    </table>

                                    <div class="save">
                                        <button type="submit" name="update">Save</button>
                                    </div>
                                </form>
                            </div>
                        `;
                    } else {
                        modalContent.innerHTML = "Error: Failed to load class details.";
                    }

                    openModal(); // Open the modal
                },
                error: function () {
                    modalContent.innerHTML = "Error: Failed to load class details.";
                    openModal(); // Open the modal to show the error message
                }
            });
        }
    </script>

    <script>
        // Get the modal element
        var modal01 = document.getElementById("myModal01");

        // Function to open the modal
        function openModal01() {
            modal01.style.display = "block";
        }

        // Function to close the modal
        function closeModal01() {
            modal01.style.display = "none";
        }

        // Function to load content into the modal
        function loadContent01(cl_id, st_id) {
            var modalContent01 = document.getElementById("modalContent01");

            $.ajax({
                url: 'banned-student-process.php',
                method: "POST",
                data: { cl_id: cl_id, st_id: st_id }, // Pass both cl_id and st_id
                success: function (response) {
                    // Check if response is valid
                    if (typeof response === 'object' && response !== null) {
                        // Populate the modal with the retrieved content
                        modalContent01.innerHTML = `
                            <div class="popup1">
                                <h2>UPDATE PAYMENT PENDING STUDENTS</h2>
                                <form action="restrict-student.php" method="post">
                                    <table>
                                        <tr>
                                            <td>Status: </td>
                                            <td>
                                                <select name="status" required>
                                                    <option value="Paid">Paid</option>
                                                    <option value="Not Paid">Restrict</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <input type="hidden" name="cl_id" value="${response.cl_id}">
                                        <input type="hidden" name="st_id" value="${response.st_id}">
                                    </table>

                                    <div class="save">
                                        <button type="submit" name="update">Save</button>
                                    </div>
                                </form>
                            </div>
                        `;
                    } else {
                        modalContent01.innerHTML = "Error: Failed to load class details.";
                    }

                    openModal01(); // Open the modal
                },
                error: function () {
                    modalContent01.innerHTML = "Error: Failed to load class details.";
                    openModal01(); // Open the modal to show the error message
                }
            });
        }
    </script>

    <script>
        var modal02 = document.getElementById("myModal02");

        function openModal02() {
            modal02.style.display = "block";
        }

        function closeModal02() {
            modal02.style.display = "none";
        }

        function loadContent02(Bslip) {
            var modalContent02 = document.getElementById("modalContent02");

            modalContent02.innerHTML = "<img src='../images/payment-slip/" + Bslip + "' width='70%' height='auto'>";

            openModal02();
        };
    </script>

    <?php
        if(isset($_SESSION['padi-st-update-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Updated!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['padi-st-update-ok']); } ?>

    <?php
        if(isset($_SESSION['padi-st-update-error'])){ ?>
        <script>
            swal({
                title: "Faid to update.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['padi-st-update-error']); } ?>

    <?php
        if(isset($_SESSION['padi-st-update-all-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Updated All Students",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['padi-st-update-all-ok']); } ?>

    <?php
        if(isset($_SESSION['padi-st-update-all-error'])){ ?>
        <script>
            swal({
                title: "Faid to update!Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['padi-st-update-all-error']); } ?>

</body>
</html>
