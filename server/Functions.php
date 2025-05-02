<?php
require_once 'server/Config.php';

// Generate registration number
function generateRegistrationNumber() {
    $prefix = "PU";
    $number = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    return $prefix . $number;
}

// Password hashing
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Verify password
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect function
function redirect($url) {
    header("Location: $url");
    exit();
}

// Sanitize input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Check login attempts
function checkLoginAttempts($email, $pdo) {
    $stmt = $pdo->prepare("SELECT login_attempts, locked_until FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && $user['locked_until'] && strtotime($user['locked_until']) > time()) {
        return false; // Account is locked
    }
    
    return true; // Account is not locked or doesn't exist
}
?>