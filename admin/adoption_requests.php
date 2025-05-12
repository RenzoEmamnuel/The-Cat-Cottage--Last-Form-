<?php include("connections.php"); ?>

<?php
if (isset($_POST['confirm_approve'])) {
    $approve_id = $_POST['approve_id'];
    mysqli_query($connections, "UPDATE adoption_requests SET status='Approved' WHERE id='$approve_id'");

    $result = mysqli_query($connections, "SELECT cat_id, user_id FROM adoption_requests WHERE id='$approve_id'");
    if ($row = mysqli_fetch_assoc($result)) {
        $cat_id = $row['cat_id'];
        $user_id = $row['user_id'];

        mysqli_query($connections, "UPDATE cats SET status='Adopted' WHERE id='$cat_id'");
        $cat_result = mysqli_query($connections, "SELECT name FROM cats WHERE id='$cat_id'");
        $cat_name = ($cat_row = mysqli_fetch_assoc($cat_result)) ? $cat_row['name'] : 'the cat';

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
    mysqli_query($connections, "UPDATE adoption_requests SET status='Rejected' WHERE id='$reject_id'");

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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Adoption Requests</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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


<div class="max-w-7xl mx-auto bg-lightcream bg-opacity-90 backdrop-blur-md p-6 rounded-3xl shadow-lg mt-8">
  <h2 class="text-2xl font-semibold text-center mb-6">Review Adoption Requests</h2>

  <div class="overflow-x-auto">
    <table class="min-w-full table-auto border-collapse border border-olivegreen rounded-xl overflow-hidden">
      <thead class="bg-tablehead text-white text-center">
        <tr>
          <th class="p-3">Time Submitted</th>
          <th class="p-3">Email</th>
          <th class="p-3">Cat Name</th>
          <th class="p-3">Pick-Up Date</th>
          <th class="p-3">Time</th>
          <th class="p-3">Status</th>
          <th class="p-3">Image</th>
          <th class="p-3">Actions</th>
        </tr>
      </thead>
      <tbody class="text-center">
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
            echo "
            <tr class='bg-white border-b border-gray-200'>
              <td class='p-3'>{$row['timestamp']}</td>
              <td class='p-3'>{$row['requester_email']}</td>
              <td class='p-3'>{$row['cat_name']}</td>
              <td class='p-3'>{$row['pickup_date']}</td>
              <td class='p-3'>{$row['pickup_time']}</td>
              <td class='p-3'>{$row['status']}</td>
              <td class='p-3'><img src='../{$row['cat_image']}' alt='Cat Image' class='w-24 h-auto rounded-lg mx-auto'></td>
              <td class='p-3 align-middle'>
                <button class='bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm w-full sm:w-auto'>Approve</button>
                <button class='bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm w-full sm:w-auto'>Reject</button>
                </td>

            </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Reusable Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-lightcream p-6 rounded-2xl shadow-xl w-11/12 max-w-md border border-olivegreen text-center">
    <h3 id="modalTitle" class="text-xl font-semibold text-olivegreen mb-4">Confirm Action</h3>
    <p id="modalText" class="mb-6 text-gray-700">Are you sure?</p>
    <form method="POST">
      <input type="hidden" name="approve_id" id="approve_id">
      <input type="hidden" name="reject_id" id="reject_id">
      <div class="flex justify-center gap-4">
        <button type="button" onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium">Cancel</button>
        <button type="submit" name="" id="confirmButton" class="px-4 py-2 rounded-lg font-medium"></button>
      </div>
    </form>
  </div>
</div>

<script>
function openModal(action, id) {
  const modal = document.getElementById('confirmModal');
  const modalTitle = document.getElementById('modalTitle');
  const modalText = document.getElementById('modalText');
  const confirmBtn = document.getElementById('confirmButton');
  const approveInput = document.getElementById('approve_id');
  const rejectInput = document.getElementById('reject_id');

  modal.classList.remove('hidden');

  if (action === 'approve') {
    modalTitle.textContent = 'Approve Request';
    modalText.textContent = 'Are you sure you want to approve this adoption request?';
    approveInput.value = id;
    rejectInput.value = '';
    confirmBtn.textContent = 'Yes, Approve';
    confirmBtn.name = 'confirm_approve';
    confirmBtn.className = 'bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium';
  } else {
    modalTitle.textContent = 'Reject Request';
    modalText.textContent = 'Are you sure you want to reject this adoption request?';
    rejectInput.value = id;
    approveInput.value = '';
    confirmBtn.textContent = 'Yes, Reject';
    confirmBtn.name = 'confirm_reject';
    confirmBtn.className = 'bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium';
  }
}

function closeModal() {
  document.getElementById('confirmModal').classList.add('hidden');
}
</script>

</body>
</html>
