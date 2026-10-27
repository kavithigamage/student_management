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
    <title>Student Hub | Course</title>
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
        .error{
            color: red;
        }
        .success{
            color: green;
        }
    </style>
</head>
<body>
    <?php
        include "../includes/admin-navbar.php";
    ?>
    <div class="content">
        <h1>Course Management</h1>
        <br>
        <label for="search">Search:</label>
        <input type="text" id="search" oninput="liveSearch()">
        <br><br>
    
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo "<p class='success'>" . htmlspecialchars($_SESSION['success']) . "</p>";
            unset($_SESSION['success']);
        }
        ?>

        <a href="add_course.php">Add Course</a>
        <br><br>
        <table border="1" id="tableID">
            <thead>
                <tr>
                    <th>Course Id</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Credits</th>
                    <th>Description</th>
                    <th>Actions</th>
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
                            <td>
                                <a href='edit_course.php?id={$row['course_id']}'>Edit</a>
                                <a href='delete_course.php?id={$row['course_id']}' onclick=\"return confirm('Delete this course record?')\">Delete</a>
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
