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
            $data = mysqli_query($this->conn, "SELECT product.*, product_file.*, kategori.nama_kategori, user.user_id, user.username FROM product 
            INNER JOIN kategori ON product.kategori_id = kategori.kategori_id 
            INNER JOIN user ON product.seller_id = user.user_id 
            RIGHT JOIN product_file ON product.seller_id=product_file.seller_id 
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