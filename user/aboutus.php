<?php include("nav.php"); ?>

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
    <?php include("nav.php"); ?>

    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-[#a4b465] bg-[url('../images/paw_bg.png')] bg-cover bg-repeat">
  

  <section class="w-full text-[#2f2f2f] py-10">
    <!-- About Us Header -->
    <div class="w-full flex flex-col items-start px-4 lg:px-20">
      <img src="../images/about.png" alt="About Us" class="w-auto h-auto max-w-[300px] mb-6"/>
    </div>

    <!-- Beige Container -->
    <div class="bg-[#fff9eb] w-full px-4 lg:px-20 py-6">
      <div class="flex flex-col lg:flex-row gap-6 items-start">
        <!-- Logo -->
        <div class="w-full lg:w-1/3 flex justify-center lg:justify-center">
          <img src="images/logo.png" alt="Logo" class="w-48 lg:w-60 h-auto"/>
        </div>

        <!-- Text Content -->
        <div class="w-full lg:w-2/3 text-sm md:text-base leading-relaxed">
          <p class="mb-4">
            At The Cat Cottage we are a group of people who love cats and want to help them find safe and loving homes. Our journey began in [Year] when we saw many cats without homes and decided to make a change. Since then, we've been working hard to rescue cats, take care of them, and find them families who will love them forever.
          </p>
          <p>
            Every cat we help is given medical care, including vaccinations and spaying or neutering, to ensure they’re healthy and ready for adoption. Our team is dedicated to making sure each cat gets the attention and care they need.
          </p>
        </div>
      </div>
    </div>

    <!-- Contact Info -->
<div class="w-full mt-10 px-4 lg:px-20 flex flex-wrap justify-between text-black text-center gap-6">
  <!-- Email -->
  <div class="flex-1 min-w-[140px]">
    <a href="mailto:jerstinmaniego@gmail.com" class="hover:underline">
      <i class="fas fa-envelope text-xl mb-1 text-black"></i>
      <p class="font-semibold">Email</p>
      <span class="text-sm">TheCatCottage@gmail.com</span>
    </a>
  </div>
  <!-- Phone -->
  <div class="flex-1 min-w-[140px]">
    <a href="tel:09994786073" class="hover:underline">
      <i class="fas fa-phone text-xl mb-1 text-black"></i>
      <p class="font-semibold">Contact</p>
      <span class="text-sm">(+63) 991 7161 497</span>
    </a>
  </div>
  <!-- Location -->
  <div class="flex-1 min-w-[140px]">
    <a href="https://maps.google.com/?q=12345 National Highway, Brgy. Sto Niño, Biñan, Laguna" target="_blank" class="hover:underline">
      <i class="fas fa-map-marker-alt text-xl mb-1 text-black"></i>
      <p class="font-semibold">Location</p>
      <span class="text-sm">12345 National Highway, Biñan</span>
    </a>
  </div>
  <!-- Facebook -->
  <div class="flex-1 min-w-[140px]">
    <a href="https://www.facebook.com/profile.php?id=61573358540262" target="_blank" class="hover:underline">
      <i class="fab fa-facebook text-xl mb-1 text-black"></i>
      <p class="font-semibold">Facebook</p>
      <span class="text-sm">The Cat Cottage</span>
    </a>
  </div>
  <!-- Instagram -->
  <div class="flex-1 min-w-[140px]">
    <a href="https://instagram.com/TheCatCottage" target="_blank" class="hover:underline">
      <i class="fab fa-instagram text-xl mb-1 text-black"></i>
      <p class="font-semibold">Instagram</p>
      <span class="text-sm">@TheCatCottage</span>
    </a>
  </div>
</div>

  </section>
</body>
</html>
