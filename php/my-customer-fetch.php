<?php
session_start();
require 'db.php';

$staff_id = $_SESSION['user_id'] ?? null;
if(!$staff_id){
    echo json_encode([]);
    exit;
}

$sql = "
SELECT cu.id AS customer_id, cu.full_name, cu.email, cu.phone, cu.notes,
       TIMESTAMPDIFF(YEAR, cu.date_of_birth, CURDATE()) AS age,
       MAX(c.preferred_date) AS last_visit,
       c.id AS consult_id,
       COUNT(c.id) AS treatment_count,
       CONCAT_WS(', ', cu.streetAddress, cu.city, cu.state, cu.postalCode) AS address,
       cu.status
FROM customers cu
LEFT JOIN consultations c ON c.customer_id = cu.id
WHERE c.staff_id = ?
GROUP BY cu.id
ORDER BY last_visit DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $staff_id);
$stmt->execute();
$result = $stmt->get_result();

$customers = [];
while($row = $result->fetch_assoc()){
    $customers[] = $row;
}

echo json_encode($customers);
?>
