<?php

class Cart extends Database
{

    public function insertProductInCart($user_id, $product_id, $product_image, $product_name, $product_price)
    {
        $query = $this->connect()->prepare('INSERT INTO cart(user_id, product_id, product_image, product_name, product_price) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$user_id, $product_id, $product_image, $product_name, $product_price]);
    }

    public function findUserCart($user_id)
    {
        $query = $this->connect()->prepare('SELECT * from cart WHERE user_id = ?');
        $query->bindValue(1, $user_id);
        $query->execute();
        return $query->fetchAll();
    }

    public function totalSum($user_id)
    {
        $query = $this->connect()->prepare('SELECT sum(product_price) AS product_sum FROM cart WHERE user_id = ?');
        $query->bindValue(1, $user_id);
        $query->execute();
        return $query->fetch();
    }

    public function deleteCartItems($user_id)
    {
        $query = $this->connect()->prepare('DELETE FROM cart WHERE user_id = ?');
        $query->bindValue(1, $user_id);
        $query->execute();
    }

    public function deleteOneItemFromCart($cart_id)
    {
        $query = $this->connect()->prepare('DELETE FROM cart WHERE cart_id = ?');
        $query->bindValue(1, $cart_id);
        $query->execute();
    }
}
