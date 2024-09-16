<?php include('../config/constant.php'); ?>
<?php include('login-check.php'); ?>

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
    <script src="https://cdn.tiny.cloud/1/ipootvjlv9vz4p1d1x91ok27oce25gt4no6r0tddj5c98lsw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
                <a href="index.php" class="active"><span class="material-symbols-outlined"> menu_book </span><h3>Classes</h3></a>
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
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>



        <main>

        <ul>
            <li><a href="#0" class="active-nav">Link and Announcement</a></li>
            <li class="dropdown-01">
                <a href="javascript:void(0)" class="dropbtn-01">Homework</a>
                <div class="dropdown-content-01">
                <a href="homework/hw-creation.php">Homework Creation</a>
                <a href="homework/hw-grading.php">Homework Grading</a>
                </div>
            </li>
            <li><a href="./cl-st-view.php">Class Details</a></li>
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

            <h1 style="color: #ff7782;"><?php echo $cl_id;?> - <?php echo $cl_title;?> - <?php echo $cl_lan; ?></h1><br>

            <h1>CLASS LINK</h1><br>

            <form action="update-link.php" method="post">
                <table class="link-update-table">
                    <tr>
                        <td>
                            <h2>Set the new date and time: </h2>
                        </td>
                        <td>
                            <input type="date" name="cl_link_date" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2>Set the new class link here: </h2>
                        </td>
                        <td>
                            <textarea name="cl_link" cols="30" rows="5" placeholder="Enter the class link here." required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="cl_id" value="<?php echo $cl_id; ?>">
                            <input type="submit" name="link" value="Set Link">
                        </td>
                    </tr>
                </table>
            </form> <br>

            <?php
            
            date_default_timezone_set('Asia/Colombo');
            $current_date = date('Y-m-d');
            $css_class = (strtotime($cl_link_date) < strtotime($current_date)) ? 'red' : 'green';
            ?>

            <div class="<?php echo $css_class; ?>">
                <table class="link-update-table">
                    <tr>
                        <td>
                            <h2>Date: </h2>
                        </td>
                        <td>
                            <h3><?php echo $cl_link_date; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2>Link: </h2>
                        </td>
                        <td>
                            <h3><?php echo $cl_link; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="max-width: 30px;">
                            <button onclick="copyLink()" id="copyButton" class="link-update-table copy-button">Copy Link</button>
                        </td>
                    </tr>
                </table>
            </div>

            <br>

            <h1>ANNOUNCEMENT AREA</h1>

            <h2 style="text-align: center;">NEW ANNOUNCEMENT</h2>

            <div class="hw">
                <form action="ano-add.php" method="post" class="link-update-table">
                    <textarea name="content" id="content"></textarea>
                    <input type="hidden" name="cl_id" value="<?php echo $cl_id; ?>"><br>
                    <h3 style="font-size: 17px; margin-left: 10px;">Announcement Status:</h3>
                    <select name="ano_status" class="select-container" style="margin-left: 10px;" required>
                        <option value="">....</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select><br>
                    <input type="submit" name="announcement" value="Submit" style="margin: 10px;">
                </form>

                <br>
            </div>
                <h2 style="text-align: center;">PREVIEW ANNOUNCEMENTS</h2><br>

            <div class="hw">    

                    <?php

                    $sql3 = "SELECT * FROM announcement WHERE cl_id='$cl_id' ORDER BY id DESC";

                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);

                    if($count3>0){ ?>

                        <table class="link-update-table">
                            <thead>
                                <tr>
                                    <th>Preview</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        
                        <?php
                        while($row=mysqli_fetch_assoc($res3)){
                            $ano_id = $row['ano_id'];
                            $ano_content = $row['ano_content']; 
                            $ano_created = $row['ano_created']; 
                            $ano_status = $row['ano_status']; ?>

                        <tr>
                            <td style="border-bottom: 1px solid #0056b3;">
                                <?php echo $ano_content; ?>
                            </td>
                            <td style="text-align: center; border-bottom: 1px solid #0056b3;">
                                <?php echo $ano_created; ?>
                            </td>
                            <td style="text-align: center; border-bottom: 1px solid #0056b3; cursor: pointer;" onclick="loadContent('<?php echo $ano_id; ?>')">
                                <?php 
                                    if($ano_status=="Active"){ ?>
                                        <div class="success">
                                            <?php echo $ano_status; ?>
                                        </div> <?php
                                    }
                                    else{ ?>
                                        <div class="error">
                                            <?php echo $ano_status; ?>
                                        </div> <?php
                                    }
                                ?>
                            </td>
                            <td style="text-align: center; border-bottom: 1px solid #0056b3;">
                                <button onclick="deleteForm('<?php echo $ano_id; ?>')" class="link-update-table copy-button" style="background-color: red;">Delete</button>
                            </td>
                        </tr>

                        <?php
                        }
                    }else{ ?>
                        <h3 style="text-align: center; color: red;">No any announcement added yet.</h3>
                    <?php
                    } 
                    ?>

                    </tbody>

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

    
    <script src="teacher.js"></script>

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
            url: 'ano-process.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
             
                if (typeof response === 'object' && response !== null) {
                    
                    modalContent.innerHTML = `
                        <div class="popup1">
                            <h2>ANNOUNCEMENT STATUS</h2>
                            <form action="update-ano.php" method="post">
                                <table>
                                    <tr>
                                        <td>Status: </td>
                                        <td>
                                            <select name="ano_status" required>
                                                <option value="${response.ano_status}">${response.ano_status}</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    
                                    <input type="hidden" name="ano_id" value= ${response.ano_id}>
                                </table>

                                <div class="save">
                                    <button type="submit" name="update_ano">Save</button>
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
        tinymce.init({
        selector: 'textarea#content',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
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

    <?php if(isset($_SESSION['update-link-ok'])){ ?>
        <script>
            swal({
                title: "Link Updated Successfully!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update-link-ok']); } ?>

    <?php if(isset($_SESSION['update-link-error'])){ ?>
        <script>
            swal({
                title: "Failed to update the link!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update-link-error']); } ?>

    <?php if(isset($_SESSION['an-add-ok'])){ ?>
        <script>
            swal({
                title: "Announcement added successfully!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['an-add-ok']); } ?>

    <?php if(isset($_SESSION['an-add-error'])){ ?>
        <script>
            swal({
                title: "Failed to add the announcement!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['an-add-error']); } ?>

    <?php if(isset($_SESSION['ano-delete-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Deleted!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ano-delete-ok']); } ?>

    <?php if(isset($_SESSION['ano-delete-error'])){ ?>
        <script>
            swal({
                title: "Failed to delete the announcement!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ano-delete-error']); } ?>

    <?php if(isset($_SESSION['update-ano-ok'])){ ?>
        <script>
            swal({
                title: "Announcement Status Updated Successfully!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update-ano-ok']); } ?>

    <?php if(isset($_SESSION['update-ano-error'])){ ?>
        <script>
            swal({
                title: "Failed to Update the Announcement Status!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update-ano-errorr']); } ?>

</body>
</html>
