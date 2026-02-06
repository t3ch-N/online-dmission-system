<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'oas');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");

// Site configuration
define('SITE_NAME', 'Online Admission System');
define('SITE_URL', 'http://localhost/online-admission-system');
define('ADMIN_EMAIL', 'admin@oas.com');

// File upload paths
define('UPLOAD_PATH', 'uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB

// Session configuration
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Helper functions
function sanitize_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}

function generate_application_id() {
    return 'APP' . date('Y') . rand(10000, 99999);
}

function send_email($to, $subject, $message) {
    $headers = "From: " . ADMIN_EMAIL . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    return mail($to, $subject, $message, $headers);
}

function is_logged_in() {
    return isset($_SESSION['student_id']) || isset($_SESSION['admin_id']);
}

function is_admin() {
    return isset($_SESSION['admin_id']);
}

function is_student() {
    return isset($_SESSION['student_id']);
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}
?>
