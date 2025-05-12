<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $filename = $_FILES['file']['name'];
    $temp_name = $_FILES['file']['tmp_name'];

    // Move uploaded file to the 'uploads' directory
    $upload_dir = "uploads/";
    $upload_file = $upload_dir . basename($filename);

    if (move_uploaded_file($temp_name, $upload_file)) {
        // Insert note data into the database
        $query = "INSERT INTO notes (title, filename) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $title, $filename);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div class="container">
        <h1>Add Notes</h1>

        <form action="add_notes.php" method="POST" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" name="title" required>

            <label for="file">Upload File (PDF only):</label>
            <input type="file" name="file" accept="application/pdf" required>

            <button type="submit">Upload Note</button>
        </form>
    </div>
</body>
</html>
