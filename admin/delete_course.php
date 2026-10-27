<?php

include "../includes/admin-auth.php";
include "../includes/db.php";

$course_id = (int) $_GET['id'];

// Check enrollments
$stmt1 = $conn->prepare("SELECT 1 FROM enrollments WHERE course_id = ? LIMIT 1");
$stmt1->bind_param("i", $course_id);
$stmt1->execute();

$has_enrollments = $stmt1->get_result()->num_rows > 0;
$stmt1->close();

// Check results
$stmt2 = $conn->prepare("SELECT 1 FROM results WHERE course_id = ? LIMIT 1");
$stmt2->bind_param("i", $course_id);
$stmt2->execute();
$has_results = $stmt2->get_result()->num_rows > 0;
$stmt2->close();

// Prevent deletion if dependent records exist
if ($has_enrollments || $has_results) {
    session_start();
    $_SESSION['error'] ="Cannot delete this course because enrollments or results exist.";
} else {

    // Delete course
    $conn->begin_transaction();
    try {
        $stmt3 = $conn->prepare("DELETE FROM courses WHERE course_id = ?");
        $stmt3->bind_param("i", $course_id);
        $stmt3->execute();
        $stmt3->close();

        $conn->commit();

        session_start();
        $_SESSION['success'] = "Course deleted successfully.";

    } catch (Throwable $e) {
        $conn->rollback();

        session_start();
        $_SESSION['error'] = "Unable to delete the course.";
    }
}

header("Location: course.php");
exit();
?>
