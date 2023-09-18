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

$cart = $_SESSION['cartSave'];

function fillCart(array $product, int $nb): void
{
    global $cart;
    $product['quantity'] = $nb;
    $cart[$product['name']] = $product;
    $_SESSION['cartSave'] = $cart;
}

function totalHT(array $productsPriceHT): float
{
    $totalHT = 0;
    foreach ($productsPriceHT as $productPriceHT) {
        $totalHT = $totalHT + discountedPrice((priceExcludingVAT($productPriceHT['price'], $productPriceHT['vat'])) * $productPriceHT['quantity'], $productPriceHT['discount']);
    }
    return $totalHT;
}

function totalTTC(array $productsPriceTTC): float
{
    $totalTTC = 0;
    foreach ($productsPriceTTC as $productPriceTTC) {
        $totalTTC = $totalTTC + discountedPrice($productPriceTTC['price'] * $productPriceTTC['quantity'], $productPriceTTC['discount']);
    }
    return $totalTTC;
}

function totalWeight(array $productsWeight): float
{
    $totalWeight = 0;
    foreach ($productsWeight as $productWeight) {
        $totalWeight = $totalWeight + ($productWeight['weight'] * $productWeight['quantity']);
    }
    return $totalWeight;
}

function calcShipment1(): float
{
    global $cart;
    if (totalWeight($cart) < 500) {
        return 500;
    } elseif (totalWeight($cart) < 2000) {
        return totalTTC($cart) * 0.1;
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
        return totalTTC($cart) * 0.05;
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
        return totalTTC($cart) * 0.07;
    } else {
        return 0;
    }
}

function chooseShipment(): float|null
{
    if (isset($_GET['shipment'])) {
        if ($_GET['shipment'] == 1) {
            return calcShipment1();
        }
        if ($_GET['shipment'] == 2) {
            return calcShipment2();
        }
        if ($_GET['shipment'] == 3) {
            return calcShipment3();
        }

    }
    return null;
}
