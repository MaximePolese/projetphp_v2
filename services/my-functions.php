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
