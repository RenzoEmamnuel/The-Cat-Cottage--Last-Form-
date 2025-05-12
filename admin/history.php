
<?php include("connections.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Accounts</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { poppins: ['Poppins', 'sans-serif'] },
          colors: {
            olivegreen: '#A4B465',
            lightcream: '#f5ecd5',
            tablehead: '#f0bb77',
          }
        }
      }
    }
  </script>
  <style>
    body {
      background-image: url('../images/background.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
  </style>
</head>
<body class="font-poppins bg-olivegreen min-h-screen p-4">
  <?php include("nav.php"); ?>
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

<style>
    body {
        background-color: #fdf6e3;
        font-family: 'Segoe UI', 'Roboto', sans-serif;
        color: #4a5c28;
    }

    h3 {
        color: #4a5c28;
        margin-top: 30px;
        font-weight: bold;
        text-align: center;
    }

    table {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    thead th {
        background-color: #f0bb77;
        color: #4a5c28;
        text-align: center;
        vertical-align: middle;
    }

    td {
        text-align: center;
        vertical-align: middle;
    }

    .btn-success, .btn-danger {
        min-width: 110px;
    }

    .container {
        margin-bottom: 50px;
    }
</style>
<!-- Outer container to push both sections downward -->
<div class="mt-12"> <!-- Adjust mt-12 to control how far down -->

    <!-- Adoption History Section -->
    <div class="bg-lightcream rounded-xl shadow-xl px-6 pb-6 overflow-x-auto">
        <h3 class="text-2xl font-semibold text-center text-black mb-4 mt-0 pt-4">Adoption History</h3>
        <table class="min-w-full text-sm text-center border border-gray-300 text-black">
            <thead class="bg-tablehead text-black">
                <tr>
                    <th class="px-4 py-2">Time Submitted</th>
                    <th class="px-4 py-2">Requester's Email</th>
                    <th class="px-4 py-2">Cat's Name</th>
                    <th class="px-4 py-2">Pick Up Date</th>
                    <th class="px-4 py-2">Pick Up Time</th>
                    <th class="px-4 py-2">Cat Image</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white text-black">
                <?php
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
                    echo "<tr class='border-t'>
                            <td class='px-4 py-2'>{$row["timestamp"]}</td>
                            <td class='px-4 py-2'>{$row["requester_email"]}</td>
                            <td class='px-4 py-2'>{$row["cat_name"]}</td>
                            <td class='px-4 py-2'>{$row["pickup_date"]}</td>
                            <td class='px-4 py-2'>{$row["pickup_time"]}</td>
                            <td class='px-4 py-2'><img src='../{$row["cat_image"]}' class='w-20 h-auto mx-auto rounded'></td>
                            <td class='px-4 py-2'>{$row["status"]}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Submission History Section -->
    <div class="bg-lightcream rounded-xl shadow-xl px-6 pb-6 overflow-x-auto mt-6">
        <h3 class="text-2xl font-semibold text-center text-black mb-4 mt-0 pt-4">Submission History</h3>
        <table class="min-w-full text-sm text-center border border-gray-300 text-black">
            <thead class="bg-tablehead text-black">
                <tr>
                    <th class="px-4 py-2">Time Submitted</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Cat's Name</th>
                    <th class="px-4 py-2">Breed</th>
                    <th class="px-4 py-2">Age</th>
                    <th class="px-4 py-2">Sex</th>
                    <th class="px-4 py-2">Neutered?</th>
                    <th class="px-4 py-2">Vaccination</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white text-black">
                <?php
                $view_query = mysqli_query($connections, "SELECT * FROM submitted_cats WHERE status = 'Approved' OR status = 'Rejected'");
                while ($row = mysqli_fetch_assoc($view_query)) {
                    echo "<tr class='border-t'>
                            <td class='px-4 py-2'>{$row["timestamp"]}</td>
                            <td class='px-4 py-2'>{$row["email"]}</td>
                            <td class='px-4 py-2'>{$row["name"]}</td>
                            <td class='px-4 py-2'>{$row["breed"]}</td>
                            <td class='px-4 py-2'>{$row["age"]}</td>
                            <td class='px-4 py-2'>{$row["sex"]}</td>
                            <td class='px-4 py-2'>{$row["neutered"]}</td>
                            <td class='px-4 py-2'>{$row["vaccination"]}</td>
                            <td class='px-4 py-2'>{$row["description"]}</td>
                            <td class='px-4 py-2'><img src='../{$row["image"]}' class='w-20 h-auto mx-auto rounded'></td>
                            <td class='px-4 py-2'>{$row["status"]}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

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
</body>