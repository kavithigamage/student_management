<?php
    include "../includes/student-auth.php";
    include "../includes/db.php";
    $user_id = $_SESSION['user_id'];

    $stmt2 = $conn->prepare("SELECT name, email, password FROM users WHERE user_id = ?");
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    $user = $stmt2->get_result()->fetch_assoc();
    $stmt2->close();

    $stmt1 = $conn->prepare("SELECT nic, mobile, student_number, address FROM students WHERE user_id = ?");
    $stmt1->bind_param("i", $user_id);
    $stmt1->execute();
    $student = $stmt1->get_result()->fetch_assoc();
    $stmt1->close();
    if (!$student) {
        die("Student not found");
    }

    if(isset($_POST['submit'])){
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $student_number = trim($_POST['student_number']);
        $nic = trim($_POST['nic']);
        $mobile = trim($_POST['mobile']);
        $address = trim($_POST['address']);

        if(empty($password)){
            // If password is empty, keep the old password
            $password = $user['password'];
        }
        else{
            // Hash the new password
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
        // Insert into users table
        $stmt2 = $conn->prepare("UPDATE users SET name=?, email=?, password=? WHERE user_id=?");
        $stmt2->bind_param("sssi", $name, $email, $password, $user_id);
        $stmt2->execute();
        $stmt2->close();

        // Insert into students table using the same user_id
        $stmt3 = $conn->prepare("UPDATE students SET student_number=?, nic=?, mobile=?, address=? WHERE user_id=?");
        $stmt3->bind_param("ssssi",$student_number, $nic, $mobile, $address, $user_id);
        $stmt3->execute();
        $stmt3->close();

        header("Location: dashboard.php");
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
            background-color: #8df1bf;
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
            padding: 10px ;
        }
        form p{
            font-size: 15px;
            color: red;
        }
    </style>
    <script>
        function togglePassword() {
            let password = document.getElementById("password");
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
    </script>
</head>
<body>
    <?php
        include "../includes/header.php";
    ?>
    <?php
        include "../includes/student-navbar.php";
    ?>
    <div class="content">
        <h1>Profile</h1>
        <br>
        <form action="profile.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <br><br>
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password">
            <input type="button" onclick="togglePassword()" value="👁">
            <p>Leave blank if you don't want to change your password.</p>
            <br>
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
            <input type="submit" name="submit" value="Edit Profile">
        </form>
        <br><br>

        <a href="dashboard.php">Dashboard</a>
        <br>
    </div>
    <?php
        include "../includes/footer.php";
    ?>
</body>
</html>

