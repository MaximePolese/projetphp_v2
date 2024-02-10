<?php

try {
    $db = new PDO(
        'mysql:host=localhost;dbname=dump;charset=utf8', 'admin', 'admin', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

function get_allProduct($db): array
{
    $sql = 'SELECT * FROM products';
    $varTemp = $db->prepare($sql);
    $varTemp->execute();
    return $varTemp->fetchAll();
}