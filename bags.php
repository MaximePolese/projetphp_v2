<?php
include 'services/my-functions.php';
include 'catalog.php';
include 'templates/header.php';
?>
    <section class="container">
        <h1 class="text-center border border-warning  border-3 py-2 mt-2">Sacs de randonnée</h1>
        <?php
        foreach ($products["bags"] as $product) {
            include "templates/product.php";
//            $_GET['quantity'] = 0;
        }
        ?>
    </section>
<?php var_dump ($cart) ?>
<?php include 'templates/footer.php'; ?>