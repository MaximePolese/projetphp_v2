<?php
include_once 'services/my-functions.php';
include_once 'Catalogue.php';
include_once 'Item.php';
include_once 'database.php';


class Cart
{

    public function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function addProduct($id, $name, $quantity, $price, $discount): void
    {
        $product = array(
            'id' => $id,
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
            'discount' => $discount
        );

        $productIndex = $this->findProductInCart($id);

        if ($productIndex !== null) {
            $_SESSION['cart'][$productIndex]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][] = $product;
        }
    }

    private function findProductInCart($id): int|string|null
    {
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['id'] == $id) {
                return $key;
            }
        }
        return null;
    }

    public function removeProduct($key): void
    {
        unset($_SESSION['cart'][$key]);
    }

    public function removeAll(): void
    {
        $_SESSION['cart'] = [];
    }

    public function displayCart(): void
    {
        ?>
        <div class="border border-warning  border-3 mb-2">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Produit</th>
                    <th scope="col">Prix HT</th>
                    <th scope="col">Prix TTC</th>
                    <th scope="col">Remise</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Total TTC</th>
                    <th scope="col">Supprimer l'article</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION['cart'] as $key => $newItem) { ?>
                    <tr>
                        <td><?php echo $newItem['name']; ?></td>
                        <td><?php echo formatPrice(priceExcludingVAT($newItem['price'])); ?></td>
                        <td><?php echo formatPrice($newItem['price']); ?></td>
                        <td><?php echo $newItem['discount'] ?> %</td>
                        <td><label for="quantity"></label><input type="number" name="newQuantity" id="quantity" min="1"
                                                                 max="100"
                                                                 value="<?php echo $newItem['quantity'] ?>"></td>
                        <td><?php echo formatPrice(discountedPrice($newItem['price'] * $newItem['quantity'], $newItem['discount'])); ?></td>
                        <td>
                            <form action="panier.php" method="get">
                                <input type="hidden" name="productKey" value="<?php echo $key ?>">
                                <button name="deleteProduct" type="submit" class="btn btn-danger m-3">Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="text-end bold" colspan="5">Total HT :</td>
                    <td class="bold"><?php echo formatPrice(totalHT($_SESSION['cart'])); ?></td>
                </tr>
                <tr>
                    <td class="text-end bold" colspan="5">Total TTC :</td>
                    <td class="bold"><?php echo formatPrice(totalTTC($_SESSION['cart'])); ?></td>
                </tr>
                <?php if (count($_SESSION['cart']) > 0) { ?>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2">Choisir le transporteur</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td class="text-end" colspan="2">
                            <form action="panier.php" method="get">
                                <select name="shipment" class="form-select" aria-label="Default select example">
                                    <option
                                        <?php if (isset($_GET['shipment']) && $_GET['shipment'] == 1) echo 'selected'; ?>value="1">
                                        Colissimo
                                    </option>
                                    <option
                                        <?php if (isset($_GET['shipment']) && $_GET['shipment'] == 2) echo 'selected'; ?>value="2">
                                        Fedex
                                    </option>
                                    <option
                                        <?php if (isset($_GET['shipment']) && $_GET['shipment'] == 3) echo 'selected'; ?>value="3">
                                        UPS
                                    </option>
                                </select>
                                <input type="hidden" name="quantity" value="<?php echo $_GET['quantity'] ?>">
                                <input type="hidden" name="nameProduct" value="<?php echo $_GET['nameProduct'] ?>">
                                <button name="submit" type="submit" class="btn btn-success m-3">Valider</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end" colspan="5">Frais de livraison :</td>
                        <td><?php if (chooseShipment($_SESSION['cart']) === null) {
                                echo 'Valider le transporteur';
                            } else {
                                echo formatPrice(chooseShipment($_SESSION['cart']));
                            } ?></td>
                    </tr>
                    <tr>
                        <td class="text-end bold" colspan="5">Total TTC avec livraison :</td>
                        <td class="bold"><?php echo formatPrice(totalTTC($_SESSION['cart']) + chooseShipment($_SESSION['cart'])); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <form action="panier.php" method="get">
                    <button name="deleteAll" type="submit" class="btn btn-danger m-3">Supprimer le panier
                    </button>
                </form>
                <button type="submit" class="btn btn-success m-3"
                        <?php if (!count($_SESSION['cart']) > 0): ?>disabled <?php endif ?>>
                    COMMANDER
                </button>
            </div>
        </div>
        <?php
    }
}

?>

