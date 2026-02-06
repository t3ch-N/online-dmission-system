<?php
require_once '../includes/config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = sanitize_input($_POST['full_name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $dob = sanitize_input($_POST['dob']);
    $gender = sanitize_input($_POST['gender']);
    $address = sanitize_input($_POST['address']);
    $city = sanitize_input($_POST['city']);
    $state = sanitize_input($_POST['state']);
    $pincode = sanitize_input($_POST['pincode']);
    $previous_school = sanitize_input($_POST['previous_school']);
    $percentage_10th = sanitize_input($_POST['percentage_10th']);
    $percentage_12th = sanitize_input($_POST['percentage_12th']);
    $course_applied = sanitize_input($_POST['course_applied']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Generate unique application ID
    $application_id = generate_application_id();
    
    // Check if email already exists
    $check_sql = "SELECT id FROM students WHERE email = '$email'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        $error = "Email already registered. Please use a different email or login.";
    } else {
        $sql = "INSERT INTO students (application_id, full_name, email, phone, dob, gender, address, city, state, pincode, previous_school, percentage_10th, percentage_12th, course_applied, password) 
                VALUES ('$application_id', '$full_name', '$email', '$phone', '$dob', '$gender', '$address', '$city', '$state', '$pincode', '$previous_school', '$percentage_10th', '$percentage_12th', '$course_applied', '$password')";
        
        if ($conn->query($sql)) {
            $success = "Registration successful! Your Application ID is: <strong>$application_id</strong>. Please login to complete your application.";
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}

// Fetch courses
$courses_sql = "SELECT course_name FROM courses WHERE status = 'Active'";
$courses_result = $conn->query($courses_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
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
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../courses.php">Courses</a></li>
                        <li><a href="register.php">Apply Now</a></li>
                        <li><a href="login.php">Student Login</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="form-container">
        <h2>Student Registration</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
                <br><br>
                <a href="login.php" class="btn btn-primary">Login Now</a>
            </div>
        <?php else: ?>
        
        <form method="POST" action="">
            <h3>Personal Information</h3>
            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="full_name" class="form-control" required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Phone *</label>
                    <input type="tel" name="phone" class="form-control" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Date of Birth *</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Gender *</label>
                    <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label>Address *</label>
                <textarea name="address" class="form-control" rows="3" required></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>City *</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>State *</label>
                    <input type="text" name="state" class="form-control" required>
                </div>
            </div>
            
            <div class="form-group">
                <label>Pincode *</label>
                <input type="text" name="pincode" class="form-control" maxlength="6" required>
            </div>
            
            <h3 style="margin-top: 2rem;">Academic Information</h3>
            
            <div class="form-group">
                <label>Previous School/College</label>
                <input type="text" name="previous_school" class="form-control">
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>10th Percentage *</label>
                    <input type="number" step="0.01" name="percentage_10th" class="form-control" min="0" max="100" required>
                </div>
                <div class="form-group">
                    <label>12th Percentage</label>
                    <input type="number" step="0.01" name="percentage_12th" class="form-control" min="0" max="100">
                </div>
            </div>
            
            <div class="form-group">
                <label>Course Applied For *</label>
                <select name="course_applied" class="form-control" required>
                    <option value="">Select Course</option>
                    <?php
                    if ($courses_result && $courses_result->num_rows > 0) {
                        while($course = $courses_result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($course['course_name']) . '">' . htmlspecialchars($course['course_name']) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            
            <h3 style="margin-top: 2rem;">Account Information</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" class="form-control" minlength="6" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password *</label>
                    <input type="password" name="confirm_password" class="form-control" minlength="6" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Register</button>
        </form>
        
        <p style="text-align: center; margin-top: 1.5rem;">
            Already have an account? <a href="login.php">Login here</a>
        </p>
        <?php endif; ?>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
        </div>
    </footer>
    
    <script>
        // Password validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]').value;
            const confirm = document.querySelector('input[name="confirm_password"]').value;
            
            if (password !== confirm) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        });
    </script>
</body>
</html>
