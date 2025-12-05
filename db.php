<?php
// Database configuration that works in all environments

// Check if DATABASE_URL environment variable exists (Production/Render)
if (getenv('DATABASE_URL')) {
    // Production: Parse DATABASE_URL
    $db_url = parse_url(getenv('DATABASE_URL'));
    
    $host = $db_url['host'];
    $user = $db_url['user'];
    $pass = $db_url['pass'];
    $db   = ltrim($db_url['path'], '/');
    $port = isset($db_url['port']) ? $db_url['port'] : 3306;
    
    // Create connection with port
    $conn = new mysqli($host, $user, $pass, $db, $port);
    
} elseif (file_exists('/var/run/mysqld/mysqld.sock')) {
    // Docker environment - use socket connection
    $host = "localhost:/var/run/mysqld/mysqld.sock";
    $user = "root";
    $pass = "";
    $db   = "mydb1";
    
    $conn = new mysqli($host, $user, $pass, $db);
    
} else {
    // Local development (XAMPP/WAMP)
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "mydb1";
    
    // Try default connection
    $conn = @new mysqli($host, $user, $pass, $db);
    
    // If fails, try with explicit port
    if ($conn->connect_error) {
        $conn = new mysqli($host, $user, $pass, $db, 3306);
    }
    
    // If still fails, try 127.0.0.1 instead of localhost
    if ($conn->connect_error) {
        $host = "127.0.0.1";
        $conn = new mysqli($host, $user, $pass, $db, 3306);
    }
}

// Check connection
if ($conn->connect_error) {
    // Log detailed error for debugging
    error_log("Database connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error . "<br>Host: " . $host);
}

// Set charset to UTF-8
$conn->set_charset("utf8mb4");
?>
