<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/student_dashboard.css">
</head>
<body>
    <div class="navbar">
        <a href="attendance.php">Attendance</a>
        <a href="grades.php">Grades</a>
        <a href="notes.php">Notes</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($user['name']); ?>!</h1>
        <p>Here you can view and manage your student data.</p>
    </div>
</body>
</html>
