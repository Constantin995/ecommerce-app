<?php

require_once('../backend/init.php');

if (isset($_GET['id'])) {

    $cart_id = $_GET['id'];
    $cart = new Cart;
    $cart->deleteOneItemFromCart($cart_id);

    header("Location: ../frontend/viewCart.php");
}

if (isset($_GET['cart'])) {

    $user_id = $_GET['cart'];
    $cart = new Cart;
    $cart->deleteCartItems($user_id);

    header("Location: ../frontend/viewCart.php");
}
