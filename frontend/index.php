<?php
session_start();
require_once('../backend/init.php');

$products_all = new ProductsClass;
$products = $products_all->find_products();

$phone_products = $products_all->find4Products('phone');
$laptop_products = $products_all->find4Products('laptop');
$headphones_products = $products_all->find4Products('headphones');

if (isset($_SESSION['id'])) {
    $cart = new Cart;
    $cart_items = $cart->findUserCart($_SESSION['id']);
}

$message = '';
if (isset($_GET['cart'])) {
    if ($_GET['cart'] == 'empty') {
        $message = 'Your cart is empty, add something to vizit it';
    }
}
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
    <?php if (isset($_GET['cart'])) { ?>
        <div class="container position-absolute mt-3" style="z-index: 1; left:35%">
            <p class="cart-p timer-text bg-danger py-2 w-50 m-auto rounded text-white text-center"><?php echo $message; ?></p>
        </div>
    <?php } ?>
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


    <section class="p-3 bg-dark text-white">
        <div class="container">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md">
                                <img class="img-fluid d-none d-sm-block" src="../img/unbox.svg" alt="">
                            </div>
                            <div class="col-md p-5">
                                <p class="lead py-4">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, nulla. Eaque minima cupiditate asperiores consectetur aperiam! Deserunt assumenda numquam suscipit, non ratione qui odit illo eligendi delectus ex harum dicta odio dolor ipsum hic nesciunt laudantium! Vitae, dolores cum, soluta earum est ipsum magni deleniti et placeat temporibus optio unde!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md p-5">
                                <p class="lead py-4">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt magni optio placeat est porro nemo nostrum, nam, velit consequatur vitae voluptatibus nulla ipsa tenetur dicta distinctio explicabo molestiae ullam ipsam veritatis. Laudantium asperiores sit, ipsum quae tenetur omnis suscipit ullam! Rerum neque, cupiditate tempore consequatur at aperiam, nam, sunt harum quia velit amet quo eos ex! Odit corporis eum quod!
                                </p>
                            </div>
                            <div class="col-md">
                                <img class="img-fluid d-none d-sm-block" src="../img/undraw_noted_pc-9-f.svg" alt="" style="width: 70%;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md">
                                <img class="img-fluid d-none d-sm-block" src="../img/undraw_container_ship_ok-1-c.svg" alt="">
                            </div>
                            <div class="col-md p-5">
                                <p class="lead py-4">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate sit eos dolorem. Vitae deserunt dolore qui officia nulla quam eveniet ab. Sed perspiciatis ducimus quod nisi exercitationem explicabo. Odit corrupti quia minima reprehenderit repellat, architecto molestias sapiente aliquid qui! Facilis perspiciatis fuga quisquam dignissimos distinctio ipsam laboriosam! Id quae dolorem eligendi nisi quibusdam, in suscipit.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <section class="p-3 bg-success">
        <div class="container">
            <div class="row g-5">
                <div class="col-md">
                    <div class="card">
                        <div class="card-body text-center">
                            <img class="img-fluid h-50 image-l1" src="../img/delivery.svg" alt="">
                            <h6 class="card-title">
                                Delivery to your doorstep!
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card">
                        <div class="card-body text-center">
                            <img class="img-fluid h-50 image-l1" src="../img/return.svg" alt="">
                            <h6 class="card-title">
                                Return product in 14 days!
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card">
                        <div class="card-body text-center">
                            <img class="img-fluid h-50 image-l1" src="../img/refund.svg" alt="">
                            <h6 class="card-title">
                                Refund in less than 2 days!
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p-5 bg-light">
        <div class="container">
            <h3 class="text-black mb-3">Cell Phones</h3>
            <div class="row g-4">
                <?php foreach ($phone_products as $product) { ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <a href="viewProduct.php?product=<?php echo $product['product_name']; ?>&id=<?php echo $product['product_id']; ?>&tag=<?php echo $product['product_tags']; ?>">
                                    <img class="mb-3" src="../db_img/<?php echo $product['product_image_url']; ?>" alt="product image" style="width: 50%">
                                    <p class="card-text"><a href="viewProduct.php?product=<?php echo $product['product_name']; ?>&id=<?php echo $product['product_id']; ?>&tag=<?php echo $product['product_tags']; ?>" class="text-decoration-none text-dark"><?php echo $product['product_name'] ?></a>
                                    </p>
                                    <h4 class="card-title text-danger mb-3">
                                        <?php echo '$' . $product['product_price']; ?>
                                    </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="p-5 bg-light">
        <div class="container">
            <h3 class="text-black mb-3">Laptops / Notebooks</h3>
            <div class="row g-4">
                <?php foreach ($laptop_products as $product) { ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <a href="viewProduct.php?product=<?php echo $product['product_name']; ?>&id=<?php echo $product['product_id']; ?>&tag=<?php echo $product['product_tags']; ?>">
                                    <img class="mb-3" src="../db_img/<?php echo $product['product_image_url']; ?>" alt="product image" style="width: 50%">
                                    <p class="card-text"><a href="viewProduct.php?product=<?php echo $product['product_name']; ?>&id=<?php echo $product['product_id']; ?>&tag=<?php echo $product['product_tags']; ?>" class="text-decoration-none text-dark"><?php echo $product['product_name'] ?></a>
                                    </p>
                                    <h4 class="card-title text-danger mb-3">
                                        <?php echo '$' . $product['product_price']; ?>
                                    </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="p-5 bg-light">
        <div class="container">
            <h3 class="text-black mb-3">Headphones</h3>
            <div class="row g-4">
                <?php foreach ($headphones_products as $product) { ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <a href="viewProduct.php?product=<?php echo $product['product_name']; ?>&id=<?php echo $product['product_id']; ?>&tag=<?php echo $product['product_tags']; ?>">
                                    <img class="mb-3" src="../db_img/<?php echo $product['product_image_url']; ?>" alt="product image" style="width: 50%">
                                    <p class="card-text"><a href="viewProduct.php?product=<?php echo $product['product_name']; ?>&id=<?php echo $product['product_id']; ?>&tag=<?php echo $product['product_tags']; ?>" class="text-decoration-none text-dark"><?php echo $product['product_name'] ?></a>
                                    </p>
                                    <h4 class="card-title text-danger mb-3">
                                        <?php echo '$' . $product['product_price']; ?>
                                    </h4>
                                </a>
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
                <p class="lead">Copyright ?? 2021 Manu Constantin, this project is for my personal portofolio and I do not get any monetary value from it.</p>
            </div>
        </div>
    </footer>
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>