<?php
include("connections.php");
session_start();

$cat_id = $_POST['cat_id'];
$user_id = $_SESSION['user_id'];

$result = mysqli_query($connections, "
    SELECT * FROM adoption_requests 
    WHERE cat_id='$cat_id' AND user_id='$user_id' AND status != 'Rejected'
");

if (mysqli_num_rows($result) > 0) {
    echo "exists";
} else {
    echo "not_exists";
}
?>
