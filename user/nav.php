<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Responsive Navbar -->
<nav class="sticky top-2 z-50 w-full px-5">
  <!-- Wrapper for background only visible on desktop -->
  <div class="relative">
    <!-- Hamburger button absolutely placed at top-right -->
    <button id="menu-toggle" class="md:hidden absolute top-2 right-4 text-gray-800 z-50">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
           viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>

    <!-- Desktop navbar container -->
    <div class="hidden md:flex items-center justify-between mx-auto w-2/3 bg-[#F5ECD5] px-5 py-2 rounded-3xl shadow-lg">
      <div class="flex justify-center gap-x-4 text-sm font-semibold text-gray-800 w-full">
        <a href="index.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition">Home</a>
        <a href="adopt.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition">Adopt</a>
        <a href="submit.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition">Submit a Cat</a>
        <a href="aboutus.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition">About Us</a>
        <a href="notifs.php" class="hover:bg-[#A4B465] hover:text-white px-3 py-2 rounded-full transition flex items-center justify-center" title="Notifications">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0h6z">
            </path>
          </svg>
        </a>
        <a href="../login.php" class="bg-[#A4B465] text-white hover:bg-[#8FA856] px-4 py-2 rounded-full transition">Log Out (User)</a>
      </div>
    </div>
  </div>

  <!-- Mobile Dropdown Menu -->
  <div id="mobile-menu"
       class="md:hidden mt-2 hidden flex-col gap-y-2 text-sm font-semibold text-gray-800 text-center absolute right-4 top-12 w-56 px-4 py-2 shadow-lg rounded-3xl bg-[#F5ECD5]">
    <a href="index.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition block">Home</a>
    <a href="adopt.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition block">Adopt</a>
    <a href="submit.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition block">Submit a Cat</a>
    <a href="aboutus.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition block">About Us</a>
    <a href="notifs.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition block flex items-center justify-center">
      <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0h6z">
        </path>
      </svg>
    </a>
    <a href="../login.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition block">Log Out (User)</a>
  </div>
</nav>

<!-- Toggle Script -->
<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  toggleBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>
