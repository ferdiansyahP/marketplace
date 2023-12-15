<?php
include "include/header.php";
include "include/navbar.php";
include "../../app/class/Profile.php";
$profile = new profile();
if(!$_SESSION['user_id']){
    header('../login.php');
}
$user = $profile->getUserProfile($_SESSION['user_id']);
$product = $profile->getUserProduct($_SESSION['user_id']);
$kategori = $profile->getKategori();
// var_dump($user);
// var_dump($product);

?>
<style>
    .type{
        text-align: end;
        font-size: 14px;
    }
    .harga{
        text-align:start;
        font-size: 14px;
    }
</style>

<!-- Main Content -->
<div class="container mx-auto mt-8">

<!-- Profile Section -->
<section class="mb-8">
    <h2 class="text-2xl font-bold neon-text mb-4">Profil Anda</h2>
    <!-- Include profile details here -->
    <div class="bg-gray-800 p-4 rounded-lg"><?php
    if(!empty($user)){
        foreach($user as $u){
    ?>
        <h3 class="text-lg font-bold mb-2">Nama Pengguna : <?= $u['username']; ?></h3>
        <p class="text-gray-300">Email : <?= $u['email']; ?></p>
        <p class="text-gray-300">Bio : <?= $u['bio']; ?></p>
        <button onclick="openModalEdit()" class="bg-green-500 rounded-md text-white py-2 px-2 hover:bg-green-700 transition duration-300 mb-1 mt-1">Edit</button>
    <?php
        }}else{
            echo '<p class="text-red-300">Silahkan login terlebih dahulu</p>';
        }
    ?>
    </div>
</section>

<!-- Produk Anda -->
<section class="mb-8">
    <h2 class="text-2xl font-bold neon-text mb-4">Produk Anda</h2>
    <!-- Button untuk membuka modal -->
<button onclick="openModal()" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300 mb-3">Tambah Produk</button>

    <div class="flex flex-wrap -mx-4">
        <!-- Product Cards go here -->
        <?php 
        if(!empty($product)){
            foreach($product as $p){
        ?>
        <div class="w-1/4 px-4 mb-4">
            <div class="bg-gray-800 p-4 rounded-lg">
                <h3 class="text-lg font-bold mb-2"><?= $p['name'];?></h3>
                <hr>
                <p class="text-gray-300"><?= $p['description']; ?></p>
                <p class="text-gray-300">Harga : <?= $p['price']; ?> | <span class="type"><?= $p['product_type']; ?></span></p>
                <p class="text-gray-300">Kategori : <?= $p['nama_kategori']; ?></p>
                <a href="./product_detail.php?id=<?php echo $p['product_id']; ?>" class="text-blue-500 hover:underline block mt-4">Lihat Selengkapnya</a><span class="text-gray-300 type"><?= $p['created_at']; ?></span>
                <a href="../../app/proses/product.php?action=delete&id=<?php echo $p['product_id']; ?>" class="text-red-500 hover:underline block mt-4">Delete</a>
            </div>
        </div>
        <?php
            }}else{
                echo '<p class="text-red-300">Anda tidak memiliki Product</p>';
            }
        ?>
        <!-- Repeat the card structure for other products -->
    </div>
</section>

<!-- Modal untuk Upload Produk -->
<div id="uploadProductModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 p-8 rounded-lg">
        <h2 class="text-2xl font-bold neon-text mb-4">Upload Produk</h2>
        <!-- Include form to upload product here -->
        <form action="../../app/proses/uploadFile.php?action=create" method="post" enctype="multipart/form-data" class="space-y-4">
            <!-- Form fields for uploading product -->
            <input type="hidden" name="seller_id" value="<?php echo $_SESSION['user_id']; ?>">
            <div>
                <label for="productName" class="block text-gray-300">Nama Produk</label>
                <input type="text" name="name" id="productName" class="w-full bg-gray-700 border border-gray-600 rounded-md p-2">
            </div>
            <div>
                <label for="productName" class="block text-gray-300">Deskripsi</label>
                <input type="text" name="description" id="productName" class="w-full bg-gray-700 border border-gray-600 rounded-md p-2">
            </div>
            <div>
                <label for="productName" class="block text-gray-300">File</label>
                <input type="file" name="file" id="productName" class="w-full bg-gray-700 border border-gray-600 rounded-md p-2">
            </div>
            <div>
                <label for="productName" class="block text-gray-300">Harga</label>
                <input type="text" name="price" id="productName" class="w-full bg-gray-700 border border-gray-600 rounded-md p-2">
            </div>
            <div>
                <label for="productName" class="block text-gray-300">Kategori</label>
                <select name="kategori_id" class="bg-gray-700 border border-gray-600 rounded-md p-2">
                    <option disabled selected>Pilih Kategori Product</option>
                    <?php
        if(!empty($kategori)){
            foreach($kategori as $x){
        ?>
        <option value="<?php echo $x['kategori_id']; ?>"><?php echo $x['nama_kategori']; ?></option>
        <?php
            }}else{
                echo '<option value="Tidak ada">Tidak ada data</option>';
            }
        ?>
                </select>
            </div>
            <div>
                <label for="productName" class="block text-gray-300">Tipe Produk</label>
                <select name="product_type" class="bg-gray-700 border border-gray-600 rounded-md p-2">
                    <option disabled selected>Pilih Tipe Product</option>
                    <option value="video">Video</option>
                    <option value="pdf">PDF</option>
                    <option value="zip">ZIP</option>
                </select>
            </div>
           
            <!-- Repeat the form fields for other product details -->
            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Upload Produk</button>
                <button type="button" onclick="closeModal()" class="text-gray-300 hover:text-gray-500">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal untuk Upload Produk -->
<div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 p-8 rounded-lg">
        <h2 class="text-2xl font-bold neon-text mb-4">Edit Profile</h2>
        <!-- Include form to upload product here -->
        <form action="../../app/proses/auth.php?action=edit" method="post" class="space-y-4">
            <!-- Form fields for uploading product -->
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <?php
            foreach($user as $eu){
            ?>
            <div>
                <label for="editProfileForm" class="block text-gray-300">Username</label>
                <input type="text" value="<?php echo $eu['username']; ?>" name="username" id="editProfileForm" class="w-full bg-gray-700 border border-gray-600 rounded-md p-2" required>
            </div>
            <div>
                <label for="editProfileForm" class="block text-gray-300">Email</label>
                <input type="email" value="<?php echo $eu['email']; ?>" name="email" id="editProfileForm" class="w-full bg-gray-700 border border-gray-600 rounded-md p-2" required>
            </div>
            <div>
                <label for="editProfileForm" class="block text-gray-300">Bio</label>
                <input type="text" value="<?php echo $eu['bio']; ?>" name="bio" id="editProfileForm" class="w-full bg-gray-700 border border-gray-600 rounded-md p-2">
            </div>
            <?php
            }
            ?>
            <!-- Repeat the form fields for other product details -->
            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Upload Produk</button>
                <button type="button" onclick="closeEditModal()" class="text-gray-300 hover:text-gray-500">Batal</button>
            </div>
        </form>
    </div>
</div>



</div>

<script>
function openModal() {
    document.getElementById('uploadProductModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('uploadProductModal').classList.add('hidden');
}
function openModalEdit() {
    document.getElementById('editProfileModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editProfileModal').classList.add('hidden');
}
</script>

<?php
include "include/footer.php";
?>