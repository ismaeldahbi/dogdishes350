<?php
// Database configuration for Render

// Check if we're on Render (uses environment variables)
if (getenv('DATABASE_URL')) {
    // Production: Parse Render's DATABASE_URL
    $db_url = parse_url(getenv('DATABASE_URL'));
    
    $host = $db_url['host'];
    $user = $db_url['user'];
    $pass = $db_url['pass'];
    $db   = ltrim($db_url['path'], '/');
    $port = isset($db_url['port']) ? $db_url['port'] : 3306;
    
    $conn = new mysqli($host, $user, $pass, $db, $port);
} else {
    // Local development
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "mydb1";
    
    $conn = new mysqli($host, $user, $pass, $db);
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8
$conn->set_charset("utf8mb4");
?>
