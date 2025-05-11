<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  /* Desktop Navbar Bubble */
  .navbar-custom {
    position: sticky;
    top: 30px;
    margin: 30px auto 0 auto;
    width: fit-content;
    background-color: #F5ECD5;
    padding: 10px 24px;
    border-radius: 9999px;
    z-index: 1000;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
  }

  .navbar-custom a {
    text-decoration: none;
    color: #1f1f1f;
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0 8px;
    padding: 8px 16px;
    border-radius: 9999px;
    transition: 0.3s;
    display: block;
    text-align: center;
  }

  .navbar-custom a:hover {
    background: #A4B465;
    color: white;
  }

  .logout-btn {
    background-color: #A4B465;
    color: white;
  }

  .logout-btn:hover {
    background-color: #8FA856;
    color: white;
  }

  /* Mobile dropdown (floating under hamburger) */
  .mobile-dropdown {
    background: #F5ECD5;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border-radius: 1rem;
    padding: 10px 0;
    position: absolute;
    top: 60px;
    right: 1rem;
    width: max-content;
    text-align: center;
    z-index: 1000;
  }

 .mobile-dropdown a {
  color: #1f1f1f;
  font-size: 0.95rem;
  font-weight: 600;
  padding: 8px 16px;
  display: block;
  border-radius: 9999px;
  transition: 0.3s;
  text-decoration: none; /* <-- Remove underline */
}


  .mobile-dropdown a:hover {
    background-color: #A4B465;
    color: white;
  }

  /* Hamburger Icon (fixed) */
  #menu-toggle {
    position: fixed;
    top: 15px;
    right: 20px;
    background: none;
    border: none;
    z-index: 1050;
  }

  #menu-toggle svg {
    width: 26px;
    height: 26px;
    color: #1f1f1f;
  }

  @media (min-width: 768px) {
    #menu-toggle {
      display: none;
    }

    #mobileDropdown {
      display: none !important;
    }
  }
</style>

<!-- Hamburger Button -->
<button id="menu-toggle" class="d-md-none">
  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
       xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M4 6h16M4 12h16M4 18h16"></path>
  </svg>
</button>

<!-- Navbar (only visible on desktop) -->
<nav class="navbar-custom d-none d-md-flex justify-content-center flex-wrap">
  <a href="manage_users.php">Manage Users</a>
  <a href="manage_cats.php">Manage Cats</a>
  <a href="adoption_requests.php">Adoption Requests</a>
  <a href="review_submissions.php">Review Submitted Cats</a>
  <a href="history.php">History</a>
  <a href="../login.php" class="logout-btn">Log Out (Admin)</a>
</nav>

<!-- Mobile Dropdown Menu (initially hidden) -->
<div id="mobileDropdown" class="mobile-dropdown d-md-none d-none">
  <a href="manage_users.php">Manage Users</a>
  <a href="manage_cats.php">Manage Cats</a>
  <a href="adoption_requests.php">Adoption Requests</a>
  <a href="review_submissions.php">Review Submitted Cats</a>
  <a href="history.php">History</a>
  <a href="../login.php" class="logout-btn">Log Out (Admin)</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Toggle Dropdown -->
<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobileDropdown');

  toggleBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('d-none');
  });
</script>
