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

            $st_enr_id = "0";
            if(isset($_POST['submit'])){
                $st_enr_id = $_POST['st_enr_id'];
            }else{
                header('location: ./login.php');
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

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 3% 5%;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-size: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        input[type="file"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 1% 2%;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-size: 14px;
        }

        input[type="file"]:hover {
            background-color: #0056b3;
        }
        input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #ccc;
            border-radius: 3px;
            background-color: white;
            cursor: pointer;
        }

        input[type="checkbox"]:checked {
            background-color: #5d6cf1; 
            border-color: #5d6cf1;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 18px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-size: 20px;
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
                <h1 style="margin: 12px 0px 12px; font-size: 25px;">PAYMENT OPTIONS</h1>
                
                    <?php
                        $currentYearMonth = date('Y-m');

                        $sql = "SELECT * FROM student_enroll WHERE st_enr_id = '$st_enr_id'";
                        
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        if($count>0){
                            
                            while($row=mysqli_fetch_assoc($res)){
                                
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
                                        } 
                                    }
                                }
                            }
                        } ?>

                <div class="hw" style="display: flex; height: 50vh;">
                    <div class="hw" style="width: 48%; text-align: center; margin-right: 3%;">
                        <div class="cls-gap">
                            <h2 style="font-size: 22px;"><?php echo $cl_title; ?></h2><br>
                            <h2 style="color: #5d6cf1;"><?php echo $em_username; ?></h2><br><br>
                            <h2>PAYABLE AMOUNT</h2>
                            <h2 style="color: red;"><?php echo $cl_fee; ?></h2><br><br>
                            <div style="text-align: center; box-shadow: none;">
                                <button id="payhere-payment">Pay Online</button>
                            </div>
                        </div>
                    </div>

                    <div class="hw" style="width: 48%; text-align: center;">
                        <div class="cls-gap">
                            <h2 style="font-size: 23px;">Bank Slip Upload</h2><br>
                            <form action="add-payment-slip.php" method="post" enctype="multipart/form-data">
                                <h2>Select class(es) that payments include in bank slip.</h2>
                                <h4>Once you select the classes, no need to select again inside the relevant class.</h4><br>
                                <label>
                                    <input type="checkbox" name="selected_classes[]" value="<?php echo $cl_id; ?>" checked disabled>
                                    <?php echo $cl_title; ?>
                                </label><br>
                                <input type="hidden" name="cl_id" value="<?php echo $cl_id; ?>">

                                <?php
                                    $sql7 = "SELECT * FROM student_enroll WHERE st_id = '$st_id' AND st_enr_id != '$st_enr_id' AND (paid_month != '$currentYearMonth' OR paid_month IS NULL)";
                        
                                    $res7 = mysqli_query($conn, $sql7);
            
                                    $count7 = mysqli_num_rows($res7);
            
                                    if($count7>0){
                                        
                                        while($row=mysqli_fetch_assoc($res7)){
                                            
                                            $cl_id01 = $row['cl_id'];
            
            
                                            $sql8 = "SELECT * FROM class WHERE cl_id ='$cl_id01' ";
            
                                            $res8 = mysqli_query($conn, $sql8);
                                            $count8 = mysqli_num_rows($res8);
            
                                            if($count8>0){
                                                
                                                while($row=mysqli_fetch_assoc($res8)){
                                                    $cl_title = $row['cl_title']; ?>

                                                    <label>
                                                        <input type="checkbox" name="selected_classes[]" value="<?php echo $cl_id01; ?>">
                                                        <?php echo $cl_title; ?>
                                                        <input type="hidden" name="st_id" value="<?php echo $st_id; ?>">
                                                    </label><br>

                                                <?php
                                                }
                                            }
                                        }
                                    }

                                ?>

                                <br>
                                <input type="file" name="image" value="Upload Bank Slip"><br><br><br>
                                <input type="submit" value="Submit" name="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <main>
    </div>

    <?php

        $sql4 = "SELECT * FROM student_enroll WHERE st_enr_id = '$st_enr_id'";

        $res4 = mysqli_query($conn, $sql4);

        $count4 = mysqli_num_rows($res4);

        if($count4>0){
            
            while($row=mysqli_fetch_assoc($res4)){
                $st_id = $row['st_id'];
                $cl_id = $row['cl_id'];
            }

            $sql5 = "SELECT * FROM class WHERE cl_id = '$cl_id'";

            $res5 = mysqli_query($conn, $sql5);

            $count5 = mysqli_num_rows($res5);

            if($count5>0){
                
                while($row=mysqli_fetch_assoc($res5)){
                    $cl_fee = $row['cl_fee'];
                    $cl_title = $row['cl_title'];
                    $cl_grade = $row['cl_grade'];
                }
            }


            $sql6 = "SELECT * FROM student WHERE st_id = '$st_id'";

            $res6 = mysqli_query($conn, $sql6);

            $count6 = mysqli_num_rows($res6);

            if($count6>0){
                
                while($row=mysqli_fetch_assoc($res6)){
                    $st_username = $row['st_username'];
                }
            }


            $amount = $cl_fee;
            $merchant_id = "1223737";
            $order_id = uniqid();
            $merchant_secret = "MTM1MTQ1ODA0NDQyOTA5MDI0MDkxNDk2Mzc4NzQwMTI4OTM5Njc5Mg==";
            $currency = "LKR";

            $hash = strtoupper(
                md5(
                    $merchant_id . 
                    $order_id . 
                    number_format($amount, 2, '.', '') . 
                    $currency .  
                    strtoupper(md5($merchant_secret)) 
                ) 
            );

        }

    ?>

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <script>

        payhere.onCompleted = function onCompleted(orderId) {
            console.log("Payment completed. OrderID:" + orderId);
            
            var amount = encodeURIComponent("<?php echo $amount; ?>");
            var st_enr_id = encodeURIComponent("<?php echo $st_enr_id; ?>");
            var order_id = encodeURIComponent("<?php echo $order_id; ?>");

            window.location.href = "payment-confirm.php?amount=" + amount + "&st_enr_id=" + st_enr_id + "&order_id=" + order_id;

        };

        payhere.onDismissed = function onDismissed() {
            console.log("Payment dismissed");
        };
        payhere.onError = function onError(error) {
            console.log("Error:"  + error);
        };
        var payment = {
            "sandbox": true,
            "merchant_id": "1223737", 
            "return_url": "http://localhost/OIMS/payment/",   
            "cancel_url": "http://localhost/OIMS/payment/",    
            "notify_url": "http://localhost/OIMS/payment/",
            "order_id": "<?php echo $order_id; ?>",
            "items": "<?php echo $cl_title; ?>",
            "amount": "<?php echo $cl_fee; ?>",
            "currency": "<?php echo $currency; ?>",
            "hash": "<?php echo $hash; ?>", // 
            "first_name": "<?php echo $st_username; ?>",
            "last_name": "Perera",
            "email": "samanp@gmail.com",
            "phone": "0771234567",
            "address": "No.1, Galle Road",
            "city": "Colombo",
            "country": "Sri Lanka",
            "delivery_address": "No. 46, Galle road, Kalutara South",
            "delivery_city": "Kalutara",
            "delivery_country": "Sri Lanka",
            "custom_1": "",
            "custom_2": ""
        };

        document.getElementById('payhere-payment').onclick = function (e) {
            payhere.startPayment(payment);
        };
    </script>

    <script>
        document.getElementById("getSelectedClasses").addEventListener("click", function() {
            var selectedClasses = [];
            var checkboxes = document.querySelectorAll('input[name="selected_classes[]"]:checked');

            checkboxes.forEach(function(checkbox) {
                selectedClasses.push(checkbox.value);
            });

            console.log(selectedClasses);
        });

        var firstCheckbox = document.querySelector('input[name="selected_classes[]"]');
        firstCheckbox.addEventListener("change", function() {
            this.checked = true; 
        });
    </script>

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
</body>
</html>