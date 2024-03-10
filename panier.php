<?php
global $db;
include_once 'header.php';
include_once 'services/my-functions.php';
include_once 'Catalogue.php';
include_once 'Cart.php';
?>
<section class="container">
    <h1 class="text-center border border-warning  border-3 py-2 mt-2">Mon panier</h1>
    <?php
    $catalogue = new Catalogue($db);
    $panier = new Cart();
    if (isset($_GET['addProduct'])) {
        $itemId = $_GET['id'];
        $quantity = $_GET['quantity'];
        $item = $catalogue->getItemById($itemId);
        if ($item) {
            $panier->addProduct($itemId, $item->getName(), $quantity, $item->getPrice(), $item->getDiscount());
        }
    }
    if (isset($_GET['deleteProduct'])) {
        $panier->removeProduct($_GET['productKey']);
    }
    if (isset($_GET['deleteAll'])) {
        $panier->removeAll();
    }
    $panier->displayCart();
    ?>
</section>
<?php include 'footer.php'; ?>


