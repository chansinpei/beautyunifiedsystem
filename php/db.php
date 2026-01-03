
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "image_encryption_db";

$conn = new mysqli($host, $user, $pass, $db);

// Set charset
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}
