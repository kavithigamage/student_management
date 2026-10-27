<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>

    <link rel="stylesheet" href="/student_management/css/style.css">
</head>
<body>


<header class="main-header-student">

    <div class="brand">
        <img
            class="logo"
            src="/student_management/images/logo.png"
            alt="University Logo"
        >

        <div class="brand-text">
            <h2>Student Hub</h2>
            <p>Student Management System</p>
        </div>
    </div>

    <!-- Navbar is now inside the header -->
    <nav class="student-navbar">
        <div class="nav-links">

            <a href="/student_management/student/dashboard.php"
               class="nav-link <?= $current_page == 'dashboard.php' ? 'active' : '' ?>">
                <span class="nav-icon">⌂</span> Dashboard
            </a>

            <a href="/student_management/student/course.php"
               class="nav-link <?= $current_page == 'course.php' ? 'active' : '' ?>">
                <span class="nav-icon">▤</span> Courses
            </a>

            <a href="/student_management/student/my_courses.php"
               class="nav-link <?= $current_page == 'my_courses.php' ? 'active' : '' ?>">
                <span class="nav-icon">▣</span> My Courses
            </a>

            <a href="/student_management/student/results.php"
               class="nav-link <?= $current_page == 'results.php' ? 'active' : '' ?>">
                <span class="nav-icon">▥</span> Results
            </a>

            <a href="/student_management/student/profile.php"
               class="nav-link <?= $current_page == 'profile.php' ? 'active' : '' ?>">
                <span class="nav-icon">♙</span> Profile
            </a>

        </div>

        <a href="/student_management/logout.php" class="logout-link">
            <span class="nav-icon">↪</span> Logout
        </a>
    </nav>

</header>

</body>
</html>
