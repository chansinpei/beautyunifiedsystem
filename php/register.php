<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email    = $_POST['email'] ?? '';
    $phone    = $_POST['phone'] ?? '';

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if user already registered
    $check = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if($check->num_rows > 0){
        echo "error: Email already registered";
        exit;
    }

    // Insert new staff user (pending admin approval)
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, phone, role, status) VALUES (?, ?, ?, ?, 'staff', 'pending')");
    $stmt->bind_param("ssss", $username, $hashedPassword, $email, $phone);

    if($stmt->execute()){
        echo "pending"; // Account created, waiting admin approval
    } else {
        echo "error: ".$stmt->error;
    }
}
?>
