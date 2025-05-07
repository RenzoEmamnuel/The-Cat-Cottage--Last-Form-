

<?php include("nav.php"); ?>
<?php include("connections.php"); ?>

<?php
if (isset($_POST['confirm_approve'])) {
    $approve_id = $_POST['approve_id'];

    // Update the adoption request to 'Approved'
    mysqli_query($connections, "UPDATE adoption_requests SET status='Approved' WHERE id='$approve_id'");

    // Fetch the cat_id and user_id to update cat's status and send notif
    $result = mysqli_query($connections, "SELECT cat_id, user_id FROM adoption_requests WHERE id='$approve_id'");
    if ($row = mysqli_fetch_assoc($result)) {
        $cat_id = $row['cat_id'];
        $user_id = $row['user_id'];

        // Update the cat's status to 'Adopted'
        mysqli_query($connections, "UPDATE cats SET status='Adopted' WHERE id='$cat_id'");

        // Get cat name
        $cat_result = mysqli_query($connections, "SELECT name FROM cats WHERE id='$cat_id'");
        $cat_name = ($cat_row = mysqli_fetch_assoc($cat_result)) ? $cat_row['name'] : 'the cat';

        // Prepare the notification
        $notif_message = "Your adoption request for '$cat_name' has been approved.";
        $notif_message = mysqli_real_escape_string($connections, $notif_message);

        $user_result = mysqli_query($connections, "SELECT notifs FROM accounts WHERE id='$user_id'");
        if ($user_row = mysqli_fetch_assoc($user_result)) {
            $existing_notifs = $user_row['notifs'];
            $new_notif = $existing_notifs ? $existing_notifs . "\n\n" . $notif_message : $notif_message;
            $new_notif = mysqli_real_escape_string($connections, $new_notif);

            mysqli_query($connections, "UPDATE accounts SET notifs='$new_notif' WHERE id='$user_id'");
        }
    }
}

if (isset($_POST['confirm_reject'])) {
    $reject_id = $_POST['reject_id'];

    // Update the adoption request to 'Rejected'
    mysqli_query($connections, "UPDATE adoption_requests SET status='Rejected' WHERE id='$reject_id'");

    // Fetch user_id and cat name for notification
    $result = mysqli_query($connections, "
        SELECT ar.user_id, c.name AS cat_name 
        FROM adoption_requests ar 
        JOIN cats c ON ar.cat_id = c.id 
        WHERE ar.id='$reject_id'
    ");
    if ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $cat_name = $row['cat_name'];

        $notif_message = "Your adoption request for '$cat_name' has been rejected.";
        $notif_message = mysqli_real_escape_string($connections, $notif_message);

        $user_result = mysqli_query($connections, "SELECT notifs FROM accounts WHERE id='$user_id'");
        if ($user_row = mysqli_fetch_assoc($user_result)) {
            $existing_notifs = $user_row['notifs'];
            $new_notif = $existing_notifs ? $existing_notifs . "\n\n" . $notif_message : $notif_message;
            $new_notif = mysqli_real_escape_string($connections, $new_notif);

            mysqli_query($connections, "UPDATE accounts SET notifs='$new_notif' WHERE id='$user_id'");
        }
    }
}
?>


<div class="container mt-4">
    <h3 class="text-center">Review Adoption Requests</h3>
    <table class='table table-bordered mt-3'>
        <thead>
            <tr>
                <th>Time Submitted</th>
                <th>Requester's Email</th>
                <th>Cat's Name</th>
                <th>Pick Up Date</th>
                <th>Pick Up Time</th>
                <th>Status</th>
                <th>Cat Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "
                SELECT ar.id, ar.timestamp, ar.pickup_date, ar.pickup_time, ar.status,
                       acc.email AS requester_email,
                       c.name AS cat_name, c.image AS cat_image
                FROM adoption_requests ar
                JOIN accounts acc ON ar.user_id = acc.id
                JOIN cats c ON ar.cat_id = c.id
                WHERE ar.status = 'Pending'
            ";
            $result = mysqli_query($connections, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $request_id = $row['id'];
                $timestamp = $row['timestamp'];
                $email = $row['requester_email'];
                $cat_name = $row['cat_name'];
                $pickup_date = $row['pickup_date'];
                $pickup_time = $row['pickup_time'];
                $status = $row['status'];
                $image = $row['cat_image'];

                echo "
                <tr>
                    <td>$timestamp</td>
                    <td>$email</td>
                    <td>$cat_name</td>
                    <td>$pickup_date</td>
                    <td>$pickup_time</td>
                    <td>$status</td>
                    <td><img src='../$image' alt='Cat Image' style='width: 100px; height: auto;'></td>
                    <td>
                        <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#confirmApproveModal' data-id='$request_id'>Approve</button>
                        <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#confirmRejectModal' data-id='$request_id'>Reject</button>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="confirmApproveModal" tabindex="-1" aria-labelledby="confirmApproveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approve Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to approve this adoption request?
                    <input type="hidden" name="approve_id" id="approve_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="confirm_approve" class="btn btn-success">Yes, Approve</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="confirmRejectModal" tabindex="-1" aria-labelledby="confirmRejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to reject this adoption request?
                    <input type="hidden" name="reject_id" id="reject_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="confirm_reject" class="btn btn-danger">Yes, Reject</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var approveModal = document.getElementById('confirmApproveModal');
    var rejectModal = document.getElementById('confirmRejectModal');

    approveModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var requestId = button.getAttribute('data-id');
        approveModal.querySelector('#approve_id').value = requestId;
    });

    rejectModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var requestId = button.getAttribute('data-id');
        rejectModal.querySelector('#reject_id').value = requestId;
    });
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
