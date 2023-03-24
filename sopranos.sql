-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 24 mrt 2023 om 12:42
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sopranos`
--
CREATE DATABASE IF NOT EXISTS `sopranos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sopranos`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE `bestelling` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `phonenumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Veggie'),
(3, 'Vlees'),
(4, 'Vis');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230322113923', '2023-03-22 11:39:48', 68),
('DoctrineMigrations\\Version20230322115403', '2023-03-22 11:54:09', 55),
('DoctrineMigrations\\Version20230322125643', '2023-03-22 12:56:50', 70),
('DoctrineMigrations\\Version20230322130512', '2023-03-22 13:05:24', 37),
('DoctrineMigrations\\Version20230322131726', '2023-03-22 13:17:32', 81),
('DoctrineMigrations\\Version20230322131821', '2023-03-22 13:18:27', 32),
('DoctrineMigrations\\Version20230322132858', '2023-03-22 13:29:07', 31),
('DoctrineMigrations\\Version20230322171231', '2023-03-22 17:12:37', 46);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `bestelling_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `size` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `small` decimal(5,2) NOT NULL,
  `medium` decimal(5,2) NOT NULL,
  `large` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `details`, `picture`, `small`, `medium`, `large`) VALUES
(3, 3, 'BBQ Chicken', 'BBQ saus, mozzarella, rode ui, paprika, grilled chicken, mais, bbq swirl en knoflookolie op de rand.', 'vlees/bbq-chicken.png', '14.49', '16.49', '20.90'),
(4, 3, 'Downtown Döner', 'Tomatensaus, mozzarella, krokante döner (halal), ijsbergsla, knoflooksaus en knoflookolie op de rand.', 'vlees/downtown-döner.png', '14.49', '16.49', '20.90'),
(9, 3, 'East Side Shoarma', 'Tomatensaus, mozzarella, shoarma (100% kip), extra mozzarella. Met een swirl van knoflooksaus en knoflookolie op de rand.', 'vlees/east-side-shoarma.png', '13.49', '15.49', '19.99'),
(10, 3, 'Pulled Chicken', 'Tomatensaus, mozzarella, rode ui, paprika, natural chicken en knoflookolie op de rand.', 'vlees/pulled-chicken.png', '11.99', '13.99', '18.49'),
(11, 3, 'Teriyaki Chicken', 'BBQ saus, mozzarella, rode ui, broccoli, chicken, teriyaki swirl, sesamzaadjes en knoflookolie op de rand.', 'vlees/teriyaki-chicken.png', '13.49', '15.49', '19.49'),
(12, 1, 'Californian Veggie ', 'Tomatensaus, mozzarella, rode ui, paprika, champignons, olijven en extra mozzarella. Met knoflookolie op de rand.', 'veggie/californian_veggie.png', '11.99', '13.99', '18.99'),
(13, 1, '4 cheese', 'Crème fraîche, mozzarella, cheddar, Goudse kaas en gorgonzola en knoflookolie op de rand.', 'veggie/4_cheese.png', '13.49', '15.49', '19.99'),
(15, 1, 'Caprese', 'Tomatensaus, mozzarella, cherry tomaat, buffel mozzarella, swirl van pesto en knoflookolie op de rand.', 'veggie/caprese.png', '14.49', '16.00', '20.00'),
(16, 1, 'Margherita', 'Tomatensaus, mozzarella en met knoflookolie op de rand van de pizza. Tip! Ook lekker met oregano.', 'veggie/margherita.png', '9.99', '11.99', '16.49'),
(17, 1, 'Zwarte Truffel', 'Tomatensaus, mozzarella, champignons, parmezaan flakes, truffeltapenade, peterselie en knoflookolie op de rand.', 'veggie/zwarte_truffel.png', '14.99', '16.49', '20.99'),
(19, 4, 'Tuna Treat', 'Tomatensaus, mozzarella, pole & line tonijn, groene olijven, rode ui en knoflookolie op de rand', 'vis/tuna_treat.png', '13.49', '15.49', '19.49');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexen voor tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F52993984584665A` (`product_id`),
  ADD KEY `IDX_F5299398A2E63037` (`bestelling_id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F52993984584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_F5299398A2E63037` FOREIGN KEY (`bestelling_id`) REFERENCES `bestelling` (`id`);

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
