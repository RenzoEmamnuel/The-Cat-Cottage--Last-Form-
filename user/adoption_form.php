<?php
include("connections.php");

$email = $pickup_date = $pickup_time = "";
$emailErr = $pickup_dateErr = $pickup_timeErr = "";

// Validate cat_id from URL
if (!isset($_GET['cat_id']) || !is_numeric($_GET['cat_id'])) {
    die("Invalid or missing cat ID.");
}
$cat_id = (int) $_GET['cat_id']; // Safe to cast after validation

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
        // Query to get the user id from the email
        $check_email = mysqli_query($connections, "SELECT id FROM accounts WHERE email='$email'");
        $user = mysqli_fetch_assoc($check_email);

        if ($user) {
            $user_id = $user['id'];

            // Insert the adoption request into the adoption_requests table
            $query = mysqli_query($connections, "INSERT INTO adoption_requests (user_id, cat_id, pickup_date, pickup_time)
            VALUES ('$user_id', '$cat_id', '$pickup_date', '$pickup_time')");

            if ($query) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                        myModal.show();
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('path/to/your/background.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .blur-card {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 2rem;
            width: 40%;
            margin: 40px auto;
        }

        .centered-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-control {
            border-radius: 10px;
        }

        .error-msg {
            color: red;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
<?php include("nav.php"); ?>
<br>

<div class="centered-container">
    <div class="blur-card shadow-lg">
	<h3 class="mb-4 text-center">Input Pick Up Details</h3>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="cat_id" value="<?= htmlspecialchars($cat_id) ?>">

            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Your Email" value="<?= htmlspecialchars($email) ?>" required>
                <div class="error-msg"><?= $emailErr ?></div>
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" name="pickup_date" placeholder="Pickup Date" value="<?= htmlspecialchars($pickup_date) ?>" required>
                <div class="error-msg"><?= $pickup_dateErr ?></div>
            </div>
            <div class="mb-3">
                <input type="time" class="form-control" name="pickup_time" placeholder="Pickup Time" value="<?= htmlspecialchars($pickup_time) ?>" required>
                <div class="error-msg"><?= $pickup_timeErr ?></div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit Adoption Request</button>
        </form>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100" id="successModalLabel">Submission Successful</h5>
      </div>
      <div class="modal-body">
        We have successfully received your adoption request! Regularly check your notifications for updates!
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-success" onclick="redirectToHome()" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
    function redirectToHome() {
        window.location.href = 'adopt.php';
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
