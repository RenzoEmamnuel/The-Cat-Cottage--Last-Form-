<?php include("connections.php"); ?>

<?php
if (isset($_POST['confirm_delete'])) {
    $delete_id = $_POST['delete_id'];
    mysqli_query($connections, "DELETE FROM cats WHERE id='$delete_id'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Cats</title>
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

<div class="max-w-7xl mx-auto bg-lightcream bg-opacity-90 backdrop-blur-md p-6 rounded-3xl shadow-lg mt-8">
  <h2 class="text-2xl font-semibold text-center mb-6">Manage Cats</h2>

  <div class="overflow-x-auto">
    <table class="min-w-full table-auto border-collapse border border-olivegreen rounded-xl overflow-hidden text-sm sm:text-base">
      <thead class="bg-tablehead text-white text-center">
        <tr>
          <th class="p-3">Cat's Name</th>
          <th class="p-3">Breed</th>
          <th class="p-3">Age</th>
          <th class="p-3">Sex</th>
          <th class="p-3">Neutered?</th>
          <th class="p-3">Vaccination</th>
          <th class="p-3">Description</th>
          <th class="p-3">Image</th>
          <th class="p-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $view_query = mysqli_query($connections, "SELECT * FROM cats WHERE status='Available'");
        while ($row = mysqli_fetch_assoc($view_query)) {
            $user_id = $row["id"];
            $db_name = $row["name"];
            $db_breed = $row["breed"];
            $db_age = $row["age"];
            $db_sex = $row["sex"];
            $db_neutered = $row["neutered"];
            $db_vaccination = $row["vaccination"];
            $db_description = $row["description"];
            $image = htmlspecialchars($row["image"]);

            echo "
            <tr class='bg-white text-black text-center'>
              <td class='p-3'>$db_name</td>
              <td class='p-3'>$db_breed</td>
              <td class='p-3'>$db_age</td>
              <td class='p-3'>$db_sex</td>
              <td class='p-3'>$db_neutered</td>
              <td class='p-3'>$db_vaccination</td>
              <td class='p-3 max-w-xs break-words'>$db_description</td>
              <td class='p-3'><img src='../$image' alt='Cat Image' class='w-24 h-auto rounded-lg shadow-md mx-auto'></td>
              <td class='p-3'>
                <div class='flex flex-col sm:flex-row gap-2 justify-center'>
                  <a href='update_cats.php?id=$user_id' class='bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-3 py-1 rounded-lg text-sm'>Update</a>
                  <button class='bg-red-500 hover:bg-red-600 text-white font-semibold px-3 py-1 rounded-lg text-sm' data-id='$user_id' onclick='openModal(this)'>Delete</button>
                </div>
              </td>
            </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="text-center mt-6">
    <a href="add_cat.php" class="inline-block bg-tablehead hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg">Add a Cat</a>
  </div>
</div>

<!-- Modal -->
<div id="confirmDeleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
  <div class="bg-lightcream p-6 rounded-2xl shadow-xl w-11/12 max-w-md border border-olivegreen">
    <h3 class="text-xl font-semibold mb-4 text-center text-olivegreen">Remove Cat?</h3>
    <p class="mb-6 text-center text-gray-700">Are you sure you want to delete this cat?</p>
    <form method="POST" action="">
      <input type="hidden" name="delete_id" id="delete_id">
      <div class="flex justify-center gap-4">
        <button type="button" onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium">No</button>
        <button type="submit" name="confirm_delete" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium">Yes</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Logic -->
<script>
function openModal(button) {
  const userId = button.getAttribute('data-id');
  document.getElementById('delete_id').value = userId;
  document.getElementById('confirmDeleteModal').classList.remove('hidden');
}
function closeModal() {
  document.getElementById('confirmDeleteModal').classList.add('hidden');
}
</script>

</body>
</html>
