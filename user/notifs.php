<?php include("nav.php"); ?>

<?php
session_start();  // Start the session

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();  // Ensure no further code is executed
}

include("connections.php");

// Get the logged-in user's email from the session
$email = $_SESSION["email"];

// Fetch the notifications for the logged-in user
$query = "SELECT notifs FROM accounts WHERE email = '$email'";
$result = mysqli_query($connections, $query);
$row = mysqli_fetch_assoc($result);

// Check if there are notifications
$notifs = $row["notifs"] ?? 'No notifications available!';  // Default message if no notifications

// If there are notifications, split them by the new delimiter (\n\n)
$notifArray = explode("\n\n", $notifs);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Notifications</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .notifications-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .notification-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .no-notifications {
            background-color: #ffcc00;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        

        <!-- Check if notifications are available and display them -->
        <div class="notifications-container">
		<h3 class="text-center">Your Notifications</h3>
            <?php if (count($notifArray) > 0 && $notifArray[0] !== ''): ?>
                <!-- Loop through and display each notification -->
                <?php foreach ($notifArray as $notif): ?>
                    <div class="notification-item"><?= htmlspecialchars(stripslashes($notif)) ?></div>

                <?php endforeach; ?>
            <?php else: ?>
                <!-- No notifications available -->
                <div class="no-notifications">There are no notifications!</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
