<?php
session_start();
header('Content-Type: application/json');
require 'db.php';

// Admin only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode([]);
    exit;
}

$sql = "
SELECT
    cu.id AS customer_id,
    cu.full_name,
    cu.phone,
    cu.email,
    cu.status,
    cu.notes,
    CONCAT_WS(', ', cu.streetAddress, cu.city, cu.state, cu.postalCode) AS address,
    TIMESTAMPDIFF(YEAR, cu.date_of_birth, CURDATE()) AS age,
    MAX(c.preferred_date) AS last_visit,
    c.id AS consult_id,        -- this is the latest consultation ID
    COUNT(c.id) AS treatment_count
FROM customers cu
LEFT JOIN consultations c ON c.customer_id = cu.id
GROUP BY cu.id
ORDER BY last_visit DESC
";


$result = $conn->query($sql);
$data = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
$conn->close();
