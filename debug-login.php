<?php
header('Content-Type: application/json');

echo json_encode([
    'debug' => true,
    'request_method' => $_SERVER['REQUEST_METHOD'],
    'post_data' => $_POST,
    'php_version' => phpversion(),
    'session_status' => session_status()
]);
?>
