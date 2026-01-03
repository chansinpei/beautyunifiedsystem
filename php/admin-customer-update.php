<?php
session_start();
header('Content-Type: application/json');
require 'db.php';

// 🔒 Admin only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input['consult_id'] ?? false) {
    echo json_encode(['success' => false, 'message' => 'Consultation ID missing']);
    exit;
}

$consult_id = intval($input['consult_id']);
$phone = trim($input['phone'] ?? '');
$status = $input['status'] ?? 'active';
$address = trim($input['address'] ?? '');
$notes = trim($input['notes'] ?? '');

// Build full address from components if needed
// Here we just save what admin typed in modalAddress
$fullAddress = $address;

try {
    // 1️⃣ Get the customer_id linked to this consultation
    $stmt = $conn->prepare("SELECT customer_id FROM consultations WHERE id = ?");
    $stmt->bind_param("i", $consult_id);
    $stmt->execute();
    $stmt->bind_result($customer_id);
    if (!$stmt->fetch()) {
        throw new Exception("Consultation not found");
    }
    $stmt->close();

    // 2️⃣ Update only allowed fields in customers table
    $stmt = $conn->prepare("
        UPDATE customers
        SET phone = ?, status = ?, notes = ?, streetAddress = ?
        WHERE id = ?
    ");
    $stmt->bind_param("ssssi", $phone, $status, $notes, $fullAddress, $customer_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Customer updated successfully']);
    } else {
        throw new Exception("Failed to update customer: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
