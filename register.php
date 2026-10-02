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
</head>
<body>
    <?php
        include "includes/header.php";
    ?>

   <h1>Create Your Account</h1>
   <h2>Register to access studentHub</h2>
    <div class="container">
        <form action="" method="post">
            <label for="name">Full Name</label> <br>
            <input type="text" id="name" name="name"> <br><br>

            <label for="email">Email</label> <br>
            <input type="text" id="email" name="email"> <br><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password"><br><br>

            <label for="confirm-password">Confirm Password</label><br>
            <input type="password" id="confirm-password" name="confirm-password"><br><br>

            <button name="register" id="register" value="register">Register</button>
        </form>

        <p>Already have an account?</p>
        <a href="login.php">Login</a>
    </div>

    <br><a href="index.php">← Home</a>
</body>
</html>