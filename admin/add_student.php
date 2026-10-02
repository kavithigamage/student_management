<?php
    include "../includes/db.php";
    $errors = [];

    if(isset($_POST['submit'])){
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $student_number = trim($_POST['student_number']);
        $nic = trim($_POST['nic']);
        $mobile = trim($_POST['mobile']);
        $address = trim($_POST['address']);

        if( empty($name) || empty($nic) || empty($mobile) || empty($email) || empty($password) || empty($student_number) || empty($address) ){
            $errors[] = "All fields are required";
        }
        if(empty($errors)){
            // Insert into users table
            $stmt1 = $conn->prepare("INSERT INTO users(name, email, password, role) VALUES (?, ?, ?, ?)");
            $role = "student";
            $stmt1->bind_param("ssss", $name, $email, $password, $role);
            $stmt1->execute();
            // Get the newly created user_id - Get the ID that MySQL just automatically generated from the most recent INSERT query.
            $user_id = $conn->insert_id;
            $stmt1->close();

            // Insert into students table using the same user_id
            $stmt2 = $conn->prepare("INSERT INTO students(user_id, student_number, nic, mobile, address) VALUES (?, ?, ?, ?, ?)");
            $stmt2->bind_param("issss",$user_id,$student_number,$nic,$mobile, $address);
            $stmt2->execute();
            $stmt2->close();

            header("Location: students.php");
            exit();
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
        .content{
            margin: 20px;
        }
        .content form{
            width: 300px;
            margin-left: 20px;
            background-color: lightblue;
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
        <h1>Add Student</h1>
        <br>
        <form action="add_student.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br><br>
            <label for="student_number">Student Number:</label>
            <input type="text" name="student_number" id="student_number" required>
            <br><br>
            <label for="nic">NIC:</label>
            <input type="text" name="nic" id="nic" required>
            <br><br>
            <label for="mobile">Mobile:</label>
            <input type="text" name="mobile" id="mobile" required>
            <br><br>
            <label for="address">Address:</label>
            <textarea name="address" id="address" required></textarea>
            <br><br>
            <input type="submit" name="submit" value="Add Student">
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

