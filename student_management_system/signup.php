<?php
include('db.php');
$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        $error = "All fields are required!";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed', '$role')";
        if (mysqli_query($conn, $query)) {
            $success = "Account created! You can now <a href='index.php'>login</a>.";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
      body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #c1a4e0, #2575fc);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.container {
    width: 350px;
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center; /* Center form elements horizontally */
    justify-content: center; /* Center content vertically within the container */
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

input, select, button {
    width: 100%;  /* Ensure inputs and buttons take up full width */
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background: #0056b3;
}

.error, .success {
    text-align: center;
    margin-top: 10px;
}

.error { color: red; }
.success { color: green; }

.link {
    text-align: center;
    margin-top: 15px;
}

.signup-link a {
    color: #007bff;
    text-decoration: none;
}

.signup-link a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Signup</h2>
        <?php if ($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
        <?php if ($success): ?><p class="success"><?= $success ?></p><?php endif; ?>
        <form action="signup.php" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
            <button type="submit" class="btn">Signup</button>
        </form>
        <div class="link">
            <p>Already have an account? <a href="index.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
