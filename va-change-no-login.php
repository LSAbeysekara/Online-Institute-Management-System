<?php include('./config/constant.php'); 


if(isset($_GET['VA_NL']) && isset($_GET['file'])){
    $VA_NL = $_GET['VA_NL'];
    $file = $_GET['file'];

    if($VA_NL == 1){

        if($file == 'index'){
            $_SESSION['VA_NL'] = 1;
            header('location:./index.php');

        }elseif($file == 'teachers'){
            $_SESSION['VA_NL'] = 1;
            header('location:./teachers.php');

        }elseif($file == 'classes'){
            $_SESSION['VA_NL'] = 1;
            header('location:./classes.php');
        }elseif($file == 'request'){
            $_SESSION['VA_NL'] = 1;
            header('location:./class-view.php');
        }

        
    }else{
        if($file == 'index'){
            $_SESSION['VA_NL'] = 0;
            header('location:./index.php');

        }elseif($file == 'teachers'){
            $_SESSION['VA_NL'] = 0;
            header('location:./teachers.php');

        }elseif($file == 'classes'){
            $_SESSION['VA_NL'] = 0;
            header('location:./classes.php');
        }elseif($file == 'request'){
            $_SESSION['VA_NL'] = 1;
            header('location:./class-view.php');
        }
    }
}