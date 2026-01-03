<?php
session_start();
require 'db.php';      // DB connection

// Assuming admin ID = 1 (or use $_SESSION['user_id'])
$admin_id = 1;
$success = $error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $position = $_POST['position'] ?? '';
    $department = $_POST['department'] ?? '';
    $bio = $_POST['bio'] ?? '';

    $stmt = $conn->prepare("UPDATE admin_users SET first_name=?, last_name=?, email=?, phone=?, position=?, department=?, bio=? WHERE id=?");
    $stmt->bind_param("sssssssi", $first_name, $last_name, $email, $phone, $position, $department, $bio, $admin_id);

    if ($stmt->execute()) {
        $success = "Profile updated successfully!";
    } else {
        $error = "Error updating profile: " . $stmt->error;
    }
}

// Fetch current admin data
$stmt = $conn->prepare("SELECT * FROM admin_users WHERE id=?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-rose-100 min-h-screen py-10 px-4 flex justify-center">

  <div class="max-w-4xl w-full bg-white rounded-2xl shadow p-8 space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h2 class="text-2xl font-bold text-rose-600">Admin Profile</h2>
        <p class="text-gray-600 text-sm">Manage your account settings and preferences</p>
      </div>
      <div class="flex items-center gap-4">
        <div class="bg-gray-200 rounded-full w-12 h-12 flex items-center justify-center text-lg font-semibold text-gray-700">
          <?= strtoupper(substr($admin['first_name'],0,1) . substr($admin['last_name'],0,1)) ?>
        </div>
        <div class="text-right">
          <p class="font-semibold"><?= htmlspecialchars($admin['first_name'] . ' ' . $admin['last_name']) ?></p>
          <p class="text-gray-500 text-sm"><?= htmlspecialchars($admin['position']) ?></p>
          <p class="text-gray-500 text-sm"><?= htmlspecialchars($admin['department']) ?></p>
        </div>
      </div>
    </div>

    <!-- Tabs -->
    <div class="border-b border-gray-200 mb-6">
      <nav class="-mb-px flex space-x-8" aria-label="Tabs">
        <a href="#" class="text-rose-600 whitespace-nowrap pb-4 px-1 border-b-2 border-rose-600 font-medium text-sm">Personal Info</a>
        <a href="#" class="text-gray-500 hover:text-gray-700 whitespace-nowrap pb-4 px-1 font-medium text-sm">Security</a>
        <a href="#" class="text-gray-500 hover:text-gray-700 whitespace-nowrap pb-4 px-1 font-medium text-sm">Notifications</a>
        <a href="#" class="text-gray-500 hover:text-gray-700 whitespace-nowrap pb-4 px-1 font-medium text-sm">Preferences</a>
      </nav>
    </div>

    <!-- Success/Error Messages -->
    <?php if($success): ?>
      <p class="bg-green-100 text-green-700 p-3 rounded"><?= $success ?></p>
    <?php endif; ?>
    <?php if($error): ?>
      <p class="bg-red-100 text-red-700 p-3 rounded"><?= $error ?></p>
    <?php endif; ?>

    <!-- Profile Form -->
    <form method="POST" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-gray-700 font-medium mb-1" for="first_name">First Name</label>
          <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($admin['first_name']) ?>" class="border rounded p-3 w-full" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-1" for="last_name">Last Name</label>
          <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($admin['last_name']) ?>" class="border rounded p-3 w-full" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-1" for="email">Email Address</label>
          <input type="email" id="email" name="email" value="<?= htmlspecialchars($admin['email']) ?>" class="border rounded p-3 w-full" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-1" for="phone">Phone Number</label>
          <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($admin['phone']) ?>" class="border rounded p-3 w-full" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-1" for="position">Position</label>
          <input type="text" id="position" name="position" value="<?= htmlspecialchars($admin['position']) ?>" class="border rounded p-3 w-full" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-1" for="department">Department</label>
          <input type="text" id="department" name="department" value="<?= htmlspecialchars($admin['department']) ?>" class="border rounded p-3 w-full" />
        </div>
      </div>

      <!-- Bio -->
      <div>
        <label class="block text-gray-700 font-medium mb-1" for="bio">Bio</label>
        <textarea id="bio" name="bio" maxlength="500" class="border rounded p-3 w-full h-24"><?= htmlspecialchars($admin['bio']) ?></textarea>
        <p class="text-gray-500 text-sm mt-1">0/500 characters</p>
      </div>

      <!-- Save Button -->
      <div class="text-center">
        <button type="submit" class="bg-rose-500 text-white px-8 py-3 rounded-xl hover:bg-rose-600 transition">
          Save Changes
        </button>
      </div>
    </form>
  </div>

</body>
</html>
