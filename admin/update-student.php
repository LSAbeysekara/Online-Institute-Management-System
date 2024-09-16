<?php include('config/constant.php') ?>

<?php
    if(isset($_POST['update']))
    {
        //get all the details from the form
        $st_id = $_POST['st_id'];
        $status = $_POST['status'];

        //update the food in database 
        $sql = "UPDATE student SET
            status = '$status'
            WHERE st_id='$st_id' 
        ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query is executed or not
        
        if($res==true){
            //query executed and food updated
            $_SESSION['st-update_image-ok'] = "<div class='success'>Ok</div></br></br>"; 
            header('location:student.php'); ?>
            <!-- <meta http-equiv = "refresh" content = "0; url =manage-food.php" /> -->
        <?php
        }
        else
        {
            //failed to update
            $_SESSION['st-update_image-error'] = "<div class='error'>Error</div></br></br>";
            header('location:student.php');
        }

        //redirect to manage food with session message 
    }
    else{
        echo "HI";
    }
?>