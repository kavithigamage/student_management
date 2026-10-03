<?php
    
    include "../includes/admin-auth.php";
    include "../includes/db.php";
    $result_id = (int)$_GET['id'];

    $stmt = $conn->prepare("DELETE FROM results WHERE result_id = ?");
    $stmt->bind_param("i", $result_id);
    $stmt->execute();
    $stmt->close();

    header("Location: results.php");
    exit();

?>