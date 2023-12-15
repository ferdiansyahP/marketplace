<?php
include "include/header.php";
include "include/navbar.php";
?>

 <!-- Main Content -->
 <div class="container mx-auto mt-8">

<!-- Keranjang Belanja -->
<section class="mb-8">
    <h2 class="text-2xl font-bold neon-text mb-4">Keranjang Belanja</h2>
    <!-- Total Belanja -->
    <div class="flex justify-center">
        <div class="text-right">
            <p class="text-gray-300">Total Belanja: $199.98</p>
            <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Checkout</button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Item Keranjang -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <h3 class="text-lg font-bold mb-2">Nama Produk 1</h3>
            <p class="text-gray-300">Deskripsi singkat produk.</p>
            <p class="text-gray-300">Harga: $99.99</p>
            <p class="text-gray-300">Jumlah: 2</p>
            <button class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 transition duration-300">Hapus</button>
        </div>
        <!-- Item Keranjang lainnya -->
        <!-- Tambahkan lebih banyak item keranjang sesuai kebutuhan -->
    </div>
</section>


</div>

<?php
include "include/footer.php";
?>
