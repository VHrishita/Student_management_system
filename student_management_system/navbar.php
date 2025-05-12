<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <div class="navbar-container">
        <div class="logo">
            <h2>Student Management</h2>
        </div>
        <ul class="navbar">
            <li><a href="index.php">Home</a></li>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="teacher_dashboard.php">Dashboard</a></li>
                <li><a href="add_attendance.php">Add Attendance</a></li>
                <li><a href="add_grades.php">Add Grades</a></li>
                <li><a href="add_notes.php">Add Notes</a></li>
            <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'student'): ?>
                <li><a href="student_dashboard.php">Dashboard</a></li>
                <li><a href="view_attendance.php">View Attendance</a></li>
                <li><a href="view_grades.php">View Grades</a></li>
                <li><a href="view_notes.php">View Notes</a></li>
            <?php endif; ?>

            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>
