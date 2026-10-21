<?php
    include "../includes/admin-auth.php";
    include "../includes/db.php";
    $errors = [];

    if(isset($_POST['submit'])){
        $student_id = trim($_POST['student_id']);
        $course_id = trim($_POST['course_id']);
        $marks = trim($_POST['marks']);
        $grade = trim($_POST['grade']);

        if(empty($student_id) || empty($course_id) || empty($marks) || empty($grade) ){
            $errors[] = "All fields are required";
        }
        if(empty($errors)){
            // Check whether the student is actively enrolled in the course
            $check = $conn->prepare("SELECT enrollment_id FROM enrollments WHERE student_id = ? AND course_id = ? AND status = 'completed' ");
            $check->bind_param("ii", $student_id, $course_id);
            $check->execute();
            $check_result = $check->get_result();

            if($check_result->num_rows == 0){
                $errors[] = "This student is not actively enrolled in this course.";
            } else {
                // Insert result
                $stmt = $conn->prepare("INSERT INTO results(student_id, course_id, marks, grade) VALUES (?, ?, ?, ?)");

                $stmt->bind_param("iids", $student_id, $course_id, $marks, $grade);
                $stmt->execute();
                $stmt->close();

                header("Location: results.php");
                exit();
            }

            $check->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/student_management/css/style.css">
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
            background-color: #e4b9a5;
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
        <h1>Add Result</h1>
        <br>
        <form action="add_result.php" method="POST">
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
            <label for="marks">Marks:</label>
            <input type="number" name="marks" id="marks" min="0" max="100" step="0.01" required>
            <br><br>
            <label for="grade">Grade:</label>
            <select name="grade" id="grade" required>
                <option value="A+">A+</option>
                <option value="A">A</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B">B</option>
                <option value="B-">B-</option>
                <option value="C+">C+</option>
                <option value="C">C</option>
                <option value="C-">C-</option>
                <option value="D">D</option>
                <option value="F">F</option>
            </select>
            <br><br>
            <input type="submit" name="submit" value="Add Result">
        </form>
        <br><br>

        <a href="results.php">Back to Results</a>
        <br>
    </div>
    <?php
        include "../includes/footer.php";
    ?>
</body>
</html>

