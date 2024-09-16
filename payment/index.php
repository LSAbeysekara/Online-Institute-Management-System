<?php include('../config/constant.php'); ?>
<?php include('../student/login-check.php'); ?>

<?php
    $st_id = "0";
    if(isset($_SESSION['st_id'])){
        $st_id = $_SESSION['st_id'];
    }

    if($st_id == "0"){
        header('location: ../login.php');

    }else{
        $sql1 = "SELECT * FROM student WHERE st_id='$st_id'";

        $res1 = mysqli_query($conn, $sql1);

        $count1 = mysqli_num_rows($res1);

        if($count1>0){
            while($row=mysqli_fetch_assoc($res1)){
                $st_id = $row['st_id'];
                $st_username = $row['st_username'];
                $st_img = $row['st_img'];

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
    <title>Payment</title>
    <link rel="stylesheet" href="../st-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="../admin/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        .profile-st{
            position: absolute;
            top: 15px;
            right: 15px;
            cursor: pointer;
            padding: var(--card-padding-2);
            border-radius: 10px;
            color: #DC7633;
            z-index: 5;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 15px 25px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-size: 20px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    
</head>
<body> 
    <header>
        <a href="../index.php">
            <div class="logo" style="margin: 10px 0 10px 0;">
                <img src="../images/logos/logo.png">
                <h2 class="st-logo">ONLINE<span class="danger">INSTITUTE</span></h2>
            </div>
        </a>
        <div class="close" id="close-btn">
            <span class="material-symbols-outlined"> close </span>
        </div>
    </header>
    <div class="container-03">
        <main>

            <div class="profile-st" style="z-index: 10;">
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
                            <p>Hey, <b><?php echo $st_username; ?></b></p>
                            <small class="text-muted">Student</small>
                        </div>
                        <div class="profile-photo">
                            <img src="../images/profile-pic/<?php echo $st_img; ?>" alt="profile picture">
                        </div>
                    </div>
                </div>
            </div>

            <div class="hw" style="height: 94vh;">
                <h1>PAYMENT</h1>

                <?php
                    $currentMonthNumber = date('n');

                    $monthNames = [
                        1 => 'JANUARY',
                        2 => 'FEBRUARY',
                        3 => 'MARCH',
                        4 => 'APRIL',
                        5 => 'MAY',
                        6 => 'JUNE',
                        7 => 'JULY',
                        8 => 'AUGUST',
                        9 => 'SEPTEMBER',
                        10 => 'OCTOBER',
                        11 => 'NOVEMBER',
                        12 => 'DECEMBER',
                    ];

                    $currentMonthWord = $monthNames[$currentMonthNumber];
                ?>

                <h2 style="text-align: center; color: red; font-size: 24px;"><?php echo $currentMonthWord; ?></h2>

                <div class="insights-02">
                    <?php
                        $currentYearMonth = date('Y-m');
                        $sql = "SELECT * FROM student_enroll WHERE st_id = '$st_id' AND (paid_month != '$currentYearMonth' OR paid_month IS NULL)";
                        
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        if($count>0){
                            
                            while($row=mysqli_fetch_assoc($res)){
                                
                                $st_enr_id = $row['st_enr_id'];
                                $cl_id = $row['cl_id'];


                                $sql2 = "SELECT * FROM class WHERE cl_id ='$cl_id'";
                                $res2 = mysqli_query($conn, $sql2);
                                $count2 = mysqli_num_rows($res2);

                                if($count2>0){
                                    
                                    while($row=mysqli_fetch_assoc($res2)){
                                        $cl_id = $row['cl_id'];
                                        $cl_title = $row['cl_title'];
                                        $cl_description = $row['cl_description'];
                                        $cl_grade = $row['cl_grade'];
                                        $cl_fee = $row['cl_fee'];
                                        $cl_img = $row['cl_img'];
                                        $em_id = $row['em_id'];
                                        $cl_duration = $row['cl_duration'];
                                        $cl_time = $row['cl_time'];
                                        $cl_day = $row['cl_day'];
                                        $cl_lan = $row['cl_lan'];

                                        
                                        $sql3 = "SELECT * FROM employee WHERE em_id ='$em_id'";

                                        $res3 = mysqli_query($conn, $sql3);

                                        $count3 = mysqli_num_rows($res3);

                                        if($count3>0){
                                            
                                            while($row=mysqli_fetch_assoc($res3)){
                                                $em_username = $row['em_username'];

                                            }
                                        } ?>

                                        
                                        <div class="cls-gap">
                                            <h2 style="font-size: 22px;"><?php echo $cl_title; ?></h2><br>
                                            <h2 style="color: #5d6cf1;"><?php echo $em_username; ?></h2><br>
                                            <table>
                                                <tr>
                                                    <td><h2>Payable: </h2></td>
                                                    <td style="color: red;"><h2><?php echo $cl_fee; ?></h2></td>
                                                </tr>
                                            </table>
                                            
                                            <div style="text-align: center; box-shadow: none;">
                                                <form action="payment-option.php" method="post">
                                                    <input type="hidden" name="st_enr_id" value="<?php echo $st_enr_id; ?>">
                                                    <input type="submit" value="Pay Now" name="submit">
                                                </form>
                                            </div>
                                            
                                        </div>
                                        
                            <?php }}else{} 
                            }
                        } ?>
                        
                    </div>
                </div>
            </div>
        <main>
    </div>

<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>


    <script>
        const themeToggler = document.querySelector(".theme-toggler");
        const darkThemeClass = 'dark-theme-variables';
        const activeThemeKey = 'activeTheme';
        const setThemePreference = (isDarkTheme) => {
            localStorage.setItem(activeThemeKey, isDarkTheme ? 'dark' : 'light');
        }
        const applyThemePreference = () => {
            const activeTheme = localStorage.getItem(activeThemeKey);
            if (activeTheme === 'dark') {
                document.body.classList.add(darkThemeClass);
                themeToggler.querySelector('span:nth-child(1)').classList.remove('active');
                themeToggler.querySelector('span:nth-child(2)').classList.add('active');
            } else {
                document.body.classList.remove(darkThemeClass);
                themeToggler.querySelector('span:nth-child(1)').classList.add('active');
                themeToggler.querySelector('span:nth-child(2)').classList.remove('active');
            }
        }
        themeToggler.addEventListener('click', () => {
            document.body.classList.toggle(darkThemeClass);
            themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
            themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
            const isDarkTheme = document.body.classList.contains(darkThemeClass);
            setThemePreference(isDarkTheme);
        });
        document.addEventListener('DOMContentLoaded', () => {
            applyThemePreference();
        });
    </script>

    <?php if(isset($_SESSION['payment-add-ok'])){ ?>
        <script>
            swal({
                title: "Your Online Payment was successfull.",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['payment-add-ok']); } ?>

    <?php if(isset($_SESSION['add-bank-slip-ok'])){ ?>
        <script>
            swal({
                title: "Bank Slip Added Successfully!",
                icon: "success",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['add-bank-slip-ok']); } ?>

    <?php if(isset($_SESSION['add-bank-slip-error'])){ ?>
        <script>
            swal({
                title: "Failed to add bank slip. Try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['add-bank-slip-error']); } ?>
</body>
</html>
