<?php
require_once('../../backend/init.php');

if (isset($_POST['input'])) {

    $input = $_POST['input'];

    $products = new ProductsClass;
    $products2 = $products->top_bar_search($input);
?>
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
            <?php foreach ($products2 as $product) { ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo  '$' . $product['product_price']; ?></td>
                    <td><img src="../../db_img/<?php echo $product['product_image_url']; ?>" alt="product image" style="width: 100px;"></td>
                    <td><?php echo date('F j, Y', $product['product_timestamp']); ?></td>
                    <td>
                    <td>
                        <a href="editProduct.php?id=<?php echo $product['product_id'] ?>" class="edit-product btn btn-warning me-2" type="submit">Edit</a>
                        <a href="../../backend/deleteProduct.php?id=<?php echo $product['product_id']; ?>" class="btn btn-danger" type="submit" name="submit-delete">Delete</a>
                    </td>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="../../js/script.js"></script>
<?php
}
