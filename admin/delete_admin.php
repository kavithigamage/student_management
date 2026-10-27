<?php
    include "../includes/admin-auth.php";
    include "../includes/db.php";
    $admin_id = (int)$_GET['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ? AND role = 'admin'");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $stmt->close();


    header("Location: admins.php");
    exit();

?>