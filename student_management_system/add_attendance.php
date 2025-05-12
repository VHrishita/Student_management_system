
<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];

    $insert_query = "INSERT INTO attendance (user_id, date, status) VALUES (?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("iss", $student_id, $attendance_date, $status);
    if ($insert_stmt->execute()) {
        $message = "Attendance added successfully!";
    } else {
        $message = "Error adding attendance!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Attendance</title>
    <link rel="stylesheet" href="css/attendance.css">
</head>
<body>
    <div class="container">
        <h2>Add Attendance</h2>
        <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
        <form action="add_attendance.php" method="POST">
            <label for="student_id">Select Student</label>
            <select name="student_id" required>
                <option value="">Select a student</option>
                <!-- Add options dynamically as in the previous examples -->
            </select>
            <label for="attendance_date">Date</label>
            <input type="date" name="attendance_date" required>
            <label for="status">Status</label>
            <select name="status" required>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
            </select>
            <button type="submit" class="btn">Add Attendance</button>
        </form>
    </div>
</body>
</html>
