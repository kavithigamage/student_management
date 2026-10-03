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
    <div class="welcome-section">
        <h3>Welcome back, <?php echo $_SESSION['name']; ?>! 👋</h3> 
        <p>Here's an overview of your academic activities.</p>
    </div>
    <div class="cards">
        <div>
            <p>📚</p>  
            <h3>Enrolled Courses</h3> <br>
            <p>5</p>
        </div>
        <div>
            <p>✅</p>
            <h3>Completed Courses</h3> <br>
            <p>3</p>
        </div>
        <div>
            <p>📊</p>
            <h3> GPA / Average</h3> <br>
            <p>3.45</p>
        </div>
    </div>
    <br>
    <div class="my-courses">
        <div class="theme">
            <h2>My Courses</h2>
            <a href="../student/my_courses.php">View All</a> 
        </div>
        <table border="1" width="600" >
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Course</th>
                    <th>Credits</th>
                </tr>
            </thead>
            <tbody>
                <td>CS101</td>
                <td>Programming Fundamentals</td>
                <td>3</td>
            </tbody>
        </table>
    </div>
    <br>

    <div class="recent-results">
        <div class="theme">
            <h2>Recent Results</h2>
            <a href="../student/my_courses.php">View Results</a> 
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
                <tr>
                    <td>Programming</td>
                    <td>78</td>
                    <td>B+</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
        include "../includes/footer.php";
    ?>

</body>
</html>