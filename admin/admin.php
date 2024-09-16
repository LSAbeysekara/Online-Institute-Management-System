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
                <a href="exam.php"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="feedback.php"><span class="material-symbols-outlined"> feedback </span><h3>Feedback</h3><span class="message-count">20</span></a>
                <a href="notification.php"><span class="material-symbols-outlined">campaign</span><h3>Notification Panel</h3></a>
                <a href="#0" class="active"><span class="material-symbols-outlined">shield_person</span><h3>Admin</h3></a>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

        <main>
                <div class="recent-requests">
                <h1>ADMIN MANAGEMENT</h1>

                <div class="search">
                    <form action="" method="post">
                            <input type="search" name="search" placeholder=" Enter Admin ID or Username" required>
                            <input type="submit" name="searchSubmit">
                    </form>
                </div>

                <div class="add">
                    <button onclick="openPopup()">New Admin</button>
                </div>

                <?php if(isset($_POST['searchSubmit'])) { 
                    $search01 = $_POST['search'];
                    echo "<div class='s-result-01'>Results for your ~$search01~ search </div>";
                }    
                ?>

                <table class="Category">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Address</th>
                            <th>Image</th>
                            <th>Email</th>
                            <th>Mob no.</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        
                    </thead>
                    <tbody>

                    <?php

                        if(isset($_POST['searchSubmit'])){

                            $searches = $_POST['search'];

                            $sql3 = "SELECT * FROM employee WHERE (em_id LIKE '%$searches%' OR em_username LIKE '%$searches%') AND em_position='Admin'";


                            $res3 = mysqli_query($conn, $sql3);

                            $count3 = mysqli_num_rows($res3);

                            if($count3>0)
                            {
                                while($row=mysqli_fetch_assoc($res3))
                                {
                                    $sn = 1;
                                    $em_id = $row['em_id'];
                                    $em_username = $row['em_username'];
                                    $em_name = $row['em_name'];
                                    $em_dob = $row['em_dob'];
                                    $em_address = $row['em_address'];
                                    $em_img = $row['em_img'];
                                    $em_email = $row['em_email'];
                                    $em_phone = $row['em_phone'];
                                    $status = $row['status'];

                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $em_id; ?></td>
                                        <td><?php echo $em_username; ?></td>
                                        <td><?php echo $em_name; ?></td>
                                        <td><?php echo $em_dob; ?></td>
                                        <td><?php echo $em_address; ?></td>
                                         <td>
                                            <?php
                                                if($em_img=="")
                                                {
                                                    echo "<div class='error'> No Image Uploaded.</div>";
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="cl-img">
                                                        <img src="../images/employee/<?php echo $em_img; ?>" width="70" height="80">
                                                    </div>
                                                    <?php
                                                } ?>
                                         </td>
                                        <td><?php echo $em_email; ?></td>
                                        <td><?php echo $em_phone; ?></td>
                                        <td>
                                            <?php 
                                                if($status=="Active"){ ?>
                                                    <div class="success">
                                                        <?php echo $status; ?>
                                                    </div> <?php
                                                }
                                                else{ ?>
                                                    <div class="error">
                                                        <?php echo $status; ?>
                                                    </div> <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="edit-btn-02">
                                                <div class="item" onclick="loadContent('<?php echo $em_id; ?>')">
                                                    <button class="pop_btn">Edit</button> 
                                                </div>
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
                            $sql = "SELECT * FROM employee WHERE em_position = 'Admin'";

                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if($count>0){
                                while($row=mysqli_fetch_assoc($res)){
                                    $sn = 1;
                                    $em_id = $row['em_id'];
                                    $em_username = $row['em_username'];
                                    $em_name = $row['em_name'];
                                    $em_dob = $row['em_dob'];
                                    $em_address = $row['em_address'];
                                    $em_img = $row['em_img'];
                                    $em_email = $row['em_email'];
                                    $em_phone = $row['em_phone'];
                                    $status = $row['status'];

                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $em_id; ?></td>
                                        <td><?php echo $em_username; ?></td>
                                        <td><?php echo $em_name; ?></td>
                                        <td><?php echo $em_dob; ?></td>
                                        <td><?php echo $em_address; ?></td>
                                         <td>
                                            <?php
                                                if($em_img=="")
                                                {
                                                    echo "<div class='error'> No Image Uploaded.</div>";
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="cl-img">
                                                        <img src="../images/employee/<?php echo $em_img; ?>" width="100" height="100">
                                                    </div>
                                                    <?php
                                                } ?>
                                         </td>
                                        <td><?php echo $em_email; ?></td>
                                        <td><?php echo $em_phone; ?></td>
                                        <td>
                                            <?php 
                                                if($status=="Active"){ ?>
                                                    <div class="success">
                                                        <?php echo $status; ?>
                                                    </div> <?php
                                                }
                                                else{ ?>
                                                    <div class="error">
                                                        <?php echo $status; ?>
                                                    </div> <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="edit-btn-02">
                                                <div class="item" onclick="loadContent('<?php echo $em_id; ?>')">
                                                    <button class="pop_btn">Edit</button> 
                                                </div>
                                            </div>  
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='11' Class='error'>No Admins Found</td></tr>";
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <!-- <div class="pop_container">
                <div class="popup" id="popup">
                    <form action="add-admin.php" method="post" enctype="multipart/form-data">
                        <h2>NEW ADMIN</h2>
                        <table>
                            <tr>
                                <td>Username: </td>
                                <td>
                                    <input type="text" name="username" placeholder="Enter Username" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Name: </td>
                                <td>
                                    <input type="text" name="name" placeholder="Enter Full name" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Password: </td>
                                <td>
                                <input type="password" name="pass" placeholder="Enter Password" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Confirm Password: </td>
                                <td>
                                <input type="password" name="cpass" placeholder="Confirm Password" required>
                                </td>
                            </tr>
                            <tr>
                                <td>DOB: </td>
                                <td>
                                    <input type="date" name="date" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Address: </td>
                                <td>
                                    <textarea name="address" placeholder="Enter Address" cols="30" rows="10" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Select Image: </td>
                                <td>
                                    <input type="file" name="image">
                                </td>
                            </tr>
                            <tr>
                                <td>Email: </td>
                                <td>
                                    <input type="email" name="email" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Mobile: </td >
                                <td>
                                    <input type="tel" name="mobile" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Status: </td>
                                <td>
                                    <select name="status" required>
                                        <option value="">--Choose--</option>
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
            </div> -->


            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div id="modalContent"></div>
                </div>
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
                    
                        <div class="info">
                            <p>Hey, <b><?php echo $em_username01; ?></b></p>
                            <small class="text-muted">Admin</small>
                        </div>
                        <div class="profile-photo">
                            <img src="../images/employee/<?php echo $em_img01; ?>" alt="profile picture">
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
            url: 'admin-status-update.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
                if (typeof response === 'object' && response !== null) {
                    modalContent.innerHTML = `
                        <div class="popup1">
                            <h2>EDIT ADMIN STATUS</h2>
                            <form action="update-admin-status.php" method="post" enctype="multipart/form-data">
                                <table>
                                    <tr>
                                        <td>Admin Status: </td>
                                        <td>
                                            <select name="status" required>
                                                <option value="${response.status}">${response.status}</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>

                                <input type="hidden" name="em_id" value="${response.em_id}">
                                <div class="save">
                                    <button type="submit" name="update">Save</button>
                                </div>
                            </form>
                        </div>
                        `;
                } else {
                    modalContent.innerHTML = "Error: Failed to load Admin details.";
                }

                openModal(); 
            },
            error: function () {
                modalContent.innerHTML = "Error: Failed to load Admin details.";
                openModal();
            }
        });
    }

    </script>
    
    <!-- <script>
        
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

    </script> -->
    
    <!-- <script>
        function openModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        function loadContent(item) {
            var modalContent = document.getElementById("modalContent");

            $.ajax({
                url: './admin-process.php',
                method: "POST",
                data: { item: item },
                success: function (response) {
                    if (typeof response === 'object' && response !== null) {
                        modalContent.innerHTML = `
                                <div class="popup1" id="popup1">
                                    <h2>EDIT ADMIN</h2>
                                    <form action="update-admin.php" method="post" enctype="multipart/form-data">
                                    <table>
                                            <tr>
                                                <td>ID: </td>
                                                <td>
                                                    <label>${response.em_id} </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Username: </td>
                                                <td>
                                                    <input type="text" name="username" placeholder="Enter Username" value="${response.em_username}" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Name: </td>
                                                <td>
                                                    <input type="text" name="name" placeholder="Enter Full name" value="${response.em_name}" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Old Password: </td>
                                                <td>
                                                <input type="password" name="opass" placeholder="--Enter Password--">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>New Password: </td>
                                                <td>
                                                <input type="password" name="pass" placeholder="--Enter Password--">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Confirm Password: </td>
                                                <td>
                                                <input type="password" name="cpass" placeholder="--Confirm Password--">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>DOB: </td>
                                                <td>
                                                    <input type="date" name="dob" required value="${response.em_dob}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Address: </td>
                                                <td>
                                                    <textarea name="address" placeholder="Enter Address" cols="30" rows="5" required>${response.em_address}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Image: </td>
                                                <td>
                                                    ${response.em_img === "" ? '<div class="error"> No Image Uploaded.</div>' : `<div class="cl-img02"><img src="../images/employee/${response.em_img}" width="15" height="15"></div>`}
                                                    <input type="hidden" name="em_img" value="${response.em_img}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Select New Image: </td>
                                                <td>
                                                    <input type="file" name="image01">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email: </td>
                                                <td>
                                                    <input type="email" name="email" required value="${response.em_email}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mobile: </td >
                                                <td>
                                                    <input type="tel" name="mobile" required value="${response.em_phone}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status: </td>
                                                <td>
                                                    <select name="status" required>
                                                        <option value="${response.status}">${response.status}</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <input type="hidden" name="em_id" value= ${response.em_id}>
                                        </table>
                                
                                        <div class="save">
                                            <div class="delete">
                                                <button type="button" class="error" onclick="deleteForm()">Delete Admin</button>
                                            </div>
                                        <button type="submit" name="update">Save</button>
                                    </form>
                                </div>
                            </div>
                        `;
                    } else {
                        modalContent.innerHTML = "Error: Failed to load Admin details.";
                    }

                    openModal(); 
                },
                error: function () {
                    modalContent.innerHTML = "Error: Failed to load Admin details.";
                    openModal(); 
                }
            });
        }
    </script>  -->
 
    <script>
        function deleteForm() {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "./delete-admin.php?id=<?php echo $em_id; ?>&image_name=<?php echo $em_img; ?>";
                }else {

                }
                });
        }
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
        if(isset($_SESSION['admin-add-user-error'])){ ?>
        <script>
            swal({
                title: "Username Already Taken!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['admin-add-user-error']); } ?>

    <?php
        if(isset($_SESSION['add'])){ ?>
        <script>
            swal({
                title: "Data Added!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['add']); } ?>

    <?php
        if(isset($_SESSION['admin-update-ok'])){ ?>
        <script>
            swal({
                title: "Data Updated Successfully!"
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['admin-update-ok']); } ?>

    <?php
        if(isset($_SESSION['admin-update-error'])){ ?>
        <script>
            swal({
                title: "Passwords Dont' match!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['admin-update-error']); } ?>

    <?php
        if(isset($_SESSION['admin-update-error-02'])){ ?>
        <script>
            swal({
                title: "Incorrect details",
                icon: "warning",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['admin-update-error-02']); } ?>

    <?php
        if(isset($_SESSION['admin-delete-ok'])){ ?>
        <script>
            swal({
                title: "Data Deleted!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['admin-delete-ok']); } ?>

    <?php
        if(isset($_SESSION['admin-delete-error'])){ ?>
        <script>
            swal({
                title: "Failed to delete Data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['admin-delete-error']); } ?>

    <?php
        if(isset($_SESSION['update-admin-status-ok'])){ ?>
        <script>
            swal({
                title: "Data Saved Successfully!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update-admin-status-ok']); } ?>

    <?php
        if(isset($_SESSION['update-admin-status-error'])){ ?>
        <script>
            swal({
                title: "Failed to update Status!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update-admin-status-error']); } ?>

</body>
</html>

