<?php
session_start();
class Database
{
    private $hst = "localhost",
            $usr = "root",
            $pwd = "",
            $dbe = "marketplace";
    public  $conn;
    private $productName;
    private $productPrice;
    private $productImage;
    private $productFile;
    

    public function __construct(){
        $this->conn = mysqli_connect($this->hst,$this->usr,$this->pwd,$this->dbe);
    }
}
class Product extends Database
{
    private $path_type;
    public function __construct(){
        parent::__construct();
    }

    public function getAllProducts(){
        $query = mysqli_query($this->conn,"SELECT product.*,kategori.* FROM product 
        INNER JOIN kategori ON kategori.kategori_id=product.kategori_id");
        while($row = mysqli_fetch_array($query)){
            $x[] = $row;
        }return $x;
    }

    public function getAllCategory(){
        $query = mysqli_query($this->conn,"SELECT * FROM kategori");
        while($row = mysqli_fetch_array($query)){
            $x[] = $row;
        }return $x;
    }


    public function cekUserForBuy($user_id, $product_id) {
        $query = mysqli_query($this->conn, "SELECT * FROM transaction 
        WHERE buyer_id='$user_id' AND product_id='$product_id'");
        $punya = mysqli_query($this->conn, "SELECT * FROM product WHERE seller_id='$user_id' AND product_id='$product_id'");
        $hitung = mysqli_num_rows($query);
        $hitungUser = mysqli_num_rows($punya);
        if ($hitung > 0) {
            return true;
        }else if($hitungUser > 0){
            return true;
        } else {
            return false;
        }
    }

    public function deleteProduct($product_id) {
        mysqli_query( $this->conn,"DELETE FROM product WHERE product_id='$product_id'");
        header("location: ../../views/user/user_profile.php");
    }
    public function getSingleProduct($user_id, $product_id) {
        $cek = $this->cekUserForBuy($user_id, $product_id);
        if ($cek) {
            $data = mysqli_query($this->conn, "SELECT product.*, kategori.nama_kategori, user.user_id, user.username FROM product 
            INNER JOIN kategori ON product.kategori_id = kategori.kategori_id 
            INNER JOIN user ON product.seller_id = user.user_id 
            WHERE product.product_id='$product_id'");
            
            $result = [];
            
            while ($row = mysqli_fetch_assoc($data)) {
                $result[] = $row;
            }

            return $result;
        } else {
            return false;
        }
    }

    public function getProductById($id){
        $query = mysqli_query($this->conn,"SELECT product.*,user.* FROM product 
        INNER JOIN user ON user.user_id=product.seller_id WHERE product.product_id='$id'");
        while( $row = mysqli_fetch_assoc($query) ) {
            $result[] = $row;
        }return $result;
    }

    public function createProduct($sellerId, $name, $description, $price, $productType, $kategoriId, $file)
{
    $uploadedFile = $this->uploadFile($file, $productType, $name);
    
    if ($uploadedFile) {
        // Sesuaikan query INSERT INTO dengan struktur tabel Anda
        $insertQuery = "INSERT INTO product (seller_id, name, description, price, file, path, product_type, kategori_id) 
                        VALUES ('$sellerId', '$name', '$description', '$price', '$file', '$uploadedFile', '$productType', '$kategoriId')";
        
        $insert = mysqli_query($this->conn, $insertQuery);

        if ($insert) {
            echo "Product information saved to database.";
        } else {
            echo "Error saving product information to database: " . mysqli_error($this->conn);
        }
    }else{
        echo "baka";
    }
}

public function uploadFile($file, $productType, $name)
{
    echo "udh disini<br>";
    switch ($productType) {
        case "zip":
            $targetDirectory = "zip/";
            break;
        case "video":
            $targetDirectory = "video/";
            break;
        case "pdf":
            $targetDirectory = "pdf/";
            break;
        default:
            $targetDirectory = "";
    }
    echo "Target Directory: " . $targetDirectory . "<br>";

    $fileName = md5(pathinfo($file["name"], PATHINFO_FILENAME)); // Gunakan nama file tanpa ekstensi
    echo "Hashed File Name: " . $fileName . "<br>";
    $targetFile = "../../files/" . $targetDirectory . $fileName; // Perbaiki bagian ini
    echo "Target File: " . $targetFile . "<br>";
    $uploadOk = move_uploaded_file($file["tmp_name"], $targetFile);

    if ($uploadOk) {
        echo "The file " . htmlspecialchars(basename($file["name"])) . " has been uploaded.<br>";
        return $targetFile;
    } else {
        echo "Sorry, there was an error uploading your file.<br>";
        return false;
    }
}

public function ProductDibeli($user_id){
    $sql = "SELECT transaction.*, product.* 
            FROM product 
            INNER JOIN transaction ON transaction.product_id = product.product_id 
            WHERE transaction.buyer_id = '$user_id'";
    
    $query = mysqli_query($this->conn, $sql);

    $products = array();

    while ($row = mysqli_fetch_assoc($query)) {
        $products[] = $row;
    }

    return $products;
}
public function getLatestProducts($limit) {
    $sql = "SELECT * FROM product ORDER BY created_at DESC LIMIT $limit";
    $query = mysqli_query($this->conn, $sql);

    $latestProducts = array();

    while ($row = mysqli_fetch_assoc($query)) {
        $latestProducts[] = $row;
    }

    return $latestProducts;
}


}

    
    
?>