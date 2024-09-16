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
                <li><a href="#0" class="active-nav">Create Exams and Questions</a></li>
                <li><a href="./exam-grade.php">Grade exams</a></li>
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

            <br>
            <h1>EXAM CREATION</h1><br>

            <div class="exam">
                <form action="add-exam.php" method="post">
                    <h1 style="text-align: center;"><strong>ADD EXAM</strong></h1><br>
                    <table class="link-update-table">
                        <tr>
                            <td>
                                <h2>Exam Title: </h2>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter exam title here" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>Class: </h2>
                            </td>
                            <td>
                                <?php
                                $sql2 = "SELECT * FROM class WHERE em_id='$em_id_teacher'";

                                $res2 = mysqli_query($conn, $sql2);

                                $count2 = mysqli_num_rows($res2);

                                if($count2>0){ ?>

                                    <select name="cl_id" required>    
                                        <option value="">--- Select Your Class ---</option>

                                    <?php
                                    while($row=mysqli_fetch_assoc($res2)){
                                        $cl_id = $row['cl_id'];
                                        $cl_title = $row['cl_title'];
                                        $cl_lan = $row['cl_lan']; ?>

                                        <option value="<?php echo $cl_id; ?>"><?php echo $cl_title; echo " - "; echo $cl_lan;?></option>

                                    <?php
                                    }
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>Exam time in minutes: </h2>
                            </td>
                            <td>
                                <input type="number" name="time" placeholder="Enter time in minutes" min="0" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>Exam Date and Time: </h2>
                            </td>
                            <td>
                                <input type="datetime-local" id="ex_date" name="date" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>Exam Status: </h2>
                            </td>
                            <td>
                                <select name="status" required>    
                                    <option value="">--- Select Exam Status ---</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>Enter exam rules:</h2>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100%;" colspan="2">
                                <textarea name="rules" id="content">Enter exam rules here.</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100%;" colspan="2">
                                <input type="hidden" name="em_id" value="<?php echo $em_id_teacher; ?>">
                                <input type="submit" value="Add Exam" name="submit">
                            </td>
                        </tr>
                    </table>
                </form>
            </div><br>

            <h1><strong>EXAM MANAGEMENT</strong></h1><br>

            <div class="hw" style="text-align: center;">
                <table class="link-update-table">
                    <tr>
                        <th>Exam ID</th>
                        <th>Exam Title</th>
                        <th>Duration(Minutes)</th>
                        <th>Date and Time</th>
                        <th>Class ID</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    
                        <?php

                        $sql4 = "SELECT * FROM class WHERE em_id = '$em_id01'";

                        $res4 = mysqli_query($conn, $sql4);

                        $count4 = mysqli_num_rows($res4);

                        if($count4>0){ 

                            while($row=mysqli_fetch_assoc($res4)){

                                $cl_id = $row['cl_id'];

                            $sql3 = "SELECT * FROM exams WHERE cl_id = '$cl_id' ORDER BY id DESC";

                            $res3 = mysqli_query($conn, $sql3);

                            $count3 = mysqli_num_rows($res3);

                            if($count3>0){ 

                                while($row=mysqli_fetch_assoc($res3)){

                                    $ex_id = $row['ex_id'];
                                    $ex_title = $row['ex_title'];
                                    $ex_time = $row['ex_time'];
                                    $ex_date_time = $row['ex_date_time']; 
                                    $ex_rules = $row['ex_rules'];
                                    $cl_id = $row['cl_id'];
                                    $ex_status = $row['ex_status'];  ?>

                                <tr>
                                    <td><?php echo $ex_id; ?></td>
                                    <td><a href="question-session.php?ex_id=<?php echo $ex_id; ?>" class="btn" style="color: #1E90FF;"><?php echo $ex_title; ?></a></td>
                                    <td><?php echo $ex_time; ?></td>
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
                                    <td><?php echo $cl_id; ?></td>
                                    <td style="text-align: center;">
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
                                            <button class="pop_btn" style="width: 100%;">Edit</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        }
                    } ?>
                </table>
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

    
    <script src="../teacher.js"></script>

    <script>
        const datetimeInput = document.getElementById('ex_date');

        datetimeInput.addEventListener('change', function() {
            const selectedDate = new Date(datetimeInput.value);
            const currentDate = new Date();

            if (selectedDate < currentDate) {
            alert("Please select a future date and time.");
            datetimeInput.value = ''; 
            }
        });
    </script>

    <script>
        tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
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
            url: 'exam-process.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
                if (typeof response === 'object' && response !== null) {
                    modalContent.innerHTML = `
                        <div class="popup1">
                            <h2>EXAM STATUS</h2>
                            <form action="update-exam.php" method="post">
                                <table>
                                    <tr>
                                        <td>Exam Title: </td>
                                        <td>
                                            <input type="text" name="ex_title" value="${response.ex_title}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> New Time in Minutes: </td>
                                        <td>
                                            <input type="number" name="ex_time" value="${response.ex_time}" min="0" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Exam Date and Time: </td>
                                        <td>
                                            <input type="datetime-local" name="date" value="${response.ex_date_time}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status: </td>
                                        <td>
                                            <select name="ex_status" required>
                                                <option value="${response.ex_status}">${response.ex_status}</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Exam rules: </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%;" colspan="2">
                                            <textarea name="rules" id="content01">${response.ex_rules}</textarea>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="ex_id" value= ${response.ex_id}>
                                </table>

                                <div class="save">
                                    <div class="delete">
                                            <button type="button" class="error reject-link" data-req-id="${response.ex_id}">Delete Exam</button>
                                    </div>
                                    <button type="submit" name="update_ex">Save</button>
                                </div>
                            </form>
                        </div>
                        `;

                        tinymce.init({
                        selector: 'textarea',
                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                        });

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
                var ex_id = event.target.getAttribute('data-req-id');

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this details!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href = `./delete-exam.php?ex_id=${ex_id}`;
                    } else {
                    }
                });
            }
        });
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

    <?php if(isset($_SESSION['update-exm-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Updated homework!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update-exm-ok']); } ?>

    <?php if(isset($_SESSION['update-exm-error'])){ ?>
        <script>
            swal({
                title: "Failed to update the exam! Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update-exm-error']); } ?>

    <?php if(isset($_SESSION['ex-delete-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Deleted homework!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ex-delete-ok']); } ?>

    <?php if(isset($_SESSION['ex-delete-error'])){ ?>
        <script>
            swal({
                title: "Failed to Delete exam! Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ex-delete-error']); } ?>

    <?php if(isset($_SESSION['ex-id-error'])){ ?>
        <script>
            swal({
                title: "Failed to Load exam! Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ex-id-error']); } ?>

</body>
</html>
