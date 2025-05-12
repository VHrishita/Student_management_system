<?php
session_start();
include('db.php');  // Ensure connection to the database

// Check if the user is logged in and is a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: index.php");  // Redirect if not logged in or not a student
    exit();
}

// Fetch notes for the student
$query = "SELECT * FROM notes";
$result = mysqli_query($conn, $query);
$notes = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Notes</title>
    <link rel="stylesheet" href="css/notes.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="attendance.php">Attendance</a>
        <a href="grades.php">Grades</a>
        <a href="notes.php">Notes</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h2 class="dashboard-title">Student Notes</h2>

        <!-- Display Notes -->
        <div class="notes-container">
            <?php if (count($notes) > 0): ?>
                <?php foreach ($notes as $note): ?>
                    <div class="note-card">
                        <h3><?= htmlspecialchars($note['title']); ?></h3>
                        <p><?= nl2br(htmlspecialchars($note['description'])); ?></p>
                        <a href="uploads/<?= htmlspecialchars($note['filename']); ?>" target="_blank">Download Note</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No notes available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
