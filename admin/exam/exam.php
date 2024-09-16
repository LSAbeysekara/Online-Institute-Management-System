<?php include('../config/constant.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
</head>
<body>
    <table id="exam_data_table">
        <thead>
            <tr>
                <th>Exam Title</th>
                <th>Date & Time</th>
                <th>Duration</th>
                <th>Total Questions</th>
                <th>Right Answer Mark</th>
                <th>Wrong Answer Mark</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>

    <script>
        var dataTable = $('#exam_data_table').dataTable({
            "processing" : true,
            "serverSide" : true,
            "order": [],
            "ajax" : {
                url: "ajax_action.php",
                method: "POST",
                data:{action:'fetch', page: 'exam'}
            },
            "columnDef": [
                {
                    "targets" :[7],
                    "orderable" : false,
                }
            ]
        })
    </script>
</body>
</html>