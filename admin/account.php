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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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
                <a href="class.php"><span class="material-symbols-outlined"> groups </span><h3>Student Panel</h3></a>
                <a href="homework.php"><span class="material-symbols-outlined">library_books</span><h3>Homework</h3></a>
                <a href="payment.php"><span class="material-symbols-outlined"> payments </span><h3>Payments</h3></a>
                <a href="#" class="active"><span class="material-symbols-outlined"> account_balance </span><h3>Accounting Section</h3></a>
                <a href="exam.php"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="feedback.php"><span class="material-symbols-outlined"> feedback </span><h3>Feedback</h3><span class="message-count">20</span></a>
                <a href="notification.php"><span class="material-symbols-outlined">campaign</span><h3>Notification Panel</h3></a>
                <a href="admin.php"><span class="material-symbols-outlined">shield_person</span><h3>Admin</h3></a>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

        <main>
            <h1>PAYMENTS MANAGEMENT</h1>

            <div class="insights">
                <div class="due">
                    <span class="material-symbols-outlined">attach_money</span>
                    <div class="middle">
                        <div class="left">
                            <h3>To Pay</h3>
                            <h1>4</h1>
                        </div>
                    </div>
                    <small class="text-muted">Last 26 Days</small>
                </div>
                

                <div class="income">
                    <span class="material-symbols-outlined">price_check</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Paid Employees</h3>
                            <h1>48</h1>
                        </div>
                    </div>
                    <small class="text-muted">Last 26 Days</small>
                </div>
                <div class="t-income">
                    <span class="material-symbols-outlined">payments</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Payments</h3>
                            <h1>Rs 118200</h1>
                        </div>
                    </div>
                    <small class="text-muted">Last 26 Days</small>
                </div>
            </div>
            
            <div class="recent-requests">
                <h2>Payments to Make</h2>
                <table>
                <thead>
                    <tr>
                        <th>Emp ID</th>
                        <th>Emp Name</th>
                        <th>Total Payable</th>
                        <th>Class(es)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>S002</td>
                        <td>Lahiru Sampath</td>
                        <td>1800</td>
                        <td>C004 - English - English Medium</td>
                        <td>
                            <div class="edit-btn-02" onclick="loadContent('<?php echo $cl_id; ?>')">
                                <button class="pop_btn">Edit</button>
                            </div>  
                        </td>
                    </tr>
                    <tr>
                        <td>S002</td>
                        <td>Lahiru Sampath</td>
                        <td>1500</td>
                        <td>C004 - English - English Medium</td>
                        <td>
                            <div class="edit-btn-02" onclick="loadContent('<?php echo $cl_id; ?>')">
                                <button class="pop_btn">Edit</button>
                            </div>  
                        </td>
                    </tr>
                    <tr>
                        <td>S002</td>
                        <td>Lahiru Sampath</td>
                        <td>1650</td>
                        <td>C004 - English - English Medium</td>
                        <td>
                            <div class="edit-btn-02" onclick="loadContent('<?php echo $cl_id; ?>')">
                                <button class="pop_btn">Edit</button>
                            </div>  
                        </td>
                    </tr>
                    <tr>
                        <td>S002</td>
                        <td>Lahiru Sampath</td>
                        <td>1750</td>
                        <td>C004 - English - English Medium</td>
                        <td>
                            <div class="edit-btn-02" onclick="loadContent('<?php echo $cl_id; ?>')">
                                <button class="pop_btn">Edit</button>
                            </div>  
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="edit-btn-04" >
                                <button style="margin-right: 10px; width: 100px;" onclick="openPopup()">Show all</button>
                            </div> 
                        </td>
                        <td colspan="2">
                            <div class="edit-btn" >
                                <button style="margin-right: 10px; width: 120px; background-color:red;">Ban all</button>
                            </div> 
                        </td>
                        
                    </tr>
                </tbody>
                </table>

                <div class="floating">
                    <div class="form-container">
                        <form action="#">
                            
                        </form>
                    </div>
                </div>

                <h2>Paid Employees</h2>
                    <table class="Category">
                    <thead>
                        <tr>
                            <th>Emp ID</th>
                            <th>Emp Name</th>
                            <th>Paid Amnt</th>
                            <th>Date and Time</th>
                            <th>Classes</th>
                            <th>Type</th>
                            <th>Mob no.</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>S002</td>
                            <td>Lahiru Sampath</td>
                            <td>40000</td>
                            <td>25/06/2023 - 6:23</td>
                            <td>C004 - English - English Medium, C005 - Geography - English Medium</td>
                            <td>Bank Deposit</td>
                            <td>0717612976</td>
                            <td>Active</td>
                            <td>
                                <div class="edit-btn-02" onclick="loadContent('<?php echo $cl_id; ?>')">
                                    <button class="pop_btn">Edit</button>
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td>S002</td>
                            <td>Lahiru Sampath</td>
                            <td>40000</td>
                            <td>25/06/2023 - 6:23</td>
                            <td>C004 - English - English Medium, C005 - Geography - English Medium</td>
                            <td>Bank Deposit</td>
                            <td>0717612976</td>
                            <td>Active</td>
                            <td>
                                <div class="edit-btn-02" onclick="loadContent('<?php echo $cl_id; ?>')">
                                    <button class="pop_btn">Edit</button>
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td>S002</td>
                            <td>Lahiru Sampath</td>
                            <td>40000</td>
                            <td>25/06/2023 - 6:23</td>
                            <td>C004 - English - English Medium, C005 - Geography - English Medium</td>
                            <td>Bank Deposit</td>
                            <td>0717612976</td>
                            <td>Active</td>
                            <td>
                                <div class="edit-btn-02" onclick="loadContent('<?php echo $cl_id; ?>')">
                                    <button class="pop_btn">Edit</button>
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td>S002</td>
                            <td>Lahiru Sampath</td>
                            <td>40000</td>
                            <td>25/06/2023 - 6:23</td>
                            <td>C004 - English - English Medium, C005 - Geography - English Medium</td>
                            <td>Bank Deposit</td>
                            <td>0717612976</td>
                            <td>Active</td>
                            <td>
                                <div class="edit-btn-02" onclick="loadContent('<?php echo $cl_id; ?>')">
                                    <button class="pop_btn">Edit</button>
                                </div>  
                            </td>
                        </tr>                   
                        <tr>
                            <td colspan="4">
                                <div class="edit-btn-04" >
                                    <button style="margin-right: 10px; width: 100px;" onclick="openPopup()">Show all</button>
                                </div> 
                            </td>
                            <td colspan="4">
                                <div class="edit-btn" >
                                    <button style="margin-right: 10px; width: 120px; background-color:red;">Ban all</button>
                                </div> 
                            </td>
                        </tr>
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
</body>
</html>