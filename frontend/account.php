<?php
session_start();
require_once('../backend/init.php');

if (!isset($_SESSION['user_name'])) {
    header('Location: index.php');
}
$cart = new Cart;
$cart_items = $cart->findUserCart($_SESSION['id']);

$user = new UsersClass;
$user_found = $user->findUserById($_SESSION['id']);

$address = new Address;
$user_address = $address->selectAddress($_SESSION['id']);

$message = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'invalidExtension') {
        $message = 'The picture must be the type of jpg, jpeg, png or webp';
    }
    if ($_GET['error'] == 'error') {
        $message = 'There has been an error, try again later';
    }
    if ($_GET['error'] == 'big') {
        $message = 'The picture size is too big';
    }
    if ($_GET['error'] == 'wrongname') {
        $message = 'Name should contain only alphabetic characters';
    }
    if ($_GET['error'] == 'emptyfields') {
        $message = 'All field are mandatory';
    }
}

$message2 = '';
if (isset($_GET['success'])) {
    if ($_GET['success'] == 'picturechanged') {
        $message2 = 'Picture has been changed. To see the new picture you have to log out and log in again';
    }
    if ($_GET['success'] == 'detailschanged') {
        $message2 = 'Account details has been changed. To see the updated details you have to log out and log in again';
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
                                <a class="nav-link" href="admin/dashboard.php"><i class="bi bi-clipboard-data"></i>
                                    Admin Area
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item px-md-5">
                            <a class="nav-link" href="">
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
    <?php if (isset($_GET['error'])) { ?>
        <div class="container mt-5">
            <p class="timer-text bg-danger py-2 px-3 rounded text-white"><?php echo $message; ?></p>
        </div>
    <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
        <div class="container mt-5">
            <p class="timer-text bg-success py-2 px-3 rounded text-white"><?php echo $message2; ?></p>
        </div>
    <?php } ?>
    <section class="p-5 my-2">
        <div class="container">
            <div class="row gutters">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="account-settings">
                                <div class="user-profile">
                                    <div class="user-avatar">
                                        <img src="../db_img/<?php echo empty($user_found['user_image']) ? "avatar.svg" : $user_found['user_image']; ?>" alt="customer image">
                                    </div>
                                    <h6 class="user-name">First Name: <span class="text-primary"><?php echo $_SESSION['user_name']; ?></span></h6>
                                    <h6 class="user-name">Second Name: <span class="text-primary"><?php echo $_SESSION['user_second_name']; ?></span></h6>
                                    <h6 class="user-name">Email: <span class="text-primary"><?php echo $_SESSION['user_email']; ?></span></h6>
                                    <h6 class="user-name">Status: <span class="text-primary"><?php echo ucfirst($_SESSION['user_admin']); ?></span></h6>
                                    <form action="../backend/updateUserAccount.php" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <input class="form-control form-control-sm" type="file" name="picture">
                                            <button class="mt-3 btn btn-sm btn-success" type="submit" name="submit-profile">Set Picture</button>
                                        </div>
                                    </form>
                                    <h5>Address: <?php echo empty($user_address) ? "<span class='text-danger'>No address set</span> <i class='bi bi-bookmark-x'></i>" : "<span class='text-success'>Address set</span> <i class='bi bi-bookmark-check'></i>"; ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <form action="../backend/updateUserAccount.php" method="POST" class="mb-4">
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mb-3 text-primary">Personal Details</h6>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="firstName">First Name</label>
                                            <input type="text" class="form-control" id="firstName" name="user_name" value="<?php echo $user_found['user_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" name="user_second_name" value="<?php echo $user_found['user_second_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="user_email" value="<?php echo $user_found['user_email']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="mt-3">
                                            <button type="submit" name="submit-personal" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="../backend/updateUserAccount.php" method="POST">
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mb-3 text-primary">Address</h6>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="street">City</label>
                                            <input type="text" name="city" value="<?php echo empty($user_address) ? '' : $user_address['address_city']; ?>" class="form-control" id="street" placeholder="Enter Street">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="city">Street</label>
                                            <input type="text" name="street" value="<?php echo empty($user_address) ? '' : $user_address['address_street']; ?>" class="form-control" id="city" placeholder="Enter City">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" name="country" value="<?php echo empty($user_address) ? '' : $user_address['address_country']; ?>" class="form-control" id="country" placeholder="Enter State">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="mt-3">
                                        <button type="submit" name="submit-address" class="btn btn-success">Update</button>
                                        <a href="../backend/logout.php" class="btn btn-danger">Logout</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.js"></script>
</body>

</html>