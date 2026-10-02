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
            background-color: rgb(14, 35, 108);
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
        <a href="../admin/dashboard.php">Dashboard</a>
        <a href="../admin/students.php">Students</a>
        <a href="../admin/course.php">Courses</a>
        <a href="../admin/enrollments.php">Enrollments</a>
        <a href="../admin/results.php">Results</a>
        <a href="../logout.php">Logout</a>
    </nav>
</body>
</html>