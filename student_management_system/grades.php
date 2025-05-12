<?php
// Include database connection
require_once 'db.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch the grades for the logged-in student from the database
$query = "SELECT subject, grade FROM grades WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if grades are found
if ($result->num_rows > 0) {
    $grades = [];
    while ($row = $result->fetch_assoc()) {
        $grades[] = $row;  // Store each grade record
    }
} else {
    $grades = [];  // If no grades are found, set as empty array
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades</title>
    <link rel="stylesheet" href="css/grade.css">
</head>
<body>
     <div class="navbar">
        <a href="attendance.php">Attendance</a>
        <a href="grades.php">Grades</a>
        <a href="notes.php">Notes</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <h2>Your Grades</h2>

<!-- Subject Filter Dropdown -->
<div class="search-bar">
    <label for="subjectFilter">Filter by Subject:</label>
    <select id="subjectFilter" onchange="filterGrades()">
        <option value="all">All Subjects</option>
        <?php
        $subjects = [];
        foreach ($grades as $entry) {
            if (!in_array($entry['subject'], $subjects)) {
                $subjects[] = $entry['subject'];
                echo '<option value="' . htmlspecialchars($entry['subject']) . '">' . htmlspecialchars($entry['subject']) . '</option>';
            }
        }
        ?>
    </select>
</div>


        <!-- Grades Table -->
        <div class="card">
            <table id="gradeTable">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($grades) > 0): ?>
                        <?php foreach ($grades as $entry): ?>
                            <tr>
                                <td><?= $entry['subject'] ?></td>
                                <td><?= $entry['grade'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">No grades available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<script>
function filterGrades() {
    const filter = document.getElementById("subjectFilter").value.toLowerCase();
    const table = document.getElementById("gradesTable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        const subjectCell = rows[i].getElementsByTagName("td")[0]; // subject column
        if (subjectCell) {
            const subject = subjectCell.textContent.trim().toLowerCase();
            if (filter === "all" || subject === filter) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
}
</script>


</body>
</html>
