<article class="product d-flex justify-content-around border border-warning border-3 my-2">
    <h2 class="productName p-2"><?php echo $bag["name"] ?></h2>
    <p class="productDescription p-2"><span>Description : </span><?php echo $bag["description"] ?></p>
    <img class="productPic align-self-center p-2" src="<?php echo $bag["picture_url"] ?>" alt="">
    <div class="d-flex flex-column justify-content-end">
        <p><span>Poids : </span><?php echo $bag["weight"] ?> gr</p>
        <p><span>Prix HT : </span><?php echo formatPrice(priceExcludingVAT($bag["price"], $bag["vat"])); ?></p>
        <p<?php if ($bag["discount"] != 0): ?>><span>Remise : </span><?php echo $bag["discount"] ?> %<?php endif ?></p>
        <p <?php if ($bag["discount"] > 0): ?> class="barre"<?php endif ?> >
            <span>Prix TTC : </span><?php echo formatPrice($bag["price"]); ?></p>
        <p class="discount" <?php if ($bag["discount"] != 0): ?>>
            <span>Prix remisé : </span><?php echo formatPrice(discountedPrice($bag["price"], $bag["discount"])); ?><?php endif ?>
        </p>
        <form action="cart.php" method="get">
            <label class="quantity" for="quantity">Quantité :</label><input name="quantity" type="number" id="quantity" min="1" max="100" value="1"><br>
            <button name="submit" type="submit" class="bg-info add" <?php if (!$bag['availability']): ?>disabled<?php endif; ?>>Ajouter au panier</button>
        </form>
    </div>
</article>

