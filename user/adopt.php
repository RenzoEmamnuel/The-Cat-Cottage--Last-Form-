<?php include("connections.php"); ?>


<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>The Cat Cottage</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
   <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { poppins: ['Poppins', 'sans-serif'] },
          colors: {
            olivegreen: '#A4B465',
            lightcream: '#f5ecd5',
            adoptbtn: '#a3b77f',
            adoptbtnhover: '#8eaa7a',
          },
        }
      }
    }
  </script>
  <style>
    .glass-bg {
      background-color: rgba(245, 236, 213, 0.85);
      backdrop-filter: blur(10px);
    }
  </style>
</head>


<body class="font-poppins bg-olivegreen min-h-screen">
  <?php include("nav.php"); ?>

  <!-- Title Image -->
<header class="flex justify-center pt-6 px-4">
  <img src="../images/title.png" alt="The Cat Cottage Title" class="w-48 md:w-56 lg:w-64" loading="lazy">
</header>

  <!-- Decorative Design Top -->
  <div class="flex justify-center mt-[-4px] mb-10 px-4">
  <img src="../images/design1.png" alt="Decorative Flower Design" class="w-72 md:w-80 lg:w-96" loading="lazy">
  </div>

  <!-- Main Content -->
  <main class="pb-16 px-6 md:px-10 lg:px-20 -mt-6">
  <section class="glass-bg p-8 md:p-10 rounded-3xl shadow-lg">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        <?php
        $query = mysqli_query($connections, "SELECT * FROM cats WHERE status='Available'");
        while ($row = mysqli_fetch_assoc($query)) {
          $id = intval($row['id']);
          $fields = ['image', 'name', 'breed', 'age', 'sex', 'neutered', 'vaccination', 'description'];
          foreach ($fields as $f) $$f = htmlspecialchars($row[$f]);

          echo "
          <div class='bg-lightcream rounded-xl overflow-hidden shadow-md flex flex-col items-center cat-container cursor-pointer' onclick='showModal(\"{$id}\")'>
            <img src='{$image}' alt='Cat Image' class='w-40 h-40 object-cover mt-4' loading='lazy'>
            <div class='p-4 text-gray-800 text-center'>
              <p class='font-semibold text-lg'>{$name}</p>
              <button class='mt-4 bg-adoptbtn hover:bg-adoptbtnhover text-white font-semibold py-2 px-6 rounded-full transition duration-300' onclick='event.stopPropagation(); window.location.href=\"adoption_form.php?cat_id={$id}\"'>ADOPT</button>
            </div>
          </div>

          <!-- Modal for Cat {$id} -->
          <div id='modal-{$id}' class='fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden'>
            <div class='rounded-2xl p-6 max-w-md w-full shadow-xl relative' style='background-color: #f5ecd5;'>
              <button onclick='closeModal(\"{$id}\")' class='absolute top-2 right-3 text-xl font-bold text-gray-600 hover:text-black'>&times;</button>
              <img src='{$image}' alt='Cat Image' class='w-40 h-40 object-cover mx-auto mb-4 rounded'>
              <h2 class='text-center font-bold text-xl mb-2'>{$name}</h2>
              <ul class='text-sm text-gray-700 space-y-1'>
                <li><strong>Breed:</strong> {$breed}</li>
                <li><strong>Age:</strong> {$age}</li>
                <li><strong>Sex:</strong> {$sex}</li>
                <li><strong>Neutered:</strong> {$neutered}</li>
                <li><strong>Vaccination:</strong> {$vaccination}</li>
                <li><strong>Description:</strong> {$description}</li>
              </ul>
              <div class='text-center mt-4'>
                <button onclick='window.location.href=\"adoption_form.php?cat_id={$id}\"' class='bg-adoptbtn hover:bg-adoptbtnhover text-white font-semibold py-2 px-6 rounded-full transition duration-300'>ADOPT</button>
              </div>
            </div>
          </div>";
        }
        ?>
      </div>
    </section>
  </main>

<!-- Decorative Design Bottom -->
<div class="flex justify-center -mt-8 mb-10 px-4">
  <img src="../images/design1.png" alt="Decorative Flower Design Bottom" class="w-72 md:w-80 lg:w-96" loading="lazy">
</div>

  <!-- Modal JS -->
  <script>
    function showModal(id) {
      document.getElementById('modal-' + id).classList.remove('hidden');
    }
    function closeModal(id) {
      document.getElementById('modal-' + id).classList.add('hidden');
    }
  </script>
</body>

</html>
