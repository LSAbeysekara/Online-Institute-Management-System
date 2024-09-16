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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
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
                <a href="#" class="active"><span class="material-symbols-outlined"> group </span><h3>Teacher Panel</h3></a>
                <a href="student.php"><span class="material-symbols-outlined"> groups </span><h3>Student Panel</h3></a>
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
            <h1>TEACHER MANAGEMENT</h1>

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
                    </div>
                </div>

                <div class="expenses">
                    <span class="material-symbols-outlined">payments</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Paid</h3>
                            <h1>Rs 5600</h1>
                        </div>
                    </div><br>
                </div>
            </div>

            <div class="add" style="margin-top: 10px;">
                <button onclick="openPopup()">New Teacher</button>
            </div>



            <div class="recent-requests">

                <h2>TEACHERS</h2>

                <div class="search">
                    <form action="" method="post">
                            <input type="search" name="search" placeholder=" Enter Teacher ID or Username" required>
                            <input type="submit" name="searchSubmit">
                    </form>
                </div>

                <table class="Category">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Teacher ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Mob. No</th>
                            <th>Time Table</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody>

                        <?php
                            $sn = 1;
                            if(isset($_POST['searchSubmit'])){

                                $searches = $_POST['search'];

                                $sql3 = "SELECT * FROM employee WHERE (em_id LIKE '%$searches%' OR em_username LIKE '%$searches%') AND em_position='Teacher'";


                                $res3 = mysqli_query($conn, $sql3);

                                        //count the rows
                                $count3 = mysqli_num_rows($res3);

                                //check whether food available or not
                                if($count3>0)
                                {
                                    //food available
                                    while($row=mysqli_fetch_assoc($res3))
                                    {
                                        //get the details
                                        $em_id = $row['em_id'];
                                        $em_username = $row['em_username'];
                                        $em_name = $row['em_name'];
                                        $em_dob = $row['em_dob'];
                                        $em_address = $row['em_address'];
                                        $em_img = $row['em_img'];
                                        $em_email = $row['em_email'];
                                        $em_phone = $row['em_phone'];
                                        $status = $row['status'];
                                        $em_tt = $row['em_tt'];
 
                                        
                                        $pay_total = 0;
                                        $sql6 = "SELECT * FROM teacher_enroll WHERE em_id = '$em_id'";

                                        $res6 = mysqli_query($conn, $sql6);
                                 
                                        $count6 = mysqli_num_rows($res6);

                                        if($count6>0)
                                        {
                                            while($row=mysqli_fetch_assoc($res6))
                                            {
                                                $cl_id = $row['cl_id'];

                                                $sql6 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

                                                $res6 = mysqli_query($conn, $sql6);
                                        
                                                $count6 = mysqli_num_rows($res6);

                                                if($count6>0)
                                                {
                                                    while($row=mysqli_fetch_assoc($res6))
                                                    {
                                                        $cl_fee = $row['cl_id'];
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $em_id; ?></td>
                                            <td><?php echo $em_username; ?></td>
                                            <td><?php echo $em_name; ?></td>
                                            <td><?php echo $em_phone; ?></td>
                                            <td><?php echo $em_tt; ?></td>
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
                                        <td colspan="8">
                                            <div class="error">
                                                No record found for your search.
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }else{ ?>

<!------------------------------------------------- Search Ends Here ------------------------------------------------------- -->

                            <?php
                                $sn = 1;
                                
                                $sql = "SELECT * FROM employee WHERE em_position = 'Teacher' LIMIT 5";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count>0){
                                    
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        
                                        $em_id = $row['em_id'];
                                        $em_username = $row['em_username'];
                                        $em_name = $row['em_name'];
                                        $em_dob = $row['em_dob'];
                                        $em_address = $row['em_address'];
                                        $em_img = $row['em_img'];
                                        $em_email = $row['em_email'];
                                        $em_phone = $row['em_phone'];
                                        $status = $row['status'];
                                        $em_tt = $row['em_tt'];

                                        ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $em_id; ?></td>
                                            <td><?php echo $em_username; ?></td>
                                            <td><?php echo $em_name; ?></td>
                                            <td><?php echo $em_phone; ?></td>
                                            <td>
                                                <?php
                                                
                                                if($em_tt=="")
                                                {
                                                    echo "<div class='error'> No Image Uploaded.</div>";
                                                }
                                                else
                                                {
                                                    ?>
                                                    <div class="cl-img">
                                                        <img src="../images/Time-table/<?php echo $em_tt; ?>" width="100" height="100">
                                                    </div>
                                                    <?php
                                                } ?>
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
                                                    <div class="item" onclick="loadContent('<?php echo $em_id; ?>')">
                                                        <button class="pop_btn">Edit</button>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "<tr><td colspan='8' Class='error'>No Teachers Found</td></tr>";
                                }
                            }
                            ?>
                        <tr>
                            <td colspan="8"><a href="#" class="floating-btn" onclick="openPopup2()">Show All</a></td>
                        </tr>
                    </tbody>
                </table>

<!------------------------------------------------- Floating Platforms 1 ------------------------------------------------------------ -->

            <div class="pop_container">
                <div class="popup" id="popup">
                    <form action="add-teacher.php" method="post" enctype="multipart/form-data">
                        <h2>NEW TEACHER</h2>
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
                                    <textarea name="address" placeholder="Enter Address" cols="30" rows="6" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Select Image: </td>
                                <td>
                                    <input type="file" name="image">
                                </td>
                            </tr>
                            <tr>
                                <td>Time table (Image): </td>
                                <td>
                                    <input type="file" name="time-table">
                                </td>
                            </tr>
                            <tr>
                                <td>Education Qualifications: </td>
                                <td>
                                    <textarea name="qualification" placeholder="Enter Qualification" cols="30" rows="4" required></textarea>
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
            </div>

<!------------------------------------------------- Floating Platforms 1 Ends here------------------------------------------------------- -->

<!------------------------------------------------ Floating Platforms 2 starts here------------------------------------------------------- -->
            <div class="pop_container">
                <div class="popup2" id="popup2">
                    <table class="Category">
                        <h2>TEACHERS</h2>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Teacher ID</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Mob. No</th>
                                <th>Time Table</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sn = 1;

                                $sql8 = "SELECT * FROM employee WHERE em_position = 'Teacher'";

                                $res8 = mysqli_query($conn, $sql8);

                                $count8 = mysqli_num_rows($res8);

                                if($count8>0){
                                    
                                    while($row=mysqli_fetch_assoc($res8))
                                    {
                                        $em_id = $row['em_id'];
                                        $em_username = $row['em_username'];
                                        $em_name = $row['em_name'];
                                        $em_dob = $row['em_dob'];
                                        $em_address = $row['em_address'];
                                        $em_img = $row['em_img'];
                                        $em_email = $row['em_email'];
                                        $em_phone = $row['em_phone'];
                                        $status = $row['status'];
                                        $em_tt = $row['em_tt'];

                                        ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $em_id; ?></td>
                                            <td><?php echo $em_username; ?></td>
                                            <td><?php echo $em_name; ?></td>
                                            <td><?php echo $em_phone; ?></td>
                                            <td style="height: 15vh;">
                                                <?php
                                                
                                                if($em_tt=="")
                                                {
                                                    
                                                    echo "<div class='error'> No Image Uploaded.</div>";
                                                }
                                                else
                                                {
                                                    
                                                    ?>
                                                    <div>
                                                        <img src="../images/Time-table/<?php echo $em_tt; ?>" style="border-radius: 0px; margin-bottom: 0px;">
                                                    </div>
                                                    <?php
                                                } ?>
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
                                                    <div class="item" onclick="loadContent('<?php echo $em_id; ?>')">
                                                        <button class="pop_btn" style="margin-bottom: 6vh;">Edit</button>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php
                                    }
                                }
                                else
                                {
                                    
                                    echo "<tr><td colspan='8' Class='error'>No Teachers Found</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <button class="error" type="button" onclick="closePopup2()" style="background-color: #C70039;">Close</button>
                </div>
            </div>
<!------------------------------------------------ Floating Platform 2 Ends here------------------------------------------------------- -->

                <h2>BIO</h2>

                <div class="search">
                    <form action="" method="post">
                            <input type="search" name="search" placeholder=" Enter Teacher ID or Username" required>
                            <input type="submit" name="searchSubmit01">
                    </form>
                </div>

                <table class="Category">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Teacher ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Education</th>
                            <th>DOB</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Mob. No</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody>

                    <?php

                    $sn01 = 1;

                    if(isset($_POST['searchSubmit01'])){

                        $searches = $_POST['search'];

                        $sql7 = "SELECT * FROM employee WHERE (em_id LIKE '%$searches%' OR em_username LIKE '%$searches%') AND em_position='Teacher'";


                        $res7 = mysqli_query($conn, $sql7);

                        //count the rows to check whether we have foods or not
                        $count7 = mysqli_num_rows($res7);

                        if($count7>0){
                            //we have food in database
                            //get the foods from database and display
                            while($row=mysqli_fetch_assoc($res7))
                            {
                                //get the details
                                $em_id = $row['em_id'];
                                $em_username = $row['em_username'];
                                $em_name = $row['em_name'];
                                $em_dob = $row['em_dob'];
                                $em_address = $row['em_address'];
                                $em_img = $row['em_img'];
                                $em_email = $row['em_email'];
                                $em_phone = $row['em_phone'];
                                $status = $row['status'];
                                $em_q = $row['em_qualification'];

                                ?>
                                <tr>
                                    <td><?php echo $sn01++; ?></td>
                                    <td><?php echo $em_id; ?></td>
                                    <td><?php echo $em_username; ?></td>
                                    <td><?php echo $em_name; ?></td>
                                    <td>
                                        <?php
                                            //check whether we have image or not
                                            if($em_img=="")
                                            {
                                                //we do not have image, display error message
                                                echo "<div class='error'> No Image Uploaded.</div>";
                                            }
                                            else
                                            {
                                                //have the image
                                                ?>
                                                <div class="cl-img">
                                                    <img src="../images/employee/<?php echo $em_img; ?>" width="100" height="100">
                                                </div>
                                                <?php
                                            } ?>
                                    </td>
                                    <td><?php echo $em_q; ?></td>
                                    <td><?php echo $em_dob; ?></td>
                                    <td><?php echo $em_address; ?></td>
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
                                <?php
                            }
                        }
                        else { ?>
                            <tr>
                                <td colspan="11">
                                    <div class="error">
                                        No record found for your search.
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    }else{

                        $sql3 = "SELECT * FROM employee WHERE em_position = 'Teacher'";

                        //execute the query
                        $res3 = mysqli_query($conn, $sql3);

                        //count the rows to check whether we have foods or not
                        $count3 = mysqli_num_rows($res3);

                        if($count3>0){
                            //we have food in database
                            //get the foods from database and display
                            while($row=mysqli_fetch_assoc($res3))
                            {
                                //get the details
                                $em_id = $row['em_id'];
                                $em_username = $row['em_username'];
                                $em_name = $row['em_name'];
                                $em_dob = $row['em_dob'];
                                $em_address = $row['em_address'];
                                $em_img = $row['em_img'];
                                $em_email = $row['em_email'];
                                $em_phone = $row['em_phone'];
                                $status = $row['status'];
								                $em_q = $row['em_qualification'];

                                ?>
                                <tr>
                                    <td><?php echo $sn01++; ?></td>
                                    <td><?php echo $em_id; ?></td>
                                    <td><?php echo $em_username; ?></td>
                                    <td><?php echo $em_name; ?></td>
                                    <td>
                                        <?php
                                            //check whether we have image or not
                                            if($em_img=="")
                                            {
                                                //we do not have image, display error message
                                                echo "<div class='error'> No Image Uploaded.</div>";
                                            }
                                            else
                                            {
                                                //have the image
                                                ?>
                                                <div class="cl-img">
                                                    <img src="../images/employee/<?php echo $em_img; ?>" width="100" height="100">
                                                </div>
                                                <?php
                                            } ?>
                                    </td>
				                    <td><?php echo $em_q; ?></td>
                                    <td><?php echo $em_dob; ?></td>
                                    <td><?php echo $em_address; ?></td>
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
                                <?php
                            }
                        }
                        else
                        {
                            //class not added to database
                            echo "<tr><td colspan='8' Class='error'>No Teachers Found</td></tr>";
                        }
                    }
                    ?>

                    <tr>
                    <td colspan="11"><a href="#" class="floating-btn">Show All</a></td>
                    </tr>
                    </tbody>
                </table>

<!---------------------------------------------------------- Modal ---------------------------------------------------------->
            <div id="myModal" class="modal">
                    <!-- Modal content -->
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div id="modalContent">
                        <!-- Class details will be displayed here -->
                    </div>
                </div>
            </div>

<!---------------------------------------------------------- End of Modal ----------------------------------------------------->
  

            </div>
        </main>
            <!---------------------END OF MAIN---------------------->

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-symbols-outlined">menu</span>
                </button>
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
                <!---------------------END OF TOP---------------------->
            <div class="recent-updates">
                <h2>New Teachers</h2>

                <div class="updates">
                    <div class="update">

                        <?php
                            $sql4 = "SELECT * FROM employee WHERE em_position = 'Teacher' ORDER BY id DESC LIMIT 4";
                            $res4 = mysqli_query($conn, $sql4);
                
                            $count4 = mysqli_num_rows($res4);
                    
                            if($count4>0){                
                                while($row=mysqli_fetch_assoc($res4)){
                                    
                                    $em_id_s = $row['em_id'];
                                    $joined_s = $row['joined'];
                                    $em_username_s = $row['em_username'];
                                    $em_img_s = $row['em_img'];

                                    
                                    date_default_timezone_set('Asia/Colombo');
                                    $currentDateTime = new DateTime();
                                    $joined = new DateTime($joined_s);
                                    
                                    $timeDifference = $currentDateTime->diff($joined);
                                    $totalSeconds = $timeDifference->s + $timeDifference->i * 60 + $timeDifference->h * 3600 + $timeDifference->d * 86400;

                                    ?>

                                    <div class="profile-photo">
                                        
                                        <img src="../images/employee/<?php echo $em_img_s;?>">
                                    </div>
                                    <div class="message">
                                        <p><b><?php echo $em_username_s; ?></b></p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Joined:
                                                <small class="text-muted">
                                                    <?php
                                                    if ($timeDifference->d > 0) {
                                                        echo $timeDifference->d. ' days';
                                                    } elseif ($timeDifference->h > 0) {
                                                        echo $timeDifference->h. ' hours';
                                                    } elseif ($timeDifference->i > 0) {
                                                        echo $timeDifference->i. ' minutes';
                                                    } else {
                                                        echo $totalSeconds. ' seconds';
                                                    }
                                                    echo " ago.";
                                                    ?>
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                    
                                    <?php
                                        }
                                    }
                            ?>
                    </div>
                </div>

            </div>
                <!---------------------END OF RECENT UPDATES---------------------->
                <div class="new-users">
                <h2>New CV</h2>
                <div class="users">
                <?php
                    // Define the path to the folder you want to monitor
                    $folderPath = './teacherCV/';

                    // Get the list of files in the folder
                    $files = scandir($folderPath);

                    // Sort files by modification time
                    usort($files, function($a, $b) use ($folderPath) {
                        $aTime = filemtime($folderPath . '/' . $a);
                        $bTime = filemtime($folderPath . '/' . $b);
                        return $bTime - $aTime;
                    });

                    // Get the last updated 5 files
                    $lastUpdatedFiles = array_slice($files, 0, 5);

                    // Output download links for the last updated files
                    foreach ($lastUpdatedFiles as $file) {
                        if ($file != '.' && $file != '..') {
                            $filePath = $folderPath . '/' . $file;
                            $uploadTime = date("F j, Y, g:i a", filemtime($filePath)); // Format the upload time
                    ?>
                            <div class="user">
                                <div class="profile-photo">
                                    <img src="../images/cv.png">
                                </div>
                                <div class="message">
                                    <p><b><a href='<?php echo $filePath; ?>' download><?php echo $file; ?></a></b> - Teacher </p>
                                    <p>
                                        <small class="text-muted">
                                            Uploaded on <?php echo $uploadTime; ?>
                                        </small>
                                    </p>
                                </div>
                            </div>
                    <?php
                        }
                    }
                ?>

                </div>
            </div>

        </div>
    </div>

    <script src="./index.js"></script>

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



        let popup2 = document.getElementById("popup2");

        function openPopup2(){
            popup2.classList.add("open-popup2");
        }

        function closePopup2(){
            popup2.classList.remove("open-popup2");
        }

    </script>

    <script>
        // Get the modal element
        var modal = document.getElementById("myModal");

        // Function to open the modal
        function openModal() {
            modal.style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Function to load content into the modal
        function loadContent(item) {
        var modalContent = document.getElementById("modalContent");

        $.ajax({
            url: 'teacher-process.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
                // Check if response is valid
                if (typeof response === 'object' && response !== null) {
                    // Populate the modal with the retrieved content
                    modalContent.innerHTML = `
                        <div class="popup1">
                            <h2>EDIT TEACHER</h2>
                            <form action="update-teacher.php" method="post" enctype="multipart/form-data">
                                <table>
                                    <tr>
                                        <td>Name: </td>
                                        <td>
                                            <input type="text" name="name" placeholder="Enter Full name" value="${response.em_name}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>DOB: </td>
                                        <td>
                                            <input type="date" name="date" value="${response.em_dob}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address: </td>
                                        <td>
                                            <textarea name="address" placeholder="Enter Address" cols="30" rows="6" required>${response.em_address}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Select Image: </td>
                                        <td>
                                            <input type="file" name="image01">
                                            <input type="hidden" name="image" value="${response.em_img}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Time table (Image): </td>
                                        <td>
                                            <input type="file" name="time-table01">
                                            <input type="hidden" name="time-table" value="${response.em_tt}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Education Qualifications: </td>
                                        <td>
                                            <textarea name="qualification" placeholder="Enter Qualification" cols="30" rows="4" required>${response.em_qualification}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email: </td>
                                        <td>
                                            <input type="email" name="email" value="${response.em_email}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mobile: </td >
                                        <td>
                                            <input type="tel" name="mobile" value="${response.em_phone}" required>
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
                                </table>

                                <input type="hidden" name="em_id" value="${response.em_id}">
                                <div class="save">
                                    <div class="delete">
                                        <button type="button" class="error reject-link" data-req-id="${response.em_id}" onclick="deleteForm()">Delete Teacher</button>
                                    </div>
                                    <button type="submit" name="update">Save</button>
                                </div>
                            </form>                            
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
            // Get the em_id from the button's data-req-id attribute
            var emId = document.querySelector('.reject-link').getAttribute('data-req-id');

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Pass the em_id to delete-teacher.php via the URL
                    window.location.href = "./delete-teacher.php?id=" + emId;
                } else {
                    // Do nothing or handle cancellation
                }
            });
        }
    </script>

    <?php
        if(isset($_SESSION['teacher-add-user-error'])){ ?>
        <script>
            swal({
                title: "Username Already Taken!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['teacher-add-user-error']); } ?>

    <?php
        if(isset($_SESSION['teacher-add-ok'])){ ?>
        <script>
            swal({
                title: "Data Added!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['teacher-add-ok']); } ?>

    <?php
        if(isset($_SESSION['teacher-update-ok'])){ ?>
        <script>
            swal({
                title: "Data Updated Successfully!"
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['teacher-update-ok']); } ?>

    <?php
        if(isset($_SESSION['teacher-update-error'])){ ?>
        <script>
            swal({
                title: "Passwords Dont' match!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['teacher-update-error']); } ?>

    <?php
        if(isset($_SESSION['teacher-update-error-02'])){ ?>
        <script>
            swal({
                title: "Incorrect details",
                icon: "warning",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['teacher-update-error-02']); } ?>

    <?php
        if(isset($_SESSION['teacher-delete-ok'])){ ?>
        <script>
            swal({
                title: "Data Deleted!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['teacher-delete-ok']); } ?>

    <?php
        if(isset($_SESSION['teacher-delete-error'])){ ?>
        <script>
            swal({
                title: "Failed to delete Data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['teacher-delete-error']); } ?>

    <?php
        if(isset($_SESSION['t-update-all-ok'])){ ?>
        <script>
            swal({
                title: "Data Updated Successfully!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['t-update-all-ok']); } ?>

    <?php
        if(isset($_SESSION['t-update-all-error'])){ ?>
        <script>
            swal({
                title: "Failed to Update Data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['t-update-all-error']); } ?>

    <?php
        if(isset($_SESSION['t-update-error'])){ ?>
        <script>
            swal({
                title: "Form Submission Error! Try again",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['t-update-error']); } ?>

    <?php
        if(isset($_SESSION['update_image-error'])){ ?>
        <script>
            swal({
                title: "Failed to Save Data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['update_image-error']); } ?>

    <?php
        if(isset($_SESSION['delete-teacher-ok'])){ ?>
        <script>
            swal({
                title: "Data Deleted Successfully!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['delete-teacher-ok']); } ?>

    <?php
        if(isset($_SESSION['delete-teacher-error'])){ ?>
        <script>
            swal({
                title: "Failed to delete teacher!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['delete-teacher-error']); } ?>

</body>
</html>
