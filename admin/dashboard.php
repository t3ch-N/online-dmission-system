<?php
require_once '../includes/config.php';

if (!is_admin()) {
    redirect('login.php');
}

// Get statistics
$total_sql = "SELECT COUNT(*) as total FROM students";
$pending_sql = "SELECT COUNT(*) as pending FROM students WHERE status = 'Pending'";
$approved_sql = "SELECT COUNT(*) as approved FROM students WHERE status = 'Approved'";
$rejected_sql = "SELECT COUNT(*) as rejected FROM students WHERE status = 'Rejected'";

$total = $conn->query($total_sql)->fetch_assoc()['total'];
$pending = $conn->query($pending_sql)->fetch_assoc()['pending'];
$approved = $conn->query($approved_sql)->fetch_assoc()['approved'];
$rejected = $conn->query($rejected_sql)->fetch_assoc()['rejected'];

// Handle application status update
if (isset($_POST['update_status'])) {
    $student_id = (int)$_POST['student_id'];
    $new_status = sanitize_input($_POST['status']);
    
    $update_sql = "UPDATE students SET status = '$new_status' WHERE id = $student_id";
    if ($conn->query($update_sql)) {
        // Send email notification
        $student_sql = "SELECT email, full_name FROM students WHERE id = $student_id";
        $student_data = $conn->query($student_sql)->fetch_assoc();
        
        $email_subject = "Application Status Update";
        $email_message = "Dear " . $student_data['full_name'] . ",<br><br>";
        $email_message .= "Your admission application status has been updated to: <strong>$new_status</strong><br><br>";
        $email_message .= "Please login to your account for more details.<br><br>";
        $email_message .= "Best regards,<br>" . SITE_NAME;
        
        send_email($student_data['email'], $email_subject, $email_message);
        
        $_SESSION['success_message'] = "Application status updated successfully!";
        redirect('dashboard.php');
    }
}

// Handle CUEE marks update
if (isset($_POST['update_cuee'])) {
    $student_id = (int)$_POST['student_id'];
    $cuee_marks = (int)$_POST['cuee_marks'];
    $result_status = $cuee_marks >= 40 ? 'Pass' : 'Fail';
    
    $update_sql = "UPDATE students SET cuee_marks = $cuee_marks, result_status = '$result_status' WHERE id = $student_id";
    if ($conn->query($update_sql)) {
        $_SESSION['success_message'] = "CUEE marks updated successfully!";
        redirect('dashboard.php');
    }
}

// Get all applications
$applications_sql = "SELECT * FROM students ORDER BY created_at DESC";
$applications = $conn->query($applications_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <h1><?php echo SITE_NAME; ?> - Admin</h1>
                </div>
                <nav>
                    <ul>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="dashboard">
        <div class="container">
            <h2>Admin Dashboard</h2>
            
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
            <?php endif; ?>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Applications</h3>
                    <p class="stat-value"><?php echo $total; ?></p>
                </div>
                
                <div class="stat-card" style="border-left-color: var(--warning-color);">
                    <h3>Pending</h3>
                    <p class="stat-value" style="color: var(--warning-color);"><?php echo $pending; ?></p>
                </div>
                
                <div class="stat-card" style="border-left-color: var(--success-color);">
                    <h3>Approved</h3>
                    <p class="stat-value" style="color: var(--success-color);"><?php echo $approved; ?></p>
                </div>
                
                <div class="stat-card" style="border-left-color: var(--danger-color);">
                    <h3>Rejected</h3>
                    <p class="stat-value" style="color: var(--danger-color);"><?php echo $rejected; ?></p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>All Applications</h3>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>App ID</th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>10th %</th>
                                <th>Status</th>
                                <th>CUEE Marks</th>
                                <th>Result</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($applications && $applications->num_rows > 0) {
                                while($app = $applications->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($app['application_id']); ?></td>
                                <td><?php echo htmlspecialchars($app['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($app['email']); ?></td>
                                <td><?php echo htmlspecialchars($app['course_applied']); ?></td>
                                <td><?php echo $app['percentage_10th']; ?>%</td>
                                <td>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="student_id" value="<?php echo $app['id']; ?>">
                                        <select name="status" class="form-control" style="width: 120px; display: inline-block;" onchange="this.form.submit()">
                                            <option value="Pending" <?php echo $app['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="Approved" <?php echo $app['status'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
                                            <option value="Rejected" <?php echo $app['status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                                        </select>
                                        <input type="hidden" name="update_status" value="1">
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="student_id" value="<?php echo $app['id']; ?>">
                                        <input type="number" name="cuee_marks" class="form-control" style="width: 80px; display: inline-block;" 
                                               value="<?php echo $app['cuee_marks']; ?>" min="0" max="100" 
                                               onchange="this.form.submit()">
                                        <input type="hidden" name="update_cuee" value="1">
                                    </form>
                                </td>
                                <td>
                                    <span class="badge <?php echo $app['result_status'] == 'Pass' ? 'badge-success' : ($app['result_status'] == 'Fail' ? 'badge-danger' : 'badge-pending'); ?>">
                                        <?php echo $app['result_status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="view-application.php?id=<?php echo $app['id']; ?>" class="btn btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.9rem;">View</a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="9" style="text-align: center;">No applications found</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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
