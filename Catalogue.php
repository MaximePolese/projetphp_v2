<?php
include_once 'Item.php';

class Catalogue
{
    private array $products = [];

    public function __construct($db)
    {
        $database = get_allProduct($db);
        foreach ($database as $item) {
            $item = new Item($item['id'], $item['name'], $item['description'], $item['weight'], $item['price'], $item['picture'], $item['stock_quantity'], $item['available'], $item['discount']);
            $this->products[] = $item;
        }
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    function displayCatalogue(): void
    {
        foreach ($this->getProducts() as $item) {
            $item->displayItem();
        }
    }
}




