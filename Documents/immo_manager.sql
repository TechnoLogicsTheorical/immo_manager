-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 mars 2021 à 15:30
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immo_manager`
--

-- --------------------------------------------------------

--
-- Structure de la table `im_interventions`
--

CREATE TABLE `im_interventions` (
  `id` int(11) NOT NULL COMMENT 'Identifiant Data Auto Incremented',
  `name` tinytext NOT NULL COMMENT 'Nom de l''intervention',
  `date` date NOT NULL COMMENT 'Date de l''intervention',
  `floor` int(11) NOT NULL COMMENT 'Etage de l''intervention'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `im_interventions`
--
ALTER TABLE `im_interventions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `im_interventions`
--
ALTER TABLE `im_interventions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant Data Auto Incremented';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
