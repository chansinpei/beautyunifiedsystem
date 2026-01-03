<?php
session_start();
require 'db.php';      // Your database connection
require 'crypto.php';  // AES encryption functions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_SESSION['user_id'] ?? null;

    // 1️⃣ Collect POST data safely
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $company = trim($_POST['company'] ?? '');
    $position = trim($_POST['position'] ?? '');
    $date_submitted = $_POST['date'] ?? date('Y-m-d');
    $additional_notes = trim($_POST['additional_notes'] ?? '');

    // 2️⃣ Check consent checkboxes
    $consent_encryption      = isset($_POST['consent_encryption']) ? 1 : 0;
    $consent_data_collection = isset($_POST['consent_data_collection']) ? 1 : 0;
    $consent_data_processing = isset($_POST['consent_data_processing']) ? 1 : 0;
    $consent_secure_storage  = isset($_POST['consent_secure_storage']) ? 1 : 0;
    $final_consent           = isset($_POST['final_consent']) ? 1 : 0;

    if (!$final_consent) {
        die("Final agreement consent is required.");
    }

    // 3️⃣ Handle signature upload from canvas (base64)
    $signature_data = $_POST['signature_uploaded'] ?? '';
    $signature_path = null;

    if (!empty($signature_data)) {
        if (preg_match('/^data:image\/(\w+);base64,/', $signature_data, $type)) {
            $signature_data = substr($signature_data, strpos($signature_data, ',') + 1);
            $type = strtolower($type[1]); // jpg, jpeg, png

            if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                die('Invalid signature format.');
            }

            $signature_data = base64_decode($signature_data);
            if ($signature_data === false) die('Base64 decode failed.');

            $signature_path = 'uploads/signature_' . time() . '.' . $type;
            if (!file_put_contents($signature_path, $signature_data)) {
                die('Failed to save signature.');
            }
        }
    }

    // 4️⃣ Encrypt sensitive fields
    $encrypted_name      = encryptData($full_name);
    $encrypted_email     = encryptData($email);
    $encrypted_phone     = encryptData($phone);
    $encrypted_signature = $signature_path ? encryptData($signature_path) : null;

    // 5️⃣ Prepare SQL insert
    $stmt = $conn->prepare("
        INSERT INTO encryption_agreements 
        (user_id, full_name, email, phone, company, position, digital_signature, additional_notes, 
         final_consent, date_submitted, consent_encryption, consent_data_collection, consent_data_processing, consent_secure_storage)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // 6️⃣ Bind parameters (matches database order)
    $stmt->bind_param(
    "isssssssisiiii",
    $user_id,
    $encrypted_name,
    $encrypted_email,
    $encrypted_phone,
    $company,
    $position,
    $encrypted_signature,
    $additional_notes,
    $final_consent,
    $date_submitted,
    $consent_encryption,
    $consent_data_collection,
    $consent_data_processing,
    $consent_secure_storage
);


    // 7️⃣ Execute and redirect
    if ($stmt->execute()) {
        header("Location: ../success.html");
        exit;
    } else {
        echo "Error saving agreement: " . $stmt->error;
    }

} else {
    die("Invalid request method.");
}
?>
