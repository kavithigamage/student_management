<?php
    include "../includes/db.php";
    $student_id = (int)$_GET['id'];

    $stmt1 = $conn->prepare("SELECT user_id FROM students WHERE student_id = ?");
    $stmt1->bind_param("i", $student_id);
    $stmt1->execute();
    $student = $stmt1->get_result()->fetch_assoc();
    $stmt1->close();
    if (!$student) {
        die("Student not found");
    }
    $user_id = $student['user_id'];

    $stmt2 = $conn->prepare("DELETE FROM students WHERE student_id = ?");
    $stmt2->bind_param("i", $student_id);
    $stmt2->execute();
    $stmt2->close();

    $stmt3 = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt3->bind_param("i", $user_id);
    $stmt3->execute();
    $stmt3->close();

    header("Location: students.php");
    exit();

?>