<?php
    include "../includes/admin-auth.php";
    include "../includes/db.php";
    $user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/student_management/images/logo.png">
    <title>Student Hub | Admin</title>
    <style>
        td,th{
            padding: 10px;
            background-color: #a5e7d6;
            border: 1px solid black;
        }
        .content{
            margin: 20px;
        }
        .content a{
            text-decoration: none;
            background-color: #e4b9a5;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <?php
        include "../includes/admin-navbar.php";
    ?>
    <div class="content">
        <h1>Admin Management</h1>
        <br>
        <label for="search">Search:</label>
        <input type="text" id="search" oninput="liveSearch()">
        <br><br>
        <a href="add_admin.php">Add Admin</a>
        <br><br>
        <table border="1" id="tableID">
            <thead>
                <tr>
                    <th>Admin Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $result = $conn->query("SELECT user_id, name, email FROM users WHERE role = 'admin'");
                    while($row = $result->fetch_assoc()){
                        echo"<tr>
                            <td>{$row['user_id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>
                                <a href='edit_admin.php?id={$row['user_id']}'>Edit</a>";
                                if($row['user_id'] != $user_id){
                                    echo "<a href='delete_admin.php?id={$row['user_id']}' onclick=\"return confirm('Delete this admin record?')\">Delete</a>";
                                }
                        echo "</td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php
        include "../includes/footer.php";
    ?>
    <script src="../js/search.js"></script>
</body>
</html>
