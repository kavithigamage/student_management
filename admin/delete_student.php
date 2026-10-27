
<?php

include "../includes/admin-auth.php";
include "../includes/db.php";

$student_id = (int) $_GET['id'];

// Get the user's ID
$stmt1 = $conn->prepare("SELECT user_id FROM students WHERE student_id = ?");
$stmt1->bind_param("i", $student_id);
$stmt1->execute();
$student = $stmt1->get_result()->fetch_assoc();
$stmt1->close();

$user_id = (int) $student['user_id'];

// Check enrollments
$stmt4 = $conn->prepare("SELECT 1 FROM enrollments WHERE student_id = ? LIMIT 1");
$stmt4->bind_param("i", $student_id);
$stmt4->execute();

$has_enrollments = $stmt4->get_result()->num_rows > 0;
$stmt4->close();

// Check results
$stmt5 = $conn->prepare("SELECT 1 FROM results WHERE student_id = ? LIMIT 1");
$stmt5->bind_param("i", $student_id);
$stmt5->execute();
$has_results = $stmt5->get_result()->num_rows > 0;
$stmt5->close();

// Prevent deletion if dependent records exist
if ($has_enrollments || $has_results) {
    session_start();
    $_SESSION['error'] ="Cannot delete this student because enrollments or results exist.";
} else {

    // Delete student and user together
    $conn->begin_transaction();
    try {
        $stmt2 = $conn->prepare("DELETE FROM students WHERE student_id = ?");
        $stmt2->bind_param("i", $student_id);
        $stmt2->execute();
        $stmt2->close();

        $stmt3 = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt3->bind_param("i", $user_id);
        $stmt3->execute();
        $stmt3->close();

        $conn->commit();

        session_start();
        $_SESSION['success'] = "Student deleted successfully.";

    } catch (Throwable $e) {
        $conn->rollback();

        session_start();
        $_SESSION['error'] = "Unable to delete the student.";
    }
}

header("Location: students.php");
exit();
?>
