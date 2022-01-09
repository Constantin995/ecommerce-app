<?php
require_once('../../backend/init.php');

session_start();

if (!isset($_SESSION['user_admin'])) {
    header('Location: ../index.php');
} elseif (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] != 'admin') {
    header('Location: ../index.php');
}


$products_all = new ProductsClass;
$products = $products_all->find_products();
$message = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'invalidCharacters') {
        $message = 'The name should contain only alphabetic and numeric characters';
    }
    if ($_GET['error'] == 'invalidExtension') {
        $message = 'The picture must be the type of jpg, jpeg, png or webp';
    }
    if ($_GET['error'] == 'error') {
        $message = 'There has been an error, try again later';
    }
    if ($_GET['error'] == 'notanumber') {
        $message = 'Price of the item must be a number';
    }
    if ($_GET['error'] == 'big') {
        $message = 'The picture size is too big';
    }
}
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
            <div class="col p-3">
                <div class="container py-5">
                    <h1>Products Table</h1>
                    <hr class="mb-5">
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12" id="result">
                        <div class="">
                            <div class="card-body">
                                <form action="../../backend/checkProductInsert.php" method="POST" class="mb-4" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="mb-3 text-primary">Add Product</h6>
                                        </div>
                                        <?php if (isset($_GET['error'])) { ?>
                                            <p class="timer-text bg-danger py-2 px-3 rounded text-white"><?php echo $message; ?></p>
                                        <?php } ?>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="productName">Product Name</label>
                                                <input type="text" class="form-control" id="productName" name="product_name">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="productPrice">Product Price</label>
                                                <input type="text" class="form-control" id="productPrice" name="product_price">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="productTags">Product Tags</label>
                                                <input type="text" class="form-control" id="productTags" name="product_tags">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <label for="productImage">Product Picture</label>
                                            <input class="form-control" id="productImage" type="file" name="picture">
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="productDescription">Product Description</label>
                                                <textarea class="form-control" id="productDescription" rows="5" name="product_description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="mt-3">
                                                <button type="submit" name="submit-product" class="btn btn-primary">Add Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="overlay"></div>
                    <div class="col-md-12 mt-5">
                        <h3>All products</h3>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="form-group">
                                <input type="text" id="filter" autocomplete="off" placeholder="Search product by name" class="form-control">
                            </div>
                        </div>
                        <div id="searchresult">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Image</th>
                                        <th>Product timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product) { ?>
                                        <tr>
                                            <td><?php echo $product['product_id']; ?></td>
                                            <td><?php echo $product['product_name']; ?></td>
                                            <td><?php echo '$' . $product['product_price']; ?></td>
                                            <td><img src="../../db_img/<?php echo $product['product_image_url']; ?>" alt="product image" style="width: 100px;"></td>
                                            <td><?php echo date('F j, Y', $product['product_timestamp']); ?></td>
                                            <td>
                                                <a href="editProduct.php?id=<?php echo $product['product_id'] ?>" class="edit-product btn btn-warning me-2" type="submit">Edit</a>
                                                <a href="../../backend/deleteProduct.php?id=<?php echo $product['product_id']; ?>" class="product-delete btn btn-danger" type="submit" name="submit-delete">Delete</a>
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
    </div>
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.js"></script>
    <script src="../../js/script.js"></script>
</body>

</html>