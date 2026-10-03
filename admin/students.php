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
            background-color: lightgreen;
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
        <h1>Student Management</h1>
        <br>
        <a href="add_student.php">Add Student</a>
        <br><br>
        <table border="1" >
            <thead>
                <tr>
                    <th>Student Id</th>
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>NIC</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $result = $conn->query("SELECT s.student_id, s.student_number, u.name, s.nic, s.mobile, u.email FROM students s JOIN users u ON s.user_id = u.user_id");
                    while($row = $result->fetch_assoc()){
                        echo"<tr>
                            <td>{$row['student_id']}</td>
                            <td>{$row['student_number']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row ['nic']}</td>
                            <td>{$row['mobile']}</td>
                            <td>{$row['email']}</td>
                            <td>
                                <a href='edit_student.php?id={$row['student_id']}'>Edit</a>
                                <a href='delete_student.php?id={$row['student_id']}' onclick=\"return confirm('Delete this student record?')\">Delete the student</a>
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
