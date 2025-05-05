<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'plastic_pollution_db');

define('SITE_NAME', 'PlasticPollutions');
define('SITE_URL', 'http://localhost/plastic_pollution');
define('TWITTER_USERNAME', 'PlasticPollutionsPU');

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    $pdo->exec("USE `" . DB_NAME . "`");

    $setupFile = __DIR__ . '/../../setup.sql';

    if (file_exists($setupFile)) {
        $sql = file_get_contents($setupFile);
        try {
            $pdo->exec($sql);
        } catch (PDOException $e) {
            die("Error running setup.sql: " . $e->getMessage());
        }
    } else {
        die("setup.sql file not found.");
    }

} catch (PDOException $e) {
    die("Database setup failed: " . $e->getMessage());
}
?>
