-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Set 19, 2022 alle 19:42
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce-bruno`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cart_items`
--

CREATE TABLE `cart_items` (
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `file_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `category`
--

INSERT INTO `category` (`id`, `name`, `file_name`) VALUES
(1, 'Lampadine', ''),
(2, 'Lucchetti Smart', ''),
(3, 'Lampade 3D', ''),
(4, 'Giardini Smart', ''),
(5, 'Assistente I.A.', ''),
(6, 'Speaker Smart', ''),
(7, 'Benessere', ''),
(8, 'Arredamento', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `orders`
--

CREATE TABLE `orders` (
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `orders`
--

INSERT INTO `orders` (`user_id`, `product_id`, `quantity`, `order_date`) VALUES
(20, 3, 1, '1663585908'),
(20, 3, 1, '1663586192'),
(20, 5, 1, '1663586192'),
(20, 1, 1, '1663586192'),
(20, 2, 1, '1663586192'),
(20, 4, 2, '1663586192'),
(20, 6, 1, '1663586192'),
(20, 7, 1, '1663586192'),
(21, 7, 3, '1663601914'),
(21, 5, 2, '1663601914'),
(21, 2, 1, '1663601914'),
(21, 2, 1, '1663606499'),
(21, 3, 1, '1663606499'),
(21, 1, 1, '1663606499'),
(21, 4, 1, '1663606499'),
(21, 8, 1, '1663606499'),
(21, 14, 2, '1663606499'),
(21, 25, 2, '1663606499'),
(21, 7, 2, '1663606801'),
(21, 6, 3, '1663606801'),
(21, 8, 2, '1663606801'),
(21, 17, 3, '1663606801'),
(21, 12, 2, '1663606801'),
(21, 13, 1, '1663606801'),
(21, 16, 4, '1663606801'),
(21, 21, 1, '1663606801'),
(21, 14, 1, '1663606801'),
(21, 15, 1, '1663606801'),
(21, 1, 1, '1663606801'),
(21, 2, 1, '1663606801'),
(21, 3, 3, '1663606801'),
(21, 5, 1, '1663606801'),
(21, 11, 1, '1663606801');

-- --------------------------------------------------------

--
-- Struttura della tabella `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `category_id`) VALUES
(1, 'Lampada TNT', 'Lampada di minecraft, stile TNT', '29.99', 1),
(2, 'Lampada Alex', 'Lampada di minecraft, stile Alex', '29.99', 1),
(3, 'Philips HUE', 'White Lampadina LED Smart, con Bluetooth, Attacco E27, 15 W, Dimmerabile, 1600 Lumen, Luce Bianca Calda, Bianco', '19.99', 1),
(4, 'Lampadina Retrò', 'Lampada Luce Calda, Vintage, Stile Moderno', '15.99', 1),
(5, 'Triangoli LED', 'Triangoli LED, decorazione luminosa.', '49.99', 1),
(6, 'Serratura RUILON', 'Serratura Smart, Impronta digitale, sicurezza.', '159.99', 2),
(7, 'Nuki Smart Locker', 'Lucchetto Intelligente con APP.', '139.99', 2),
(8, 'Irrigazione Smart', 'Sistema di irrigazione smart, compatibile con Alexa.', '59.99', 4),
(9, 'Echo Dot', '3a Generazione, Compatibile con prodotti smart, controllo vocale.', '39.99', 5),
(10, 'Echo Show', '5a Generazione, Pannello Operatore per Alexa.', '199.99', 5),
(11, 'Alexa Echo', '4a Generazione', '29.99', 5),
(12, 'BOSE Homespeaker', 'Speaker Smart, compatibile con Alexa.', '129.99', 6),
(13, 'Echo Sub', 'Speaker Intelligente, Sotto prodotto Alexa, Amazon Speakers.', '19.98', 6),
(14, 'Soffione Doccia', 'Prodotto Premium, Esclusivo.', '199.50', 7),
(15, 'Colonna Smart', 'Colonna per doccia Smart.', '125.00', 7),
(16, 'Soffione Doccia LED', 'Soffione Doccia LED compatibile con tutti i prodotti Alexa, Rilassante, Audio Sorround 7.1.', '799.99', 7),
(17, 'Giardino Intelligente IDOO', 'Giardino Smart.', '80.00', 4),
(18, 'Night Light 3D Squalo', 'Luce Squalo rilassante.', '29.99', 3),
(19, 'Night Light 3D Farfalla', 'Luce Farfalla rilassante.', '29.99', 3),
(20, 'Night Light 3D Razzo', 'Luce Razzo rilassante.', '29.99', 3),
(21, 'Proiettore Soffitto', 'Proiettore per soffitto.', '34.85', 7),
(22, 'Piastra a Induzione 2.0', 'Piastra a Induzione di nuova generazione.', '89.99', 8),
(23, 'Piastra a Induzione', 'Piastra a induzione di vecchia generazione.', '39.99', 8),
(24, 'Pattumiera Smart', 'Pattumiera Smart, Sensori Premium, 16L', '19.99', 8),
(25, 'Composter Intelligente', 'Composter con Sensori intelligente, per Orti Smart.', '12.89', 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `user_type_id`) VALUES
(20, 'e.brizio.1729@vallauri.edu', 'eaba1bca7df38544439d482bb60ab916', 1),
(21, 'p.bruno.1280@vallauri.edu', '969044ea4df948fb0392308cfff9cdce', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Regular');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `cart_items`
--
ALTER TABLE `cart_items`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `orders`
--
ALTER TABLE `orders`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indici per le tabelle `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Limiti per la tabella `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
