<?php
session_start();  // Start the session

include("connections.php");

$name = $email = $password = $cpassword = "";
$nameErr = $emailErr = $passwordErr = $cpasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required!";
    } else {
        $name = $_POST["name"];
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

    // Validate Password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    // Validate Confirm Password
    if (empty($_POST["cpassword"])) {
        $cpasswordErr = "Confirm Password is required!";
    } else {
        $cpassword = $_POST["cpassword"];
    }

    // Proceed with registration if no errors
    if ($name && $email && $password && $cpassword) {

        // Check if email is already registered
        $check_email = mysqli_query($connections, "SELECT * FROM accounts WHERE email='$email'");
        $check_email_row = mysqli_num_rows($check_email);

        // Check if passwords match
        if ($password == $cpassword) {

            // If email already exists
            if ($check_email_row > 0) {
                $emailErr = "Email is already registered!";
            } else {
                // Insert new user into the database
                $query = mysqli_query($connections, "INSERT INTO accounts (name, email, password, account_type) VALUES ('$name', '$email', '$cpassword', 'User')");

                // If query is successful, set session data
                if ($query) {
                    // Store user data in session variables
                    $_SESSION["email"] = $email;  // Store email in session
                    $_SESSION["name"] = $name;    // Store name in session
                    $_SESSION["account_type"] = 'User';  // Store account type as User

                    // Redirect to the home page or user dashboard after successful registration
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                            myModal.show();
                        });
                    </script>";
                }
            }
        } else {
            // If passwords don't match
            $cpasswordErr = "Passwords do not match!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Cat Cottage</title>
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
            max-width: 400px;
            margin: auto;
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

    <div class="centered-container">
        <div class="blur-card shadow-lg">
            <form method="POST" action="">
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Name" required="" value="<?= htmlspecialchars($name) ?>">
                    <div class="error-msg"><?= $nameErr ?></div>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" required="" pattern="[^ @]*@[^ @]*" placeholder="Email" value="<?= htmlspecialchars($email) ?>">
                    <div class="error-msg"><?= $emailErr ?></div>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" required="" placeholder="Password">
                    <div class="error-msg"><?= $passwordErr ?></div>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="cpassword" required="" placeholder="Confirm Password">
                    <div class="error-msg"><?= $cpasswordErr ?></div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
                <div class="col-lg-12 text-center mt-2">
                    <small>
                        Already a member? <a href="login.php" style="color: #000000; text-decoration: none;">Log In here!</a>
                    </small>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100" id="successModalLabel">Registration Successful</h5>
                </div>
                <div class="modal-body">
                    Welcome to The Cat Cottage!
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-success" onclick="redirectToHome()" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function redirectToHome() {
            window.location.href = 'user/index.php';
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
