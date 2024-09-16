<?php include('../config/constant.php'); ?>
<?php include('./login-check.php'); ?>

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
            header('location: ./index.php');
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
    <script src="./ckeditor/ckeditor.js"></script>
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
                <a href="./index.php" class="active"><span class="material-symbols-outlined"> menu_book </span><h3>Classes</h3></a>
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
                <a href="./logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>



        <main>

            <ul>
                <li><a href="./class-view.php">Link and Announcement</a></li>
                <li class="dropdown-01">
                    <a href="javascript:void(0)" class="dropbtn-01">Homework</a>
                    <div class="dropdown-content-01">
                    <a href="homework/hw-creation.php">Homework Creation</a>
                    <a href="homework/hw-grading.php">Homework Grading</a>
                    </div>
                </li>
                <li><a href="#" class="active-nav">Class Details</a></li>
            </ul><br>

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
                            <p>Hey, <b><?php echo $em_username01; ?></b></p>
                            <small class="text-muted">Teacher</small>
                        </div>
                        <div class="profile-photo">
                            <img src="../images/employee/<?php echo $em_img01; ?>" alt="profile picture">
                        </div>
                    </div>
                </div>
            </div>

            <h1 style="color: #ff7782;"><?php echo $cl_id;?> - <?php echo $cl_title;?> - <?php echo $cl_lan; ?></h1><br>

            <h2 style="font-size: 20px;">STUDENTS</h2><br>

            <div class="hw">

                <div class="search">
                    <form action="" method="post">
                            <input type="search" name="search" placeholder=" Enter Student ID" required>
                            <input type="submit" name="searchSubmit">
                    </form>
                </div>

                <?php
                if(isset($_POST['searchSubmit'])){ 
                    
                    $searches = $_POST['search'];
                    ?>

                    <table class="link-update-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Username</th>
                                <th>DOB</th>
                                <th>Mobile</th>
                                <th>Last Payment</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody style="text-align: center;">
                            
                            <?php
                            $sn = 1;
                            
                            $sql3 = "SELECT * FROM student_enroll WHERE cl_id = '$cl_id' AND st_id LIKE '%$searches%'";

                            $res3 = mysqli_query($conn, $sql3);

                            $count3 = mysqli_num_rows($res3);
                            if($count3>0)
                            {
                                while($row=mysqli_fetch_assoc($res3))
                                {
                                    $st_id = $row['st_id'];
                                    $paid_month = $row['paid_month'];

                                    $sql4 = "SELECT * FROM student WHERE st_id = '$st_id'";

                                    $res4 = mysqli_query($conn, $sql4);

                                    $count4 = mysqli_num_rows($res4);

                                    if($count4>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res4)){

                                            $st_username = $row['st_username'];
                                            $st_dob = $row['st_dob'];
                                            $st_img = $row['st_img'];
                                            $st_phone = $row['st_phone'];
                                            $st_status = $row['status'];
                                    
                                    ?>

                                        <tr slyle="margin-bottom: 10px;">
                                            <td><?php echo $sn++ ; ?></td>
                                            <td style="width: 20px;">
                                                <img src="../images/profile-pic/<?php echo $st_img; ?>" alt="Profile Picture">
                                            </td>
                                            <td>
                                                <?php echo $st_username; ?>
                                            </td>
                                            <td>
                                                <?php echo $st_dob; ?>
                                            </td>
                                            <td>
                                                <?php echo $st_phone; ?>
                                            </td>
                                            <td>
                                                <?php echo $paid_month; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    if($st_status=="Active"){ ?>
                                                        <div class="success">
                                                            <?php echo $st_status; ?>
                                                        </div> <?php
                                                    }
                                                    else{ ?>
                                                        <div class="error">
                                                            <?php echo $st_status; ?>
                                                        </div> <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                        }
                                    }
                                }
                            } else{ ?>
                                <tr>
                                    <td colspan="7">
                                        <h3 style="text-align: center; color: red;">No any student joined yet.</h3>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                <?php
                }else{ ?>

                    <table class="link-update-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Username</th>
                                <th>DOB</th>
                                <th>Mobile</th>
                                <th>Last Payment</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody style="text-align: center;">
                            
                            <?php
                            $sn = 1;
                            
                            $sql3 = "SELECT * FROM student_enroll WHERE cl_id = '$cl_id'";

                            $res3 = mysqli_query($conn, $sql3);
                            $count3 = mysqli_num_rows($res3);
                            if($count3>0)
                            {
                                while($row=mysqli_fetch_assoc($res3))
                                {
                                    
                                    $st_id = $row['st_id'];
                                    $paid_month = $row['paid_month'];

                                    $sql4 = "SELECT * FROM student WHERE st_id = '$st_id'";

                                    $res4 = mysqli_query($conn, $sql4);

                                    $count4 = mysqli_num_rows($res4);

                                    if($count4>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res4)){

                                            $st_username = $row['st_username'];
                                            $st_dob = $row['st_dob'];
                                            $st_img = $row['st_img'];
                                            $st_phone = $row['st_phone'];
                                            $st_status = $row['status'];
                                    
                                    ?>

                                        <tr slyle="margin-bottom: 10px;">
                                            <td><?php echo $sn++ ; ?></td>
                                            <td style="width: 20px;">
                                                <img src="../images/profile-pic/<?php echo $st_img; ?>" alt="Profile Picture">
                                            </td>
                                            <td>
                                                <?php echo $st_username; ?>
                                            </td>
                                            <td>
                                                <?php echo $st_dob; ?>
                                            </td>
                                            <td>
                                                <?php echo $st_phone; ?>
                                            </td>
                                            <td>
                                                <?php echo $paid_month; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    if($st_status=="Active"){ ?>
                                                        <div class="success">
                                                            <?php echo $st_status; ?>
                                                        </div> <?php
                                                    }
                                                    else{ ?>
                                                        <div class="error">
                                                            <?php echo $st_status; ?>
                                                        </div> <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                        }
                                    }
                                }
                            } else{ ?>
                                <tr>
                                    <td colspan="7">
                                        <h3 style="text-align: center; color: red;">No any student joined yet.</h3>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                <?php
                }
                ?>


                
            </div>
            <div id="myModal" class="modal">
                   
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div id="modalContent">
                    </div>
                </div>
            </div>
         
        </main>
        
    </div>

    
    <script src="./teacher.js"></script>

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
            url: 'hw-process.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
               
                if (typeof response === 'object' && response !== null) {
                   
                    modalContent.innerHTML = `
                        <div class="popup1">
                            <h2>PUBLISH RESULTS</h2>
                            <form action="add-hw-grading.php" method="post" enctype="multipart/form-data">
                                <table>
                                    <tr>
                                        <td>Content: </td>
                                        <td>
                                            <textarea name="content" rows="5" cols="80" required></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Result Status: </td>
                                        <td>
                                            <select name="result_status" required>
                                                <option value="">.....</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="hw_id" value="${response.hw_id}">
                                </table>

                                <div class="save">
                                    <button type="submit" name="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        `;
                        CKEDITOR.replace('content');
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
        function copyLink() {
            
            const linkText = "<?php echo $cl_link; ?>";
            const tempInput = document.createElement('input');
            tempInput.value = linkText;

            document.body.appendChild(tempInput);

            tempInput.select();
            tempInput.setSelectionRange(0, 99999); 

            document.execCommand('copy');

            document.body.removeChild(tempInput);

            const copyButton = document.getElementById('copyButton');
            copyButton.innerHTML = 'Copied';

            setTimeout(() => {
                copyButton.innerHTML = 'Copy Link';
            }, 2000);
        }
    </script>


    <?php if(isset($_SESSION['not-hw-id'])){ ?>
        <script>
            swal({
                title: "Homework Could not be found. Please try again!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['not-hw-id']); } ?>

    <?php if(isset($_SESSION['hw-grading-add-ok'])){ ?>
        <script>
            swal({
                title: "Results added successfully!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['hw-grading-add-ok']); } ?>

    <?php if(isset($_SESSION['hw-grading-add-error'])){ ?>
        <script>
            swal({
                title: "Failed to add results!. Please try again!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['hw-grading-add-error']); } ?>


</body>
</html>
