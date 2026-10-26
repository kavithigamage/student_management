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
    <link rel="stylesheet" href="/student_management/css/style.css">
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
            background-color: rgb(45, 196, 148);
        }
        .my-courses,
        .recent-results{
            margin: 10px;
        }
        .theme{
            display: flex;
            justify-content: space-between;
        }
        .my-courses h2,
        .recent-results h2{
            margin: 0;
        }
        .my-courses a,
        .recent-results a{
            border-radius: 8px;
            text-decoration: none;
            padding: 10px;
            margin-right: 10px;
            background-color: rgb(232, 159, 99);
            color: black;
        }
        th, td {
            padding: 10px;
            text-align: left;
            background-color: #c5ea76;
            border: 1px solid black;
        }


    </style>
</head>
<body>
    <?php
        include "../includes/student-navbar.php";
    ?>
    <div class="welcome-section">
        <h3>Welcome back, <?php echo $_SESSION['name']; ?>! 👋</h3> 
        <p>Here's an overview of your academic activities.</p>
    </div>
    <div class="cards">
        <div>
            <p>📚</p>  
            <h3>Enrolled Courses</h3>
            <p>
                <?php
                    $stmt = $conn->prepare("SELECT COUNT(*) AS total_courses FROM enrollments e JOIN students s ON e.student_id = s.student_id WHERE s.user_id = ?");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    echo $row['total_courses'];
                ?>
            </p>
        </div>
        <div>
            <p>✅</p>
            <h3>Completed Courses</h3>
            <p>
                <?php
                    $stmt = $conn->prepare("SELECT COUNT(*) AS total_completed FROM enrollments e JOIN students s ON e.student_id = s.student_id WHERE s.user_id = ?");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    echo $row['total_completed'];
                ?>
            </p>
        </div>
        <div>
            <p>📊</p>
            <h3> GPA </h3> 
            <p>
                <?php
                    $grade_points = [
                        "A+" => 4.0,
                        "A"  => 4.0,
                        "A-" => 3.7,
                        "B+" => 3.3,
                        "B"  => 3.0,
                        "B-" => 2.7,
                        "C+" => 2.3,
                        "C"  => 2.0,
                        "C-" => 1.7,
                        "D"  => 1.0,
                        "F"  => 0.0
                    ];
                    $stmt = $conn->prepare("SELECT r.grade, c.credits FROM results r JOIN courses c ON r.course_id = c.course_id JOIN students s ON r.student_id = s.student_id WHERE s.user_id = ? ");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    // Calculate GPA logic would go here
                    $total_points = 0;
                    $total_credits = 0;
                    while($row = $result->fetch_assoc()){
                        $grade = $row['grade'];
                        $credits = $row['credits'];
                        
                        $point = $grade_points[$grade];

                        $total_points += $point* $credits;
                        $total_credits += $credits;
                    }
                    if($total_credits > 0){
                        $gpa = $total_points / $total_credits;
                    } else {
                        $gpa = 0;
                    }
                    echo number_format($gpa, 2);
                ?>
            </p>
        </div>
    </div>
    <br>
    <div class="my-courses">
        <div class="theme">
            <h2>My Courses</h2>
            <a href="../student/my_courses.php">View All</a> 
        </div>
        <table width="600" >
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Course</th>
                    <th>Credits</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $stmt = $conn->prepare("SELECT c.course_code, c.course_name, c.credits FROM courses c JOIN enrollments e ON c.course_id = e.course_id JOIN students s ON s.student_id = e.student_id WHERE s.user_id = ? LIMIT 3");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()){
                        echo"<tr>
                            <td>{$row['course_code']}</td>
                            <td>{$row['course_name']}</td>
                            <td>{$row['credits']}</td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <br>

    <div class="recent-results">
        <div class="theme">
            <h2>Recent Results</h2>
            <a href="../student/results.php">View Results</a> 
        </div>
        <table width="600" >
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Marks</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $stmt = $conn->prepare("SELECT c.course_name, r.marks, r.grade FROM courses c JOIN results r ON c.course_id = r.course_id  JOIN students s ON s.student_id = r.student_id WHERE s.user_id = ? ORDER BY r.result_id DESC LIMIT 3");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()){
                        echo"<tr>
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