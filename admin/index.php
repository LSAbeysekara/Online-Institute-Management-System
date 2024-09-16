<?php include('config/constant.php') ?>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="./sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
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
                <a href="#" class="active"><span class="material-symbols-outlined"> grid_view </span><h3>Dashboard</h3></a>
                <a href="class.php"><span class="material-symbols-outlined"> menu_book </span><h3>Classes</h3></a>
                <a href="teacher.php"><span class="material-symbols-outlined"> group </span><h3>Teacher Panel</h3></a>
                <a href="student.php"><span class="material-symbols-outlined"> groups </span><h3>Student Panel</h3></a>
                <a href="homework.php"><span class="material-symbols-outlined">library_books</span><h3>Homework</h3></a>
                <a href="payment.php"><span class="material-symbols-outlined"> payments </span><h3>Payments</h3></a>
                <!-- <a href="#"><span class="material-symbols-outlined"> account_balance </span><h3>Accounting Section</h3></a> -->
                <a href="exam.php"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="#"><span class="material-symbols-outlined"> feedback </span><h3>Feedback</h3><span class="message-count">20</span></a>
                <a href="notification.php"><span class="material-symbols-outlined">campaign</span><h3>Notification Panel</h3></a>
                <a href="admin.php"><span class="material-symbols-outlined">shield_person</span><h3>Admin</h3></a>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

        <main>
            <h1>DASHBOARD</h1>

            <?php
                $sql7 = "SELECT COUNT(*) FROM student";

                $res7 = mysqli_query($conn, $sql7);

                if($res7) {
                    $row = mysqli_fetch_array($res7);
                    $st_count = $row[0];
                }

            ?>
            
            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-outlined">group</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Students</h3>
                            <h1><?php echo $st_count; ?></h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
                    $sql8 = "SELECT COUNT(*) FROM employee WHERE em_position = 'Teacher'";

                    $res8 = mysqli_query($conn, $sql8);

                    if($res8) {
                        $row = mysqli_fetch_array($res8);
                        $teacher_count = $row[0];
                    }

                ?>

                <div class="expenses">
                    <span class="material-symbols-outlined">record_voice_over</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Teachers</h3>
                            <h1><?php echo $teacher_count; ?></h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="36" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>78%</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <?php
                    $sql9 = "SELECT * FROM payments";
                    
                    $res9 = mysqli_query($conn, $sql9);

                    $count9 = mysqli_num_rows($res9);

                    if($count9>0){
                        $amount = 0;
                        while($row=mysqli_fetch_assoc($res9))
                        {
                            $amount01 = $row['amount'];
                            $amount = $amount + $amount01;
                        }
                    }

                ?>

                <div class="income">
                    <span class="material-symbols-outlined">payments</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Income</h3>
                            <h1>Rs <?php echo $amount; ?></h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div><br>
                </div>
                
                <!---------------------END OF INCOME---------------------->
            </div>
                <!---------------------END OF INSIGHTS---------------------->
            
            <div class="recent-requests">
                <h2>Recent Requests</h2>
                <table>
                <thead>
                    <tr>
                        <th>S. ID</th>
                        <th>Username</th>
                        <th>Student Age</th>
                        <th>Requesting Class</th>
                        <th>Teacher ID</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //create sql query to display categories from database
                        $sql = "SELECT * FROM request LIMIT 5";
                        //execute the query
                        $res = mysqli_query($conn, $sql);

                        //count rows to check whether the category is available or not
                        $count = mysqli_num_rows($res);

                        if($count>0){
                        //categories available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the values
                            $req_id = $row['req_id'];
                            $st_id = $row['st_id'];
                            $cl_id = $row['cl_id'];
                            

                            $sql2 = "SELECT * FROM student WHERE st_id = '$st_id'";
                            //execute the query
                            $res2 = mysqli_query($conn, $sql2);

                            //count rows to check whether the category is available or not
                            $count2 = mysqli_num_rows($res2);

                            if($count2>0){

                            while($row=mysqli_fetch_assoc($res2))
                            {
                                $st_username = $row['st_username'];
                                $st_age = $row['st_age'];

                                $sql3 = "SELECT * FROM class WHERE cl_id = '$cl_id'";
                                //execute the query
                                $res3 = mysqli_query($conn, $sql3);

                                //count rows to check whether the category is available or not
                                $count3 = mysqli_num_rows($res3);

                                if($count3>0){

                                while($row=mysqli_fetch_assoc($res3))
                                {
                                    $cl_title = $row['cl_title'];
                                    $teacher_id = $row['em_id'];
                                
                                ?>
                                <tr>
                                    <td><?php echo $st_id; ?></td>
                                    <td><?php echo $st_username; ?></td>
                                    <td><?php echo $st_age; ?></td>
                                    <td><?php echo $cl_id;  ?> - <?php echo $cl_title; ?></td>
                                    <td><?php echo $teacher_id; ?></td>
                                    <td class="approve">
                                        <a href="req-accept.php?req_id=<?php echo $req_id; ?>">Accept</a>
                                    </td>
                                    <td class="error-btn">
                                        <a href="#" class="reject-link" data-req-id="<?php echo $req_id; ?>">Reject</a>
                                    </td>
                                </tr> 
                            <?php 
                                }}
                            }}
                        } ?>

                        <tr>
                            <td colspan="3">
                                <div class="edit-btn-04" >
                                    <button style="margin-right: 10px; width: 100px;" onclick="openPopup()">Show all</button>
                                </div> 
                            </td>
                            <td colspan="4">
                                <a href="req-accept-all.php?req_id=<?php echo $req_id; ?>">
                                    <div class="edit-btn" >
                                        <button style="margin-right: 10px; width: 120px;">Accept all</button>
                                    </div> 
                                </a>
                            </td>
                        </tr>

                    <?php
                    }
                    else{ ?>

                        <tr>
                            <td colspan="7" class="warning">No new requests found.</td>
                        </tr>
                                                
                    <?php }?>

                </tbody>
            </table>

            </div>

            <!-------------------------------floating panel--------------------------->
            
            
            <div class="pop_container">
                <div class="popup" id="popup">
                    <table class="Category">
                        <h2>REQUESTS TO JOIN CLASSES</h2>
                        <thead>
                            <tr>
                                <th>S. ID</th>
                                <th>Username</th>
                                <th>Student Age</th>
                                <th>Requesting Class</th>
                                <th>Teacher ID</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql1 = "SELECT * FROM request";
                                //execute the query
                                $res1 = mysqli_query($conn, $sql1);
        
                                //count rows to check whether the category is available or not
                                $count1 = mysqli_num_rows($res1);

                                if($count1>0){
                                //categories available
                                while($row=mysqli_fetch_assoc($res1))
                                {
                                    //get the values
                                    $req_id1 = $row['req_id'];
                                    $st_id1 = $row['st_id'];
                                    $cl_id1 = $row['cl_id'];
                                    

                                    $sql2 = "SELECT * FROM student WHERE st_id = '$st_id1'";
                                    //execute the query
                                    $res2 = mysqli_query($conn, $sql2);

                                    //count rows to check whether the category is available or not
                                    $count2 = mysqli_num_rows($res2);

                                    if($count2>0){

                                    while($row=mysqli_fetch_assoc($res2))
                                    {
                                        $st_username = $row['st_username'];
                                        $st_age = $row['st_age'];

                                        $sql3 = "SELECT * FROM class WHERE cl_id = '$cl_id1'";
                                        //execute the query
                                        $res3 = mysqli_query($conn, $sql3);

                                        $count3 = mysqli_num_rows($res3);

                                        if($count3>0){

                                        while($row=mysqli_fetch_assoc($res3))
                                        {
                                            $cl_title = $row['cl_title'];
                                            $teacher_id = $row['em_id'];
                                        
                                        ?>

                                        <tr>
                                            <td><?php echo $st_id; ?></td>
                                            <td><?php echo $st_username; ?></td>
                                            <td><?php echo $st_age; ?></td>
                                            <td><?php echo $cl_id;  ?> - <?php echo $cl_title; ?></td>
                                            <td><?php echo $teacher_id; ?></td>
                                            <td class="approve">
                                                <a href="req-accept.php?req_id=<?php echo $req_id1; ?>">Accept</a>
                                            </td>
                                            <td class="error-btn">
                                                <a href="#" class="reject-link" data-req-id="<?php echo $req_id1; ?>">Reject</a>
                                            </td>
                                        </tr> 
                            <?php 
                                }} }}
                                
                             } }else{ ?>

                                <tr>
                                    <td colspan="6" class="warning">No requests found.</td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                    <button class="error" type="button" onclick="closePopup()" style="background-color: #C70039;">Close</button>
                </div>
            </div>
            
            <!-------------------------------floating panel ends here--------------------------->

            
        </main>
            <!---------------------END OF MAIN---------------------->
        
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-symbols-outlined">menu</span>
                </button>
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
                <!---------------------END OF TOP---------------------->
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">
                    <div class="update">

                        <?php
                            $sql4 = "SELECT * FROM student_enroll ORDER BY id DESC LIMIT 4";

                            $res4 = mysqli_query($conn, $sql4);
                    
                            $count4 = mysqli_num_rows($res4);
                    
                            if($count4>0){
                                
                                while($row=mysqli_fetch_assoc($res4)){
                                    
                                    $st_enr_id = $row['st_enr_id'];
                                    $st_id02 = $row['st_id'];
                                    $cl_id02 = $row['cl_id'];
                                    $enr_date = $row['enr_date'];

                                    
                                    date_default_timezone_set('Asia/Colombo');

                                    
                                    $currentDateTime = new DateTime();

                                    
                                    $enr_date01 = new DateTime($enr_date);

                                    
                                    $timeDifference = $currentDateTime->diff($enr_date01);

                                    
                                    $totalSeconds = $timeDifference->s + $timeDifference->i * 60 + $timeDifference->h * 3600 + $timeDifference->d * 86400;




                                    $sql5 = "SELECT * FROM student WHERE st_id = '$st_id02'";

                                    
                                    $res5 = mysqli_query($conn, $sql5);
                            
                                    
                                    $count5 = mysqli_num_rows($res5);
                            
                                    if($count5>0){
                                        
                                        while($row=mysqli_fetch_assoc($res5)){
                                            
                                            $st_id = $row['st_id'];
                                            $st_username = $row['st_username']; 
                                            $st_img01 = $row['st_img']; ?>

                                            <div class="profile-photo">
                                                <img src="../images/profile-pic/<?php echo $st_img01; ?>">
                                            </div>
                                            <div class="message">
                                                <p><b><?php echo $st_username; ?></b> joined the class - <?php echo $cl_id02; ?></p>
                                                <small class="text-muted">
                                                    <?php
                                                    
                                                        if ($timeDifference->d > 0) {
                                                            echo $timeDifference->d . ' days';
                                                        } elseif ($timeDifference->h > 0) {
                                                            echo $timeDifference->h . ' hours';
                                                        } elseif ($timeDifference->i > 0) {
                                                            echo $timeDifference->i . ' minutes';
                                                        } else {
                                                            echo $totalSeconds . ' seconds';
                                                        }
                                                        echo " ago.";
                                                    ?>
                                                </small>
                                            </div>

                                        <?php
                                        }
                                    }
                    
                                }
                            }

                        ?>
                    </div>
                </div>
                
            </div>
                <!---------------------END OF RECENT UPDATES---------------------->
            <div class="new-users">
                <h2>New Users</h2>
                <div class="users">
                    
                    <?php
                    $sql6 = "SELECT * FROM student ORDER BY id DESC LIMIT 4";

                    
                    $res6 = mysqli_query($conn, $sql6);

                    
                    $count6 = mysqli_num_rows($res6);

                    if($count6>0){
                        
                        while($row=mysqli_fetch_assoc($res6)){
                            
                            $st_username01 = $row['st_username'];
                            $st_img02 = $row['st_img'];
                            $reg_date = $row['reg_date'];

                            
                            date_default_timezone_set('Asia/Colombo');

                            
                            $currentDateTime = new DateTime();

                            
                            $reg_date01 = new DateTime($reg_date);

                            
                            $timeDifference = $currentDateTime->diff($reg_date01);

                            
                            $totalSeconds = $timeDifference->s + $timeDifference->i * 60 + $timeDifference->h * 3600 + $timeDifference->d * 86400; ?>

                            <div class="user">
                                <div class="profile-photo">
                                    <img src="../images/profile-pic/<?php echo $st_img02; ?>">
                                </div>
                                <div class="message">
                                    <p><b><?php echo $st_username01; ?></b> - Student </p>
                                    <p>
                                        <small class="text-muted">
                                            <?php
                                            
                                                if ($timeDifference->d > 0) {
                                                    echo $timeDifference->d . ' days';
                                                } elseif ($timeDifference->h > 0) {
                                                    echo $timeDifference->h . ' hours';
                                                } elseif ($timeDifference->i > 0) {
                                                    echo $timeDifference->i . ' minutes';
                                                } else {
                                                    echo $totalSeconds . ' seconds';
                                                }
                                                echo " ago.";
                                            ?>
                                        </small>
                                    </p>
                                </div>
                            </div>
                    
                    <?php
                        }}
                        ?>
                    
                </div>
            </div>
        </div>
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

    </script>

    <script>
        
        document.body.addEventListener('click', function (event) {
            
            if (event.target.classList.contains('reject-link')) {
                event.preventDefault(); 
                
                var req_id = event.target.getAttribute('data-req-id');

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this details!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        
                        window.location.href = `req-reject.php?req_id=${req_id}`;
                    } else {
                        
                    }
                });
            }
        });
    </script>
    
</body>
</html>

    <?php if(isset($_SESSION['login-status-01'])){ ?>
        <script>
            swal({
                title: "Successfully Logged in",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['login-status-01']); } ?>

    <?php if(isset($_SESSION['req-delete-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Deleted!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['req-delete-ok']); } ?>

    <?php if(isset($_SESSION['req-delete-error'])){ ?>
        <script>
            swal({
                title: "Failed to delete the request!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['req-delete-error']); } ?>

    <?php if(isset($_SESSION['req-accept-ok'])){ ?>
        <script>
            swal({
                title: "Request Accepted!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['req-accept-ok']); } ?>

    <?php if(isset($_SESSION['req-accept-error'])){ ?>
        <script>
            swal({
                title: "Failed to accept the request! Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['req-accept-error']); } ?>

    <?php if(isset($_SESSION['req-accept-all-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Accepted All Requests!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['req-accept-all-ok']); } ?>

    <?php if(isset($_SESSION['req-accept-all-error'])){ ?>
        <script>
            swal({
                title: "Failed to accept the requests! Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['req-accept-all-error']); } ?>
    