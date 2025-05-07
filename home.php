<?php include("connections.php"); ?>

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>The Cat Cottage</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-[#a4b465] relative z-0">
  <?php include("nav.php"); ?>

  <!-- Vertical Half-Circle on Top-Left -->
  <div class="absolute top-[-50px] left-0 w-full sm:w-[500px] md:w-[600px] h-[550px] sm:h-[600px] md:h-[622px] bg-[#6f7753]/90 rounded-b-full z-30 flex items-center justify-center text-center px-6">
    <div class="mt-24 sm:mt-20 md:mt-28">
      <img src="images/logo.png" alt="The Cat Cottage Logo" class="mx-auto w-[60px] sm:w-[80px] md:w-[100px]" />
      <img src="images/title.png" alt="The Cat Cottage" class="mx-auto w-[200px] sm:w-[250px] md:w-[300px]" />
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
    </div>
  </section>

  <!-- Why Adopt Section -->
  <section class="relative mt-6 mb-10 px-4 sm:px-6 md:px-10">
    <div class="bg-[#c9d2a3] rounded-l-[120px] rounded-r-[120px] px-6 sm:px-8 md:px-10 py-6 md:py-8 flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-8">
      <div class="w-full md:w-1/2 flex justify-center">
        <img src="images/half.png" alt="Half cat illustration" class="w-[220px] sm:w-[280px] md:w-[350px] lg:w-[400px] h-auto object-contain mx-auto"/>
      </div>
      <div class="w-full md:w-1/2 text-[#3d3d3d] flex flex-col items-center md:items-start">
        <img src="images/why.png" alt="Why adopt a cat title" class="w-[220px] sm:w-[260px] md:w-[320px] mb-4 md:mb-5 mx-auto" />
        <p class="text-xs sm:text-sm md:text-base leading-relaxed text-center md:text-left font-[400] font-[Poppins] mb-6">
          ฅ^._.^ฅ <br>Cats are wonderful pets, known for reducing stress, easing loneliness, and filling your days with playful moments.
          When you adopt, you also support rescue efforts, helping more cats find the homes they deserve.
          Plus, our cats are already vaccinated, spayed/neutered, and ready to become part of your family.
          Why buy when you can change a life? Start your journey today.
        </p>
      </div>
    </div>
  </section>

<!-- Steps Carousel Section With Background Image -->
<section class="relative w-full bg-cover bg-center py-2 sm:py-3 md:py-4" style="background-image: url('images/blanket_cat.png');">
  <!-- Background Overlay (optional, for readability) -->
  <div class="absolute inset-0 bg-[#a4b465]/80 z-0"></div>

  <!-- Carousel Content Wrapper -->
  <div class="relative z-20 max-w-5xl mx-auto px-4 sm:px-6 md:px-10">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">

        <!-- Step 01 -->
        <div class="swiper-slide flex flex-col md:flex-row items-center justify-between rounded-[20px] p-6 sm:p-10 bg-transparent">
          <div class="w-full md:w-1/2 text-white text-center md:text-left relative">
            <!-- Vertical Line -->
            <div class="hidden md:block absolute right-[-25px] top-0 bottom-0 w-0.5 bg-white/50"></div>
            <img src="images/step1.png" alt="Step 01 Title" class="mx-auto md:mx-0 w-[140px] mb-3">
            <p class="text-sm sm:text-base mb-6">
              Explore our heartwarming gallery of cats and pick the one that steals your heart.
            </p>
            <a href="#" class="bg-[#f7bb92] text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-[#e2a76d] transition">
              ADOPT NOW
            </a>
          </div>
          <div class="w-full md:w-1/2 flex justify-center mt-6 md:mt-0">
            <div class="relative w-[200px] h-[200px] sm:w-[240px] sm:h-[240px] rounded-full overflow-hidden shadow-lg">
              <img src="images/circle_cat.png" alt="Cat Step 01" class="object-cover w-full h-full" />
            </div>
          </div>
        </div>

        <!-- Step 02 -->
        <div class="swiper-slide flex flex-col md:flex-row items-center justify-between rounded-[20px] p-6 sm:p-10 bg-transparent">
          <div class="w-full md:w-1/2 text-white text-center md:text-left relative">
            <div class="hidden md:block absolute right-[-25px] top-0 bottom-0 w-0.5 bg-white/50"></div>
            <img src="images/step2.png" alt="Step 02 Title" class="mx-auto md:mx-0 w-[140px] mb-3">
            <p class="text-sm sm:text-base mb-6">
              Visit our shelter or contact us for a virtual meeting with your chosen furball.
            </p>
            <a href="#" class="bg-[#f7bb92] text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-[#e2a76d] transition">
              ADOPT NOW
            </a>
          </div>
          <div class="w-full md:w-1/2 flex justify-center mt-6 md:mt-0">
            <div class="relative w-[200px] h-[200px] sm:w-[240px] sm:h-[240px] rounded-full overflow-hidden shadow-lg">
              <img src="images/circle_cat.png" alt="Cat Step 02" class="object-cover w-full h-full" />
            </div>
          </div>
        </div>

        <!-- Step 03 -->
        <div class="swiper-slide flex flex-col md:flex-row items-center justify-between rounded-[20px] p-6 sm:p-10 bg-transparent">
          <div class="w-full md:w-1/2 text-white text-center md:text-left relative">
            <div class="hidden md:block absolute right-[-25px] top-0 bottom-0 w-0.5 bg-white/50"></div>
            <img src="images/step3.png" alt="Step 03 Title" class="mx-auto md:mx-0 w-[140px] mb-3">
            <p class="text-sm sm:text-base mb-6">
              Finalize the papers and welcome your new family member home!
            </p>
            <a href="#" class="bg-[#f7bb92] text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-[#e2a76d] transition">
              ADOPT NOW
            </a>
          </div>
          <div class="w-full md:w-1/2 flex justify-center mt-6 md:mt-0">
            <div class="relative w-[200px] h-[200px] sm:w-[240px] sm:h-[240px] rounded-full overflow-hidden shadow-lg">
              <img src="images/circle_cat.png" alt="Cat Step 03" class="object-cover w-full h-full" />
            </div>
          </div>
        </div>

      </div>
      <div class="swiper-pagination mt-6"></div>
    </div>
  </div>
</section>

<!-- Swiper Script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper(".mySwiper", {
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    autoplay: {
      delay: 4000,
    },
  });
</script>


</body>
</html>
