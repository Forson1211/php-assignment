<?php
require_once 'pages/includes/Config.php';
require_once 'pages/includes/Functions.php';

if (!isLoggedIn()) {
    redirect('login');
}

$pageTitle = "Change Password";
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        $error = 'All fields are required.';
    } elseif ($newPassword !== $confirmPassword) {
        $error = 'New passwords do not match.';
    } elseif (strlen($newPassword) < 8) {
        $error = 'Password must be at least 8 characters long.';
    } else {
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
        
        if (!password_verify($currentPassword, $user['password'])) {
            $error = 'Current password is incorrect.';
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $result = $stmt->execute([$hashedPassword, $_SESSION['user_id']]);
            
            if ($result) {
                $success = true;
                
                $to = $_SESSION['user_email'];
                $subject = 'Your password has been changed';
                $message = "Dear " . $_SESSION['user_name'] . ",\n\nThis is to confirm that your password for PlasticPollutions has been successfully changed.\n\nIf you did not make this change, please contact us immediately.\n\nSincerely,\nThe PlasticPollutions Team";
                $headers = 'From: no-reply@plasticpollutions.com';
            } else {
                $error = 'Failed to update password. Please try again.';
            }
        }
    }
}

require_once 'pages/includes/Header.php';
?>

<main class="password-change-page">
    <div class="password-container">
        <div class="dashboard-header">
            <h2>Change Your Password</h2>
            <p>For security, please enter your current password and then your new password</p>
        </div>
        
        <div class="dashboard-card">
            <?php if ($success): ?>
                <div class="alert alert-success">
                    Your password has been updated successfully!
                </div>
                <a href="dashboard" class="btn-primary">Back to Dashboard</a>
            <?php else: ?>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-error"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form action="change_password" method="POST">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="newPassword">New Password (min 8 characters)</label>
                        <input type="password" id="newPassword" name="newPassword" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    
                    <div style="display: flex;">
                        <button type="submit" class="btn-primary">Change Password</button>
                        <a href="dashboard" class="btn-primary cns">Cancel</a>
                    </div>
                    
                </form>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once 'pages/includes/Footer.php'; ?>