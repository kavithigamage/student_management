<?php
    include "../includes/admin-auth.php";
    include "../includes/db.php";
    $course_id = (int)$_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM courses WHERE course_id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $course = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if (!$course) {
        die("Course not found");
    }

    if(isset($_POST['submit'])){
        $course_code = trim($_POST['course_code']);
        $course_name = trim($_POST['course_name']);
        $credits = trim($_POST['credits']);
        $description = trim($_POST['description']);

        // Update the course
        $stmt1 = $conn->prepare("UPDATE courses SET course_code=?, course_name=?, credits=?, description=? WHERE course_id=?");
        $stmt1->bind_param("ssisi", $course_code, $course_name, $credits, $description, $course_id);
        $stmt1->execute();
        $stmt1->close();

        header("Location: course.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .content{
            margin: 20px;
        }
        .content form{
            width: 300px;
            margin-left: 20px;
            background-color: aqua;
            border-radius: 10px;
            border: 1px solid black;
            padding: 20px;
        }
        .content a{
            text-decoration: none;
            background-color: lightgreen;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
        }
        form input[type="submit"]{
            padding: 10px;
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
        <h1>Edit Course</h1>
        <br>
        <form action="edit_course.php?id=<?php echo $course_id; ?>" method="POST">
            <label for="course_code">Course Code:</label>
            <input type="text" name="course_code" id="course_code" value="<?php echo htmlspecialchars($course['course_code']); ?>" required>
            <br><br>
            <label for="course_name">Course Name:</label>
            <input type="text" name="course_name" id="course_name" value="<?php echo htmlspecialchars($course['course_name']); ?>" required>
            <br><br>
            <label for="credits">Credits:</label>
            <input type="number" name="credits" id="credits" value="<?php echo htmlspecialchars($course['credits']); ?>" required>
            <br><br>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo htmlspecialchars($course['description']); ?></textarea>
            <br><br>
            <input type="submit" name="submit" value="Update Course">
        </form>
        <br><br>

        <a href="courses.php">Back to Courses</a>
        <br>
    </div>
    <?php
        include "../includes/footer.php";
    ?>
</body>
</html>