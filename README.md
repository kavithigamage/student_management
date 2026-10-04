# Student Course Management System

## About

The Student Course Management System is a web-based application developed to manage students, courses, enrollments, and academic results.

The system provides separate access for **administrators** and **students** using authentication, sessions, and role-based access control.

This project was developed as a university Software Engineering project using PHP and MySQL with XAMPP.

---

## Features

### Admin Features

* Admin login
* Admin dashboard
* Admin management
* Student management
* Course management
* Enrollment management
* Result management
* Add, view, edit, and delete records
* View recent students and enrollments
* Manage student accounts

### Student Features

* Student registration
* Student login and logout
* Student dashboard
* View available courses
* View enrolled courses
* View academic results
* View GPA
* Update profile information
* Change password

### Authentication and Security

* User login and logout
* PHP session management
* Role-based access control
* Separate admin and student access protection
* Password hashing using PHP `password_hash()`
* Password verification using `password_verify()`
* Duplicate email validation
* Prepared SQL statements

---

## Technologies Used

### Frontend

* HTML
* CSS
* JavaScript

### Backend

* PHP

### Database

* MySQL

### Development Environment

* XAMPP
* Apache
* phpMyAdmin

### Version Control

* Git
* GitHub

---

## User Roles

The system contains two main user roles.

| Role    | Description                                                               |
| ------- | ------------------------------------------------------------------------- |
| Admin   | Manages students, courses, enrollments, results, and other administrators |
| Student | Views courses, enrollments, results, GPA, and manages their profile       |

---

## Project Structure

```text
student_management/
│
├── index.php
├── login.php
├── register.php
├── logout.php
│
├── admin/
│   ├── dashboard.php
│   ├── students.php
│   ├── add_student.php
│   ├── edit_student.php
│   ├── delete_student.php
│   ├── courses.php
│   ├── add_course.php
│   ├── edit_course.php
│   ├── delete_course.php
│   ├── enrollments.php
│   ├── add_enrollment.php
│   ├── edit_enrollment.php
│   ├── delete_enrollment.php
│   ├── results.php
│   ├── add_result.php
│   ├── edit_result.php
│   ├── delete_result.php
│   └── add_admin.php
│
├── student/
│   ├── dashboard.php
│   ├── profile.php
│   ├── courses.php
│   ├── my_courses.php
│   └── results.php
│
├── includes/
│   ├── db.php
│   ├── header.php
│   ├── navbar.php
│   ├── admin-navbar.php
│   ├── student-navbar.php
│   ├── footer.php
│   ├── auth.php
│   ├── admin-auth.php
│   └── student-auth.php
│
├── css/
│   └── style.css
│
├── js/
│   └── script.js
│
└── images/
```

---

## Database

The application uses a MySQL database named:

```text
student_management
```

The database contains five main tables:

### 1. users

Stores login and account information.

Main fields:

* `user_id`
* `name`
* `email`
* `password`
* `role`

### 2. students

Stores additional information about students.

Main fields:

* `student_id`
* `user_id`
* `student_number`
* `nic`
* `mobile`
* `address`

### 3. courses

Stores course information.

Main fields:

* `course_id`
* `course_code`
* `course_name`
* `credits`
* `description`

### 4. enrollments

Stores student course enrollments.

Main fields:

* `enrollment_id`
* `student_id`
* `course_id`
* `enrollment_date`
* `status`

### 5. results

Stores student academic results.

Main fields:

* `result_id`
* `student_id`
* `course_id`
* `marks`
* `grade`

---

## Database Relationships

```text
users
  │
  │ 1
  │
  │ 1
students
  │
  ├──────────────┐
  │              │
  │              │
  ▼              ▼
enrollments    results
  │              │
  │              │
  ▼              ▼
courses        courses
```

A student account is connected to a student profile through `user_id`.

Enrollments connect students with courses.

Results connect students with courses and store their academic performance.

---

## How to Run the Project

### Requirements

* XAMPP
* PHP
* MySQL
* Apache
* Web browser

### Installation

1. Install XAMPP.
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.
3. Copy the project into the XAMPP `htdocs` directory.

Example:

```text
C:\xampp\htdocs\student_management
```

4. Open phpMyAdmin.
5. Create a database named:

```text
student_management
```

6. Import the database SQL file into the database.
7. Make sure the database connection in `includes/db.php` matches your local MySQL configuration.
8. Open the project in a browser:

```text
http://localhost/student_management/
```

---

## Authentication Flow

The application uses PHP sessions to maintain logged-in users.

```text
User
 │
 ▼
Login
 │
 ▼
Check email
 │
 ▼
Verify password
 │
 ▼
Create session
 │
 ├───────────────┐
 ▼               ▼
Admin          Student
 │               │
 ▼               ▼
Admin           Student
Dashboard       Dashboard
```

Access to pages is controlled according to the user's role.

---

## Student Registration Flow

A student can create an account through the registration page.

```text
Register
   ↓
Create user account
   ↓
Create student profile
   ↓
Student logs in
   ↓
Student completes profile
```

The password is stored using a secure password hash rather than plain text.

---

## Enrollment and Result Flow

The system follows the following basic process:

```text
Student
   ↓
Enroll in course
   ↓
Status = Active
   ↓
Complete course
   ↓
Status = Completed
   ↓
Admin adds result
   ↓
Student views result
```

---

## GPA Calculation

The student's GPA is calculated using the course credits and grade points.

```text
GPA = Σ(Grade Point × Credits) / Σ(Credits)
```

Only courses with available results are included in the GPA calculation.

---

## Validation

The system includes validation for common user input problems, including:

* Required fields
* Password confirmation
* Duplicate email addresses
* Login credentials
* User roles
* Course information
* Enrollment information
* Result information

---

## Git and Version Control

Git is used to track the development of the project.

Development includes working with branches for experimenting with new features and keeping the main project version stable.

Example workflow:

```text
main
 │
 └── feature branch
       │
       ├── Develop
       ├── Test
       └── Fix
              │
              ▼
           Merge
              │
              ▼
             main
```

---

## Documentation

A separate development document contains the detailed journey of creating this project.

It includes:

* Project planning
* Database design
* Development steps
* Features implemented
* Problems encountered
* Solutions
* Testing
* Git usage
* Development progress

The detailed development documentation is maintained separately from this README.

---

## Future Improvements

Possible future improvements include:

* Admin CRUD management
* Student search
* Course filtering
* Enrollment filtering
* Improved JavaScript interactivity
* Delete confirmation dialogs
* Improved notifications
* Dashboard charts
* More advanced reports
* Additional validation

---

## Project Status

**Current Status: Development / Continuous Improvement**

The main system functionality has been implemented and tested. Additional interactive features may be added in future versions.

---

## Author

Developed as a university Software Engineering project.

**Student Course Management System**
