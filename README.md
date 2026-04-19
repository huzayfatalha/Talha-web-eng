# 🚀 Lead Tracking AI

A simple, beginner-friendly **lead tracking and management system** built with **PHP, MySQL, HTML, CSS, and JavaScript**. Perfect for learning full-stack web development!

---

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Installation](#-installation)
- [Database Setup](#-database-setup)
- [Project Structure](#-project-structure)
- [How to Use](#-how-to-use)
- [Login Credentials](#-login-credentials)
- [Important URLs](#-important-urls)
- [Troubleshooting](#-troubleshooting)
- [Notes](#-notes)

---

## ✨ Features

### Core Features (Fully Functional ✅)
- **Add Leads** - Create new leads with name, email, and phone number
- **View Leads** - Display all leads in a dynamic table
- **Search Feature** - Filter leads by name or email in real-time
- **Pagination** - Show 5 leads per page with navigation controls
- **Edit Leads** - Modify lead information anytime
- **Delete Leads** - Remove leads with confirmation dialog
- **Form Validation** - Both client-side (JavaScript) and server-side (PHP) validation
- **Login System** - Admin authentication with session management
- **Clean UI** - Modern, responsive design with professional styling
- **Security** - Session protection for authenticated pages

---

## 🛠️ Tech Stack

- **Backend:** PHP (Procedural)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3
- **Validation:** JavaScript, PHP
- **Server:** XAMPP (Apache + MySQL)

---

## 📦 Installation

### Prerequisites
- **XAMPP** installed ([Download here](https://www.apachefriends.org/))
- **PHP 7.0** or higher
- **MySQL** (comes with XAMPP)
- Basic knowledge of file management

### Step-by-Step Installation

#### 1. Download/Clone Project
```bash
# Clone from GitHub
git clone https://github.com/huzayfatalha/Talha-web-eng.git

# Or extract ZIP file
# Place in: C:\xampp\htdocs\web_project\
```

#### 2. Start XAMPP Services
1. Open **XAMPP Control Panel**
2. Click **Start** button next to **Apache**
   - Wait until it shows green (Running)
3. Click **Start** button next to **MySQL**
   - Wait until it shows green (Running)

#### 3. Create Database
1. Open browser and go to: `http://localhost/phpmyadmin/`
2. Click **SQL** tab at the top
3. Copy and paste this code:

```sql
CREATE DATABASE IF NOT EXISTS crm_project;
USE crm_project;

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admins (username, password) VALUES ('admin', '12345');
```

4. Click **Go** button
5. You should see success message and `crm_project` database created

#### 4. Access Application
- Open browser
- Go to: `http://localhost/web_project/`
- You will be redirected to login page
- Log in with credentials below

---

## 🗄️ Database Setup

### Database Name
```
crm_project
```

### Database Credentials
```
Hostname: localhost
Username: root
Password: (empty/blank)
Port: 3306
```

### Tables Structure

**customers table:**
```
id          INT (Primary Key, Auto Increment)
name        VARCHAR(100) - Lead name
email       VARCHAR(100) - Lead email
phone       VARCHAR(20) - Lead phone (optional)
created_at  TIMESTAMP - Auto-created timestamp
```

**admins table:**
```
id       INT (Primary Key, Auto Increment)
username VARCHAR(50) - Admin username
password VARCHAR(255) - Plain text password
```

---

## 📁 Project Structure

```
web_project/
│
├── README.md                    # Documentation (this file)
├── index.php                    # Homepage - Welcome page
├── login.php                    # Login page
├── logout.php                   # Logout functionality
├── db.php                       # Database connection
│
├── css/
│   └── style.css               # All CSS styling
│
├── js/
│   └── script.js               # JavaScript validation & functions
│
├── pages/
│   ├── add_customer.php        # Add new lead form
│   ├── view_customers.php      # View all leads with search & pagination
│   └── edit_customer.php       # Edit lead form
│
└── includes/
    ├── header.php              # Header & navigation bar
    ├── footer.php              # Footer
    └── session_check.php       # Session verification for login protection
```

---

## 🚀 How to Use

### 1. Login to System
1. Go to: `http://localhost/web_project/login.php`
2. Enter Username: `admin`
3. Enter Password: `12345`
4. Click **Login**

### 2. View Dashboard (Homepage)
1. After login, you'll see the homepage
2. It shows welcome message and quick action buttons
3. Navigation menu at top: Home | Add Lead | View Leads

### 3. Add a New Lead
1. Click **"Add New Lead"** button (or navigate from menu)
2. Fill in the form:
   - **Lead Name** (required, minimum 2 characters)
   - **Email** (required, must be valid email format)
   - **Phone** (optional, numbers only)
3. Click **"Add Lead"** button
4. See success message
5. Auto-redirected to View Leads page

### 4. View All Leads
1. Click **"View All Leads"** button (or navigate from menu)
2. See table of all leads with: ID, Name, Email, Phone, Date Added
3. Each row has **Edit** and **Delete** action buttons
4. Navigate pages using pagination (5 leads per page)

### 5. Search for a Lead
1. On View Leads page, use search box at the top
2. Enter name or email of lead
3. Click **"Search"** button
4. Table filters to show only matching results
5. Click **"Clear Search"** to see all leads again

### 6. Edit a Lead
1. On View Leads page, click **"Edit"** button for any lead
2. Form opens with pre-filled information
3. Modify any field (except Date Added which is read-only)
4. Click **"Update Lead"** button
5. See success message
6. Auto-redirected to View Leads page with updated data

### 7. Delete a Lead
1. On View Leads page, click **"Delete"** button for any lead
2. Confirmation popup appears: "Are you sure you want to delete [Name]?"
3. Click **OK** to confirm deletion
4. Lead is removed from database
5. See success message and updated list

### 8. Logout
1. Click **"Logout"** button (top right corner)
2. Session ends
3. Redirected to login page

---

## 🔐 Login Credentials

### Default Admin Account
```
Username: admin
Password: 12345
```

> ⚠️ **Note:** Change these credentials in production!

---

## 🌐 Important URLs

### Main Pages
| Page | URL |
|------|-----|
| Homepage | `http://localhost/web_project/` |
| Login | `http://localhost/web_project/login.php` |
| Logout | `http://localhost/web_project/logout.php` |
| Add Lead | `http://localhost/web_project/pages/add_customer.php` |
| View Leads | `http://localhost/web_project/pages/view_customers.php` |
| Edit Lead | `http://localhost/web_project/pages/edit_customer.php?id=1` |

### Helpful Links
| Service | URL |
|---------|-----|
| phpMyAdmin | `http://localhost/phpmyadmin/` |
| XAMPP Dashboard | `http://localhost/` |
| Local Project Folder | `C:\xampp\htdocs\web_project\` |

---

## 🧪 Testing the Application

### Quick Test Checklist

#### Login & Security
- [ ] Login with admin/12345 works
- [ ] Cannot access pages without login
- [ ] Logout button works
- [ ] Session persists when navigating pages

#### Add Lead Feature
- [ ] Form validates empty fields
- [ ] Form validates name length (min 2 chars)
- [ ] Form validates email format
- [ ] Successfully add lead with valid data
- [ ] Success message appears
- [ ] Auto-redirect to View Leads page

#### View Leads & Pagination
- [ ] All leads display in table
- [ ] Pagination shows (if 6+ leads exist)
- [ ] Only 5 leads per page
- [ ] Next/Previous buttons work
- [ ] Page numbers are clickable

#### Search Feature
- [ ] Search by name filters correctly
- [ ] Search by email filters correctly
- [ ] No results message displays
- [ ] Clear search shows all leads again

#### Edit Lead
- [ ] Edit button opens form with pre-filled data
- [ ] Date Added field is read-only (disabled)
- [ ] Can update lead information
- [ ] Validation works on edit
- [ ] Success message displays
- [ ] Changes appear in View Leads

#### Delete Lead
- [ ] Delete button shows confirmation popup
- [ ] Cancel doesn't delete lead
- [ ] OK confirms and deletes
- [ ] Lead removed from table
- [ ] Success message displays

---

## 🚨 Troubleshooting

### ❌ Error: "Unknown database 'crm_project'"
**Solution:**
1. Go to: `http://localhost/phpmyadmin/`
2. Click **SQL** tab
3. Copy and run the database creation SQL code (see Database Setup section)
4. Refresh the page

### ❌ Error: Blank Page or 500 Error
**Solution:**
1. Check that Apache and MySQL are running (green in XAMPP)
2. Verify file path is: `C:\xampp\htdocs\web_project\`
3. Make sure `db.php` has correct credentials
4. Check PHP error logs in XAMPP directory

### ❌ Cannot Login (Even with admin/12345)
**Solution:**
1. Go to: `http://localhost/phpmyadmin/`
2. Click on `crm_project` database
3. Click on `admins` table
4. Check if admin user exists
5. If not, run this SQL in phpMyAdmin:
```sql
INSERT INTO admins (username, password) VALUES ('admin', '12345');
```

### ❌ Pagination Not Showing
**Solution:**
1. Add at least 6 leads to see pagination
2. Pagination appears automatically when you have more than 5 leads
3. Each page shows exactly 5 leads

### ❌ Search Not Working
**Solution:**
1. Make sure you're on View Leads page
2. Check that leads exist in database
3. Try searching with simple keywords (e.g., first names)
4. Click "Clear Search" and try again

### ❌ CSS/JavaScript Not Loading (Styling looks broken)
**Solution:**
1. Clear browser cache (Ctrl+Shift+Delete)
2. Wait for page to fully load
3. Check that project is in `C:\xampp\htdocs\web_project\`
4. Verify CSS path: `/web_project/css/style.css`

### ❌ Cannot Access Pages Directly Without Login
**This is intentional!** The system is secure and redirects to login page.

---

## 📝 Notes

### About This Project
- **Educational Purpose:** Built for learning full-stack web development
- **No Frameworks:** Uses pure PHP, HTML, CSS, and JavaScript
- **Procedural Code:** Simple, beginner-friendly code structure
- **Learning Focused:** Easy to understand and modify

### Security Notes
- ⚠️ **NOT for production use** - passwords are stored in plain text
- ⚠️ SQL queries use string concatenation (for educational purposes)
- ⚠️ Always use prepared statements and PASSWORD HASHING in production
- ✅ Basic input validation implemented
- ✅ Session-based authentication implemented

### Future Enhancements
- Password hashing with bcrypt
- Email verification
- User roles (Admin, User)
- Lead status (Hot, Cold, Contacted, etc.)
- Email notifications
- Export to CSV/PDF
- Mobile app version

---

## 📊 Project Status

```
✅ FULLY COMPLETE & TESTED

Features:
  ✓ Database setup
  ✓ Database connection
  ✓ Homepage with navigation
  ✓ Login system
  ✓ Add lead feature with validation
  ✓ View leads with pagination
  ✓ Search functionality
  ✓ Edit lead feature
  ✓ Delete lead feature
  ✓ Form validation (Client & Server)
  ✓ Session management
  ✓ Modern UI/UX design

Status: 100% COMPLETE ✅
```

---

## 🤝 Contributing

This is a student project. Feel free to fork, modify, and use for learning purposes!

### How to Modify
1. Edit PHP files directly
2. Modify CSS in `css/style.css`
3. Update JavaScript in `js/script.js`
4. Test changes locally with XAMPP
5. Commit and push to GitHub

---

## 📞 Support

If you encounter issues:
1. Check [Troubleshooting](#-troubleshooting) section
2. Verify all prerequisites are installed
3. Check XAMPP services are running
4. Review error messages carefully
5. Check browser console (F12)

---

## 👨‍💻 Author

**By Student**

Lead Tracking AI - A Student Project

---

## 📄 License

Free to use for educational and personal projects.

---

**Thank you for using Lead Tracking AI! 🚀**

Happy coding! 💻
