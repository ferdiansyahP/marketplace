<?php

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "marketplace");

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses form pengunggahan produk
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] == 'create') {
    $sellerId = $_POST['seller_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $kategoriId = $_POST['kategori_id'];
    $productType = $_POST['product_type'];

    // Memeriksa apakah file telah diunggah
    if (!empty($_FILES['file']['name'])) {
        switch ($productType) {
            case "zip":
                $type = "zip/";
                break;
            case "video":
                $type = "video/";
                break;
            case "pdf":
                $type = "pdf/";
                break;
            default:
                $type = "";
                break;
        }
        
        echo $type;
        // Mengunggah file
        $targetDir = "../../files/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $type . $fileName;

        // Memeriksa apakah file adalah file gambar
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Menyimpan data produk ke database
            $sql = "INSERT INTO product (seller_id, name, description, price, created_at, file, path, product_type, kategori_id)
                    VALUES ('$sellerId', '$name', '$description', '$price', CURRENT_TIMESTAMP, '$fileName', '$targetFilePath', '$productType', '$kategoriId')";

            if ($conn->query($sql) === TRUE) {
                echo "Produk berhasil diunggah!";
            } else {
                echo "Terjadi kesalahan saat menambahkan produk ke database: " . $conn->error;
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Harap pilih file untuk diunggah.";
    }
}

// Menutup koneksi
$conn->close();

?>
