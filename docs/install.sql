-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 apr 2017 om 20:54
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zf_cms_jor`
--
DROP DATABASE IF EXISTS `zf_cms_jor`;
CREATE DATABASE IF NOT EXISTS `zf_cms_jor` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `zf_cms_jor`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bugs`
--

CREATE TABLE `bugs` (
  `id` int(11) UNSIGNED NOT NULL,
  `author` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `description` text,
  `priority` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `content_nodes`
--

CREATE TABLE `content_nodes` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `node` varchar(50) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `content_nodes`
--

INSERT INTO `content_nodes` (`id`, `page_id`, `node`, `content`) VALUES
(13, 4, 'headline', 'Bacon Ipsum headline'),
(14, 4, 'image', '/images/upload/bacon-ipsum-square-200-200 (1).jpg'),
(15, 4, 'description', 'Bacon ipsum dolor amet ham ham hock meatball cupim turkey beef corned beef bacon salami jerky shankle cow prosciutto pork loin. Tongue leberkas turkey strip steak short loin. Brisket filet mignon tenderloin shankle. Venison ham beef frankfurter prosciutto turducken shank ball tip pork belly chicken ground round pork loin ribeye.\r\n\r\nSpare ribs ham hock turkey, landjaeger chuck prosciutto chicken tongue frankfurter porchetta venison capicola brisket. Prosciutto ham corned beef tenderloin, flank short loin shoulder filet mignon bacon. Short ribs burgdoggen t-bone pig, shank bacon jowl pork chop spare ribs tail. Bresaola swine beef, pork meatloaf short ribs sirloin tenderloin. Salami swine shankle doner. Rump frankfurter doner ground round, ham corned beef tri-tip andouille tail. Leberkas burgdoggen picanha chicken, sirloin frankfurter cow venison corned beef porchetta meatball pork belly doner cupim.\r\n\r\nHamburger pork alcatra, ground round bacon pork loin chicken andouille cow tail tri-tip doner short ribs short loin ham. Tenderloin sirloin hamburger, rump t-bone ball tip swine strip steak boudin fatback pork loin porchetta kevin landjaeger chuck. Tri-tip swine t-bone, meatloaf tongue boudin biltong short loin leberkas pork chop chicken. Strip steak hamburger shank brisket, flank cow ground round. Chicken pork venison shankle shank, alcatra burgdoggen brisket.\r\n\r\nPork loin bresaola landjaeger fatback chuck ground round pork belly, shoulder kevin. Pork chop kevin strip steak biltong, jerky landjaeger short ribs boudin turkey swine flank rump chuck. Turducken turkey frankfurter corned beef kielbasa andouille cupim ribeye spare ribs. Bacon filet mignon pig pork belly swine. Pig venison prosciutto kevin. Pork belly kevin hamburger, biltong jowl meatball swine beef ribs picanha rump pork loin ball tip burgdoggen.\r\n\r\nBoudin flank jerky alcatra. Meatball swine flank short loin t-bone chuck. Fatback kevin pork pork belly frankfurter, tenderloin short ribs t-bone cow biltong swine hamburger chicken drumstick meatball. Boudin ground round fatback pork. T-bone beef ribs cupim shank pastrami pork strip steak landjaeger andouille. Jerky tongue tri-tip filet mignon. Biltong alcatra prosciutto beef ribs t-bone frankfurter short ribs porchetta filet mignon chicken pork belly meatloaf.\r\n\r\nDoes your lorem ipsum text long for something a little meatier? Give our generator a tryâ€¦ itâ€™s tasty!\r\n'),
(16, 4, 'content', 'Bacon ipsum dolor amet ham ham hock meatball cupim turkey beef corned beef bacon salami jerky shankle cow prosciutto pork loin. Tongue leberkas turkey strip steak short loin. Brisket filet mignon tenderloin shankle. Venison ham beef frankfurter prosciutto turducken shank ball tip pork belly chicken ground round pork loin ribeye.\r\n\r\nSpare ribs ham hock turkey, landjaeger chuck prosciutto chicken tongue frankfurter porchetta venison capicola brisket. Prosciutto ham corned beef tenderloin, flank short loin shoulder filet mignon bacon. Short ribs burgdoggen t-bone pig, shank bacon jowl pork chop spare ribs tail. Bresaola swine beef, pork meatloaf short ribs sirloin tenderloin. Salami swine shankle doner. Rump frankfurter doner ground round, ham corned beef tri-tip andouille tail. Leberkas burgdoggen picanha chicken, sirloin frankfurter cow venison corned beef porchetta meatball pork belly doner cupim.\r\n\r\nHamburger pork alcatra, ground round bacon pork loin chicken andouille cow tail tri-tip doner short ribs short loin ham. Tenderloin sirloin hamburger, rump t-bone ball tip swine strip steak boudin fatback pork loin porchetta kevin landjaeger chuck. Tri-tip swine t-bone, meatloaf tongue boudin biltong short loin leberkas pork chop chicken. Strip steak hamburger shank brisket, flank cow ground round. Chicken pork venison shankle shank, alcatra burgdoggen brisket.\r\n\r\nPork loin bresaola landjaeger fatback chuck ground round pork belly, shoulder kevin. Pork chop kevin strip steak biltong, jerky landjaeger short ribs boudin turkey swine flank rump chuck. Turducken turkey frankfurter corned beef kielbasa andouille cupim ribeye spare ribs. Bacon filet mignon pig pork belly swine. Pig venison prosciutto kevin. Pork belly kevin hamburger, biltong jowl meatball swine beef ribs picanha rump pork loin ball tip burgdoggen.\r\n\r\nBoudin flank jerky alcatra. Meatball swine flank short loin t-bone chuck. Fatback kevin pork pork belly frankfurter, tenderloin short ribs t-bone cow biltong swine hamburger chicken drumstick meatball. Boudin ground round fatback pork. T-bone beef ribs cupim shank pastrami pork strip steak landjaeger andouille. Jerky tongue tri-tip filet mignon. Biltong alcatra prosciutto beef ribs t-bone frankfurter short ribs porchetta filet mignon chicken pork belly meatloaf.\r\n\r\nDoes your lorem ipsum text long for something a little meatier? Give our generator a tryâ€¦ itâ€™s tasty!\r\n');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `access_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `menus`
--

INSERT INTO `menus` (`id`, `name`, `access_level`) VALUES
(1, 'maine_menu', NULL),
(2, 'admino_menu', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `label`, `page_id`, `link`, `position`) VALUES
(12, 2, 'pages', 0, '/page', 1),
(13, 1, 'Home', 0, '/page', 1),
(15, 2, 'menus', 0, '/menu', 2),
(16, 1, 'bacon[link doesnt work]', 4, NULL, 2),
(19, 2, 'add user', 0, '/user/create', 4),
(20, 2, 'users', 0, '/user/list', 3),
(22, 2, 'create page', 0, '/page/create', 6),
(23, 2, 'Rebuild Search Index', 0, '/search/build', 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `namespace` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `pages`
--

INSERT INTO `pages` (`id`, `parent_id`, `namespace`, `name`, `date_created`) VALUES
(4, 0, 'page', 'Bacon Ipsum', 1491015313);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `role` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `role`) VALUES
(3, 'BBetgen', '3eee07273efaf427665828a6079d6918', 'Bert', 'Betgen', 'Administrator'),
(4, 'User', '8f9bfe9d1345237cb3b2b205864da075', 'user', 'user', 'User'),
(5, 'Jor', 'c5d708ffde8000261ee067f2540a97bf', 'Jor', 'Sanders', 'Administrator'),
(6, 'Jor', 'c5d708ffde8000261ee067f2540a97bf', 'Jor', 'Sanders', 'Administrator');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `content_nodes`
--
ALTER TABLE `content_nodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bugs`
--
ALTER TABLE `bugs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `content_nodes`
--
ALTER TABLE `content_nodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT voor een tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT voor een tabel `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
