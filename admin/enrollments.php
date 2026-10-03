<?php
    include "../includes/admin-auth.php";
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
        include "../includes/admin-navbar.php";
    ?>
    <div class="content">
        <h1>Enrollment Management</h1>
        <br>
        <a href="add_enrollment.php">Add Enrollment</a>
        <br><br>
        <table border="1" >
            <thead>
                <tr>
                    <th>Enrollment Id</th>
                    <th>Student Id</th>
                    <th>Course Id</th>
                    <th>Enrollment Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $result = $conn->query("SELECT * FROM enrollments");
                    while($row = $result->fetch_assoc()){
                        echo"<tr>
                            <td>{$row['enrollment_id']}</td>
                            <td>{$row['student_id']}</td>
                            <td>{$row['course_id']}</td>
                            <td>{$row['enrollment_date']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <a href='edit_enrollment.php?id={$row['enrollment_id']}'>Edit</a>
                                <a href='delete_enrollment.php?id={$row['enrollment_id']}' onclick=\"return confirm('Delete this enrollment record?')\">Delete</a>
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
</body>
</html>
