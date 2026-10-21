<?php
    include "../includes/admin-auth.php";
    include "../includes/db.php";
    $course_id = (int)$_GET['id'];

    $stmt = $conn->prepare("DELETE FROM courses WHERE course_id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $stmt->close();


    header("Location: course.php");
    exit();

?>
