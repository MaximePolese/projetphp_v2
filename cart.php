<?php
include 'services/my-functions.php';
include 'catalog.php';
include 'templates/header.php';
?>
<section class="container">
    <h1 class="text-center border border-warning  border-3 py-2 mt-2">Mon panier</h1>
    <div class="border border-warning  border-3 mb-2">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Produit</th>
                <th scope="col">Prix HT</th>
                <th scope="col">Prix TTC</th>
                <th scope="col">Remise</th>
                <th scope="col">Quantité</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Deuter trail 30</td>
                <td>120,83 €</td>
                <td>145 €</td>
                <td>0%</td>
                <td><input type="number" id="quantity" min="0" max="100" value="1"></td>
                <td>145 €</td>
            </tr>
            <tr>
                <td class="text-end" colspan="5">Total</td>
                <td>145€</td>
            </tr>
            <tr>
                <th class="text-end" colspan="4">Choisir le transporteur</th>
                <th colspan="2"></th>
            </tr>
            <tr>
                <th colspan="2"></th>
                <th class="text-end" colspan="3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Colissimo</option>
                        <option value="1">Fedex</option>
                        <option value="2">UPS</option>
                    </select>
                </th>
                <th colspan="1"></th>
            </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success m-3">COMMANDER</button>
        </div>
    </div>
</section>
<?php include 'templates/footer.php'; ?>

