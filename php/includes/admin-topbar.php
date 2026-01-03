<header class="h-16 bg-white border-b flex items-center justify-between px-6">

  <div class="flex items-center gap-4">
    <input
      type="text"
      placeholder="Search customers, records..."
      class="hidden sm:block w-80 pl-10 pr-4 py-2 border rounded-lg focus:ring-rose-400"
    >
  </div>

  <div class="flex items-center gap-4">

    <!-- Notification -->
    <button class="relative w-10 h-10 hover:bg-rose-100 rounded-lg">
      <i class="ri-notification-line text-xl"></i>
      <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
    </button>

    <!-- Profile -->
    <div class="flex items-center gap-3">
      <div class="text-right hidden sm:block">
        <p class="text-sm font-medium">Admin</p>
        <p class="text-xs text-gray-500">Administrator</p>
      </div>
      <div class="w-10 h-10 bg-gradient-to-br from-rose-500 to-pink-500 rounded-full flex items-center justify-center">
        <i class="ri-user-line text-white"></i>
      </div>
    </div>

  </div>

</header>
