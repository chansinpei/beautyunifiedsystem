<aside class="w-64 bg-white border-r border-gray-200 hidden lg:flex flex-col">

  <!-- LOGO -->
  <div class="h-16 flex items-center px-6 border-b">
    <div class="w-10 h-10 bg-gradient-to-br from-rose-500 to-pink-500 rounded-lg flex items-center justify-center">
      <i class="ri-heart-pulse-line text-white text-xl"></i>
    </div>
    <span class="ml-3 font-bold text-gray-900">SecureBeauty</span>
  </div>

  <!-- MENU -->
  <nav class="flex-1 px-4 py-6 space-y-1">
    <?php
      $menu = [
        ['Dashboard','ri-dashboard-line','admin-dashboard.php'],
        ['Customer Records','ri-group-line','customer-data.html'],
        ['Staff Management','ri-team-line','user.html'],
        ['Analytics','ri-bar-chart-box-line','analytics.html'],
        ['Consultation Form','ri-file-text-line','customer-data.html'],
        ['Settings','ri-settings-3-line','settings.html']
      ];

      foreach ($menu as $m):
    ?>
      <a href="<?= $m[2] ?>"
         class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-rose-50 text-gray-700">
        <i class="<?= $m[1] ?> text-xl"></i>
        <span class="text-sm font-medium"><?= $m[0] ?></span>
      </a>
    <?php endforeach; ?>
  </nav>

  <!-- USER -->
  <div class="p-4 border-t">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-gradient-to-br from-rose-500 to-pink-500 rounded-full flex items-center justify-center">
        <i class="ri-user-line text-white"></i>
      </div>
      <div>
        <p class="text-sm font-medium">Admin</p>
        <p class="text-xs text-gray-500">Administrator</p>
      </div>
    </div>

    <a href="logout.php"
       class="mt-4 flex items-center gap-3 text-red-600 hover:bg-red-50 p-3 rounded-lg">
      <i class="ri-logout-box-line text-xl"></i> Logout
    </a>
  </div>

</aside>
