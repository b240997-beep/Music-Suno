<?php
date_default_timezone_set("Asia/Kolkata");
error_reporting(1);

// Database configuration for production (Vercel) and development
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    // Production environment (Vercel)
    $dbhost = $_ENV['DB_HOST'] ?? 'localhost';
    $dbuser = $_ENV['DB_USER'] ?? 'root';
    $dbpass = $_ENV['DB_PASS'] ?? '';
    $dbname = $_ENV['DB_NAME'] ?? 'music';
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
