<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Neotokyo Marketplace</title>
</head>
<body class="bg-gray-900 text-white font-sans min-h-screen flex items-center justify-center">

<?php 
session_start();
if(isset($_SESSION["pesan"])){
    if($_SESSION["pesan"] == "password"){
        echo "<p class='text-red-500'>Pastikan password anda benar</p>";
        unset($_SESSION["pesan"]);
    }elseif($_SESSION["pesan"] == "login"){
        echo "<p class='text-green-500'>Silahkan Login</p>";
        unset($_SESSION["pesan"]);
    }
}
?>

<form action="../app/proses/auth.php?action=register" method="post" class="bg-gray-800 p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 neon-text">Create Your Neotokyo Marketplace Account</h2>
    <div class="mb-4">
        <label for="username" class="block text-gray-300">Username</label>
        <input type="text" name="username" id="username" class="w-full bg-gray-700 border border-gray-600 rounded-md p-2">
    </div>
    <div class="mb-4">
        <label for="password" class="block text-gray-300">Password</label>
        <input type="password" name="password" id="password" class="w-full bg-gray-700 border border-gray-600 rounded-md p-2">
    </div>
    <div class="mb-4">
        <label for="cPassword" class="block text-gray-300">Confirm Password</label>
        <input type="password" name="cPassword" id="cPassword" class="w-full bg-gray-700 border border-gray-600 rounded-md p-2">
    </div>
    <div class="mb-4">
        <label for="email" class="block text-gray-300">Email</label>
        <input type="email" name="email" id="email" class="w-full bg-gray-700 border border-gray-600 rounded-md p-2">
    </div>
    <input type="submit" value="Register" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300">
    <p class="mt-4 text-gray-300">Sudah punya akun? <a href="login.php" class="text-blue-500 hover:underline">Login</a></p>

</form>
<?php
include "user/include/footer.php";
?>