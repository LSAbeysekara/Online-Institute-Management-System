<?php include('../config/constant.php') ?>

<?php
    if(isset($_POST['submit'])){
        $not_id = $_POST['not_id'];
        $not_title = $_POST['class'];
        $active = $_POST['active'];
        if(isset($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];
            if($image_name!=""){

                $ext = end(explode('.', $image_name));

                $image_name = "Notifi-Name-".rand(0000,9999).".".$ext; 

                $src = $_FILES['image']['tmp_name'];
                $dst = "../images/notification/".$image_name;

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
        $sql2 = "INSERT INTO notification SET
            not_title = '$not_title',
            not_img = '$image_name',
            active = '$active'
        ";
        $res2 = mysqli_query($conn, $sql2);

        $sql3 = "SELECT * FROM notification ORDER BY id DESC LIMIT 1";
        $res3 = mysqli_query($conn, $sql3);
        $count3 = mysqli_num_rows($res3);

        if($count3>0){
            while($row=mysqli_fetch_assoc($res3)){
                $id = $row['id'];
            }}

            $id1 = "N".$id;

        $sql4 = "UPDATE notification SET not_id= '$id1' WHERE id = $id";

        $res4 = mysqli_query($conn, $sql4);

        if($res2 == true){
            $_SESSION['notifi-add-ok'] = "<div class='success'>Ok</div></br></br>";
            header('location: notification.php');
             ?>
        <?php
        }
        else
        {
            $_SESSION['notifi-add-error'] = "<div class='success'>error</div></br></br>";
            header('location: notification.php');
            
        }
    }
?>