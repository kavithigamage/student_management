<?php
    include "../includes/admin-auth.php";
    include "../includes/db.php";
    $student_id = (int)$_GET['id'];

    $stmt1 = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt1->bind_param("i", $student_id);
    $stmt1->execute();
    $student = $stmt1->get_result()->fetch_assoc();
    $stmt1->close();
    if (!$student) {
        die("Student not found");
    }
    $user_id = $student['user_id'];
    $stmt2 = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    $user = $stmt2->get_result()->fetch_assoc();
    $stmt2->close();

    if(isset($_POST['submit'])){
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $student_number = trim($_POST['student_number']);
        $nic = trim($_POST['nic']);
        $mobile = trim($_POST['mobile']);
        $address = trim($_POST['address']);

        // Insert into users table
        $stmt1 = $conn->prepare("UPDATE users SET name=?, email=?, password=? WHERE user_id=?");
        $stmt1->bind_param("sssi", $name, $email, $password, $user_id);
        $stmt1->execute();
        $stmt1->close();

        // Insert into students table using the same user_id
        $stmt2 = $conn->prepare("UPDATE students SET student_number=?, nic=?, mobile=?, address=? WHERE user_id=?");
        $stmt2->bind_param("ssssi",$student_number, $nic, $mobile, $address, $user_id);
        $stmt2->execute();
        $stmt2->close();

        header("Location: students.php");
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
        <h1>Edit Student</h1>
        <br>
        <form action="edit_student.php?id=<?php echo $student_id; ?>" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($user['password']); ?>" required>
            <br><br>
            <label for="student_number">Student Number:</label>
            <input type="text" name="student_number" id="student_number" value="<?php echo htmlspecialchars($student['student_number']); ?>" required>
            <br><br>
            <label for="nic">NIC:</label>
            <input type="text" name="nic" id="nic" value="<?php echo htmlspecialchars($student['nic']); ?>" required>
            <br><br>
            <label for="mobile">Mobile:</label>
            <input type="text" name="mobile" id="mobile" value="<?php echo htmlspecialchars($student['mobile']); ?>" required>
            <br><br>
            <label for="address">Address:</label>
            <textarea name="address" id="address" required><?php echo htmlspecialchars($student['address']); ?></textarea>
            <br><br>
            <input type="submit" name="submit" value="Update Student">
        </form>
        <br><br>

        <a href="students.php">Back to Students</a>
        <br>
    </div>
    <?php
        include "../includes/footer.php";
    ?>
</body>
</html>