-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Št 10.Dec 2020, 08:55
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
-- Štruktúra tabuľky pre tabuľku `changeloglt`
--

CREATE TABLE `changeloglt` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `changeloglt`
--

INSERT INTO `changeloglt` (`id`, `date`, `version`, `text`) VALUES
(1, '30.1.2020', '0.0.0', '<ul>\r\n<li>v&yacute;ber prostredia na vytvorenie aplik&aacute;cie</li>\r\n<li>vytvorenie n&aacute;vrhu použ&iacute;vateľsk&eacute;ho prostredia</li>\r\n<li>vytvorenie n&aacute;vrhu aplik&aacute;cie</li>\r\n</ul>'),
(2, '31.1.2020', '0.0.1', '<ul>\r\n<li>vytvorenie z&aacute;kladn&eacute;ho UI v prostred&iacute; Unity</li>\r\n<li>vytvorenie informačn&eacute;ho okna po stlačen&iacute; tlačidla</li>\r\n<li>implementovanie dočasn&yacute;ch tlačidiel</li>\r\n</ul>'),
(3, '8.2.2020', '0.0.2', '<ul>\r\n<li>&uacute;prava UI v prostred&iacute; Unity</li>\r\n<li>vytvorenie informačn&eacute;ho okna po stlačen&iacute; tlačidla</li>\r\n<li>implementovanie tlačidla na vypnutie aplik&aacute;cie</li>\r\n<li>pridan&eacute; n&aacute;hodn&eacute; vyberanie ot&aacute;zok po spusten&iacute; testovania \"N&aacute;hodn&eacute; testy\"</li>\r\n<li>pridan&eacute; 2 tlačidl&aacute; ktor&eacute; otvoria prehliadač a prejd&uacute; na t&uacute;to str&aacute;nku a str&aacute;nku Vimeo kan&aacute;la</li>\r\n<li>vytvorenie nov&yacute;ch sc&eacute;n (2)</li>\r\n<li>vytvorenie UI pre vyberanie ot&aacute;zok na teste</li>\r\n</ul>');

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
(2, '12.02.2020', '0.0.0.8', '<ul>\r\n<li>New timer that counts in seconds and stops when the level is completed</li>\r\n<li>New behaviour of \'completing a level\' game mechanic: now level ends when all collectibles are collected</li>\r\n<li>Added \'Level Complete\' screen</li>\r\n</ul>'),
(4, '12.02.2020', '0.0.0.7', '<ul>\r\n<li>Added score counter</li>\r\n<li>New \'How to Play\' screen added, accessed by a button</li>\r\n<li>New \'Select a level\' screen added, accessed by a button</li>\r\n<li>Four new hand-built levels added</li>\r\n<li>Added \'Level Complete\' screen after finishing a level</li>\r\n<li>Main Menu created</li>\r\n<li>Added \'gems\' and \'wooden chests\' to every map as collectibles that count toward the score</li>\r\n</ul>'),
(5, '10.02.2020', '0.0.0.1', '<ul>\r\n<li>First game draft</li>\r\n<li>Run &amp; idle animations created</li>\r\n<li>Tile-based, 2D map created (now used as level 01)</li>\r\n<li>Basic player controls (going left &amp; right, jumping)</li>\r\n</ul>'),
(18, '14.2.2020', '0.0.1.1', '<ul>\r\n<li>Added Main Menu music, can be toggled ON/OFF</li>\r\n<li>Added new level number 5</li>\r\n<li>Added a button in the top left that redirects to the game\'s homepage</li>\r\n</ul>'),
(22, '09.10.2020', '0.3.0-A5', '<ul>\r\n<li>New main menu</li>\r\n<li>Settings screen now fully working (preview in image gallery)</li>\r\n<li>Minor improvements/additions</li>\r\n</ul>'),
(23, '06.10.2020', '0.3.0-A2', '<ul>\r\n<li>Minor changes</li>\r\n<li>Remake of the game started</li>\r\n</ul>');

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
(2, '14.02.2020', '0.0.6', '<ul>\r\n<li>Version checking is now working</li>\r\n<li>Updating the game allowed only when a new version is detected</li>\r\n<li>Update files and game files are now inside the launcher installation folder (/launcherdata/)</li>\r\n</ul>'),
(4, '13.02.2020', '0.0.5', '<ul>\r\n<li>Updating the game mechanic added</li>\r\n<li>Starting the game &amp; exiting the launcher now working</li>\r\n<li>Exit button added</li>\r\n<li>Download status on main screen</li>\r\n</ul>'),
(5, '13.02.2020', '0.0.1', '<ul>\r\n<li>Basic layout created</li>\r\n<li>Buttons for starting the game, downloading the game &amp; updates added</li>\r\n<li>Working game file download mechanic</li>\r\n</ul>');

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
(1, '04.10.2020', '0.0.1', '<ul><li>Website created on 1.10.2020</li>\r\n<li>Added some content</li>\r\n<li>Created changelog pages</li>\r\n<li>Created image gallery</li></ul>\r\n'),
(6, '28.10.2020', '0.3.0-A2', '<ul>\r\n<li>Added tinyMCE text editor to changelog\'s textarea</li>\r\n<li>Register &amp; login system created</li>\r\n<li>System to dynamically add/delete/update changelogs now working</li>\r\n<li>Completely new simplistic design</li>\r\n<li>Image gallery system now 50% complete</li>\r\n</ul>'),
(8, '18.11.2020', '0.6.8-A10', '<ul>\r\n<li>Brand new admin panel</li>\r\n</ul>');

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
(1, 'RA1G Launcher', 'ra1gL1.png'),
(2, 'PR2D Main menu', 'pr2d1.png'),
(3, 'Select a level', 'pr2d2.png'),
(4, 'How to play', 'pr2d3.png'),
(5, 'Level 1', 'pr2d4.png'),
(21, 'XDDDDDDDDDDDDDD', 'clownHairdo.png');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `menu`
--

CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL,
  `meno` varchar(55) NOT NULL,
  `file_path` varchar(90) DEFAULT NULL,
  `icon` varchar(90) NOT NULL,
  `menuorder` int(11) DEFAULT NULL,
  `menu_category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `menu`
--

INSERT INTO `menu` (`idmenu`, `meno`, `file_path`, `icon`, `menuorder`, `menu_category`) VALUES
(2, 'RA1G.eu', 'http://www.ra1g.eu', 'fa fa-paper-plane', 4, 'external'),
(3, 'PeepoRun.Fun', 'http://www.PeepoRun.Fun', 'fa fa-home', 5, 'external'),
(4, 'Image Gallery', 'images.php', 'fa fa-image', 3, NULL),
(5, 'Home', 'index.php', 'fa fa-home', 1, NULL),
(7, 'News', 'newscat.php', 'fas fa-newspaper', 2, NULL),
(10, 'Changelogs', 'changelogs.php', 'fa fa-list-ul', 6, NULL),
(11, 'Downloads', 'downloads.php', 'fas fa-download', 7, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_title` varchar(150) NOT NULL,
  `news_short_description` longtext NOT NULL,
  `news_full_content` longtext NOT NULL,
  `news_author` varchar(20) NOT NULL,
  `news_published_on` varchar(30) NOT NULL,
  `news_category` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_short_description`, `news_full_content`, `news_author`, `news_published_on`, `news_category`) VALUES
(1, 'News system now in development!', 'Work began on a simple news system', '<p style=\"text-align: center;\"><span style=\"font-size: 14pt;\">Today I started working on a simple news system, so i can publish articles about my development work. Comments system is also planned next!</span></p>', 'ra1g', '29.10.2020', 'Site News'),
(2, 'PeepoRun2D & RA1G Launcher put on hold temporarily', 'I have put on hold the development of PR2D & RA1G Launcher, so I could focus more on university studying and website development.', '<p style=\"text-align: center;\"><span style=\"font-size: 14pt;\">Due to unforeseen circumstances</span></p>', 'ra1g', '29.10.2020', 'General News'),
(6, 'R1 Admin Panel on track to be finished soon', 'The brand new R1 Admin Panel is on track to be fully implemented and functional soon.', '<p>Although <em>some</em> features are still missing, it is looking very nicely at this time.</p>', 'mato', '19.11.2020', 'Site News');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `releases`
--

CREATE TABLE `releases` (
  `idrelease` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `file_path` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  `islatest` varchar(3) NOT NULL,
  `dateuploaded` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `releases`
--

INSERT INTO `releases` (`idrelease`, `name`, `file_path`, `version`, `islatest`, `dateuploaded`) VALUES
(1, 'PeepoRun2D', 'Game030A5.zip', '0.3.0-A5', 'yes', '09.10.2020'),
(2, 'RA1G Launcher', 'ra1g_launcher010A2.exe', 'v0.1.0-A2', 'yes', '04.10.2020'),
(3, 'PeepoRun2D', 'Game0011.zip', '0.0.1.1', 'no', '14.2.2020');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `resourcespage`
--

CREATE TABLE `resourcespage` (
  `id` int(11) NOT NULL,
  `res_name` varchar(200) NOT NULL,
  `res_desc` mediumtext DEFAULT NULL,
  `res_filepath` varchar(254) NOT NULL,
  `res_cat` varchar(50) NOT NULL,
  `res_dateadded` varchar(20) NOT NULL,
  `res_user` varchar(254) NOT NULL,
  `res_filesize` varchar(30) NOT NULL,
  `res_imgdimensions` varchar(30) DEFAULT NULL,
  `res_disabled` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `resourcespage`
--

INSERT INTO `resourcespage` (`id`, `res_name`, `res_desc`, `res_filepath`, `res_cat`, `res_dateadded`, `res_user`, `res_filesize`, `res_imgdimensions`, `res_disabled`) VALUES
(1, 'clownHairdo emote', 'pepo clown hairdo', 'files/cat_img/clownHairdo.png', 'cat_img', '04/12/2020 00:17:53', 'mato', '0,1', '100x100', 'no'),
(4, 'Christmas 5Head', 'discord emote', 'files/cat_img/5Head2.png', 'cat_img', '04/12/2020 00:21:07', 'mato', '1', '130x120', 'no'),
(5, 'PepeLaugh Biohazard', NULL, 'files/cat_img/coronaPepeLaugh.png', 'cat_img', '04/12/2020 00:32:40', 'mato', '1', NULL, 'no'),
(6, 'D: Emote', NULL, 'files/cat_img/coronaGasp.png', 'cat_img', '04/12/2020 00:36:52', 'mato', '2', NULL, 'no'),
(7, 'Pepega Biohazard', NULL, 'files/cat_img/coronaPepega.png', 'cat_img', '04/12/2020 00:38:00', 'mato', '1', NULL, 'no'),
(8, 'Omegalul', NULL, 'files/cat_img/omegalul.png', 'cat_img', '04/12/2020 00:38:43', 'mato', '3', NULL, 'no'),
(9, 'Button image', NULL, 'files/cat_img/buttoncopy.png', 'cat_img', '04/12/2020 00:41:18', 'mato', '0.5', NULL, 'no'),
(10, 'Craig', 'There is no need to be upset', 'files/cat_img/craig.png', 'cat_img', '04/12/2020 00:44:00', 'mato', '4', NULL, 'no'),
(11, 'Hmmmm', 'Thinking', 'files/cat_img/monkaHmm.png', 'cat_img', '04/12/2020 00:50:15', 'mato', '2', NULL, 'no'),
(12, 'Sleepy Joe', '2020', 'files/cat_img/sleepyJoe.png', 'cat_img', '04/12/2020 00:52:41', 'mato', '5', NULL, 'no'),
(13, 'AYAYA Spooky', 'Spooktober edition', 'files/cat_img/AYAYAoct.png', 'cat_img', '04/12/2020 00:53:48', 'mato', '1', NULL, 'no'),
(14, 'Audi 80 Quattro', 'GTR 2 ', 'files/cat_img/69686809_2328788294055051_2235073080730845184_n.jpg', 'cat_img', '04/12/2020 11:53:28', 'mato', '2', NULL, 'no'),
(15, 'Motorsport Manager 2030 Season', 'Season 10', 'files/cat_img/2033_standings.png', 'cat_img', '04/12/2020 13:20:43', 'mato', '3', NULL, 'no'),
(16, 'NMO Programy', 'Vsetky NMO programy doteraz', 'files/cat_arch/comingsoon_04.zip', 'cat_arch', '04/12/2020 13:24:24', 'mato', '4', 'FILE-NOT-IMAGE', 'no'),
(19, 'Asphalt texture', 'For track making', 'files/cat_arch/asphalt_0002_2k_CN4UaB.zip', 'cat_arch', '04/12/2020 13:57:38', 'mato', '4', 'FILE-NOT-IMAGE', 'no'),
(21, 'Image with space in the filename', 'Title', 'files/cat_img/zilina2.jpg', 'cat_img', '04/12/2020 22:15:18', 'mato', '20', NULL, 'no'),
(22, 'Random video', 'Idk', 'files/cat_video/received_812030352918152.mp4', 'cat_video', '04/12/2020 22:31:58', 'mato', '3', 'FILE-NOT-IMAGE', 'no'),
(23, 'IMG Dimension and FileSize test', 'title basically', 'files/cat_img/vydiagamedeloepr2.png', 'cat_img', '06/12/2020 15:52:14', 'mato', '0.17', '450x450', 'yes');

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
  `userid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(254) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `email`, `role`) VALUES
