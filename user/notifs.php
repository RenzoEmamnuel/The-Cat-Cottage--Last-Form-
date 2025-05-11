<?php include("nav.php"); ?>
<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

include("connections.php");
$email = $_SESSION["email"];

$query = "SELECT notifs FROM accounts WHERE email = '$email'";
$result = mysqli_query($connections, $query);
$row = mysqli_fetch_assoc($result);

$notifs = $row["notifs"] ?? 'No notifications available!';
$notifArray = explode("\n\n", $notifs);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Notifications</title>
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
            yellownotice: '#ffcc00',
          }
        }
      }
    }
  </script>
  <style>
    body {
      background-image: url('../images/background.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
  </style>
</head>
<body class="font-poppins bg-olivegreen min-h-screen p-4">
  <div class="max-w-3xl mx-auto bg-lightcream bg-opacity-90 backdrop-blur-md p-6 rounded-3xl shadow-lg mt-8">
    <h2 class="text-2xl font-semibold text-center mb-6">Your Notifications</h2>

    <?php if (count($notifArray) > 0 && $notifArray[0] !== ''): ?>
      <?php foreach ($notifArray as $index => $notif): ?>
        <div class="<?= $index % 2 === 0 ? 'bg-white' : 'bg-olivegreen text-white' ?> px-4 py-3 rounded-lg shadow-sm mb-4">
          <?= htmlspecialchars(stripslashes($notif)) ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="bg-yellownotice text-center py-3 px-4 rounded-lg font-semibold text-gray-800">
        There are no notifications!
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
