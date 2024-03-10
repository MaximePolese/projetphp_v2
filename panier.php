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

    if (isset($_POST['addProduct'])) {
        $itemId = $_POST['id'];
        $quantity = $_POST['quantity'];
        $item = $catalogue->getItemById($itemId);
        if ($item) {
            $panier->addProduct($item->getId(), $item->getName(), intval($quantity), $item->getPrice(), $item->getDiscount(), $item->getWeight());
        }
    }

    if (isset($_GET['deleteProduct'])) {
        $panier->removeProduct($_GET['productKey']);
    }

    if (isset($_GET['deleteAll'])) {
        $panier->removeAll();
    }

    if (isset($_POST['submit'])) {
        $_SESSION['shipment'] = intval($_POST['shipment']);
        var_dump($_SESSION['shipment']);
    }

    if (isset($_GET['order'])) {
        $panier->orderProducts();
    }

    $panier->displayCart();
    ?>
</section>
<?php include 'footer.php'; ?>


