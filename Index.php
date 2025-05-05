<?php
$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$basePath = rtrim(string: $scriptName, characters: '/');

$route = str_replace($basePath, '', $requestUri);
$route = trim($route, '/');
$route = explode('?', $route)[0];

switch ($route) {
    case '':
    case '/':
        require 'pages/home.php';
        break;

    case 'register':
        require 'pages/Register.php';
        break;

    case 'login':
        require 'pages/login.php';
        break;

    case 'forget-password':
        require 'pages/ForgetPassword.php';
        break;    

    case 'dashboard':
        require 'pages/Dashboard.php';
        break;

    case 'contact':
        require 'pages/Contact.php';
        break;

    case 'developers':
        require 'pages/Developers.php';
        break;

    case 'about':
        require 'pages/About.php';
        break;

    case 'edit-profile':
        require 'pages/Profile.php';
        break;

    case 'donate':
        require 'pages/Donate.php';
        break;
        
    case 'help':
        require 'pages/Help.php';
        break;

    case 'privacy':
        require 'pages/privacy.php';
        break;   
        
    case 'cookies':
        require 'pages/Cookies.php';
        break;    

    case 'campaigns':
        require 'pages/Campaigns.php';
        break;      

    case 'change_password':
        require 'pages/Change_Password.php';
        break; 
        
    case 'strategy':
        require 'pages/Strategy.php';
        break;   
        
    case 'donation-receipt':
        require 'pages/DonationReciept.php';
        break;  
        
    case 'latest':
        require 'pages/News.php';
        break; 
        
    case 'logout':
        require 'pages/Logout.php';
        break;        
                
    default:
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        break;
}
