<?php
    include "../includes/admin-auth.php";
    include "../includes/db.php";
    $result_id = (int)$_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM results WHERE result_id = ?");
    $stmt->bind_param("i", $result_id);
    $stmt->execute();
    $result_selected = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if (!$result_selected) {
        die("Result not found");
    }

    if(isset($_POST['submit'])){
        $student_id = trim($_POST['student_id']);
        $course_id = trim($_POST['course_id']);
        $marks = trim($_POST['marks']);
        $grade = trim($_POST['grade']);

        // Update the result
        $stmt = $conn->prepare("UPDATE results SET student_id=?, course_id=?, marks=?, grade=? WHERE result_id=?");
        $stmt->bind_param("iiisi", $student_id, $course_id, $marks, $grade, $result_id);
        $stmt->execute();
        $stmt->close();

        header("Location: results.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/student_management/images/logo.png">
    <title>Student Hub | Edit Result</title>
    <link rel="stylesheet" href="/student_management/css/style.css">
    <style>
        .content{
            margin: 20px;
            background-color: #a5e7d6;
            border: 1px solid black;
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
        include "../includes/admin-navbar.php";
    ?>
    <div class="content">
        <h1>Edit Result</h1>
        <br>
        <form action="edit_result.php?id=<?php echo $result_id; ?>" method="POST">
            <label for="student_id">Student:</label>
            <select name="student_id" id="student_id" required>
                <?php
                    $result = $conn->query("SELECT s.student_id, u.name FROM students s JOIN users u ON s.user_id = u.user_id");
                    while($row = $result->fetch_assoc()){
                        $selected = "";
                        if($row['student_id'] == $result_selected['student_id']){
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
                        if($row['course_id'] == $result_selected['course_id']){
                            $selected = "selected";
                        }
                        echo "<option value='{$row['course_id']}' $selected>
                                {$row['course_code']} - {$row['course_name']}
                            </option>";
                    }
                ?>
            </select>
            <br><br>
            <label for="marks">Marks:</label>
            <input type="number" name="marks" id="marks" min="0" max="100" step="0.01" value="<?php echo $result_selected['marks']; ?>" required>
            <br><br>
            <label for="grade">Grade:</label>
            <select name="grade" id="grade" required>
                <option value="A+" <?php if($result_selected['grade'] == 'A+') echo 'selected'; ?>>A+</option>
                <option value="A" <?php if($result_selected['grade'] == 'A') echo 'selected'; ?>>A</option>
                <option value="A-" <?php if($result_selected['grade'] == 'A-') echo 'selected'; ?>>A-</option>
                <option value="B+" <?php if($result_selected['grade'] == 'B+') echo 'selected'; ?>>B+</option>
                <option value="B" <?php if($result_selected['grade'] == 'B') echo 'selected'; ?>>B</option>
                <option value="B-" <?php if($result_selected['grade'] == 'B-') echo 'selected'; ?>>B-</option>
                <option value="C+" <?php if($result_selected['grade'] == 'C+') echo 'selected'; ?>>C+</option>
                <option value="C" <?php if($result_selected['grade'] == 'C') echo 'selected'; ?>>C</option>
                <option value="C-" <?php if($result_selected['grade'] == 'C-') echo 'selected'; ?>>C-</option>
                <option value="D" <?php if($result_selected['grade'] == 'D') echo 'selected'; ?>>D</option>
                <option value="F" <?php if($result_selected['grade'] == 'F') echo 'selected'; ?>>F</option>
            </select>
            <br><br>
            <input type="submit" name="submit" value="Update Result">
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