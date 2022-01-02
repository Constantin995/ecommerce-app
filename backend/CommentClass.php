<?php

class Comments extends Database
{

    public function insertComment($product_id, $comment_author, $comment_body, $comment_timestamp)
    {

        $query = $this->connect()->prepare('INSERT INTO comments(product_id, comment_author, comment_body, comment_timestamp) VALUES(?, ?, ?, ?)');
        $query->execute([$product_id, $comment_author, $comment_body, $comment_timestamp]);
    }

    public function selectComment($product_id)
    {
        $query = $this->connect()->prepare('SELECT * FROM comments where product_id = ?');
        $query->bindValue(1, $product_id);
        $query->execute();
        return $query->fetchAll();
    }

    public function selectAllComments()
    {

        $query = $this->connect()->prepare('SELECT * FROM comments INNER JOIN products ON comments.product_id = products.product_id');
        $query->execute();
        return $query->fetchAll();
    }

    public function deleteComment($comment_id)
    {
        $query = $this->connect()->prepare('DELETE FROM comments WHERE comment_id = ?');
        $query->bindValue(1, $comment_id);
        $query->execute();
    }
}
