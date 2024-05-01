-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 30 avr. 2024 à 08:05
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reactphp`
--

-- --------------------------------------------------------

--
-- Structure de la table `data_table`
--

CREATE TABLE `data_table` (
  `id` int(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `value` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `data_table`
--

INSERT INTO `data_table` (`id`, `label`, `value`) VALUES
(1, 'Label 1', 10),
(2, 'Label 2', 20),
(3, 'Label 3', 30);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`) VALUES
(2052, 'reunion', '2030-01-30 15:32:00', '2030-01-31 15:32:00'),
(2054, 'Aniversaire', '2024-04-30 17:28:00', '2024-05-01 17:28:00');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(25) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_stats`
--

CREATE TABLE `product_stats` (
  `id` int(6) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `sales` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `refclient` varchar(100) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `purchases`
--

INSERT INTO `purchases` (`id`, `product_id`, `quantity`, `buyer_name`, `refclient`, `purchase_date`) VALUES
(0, 37, 3, 'vola1234', 'client_662743d681b8d3.92114588', '2024-04-23 05:15:02'),
(0, 38, 4, 'vola1234', 'client_662743d681b8d3.92114588', '2024-04-23 05:15:02'),
(0, 38, 2, 'tina lhlhfld', 'client_662743e6dd0445.81356134', '2024-04-23 05:15:18'),
(0, 39, 3, 'tina lhlhfld', 'client_662743e6dd0445.81356134', '2024-04-23 05:15:19'),
(0, 38, 4, 'CHER NJARA DG', 'client_662743f6421ee4.34419464', '2024-04-23 05:15:34'),
(0, 39, 3, 'CHER NJARA DG', 'client_662743f6421ee4.34419464', '2024-04-23 05:15:34'),
(0, 41, 15, 'Stock AIGLE 50kg', 'client_66274424da4db3.82442941', '2024-04-23 05:16:20'),
(0, 40, 3, 'Stock AIGLE 50kg', 'client_66274424da4db3.82442941', '2024-04-23 05:16:21'),
(0, 49, 4, 'gg', 'client_662cb18931c0f1.55159487', '2024-04-27 08:04:25'),
(0, 51, 4, 'gg', 'client_662cb18931c0f1.55159487', '2024-04-27 08:04:26'),
(0, 49, 10, 'tinalalaina', 'client_662cb1c6718c62.23372585', '2024-04-27 08:05:26'),
(0, 51, 10, 'tinalalaina', 'client_662cb1c6718c62.23372585', '2024-04-27 08:05:26'),
(0, 49, 3, 'CHER NJARA DG', 'client_662cb230724282.05305243', '2024-04-27 08:07:12'),
(0, 51, 4, 'CHER NJARA DG', 'client_662cb230724282.05305243', '2024-04-27 08:07:12'),
(0, 52, 5, 'CHER NJARA DG', 'client_662cb230724282.05305243', '2024-04-27 08:07:12'),
(0, 49, 2, 'CHER NJARA tinalalaina', 'client_662cbccd5a13b3.22957209', '2024-04-27 08:52:29'),
(0, 51, 2, 'CHER NJARA tinalalaina', 'client_662cbccd5a13b3.22957209', '2024-04-27 08:52:29'),
(0, 52, 1, 'CHER NJARA tinalalaina', 'client_662cbccd5a13b3.22957209', '2024-04-27 08:52:29'),
(0, 53, 2, 'CHER NJARA tinalalaina', 'client_662cbccd5a13b3.22957209', '2024-04-27 08:52:29'),
(0, 49, 1, 'ji', 'client_662d032f8535f7.53722809', '2024-04-27 13:52:47'),
(0, 51, 2, 'ji', 'client_662d032f8535f7.53722809', '2024-04-27 13:52:47'),
(0, 52, 2, 'ji', 'client_662d032f8535f7.53722809', '2024-04-27 13:52:47'),
(0, 53, 1, 'ji', 'client_662d032f8535f7.53722809', '2024-04-27 13:52:48'),
(0, 54, 3, 'ji', 'client_662d032f8535f7.53722809', '2024-04-27 13:52:48'),
(0, 55, 3, '25', 'client_662f6145c97f15.37385322', '2024-04-29 08:58:45'),
(0, 56, 7, 'vola1234', 'client_662f65839b0235.70299612', '2024-04-29 09:16:51'),
(0, 57, 8, 'vola1234', 'client_662f65839b0235.70299612', '2024-04-29 09:16:51'),
(0, 56, 18, 'vola1234', 'client_662f933552c6b6.50334702', '2024-04-29 12:31:49'),
(0, 58, 8, 'jj', 'client_66308825463a39.11529954', '2024-04-30 05:56:53'),
(0, 59, 7, 'jj', 'client_66308825463a39.11529954', '2024-04-30 05:56:53'),
(0, 60, 5, 'jj', 'client_66308825463a39.11529954', '2024-04-30 05:56:53'),
(0, 61, 6, 'jj', 'client_66308825463a39.11529954', '2024-04-30 05:56:53'),
(0, 62, 9, 'jj', 'client_66308825463a39.11529954', '2024-04-30 05:56:53'),
(0, 63, 8, 'jj', 'client_66308825463a39.11529954', '2024-04-30 05:56:54'),
(0, 64, 24, 'jj', 'client_66308825463a39.11529954', '2024-04-30 05:56:54');

-- --------------------------------------------------------

--
-- Structure de la table `statistiques_produit`
--

CREATE TABLE `statistiques_produit` (
  `id` int(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `value` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statistiques_produit`
