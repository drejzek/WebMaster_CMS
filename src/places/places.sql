-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Sob 02. zář 2023, 21:50
-- Verze serveru: 5.7.36
-- Verze PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `exploreblog`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `places`
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `identifier` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `descr` varchar(155) COLLATE utf8_czech_ci DEFAULT NULL,
  `keywords` varchar(60) COLLATE utf8_czech_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `date` date NOT NULL,
  `public_from` date DEFAULT NULL,
  `public_to` date DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `a_sec` int(2) NOT NULL,
  `header_img_path` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `img_dir` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `is_public_from` tinyint(1) NOT NULL DEFAULT '0',
  `is_public_to` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `places`
--

INSERT INTO `places` (`id`, `name`, `identifier`, `descr`, `keywords`, `content`, `date`, `public_from`, `public_to`, `author`, `a_sec`, `header_img_path`, `img_dir`, `visible`, `is_public_from`, `is_public_to`, `locked`) VALUES
(1, 'BÃ½valÃ© jatky', 'byvale-jatky', 'Jatka', 'Jatka', NULL, '2023-09-02', NULL, NULL, 'David Rejzek', 1, 'IMG_1015.jpeg', 'jatka', 1, 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
