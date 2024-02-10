-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 06, 2023 at 09:09 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dump`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'bags'),
(2, 'tents'),
(3, 'mattress'),
(4, 'sleeping_bags'),
(5, 'sticks');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `adress` varchar(45) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `town` varchar(45) NOT NULL,
  `phone_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `adress`, `zip_code`, `town`, `phone_number`) VALUES
(1, 'Pierre', 'Dupont', 'Avenue des Champs Elysées', 38000, 'New York City', 102030405),
(2, 'Jean', 'Dupuis', 'Avenue Charles de Gaule', 69000, 'Lyon', 102030406);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `date` date NOT NULL,
  `shipment` float DEFAULT NULL,
  `total` float NOT NULL,
  `customers_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `date`, `shipment`, `total`, `customers_id`) VALUES
(1, 1, '2023-09-18', 0, 0, 1),
(2, 2, '2023-09-18', 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `products_id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`products_id`, `orders_id`, `quantity`) VALUES
(1, 1, 2),
(2, 1, 4),
(3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `weight` int(11) NOT NULL,
  `price` float NOT NULL,
  `picture` varchar(255) NOT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `available` tinyint(4) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `weight`, `price`, `picture`, `stock_quantity`, `available`, `categories_id`, `discount`) VALUES
(1, 'Trail 30', 'La surface de contact réduite et les grands canaux d’aération du système dorsal Airstripes de deuter, combinés aux bretelles et aux stabilisateurs de hanche perforés (avec poches), assurent un flux d’air maximal et une répartition uniforme du poids pour un maintien parfait et sécurisé sur tous les terrains. La construction plate du rabat offre un bon dégagement pour la tête, même avec un casque. Les boucles sur les bretelles permettent de garder les mousquetons de via ferrata à portée de main. Et grâce à une grande ouverture frontale zippée et à des poches latérales, les équipements et le matériel sont toujours faciles d’accès.', 1120, 14500, 'https://dk0fkjygbn9vu.cloudfront.net/cache-buster-11693972413/deuter/mediaroom/product-images/backpacks/hiking-backpacks/159244/image-thumb__159244__deuter_lightbox-img/3440723-3253-Trail30_wave_ivy-D-00.png', 1645, 1, 1, 0),
(2, 'FUTURA 32', 'Le Futura a été conçu pour les randonnées d\'une journée ou de plusieurs jours, où le confort de port et la maniabilité sont primordiaux. La nouvelle maille du système dorsal Aircomfort assure une ventilation maximale. Cela signifie jusqu\'à 25 % de transpiration en moins et donc une meilleure performance. Les bretelles mobiles ActiveFit et les ailerons de hanche ergonomiques (avec réglage par traction vers l\'avant) assurent également un confort de port agréable. En outre, le compartiment inférieur séparé offre des possibilités d\'organisation supplémentaires dans le sac à dos.', 1440, 16500, 'https://dk0fkjygbn9vu.cloudfront.net/cache-buster-11693969184/deuter/mediaroom/product-images/backpacks/hiking-backpacks/145831/image-thumb__145831__deuter_lightbox-img/3400821-1358-Futura_32_reef-D-00.png', 439, 1, 1, 20),
(3, 'AC Lite 14 SL', 'Le nouveau AC Lite est le sac parfait pour les randonnées d’une journée. Ce sac à dos est encore plus léger que son modèle précédent et dispose d’une ventilation maximale grâce au système dorsal Aircomfort. La grande ouverture frontale à fermeture éclair offre une excellente vue d\'ensemble du sac et de son contenu. Le smartphone ou les en-cas peuvent être rapidement rangés dans la poche latérale élastique aérée. Il est également possible d\'accrocher un casque sur les attaches à l\'extérieur du sac à dos.', 860, 10000, 'https://dk0fkjygbn9vu.cloudfront.net/cache-buster-11693971034/deuter/mediaroom/product-images/backpacks/hiking-backpacks/159177/image-thumb__159177__deuter_lightbox-img/3420521-1379-ACLite14SL_lake_ink-D-00.png', 211, 1, 1, 10),
(4, 'Futura Pro 42 EL', 'Le sac à dos de randonnée léger et fonctionnel Futura EL est destiné aux personnes particulièrement grandes (à partir de 185 cm) et constitue le compagnon idéal pour les randonnées sportives d\'une journée : le système de dos Aircomfort est super confortable et offre une ventilation maximale au niveau du dos grâce à la nouvelle maille. Ce qui veut dire : jusqu\'à 25 % de transpiration en moins et donc de meilleures performances. Si les vêtements sont humides, ils peuvent sécher rapidement dans la poche avant élastique et perméable à l\'air pendant la randonnée.', 1700, 22500, 'https://dk0fkjygbn9vu.cloudfront.net/cache-buster-11693969537/deuter/mediaroom/product-images/backpacks/hiking-backpacks/145856/image-thumb__145856__deuter_lightbox-img/3401421-7403-FuturaPro42EL_black_graphite-D-00.png', 0, 0, 1, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`,`customers_id`),
  ADD KEY `fk_orders_customers1` (`customers_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`products_id`,`orders_id`),
  ADD KEY `fk_products_has_orders_orders1` (`orders_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`,`categories_id`),
  ADD KEY `fk_products_categories1` (`categories_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customers1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `fk_products_has_orders_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_has_orders_products` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
