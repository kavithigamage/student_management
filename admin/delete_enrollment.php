<?php
    include "../includes/db.php";
    $enrollment_id = (int)$_GET['id'];

    $stmt = $conn->prepare("DELETE FROM enrollments WHERE enrollment_id = ?");
    $stmt->bind_param("i", $enrollment_id);
    $stmt->execute();
    $stmt->close();


    header("Location: enrollments.php");
    exit();

?>