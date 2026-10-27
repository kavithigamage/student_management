<?php
    include "../includes/admin-auth.php";
    include "../includes/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/student_management/images/logo.png">
    <title>Student Hub | Result</title>
    <link rel="stylesheet" href="/student_management/css/style.css">
    <style>
        td,th{
            padding: 10px;
            background-color: #a5e7d6;
            border: 1px solid black;
        }
        .content{
            margin: 20px;
        }
        .content a{
            text-decoration: none;
            background-color: #e4b9a5;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php
        include "../includes/admin-navbar.php";
    ?>
    <div class="content">
        <h1>Result Management</h1>
        <br>
        <label for="search">Search:</label>
        <input type="text" id="search" oninput="liveSearch()">
        <br><br>
        <a href="add_result.php">Add Result</a>
        <br><br>
        <table border="1" id="tableID">
            <thead>
                <tr>
                    <th>Result Id</th>
                    <th>Student Number</th>
                    <th>Student Name</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Marks</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $result = $conn->query("SELECT r.result_id, s.student_number, u.name, c.course_code, c.course_name, r.marks, r.grade FROM results r JOIN students s ON r.student_id = s.student_id JOIN users u ON s.user_id = u.user_id JOIN courses c ON r.course_id = c.course_id");
                    while($row = $result->fetch_assoc()){
                        echo"<tr>
                            <td>{$row['result_id']}</td>
                            <td>{$row['student_number']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['course_code']}</td>
                            <td>{$row['course_name']}</td>
                            <td>{$row['marks']}</td>
                            <td>{$row['grade']}</td>
                            <td>
                                <a href='edit_result.php?id={$row['result_id']}'>Edit</a>
                                <a href='delete_result.php?id={$row['result_id']}' onclick=\"return confirm('Delete this result record?')\">Delete</a>
                            </td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php
        include "../includes/footer.php";
    ?>
    <script src="../js/search.js"></script>
</body>
</html>