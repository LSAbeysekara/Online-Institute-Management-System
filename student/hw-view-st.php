<?php include('../config/constant.php'); ?>
<?php include('./login-check.php'); ?>

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

            $hw_id = "0";
            if(isset($_SESSION['hw_id_st_view'])){
                $hw_id = $_SESSION['hw_id_st_view'];
            }

            if($hw_id == "0"){
                header('location: ./class-view-st.php');
            }
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

<?php
$sql4 = "SELECT * FROM homework WHERE hw_id = '$hw_id'";

$res4 = mysqli_query($conn, $sql4);
$count4 = mysqli_num_rows($res4);
if($count4>0)
{
    while($row=mysqli_fetch_assoc($res4))
    {
        $hw_title = $row['hw_title'];
        ?>
    
    <?php
    }
} ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cl_title; ?> - Homework</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/ipootvjlv9vz4p1d1x91ok27oce25gt4no6r0tddj5c98lsw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="../admin/sweetalert.min.js"></script>
    <style>
        .save-button {
            background-color: #4CAF50;
            /* Green */
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
                <li><a href="./class-view-st.php"><?php echo $cl_title; ?></a></li>
                <li><a href="homeworks.php">Homework</a></li>
            </ul><br>

            <p style="margin: 0 0 8px 5px;"><a style="color: #007bff;" href="homeworks.php">Homework</a> > <?php echo $hw_title; ?></p>

            
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

            <div class="hw">
                <h1 style="color: #ff7782;"><?php echo $cl_id;?> - <?php echo $cl_title;?> - <?php echo $cl_lan; ?></h1><br>

                <?php

                $sql3 = "SELECT * FROM homework WHERE hw_id = '$hw_id'";

                $res3 = mysqli_query($conn, $sql3);

                $count3 = mysqli_num_rows($res3);

                if($count3>0)
                {
                    while($row=mysqli_fetch_assoc($res3))
                    {
                        $hw_created = $row['hw_created'];
                        $hw_title = $row['hw_title'];
                        $hw_content = $row['hw_content'];
                        $hw_expire = $row['hw_expire'];
                        $hw_status = $row['hw_status'];
                        ?>
                    
                    <?php
                    }
                } 
                
                $g_status = "";
                ?>

                
                <div class="hw">
                    <h2><?php echo $hw_title; ?></h2><br>
                    
                    <div class="hw">
                        <table class="link-update-table">
                            <tr>
                                <td><h3>Opened: </h3> </td>
                                <td><h3><?php echo $hw_created; ?></h3></td>
                            </tr>
                            <tr>
                                <td><h3>Due: </h3></td>
                                <td onclick="loadContent01('<?php echo $hw_id; ?>')">
                                    <?php
                                        $timezone = new DateTimeZone('Asia/Colombo');
                                        $new_hw_expire = new DateTime($hw_expire, $timezone);
                                        $currentDateTimeObj = new DateTime('now', $timezone);

                                        $timeDifference = $currentDateTimeObj->diff($new_hw_expire);

                                        if ($timeDifference->invert == 1) {
                                            echo '<h3 style="color: #C70039;">' . $hw_expire . '</h3>';
                                        } else {
                                            echo '<h3 style="color: #41f1b6;">' . $hw_expire . '</h3>';
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="hw" style="padding: 12px;">
                    <?php echo $hw_content; ?>
                </div><br><br>

                <?php

                    $sql6 = "SELECT * FROM homework WHERE hw_id = '$hw_id'";

                    $res6 = mysqli_query($conn, $sql6);

                    $count6 = mysqli_num_rows($res6);
                    if($count6>0)
                    { ?>
                        
                            <?php
                            while($row=mysqli_fetch_assoc($res6))
                            {
                                $ans_type = $row['ans_type'];
                                $deadline = $row['hw_expire'];
                            } 
                            
                            if($ans_type != 'None'){
                            ?>
                                <?php
                                    if ($timeDifference->invert != 1) { ?>
                                        
                                            <?php
                                                $sql8 = "SELECT * FROM homework_answers WHERE hw_id = '$hw_id' AND st_id = '$st_id'";

                                                $res8 = mysqli_query($conn, $sql8);
                                
                                                $count8 = mysqli_num_rows($res8);
                                                if($count8>0) {

                                                    while($row=mysqli_fetch_assoc($res8))
                                                    {
                                                        $grading = $row['grading'];
                                                        $comment = $row['comment'];
                                                        $upl_date = $row['upl_date'];
                                                        $g_status = $row['g_status'];
                                                    } 
                                                ?>

                                                <br><br>

                                                <h2 style="margin-left: 10px;">Submission Status:</h2>
                                                <div class="hw">

                                                    <table class="link-update-table" style="border: 1px solid #ccc; font-size: 13px; max-width: 45%;">
                                                        <tr>
                                                            <td>Submission status</td>
                                                            <td>
                                                                <?php
                                                                    $sql7 = "SELECT * FROM homework_answers WHERE hw_id = '$hw_id' AND st_id = '$st_id'";

                                                                    $res7 = mysqli_query($conn, $sql7);
                                                    
                                                                    $count7 = mysqli_num_rows($res7);
                                                                    if($count7>0) {?>
                                                                        <div style="font-weight: bold;">Submitted for grading</div>
                                                                    <?php } else {?>
                                                                        <div style="font-weight: bold; color: red;">Answer not uploaded yet</div>
                                                                    <?php }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Grading Status</td>
                                                            <td>
                                                                <?php
                                                                    if($grading == 0){
                                                                        echo "Pending";
                                                                    }else{
                                                                        if($g_status == "Active"){
                                                                            echo $grading;
                                                                        }else{
                                                                            echo "Pending";
                                                                        }
                                                                        
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Uploaded</td>
                                                            <td>
                                                                <?php

                                                                    $startDateTime = new DateTime($upl_date);
                                                                    $endDateTime = new DateTime($deadline);
                                                                    
                                                                    // Calculate the difference
                                                                    $difference = $endDateTime->diff($startDateTime);
                                                                    
                                                                    $days = $difference->days;
                                                                    $hours = $difference->h;
                                                                    $minutes = $difference->i;

                                                                    // Display the time difference
                                                                    echo "Assignment was submitted ";
                                                                    if ($days > 0) {
                                                                        echo "$days days ";
                                                                    }
                                                                    if ($hours > 0) {
                                                                        echo "$hours hours ";
                                                                    }
                                                                    if ($minutes > 0) {
                                                                        echo "$minutes minutes";
                                                                    }
                                                                    if ($days == 0 && $hours == 0 && $minutes == 0) {
                                                                        echo "0 minutes";
                                                                    }
                                                                    echo " before";
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </table><br><br>

                                                <?php } ?>

                                            <h2>Upload your answer here:</h2><br>

                                            <?php
                                            $ans_content = "";
                                            if($ans_type == 'PDF'){
                                                $sql8 = "SELECT * FROM homework_answers WHERE hw_id = '$hw_id' AND st_id = '$st_id'";

                                                $res8 = mysqli_query($conn, $sql8);
                                
                                                $count8 = mysqli_num_rows($res8);
                                                if($count8>0) {
                                                    while($row=mysqli_fetch_assoc($res8))
                                                    {
                                                        $ans_content = $row['ans_content'];
                                                    } 
                                                }

                                                echo "Your uploaded file: ";
                                                $pdfFilePath = '../teacher/homework-files/'.$hw_id.'/'.$ans_content;
                                                $pdfFileName = basename($pdfFilePath);

                                                if (file_exists($pdfFilePath)) {
                                                    ?>
                                                    <a href="<?php echo $pdfFilePath; ?>" download="<?php echo $pdfFileName; ?>" style="color:red; text-decoration: underline;">
                                                        <?php echo $pdfFileName; ?>
                                                    </a>
                                                    <?php
                                                } else {
                                                    echo "<p style='color: orange;'>File not found!</p>";
                                                } ?> 

                                                <br><br>
                                                
                                                <?php
                                            }


                                            if($ans_type == 'Text'){ ?>
                                            <?php
                                                $sql8 = "SELECT * FROM homework_answers WHERE hw_id = '$hw_id' AND st_id = '$st_id'";

                                                $res8 = mysqli_query($conn, $sql8);
                                
                                                $count8 = mysqli_num_rows($res8);
                                                if($count8>0) {
                                                    while($row=mysqli_fetch_assoc($res8))
                                                    {
                                                        $ans_content = $row['ans_content'];
                                                    } 
                                                }
                                            ?>
                                                <form action="add-hw-answer-text.php" method="POST" enctype="multipart/form-data">
                                                    <textarea name="content" id="content" rows="5" cols="80"><?php echo $ans_content; ?></textarea>
                                                    <input type="hidden" name="st_id" value="<?php echo $st_id; ?>">
                                                    <input type="hidden" name="hw_id" value="<?php echo $hw_id; ?>"><br>
                                                    <input type="submit" class="save-button" value="Submit" name="submit">
                                                </form>
                                            <?php
                                            }elseif($ans_type == 'PDF'){ ?>
                                                <h3 style="margin-bottom: 5px;">Upload answer as a pdf file. Other files won't be accepted.</h3>
                                                <form action="add-hw-answer-pdf.php" method="POST" enctype="multipart/form-data">
                                                    <input type="file" name="pdf" accept=".pdf" required>
                                                    <input type="hidden" name="st_id" value="<?php echo $st_id; ?>">
                                                    <input type="hidden" name="hw_id" value="<?php echo $hw_id; ?>">
                                                    <input type="submit" value="Submit" name="submit" style="background-color: #3498DB; padding: 4px; border-radius: 40%; cursor: pointer;">
                                                </form><br><br>
                                                <h3 style="margin-bottom: 5px;">File name should be :- "Your_Username.pdf"</h3>
                                            <?php
                                            }else{ ?>
                                                <h3 style="margin-bottom: 5px;">Upload answer as an image. Other files won't be accepted.</h3>
                                                <form action="add-hw-answer-image.php" method="POST" enctype="multipart/form-data">
                                                    <input type="file" name="submit_image" required>
                                                    <input type="hidden" name="st_id" value="<?php echo $st_id; ?>">
                                                    <input type="hidden" name="hw_id" value="<?php echo $hw_id; ?>">
                                                    <input type="submit" value="Submit" name="submit">
                                                </form><br><br>
                                                <h3 style="margin-bottom: 5px;">File name should be :- "Your_Username.file_type"</h3>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    }
                                ?>
                            <?php } ?>
                                
                        </form>
                    <?php
                    }

                    if($g_status == "Active"){
                        if($comment != ""){
                            ?>
        
                            <br><br>
                            <div class="hw">
                                <h2>Teacher's Comment:</h2><br>
                                <div style="font-size: 15px;"><?php echo $comment; ?></div>
                            </div>
                            <?php
                            }
                            
                    } ?>

            </div><br>

            
        </main>
        
    </div>

    
    <script src="./student.js"></script>

    <script>
        tinymce.init({
        selector: 'textarea#content',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>

    <?php if(isset($_SESSION['ans-upload-ok'])){ ?>
        <script>
            swal({
                title: "File Uploaded Successfully",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ans-upload-ok']); } ?>

    <?php if(isset($_SESSION['ans-upload-error'])){ ?>
        <script>
            swal({
                title: "File not Uploaded! Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ans-upload-error']); } ?>

    <?php if(isset($_SESSION['file-type-error'])){ ?>
        <script>
            swal({
                title: "File type error! Please try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['file-type-error']); } ?>

</body>
</html>
