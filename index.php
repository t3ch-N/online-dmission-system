<?php
require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <h1><?php echo SITE_NAME; ?></h1>
                </div>
                <nav>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="courses.php">Courses</a></li>
                        <li><a href="student/register.php">Apply Now</a></li>
                        <li><a href="student/login.php">Student Login</a></li>
                        <li><a href="admin/login.php">Admin Login</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h2>Welcome to Our Online Admission Portal</h2>
            <p>Apply for admission to your dream course in just a few clicks</p>
            <a href="student/register.php" class="btn btn-primary">Apply Now</a>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Why Choose Our Online Admission System?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📝</div>
                    <h3>Easy Application</h3>
                    <p>Fill and submit your application form online with ease. No need for physical paperwork.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Quick Processing</h3>
                    <p>Get your application processed quickly. Receive updates via email instantly.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎫</div>
                    <h3>Download Admit Card</h3>
                    <p>Download your admit card directly from your student dashboard once approved.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>View Results</h3>
                    <p>Check your CUEE exam results and admission status online anytime.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Secure & Reliable</h3>
                    <p>Your data is safe with us. We use industry-standard security measures.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>24/7 Access</h3>
                    <p>Access your account anytime, anywhere from any device with internet.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features" style="background-color: white;">
        <div class="container">
            <h2>Admission Process</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">1️⃣</div>
                    <h3>Register</h3>
                    <p>Create your account with basic details and choose your desired course.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">2️⃣</div>
                    <h3>Fill Application</h3>
                    <p>Complete the application form and upload required documents.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">3️⃣</div>
                    <h3>Application Review</h3>
                    <p>Our team will review your application and notify you via email.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">4️⃣</div>
                    <h3>CUEE Exam</h3>
                    <p>Download admit card and appear for the entrance exam.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">5️⃣</div>
                    <h3>Results</h3>
                    <p>Check your exam results and final admission status online.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">6️⃣</div>
                    <h3>Admission</h3>
                    <p>Complete the admission formalities and join your course.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
            <p>Developed with ❤️ for Education</p>
        </div>
    </footer>
</body>
</html>
