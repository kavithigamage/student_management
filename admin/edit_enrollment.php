<?php
    include "../includes/admin-auth.php";
    include "../includes/db.php";
    $enrollment_id = (int)$_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM enrollments WHERE enrollment_id = ?");
    $stmt->bind_param("i", $enrollment_id);
    $stmt->execute();
    $enrollment = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if (!$enrollment) {
        die("Enrollment not found");
    }

    if(isset($_POST['submit'])){
        $student_id = trim($_POST['student_id']);
        $course_id = trim($_POST['course_id']);
        $enrollment_date = trim($_POST['enrollment_date']);
        $status = trim($_POST['status']);

        // Update the enrollment
        $stmt = $conn->prepare("UPDATE enrollments SET student_id=?, course_id=?, enrollment_date=?, status=? WHERE enrollment_id=?");
        $stmt->bind_param("iissi", $student_id, $course_id, $enrollment_date, $status, $enrollment_id);
        $stmt->execute();
        $stmt->close();

        header("Location: enrollments.php");
        exit();
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
            background-color: #a5e7d6;
            border: 1px solid black;
            margin: 20px;
            padding: 20px;
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
            background-color: #e4b9a5;
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
        <h1>Edit Enrollment</h1>
        <br>
        <form action="edit_enrollment.php?id=<?php echo $enrollment_id; ?>" method="POST">
            <label for="student_id">Student:</label>
            <select name="student_id" id="student_id" required>
                <?php
                    $result = $conn->query("SELECT s.student_id, u.name FROM students s JOIN users u ON s.user_id = u.user_id");
                    while($row = $result->fetch_assoc()){
                        $selected = "";
                        if($row['student_id'] == $enrollment['student_id']){
                            $selected = "selected";
                        }
                        echo "<option value='{$row['student_id']}' $selected>
                                {$row['student_id']} - {$row['name']}
                            </option>";
                    }
                ?>
            </select>
            <br><br>
            <label for="course_id">Course:</label>
            <select name="course_id" id="course_id" required>
                <?php
                    $result = $conn->query("SELECT course_id, course_name, course_code FROM courses");
                    while($row = $result->fetch_assoc()){
                        $selected = "";
                        if($row['course_id'] == $enrollment['course_id']){
                            $selected = "selected";
                        }
                        echo "<option value='{$row['course_id']}' $selected>
                                {$row['course_code']} - {$row['course_name']}
                            </option>";
                    }
                ?>
            </select>
            <br><br>
            <label for="enrollment_date">Enrollment Date:</label>
            <input type="date" name="enrollment_date" id="enrollment_date" value="<?php echo $enrollment['enrollment_date']; ?>" required>
            <br><br>
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="active" <?php if($enrollment['status'] == 'active') echo 'selected'; ?>>Active</option>
                <option value="completed" <?php if($enrollment['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                <option value="dropped" <?php if($enrollment['status'] == 'dropped') echo 'selected'; ?>>Dropped</option>
            </select>
            <br><br>
            <input type="submit" name="submit" value="Update Enrollment">
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