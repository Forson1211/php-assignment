<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="src/css/Style.css">
<link rel="stylesheet" href="src/css/mobile.css" media="screen and (max-width: 768px)">
</head>
<?php
require_once 'pages/includes/Config.php';
require_once 'pages/includes/Functions.php';

$pageTitle = "Register";
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = sanitize($_POST['firstName']);
    $lastName = sanitize($_POST['lastName']);
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $error = 'Email already registered.';
        } else {
            $registrationNumber = generateRegistrationNumber();
            $hashedPassword = hashPassword($password);
            
            $stmt = $pdo->prepare("INSERT INTO users (registration_number, first_name, last_name, email, password) VALUES (?, ?, ?, ?, ?)");
            $result = $stmt->execute([$registrationNumber, $firstName, $lastName, $email, $hashedPassword]);
            
            if ($result) {
                $_SESSION['success_message'] = 'Registration successful! You can now login.';
                redirect('login');
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}
?>

<main class="auth-page">
    <div class="auth-container">
        <div class="auth-image">
            <!-- <div class="a-i">
                <img src="src/images/regg.avif" alt="register image">
            </div> -->
        </div>

        <div class="auth-form">
            <h2>Create an Account</h2>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form action="/php-assignment/register" method="POST">
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

                <button type="submit" class="animated-button">
                    <span>Register</span>
                    <span></span>
                </button>
            </form>
            
            <div class="auth-links">
                <p>Already have an account? <a href="/php-assignment/login">Login here</a></p>
            </div>
        </div>
    </div>
</main>