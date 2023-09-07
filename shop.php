<?php
include 'services/my-functions.php';
$products = [
    "bags" => [
        "trail 30" => [
            "name" => "Deuter trail 30",
            "description" => "La surface de contact réduite et les grands canaux d’aération du système dorsal Airstripes de deuter, combinés aux bretelles et aux stabilisateurs de hanche perforés (avec poches), assurent un flux d’air maximal et une répartition uniforme du poids pour un maintien parfait et sécurisé sur tous les terrains. La construction plate du rabat offre un bon dégagement pour la tête, même avec un casque. Les boucles sur les bretelles permettent de garder les mousquetons de via ferrata à portée de main. Et grâce à une grande ouverture frontale zippée et à des poches latérales, les équipements et le matériel sont toujours faciles d’accès. ",
            "vat" => 20,
            "price" => 14500,
            "weight" => 1120,
            "discount" => 0,
            "availability" => true,
            "picture_url" => "img/3440723-3253-Trail30_wave_ivy-D-00.png"
        ],
        "FUTURA 32" => [
            "name" => "Deuter FUTURA 32",
            "description" => "Le Futura a été conçu pour les randonnées d'une journée ou de plusieurs jours, où le confort de port et la maniabilité sont primordiaux. La nouvelle maille du système dorsal Aircomfort assure une ventilation maximale. Cela signifie jusqu'à 25 % de transpiration en moins et donc une meilleure performance. Les bretelles mobiles ActiveFit et les ailerons de hanche ergonomiques (avec réglage par traction vers l'avant) assurent également un confort de port agréable. En outre, le compartiment inférieur séparé offre des possibilités d'organisation supplémentaires dans le sac à dos.",
            "vat" => 20,
            "price" => 16500,
            "weight" => 1440,
            "discount" => 20,
            "availability" => true,
            "picture_url" => "img/3400821-1358-Futura_32_reef-D-00.png"
        ],
        "AC Lite 14 SL" => [
            "name" => "Deuter AC Lite 14 SL",
            "description" => "Le nouveau AC Lite est le sac parfait pour les randonnées d’une journée. Ce sac à dos est encore plus léger que son modèle précédent et dispose d’une ventilation maximale grâce au système dorsal Aircomfort. La grande ouverture frontale à fermeture éclair offre une excellente vue d'ensemble du sac et de son contenu. Le smartphone ou les en-cas peuvent être rapidement rangés dans la poche latérale élastique aérée. Il est également possible d'accrocher un casque sur les attaches à l'extérieur du sac à dos.",
            "vat" => 20,
            "price" => 10000,
            "weight" => 860,
            "discount" => 10,
            "availability" => true,
            "picture_url" => "img/3420521-1379-ACLite14SL_lake_ink-D-00.png"
        ],
        "Futura Pro 42 EL" => [
            "name" => "Deuter Futura Pro 42 EL",
            "description" => "Le sac à dos de randonnée léger et fonctionnel Futura EL est destiné aux personnes particulièrement grandes (à partir de 185 cm) et constitue le compagnon idéal pour les randonnées sportives d'une journée : le système de dos Aircomfort est super confortable et offre une ventilation maximale au niveau du dos grâce à la nouvelle maille. Ce qui veut dire : jusqu'à 25 % de transpiration en moins et donc de meilleures performances. Si les vêtements sont humides, ils peuvent sécher rapidement dans la poche avant élastique et perméable à l'air pendant la randonnée. ",
            "vat" => 20,
            "price" => 22500,
            "weight" => 1700,
            "discount" => 25,
            "availability" => false,
            "picture_url" => "img/3401421-7403-FuturaPro42EL_black_graphite-D-00.png"
        ],
    ],
    "tents" => [],
    "mattress" => [],
    "sleeping_bags" => [],
    "sticks" => [],
];
include 'templates/header.php';
?>
    <section class="container">
        <h1 class="text-center border border-warning  border-3 py-2 mt-2">Sacs de randonnée</h1>
        <?php
        foreach ($products["bags"] as $bag) {
            include "templates/product.php";
        }
        ?>
    </section>
<?php include 'templates/footer.php'; ?>