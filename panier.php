<?php
global $db;
include 'header.php';
include 'services/my-functions.php';
include 'Catalogue.php';
include 'Cart.php';

$catalogue = new Catalogue($db);

if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['id']) && isset($_GET['quantity'])) {
    $itemId = $_GET['id'];
    $quantity = $_GET['quantity'];
    echo $itemId;
    echo $quantity;
    var_dump($_GET['id']);
    var_dump($_GET['quantity']);
    $item = $catalogue->getItemById($itemId);
    $panier = new Cart();
    if ($item) {
        $panier->fillCart($item->getName(), $quantity, $item->getPrice(), $item->getDiscount());
    }
}
?>
    <section class="container">
        <h1 class="text-center border border-warning  border-3 py-2 mt-2">Mon panier</h1>
        <?php
            $panier->displayCart();
        ?>
    </section>
<?php include 'footer.php'; ?>


//    if (isset($_GET['submitprod'])) {
//        if (!isset($_SESSION['cartSave'][$_GET['nameProduct']]) || $_GET['quantity'] != $_SESSION['cartSave'][$_GET['nameProduct']]['quantity']) {
//            $this->fillCart($_SESSION['cartSave'][$_GET['nameProduct']], $_GET['quantity']);
//        }
//    }
//
//    if (isset($_GET['submitprod'])) {
//        $this->fillCart($_GET['nameProduct'], $_GET['quantity']);
//    }
