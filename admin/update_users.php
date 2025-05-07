<?php
$emailErr = "";
$user_id = $_REQUEST["id"];

include("connections.php");

$get_record = mysqli_query($connections, "SELECT * FROM accounts WHERE id='$user_id'");

if ($row_edit = mysqli_fetch_assoc($get_record)) {
    $db_name = $row_edit["name"];
    $db_email = $row_edit["email"];
    $db_password = $row_edit["password"];
    $db_type = $row_edit["account_type"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $_POST["new_name"];
    $new_email = $_POST["new_email"];
    $new_password = $_POST["new_password"];
    $new_type = $_POST["new_type"];

    $check_email = mysqli_query($connections, "SELECT * FROM accounts WHERE email='$new_email' AND id != '$user_id'");

    if (mysqli_num_rows($check_email) > 0) {
        $emailErr = "Email is already registered!";
    } else {
        if (mysqli_query($connections, "UPDATE accounts SET name='$new_name', email='$new_email', password='$new_password', account_type='$new_type' WHERE id='$user_id'")) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                    myModal.show();
                });
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
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
            margin-top: 50px;
            margin-bottom: 50px;
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
<div class="centered-container">
    <div class="blur-card shadow-lg">
        <form method="POST" action="">
            <div class="mb-3">
                <input type="text" class="form-control" name="new_name" placeholder="Full Name" value="<?= htmlspecialchars($db_name) ?>" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="new_email" placeholder="Email" value="<?= htmlspecialchars($db_email) ?>" required>
                <div class="error-msg text-center"><?= $emailErr ?></div>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="new_password" placeholder="Password" value="<?= htmlspecialchars($db_password) ?>" required>
            </div>
            <div class="mb-3">
                <select class="form-control" name="new_type" required>
                    <option value="" disabled <?= $db_type == "" ? "selected" : "" ?>>Select Account Type</option>
                    <option value="Admin" <?= $db_type == "Admin" ? "selected" : "" ?>>Admin</option>
                    <option value="User" <?= $db_type == "User" ? "selected" : "" ?>>User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Account</button>
        </form>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100" id="successModalLabel">Update Successful</h5>
      </div>
      <div class="modal-body">
        Account information has been updated successfully.
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-success" onclick="redirectToHome()" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
    function redirectToHome() {
        window.location.href = 'manage_users.php'; // Change as needed
    }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
