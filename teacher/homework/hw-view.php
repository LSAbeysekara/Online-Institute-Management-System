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
                <a href="../exam/index.php" class="dropbtn"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
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
                    <a href="hw-creation.php" class="active-nav">Homework Creation</a>
                    <a href="hw-grading.php">Homework Grading</a>
                    </div>
                </li>
                <li><a href="../cl-st-view.php">Class Details</a></li>
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
                    $hw_created = $row['hw_created'];
                    $hw_title = $row['hw_title'];
                    $hw_content = $row['hw_content'];
                    $hw_expire = $row['hw_expire'];
                    $hw_status = $row['hw_status'];
                    ?>
                
                <?php
                }
            } ?>

            <h1>HOMEWORK</h1><br>
            <h2><?php echo $hw_title; ?></h2><br>
            
            <div class="hw">
                <table class="link-update-table">
                    <tr>
                        <td><h3>Creaded On: </h3> </td>
                        <td><h3><?php echo $hw_created; ?></h3></td>
                    </tr>
                    <tr>
                        <td><h3>Expired On: </h3></td>
                        <td style="cursor: pointer;" onclick="loadContent01('<?php echo $hw_id; ?>')">
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
                    <tr>
                        <td><h3>Status:</h3></td>
                        <td style="cursor: pointer;" onclick="loadContent('<?php echo $hw_id; ?>')">
                            <h3>
                                <?php 
                                    if($hw_status=="Active"){ ?>
                                        <div class="success">
                                            <?php echo $hw_status; ?>
                                        </div> <?php
                                    }
                                    else{ ?>
                                        <div class="error">
                                            <?php echo $hw_status; ?>
                                        </div> <?php
                                    }
                                ?>
                            </h3>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="hw">
                <table>
                    <tr>
                        <td><?php echo $hw_content; ?></td>
                    </tr>
                </table>
            </div>



            <div id="myModal" class="modal">
                  
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div id="modalContent">
                      
                    </div>
                </div>
            </div>

            <div id="myModal01" class="modal">
                  
                <div class="modal-content">
                    <span class="close" onclick="closeModal01()">&times;</span>
                    <div id="modalContent01">
                       
                    </div>
                </div>
            </div>
    

        </main>
        
    </div>

    
    <script src="../teacher.js"></script>

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
            url: 'hw-process.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
                
                if (typeof response === 'object' && response !== null) {
                    modalContent.innerHTML = `
                        <div class="popup1">
                            <h2>HOMEWORK STATUS</h2>
                            <form action="update-hw.php" method="post">
                                <table>
                                    <tr>
                                        <td>Status: </td>
                                        <td>
                                            <select name="hw_status" required>
                                                <option value="${response.hw_status}">${response.hw_status}</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    
                                    <input type="hidden" name="hw_id" value= ${response.hw_id}>
                                </table>

                                <div class="save">
                                    <button type="submit" name="update_hw">Save</button>
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
        var modal01 = document.getElementById("myModal01");

        function openModal01() {
            modal01.style.display = "block";
        }

        function closeModal01() {
            modal01.style.display = "none";
        }

        function loadContent01(item) {
        var modalContent01 = document.getElementById("modalContent01");

        $.ajax({
            url: 'hw-process.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
                if (typeof response === 'object' && response !== null) {
                    modalContent01.innerHTML = `
                        <div class="popup1">
                            <h2>HOMEWORK EXPIRE DATE AND TIME</h2>
                            <form action="update-hw-01.php" method="post">
                                <table>
                                    <tr>
                                        <td>Old Expire Date: </td>
                                        <td>
                                            <h3> ${response.hw_expire} </h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>New Expire Date: </td>
                                        <td>
                                            <input type="datetime-local" id="ex_date" name="hw_expire">
                                        </td>
                                    </tr>
                                    
                                    <input type="hidden" name="hw_id" value= ${response.hw_id}>
                                </table>

                                <div class="save">
                                    <button type="submit" name="update_hw_01">Save</button>
                                </div>
                            </form>
                        </div>
                        `;

                        const datetimeInput = document.getElementById('ex_date');

                        datetimeInput.addEventListener('change', function() {
                            const selectedDate = new Date(datetimeInput.value);
                            const currentDate = new Date();

                            if (selectedDate < currentDate) {
                            alert("Please select a future date and time.");
                            datetimeInput.value = ''; 
                            }
                        });
        
                } else {
                    modalContent01.innerHTML = "Error: Failed to load class details.";
                }

                openModal01(); 
            },
            error: function () {
                modalContent.innerHTML = "Error: Failed to load class details.";
                openModal01(); 
            }
        });
    }

    </script>

    <script>
        function deleteForm(ano_id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this details!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "./delete-ano.php?ano_id=" + ano_id + "&image_name=<?php echo $cl_img; ?>";
                } else {
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


    <?php if(isset($_SESSION['hw-add-ok'])){ ?>
        <script>
            swal({
                title: "Homework added successfully!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['hw-add-ok']); } ?>

    <?php if(isset($_SESSION['hw-add-error'])){ ?>
        <script>
            swal({
                title: "Failed to add the Homework!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['hw-add-error']); } ?>

    <?php if(isset($_SESSION['update-hw-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Updated!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update-hw-ok']); } ?>

    <?php if(isset($_SESSION['update-hw-error'])){ ?>
        <script>
            swal({
                title: "Failed to add the Homework!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update-hw-error']); } ?>

</body>
</html>
