<?php
include 'services/my-functions.php';
include 'products.php';
include 'templates/header.php';
?>
<section class="container">
    <h1 class="text-center border border-warning  border-3 py-2 mt-2">Mon panier</h1>
    <div>
        <table>
            <thead>
            <tr>
                <th>Produit</th>
                <th>Prix HT</th>
                <th>Prix TTC</th>
                <th>Remise</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td><?php echo $bag["name"] ?></td>
                <td><?php echo formatPrice(priceExcludingVAT($bag["price"], $bag["vat"])); ?></td>
                <td><?php echo formatPrice($bag["price"]); ?></td>
                <td><?php echo $bag["discount"] ?></td>
                <td><?php if (isset($_GET['submit'])) {
                        echo $_GET['quantity'];
                    } ?></td>
                <td><?php echo formatPrice(discountedPrice($bag["price"], $bag["discount"])); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</section>

<?php include 'templates/footer.php'; ?>


<p><span>Prix HT : </span>
    <?php echo formatPrice(priceExcludingVAT($bag["price"], $bag["vat"])); ?></p>
<p<?php if ($bag["discount"] != 0): ?>><span>Remise : </span>
    <?php echo $bag["discount"] ?> %<?php endif ?>
</p>
<p <?php if ($bag["discount"] > 0): ?> class="barre"<?php endif ?> >
    <span>Prix TTC : </span><?php echo formatPrice($bag["price"]); ?></p>
<p class="discount" <?php if ($bag["discount"] != 0): ?>>
    <span>Prix remisé : </span>
    <?php echo formatPrice(discountedPrice($bag["price"], $bag["discount"])); ?><?php endif ?>
</p>