<?php
require_once 'Functions.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' : ''; ?><?php echo SITE_NAME; ?></title>
    <meta name="description" content="Join the fight against plastic pollution. Learn how you can help reduce plastic waste in our oceans and environment.">
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" href="mobile.css" media="screen and (max-width: 768px)">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1><a href="index.php">Plastic<span>Pollutions</span></a></h1>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="dropdown">
                        <a href="about.php">About Plastic <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="about.php">What to Do</a></li>
                            <li><a href="strategy.php">Our Strategy</a></li>
                            <li><a href="campaigns.php">Campaigns</a></li>
                        </ul>
                    </li>
                    <li><a href="latest.php">Latest News</a></li>
                    <li><a href="help.php">How to Help</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <?php if (isLoggedIn()): ?>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <div class="cookie-consent" id="cookieConsent">
        <div class="cookie-content">
            <p>We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.</p>
            <div class="cookie-buttons">
                <button id="acceptCookies">Accept</button>
                <button id="learnMore">Learn More</button>
            </div>
        </div>
    </div>

    <script src="main.js"></script>
    <script src="cookies.js"></script>
    <?php if (basename($_SERVER['PHP_SELF']) == 'index.php'): ?>
        <script src="slider.js"></script>
    <?php endif; ?>
</body>
</html>