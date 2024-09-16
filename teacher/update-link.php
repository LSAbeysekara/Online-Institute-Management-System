
<?php include('../config/constant.php'); ?>

<?php
if(isset($_POST['link'])){
    $cl_id = $_POST['cl_id'];
    $cl_link_date01 = $_POST['cl_link_date'];
    $cl_link01 = $_POST['cl_link'];

    $sql3 = "UPDATE class SET
            cl_link_date = '$cl_link_date01',
            cl_link = '$cl_link01'
            WHERE cl_id='$cl_id' 
        ";

        //execute the query
        $res3 = mysqli_query($conn, $sql3);

        //check whether the query is executed or not
        
        if($res3==true){
            $_SESSION['update-link-ok'] = "Ok"; 
            header('location:../teacher/class-view.php');
        }else{
            $_SESSION['update-link-error'] = "Error"; 
            header('location:class-view.php');
        }
}
?>