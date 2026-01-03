<?php include 'includes/auth-check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-rose-50 via-pink-50 to-rose-100 min-h-screen flex">

<?php include 'includes/admin-sidebar.php'; ?>

<div class="flex-1 flex flex-col">

<?php include 'includes/admin-topbar.php'; ?>

<main class="p-6 max-w-7xl mx-auto w-full">

<h1 class="text-3xl font-bold text-slate-800 mb-2">Dashboard Overview</h1>
<p class="text-slate-600 mb-8">Welcome back! Here's what's happening today.</p>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

<?php
$stats = [
  ['Total Customers','1247','ri-user-line','rose'],
  ['Active Treatments','89','ri-heart-pulse-line','pink'],
  ['Monthly Revenue','RM 45,230','ri-money-dollar-circle-line','fuchsia'],
  ['Pending Follow-ups','23','ri-notification-line','orange']
];

foreach ($stats as $s):
?>
<div class="bg-white p-6 rounded-xl border hover:shadow-lg transition">
  <div class="w-12 h-12 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mb-4">
    <i class="<?= $s[2] ?> text-2xl"></i>
  </div>
  <p class="text-sm text-slate-600"><?= $s[0] ?></p>
  <p class="text-2xl font-bold text-slate-800"><?= $s[1] ?></p>
</div>
<?php endforeach; ?>

</div>

<!-- QUICK ACTIONS -->
<div class="bg-white rounded-xl p-6 border">
<h2 class="text-lg font-bold mb-4">Quick Actions</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

<a href="customer-data.html" class="p-4 bg-rose-100 rounded-lg hover:bg-rose-200">
<i class="ri-user-add-line text-2xl text-rose-600"></i>
<p class="font-semibold mt-2">Add New Customer</p>
</a>

<a href="customer-data.html" class="p-4 bg-pink-100 rounded-lg hover:bg-pink-200">
<i class="ri-file-add-line text-2xl text-pink-600"></i>
<p class="font-semibold mt-2">New Treatment Record</p>
</a>

<a href="analytics.html" class="p-4 bg-fuchsia-100 rounded-lg hover:bg-fuchsia-200">
<i class="ri-bar-chart-box-line text-2xl text-fuchsia-600"></i>
<p class="font-semibold mt-2">View Analytics</p>
</a>

<a href="analytics.html" class="p-4 bg-orange-100 rounded-lg hover:bg-orange-200">
<i class="ri-file-download-line text-2xl text-orange-600"></i>
<p class="font-semibold mt-2">Export Report</p>
</a>

</div>
</div>

</main>
</div>

</body>
</html>
