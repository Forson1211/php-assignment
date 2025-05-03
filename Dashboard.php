<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Style.css?v=1.0">
</head>
</html>

<?php
require_once 'Config.php';
require_once 'Functions.php';



if (!isLoggedIn()) {
    redirect('login.php');
}

$pageTitle = "Dashboard";

// Get user information
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Get user donations
$stmt = $pdo->prepare("SELECT * FROM donations WHERE user_id = ? ORDER BY donation_date DESC");
$stmt->execute([$_SESSION['user_id']]);
$donations = $stmt->fetchAll();

// Calculate total donations
$totalDonated = 0;
foreach ($donations as $donation) {
    $totalDonated += $donation['amount'];
}

require_once 'header.php';
?>

<main class="dashboard">
    <div class="container">
        <div class="dashboard-header">
            <h2>Welcome, <?php echo $user['first_name']; ?></h2>
            <p>Your registration number: <?php echo $user['registration_number']; ?></p>
        </div>
        
        <div class="dashboard-grid">
            <div class="dashboard-card profile-card">
                <h3>Your Profile</h3>
                <div class="profile-info">
                    <p><strong>Name:</strong> <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p><strong>Member Since:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
                </div>
                <div class="profile-actions">
                    <a href="edit-profile.php" class="btn-secondary">Edit Profile</a>
                    <a href="change-password.php" class="btn-secondary">Change Password</a>
                </div>
            </div>
            
            <div class="dashboard-card donation-card">
                <h3>Your Donations</h3>
                <div class="donation-total">
                    <p>Total Donated:</p>
                    <h4>$<?php echo number_format($totalDonated, 2); ?></h4>
                </div>
                
                <?php if (!empty($donations)): ?>
                    <div class="donation-history">
                        <h4>Donation History</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($donations as $donation): ?>
                                    <tr>
                                        <td><?php echo date('M j, Y', strtotime($donation['donation_date'])); ?></td>
                                        <td>$<?php echo number_format($donation['amount'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>You haven't made any donations yet.</p>
                <?php endif; ?>
                
                <a href="donate.php" class="btn-primary">Make a Donation</a>
            </div>
        </div>
    </div>
</main>

<?php require_once 'footer.php'; ?>