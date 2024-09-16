<?php include('../../config/constant.php'); ?>
<?php include('../login-check.php'); ?>

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

        $cl_id_teacher = "0";
        if (isset($_SESSION['cl_id_teacher'])) {
            $cl_id = $_SESSION['cl_id_teacher'];
        }
        
        if($cl_id == "0"){
            $_SESSION['not-cl-id'] = "error";
            header('location: ../index.php');
        }
        else{

            $hw_id = "0";
            if (isset($_SESSION['hw_id_teacher_view'])) {
                $hw_id = $_SESSION['hw_id_teacher_view'];
            }

            if($hw_id == "0"){
                $_SESSION['hw-id-error'] = "error";
                header('location: ./hw-creation.php');
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
    <style>
            /* Style the table */
            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
            }

            /* Style the table header */
            th {
                /* background-color: #f2f2f2; */
                font-weight: bold;
                text-align: left;
                padding: 8px;
                border: 1px solid #dddddd;
            }

            /* Style the table rows */
            tr:nth-child(even) {
                /* background-color: #f9f9f9; */
            }

            /* Style the table data cells */
            td {
                padding: 8px;
                border: 1px solid #dddddd;
            }

            /* Style input and textarea inside table cells */
            input[type="number"],
            textarea {
                width: 100%;
                padding: 5px;
                box-sizing: border-box;
                border: 1px solid #dddddd;
                border-radius: 4px;
            }

            .save-button {
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 14px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 4px;
            }

            .save-button:hover {
                background-color: #3e8e41;
            }
        </style>
</head>
<body>
    <div class="container-02">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="../../images/logos/logo.png">
                    <h2>ONLINE<span class="danger">INSTITUTE</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-outlined"> close </span>
                </div>
            </div>
            <div class="sidebar">
                <a href="../index.php" class="active"><span class="material-symbols-outlined"> menu_book </span><h3>Classes</h3></a>
                <a href="../exam/index.php" class="active"><span class="material-symbols-outlined"> auto_stories </span><h3>Exams</h3></a>
                <a href="#"><span class="material-symbols-outlined"> payments </span><h3>Payments</h3></a>
                <div class="dropdown">
                    <a href="#" class="dropbtn"><span class="material-symbols-outlined">lab_profile</span><h3>Reports</h3><i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="#">Attendance Reports</a>
                        <a href="#">Classes Details</a>
                        <a href="#">Payment Details</a>
                    </div>
                </div>
                <a href="../logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>


        <main>

            <ul>
                <li><a href="../class-view.php">Link and Announcement</a></li>
                <li class="dropdown-01">
                    <a href="javascript:void(0)" class="dropbtn-01 active-nav">Homework</a>
                    <div class="dropdown-content-01">
                    <a href="hw-creation.php">Homework Creation</a>
                    <a href="hw-grading.php" class="active-nav">Homework Grading</a>
                    </div>
                </li>
                <li><a href="../cl-st-view.php">Class Details</a></li>
            </ul><br>

            <?php

            $timezone = new DateTimeZone('Asia/Colombo');
            $current_datetime = new DateTime('now', $timezone);
            $current_datetime = $current_datetime->format('Y-m-d H:i:s');



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
                    
                        <a href="../profile.php">
                            <div class="profile">
                                <div class="info">
                                    <p>Hey, <b><?php echo $em_username01; ?></b></p>
                                    <small class="text-muted">Admin</small>
                                </div>
                                <div class="profile-photo">
                                    <img src="../../images/employee/<?php echo $em_img01; ?>" alt="profile picture">
                                </div>
                            </div>
                        </a>
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
                    $hw_title = $row['hw_title'];
                    $hw_created = $row['hw_created'];
                    $hw_expire = $row['hw_expire'];
                    $hw_content = $row['hw_content'];
                    $hw_status = $row['hw_status'];
                    ?>
                
                <?php
                }
            } ?>


            <h1>HOMEWORK GRADING</h1><br>
            <h2><?php echo $hw_title; ?></h2><br>
            
            
            <div class="hw">
                <div class="hw">
                    <table style="max-width: 30%;">
                        <tr>
                            <td>Created: </td>
                            <td><?php echo $hw_created; ?></td>
                        </tr>
                        <tr>
                            <td>Deadline: </td>
                            <td>
                                <?php if($hw_expire > $current_datetime){
                                    echo "<div style='color: #0C9629;'>".$hw_expire."</div>";
                                }else{
                                    echo "<div style='color: red;'>".$hw_expire."</div>";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Homework Status</td>
                            <td>
                                <form action="update-hw.php" method="post">
                                    <select name="status" id="status">
                                        <option value="<?php echo $hw_status; ?>"><?php echo $hw_status; ?></option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                    <input type="hidden" name="hw_id" value="<?php echo $hw_id; ?>">
                                </form>
                            </td>
                        </tr>
                    </table><br><br>

                    <div>
                        <?php echo $hw_content; ?>
                    </div>
                </div>
            </div>


            <div class="hw">
                <h2>Grade Answers</h2><br>
                <table>
                    <tr>
                        <th>Student name</th>
                        <th>Uploaded</th>
                        <th>Grade</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    <form action="#" method="post">
                        <?php
                        $sql2 = "SELECT * FROM homework_answers WHERE hw_id = '$hw_id'";

                        $res2 = mysqli_query($conn, $sql2);

                        $count2 = mysqli_num_rows($res2);

                        if ($count2 > 0) {
                            while ($row = mysqli_fetch_assoc($res2)) {
                                $hw_a_id = $row['hw_a_id'];
                                $uplo_date = $row['upl_date'];
                                $st_id = $row['st_id'];
                                $grading = $row['grading'];
                                $comment = $row['comment'];
                                $status = $row['g_status'];


                                $sql3 = "SELECT * FROM student WHERE st_id = '$st_id'";

                                $res3 = mysqli_query($conn, $sql3);

                                $count3 = mysqli_num_rows($res3);

                                if ($count3 > 0) {
                                    while ($row = mysqli_fetch_assoc($res3)) {
                                        $st_username = $row['st_username'];



                                        $sql4 = "SELECT * FROM homework WHERE hw_id = '$hw_id'";

                                        $res4 = mysqli_query($conn, $sql4);

                                        $count4 = mysqli_num_rows($res4);

                                        if ($count4 > 0) {
                                            while ($row = mysqli_fetch_assoc($res4)) {
                                                $deadline = $row['hw_expire'];


                        ?>

                                                <tr>
                                                    <td><?php echo $st_id . " - " . $st_username; ?></td>
                                                    <th>
                                                        <?php
                                                        $startDateTime = new DateTime($uplo_date);
                                                        $endDateTime = new DateTime($deadline);

                                                        $difference = $endDateTime->diff($startDateTime);

                                                        $days = $difference->days;
                                                        $hours = $difference->h;
                                                        $minutes = $difference->i;

                                                        $timeDifference = '';

                                                        if ($days > 0) {
                                                            $timeDifference .= "$days days ";
                                                        }
                                                        if ($hours > 0) {
                                                            $timeDifference .= "$hours hours ";
                                                        }
                                                        if ($minutes > 0) {
                                                            $timeDifference .= "$minutes minutes";
                                                        }
                                                        if ($days == 0 && $hours == 0 && $minutes == 0) {
                                                            $timeDifference .= "0 minutes";
                                                        }

                                                        $style = '';
                                                        if ($startDateTime > $endDateTime) {
                                                            $style = 'color: red;';
                                                            $beforeAfterText = 'after';
                                                        } else {
                                                            $beforeAfterText = 'before';
                                                        }

                                                        ?>

                                                        <span style="<?php echo $style; ?>"><?php echo $timeDifference; ?> <?php echo $beforeAfterText; ?></span>

                                                    </th>
                                                    <td><input type="number" name="grading" value="<?php echo $grading; ?>"></td>
                                                    <td><textarea name="comment" id="" cols="30" rows="2"><?php echo $comment; ?></textarea></td>
                                                    <td>
                                                        <select name="status" id="status">
                                                            <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="act_id" value="<?php echo $hw_a_id; ?>">
                                                        <input type="hidden" name="username" value="<?php echo $st_id; ?>">
                                                        <button type="button" class="save-button" onclick="saveData('<?php echo $hw_a_id; ?>', '<?php echo $st_id; ?>', this)">Save</button>
                                                    </td>
                                                </tr>

                        <?php
                                            }
                                        }
                                    }
                                }
                            }
                        } ?>

                    </form>
                </table>
            </div>

            
                <?php
                $sql4 = "SELECT * FROM homework WHERE hw_id = '$hw_id'";

                $res4 = mysqli_query($conn, $sql4);

                $count4 = mysqli_num_rows($res4);
                if($count4>0)
                {
                    while($row=mysqli_fetch_assoc($res4))
                    {
                        $ans_type = $row['ans_type'];
                    } 

                    if($ans_type == 'PDF'){ ?>

                        <div class="download">
                            <div class="hw">
                                <h2>Download Answers: </h2><br>
                                <form action="download.php" method="post">
                                    <input type="hidden" name="hw_id" value="<?php echo $hw_id; ?>"> 
                                    <button type="submit" name="download">Download</button>
                                </form>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                <?php
                }
                ?>

        </main>
        
    </div>

    <script>
        function saveData(act_id, username, button) {
            // Navigate up the DOM tree to the row containing the button
            var row = button.parentNode.parentNode;

            // Find grading, comment, and status elements within the row
            var gradingInput = row.querySelector('input[name="grading"]');
            var commentInput = row.querySelector('textarea[name="comment"]');
            var statusSelect = row.querySelector('select[name="status"]');

            // Retrieve values from grading, comment, and status inputs
            var grading = gradingInput.value;
            var comment = commentInput.value;
            var status = statusSelect.value;

            // Create AJAX request
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "success") {

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 500
                        });

                        console.log("Data saved successfully");
                    } else {
                        // Handle error
                        console.log("Error saving data");
                    }
                }
            };
            xhttp.open("POST", "update_grading_comment.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("act_id=" + act_id + "&username=" + username + "&grading=" + grading + "&comment=" + comment + "&status=" + status);
        }
    </script>

    <script>
        document.getElementById('status').addEventListener('change', function() {
            var status = this.value;
            var hw_id = this.nextElementSibling.value;

            // Send AJAX request to update the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_hw_status.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Database updated successfully');
                } else {
                    console.log('Error updating database');
                }
            };
            xhr.send('status=' + status + '&hw_id=' + hw_id);
        });
    </script>
    
    <script src="../teacher.js"></script>

</body>
</html>

<?php
if (isset($_POST['download'])) {

    $hw_id = $_POST['hw_id'];

    // create a zip file
    $zip_file = "../homework-files/" . $hw_id . ".zip";
    touch($zip_file);

    // open zip file
    $zip = new ZipArchive;
    $this_zip = $zip->open($zip_file);

    if ($this_zip) {

        $folder = opendir('../homework-files/');

        if ($folder) {
            while (false !== ($file = readdir($folder))) {
                if ($file !== "." && $file !== "..") {
                    $file_with_path = '../homework-files/' . $file;
                    $zip->addFile($file_with_path, $file);
                }
            }
            closedir($folder);
        }

        // download this created zip file
        if (file_exists($zip_file)) {

            //name when download
            $demo_name = $hw_id . ".zip";

            header('Content-type: application/zip');
            header('Content-Disposition: attachment; filename="' . $demo_name . '"');
            readfile($zip_file); // auto download

            //delete this zip file after download
            unlink($zip_file);
        }

    }

}
?>