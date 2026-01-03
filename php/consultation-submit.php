<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'db.php';
header('Content-Type: application/json'); // must be before any output




// 1️⃣ Check if user is logged in
$user_id = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;

if (!$user_id || !$role) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// 2️⃣ Collect customer info from POST safely
$fullName = trim($_POST['fullName'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$dateOfBirth = $_POST['dateOfBirth'] ?? null;
$gender = $_POST['gender'] ?? '';
$streetAddress = trim($_POST['streetAddress'] ?? '');
$city = trim($_POST['city'] ?? '');
$state = trim($_POST['state'] ?? '');
$postalCode = trim($_POST['postalCode'] ?? '');
$emergencyContact = trim($_POST['emergencyContact'] ?? '');
$emergencyPhone = trim($_POST['emergencyPhone'] ?? '');

// 3️⃣ Collect consultation info
$selectedPackage = $_POST['selectedPackage'] ?? '';
$preferredDate = $_POST['preferredDate'] ?? null;
$preferredTime = $_POST['preferredTime'] ?? '';
$skinType = $_POST['skinType'] ?? '';
$mainConcerns = trim($_POST['concerns'] ?? '');
$medicalHistory = trim($_POST['medicalHistory'] ?? '');
$allergies = trim($_POST['allergies'] ?? '');
$currentMedications = trim($_POST['currentMedications'] ?? '');
$previousTreatments = trim($_POST['previousTreatments'] ?? '');
$lifestyle = trim($_POST['lifestyle'] ?? '');
$consent = isset($_POST['consent']) ? 1 : 0;

// Everyone uses their own user ID as staff_id

$staff_id_for_db = $_SESSION['user_id']; // logged-in user (admin or staff)

// Now save $staff_id_for_db into your database along with the other form fields



// 5️⃣ Insert customer info
$customerStmt = $conn->prepare("
    INSERT INTO customers (
        full_name, email, phone, date_of_birth, gender,
        emergency_contact, emergency_phone,
        streetAddress, city, state, postalCode
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$customerStmt->bind_param(
    "sssssssssss",
    $fullName, $email, $phone, $dateOfBirth, $gender,
    $emergencyContact, $emergencyPhone,
    $streetAddress, $city, $state, $postalCode
);

if (!$customerStmt->execute()) {
    echo json_encode(['success' => false, 'message' => "Customer insert error: ".$customerStmt->error]);
    exit;
}

$customer_id = $customerStmt->insert_id;

// 6️⃣ Insert consultation info
$consultStmt = $conn->prepare("
    INSERT INTO consultations (
        customer_id, staff_id, submitted_by_role,
        selected_package, preferred_date, preferred_time, skin_type,
        main_concerns, medical_history, allergies, current_medications,
        previous_treatments, lifestyle, consent
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$consultStmt->bind_param(
    "iisssssssssssi",
    $customer_id, $staff_id_for_db, $role,
    $selectedPackage, $preferredDate, $preferredTime, $skinType,
    $mainConcerns, $medicalHistory, $allergies, $currentMedications,
    $previousTreatments, $lifestyle, $consent
);

if (!$consultStmt->execute()) {
    echo json_encode(['success' => false, 'message' => "Consultation insert error: ".$consultStmt->error]);
    exit;
}

// 7️⃣ Success → Role-based redirect
$redirectURL = ($role === 'admin') ? '/beautyunifiedsystem/customer-records.html?success=1' : '/beautyunifiedsystem/my-customer.html?success=1';
echo json_encode(['success' => true, 'redirect' => $redirectURL]);

// Close statements and connection
$customerStmt->close();
$consultStmt->close();
$conn->close();
exit;
?>
