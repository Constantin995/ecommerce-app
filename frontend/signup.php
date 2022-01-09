<?php
$message = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'empty') {
        $message = 'All field are mandatory';
    }
    if ($_GET['error'] == 'unavailableName') {
        $message = 'Your name must contain only letters';
    }
    if ($_GET['error'] == 'unavailableEmail') {
        $message = 'Your Email address is unavailable';
    }
    if ($_GET['error'] == 'shortPassword') {
        $message = 'Password should contain at least 5 characters';
    }
    if ($_GET['error'] == 'passwordsNotMatch') {
        $message = 'Passwords do not match';
    }
    if ($_GET['error'] == 'emailUsed') {
        $message = 'Email address already in use';
    }
}

$message2 = '';
if (isset($_GET['error2'])) {
    if ($_GET['error2'] == 'empty') {
        $message2 = 'All field are mandatory';
    }
    if ($_GET['error2'] == 'nouserorpasswordfound') {
        $message2 = 'The username or password is incorrect';
    }
}

$message3 = '';
if (isset($_GET['message'])) {
    if ($_GET['message'] == 'accountneeded') {
        $message3 = 'You need an account in order to buy something';
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
                    <?php if (isset($_SESSION['username'])) {
                    ?>
                        <?php if (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 'admin') { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin/products.php"><i class="bi bi-clipboard-data"></i>
                                    Admin Area
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item px-md-5">
                            <a class="nav-link" href="">
                                <i class="bi bi-person-circle"></i> Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="bi bi-cart"></i> View Cart
                            </a>
                        </li>
                    <?php } else {
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
                        <button class="btn btn-outline-success bg-warning" type="submit" name="submiti"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="p-4 my-3">
        <div class="container">
            <?php if (isset($_GET['message'])) { ?>
                <div class="container text-center">
                    <p class="timer-text bg-danger py-2 px-3 rounded text-white"><?php echo $message3; ?></p>
                </div>
            <?php } ?>
            <div class="row align-item-center justify-content-between g-5">
                <div class="col-md-6 p-3">
                    <h3 class="pb-3">New Account</h3>
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="timer-text bg-danger py-2 px-3 rounded text-white"><?php echo $message; ?></p>
                    <?php } ?>
                    <form action="../backend/checkSignUpAndLogin.php" method="POST">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" name="user_name">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" name="user_second_name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="user_email">
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="user_admin" value="admin">
                            <label class="form-check-label" for="admin">
                                Admin
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="user_admin" value="customer" checked>
                            <label class="form-check-label" for="customer">
                                Customer
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="user_password">
                        </div>
                        <div class="form-group">
                            <label for="repPassword">Repete Password</label>
                            <input type="password" class="form-control" name="user_rep_password">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit-signup" class="btn btn-primary btn-lg btn-block mt-3">
                                Sign up
                            </button>
                        </div>
                    </form>
                </div>
                <?php

                ?>
                <div class="col-md-6 p-3">
                    <h3 class="pb-3">Log into your account</h3>
                    <?php if (isset($_GET['error2'])) { ?>
                        <p class="timer-text bg-danger py-2 px-3 rounded text-white"><?php echo $message2; ?></p>
                    <?php } ?>
                    <form action="../backend/checkSignUpAndLogin.php" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="user_email_login">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="user_password_login">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3" name="submit-login">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="p-3 bg-warning">
        <div class="container">
            <div class="row">
                <div class="col-md p-3">
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
                <div class="col-md">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.js"></script>
</body>

</html>