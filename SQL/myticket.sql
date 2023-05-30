-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 29 mai 2023 à 20:10
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `myticket`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `ID_Admin` varchar(30) NOT NULL,
  `Mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `banque`
--

CREATE TABLE `banque` (
  `Num_Cart` int(16) NOT NULL,
  `CVV` int(3) NOT NULL,
  `Date_Exp` date NOT NULL,
  `Nom_Prenom` varchar(50) NOT NULL,
  `Sold` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `banque`
--

INSERT INTO `banque` (`Num_Cart`, `CVV`, `Date_Exp`, `Nom_Prenom`, `Sold`) VALUES
(666, 666, '2023-05-31', 'Admin', 2056.4),
(1233321, 221, '2023-05-31', 'org', 509010),
(12345678, 123, '2023-05-31', 'belaid', 6400),
(123123123, 321, '2023-05-31', 'Xadmin', 105952),
(786958489, 773, '2024-05-29', 'system', 18807.6),
(987654321, 987, '2023-05-31', 'mounir', 785600),
(2147483647, 810, '2024-05-28', 'qwerty azerty', 4880);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `ID_Client` int(10) NOT NULL,
  `Nom_Client` varchar(20) NOT NULL,
  `Prénom_Client` varchar(20) NOT NULL,
  `Numero_Telephone` int(10) NOT NULL,
  `Email_Client` varchar(20) NOT NULL,
  `Password_Client` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID_Client`, `Nom_Client`, `Prénom_Client`, `Numero_Telephone`, `Email_Client`, `Password_Client`) VALUES
