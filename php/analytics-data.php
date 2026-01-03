<?php
include 'db.php';
ini_set('display_errors', 0);
header('Content-Type: application/json');

// ---------- Customer Age Distribution ----------
$age_labels = ['18-25','26-35','36-45','46-55','56+'];
$age_data = array_fill(0, count($age_labels), 0);

$result = $conn->query("SELECT 
    CASE 
        WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN 18 AND 25 THEN '18-25'
        WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN 26 AND 35 THEN '26-35'
        WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN 36 AND 45 THEN '36-45'
        WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN 46 AND 55 THEN '46-55'
        ELSE '56+' 
    END AS age_group, COUNT(*) AS total
    FROM customers
    GROUP BY age_group");

while ($row = $result->fetch_assoc()) {
    $index = array_search($row['age_group'], $age_labels);
    if($index !== false) $age_data[$index] = (int)$row['total'];
}

// ---------- Popular Treatments (from selected_services) ----------
$treatment_labels = [];
$treatment_counts = [];

$res = $conn->query("SELECT selected_services FROM customers WHERE selected_services != ''");
$all_services = [];

while($row = $res->fetch_assoc()){
    $services = explode(',', $row['selected_services']);
    foreach($services as $s){
        $s = trim($s);
        if($s) $all_services[] = $s;
    }
}

// Count occurrences
$service_count = array_count_values($all_services);
arsort($service_count);

$treatment_labels = array_keys($service_count);
$treatment_counts = array_values($service_count);

// ---------- Revenue Overview (Monthly) ----------
$monthly_labels = [];
$monthly_revenue = [];

for($m=1;$m<=12;$m++){
    $monthName = date('M', mktime(0,0,0,$m,1));
    $monthly_labels[] = $monthName;

    $res = $conn->query("SELECT SUM(cost) AS revenue FROM customers WHERE MONTH(consult_date)=$m");
    $row = $res->fetch_assoc();
    $monthly_revenue[] = $row['revenue'] ? (float)$row['revenue'] : 0;
}

// ---------- Activity Log (last 10) ----------
$activity_log = [];
$res = $conn->query("SELECT name AS user, consult_date AS timestamp, CONCAT('Booked: ', selected_services) AS action, 'Customer' AS type FROM customers ORDER BY consult_date DESC LIMIT 10");
while($row = $res->fetch_assoc()){
    $activity_log[] = $row;
}

// Return JSON
echo json_encode([
    'age_labels' => $age_labels,
    'age_data' => $age_data,
    'treatment_labels' => $treatment_labels,
    'treatment_counts' => $treatment_counts,
    'monthly_labels' => $monthly_labels,
    'monthly_revenue' => $monthly_revenue,
    'activity_log' => $activity_log
]);
