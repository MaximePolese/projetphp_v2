<?php

class Item
{
    private int $id;
    private string $name;
    private string $description;
    private int $weight;
    private int $price;
    private string $picture;
    private int $stock_quantity;
    private int $available;
    private int $discount;

    public function __construct(int $id, string $name, string $description, int $weight, int $price, string $picture, int $stock_quantity, int $available, int $discount)
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

