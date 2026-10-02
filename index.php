<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .hero{
            display: flex;
            flex-direction: row;

            background-color: rgb(4, 63, 4);
            margin: 5px;
            border-radius: 5px;
            padding: 15px;

        }
        .hero .content{
            flex: 1;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 5px;
            color: white;
        }
        .hero img{
            width: 500px;
        }
        .hero-btn{
            display: inline-block;
            text-decoration: none;
            padding: 10px;
            margin-left: 80px;
            font-size: 20px;
            background-color: lightgreen;
            color: black;
            border-radius: 8px;
            border: 1px solid black;
            cursor: pointer;
        }
        .hero-btn:hover{
            background-color: lightseagreen;
            color: white;
        }
        .featuresh1{
            text-align: center;
            margin: 10px;

        }
        .features{
            display: flex;
            flex-direction: row;
            margin: 10px;
            flex-wrap: wrap;
        }
        .features div{
            background-color: lightpink;
            text-align: center;
            flex: 1;
            border-radius: 10px;
            margin-left: 15px;
            padding: 15px;
        }
        p{
            font-size: 16px;
        }
    </style>
</head>
<body>   
    <?php
        include "includes/header.php";
    ?>

    <div class="hero">
        <div class="content">
            <h1>MANAGE YOUR ACADEMIC JOURNEY</h1> <br>
            <p>Manage courses, enrollements, and results easily from one place.</p>
            <br> <br>
            <a href="login.php" class="hero-btn">Login</a>
            <a href="register.php" class="hero-btn">Register</a>
        </div>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUaUfbGCUCuCKh6QRxgeDz4FNFzOvc2hDxKYQ2uayfsA&s=10">
    </div>

    <h1 class="featuresh1">FEATURES</h1>
    <div class="features">
        <div>
            <h2>📚 Course Management</h2><br>
            <p>Browse available courses and view course information.</p>
        </div>
        <div>
            <h2>📝 Easy Enrollment</h2><br>
            <p>Enroll in courses through your student account.</p>
        </div>
        <div>
            <h2>📊 View Results</h2><br>
            <p>Access your marks and grades in one place.</p>
        </div>
        <div>
            <h2>👤 Student Profile</h2><br>
            <p>Manage and view your personal information.</p>
        </div>
    </div>

    <?php
        include "includes/footer.php";
    ?>
</body>
</html>