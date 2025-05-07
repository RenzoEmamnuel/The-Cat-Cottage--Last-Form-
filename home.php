<?php include("connections.php"); ?>

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>The Cat Cottage</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#a4b465] relative z-0">
  <?php include("nav.php"); ?>

  <!-- Vertical Half-Circle on Top-Left, Outside Background -->
  <div class="absolute top-[-50px] left-0 w-full sm:w-[500px] md:w-[600px] h-[550px] sm:h-[600px] md:h-[650px] bg-[#6f7753]/90 rounded-b-full z-30 flex items-center justify-center text-center px-6">
    <div class="mt-24 sm:mt-20 md:mt-28">
      <img src="images/title.png" alt="The Cat Cottage" class="mx-auto w-[200px] sm:w-[250px] md:w-[300px] mb-4"/>
      <p class="text-white text-sm sm:text-base md:text-base mb-5">
        Come visit our shelter and help bring a cat to<br />
        an ever-loving new home it deserves.
      </p>
      <a href="https://www.facebook.com/profile.php?id=61573358540262" target="_blank"
         class="inline-block bg-[#a79d65] text-white font-semibold py-2 px-5 rounded-full hover:bg-[#918949] transition">
        Learn More
      </a>
    </div>
  </div>

  <!-- Hero Background Section -->
  <section class="relative w-full mt-[20px]">
    <div class="w-full h-[400px] sm:h-[450px] md:h-[500px] relative bg-[url('images/cat_grass.jpg')] bg-cover bg-center md:bg-[center_top] overflow-hidden">
      <!-- Just the background, no content inside -->
    </div>
  </section>

</body>
</html>
