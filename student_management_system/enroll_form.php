<!DOCTYPE html>
<html>
<head>
    <title>Course Enrollment</title>
    <link rel="stylesheet" href="css/enroll_form.css">
</head>
<body>

    <div class="container">
        <h2>Enroll in a Course</h2>
        <form action="submit_enrollment.php" method="POST">
            <label>Full Name</label>
            <input type="text" name="name" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Select Course</label>
            <select name="course" required>
                <option value="">-- Select --</option>
                <option value="Math">Web Development</option>
                <option value="Science">Data Science</option>
                <option value="Computer">Digital Marketing</option>
            </select>

            <button type="submit">Submit Enrollment</button>
        </form>
    </div>

</body>
</html>
