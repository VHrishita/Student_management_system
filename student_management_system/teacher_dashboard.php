<?php
session_start();
require_once 'db.php';

// Check if the user is logged in and is a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit();
}

$teacher_id = $_SESSION['user_id'];
$successMessage = "";

// Fetch students and subjects
$students = mysqli_query($conn, "SELECT id, name FROM users WHERE role = 'student'");
$subjects = ["Math", "Science", "English", "History", "Physics"]; // Example subjects

// Add attendance
if (isset($_POST['add_attendance'])) {
    if (isset($_POST['student_id_attendance'], $_POST['subject_attendance'], $_POST['date'], $_POST['status'])) {
        $student_id = $_POST['student_id_attendance'];
        $subject = $_POST['subject_attendance'];
        $date = $_POST['date'];
        $status = $_POST['status'];

        $stmt = $conn->prepare("INSERT INTO attendance (student_id, subject, date, status, teacher_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssi", $student_id, $subject, $date, $status, $teacher_id);
        if ($stmt->execute()) {
            $successMessage = "Attendance added successfully.";
        } else {
            $successMessage = "Error adding attendance: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $successMessage = "All attendance fields are required!";
    }
}

// Add grades
if (isset($_POST['add_grade'])) {
    if (isset($_POST['student_id_grade'], $_POST['subject_grade'], $_POST['grade'])) {
        $student_id = $_POST['student_id_grade'];
        $subject = $_POST['subject_grade'];
        $grade = $_POST['grade'];

        $stmt = $conn->prepare("INSERT INTO grades (student_id, subject, grade, user_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $student_id, $subject, $grade, $teacher_id);
        if ($stmt->execute()) {
            $successMessage = "Grade added successfully.";
        } else {
            $successMessage = "Error adding grade: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $successMessage = "All grade fields are required!";
    }
}

// Add notes
if (isset($_POST['add_notes'])) {
    if (isset($_POST['student_id_notes'], $_POST['title'], $_POST['description']) && isset($_FILES['file'])) {
        $student_id = $_POST['student_id_notes'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $filename = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];

        if (move_uploaded_file($file_tmp, "uploads/" . $filename)) {
            $stmt = $conn->prepare("INSERT INTO notes (student_id, title, description, filename) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $student_id, $title, $description, $filename);
            if ($stmt->execute()) {
                $successMessage = "Note uploaded successfully.";
            } else {
                $successMessage = "Error uploading note: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $successMessage = "Failed to upload file.";
        }
    } else {
        $successMessage = "All note fields are required!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="css/teacher_dashboard.css">
</head>
<body>
    <?php if ($successMessage): ?>
        <div class="floating-message"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <!-- Navbar -->
    <div class="navbar">
        <a href="teacher_dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h2 class="dashboard-title">Teacher Dashboard</h2>

        <!-- Add Attendance Form -->
        <div class="form-container">
            <h3>Add Attendance</h3>
            <form action="teacher_dashboard.php" method="POST">
                <label for="student_id_attendance">Select Student</label>
                <select name="student_id_attendance" required>
                    <option value="">--Select a Student--</option>
                    <?php
                    mysqli_data_seek($students, 0); // Reset pointer
                    while ($student = mysqli_fetch_assoc($students)): ?>
                        <option value="<?= $student['id'] ?>"><?= htmlspecialchars($student['name']) ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="subject_attendance">Select Subject</label>
                <select name="subject_attendance" required>
                    <option value="">--Select Subject--</option>
                    <?php foreach ($subjects as $subject): ?>
                        <option value="<?= $subject ?>"><?= htmlspecialchars($subject) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="date">Date</label>
                <input type="date" name="date" required>

                <label for="status">Attendance Status</label>
                <select name="status" required>
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                </select>

                <button type="submit" name="add_attendance" class="btn">Add Attendance</button>
            </form>
        </div>

        <!-- Add Grades Form -->
        <div class="form-container">
            <h3>Add Grades</h3>
            <form action="teacher_dashboard.php" method="POST">
                <label for="student_id_grade">Select Student</label>
                <select name="student_id_grade" required>
                    <option value="">--Select a Student--</option>
                    <?php
                    mysqli_data_seek($students, 0); // Reset pointer
                    while ($student = mysqli_fetch_assoc($students)): ?>
                        <option value="<?= $student['id'] ?>"><?= htmlspecialchars($student['name']) ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="subject_grade">Select Subject</label>
                <select name="subject_grade" required>
                    <option value="">--Select Subject--</option>
                    <?php foreach ($subjects as $subject): ?>
                        <option value="<?= $subject ?>"><?= htmlspecialchars($subject) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="grade">Grade</label>
                <input type="text" name="grade" placeholder="Grade" required>

                <button type="submit" name="add_grade" class="btn">Add Grade</button>
            </form>
        </div>

        <!-- Add Notes Form -->
        <div class="form-container">
            <h3>Upload Notes</h3>
            <form action="teacher_dashboard.php" method="POST" enctype="multipart/form-data">
                <label for="student_id_notes">Select Student</label>
                <select name="student_id_notes" required>
                    <option value="">--Select a Student--</option>
                    <?php
                    mysqli_data_seek($students, 0); // Reset pointer
                    while ($student = mysqli_fetch_assoc($students)): ?>
                        <option value="<?= $student['id'] ?>"><?= htmlspecialchars($student['name']) ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="title">Note Title</label>
                <input type="text" name="title" placeholder="Note Title" required>

                <label for="description">Description</label>
                <textarea name="description" placeholder="Description" required></textarea>

                <label for="file">Select File</label>
                <input type="file" name="file" required>

                <button type="submit" name="add_notes" class="btn">Upload Note</button>
            </form>
        </div>
    </div>
</body>
</html>