(7, 'admin', 'root', 674571547, 'bld.bns5@gmail.com', '$2y$10$LUSQo17LIB12SAlyLyZqNeCqGMTIWGx7mxi6cYoe/nAQh01cSzfYG'),
(8, 'benaissou', 'anouche', 674571543, 'Benaissou12@s.s', '$2y$10$E4RNDWUhbIe0E106RtBezOdD2veAptmFrfS4Yt7h7Fk84Q3H9h8hy'),
(9, 'belaid', 'benaissou', 796206402, 'bns3@gmai.com', '$2y$10$2CCHITIeHPu0c4w8AXHbjOTcEguKuITAz2l1SigWRcJFdyXDn652S'),
(10, 'qwerty', 'azerty', 7689878, 'qwerty@gmail.com', '$2y$10$o/3AKDTtI0IchDXXIISp..tEgsqY7pqrNLniWf86RpTOcZD2uU3m.');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `Num_Commande` int(10) NOT NULL,
  `Num_Cart_id_client` int(10) NOT NULL,
  `ID_Event` int(8) NOT NULL,
  `Date_Commande` datetime NOT NULL,
  `Nom_Prénom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`Num_Commande`, `Num_Cart_id_client`, `ID_Event`, `Date_Commande`, `Nom_Prénom`) VALUES
(1, 1234455, 8, '2023-05-28 20:59:55', 'BELAID'),
(2, 1234455, 8, '2023-05-28 21:05:52', 'BELAID'),
(3, 1234455, 8, '2023-05-28 21:05:55', 'BELAID'),
(4, 1234455, 8, '2023-05-28 21:05:57', 'BELAID'),
(5, 1234455, 8, '2023-05-28 21:05:58', 'BELAID'),
(6, 1234455, 8, '2023-05-28 21:06:00', 'BELAID'),
(7, 1234455, 8, '2023-05-28 21:06:03', 'BELAID'),
(8, 1234455, 8, '2023-05-28 21:06:06', 'BELAID'),
(9, 123123, 15, '2023-05-29 00:00:00', 'bns b'),
(10, 12321, 15, '2023-05-29 00:00:00', 'qweasd'),
(11, 123678, 16, '2023-05-29 00:00:00', 'benasiiuou'),
(12, 45632, 8, '2023-05-29 00:00:00', 'bns qkj'),
(13, 7868, 8, '2023-05-29 00:00:00', 'bns'),
(14, 23432, 8, '2023-05-29 00:00:00', 'cvxzx'),
(15, 2312312, 15, '2023-05-29 00:00:00', 'wqwdasas'),
(16, 1231231, 15, '2023-05-29 00:00:00', 'bnsbnsa'),
(17, 78695, 17, '2023-05-29 00:00:00', 'billy suicide'),
(18, 767879879, 16, '2023-05-29 00:00:00', 'jhgjhvjh'),
(19, 1241242153, 15, '2023-05-29 00:00:00', 'fkjaskfjb'),
(20, 436578787, 15, '2023-05-29 00:00:00', 'jhhyfuf'),
(21, 578787685, 17, '2023-05-29 00:00:00', 'hjfgjhv'),
(22, 325536, 15, '2023-05-29 00:00:00', 'ttrrdgufhy');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `ID_Event` int(8) NOT NULL,
  `ID_Org` int(8) NOT NULL,
  `nom_event` varchar(255) NOT NULL,
  `lieu_event` varchar(255) NOT NULL,
  `date_event` date NOT NULL,
  `heure_event` time NOT NULL,
  `quantite` int(6) NOT NULL,
  `prix` decimal(4,0) NOT NULL,
  `image_event` varchar(255) NOT NULL,
  `type_event` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`ID_Event`, `ID_Org`, `nom_event`, `lieu_event`, `date_event`, `heure_event`, `quantite`, `prix`, `image_event`, `type_event`) VALUES
(8, 26, 'Theatre Comedie ', 'Maison de jeune T.O', '2023-07-26', '21:00:00', 100, 1000, 'téléchargement (7).png', 'culturel'),
(13, 29, 'JSK vs ESS', 'Stade  1er Novembre ', '2023-05-27', '18:39:00', 400, 800, 'téléchargement (7).png', 'sportif'),
(14, 27, 'Soolking', 'Alger', '2023-05-27', '21:00:00', 100, 1200, 'téléchargement (7).png', 'culturel'),
(15, 23, 'Match', 'ALGER', '2023-05-26', '21:00:00', 100, 800, 'téléchargement (7).png', 'sportif'),
(16, 30, 'musique', 'tizi ouzou', '2024-05-23', '15:30:00', 800, 120, '6473c3c6de3cf.png', 'culturel'),
(17, 31, 'Dance Kabyle', 'Maison de la culture', '2023-07-05', '17:30:00', 1200, 120, '64742962219a2.png', 'culturel');

-- --------------------------------------------------------

--
-- Structure de la table `organisateur`
--

CREATE TABLE `organisateur` (
  `ID_Org` int(8) NOT NULL,
  `Nom_Org` varchar(26) NOT NULL,
  `Numero_Telephone_Org` int(10) NOT NULL,
  `Mdp_Org` varchar(255) NOT NULL,
  `Email_Org` varchar(30) NOT NULL,
  `Compte_Org` int(30) NOT NULL,
  `Registre_commerce_Org` varchar(60) NOT NULL,
  `Approuve_Org` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `organisateur`
--

INSERT INTO `organisateur` (`ID_Org`, `Nom_Org`, `Numero_Telephone_Org`, `Mdp_Org`, `Email_Org`, `Compte_Org`, `Registre_commerce_Org`, `Approuve_Org`) VALUES
(23, 'Xadmin', 794206402, '$2y$10$AF4wcDDyHqtlyGQ9bzXq1uRfzem1lz/6PeXuRbouNiRwuLRWRfckC', 'admin.admin@xyz.com', 123123123, '645ff4013b177.png', 1),
(24, 'user', 674571545, '$2y$10$753jbWSovbtqk/19WThwtOEN41iNv3Wfrn46jngI4byvrSQ42nBeG', 'user@user.com', 123123123, '645ff5cae3a99.png', 1),
(25, 'abcd', 123123, '$2y$10$Aem9LRVbcghtl8WbtB/jD.uBvAb3FYPltzo3/I3Us/gN7x864vzE6', 'admin@user.com', 123123123, '645ff99b0154f.png', 1),
(26, 'org', 989878, '$2y$10$vGWPnt91I23ZPXkMkN8KbOGgA2D0E2gqaPm3Q0j2WdXNZGidp11Na', 'admin@gmail.com', 1233321, '645ffb8e80e2b.png', 1),
(27, 'admin', 9090909, '$2y$10$R/Alg2zSNlx1hEAmT39EB.xJpUvLe4gHu5fqodBKRLGc0xb/Vu.Zy', 'admin@admin.xxyz', 123123123, '646003804d70c.png', 1),
(28, 'admin', 19231924, '$2y$10$Z7uMsBmu/TQ/4gNw/l7kd.eYHm6hxykMmBQUL8aG1vgYSU9RsWg4W', 'admin@admin.root', 123123123, '646390ac759b5.jpg', 1),
(29, 'abcd', 401284, '$2y$10$cXu3J0v65ddd2bqZ5q22AeQK8hD.vXHh0R4yYOCRXT2bKOb63GlMi', 'abcd@abcd.com', 124312413, '646ac1cff03e2.jpg', 1),
(30, 'beladi', 989889, '$2y$10$XNI2ayvKJUrQbLX7NdLhGO29MkOKAU4/EVHa29xv0ko4Z.ZvCtaVG', 'bladi1@gmail.com', 2147483647, '64738f6eded8a.jpg', 1),
(31, 'system', 123212, '$2y$10$FQSmlo.b0hwyGw5McoBpF.E1qc0abH6fLjXKo4uqnu99L2uZyactG', 'benaissou19@gmail.com', 12312345, '6474282b22b49.jpg', 1),
(32, 'system', 123212, '$2y$10$wZjr/MQJewWV/r.6Wc.j9.tVtpVt8NbkQZDVXp3EmL9ngTACqFNh6', 'benaissou19@gmail.com', 12312345, '6474287a754d1.jpg', 1),
(33, 'system', 2314989, '$2y$10$m2zl5LWrtzwQDGBp8GqFH./4Bwm/v3vZ2kqWolQUsSGkZWHt/DXHC', 'benaissou19@gmail.com', 786958489, '6474290584f80.jpg', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`ID_Admin`);

--
-- Index pour la table `banque`
--
ALTER TABLE `banque`
  ADD PRIMARY KEY (`Num_Cart`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_Client`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`Num_Commande`),
  ADD KEY `ID_Event` (`ID_Event`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`ID_Event`),
  ADD KEY `ID_Org` (`ID_Org`);

--
-- Index pour la table `organisateur`
--
ALTER TABLE `organisateur`
  ADD PRIMARY KEY (`ID_Org`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `ID_Client` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `Num_Commande` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `ID_Event` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `organisateur`
--
ALTER TABLE `organisateur`
  MODIFY `ID_Org` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`ID_Event`) REFERENCES `evenements` (`ID_Event`);

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_ibfk_1` FOREIGN KEY (`ID_Org`) REFERENCES `organisateur` (`ID_Org`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
