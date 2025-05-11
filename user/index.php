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
      <a href="aboutus.php" 
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
      <div class="swiper-slide flex flex-col md:flex-row items-center justify-between rounded-[20px] p-8 sm:p-12 bg-transparent">
        <div class="w-full md:w-1/2 text-white text-center md:text-left relative">
          <!-- Vertical Line -->
          <div class="hidden md:block absolute right-[-25px] top-0 bottom-0 w-0.5 bg-white/50"></div>
          <img src="images/step1.png" alt="Step 01 Title" class="mx-auto md:mx-0 w-[200px] mb-6">
          <p class="text-lg sm:text-xl mb-8">
            Explore our heartwarming gallery of cats and pick the one that steals your heart.
          </p>
          <a href="adopt.php" class="bg-[#626F47] text-white py-3 px-8 rounded-full text-base font-semibold hover:text-black hover:bg-[#F5ECD5] transition duration-300">
            ADOPT NOW
          </a>
        </div>
        <div class="w-full md:w-1/2 flex justify-center mt-8 md:mt-0">
          <div class="relative w-[300px] h-[300px] sm:w-[320px] sm:h-[320px] rounded-full overflow-hidden shadow-lg">
            <img src="images/logo.png" alt="Cat Step 01" class="object-cover w-full h-full" />
          </div>
        </div>
      </div>

      <!-- Step 02 -->
      <div class="swiper-slide flex flex-col md:flex-row items-center justify-between rounded-[20px] p-8 sm:p-12 bg-transparent">
        <div class="w-full md:w-1/2 text-white text-center md:text-left relative">
          <div class="hidden md:block absolute right-[-25px] top-0 bottom-0 w-0.5 bg-white/50"></div>
          <img src="images/step2.png" alt="Step 02 Title" class="mx-auto md:mx-0 w-[200px] mb-6">
          <p class="text-lg sm:text-xl mb-8">
            Visit our shelter or contact us for a virtual meeting with your chosen furball.
          </p>
          <a href="adopt.php" class="bg-[#626F47] text-white py-3 px-8 rounded-full text-base font-semibold hover:text-black hover:bg-[#F5ECD5] transition duration-300">
            ADOPT NOW
          </a>
        </div>
        <div class="w-full md:w-1/2 flex justify-center mt-8 md:mt-0">
          <div class="relative w-[300px] h-[300px] sm:w-[320px] sm:h-[320px] rounded-full overflow-hidden shadow-lg">
            <img src="images/logo.png" alt="Cat Step 02" class="object-cover w-full h-full" />
          </div>
        </div>
      </div>

      <!-- Step 03 -->
      <div class="swiper-slide flex flex-col md:flex-row items-center justify-between rounded-[20px] p-8 sm:p-12 bg-transparent">
        <div class="w-full md:w-1/2 text-white text-center md:text-left relative">
          <div class="hidden md:block absolute right-[-25px] top-0 bottom-0 w-0.5 bg-white/50"></div>
          <img src="images/step3.png" alt="Step 03 Title" class="mx-auto md:mx-0 w-[200px] mb-6">
          <p class="text-lg sm:text-xl mb-8">
            Finalize the papers and welcome your new family member home!
          </p>
          <a href="adopt.php" class="bg-[#626F47] text-white py-3 px-8 rounded-full text-base font-semibold hover:text-black hover:bg-[#F5ECD5] transition duration-300">
            ADOPT NOW
          </a>
        </div>
        <div class="w-full md:w-1/2 flex justify-center mt-8 md:mt-0">
          <div class="relative w-[300px] h-[300px] sm:w-[320px] sm:h-[320px] rounded-full overflow-hidden shadow-lg">
            <img src="images/logo.png" alt="Cat Step 03" class="object-cover w-full h-full" />
          </div>
        </div>
      </div>

    </div>
    <div class="swiper-pagination mt-8"></div>
  </div>
</div>

</section>
<section class="relative bg-cover bg-center py-16 px-6 text-white" style="background-image: url('images/cat_grasss2.jpg');">
  <!-- Happy Image and Subtitle -->
  <div class="absolute top-6 left-6 z-20 max-w-4xl">
    <img src="images/happy.png" alt="Happy Cats, Happy Hearts" class="w-full sm:w-[480px] max-w-full">
    <p class="mx-4 my-2 text-sm sm:text-base md:text-lg lg:text-xl text-black w-auto max-w-full leading-relaxed drop-shadow-[0_0_2px_#F0BB78] break-words">
    "Bringing home a rescue cat means gaining a best friend. Read inspiring stories from adopters who found happiness through adoption!"
</p>

</div>



 <!-- Story Cards Container -->
