<?php
    include "../includes/student-auth.php";
    include "../includes/db.php";
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
            background-color: lightskyblue;
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
        <h1>All Courses</h1>
        <br>
        <table border="1" >
            <thead>
                <tr>
                    <th>Course Id</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Credits</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $result = $conn->query("SELECT * FROM courses");
                    while($row = $result->fetch_assoc()){
                        echo"<tr>
                            <td>{$row['course_id']}</td>
                            <td>{$row['course_code']}</td>
                            <td>{$row['course_name']}</td>
                            <td>{$row['credits']}</td>
                            <td>{$row['description']}</td>
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
