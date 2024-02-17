<?php
global $db;
include 'header.php';
include 'database.php';
include 'Catalogue.php';
include 'services/my-functions.php';
?>
    <section class="container">
        <h1 class="text-center border border-warning  border-3 py-2 mt-2">Sacs de randonnée</h1>
        <?php
        $products = new Catalogue($db);
        $products->displayCatalogue();
        ?>
    </section>
<?php include 'footer.php'; ?>