<div class="story-container-wrapper mt-[150px] w-[90%] max-w-6xl mx-auto">
  <!-- Story Card 1 -->
  <div class="story-container bg-[#A4B465]/70 backdrop-blur-md rounded-xl px-12 py-10 flex flex-col md:flex-row items-center md:items-start gap-8 relative">
    <div class="relative flex-shrink-0">
      <div class="absolute -top-6 -left-6 w-32 h-32 bg-[#f5ecd5] z-0 rounded filter blur-md"></div>
      <div class="absolute top-6 left-6 w-28 h-28 bg-[#a3b77f] z-0 rounded filter blur-md"></div>
      <img src="images/daniel.jpg" alt="Daniel & Oliver" class="relative z-10 w-32 h-32 rounded shadow-md">
    </div>
    <div class="text-left text-white flex-1 pt-2">
      <h3 class="font-bold uppercase text-lg sm:text-xl">DANIEL REYES & OLIVER</h3>
      <p class="text-sm sm:text-base mt-2 leading-snug">
      "I adopted Oliver through this website, and he’s been a blessing ever since. From the moment he arrived, he made himself right at home—greeting me at the door, sleeping on my lap, and even 'helping' with my work. Giving him a home has been the most rewarding experience."
</p>
    </div>
    <div class="flex gap-4 text-3xl text-white pt-6 md:pt-12 absolute bottom-4 right-4">
      <button class="prevBtn hover:text-yellow-300">&#10094;</button>
      <button class="nextBtn hover:text-yellow-300">&#10095;</button>
    </div>
  </div>

  <!-- Story Card 2 -->
  <div class="story-container hidden bg-[#A4B465]/70 backdrop-blur-md rounded-xl px-12 py-10 flex flex-col md:flex-row items-center md:items-start gap-8 relative">
    <div class="relative flex-shrink-0">
      <div class="absolute -top-6 -left-6 w-32 h-32 bg-[#f5ecd5] z-0 rounded filter blur-md"></div>
      <div class="absolute top-6 left-6 w-28 h-28 bg-[#a3b77f] z-0 rounded filter blur-md"></div>
      <img src="images/lucas.jpg" alt="Lucas & Snickers" class="relative z-10 w-32 h-32 rounded shadow-md">
    </div>
    <div class="text-left text-white flex-1 pt-2">
      <h3 class="font-bold uppercase text-lg sm:text-xl">LUCAS RAMOS & SNICKERS</h3>
      <p class="text-sm sm:text-base mt-2 leading-snug">
      "Snickers came into our lives thanks to this adoption site. He was abandoned at a park, and when we first met, he was shy. But with a little love, he became the most affectionate cat. He truly brings so much joy to our home."      </p>
    </div>
    <div class="flex gap-4 text-3xl text-white pt-6 md:pt-12 absolute bottom-4 right-4">
      <button class="prevBtn hover:text-yellow-300">&#10094;</button>
      <button class="nextBtn hover:text-yellow-300">&#10095;</button>
    </div>
  </div>

  <!-- Story Card 3 -->
  <div class="story-container hidden bg-[#A4B465]/70 backdrop-blur-md rounded-xl px-12 py-10 flex flex-col md:flex-row items-center md:items-start gap-8 relative">
    <div class="relative flex-shrink-0">
      <div class="absolute -top-6 -left-6 w-32 h-32 bg-[#f5ecd5] z-0 rounded filter blur-md"></div>
      <div class="absolute top-6 left-6 w-28 h-28 bg-[#a3b77f] z-0 rounded filter blur-md"></div>
      <img src="images/jessica.jpg" alt="Jessica & Luna" class="relative z-10 w-32 h-32 rounded shadow-md">
    </div>
    <div class="text-left text-white flex-1 pt-2">
      <h3 class="font-bold uppercase text-lg sm:text-xl">JESSICA MANALO & LUNA</h3>
      <p class="text-sm sm:text-base mt-2 leading-snug">
      "I found Luna through this site, and I couldn’t be more grateful. She was a bit timid at first, but within days, she became my little shadow! Her cuddles and playful energy light up my day—adopting her here was the best decision I’ve made."      </p>
    </div>
    <div class="flex gap-4 text-3xl text-white pt-6 md:pt-12 absolute bottom-4 right-4">
      <button class="prevBtn hover:text-yellow-300">&#10094;</button>
      <button class="nextBtn hover:text-yellow-300">&#10095;</button>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const storyContainers = document.querySelectorAll('.story-container');
    let currentIndex = 0;

    function updateStory() {
      storyContainers.forEach((container, index) => {
        container.classList.toggle('hidden', index !== currentIndex);
      });
    }

    document.querySelectorAll('.prevBtn').forEach((button, index) => {
      button.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + storyContainers.length) % storyContainers.length;
        updateStory();
      });
    });

    document.querySelectorAll('.nextBtn').forEach((button, index) => {
      button.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % storyContainers.length;
        updateStory();
      });
    });

    updateStory();
  });
</script>




    


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
