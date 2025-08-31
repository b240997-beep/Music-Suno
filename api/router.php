<?php
// Simple router for Vercel deployment
// This file handles all requests and routes them to appropriate files

// Get the request path
$path = $_GET['path'] ?? $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($path, PHP_URL_PATH);
$path = ltrim($path, '/');

// If path is empty, default to index
if (empty($path)) {
    $path = 'index.php';
}

// Add .php extension if not present and not a static file
if (!preg_match('/\.(php|css|js|jpg|jpeg|png|gif|mp3|wav|ico|svg)$/i', $path)) {
    $path .= '.php';
}

// Define the root directory (parent of api)
$rootDir = dirname(__DIR__);

// Handle static files
if (preg_match('/\.(css|js|jpg|jpeg|png|gif|mp3|wav|ico|svg)$/i', $path)) {
    $filePath = $rootDir . '/' . $path;
    if (file_exists($filePath)) {
        // Set appropriate content type
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $mimeTypes = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg', 
            'png' => 'image/png',
            'gif' => 'image/gif',
            'mp3' => 'audio/mpeg',
            'wav' => 'audio/wav',
            'ico' => 'image/x-icon',
            'svg' => 'image/svg+xml'
        ];
        
        if (isset($mimeTypes[$ext])) {
            header('Content-Type: ' . $mimeTypes[$ext]);
        }
        
        readfile($filePath);
        exit;
    }
}

// List of valid PHP files
$validFiles = [
    'index.php',
    'login.php', 
    'register.php',
    'dashboard.php',
    'playlist.php',
    'create_playlist.php',
    'add-songs.php',
    'about-us.php',
    'contact-us.php',
    'logout.php',
    'php/login.php',
    'php/register.php', 
    'php/add-songs.php',
    'php/add-to-playlist.php'
];

// Check if requested file is valid
if (in_array($path, $validFiles)) {
    $filePath = $rootDir . '/' . $path;
    if (file_exists($filePath)) {
        // Change working directory to root
        chdir($rootDir);
        include $filePath;
        exit;
    }
}

// Default to index.php
$indexPath = $rootDir . '/index.php';
if (file_exists($indexPath)) {
    chdir($rootDir);
    include $indexPath;
} else {
    http_response_code(404);
    echo "404 - Page not found";
}
?>
