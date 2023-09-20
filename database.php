<?php

try {
    $db = new PDO(
        'mysql:host=localhost;dbname=dump;charset=utf8', 'admin', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

function get_allProduct($db): array
{
    $sql = 'SELECT * FROM products';
    $varTemp = $db->prepare($sql);
    $varTemp->execute();
    return $varTemp->fetchAll();
}

function displayItem(Item $item)
{
    ?>
    <article class="product d-flex justify-content-around border border-warning border-3 my-2">
        <h2 class="productName p-2"><?php echo $item->getName() ?></h2>
        <p class="productDescription p-2"><span>Description : </span><?php echo $item->getDescription() ?></p>
        <img class="productPic align-self-center p-2" src="<?php echo $item->getPicture() ?>" alt="">
        <div class="d-flex flex-column justify-content-end">
            <p><span>Poids : </span><?php echo $item->getWeight() ?> gr</p>
            <p><span>Prix HT : </span><?php echo formatPrice(priceExcludingVAT($item->getPrice())); ?></p>
            <p<?php if ($item->getDiscount() != 0): ?>><span>Remise : </span><?php echo $item->getDiscount() ?>
                %<?php endif ?></p>
            <p <?php if ($item->getDiscount() > 0): ?> class="barre"<?php endif ?> >
                <span>Prix TTC : </span><?php echo formatPrice($item->getPrice()); ?></p>
            <p id="discountPrice" class="discount" <?php if ($item->getDiscount() != 0): ?>>
                <span>Prix remisé : </span><?php echo formatPrice(discountedPrice($item->getPrice(), $item->getDiscount())); ?><?php endif ?>
            </p>
            <form action="cart.php" method="get">
                <label class="quantity" for="quantity">Quantité :</label><input name="quantity" type="number" id="quantity" min="1" max="100" value="1"><br>
                <input type="hidden" name="nameProduct" value="<?php echo $item->getName() ?>">
                <button name="submit" type="submit" class="bg-info add"
                        <?php if (!$item->getAvailable()): ?>disabled <?php endif; ?> >Ajouter au panier
                </button>
            </form>
        </div>
    </article>
    <?php
}

function displayCatalogue(Catalogue $products)
{
    foreach ($products->getProducts() as $item) {
        displayItem($item);
    }
}