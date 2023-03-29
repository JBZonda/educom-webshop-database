-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2023 at 04:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jeroens_webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `time`) VALUES
(5, 2, '2023-03-02'),
(6, 2, '2023-03-08'),
(10, 2, '2023-03-28'),
(11, 2, '2023-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`id`, `product_id`, `order_id`, `amount`) VALUES
(4, 1, 5, 1),
(5, 4, 5, 1),
(6, 5, 5, 1),
(7, 4, 6, 1),
(8, 5, 6, 1),
(13, 1, 10, 1),
(14, 5, 10, 2),
(15, 2, 10, 1),
(16, 1, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `discription` mediumtext NOT NULL,
  `price` int(11) NOT NULL,
  `image_location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `discription`, `price`, `image_location`) VALUES
(1, 'Leren fauteuil Joy', 'Leren fauteuil Joy is één van onze hardlopers. Deze stijlvolle fauteuil heeft een strak, doch warm ontwerp en is leverbaar met houten stoelpoten. De houten stoelpoten zijn leverbaar in veel verschillende kleuren. Het zitkussen zit los waardoor u de stoel makkelijk kunt schoon te maken. Het kussen zit er strak in waardoor deze niet kan verschuiven. Om het af te maken kunt u er ook een bijpassende hocker bij nemen. De hocker kan ook dienen als bijzettafel wanneer u er een dienblad of een glasplaat op legt. ', 590, 'leren-fauteuil-joy.webp'),
(2, 'Dyyk fauteuil Specter', 'Dyyk fauteuil Specter\r\n\r\nFauteuil Specter van Dyyk is een heerlijke comfortabele stoel waar je heerlijk ontspannen in kunt zitten. Deze fauteuil kan worden geleverd in zowel stof als leder. Hier is deze getoond in een stoffen uitvoering. De voet is leverbaar in een 5-teens draaivoet, in zwart,wit of rvs (rvs tegen meerprijs).\r\n\r\nIn onze woonwinkel hebben we de Specter fauteuil staan en u bent welkom hier te komen zitten onder het genot van een kopje koffie. Ook hebben we hier alle stalen liggen van de stoffen- en de leren collectie. Wilt u deze stoel op proef ontvangen? Dan kunt u dit via het proefzit-formulier of de e-mail aanvragen. Wij zetten deze stoel dan vrijblijvend bij u thuis neer en nemen alle stalen mee.', 445, 'specter-prado-mustard-06-dyyk-1-scaled.jpg'),
(3, 'Benson Stoel Grijs/Blauw', 'Kijk toch naar die kleine, bolle stoelschoentjes! Hoeveel stoelen kunnen zeggen dat ze schoenen hebben? Stoel Benson kan dat! Nadat we die voetjes hadden bedacht, was de rest van het ontwerpproces eenvoudig. Wat vaak gebeurt met een goed ontwerp. De ene Benson na de andere vloog van de tekentafel. We konden het bijna niet bijhouden.', 249, '1100391_0_1000x1000_50m.webp'),
(4, 'Bank Niek', 'Een bank waar je nooit op uitgekeken raakt: Bank Niek is een blijvertje! Zijn tijdloze design en moderne uitstraling vormen de perfecte basis. De brede armleuningen en losse rugkussens zorgen voor het spreekwoordelijke steuntje in de rug. Zijn vulling van koudschuim draagt hier comfortabel aan bij. De perfecte keuze voor liefhebbers van een comfortabele zit dus! Ben je op zoek naar het ideale gezelschap voor een avondje relaxen? Kies dan voor bank Niek met longchair of ottomane. Met Niek weet je dus zeker dat je goed zit!', 1525, 'Niek-hoek-links-980x656.jpg'),
(5, 'Bank Silver', 'Bank Silver laat zich kenmerken door het simplistische en moderne uiterlijk, waarbij aandacht is besteed aan ieder klein detail. Kijk bijvoorbeeld naar de strakke stiksels en de luchtige pootjes, waardoor het lijkt alsof de bank haast lijkt te zweven. Silver beschikt over dikke, comfortabele kussens waar je zowel actief als relaxed op kunt zitten. Zo biedt de bank ultiem zitcomfort voor iedereen in huis. ', 1499, 'so-true-by-troubadour-bank-silver.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES
(1, 'coach@man-kind.nl', 'Geert Weggemans', 'halt!'),
(2, 'aaa@a.com', 'awsd', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
