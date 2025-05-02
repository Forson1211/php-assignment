<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'plastic_pollution_db');

define('SITE_NAME', 'PlasticPollutions');
define('SITE_URL', 'http://localhost/plastic_pollution');
define('TWITTER_USERNAME', 'PlasticPollutionsPU');

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    // $pdo->setAttribute(constant('PDO::ATTR_ERRMODE'), constant('PDO::ATTR_ERRMODE_EXCEPTION'));
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>