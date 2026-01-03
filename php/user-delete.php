<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST['id'] ?? null;

  if ($id) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    echo $stmt->execute() ? "success" : "error: " . $stmt->error;
  } else {
    echo "error: Missing user ID.";
  }
}
?>
