<?php
require_once 'config.php';
require_once 'functions.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$pageTitle = "Edit Profile";
$success = false;
$error = '';

// Get current user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = sanitize($_POST['firstName']);
    $lastName = sanitize($_POST['lastName']);
    $email = sanitize($_POST['email']);
    
    // Validate inputs
    if (empty($firstName) || empty($lastName) || empty($email)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Check if email is being changed to one that already exists
        if ($email !== $user['email']) {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $error = 'Email already in use by another account.';
            }
        }
        
        if (empty($error)) {
            // Update user profile
            $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
            $result = $stmt->execute([$firstName, $lastName, $email, $_SESSION['user_id']]);
            
            if ($result) {
                // Update session data
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $firstName . ' ' . $lastName;
                
                $success = true;
                $user['first_name'] = $firstName;
                $user['last_name'] = $lastName;
                $user['email'] = $email;
            } else {
                $error = 'Failed to update profile. Please try again.';
            }
        }
    }
}

require_once 'header.php';
?>

<main class="dashboard-page">
    <div class="container">
        <div class="dashboard-header">
            <h2>Edit Your Profile</h2>
            <p>Update your personal information</p>
        </div>
        
        <div class="dashboard-card">
            <?php if ($success): ?>
                <div class="alert alert-success">
                    Your profile has been updated successfully!
                </div>
            <?php elseif (!empty($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form action="edit-profile.php" method="POST">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" required value="<?php echo htmlspecialchars($user['first_name']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" required value="<?php echo htmlspecialchars($user['last_name']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>
                
                <button type="submit" class="btn-primary">Save Changes</button>
                <a href="dashboard.php" class="btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</main>

<?php require_once 'footer.php'; ?>