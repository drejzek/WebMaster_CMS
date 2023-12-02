-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Sob 02. zář 2023, 20:34
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
-- Databáze: `example_web`
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `cms_news`
--

INSERT INTO `cms_news` (`id`, `name`, `content`, `timestamp`) VALUES
(1, 'Lorem ipsum', 'Lorem ipsum dolor sit amet..', '2023-08-24');

-- --------------------------------------------------------

--
-- Struktura tabulky `cms_users`
--

DROP TABLE IF EXISTS `cms_users`;
CREATE TABLE IF NOT EXISTS `cms_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `perm` int(1) NOT NULL DEFAULT '1',
  `timestamp` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `cms_users`
--

INSERT INTO `cms_users` (`id`, `name`, `email`, `username`, `password`, `active`, `perm`, `timestamp`) VALUES
(0, 'David Rejzek', 'info@davidrejzek.cz', 'SliestBull58637', '21232f297a57a5a743894a0e4a801fc3', 1, 2, '07-11-22 9:31:30'),
(2, 'Admin', 'admin@admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 1, '04-02-23 10:02:27');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `pages`
--

INSERT INTO `pages` (`id`, `name`, `identifier`, `descr`, `keywords`, `content`, `date`, `public_from`, `public_to`, `toppage`, `subweb_id`, `header_img_path`, `visible`, `locked`, `is_public_from`, `is_public_to`, `last_modified`) VALUES
(1, 'O nÃ¡s', 'o-nas', 'O nÃ¡s', 'O nÃ¡s', '<p><em>Zab&yacute;v&aacute;m se v&yacute;robou a prodejem&nbsp;<strong>ruÄnÄ› vyr&aacute;bÄ›n&yacute;ch&nbsp;</strong>sv&iacute;Äek z&nbsp;<strong>pÅ™&iacute;rodn&iacute;ho&nbsp;</strong>palmov&eacute;ho krystalick&eacute;ho vosku. Vybere si u n&aacute;s kaÅ¾d&yacute; kdo m&aacute; r&aacute;d sv&iacute;Äky, i ten kdo nev&iacute; co d&aacute;t za d&aacute;rek, protoÅ¾e&nbsp;<strong>ruÄn&iacute; v&yacute;roba&nbsp;</strong>se vÅ¾dy cen&iacute; a hlavnÄ› za&nbsp;<strong>rozumn&eacute; ceny</strong>. Nav&iacute;c pÅ™i objedn&aacute;vce nad&nbsp;<strong>1000 KÄ je doprava zdarma</strong>. UÅ¾ nemus&iacute;te chodit do pÅ™eplnÄ›n&yacute;ch obchodÅ¯, nakupujte v klidu z pohodl&iacute; Va&scaron;eho domova.</em></p>\r\n<p><em>V pÅ™&iacute;padÄ›, Å¾e m&aacute;te nÄ›jak&eacute; ot&aacute;zky nebo potÅ™ebujete poradit, obraÅ¥te se na email&nbsp;<strong>magickysvetsvicek@seznam.cz</strong></em></p>\r\n<p><em>DÄ›kuji a tÄ›&scaron;&iacute;m se na V&aacute;&scaron; n&aacute;kup.</em></p>', '2023-08-18', NULL, NULL, NULL, 1, '1ObrÃ¡zek1.jpg', 1, 0, 0, 0, '2023-08-18');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `page_blocks`
--

INSERT INTO `page_blocks` (`id`, `page_id`, `block_id`, `content`, `block_type`) VALUES
(5, 1, 1, '<p>dfgdfgdfhgdfgt</p>', 'text'),
(14, 1, 2, 'http://localhost/phpmyadmin/themes/dot.gif', 'img');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `settings`
--

INSERT INTO `settings` (`id`, `site_lock`, `site_password`, `page_password`, `use_forgotpassword`, `company_name`, `company_name_short`, `ver`) VALUES
(1, 0, NULL, '21232f297a57a5a743894a0e4a801fc3', 1, 'ZÃ¡kladnÃ­ a mateÅ™skÃ¡ Å¡kola StaÅˆkovice, PostoloprtskÃ¡ 100, 439 49 StaÅˆkovice', 'ZÃ¡kladnÃ­ a mateÅ™skÃ¡ Å¡kola StaÅˆkovice', '1.0.0.0');

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
) ENGINE=MyISAM AUTO_INCREMENT=166 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `stats_total`
--

INSERT INTO `stats_total` (`id`, `sess_id`, `user_id`, `timestamp`) VALUES
(1, 'as1ts0ttlb920org5mrl5huvjt', '48f0917e0db6ad5a1aa35ab96f693977', '05-01-23 10:18:56'),
(2, 'as1ts0ttlb920org5mrl5huvjt', 'e88d5f65f9d101c9ae2b996c8c3c044d', '05-01-23 10:19:24'),
(3, 'as1ts0ttlb920org5mrl5huvjt', '7bfea1870de6269ca7daa7e1f66bc79c', '05-01-23 11:08:25'),
(4, 'as1ts0ttlb920org5mrl5huvjt', '4141ff4fa3d97147ec7d6f92de7a02ea', '06-01-23 06:41:43'),
(5, 'as1ts0ttlb920org5mrl5huvjt', 'a3004571209f91ea681c8cc2652e206a', '06-01-23 06:42:02'),
(6, 'as1ts0ttlb920org5mrl5huvjt', '6498a215889574bad4ca4358279c103b', '06-01-23 06:42:02'),
(7, 'as1ts0ttlb920org5mrl5huvjt', '04c251838c1449f112b91921cb1b795b', '06-01-23 06:42:23'),
(8, 'as1ts0ttlb920org5mrl5huvjt', '50118ad079d6f3a997e14de5765139f6', '06-01-23 06:48:15'),
(9, 'd8u59bcbm244am81lgjs61d5ic', '58b550d73174d1fef428340dfbdc7a07', '09-01-23 11:24:54'),
(10, '', '8782c33f0d305695cd3f2376279d7734', '09-01-23 11:31:26'),
(11, '', '8ab6b4358a947dd45bddd2fb7c9617d4', '09-01-23 11:31:44'),
(12, '', 'b8f283e86b5608895a6015b943365781', '09-01-23 11:32:18'),
(13, '', 'a2a323d3beb66a9219f02485a5aae787', '09-01-23 11:32:50'),
(14, '3skia94m0bou1n3krr0413qd3p', 'd5f4d594d01fe991531e6250c31a373c', '09-01-23 11:32:54'),
(15, '', 'c50a95880c539c2e5ff3822beb0ac912', '09-01-23 12:35:34'),
(16, 'tueguih2nt97sjq94tk651k0dq', '9f32b799b0b3db7f46cbf8b35227c99f', '09-01-23 12:35:36'),
(17, 'tueguih2nt97sjq94tk651k0dq', 'bede5bfa50f83da1178e95eec811dd5f', '09-01-23 12:35:58'),
(18, 'nghf3bdbemho9nnhsk60jpt4hp', '055a8c3bacdcdd495e3b293bf9de39e9', '13-01-23 08:16:19'),
(19, 'nghf3bdbemho9nnhsk60jpt4hp', '0f971932c36b2cef75b9fe5904f75d8f', '13-01-23 08:17:39'),
(20, 'nghf3bdbemho9nnhsk60jpt4hp', '5781a6faaa18f53ea7c025033e4fe93a', '13-01-23 08:21:00'),
(21, '', '6232deef86253bef1a5964d54fa21b4f', '20-01-23 07:44:29'),
(22, '3jirg2etoinq1h52s74knfg5bp', 'a47293570d44954706b5ac871f6da151', '20-01-23 07:44:38'),
(23, '3jirg2etoinq1h52s74knfg5bp', '133cedcc23a98604a156c4d8bb8c117d', '20-01-23 07:44:43'),
(24, '3jirg2etoinq1h52s74knfg5bp', '84c533ee27bc2cfb299ad8aa1d38244b', '20-01-23 07:51:35'),
(25, '3jirg2etoinq1h52s74knfg5bp', '81ed0426dc5fce07e934d6550d3632a2', '23-01-23 12:47:57'),
(26, '3jirg2etoinq1h52s74knfg5bp', 'b38ae2e3203bfb7e3d16f859f5bcb930', '01-02-23 12:16:58'),
(27, '3jirg2etoinq1h52s74knfg5bp', '55a767c23d85d2a272ca1f180cafb45e', '01-02-23 12:17:24'),
(28, '3jirg2etoinq1h52s74knfg5bp', 'f99a110ceb0845ffe111d6dd845cdac4', '01-02-23 12:21:54'),
(29, '3jirg2etoinq1h52s74knfg5bp', '89d2a6cb9d9dbcc3def243c61fc10f4e', '01-02-23 12:25:17'),
(30, '3jirg2etoinq1h52s74knfg5bp', 'eb6601552b22ee78736fbb4c4f419f3f', '01-02-23 12:50:06'),
(31, 'mml9r82j32cfvo7a2g2jij1lo9', '3b930a33f957f1ed75aab58d6702b2e3', '01-02-23 01:29:48'),
(32, 'mml9r82j32cfvo7a2g2jij1lo9', '8341a0470bb9d7eff36d4f331b4f8c2a', '01-02-23 01:29:55'),
(33, 'mml9r82j32cfvo7a2g2jij1lo9', '1a291bbfd51478776f9c576615e78cee', '01-02-23 01:29:56'),
(34, 'mml9r82j32cfvo7a2g2jij1lo9', '7ece8332be83bec1ee8a24849e3c00b6', '01-02-23 02:06:46'),
(35, 'mml9r82j32cfvo7a2g2jij1lo9', '77a170c8b4c5c3c24b364fda08737b08', '01-02-23 02:28:46'),
(36, 'mml9r82j32cfvo7a2g2jij1lo9', '37b17c4a72e1e65cd731ffc4466bcada', '01-02-23 02:38:26'),
(37, 'mml9r82j32cfvo7a2g2jij1lo9', '7b34a6151e76c45aa76fff3b415f134f', '01-02-23 04:40:27'),
(38, 'mml9r82j32cfvo7a2g2jij1lo9', '640ef977607248f9de6328358bcee898', '01-02-23 04:40:33'),
(39, 'mml9r82j32cfvo7a2g2jij1lo9', '132de39953b9b748df72b207d6910532', '01-02-23 04:40:35'),
(40, 'mml9r82j32cfvo7a2g2jij1lo9', '5e8e7e4fa8bf6a3cf3e7cd7438611a71', '01-02-23 06:20:51'),
(41, 'mml9r82j32cfvo7a2g2jij1lo9', '2415ad658fa0b9744ed6d64f98ec3f21', '01-02-23 06:20:54'),
(42, 'mml9r82j32cfvo7a2g2jij1lo9', '23d06f779a399ea178f552338a88fc97', '03-02-23 06:38:57'),
(43, 'mml9r82j32cfvo7a2g2jij1lo9', '572a0e8c3228520371832eea0c4a3b21', '03-02-23 06:39:03'),
(44, 'mml9r82j32cfvo7a2g2jij1lo9', 'b997f079e616732e2327a43ed3e07327', '03-02-23 06:41:03'),
(45, 'mml9r82j32cfvo7a2g2jij1lo9', 'ea04c2fa926910add73899a0a89019a0', '03-02-23 06:41:35'),
(46, 'mml9r82j32cfvo7a2g2jij1lo9', 'da5b1d76b91a45c54d86086b21deb39b', '03-02-23 06:41:40'),
(47, 'mml9r82j32cfvo7a2g2jij1lo9', 'c95932434cf14feeb4aedbeeb49c4754', '03-02-23 06:41:45'),
(48, 'mml9r82j32cfvo7a2g2jij1lo9', '9adb9b42b24e5abf6bcea971c08ae46c', '03-02-23 06:45:44'),
(49, 'mml9r82j32cfvo7a2g2jij1lo9', '8fb70e991b785bb4fdd7bb961f8bb62c', '03-02-23 06:46:08'),
(50, 'mml9r82j32cfvo7a2g2jij1lo9', 'dd5d2c6f4047226230ed64d3d3d4d1fe', '03-02-23 06:48:10'),
(51, 'mml9r82j32cfvo7a2g2jij1lo9', 'c362712fbf4b1e33074bc6a89c843e97', '03-02-23 06:49:04'),
(52, 'mml9r82j32cfvo7a2g2jij1lo9', '6b8d0016c8967cc5d455c28e291f2916', '03-02-23 07:57:43'),
(53, 'mml9r82j32cfvo7a2g2jij1lo9', 'e50f09ed147e1ae8e28d8bea4fbf3959', '03-02-23 07:58:14'),
(54, 'mml9r82j32cfvo7a2g2jij1lo9', '638c4e1aa47734881c42dac346d0325a', '03-02-23 07:58:28'),
(55, 'mml9r82j32cfvo7a2g2jij1lo9', '30430599d3640690ebddef63609c5f31', '03-02-23 07:58:51'),
(56, 'mml9r82j32cfvo7a2g2jij1lo9', '8f12e21a94e04b0c505a24bedbf858d3', '03-02-23 07:59:02'),
(57, 'mml9r82j32cfvo7a2g2jij1lo9', 'effa2ebcbe3a7a78292c131d7a008de1', '03-02-23 08:00:08'),
(58, 'mml9r82j32cfvo7a2g2jij1lo9', '0d676d34b00ca570a39da6ab6a3b07f9', '03-02-23 08:02:14'),
(59, 'mml9r82j32cfvo7a2g2jij1lo9', 'c7b526abf0c2a425c3aea90d122fd040', '03-02-23 08:03:09'),
(60, 'mml9r82j32cfvo7a2g2jij1lo9', '32a0795b2d3918bd546513c05046e56b', '03-02-23 09:47:07'),
(61, 'mml9r82j32cfvo7a2g2jij1lo9', '0e9db9ff1f4581bd62c59d4037f1bea1', '03-02-23 09:48:02'),
(62, 'mml9r82j32cfvo7a2g2jij1lo9', 'd87ff2b43fe766e8959292d53d12ab03', '03-02-23 09:48:44'),
(63, 'mml9r82j32cfvo7a2g2jij1lo9', '092af181323abd5152945019c574bd06', '03-02-23 09:49:29'),
(64, 'mml9r82j32cfvo7a2g2jij1lo9', '72fb153fe2bc738ac6a163957dd0a274', '03-02-23 09:49:39'),
(65, 'mml9r82j32cfvo7a2g2jij1lo9', 'fa32183f975419c39ab977302bca07d9', '03-02-23 10:09:44'),
(66, 'mml9r82j32cfvo7a2g2jij1lo9', '57ec541f315095e0cbcf05dab01ad2eb', '03-02-23 10:10:45'),
(67, 'mml9r82j32cfvo7a2g2jij1lo9', 'd6d16ecdea12b10b58276e59e2420937', '03-02-23 10:11:11'),
(68, 'mml9r82j32cfvo7a2g2jij1lo9', 'd9de2f557c12dc5c7c864760e200b5e9', '03-02-23 10:11:30'),
(69, 'mml9r82j32cfvo7a2g2jij1lo9', '9e55c8a4b6650742869bb9a50c481e6d', '03-02-23 10:14:15'),
(70, 'mml9r82j32cfvo7a2g2jij1lo9', '2b669df6a26be4c44c888bf71e32d4ba', '03-02-23 10:14:38'),
(71, 'mml9r82j32cfvo7a2g2jij1lo9', 'd539d1b1c6137e25037be1dec9b5641b', '03-02-23 10:14:55'),
(72, 'mml9r82j32cfvo7a2g2jij1lo9', '82adaedfe2add7735955319ed4ec1062', '03-02-23 10:16:46'),
(73, 'mml9r82j32cfvo7a2g2jij1lo9', 'b5640a29d9b7fec533c5fe3b2fe57454', '03-02-23 10:17:26'),
(74, 'mml9r82j32cfvo7a2g2jij1lo9', '572f90aa7d664f6a705f13d87dab03c2', '03-02-23 10:17:46'),
(75, 'mml9r82j32cfvo7a2g2jij1lo9', '93b4addd9f16b9bf63f2673bcdcf76e3', '03-02-23 10:18:00'),
(76, 'mml9r82j32cfvo7a2g2jij1lo9', '5960a5316926382da861c3e6c9d0ba86', '03-02-23 10:18:18'),
(77, 'mml9r82j32cfvo7a2g2jij1lo9', '59463a8f847d6ad1f6af3f5b577e421d', '03-02-23 10:18:41'),
(78, 'mml9r82j32cfvo7a2g2jij1lo9', '907a022d5af1c999f4a9076024664453', '03-02-23 10:20:02'),
(79, 'mml9r82j32cfvo7a2g2jij1lo9', 'cb6078218f679195e558e953799cfaa9', '03-02-23 10:20:26'),
(80, 'mml9r82j32cfvo7a2g2jij1lo9', 'f9f7b12395bfbf20fc2855d06b08631a', '03-02-23 10:20:44'),
(81, 'mml9r82j32cfvo7a2g2jij1lo9', '2adc97c7f23b17fb8840bbe48a15ba52', '03-02-23 10:21:00'),
(82, 'mml9r82j32cfvo7a2g2jij1lo9', '6dc6e6a36a450186d8bc2bb4bae39358', '03-02-23 10:21:11'),
(83, 'mml9r82j32cfvo7a2g2jij1lo9', '47887c699941c2c5eb8906f50fe29ca7', '03-02-23 10:22:00'),
(84, 'mml9r82j32cfvo7a2g2jij1lo9', 'd58af553456f04ac949e2676c4739637', '03-02-23 10:22:20'),
(85, 'mml9r82j32cfvo7a2g2jij1lo9', 'cf91f14f63bbc002a793a6bc5e6009a3', '03-02-23 10:22:43'),
(86, 'mml9r82j32cfvo7a2g2jij1lo9', 'b24061cb62228914cfea760602eaf075', '03-02-23 10:24:22'),
(87, 'mml9r82j32cfvo7a2g2jij1lo9', '1114eff29363353ffa0bce9cd4d0af10', '03-02-23 10:25:01'),
(88, 'mml9r82j32cfvo7a2g2jij1lo9', 'faa4578ad4580baaf066b350f4978959', '03-02-23 10:25:51'),
(89, 'mml9r82j32cfvo7a2g2jij1lo9', 'f3185e09d4b06c74b96a20ba492f934a', '03-02-23 10:26:03'),
(90, 'mml9r82j32cfvo7a2g2jij1lo9', '8e5f8a349ae80119a7e5c68ecf15b3ce', '03-02-23 10:26:30'),
(91, 'mml9r82j32cfvo7a2g2jij1lo9', '096d13276cb6494d93383dd0f3a23114', '03-02-23 10:27:01'),
(92, 'mml9r82j32cfvo7a2g2jij1lo9', '96c13b5aac052964b33143afe0423dca', '03-02-23 10:27:33'),
(93, 'mml9r82j32cfvo7a2g2jij1lo9', '77a6ef1fdc242987b137f49199ca2d6f', '03-02-23 10:28:55'),
(94, 'mml9r82j32cfvo7a2g2jij1lo9', '4cf3c41bd7481afc7e7784b426935a55', '03-02-23 11:07:44'),
(95, 'mml9r82j32cfvo7a2g2jij1lo9', '9b6f74fca8e6145a3295432c1dae2721', '03-02-23 11:08:14'),
(96, 'mml9r82j32cfvo7a2g2jij1lo9', '48e51488f0e17da43b9341265b22d66b', '03-02-23 11:08:38'),
(97, 'mml9r82j32cfvo7a2g2jij1lo9', '2c162d01805e79ce5dfe095b8c49d89c', '03-02-23 11:10:52'),
(98, 'mml9r82j32cfvo7a2g2jij1lo9', 'f114504ebc9502e5d51e2bd09fd1dae1', '03-02-23 11:11:46'),
(99, 'mml9r82j32cfvo7a2g2jij1lo9', 'ff8defd02ede04822df4a9e2c8a58a8c', '04-02-23 10:07:52'),
(100, 'mml9r82j32cfvo7a2g2jij1lo9', 'b637b2627c1f120ca2933e037de2445d', '04-02-23 10:09:33'),
(101, 'mml9r82j32cfvo7a2g2jij1lo9', 'd5f2a0f6c7205cf195a62516b19b4f2c', '04-02-23 10:09:34'),
(102, 'mml9r82j32cfvo7a2g2jij1lo9', '48b51849c7069ba374a788bce693ff0d', '04-02-23 10:17:14'),
(103, 'mml9r82j32cfvo7a2g2jij1lo9', '8ae614fdc6b549aa690d959a1f974e17', '04-02-23 10:17:48'),
(104, 'mml9r82j32cfvo7a2g2jij1lo9', '0d25606e3451492c797bd806eb839ee3', '04-02-23 10:19:26'),
(105, 'mml9r82j32cfvo7a2g2jij1lo9', '0d7ccacb49fbedce8750f548e58c08b3', '04-02-23 10:19:49'),
(106, 'mml9r82j32cfvo7a2g2jij1lo9', 'b0c77ae904c96f826fca5b23b236f874', '04-02-23 10:21:06'),
(107, 'mml9r82j32cfvo7a2g2jij1lo9', 'fc387d443e29e704453fd08fb0acc413', '04-02-23 10:21:22'),
(108, 'mml9r82j32cfvo7a2g2jij1lo9', '6272e38bf0a81fd82527c45aa16d846c', '04-02-23 10:22:50'),
(109, 'mml9r82j32cfvo7a2g2jij1lo9', '00d93cd1a3e5103809db89cb4f0f8251', '04-02-23 10:23:16'),
(110, 'mml9r82j32cfvo7a2g2jij1lo9', 'b9457a60ef8a4dd4ac1ec840f78c5b14', '04-02-23 10:23:53'),
(111, 'mml9r82j32cfvo7a2g2jij1lo9', '3c819017284e9eacddf81f86aa936a45', '04-02-23 10:24:29'),
(112, 'mml9r82j32cfvo7a2g2jij1lo9', '4147a82e52f493993f509170c17ef94c', '04-02-23 10:27:00'),
(113, 'mml9r82j32cfvo7a2g2jij1lo9', '397414d7bc1a4f2c0f0f82449052a8f2', '04-02-23 10:29:05'),
(114, 'mml9r82j32cfvo7a2g2jij1lo9', '0ee80e8f107a699782766cbc834c6ac5', '04-02-23 10:29:34'),
(115, 'mml9r82j32cfvo7a2g2jij1lo9', 'c95e28ec272cdbc8af353663e29d43a0', '04-02-23 10:30:08'),
(116, 'mml9r82j32cfvo7a2g2jij1lo9', '73a3534890eb3484bca10168048720b6', '04-02-23 10:30:12'),
(117, 'mml9r82j32cfvo7a2g2jij1lo9', '565a8894835e6e937a281f8ab4bcb419', '04-02-23 10:30:24'),
(118, 'mml9r82j32cfvo7a2g2jij1lo9', '98fb74863b42f87930eb1e62d5eab8bb', '04-02-23 10:30:36'),
(119, 'mml9r82j32cfvo7a2g2jij1lo9', 'b772945cbd78e9d56cc77883f0681ab0', '04-02-23 10:31:10'),
(120, 'mml9r82j32cfvo7a2g2jij1lo9', '632b892d3ecbcf228436c9d435076816', '04-02-23 10:31:24'),
(121, 'mml9r82j32cfvo7a2g2jij1lo9', '8605aa22cbf9aaf8dcc43040d292fc81', '04-02-23 10:31:35'),
(122, 'mml9r82j32cfvo7a2g2jij1lo9', '9337835725a418968f3e6307769c6c1c', '04-02-23 10:31:51'),
(123, 'mml9r82j32cfvo7a2g2jij1lo9', '399be72dcee0070ca04fab82f550ccc7', '04-02-23 10:32:10'),
(124, 'mml9r82j32cfvo7a2g2jij1lo9', '3b8c376487ffa3b937a1a61bda92ad4d', '04-02-23 10:33:08'),
(125, 'mml9r82j32cfvo7a2g2jij1lo9', '4595155214ad563c28e284e0a84eb8a0', '04-02-23 10:33:34'),
(126, 'mml9r82j32cfvo7a2g2jij1lo9', '83524763414fbcad54f9a7d60490c707', '04-02-23 10:34:49'),
(127, 'mml9r82j32cfvo7a2g2jij1lo9', 'fb53a941b1632940dac4741a938c9e8f', '04-02-23 10:36:30'),
(128, 'mml9r82j32cfvo7a2g2jij1lo9', '9b2d6a17a7d41efd9219aceb88f1174f', '04-02-23 10:36:50'),
(129, 'mml9r82j32cfvo7a2g2jij1lo9', 'e54e5a8abe8163938731b78065c6239e', '04-02-23 10:37:07'),
(130, 'mml9r82j32cfvo7a2g2jij1lo9', 'be8d955f6123a74545d2194d9bb04082', '04-02-23 10:38:02'),
(131, 'mml9r82j32cfvo7a2g2jij1lo9', '53eb51e0c1c5b6b9fef56b44a23bfa3f', '04-02-23 10:38:16'),
(132, 'mml9r82j32cfvo7a2g2jij1lo9', 'ad5c188c1b6fd9daa11d48a6b054e943', '04-02-23 10:38:56'),
(133, 'mml9r82j32cfvo7a2g2jij1lo9', 'bc40f1586cc43bf211a212c5e341bcf8', '04-02-23 10:49:28'),
(134, 'mml9r82j32cfvo7a2g2jij1lo9', 'ef2d55e21a20d5f983cd888a070e71ee', '04-02-23 10:50:26'),
(135, 'mml9r82j32cfvo7a2g2jij1lo9', 'e428fc40ee1c5892ad1e2a570082be20', '04-02-23 10:50:54'),
(136, 'mml9r82j32cfvo7a2g2jij1lo9', 'efc5a5e5927c22bb0c9554cf2eb00c42', '04-02-23 10:54:50'),
(137, 'mml9r82j32cfvo7a2g2jij1lo9', '529ba2f297b4b9758dff541ea2f5b020', '04-02-23 10:55:19'),
(138, 'mml9r82j32cfvo7a2g2jij1lo9', 'ceaf620f7ae7b7ce90f600e156ae1be1', '04-02-23 10:56:21'),
(139, 'mml9r82j32cfvo7a2g2jij1lo9', '918aaedfcb118647bb93ae56c57d038b', '04-02-23 03:16:01'),
(140, 'mml9r82j32cfvo7a2g2jij1lo9', 'a21c4470c7cd0935dbfeb11257c777ef', '04-02-23 03:16:26'),
(141, 'mml9r82j32cfvo7a2g2jij1lo9', 'cb97708762668e1563b1df0b3d4d0184', '04-02-23 03:19:47'),
(142, 'mml9r82j32cfvo7a2g2jij1lo9', 'dfe4b8ddc125de53a19e48a36541f7bb', '04-02-23 03:26:22'),
(143, 'mml9r82j32cfvo7a2g2jij1lo9', '4e56bf8fdadf9c2d3c3f25c279021e06', '04-02-23 03:35:33'),
(144, 'mml9r82j32cfvo7a2g2jij1lo9', 'ab4909153744a296a97f5c74958f69dc', '04-02-23 03:36:07'),
(145, 'mml9r82j32cfvo7a2g2jij1lo9', 'c0116233bd6078b2fbbc85775df47cf9', '04-02-23 03:37:42'),
(146, 'mml9r82j32cfvo7a2g2jij1lo9', 'a44db728da1651481df91de4cbeeb16d', '04-02-23 03:37:50'),
(147, 'mml9r82j32cfvo7a2g2jij1lo9', '95a37fab44edff3ed6eb55bdda14783f', '04-02-23 03:37:55'),
(148, 'mml9r82j32cfvo7a2g2jij1lo9', '92046e4de64475f31d68a0b1fef71a99', '04-02-23 03:38:18'),
(149, 'mml9r82j32cfvo7a2g2jij1lo9', '6f5d945d6ae247f063c5057710a11de3', '04-02-23 03:38:32'),
(150, 'mml9r82j32cfvo7a2g2jij1lo9', '6645f561df8f950da3a701ee48faab72', '04-02-23 03:40:22'),
(151, 'mml9r82j32cfvo7a2g2jij1lo9', '3648d695c74bc4d5e9120c24e430f2e2', '04-02-23 03:47:09'),
(152, 'mml9r82j32cfvo7a2g2jij1lo9', '522eee65c4838eb8569649790d8b0cd1', '04-02-23 03:48:34'),
(153, 'mml9r82j32cfvo7a2g2jij1lo9', 'd924879bc7ef2ce5252e042ee2464d41', '04-02-23 03:48:58'),
(154, 'mml9r82j32cfvo7a2g2jij1lo9', 'dc216aebf1d1c2ed7faea3c219b67c7a', '04-02-23 09:35:42'),
(155, 'mml9r82j32cfvo7a2g2jij1lo9', 'dd9274ae06e7c65fc039ea81429d2ab1', '04-02-23 09:36:23'),
(156, 'mml9r82j32cfvo7a2g2jij1lo9', '4c049df62771e23a8c0494df241b171f', '04-02-23 09:37:13'),
(157, 'mml9r82j32cfvo7a2g2jij1lo9', '79c22eb2cc53da6fc95125a165441fc5', '04-02-23 10:07:55'),
(158, 'mml9r82j32cfvo7a2g2jij1lo9', '080d674361b11e65363e9800e47a9c96', '06-02-23 06:47:04'),
(159, 'mml9r82j32cfvo7a2g2jij1lo9', 'a699bc841efbbe9fd28cacad69a94f79', '07-02-23 11:57:51'),
(160, 'mml9r82j32cfvo7a2g2jij1lo9', 'da5a51452e9c58545b9c6afe70178efb', '07-02-23 11:58:02'),
(161, '', '9bfb6db3108804fac0a8c598b1dec43c', '07-02-23 11:58:43'),
(162, 'g7hfe1njm24dceok7kivge6sji', 'fa7e8251916f60f3a5ea0a92be8ae811', '07-02-23 11:58:53'),
(163, 'g7hfe1njm24dceok7kivge6sji', '4e6acb093fdf5169ed1e9aff3e7c1819', '07-02-23 12:01:44'),
(164, '', 'ac5818cbca2689470933edf855ca03b1', '07-02-23 12:02:41'),
(165, 'bs140k8it53v1e0dklgvb691tg', 'de092d57c359689f837b01c5c54fd27c', '07-02-23 12:03:04');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `subwebs`
--

INSERT INTO `subwebs` (`id`, `web_name`, `web_id`, `visible`, `locked`, `password`) VALUES
(1, 'HlavnÃ­ web', 1, 1, 0, NULL),
(2, 'ZÃ¡kladnÃ­ Å¡kola', 2, 1, 0, NULL),
(3, 'MateÅ™skÃ¡ Å¡kola', 3, 1, 0, NULL),
(4, 'Å kolnÃ­ jÃ­delna', 4, 1, 0, NULL),
(5, 'Å kolnÃ­ druÅ¾ina', 5, 1, 0, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
