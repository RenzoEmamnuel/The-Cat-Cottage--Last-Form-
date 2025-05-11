<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Hamburger Button (Mobile, absolute at top-right) -->
<button id="menu-toggle"
        class="md:hidden fixed top-3 right-4 text-gray-800 z-50">
  <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
       viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M4 6h16M4 12h16M4 18h16"></path>
  </svg>
</button>

<!-- Responsive Navbar -->
<nav class="sticky top-3 mx-auto w-1/2 bg-transparent md:bg-[#F5ECD5] px-4 py-2 rounded-3xl z-40 shadow-lg relative">
  <div class="flex items-center justify-between w-full">
    <!-- Desktop Links -->
    <div class="hidden md:flex justify-center gap-x-4 text-sm font-semibold text-gray-800 w-full">
      <a href="home.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition">Home</a>
      <a href="adopt.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition">Adopt</a>
      <a href="aboutus.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition">About Us</a>
      <a href="login.php" class="bg-[#A4B465] text-white hover:bg-[#8FA856] px-4 py-2 rounded-full transition">Log In / Sign Up</a>
    </div>
  </div>
</nav>

<!-- Mobile Dropdown Menu -->
<div id="mobile-menu"
     class="md:hidden mt-3 hidden flex-col gap-y-2 text-sm font-semibold text-gray-800 text-center
            absolute right-4 top-14 w-max px-4 py-2 shadow-lg rounded-3xl bg-[#F5ECD5] z-40">
  <a href="home.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition block">Home</a>
  <a href="adopt.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition block">Adopt</a>
  <a href="aboutus.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition block">About Us</a>
  <a href="login.php" class="hover:bg-[#A4B465] hover:text-white px-4 py-2 rounded-full transition block">Log In / Sign Up</a>
</div>

<!-- Toggle Script -->
<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  toggleBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>
