-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 03 juil. 2023 à 01:10
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `esera`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `date_commande` datetime DEFAULT NULL,
  `liked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `produit_id`, `utilisateur_id`) VALUES
(1, 1, 3),
(3, 1, 14),
(2, 2, 3),
(7, 3, 3),
(4, 3, 14),
(5, 11, 14),
(8, 14, 3),
(6, 16, 14),
(9, 18, 3),
(10, 23, 3);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `image` blob NOT NULL,
  `description` text DEFAULT NULL,
  `prix` decimal(10,0) NOT NULL,
  `date_publication` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `utilisateur_id`, `nom`, `type`, `image`, `description`, `prix`, `date_publication`) VALUES
(1, 3, 'yezzy', 'mode tendance', 0x79657a7a792e6a7067, 'pointure 40', '15000', '2023-06-11 21:52:19'),
(2, 6, 'Accer Nitro 5', 'Techno', 0x61636365722e6a7067, 'ram 16go \r\nssd 512go\r\nrtx 3050ti\r\n', '5500000', '2023-06-11 23:58:56'),
(3, 5, 'Diffuseur', 'Déco', 0x646966662e6a706567, 'Diffuseur de vapeur pour décoration d\'intérieur', '20000', '2023-06-12 00:25:05'),
(11, 10, 'jordan air force one', 'Shoes', 0x6a6f7264616e2e6a706567, 'pointure 37???? \r\noriginal sous carton', '200000', '2023-07-02 14:39:26'),
(12, 11, 'air force', 'Shoes', 0x616972666f726365286e6f6972292e6a706567, 'black édition rouge sang\r\n', '1500000', '2023-07-02 14:42:26'),
(13, 10, 'air force', 'Shoes', 0x616972666f726365726f73652e6a7067, 'Tout rose \r\npointure 42', '100000', '2023-07-02 14:43:27'),
(14, 12, 'thomson pc', 'Technologie', 0x54686f6d736f6d2e6a7067, 'ram16gb\r\n1 TO\r\nrtx 3050Ti\r\n2CRAN hd', '1200000', '2023-07-02 14:52:00'),
(15, 13, 'clavier', 'Technologie', 0x6b6579626f6172642e6a7067, 'stock limité', '7000', '2023-07-02 14:53:20'),
(16, 14, 'air jordan one 1', 'Shoes', 0x6a6f7264616e286f6e65626c657565292e6a7067, 'tout bleue\r\ndisponnible de suite', '100000', '2023-07-02 14:56:37'),
(17, 11, 'anana patchoy', 'Other', 0x70617463686f792e6a7067, 'anana ', '200', '2023-07-02 15:01:59'),
(18, 14, 'air max', 'Shoes', 0x6169726d61782e6a7067, 'disponible de suite\r\npointure 40\r\ncouleur: gris', '80000', '2023-07-02 17:17:57'),
(19, 13, 'computer accer', 'Technologie', 0x616365722e6a7067, 'ram 8gb ddr3 double slot\r\nssd 512 gb\r\nnvidia geforce  gtx 4 go dedié', '1000000', '2023-07-02 17:26:43'),
(20, 3, 'iphone X', 'Technologie', 0x6970686f6e652e6a7067, 'originale\r\nétat 9/10', '1200000', '2023-07-03 00:24:02'),
(21, 11, 'air max', 'Shoes', 0x6169726d6178286a61756e65292e6a7067, 'couleur: jaune\r\nsemi cuir \r\nsous carton ', '100000', '2023-07-03 00:25:20'),
(22, 12, 'redmi note 10 pro max', 'Technologie', 0x7265646d692e6a7067, 'sous carton\r\nbatterie originale\r\npremier démarrage', '2000000', '2023-07-03 00:27:16'),
(23, 5, 'chiot ', 'Pets&co', 0x6368696f742e6a7067, 'pure sang\r\n3 mois\r\n', '500000', '2023-07-03 00:30:17');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `motdepasse` varchar(255) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `pdp` blob DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `product_liked_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `motdepasse`, `pseudo`, `pdp`, `tel`, `product_liked_id`) VALUES
(3, 'motdepasse', 'fetra', 0x7064702e706e67, '0341313655', NULL),
(5, 'monmdp', 'rasta', 0x72617374612e6a7067, '0341313333', NULL),
(6, 'motdepasse', 'Computer Store ', 0x70737963686f73652e6a7067, '0331240857', NULL),
(10, 'fetra', 'Léothicia Ralantoarison', 0x6c656f2e6a7067, '038 94 205 61', NULL),
(11, 'poums', 'james', 0x6a616d65732e6a7067, '034 27 899 65', NULL),
(12, 'tsy', 'beloha', 0x62656c6f68612e6a7067, '034 45 788 78', NULL),
(13, '1234', 'computer store fianar', 0x636f6d707574657273746f72652e6a7067, '034 58 996 33', NULL),
(14, '1244', 'fetra sarobidy', 0x66657472612e6a7067, '034 13 136 55', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`produit_id`,`utilisateur_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
