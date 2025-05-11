<?php
include("connections.php");

$email = $pickup_date = $pickup_time = "";
$emailErr = $pickup_dateErr = $pickup_timeErr = "";

if (!isset($_GET['cat_id']) || !is_numeric($_GET['cat_id'])) {
    die("Invalid or missing cat ID.");
}
$cat_id = (int) $_GET['cat_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty($_POST["pickup_date"])) {
        $pickup_dateErr = "Pickup date is required!";
    } else {
        $pickup_date = $_POST["pickup_date"];
    }

    if (empty($_POST["pickup_time"])) {
        $pickup_timeErr = "Pickup time is required!";
    } else {
        $pickup_time = $_POST["pickup_time"];
    }

    if ($email && $pickup_date && $pickup_time) {
        $check_email = mysqli_query($connections, "SELECT id FROM accounts WHERE email='$email'");
        $user = mysqli_fetch_assoc($check_email);

        if ($user) {
            $user_id = $user['id'];
            $query = mysqli_query($connections, "INSERT INTO adoption_requests (user_id, cat_id, pickup_date, pickup_time)
            VALUES ('$user_id', '$cat_id', '$pickup_date', '$pickup_time')");

            if ($query) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('successModal').classList.remove('hidden');
                    });
                  </script>";
            } else {
                echo "Database Error: " . mysqli_error($connections);
            }
        } else {
            $emailErr = "Email is not registered!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>The Cat Cottage Adoption Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { poppins: ['Poppins', 'sans-serif'] },
          colors: {
            olivegreen: '#A4B465',
            lightcream: '#f5ecd5',
            adoptbtn: '#a3b77f',
            adoptbtnhover: '#8eaa7a',
          },
        }
      }
    }
  </script>
  <style>
    body {
      background-image: url('../images/background.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
  </style>
</head>
<body class="font-poppins bg-olivegreen min-h-screen">
  <?php include("nav.php"); ?>

  <div class="flex items-center justify-center min-h-screen px-4 py-12">
    <div class="bg-lightcream bg-opacity-80 backdrop-blur-md p-8 rounded-3xl shadow-xl w-full max-w-md">
      <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Input Pick-Up Details</h2>

      <form method="POST" action="">
        <input type="hidden" name="cat_id" value="<?= htmlspecialchars($cat_id) ?>">

        <div class="mb-4">
          <input type="email" name="email" placeholder="Your Email" value="<?= htmlspecialchars($email) ?>"
                 class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-olivegreen"
                 required>
          <p class="text-sm text-red-600 mt-1"><?= $emailErr ?></p>
        </div>

        <div class="mb-4">
          <input type="date" name="pickup_date" value="<?= htmlspecialchars($pickup_date) ?>"
                 class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-olivegreen"
                 required>
          <p class="text-sm text-red-600 mt-1"><?= $pickup_dateErr ?></p>
        </div>

        <div class="mb-6">
          <input type="time" name="pickup_time" value="<?= htmlspecialchars($pickup_time) ?>"
                 class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-olivegreen"
                 required>
          <p class="text-sm text-red-600 mt-1"><?= $pickup_timeErr ?></p>
        </div>

        <button type="submit"
                class="w-full bg-adoptbtn hover:bg-adoptbtnhover text-white py-2 rounded-xl font-semibold transition duration-300">
          Submit Adoption Request
        </button>
      </form>
    </div>
  </div>

  <!-- Success Modal -->
  <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-xl text-center">
      <h2 class="text-xl font-semibold mb-3">Submission Successful</h2>
      <p class="text-gray-700 mb-5">We have successfully received your adoption request! Check your notifications for updates.</p>
      <button onclick="window.location.href='adopt.php'"
              class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-full transition">
        OK
      </button>
    </div>
  </div>
</body>
</html>
