<?php
session_start();
require_once('../backend/init.php');

$user = new UsersClass;
$user_found = $user->findUserById($_SESSION['id']);

$address = new Address;
$address_found = $address->selectAddress($_SESSION['id']);

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $product_found = new ProductsClass;
    $product = $product_found->findProductById($product_id);


    $user_id = $_SESSION['id'];
    $product_id = $product['product_id'];
    $product_image = $product['product_image_url'];
    $product_name = $product['product_name'];
    $product_price = $product['product_price'];

    $cart = new Cart;
    $cart->insertProductInCart($user_id, $product_id, $product_image, $product_name, $product_price);
    $cart_items = $cart->findUserCart($user_id);
    header('Location: viewCart.php');
}
$cart = new Cart;
$cart_items = $cart->findUserCart($_SESSION['id']);
if (empty($cart_items)) {
    header('Location: index.php');
}

$sum =  $cart->totalSum($_SESSION['id']);
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
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="bi bi-cart"></i> View Cart
                            </a>
                        </li>
                    <?php } else { ?>
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
    <section class="p-3 my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1>Shopping Cart</h1>
                    <hr>
                    <table class="table">
                        <tbody>
                            <?php foreach ($cart_items as $item) { ?>
                                <tr class="text-center">
                                    <td><img src="../db_img/<?php echo $item['product_image']; ?>" alt="product image" style="width: 100px;"></td>
                                    <td class="h5"><?php echo $item['product_name']; ?></td>
                                    <td class="h4 text-danger"><?php echo '$' . $item['product_price']; ?></td>
                                    <td><a href="../backend/deleteCart.php?id=<?php echo $item['cart_id']; ?>" class="btn btn-danger">X</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div>
                        <a href="../backend/deleteCart.php?cart=<?php echo $_SESSION['id']; ?>" class="mx-0 mx-sm-5 btn btn-danger d-inline">Remove all Items</a>
                        <p class="mx-0 mx-sm-5 d-inline">
                            <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Check address details
                            </a>
                        </p>
                        <div class="collapse mt-4" id="collapseExample">
                            <div class="card card-body">
                                <div class="d-block justify-content-around d-md-flex">
                                    <div>
                                        <p>First Name: <samp class="text-primary"><?php echo $user_found['user_name']; ?></samp></p>
                                        <p>Last Name: <samp class="text-primary"><?php echo $user_found['user_second_name']; ?></p>
                                        <p>Email: <samp class="text-primary"><?php echo $user_found['user_email']; ?></p>
                                    </div>
                                    <div>
                                        <p>City: <samp class="text-primary"><?php echo empty($address_found) ? 'No address given' : $address_found['address_city']; ?></samp></p>
                                        <p>Street: <samp class="text-primary"><?php echo empty($address_found) ? 'No address given' : $address_found['address_street']; ?></p>
                                        <p>Country: <samp class="text-primary"><?php echo empty($address_found) ? 'No address given' : $address_found['address_country']; ?></p>
                                    </div>
                                    <div>
                                        <h5>Total: <samp class="text-primary"><?php echo empty($sum['product_sum']) ? '$' . 0 : '$' . bcdiv($sum['product_sum'], 1, 2); ?></samp></h5>
                                        <a href="<?php echo empty($address_found) ? 'account.php' : '#'; ?>" class="btn btn-primary">Send Order</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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