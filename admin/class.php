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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    <style>
        .custom-select {
            appearance: none; 
            background-color: #f8f9fa; 
            border: 1px solid #ced4da; 
            padding: 8px 12px; 
            font-size: 16px; 
            width: 100%; 
            border-radius: 4px;
            outline: none; 
        }

        .custom-select:focus {
            border-color: #80bdff; 
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); 
        }

        .select2-results__option {
            background-color: white;
            color: black;
        }

        .select2-selection__rendered {
            background-color: black;
            border: none;
            outline: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            background-color: black;
            color: white;
        }

    </style>
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
                <a href="index.php"><span class="material-symbols-outlined"> grid_view </span><h3>Dashboard</h3></a>
                <a href="#" class="active"><span class="material-symbols-outlined"> menu_book </span><h3>Classes</h3></a>
                <a href="teacher.php"><span class="material-symbols-outlined"> group </span><h3>Teacher Panel</h3></a>
                <a href="student.php"><span class="material-symbols-outlined"> groups </span><h3>Student Panel</h3></a>
                <a href="homework.php"><span class="material-symbols-outlined">library_books</span><h3>Homework</h3></a>
                <a href="payment.php"><span class="material-symbols-outlined"> payments </span><h3>Payments</h3></a>
                <!-- <a href="account.php"><span class="material-symbols-outlined"> account_balance </span><h3>Accounting Section</h3></a> -->
                <a href="exam.php"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="feedback.php"><span class="material-symbols-outlined"> feedback </span><h3>Feedback</h3><span class="message-count">20</span></a>
                <a href="notification.php"><span class="material-symbols-outlined">campaign</span><h3>Notification Panel</h3></a>
                <a href="admin.php"><span class="material-symbols-outlined">shield_person</span><h3>Admin</h3></a>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

        <main>
                <div class="recent-requests">
                <h1>CLASS MANAGEMENT</h1>

                <div class="search">
                    <form action="" method="post">
                            <input type="search" name="search" placeholder=" Enter Class ID or Title">
                            <input type="submit" name="searchSubmit">
                    </form>
                </div>

                <div class="add">
                    <button onclick="openPopup()">New Class</button>
                </div>

                <table class="Category">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Class ID</th>
                            <th>Title</th>
                            <th>Grade</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Fee</th>
                            <th>Teacher</th>
                            <th>Language</th>
                            <th>Duration</th>
                            <th>Day and Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        
                    </thead>
                    <tbody>

                    <?php

                        if(isset($_POST['searchSubmit'])){

                            $searches = $_POST['search'];

                            $sql3 = "SELECT * FROM class WHERE cl_id LIKE '%$searches%' OR cl_title LIKE '%$searches%'";

                            $res3 = mysqli_query($conn, $sql3);
                            $count3 = mysqli_num_rows($res3);

                            if($count3>0)
                            {
                                while($row=mysqli_fetch_assoc($res3))
                                {
                                    $sn = 1;
                                    $cl_id = $row['cl_id'];
                                    $cl_title = $row['cl_title'];
                                    $cl_description = $row['cl_description'];
                                    $cl_grade = $row['cl_grade'];
                                    $cl_fee = $row['cl_fee'];
                                    $cl_status = $row['cl_status'];
                                    $cl_img = $row['cl_img'];
                                    $em_id = $row['em_id'];
                                    $cl_duration = $row['cl_duration'];
                                    $cl_time = $row['cl_time'];
                                    $cl_day = $row['cl_day'];
                                    $cl_lan = $row['cl_lan'];

                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $cl_id; ?></td>
                                        <td><?php echo $cl_title; ?></td>
                                        <td><?php echo $cl_grade; ?></td>
                                         <td>
                                            <?php
                                                if($cl_img=="")
                                                {
                                                    echo "<div class='error'> No Image Uploaded.</div>";
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="cl-img">
                                                        <img src="../images/class/<?php echo $cl_img; ?>" width="70" height="80">
                                                    </div>
                                                    <?php
                                                } ?>
                                         </td>
                                        <td><?php echo $cl_description; ?></td>
                                        <td><?php echo $cl_fee; ?>.00</td>
                                        <td><?php echo $em_id; ?></td>
                                        <td><?php echo $cl_lan; ?></td>
                                        <td><?php echo $cl_duration; ?></td>
                                        <td><?php echo $cl_day . " - " . $cl_time; ?> </td>
                                        <td>
                                            <?php 
                                                if($cl_status=="Active"){ ?>
                                                    <div class="success">
                                                        <?php echo $cl_status; ?>
                                                    </div> <?php
                                                }
                                                else{ ?>
                                                    <div class="error">
                                                        <?php echo $cl_status; ?>
                                                    </div> <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <div onclick="loadContent('<?php echo $cl_id; ?>')" class="edit-btn-02">
                                                <button class="pop_btn">Edit</button>
                                            </div>                                        
                                        </td>
                                    </tr>

                            <?php
                                }
                            } else { ?>
                                <tr>
                                    <td colspan="12">
                                        <div class="error">
                                            No record found for your search.
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                        }else{ ?>
                        <?php
                            $sn = 1;
                            $sql = "SELECT * FROM class";
                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if($count>0){
                                while($row=mysqli_fetch_assoc($res)){
                                    $cl_id = $row['cl_id'];
                                    $cl_title = $row['cl_title'];
                                    $cl_description = $row['cl_description'];
                                    $cl_grade = $row['cl_grade'];
                                    $cl_fee = $row['cl_fee'];
                                    $cl_status = $row['cl_status'];
                                    $cl_img = $row['cl_img'];
                                    $em_id = $row['em_id'];
                                    $cl_duration = $row['cl_duration'];
                                    $cl_time = $row['cl_time'];
                                    $cl_day = $row['cl_day'];
                                    $cl_lan = $row['cl_lan'];

                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $cl_id; ?></td>
                                        <td><?php echo $cl_title; ?></td>
                                        <td><?php echo $cl_grade; ?></td>
                                         <td>
                                            <?php
                                                if($cl_img=="")
                                                {
                                                    echo "<div class='error'> No Image Uploaded.</div>";
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="cl-img">
                                                        <img src="../images/class/<?php echo $cl_img; ?>" width="70" height="80">
                                                    </div>
                                                    <?php
                                                } ?>
                                         </td>
                                        <td><?php echo $cl_description; ?></td>
                                        <td><?php echo $cl_fee; ?>.00</td>
                                        <td><?php echo $em_id; ?></td>
                                        <td><?php echo $cl_lan; ?></td>
                                        <td><?php echo $cl_duration; ?></td>
                                        <td><?php echo $cl_day . " - " . $cl_time; ?> </td>
                                        <td>
                                            <?php 
                                                if($cl_status=="Active"){ ?>
                                                    <div class="success">
                                                        <?php echo $cl_status; ?>
                                                    </div> <?php
                                                }
                                                else{ ?>
                                                    <div class="error">
                                                        <?php echo $cl_status; ?>
                                                    </div> <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="edit-btn-02" onclick="loadContent('<?php echo $cl_id; ?>')">
                                                <button class="pop_btn">Edit</button>
                                            </div>                                    
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='11' >Classes Not Added Yet.</td></tr>";
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <div class="pop_container">
                <div class="popup" id="popup">
                    <form action="add-class.php" method="post" enctype="multipart/form-data">
                        <h2>NEW CLASS</h2>
                        <table>
                            <tr>
                                <td>Title: </td>
                                <td>
                                    <input type="text" name="title" placeholder="Title of the Class" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Description: </td>
                                <td>
                                    <textarea name="description" cols="30" rows="5" placeholder="Description for the class" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Grade: </td>
                                <td>
                                    <select name="grade" required>
                                        <option value="">.....</option>
                                        <option value="LKG">Lower kindergarten</option>
                                        <option value="UKG">Upper kindergarten</option>
                                        <option value="KG">Kindergarten</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="A/L">A/L</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Fee: </td>
                                <td>
                                    <input type="number" name="cl_fee" placehodlder="Enter the class fee" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Teacher ID or Name:</td>
                                <td>
                                    <select id="teacherSelect" name="teacher" class="custom-select" style="width: 100%;" required hidden>
                                        <option value="">Select Teacher ID</option>

                                        <?php
                                        $sql6 = "SELECT * FROM employee WHERE em_position = 'Teacher'";

                                        $res6 = mysqli_query($conn, $sql6);
                                        $count6 = mysqli_num_rows($res6);

                                        if($count6>0)
                                        {
                                            while($row=mysqli_fetch_assoc($res6))
                                            {
                                                $em_id_cl = $row['em_id']; 
                                                $em_username_cl = $row['em_username'];
                                                ?>

                                                <option value="<?php echo $em_id_cl; ?>" style="background-color: red;"><?php echo $em_username_cl; ?></option>

                                            <?php  
                                            } 
                                        } 
                                        ?>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Select Image: </td>
                                <td>
                                    <input type="file" name="image">
                                </td>
                            </tr>
                            <tr>
                                <td>Day: </td>
                                <td>
                                    <select name="day" required>
                                        <option value="">.....</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Time: </td >
                                <td>
                                    <input type="time" name="time" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Duration: </td>
                                <td>
                                    <select name="duration" required>
                                        <option value="">.....</option>
                                        <option value="30 min">30 Min</option>
                                        <option value="1 hr">1 Hour</option>
                                        <option value="1.30 hr">1.30 Hours</option>
                                        <option value="2 hr">2 Hours</option>
                                        <option value="2.30 hr">2.30 Hours</option>
                                        <option value="3 hr">3 Hours</option>
                                        <option value="3.30 hr">3.30 Hours</option>
                                        <option value="4 hr">4 Hours</option>
                                        <option value="4.30 hr">4.30 Hours</option>
                                        <option value="5 hr">5 Hours</option>
                                        <option value="5.30 hr">5.30 Hours</option>
                                        <option value="6 hr">6 Hours</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Language: </td>
                                <td>
                                    <select name="language" required>
                                        <option value="">.....</option>
                                        <option value="Sinhala">Sinhala</option>
                                        <option value="English">English</option>
                                        <option value="Tamil">Tamil</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Status: </td>
                                <td>
                                    <select name="status" required>
                                        <option value="">.....</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </td>
                            </tr>
                        </table>

                        <div class="save">
                            <button type="button" onclick="closePopup()" class="error">Cancel</button>
                            <button type="submit" name="submit" class="save-01">Save</button>
                        </div>
                    </form>
                    
                </div>
            </div>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div id="modalContent">
                    </div>
                </div>
            </div>

        </main>
        
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
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">
                    <div class="update">
                        <?php
                            $sql4 = "SELECT * FROM student_enroll ORDER BY id DESC LIMIT 9";
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


                                    $sql5 = "SELECT * FROM student WHERE st_id = '$st_id02' LIMIT 10";
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
        </div>
    </div>

    <script src="./index.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script>
        // Initialize Select2
        $(document).ready(function() {
            $('#teacherSelect').select2({
                placeholder: 'Enter teacher name',
                allowClear: true,
                dropdownAutoWidth: true,
                width: '100%',
                hideSelectionFromResult: true
            });
        });
    </script>
    
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
            url: 'class-process.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
                if (typeof response === 'object' && response !== null) {
                    modalContent.innerHTML = `
                        <div class="popup1">
                            <h2>EDIT CLASS</h2>
                            <form action="update-class.php" method="post" enctype="multipart/form-data">
                                <table>
                                    <tr>
                                        <td>Title: </td>
                                        <td>
                                            <input type="text" name="title" placeholder="Title of the Class" required value="${response.cl_title}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Description: </td>
                                        <td>
                                            <textarea name="description" cols="30" rows="5" required placeholder="Description for the class">${response.cl_description}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Grade: </td>
                                        <td>
                                            <select name="grade" required>
                                                <option value="${response.cl_grade}">${response.cl_grade}</option>
                                                <option value="LKG">Lower kindergarten</option>
                                                <option value="UKG">Upper kindergarten</option>
                                                <option value="KG">Kindergarten</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="A/L">A/L</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fee: </td>
                                        <td>
                                            <input type="number" name="cl_fee" placeholder="Enter class fee" required value="${response.cl_fee}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Teacher ID: </td>
                                        <td>
                                            <input type="text" name="em_id" placeholder="Enter teacher ID" required value="${response.em_id}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Image: </td>
                                        <td>
                                            ${response.cl_img === "" ? '<div class="error"> No Image Uploaded.</div>' : `<div class="cl-img02"><img src="../images/class/${response.cl_img}" width="15" height="15"></div>`}
                                            <input type="hidden" name="cl_img" value="${response.cl_img}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Selecet New Image: </td>
                                        <td>
                                            <input type="file" name="image01">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Day: </td>
                                        <td>
                                            <select name="day" value="">
                                                <option value="${response.cl_day}">${response.cl_day}</option>
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                                <option value="Saturday">Saturday</option>
                                                <option value="Sunday">Sunday</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Time: </td >
                                        <td>
                                            <input type="time" name="time" required value="${response.cl_time}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Duration: </td>
                                        <td>
                                            <select name="duration" required>
                                                <option value="${response.cl_duration}">${response.cl_duration}</option>
                                                <option value="30 min">30 Min</option>
                                                <option value="1 hr">1 Hour</option>
                                                <option value="1.30 hr">1.30 Hours</option>
                                                <option value="2 hr">2 Hours</option>
                                                <option value="2.30 hr">2.30 Hours</option>
                                                <option value="3 hr">3 Hours</option>
                                                <option value="3.30 hr">3.30 Hours</option>
                                                <option value="4 hr">4 Hours</option>
                                                <option value="4.30 hr">4.30 Hours</option>
                                                <option value="5 hr">5 Hours</option>
                                                <option value="5.30 hr">5.30 Hours</option>
                                                <option value="6 hr">6 Hours</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Language: </td>
                                        <td>
                                            <select name="language" required>
                                                <option value="${response.cl_lan}">${response.cl_lan}</option>
                                                <option value="Sinhala">Sinhala</option>
                                                <option value="English">English</option>
                                                <option value="Tamil">Tamil</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status: </td>
                                        <td>
                                            <select name="status" required>
                                                <option value="${response.cl_status}">${response.cl_status}</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="cl_id" value= ${response.cl_id}>
                                </table>

                                <div class="save">
                                    <div class="delete">
                                            <button type="button" class="error reject-link" data-req-id1="${response.cl_id}" data-req-id2="${response.cl_img}">Delete Class</button>
                                    </div>
                                    <button type="submit" name="update">Save</button>
                                </div>
                            </form>
                        </div>
                        `;
                } else {
                    modalContent.innerHTML = "Error: Failed to load class details.";
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

    <script>
        document.body.addEventListener('click', function (event) {
            if (event.target.classList.contains('reject-link')) {
                event.preventDefault(); 
                var cl_id = event.target.getAttribute('data-req-id1');
                var cl_img = event.target.getAttribute('data-req-id2');

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this details!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href = `../admin/delete-class.php?id=${cl_id}&image_name=${cl_img}`;
                    } else {
                    }
                });
            }
        });
    </script>


    <script>
        function search(){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "error",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "../admin/class.php";
                }else {

                }
                });
        }
    </script>

    <?php
        if(isset($_SESSION['cls-add-ok'])){ ?>
        <script>
            swal({
                title: "Data Added Successfully",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['cls-add-ok']); } ?>

    <?php
        if(isset($_SESSION['cls-add-error'])){ ?>
        <script>
            swal({
                title: "Failed to add Data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['cls-add-error']); } ?>

    <?php
        if(isset($_SESSION['update_image-ok'])){ ?>
        <script>
            swal({
                title: "Data Saved Successfully!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update_image-ok']); } ?>

    <?php
        if(isset($_SESSION['update_image-error'])){ ?>
        <script>
            swal({
                title: "Failed to Save Data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update_image-error']); } ?>

    <?php
        if(isset($_SESSION['delete-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Deleted",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['delete-ok']); } ?>

    <?php
        if(isset($_SESSION['delete-error'])){ ?>
        <script>
            swal({
                title: "Failed to delete data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['delete-error']); } ?>

</body>
</html>