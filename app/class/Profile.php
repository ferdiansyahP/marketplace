<?php
class Database
{
    private $hst = "localhost",
            $usr = "root",
            $pwd = "",
            $dbe = "marketplace";
    public  $conn;

    public function __construct(){
        $this->conn = mysqli_connect($this->hst,$this->usr,$this->pwd,$this->dbe);
    }
}

class Profile extends Database
{
    public function __construct(){
        parent::__construct();
    }
    public function getUserProfile($id){
        $cari = mysqli_query($this->conn,"SELECT * FROM user WHERE user_id='$id'");
        while($row = mysqli_fetch_assoc($cari)){
            $user[] = $row;
        }return $user;
    }
    public function getUserProduct($id){
        $cariProduct = mysqli_query($this->conn,"SELECT user.user_id, product.*, kategori.* FROM user 
        INNER JOIN product ON user.user_id=product.seller_id LEFT JOIN kategori ON kategori.kategori_id=product.kategori_id 
        WHERE user_id='$id'");
        while($row = mysqli_fetch_assoc($cariProduct)){
            $product[] = $row;
        }return $product;
    }
    public function getKategori(){
        $cari = mysqli_query($this->conn,"SELECT * FROM kategori");
        while($row = mysqli_fetch_assoc($cari)){
            $kategori[] = $row;
        }return $kategori;
    }
}

?>