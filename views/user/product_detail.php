<?php
include "include/header.php";
include "include/navbar.php";
include "../../app/class/Product.php";
$products = new Product();
// echo $_GET['id'];
// echo $_SESSION['user_id'];

// var_dump($products->getSingleProduct($_SESSION['user_id'],$_GET['id']));
$producsInfo = $products->getProductById($_GET["id"]);
$product = $products->getSingleProduct($_SESSION['user_id'],$_GET['id'])
?>
<style>
        .blurred {
            filter: blur(5px);
            -webkit-filter: blur(5px);
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: none;
            user-select: none;
        }

        .overlay p {
            color: white;
            font-size: 20px;
            text-align: center;
        }
</style>
  <!-- Main Content -->
  <div class="container mx-auto mt-8">

<!-- Produk Detail -->
<section class="mb-8">
    <?php
    if(!empty($producsInfo)){
        foreach($producsInfo as $p){
    ?>
    <h2 class="text-2xl font-bold neon-text mb-4">Detail : <?= $p['name']; ?></h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Gambar Produk -->
        
        <!-- Informasi Produk -->
        <div>
            <h3 class="text-3xl font-bold mb-2"><?= $p['name']; ?></h3>
            <p class="text-gray-300"><?= $p['description']; ?></p>
            <p class="text-gray-300">Harga: <?= $p['price']; ?></p>
            <p class="text-gray-300">Harga: <?= $p['username']; ?></p>
            <!-- Tombol untuk Membeli Produk -->
            <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Beli Produk</button>
        </div>
    </div>
    <?php
        }}else{
            echo "kontent tidak ditemukan";
        }
?>
</section>

<!-- Konten yang akan di-blur jika belum membayar -->
<?php
// Memastikan $_GET["id"] telah di-set dan sesuai kebutuhan untuk menghindari SQL injection
$product_id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$cek = $products->cekUserForBuy($_SESSION["user_id"], $product_id);

if ($cek == true) {
    foreach ($product as $y) {
        ?>
        
        <section class="mb-8">
    <h2 class="text-2xl font-bold neon-text mb-4">Konten Setelah Pembelian</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Konten yang di-blur -->
        <div>
            <h3 class="text-3xl font-bold mb-2"><?php echo $y['name']; ?></h3>
            <p class="text-gray-300"><?php echo $y['description']; ?></p>
        </div>
        <!-- Cek product_type dan tampilkan konten sesuai -->
        <?php if ($y['product_type'] === 'video') : ?>
            <!-- Jika product_type adalah video -->
            <div class="video-container">
                <!-- Tampilkan video sesuai dengan path atau file yang sesuai -->
                <video controls>
                    <source src="<?php echo $y['path']; ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        <?php elseif ($y['product_type'] === 'pdf') : ?>
            <!-- Jika product_type adalah PDF -->
            
            <div class="pdf-container p-4 bg-white rounded-md shadow-md">
                <!-- Tampilkan embed PDF sesuai dengan path atau file yang sesuai -->

                <iframe src="<?php echo $y['path'].$y['file']; ?>" class="w-full h-96" frameborder="0"></iframe>
            </div>
        <?php elseif ($y['product_type'] === 'zip') : ?>
            <!-- Jika product_type adalah ZIP (arsip) -->
            <div class="zip-container">
                <!-- Tampilkan informasi atau link untuk men-download ZIP -->
                <p>Ini adalah produk tipe ZIP. Silakan klik link berikut untuk men-download:</p>
                <a href="<?php echo $y['path']; ?>" download>Download ZIP</a>
            </div>

        <?php endif; ?>
    </div>
</section>

    <?php
    }
} else {
    ?>
    <section class="mb-8 blurred">
        <h2 class="text-2xl font-bold neon-text mb-4">Konten Setelah Pembelian</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Konten yang di-blur -->
            <div>
                <h3 class="text-3xl font-bold mb-2">Judul Konten</h3>
                <p class="text-gray-300">Deskripsi singkat konten.</p>
            </div>
            <!-- Overlay -->
            <div class="overlay">
                <p>Teks ini tidak dapat disalin.</p>
            </div>
        </div>
    </section>
<?php
}
?>

</div>



<script>
    // Fungsi untuk membuka modal dan menampilkan PDF
    function openPdfModal(pdfUrl) {
        document.getElementById('pdfViewer').src = pdfUrl;
        document.getElementById('pdfModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closePdfModal() {
        document.getElementById('pdfModal').classList.add('hidden');
    }

    // Event listener untuk tombol membuka modal
    document.getElementById('openPdfModal').addEventListener('click', function () {
        openPdfModal('path/ke/pdf/file.pdf'); // Gantilah dengan path sesuai dengan kebutuhan Anda
    });

    // Event listener untuk tombol menutup modal
    document.getElementById('closePdfModal').addEventListener('click', closePdfModal);
</script>

<?php
include "include/footer.php";
?>