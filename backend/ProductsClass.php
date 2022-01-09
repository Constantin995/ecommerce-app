<?php
include_once('init.php');

class ProductsClass extends Database
{

    public function find_products()
    {

        $querry = $this->connect()->prepare('SELECT * FROM products');
        $querry->execute();
        return $querry->fetchAll();
    }

    public function top_bar_search($item_name)
    {
        $querry = $this->connect()->prepare('SELECT * FROM products WHERE product_tags LIKE ?');
        $querry->bindValue(1, $item_name . '%');
        $querry->execute();
        return $querry->fetchAll();
    }

    public function topBarSearchLowerPrice($item_name)
    {
        $querry = $this->connect()->prepare('SELECT * FROM products WHERE product_tags LIKE ? ORDER BY product_price ASC');
        $querry->bindValue(1, $item_name . '%');
        $querry->execute();
        return $querry->fetchAll();
    }

    public function topBarSearchHigherPrice($item_name)
    {
        $querry = $this->connect()->prepare('SELECT * FROM products WHERE product_tags LIKE ? ORDER BY product_price DESC');
        $querry->bindValue(1, $item_name . '%');
        $querry->execute();
        return $querry->fetchAll();
    }

    public function insertProduct($product_name, $product_description, $product_image_url, $product_price, $product_tags, $product_timestamp)
    {
        $querry = $this->connect()->prepare('INSERT INTO products(product_name, product_description, product_image_url, product_price, product_tags, product_timestamp) VALUES (?,?,?,?,?,?)');
        $querry->execute([$product_name, $product_description, $product_image_url, $product_price, $product_tags, $product_timestamp]);
    }

    public function findProduct($product_id, $product_name)
    {
        $querry = $this->connect()->prepare('SELECT * FROM products WHERE product_id = ? AND product_name = ?');
        $querry->execute([$product_id, $product_name]);
        return $querry->fetch();
    }

    public function find4Products($product_tags)
    {
        $querry = $this->connect()->prepare('SELECT * FROM products WHERE product_tags LIKE ? ORDER BY RAND() LIMIT 4');
        $querry->bindValue(1, $product_tags . '%');
        $querry->execute();
        return $querry->fetchAll();
    }

    public function findProductById($product_id)
    {
        $querry = $this->connect()->prepare('SELECT * FROM products WHERE product_id = ?');
        $querry->bindValue(1, $product_id);
        $querry->execute();
        return $querry->fetch();
    }

    public function updateProduct($product_name, $product_description, $product_price, $product_tags, $product_id)
    {
        $querry = $this->connect()->prepare('UPDATE products SET product_name = ?, product_description = ?, product_price = ?, product_tags = ? WHERE product_id = ?');
        $querry->execute([$product_name, $product_description, $product_price, $product_tags, $product_id]);
    }

    public function updateProductImageAndDetails($product_name, $product_description, $product_image_url, $product_price, $product_tags, $product_id)
    {
        $querry = $this->connect()->prepare('UPDATE products SET product_name = ?, product_description = ?, product_image_url = ?, product_price = ?, product_tags = ? WHERE product_id = ?');
        $querry->execute([$product_name, $product_description, $product_image_url, $product_price, $product_tags, $product_id]);
    }

    public function deleteProduct($product_id)
    {
        $query = $this->connect()->prepare('DELETE FROM products WHERE product_id = ?');
        $query->bindValue(1, $product_id);
        $query->execute();
    }

    public function findProductsWithLimit($product_tag)
    {
        $querry = $this->connect()->prepare('SELECT * FROM products WHERE product_tags LIKE ? ORDER BY RAND() LIMIT 4');
        $querry->execute([$product_tag . '%']);
        return $querry->fetchAll();
    }
}
