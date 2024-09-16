<?php include('config/constant.php') ?>

<?php
    $VA = 0;
?>

<?php
    $st_id = "0";
    if(isset($_SESSION['st_id'])){
        $st_id = $_SESSION['st_id'];
    }
    
    if(isset($_SESSION['not_show'])){

        $not_show = $_SESSION['not_show'];

    if ($not_show == '1') { ?>
        <body onload="openPopup()">
        
    <?php 
        $_SESSION['not_show'] = '0';
    }
    }
?>

<?php
    $sql5 = "SELECT * FROM student WHERE st_id = '$st_id'";
    $res5 = mysqli_query($conn, $sql5);
    $count5 = mysqli_num_rows($res5);

    $lang = 'en';

    if ($count5 > 0) {
        while ($row = mysqli_fetch_assoc($res5)) {
            $VA = $row['VA'];
            if ($VA == 1) {
                $lang = 'si';
            }
        }
    }

    $langParam = isset($_GET['lang']) ? $_GET['lang'] : '';

    if ($langParam === 'si') {
        $lang = 'si';
    }

    function loadLanguageFile($lang) {
        $file = ($lang === 'si') ? 'sinhala_lang.php' : 'english_lang.php';
        return include_once($file);
    }

    $langStrings = loadLanguageFile($lang);
?>



