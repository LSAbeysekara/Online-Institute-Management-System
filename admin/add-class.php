<?php include('../config/constant.php') ?>

<?php
    
    if(isset($_POST['submit'])){
        
        $cl_title = $_POST['title'];
        $cl_description = $_POST['description'];
        $cl_grade = $_POST['grade'];
        $cl_fee = $_POST['cl_fee'];
        $em_id = $_POST['teacher'];
        $cl_day = $_POST['day'];
        $cl_time = $_POST['time'];
        $cl_duration = $_POST['duration'];
        $cl_lan = $_POST['language'];
        $cl_status = $_POST['status'];

        
        if(isset($_FILES['image']['name'])){
            
            $image_name = $_FILES['image']['name'];

            
            if($image_name!=""){
                
                $ext = end(explode('.', $image_name));

                
                $image_name = "Class-Name-".rand(0000,9999).".".$ext; 
                $src = $_FILES['image']['tmp_name'];
                $dst = "../images/class/".$image_name;
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

        
        $sql2 = "INSERT INTO class SET
            cl_title = '$cl_title',
            cl_description = '$cl_description',
            cl_grade = '$cl_grade',
            cl_fee = '$cl_fee',
            cl_status = '$cl_status',
            cl_img = '$image_name',
            em_id = '$em_id',
            cl_duration = '$cl_duration',
            cl_time = '$cl_time',
            cl_day = '$cl_day',
            cl_lan = '$cl_lan'
        ";
        $res2 = mysqli_query($conn, $sql2);

        $sql3 = "SELECT * FROM class ORDER BY id DESC LIMIT 1";

        $res3 = mysqli_query($conn, $sql3);

        $count3 = mysqli_num_rows($res3);

        if($count3>0){
            while($row=mysqli_fetch_assoc($res3)){

                $id = $row['id'];
            }}

            $id1 = "C".$id;

        $sql4 = "UPDATE class SET cl_id= '$id1' WHERE id = $id";

        $res4 = mysqli_query($conn, $sql4);

        if($res2 == true){

            $sql5 = "INSERT INTO teacher_enroll SET
                        cl_id = '$id1',
                        em_id = '$em_id'
                    ";
            $res5 = mysqli_query($conn, $sql5);

            if($res5 == true){

                $sql6 = "SELECT * FROM teacher_enroll ORDER BY id DESC LIMIT 1";

                $res6 = mysqli_query($conn, $sql6);
                
                $count6 = mysqli_num_rows($res6);

                if($count6>0){
                    
                    while($row=mysqli_fetch_assoc($res6)){
                        $id = $row['id'];
                    }}

                    $id2 = "TE".$id;

                $sql7 = "UPDATE teacher_enroll SET em_enr_id = '$id2' WHERE id = $id";

                $res7 = mysqli_query($conn, $sql7);

                if($res7 == true){
                    $_SESSION['cls-add-ok'] = "OK";
                    header('location: class.php');
                }
                else{
                    $_SESSION['cls-add-error'] = "error";
                    header('location: class.php');
                }
            }

        }
        else
        {
            $_SESSION['cls-add-error-01'] = "error";
            header('location: class.php');
        }
        
    }
    else {
        header('location: class.php');
    }
?>