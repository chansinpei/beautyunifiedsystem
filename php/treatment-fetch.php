<?php
require 'db.php';
header('Content-Type: application/json');

$sql = "SELECT * FROM treatment_records ORDER BY id DESC";
$result = $conn->query($sql);

$records = [];
$publicUploadsURL = 'uploads/'; // relative to HTML at root

while ($row = $result->fetch_assoc()) {
    $records[] = [
        'id' => $row['id'],
        'customer' => $row['customer'],
        'staff' => $row['staff'],
        'treatment' => $row['treatment'],
        'category' => $row['category'],
        'date' => $row['date'],
        'duration' => '60 min',
        'price' => 'RM ' . $row['price'],
        'status' => 'Completed',
        'notes' => $row['notes'],
        'products' => array_map('trim', explode(',', $row['products'])),
        'nextAppointment' => $row['next_appointment'],
        'beforePhoto' => !empty($row['before_photo']) ? $publicUploadsURL . $row['before_photo'] : '',
        'afterPhoto'  => !empty($row['after_photo']) ? $publicUploadsURL . $row['after_photo'] : ''
    ];
}

echo json_encode([
    'status' => 'success',
    'records' => $records
]);

$conn->close();
?>
