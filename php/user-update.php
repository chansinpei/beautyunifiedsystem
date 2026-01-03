<?php
// php/user-update.php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;
  $username = $_POST['username'] ?? '';
  $email = $_POST['email'] ?? '';
  $phone = $_POST['phone'] ?? '';
  $role = $_POST['role'] ?? 'staff';

  if (!$id || !$username || !$email) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
  }

  $stmt = $conn->prepare("UPDATE users SET username=?, email=?, phone=?, role=? WHERE id=?");
  $stmt->bind_param("ssssi", $username, $email, $phone, $role, $id);

  if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
  } else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
  }
}
