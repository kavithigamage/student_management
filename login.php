<?php
    session_start();
    include "includes/db.php";

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if email exists
        if($result->num_rows > 0){
            // Get the user's database row
            $user = $result->fetch_assoc();

            // Verify entered password with hashed password
            if(password_verify($password, $user['password'])){
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                if($user['role'] == 'admin'){
                    header("Location: admin/dashboard.php");
                } else {
                    header("Location: student/dashboard.php");
                }
                exit();
            }
            else {
                echo "<script>alert('Invalid email or password');</script>";
            }
        }
        else {
            echo "<script>alert('Invalid email or password');</script>";
        }
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            text-align: center;
        }
        .container{
            width: 300px;
            background-color: lightcoral;
            margin: auto;
            padding: 30px;
            border-radius: 20px;
        }
        button{
            padding: 10px;
            background-color: blueviolet;
            color: white;
            font-size: 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover{
            background-color: darkblue;
            color: white;
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

   <h1>Welcome Back!</h1>
   <h2>Login to your account</h2>
    <div class="container">
        <form action="login.php" method="post">
            <label for="email">Email</label> <br>
            <input type="text" id="email" name="email"> <br><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password">
            <input type="button" onclick="togglePassword()" value="👁"> <br><br>

            <button name="login" id="login" value="login">Login</button>
        </form>

        <p>Don't have an account?</p>
        <a href="register.php">Register</a>
    </div>

    <br><a href="index.php">← Home</a>
</body>
</html>