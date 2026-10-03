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
        .welcome-section{
            margin: 25px;
        }
        .cards{
            margin: 10px;
            display: flex;
            flex-direction: row;
            gap: 10px;
            text-align: center;
        }
        .cards div{
            border-radius: 5px;
            padding: 20px;
            flex: 1;
            background-color: rgb(28, 187, 215);
        }
        .recent-students,
        .recent-enrollements,
        .quick-actions{
            margin: 15px;
        }
        .theme{
            display: flex;
            justify-content: space-between;
        }
        .recent-students a,
        .recent-enrollements a{
            border-radius: 8px;
            text-decoration: none;
            padding: 10px;
            margin-right: 10px;
            background-color: rgb(125, 172, 59);
            color: black;
        }
        .recent-students table a{
            padding: 5px;
            text-decoration: none;
            background-color: rgb(232, 219, 99);
            color: black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .quick-actions a{
            border-radius: 8px;
            text-decoration: none;
            padding: 10px;
            margin-right: 10px;
            background-color: hsl(196, 42%, 86%);
            color: black;
            border: 2px solid rgb(50, 94, 198);
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
    <div class="welcome-section">
        <h3>Welcome back, <?php echo $_SESSION['name']; ?>! 👋</h3> 
        <p>Here's an overview of the student management system. </p>
    </div>
    <div class="cards">
        <div>
            <p>👨‍🎓</p>  
            <h3>Total Students</h3> <br>
            <p>125</p>
        </div>
        <div>
            <p>📚</p>
            <h3>Total Courses</h3> <br>
            <p>18</p>
        </div>
        <div>
            <p>📝</p>
            <h3> Total Enrollments</h3> <br>
            <p>342</p>
        </div>
    </div>
    <br>
    <div class="recent-students">
        <div class="theme">
            <h2>Recent Students </h2>
            <a href="students.php">View All</a> 
        </div>
        <table border="1" width="800" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <td>001</td>
                <td>Kavithi</td>
                <td>...</td>
                <td><a href="edit_student.php">Edit</a></td>
            </tbody>
        </table>
    </div>
    <br>

    <div class="recent-enrollements">
        <div class="theme">
            <h2>Recent Enrollments</h2>
            <a href="enrollments.php">View All</a> 
        </div>
        <table width="600" border="1">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kavithi</td>
                    <td>Programming</td>
                    <td>30/09/2026</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <div class="quick-actions">
        <h2>Quick Actions</h2> <br>
        <a href="add_student.php">Add Student</a>
        <a href="add_Course.php">Add Course</a>
        <a href="add_result.php">Add Result</a>
    </div>
    <br>
    <?php
        include "../includes/footer.php";
    ?>

</body>
</html>