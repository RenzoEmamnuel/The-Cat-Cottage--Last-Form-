<?php include("connections.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Review Cat Submissions</title>
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
          danger: '#dc2626',
          success: '#16a34a',
          warmorange: '#f0bb77',
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
<body class="font-poppins bg-olivegreen bg-opacity-90 min-h-screen p-4">
  <?php include("nav.php"); ?>
  <div class="max-w-6xl mx-auto bg-lightcream bg-opacity-90 backdrop-blur p-4 rounded-3xl shadow-lg mt-8 overflow-x-auto">
  <h2 class="text-2xl font-semibold text-center mb-4">Review Cat Submissions</h2>

  <table class="min-w-full text-xs md:text-sm text-center border border-gray-300 rounded-lg overflow-hidden">
    <thead class="bg-warmorange text-white text-center">
      <tr>
        <th class="px-3 py-2">Time</th>
        <th class="px-3 py-2">Email</th>
        <th class="px-3 py-2">Name</th>
        <th class="px-3 py-2">Breed</th>
        <th class="px-3 py-2">Age</th>
        <th class="px-3 py-2">Sex</th>
        <th class="px-3 py-2">Neutered</th>
        <th class="px-3 py-2">Vaccination</th>
        <th class="px-3 py-2">Description</th>
        <th class="px-3 py-2">Image</th>
        <th class="px-3 py-2">Status</th>
        <th class="px-3 py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $view_query = mysqli_query($connections, "SELECT * FROM submitted_cats WHERE status = 'Pending'");
      while ($row = mysqli_fetch_assoc($view_query)) {
        $id = $row['id'];
        echo "<tr class='border-t border-gray-300 bg-white hover:bg-gray-50'>
          <td class='px-3 py-2'>{$row['timestamp']}</td>
          <td class='px-3 py-2'>{$row['email']}</td>
          <td class='px-3 py-2'>{$row['name']}</td>
          <td class='px-3 py-2'>{$row['breed']}</td>
          <td class='px-3 py-2'>{$row['age']}</td>
          <td class='px-3 py-2'>{$row['sex']}</td>
          <td class='px-3 py-2'>{$row['neutered']}</td>
          <td class='px-3 py-2'>{$row['vaccination']}</td>
          <td class='px-3 py-2'>{$row['description']}</td>
          <td class='px-3 py-2'><img src='../" . htmlspecialchars($row['image']) . "' class='w-16 h-auto rounded mx-auto'></td>
          <td class='px-3 py-2'>{$row['status']}</td>
          <td class='px-2 py-2 text-center'>
  <div class='flex flex-col items-center gap-2'>
    <button data-id='$id' class='open-approve bg-green-500 text-white text-xs font-medium py-1 px-2 rounded w-20 hover:bg-green-700 transition'>
      Approve
    </button>
    <button data-id='$id' class='open-reject bg-red-500 text-white text-xs font-medium py-1 px-2 rounded w-20 hover:bg-red-700 transition'>
      Reject
    </button>
  </div>
</td>


        </tr>";
      }
      ?>
    </tbody>
  </table>
</div>


  <!-- Approve Modal -->
  <div id="approveModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 items-center justify-center">
    <div class="bg-white rounded-xl p-6 max-w-sm w-full">
      <form method="POST">
        <input type="hidden" name="approve_id" id="approve_id">
        <h3 class="text-lg font-semibold mb-4">Confirm Approval</h3>
        <p class="mb-4">Are you sure you want to approve this cat submission?</p>
        <div class="flex justify-end space-x-2">
          <button type="button" class="close-modal px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
          <button type="submit" name="confirm_approve" class="px-4 py-2 rounded bg-success text-white hover:bg-green-700">Approve</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Reject Modal -->
  <div id="rejectModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 items-center justify-center">
    <div class="bg-white rounded-xl p-6 max-w-sm w-full">
      <form method="POST">
        <input type="hidden" name="reject_id" id="reject_id">
        <h3 class="text-lg font-semibold mb-4">Confirm Rejection</h3>
        <p class="mb-4">Are you sure you want to reject this cat submission?</p>
        <div class="flex justify-end space-x-2">
          <button type="button" class="close-modal px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
          <button type="submit" name="confirm_reject" class="px-4 py-2 rounded bg-danger text-white hover:bg-red-700">Reject</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const approveModal = document.getElementById('approveModal');
    const rejectModal = document.getElementById('rejectModal');
    const approveInput = document.getElementById('approve_id');
    const rejectInput = document.getElementById('reject_id');

    document.querySelectorAll('.open-approve').forEach(btn => {
      btn.addEventListener('click', () => {
        approveInput.value = btn.getAttribute('data-id');
        approveModal.classList.remove('hidden');
        approveModal.classList.add('flex');
      });
    });

    document.querySelectorAll('.open-reject').forEach(btn => {
      btn.addEventListener('click', () => {
        rejectInput.value = btn.getAttribute('data-id');
        rejectModal.classList.remove('hidden');
        rejectModal.classList.add('flex');
      });
    });

    document.querySelectorAll('.close-modal').forEach(btn => {
      btn.addEventListener('click', () => {
        approveModal.classList.add('hidden');
        rejectModal.classList.add('hidden');
        approveModal.classList.remove('flex');
        rejectModal.classList.remove('flex');
      });
    });
  </script>
</body>
</html>
