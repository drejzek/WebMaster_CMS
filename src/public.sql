-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Sob 04. lis 2023, 22:00
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
-- Struktura tabulky `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `a_sections`
--

DROP TABLE IF EXISTS `a_sections`;
CREATE TABLE IF NOT EXISTS `a_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sec_name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `sec_id` int(2) NOT NULL,
  `visible` tinyint(1) DEFAULT '1',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `content` varchar(4096) COLLATE utf8_czech_ci NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `submit_text` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  `cancel_text` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  `secondary_text` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `cms_news`
--

DROP TABLE IF EXISTS `cms_news`;
CREATE TABLE IF NOT EXISTS `cms_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `content` varchar(1000) COLLATE utf8_czech_ci NOT NULL,
  `timestamp` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(516) COLLATE utf8_czech_ci NOT NULL,
  `type` varchar(4) COLLATE utf8_czech_ci NOT NULL,
  `path` varchar(516) COLLATE utf8_czech_ci NOT NULL,
  `alt` varchar(516) COLLATE utf8_czech_ci NOT NULL,
  `for_module` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `superior_section` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `forms`
--

DROP TABLE IF EXISTS `forms`;
CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `forms_fields`
--

DROP TABLE IF EXISTS `forms_fields`;
CREATE TABLE IF NOT EXISTS `forms_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `type` int(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `placeholder` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `form_identifier` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `galery`
--

DROP TABLE IF EXISTS `galery`;
CREATE TABLE IF NOT EXISTS `galery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `galery_name` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  `galery_identifier` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `date` datetime NOT NULL,
  `user` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `nav`
--

DROP TABLE IF EXISTS `nav`;
CREATE TABLE IF NOT EXISTS `nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `topmenu` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `identifier` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `descr` varchar(999) COLLATE utf8_czech_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8_czech_ci,
  `date` date DEFAULT NULL,
  `public_from` date DEFAULT NULL,
  `public_to` date DEFAULT NULL,
  `toppage` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
  `subweb_id` int(1) NOT NULL DEFAULT '0',
  `header_img_path` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `is_public_from` tinyint(1) NOT NULL DEFAULT '0',
  `is_public_to` tinyint(1) NOT NULL DEFAULT '0',
  `last_modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `page_blocks`
--

DROP TABLE IF EXISTS `page_blocks`;
CREATE TABLE IF NOT EXISTS `page_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(2) NOT NULL,
  `block_id` int(2) NOT NULL,
  `content` varchar(1000) COLLATE utf8_czech_ci NOT NULL,
  `block_type` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `p_sections`
--

DROP TABLE IF EXISTS `p_sections`;
CREATE TABLE IF NOT EXISTS `p_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sec_name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `sec_id` int(2) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_lock` tinyint(1) NOT NULL DEFAULT '0',
  `site_password` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `page_password` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `use_forgotpassword` tinyint(1) NOT NULL DEFAULT '1',
  `company_name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `company_name_short` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `ver` varchar(16) COLLATE utf8_czech_ci DEFAULT '1.0.0.0',
  `autologout_allowed` tinyint(1) NOT NULL DEFAULT '1',
  `autologout_time` int(5) DEFAULT '600',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `stats_24h`
--

DROP TABLE IF EXISTS `stats_24h`;
CREATE TABLE IF NOT EXISTS `stats_24h` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sess_id` int(6) NOT NULL,
  `user_id` varchar(132) COLLATE utf8_czech_ci NOT NULL,
  `timestamp` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `stats_total`
--

DROP TABLE IF EXISTS `stats_total`;
CREATE TABLE IF NOT EXISTS `stats_total` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sess_id` varchar(132) COLLATE utf8_czech_ci NOT NULL,
  `user_id` varchar(516) COLLATE utf8_czech_ci NOT NULL,
  `timestamp` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `subwebs`
--

DROP TABLE IF EXISTS `subwebs`;
CREATE TABLE IF NOT EXISTS `subwebs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `web_name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `web_id` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `user_tokens`
--

DROP TABLE IF EXISTS `user_tokens`;
CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `user_id` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
