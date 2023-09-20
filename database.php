<?php
try {
    $db = new PDO(
        'mysql:host=localhost;dbname=dump;charset=utf8', 'admin', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

function get_allProduct($db): array
{
    $sql = 'SELECT * FROM products';
    $varTemp = $db->prepare($sql);
    $varTemp->execute();
    $products = $varTemp->fetchAll();
    return $products;
}

function get_product($db, string $name): array
{
    $sql = 'SELECT * FROM products WHERE name=:name LIMIT 1';
    $varTemp = $db->prepare($sql);
    $varTemp->execute([':name' => $name]);
    $product = $varTemp->fetchAll();
    return $product[0];
}
