<?php

session_start();
require_once('init.php');

if (isset($_POST['submit-product'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_tags = $_POST['product_tags'];
    $product_description = $_POST['product_description'];

    $picture = $_FILES['picture'];

    $picture_name = $picture['name'];
    $picture_tmp_name = $picture['tmp_name'];
    $picture_size = $picture['size'];
    $picture_error = $picture['error'];
    $picture_type = $picture['type'];

    $picture_extension = explode(".", $picture_name);
    $picture_extension_lower = strtolower(end($picture_extension));

    $allowed = ['jpg', 'jpeg', 'png', 'pdf', 'webp'];

    if (preg_match("/^[a-zA-Z\s\d]+$/", $product_name)) {
        if (is_numeric($product_price)) {
            if (in_array($picture_extension_lower, $allowed)) {
                if ($picture_error === 0) {
                    if ($picture_size < 5000000) {

                        $picture_new_name = uniqid('', true) . '.' . $picture_extension_lower;
                        $picture_destination = '../db_img/' . $picture_new_name;
                        move_uploaded_file($picture_tmp_name, $picture_destination);

                        $new_picture = new ProductsClass;
                        $new_picture->insertProduct($product_name, $product_description, $picture_new_name, $product_price, $product_tags, time());
                        header('Location: ../frontend/admin/products.php');
                    } else {
                        header('Location: ../frontend/admin/products.php?error=big');
                        die();
                    }
                } else {
                    header('Location: ../frontend/admin/products.php?error=error');
                    die();
                }
            } else {
                header('Location: ../frontend/admin/products.php?error=invalidExtension');
                die();
            }
        } else {
            header('Location: ../frontend/admin/products.php?error=notanumber');
            die();
        }
    } else {
        header('Location: ../frontend/admin/products.php?error=invalidCharacters');
        die();
    }
}



if (isset($_POST['submit-edit-product'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_tags = $_POST['product_tags'];
    $product_description = $_POST['product_description'];

    $picture = $_FILES['picture'];

    $picture_name = $picture['name'];
    $picture_tmp_name = $picture['tmp_name'];
    $picture_size = $picture['size'];
    $picture_error = $picture['error'];
    $picture_type = $picture['type'];

    if (empty($picture_name)) {

        $edit_product = new ProductsClass;
        $edit_product->updateProduct($product_name, $product_description, $product_price, $product_tags, $product_id);
        header('Location: ../frontend/admin/products.php');
    } else {

        $picture_extension = explode(".", $picture_name);
        $picture_extension_lower = strtolower(end($picture_extension));

        $allowed = ['jpg', 'jpeg', 'png', 'pdf', 'webp'];

        if (preg_match("/^[a-zA-Z\s\d]+$/", $product_name)) {
            if (is_numeric($product_price)) {
                if (in_array($picture_extension_lower, $allowed)) {
                    if ($picture_error === 0) {
                        if ($picture_size < 5000000) {

                            $picture_new_name = uniqid('', true) . '.' . $picture_extension_lower;
                            $picture_destination = '../db_img/' . $picture_new_name;
                            move_uploaded_file($picture_tmp_name, $picture_destination);

                            $new_picture = new ProductsClass;
                            $new_picture->updateProductImageAndDetails($product_name, $product_description, $picture_new_name, $product_price, $product_tags, $product_id);
                            header('Location: ../frontend/admin/products.php');
                        } else {
                            header('Location: ../frontend/admin/products.php?error=big');
                            die();
                        }
                    } else {
                        header('Location: ../frontend/admin/products.php?error=error');
                        die();
                    }
                } else {
                    header('Location: ../frontend/admin/products.php?error=invalidExtension');
                    die();
                }
            } else {
                header('Location: ../frontend/admin/products.php?error=notanumber');
                die();
            }
        } else {
            header('Location: ../frontend/admin/products.php?error=invalidCharacters');
            die();
        }
    }
}
