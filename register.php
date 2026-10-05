<?php
    include "includes/db.php";

    if(isset($_POST['register'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $role = 'student'; // Default role for new users

        if($password !== $confirm_password){
            echo "<script>alert('Passwords do not match!');</script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt1 = $conn->prepare("INSERT INTO users(name, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt1->bind_param("ssss", $name, $email, $hashed_password, $role);
            

            if($stmt1->execute()){
                // Get the newly created user ID
                $user_id = $conn->insert_id;

                // Create student record using the user ID
                $stmt2 = $conn->prepare("INSERT INTO students(user_id) VALUES (?)");
                $stmt2->bind_param("i", $user_id);
                $stmt2->execute();
                $stmt2->close();
                
                echo "<script>alert('Registration successful! Please login.'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Error: ". $stmt1->error ."');</script>";
            }
            $stmt1->close();
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
        *{
            text-align: center;
        }
        .container{
            width: 300px;
            background-color: lightblue;
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
            let confirmPassword = document.getElementById("confirm-password");
            if (confirmPassword.type === "password") {
                confirmPassword.type = "text";
            } else {
                confirmPassword.type = "password";
            }
        }
        function validateForm() {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirm-password").value;
            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }
            return true;
        }   

    </script>
</head>
<body>
    <?php
        include "includes/header.php";
    ?>

   <h1>Create Your Account</h1>
   <h2>Register to access studentHub</h2>
    <div class="container">
        <form action="register.php" method="post">
            <label for="name">Full Name</label> <br>
            <input type="text" id="name" name="name"> <br><br>

            <label for="email">Email</label> <br>
            <input type="text" id="email" name="email"> <br><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password">
            <input type="button" onclick="togglePassword()" value="👁"> <br><br>

            <label for="confirm-password">Confirm Password</label><br>
            <input type="password" id="confirm-password" name="confirm-password">
            <input type="button" onclick="togglePassword()" value="👁"> <br><br>

            <button name="register" id="register" value="register" onclick="return validateForm()">Register</button>
        </form>

        <p>Already have an account?</p>
        <a href="login.php">Login</a>
    </div>

    <br><a href="index.php">← Home</a>
</body>
</html>