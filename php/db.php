<?php
// Railway MySQL Database Configuration
$host = "mysql.railway.internal";  // Railway internal host
$user = "root";                    // Username
$pass = "YbEqYFn1ouxVgowkoocCnxxJYTUjxNYU";  // Your Railway password
$db   = "railway";                 // Database name from Railway
$port = "3306";                    // Railway MySQL port

// Create connection
$conn = new mysqli($host, $user, $pass, $db, $port);

// Set charset
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    // Don't echo JSON - your login.php expects this format
    die("Database connection failed: " . $conn->connect_error);
}
?>
