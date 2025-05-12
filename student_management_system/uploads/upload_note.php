<?php
require_once "includes/auth.php";
require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['note'])) {
    $title = $_POST['title'];
    $file = $_FILES['note'];
    $filename = basename($file['name']);
    $target = "uploads/" . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO notes (title, filename) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $filename);
        $stmt->execute();
        $stmt->close();
        echo "Uploaded!";
    } else {
        echo "Upload failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Note</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-container">
    <h2>Upload New Note (PDF)</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="title" required placeholder="Title"><br>
        <input type="file" name="note" accept="application/pdf" required><br>
        <button type="submit">Upload</button>
    </form>
</div>
</body>
</html>
