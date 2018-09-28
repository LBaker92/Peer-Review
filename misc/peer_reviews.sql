-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2018 at 12:40 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peer_reviews`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `username`, `email`, `password`) VALUES
(1, 'Daniel', 'Adognravi', 'dadognra', 'dadognra@kent.edu', 'DanielAdognravi787'),
(2, 'Jared', 'Anderson', 'jande135', 'jande135@kent.edu', 'JaredAnderson701'),
(3, 'Logan', 'Baker', 'lbaker38', 'lbaker38@kent.edu', 'LoganBaker875'),
(4, 'Bryce', 'Benjamin', 'bbenjam5', 'bbenjam5@kent.edu', 'BryceBenjamin500'),
(5, 'Tylor', 'Bricker', 'tbricke2', 'tbricke2@kent.edu', 'TylorBricker927'),
(6, 'Roger', 'Cooper', 'rcoope23', 'rcoope23@kent.edu', 'RogerCooper646'),
(7, 'Connor', 'DeGeorge', 'cdegeorg', 'cdegeorg@kent.edu', 'ConnorDeGeorge126'),
(8, 'Charles', 'Desmit', 'cdesmit', 'cdesmit@kent.edu', 'CharlesDesmit930'),
(9, 'Michael', 'Duncan', 'mdunca14', 'mdunca14@kent.edu', 'MichaelDuncan135'),
(10, 'Joshua', 'Evans', 'jevans63', 'jevans63@kent.edu', 'JoshuaEvans100'),
(11, 'Elliott', 'Frankhouse', 'efrankho', 'efrankho@kent.edu', 'ElliottFrankhouse417'),
(12, 'Mark', 'Gardner', 'mgardn15', 'mgardn15@kent.edu', 'MarkGardner535'),
(13, 'Anthony', 'Hillrich', 'ahillric', 'ahillric@kent.edu', 'AnthonyHillrich975'),
(14, 'John', 'Huff', 'jhuff21', 'jhuff21@kent.edu', 'JohnHuff495'),
(15, 'Clay', 'James', 'cjames29', 'cjames29@kent.edu', 'ClayJames877'),
(16, 'Konstantinos', 'Kasamias', 'kkasamia', 'kkasamia@kent.edu', 'KonstantinosKasamias524'),
(17, 'Maxwell', 'Kotlan', 'mkotlan', 'mkotlan@kent.edu', 'MaxwellKotlan824'),
(18, 'Christian', 'Lenart', 'clenart4', 'clenart4@kent.edu', 'ChristianLenart941'),
(19, 'Hao', 'Liu', 'hliu32', 'hliu32@kent.edu', 'HaoLiu667'),
(20, 'Blair', 'McClain', 'bmcclai5', 'bmcclai5@kent.edu', 'BlairMcClain616'),
(21, 'Hayden', 'Moore', 'hmoore14', 'hmoore14@kent.edu', 'HaydenMoore398'),
(22, 'Megan', 'Moorman', 'mmoorma1', 'mmoorma1@kent.edu', 'MeganMoorman177'),
(23, 'Shannon', 'Morris', 'smorri55', 'smorri55@kent.edu', 'ShannonMorris539'),
(24, 'Alexander', 'Pritt', 'apritt3', 'apritt3@kent.edu', 'AlexanderPritt491'),
(25, 'Dylan', 'Prost', 'dprost', 'dprost@kent.edu', 'DylanProst165'),
(26, 'Shemon', 'Rawat', 'srawat1', 'srawat1@kent.edu', 'ShemonRawat115'),
(27, 'Luke', 'Rinehart', 'lrineha1', 'lrineha1@kent.edu', 'LukeRinehart252'),
(28, 'Ohm', 'Shah', 'oshah', 'oshah@kent.edu', 'OhmShah353'),
(29, 'Matthew', 'Skeins', 'mskeins', 'mskeins@kent.edu', 'MatthewSkeins935'),
(30, 'Lauren', 'Smith', 'nsmith97', 'nsmith97@kent.edu', 'LaurenSmith475'),
(31, 'Adam', 'Tischler', 'atischle', 'atischle@kent.edu', 'AdamTischler229'),
(32, 'Joseph', 'Trussell', 'jtrusse1', 'jtrusse1@kent.edu', 'JosephTrussell311'),
(33, 'Collin', 'Werner', 'cwerner7', 'cwerner7@kent.edu', 'CollinWerner792'),
(34, 'Bin', 'Xu', 'bxu3', 'bxu3@kent.edu', 'BinXu375');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
