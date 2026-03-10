# 🚀 BilalCvMaker - Professional Resume Builder

![BilalCvMaker Preview](https://via.placeholder.com/1200x600.png?text=BilalCvMaker+-+Empowering+Student+Careers)

**Live Demo:** [bilalcvmaker.lovestoblog.com](https://bilalcvmaker.lovestoblog.com)

## 📖 About The Project
**BilalCvMaker** is a full-stack, production-ready web application designed to help students and professionals generate high-quality, ATS-optimized CVs in minutes. Built completely from scratch, this platform is 100% free for students, removing the financial barriers to creating a job-winning resume. 

The system features a dynamic template rendering engine, secure user authentication, and a comprehensive Global Admin Dashboard to manage users, templates, and system health.

## ✨ Key Features
* **User Dashboard & Auth:** Secure login/registration system with password hashing and session management.
* **12+ ATS-Friendly Templates:** Dynamic switching between premium layouts (Modern Blue, Cyber Tech, Executive, etc.).
* **Real-Time Builder:** Dynamic CRUD operations allowing users to easily add, edit, and preview Education, Experience, and Skills.
* **High-Quality Export:** Instant conversion of HTML/DOM to pristine, printable PDF and PNG formats.
* **Global Admin Control Center:** * Live system health and storage monitoring.
  * Real-time analytics on daily prints and template popularity.
  * Complete user governance (Block, Unblock, Track).
  * Dynamic CV Template Manager (Deploy, Enable, Disable templates without touching code).
* **Responsive UI:** Fully mobile-optimized interface built with Bootstrap 5.

## 🛠️ Built With (Tech Stack)
* **Backend:** PHP (Core)
* **Database:** MySQL
* **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5
* **Libraries:** FontAwesome, html2pdf (or specific PDF rendering library used)
* **Pdf Templates** New temlates have been updated

## 🚀 How to Run Locally
If you want to run this project on your local machine:
1. Clone the repository: `git clone https://github.com/YourUsername/BilalCvMaker.git`
2. Move the project folder to your local server directory (e.g., `htdocs` for XAMPP or `www` for WAMP).
3. Create a new MySQL database named `cv_maker_db` (or your specific db name).
4. Import the provided `.sql` database file into your phpMyAdmin.
5. Update the `db.php` or configuration file with your local database credentials:
   ```php
   $host = "localhost";
   $user = "root";
   $pass = "";
   $dbname = "cv_maker_db";
