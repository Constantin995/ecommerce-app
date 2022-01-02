<?php

require_once('../backend/init.php');

if (isset($_GET['id'])) {

    $comment_id = $_GET['id'];
    $comment = new Comments;
    $comment->deleteComment($comment_id);

    header("Location: ../frontend/admin/comments.php?comment=deleted");
}
