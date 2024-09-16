<?php include('../../config/constant.php'); ?>
<?php include('../login-check.php'); ?>

<?php
    $st_id = "0";
    if(isset($_SESSION['st_id'])){
        $st_id = $_SESSION['st_id'];
    }

    if($st_id == "0"){
        header('location: ../login.php');

    }else{
        
        $ex_id = "0";
        if(isset($_GET['ex_id'])){

            $ex_id = $_GET['ex_id'];

            $sql1 = "SELECT * FROM exams WHERE ex_id='$ex_id'";

            $res1 = mysqli_query($conn, $sql1);

            $count1 = mysqli_num_rows($res1);

            if($count1 == 0){
                $_GET['ex-id-error'] = "error";
                header('location: ./index.php');
            }
        }

        if($ex_id == "0"){
            $_GET['ex-id-error'] = "error";
            header('location: ./index.php');
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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../../admin/sweetalert.min.js"></script>
</head>
<body>
    <div class="container-03">
        <main>
            <div class="hw" style="height: 94vh;">
                <?php
                    $sql2 = "SELECT * FROM exams WHERE ex_id='$ex_id'";
                    $res2 = mysqli_query($conn, $sql2);
            
                    $count2 = mysqli_num_rows($res2);
            
                    if($count2>0){
                        
                        while($row=mysqli_fetch_assoc($res2)){
                            $ex_title = $row['ex_title'];
                            $ex_time = $row['ex_time'];
                            $ex_date = $row['ex_date_time'];
                            $cl_id = $row['cl_id'];
                            $ex_rules = $row['ex_rules'];
                        }
                    }

                    $sql3 = "SELECT * FROM class WHERE cl_id='$cl_id'";
                    $res3 = mysqli_query($conn, $sql3);
            
                    $count3 = mysqli_num_rows($res3);
            
                    if($count3>0){
                        
                        while($row=mysqli_fetch_assoc($res3)){
                            $cl_title = $row['cl_title'];
                        }
                    }

                ?>

                <h1 style="text-align: center; font-size: 34px;"><?php echo $cl_title; ?></h1><br>

                <h1 style="text-align: center;"><?php echo $ex_title; ?></h1><br><br>

                <div class="exam">
                    <h3>
                        <table class="link-update-table ">
                            <tr>
                                <td>Date and Time: </td>
                                <td><?php echo $ex_date; ?></td>
                            </tr>
                            <tr>
                                <td>Duration: </td>
                                <td>
                                    <?php
                                        if ($ex_time < 60) {
                                            echo $ex_time . " minutes";
                                        } else {
                                            $hours = floor($ex_time / 60);
                                            $minutes = $ex_time % 60;
                                            if ($minutes === 0) {
                                                echo $hours . " hours";
                                            } else {
                                                echo $hours . " hours and " . $minutes . " minutes";
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </h3>
                </div>

                <div class="hw attempt">
                    <?php echo $ex_rules; ?>
                </div>

                <br><br>
                <div class="exam" style="text-align: center;">
                    <h2>Attempt Exam Here</h2><br>
                    <a href="exam-view-session.php?ex_id=<?php echo $ex_id; ?>">
                        <div class="edit-btn-02">
                            <button class="pop_btn" style="width: 50%; height: 30px;">Attempt Now</button>
                        </div>
                    </a>
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