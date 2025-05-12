<?php
session_start();
require_once 'db.php';

// Check if the user is logged in and is a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch attendance records for the logged-in student
$query = "SELECT subject, date, status FROM attendance WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$attendance = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendance[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
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
        <h2 class="dashboard-title">Your Attendance</h2>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($attendance) > 0): ?>
                        <?php foreach ($attendance as $entry): ?>
                            <tr>
                                <td><?= htmlspecialchars($entry['subject']); ?></td>
                                <td><?= htmlspecialchars($entry['date']); ?></td>
                                <td><?= htmlspecialchars($entry['status']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No attendance records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
