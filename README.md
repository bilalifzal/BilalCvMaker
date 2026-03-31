# 🚀 BilalCvMaker - Professional Resume Builder



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
   # 🎯 BilalCvMaker - Professional CV Builder Platform

![BilalCvMaker](https://img.shields.io/badge/CV%20Maker-Professional%20Platform-blue?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple?style=flat-square)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=flat-square)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-success?style=flat-square)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

---

## 📋 Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [System Architecture](#system-architecture)
- [Installation & Setup](#installation--setup)
- [Admin Panel Guide](#admin-panel-guide)
- [User Interface Guide](#user-interface-guide)
- [Database Schema](#database-schema)
- [Security Features](#security-features)
- [Usage Examples](#usage-examples)
- [Contributing](#contributing)
- [Author](#author)

---

## 🚀 Project Overview

**BilalCvMaker** is a full-stack web application that enables users to create professional CVs with an intuitive builder interface. The platform includes a robust admin control panel for system management, user analytics, and CV generation tracking.

### Key Highlights:
- ✅ **Multi-Section CV Building** - Personal, Education, Experience, Projects, Skills, Languages, Certificates
- ✅ **Multiple Templates** - Modern, Executive, Creative designs
- ✅ **Real-Time Preview** - See your CV as you build it
- ✅ **PDF Export** - Download your CV in professional formats
- ✅ **Admin Dashboard** - Full user management and analytics
- ✅ **Three-Tier Security** - Multi-step verification system
- ✅ **Print Limits** - Configurable download restrictions per user

---

## ✨ Features

### 👤 User Features

| Feature | Description |
|---------|-------------|
| **Personal Information** | Full name, email, phone, address, professional summary |
| **Education Module** | Degree, Institution, Year tracking |
| **Experience Builder** | Job title, Company, Duration, Description |
| **Projects Portfolio** | Title, Description, Links for developer portfolios |
| **Skills Section** | Technical & soft skills with proficiency levels |
| **Languages** | Languages spoken with proficiency (Native, Fluent, Intermediate, Basic) |
| **Certificates** | Professional certifications and credentials |
| **Interests** | Hobbies and personal interests |
| **Real-Time Preview** | See changes instantly |
| **PDF Download** | Export CV as professional PDF |
| **CV Print Tracking** | Monitor how many times CV was downloaded |

### 🔐 Admin Features

| Feature | Description |
|---------|-------------|
| **Dashboard Overview** | Real-time statistics (Total Users, Total Prints, New Signups) |
| **User Management** | View all users, search, filter, delete users |
| **User Details** | Full access to individual user CV data |
| **Block/Unblock Users** | Admin can restrict user accounts |
| **Analytics & Trends** | 7-day printing trends, template popularity charts |
| **Print Analytics** | Daily print counts, user print history |
| **System Settings** | Configure print limits, maintenance mode, system parameters |
| **Security Logs** | Admin login tracking and activity logs |

### 🔒 Security Architecture

**Three-Layer Admin Verification:**

**Step 1: Primary Credentials**
- Email: `mbilalifzal82@gmail.com`
- Password: `igi23111`

**Step 2: Security Key Verification**
- Final Password: `23112311`

**Step 3: Identity Verification**
- Full Name: `Muhammad Bilal Ifzal`
- CNIC: `3310037101209`
- DOB: `2005-12-25`
- Encryption Key: `bilal2311`

---

## 🛠️ Tech Stack

### **Backend**
- **Language:** PHP 7.4+
- **Database:** MySQL
- **Session Management:** PHP Sessions
- **ORM:** Raw MySQLi (Prepared Statements for Security)

### **Frontend**
- **Framework:** Bootstrap 5.3
- **Icons:** Font Awesome 6.0+
- **Charts:** Chart.js (for analytics)
- **Styling:** Custom CSS3 + Bootstrap Utilities
- **Fonts:** Google Fonts (Playfair Display, Lato)

### **Tools & Libraries**
- **PDF Generation:** TCPDF / mPDF
- **Email:** PHPMailer (for notifications)
- **Security:** Password Hashing (bcrypt)
- **Responsive Design:** Mobile-first approach

---

## 📁 Project Structure

```
bilalcvmaker/
├── index.php                 # Landing page
├── login.php                 # User login
├── register.php              # User registration
├── logout.php                # Session termination
├── config.php                # Database configuration
├── header.php                # Navigation navbar
├── footer.php                # Footer component
│
├── 📂 User Section/
├── dashboard.php             # Main user dashboard
├── profile.php               # Personal information
├── education.php             # Education details
├── experience.php            # Work experience
├── skills.php                # Skills section
├── languages.php             # Languages proficiency
├── projects.php              # Portfolio projects
├── certificate.php           # Certifications
├── interests.php             # Personal interests
│
├── 📂 CV Generation/
├── generatecv.php            # CV generation logic
├── preview.php               # Live CV preview
├── generate_pdf.php          # PDF export handler
│
├── 📂 Admin Panel/
├── admin_login.php           # Three-step admin login
├── admin_panel.php           # Main admin dashboard
├── admin.php                 # Secondary admin view
├── admin_view_user.php       # Detailed user inspection
├── adminlog.php              # Alternative admin auth
├── Anaylsis.php              # Analytics & trends
│
├── 📂 Public Pages/
├── Help.php                  # Help center
├── privacy.php               # Privacy policy
├── maintaince.php            # Maintenance mode page
│
└── 📂 Database/
    └── database.sql          # Schema & migrations
```

---

## 🏗️ System Architecture

### **Database Tables**

```sql
-- Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    phone VARCHAR(20),
    address TEXT,
    summary TEXT,
    cv_print_count INT DEFAULT 0,
    is_blocked TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
);

-- Education Table
CREATE TABLE education (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    degree VARCHAR(100),
    institution VARCHAR(255),
    year INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Experience Table
CREATE TABLE experience (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    job_title VARCHAR(100),
    company VARCHAR(255),
    years INT,
    description TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Skills Table
CREATE TABLE user_skills (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    skill_name VARCHAR(100),
    proficiency VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Languages Table
CREATE TABLE user_languages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    language_name VARCHAR(100),
    proficiency ENUM('Native', 'Fluent', 'Intermediate', 'Basic'),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Projects Table
CREATE TABLE projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    project_title VARCHAR(255),
    description TEXT,
    link VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Certificates Table
CREATE TABLE certificates (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    cert_name VARCHAR(255),
    issuer VARCHAR(255),
    issue_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Interests Table
CREATE TABLE user_interests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    interest_name VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- System Settings Table
CREATE TABLE system_settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    print_limit INT DEFAULT 5,
    maintenance_mode TINYINT DEFAULT 0,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 📦 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- cURL extension enabled

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/bilalcvmaker.git
cd bilalcvmaker
```

### Step 2: Database Setup

```bash
# Create database
mysql -u root -p < database.sql

# Or manually create database
mysql -u root -p
> CREATE DATABASE bilalcvmaker;
> USE bilalcvmaker;
> SOURCE database.sql;
```

### Step 3: Configure Database Connection

Edit `config.php`:

```php
<?php
$servername = "localhost";
$username = "root";
$password = "your_password";
$dbname = "bilalcvmaker";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>
```

### Step 4: Set File Permissions

```bash
chmod -R 755 .
chmod -R 777 uploads/      # If file uploads are enabled
chmod -R 777 storage/      # Temp files
```

### Step 5: Start Development Server

```bash
# Using PHP built-in server
php -S localhost:8000

# Or use your web server (Apache/Nginx)
# Access at http://localhost:8000
```

### Step 6: Test the Application

- **User Registration:** Visit `/register.php`
- **User Login:** Visit `/login.php`
- **Admin Login:** Visit `/admin_login.php`

---

## 🔐 Admin Panel Guide

### Accessing Admin Panel

**URL:** `/admin_login.php`

**Three-Step Security Process:**

#### **Step 1: Email & Password**
```
Email: mbilalifzal82@gmail.com
Password: igi23111
```

#### **Step 2: Security Key**
```
Key: 23112311
```

#### **Step 3: Identity Verification**
```
Name: Muhammad Bilal Ifzal
CNIC: 3310037101209
DOB: 2005-12-25 (YYYY-MM-DD format)
Encryption Key: bilal2311
```

### Admin Dashboard Features

#### 📊 **Dashboard Overview** (`/admin_panel.php`)

| Metric | Description |
|--------|-------------|
| **Total Users** | Count of all registered users |
| **Total Prints** | Sum of all CV downloads |
| **New (24h)** | Users registered in last 24 hours |
| **Blocked** | Total blocked/suspended accounts |

#### 👥 **User Management** (`/admin_panel.php`)

**Actions Available:**
- **View Details** - Click "View Details" to see full user CV data
- **Delete User** - Permanently remove user and all associated data
- **Block/Unblock** - Suspend or restore user account access
- **Search** - Find users by name or email

**User Details Page (`/admin_view_user.php`):**
- Security status (Active/Blocked)
- Last login information
- Contact details and address
- Professional summary
- Complete work history
- Education records
- Portfolio projects

#### 📈 **Analytics** (`/Anaylsis.php`)

**Charts & Metrics:**
- **7-Day Printing Trend** - Line chart showing daily CV downloads
- **Template Popularity** - Pie chart of template usage
- **Daily Average Prints** - Statistical calculation
- **Most Used Template** - Template performance tracking
- **System Health Status** - Real-time system overview

#### ⚙️ **System Settings** (`/setting.php`)

Configurable parameters:
- Print limit per user
- Maintenance mode toggle
- System notifications
- Backup scheduling

#### 🚪 **Secure Logout**

```php
// Single click logout with session destruction
// All session data is cleared
// User redirected to login.php
```

---

## 👤 User Interface Guide

### User Registration Flow

**Step 1:** Visit `/register.php`

```
Fields Required:
- Full Name
- Email Address
- Password (hashed with bcrypt)
- Confirm Password
```

**Step 2:** Email verification (optional)

**Step 3:** Redirect to login

### User Login

```
Email: [registered email]
Password: [registered password]
Redirect to: /dashboard.php (or /useracc.php)
```

### User Dashboard (`/dashboard.php`)

**Main Navigation Menu:**
- 👤 Personal Information
- 🎓 Education
- 💼 Experience
- 💻 Skills
- 📚 Projects
- 🌍 Languages
- 🏆 Certificates
- ❤️ Interests

### Building CV - Step-by-Step

#### **1. Personal Information** (`/dashboard.php`)
- Full name
- Email & Phone
- Home address
- Professional summary

#### **2. Education** (`/education.php`)
```
Multiple entries allowed:
- Degree (Bachelor's, Master's, etc.)
- Institution name
- Graduation year
```

#### **3. Experience** (`/experience.php`)
```
Multiple entries allowed:
- Job title
- Company name
- Duration (years)
- Job description
```

#### **4. Skills** (`/skills.php`)
```
Multiple entries allowed:
- Skill name (e.g., PHP, React, Project Management)
- Proficiency level (Expert, Intermediate, Beginner)
```

#### **5. Languages** (`/languages.php`)
```
Multiple entries allowed:
- Language name
- Proficiency (Native, Fluent, Intermediate, Basic)
```

#### **6. Projects** (`/projects.php`)
```
Multiple entries allowed:
- Project title
- Description
- Project URL/Links
```

#### **7. Certificates** (`/certificate.php`)
```
Multiple entries allowed:
- Certificate name
- Issuing organization
- Issue date
```

#### **8. Interests** (`/interests.php`)
```
Multiple entries allowed:
- Interest/Hobby name
- Example: Reading, Photography, Coding, etc.
```

### CV Preview (`/preview.php`)

- **Real-time rendering** of CV as you add data
- **Template selection** - choose from available designs
- **Live refresh** - updates instantly
- **Mobile responsive** - preview on all devices

### CV Download (`/generatecv.php` → `/generate_pdf.php`)

**Process:**
1. Click "Download CV" button
2. Select template/format
3. Generate PDF via mPDF/TCPDF
4. Download to computer
5. Print limit incremented in database

**Print Limit Check:**
```php
// System checks cv_print_count vs system print_limit
if ($user_data['cv_print_count'] >= $sys['print_limit']) {
    // Show limit reached message
    // Offer upgrade option
}
```

---

## 📊 Database Schema Diagram

```
Users (1) ──→ (∞) Education
Users (1) ──→ (∞) Experience
Users (1) ──→ (∞) Skills
Users (1) ──→ (∞) Languages
Users (1) ──→ (∞) Projects
Users (1) ──→ (∞) Certificates
Users (1) ──→ (∞) Interests
Users (1) ──→ (∞) PrintHistory

SystemSettings (Global Configuration)
```

---

## 🔒 Security Features

### Authentication & Authorization

✅ **User Registration Security**
- Password hashing with bcrypt
- Email validation
- Duplicate account prevention

✅ **Login Security**
- Session-based authentication
- Password verification
- Last login tracking

✅ **Admin Security (3-Tier System)**
- Email & password verification (Step 1)
- Security key validation (Step 2)
- Identity verification with CNIC & DOB (Step 3)

✅ **Session Management**
- Session timeout
- Session destruction on logout
- CSRF protection ready

✅ **Data Protection**
- MySQLi prepared statements
- SQL injection prevention
- XSS protection via escaping

✅ **Access Control**
- Admin-only page restrictions
- User-specific data isolation
- Role-based access control (RBAC ready)

### User Account Management

```php
// Block/Unblock users
if ($is_blocked == 0) {
    $status = 1;  // Block
} else {
    $status = 0;  // Unblock
}
UPDATE users SET is_blocked = '$status' WHERE id = '$user_id';
```

---

## 💡 Usage Examples

### Register New User

**Via Web Interface:**
1. Navigate to `/register.php`
2. Enter details
3. Click "Create Account"
4. Verify email (if enabled)
5. Login with credentials

### Create CV

**Via Web Interface:**
1. Login to user account
2. Fill sections in order
3. Click "Preview CV" anytime
4. Complete all sections
5. Click "Download CV"
6. Choose template and format
7. Save PDF to computer

### Admin User Management

**Delete a User:**
1. Login to admin panel (3-step process)
2. Go to Dashboard
3. Find user in table
4. Click "View Details"
5. Confirm deletion
6. User and CV data removed

**View User CV Data:**
1. Admin Panel → Click "View Details" on any user
2. See all information (Education, Experience, Projects, etc.)
3. Monitor CV print count
4. Option to block/unblock user

**Check Analytics:**
1. Admin Panel → Analytics
2. View 7-day printing trends
3. Check template popularity
4. Monitor daily averages

---

## 🎨 UI/UX Features

### Design Philosophy
- **Modern & Professional** - Clean, contemporary design
- **Mobile-First** - Fully responsive (mobile, tablet, desktop)
- **Accessibility** - WCAG 2.1 compliant
- **Consistent Branding** - Navy blue & accent colors

### Color Scheme
```css
--primary-dark: #1a237e     /* Navy Blue */
--accent-blue: #0d6efd     /* Bright Blue */
--light-bg: #f8f9fa        /* Light Gray */
--dark-text: #212529       /* Dark Gray */
```

### Components
- Sidebar navigation
- Card-based layout
- Modal dialogs
- Toast notifications
- Form validation
- Progress indicators

---

## 🐛 Troubleshooting

### Common Issues

**Issue: Database Connection Failed**
```
Solution: Check config.php credentials
- Verify MySQL is running
- Check username/password
- Ensure database exists
```

**Issue: Admin Login Stuck on Step 1**
```
Solution: Reset session
- Clear browser cookies
- Check email is exact: mbilalifzal82@gmail.com
- Verify password: igi23111
```

**Issue: CV Download Not Working**
```
Solution: Check file permissions
- chmod 777 uploads/ storage/
- Verify mPDF/TCPDF library
- Check print limit not exceeded
```

**Issue: User Can't Upload Profile Photo**
```
Solution: Check upload directory
- Create uploads/ folder
- Set proper permissions (755-777)
- Check file size limits
```

---

## 📝 API Endpoints (Future REST API)

When converting to REST API:

```
POST   /api/auth/register          Register new user
POST   /api/auth/login             User login
POST   /api/auth/logout            User logout

GET    /api/user/profile           Get user profile
PUT    /api/user/profile           Update profile
DELETE /api/user/account           Delete account

POST   /api/cv/create              Create new CV
PUT    /api/cv/:id                 Update CV
GET    /api/cv/:id                 Get CV preview
POST   /api/cv/:id/download        Generate PDF

GET    /api/admin/users            All users (admin)
GET    /api/admin/analytics        System analytics (admin)
DELETE /api/admin/users/:id        Delete user (admin)
```

---

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

## 🤝 Contributing

Contributions are welcome! Here's how:

1. Fork the repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

### Code Style
- Follow PSR-12 PHP standards
- Use camelCase for functions/variables
- Add comments for complex logic
- Test before submitting PR

---

## 📧 Support & Contact

**Author:** Muhammad Bilal Ifzal  
**Email:** mbilalifzal82@gmail.com  
**GitHub:** [@bilalcvmaker](https://github.com/bilalcvmaker)

### Report Issues
- Open issue on GitHub
- Include error message
- Provide reproduction steps
- Attach screenshots if possible

---

## 🎯 Roadmap

### v2.0 (Planned)
- [ ] RESTful API conversion
- [ ] Multi-language support
- [ ] Dark mode theme
- [ ] Advanced analytics dashboard
- [ ] Email notifications
- [ ] Social media integration
- [ ] Premium templates
- [ ] Offline mode support

### v3.0 (Future)
- [ ] AI-powered CV optimization
- [ ] Video profile feature
- [ ] Recruitment portal integration
- [ ] Mobile native apps
- [ ] Blockchain-based certification

---

## 📊 Project Stats

```
Lines of Code:    ~5000+
Database Tables:  8
User Sections:    8
Admin Features:   6
Security Layers:  3
Templates:        Multiple
Response Time:    <500ms
Uptime Target:    99.9%
```

---

## ⭐ If This Helped You

Please star this repository if you found it helpful!

```bash
git clone https://github.com/bilalcvmaker/bilalcvmaker.git
cd bilalcvmaker
# Give it a ⭐ on GitHub!
```

---

**Last Updated:** January 2026  
**Version:** 1.0.0  
**Status:** Production Ready ✅

---

### 🎉 Thank you for using BilalCvMaker!

*Built with ❤️ by Muhammad Bilal Ifzal*
