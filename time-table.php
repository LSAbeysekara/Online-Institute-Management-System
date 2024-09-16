<?php include('config/constant.php') ?>

<?php
    $VA = 0;
    $em_tt = "";

    if (isset($_GET['em_id'])) {
        $em_id = $_GET['em_id'];

    } else {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Table</title>
    <link rel="stylesheet" href="st-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="./admin/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        

        header ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        header li {
            float: left;
        }

        header    li a, .dropbtn-01 {
            display: inline-block;
            color: #DC7633;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            border-radius: 25px;
        }

        header    li a:hover, .dropdown-01:hover .dropbtn-01 {
            background-color: #fff
        }

        header   li.dropdown-01 {
            display: inline-block;
        }

        header    .dropdown-content-01 {
            display: none;
            position: absolute;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            background-color: #5d6cf1;
            border-radius: 25px;
        }

        header .active-nav{
            background-color: var(--color-btn);
        }

        header  .dropdown-content-01 a {
            color: var(--color-dark);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            border-radius: 25px;
        }

        header    .dropdown-content-01 a:hover {background-color: var(--color-dark); color: var(--color-white);}

        header   .dropdown-01:hover .dropdown-content-01 {
            display: block;
        }


        #audioPlayer {
            display: none;
        }

        #playButtonLabel {
            display: inline-block;
            background-color: #f1f1f1;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #audioPlayer01 {
            display: none;
        }

        #playButtonLabel01 {
            display: inline-block;
            background-color: #f1f1f1;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #audioPlayer02 {
            display: none;
        }

        #playButtonLabel02 {
            display: inline-block;
            background-color: #f1f1f1;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

    </style>
    
</head>
        <?php
            $st_id = "0";
            if(isset($_SESSION['st_id'])){
                $st_id = $_SESSION['st_id'];
            }
        ?>

<body>

    <?php if($st_id!="0"){ ?>
    <header>
        <div class="logo">
            <img src="./images/logos/logo.png">
            <h2 class="st-logo">ONLINE<span class="danger">INSTITUTE</span></h2>
        </div>
        <nav>
            <ul>
                <?php
                     $sql5 = "SELECT * FROM student WHERE st_id = '$st_id'";

                     $res5 = mysqli_query($conn, $sql5);
         
                     $count5 = mysqli_num_rows($res5);
         
                     if($count5>0){
                        while($row=mysqli_fetch_assoc($res5)){
                            $VA = $row['VA'];
                        }
                    } ?>
                
                <?php
                    if($VA == 1){ ?>
                        <li><a href="va-change.php?VA=0&st_id=<?php echo urlencode($st_id); ?>" class="VA-icon"><span class="material-symbols-outlined">mic</span></a></li>
                    <?php
                    }else{ ?>
                        <li><a href="va-change.php?VA=1&st_id=<?php echo urlencode($st_id); ?>"><span class="material-symbols-outlined">mic</span></a></li>
                    <?php
                    }
                ?>
                <li></li>
                <li><a href="#">Home</a></li>
                <li><a href="./student/index.php">My Classes</a></li>
                <li class="dropdown-01">
                    <a href="javascript:void(0)" class="dropbtn-01">Classes</a>
                    <div class="dropdown-content-01">
                    <a href="classes.php">Classes</a>
                    <a href="#">Teachers</a>
                    </div>
                </li>
                <li><a href="./payment/index.php">Payment</a></li>
                <li><a href="./student/exam/index.php">Exams</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="">English</a></li>
                
                <?php if($st_id=="0") {?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register_form.php">Register</a></li>
                <?php }else{ ?>
                <li><a href="logout.php">Logout</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div class="close" id="close-btn">
            <span class="material-symbols-outlined"> close </span>
        </div>
    </header>

    <?php } else { ?>
        <header style="padding: 5px 6% 0 4px;">
        <div class="logo">
            <img src="./images/logos/logo.png">
            <h2 class="st-logo">ONLINE<span class="danger">INSTITUTE</span></h2>
        </div>
        <nav>
            <ul>
                <?php
                    if(isset($_SESSION['VA_NL'])){
                        $VA = $_SESSION['VA_NL'];
                    }
                ?>

                <?php
                    if($VA == 1){ ?>
                        <li><a href="va-change-no-login.php?VA_NL=0&st_id=<?php echo urlencode($st_id); ?>" class="VA-icon"><span class="material-symbols-outlined">mic</span></a></li>
                    <?php
                    }else{ ?>
                        <li><a href="va-change-no-login.php?VA_NL=1&st_id=<?php echo urlencode($st_id); ?>"><span class="material-symbols-outlined">mic</span></a></li>
                    <?php
                    }
                ?>
                <li></li>
                <li><a href="#">Home</a></li> <!-- add more li to for all classes and teachers -->
                <li class="dropdown-01">
                    <a href="javascript:void(0)" class="dropbtn-01">Classes</a>
                    <div class="dropdown-content-01">
                    <a href="#">Classes</a>
                    <a href="#">Teachers</a>
                    </div>
                </li>
                <li><a href="#">English</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register_form.php">Register</a></li>
            </ul>
        </nav>
        <div class="close" id="close-btn">
            <span class="material-symbols-outlined"> close </span>
        </div>
    </header>

    <?php } ?>

    <div class="container">

        <main>

            <?php
            if($st_id !== '0'){
                $sql1 = "SELECT * FROM student WHERE st_id = '$st_id'";
                
                $res1 = mysqli_query($conn, $sql1);
                
                $count1 = mysqli_num_rows($res1);

                if($count1>0){ 
                    while($row=mysqli_fetch_assoc($res1)){
                        
                        $st_username = $row['st_username']; 
                        $st_img = $row['st_img'];
                        ?>

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
                                        <p>Hey, <b><?php echo $st_username; ?></b></p>
                                        <small class="text-muted">Student</small>
                                    </div>
                                    <div class="profile-photo">
                                        <img src="images/profile-pic/<?php echo $st_img; ?>" alt="profile picture">
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }}
                
                }
                else{ ?>
                    <div class="profile-st" style="top:4px; right:3px">
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
                <?php
                };


                
                $sql6 = "SELECT * FROM employee WHERE em_id = '$em_id'";
                
                $res6 = mysqli_query($conn, $sql6);
                
                $count6 = mysqli_num_rows($res6);

                if($count6>0){ 
                    while($row=mysqli_fetch_assoc($res6)){
                        $em_username = $row['em_username'];
                        $em_qualification = $row['em_qualification'];
                        $em_img = $row['em_img'];
                        $em_tt = $row['em_tt']; 
                    } } ?>
                
                <div class="hw" style="margin-top: 10px;">
                    <div style="max-width: 15%; display: inline-block; vertical-align: top; margin-right: 20px;">
                        <img src="images/employee/<?php echo $em_img; ?>" alt="Profile Picture">
                    </div>
                    <div style="max-width: 60%; display: inline-block; vertical-align: top;">
                        <h2 style="font-size: 24px;"><?php echo $em_username; ?></h2><br>
                        <h2><?php echo $em_qualification; ?></h2><br>
                        <h2></h2>
                    </div>
                </div>

                <?php
                if($em_tt != NULL){ ?>
                <div class="hw">
                    <img src="images/Time-table/<?php echo $em_tt; ?>" alt="">
                </div>
                
                <?php }else{ ?>
                    <div style="color: red; font-size: 23px; text-align: center; margin-top: 10px;">
                        <?php echo "No time table found"; ?>
                    </div>
                <?php }  ?>
            
        </main>

    </div>

    <script src="main.js"></script> 
</body>
</html>