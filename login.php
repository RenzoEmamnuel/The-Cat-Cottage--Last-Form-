<?php
session_start();

$email = $password = "";
$emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    if ($email && $password) {
        include("connections.php");

        $check_email = mysqli_query($connections, "SELECT * FROM accounts WHERE email='$email'");
        $check_email_row = mysqli_num_rows($check_email);

        if ($check_email_row > 0) {
            while ($row = mysqli_fetch_assoc($check_email)) {

                $db_password = $row["password"];
                $db_account_type = $row["account_type"];

                if ($password == $db_password) {
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["id"] = $row["id"];

                    if ($db_account_type == "Admin") {
                        header("Location: admin/manage_users.php");
                        exit();
                    } else {
                        header("Location: user/index.php");
                        exit();
                    }
                } else {
                    $passwordErr = "Password is incorrect!";
                }
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
    <title>The Cat Cottage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center min-h-screen flex flex-col items-center justify-start pt-4" style="background-image: url('images/cat_pond.jpg')">

    <!-- Logo and Title -->
    <div class="flex flex-col items-center space-y-2 mb-4 sm:flex-row sm:space-y-0 sm:space-x-3">
        <img src="images/logo.png" alt="Logo" class="w-16 h-16 md:w-20 md:h-20 lg:w-24 lg:h-24 rounded-full border border-white shadow-lg">
        <img src="images/title.png" alt="The Cat Cottage" class="h-20 md:h-28 lg:h-36">
    </div>

    <!-- Login Form -->
    <div class="w-[90%] max-w-xs sm:max-w-sm px-4 sm:px-6 py-6 sm:py-8 bg-white/30 backdrop-blur-md rounded-2xl shadow-lg mt-4 mx-auto">
        <form method="POST" action="" class="space-y-4">
            <div>
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                    pattern="[^ @]*@[^ @]*"
                    value="<?= htmlspecialchars($email) ?>"
                    class="w-full px-4 py-2 rounded-lg bg-white/80 focus:outline-none focus:ring-2 focus:ring-blue-400"
                />
                <p class="text-red-600 text-sm mt-1"><?= $emailErr ?></p>
            </div>
            <div>
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                    class="w-full px-4 py-2 rounded-lg bg-white/80 focus:outline-none focus:ring-2 focus:ring-blue-400"
                />
                <p class="text-red-600 text-sm mt-1"><?= $passwordErr ?></p>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-300"
            >
                Log In
            </button>

            <div class="text-center text-sm mt-3">
                Not registered yet?
                <a href="register.php" class="text-black underline hover:text-blue-700">Register here!</a>
            </div>
        </form>
    </div>

</body>
</html>