<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $langStrings['home']; ?></title>
    <link rel="stylesheet" href="st-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdn.jsdelivr.net/npm/i18next@21.6.12/dist/umd/i18next.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/i18next-xhr-backend@3.2.2/dist/i18nextXHRBackend.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/i18next-browser-languagedetector@6.1.2/dist/i18nextBrowserLanguageDetector.min.js"></script>
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

        footer {
            background-color: #F0E2C6;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .foot {
            color: #4a4a4a;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .footer button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1.2em;
            margin: 0 auto;
            margin-bottom: 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            animation: pulse 2s infinite;
        }

        .footer button:hover {
            background-color: #3e8e41;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

    </style>
    
</head>

            

<body>

<video autoplay loop muted plays-inline class="back-video">
    <source src="images/logos/back.mp4" type="video/mp4">
</video>

<?php if($st_id!="0"){ ?>
<header>
    <div class="logo">
        <img src="./images/logos/logo.png">
        <h2 class="st-logo">ONLINE<span class="danger">INSTITUTE</span></h2>
    </div>
    <nav>
        <ul>
            
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
            <li><a href="#" class="cta"><?php echo $langStrings['home']; ?></a></li>
            <li><a href="./student/index.php"><?php echo $langStrings['myclass']; ?></a></li>
            <li class="dropdown-01">
                <a href="javascript:void(0)" class="dropbtn-01"><?php echo $langStrings['classes']; ?></a>
                <div class="dropdown-content-01">
                <a href="classes.php"><?php echo $langStrings['classes']; ?></a>
                <a href="teachers.php"><?php echo $langStrings['teachers']; ?></a>
                </div>
            </li>
            <li><a href="./payment/index.php"><?php echo $langStrings['payment']; ?></a></li>
            <li><a href="./student/exam/index.php"><?php echo $langStrings['exam']; ?></a></li>
            <li class="dropdown-01">
                <a href="javascript:void(0)" class="dropbtn-01"><?php echo $langStrings['language']; ?></a>
                <div class="dropdown-content-01">
                <a href="?lang=en">English</a>
                <a href="?lang=si">සිංහල</a>
                </div>
            </li>
            <li><a href="#"><?php echo $langStrings['help']; ?></a></li>
            <li>
            <?php if($st_id=="0") {?>
            <li><a href="login.php"><?php echo $langStrings['login']; ?></a></li>
            <li><a href="register_form.php"><?php echo $langStrings['register']; ?></a></li>
            <?php }else{ ?>
            <li><a href="logout.php"><?php echo $langStrings['logout']; ?></a></li>
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
                    <li><a href="va-change-no-login.php?VA_NL=0&file=index" class="VA-icon"><span class="material-symbols-outlined">mic</span></a></li>
                <?php
                }else{ ?>
                    <li><a href="va-change-no-login.php?VA_NL=1&file=index"><span class="material-symbols-outlined">mic</span></a></li>
                <?php
                }
            ?>
            <li></li>
            <li><a href="#" class="cta"><?php echo $langStrings['home']; ?></a></li> 
            <li class="dropdown-01">
                <a href="javascript:void(0)" class="dropbtn-01"><?php echo $langStrings['language']; ?></a>
                <div class="dropdown-content-01">
                <a href="?lang=en">English</a>
                <a href="?lang=si">සිංහල</a>
                </div>
            </li>
            <li class="dropdown-01">
                <a href="javascript:void(0)" class="dropbtn-01"><?php echo $langStrings['classes']; ?></a>
                <div class="dropdown-content-01">
                <a href="classes.php"><?php echo $langStrings['classes']; ?></a>
                <a href="teachers.php"><?php echo $langStrings['teachers']; ?></a>
                </div>
            </li>
            <li><a href="#"><?php echo $langStrings['help']; ?></a></li>
            <li><a href="login.php"><?php echo $langStrings['login']; ?></a></li>
            <li><a href="register_form.php"><?php echo $langStrings['register']; ?></a></li>
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
        
        $sql = "SELECT * FROM notification WHERE active = 'Yes'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count>0){ ?>

            <div class="popup" id="popup">
                <div class="slide-container1">
                        <div class="corner">
                            <span class="material-symbols-outlined" onclick="closePopup()">close</span>
                        </div>
                    <div class="slide-wrapper">
                        
                                <?php
                                
                                while($row=mysqli_fetch_assoc($res)){
                                    $not_id = $row['not_id'];
                                    $not_img = $row['not_img'];
                                    ?>
                                    <img src="images/notification/<?php echo $not_img; ?>">
                                
                                <?php
                                }
                            }else?>
                    </div>
                </div>
            </div>

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
                                    <small class="text-muted"><?php echo $langStrings['student']; ?></small>
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
            ?>

        <div class="div" data-aos="fade-right">
            <h1 class="st-heading-01"><?php echo $langStrings['search']; ?></h1> 
        </div> 
      
        <div class="div" data-aos="flip-up">
            <div class="div" data-aos="fade-left">
                <form class="search" method="post">
                    <input type="search" name="search" placeholder="<?php echo $langStrings['search-placeholder']; ?>" required>
                    <button type="submit" name="searchSubmit"><?php echo $langStrings['search-button']; ?></button>
                </form>  
            </div> 
        </div> 


        <div class="div" data-aos="flip-up">
            <div class="cl-gap">

                <div class="div" data-aos="flip-up">
                    <h1><?php echo $langStrings['our-classes']; ?></h1>
                </div>

                <?php if($VA == 1){ ?>
                    <?php if(isset($_SESSION['login-cls-sin'])){ ?>
                        <audio id="audioPlayer01" controls>
                            <source src="./VA/mp3/index-classes.mp3" type="audio/mpeg">
                        </audio>
                    <?php   unset($_SESSION['login-cls-sin']); 
                    }elseif(isset($_SESSION['VA-on'])){ ?>
                        <audio id="audioPlayer01" controls>
                            <source src="./VA/mp3/index-classes.mp3" type="audio/mpeg">
                        </audio>
                <?php }} ?>

               <div class="insights" id="playableDiv">
                  
                <?php
                    if(isset($_POST['searchSubmit'])){

                        $searches = $_POST['search'];

                        $sql2 = "SELECT * FROM class WHERE cl_title LIKE '%$searches%' AND cl_status = 'Active'";

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

                                <a href="./class-view.php?cl_id=<?php echo $cl_id; ?>">
                                    <div class="cls-gap">
                                
                                            <?php
                                                if($cl_img=="") 
                                                {  ?>                                    
                                                    <div class="cl-img-03" data-aos="zoom-in">
                                                        <?php echo "<div class='error'>Image Not Available.</div>"; ?>
                                                    </div>
                                                    <div class="details" data-aos="zoom-in">
                                                        <h2><?php echo $cl_title; ?></h2>
                                                        <h3 class="teacher"><?php echo $em_username; ?></h3>
                                                        <h4><?php echo $cl_description; ?></h4>
                                                        <h4 class="teacher">Grade: <?php echo $cl_grade; ?></h4>
                                                        <h6><?php echo $cl_time; ?></h6>
                                                        <h5><?php echo $cl_fee; ?></h5>
                                                    </div>
                                                <?php
                                                }
                                                else
                                                {
                                                    
                                                    ?>
                                                    <div class="cl-img-03" data-aos="zoom-in">
                                                        <img src="./images/class/<?php echo $cl_img; ?>">
                                                        
                                                    </div>
                                                    <div class="details" data-aos="zoom-in">
                                                        <h2><?php echo $cl_title; ?></h2>
                                                        <h3 class="teacher"><?php echo $em_username; ?></h3>
                                                        <h4><?php echo $cl_description; ?></h4>
                                                        <h4 class="teacher">Grade: <?php echo $cl_grade; ?></h4>
                                                        <h6><?php echo $cl_time; ?></h6>
                                                        <h5><?php echo $cl_fee; ?></h5>
                                                    </div>
                                                <?php
                                                }
                                            ?>
                                    </div>
                                </a>
                        <?php
                            }}
                    }else{

                        $sql2 = "SELECT * FROM class WHERE cl_status ='Active'";

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

                                <a href="./class-view.php?cl_id=<?php echo $cl_id; ?>">
                                    <div class="cls-gap">
                                
                                            <?php
                                                if($cl_img=="") 
                                                {  ?>                                    
                                                    <div class="cl-img-03" data-aos="zoom-in">
                                                        <?php echo "<div class='error'>Image Not Available.</div>"; ?>
                                                    </div>
                                                    <div class="details" data-aos="zoom-in">
                                                        <h2><?php echo $cl_title; ?></h2>
                                                        <h3 class="teacher"><?php echo $em_username; ?></h3>
                                                        <h4><?php echo $cl_description; ?></h4>
                                                        <h4 class="teacher">Grade: <?php echo $cl_grade; ?></h4>
                                                        <h6><?php echo $cl_time; ?></h6>
                                                        <h5><?php echo $cl_fee; ?></h5>
                                                    </div>
                                                <?php
                                                }
                                                else
                                                {
                                                    
                                                    ?>
                                                    <div class="cl-img-03" data-aos="zoom-in">
                                                        <img src="./images/class/<?php echo $cl_img; ?>">
                                                        
                                                    </div>
                                                    <div class="details" data-aos="zoom-in">
                                                        <h2><?php echo $cl_title; ?></h2>
                                                        <h3 class="teacher"><?php echo $em_username; ?></h3>
                                                        <h4><?php echo $cl_description; ?></h4>
                                                        <h4 class="teacher">Grade: <?php echo $cl_grade; ?></h4>
                                                        <h6><?php echo $cl_time; ?></h6>
                                                        <h5><?php echo $cl_fee; ?></h5>
                                                    </div>
                                                <?php
                                                }
                                            ?>
                                    </div>
                                </a>
                    <?php 
                            }
                        } 
                    }
                    ?>
                </div>
                    <div class="div load-more" data-aos="zoom-in">
                        <a href="./classes.php"><?php echo $langStrings['load']; ?></a>
                    </div>
            </div>  
        </div>
        
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <div id="modalContent"></div>
            </div>
        </div>
        
        <div class="div" data-aos="zoom-in" >
            <div>
                <h1 style="font-family: 'Shadows Into Light', cursive; font-size: 35px;"><?php echo $langStrings['teachers']; ?></h1>
            </div>
        </div>

        <div class="div" data-aos="zoom-in" id="playableDiv02">

            <?php if($VA == 1){ ?>
                <?php if(isset($_SESSION['login-teacher-sin'])){ ?>
                    <audio id="audioPlayer02" controls>
                        <source src="./VA/mp3/index-teacher.mp3" type="audio/mpeg">
                    </audio>
                <?php   unset($_SESSION['login-teacher-sin']); 
                }elseif(isset($_SESSION['VA-on'])){ ?>
                    <audio id="audioPlayer02" controls>
                        <source src="./VA/mp3/index-teacher.mp3" type="audio/mpeg">
                    </audio>
            <?php }} ?>                     
                
            
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    <?php
                    
                    $sql4 = "SELECT * FROM employee WHERE em_position = 'Teacher' AND status = 'Active'";
                    
                    $res4 = mysqli_query($conn, $sql4);
                    
                    $count4 = mysqli_num_rows($res4);

                    if($count4>0){ 
                        
                        while($row=mysqli_fetch_assoc($res4)){

                            $em_id = $row['em_id'];
                            $em_uname = $row['em_username'];
                            $em_img = $row['em_img']; 
                            $em_q = $row['em_qualification']; ?>

                            <div class="swiper-slide">
                                <div class="image-content">
                                    <span class="overlay"></span>

                                    <div class="card-image">
                                        <img src="images/employee/<?php echo $em_img; ?>" alt="" class="card-img">
                                    </div>
                                </div>

                                <div class="card-content">
                                    <h2 class="name"><?php echo $em_uname; ?></h2>
                                    <p class="description"><?php echo $em_q; ?> </p>
                                
                                    <a href="./time-table.php?em_id=<?php echo $em_id; ?>">
                                        <button class="button">Time Table</button>
                                    </a>
                                </div>
                            </div>
                    <?php 
                        }
                    }else{
                        echo "<div class='error'>No teachers were added.</div>";
                    }
                    
                    ?>    
                    

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
                <div class="autoplay-progress">
                <svg>
                    
                </svg>
                <span></span>
                </div>
            </div>
        </div><br><br>

        <?php 
            if($VA == 1){ ?>
            <?php if(isset($_SESSION['login-status-01-sin'])){ ?>
                <audio id="audioPlayer" controls>
                    <source src="./VA/mp3/index-log.mp3" type="audio/mpeg">
                </audio>
            <?php   unset($_SESSION['login-status-01-sin']); } ?>
        <?php } ?>


        <footer class="footer">
            <h1 class="foot"><?php echo $langStrings['become']; ?></h1>
            <a href="teacher_cv.php">
                <button><?php echo $langStrings['become-t']; ?></button>
            </a>
        </footer>
    
    </main>
