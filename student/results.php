<?php
    include "../includes/student-auth.php";
    include "../includes/db.php";
    $user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td,th{
            padding: 10px;
        }
        .content{
            margin: 20px;
        }
        .content a{
            text-decoration: none;
            background-color: lightgoldenrodyellow;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php
        include "../includes/header.php";
    ?>
    <?php
        include "../includes/student-navbar.php";
    ?>
    <div class="content">
        <h1>My Result</h1>
        <br>
        <table border="1" >
            <thead>
                <tr>
                    <th>Result Id</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Marks</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $result = $conn->query("SELECT r.result_id, c.course_code, c.course_name, r.marks, r.grade FROM results r JOIN courses c ON r.course_id = c.course_id JOIN students s ON r.student_id = s.student_id WHERE s.user_id = $user_id");
                    if ($result->num_rows == 0) {
                        echo "<tr>
                                <td colspan='5'>No results available yet.</td>
                            </tr>";
                    }
                    while($row = $result->fetch_assoc()){
                        echo"<tr>
                            <td>{$row['result_id']}</td>
                            <td>{$row['course_code']}</td>
                            <td>{$row['course_name']}</td>
                            <td>{$row['marks']}</td>
                            <td>{$row['grade']}</td>
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
</body>
</html>
