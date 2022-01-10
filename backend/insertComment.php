<?php
session_start();
require_once('init.php');

if (isset($_POST['submit-comment'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_tags = $_POST['product_tags'];
    $comment_author = $_SESSION['user_name'] . ' ' . $_SESSION['user_second_name'];
    $comment_text = $_POST['comment_text'];

    $comment = new Comments;
    $comment->insertComment($product_id, $comment_author, $comment_text, time());

    header("Location: ../frontend/viewProduct.php?product=$product_name&id=$product_id&tag=$product_tags");
}
