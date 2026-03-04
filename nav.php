<!-- Navbar -->
<nav class="bg-white shadow-md w-full  fixed top-0 right-0 ">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center h-16">
      
     
      <div class="text-xl font-bold text-blue-600 flex items-center gap-2">
        <img src="<?= $_SESSION['user']['img'] ?>" class="w-10 h-10 rounded-full object-cover" alt="">
        <?php echo $_SESSION["user"]["first_name"] ?? "User" ?>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden md:flex space-x-6 text-gray-700 font-medium">
        <a href="users.view.php" class="hover:text-blue-600 transition">Users</a>
        <a href="index.php" class="hover:text-blue-600 transition">Add User</a>
        <a href="logout.php" class="hover:text-blue-600 transition">Logout</a>

      </div>

      <!-- Mobile Button -->
      <div class="md:hidden">
        <button id="menu-btn" class="text-gray-700 focus:outline-none">
          ☰
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden px-6 pb-4">
    <a href="users.view.php" class="block py-2 text-gray-700 hover:text-blue-600">Users</a>
    <a href="create.php" class="block py-2 text-gray-700 hover:text-blue-600">Add User</a>
    <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Profile</a>
  </div>
</nav>

<!-- Script -->
<script>
  const btn = document.getElementById("menu-btn");
  const menu = document.getElementById("mobile-menu");

  btn.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });
</script>