<?php
// Initialize all variables to avoid undefined warnings
$email = $name = $breed = $age = $sex = $neutered = $vaccination = $description = "";
$emailErr = $nameErr = $breedErr = $ageErr = $sexErr = $neuteredErr = $vaccinationErr = $descriptionErr = $imageErr = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Submit a Cat</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-[#a4b465] font-[Poppins] min-h-screen flex flex-col">

  <?php include("nav.php"); ?>

  <div class="flex flex-col items-center justify-center px-4 py-6 w-full">
    
    <div class="bg-[#f6eddc] shadow-lg rounded-2xl p-4 sm:p-6 w-full max-w-3xl mx-auto">
      <h2 class="text-lg sm:text-xl font-semibold text-center text-[#333] mb-4">Submit a Cat for Adoption</h2>
      
      <form method="POST" action="" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <div>
          <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Your Email" class="w-full p-2 rounded-md border border-gray-300 focus:ring-[#5F6F43] focus:ring-2">
          <div class="text-red-600 text-sm mt-1"><?= $emailErr ?></div>
        </div>

        <div>
          <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" placeholder="Cat's Name" class="w-full p-2 rounded-md border border-gray-300 focus:ring-[#5F6F43] focus:ring-2">
          <div class="text-red-600 text-sm mt-1"><?= $nameErr ?></div>
        </div>

        <div>
          <input type="text" name="breed" value="<?= htmlspecialchars($breed) ?>" placeholder="Breed" class="w-full p-2 rounded-md border border-gray-300 focus:ring-[#5F6F43] focus:ring-2">
          <div class="text-red-600 text-sm mt-1"><?= $breedErr ?></div>
        </div>

        <div>
          <input type="number" name="age" value="<?= htmlspecialchars($age) ?>" placeholder="Age" class="w-full p-2 rounded-md border border-gray-300 focus:ring-[#5F6F43] focus:ring-2">
          <div class="text-red-600 text-sm mt-1"><?= $ageErr ?></div>
        </div>

        <div>
          <select name="sex" class="w-full p-2 rounded-md border border-gray-300 focus:ring-[#5F6F43] focus:ring-2">
            <option value="" disabled <?= $sex == "" ? "selected" : "" ?>>Select Sex</option>
            <option value="Male" <?= $sex == "Male" ? "selected" : "" ?>>Male</option>
            <option value="Female" <?= $sex == "Female" ? "selected" : "" ?>>Female</option>
          </select>
          <div class="text-red-600 text-sm mt-1"><?= $sexErr ?></div>
        </div>

        <div>
          <select name="neutered" class="w-full p-2 rounded-md border border-gray-300 focus:ring-[#5F6F43] focus:ring-2">
            <option value="" disabled <?= $neutered == "" ? "selected" : "" ?>>Neutered?</option>
            <option value="Yes" <?= $neutered == "Yes" ? "selected" : "" ?>>Yes</option>
            <option value="No" <?= $neutered == "No" ? "selected" : "" ?>>No</option>
          </select>
          <div class="text-red-600 text-sm mt-1"><?= $neuteredErr ?></div>
        </div>

        <div>
          <input type="text" name="vaccination" value="<?= htmlspecialchars($vaccination) ?>" placeholder="Vaccination Status" class="w-full p-2 rounded-md border border-gray-300 focus:ring-[#5F6F43] focus:ring-2">
          <div class="text-red-600 text-sm mt-1"><?= $vaccinationErr ?></div>
        </div>

        <div class="md:col-span-2">
          <textarea name="description" rows="2" placeholder="Description" class="w-full p-2 rounded-md border border-gray-300 focus:ring-[#5F6F43] focus:ring-2"><?= htmlspecialchars($description) ?></textarea>
          <div class="text-red-600 text-sm mt-1"><?= $descriptionErr ?></div>
        </div>

        <div class="md:col-span-2">
          <input type="file" name="image" accept="image/*" class="w-full p-2 bg-white rounded-md border border-gray-300">
          <div class="text-red-600 text-sm mt-1"><?= $imageErr ?></div>
        </div>

        <div class="md:col-span-2">
          <button type="submit" class="w-full bg-[#3e7a3c] text-white font-semibold py-2 rounded-md hover:bg-[#366835] transition">Submit</button>
        </div>
      </form>
    </div>
  </div>

 

  <script>
    function redirectToHome() {
      window.location.href = 'index.php';
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
