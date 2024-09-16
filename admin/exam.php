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
        $res10 = mysqli_query($conn, $sql10);

        $count10 = mysqli_num_rows($res10);

        if($count10>0){
            while($row=mysqli_fetch_assoc($res10)){
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
                <a href="payment.php"><span class="material-symbols-outlined"> payments </span><h3>Payments</h3></a>
                <!-- <a href="account.php"><span class="material-symbols-outlined"> account_balance </span><h3>Accounting Section</h3></a> -->
                <a href="#0" class="active"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="feedback.php"><span class="material-symbols-outlined"> feedback </span><h3>Feedback</h3><span class="message-count">20</span></a>
                <a href="notification.php"><span class="material-symbols-outlined">campaign</span><h3>Notification Panel</h3></a>
                <a href="admin.php"><span class="material-symbols-outlined">shield_person</span><h3>Admin</h3></a>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

        <main>
            <br>
            <h1>EXAM MANAGEMENT</h1>
            <div class="recent-requests">

                <div class="search">
                    <form action="" method="post">
                            <input type="search" name="search" placeholder=" Enter Exam ID or Exam Title or Class ID">
                            <input type="submit" name="searchSubmit">
                    </form>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Exam ID</th>
                            <th>Exam Title</th>
                            <th>Class ID</th>
                            <th>Class Title</th>
                            <th>Teacher ID</th>
                            <th>Teacher's Name</th>
                            <th>Date & Time</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_POST['searchSubmit'])){

                            $searches = $_POST['search'];

                            $sql = "SELECT * FROM exams WHERE ex_id LIKE '%$searches%' OR cl_id LIKE '%$searches%' OR ex_title LIKE '%$searches%'";

                            $res = mysqli_query($conn, $sql);
                    
                            $count = mysqli_num_rows($res);
                    
                            if($count>0){
                                
                                while($row=mysqli_fetch_assoc($res)){
                                    $ex_id = $row['ex_id'];
                                    $ex_title = $row['ex_title'];
                                    $ex_time = $row['ex_time'];
                                    $ex_date_time = $row['ex_date_time'];
                                    $question_count = $row['question_count'];
                                    $cl_id = $row['cl_id'];
                                    $created = $row['created'];
                                    $ex_status = $row['ex_status']; 

                                    $sql1 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

                                    $res1 = mysqli_query($conn, $sql1);

                                    $count1 = mysqli_num_rows($res1);

                                    if($count1>0){
                                        
                                        while($row=mysqli_fetch_assoc($res1)){
                                            $cl_title = $row['cl_title'];
                                        }
                                    }


                                    $sql2 = "SELECT * FROM employee WHERE em_id = '$created'";

                                    $res2 = mysqli_query($conn, $sql2);

                                    $count2 = mysqli_num_rows($res2);

                                    if($count2>0){
                                        
                                        while($row=mysqli_fetch_assoc($res2)){
                                            $em_username = $row['em_username'];
                                        }
                                    } ?>

                                    <tr>
                                        <td><?php echo $ex_id; ?></td>
                                        <td><?php echo $ex_title; ?></td>
                                        <td><?php echo $cl_id; ?></td>
                                        <td><?php echo $cl_title; ?></td>
                                        <td><?php echo $created; ?></td>
                                        <td><?php echo $em_username; ?></td>
                                        <td>
                                            <?php
                                                $timezone = new DateTimeZone('Asia/Colombo');
                                                $new_hw_expire = new DateTime($ex_date_time, $timezone);
                                                $currentDateTimeObj = new DateTime('now', $timezone);

                                                $timeDifference = $currentDateTimeObj->diff($new_hw_expire);

                                                if ($timeDifference->invert == 1) {
                                                    echo '<p style="color: #C70039;">' . $ex_date_time . '</p>';
                                                } else {
                                                    echo '<p style="color: #41f1b6;">' . $ex_date_time . '<p>';
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $ex_time; ?> minutes</td>
                                        <td>
                                            <?php 
                                                if($ex_status=="Active"){ ?>
                                                    <div class="success">
                                                        <?php echo $ex_status; ?>
                                                    </div> <?php
                                                }
                                                else{ ?>
                                                    <div class="error">
                                                        <?php echo $ex_status; ?>
                                                    </div> <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <div onclick="loadContent('<?php echo $ex_id; ?>')" class="edit-btn-02">
                                                <button class="pop_btn">Edit</button>
                                            </div>    
                                        </td>
                                    </tr>

                                <?php
                                }
                            }else{ ?>
                                <tr>
                                    <td colspan="10" style="color: red;"><h3>No record found for your search.</h3></td>
                                </tr>
                            <?php
                            }

                        }else{
                            $sql = "SELECT * FROM exams";

                            $res = mysqli_query($conn, $sql);
                    
                            $count = mysqli_num_rows($res);
                    
                            if($count>0){
                                
                                while($row=mysqli_fetch_assoc($res)){
                                    $ex_id = $row['ex_id'];
                                    $ex_title = $row['ex_title'];
                                    $ex_time = $row['ex_time'];
                                    $ex_date_time = $row['ex_date_time'];
                                    $question_count = $row['question_count'];
                                    $cl_id = $row['cl_id'];
                                    $created = $row['created'];
                                    $ex_status = $row['ex_status'];


                                    $sql1 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

                                    $res1 = mysqli_query($conn, $sql1);

                                    $count1 = mysqli_num_rows($res1);

                                    if($count1>0){
                                        
                                        while($row=mysqli_fetch_assoc($res1)){
                                            $cl_title = $row['cl_title'];
                                        }
                                    }


                                    $sql2 = "SELECT * FROM employee WHERE em_id = '$created'";

                                    $res2 = mysqli_query($conn, $sql2);

                                    $count2 = mysqli_num_rows($res2);

                                    if($count2>0){
                                        
                                        while($row=mysqli_fetch_assoc($res2)){
                                            $em_username = $row['em_username'];
                                        }
                                    } ?>

                                    <tr>
                                        <td><?php echo $ex_id; ?></td>
                                        <td><?php echo $ex_title; ?></td>
                                        <td><?php echo $cl_id; ?></td>
                                        <td><?php echo $cl_title; ?></td>
                                        <td><?php echo $created; ?></td>
                                        <td><?php echo $em_username; ?></td>
                                        <td>
                                            <?php
                                                $timezone = new DateTimeZone('Asia/Colombo');
                                                $new_hw_expire = new DateTime($ex_date_time, $timezone);
                                                $currentDateTimeObj = new DateTime('now', $timezone);

                                                $timeDifference = $currentDateTimeObj->diff($new_hw_expire);

                                                if ($timeDifference->invert == 1) {
                                                    echo '<p style="color: #C70039;">' . $ex_date_time . '</p>';
                                                } else {
                                                    echo '<p style="color: #41f1b6;">' . $ex_date_time . '<p>';
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $ex_time; ?> minutes</td>
                                        <td>
                                            <?php 
                                                if($ex_status=="Active"){ ?>
                                                    <div class="success">
                                                        <?php echo $ex_status; ?>
                                                    </div> <?php
                                                }
                                                else{ ?>
                                                    <div class="error">
                                                        <?php echo $ex_status; ?>
                                                    </div> <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <div onclick="loadContent('<?php echo $ex_id; ?>')" class="edit-btn-02">
                                                <button class="pop_btn">Edit</button>
                                            </div>    
                                        </td>
                                    </tr>

                                <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
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


            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div id="modalContent">
                    </div>
                </div>
            </div>
  
                </div>
            </main>
    </div>

    <script src="./index.js"></script>

    <script>
        var modal = document.getElementById("myModal");

        function openModal() {
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
        }
        function loadContent(item) {
        var modalContent = document.getElementById("modalContent");

        $.ajax({
            url: 'exam-process.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
                if (typeof response === 'object' && response !== null) {
                    modalContent.innerHTML = `
                        <div class="popup1">
                            <h2>EDIT EXAM STATUS</h2>
                            <form action="update-exam.php" method="post" enctype="multipart/form-data">
                                <table>
                                    <tr>
                                        <td>Exam Status: </td>
                                        <td>
                                            <select name="status" required>
                                                <option value="${response.ex_status}">${response.ex_status}</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>

                                <input type="hidden" name="ex_id" value="${response.ex_id}">
                                <div class="save">
                                    <button type="submit" name="update">Save</button>
                                </div>
                            </form>
                        </div>
                        `;
                } else {
                    modalContent.innerHTML = "Error: Failed to load exam details.";
                }

                openModal(); 
            },
            error: function () {
                modalContent.innerHTML = "Error: Failed to load class details.";
                openModal();
            }
        });
    }

    </script>

    <?php
        if(isset($_SESSION['ex-update-ok'])){ ?>
        <script>
            swal({
                title: "Status Updated Successfully",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ex-update-ok']); } ?>

    <?php
        if(isset($_SESSION['ex-update-error'])){ ?>
        <script>
            swal({
                title: "Failed to update data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ex-update-error']); } ?>

</body>
</html>