</div>

<script>
    document.querySelector('#sinhala-button').addEventListener('click', function() {
  i18next.changeLanguage('si');
});
</script>

<script>
    i18next
    .use(i18nextXHRBackend)
    .use(i18nextBrowserLanguageDetector)
    .init({
        fallbackLng: 'en',
        debug: true,
        whitelist: ['en', 'si'],
        load: 'languageOnly',
        backend: {
        loadPath: 'locales/{{lng}}/translation.json'
        },
        detection: {
        order: ['localStorage', 'navigator']
        }
    }, function(err, t) {
        // initialized and ready to go!
        i18next.changeLanguage('si');
    });
</script>

<script>
    setTimeout(function() {
        const audioPlayer = document.getElementById('audioPlayer');
        audioPlayer.play();
    }, 2000); 
</script>

<script>
    
    function playAudio() {
        const audioPlayer = document.getElementById('audioPlayer01');
        audioPlayer.play();
    }
    
    const options = {
        threshold: 0.5 
        
    };
    
    function handleIntersection(entries, observer) {
        entries.forEach(entry => {
        if (entry.isIntersecting) {
            playAudio();
            observer.unobserve(entry.target); 
            
        }
        });
    }
    const observer = new IntersectionObserver(handleIntersection, options);
    const targetElement = document.getElementById('playableDiv');
    observer.observe(targetElement);
