<?php
include_once 'Item.php';

class Catalogue
{
    private array $products = [];

    public function __construct($db)
    {
        $catalogue = get_allProduct($db);
        foreach ($catalogue as $item) {
            $item = new Item($item['id'], $item['name'], $item['description'], $item['weight'], $item['price'], $item['picture'], $item['stock_quantity'], $item['available'], $item['discount']);
            $this->products[] = $item;
        }


        echo '<pre>';
        var_dump($this->products);
        echo '</pre>';

    }

    public function getProducts(): array
    {
        return $this->products;
    }
}




