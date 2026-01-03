<?php
include 'db.php';

header('Content-Type: application/json');

// Fetch all logs
$sql = "SELECT * FROM activity_log ORDER BY timestamp DESC";
$result = $conn->query($sql);

$logs = [];
while($row = $result->fetch_assoc()){
    $logs[] = $row;
}

echo json_encode($logs);
?>