</script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
     
        var swiperOptions = {
            
        };
        var mySwiper = new Swiper(".mySwiper", swiperOptions);
        startAutoplay();

       
        function startAutoplay() {
            setInterval(function () {
              
                mySwiper.slideNext();

                if (mySwiper.isEnd) {
                   
                    mySwiper.slideTo(0, 0);
                }
            }, 5000); 
        }

        const options02 = {
            threshold: 0.5 
            
        };

        const observer02 = new IntersectionObserver(handleIntersection02, options02);

        const targetElement02 = document.getElementById('playableDiv02');
        observer02.observe(targetElement02);
    });

    function playAudio02() {
        const audioPlayer02 = document.getElementById('audioPlayer02');
        audioPlayer02.play();
    }

    function handleIntersection02(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                playAudio02();
                observer.unobserve(entry.target); 
            }
        });
    }
</script>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var swiperOptions = {
        direction: "horizontal", 
        loop: false, 
        speed: 2000, 
        slidesPerView: "auto", 
        spaceBetween: 15,
        pagination: {
            el: ".swiper-pagination", 
            clickable: true, 
        },
        navigation: {
            nextEl: ".swiper-button-next", 
            prevEl: ".swiper-button-prev", 
        },
        };

        var mySwiper = new Swiper(".mySwiper", swiperOptions);

        function startAutoplay() {
        setInterval(function () {
           
            mySwiper.slideNext();

            if (mySwiper.isEnd) {
           
            mySwiper.slideTo(0, 0);
            }
        }, 5000); 
        }

        startAutoplay();
    });
