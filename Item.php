<?php

class Item
{
    public int $id;
    public string $name;
    public string $description;
    public int $weight;
    public int $price;
    public string $pictureUrl;
    public int $stock;
    public int $available;
    public int $discount;

    public function __construct($db, string $name)
    {
        $item = get_product($db, $name);
        $this->id = $item['id'];
        $this->name = $name;
        $this->description = $item['description'];
        $this->weight = $item['weight'];
        $this->price = $item['price'];
        $this->pictureUrl = $item['picture'];
        $this->stock = $item['stock_quantity'];
        $this->available = $item['available'];
        $this->discount = $item['discount'];
    }

    public function displayItem()
    {
        ?>
        <article class="product d-flex justify-content-around border border-warning border-3 my-2">
            <h2 class="productName p-2"><?php echo $this->name ?></h2>
            <p class="productDescription p-2"><span>Description : </span><?php echo $this->description ?></p>
            <img class="productPic align-self-center p-2" src="<?php echo $this->pictureUrl ?>" alt="">
            <div class="d-flex flex-column justify-content-end">
                <p><span>Poids : </span><?php echo $this->weight ?> gr</p>
                <p><span>Prix HT : </span><?php echo formatPrice(priceExcludingVAT($this->price)); ?></p>
                <p<?php if ($this->discount != 0): ?>><span>Remise : </span><?php echo $this->discount ?>
                    %<?php endif ?></p>
                <p <?php if ($this->discount > 0): ?> class="barre"<?php endif ?> >
                    <span>Prix TTC : </span><?php echo formatPrice($this->price); ?></p>
                <p id="discountPrice" class="discount" <?php if ($this->discount != 0): ?>>
                    <span>Prix remisé : </span><?php echo formatPrice(discountedPrice($this->price, $this->discount)); ?><?php endif ?>
                </p>
                <form action="cart.php" method="get">
                    <label class="quantity" for="quantity">Quantité :</label><input name="quantity" type="number"
                                                                                    id="quantity" min="1" max="100"
                                                                                    value="1"><br>
                    <input type="hidden" name="nameProduct" value="<?php echo $key ?>">
                    <button name="submit" type="submit" class="bg-info add"
                            <?php if (!$this->available): ?>disabled <?php endif; ?> >Ajouter au panier
                    </button>
                </form>
            </div>
        </article>
        <?php
    }
}