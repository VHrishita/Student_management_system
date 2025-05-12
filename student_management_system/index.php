<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/welcome.css">
</head>
<body>

    <nav>
        <div class="navbar-container">
            <h1>Student Sphere</h1>
            <ul class="navbar">
                <li><a href="#courses">Courses</a></li>
                <li><a href="#teachers">Teachers</a></li>
                <li><a href="#achievements">Achievements</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>

    <section id="courses">
        <h2>Our Courses</h2>
        <div class="course-container">
            <div class="course-card">
                <img src="images/web_dev.jpg" alt="Course 1">
                <h3>Web Development</h3>
                <p>Learn to build websites with HTML, CSS, JS</p>
                <a href="enroll_form.php" class="enroll-btn">Enroll Now</a>
            </div>
            <div class="course-card">
                <img src="images/data_science.jpg" alt="Course 2">
                <h3>Data Science</h3>
                <p>Explore data analysis and machine learning</p>
                <a href="enroll_form.php" class="enroll-btn">Enroll Now</a>
            </div>
            <div class="course-card">
                <img src="images/digital_marketing.jpg" alt="Course 3">
                <h3>Digital Marketing</h3>
                <p>Explore the world of Digital marketing</p>
                <a href="enroll_form.php" class="enroll-btn">Enroll Now</a>
            </div>
        </div>
    </section>

    <!-- Teachers Section -->
    <section id="teachers">
        <h2>Our Teachers</h2>
        <div class="teacher-container">
            <div class="teacher-card">
                <img src="images/john_doe.jpg" alt="Teacher 1">
                <h3>Prof. John Doe</h3>
                <p>Expert in Web & Backend Development</p>
            </div>
            <div class="teacher-card">
                <img src="images/jane_smith2.jpg" alt="Teacher 2">
                <h3>Dr. Jane Smith</h3>
                <p>Data Science and AI Specialist</p>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section id="achievements" class="achievements-section">
        <h2>Our Achievements</h2>
        <div class="achievement-card">
            <h3>1000+ Students</h3>
            <p>We have helped thousands of students achieve their dreams.</p>
        </div>
        <div class="achievement-card">
            <h3>Top Rated</h3>
            <p>Our courses are rated 4.9/5 by learners across the globe.</p>
        </div>
        <div class="achievement-card">
            <h3>500+ Placements</h3>
            <p>Highest Package of 30 LPA offered through Placements.</p>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials-section">
        <h2>What Our Students Say</h2>
        <div class="testimonial-card">
            <p>“This platform transformed my career path! Tremendous help”</p>
            <h4>- Aisha M.</h4>
        </div>
        <div class="testimonial-card">
            <p>“Amazing teachers and very helpful material.”</p>
            <h4>- Rohan D.</h4>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Student Management System. All rights reserved.</p>
    </footer>

</body>
</html>
