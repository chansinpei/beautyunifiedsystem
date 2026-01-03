<?php
session_start();
header('Content-Type: application/json');
require 'db.php';

// Admin only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success'=>false, 'message'=>'Unauthorized']);
    exit;
}

// Read JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['consult_id'])) {  // ✅ must match JS
    echo json_encode(['success'=>false, 'message'=>'Consult ID missing']);
    exit;
}

$consult_id = intval($input['consult_id']);

$conn->begin_transaction();

try {
    // 1️⃣ Get linked customer
    $stmt = $conn->prepare("SELECT customer_id FROM consultations WHERE id = ?"); // id = DB column
    $stmt->bind_param("i", $consult_id);
    $stmt->execute();
    $stmt->bind_result($customer_id);
    if (!$stmt->fetch()) throw new Exception("Consultation not found");
    $stmt->close();

    // 2️⃣ Delete consultation
    $stmt = $conn->prepare("DELETE FROM consultations WHERE id = ?");
    $stmt->bind_param("i", $consult_id);
    if (!$stmt->execute()) throw new Exception("Failed to delete consultation");
    $stmt->close();

    // 3️⃣ Delete customer
    $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->bind_param("i", $customer_id);
    if (!$stmt->execute()) throw new Exception("Failed to delete customer");
    $stmt->close();

    $conn->commit();
    echo json_encode(['success'=>true]);

} catch(Exception $e) {
    $conn->rollback();
    echo json_encode(['success'=>false, 'message'=>$e->getMessage()]);
}

$conn->close();
?>
