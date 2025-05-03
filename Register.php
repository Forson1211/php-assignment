<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Style.css?v=1.0">
<link rel="stylesheet" href="src/assets/assets/css/mobile.css" media="screen and (max-width: 768px)">
</head>
<?php
require_once 'Config.php';
require_once 'Functions.php';

$pageTitle = "Register";
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = sanitize($_POST['firstName']);
    $lastName = sanitize($_POST['lastName']);
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    // Validate inputs
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long.';
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $error = 'Email already registered.';
        } else {
            // Create new user
            $registrationNumber = generateRegistrationNumber();
            $hashedPassword = hashPassword($password);
            
            $stmt = $pdo->prepare("INSERT INTO users (registration_number, first_name, last_name, email, password) VALUES (?, ?, ?, ?, ?)");
            $result = $stmt->execute([$registrationNumber, $firstName, $lastName, $email, $hashedPassword]);
            
            if ($result) {
                $_SESSION['success_message'] = 'Registration successful! You can now login.';
                redirect('login.php');
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}

require_once 'Header.php';
?>

<main class="auth-page">
    <div class="container">
        <div class="auth-form">
            <h2>Create an Account</h2>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" required value="<?php echo isset($firstName) ? $firstName : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" required value="<?php echo isset($lastName) ? $lastName : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required value="<?php echo isset($email) ? $email : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password (min 8 characters)</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>
                <button type="submit" class="btn-primary">Register</button>
            </form>
            
            <div class="auth-links">
                <p>Already have an account? <a href="server/pages/login.php">Login here</a></p>
            </div>
        </div>
    </div>
</main>

<?php require_once 'footer.php'; ?>