<?php

class Item
{
    private string $name;
    private string $description;
    private int $weight;
    private int $price;
    private string $picture;
    private int $stock_quantity;
    private int $available;
    private int $discount;

    public function __construct(private int $id, string $name, string $description, int $weight, int $price, string $picture, int $stock_quantity, int $available, int $discount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->weight = $weight;
        $this->price = $price;
        $this->picture = $picture;
        $this->stock_quantity = $stock_quantity;
        $this->available = $available;
        $this->discount = $discount;
    }

    function displayItem(): void
    {
        ?>
        <article class="product d-flex justify-content-around border border-warning border-3 my-2">
            <h2 class="productName p-2"><?php echo $this->getName() ?></h2>
            <p class="productDescription p-2"><span>Description : </span><?php echo $this->getDescription() ?></p>
            <img class="productPic align-self-center p-2" src="<?php echo $this->getPicture() ?>" alt="">
            <div class="d-flex flex-column justify-content-end">
                <p><span>Poids : </span><?php echo $this->getWeight() ?> gr</p>
                <p><span>Prix HT : </span><?php echo formatPrice(priceExcludingVAT($this->getPrice())); ?></p>
                <p<?php if ($this->getDiscount() != 0): ?>><span>Remise : </span><?php echo $this->getDiscount() ?>
                    %<?php endif ?></p>
                <p <?php if ($this->getDiscount() > 0): ?> class="barre"<?php endif ?> >
                    <span>Prix TTC : </span><?php echo formatPrice($this->getPrice()); ?></p>
                <p id="discountPrice" class="discount" <?php if ($this->getDiscount() != 0): ?>>
                    <span>Prix remisé : </span><?php echo formatPrice(discountedPrice($this->getPrice(), $this->getDiscount())); ?><?php endif ?>
                </p>
                <form action="panier.php" method="post">
                    <label class="quantity" for="quantity">Quantité :</label>
                    <input name="quantity" type="number" id="quantity" min="1" max="100" value="1"><br>
                    <input type="hidden" name="id" value="<?php echo $this->getId(); ?>">
                    <button name="addProduct" type="submit" class="bg-info add"
                            <?php if (!$this->getAvailable()): ?>disabled <?php endif; ?> >Ajouter au panier
                    </button>
                </form>
            </div>
        </article>
        <?php
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function getStock_quantity(): int
    {
        return $this->stock_quantity;
    }

    public function getAvailable(): int
    {
        return $this->available;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }
}

