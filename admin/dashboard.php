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
    <link rel="stylesheet" href="/student_management/css/style.css">
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
        .recent-students h2,
        .recent-enrollements h2{
            margin: 0;
        }
        .recent-students a,
        .recent-enrollements a{
            margin-right: 10px;
            border-radius: 8px;
            text-decoration: none;
            padding: 10px;
            background-color: #e4b9a5;
            color: black;
        }
        th, td {
            padding: 10px;
            text-align: left;
            background-color: #a5e7d6;
            border: 1px solid black;
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
        include "../includes/admin-navbar.php";
    ?>
    <div class="welcome-section">
        <h3>Welcome back, <?php echo $_SESSION['name']; ?>! 👋</h3> 
        <p>Here's an overview of the student management system. </p>
    </div>
    <div class="cards">
        <div>
            <p>👨‍🎓</p>  
            <h3>Total Students</h3>
            <p>
                <?php
                    $result = $conn->query("SELECT COUNT(*) AS total_students FROM students");
                    $row = $result->fetch_assoc();
                    echo $row['total_students'];
                ?>
            </p>
        </div>
        <div>
            <p>📚</p>
            <h3>Total Courses</h3>
            <p>
                <?php
                    $result = $conn->query("SELECT COUNT(*) AS total_courses FROM courses");
                    $row = $result->fetch_assoc();
                    echo $row['total_courses'];
                ?>
            </p>
        </div>
        <div>
            <p>📝</p>
            <h3> Total Enrollments</h3> 
            <p>
                <?php
                    $result = $conn->query("SELECT COUNT(*) AS total_enrollments FROM enrollments");
                    $row = $result->fetch_assoc();
                    echo $row['total_enrollments'];
                ?>  
            </p>
        </div>
        <div>
            <p>📊</p>
            <h3> Results Added</h3> 
            <p>
                <?php
                    $result = $conn->query("SELECT COUNT(*) AS total_results FROM results");
                    $row = $result->fetch_assoc();
                    echo $row['total_results'];
                ?>  
            </p>
        </div>
    </div>
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
                </tr>
            </thead>
            <tbody>
                    <?php
                        $result = $conn->query("SELECT s.student_id, u.name, u.email FROM students s JOIN users u ON s.user_id = u.user_id ORDER BY s.student_id DESC LIMIT 3");
                        while($row = $result->fetch_assoc()){
                            echo"<tr>
                                <td>{$row['student_id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                            </tr>
                            ";
                        }
                    ?>
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
                    <?php
                        $result = $conn->query("SELECT u.name, c.course_code, e.enrollment_date FROM enrollments e JOIN students s ON e.student_id = s.student_id JOIN users u ON s.user_id = u.user_id JOIN courses c ON e.course_id = c.course_id ORDER BY e.enrollment_id DESC LIMIT 3");
                        while($row = $result->fetch_assoc()){
                            echo"<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['course_code']}</td>
                                <td>{$row['enrollment_date']}</td>
                            </tr>
                            ";
                        }
                    ?>
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