<?php include('config/constant.php'); 

if(isset($_GET['req_id']))
    {
        //process to delete
        $req_id = $_GET['req_id'];


        $sql1 = "SELECT * FROM request WHERE req_id='$req_id'";
        //execute the query
        $res1 = mysqli_query($conn, $sql1);

        //count rows to check whether the category is available or not
        $count1 = mysqli_num_rows($res1);

        if($count1>0){
        //categories available
        while($row=mysqli_fetch_assoc($res1))
        {
            $st_id = $row['st_id'];
            $cl_id = $row['cl_id'];

            date_default_timezone_set('Asia/Colombo'); // Set the timezone to Sri Lanka
            $currentDateTime = date('Y-m-d H:i:s'); // Get the current date and time


            $currentDateTime01 = new DateTime(); // Get the current date and time
            $currentDateTime01->modify('first day of last month'); // Set the date to the first day of the previous month
            $previousMonth = $currentDateTime01->format('Y-m'); // Format the date as YYYY-MM
            echo $previousMonth;

            $sql2 = "INSERT INTO student_enroll SET
            cl_id = '$cl_id',
            st_id = '$st_id',
            enr_date = '$currentDateTime',
            paid_month = '$previousMonth'
            ";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            $sql3 = "SELECT * FROM student_enroll ORDER BY id DESC LIMIT 1";

            //execute the query
            $res3 = mysqli_query($conn, $sql3);

            //count the rows to check whether we have foods or not
            $count3 = mysqli_num_rows($res3);

            if($count3>0){
            //we have food in database
            //get the foods from database and display
            while($row=mysqli_fetch_assoc($res3)){
                //get the value from individual columns
                $id = $row['id'];
            }}

                $id1 = "SE".$id;

                $sql4 = "UPDATE student_enroll SET st_enr_id = '$id1' WHERE id = $id";

                $res4 = mysqli_query($conn, $sql4);

                if($res2 && $res4 == true){

                    //delete from database
                    $sql = "DELETE FROM request WHERE req_id='$req_id'";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //check whethtr the query exetued or not
                    if($res==true)
                    {
                        //food dleted
                        $_SESSION['req-accept-ok'] = "Ok";
                        header('location:./index.php');
                    }
                    else
                    {
                        $_SESSION['req-accept-error'] = "Error";
                        header('location:./index.php');
                    }

                }else{
                    $_SESSION['req-accept-error'] = "Error";
                    header('location:./index.php');
                }
        }
        }else{
            $_SESSION['req-accept-error'] = "Error";
            header('location:./index.php');
        }
    }
    else
    {
        $_SESSION['req-accept-error'] = "Error";
        header('location:./index.php');
    }



?>