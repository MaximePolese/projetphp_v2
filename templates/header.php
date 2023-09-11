<?php
//if (!isset ($_SESSION)) {
//    session_start();
//}
//if (!isset($_SESSION['cartSave'])) {
//    $_SESSION['cartSave'] = [];
//}
//?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Rando Shop</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container">
            <a class="navbar-brand" href="index.php">Rando Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Produits
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="bags.php">Sacs de randonnée</a></li>
                            <li><a class="dropdown-item" href="#">Tentes</a></li>
                            <li><a class="dropdown-item" href="#">Matelas</a></li>
                            <li><a class="dropdown-item" href="#">Sacs de couchage</a></li>
                            <li><a class="dropdown-item" href="#">Bâtons</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Mon panier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-warning" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</header>
<main>