<?php include('../../config/constant.php'); ?>
<?php include('../login-check.php'); ?>

<?php
    $em_id_teacher = "0";
    if(isset($_SESSION['em_id_teacher'])){
        $em_id_teacher = $_SESSION['em_id_teacher'];
    }

    if($em_id_teacher == "0"){
        $_SESSION['login-status-03'] = "error";
        header('location: ../../admin/login.php');
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
        }else{
            $_SESSION['login-status-03'] = "error";
            header('location: ../../admin/login.php');
        }

        $ex_id = "0";
        if(isset($_GET['ex_id'])){

            $ex_id = $_GET['ex_id'];

            $sql2 = "SELECT * FROM exams WHERE ex_id = '$ex_id'";

            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);

            if($count2>0){ 

                while($row=mysqli_fetch_assoc($res2)){

                    $ex_title = $row['ex_title'];
                    $cl_id = $row['cl_id'];
                }
            }
        }

        if($ex_id == "0"){
            $_SESSION['ex-id-error'] = "error";
            header('location: ./exam-grade.php');
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
    <script src="https://cdn.tiny.cloud/1/ipootvjlv9vz4p1d1x91ok27oce25gt4no6r0tddj5c98lsw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
                <a href="../index.php" ><span class="material-symbols-outlined"> menu_book </span><h3>Classes</h3></a>
                <a href="#" class="active"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
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
                <li><a href="index.php">Create Exams and Questions</a></li>
                <li><a href="exam-grade.php" class="active-nav">Grade exams</a></li>
            </ul><br>

            
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
            

            <?php
            $sql3 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

            $res3 = mysqli_query($conn, $sql3);

            $count3 = mysqli_num_rows($res3);

            if($count3>0){ 

                while($row=mysqli_fetch_assoc($res3)){

                    $cl_title = $row['cl_title'];
                    $cl_grade = $row['cl_grade'];
                }
            }

            ?>

            
            <h1><strong><?php echo $cl_title." - Grade ".$cl_grade; ?></strong></h1><br>
            <h2><?php echo $ex_title; ?></h2><br>

            <div class="hw" style="text-align: center;">
                <table>
                    <tr>
                        <th>Student</th>
                        <th>Correct answer count</th>
                        <th>Marks</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    <form action="#" method="post">
                        <?php
                        $sql5 = "SELECT * FROM exam_results WHERE ex_id = '$ex_id'";

                        $res5 = mysqli_query($conn, $sql5);

                        $count5 = mysqli_num_rows($res5);

                        if ($count5 > 0) {
                            while ($row = mysqli_fetch_assoc($res5)) {
                                $res_id = $row['res_id'];
                                $st_id_g = $row['st_id'];
                                $result = $row['result'];
                                $act_result = $row['act_result'];
                                $status_result = $row['status'];


                                $sql6 = "SELECT * FROM student WHERE st_id = '$st_id_g'";

                                $res6 = mysqli_query($conn, $sql6);

                                $count6 = mysqli_num_rows($res6);

                                if ($count6 > 0) {
                                    while ($row = mysqli_fetch_assoc($res6)) {
                                        $st_username_g = $row['st_username'];
                                        $status_st = $row['status'];
                                ?>

                                        <tr>
                                            <td><?php echo $st_id_g . " - " . $st_username_g; ?></td>
                                            <th><?php echo $result; ?></th>
                                            <td><input type="number" name="grading" value="<?php echo $act_result; ?>" min=0></td>
                                            <td>
                                                <select name="status" id="status">
                                                    <option value="<?php echo $status_result; ?>"><?php echo $status_result; ?></option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="hidden" name="res_id" value="<?php echo $res_id; ?>">
                                                <input type="hidden" name="username" value="<?php echo $st_id_g; ?>">
                                                <button type="button" class="save-button" onclick="saveData('<?php echo $res_id; ?>', '<?php echo $st_id_g; ?>', this)">Save</button>
                                            </td>
                                        </tr>

                                <?php
                                            }
                                        }
                                    }
                                }else{ ?>

                                    <tr>
                                        <td colspan="5" style="color: red;">No any student participated for this exam.</td>
                                    </tr>

                                <?php
                                }
                                ?>

                    </form>
                </table>
            </div> 
         
        </main>
    </div>

    <script>
        function saveData(res_id, username, button) {

            var row = button.parentNode.parentNode;

            var gradingInput = row.querySelector('input[name="grading"]');
            var statusSelect = row.querySelector('select[name="status"]');

            var grading = gradingInput.value;
            var status = statusSelect.value;

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
            xhttp.open("POST", "update_ex_result.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("res_id=" + res_id + "&username=" + username + "&grading=" + grading + "&status=" + status);
        }
    </script>

    <script src="../teacher.js"></script>

    <?php if(isset($_SESSION['update-exm-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Updated homework!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update-exm-ok']); } ?>


</body>
</html>