--

INSERT INTO `statistiques_produit` (`id`, `label`, `value`) VALUES
(1, 'Janvier', 100),
(2, 'Février', 150),
(3, 'Mars', 200),
(4, 'Avril', 180),
(5, 'Mai', 220);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `p_id` int(11) NOT NULL,
  `ptitle` varchar(255) NOT NULL,
  `pprice` varchar(255) NOT NULL,
  `pstockinitiale` int(250) NOT NULL,
  `pstock` int(250) NOT NULL,
  `pfile` varchar(255) NOT NULL,
  `pstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_product`
--

INSERT INTO `tbl_product` (`p_id`, `ptitle`, `pprice`, `pstockinitiale`, `pstock`, `pfile`, `pstatus`) VALUES
(58, 'tenis', '1000', 200, 192, '1714455980IMG_20231229_060241.jpg', 1),
(59, 'tenis model 2', '20000', 195, 188, '1714456027IMG_20231229_060946.jpg', 1),
(60, 'tenis model 3', '1500', 189, 184, '1714456065IMG_20231229_061006.jpg', 1),
(61, 'tenis model 4', '25000', 150, 144, '1714456088IMG_20231229_061114.jpg', 1),
(62, 'tenis model 6', '26000', 188, 179, '1714456117IMG_20231229_061139.jpg', 1),
(63, 'tenis model 7', '26880', 155, 147, '1714456150IMG_20231229_061158.jpg', 1),
(64, 'tenis model 9', '25600', 156, 132, '1714456185IMG_20231229_061213.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_statistique`
--

CREATE TABLE `tbl_statistique` (
  `userid` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tbl_statistique`
--

INSERT INTO `tbl_statistique` (`userid`, `username`, `useremail`, `created_at`, `updated_at`) VALUES
(1, '2024-04-20', '25', NULL, NULL),
(3, '2024-04-26', '0', NULL, NULL),
(9, '2024-05-11', '36', NULL, NULL),
(10, '2024-05-11', '6', NULL, NULL),
(11, '2024-04-26', '36', NULL, NULL),
(12, '2024-04-26', '35', NULL, NULL),
(13, '2024-04-26', '34', NULL, NULL),
(14, '2024-04-26', '33', NULL, NULL),
(17, '2024-04-29', '52', NULL, NULL),
(18, '2024-04-30', '26', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `status` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `useremail`, `status`) VALUES
(17, 'lalaina', 'vola1234@gmail.com', 'Janvier'),
(23, 'Tina', 'tinalalaina14@gmail.com', '1'),
(24, 'faniry', 'faniry@gmail.com', '0');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `chiffre_d_affaire` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `data_table`
--
ALTER TABLE `data_table`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_stats`
--
ALTER TABLE `product_stats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statistiques_produit`
--
ALTER TABLE `statistiques_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Index pour la table `tbl_statistique`
--
ALTER TABLE `tbl_statistique`
  ADD PRIMARY KEY (`userid`);

--
-- Index pour la table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `data_table`
--
ALTER TABLE `data_table`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2055;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product_stats`
--
ALTER TABLE `product_stats`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statistiques_produit`
--
ALTER TABLE `statistiques_produit`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `tbl_statistique`
--
ALTER TABLE `tbl_statistique`
  MODIFY `userid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
