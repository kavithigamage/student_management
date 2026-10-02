<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        nav {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            text-align: center;
        }
        nav a{  
            text-decoration: none;
            color: white;  
            flex: 1;    
            list-style-type: none;
            background-color: rgb(6, 54, 6);
            border: 1px solid black;
            padding: 10px;
        }
        nav a:hover{
            background-color: lightcyan;
            color: black;
        }
    </style>
</head>
<body>
    <nav>
        <a href="../student/dashboard.php">Dashboard</a>
        <a href="../student/course.php">Course</a>
        <a href="../student/my_courses.php">My Courses</a>
        <a href="../student/results.php">Results</a>
        <a href="../student/profile.php">Profile</a>
        <a href="../logout.php">Logout</a>
    </nav>
</body>
</html>