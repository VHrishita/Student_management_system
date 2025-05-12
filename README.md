# 📚 Student Management System (PHP + MySQL)

A web-based Student Management System built using **PHP**, **MySQL**, **HTML**, and **CSS**. It provides a role-based dashboard for **students** and **teachers**. Teachers can manage attendance, grades, and notes, while students can view their personal academic data in a simple and styled interface.

---

## 🔧 Features

### 👨‍🏫 Teacher Dashboard
- ✅ Add attendance for students
- 📝 Add grades (subject-wise)
- 📎 Upload notes (PDFs) for specific students
- 📋 Role-based login to secure access

### 👨‍🎓 Student Dashboard
- 📅 View attendance records with absent dates
- 🎓 View grades in a table
- 📥 Download subject-wise notes uploaded by the teacher

---

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3
- **Backend**: PHP (Vanilla)
- **Database**: MySQL
- **Server**: XAMPP / Apache

---

## 💾 Database Structure

### 1. `users`
| Field      | Type         | Description          |
|------------|--------------|----------------------|
| id         | int, PK      | User ID              |
| name       | varchar(100) | User's full name     |
| email      | varchar(100) | Login email          |
| password   | varchar(255) | Hashed password      |
| role       | varchar(20)  | 'student' or 'teacher'|

### 2. `attendance`
| Field      | Type         | Description           |
|------------|--------------|-----------------------|
| id         | int, PK      | Entry ID              |
| student_id | int          | FK to `users.id`      |
| subject    | varchar(100) | Subject name          |
| date       | date         | Date of class         |
| status     | varchar(10)  | Present/Absent        |
| teacher_id | int          | FK to `users.id`      |

### 3. `grades`
| Field      | Type         | Description           |
|------------|--------------|-----------------------|
| id         | int, PK      | Grade ID              |
| student_id | int          | FK to `users.id`      |
| subject    | varchar(100) | Subject name          |
| grade      | varchar(10)  | Grade value           |
| user_id    | int          | FK to `users.id` (teacher)|

### 4. `notes`
| Field      | Type         | Description              |
|------------|--------------|--------------------------|
| id         | int, PK      | Note ID                  |
| student_id | int          | FK to `users.id`         |
| title      | varchar(255) | Note title               |
| description| text         | Brief about the note     |
| filename   | varchar(255) | File name (PDF uploaded) |

---

## 🔐 Login Roles

- **Teacher**
  - Can manage student attendance, grades, and upload notes.
- **Student**
  - Can view their grades, attendance (with absent dates), and download uploaded notes.

---

## 🚀 How to Run

1. **Clone the repo:**
   ```bash
   git clone https://github.com/yourusername/student-management-system.git
   
2. Start XAMPP and import the MySQL tables via phpMyAdmin.

3. **Import the database:**
   - Create a database named student_system
   - Import the SQL file (if provided) or create tables using the structure above.
4. **Run the project** by placing it inside htdocs and navigating to:
    http://localhost/student-management-system/login.php

## 📁 Folder Structure

student-management-system/
├── css/
│   ├── student_dashboard.css
│   └── teacher_dashboard.css
├── uploads/          # Notes PDFs
├── login.php
├── signup.php
├── logout.php
├── db.php
├── student_dashboard.php
├── teacher_dashboard.php
├── attendance.php
├── grades.php
├── notes.php

## 📄 License

This project is for educational purposes only.
