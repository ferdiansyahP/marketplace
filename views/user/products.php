<?php
include "include/header.php";
include "include/navbar.php";
include "../../app/class/Product.php";
$products = new Product();
$prod = $products->getAllProducts();
$kat = $products->getAllCategory();
?>

 <!-- Main Content -->
 <div class="container mx-auto mt-8">

<!-- Filter Section -->
<section class="mb-6 flex items-center space-x-4">
    <!-- Filter by Programming Language -->
    <select class="bg-gray-700 border border-gray-600 rounded-md p-2">
        <option value="all">Semua Bahasa Pemrograman</option>
        <?php
        if(!empty($kat)){
            foreach($kat as $x){
        ?>
        <option value="<?php echo $x['kategori_id']; ?>"><?php echo $x['nama_kategori']; ?></option>
        <?php
            }}else{
                echo '<option value="Tidak ada">Tidak ada data</option>';
            }
        ?>
    </select>

    <!-- Filter by Product Type -->
    <select class="bg-gray-700 border border-gray-600 rounded-md p-2">
        <option value="all">Semua Jenis Produk</option>
        <option value="video">Video</option>
        <option value="materi">Materi</option>
        <option value="project">Project</option>
        <!-- Tambahkan pilihan jenis produk lainnya -->
    </select>

    <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Terapkan Filter</button>
</section>

<!-- Produk Terbaru -->
<section class="mb-8">
    <h2 class="text-2xl font-bold neon-text mb-4">Semua Produk</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <!-- Product Cards go here -->
        <!-- Repeat the card structure for each product -->
        <?php
        if(!empty($prod)){
            foreach($prod as $y){
        ?>
        <div class="bg-gray-800 p-4 rounded-lg">
    <h3 class="text-lg font-bold mb-2"><?php echo $y['name']; ?></h3>
    <p class="text-gray-300"><?php echo $y['description']; ?></p>
    
    <!-- Menambahkan informasi harga, tipe, dan tanggal -->
    <p class="text-gray-300">Harga: <?php echo $y['price']; ?></p>
    <p class="text-gray-300">Tipe: <?php echo $y['product_type']; ?></p>
    <p class="text-gray-300">Dibuat Tanggal: <?php echo $y['created_at']; ?></p>
    
    <a href="product_detail.php?id=<?php echo $y['product_id']; ?>" class="text-blue-500 hover:underline block mt-4">Lihat Selengkapnya</a>
</div>

        <?php
            }}else{
                echo 'Tidak ada data';
            }
        ?>
    </div>
</section>

<!-- Paginasi -->
<div class="flex items-center justify-center">
    <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Sebelumnya</button>
    <span class="mx-4 text-gray-300">1</span>
    <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Berikutnya</button>
</div>
</div>
<?php
include "include/footer.php";
?>