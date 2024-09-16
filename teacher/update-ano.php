<?php include('../config/constant.php'); 

if(isset($_POST['update_ano']))
    {
        //get all the details from the form
        $ano_id = $_POST['ano_id'];
        $ano_status = $_POST['ano_status'];


        //update the food in database 
        $sql = "UPDATE announcement SET
            ano_status = '$ano_status'
            WHERE ano_id='$ano_id' 
        ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query is executed or not
        
        if($res==true){
            $_SESSION['update-ano-ok'] = "<div class='success'>Ok</div></br></br>"; 
            header('location:./class-view.php');
        }
        else
        {
            //failed to update
            $_SESSION['update-ano-error'] = "<div class='error'>Error</div></br></br>";
            header('location:./class-view.php');
        }

        //redirect to manage food with session message 
    }else{
        $_SESSION['update-ano-error'] = "<div class='error'>Error</div></br></br>";
        header('location:./class-view.php');
    }