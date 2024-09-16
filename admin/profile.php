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
                $em_id = $row['em_id'];
                $em_username = $row['em_username'];
                $em_img = $row['em_img'];
                $em_name = $row['em_name'];
                $em_dob = $row['em_dob'];
                $em_address = $row['em_address'];
                $em_qualification = $row['em_qualification'];
                $em_password = $row['em_password'];
                $em_email = $row['em_email'];
                $em_phone = $row['em_phone'];
                $em_position = $row['em_position'];
                $em_joined = $row['joined'];
                $em_status = $row['status'];
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
    <title><?php echo $em_username; ?></title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./sweetalert.min.js"></script>
    <style>
        .cont {
            display: flex;
        }

        .left,
        .right {
            flex: 1;
            margin-right: 20px;
        }

        .profile-edit {
            max-width: 98%;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
            margin: 50px auto;
        }

        .profile-edit h1 {
            margin: 0 0 20px;
            font-size: 24px;
        }

        .profile-edit label {
            display: block;
            margin-bottom: 8px;
        }

        .profile-edit input[type="text"],
        .profile-edit input[type="datetime-local"],
        .profile-edit input[type="tel"],
        .profile-edit textarea,
        .profile-edit input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .profile-edit textarea {
            resize: vertical;
        }

        .profile-picture {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-picture-container {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 10px;
        }

        .profile-picture-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .profile-edit .btn-img {
            display: inline-block;
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
            font-size: 14px;
            margin: 0 auto;
            width: fit-content;
        }

        .profile-edit .btn-img:hover {
            background-color: #0056b3;
        }

    </style>
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
                <a href="admin.php"><span class="material-symbols-outlined">shield_person</span><h3>Admin</h3></a>
                <a href="logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

        <main>
            <br>
            <div class="recent-requests">
                <div class="hw">
                    <h1 style="text-align: center; font-size: 35px;"><strong><?php echo $em_username; ?></strong></h1>
                    <h3 style="text-align: center; font-size: 22px; color: #92938E;"><?php echo $em_id; ?></h3>

                    <div class="profile-edit">
                        <form action="update-profile.php" method="post" enctype="multipart/form-data">
                            <div class="profile-picture">
                                <div class="profile-picture-container">
                                    <img id="profile-image" src="../images/employee/<?php echo $em_img; ?>" alt="Profile Picture">
                                </div><br>
                                <input type="file" id="profile-picture-input" name="pic" accept="image/*" style="display: none;">
                                <label for="profile-picture-input" class="btn-img">Select New Profile Picture</label>
                            </div>

                            <div class="cont" style="font-size: 14px;">
                                <div class="left">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name" value="<?php echo $em_name; ?>" required>

                                    <label for="name">Date of Birth:</label>
                                    <input type="date" name="date" value="<?php echo $em_dob; ?>" required>

                                    <label for="name">Email:</label>
                                    <input type="text" name="email" value="<?php echo $em_email; ?>" required>
                                </div>
                                <div class="right">
                                    <label for="bio">Address:</label>
                                    <textarea name="address" rows="4" required><?php echo $em_address; ?></textarea>

                                    <label for="name">Mobile:</label>
                                    <input type="tel" name="mobile" value="<?php echo $em_phone; ?>" required>
                                </div>
                            </div>

                            <input type="hidden" name="em_id" value="<?php echo $em_id; ?>">
                            <button type="submit" name="update" class="btn">Save Changes</button>
                        </form>
                    </div>
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
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script src="./index.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var profilePictureInput = document.getElementById('profile-picture-input');
            var profileImage = document.getElementById('profile-image');

            profilePictureInput.addEventListener('change', function(event) {
                var selectedFile = event.target.files[0];
                if (selectedFile) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        profileImage.src = event.target.result;
                    };
                    reader.readAsDataURL(selectedFile);
                }
            });
        });
    </script>

    <?php
        if(isset($_SESSION['ex-update-ok'])){ ?>
        <script>
            swal({
                title: "Status Updated Successfully",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ex-update-ok']); } ?>

    <?php
        if(isset($_SESSION['ex-update-error'])){ ?>
        <script>
            swal({
                title: "Failed to update data!",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['ex-update-error']); } ?>

</body>
</html>