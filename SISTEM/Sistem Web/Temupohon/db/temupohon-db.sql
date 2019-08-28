-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2017 at 05:59 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `temupohon-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(20) NOT NULL,
  `captcha_time` int(11) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(108, 1504997313, '::1', '219168'),
(109, 1504997350, '::1', '056924'),
(110, 1504997390, '::1', '843700');

-- --------------------------------------------------------

--
-- Table structure for table `datapohon`
--

CREATE TABLE `datapohon` (
  `id_pohon` varchar(255) NOT NULL,
  `nama_pohon` varchar(500) NOT NULL,
  `nama_latin` varchar(100) NOT NULL,
  `sinonim` varchar(100) NOT NULL,
  `perawakan` varchar(255) NOT NULL,
  `biologi` varchar(255) NOT NULL,
  `status_konservasi` varchar(255) NOT NULL,
  `persebaran` varchar(255) NOT NULL,
  `nama_gambar` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `datapohon`
--

INSERT INTO `datapohon` (`id_pohon`, `nama_pohon`, `nama_latin`, `sinonim`, `perawakan`, `biologi`, `status_konservasi`, `persebaran`, `nama_gambar`) VALUES
('TihnMlBh', 'Pohon khuldei', 'khuldi khudli', 'alsjdf', 'akjsdfl', 'lkasjdf', 'lasdjf', 'lkasjdfl', ''),
('Hegrx7wv', 'sdjfk', 'jsdflk', 'lksjdf', 'kljsdf', 'kdjfs', 'klsjdfl', 'lkdfsjfl', ''),
('4fd1nSo3', 'sdjflkjfl', 'ksdjfkdsjfi', 'ijsdifjisdfj', 'ijsidjfi', 'isdfji', 'isdjfiq', 'ijsdfijdsifl', ''),
('ItMkKl0W', 'wejsflkj;dfklj', 'ksdjaflksj', 'ksdjf', 'ksjdf', 'kasdjf', 'dsjflk', 'ksdjf', ''),
('K3jt1r6a', 'dsjzhfjsd', 'kjskdfj', 'kjsdf', 'lksjadfl', 'lkajsdflk', 'kljsdflk', 'lkjsdlkfj', '1505015050dsjzhfjsd.jpg'),
('oqGpk6p5', 'sdfdsf', 'sdf', 'sd', 'j', 'sdfxlkj', 'sdfds', 'skldfd', '1504997776sdfdsf.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `uploadimage`
--

CREATE TABLE `uploadimage` (
  `id_gambar` varchar(50) NOT NULL,
  `nama_gambar` varchar(35) DEFAULT NULL,
  `tipe_gambar` varchar(10) DEFAULT NULL,
  `ket_gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploadimage`
--

INSERT INTO `uploadimage` (`id_gambar`, `nama_gambar`, `tipe_gambar`, `ket_gambar`) VALUES
('', 'gilang222.jpg', 'image/jpeg', 'Gambar Identitas'),
('1504956482', 'gilanggilang.jpg', 'image/jpeg', 'Gambar Identitas'),
('1504956563', 'gilanggilanggilang.jpg', 'image/jpeg', 'Gambar Identitas'),
('1504957530', 'fuad2323.jpg', 'image/jpeg', 'Gambar Identitas'),
('1504997389', 'mgilang13.jpg', 'image/jpeg', 'Gambar Identitas'),
('1504997439', '1504997439Pohon_Beringin.jpg', 'image/jpeg', 'Gambar Pohon'),
('1505014757', '1505014757sdjflkjfl.jpg', 'image/jpeg', 'Gambar Pohon'),
('1505014827wejsflkj;dfklj', '1505014827wejsflkjdfklj.jpg', 'image/jpeg', 'Gambar Pohon'),
('K3jt1r6a', '1505015050dsjzhfjsd.jpg', 'image/jpeg', 'Gambar Pohon'),
('oqGpk6p5', '1504997776sdfdsf.jpg', 'image/jpeg', 'Gambar Pohon');

--
-- Triggers `uploadimage`
--
DELIMITER $$
CREATE TRIGGER `uploadGambar` AFTER INSERT ON `uploadimage` FOR EACH ROW update datapohon set nama_gambar = (select nama_gambar from uploadimage where datapohon.id_pohon=uploadimage.id_gambar)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(225) CHARACTER SET utf8 NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `job` varchar(50) NOT NULL,
  `salt` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `username`, `password`, `alamat`, `gender`, `job`, `salt`) VALUES
('1504997389', 'Muhammad GIlang Nur Khoiri', 'achilgilang@gmail.com', 'mgilang13', 'c38103a468af2488750e884b8229710132d020c7', 'sjdklfjsdljfilsdj', 'Male', 'Ilmuwan', 'AJ7?cxqV'),
('1504957530', 'fuad hm', 'achilgilang@gmail.com', 'fuad2323', 'f9b60c6e07df7eeb786402ceaf2a24845fb536ca', 'afdfjsdjf', 'Male', 'Ilmuwan', 'ocn9ETsX');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`);

--
-- Indexes for table `datapohon`
--
ALTER TABLE `datapohon`
  ADD PRIMARY KEY (`id_pohon`);

--
-- Indexes for table `uploadimage`
--
ALTER TABLE `uploadimage`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
