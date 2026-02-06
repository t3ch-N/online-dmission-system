# Online Admission System - PHP Project

A comprehensive web-based admission management system for educational institutions.

## Features

✅ Student Registration & Login
✅ Online Application Form  
✅ Document Upload (Photo, ID Proof, Marksheets)
✅ Admin Dashboard
✅ Application Approval/Rejection
✅ CUEE Marks Management
✅ Result Publication
✅ Admit Card Download
✅ Email Notifications
✅ Responsive Design

## Installation

### Prerequisites
- XAMPP/WAMP/MAMP (PHP 5.5+)
- MySQL Database
- Web Browser

### Steps

1. **Copy Project Files**
   ```
   Copy 'online-admission-system' folder to: C:/xampp/htdocs/
   ```

2. **Start Services**
   - Open XAMPP Control Panel
   - Start Apache and MySQL

3. **Create Database**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Create new database: `oas`
   - Import SQL file: `database/oas.sql`

4. **Configure Database** (if needed)
   - Edit `includes/config.php`
   - Update database credentials:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'oas');
   ```

5. **Access Application**
   ```
   Homepage: http://localhost/online-admission-system/
   Admin: http://localhost/online-admission-system/admin/login.php
   Student: http://localhost/online-admission-system/student/login.php
   ```

## Default Credentials

### Admin Login
- **Username:** admin
- **Password:** password

### Student Login  
- Register new account at student registration page

## Project Structure

```
online-admission-system/
├── admin/                 # Admin panel
│   ├── login.php
│   ├── dashboard.php
│   └── logout.php
├── student/               # Student panel
│   ├── register.php
│   ├── login.php
│   ├── dashboard.php
│   └── logout.php
├── includes/              # Configuration files
│   └── config.php
├── assets/               
│   ├── css/              # Stylesheets
│   └── images/           # Images
├── database/             
│   └── oas.sql           # Database schema
├── index.php             # Homepage
└── courses.php           # Courses page
```

## Usage

### For Students:
1. Register with email and personal details
2. Login to student dashboard
3. Complete application form
4. Upload required documents
5. Wait for admin approval
6. Download admit card (if approved)
7. View CUEE results

### For Admin:
1. Login to admin panel
2. View all applications
3. Approve/Reject applications
4. Update CUEE marks
5. Manage student records

## Features in Detail

### Student Features:
- Online registration
- Secure login
- Application status tracking
- Document upload
- Admit card download
- Result viewing

### Admin Features:
- Dashboard with statistics
- Application management
- Bulk operations
- CUEE marks entry
- Email notifications
- Report generation

## Database Tables

- `admin` - Admin users
- `students` - Student information
- `courses` - Available courses
- `notifications` - System notifications
- `contact_messages` - Contact form submissions

## Technologies Used

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Server:** Apache

## Browser Support

- Chrome (recommended)
- Firefox
- Safari
- Edge

## Security Features

- Password hashing (bcrypt)
- SQL injection prevention
- XSS protection
- Session management
- Input validation

## Troubleshooting

**Database Connection Error:**
- Check MySQL service is running
- Verify database credentials in config.php
- Ensure database 'oas' exists

**Login Issues:**
- Clear browser cache
- Check username/password
- Verify user exists in database

**Email Not Sending:**
- Configure SMTP settings
- Check mail() function is enabled

## Support

For issues or customization:
- Email: projectworldsofficial@gmail.com
- WhatsApp: +91 7000830947

## License

Free to use for educational purposes.

---

**Developed for Academic Projects**
**Version 1.0 - February 2026**
