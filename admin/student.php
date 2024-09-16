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
                <a href="#0" class="active"><span class="material-symbols-outlined"> groups </span><h3>Student Panel</h3></a>
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
            <h1>STUDENT MANAGEMENT</h1>

            
            <div class="insights">
                <?php
                    $sql4 = "SELECT COUNT(*) FROM employee WHERE em_position = 'Teacher'";

                    $res4 = mysqli_query($conn, $sql4);

                    if($res4) {
                        $row = mysqli_fetch_array($res4);
                        $teacher_count = $row[0];
                    }

                ?>

                <div class="users">
                    <span class="material-symbols-outlined">record_voice_over</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Teachers</h3>
                            <h1><?php echo $teacher_count; ?></h1>
                        </div>
                    </div>
                </div>
                
                <?php
                    $sql5 = "SELECT * FROM payments";
                    
                    $res5 = mysqli_query($conn, $sql5);

                    $count5 = mysqli_num_rows($res5);

                    if($count5>0){
                        $amount = 0;
                        while($row=mysqli_fetch_assoc($res5))
                        {
                            $amount01 = $row['amount'];
                            $amount = $amount + $amount01;
                        }
                    }

                ?>

                <div class="income">
                    <span class="material-symbols-outlined">payments</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Income</h3>
                            <h1>Rs <?php echo $amount; ?></h1>
                        </div>
                    </div><br>
                </div>
            </div>
            
            <div class="recent-requests">
                <h2>Recent Requests</h2>
                <table>
                <thead>
                    <tr>
                        <th>S. ID</th>
                        <th>Username</th>
                        <th>Student Age</th>
                        <th>Requesting Class</th>
                        <th>Teacher ID</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //create sql query to display categories from database
                        $sql = "SELECT * FROM request LIMIT 5";
                        //execute the query
                        $res = mysqli_query($conn, $sql);

                        //count rows to check whether the category is available or not
                        $count = mysqli_num_rows($res);

                        if($count>0){
                        //categories available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the values
                            $req_id = $row['req_id'];
                            $st_id = $row['st_id'];
                            $cl_id02 = $row['cl_id'];
                            

                            $sql2 = "SELECT * FROM student WHERE st_id = '$st_id'";
                            //execute the query
                            $res2 = mysqli_query($conn, $sql2);

                            //count rows to check whether the category is available or not
                            $count2 = mysqli_num_rows($res2);

                            if($count2>0){

                            while($row=mysqli_fetch_assoc($res2))
                            {
                                $st_username = $row['st_username'];
                                $st_age = $row['st_age'];

                                $sql3 = "SELECT * FROM class WHERE cl_id = '$cl_id02'";
                                //execute the query
                                $res3 = mysqli_query($conn, $sql3);

                                //count rows to check whether the category is available or not
                                $count3 = mysqli_num_rows($res3);

                                if($count3>0){

                                while($row=mysqli_fetch_assoc($res3))
                                {
                                    $cl_title = $row['cl_title'];
                                    $teacher_id = $row['em_id'];
                                
                                ?>
                                <tr>
                                    <td><?php echo $st_id; ?></td>
                                    <td><?php echo $st_username; ?></td>
                                    <td><?php echo $st_age; ?></td>
                                    <td><?php echo $cl_id02;  ?> - <?php echo $cl_title; ?></td>
                                    <td><?php echo $teacher_id; ?></td>
                                    <td class="approve">
                                        <a href="req-accept-st.php?req_id=<?php echo $req_id; ?>">Accept</a>
                                    </td>
                                    <td class="error-btn">
                                        <a href="#" class="reject-link" data-req-id="<?php echo $req_id; ?>">Reject</a>
                                    </td>
                                </tr> 
                            <?php 
                                }}
                            }}
                        } ?>

                        <tr>
                            <td colspan="3">
                                <div class="edit-btn-04" >
                                    <button style="margin-right: 10px; width: 100px;" onclick="openPopup()">Show all</button>
                                </div> 
                            </td>
                            <td colspan="4">
                                <a href="req-accept-st-all.php?req_id=<?php echo $req_id; ?>">
                                    <div class="edit-btn" >
                                        <button style="margin-right: 10px; width: 120px;">Accept all</button>
                                    </div> 
                                </a>
                            </td>
                        </tr>

                    <?php
                    }
                    else{ ?>

                        <tr>
                            <td colspan="7" class="warning">No new requests found.</td>
                        </tr>
                                                
                    <?php }?>

                </tbody>
            </table>


            <h2>Students</h2>

                <div class="search">
                    <form action="" method="post">
                            <input type="search" name="search" placeholder=" Enter Student ID or Name">
                            <input type="submit" name="searchSubmit">
                    </form>
                </div>

                <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>DOB</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Mob no.</th>
                        <th>P. Name</th>
                        <th>P. Email</th>
                        <th>Paid</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        if(isset($_POST['searchSubmit'])){

                            $searches = $_POST['search'];

                            $sql3 = "SELECT * FROM student WHERE st_id LIKE '%$searches%' OR st_name LIKE '%$searches%' OR st_username LIKE '%$searches%'";

                            $res3 = mysqli_query($conn, $sql3);

                                    //count the rows
                            $count3 = mysqli_num_rows($res3);

                            //check whether food available or not
                            if($count3>0)
                            {
                                $sn = 1;
                                //food available
                                while($row=mysqli_fetch_assoc($res3))
                                {
                                    //get the details
                                    $st_id = $row['st_id'];
                                    $st_username = $row['st_username'];
                                    $g_email = $row['g_email'];
                                    $st_name = $row['st_name'];
                                    $st_dob = $row['st_dob'];
                                    $st_age = $row['st_age'];
                                    $st_address = $row['st_address'];
                                    $st_img = $row['st_img'];
                                    $st_phone = $row['st_phone'];
                                    $g_name = $row['g_name'];
                                    $status = $row['status'];
                                    $paid = "Yes";

                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $st_id; ?></td>
                                        <td><?php echo $st_username; ?></td>
                                        <td><?php echo $st_name; ?></td>
                                        <td><?php echo $st_age; ?></td>
                                        <td><?php echo $st_dob; ?></td>
                                        <td><?php echo $st_address; ?></td>
                                        <td>
                                            <?php
                                                //check whether we have image or not
                                                if($st_img=="")
                                                {
                                                    //we do not have image, display error message
                                                    echo "<div class='error'> No Image Uploaded.</div>";
                                                }
                                                else
                                                {
                                                    //have the image
                                                    ?>
                                                    <div class="cl-img">
                                                        <img src="../images/profile-pic/<?php echo $st_img; ?>" width="70" height="80">
                                                    </div>
                                                    <?php
                                                } ?>
                                        </td>
                                        <td><?php echo $st_phone; ?></td>
                                        <td><?php echo $g_name; ?></td>
                                        <td><?php echo $g_email; ?></td>
                                        <td>
                                            <?php 
                                                if($paid=="Yes"){ ?>
                                                    <div class="success">
                                                        <?php echo $paid; ?>
                                                    </div> <?php
                                                }
                                                else{ ?>
                                                    <div class="error">
                                                        <?php echo $paid; ?>
                                                    </div> <?php
                                                }
                                            ?>
                                        </td>
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
                                                <div class="item" onclick="loadContent('<?php echo $st_id; ?>')">
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
                        }else{

                            $sn = 1;
                            //create a sql query to get all the food
                            $sql = "SELECT * FROM student";

                            //execute the query
                            $res = mysqli_query($conn, $sql);

                            //count the rows to check whether we have foods or not
                            $count = mysqli_num_rows($res);

                            if($count>0){
                                //we have food in database
                                //get the foods from database and display
                                while($row=mysqli_fetch_assoc($res)){
                                    $st_id = $row['st_id'];
                                    $st_username = $row['st_username'];
                                    $g_email = $row['g_email'];
                                    $st_name = $row['st_name'];
                                    $st_dob = $row['st_dob'];
                                    $st_age = $row['st_age'];
                                    $st_address = $row['st_address'];
                                    $st_img = $row['st_img'];
                                    $st_phone = $row['st_phone'];
                                    $g_name = $row['st_name'];
                                    $status = $row['status'];
                                    $paid = "Yes";      ?>

                                    <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $st_id; ?></td>
                                    <td><?php echo $st_username; ?></td>
                                    <td><?php echo $st_name; ?></td>
                                    <td><?php echo $st_age; ?></td>
                                    <td><?php echo $st_dob; ?></td>
                                    <td><?php echo $st_address; ?></td>
                                    <td>
                                        <?php
                                            //check whether we have image or not
                                            if($st_img=="")
                                            {
                                                //we do not have image, display error message
                                                echo "<div class='error'> No Image Uploaded.</div>";
                                            }
                                            else
                                            {
                                                //have the image
                                                ?>
                                                <div class="cl-img">
                                                    <img src="../images/profile-pic/<?php echo $st_img; ?>" width="70" height="80">
                                                </div>
                                                <?php
                                            } ?>
                                    </td>
                                    <td><?php echo $st_phone; ?></td>
                                    <td><?php echo $g_name; ?></td>
                                    <td><?php echo $g_email; ?></td>
                                    <td>
                                        <?php 
                                            if($paid=="Yes"){ ?>
                                                <div class="success">
                                                    <?php echo $paid; ?>
                                                </div> <?php
                                            }
                                            else{ ?>
                                                <div class="error">
                                                    <?php echo $paid; ?>
                                                </div> <?php
                                            }
                                        ?>
                                    </td>
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
                                            <div class="item" onclick="loadContent('<?php echo $st_id; ?>')">
                                                <button class="pop_btn">Edit</button>
                                            </div>
                                        </div>                                        
                                    </td>
                                </tr>

                         <?php       }
                            }
                            else{
                                echo "<tr><td colspan='14' >Students Not Added Yet.</td></tr>";
                            }
                        } ?>
                </tbody>
            </table>
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


            <div class="pop_container">
                <div class="popup" id="popup">
                    <table class="Category">
                        <h2>REQUESTS TO JOIN CLASSES</h2>
                        <thead>
                            <tr>
                                <th>S. ID</th>
                                <th>Username</th>
                                <th>Student Age</th>
                                <th>Requesting Class</th>
                                <th>Teacher ID</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql1 = "SELECT * FROM request";
                                //execute the query
                                $res1 = mysqli_query($conn, $sql1);
        
                                //count rows to check whether the category is available or not
                                $count1 = mysqli_num_rows($res1);

                                if($count1>0){
                                //categories available
                                while($row=mysqli_fetch_assoc($res1))
                                {
                                    //get the values
                                    $req_id1 = $row['req_id'];
                                    $st_id1 = $row['st_id'];
                                    $cl_id03 = $row['cl_id'];
                                    

                                    $sql2 = "SELECT * FROM student WHERE st_id = '$st_id1'";
                                    //execute the query
                                    $res2 = mysqli_query($conn, $sql2);

                                    //count rows to check whether the category is available or not
                                    $count2 = mysqli_num_rows($res2);

                                    if($count2>0){

                                    while($row=mysqli_fetch_assoc($res2))
                                    {
                                        $st_username = $row['st_username'];
                                        $st_age = $row['st_age'];

                                        $sql3 = "SELECT * FROM class WHERE cl_id = '$cl_id03'";
                                        //execute the query
                                        $res3 = mysqli_query($conn, $sql3);

                                        //count rows to check whether the category is available or not
                                        $count3 = mysqli_num_rows($res3);

                                        if($count3>0){

                                        while($row=mysqli_fetch_assoc($res3))
                                        {
                                            $cl_title = $row['cl_title'];
                                            $teacher_id = $row['em_id'];
                                        
                                        ?>

                                        <tr>
                                            <td><?php echo $st_id; ?></td>
                                            <td><?php echo $st_username; ?></td>
                                            <td><?php echo $st_age; ?></td>
                                            <td><?php echo $cl_id03;  ?> - <?php echo $cl_title; ?></td>
                                            <td><?php echo $teacher_id; ?></td>
                                            <td class="approve">
                                                <a href="req-accept-st.php?req_id=<?php echo $req_id1; ?>">Accept</a>
                                            </td>
                                            <td class="error-btn">
                                                <a href="#" class="reject-link" data-req-id="<?php echo $req_id1; ?>">Reject</a>
                                            </td>
                                        </tr> 
                            <?php 
                                }} }}
                                
                             } }else{ ?>

                                <tr>
                                    <td colspan="6" class="warning">No requests found.</td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                    <button class="error" type="button" onclick="closePopup()" style="background-color: #C70039;">Close</button>
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
            url: 'student-process.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
                // Check if response is valid
                if (typeof response === 'object' && response !== null) {
                    // Populate the modal with the retrieved content
                    modalContent.innerHTML = `
                            <div class="popup1" id="popup1">
                                <h2>EDIT STUDENT</h2>
                                <form action="update-student.php" method="post" enctype="multipart/form-data">
                                <table>
                                        <tr>
                                            <td>ID: </td>
                                            <td>
                                                <label>${response.st_id} </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Username: </td>
                                            <td>
                                                <label>${response.st_username} </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Active: </td>
                                            <td>
                                                <select name="status" required>
                                                    <option value="${response.status}">${response.status}</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </td>
                                        <input type="hidden" name="st_id" value= ${response.st_id}>
                                    </table>
                            
                                    <div class="save">
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
                    window.location.href = "../admin/delete-student.php?id=<?php echo $st_id; ?>&image_name=<?php echo $st_img; ?>";
                }else {

                }
                });
        }

    </script>

    <?php if(isset($_SESSION['req-accept-st-ok'])){ ?>
        <script>
            swal({
                title: "Request Accepted!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['req-accept-st-ok']); } ?>

    <?php if(isset($_SESSION['req-accept-st-error'])){ ?>
        <script>
            swal({
                title: "Failed to accept the request! Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['req-accept-st-error']); } ?>

    <?php if(isset($_SESSION['req-accept-st-all-ok'])){ ?>
        <script>
            swal({
                title: "Successfully Accepted All Requests!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['req-accept-st-all-ok']); } ?>

    <?php if(isset($_SESSION['req-accept-st-all-error'])){ ?>
        <script>
            swal({
                title: "Failed to accept the requests! Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['req-accept-st-all-error']); } ?>

</body>
</html>

