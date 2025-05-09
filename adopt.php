<?php include("connections.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cat Adoption</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            poppins: ['Poppins', 'sans-serif']
          },
          colors: {
            darkgreen: '#626F47',
            olivegreen: '#A4B465',
            cream: '#f1f0d1',
            adoptbtn: '#a6c191',
            adoptbtnhover: '#8eaa7a',
          }
        }
      }
    }
  </script>
</head>

<body class="font-poppins bg-darkgreen min-h-screen">
  <?php include("nav.php"); ?>

  <main class="pt-32 pb-16 px-6 md:px-10 lg:px-20">
    <section class="bg-olivegreen p-10 md:p-12 rounded-3xl shadow-2xl">
      <h2 class="text-3xl font-semibold text-white text-center mb-10">Available Cats for Adoption</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
        <?php
        $query = mysqli_query($connections, "SELECT * FROM cats WHERE status='Available'");
        while ($row = mysqli_fetch_assoc($query)) {
            $image       = htmlspecialchars($row['image']);
            $name        = htmlspecialchars($row['name']);
            $breed       = htmlspecialchars($row['breed']);
            $age         = htmlspecialchars($row['age']);
            $sex         = htmlspecialchars($row['sex']);
            $neutered    = htmlspecialchars($row['neutered']);
            $vaccination = htmlspecialchars($row['vaccination']);
            $description = htmlspecialchars($row['description']);
            $id          = intval($row['id']);

            echo "
            <div class='bg-cream rounded-xl overflow-hidden shadow-md flex flex-col'>
              <img src='{$image}' alt='Cat Image' class='w-full h-52 object-cover'>

              <div class='p-4 text-gray-800 flex-1 flex flex-col justify-between'>
                <div class='text-sm space-y-1 text-center'>
                  <p><strong>Name:</strong> {$name}</p>
                  <p><strong>Breed:</strong> {$breed}</p>
                  <p><strong>Age:</strong> {$age}</p>
                  <p><strong>Sex:</strong> {$sex}</p>
                  <p><strong>Neutered:</strong> {$neutered}</p>
                  <p><strong>Vaccination:</strong> {$vaccination}</p>
                  <p><strong>Description:</strong> {$description}</p>
                </div>
                <div class='mt-4 text-center'>
                  <button class='bg-adoptbtn hover:bg-adoptbtnhover text-white font-semibold py-2 px-6 rounded-full transition-all duration-300' onclick='window.location.href=\"login.php?cat_id={$id}\"'>ADOPT</button>
                </div>
              </div>
            </div>
            ";
        }
        ?>
      </div>
    </section>
  </main>
</body>
</html>
