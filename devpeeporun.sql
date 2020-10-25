-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Ne 25.Okt 2020, 20:11
-- Verzia serveru: 10.4.14-MariaDB
-- Verzia PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `devpeeporun`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `changelogpr`
--

CREATE TABLE `changelogpr` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `changelogpr`
--

INSERT INTO `changelogpr` (`id`, `date`, `version`, `text`) VALUES
(1, '2020-02-14', '0.0.1.1', '<li>Added Main Menu music, can be toggled ON/OFF</li>\r\n<li>Added new level number 5</li>\r\n<li>Added a button in the top left that redirects to the game\'s homepage</li>\r\n'),
(2, '2020-02-12', '0.0.0.8', '<li>New timer that counts in seconds and stops when the level is completed</li>\r\n<li>New behaviour of \'completing a level\' game mechanic: now level ends when all collectibles are collected</li>\r\n<li>Added \'Level Complete\' screen</li>\r\n\r\n'),
(4, '2020-02-12', '0.0.0.7', '<li>Added score counter</li>\r\n<li>New \'How to Play\' screen added, accessed by a button</li>\r\n<li>New \'Select a level\' screen added, accessed by a button</li>\r\n<li>Four new hand-built levels added</li>\r\n<li>Added \'Level Complete\' screen after finishing a level</li>\r\n<li>Main Menu created</li>\r\n<li>Added \'gems\' and \'wooden chests\' to every map as collectibles that count toward the score</li>\r\n\r\n'),
(5, '2020-02-10', '0.0.0.1', '<li>First game draft</li>\r\n<li>Run & idle animations created</li>\r\n<li>Tile-based, 2D map created (now used as level 01)</li>\r\n<li>Basic player controls (going left & right, jumping)</li>\r\n\r\n');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `changelogrl`
--

CREATE TABLE `changelogrl` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `changelogrl`
--

INSERT INTO `changelogrl` (`id`, `date`, `version`, `text`) VALUES
(1, '2020-10-04', 'v4.10.20r1', '<li>Rewritten some text to be easier to understand</li>\r\n<li>Download system is now working again</li>\r\n<li>Launcher renamed & some images changed</li>\r\n<li>New version system</li>\r\n'),
(2, '2020-02-14', '0.0.6', '<li>Version checking is now working</li>\r\n<li>Updating the game allowed only when a new version is detected</li>\r\n<li>Update files and game files are now inside the launcher installation folder (/launcherdata/)</li>\r\n\r\n'),
(4, '2020-02-13', '0.0.5', '<li>Updating the game mechanic added</li>\r\n<li>Starting the game & exiting the launcher now working</li>\r\n<li>Exit button added</li>\r\n<li>Download status on main screen</li>\r\n\r\n'),
(5, '2020-02-13', '0.0.1', '<li>Basic layout created</li>\r\n<li>Buttons for starting the game, downloading the game & updates added</li>\r\n<li>Working game file download mechanic</li>\r\n\r\n\r\n');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `changelogsite`
--

CREATE TABLE `changelogsite` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `changelogsite`
--

INSERT INTO `changelogsite` (`id`, `date`, `version`, `text`) VALUES
(1, '2020-10-01', '0.0.1', '<li>Added some content</li>\r\n<li>Created changelog pages</li>\r\n<li>Created image gallery</li>\r\n');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `imagegallery`
--

CREATE TABLE `imagegallery` (
  `idimage` int(11) NOT NULL,
  `name` varchar(254) NOT NULL,
  `file_path` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `imagegallery`
--

INSERT INTO `imagegallery` (`idimage`, `name`, `file_path`) VALUES
(1, 'RA1G Launcher', 'imgs/ra1gL1.png'),
(2, 'PR2D Main menu', 'imgs/pr2d1.png'),
(3, 'Select a level', 'imgs/pr2d2.png'),
(4, 'How to play', 'imgs/pr2d3.png'),
(5, 'Level 1', 'imgs/pr2d4.png');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `menu`
--

CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL,
  `meno` varchar(55) NOT NULL,
  `file_path` varchar(90) DEFAULT NULL,
  `icon` varchar(90) NOT NULL,
  `menuorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `menu`
--

INSERT INTO `menu` (`idmenu`, `meno`, `file_path`, `icon`, `menuorder`) VALUES
(1, 'Documentation', 'doc.php', 'fa fa-book', 2),
(2, 'RA1G.eu', 'http://www.ra1g.eu', 'fa fa-paper-plane', 4),
(3, 'PeepoRun.Fun', 'http://www.PeepoRun.Fun', 'fa fa-home', 5),
(4, 'Image Gallery', 'images.php', 'fa fa-image', 3),
(5, 'Home', 'index.php', 'fa fa-home', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `supporters`
--

CREATE TABLE `supporters` (
  `id` int(11) NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(254) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(3, 'mato', 'c18c3884160e64a10ce8369a93ff60a9338490ec9d48e66c0a51ca62194508ce', 'mato@mato.sk', 'admin'),
(4, 'rigo66', '20478a3f271d0320ff641e8f87cefc11de9e86d793c31af18302753e6e3ad68f', 'pikoman@pikomanindustries.com', 'basic');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `changelogpr`
--
ALTER TABLE `changelogpr`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `changelogrl`
--
ALTER TABLE `changelogrl`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `changelogsite`
--
ALTER TABLE `changelogsite`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `imagegallery`
--
ALTER TABLE `imagegallery`
  ADD PRIMARY KEY (`idimage`);

--
-- Indexy pre tabuľku `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `meno_UNIQUE` (`meno`);

--
-- Indexy pre tabuľku `supporters`
--
ALTER TABLE `supporters`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `changelogpr`
--
ALTER TABLE `changelogpr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pre tabuľku `changelogrl`
--
ALTER TABLE `changelogrl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pre tabuľku `changelogsite`
--
ALTER TABLE `changelogsite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `imagegallery`
--
ALTER TABLE `imagegallery`
  MODIFY `idimage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `supporters`
--
ALTER TABLE `supporters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
