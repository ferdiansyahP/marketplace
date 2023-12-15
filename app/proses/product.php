<?php

include "../class/Product.php";
$product = new Product();
$act = isset($_GET['action']) ? $_GET['action'] : '';
if ($act == 'create') {
    // var_dump($_POST['seller_id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['product_type'], $_POST['kategori_id'], $_FILES['file']);
}else if($act == 'delete') {
    $product->deleteProduct($_GET['id']);
}
?>