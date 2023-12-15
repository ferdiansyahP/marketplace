
<?php 
include "include/header.php";
include "include/navbar.php";
include "../../app/class/Product.php";
$product = new Product();
$productDibeli = $product->ProductDibeli($_SESSION['user_id']);
$productLatest = $product->getLatestProducts(5);
?>

    <!-- Main Content -->
    <div class="container mx-auto mt-8">

        <!-- Search Bar -->
        <div class="mb-6 flex items-center space-x-4">
            <input type="text" placeholder="Search..." class="w-full bg-gray-700 border border-gray-600 rounded-md p-2">
            <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Search</button>
        </div>


        <!-- Produk Terbaik -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-4 neon-text">Produk Dibeli</h2>
            <div class="flex overflow-x-auto space-x-4">
                <!-- Product Cards go here -->
                <?php
                if(!empty($productDibeli)){
                    foreach($productDibeli as $dibeli){
                ?>
                <div class="w-64 bg-gray-800 p-4 rounded-lg">
                    <h3 class="text-lg font-bold mb-2"><?= $dibeli['name']; ?></h3>
                    <p class="text-gray-300"><?= $dibeli['description']; ?></p>
                    <a href="./product_detail.php?id=<?php echo $dibeli['product_id']; ?>" class="text-blue-500 hover:underline block mt-4">Lihat Selengkapnya</a>
                </div>
                <?php
                    }}else{
                        echo '<p class="text-red-300">Anda tidak memiliki Product yang sudah dibeli</p>';
                    }
                ?>
                <!-- Repeat the card structure for other products -->
            </div>
        </section>

        <!-- Produk Terbaik -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-4 neon-text">Produk Terbaik</h2>
            <div class="flex overflow-x-auto space-x-4">
                <!-- Product Cards go here -->
                <div class="w-64 bg-gray-800 p-4 rounded-lg">
                    <h3 class="text-lg font-bold mb-2">Nama Produk 1</h3>
                    <p class="text-gray-300">Deskripsi singkat produk.</p>
                    <a href="#" class="text-blue-500 hover:underline block mt-4">Lihat Selengkapnya</a>
                </div>
                <!-- Repeat the card structure for other products -->
            </div>
        </section>

        <!-- Produk Terbaru -->
        <section>
            <h2 class="text-2xl font-bold mb-4 neon-text">Produk Terbaru</h2>
            <div class="flex overflow-x-auto space-x-4">
                <!-- Product Cards go here -->
                <?php
                if(!empty($productLatest)){
                    foreach($productLatest as $latest){
                ?>
                <div class="w-64 bg-gray-800 p-4 rounded-lg">
                    <h3 class="text-lg font-bold mb-2"><?= $latest['name']; ?></h3>
                    <p class="text-gray-300"><?= $latest['description']; ?></p>
                    <a href="./product_detail.php?id=<?php echo $latest['product_id']; ?>" class="text-blue-500 hover:underline block mt-4">Lihat Selengkapnya</a>
                </div>
                <?php
                    }}else{
                        echo '<p class="text-red-300">Anda tidak memiliki Product yang sudah dibeli</p>';
                    }
                ?>
                <!-- Repeat the card structure for other products -->
            </div>
        </section>
    </div>
<?php
include "include/footer.php";
?>