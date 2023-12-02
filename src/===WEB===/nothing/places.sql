-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Stř 20. zář 2023, 19:06
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
  `coordinates` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `identifier` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `descr` varchar(155) COLLATE utf8_czech_ci DEFAULT NULL,
  `keywords` varchar(60) COLLATE utf8_czech_ci DEFAULT NULL,
  `species` int(1) DEFAULT '0',
  `type` int(1) DEFAULT '0',
  `status` int(1) DEFAULT '0',
  `statistics` int(1) DEFAULT '0',
  `accessibility` int(1) DEFAULT '0',
  `a_sec` int(2) NOT NULL,
  `header_img_path` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `img_dir` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `locked` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `places`
--

INSERT INTO `places` (`id`, `name`, `coordinates`, `identifier`, `descr`, `keywords`, `species`, `type`, `status`, `statistics`, `accessibility`, `a_sec`, `header_img_path`, `img_dir`, `visible`, `locked`) VALUES
(1, 'BÃ½valÃ¡ jatka', '50.335022, 13.542073', 'byvale-jatky', 'BÃ½valÃ¡ jatka', 'BÃ½valÃ¡ jatka, Å½atec', 3, 1, 3, 2, 4, 2, 'IMG_1015.jpeg', 'jatka', 1, 0),
(3, 'NÃ¡draÅ¾Ã­ TÅ™ebuÅ¡ice', '50.523175, 13.579971', 'nadrazi-trebusice', 'NÃ¡draÅ¾Ã­ TÅ™ebuÅ¡ice', 'NÃ¡draÅ¾Ã­ TÅ™ebuÅ¡ice', 7, 1, 3, 2, 4, 1, NULL, 'nadrazi-trebusice', 1, 0),
(4, 'BytovÃ½ dÅ¯m nÃ¡draÅ¾Ã­ Obrnice', '50.503983, 13.700429', 'bytovy-dum-obrnice', 'BytovÃ½ dÅ¯m nÃ¡draÅ¾Ã­ Obrnice', 'BytovÃ½ dÅ¯m nÃ¡draÅ¾Ã­ Obrnice', 1, 1, 3, 1, 3, 1, NULL, 'dum-obrnice', 1, 0),
(5, 'Hotel Nachtigall Praha', '50.325361, 13.54265', 'hotel-nachtigall-praha', 'Hotel Nachtigal Praha', 'Hotel Nachtigal Praha', 1, 1, 3, 1, 2, 2, NULL, 'hotel-nachtigall', 1, 0),
(6, 'HrÃ¡zdÄ›nka', '50.329912, 13.548967', 'hrazdenka', 'HrÃ¡zdÄ›nka', 'HrÃ¡zdÄ›nka', 1, 1, 3, 1, 2, 2, 'hrazdenka.jpg', 'hrazdenka', 1, 0),
(7, 'BytovÃ½ dÅ¯m Trnovany', '50.318648, 13.597675', 'bytovy-dum-trnovany', 'BytovÃ½ dÅ¯m Trnovany', 'BytovÃ½ dÅ¯m Trnovany', 1, 1, 3, 1, 5, 2, NULL, 'bytovy-dum-trnovany', 1, 0),
(8, 'Depo Trnovany', '50.318292, 13.597743', 'depo-trnovany', 'Depo Trnovany', 'Depo Trnovany', 7, 1, 3, 2, 5, 2, NULL, 'depo-trnovany', 1, 0),
(9, 'VÃ½mÄ›nÃ­kovÃ¡ stanice VS-1', '50.316427, 13.545196', 'vymenikova-stanice-vs-1', 'VÃ½mÄ›nÃ­kovÃ¡ stanice VS-1', 'VÃ½mÄ›nÃ­kovÃ¡ stanice VS-1', 8, 1, 1, 3, 1, 2, NULL, 'vs-1', 1, 0),
(10, 'Kolektory VS-1', '50.316488, 13.545177', 'kolektory-vs-1', 'Kolektory VS-1', 'Kolektory VS-1', 8, 3, 1, 2, 2, 2, NULL, 'kolektory_vs1', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
