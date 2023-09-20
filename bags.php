<?php
include 'templates/header.php';
include 'services/my-functions.php';
include 'Item.php';
include 'database.php';
?>
    <section class="container">
        <h1 class="text-center border border-warning  border-3 py-2 mt-2">Sacs de randonnée</h1>
        <?php
        foreach (get_allProduct($db) as $key => $product) {
            $item = new Item($db, $product['name']);
            $item->displayItem();
        }
        ?>
    </section>
<?php include 'templates/footer.php'; ?>