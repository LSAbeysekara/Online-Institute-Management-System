<?php include('../../config/constant.php'); ?>
<?php include('../login-check.php'); ?>

<?php
    $em_id_teacher = "0";
    if(isset($_SESSION['em_id_teacher'])){
        $em_id_teacher = $_SESSION['em_id_teacher'];
    }

    if($em_id_teacher == "0"){
        $_SESSION['login-status-03'] = "error";
        header('location: ../../admin/login.php');
    }else{
        $sql1 = "SELECT * FROM employee WHERE em_id='$em_id_teacher'";

        $res1 = mysqli_query($conn, $sql1);
        $count1 = mysqli_num_rows($res1);

        if($count1>0){
            while($row=mysqli_fetch_assoc($res1)){
                $em_id01 = $row['em_id'];
                $em_username01 = $row['em_username'];
                $em_img01 = $row['em_img'];

            }

            $ex_id = "0";
            if(isset($_SESSION['ex_id'])){

                $ex_id = $_SESSION['ex_id'];

                $sql2 = "SELECT * FROM exams WHERE ex_id = '$ex_id'";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0){ 

                    while($row=mysqli_fetch_assoc($res2)){

                        $ex_title = $row['ex_title'];
                    }
                }
            }

            if($ex_id == "0"){
                $_SESSION['ex-id-error'] = "error";
                header('location: ./index.php');
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/ipootvjlv9vz4p1d1x91ok27oce25gt4no6r0tddj5c98lsw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="../../admin/sweetalert.min.js"></script>
</head>
<body>
    <div class="container-02">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="../../images/logos/logo.png">
                    <h2>ONLINE<span class="danger">INSTITUTE</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-outlined"> close </span>
                </div>
            </div>
            <div class="sidebar">
                <a href="../index.php" ><span class="material-symbols-outlined"> menu_book </span><h3>Classes</h3></a>
                <a href="./index.php" class="active"><span class="material-symbols-outlined">auto_stories</span><h3>Exams</h3></a>
                <a href="#"><span class="material-symbols-outlined"> payments </span><h3>Payments</h3></a>
                <div class="dropdown">
                    <a href="#" class="dropbtn"><span class="material-symbols-outlined">lab_profile</span><h3>Reports</h3><i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="#">Attendance Reports</a>
                        <a href="#">Classes Details</a>
                        <a href="#">Payment Details</a>
                    </div>
                </div>
                <a href="../logout.php"><span class="material-symbols-outlined"> logout </span><h3>Logout</h3></a>
            </div>
        </aside>

        <main>            
            <div class="profile-st">
                <div class="top">
                    <button id="menu-btn">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <div class="profile">
                        <div class="theme-toggler">
                            <span class="material-symbols-outlined active">light_mode</span>
                            <span class="material-symbols-outlined">dark_mode</span>
                        </div>
                    
                        <a href="../profile.php">
                            <div class="profile">
                                <div class="info">
                                    <p>Hey, <b><?php echo $em_username01; ?></b></p>
                                    <small class="text-muted">Admin</small>
                                </div>
                                <div class="profile-photo">
                                    <img src="../../images/employee/<?php echo $em_img01; ?>" alt="profile picture">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <br>
            <h1>MANAGE QUESTIONS</h1><br>

            <h2 class="header-02"><?php echo $ex_title; ?></h2><br>

        
            <?php

            $sql4 = "SELECT * FROM questions WHERE ex_id = '$ex_id'";

            $res4 = mysqli_query($conn, $sql4);

            $count4 = mysqli_num_rows($res4);

            if($count4>0)
            { 
                 $sn = 1;
                ?>
                <h2 style="text-align: center; margin-bottom: 10px;">QUESTIONS</h2>
                <div class="hw-02">
                    <div class="insights-03">

                        <?php
                        while($row=mysqli_fetch_assoc($res4))
                        {
                            $ex_id = $row['ex_id'];
                            $q_id = $row['q_id']; ?>

                            <div class="classes">
                                <div class="row-02">
                                    <a href="question-edit.php?q_id=<?php echo $q_id; ?>&q_num=<?php echo $sn; ?>"><h4 class="btn" style="color: #ff7782;">Q <?php echo $sn++; ?></h4></a>
                                </div>
                            </div>

                        <?php
                        } ?>
                    </div>
                </div>
            <?php
            }
            ?>
            
            <?php
                $q_number = 1;
                if(isset($count4)){
                    $q_number = $count4 + 1; 
                } 
            ?>
            
            <div class="hw">
                <form id="exam-form" method="post" action="add-questions.php" onsubmit="return validateForm()">
                    <div class="question">
                        <div class="hw">
                            <h3 style="font-size: 20px;">Question <?php echo $q_number; ?></h3><br>
                            <textarea name="question" class="question-text" id="editor"></textarea><br>
                            <div class="answer-options">
                                <div class="hw">
                                    <h3><label for="">Answer 1: </label></h3>
                                    <textarea name="ans_01" class="question-text" id="editor01"></textarea><br>
                                </div>
                                <div class="hw">
                                    <h3><label for="">Answer 2: </label></h3>
                                    <textarea name="ans_02" class="question-text" id="editor02"></textarea><br>
                                </div>
                                <div class="hw">
                                    <h3><label for="">Answer 3: </label></h3> 
                                    <textarea name="ans_03" class="question-text" id="editor03"></textarea><br>
                                </div>
                                <div class="hw">
                                    <h3><label for="">Answer 4: </label></h3>
                                    <textarea name="ans_04" class="question-text" id="editor04"></textarea>
                                </div><br>
                                <div class="hw">
                                    <h2 class="header-03"><label for="">Correct answer: </label></h2>
                                    <textarea name="correct_answer" class="question-text" id="editor05"></textarea>
                                </div>
                                <input type="hidden" name="ex_id" value="<?php echo $ex_id; ?>">
                            </div>
                        </div>
                    </div><br>

                    <div class="edit-btn-02" style="float: right;">
                        <button type="submit" name="submit" class="pop_btn" style="width: 200px; height: 50px; padding: 4px 8px;">Next Question</button>
                    </div>
                    
                </form>
            </div>
            <div id="myModal" class="modal">
              
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div id="modalContent">
                    </div>
                </div>
            </div>
         
        </main>
    </div>

    
    <script src="../teacher.js"></script>

    <script>
        tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>

    <script>
        tinymce.init({
            selector: '#editor', 
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ],
        });
        
        function setContentToEditor() {
            var storedData = "This is the retrieved stored text.";
            tinymce.activeEditor.setContent(storedData);
        }
    </script>

    <script>
        var modal = document.getElementById("myModal");

        function openModal() {
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
        }

        function loadContent(item) {
        var modalContent = document.getElementById("modalContent");

        $.ajax({
            url: 'exam-process.php',
            method: "POST",
            data: { item: item },
            success: function (response) {
                if (typeof response === 'object' && response !== null) {
                    modalContent.innerHTML = `
                        <div class="popup1">
                            <h2>EXAM STATUS</h2>
                            <form action="update-exam.php" method="post">
                                <table>
                                    <tr>
                                        <td>Exam Title: </td>
                                        <td>
                                            <input type="text" name="ex_title" value="${response.ex_title}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> New Time in Minutes: </td>
                                        <td>
                                            <input type="number" name="ex_time" value="${response.ex_time}" min="0" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status: </td>
                                        <td>
                                            <select name="ex_status" required>
                                                <option value="${response.ex_status}">${response.ex_status}</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="ex_id" value= ${response.ex_id}>
                                </table>

                                <div class="save">
                                    <div class="delete">
                                            <button type="button" class="error reject-link" data-req-id="${response.ex_id}">Delete Class</button>
                                    </div>
                                    <button type="submit" name="update_ex">Save</button>
                                </div>
                            </form>
                        </div>
                        `;
                } else {
                    modalContent.innerHTML = "Error: Failed to load class details.";
                }

                openModal(); 
            error: function () {
                modalContent.innerHTML = "Error: Failed to load class details.";
                openModal(); 
            }
        });
    }

    </script>

    <script>
        // Attach a click event listener to the document body
        document.body.addEventListener('click', function (event) {
            if (event.target.classList.contains('reject-link')) {
                event.preventDefault(); 
                var ex_id = event.target.getAttribute('data-req-id');

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this details!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                       
                        window.location.href = `./delete-exam.php?ex_id=${ex_id}`;
                    } else {
                    }
                });
            }
        });
    </script>

    <script>
        function validateForm() {
            var questionTextarea = document.getElementById("editor");
            var questionTextarea01 = document.getElementById("editor01");
            var questionTextarea02 = document.getElementById("editor02");
            var questionTextarea03 = document.getElementById("editor03");
            var questionTextarea04 = document.getElementById("editor04");
            var questionTextarea05 = document.getElementById("editor05");

            if (questionTextarea.value.trim() === "") {
                alert("Please fill out all required fields.");
                return false; 
            }
            if (questionTextarea01.value.trim() === "") {
                alert("Please fill out all required fields.");
                return false; 
            if (questionTextarea02.value.trim() === "") {
                alert("Please fill out all required fields.");
                return false; 
            }
            if (questionTextarea03.value.trim() === "") {
                alert("Please fill out all required fields.");
                return false;
            }
            if (questionTextarea04.value.trim() === "") {
                alert("Please fill out all required fields.");
                return false; 
            }
            if (questionTextarea05.value.trim() === "") {
                alert("Please fill out all required fields.");
                return false; 
            }

            return true; 
        }
    </script>

    <?php if(isset($_SESSION['q-add-error'])){ ?>
        <script>
            swal({
                title: "Failed to add the question! Please try again.",
                icon: "error",
                button: "OK",
                });
        </script>
    <?php   unset($_SESSION['q-add-error']); } ?>

</body>
</html>
