<?php include('../config/constant.php');

if(isset($_POST['announcement'])){
    $ano_content = $_POST['content'];
    $ano_status = $_POST['ano_status'];
    $cl_id = $_POST['cl_id'];

    $ano_created = date('Y-m-d');

    $sql2 = "INSERT INTO announcement SET
            cl_id = '$cl_id',
            ano_content = '$ano_content',
            ano_created = '$ano_created',
            ano_status = '$ano_status'
        ";
        $res2 = mysqli_query($conn, $sql2);



        $sql3 = "SELECT * FROM announcement ORDER BY id DESC LIMIT 1";

        $res3 = mysqli_query($conn, $sql3);
        $count3 = mysqli_num_rows($res3);

        if($count3>0){
            
            while($row=mysqli_fetch_assoc($res3)){
               
                $id = $row['id'];
            }}

            $id1 = "AN".$id;

        $sql4 = "UPDATE announcement SET ano_id= '$id1' WHERE id = $id";

        $res4 = mysqli_query($conn, $sql4);

        if($res4 == TRUE) {
            $_SESSION['an-add-ok'] = "ok";
            header('location: class-view.php');
        }else{
            $_SESSION['an-add-error'] = "error";
            header('location: class-view.php');
        }
}
else{
    $_SESSION['an-add-error'] = "error";
    header('location: class-view.php');
}