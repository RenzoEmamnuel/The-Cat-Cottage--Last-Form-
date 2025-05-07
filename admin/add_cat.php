<?php
include("connections.php");

$name = $breed = $age = $sex = $neutered = $vaccination = $description = $image = "";
$nameErr = $breedErr = $ageErr = $sexErr = $neuteredErr = $vaccinationErr = $descriptionErr = $imageErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $nameErr = "Name is required!";
    } else {
        $name = $_POST["name"];
    }

    if (empty($_POST["breed"])) {
        $breedErr = "Breed is required!";
    } else {
        $breed = $_POST["breed"];
    }

    if (empty($_POST["age"])) {
        $ageErr = "Age is required!";
    } else {
        $age = $_POST["age"];
    }

    if (empty($_POST["sex"])) {
        $sexErr = "Sex of cat is required!";
    } else {
        $sex = $_POST["sex"];
    }

    if (empty($_POST["neutered"])) {
        $neuteredErr = "Required!";
    } else {
        $neutered = $_POST["neutered"];
    }

    if (empty($_POST["vaccination"])) {
        $vaccinationErr = "Required!";
    } else {
        $vaccination = $_POST["vaccination"];
    }

    if (empty($_POST["description"])) {
        $descriptionErr = "Required!";
    } else {
        $description = $_POST["description"];
    }

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $upload_dir = "../cats/";
        $relative_dir = "cats/";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $original_name = basename($_FILES["image"]["name"]);
        $unique_name = uniqid() . "_" . $original_name;

        $image_path = $upload_dir . $unique_name;
        $image_relative = $relative_dir . $unique_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            $image = $image_relative;
        } else {
            $imageErr = "Failed to upload image!";
        }
    } else {
        $imageErr = "Image is required!";
    }

    if ($name && $breed && $age && $sex && $neutered && $vaccination && $description && $image) {
        $query = mysqli_query($connections, "INSERT INTO cats (name, breed, age, sex, neutered, vaccination, description, image)
            VALUES ('$name', '$breed', '$age', '$sex', '$neutered', '$vaccination', '$description', '$image')");

        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                myModal.show();
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Cat Cottage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: url('path/to/your/background.jpg') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

    .blur-card {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        padding: 2rem;
        width: 40%;
        margin: 40px auto;
    }

    .centered-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .form-control {
        border-radius: 10px;
    }

    .error-msg {
        color: red;
        font-size: 0.875rem;
    }
</style>
</head>
<body>
<?php include("nav.php"); ?>

<div class="centered-container">
    <div class="blur-card shadow-lg">
        <h3 class="text-center">Add a Cat</h3>
        <form method="POST" action="" enctype="multipart/form-data">

            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Cat's Name" value="<?= htmlspecialchars($name) ?>" required>
                <div class="error-msg"><?= $nameErr ?></div>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="breed" placeholder="Breed" value="<?= htmlspecialchars($breed) ?>" required>
                <div class="error-msg"><?= $breedErr ?></div>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" name="age" placeholder="Age" value="<?= htmlspecialchars($age) ?>" required>
                <center><div class="error-msg"><?= $ageErr ?></div></center>
            </div>
            <div class="mb-3">
                <select class="form-control" name="sex" required>
                    <option value="" disabled <?= $sex == "" ? "selected" : "" ?>>Select Sex</option>
                    <option value="Male" <?= $sex == "Male" ? "selected" : "" ?>>Male</option>
                    <option value="Female" <?= $sex == "Female" ? "selected" : "" ?>>Female</option>
                </select>
                <div class="error-msg"><?= $sexErr ?></div>
            </div>
            <div class="mb-3">
                <select class="form-control" name="neutered" required>
                    <option value="" disabled <?= $neutered == "" ? "selected" : "" ?>>Neutered?</option>
                    <option value="Yes" <?= $neutered == "Yes" ? "selected" : "" ?>>Yes</option>
                    <option value="No" <?= $neutered == "No" ? "selected" : "" ?>>No</option>
                </select>
                <div class="error-msg"><?= $neuteredErr ?></div>
            </div>
            <div class="mb-3">
                <select class="form-control" name="vaccination" required>
                    <option value="" disabled <?= $vaccination == "" ? "selected" : "" ?>>Vaccination Status</option>
                    <option value="Fully Vaccinated" <?= $vaccination == "Fully Vaccinated" ? "selected" : "" ?>>Fully Vaccinated</option>
                    <option value="Partially Vaccinated" <?= $vaccination == "Partially Vaccinated" ? "selected" : "" ?>>Partially Vaccinated</option>
                    <option value="Not Vaccinated" <?= $vaccination == "Not Vaccinated" ? "selected" : "" ?>>Not Vaccinated</option>
                </select>
                <div class="error-msg"><?= $vaccinationErr ?></div>
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="description" placeholder="Description" rows="3" required><?= htmlspecialchars($description) ?></textarea>
                <div class="error-msg"><?= $descriptionErr ?></div>
            </div>
            <div class="mb-3">
                <input type="file" class="form-control" name="image" accept="image/*" required>
                <div class="error-msg"><?= $imageErr ?></div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Add</button>
        </form>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100" id="successModalLabel">Submission Successful</h5>
      </div>
      <div class="modal-body">
        You have successfully added a cat into The Cat Cottage!
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-success" onclick="redirectToHome()" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
    function redirectToHome() {
        window.location.href = 'manage_cats.php';
    }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
