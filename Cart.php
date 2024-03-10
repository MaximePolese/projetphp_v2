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
        if (!isset($_SESSION['shipment'])) {
            $_SESSION['shipment'] = 1;
        }
    }

    public function addProduct($id, $name, $quantity, $price, $discount, $weight): void
    {
        $product = array(
            'id' => $id,
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
            'discount' => $discount,
            'weight' => $weight
        );

        $productIndex = $this->findProductInCart($id);

        if ($productIndex !== null) {
            $_SESSION['cart'][$productIndex]['quantity'] += $quantity;
            $this->updateProductInDb($id, $_SESSION['cart'][$productIndex]['quantity']);
        } else {
            $_SESSION['cart'][] = $product;
            $this->addProductToDb($id, 1, $quantity);
        }

        header("Location: panier.php");
        exit;
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
        $this->removeProductFromDb($_SESSION['cart'][$key]['id']);
        unset($_SESSION['cart'][$key]);
        if (count($_SESSION['cart']) === 0) {
            $_SESSION['shipment'] = 1;
        }
    }

    public function removeAll(): void
    {
        $_SESSION['cart'] = [];
        $_SESSION['shipment'] = 1;
        $this->removeAllFromDb();
    }

    public function addProductToDb($id, $order_id, $quantity): void
    {
        global $db;
        $stmt = $db->prepare('INSERT INTO order_product (products_id, orders_id, quantity) VALUES (?,?, ?)');
        $stmt->execute([$id, $order_id, $quantity]);
    }

    public function removeProductFromDb($id): void
    {
        global $db;
        $stmt = $db->prepare('DELETE FROM order_product WHERE products_id = ?');
        $stmt->execute([$id]);
    }

    public function updateProductInDb($id, $quantity): void
    {
        global $db;
        $stmt = $db->prepare('UPDATE order_product SET quantity = ? WHERE products_id = ?');
        $stmt->execute([$quantity, $id]);
    }

    public function removeAllFromDb(): void
    {
        global $db;
        $stmt = $db->prepare('DELETE FROM order_product');
        $stmt->execute();
    }

    public function orderProducts(): void
    {
        $this->removeAll();
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
                            <form action="panier.php" method="post">
                                <select name="shipment" class="form-select" aria-label="Default select example">
                                    <option
                                        <?php if ($_SESSION['shipment'] == 1) echo 'selected'; ?> value="1">
                                        Colissimo
                                    </option>
                                    <option
                                        <?php if ($_SESSION['shipment'] == 2) echo 'selected'; ?> value="2">
                                        Fedex
                                    </option>
                                    <option
                                        <?php if ($_SESSION['shipment'] == 3) echo 'selected' ?> value="3">
                                        UPS
                                    </option>
                                </select>
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
                    <button name="order" type="submit" class="btn btn-success m-3"
                        <?php if (!count($_SESSION['cart']) > 0): ?> disabled <?php endif ?>>
                        COMMANDER
                    </button>
                </form>
            </div>
        </div>
        <?php
    }
}

?>