</script>

<script>
  AOS.init({
    duration: 3000,
    once: true,
  });
</script>

<script>
    var audioPlayer01 = document.getElementById("audioPlayer01");
    var audioPlayer02 = document.getElementById("audioPlayer02");

    audioPlayer02.addEventListener("play", function () {
        audioPlayer01.pause();
    });
</script>

<script src="main.js"></script> 

<?php if(isset($_SESSION['login-status-01'])){ ?>
    <script>
        swal({
            title: "<?php echo $langStrings['logged-in']; ?>",
            icon: "success",
            button: "OK",
            });
    </script>
<?php   unset($_SESSION['login-status-01']); } ?>

<?php if(isset($_SESSION['req-ok'])){ ?>
    <script>
        swal({
            title: "<?php echo $langStrings['request-sent']; ?>",
            text: "<?php echo $langStrings['admin']; ?>",
            icon: "success",
            button: "OK",
            });
    </script>
<?php   unset($_SESSION['req-ok']); } ?>

<?php if(isset($_SESSION['req-error'])){ ?>
    <script>
        swal({
            title: "<?php echo $langStrings['request-sent']; ?>",
            text: "<?php echo $langStrings['try-again']; ?>",
            icon: "error",
            button: "OK",
            });
    </script>
<?php   unset($_SESSION['req-error']); } ?>

<?php if(isset($_SESSION['banned'])){ ?>
    <script>
        swal({
            title: "<?php echo $langStrings['request-sent']; ?>",
            text: "<?php echo $langStrings['banned']; ?>",
            icon: "error",
            button: "OK",
            });
    </script>
<?php   unset($_SESSION['banned']); } ?>

<?php if(isset($_SESSION['requested'])){ ?>
    <script>
        swal({
            title: "<?php echo $langStrings['request-sent']; ?>",
            text: "<?php echo $langStrings['requested']; ?> ",
            icon: "warning",
            button: "OK",
            });
    </script>
<?php   unset($_SESSION['requested']); } ?>

<?php if(isset($_SESSION['already-in'])){ ?>
    <script>
        swal({
            title: "<?php echo $langStrings['already-in']; ?>",
            icon: "warning",
            button: "OK",
            });
    </script>
<?php   unset($_SESSION['already-in']); } ?>

<?php if(isset($_SESSION['change-VA-error'])){ ?>
    <script>
        swal({
            title: "<?php echo $langStrings['change-VA-error']; ?>",
            icon: "error",
            button: "OK",
            });
    </script>
<?php   unset($_SESSION['change-VA-error']); } ?>

<?php if(isset($_SESSION['file-ok'])){ ?>
    <script>
        swal({
            title: "<?php echo $langStrings['file-uploaded']; ?>",
            text: "<?php echo $langStrings['file-cv-ok']; ?>",
            icon: "success",
            button: "OK",
            });
    </script>
<?php   unset($_SESSION['file-ok']); } ?>