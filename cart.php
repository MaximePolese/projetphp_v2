<?php
include 'services/my-functions.php';
include 'templates/header.php';
?>
    <section class="container">
        <h1 class="text-center border border-warning  border-3 py-2 mt-2">Mon panier</h1>
        <div class="d-flex flex-column justify-content-end">
            <p><span>Prix HT : </span><?php ?></p>
            <p><span>Prix TTC : </span><?php ?></p>
            <p class="discount"><span>Remise : </span><?php ?> %</p>
            <p><span>Prix remisé : </span><?php ?></p>
        </div>
        <?php ?>
    </section>

<?php include 'templates/footer.php'; ?>