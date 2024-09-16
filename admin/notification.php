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

        //execute the query
        $res10 = mysqli_query($conn, $sql10);

        //count the rows to check whether we have foods or not
        $count10 = mysqli_num_rows($res10);

        if($count10>0){
            //we have food in database
            //get the foods from database and display
            while($row=mysqli_fetch_assoc($res10)){
                //get the value from individual columns
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<!------------------------------------------------- Navigation ------------------------------------------------------------ -->
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
                <a href="#0" class="active"><span class="material-symbols-outlined">campaign</span><h3>Notification Panel</h3></a>
                <a href="admin.php"><span class="material-symbols-outlined">shield_person</span><h3>Admin</h3></a>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

<!------------------------------------------------- Display Platforms ------------------------------------------------------------ -->

        <main>
            <h1>NOTIFICATION MANAGEMENT</h1>

            <div class="search">
                    <form action="" method="post">
                            <input type="search" name="search" placeholder=" Enter Class ID or Title">
                            <input type="submit" name="searchSubmit">
                    </form>
            </div>
            
            <div class="add">
                    <button onclick="openPopup()">New Notification</button>
            </div>

                <div class="recent-requests">
                    <div class="insights-02">

                    <?php

                        $sn = 1;

                        if(isset($_POST['searchSubmit'])){

                            $searches = $_POST['search'];

                            $sql3 = "SELECT * FROM notification WHERE not_id LIKE '%$searches%' OR not_title LIKE '%$searches%'";

                            $res3 = mysqli_query($conn, $sql3);

                            //count rows to check whether the category is available or not
                            $count3 = mysqli_num_rows($res3);

                            if($count3>0){
                                //categories available
                                while($row=mysqli_fetch_assoc($res3))
                                {
                                    $not_id = $row['not_id'];
                                    $not_title = $row['not_title'];
                                    $not_img = $row['not_img'];
                                    $active = $row['active']; ?>

                                    <div class="box-3 float-container">
                                        <h3 style="color:red; margin-bottom:6px"><?php echo $not_id; ?></h3>
                                        <h3><?php echo $not_title; ?></h3>
                                        <?php
                                            //check whether image is available or not
                                            if($not_img=="")
                                            {
                                                //display the message
                                                echo "<div class='error'>Image Not Available.</div>";
                                            }
                                            else
                                            {
                                                //image available
                                                ?>
                                                <div class="notifi-img">
                                                    <img src="../images/notification/<?php echo $not_img; ?>">
                                                </div>
                                                <?php
                                            }
                                        ?>
                                            <div class="edit-btn-03">
                                                <h3>Active: 
                                                    <?php
                                                    if($active == 'Yes'){ ?>
                                                        <span class="success"><?php echo $active; ?></span>
                                                    <?php } else{ ?>
                                                        <span class="danger"><?php echo $active; ?></span>
                                                    <?php } ?>
                                                </h3>
                                            </div>
                                            
                                            <div class="edit-btn-03">
                                                <div class="item" onclick="loadContent('<?php echo $not_id; ?>')">
                                                    <button class="pop_btn">Edit</button>
                                                </div>
                                            </div>  
                                    </div>

                            <?php    }
                            }   
                        }else{ ?>

                        <?php
                            $sql = "SELECT * FROM notification";

                            $res = mysqli_query($conn, $sql);

                            //count rows to check whether the category is available or not
                            $count = mysqli_num_rows($res);

                            if($count>0){
                                //categories available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $not_id = $row['not_id'];
                                    $not_title = $row['not_title'];
                                    $not_img = $row['not_img'];
                                    $active = $row['active']; ?>

                                    <div class="box-3 float-container">
                                        <h3 style="color:red; margin-bottom:6px"><?php echo $not_id; ?></h3>
                                        <h3><?php echo $not_title; ?></h3>
                                        <?php
                                            //check whether image is available or not
                                            if($not_img=="")
                                            {
                                                //display the message
                                                echo "<div class='error'>Image Not Available.</div>";
                                            }
                                            else
                                            {
                                                //image available
                                                ?>
                                                <div class="notifi-img">
                                                    <img src="../images/notification/<?php echo $not_img; ?>">
                                                </div>
                                                <?php
                                            }
                                        ?>
                                            <div class="edit-btn-03">
                                                <h3>Active: 
                                                    <?php
                                                    if($active == 'Yes'){ ?>
                                                        <span class="success"><?php echo $active; ?></span>
                                                    <?php } else{ ?>
                                                        <span class="danger"><?php echo $active; ?></span>
                                                    <?php } ?>
                                                </h3>
                                            </div>
                                            
                                            <div class="edit-btn-03">
                                                <div class="item" onclick="loadContent('<?php echo $not_id; ?>')">
                                                    <button class="pop_btn">Edit</button>
                                                </div>
                                            </div> 
                                    </div>

                            <?php    }
                            }}
                        ?>
                    </div>
                </div>

            <div class="pop_container">
                <div class="popup" id="popup">
                    <form action="add-notifi.php" method="post" enctype="multipart/form-data">
                        <h2>NEW NOTIFICATION</h2>
                        <table>
                            <tr>
                                <td>Relevant Class(es): </td>
                                <td>
                                    <input type="text" name="class" placeholder="Enter the Relevant Class(es)">
                                </td>
                            </tr>
                            <tr>
                                <td>Select Image: </td>
                                <td>
                                    <input type="file" name="image">
                                </td>
                            </tr>
                            <tr>
                                <td>Acitve: </td>
                                <td>
                                    <select name="active" required>
                                        <option value="">...</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
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
            
<!----------------------------------------------------- Model 1 starts Here ------------------------------------>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div id="modalContent"></div>
                </div>
            </div>
<!----------------------------------------------------- Model 1 Ends Here ------------------------------------>

        </main>
            <!---------------------END OF MAIN---------------------->
    </div>

    <script src="./index.js"></script>
    
    <script>
        
        //Floating panel 1

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
    // Function to open the modal
    function openModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

    // Function to load content into the modal
    function loadContent(item) {
        var modalContent = document.getElementById("modalContent");

        $.ajax({
            url: 'notifi-process.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
                // Check if response is valid
                if (typeof response === 'object' && response !== null) {
                    // Populate the modal with the retrieved content
                    modalContent.innerHTML = `
                            <div class="popup1" id="popup1">
                                <h2>EDIT NOTIFICATION</h2>
                                <form action="update-notifi.php" method="post" enctype="multipart/form-data">
                                <table>
                                        <tr>
                                            <td>ID: </td>
                                            <td>
                                                <label>${response.not_id} </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Image: </td>
                                            <td>
                                                ${response.not_img === "" ? '<div class="error"> No Image Uploaded.</div>' : `<div class="cl-img02"><img src="../images/notification/${response.not_img}" width="15" height="15"></div>`}
                                                <input type="hidden" name="not_img" value="${response.not_img}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Selecet New Image: </td>
                                            <td>
                                                <input type="file" name="image01">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Active: </td>
                                            <td>
                                                <select name="active" required>
                                                    <option value="${response.active}">${response.active}</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                        <input type="hidden" name="not_id" value= ${response.not_id}>
                                    </table>
                            
                                    <div class="save">
                                        <div class="delete">
                                            <button type="button" class="error" onclick="deleteForm()">Delete Notification</button>
                                        </div>
                                    <button type="submit" name="update">Save</button>
                                </form>
                            </div>
                        </div>
                    `;
                } else {
                    modalContent.innerHTML = "Error: Failed to load class details.";
                }

                openModal(); // Open the modal
            },
            error: function () {
                modalContent.innerHTML = "Error: Failed to load class details.";
                openModal(); // Open the modal to show the error message
            }
        });
    }
    </script> 
            
    
    <script src="./sweetalert.min.js"></script>

    <?php
        if(isset($_SESSION['notifi-add-ok'])){ ?>
        <script>
            swal({
                title: "Data Added Successfully",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['notifi-add-ok']); } ?>

    <?php
        if(isset($_SESSION['notifi-add-error'])){ ?>
        <script>
            swal({
                title: "Failed to add Data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['notifi-add-error']); } ?>

    <?php
        if(isset($_SESSION['notifi-update_image-ok'])){ ?>
        <script>
            swal({
                title: "Data Saved Successfully!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['notifi-update_image-ok']); } ?>

    <?php
        if(isset($_SESSION['notifi-update_image-error'])){ ?>
        <script>
            swal({
                title: "Failed to Save Data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['notifi-update_image-error']); } ?>

    <?php
        if(isset($_SESSION['notifi-delete-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Deleted",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['notifi-delete-ok']); } ?>

    <?php
        if(isset($_SESSION['notifi-delete-error'])){ ?>
        <script>
            swal({
                title: "Failed to delete data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['notifi-delete-error']); } ?>

    <script>
        function deleteForm() {

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this information",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "../admin/delete-notifi.php?id=<?php echo $not_id; ?>&image_name=<?php echo $not_img; ?>";
                }else {

                }
                });
        }
    </script>
    
</body>
</html>