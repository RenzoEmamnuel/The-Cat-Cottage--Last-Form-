<?php include("nav.php"); ?>
<?php include("connections.php"); ?>

<?php
if (isset($_POST['confirm_delete'])) {
    $delete_id = $_POST['delete_id'];
    mysqli_query($connections, "DELETE FROM cats WHERE id='$delete_id'");
}
?>


<div class="container mt-4">
    <h3 class="text-center">Manage Cats</h3>
    <table class='table table-bordered mt-3'>
        <thead>
            <tr>
                <th>Cat's Name</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Neutered?</th>
                <th>Vaccination</th>
                <th>Description</th>
                <th>Image</th>
				<th>Actions</th>
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
                $image       = htmlspecialchars($row['image']);
                echo "
                <tr>
                    <td>$db_name</td>
                    <td>$db_breed</td>
                    <td>$db_age</td>
                    <td>$db_sex</td>
                    <td>$db_neutered</td>
                    <td>$db_vaccination</td>
                    <td>$db_description</td>
                    <td><img src='../$image' alt='Cat Image' style='width: 100px; height: auto;'></td>
                    <td>
                        <a href='update_cats.php?id=$user_id' class='btn btn-warning btn-sm'>Update</a>
                        <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-id='$user_id'>Delete</button>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
	<a href="add_cat.php" class="btn btn-primary mt-3">Add a Cat</a>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Remove Cat?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this cat?
          <input type="hidden" name="delete_id" id="delete_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="submit" name="confirm_delete" class="btn btn-danger">Yes</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS to pass ID to modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-id');
        deleteModal.querySelector('#delete_id').value = userId;
    });
});
</script>
