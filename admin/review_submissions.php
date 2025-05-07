<?php include("nav.php"); ?>
<?php include("connections.php"); ?>

<?php
if (isset($_POST['confirm_approve'])) {
    $approve_id = $_POST['approve_id'];

    // Fetch the details of the approved cat
    $result = mysqli_query($connections, "SELECT * FROM submitted_cats WHERE id='$approve_id'");
    $cat = mysqli_fetch_assoc($result);

    if ($cat) {
        // Update the status of the cat to "Approved"
        mysqli_query($connections, "UPDATE submitted_cats SET status='Approved' WHERE id='$approve_id'");

        // Insert the approved cat's details into the cats table
        $name = $cat['name'];
        $breed = $cat['breed'];
        $age = $cat['age'];
        $sex = $cat['sex'];
        $neutered = $cat['neutered'];
        $vaccination = $cat['vaccination'];
        $description = $cat['description'];
        $image = $cat['image'];

        $insert_query = "INSERT INTO cats (name, breed, age, sex, neutered, vaccination, description, image)
                         VALUES ('$name', '$breed', '$age', '$sex', '$neutered', '$vaccination', '$description', '$image')";

        mysqli_query($connections, $insert_query);

        $email = $cat['email'];
        $notif_message = "Your cat submission for '$name' has been approved.";

        // Escape the notification message to avoid SQL syntax errors
        $notif_message = mysqli_real_escape_string($connections, $notif_message);

        // Get account ID using email
        $get_user = mysqli_query($connections, "SELECT id, notifs FROM accounts WHERE email='$email'");
        if ($user = mysqli_fetch_assoc($get_user)) {
            $account_id = $user['id'];
            $existing_notifs = $user['notifs'];

            // Add a delimiter between the new notification and the existing ones
            // If there are existing notifications, we add "\n\n" before the new notification
            if ($existing_notifs) {
                $new_notif = $existing_notifs . "\n\n" . $notif_message;
            } else {
                // If no existing notifications, just set the new notification
                $new_notif = $notif_message;
            }

            // Escape the new notification message to prevent SQL syntax errors
            $new_notif = mysqli_real_escape_string($connections, $new_notif);

            // Update the notification
            mysqli_query($connections, "
                UPDATE accounts 
                SET notifs = '$new_notif' 
                WHERE id = '$account_id'
            ");
        }
    }
}

if (isset($_POST['confirm_reject'])) {
    $reject_id = $_POST['reject_id'];
    mysqli_query($connections, "UPDATE submitted_cats SET status='Rejected' WHERE id='$reject_id'");

    $result = mysqli_query($connections, "SELECT * FROM submitted_cats WHERE id='$reject_id'");
    $cat = mysqli_fetch_assoc($result);

    if ($cat) {
        mysqli_query($connections, "UPDATE submitted_cats SET status='Rejected' WHERE id='$reject_id'");

        $email = $cat['email'];
        $name = $cat['name'];
        $notif_message = "Your cat submission for '$name' has been rejected.";

        // Escape the notification message to avoid SQL syntax errors
        $notif_message = mysqli_real_escape_string($connections, $notif_message);

        // Get account ID using email
        $get_user = mysqli_query($connections, "SELECT id, notifs FROM accounts WHERE email='$email'");
        if ($user = mysqli_fetch_assoc($get_user)) {
            $account_id = $user['id'];
            $existing_notifs = $user['notifs'];

            // Add a delimiter between the new notification and the existing ones
            // If there are existing notifications, we add "\n\n" before the new notification
            if ($existing_notifs) {
                $new_notif = $existing_notifs . "\n\n" . $notif_message;
            } else {
                // If no existing notifications, just set the new notification
                $new_notif = $notif_message;
            }

            // Escape the new notification message to prevent SQL syntax errors
            $new_notif = mysqli_real_escape_string($connections, $new_notif);

            // Update the notification
            mysqli_query($connections, "
                UPDATE accounts 
                SET notifs = '$new_notif' 
                WHERE id = '$account_id'
            ");
        }
    }
}



?>

<div class="container mt-4">
    <h3 class="text-center">Review Cat Submissions</h3>
    <table class='table table-bordered mt-3'>
        <thead>
            <tr>
                <th>Time Submitted</th>
                <th>Email</th>
                <th>Cat's Name</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Neutered?</th>
                <th>Vaccination History</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $view_query = mysqli_query($connections, "SELECT * FROM submitted_cats WHERE status = 'Pending'");
            while ($row = mysqli_fetch_assoc($view_query)) {
                $user_id = $row["id"];
                $db_email = $row["email"];
                $db_name = $row["name"];
                $db_breed = $row["breed"];
                $db_age = $row["age"];
                $db_sex = $row["sex"];
                $db_neutered = $row["neutered"];
                $db_vaccination = $row["vaccination"];
                $db_description = $row["description"];
                $image       = htmlspecialchars($row['image']);
                $db_status = $row["status"];
                $db_timestamp = $row["timestamp"];
                echo "
                <tr>
                    <td>$db_timestamp</td>
                    <td>$db_email</td>
                    <td>$db_name</td>
                    <td>$db_breed</td>
                    <td>$db_age</td>
                    <td>$db_sex</td>
                    <td>$db_neutered</td>
                    <td>$db_vaccination</td>
                    <td>$db_description</td>
                    <td><img src='../$image' alt='Cat Image' style='width: 100px; height: auto;'></td>
                    <td>$db_status</td>
                    <td>
                        <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#confirmApproveModal' data-id='$user_id'>Approve</button>
                        <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#confirmRejectModal' data-id='$user_id'>Reject</button>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="confirmApproveModal" tabindex="-1" aria-labelledby="confirmApproveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Approval</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to approve this cat submission?
          <input type="hidden" name="approve_id" id="approve_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="submit" name="confirm_approve" class="btn btn-success">Yes, Approve</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="confirmRejectModal" tabindex="-1" aria-labelledby="confirmRejectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Rejection</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to reject this cat submission?
          <input type="hidden" name="reject_id" id="reject_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="submit" name="confirm_reject" class="btn btn-danger">Yes, Reject</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script to pass ID to modals -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var approveModal = document.getElementById('confirmApproveModal');
    var rejectModal = document.getElementById('confirmRejectModal');

    approveModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-id');
        approveModal.querySelector('#approve_id').value = userId;
    });

    rejectModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-id');
        rejectModal.querySelector('#reject_id').value = userId;
    });
});
</script>
