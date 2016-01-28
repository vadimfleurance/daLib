-- phpMyAdmin SQL Dump
-- version 4.5.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 28 Janvier 2016 à 11:49
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dalib`
--

-- --------------------------------------------------------

--
-- Structure de la table `movies__users`
--

CREATE TABLE `movies__users` (
  `id` int(10) UNSIGNED NOT NULL,
  `idMovie` int(10) UNSIGNED NOT NULL,
  `idUser` int(10) UNSIGNED NOT NULL,
  `watched` tinyint(1) DEFAULT NULL,
  `toWatch` tinyint(1) DEFAULT NULL,
  `owned` tinyint(1) DEFAULT NULL,
  `ofInterest` tinyint(1) DEFAULT NULL,
  `wanted` tinyint(1) DEFAULT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `movies__users`
--
ALTER TABLE `movies__users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_movie` (`idMovie`),
  ADD KEY `id_user` (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `movies__users`
--
ALTER TABLE `movies__users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `movies__users`
--
ALTER TABLE `movies__users`
  ADD CONSTRAINT `movies__users_ibfk_1` FOREIGN KEY (`idMovie`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `movies__users_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
