<?php
    include "../includes/admin-auth.php";
    include "../includes/db.php";
    $errors = [];

    if(isset($_POST['submit'])){
        $student_id = trim($_POST['student_id']);
        $course_id = trim($_POST['course_id']);
        $enrollment_date = trim($_POST['enrollment_date']);
        $status = trim($_POST['status']);

        if(empty($student_id) || empty($course_id) || empty($enrollment_date) || empty($status) ){
            $errors[] = "All fields are required";
        }
        if(empty($errors)){
            // Insert into enrollments table
            $stmt = $conn->prepare("INSERT INTO enrollments(student_id, course_id, enrollment_date, status) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $student_id, $course_id, $enrollment_date, $status);
            $stmt->execute();
            $stmt->close();

            header("Location: enrollments.php");
            exit();
        }
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
            background-color: lightskyblue;
            border-radius: 10px;
            border: 1px solid black;
            padding: 20px;
        }
        .content > a{
            text-decoration: none;
            background-color: lightgreen;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
        }
        form input[type="submit"]{
            padding: 10px ;
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
        <h1>Add Enrollment</h1>
        <br>
        <form action="add_enrollment.php" method="POST">
            <label for="student_id">Student:</label>
            <select name="student_id" id="student_id" required>
                <?php
                    $result = $conn->query("SELECT s.student_id, u.name FROM students s JOIN users u ON s.user_id = u.user_id");
                    while($row = $result->fetch_assoc()){
                        echo "<option value='{$row['student_id']}'>{$row['student_id']} - {$row['name']}</option>";
                    }
                ?>
            </select>
            <br><br>
            <label for="course_id">Course:</label>
            <select name="course_id" id="course_id" required>
                <?php
                    $result = $conn->query("SELECT course_id, course_name, course_code FROM courses");
                    while($row = $result->fetch_assoc()){
                        echo "<option value='{$row['course_id']}'>{$row['course_code']} - {$row['course_name']}</option>";
                    }
                ?>
            </select>
            <br><br>
            <label for="enrollment_date">Enrollment Date:</label>
            <input type="date" name="enrollment_date" id="enrollment_date" required>
            <br><br>
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="active">Active</option>
                <option value="completed">Completed</option>
                <option value="dropped">Dropped</option>
            </select>
            <br><br>
            <input type="submit" name="submit" value="Add Enrollment">
        </form>
        <br><br>

        <a href="enrollments.php">Back to Enrollments</a>
        <br>
    </div>
    <?php
        include "../includes/footer.php";
    ?>
</body>
</html>

