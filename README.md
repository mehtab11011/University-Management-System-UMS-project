 read in code form 

#University Management System (UMS)
Project Description
The University Management System (UMS) is a web-based application designed to help universities manage student records and announcements efficiently.

Admin Panel: Allows administrators to add, update, delete students, post announcements, update CGPA, and search for students.
Student Panel: Enables students to log in using their name and roll number to check their details and view announcements.
Features
Admin Panel
✅ Secure login system (username & password).
✅ Add, update, and delete student records.
✅ Post and manage announcements.
✅ Search for specific students.
✅ Update student CGPA.

Student Panel
✅ Secure login (name & roll number).
✅ View personal details (CGPA, roll number, etc.).
✅ Check announcements.

Folder Structure

UMS_mine/
│── assets/           # UI/UX design, CSS, images
│── public/           
│   ├── index.php  # with header and footer  ---> Main home page
│── admin/           
also include header footer and side bar 
│   ├── login.php     # Admin login page
│   ├── dashboard.php # Admin dashboard
│   ├── add_student.php
│   ├── update_student.php
│   ├── delete_student.php
│   ├── announcements.php
│   ├── logout.php
│── student/    
also include header footer and side bar 
│   ├── login.php     # Student login page
│   ├── profile.php   # Student details
│   ├── announcements.php
│── database/        
│   ├── db.php        # Database connection
│   ├── ums_db.sql    # SQL file to create database
│── config/           # Config files
│── README.md         # Project documentation
Database Structure
Database Name: ums_db
Tables
1. admin (Stores admin login details)
id (Primary Key)
username
password
2. students (Stores student details)
id (Primary Key)
name
roll_number
email
cgpa
password
3. announcements (Stores announcements)
id (Primary Key)
title
description
created_at
Installation & Setup
Clone the repository:
git clone https://github.com/your-username/UMS.git
Move to the project folder:
cd UMS
Import the database (ums_db.sql) into MySQL.
Configure database credentials in database/db.php.
Start the PHP server:
php -S localhost:8000
Open http://localhost:8000 in your browser.
Technologies Used
PHP (Backend)
MySQL (Database)
HTML, CSS (Frontend)
JavaScript (For UI interactions)
Author
👤 Your Mehtab Khan

