-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 13 avr. 2023 à 04:53
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `groupe8hotel`
--

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `available_rooms_by_zone`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `available_rooms_by_zone` (
`h_address` varchar(50)
,`available_rooms` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `order_id` varchar(150) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `booking`
--

INSERT INTO `booking` (`booking_id`, `price`, `total_pay`, `room_id`, `user_id`, `phonenum`, `address`, `order_id`, `datentime`) VALUES
(11, 100, 1600, 62, 8, '5148914701', '106-65 Boulevard Fournier', 'ORD_8670056', '2023-04-12 22:45:01');

-- --------------------------------------------------------

--
-- Structure de la table `chains`
--

CREATE TABLE `chains` (
  `chain_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `c_address` varchar(120) NOT NULL,
  `nb_hotels` int(11) NOT NULL,
  `c_email` varchar(150) NOT NULL,
  `c_pn` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chains`
--

INSERT INTO `chains` (`chain_id`, `name`, `c_address`, `nb_hotels`, `c_email`, `c_pn`) VALUES
(1, 'CHAIN 1', 'OTTAWA', 8, 'contact@chaine1.com', '123456789'),
(2, 'CHAIN 2', 'MONTREAL', 8, 'contact@chaine2.com', '123456789'),
(3, 'CHAIN 3', 'CALGARY', 8, 'contact@chaine3.com', '123456789'),
(4, 'CHAIN 4', 'VANCOUVER', 8, 'contact@chaine4.com', '123456789'),
(5, 'CHAIN 5', 'TORONTO', 8, 'contact@chaine5.com', '123456789');

-- --------------------------------------------------------

--
-- Structure de la table `chain_images`
--

CREATE TABLE `chain_images` (
  `sr_no` int(11) NOT NULL,
  `chain_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'Downtown, Ottawa, ON', 'https://goo.gl/maps/jeS5eaXiJz83Qd3t5', 5555555, 'contact@tunbooking.ca', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.twitter.com', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d22403.56087992913!2d-75.698873!3d45.420528!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cce0453fe0927e1:0x74f95f439b0f07b8!2sDelta Hotels by Marriott Ottawa City Centre!5e0!3m2!1sfr!2sca!4v1680567292256!5m2!1sfr!2sca');

-- --------------------------------------------------------

--
-- Structure de la table `employee_cred`
--

CREATE TABLE `employee_cred` (
  `e_id` int(11) NOT NULL,
  `e_name` varchar(255) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `e_pass` varchar(255) NOT NULL,
  `e_nas` int(9) NOT NULL,
  `e_role` varchar(255) NOT NULL,
  `e_address` varchar(255) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `chain_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employee_cred`
--

INSERT INTO `employee_cred` (`e_id`, `e_name`, `picture`, `e_pass`, `e_nas`, `e_role`, `e_address`, `rental_id`, `hotel_id`, `chain_id`) VALUES
(1, 'Manager', 'manager.jpg', 'admin', 123456789, 'Manager', 'Test', 0, 0, 0),
(23, 'Sarah J.', 'IMG_51226.jpg', '', 2134569, 'Junior Receptionist', 'Test', 0, 0, 0),
(24, 'Michael D.', 'IMG_39555.jpg', '', 68468768, 'Senior Receptionist', 'Test', 0, 0, 0),
(25, 'Julia E.', 'IMG_57020.jpg', '', 4586768, 'Head Receptionist', 'Test', 0, 0, 0),
(26, 'Daniel K.', 'IMG_69420.jpg', '', 789798798, 'Front Office Manager', 'Test', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `facilities`
--

INSERT INTO `facilities` (`id`, `name`) VALUES
(2, 'Wifi'),
(3, 'AC'),
(4, 'TV');

-- --------------------------------------------------------

--
-- Structure de la table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(6, 'Sea View'),
(7, 'Mountain View'),
(8, 'Balcony');

-- --------------------------------------------------------

--
-- Structure de la table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `nb_rooms` int(11) NOT NULL,
  `h_address` varchar(50) NOT NULL,
  `h_email` varchar(100) NOT NULL,
  `h_pn` varchar(30) NOT NULL,
  `rating` int(11) NOT NULL,
  `chain_id` int(11) NOT NULL,
  `modified_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `name`, `nb_rooms`, `h_address`, `h_email`, `h_pn`, `rating`, `chain_id`, `modified_date`) VALUES
(42, 'HOTEL 1A', 57, 'TORONTO', 'hotel1a@chaine1.com', '5551234', 4, 1, '2023-04-12 22:07:08'),
(43, 'HOTEL 1B', 0, 'TORONTO', 'hotel1b@chaine1.com', '5553543', 3, 1, '2023-04-12 21:40:29'),
(44, 'HOTEL 1C', 0, 'MONTREAL', 'hotel1c@chaine1.com', '5556852', 5, 1, '2023-04-12 21:40:55'),
(45, 'HOTEL 1D', 0, 'MONTREAL', 'hotel1d@chaine1.com', '55588896', 2, 1, '2023-04-12 21:41:21'),
(46, 'HOTEL 1E', 0, 'VANCOUVER', 'hotel1e@chaine1.com', '55969618', 1, 1, '2023-04-12 21:41:46'),
(47, 'HOTEL 1F', 0, 'VANCOUVER', 'hotel1f@chaine1.com', '85555666', 1, 1, '2023-04-12 21:42:08'),
(48, 'HOTEL 1G', 0, 'QUEBEC', 'hotel1g@chaine1.com', '55566332', 5, 1, '2023-04-12 21:42:33'),
(49, 'HOTEL 1H', 0, 'QUEBEC', 'hotel1h@chaine1.com', '55523633', 1, 1, '2023-04-12 21:42:57'),
(50, 'HOTEL 2A', 0, 'OTTAWA', 'hotel2a@chaine2.com', '555888966', 3, 2, '2023-04-12 21:48:51'),
(51, 'HOTEL 2B', 0, 'OTTAWA', 'hotel2b@chaine2.com', '55669662', 1, 2, '2023-04-12 21:49:10'),
(52, 'HOTEL 2C', 0, 'MONTREAL', 'hotel2c@chaine2.com', '888955320', 1, 2, '2023-04-12 21:49:33'),
(53, 'HOTEL 2D', 0, 'MONTREAL', 'hotel2d@chaine2.com', '88899966', 1, 2, '2023-04-12 21:49:55'),
(54, 'HOTEL 2E', 0, 'VANCOUVER', 'hotel2e@chaine2.com', '88889966', 2, 2, '2023-04-12 21:50:16'),
(55, 'HOTEL 2F', 0, 'VANCOUVER', 'hotel2f@chaine2.com', '55556632', 5, 2, '2023-04-12 21:50:39'),
(56, 'HOTEL 2G', 0, 'CALGARY', 'hotel2g@chaine2.com', '55563231', 4, 2, '2023-04-12 21:51:14'),
(57, 'HOTEL 2H', 0, 'CALGARY', 'hotel2h@chaine2.com', '88899966', 1, 2, '2023-04-12 21:51:34'),
(58, 'HOTEL 3A', 0, 'MONTREAL', 'hotel3a@chaine3.com', '222333666', 5, 3, '2023-04-12 21:51:59'),
(59, 'HOTEL 3B', 0, 'MONTREAL', 'hotel3b@chaine3.com', '88855666', 4, 3, '2023-04-12 21:52:15'),
(60, 'HOTEL 3C', 0, 'TORONTO', 'hotel3c@chaine3.com', '88856244', 3, 3, '2023-04-12 21:52:34'),
(61, 'HOTEL 3D', 0, 'TORONTO', 'hotel3d@chaine3.com', '7778553', 4, 3, '2023-04-12 21:52:55'),
(62, 'HOTEL 3E', 0, 'CALGARY', 'hotel3e@chaine3.com', '7775662', 2, 3, '2023-04-12 21:53:22'),
(63, 'HOTEL 3F', 0, 'CALGARY', 'hotel3f@chaine3.com', '88825262', 1, 3, '2023-04-12 21:53:45'),
(64, 'HOTEL 3G', 0, 'OTTAWA', 'hotel3g@chaine3.com', '44445633', 2, 3, '2023-04-12 21:54:04'),
(65, 'HOTEL 3H', 0, 'OTTAWA', 'hotel3h@chaine3.com', '888991225', 1, 3, '2023-04-12 21:54:23'),
(66, 'HOTEL 4A', 0, 'VANCOUVER', 'hotel4a@chaine4.com', '555566629', 5, 4, '2023-04-12 21:54:54'),
(67, 'HOTEL 4B', 0, 'VANCOUVER', 'hotel4b@chaine4.com', '555665217', 2, 4, '2023-04-12 21:55:35'),
(68, 'HOTEL 4C', 0, 'OTTAWA', 'hotel4c@chaine4.com', '33335542', 3, 4, '2023-04-12 22:00:22'),
(69, 'HOTEL 4D', 0, 'OTTAWA', 'hotel4d@chaine4.com', '812812562', 1, 4, '2023-04-12 21:56:22'),
(70, 'HOTEL 4E', 0, 'MONTREAL', 'hotel4e@chaine4.com', '7895532', 4, 4, '2023-04-12 21:56:44'),
(71, 'HOTEL 4F', 0, 'MONTREAL', 'hotel4f@chaine4.com', '88252255', 2, 4, '2023-04-12 21:57:42'),
(72, 'HOTEL 4G', 0, 'CALGARY', 'hotel4g@chaine4.com', '55203420', 2, 4, '2023-04-12 21:58:01'),
(73, 'HOTEL 4H', 0, 'CALGARY', 'hotel4h@chaine4.com', '78787552', 1, 4, '2023-04-12 21:58:21'),
(74, 'HOTEL 5A', 0, 'MONTREAL', 'hotel5a@chaine5.com', '78945333', 5, 5, '2023-04-12 22:00:06'),
(75, 'HOTEL 5B', 0, 'MONTREAL', 'hotel5b@chaine5.com', '57811454', 4, 5, '2023-04-12 21:59:32'),
(76, 'HOTEL 5C', 0, 'OTTAWA', 'hotel5c@chaine5.com', '78422888', 3, 5, '2023-04-12 21:59:59'),
(77, 'HOTEL 5D', 0, 'OTTAWA', 'hotel5d@chaine5.com', '787545345', 2, 5, '2023-04-12 22:02:00'),
(78, 'HOTEL 5E', 0, 'CALGARY', 'hotel5e@chaine5.com', '968535682', 1, 5, '2023-04-12 22:02:20'),
(79, 'HOTEL 5F', 0, 'CALGARY', 'hotel5f@chaine5.com', '4454653553', 4, 5, '2023-04-12 22:02:46'),
(80, 'HOTEL 5G', 0, 'VANCOUVER', 'hotel5g@chaine5.com', '454632156', 5, 5, '2023-04-12 22:03:26'),
(81, 'HOTEL 5H', 0, 'VANCOUVER', 'hotel5h@chaine5.com', '68656535', 3, 5, '2023-04-12 22:03:56');

--
-- Déclencheurs `hotels`
--
DELIMITER $$
CREATE TRIGGER `update_hotel_modified_date` BEFORE UPDATE ON `hotels` FOR EACH ROW BEGIN
    SET NEW.modified_date = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `hotel_images`
--

CREATE TABLE `hotel_images` (
  `sr_no` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `hotel_room_capacity`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `hotel_room_capacity` (
`hotel_id` int(11)
,`hotel_name` varchar(150)
,`total_capacity` decimal(42,0)
);

-- --------------------------------------------------------

--
-- Structure de la table `rental`
--

CREATE TABLE `rental` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `rental_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rental`
--

INSERT INTO `rental` (`rental_id`, `user_id`, `room_id`, `booking_id`, `check_in`, `check_out`, `rental_status`) VALUES
(11, 8, 62, 11, '2023-04-12', '2023-04-28', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `n_bed` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `hotel_id` int(11) NOT NULL,
  `modified_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`room_id`, `name`, `n_bed`, `price`, `quantity`, `status`, `hotel_id`, `modified_date`) VALUES
(62, 'STANDARD', 1, 100, 10, 1, 42, '2023-04-12 21:43:55'),
(63, 'DELUXE', 2, 150, 16, 1, 42, '2023-04-12 21:44:14'),
(64, 'SUITE', 4, 250, 10, 1, 42, '2023-04-12 22:07:03'),
(65, 'PRESIDENTIAL', 3, 500, 1, 1, 42, '2023-04-12 22:06:58'),
(66, 'FAMILY', 5, 200, 20, 1, 42, '2023-04-12 22:07:08');

--
-- Déclencheurs `rooms`
--
DELIMITER $$
CREATE TRIGGER `update_room_modified_date` BEFORE UPDATE ON `rooms` FOR EACH ROW BEGIN
    SET NEW.modified_date = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(127, 62, 2),
(128, 62, 3),
(129, 63, 3),
(130, 63, 4),
(139, 65, 2),
(140, 65, 3),
(141, 65, 4),
(142, 64, 2),
(143, 64, 3),
(144, 64, 4),
(145, 66, 2),
(146, 66, 4);

-- --------------------------------------------------------

--
-- Structure de la table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(141, 62, 6),
(142, 63, 7),
(143, 63, 8),
(151, 65, 6),
(152, 65, 7),
(153, 65, 8),
(154, 64, 6),
(155, 64, 8),
(156, 66, 6),
(157, 66, 8);

-- --------------------------------------------------------

--
-- Structure de la table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`) VALUES
(1, 'TUNBOOKING', 'At TUNBOOKING, we strive to offer an outstanding hotel booking experience for travelers exploring the world. Our user-friendly platform allows you to easily discover, compare, and book a diverse range of accommodations to suit your needs.');

-- --------------------------------------------------------

--
-- Structure de la table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `sin` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `sin`, `dob`, `profile`, `password`, `datentime`, `status`) VALUES
(8, 'Mohamed Mehdi Boukattaya', 'boukattayamehdi99@gmail.com', '106-65 Boulevard Fournier', '5148914701', 123123123, '2001-07-01', 'IMG_86294.jpeg', '$2y$10$9mmjHrmcxSlKcSgdcbYe..kE83w2XrX9utuxyv5HS/vdlrn1KZDPq', '2023-04-12 19:19:08', 1),
(9, 'Mohamed Mehdi Boukattaya', 'mehh@mehdi.com', '106-65 Boulevard Fournier', '5148914000', 88888, '2001-07-04', 'IMG_44686.jpeg', '$2y$10$YUo4kasCMJeFYTy34llmoOjfsozOiN5d8y/iVb2G.nfBFilWzWrka', '2023-04-12 19:19:41', 1);

-- --------------------------------------------------------

--
-- Structure de la vue `available_rooms_by_zone`
--
DROP TABLE IF EXISTS `available_rooms_by_zone`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `available_rooms_by_zone`  AS SELECT `h`.`h_address` AS `h_address`, sum(`h`.`nb_rooms`) AS `available_rooms` FROM (`rooms` `r` join `hotels` `h` on(`r`.`hotel_id` = `h`.`hotel_id`)) WHERE `r`.`status` = 1 GROUP BY `h`.`h_address``h_address`  ;

-- --------------------------------------------------------

--
-- Structure de la vue `hotel_room_capacity`
--
DROP TABLE IF EXISTS `hotel_room_capacity`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hotel_room_capacity`  AS SELECT `h`.`hotel_id` AS `hotel_id`, `h`.`name` AS `hotel_name`, sum(`r`.`n_bed` * `r`.`quantity`) AS `total_capacity` FROM (`rooms` `r` join `hotels` `h` on(`r`.`hotel_id` = `h`.`hotel_id`)) GROUP BY `h`.`hotel_id`, `h`.`name``name`  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `rmfk` (`room_id`),
  ADD KEY `uidfk` (`user_id`);

--
-- Index pour la table `chains`
--
ALTER TABLE `chains`
  ADD PRIMARY KEY (`chain_id`);

--
-- Index pour la table `chain_images`
--
ALTER TABLE `chain_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `chain_images_ibfk_1` (`chain_id`);

--
-- Index pour la table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Index pour la table `employee_cred`
--
ALTER TABLE `employee_cred`
  ADD PRIMARY KEY (`e_id`);

--
-- Index pour la table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`),
  ADD KEY `fk_hotel_chain` (`chain_id`),
  ADD KEY `address_idx` (`h_address`);

--
-- Index pour la table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `hotel id` (`hotel_id`);

--
-- Index pour la table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `ussid` (`user_id`),
  ADD KEY `rmmmid` (`room_id`),
  ADD KEY `check_in_idx` (`check_in`),
  ADD KEY `check_out_idx` (`check_out`);

--
-- Index pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `price_idx` (`price`);

--
-- Index pour la table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Index pour la table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Index pour la table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `roomm id` (`room_id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Index pour la table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `chains`
--
ALTER TABLE `chains`
  MODIFY `chain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `chain_images`
--
ALTER TABLE `chain_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `employee_cred`
--
ALTER TABLE `employee_cred`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT pour la table `hotel_images`
--
ALTER TABLE `hotel_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `rental`
--
ALTER TABLE `rental`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT pour la table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT pour la table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `rmfk` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `uidfk` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Contraintes pour la table `chain_images`
--
ALTER TABLE `chain_images`
  ADD CONSTRAINT `chain_images_ibfk_1` FOREIGN KEY (`chain_id`) REFERENCES `chains` (`chain_id`);

--
-- Contraintes pour la table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `fk_hotel_chain` FOREIGN KEY (`chain_id`) REFERENCES `chains` (`chain_id`);

--
-- Contraintes pour la table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD CONSTRAINT `hotel id` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`) ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `booking_id` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`),
  ADD CONSTRAINT `rmmmid` FOREIGN KEY (`room_id`) REFERENCES `booking` (`room_id`),
  ADD CONSTRAINT `ussid` FOREIGN KEY (`user_id`) REFERENCES `booking` (`user_id`);

--
-- Contraintes pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`);

--
-- Contraintes pour la table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON UPDATE NO ACTION;

--
-- Contraintes pour la table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `roomm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
