<?php
try {
    $mysql = new PDO(
        'mysql:host=localhost;dbname=dump;charset=utf8', 'admin', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

function get_product(string $name):array{
    $sql = 'SELECT * FROM products WHERE name=:name LIMIT 1';
    $varTemp = $mysql->prepare($sql);
    $varTemp->execute([':name' => $name]);
    $product = $varTemp->fetchAll();
    return $product;
}

//
//function allOrders(): void
//{
//    $allOrders = $mysql->prepare('SELECT number, sum(price * order_product.quantity)
//FROM orders
//         LEFT JOIN order_product ON orders.id = order_product.order_id
//         LEFT JOIN products ON order_product.product_id = products.id
//GROUP BY number');
//    $allOrders->execute();
//    $orders = $allOrders->fetchAll();
//    var_dump($orders);
//}
//
//function addToCart(): void
//{
//    $addToCart = $mysql->prepare('INSERT INTO `order_product`(`products_id`, `orders_id`, `quantity`) VALUES ('','','$_GET['quantity'])
//    $addToCart->execute();
//    $cart = $addToCart->fetchAll();
//    var_dump($cart);
//}
//
//