(3, 'mato', 'c18c3884160e64a10ce8369a93ff60a9338490ec9d48e66c0a51ca62194508ce', 'mato@mato.sk', 'admin'),
(4, 'rigo66', '20478a3f271d0320ff641e8f87cefc11de9e86d793c31af18302753e6e3ad68f', 'pikoman@pikomanindustries.com', 'basic'),
(5, 'ibimaiga', 'eeb8dbb7ea0ec5586fb257657e739e35e07572f7cf136ab2613b867ddbafcbb1', 'ibi@maiga.cz', 'basic'),
(6, 'aaaaaaaaaaaa', '56693b10dff894e44c407f1ef0e03460e9f22bae7fbfe86963744d4f39b29ad9', 'neeeeeeeeeeee@ne.com', 'banned'),
(7, 'TEST', '54fbcc856e3d1e0ed4791a82b4a5862fe20103c477afbf2275257b252a12112c', 'TEST@TEST.COM', 'banned'),
(8, 'kralik', '8d4308a726156ff1c4d4c5bb241a074ab6e202b6df7974ee63129969cf805e19', 'kralikman@azet.sk', 'banned'),
(9, 'zumprecht', '311fe3feed16b9cd8df0f8b1517be5cb86048707df4889ba8dc37d4d68866d02', 'zumprecht@gege.sk', 'basic');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `changeloglt`
--
ALTER TABLE `changeloglt`
  ADD PRIMARY KEY (`id`);

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
-- Indexy pre tabuľku `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexy pre tabuľku `releases`
--
ALTER TABLE `releases`
  ADD PRIMARY KEY (`idrelease`);

--
-- Indexy pre tabuľku `resourcespage`
--
ALTER TABLE `resourcespage`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `supporters`
--
ALTER TABLE `supporters`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `changeloglt`
--
ALTER TABLE `changeloglt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pre tabuľku `changelogpr`
--
ALTER TABLE `changelogpr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pre tabuľku `changelogrl`
--
ALTER TABLE `changelogrl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pre tabuľku `changelogsite`
--
ALTER TABLE `changelogsite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pre tabuľku `imagegallery`
--
ALTER TABLE `imagegallery`
  MODIFY `idimage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pre tabuľku `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pre tabuľku `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pre tabuľku `releases`
--
ALTER TABLE `releases`
  MODIFY `idrelease` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pre tabuľku `resourcespage`
--
ALTER TABLE `resourcespage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pre tabuľku `supporters`
--
ALTER TABLE `supporters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
