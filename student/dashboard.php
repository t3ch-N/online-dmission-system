<?php
require_once '../includes/config.php';

if (!is_student()) {
    redirect('login.php');
}

$student_id = $_SESSION['student_id'];
$sql = "SELECT * FROM students WHERE id = $student_id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - <?php echo SITE_NAME; ?></title>
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
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="dashboard">
        <div class="container">
            <h2>Welcome, <?php echo htmlspecialchars($student['full_name']); ?>!</h2>
            <p>Application ID: <strong><?php echo htmlspecialchars($student['application_id']); ?></strong></p>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Application Status</h3>
                    <p class="stat-value">
                        <?php
                        $status_class = '';
                        switch($student['status']) {
                            case 'Approved':
                                $status_class = 'badge-success';
                                break;
                            case 'Rejected':
                                $status_class = 'badge-danger';
                                break;
                            default:
                                $status_class = 'badge-pending';
                        }
                        ?>
                        <span class="badge <?php echo $status_class; ?>"><?php echo $student['status']; ?></span>
                    </p>
                </div>
                
                <div class="stat-card">
                    <h3>Course Applied</h3>
                    <p class="stat-value" style="font-size: 1.2rem;"><?php echo htmlspecialchars($student['course_applied']); ?></p>
                </div>
                
                <div class="stat-card">
                    <h3>CUEE Marks</h3>
                    <p class="stat-value"><?php echo $student['cuee_marks'] ? $student['cuee_marks'] : 'Not Updated'; ?></p>
                </div>
                
                <div class="stat-card">
                    <h3>Result Status</h3>
                    <p class="stat-value">
                        <span class="badge <?php echo $student['result_status'] == 'Pass' ? 'badge-success' : ($student['result_status'] == 'Fail' ? 'badge-danger' : 'badge-pending'); ?>">
                            <?php echo $student['result_status']; ?>
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>Quick Actions</h3>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                    <a href="profile.php" class="btn btn-primary">Complete Profile</a>
                    <?php if ($student['status'] == 'Approved'): ?>
                        <a href="admit-card.php" class="btn btn-success">Download Admit Card</a>
                    <?php endif; ?>
                    <?php if ($student['result_status'] != 'Pending'): ?>
                        <a href="result.php" class="btn btn-secondary">View Result</a>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>Application Details</h3>
                </div>
                <table style="width: 100%;">
                    <tr>
                        <td><strong>Full Name:</strong></td>
                        <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td><?php echo htmlspecialchars($student['phone']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date of Birth:</strong></td>
                        <td><?php echo date('d-m-Y', strtotime($student['dob'])); ?></td>
                    </tr>
                    <tr>
                        <td><strong>10th Percentage:</strong></td>
                        <td><?php echo $student['percentage_10th']; ?>%</td>
                    </tr>
                    <tr>
                        <td><strong>12th Percentage:</strong></td>
                        <td><?php echo $student['percentage_12th'] ? $student['percentage_12th'] . '%' : 'N/A'; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Application Date:</strong></td>
                        <td><?php echo date('d-m-Y', strtotime($student['created_at'])); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
