<?php
session_start();
echo "User ID: " . ($_SESSION['user_id'] ?? 'No session set');
echo "<br>Username: " . ($_SESSION['username'] ?? 'No username set');
echo "<br>Role: " . ($_SESSION['role'] ?? 'No role set');
?>
