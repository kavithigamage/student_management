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
</head>
<body>
   <?php
        include "includes/header.php";
    ?>

   <h1>Welcome Back!</h1>
   <h2>Login to your account</h2>
    <div class="container">
        <form action="" method="post">
            <label for="email">Email</label> <br>
            <input type="text" id="email" name="email"> <br><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password"><br><br>

            <button name="login" id="login" value="login">Login</button>
        </form>

        <p>Don't have an account?</p>
        <a href="register.php">Register</a>
    </div>

    <br><a href="index.php">← Home</a>
</body>
</html>