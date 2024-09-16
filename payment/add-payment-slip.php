<?php include('../config/constant.php'); ?>

<?php
    
    if(isset($_POST['submit'])){

        $classes = "";

        if (isset($_POST["selected_classes"]) && is_array($_POST["selected_classes"])) {

            $cl_id = $_POST['cl_id'];
            $st_id = $_POST['st_id'];
            
            foreach ($_POST["selected_classes"] as $selected_class) {

                $sql = "SELECT * FROM class WHERE cl_id ='$selected_class'";
            
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $cl_title = $row['cl_title'];
                    }

                    $classes = $classes." / ".$selected_class." - ".$cl_title;
                }

            }


            $sql1 = "SELECT * FROM class WHERE cl_id ='$cl_id'";
            
            $res1 = mysqli_query($conn, $sql1);
            $count1 = mysqli_num_rows($res1);

            if($count1>0){
                while($row=mysqli_fetch_assoc($res1)){
                    $cl_title01 = $row['cl_title'];
                }

                $classes = $classes." / ".$cl_id." - ".$cl_title01;
            }

            



            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];
                if($image_name!=""){
                    $ext = end(explode('.', $image_name));
    
                    $image_name = "Bank-Slip-".rand(0000,9999).".".$ext;
    
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/payment-slip/".$image_name;
                    $upload = move_uploaded_file($src, $dst);
    
                    if($upload == false)
                    {
                        die();
                    }
                }
            }
            else
            {
                $image_name = ""; 
            }



        } else {
            $_SESSION['add-bank-slip-error'] = "error";
            header('location: index.php');
        }

        
        date_default_timezone_set('Asia/Colombo');
        $currentDateTime = date('Y-m-d H:i:s');

        $sql3 = "INSERT INTO payments SET
            st_id = '$st_id',
            amount = 0,
            payment_date = '$currentDateTime',
            paid_type = 'Bank Slip',
            payment_method = 'Bank Deposit',
            transaction_id = '$image_name',
            classes = '$classes'
        ";

        $res3 = mysqli_query($conn, $sql3);
        
        $sql4 = "SELECT * FROM payments ORDER BY id DESC LIMIT 1";
        $res4 = mysqli_query($conn, $sql4);
        $count4 = mysqli_num_rows($res4);

        if($count4>0){
            while($row=mysqli_fetch_assoc($res4)){
                $id = $row['id'];
            }}

            $id1 = "P".$id;

        $sql5 = "UPDATE payments SET p_id= '$id1' WHERE id = $id";

        $res5 = mysqli_query($conn, $sql5);

        if($res5 == TRUE) {
            $_SESSION['add-bank-slip-ok'] = "Ok";
            header('location: index.php');
        }else{
            $_SESSION['add-bank-slip-error'] = "error";
            header('location: index.php');
        }
        
    }else{
        $_SESSION['add-bank-slip-error'] = "error";
        header('location: index.php');
    }
?>