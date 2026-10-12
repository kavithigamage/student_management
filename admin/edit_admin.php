<?php
    include "../includes/admin-auth.php";
    include "../includes/db.php";
    $admin_id = (int)$_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ? AND role = 'admin'");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if (!$admin) {
        die("Admin not found");
    }

    if(isset($_POST['submit'])){
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Update the admin
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, password=? WHERE user_id=? AND role = 'admin'");
        $stmt->bind_param("sssi", $name, $email, $hashed_password, $admin_id);
        $stmt->execute();
        $stmt->close();

        header("Location: admins.php");
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
            margin: 20px;
            background-color: #a5e7d6;
            border: 1px solid black;
            padding: 20px;
        }
        .content form{
            width: 350px;
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
        include "../includes/admin-navbar.php";
    ?>
    <div class="content">
        <h1>Edit Admin</h1>
        <br>
        <form action="edit_admin.php?id=<?php echo $admin_id; ?>" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($admin['name']); ?>" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <input type="button" onclick="togglePassword()" value="👁">
            <br><br>
            <input type="submit" name="submit" value="Update Admin">
        </form>
        <br><br>

        <a href="admins.php">Back to Admin</a>
        <br>
    </div>
    <?php
        include "../includes/footer.php";
    ?>
</body>
</html>