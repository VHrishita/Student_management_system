<!DOCTYPE html>
<html>
<head>
    <title>Enrollment Status</title>
    <link rel="stylesheet" href="css/submit_enrollment.css">
</head>
<body>
<div class="message-box">
<?php
$servername = "localhost";
$username = "root";
$password = "hrishita";
$dbname = "student_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "<h3>Error connecting to database</h3>";
    echo "<a href='enroll_form.php'>Try Again</a>";
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$course = $_POST['course'];

$sql = "INSERT INTO enrollments (name, email, course) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $course);

if ($stmt->execute()) {
    echo "<h3>Enrollment successful!</h3>";
    echo "<a href='index.php'>Go back to Home</a>";
} else {
    echo "<h3>Enrollment failed. Please try again.</h3>";
    echo "<a href='enroll_form.php'>Try Again</a>";
}

$stmt->close();
$conn->close();
?>
</div>
</body>
</html>
