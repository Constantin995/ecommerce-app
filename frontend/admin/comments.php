<?php
session_start();
require_once('../../backend/init.php');

if (!isset($_SESSION['user_admin'])) {
    header('Location: ../index.php');
} elseif (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] != 'admin') {
    header('Location: ../index.php');
}

$all_comments = new Comments;
$comments = $all_comments->selectAllComments();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Document</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Admin Area</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link align-middle px-0 text-white">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="dashboard.php" class="nav-link px-0 align-middle text-white">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                        </li>
                        <li>
                            <a href="products.php" class="nav-link px-0 align-middle text-white">
                                <i class="fs-4 bi-basket"></i> <span class="ms-1 d-none d-sm-inline">Products</span></a>
                        </li>
                        <li>
                            <a href="customers.php" class="nav-link px-0 align-middle text-white ">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span></a>
                        </li>
                        <li>
                            <a href="comments.php" class="nav-link px-0 align-middle text-white">
                                <i class="fs-4 bi-chat-left-text"></i> <span class="ms-1 d-none d-sm-inline">Comments</span> </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 p-3">
                <div class="container py-5">
                    <h1>Comments Table</h1>
                    <hr class="mb-5">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Picture</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($comments as $comment) { ?>
                                <tr>
                                    <td><?php echo $comment['product_name'] ?></td>
                                    <td><img src="../../db_img/<?php echo $comment['product_image_url']; ?>" alt="product image" style="width: 100px;"></td>
                                    <td><?php echo $comment['comment_author']; ?></td>
                                    <td><?php echo $comment['comment_body']; ?></td>
                                    <td><?php echo date('Y-m-d', $comment['comment_timestamp']); ?></td>
                                    <td>
                                        <a href="../../backend/deleteComment.php?id=<?php echo $comment['comment_id']; ?>" class="comment-delete btn btn-danger" \>Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.js"></script>
    <script src="../../js/script.js"></script>
</body>

</html>