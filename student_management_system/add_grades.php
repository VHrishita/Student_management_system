<?php
session_start();
require_once 'db.php';

// Get the current user's ID from the session
$user_id = $_SESSION['user_id'];

// Fetch all students from the database to assign grades
$query = "SELECT * FROM users WHERE role = 'student'";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_grades'])) {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];

    // Prepare the query to insert the grade
    $query = "INSERT INTO grades (user_id, subject, grade, student_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isii", $user_id, $subject, $grade, $student_id); // Bind variables
    
    if ($stmt->execute()) {
        echo "Grade added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Grades</title>
    <link rel="stylesheet" href="css/grade.css">
</head>
<body>
    
    <div class="container">
        <h1>Add Grades</h1>

        <form action="add_grades.php" method="POST">
            <label for="student_id">Select Student:</label>
            <select name="student_id" required>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>

            <label for="subject">Subject:</label>
            <input type="text" name="subject" required>

            <label for="grade">Grade:</label>
            <input type="text" name="grade" required>

            <button type="submit" name="add_grades">Add Grade</button>
        </form>
    </div>
</body>
</html>
