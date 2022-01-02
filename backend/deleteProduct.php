<?php

require_once('../backend/init.php');

if (isset($_GET['id'])) {

    $product_id = $_GET['id'];
    $product = new ProductsClass;
    $product->deleteProduct($product_id);

    header("Location: ../frontend/admin/products.php?product=deleted");
}
