<?php
session_start();
header('Content-Type: application/json');
require 'db.php';

$staff_id = $_SESSION['user_id']; // staff logged in

$input = json_decode(file_get_contents('php://input'), true);
$consult_id = intval($input['consult_id'] ?? 0);

if (!$consult_id) {
    echo json_encode(['success' => false, 'message' => 'Consult ID missing']);
    exit;
}

// Only allow staff to update their own customers
$sql = "UPDATE customer_records 
        SET phone=?, age=?, last_visit=?, treatment_count=?, status=?, address=?, notes=? 
        WHERE consult_id=? AND staff_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssssii", 
    $input['phone'], $input['age'], $input['last_visit'], $input['treatment_count'],
    $input['status'], $input['address'], $input['notes'], $consult_id, $staff_id
);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}

$stmt->close();
$conn->close();
?>
