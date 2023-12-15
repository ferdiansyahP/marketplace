<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Neotokyo Marketplace</title>
</head>
<body class="bg-black text-white font-sans">

  <!-- Header -->
  <header class="bg-black p-6 text-center">
    <h1 class="text-4xl font-bold neon-text">Neotokyo Marketplace</h1>
    <p class="text-lg mt-2">Explore the Future of Selling and Buying Digital Products</p>
  </header>

  <!-- Navigation -->
  <nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-center space-x-8">
      <a href="#home" class="text-white hover:text-gray-400 transition duration-300">Home</a>
      <a href="#product" class="text-white hover:text-gray-400 transition duration-300">Products</a>
      <a href="#about" class="text-white hover:text-gray-400 transition duration-300">About</a>
      <a href="#contact" class="text-white hover:text-gray-400 transition duration-300">Contact</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-gray-900 text-center py-20" id="home">
    <div class="container mx-auto">
      <h2 class="text-5xl font-bold mb-4 neon-text">Empower Your Digital Journey with Neotokyo Marketplace</h2>
      <p class="text-lg mb-8">Join our platform to sell and discover cutting-edge digital content, projects, and more.</p>
      <a href="./views/login.php" class="bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-600 transition duration-300">Explore Now</a>
    </div>
  </section>

  <!-- Featured Products Section -->
<section class="bg-gray-800 py-16" id="product">
  <div class="container mx-auto text-center">
    <h2 class="text-4xl font-bold mb-8 neon-text">Featured Digital Products</h2>

    <!-- Product Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
      <!-- Product Card Example -->
      <div class="bg-gray-700 p-6 rounded-lg shadow-md">
        <img src="product1.jpg" alt="Product 1" class="w-full h-48 object-cover mb-4 rounded">
        <h3 class="text-lg font-bold">Futuristic Gadget</h3>
        <p class="text-gray-300">Experience cutting-edge technology.</p>
        <a href="#" class="text-blue-500 mt-2 hover:underline">View Details</a>
      </div>

      <!-- Add more product cards as needed -->
    </div>
  </div>
</section>

    <!-- About Us Section -->
<section class="bg-gray-900 text-white py-16" id="about">
  <div class="container mx-auto text-center">
    <h2 class="text-4xl font-bold mb-8 neon-text">About Neotokyo Marketplace</h2>
    <p class="text-lg mb-8">
      Welcome to Neotokyo Marketplace, a portal to the future of digital commerce. Immerse yourself in a world where innovation, technology, and creativity converge. Our avant-garde platform is tailored for forward-thinking creators, offering a space to showcase and commercialize visionary digital products.
    </p>
    <p class="text-lg mb-8">
      Neotokyo Marketplace envisions a limitless future for digital content. Whether you're an architect of ideas, an educator, or a digital artisan, our platform provides a launchpad for your creations. Embrace the forefront of technology and join a community that shares your passion for pushing boundaries.
    </p>
    <p class="text-lg mb-8">
      Why Neotokyo Marketplace?
      <ul class="list-disc text-left ml-8">
        <li>Seamless and secure transactions through cutting-edge technology</li>
        <li>Global exposure for your digital innovations</li>
        <li>Futuristic design and user interface</li>
        <li>Connect with a community of visionaries and creators</li>
      </ul>
    </p>
  </div>
</section>

  <!-- Contact Section -->
  <section class="bg-gray-900 text-white py-16" id="contact">
    <div class="container mx-auto text-center">
      <h2 class="text-4xl font-bold mb-8 neon-text">Contact Us</h2>
      <p class="text-lg mb-8">Have questions or need assistance? Reach out to our support team!</p>

      <!-- Contact Information -->
      <div class="flex justify-center space-x-6">
        <div>
          <p class="text-xl font-bold">Customer Support</p>
          <p>Email: support@neotokyo.market</p>
        </div>
        <div>
          <p class="text-xl font-bold">Business Inquiries</p>
          <p>Email: business@neotokyo.market</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-center py-8">
    <p class="text-gray-400">&copy; 2023 Neotokyo Marketplace. All rights reserved.</p>
  </footer>

</body>
</html>
