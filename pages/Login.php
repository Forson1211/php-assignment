<?php
require_once 'pages/includes/Config.php';
require_once 'pages/includes/Functions.php';

$pageTitle = "Login";
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    
    if (!checkLoginAttempts($email, $pdo)) {
        $error = 'Account locked due to too many failed attempts. Please try again in 3 minutes.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && verifyPassword($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            
            $stmt = $pdo->prepare("UPDATE users SET login_attempts = 0, locked_until = NULL WHERE id = ?");
            $stmt->execute([$user['id']]);
            
            redirect('dashboard');
        } else {
            $error = 'Invalid email or password.';
            
            if ($user) {
                $newAttempts = $user['login_attempts'] + 1;
                $lockedUntil = null;
                
                if ($newAttempts >= 3) {
                    $lockedUntil = date('Y-m-d H:i:s', strtotime('+3 minutes'));
                }
                
                $stmt = $pdo->prepare("UPDATE users SET login_attempts = ?, last_attempt = NOW(), locked_until = ? WHERE id = ?");
                $stmt->execute([$newAttempts, $lockedUntil, $user['id']]);
                
                if ($newAttempts >= 3) {
                    $error = 'Account locked due to too many failed attempts. Please try again in 3 minutes.';
                } else {
                    $remainingAttempts = 3 - $newAttempts;
                    $error .= " You have $remainingAttempts attempts remaining.";
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/Style.css">
    <title>Login</title>
</head>
<body>
    <main class="auth-page">
        <div class="auth-container">
            <div class="auth-image">
                <!-- <div class="a-i">
                    <img src="src/images/regg.avif" alt="register image">
                </div> -->
            </div>

            <div class="auth-form">
                <h2>Login to Your Account</h2>
                
                <?php if (!empty($error)): ?>
                    <div class="alert alert-error"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
                <?php endif; ?>
                
                <form action="/php-assignment/login" method="POST">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required value="<?php echo isset($email) ? $email : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <a href="/php-assignment/forget-password" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" class="animated-button">
                        <span>Login</span>
                        <span></span>
                    </button>
                </form>
                
                <div class="auth-links">
                    <p>Don't have an account? <a href="/php-assignment/register">Register here</a></p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>