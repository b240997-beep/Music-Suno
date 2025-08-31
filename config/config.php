<?php
date_default_timezone_set("Asia/Kolkata");
error_reporting(1);

// Database configuration for production (Vercel) and development
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || isset($_ENV['DB_HOST'])) {
    // Production environment (Vercel or other cloud)
    $dbhost = $_ENV['DB_HOST'] ?? $_SERVER['DB_HOST'] ?? 'localhost';
    $dbuser = $_ENV['DB_USER'] ?? $_SERVER['DB_USER'] ?? 'root';
    $dbpass = $_ENV['DB_PASS'] ?? $_SERVER['DB_PASS'] ?? '';
    $dbname = $_ENV['DB_NAME'] ?? $_SERVER['DB_NAME'] ?? 'music';
} else {
    // Development environment
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'music';
}

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die('Database not connected: ' . mysqli_connect_error());
}
?>
