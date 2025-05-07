<?php include("nav.php"); ?>
<?php include("connections.php"); ?>

<?php
if (isset($_POST['confirm_approve'])) {
    $approve_id = $_POST['approve_id'];
    mysqli_query($connections, "UPDATE submitted_cats SET status='Approved' WHERE id='$approve_id'");
}

if (isset($_POST['confirm_reject'])) {
    $reject_id = $_POST['reject_id'];
    mysqli_query($connections, "UPDATE submitted_cats SET status='Rejected' WHERE id='$reject_id'");
}
?>
<div class="container mt-4">
    <h3 class="text-center">Adoption History</h3>
    <table class='table table-bordered mt-3'>
        <thead>
            <tr>
                <th>Time Submitted</th>
                <th>Requester's Email</th>
                <th>Cat's Name</th>
                <th>Pick Up Date</th>
                <th>Pick Up Time</th>
                
                <th>Cat Image</th>
				<th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Updated query to fetch adoption request details, email from accounts, and cat name/image from cats table
            $query = "
                SELECT ar.timestamp, ar.pickup_date, ar.pickup_time, ar.status,
                       acc.email AS requester_email,
                       c.name AS cat_name, c.image AS cat_image
                FROM adoption_requests ar
                JOIN accounts acc ON ar.user_id = acc.id
                JOIN cats c ON ar.cat_id = c.id
                WHERE ar.status = 'Approved' OR ar.status = 'Rejected'
            ";
            
            $view_query = mysqli_query($connections, $query);

            while ($row = mysqli_fetch_assoc($view_query)) {
                $timestamp = $row["timestamp"];
                $email = $row["requester_email"];
                $cat_name = $row["cat_name"];
                $pickup_date = $row["pickup_date"];
                $pickup_time = $row["pickup_time"];
                $status = $row["status"];
                $cat_image = $row["cat_image"];

                echo "
                <tr>
                    <td>$timestamp</td>
                    <td>$email</td>
                    <td>$cat_name</td>
                    <td>$pickup_date</td>
                    <td>$pickup_time</td>
                    
                    <td><img src='../$cat_image' alt='Cat Image' style='width: 100px; height: auto;'></td>
					<td>$status</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<div class="container mt-4">
    <h3 class="text-center">Submission History</h3>
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
            </tr>
        </thead>
        <tbody>
            <?php
            $view_query = mysqli_query($connections, "SELECT * FROM submitted_cats WHERE status = 'Approved' OR status = 'Rejected'");
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
                $db_image = $row["image"];
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
                    <td><img src='../$db_image' alt='Cat Image' style='width: 100px; height: auto;'></td>
                    <td>$db_status</td>
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
