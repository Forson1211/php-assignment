<?php
require_once 'pages/includes/Functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' : ''; ?><?php echo SITE_NAME; ?></title>
    <meta name="description" content="Join the fight against plastic pollution. Learn how you can help reduce plastic waste in our oceans and environment.">
    <link rel="stylesheet" type="text/css" href="src/css/Style.css">
    <link rel="stylesheet" href="src/css/mobile.css" media="screen and (max-width: 768px)">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div style="margin-bottom: 70px;">
        <header>
            <div class="container">
                <div class="logo">
                    <h1><a href="/">Plastic<span>Pollutions</span></a></h1>
                </div>
                <nav class="main-nav">
                    <ul>
                        <li><a href="/php-assignment/">Home</a></li>
                        <li class="dropdown">
                            <div class="menu">
                                <div class="item">
                                    <a href="#" class="link">
                                        <span> Our Services </span>
                                        <svg viewBox="0 0 360 360" xml:space="preserve">
                                            <g id="SVGRepo_iconCarrier">
                                            <path
                                                id="XMLID_225_"
                                                d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393 c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393 s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z"
                                            ></path>
                                            </g>
                                        </svg>
                                    </a>
                                    <div class="submenu">
                                        <div class="submenu-item">
                                            <a href="about" class="submenu-link">What to Do</a>
                                        </div>
                                        <div class="submenu-item">
                                            <a href="strategy" class="submenu-link">Our Strategy</a>
                                        </div>
                                        <div class="submenu-item">
                                            <a href="campaigns" class="submenu-link">Campaigns</a>
                                        </div>
                                        <div class="submenu-item">
                                            <a href="developers" class="submenu-link">Meet the team</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="/php-assignment/latest">Latest News</a></li>
                        <li><a href="/php-assignment/help">How to Help</a></li>
                        <li><a href="/php-assignment/contact">Contact Us</a></li>
                        <?php if (isLoggedIn()): ?>
                            <li><a href="/php-assignment/dashboard">Dashboard</a></li>
                            <li><a href="/php-assignment/logout">Logout</a></li>
                        <?php else: ?>
                            <li><a href="/php-assignment/login">Login</a></li>
                            <li><a href="/php-assignment/register">Register</a></li>
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
    </div>
</body>
</html>