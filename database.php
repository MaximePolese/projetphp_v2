<?php
try {
    $mysql = new PDO(
        'mysql:host=localhost;dbname=rando_shop;charset=utf8', 'admin', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

function allOrders (): void{
$allOrders = $mysql->prepare('SELECT number, sum(price * order_product.quantity)
FROM orders
         LEFT JOIN order_product ON orders.id = order_product.order_id
         LEFT JOIN products ON order_product.product_id = products.id
GROUP BY number');
$allOrders->execute();
$orders = $allOrders->fetchAll();
var_dump($orders);
}

function addToCart(): void {
    $addToCart= 'INSERT INTO `order_product`(`products_id`, `orders_id`, `quantity`) VALUES ('','','')
}
        
        function new_customer(string $name, int $phone, int $zip, string $address, string $city, string $mail): void
{
    $sql = 'INSERT INTO customers (customer_id, full_name, phone_number, zip_code, address, city, mail) VALUES (NULL, ?, ?, ?, ?, ?, ?)';
    $db = include 'db_mysql.php';
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute(array($name, $phone, $zip, $address, $city, $mail));
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $sql = 'SELECT customer_id FROM customers WHERE full_name = :name';
    $stmt = $db->prepare($sql);
    $stmt->execute([':name' => $_GET["nom_prenom"]]);
    $temp = $stmt->fetchAll();
    $_SESSION['customer_id'] = $temp[0][0];
    unset($db);
}
