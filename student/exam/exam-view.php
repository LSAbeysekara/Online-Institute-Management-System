<?php include('../../config/constant.php'); ?>
<?php include('../login-check.php'); ?>

<?php
    $st_id = "0";
    if(isset($_SESSION['st_id'])){
        $st_id = $_SESSION['st_id'];
    }

    if($st_id == "0"){
        header('location: ../../login.php');

    }else{
        
        $ex_id = "0";
        if(isset($_SESSION['ex_id'])){

            $ex_id = $_SESSION['ex_id'];

            $sql1 = "SELECT * FROM exams WHERE ex_id='$ex_id'";

            $res1 = mysqli_query($conn, $sql1);

            $count1 = mysqli_num_rows($res1);

            if($count1 == 0){

                $_GET['ex-id-error'] = "error";
                header('location: ./index.php');

            }else{

                if(isset($_GET['q_num']) && isset($_GET['q_id'])){

                    $q_num = $_GET['q_num'];
                    $q_id01 = $_GET['q_id'];

                } elseif(isset($_SESSION['q_num']) && isset($_SESSION['q_id'])){

                    $q_num = $_SESSION['q_num'];
                    $q_id01 = $_SESSION['q_id'];

                } else {
                    $q_num = 1;
                }

            }
        }

        if($ex_id == "0"){
            $_SESSION['ex-id-error'] = "error";
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
    <style>
        input[type="radio"] {
            display: none;
        }
        
        .custom-radio {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 2px solid #ccc;
            margin-right: 10px;
            position: relative;
        }
        
        input[type="radio"]:checked + .custom-radio::before {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #007bff;
            top: 2px;
            left: 2px;
        }
        .answer-label {
            display: block;
            margin-bottom: 10px;
            cursor: pointer;
        }

        #countdown {
            position: fixed;
            top: 65px;
            right: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        
    </style>
</head>
<body onload="handleRadioChange()">

    <div class="container-02">

        <aside>
        <?php

            $sql4 = "SELECT * FROM questions WHERE ex_id = '$ex_id'";

            $res4 = mysqli_query($conn, $sql4);

            $count4 = mysqli_num_rows($res4);

            if($count4>0)
            { 
                $sn = 1;
                ?>
                <br>
                <h2 style="text-align: center; margin-bottom: 10px;">QUESTIONS</h2>
                <div class="hw-02">
                    <div class="insights-03">

                        <?php
                        while($row=mysqli_fetch_assoc($res4))
                        {
                            $q_id = $row['q_id']; ?>
                            
                            <?php 
                                if($sn == $q_num){ ?>
                                    <div class="classes active">
                                        <div class="row-03">
                                            <a href="exam-view.php?q_id=<?php echo $q_id; ?>&q_num=<?php echo $sn; ?>">
                                                <h4 style="color: #ff7782;">Q <?php echo $sn++; ?></h4>
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                }else{ ?>
                                    <div class="classes">
                                        <div class="row-03">
                                            <a href="exam-view.php?q_id=<?php echo $q_id; ?>&q_num=<?php echo $sn; ?>">
                                                <h4 style="color: #ff7782;">Q <?php echo $sn++; ?></h4>
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                }
                            ?>
                        <?php
                        } ?>
                        
                    </div>
                </div>
            <?php
            }
            ?>
        </aside>

        <main>

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

            <?php
            $sql3 = "SELECT * FROM questions WHERE q_id='$q_id01'";

            $res3 = mysqli_query($conn, $sql3);    
            
            $count3 = mysqli_num_rows($res3);
    
            if($count3>0){

                while($row=mysqli_fetch_assoc($res3)){
                     
                    $question = $row['question'];
                    $ans_01 = $row['ans_01'];
                    $ans_02 = $row['ans_02'];
                    $ans_03 = $row['ans_03'];
                    $ans_04 = $row['ans_04'];
                    $correct_answer = $row['correct_answer'];
                }
            }
            ?>
            
            <div class="hw" style="height: 94vh; padding: 20px;">
                <h3 style="font-size: 17px;">
                    <div class="question">
                        <?php echo $question; ?>
                    </div><br>
                </h3>

                <?php
                    $st_answer = "0";
                    $sql6 = "SELECT * FROM answer WHERE q_id='$q_id01' AND st_id='$st_id'";

                    $res6 = mysqli_query($conn, $sql6);    
                    
                    $count6 = mysqli_num_rows($res6);
            
                    if($count6>0){
        
                        while($row=mysqli_fetch_assoc($res6)){
                             
                            $st_answer = $row['st_answer'];
                        }
                    }
                ?>

                <form action="process-quiz.php" method="post" enctype="multipart/form-data">
                    <h3 style="font-size: 14px;">
                        <?php
                            $answerValues = array($ans_01, $ans_02, $ans_03, $ans_04);
                            
                            foreach ($answerValues as $index => $answerValue) {
                                echo '<label class="answer-label">';
                                echo '<input type="radio" name="answer" value="' . $answerValue . '"';
                                
                                if ($st_answer === $answerValue) {
                                    echo ' checked';
                                }
                                
                                echo '>';
                                echo '<span class="custom-radio"></span>';
                                echo $answerValue;
                                echo '</label>';
                            }
                        ?>

                        <input type="hidden" name="correct_answer" value="<?php echo $correct_answer; ?>">
                        <input type="hidden" name="q_id" value="<?php echo $q_id01; ?>">
                        <input type="hidden" name="st_id" value="<?php echo $st_id; ?>">
                        <input type="hidden" name="ex_id" value="<?php echo $ex_id; ?>">
                    </h3>
                    
        
                    <?php

                        $specific_q_id = $q_id01; 
                        $ex_id01 = $ex_id; 
                        $sql_specific = "SELECT * FROM questions WHERE q_id = '$specific_q_id' AND ex_id = '$ex_id01'";
                        $res_specific = mysqli_query($conn, $sql_specific);
                        $row_specific = mysqli_fetch_assoc($res_specific);

                        if ($row_specific) {
                            $sql_next = "SELECT * FROM questions WHERE ex_id = '$ex_id01' AND q_id > '$specific_q_id' LIMIT 1";
                            $res_next = mysqli_query($conn, $sql_next);
                            $row_next = mysqli_fetch_assoc($res_next);

                            if ($row_next) {
                                $next_q_id = $row_next['q_id'];
                            } else {
                                $next_q_id = "0";
                            }
                        }

                        $q_num01 = $q_num + 1;

                    ?>

                    <div class="edit-btn-02" style="float: right;">
                        <?php
                        if($next_q_id=="0"){ ?>
                            <input type="hidden" name="new_q_id" value="0">
                            <input type="hidden" name="new_q_num" value="0">
                        <?php
                        }else{ ?>
                            <input type="hidden" name="new_q_id" value="<?php echo $next_q_id; ?>">
                            <input type="hidden" name="new_q_num" value="<?php echo $q_num01; ?>">
                        <?php } 

                        if($next_q_id == "0"){ ?>
                            <input type="hidden" name="finish" value="Finished">
                            <button type="submit" name="submit" class="pop_btn" style="width: 150px; height: 30px; padding: 4px 8px;" id="finishButton">Finish</button>
                        <?php } else{ ?>
                            <button type="submit" name="submit" class="pop_btn" style="width: 150px; height: 30px; padding: 4px 8px;">Next Question</button>
                        <?php } ?>
                    </div>
                </form>

                <button id="clear-button" class="pop_btn" style="width: 120px; height: 20px; padding: 4px 8px; display: none; cursor: pointer;">Clear Selection</button>


            </div>

            <?php
                 $sql5 = "SELECT * FROM exams WHERE ex_id='$ex_id'";

                 $res5 = mysqli_query($conn, $sql5);    
                 
                 $count5 = mysqli_num_rows($res5);
         
                 if($count5>0){
     
                     while($row=mysqli_fetch_assoc($res5)){
                          
                         $ex_time = $row['ex_time'];
                     }
                    }
            ?>

            <div id="countdown"></div>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <div id="modalContent">
                        <h2>Time is over. Press finish button to save your answers and finish the exam.</h2>
                        <a href="./exam-submit.php?ex_id=<?php echo $ex_id; ?>&st_id=<?php echo $st_id; ?>">
                            <button class="pop_btn" style="width: 150px; height: 30px; padding: 4px 8px;" id="finishButton01" onclick="confirmFinish()">Save and Finish Exam</button>
                        </a>
                    </div>
                </div>
            </div>
    
        </main>
    </div>

    <script>
        function handleRadioChange() {
            var radios = document.querySelectorAll('input[type="radio"]');
            var clearButton = document.getElementById('clear-button');

            radios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    clearButton.style.display = 'block';
                });
            });

            clearButton.addEventListener('click', function() {
                radios.forEach(function(radio) {
                    radio.checked = false;
                });
                clearButton.style.display = 'none';
            });
        }
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

    <script>
        const examDurationFromServer = <?php echo $ex_time; ?>; 
        
        function startCountdown(examDurationInMinutes) {
            let endTime;

            const storedEndTime = localStorage.getItem("endTime");
            if (storedEndTime) {
                endTime = new Date(storedEndTime);
            } else {
                endTime = new Date();
                endTime.setMinutes(endTime.getMinutes() + examDurationInMinutes);
                localStorage.setItem("endTime", endTime);
            }

            const countdownElement = document.getElementById("countdown");
            let interval;

            function updateCountdown() {
                const now = new Date();
                const timeLeft = endTime - now;

                if (timeLeft <= 0) {
                    clearInterval(interval);
                    openModal();
                } else {
                    const hours = Math.floor(timeLeft / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    countdownElement.innerHTML = `${hours.toString().padStart(2, "0")}:
                                                ${minutes.toString().padStart(2, "0")}:
                                                ${seconds.toString().padStart(2, "0")}`;
                }
            }

            interval = setInterval(updateCountdown, 1000);

            const finishButton = document.getElementById("finishButton");
            finishButton.addEventListener("click", function() {
                clearInterval(interval);
                countdownElement.innerHTML = "Countdown stopped.";
                localStorage.removeItem("endTime");
            });

            const finishButton01 = document.getElementById("finishButton01");
            finishButton01.addEventListener("click", function() {
                clearInterval(interval);
                countdownElement.innerHTML = "Countdown stopped.";
                localStorage.removeItem("endTime");
            });
        }
        
        startCountdown(examDurationFromServer);
    </script>

    <script>
        var modal = document.getElementById("myModal");
        function openModal() {
            modal.style.display = "block";
        }
        function closeModal() {
            modal.style.display = "none";
        }
    </script>

    <script>
        function confirmFinish() {
            return confirm("Are you sure you want to finish the exam?");
        }
    </script>

</body>
</html>