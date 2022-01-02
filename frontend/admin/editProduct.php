<?php
require_once('../../backend/init.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $product = new ProductsClass;
    $product_found = $product->findProductById($id);
}

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

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card-body">
        <form action="../../backend/checkProductInsert.php" method="POST" class="mb-4" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-3 text-success">Edit Product <a href="products.php" class="text-primary text-decoration-none"> &larr; Add Product</a></h6>
                </div>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="timer-text bg-danger py-2 px-3 rounded text-white"><?php echo $message; ?></p>
                <?php } ?>
                <input type="hidden" class="form-control" value="<?php echo $product_found['product_id']; ?>" name="product_id">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" value="<?php echo $product_found['product_name']; ?>" name="product_name">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="productPrice">Product Price</label>
                        <input type="text" class="form-control" value="<?php echo $product_found['product_price']; ?>" name="product_price">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="productTags">Product Tags</label>
                        <input type="text" class="form-control" value="<?php echo $product_found['product_tags']; ?>" name="product_tags">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="productImage">Product Picture</label>
                    <input class="form-control" id="productImage" type="file" name="picture">
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="productDescription">Product Description</label>
                        <textarea class="form-control" rows="5" name="product_description"><?php echo $product_found['product_description']; ?></textarea>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="mt-3">
                        <button type="submit" name="submit-edit-product" class="btn btn-danger">Update product</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../../js/bootstrap.js"></script>
<script src="../../js/script.js"></script>