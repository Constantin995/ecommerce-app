<?php

use function PHPSTORM_META\type;

session_start();
require_once('../backend/init.php');

if (isset($_SESSION['id'])) {
    $cart = new Cart;
    $cart_items = $cart->findUserCart($_SESSION['id']);
}

$date = date('F j, Y');
$newdate = date("Y-m-d", strtotime('+2 month', strtotime($date)));

$query = @unserialize(file_get_contents('http://ip-api.com/php/'));

if (isset($_GET['product']) && isset($_GET['id']) && isset($_GET['tag'])) {

    $product_id = $_GET['id'];
    $product_name = $_GET['product'];
    $product_tags = $_GET['tag'];

    $foundProduct = new ProductsClass;
    $product = $foundProduct->findProduct($_GET['id'], $_GET['product']);

    $products_found = $foundProduct->findProductsWithLimit(strtok($product_tags, ','));
}

$comments = new Comments;
$found_comments = $comments->selectComment($product['product_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-sm bg-dark py-3 fixed-top">
        <div class="container">
            <a class="navbar-brand text-white" href="index.php"><i class="bi bi-book-half text-white"></i> Home Project</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_email'])) {
                    ?>
                        <?php if (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 'admin') { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin/products.php"><i class="bi bi-clipboard-data"></i>
                                    Admin Area
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item px-md-5">
                            <a class="nav-link" href="account.php">
                                <i class="bi bi-person-circle"></i> Account
                            </a>
                        </li>
                        <?php if (!empty($cart_items)) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="viewCart.php">
                                    <i class="bi bi-cart"></i> View Cart
                                </a>
                            </li>
                        <?php }
                    } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Sing in <i class="bi bi-three-dots-vertical"></i> Login</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <section class="py-3 bg-primary">
        <div class="container">
            <form action="view_products.php" class="form-group" method="POST">
                <div class="input-group input-small">
                    <input type="text" class="form-control" placeholder="Search for anything" name="searchBar">
                    <select name="select">
                        <option value="none">No filter</option>
                        <option value="lowest">From Lowest Price</option>
                        <option value="highest">From Higher Price</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-success bg-warning" type="submit" name="submit"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="py-5 px-3">
        <div class="container">
            <div class="row">
                <h3><?php echo $product['product_name']; ?></h3>
                <hr>
                <div class="col-md">
                    <img src="../db_img/<?php echo $product['product_image_url']; ?>" alt="product image" style="width: 80%;">
                </div>
                <div class="col-md py-4">
                    <h4 class="lead"><?php echo $product['product_description']; ?></h4>
                    <p class="mt-5"><i class="bi bi-arrow-clockwise"></i> Return policy: Returnable until <span class="text-success"><?php echo $newdate; ?></span></p>
                    <p><i class="bi bi-geo-alt"></i> Delivery to <span class="text-primary"><?php echo $query['city'], ', ', $query['country']; ?></span></p>
                    <h2 class="text-danger mt-5"><?php echo '$' . $product['product_price']; ?></h2>
                    <a class="btn btn-danger btn-lg" href="<?php echo isset($_SESSION['id']) ? 'viewCart.php?id=' . $product['product_id'] : 'signup.php?message=accountneeded'; ?>">Add to Cart</a>
                </div>
            </div>
            <?php if (isset($_SESSION['user_name'])) { ?>
                <div class="row mt-5">
                    <div class="col-md-8">
                        <div class="card p-4" style="background-color: #F0F0F0">
                            <h3>Leave a comment: </h3>
                            <form action="../backend/insertComment.php" method="POST">
                                <div class="form-group">
                                    <textarea class="form-control" name="comment_text" rows="5"></textarea>
                                    <input type="hidden" value="<?php echo $product['product_id']; ?>" name="product_id">
                                    <input type="hidden" value="<?php echo $product['product_name']; ?>" name="product_name">
                                    <button class="btn btn-primary mt-2" type="submit" name="submit-comment">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <hr class="mt-5">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="mb-5">Comments section: </h3>
                </div>
            </div>
            <div class="row">
                <?php if (empty($found_comments)) { ?>
                    <div class="text-danger my-2">
                        <h5>No comments on this product yet</h5>
                    </div>
                <?php } else { ?>
                    <?php foreach ($found_comments as $comment) { ?>
                        <div class="col-md-8 mb-5">
                            <div class="d-flex">
                                <img class="mr-3 me-3 rounded" src="http://placehold.it/64x64" alt="Generic placeholder image" style="height: 80px;">
                                <div class="media-body">
                                    <h4 class="mt-0"><?php echo $comment['comment_author'] ?> <small class="text-muted h6"> <?php echo date("Y-m-d H:i:s", $comment['comment_timestamp']); ?></small></h4>
                                    <p><?php echo $comment['comment_body']; ?></p>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
            <hr>
        </div>
    </section>
    <section class="p-3">
        <div class="container">
            <h3 class="mb-4">Similar products</h3>
            <div class="row g-3">
                <?php foreach ($products_found as $product) { ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <img class="mb-3" src="../db_img/<?php echo $product['product_image_url']; ?>" alt="product image" style="width: 50%">
                                <p class="card-text h6"><a href="viewProduct.php?product=<?php echo $product['product_name']; ?>&id=<?php echo $product['product_id']; ?>&tag=<?php echo $product['product_tags']; ?>" class="text-decoration-none text-dark"><?php echo $product['product_name'] ?></a>
                                </p>
                                <div class="card-title text-danger">
                                    <h5>
                                        <?php echo '$' . $product['product_price']; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="p-3 bg-warning">
        <div class="container">
            <div class="row">
                <div class="col-sm p-3">
                    <h1 class="lead">Sign up to receiv email update on new product announcements, special promotions, sales and more</h1>
                    <ul>
                        <li>Receive offers at the lowest price</li>
                        <li>Be among the first to find when new products are launched</li>
                        <li>Special offers dedicated to out subscribers</li>
                    </ul>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email address">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="button">Send</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <img class="image-email img-fluid w-50 d-none d-sm-block" src="../img/mail.svg" alt="">
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-5 pb-2 bg-black">
        <div class="container">
            <div class="row text-center text-white g-5">
                <div class="col-md-6">
                    <p class="lead">
                        About me
                    </p>
                    <p class="">
                        <a href="../../Whether/index.php">Weather app</a>
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="lead">
                        Contact
                    </p>
                    <p class="">
                        Phone: +40754 912 102
                    <p class="">
                        Email:
                        manu.constantin95@yahoo.com |
                        manuctin95@gmail.com
                    </p>
                </div>
            </div>
            <div class="col-md text-white text-center mt-5">
                <p class="lead">Copyright © 2021 Manu Constantin, this project is for my personal portofolio and I do not get any monetary value from it.</p>
            </div>
        </div>
    </footer>

    <script src="../js/bootstrap.js"></script>
</body>

</html>