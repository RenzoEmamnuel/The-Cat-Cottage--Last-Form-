<?php
include("connections.php");

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete the user from the database
    $delete_query = mysqli_query($connections, "DELETE FROM accounts WHERE id='$user_id'");

    if ($delete_query) {
        echo "<script>
            alert('Account deleted successfully!');
            window.location.href = 'manage_users.php'; // Redirect back to the account list
        </script>";
    } else {
        echo "<script>
            alert('Error deleting account. Please try again.');
            window.location.href = 'manage_users.php'; // Redirect back to the account list
        </script>";
    }
}
?>
