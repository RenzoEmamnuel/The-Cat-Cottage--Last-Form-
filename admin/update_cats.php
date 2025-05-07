<?php
include("connections.php");

$cat_id = $_REQUEST["id"];
$imageErr = "";

// Fetch existing cat data
$get_record = mysqli_query($connections, "SELECT * FROM cats WHERE id='$cat_id'");
if ($row_edit = mysqli_fetch_assoc($get_record)) {
    $db_name = $row_edit["name"];
    $db_breed = $row_edit["breed"];
    $db_age = $row_edit["age"];
    $db_sex = $row_edit["sex"];
    $db_neutered = $row_edit["neutered"];
    $db_vaccination = $row_edit["vaccination"];
    $db_description = $row_edit["description"];
    $db_image = $row_edit["image"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $breed = $_POST["breed"];
    $age = $_POST["age"];
    $sex = $_POST["sex"];
    $neutered = $_POST["neutered"];
    $vaccination = $_POST["vaccination"];
    $description = $_POST["description"];

    $new_image = $db_image;

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "cats/";
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $new_image = $image_name;
        } else {
            $imageErr = "Failed to upload image.";
        }
    }

    // Update the database
    $update_query = "UPDATE cats SET 
        name='$name', 
        breed='$breed', 
        age='$age', 
        sex='$sex', 
        neutered='$neutered', 
        vaccination='$vaccination', 
        description='$description', 
        image='$new_image' 
        WHERE id='$cat_id'";

    if (mysqli_query($connections, $update_query)) {
        header("Location: manage_cats.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Cat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f3f3e9;
        }

        .blur-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 2rem;
            max-width: 600px;
            margin: 50px auto;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .form-control {
            border-radius: 10px;
        }

        .error-msg {
            color: red;
            font-size: 0.875rem;
        }

        .image-preview {
            max-width: 150px;
            max-height: 150px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="blur-card shadow-lg">
    <h3 class="mb-4 text-center">Edit Cat Information</h3>

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Name" value="<?= htmlspecialchars($db_name) ?>" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="breed" placeholder="Breed" value="<?= htmlspecialchars($db_breed) ?>" required>
        </div>
        <div class="mb-3">
            <input type="number" class="form-control" name="age" placeholder="Age" value="<?= htmlspecialchars($db_age) ?>" required>
        </div>
        <div class="mb-3">
            <select class="form-control" name="sex" required>
                <option value="Male" <?= $db_sex == "Male" ? "selected" : "" ?>>Male</option>
                <option value="Female" <?= $db_sex == "Female" ? "selected" : "" ?>>Female</option>
            </select>
        </div>
        <div class="mb-3">
            <select class="form-control" name="neutered" required>
                <option value="Yes" <?= $db_neutered == "Yes" ? "selected" : "" ?>>Yes</option>
                <option value="No" <?= $db_neutered == "No" ? "selected" : "" ?>>No</option>
            </select>
        </div>
        <div class="mb-3">
            <select class="form-control" name="vaccination" required>
                <option value="Fully Vaccinated" <?= $db_vaccination == "Fully Vaccinated" ? "selected" : "" ?>>Fully Vaccinated</option>
                <option value="Partially Vaccinated" <?= $db_vaccination == "Partially Vaccinated" ? "selected" : "" ?>>Partially Vaccinated</option>
                <option value="Not Vaccinated" <?= $db_vaccination == "Not Vaccinated" ? "selected" : "" ?>>Not Vaccinated</option>
            </select>
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="description" rows="3" placeholder="Description" required><?= htmlspecialchars($db_description) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image">Upload New Image:</label>
            <input type="file" class="form-control" name="image" id="image">
            <?php if ($db_image): ?>
                <div class="mt-2">
                    <img src="cats/<?= htmlspecialchars($db_image) ?>" class="image-preview" alt="Current Image">
                </div>
            <?php endif; ?>
            <div class="error-msg"><?= $imageErr ?></div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Cat</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
