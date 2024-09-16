<?php include('config/constant.php'); ?>

<?php
    $st_id = "0";
    if(isset($_SESSION['st_id'])){
        $st_id = $_SESSION['st_id'];
    }
?>

<?php
    $VA = 0;
?>


<?php
    $sql5 = "SELECT * FROM student WHERE st_id = '$st_id'";

    $res5 = mysqli_query($conn, $sql5);

    $count5 = mysqli_num_rows($res5);

    if($count5>0){
        while($row=mysqli_fetch_assoc($res5)){
            $VA = $row['VA'];
        }
    } ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <title>Class View</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    * {
      box-sizing: border-box;
    }
    
    body {
      font-family: Arial, Helvetica, sans-serif;
    }
    

    header {
      background-color: #613659;
      padding: 6px;
      text-align: center;
      font-size: 35px;
      color: white;
      width: 100%;
      font-family: 'Dancing Script', cursive;
    }

    div > .img {
      width: 39%;
      float: left;
      height: auto;
      background: #ccc;
      padding: 0.5rem;
    }

    .div-02 h2{
        text-align: center;
        font-family: 'Lumanosimo', cursive;
    }

    .div-02 > table{
        padding-left: 1rem;
    }

    div > img{
        max-width: 960px;
        min-width: 480px;

        max-height: 830px;
        min-height: 360px;
    }
    
    
    article {
      float: left;
      padding: 20px;
      width: 60%;
      background-color: #f1f1f1;
      height: 100% 
    }
    
   
    section::after {
      content: "";
      display: table;
      clear: both;
    }
    
    footer {
      background-color: #613659;
      padding: 10px;
      text-align: center;
      color: white;
      width: 100%;
    }

    .button {
    display: inline-block;
    border-radius: 8px;
    background-color: #f4511e;
    border: none;
    color: #FFFFFF;
    text-align: center;
    font-size: 28px;
    padding: 10px;
    width: auto;
    height: auto;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5px;
    }

    .button span {
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
    }

    .button span:after {
    content: '\00bb';
    position: absolute;
    opacity: 0;
    top: 0;
    right: -20px;
    transition: 0.5s;
    }

    .button:hover span {
    padding-right: 25px;
    }

    .button:hover span:after {
    opacity: 1;
    right: 0;
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
    
  
    @media (max-width: 765px) {
        
        div > img{
            width: 97%;
        }

      div > .img, article{
        width: 100%;
        height: auto;
      }
    }
    </style>
    </head>
    <body>
    
    <?php
    $cl_id = $_GET['cl_id'];

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

            $time_obj = new DateTime($cl_time);
            $formatted_time = $time_obj->format('H:i'); 
            
            
            $sql3 = "SELECT * FROM employee WHERE em_id ='$em_id'";

            $res3 = mysqli_query($conn, $sql3);

            $count3 = mysqli_num_rows($res3);

            if($count3>0){
                
                while($row=mysqli_fetch_assoc($res3)){
                    $em_username = $row['em_username'];

                }
            }

            ?>

    <?php  
        }
    }    
    ?>

    <header>
        <h2><?php echo $cl_title; ?> - <?php echo $cl_lan; ?> Medium</h2>
    </header>

    <section>
    <div style="margin-right:3px;">
        <img class="img" src="./images/class/<?php echo $cl_img; ?>">
    </div>
    
        <div class="div-02">
            <p><h2><?php echo $cl_description; ?></h2></p>
            <table style="text-align:center;">
                <tr>
                    <td colspan=2 style="color:blue; font-size:24px">
                        <h1><?php echo $em_username; ?></h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>Grade:</h3>
                    </td>
                    <td style="color:red;">
                        <h3><?php echo $cl_grade; ?></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>Day:</h3>
                    </td>
                    <td style="color:red;">
                        <h3><?php echo $cl_day; ?></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>Time:</h3>
                    </td>
                    <td style="color:red;">
                        <h3><?php echo $formatted_time; ?></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>Duration:</h3>
                    </td>
                    <td style="color:red;">
                        <h3><?php echo $cl_duration; ?></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>Fee:</h3>
                    </td>
                    <td style="color:red;">
                        <h3><?php echo $cl_fee; ?></h3>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 style="color:red;">
                        <h6>***Fees are shown for one month***</h6>
                    </td>
                </tr>
            </table>
            
        </div>
    </section>

    <footer>
            <a href="./class-view.php?cl_id=<?php echo $cl_id; ?>&st_id=<?php echo $st_id; ?>">
                <button class="button" style="vertical-align:middle"><span>Request to join</span></button>
            </a>
    </footer>

    <?php if($VA == 1){ ?>
        <?php if(isset($_SESSION['login-teacher-sin'])){ ?>
            <audio id="audioPlayer01" controls>
                <source src="./VA/mp3/class-view.mp3" type="audio/mpeg">
            </audio>
        <?php   unset($_SESSION['login-teacher-sin']); 
        }elseif(isset($_SESSION['VA-on'])){ ?>
            <audio id="audioPlayer01" controls>
                <source src="./VA/mp3/class-view.mp3" type="audio/mpeg">
            </audio>
    <?php }} ?>   

    <script>
        setTimeout(function() {
            const audioPlayer = document.getElementById('audioPlayer01');
            audioPlayer.play();
        }, 2000); 
    </script>

    </body>
    </html>
            
            
            
    <?php

    if(isset($_GET['cl_id']) && isset($_GET['st_id']))
    {
        $cl_id = $_GET['cl_id'];
        $st_id = $_GET['st_id'];
        
        
        $sql5 = "SELECT * FROM request WHERE st_id = '$st_id' AND cl_id = '$cl_id'";

       
        $res5 = mysqli_query($conn, $sql5);

        $count5 = mysqli_num_rows($res5);

        if($count5>0){
            
            $_SESSION['requested'] = "error";
            echo "<script> window.location.replace('index.php');</script>";

        }else{

            $sql6 = "SELECT * FROM student_enroll WHERE st_id = '$st_id' AND cl_id = '$cl_id'";

            $res6 = mysqli_query($conn, $sql6);

            $count6 = mysqli_num_rows($res6);

            if($count6>0){
                
                $_SESSION['already-in'] = "error";
                echo "<script> window.location.replace('index.php');</script>";

            }else{
            
                if($_GET['st_id'] != "0")
                {

                    $sql4 = "SELECT * FROM student WHERE st_id = '$st_id'";

                    $res4 = mysqli_query($conn, $sql4);

                    $count4 = mysqli_num_rows($res4);

                    if($count4>0){
                        
                        while($row=mysqli_fetch_assoc($res4)){
                           
                            $status = $row['status'];
                        }
                    }

                    if($status == "Active"){

                        $sql2 = "INSERT INTO request SET
                            st_id = '$st_id',
                            cl_id = '$cl_id'
                        ";
                        $res2 = mysqli_query($conn, $sql2);

                        $sql3 = "SELECT * FROM request ORDER BY id DESC LIMIT 1";

                        $res3 = mysqli_query($conn, $sql3);

                        $count3 = mysqli_num_rows($res3);

                        if($count3>0){
                            while($row=mysqli_fetch_assoc($res3)){
                                $id = $row['id'];
                            }}

                            $id1 = "R".$id;

                        $sql4 = "UPDATE request SET req_id= '$id1' WHERE id = $id";

                        $res4 = mysqli_query($conn, $sql4);

                        if($res2 == true){
                            $_SESSION['req-ok'] = "<div class='success'>Ok</div></br></br>";
                            echo "<script> window.location.replace('index.php');</script>";
                            ?>
                        <?php
                        }
                        else
                        {
                            $_SESSION['req-error'] = "<div class='success'>error</div></br></br>";
                            header('location: index.php');
                            
                        }
                    
                    }else{
                        $_SESSION['banned'] = "error";
                        echo "<script> window.location.replace('index.php');</script>";
                    }

                }else{
                    echo "<script> window.location.replace('login.php');</script>";
                }
            }
        }

    }
    else{
        
    }
    ?>
            
    