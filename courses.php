<?php
require_once 'includes/config.php';

// Fetch all active courses
$sql = "SELECT * FROM courses WHERE status = 'Active' ORDER BY course_name";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - <?php echo SITE_NAME; ?></title>
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

    <section class="features">
        <div class="container">
            <h2>Available Courses</h2>
            <div class="features-grid">
                <?php
                if ($result && $result->num_rows > 0) {
                    while($course = $result->fetch_assoc()) {
                ?>
                <div class="feature-card">
                    <div class="feature-icon">🎓</div>
                    <h3><?php echo htmlspecialchars($course['course_name']); ?></h3>
                    <p><strong>Duration:</strong> <?php echo htmlspecialchars($course['duration']); ?></p>
                    <p><?php echo htmlspecialchars($course['description']); ?></p>
                    <a href="student/register.php" class="btn btn-primary" style="margin-top: 1rem;">Apply Now</a>
                </div>
                <?php
                    }
                } else {
                    echo '<p>No courses available at the moment.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
