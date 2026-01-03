<?php
require 'db.php';  // your database connection
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status'=>'error','error'=>'Method Not Allowed']);
    exit;
}

// Collect POST data
$customer = $_POST['customer'] ?? '';
$staff = $_POST['staff'] ?? '';
$treatment = $_POST['treatment'] ?? '';
$category = $_POST['category'] ?? '';
$date = $_POST['date'] ?? '';
$price = $_POST['price'] ?? 0;
$notes = $_POST['notes'] ?? '';
$products = $_POST['products'] ?? '';
$next_appointment = $_POST['nextAppointment'] ?? '';

// === Upload Photos ===
// Filesystem path (PHP saves here)
$uploadsDir = __DIR__ . '/../uploads/';

$beforePhotoName = basename($_FILES['beforePhoto']['name'] ?? '');
$afterPhotoName  = basename($_FILES['afterPhoto']['name'] ?? '');

// Move files if provided
if (!empty($beforePhotoName)) {
    if (!move_uploaded_file($_FILES['beforePhoto']['tmp_name'], $uploadsDir . $beforePhotoName)) {
        echo json_encode(['status'=>'error','error'=>'Failed to upload Before Photo']);
        exit;
    }
}
if (!empty($afterPhotoName)) {
    if (!move_uploaded_file($_FILES['afterPhoto']['tmp_name'], $uploadsDir . $afterPhotoName)) {
        echo json_encode(['status'=>'error','error'=>'Failed to upload After Photo']);
        exit;
    }
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO treatment_records 
    (customer, staff, treatment, category, date, price, notes, products, before_photo, after_photo, next_appointment, created_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

$stmt->bind_param(
    "sssssdsssss", 
    $customer, $staff, $treatment, $category, $date, $price, $notes, $products, $beforePhotoName, $afterPhotoName, $next_appointment
);

if ($stmt->execute()) {
    $publicUploadsURL = 'uploads/'; // relative to HTML at root
    echo json_encode([
        'status' => 'success',
        'message' => 'Record saved successfully!',
        'beforePhotoURL' => !empty($beforePhotoName) ? $publicUploadsURL . $beforePhotoName : '',
        'afterPhotoURL'  => !empty($afterPhotoName) ? $publicUploadsURL . $afterPhotoName : ''
    ]);
} else {
    echo json_encode(['status'=>'error','error'=>$stmt->error]);
}

$stmt->close();
$conn->close();
?>
