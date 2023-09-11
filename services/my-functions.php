<?php

function formatPrice(float $price): string
{
    return number_format($price / 100, 2, ",", " ") . ' €';
}

function priceExcludingVAT(float $price, float $vat): float
{
    return (100 * $price) / (100 + $vat);
}

function discountedPrice(float $price, float $discount): float
{
    return $price - ($price * $discount / 100);
}

//$cart = [$_SESSION['cartSave']];
$cart = [];

function fillCart(array $product, int $nb): void
{
    global $cart;
    $product['quantity'] = $nb;
    $cart[] = $product;
//    $_SESSION['cartSave'] = $cart;
}

function totalHT(array $products): float
{
    $totalHT = 0;
    foreach ($products as $product) {
        $totalHT = $totalHT+ ((priceExcludingVAT($product['price'], $product['vat'])) * $product['quantity']);
    }
    return $totalHT;
}

function totalTTC(array $products): float
{
    $totalTTC = 0;
    foreach ($products as $product) {
        $totalTTC = $totalTTC + ($product['price'] * $product['quantity']);
    }
    return $totalTTC;
}

function totalWeight(array $products): float
{
    $totalWeight = 0;
    foreach ($products as $product) {
        $totalWeight = $totalWeight + ($product['weight'] * $product['quantity']);
    }
    return $totalWeight;
}

function calcShipment1(): float
{
    global $cart;
    if (totalWeight($cart) < 500) {
        return 500;
    } elseif (totalWeight($cart) < 2000) {
        return totalTTC($cart)* 0.1;
    } else {
        return 0;
    }
}

function calcShipment2(): float
{
    global $cart;
    if (totalWeight($cart) < 500) {
        return 1000;
    } elseif (totalWeight($cart) < 3000) {
        return totalTTC($cart)* 0.05;
    } else {
        return 0;
    }
}

function calcShipment3(): float
{
    global $cart;
    if (totalWeight($cart) < 100) {
        return 750;
    } elseif (totalWeight($cart) < 4000) {
        return totalTTC($cart)* 0.07;
    } else {
        return 0;
    }
}