-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2018 at 07:08 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `temupohon_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(50) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `job` varchar(20) NOT NULL,
  `salt` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `nama_gambar` varchar(100) NOT NULL,
  `id_pertanyaan` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `username`, `password`, `alamat`, `gender`, `job`, `salt`, `level`, `nama_gambar`, `id_pertanyaan`) VALUES
('1506093110', 'Admin', 'achilgilang@gmail.com', 'admin', '4fea6893ecf310e26e7335defd05a49428e94294', 'jsdkfj', 'Male', 'Ilmuwan', 'xFVp&HD+', 'admin', '1506093110admin.jpg', '0'),
('1506389446', 'superadmin', 'ahmadsadi66@yahoo.com', 'superadmin', '5fb2e8b790ba4389d9e29cb60e93f8425398cec1', 'jsdf', 'Male', 'Ilmuwan', 'cSnIH&h8', 'super-admin', '1506389446superadmin.jpg', '0'),
('1510324578', 'Irvan Ferdia', 'kerengilang0@gmail.com', 'fafan21', 'd0266aa32957f50760b88d40556f05fefd63a027', 'sdkljf;lskdf', 'Male', 'Ilmuwan', '+oDmOte2', 'admin', '1510324578fafan21.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(20) NOT NULL,
  `captcha_time` int(11) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(356, 1515377433, '112.215.242.240', '464838'),
(355, 1515377207, '112.215.242.240', '411950'),
(357, 1515542358, '66.249.69.13', '096696'),
(358, 1515939566, '::1', '835308');

-- --------------------------------------------------------

--
-- Table structure for table `datapohon`
--

CREATE TABLE `datapohon` (
  `id_pohon` varchar(255) NOT NULL,
  `nama_pohon` varchar(500) NOT NULL,
  `nama_latin` varchar(100) NOT NULL,
  `sinonim` varchar(100) NOT NULL,
  `perawakan` text NOT NULL,
  `biologi` text NOT NULL,
  `habitat` text NOT NULL,
  `potensi` text NOT NULL,
  `status_konservasi` text NOT NULL,
  `persebaran` text NOT NULL,
  `nama_gambar` varchar(50) NOT NULL,
  `pohon_qr` varchar(100) NOT NULL,
  `add_by` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `datapohon`
--

INSERT INTO `datapohon` (`id_pohon`, `nama_pohon`, `nama_latin`, `sinonim`, `perawakan`, `biologi`, `habitat`, `potensi`, `status_konservasi`, `persebaran`, `nama_gambar`, `pohon_qr`, `add_by`) VALUES
('9JmmcZNp', 'Getasan', 'Buchanania arborescens', 'Buchanania florida', 'Tinggi 35 m, diameter batang 120 cm. Batang lurus tinggi bebas cabang 20 m, kulit batang halus, berwarna abu-abut pucat, bergetah bening. Daun spiral menggerombol di ujung ranting dalam malai kecil-kecil. Bunga kelipatan 5, berwarna putih krem', 'Berbunga pada Januari-Agustus. Berbuah April-November. Regerasi dengan biji, dipencarkan oleh burung. Perbanyakan jenis ini dilakukan dengan biji', 'Banyak tumbuh di daerah pesisir. Tumbuh baik di hutan primer dan sekunder pada ketinggian 600-1000 m. Tumbuh di rawa gambut dan bukit batu kapur.Tidak tahan terhadap api.', 'Kayunya untuk konstruksi ringan, perahu, perabotan rumah tangga, pulp, serta kayu bakar. Daun sebagai obat sakit kepala.', 'Tidak dilindungi mengingat populasinya di alam sangat banyak dan jarang dimanfaatkan. ', 'India, Kep. Andaman, Burma, Indo-China, Taiwan, Thailand, dan kawasan Malesia', '9JmmcZNp.png', '9JmmcZNpqr.png', ''),
('InaC5Jf4', 'Damar Mata Kucing', 'Shorea javanica', 'Shorea vandekoppeli', 'Tinggi 40 m, diameter batang 110 cm. Kulit luar beralur dangkal, cokelat kehitaman, dan mengeluarkan resin bila terluka. Pepagan berserat dan berwarna coklat kemerahan.', 'Berbunga 4 tahun sekali, pada awal musim kemarau dan berbuah di akhir musim kemarau. Regenerasi dan perbanyakan melalui biji dan pemencaran dibantu oleh air dan angin', 'Hutan primer dan sekunder daerah pamah. ', 'Bahan bangunan, meubel, dan perabot rumah tangga. ', 'Populasi di alam mengalami penurunan, karena sering ditebang. Damar ini masih belum masuk ke daftar pohon yang diliindungi', 'Semenanjung Malaka, Sumatra, dan Jawa Barat. ', 'InaC5Jf4.jpg', '', ''),
('nGhQgd8j', 'Rau', 'Dracontomelon dao', 'Dracontomelon mangiferum', 'Tinggi 45 m, diameter 100 cm. Batang berbanit, tinggi 5 m dan lebar 2,5 m, kulit luar cokelat abu-abu, mengelupas seperti sisik. Daun majemuk dengan 4-9 pasang anak daun. Perbungaaan tersusun dalam malai, di ujung ranting. Bunga putih. Buah batu, bulat melonjong, cokelat kemerahan setelah masak.', 'Berbunga pada akhir musim kemarau, berbuah pada Januari-Desember, regenerasi melalui biji. Pemencarannya dibantu oleh binatang, antara lain berbagai jenis burung, kelelawar, dan monyet', 'Daerah beriklim basah, Tumbuh di hutan malar hijau hingga sedikit luruh, di hutan primer-sekunder dengan ketinggian &lt;500m', 'Kayu jenis ini agak lunak, bahan bangunan ringan venic, panel, mebelair, lemari. Pepagan rau untuk obat tradisional', 'Tidak dilindungi, namun populasinya di alam cenderung menurun karena banyak ditebang', 'India, Birma, Thailand, dan seluruh kawasan Malesia.', 'nGhQgd8j.jpg', 'nGhQgd8jqr.png', ''),
('Fo6OmQPr', 'Rengas', 'Gluta renghas', 'Tidak ditemukan', 'Tinggi 50m, diameter 115 cm terkadang berbanit, kulit luar cokelat muda keabu-abuan, ketika dewasa bersisik tebal dan agak mengelupas. Daun tunggal, tersusun spiral, getas, jorong bundar memanjang. Perbungaan tersusun dalam malai dan berwarna putih. Buah batu, membulat, berwarna ungu kecokelatan', 'Berbunga pada awal musim hujan, buah masak pada akhir musim hujan. Pemencaran dibantu oleh kelelawar, burung, dan aliran air.', 'Daerah pantai dan rawa gambut. Tumbuh baik hingga ketinggian 800 m.', 'Kayu sangat kuat dan awet, dipakai untuk bangunan rumah, perahu, mebelair, dan bingkai gambar', 'Tidak dilindungi, walaupun populasi di alam sudah mulai menurun karena banyak ditebang', 'Sumatra, Borneo, Jawa, dan Sulawesi hingga Seram.', 'Fo6OmQPr.jpg', 'Fo6OmQPrqr.png', ''),
('Kfrarutv', 'siodfj', 'ilsdjif', 'lksdjfl', 'lksdjf', 'lksdjfoiwe', 'jsdfoiwj', 'iosdjfo', 'isdjfio', 'ijisof', 'Kfrarutv.jpg', '', ''),
('P0gP34Af', 'Bintaro', 'Cerbera odollam', 'Cerbera dilatata', 'Pohon kecil hingga sedang, tinggi 10-20 m dengan diameter 40 cm. Daun tunggal membundar telur sungsang, tersusun dalam spiral hampir roset di ujung ranting. Bunga tersusun dalam bentuk payung bertangkai panjang, putih kekuningan, dan harum. Buah batu seperti bola, setelah masak berwarna jingga.', 'Berbunga sepanjang tahun, perbanyakan dengan biji. Pemencaran dibantu oleh aliran air dan arus laut', 'Tumbuh di daerah pesisir dan berbatasan dengan mangrove', 'Sebagai pohon pinggir jalan dan hiasan taman', 'Tidak dilindungi karena jumlahnya sangat melimpah', 'Di semua daerah beriklim tropis', 'P0gP34Af.jpg', 'P0gP34Afqr.png', ''),
('Pn5QDmfq', 'Aren', 'Arenga pinnata', 'Arenga saccharifera', 'Ukuran sedang, ijuk banyak, tinggi total 15-20 m, diameter 30-65 cm. Daun majemuk, menyirip, panjang 6-12 m, anak daun berbentuk pita berjumlah 80-130 lembar. Perbungaan di bagian atas terdiri dari bunga betina dan  yang bawah terdiri dari bunga jantan. Buah melonjong berbiji 3. Kulit buah mengandung kristal oksalat yang mengakibatkan gatal di kulit', 'Perbanyakan dengan biji. Perkecambahan biji sangat lama. Untuk mempercepatnya dilakukan skarifikasi. Aren berbunga dan berbuah sepanjang tahun', 'Tumbuh dengan baik di dekat aliran sungai, daerah dengan ketinggian 5-1400 m', 'Tandan bunga(nira), Buah(bahan makanan), Ijuk(anyaman, dekorasi, atap rumah), Tulang anak daun(lidi), Kayu(tongkat pelancong), batang(saluran air dan pati ketika berbuah) ', 'Dilindungi berdasarkan PP. No.54/Kts/Um/2/1972', 'Pantai barat India sampai ke wilayah Cina Selatan dan Papua hingga Kepulauan Guam', 'Pn5QDmfq.jpg', 'Pn5QDmfqqr.png', ''),
('nDQXl2oR', 'Sentok', 'Celtis philippensis', 'Celtis wightii', 'Pohon sedang hingga besar, malar hijau, tinggi 45m, diameter 200cm, Batang lurus, tidak berbanit, kulit luar halus. Daun tunggal berseling dalam dua baris. Bunga tersusun dalam malai, warna putih krem kekuningan. Buah membulat telur, jingga-hijau kebiruan, biji bulat dan mendaging', 'Berbunga pada Juli-April, buah masak pada November-Desember. Penyerbukan dibantu oleh serangga/angin. Biji dipencarkan oleh burung, hewan pengerat, dan aliran air.', 'Tumbuh alami pada ketinggian 2000m. Bukit batu kapur dan pantai berbatu.', 'Bahan bangunan, konstruksi jembatan, bahan lantai, bantalan rel, rangka jendela, perkakas rumah tangga, gagang raket tenis, dan pulp.', 'Tidak dilindungi karena banyak', 'Afrika tropik, Madagaskar, India, Myanmar, Indo-Cina, Cina baigan selatan, Hongkong, Taiwan, hingga ke kawasan Malesia, Kep. Solomon, dan Australia bagian Timur Laut.', 'nDQXl2oR.jpg', '', ''),
('39DzelFr', 'Mindi', 'Melia azedarach', 'Azedarach commelinii', 'Pohon berukuran sedang, tinggi 30 m, diameter batang mencapai 60 cm. Batang tegak lurus, sistem perakarn masuk ke dalam tanah. Kulit luar berwarna abu-abu kehitaman. Tajuk tersebar melebar, dengan sedikit percabangan. Daun majemuk menyirip ganda. Perbungaan dalam malai muncul di ketiak daun, berwarna merah muda. Buah batu, kuning, dengan kulit luar lunak setelah masak.', 'Berbunga dan berbuah hampir sepanjang tahun, buah lebat pada musim tertentu. Perbanyakan mindi dilakukan dengan biji dan potongan batang. Pemencaran dibantu oleh burung dan kelelawar.', 'Tumbuh alami di hutan pamah, hingga ketinggian 500m, terutama di tempat terbuka. ', 'Buah beracun dapat mematikan manusia kecuali burung. Bagian lain dari tumbuhan ini dapat digunakan untuk meracuni ikan atau membuat insektisida. Kayu sangat kuat, tergolong dalam kelas kekuatan II-III dan keawetan IV-V, baik untuk bahan bangunan, dan perabot rumah tangga. Daun dan kulit bataya dapat dijdikan sebagai obat. Mindi banyak ditanam sebagai pohon pinggir jalan.', 'Populasi ini cukup banyak sehingga tidak dilindungi', 'Mindi tersebar alami di kawasan Malesia, Cina, dan bagian timur Australia. Di Indonesia, mindi tersebar hampir di seluru pulau dari Sumatra hingga Papua', '39DzelFr.jpg', '39DzelFrqr.png', ''),
('oRB5DOWe', 'Pohon Padang', 'padang padang', 'ksladjf', 'klsdjf', 'lksfjd', 'lsjdf', 'lsdjf', 'lkfjd', 'lksdfj', 'oRB5DOWe.png', 'oRB5DOWeqr.png', ''),
('hBPBNZAL', 'sdfj', 'sdkfj', 'dfj', 'ksldfj', 'sdkj', 'sdkflj', 'sdf', 'sdfjk', 'skdfj', 'hBPBNZAL.png', 'hBPBNZALqr.png', ''),
('sGsQzh7Y', 'sdjklf', 'lksdjf', 'sldkjf', 'sdkfj', 'klsdfj', 'klsdjf', 'sdklfj', 'lksdjf', 'sldkfj', 'sGsQzh7Y.png', '', 'Muhammad Admin');

-- --------------------------------------------------------

--
-- Table structure for table `lupapasword`
--

CREATE TABLE `lupapasword` (
  `id_pertanyaan` varchar(10) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `index_pertanyaan` varchar(5) NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lupapasword`
--

INSERT INTO `lupapasword` (`id_pertanyaan`, `id_user`, `index_pertanyaan`, `jawaban`) VALUES
('1DzkXwox', '', '3', 'sdafsdf');

-- --------------------------------------------------------

--
-- Table structure for table `masukanpengunjung`
--

CREATE TABLE `masukanpengunjung` (
  `id_pesan` varchar(100) NOT NULL,
  `isi_pesan` text NOT NULL,
  `email_pengunjung` varchar(100) NOT NULL,
  `nama_pengunjung` varchar(100) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `masukanpengunjung`
--

INSERT INTO `masukanpengunjung` (`id_pesan`, `isi_pesan`, `email_pengunjung`, `nama_pengunjung`, `waktu`) VALUES
('', 'sadlkfjljs;df', 'sdjfklsdjflk', 'dsjfdjsfj', '2017-10-19 12:00:33'),
('SsipSebORf', 'sadlkfjljs;df', 'sdjfklsdjflk', 'dsjfdjsfj', '2017-10-19 12:04:27'),
('orD5T4TZl4', 'Haloo ...', 'achilgilang@gmail.com', 'Muhammad Gilang Nur Khoiri', '2017-10-19 12:21:39'),
('3gYcZ37Odq', 'sdkfjsdkljfew', 'aaskdjfl', 'M Fuad', '2017-10-19 12:27:40'),
('blesLQ4qWf', 'HAI Cantik', '', '', '2017-10-19 15:24:59'),
('EACTAXQJ9f', 'dfsdf', 'dsafjdsfiewjfoijoai;sdjfoiwejoisjfiowjesjdf', 'sdfsdf', '2017-10-19 16:11:13'),
('umOxMBxrqN', 'lksadjflsjfdlk', 'lksdjfljsdf', 'sdajf', '2017-10-19 16:17:36'),
('CUINNClIO5', 'sadjflsj;dkf', 'achilgilang', 'gilang', '2017-10-19 16:22:28'),
('K3G5y69uJO', 'alksdjf', 'alalala', 'gilang', '2017-10-19 16:23:48'),
('G7mZP0OuFt', 'sdjfdskf', 'bismillah@gmail.com', 'bismillah', '2017-10-20 06:26:04'),
('vlBl2mDXC7', 'adksfjpdskf', 'asd2323@gmail.com', 'sdfewsdfsdfda', '2017-10-29 17:10:00'),
('lak14ThH2O', 'ghj', 'achilgilang@gmail.com', 'hy', '2017-11-01 08:52:45'),
('lQNZ3jbOP4', '', '', '', '2017-11-10 06:41:40'),
('s9HIHE7Ce1', '', '', '', '2017-11-10 06:42:46'),
('eJj0LlCW4e', 'sadlkfjljs;df', 'sdjfklsdjflk', 'dsjfdjsfj', '2017-11-12 12:20:58'),
('0P1EDtbPuW', 'sadlkfjljs;df', 'achilgilang@gmail.com', 'dsjfdjsfj', '2017-11-12 12:21:30'),
('HMKO6f7Zqf', 'Testing ', 'achilgilang@gmail.com', 'Muhammad Gilang Nur Khoiri', '2017-11-24 14:41:02'),
('xHW9eJPTGK', 'Testing 2', 'achilgilang@gmail.com', 'Muhammad Gilang Nur Khoiri', '2017-11-24 14:41:51'),
('RX4FEPZouY', 'agjbvnmlkkknnnnj', 'achilgilang@gmail.com', 'bis', '2018-01-07 07:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `pesan-admin`
--

CREATE TABLE `pesan-admin` (
  `id_pesan` varchar(50) NOT NULL,
  `id_admin` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `isi_pesan` text NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan-admin`
--

INSERT INTO `pesan-admin` (`id_pesan`, `id_admin`, `id_user`, `isi_pesan`, `nama_admin`, `waktu`) VALUES
('1505564671', '1505552946', '1504997389', 'sdfsdf', '', '2017-09-25 23:17:49'),
('1505564757', '1505552946', '1504997389', 'sdfsdf', '', '2017-09-25 23:17:49'),
('1505564823', '1505552946', '1504997389', 'sdfsdf', '', '2017-09-25 23:17:49'),
('1505564844', '1505552946', '1504997389', 'sdfsdf', '', '2017-09-25 23:17:49'),
('1505565020', '1505552946', '1504997389', 'sdfsdf', '', '2017-09-25 23:17:49'),
('1505565080', '1505552946', '1504997389', 'l', '', '2017-09-25 23:17:49'),
('1505565136', '1505552946', '1504997389', 'l', '', '2017-09-25 23:17:49'),
('1505565179', '1505552946', '1504997389', 'l', '', '2017-09-25 23:17:49'),
('1505565203', '1505552946', '1504997389', 'l', '', '2017-09-25 23:17:49'),
('1505565242', '1505552946', '1504997389', 'l', '', '2017-09-25 23:17:49'),
('1505565433', '1505552946', '1504997389', 'l', '', '2017-09-25 23:17:49'),
('1505565441', '1505552946', '1504997389', 'kk', '', '2017-09-25 23:17:49'),
('1505565467', '1505552946', '1504997389', 'ddsj', '', '2017-09-25 23:17:49'),
('1506171812', '0', '1506124949', 'd', '', '2017-09-25 23:17:49'),
('1506179086', '1506093110', '1506124732', 'zxcdsfdsewad', '', '2017-09-25 23:17:49'),
('1506356121', '1506093110', '1506304390', 'd', 'Admin', '2017-09-25 23:17:49'),
('1506681232', '1506093110', '1506304390', 'hggghghghgt', 'Admin', '2017-09-29 17:33:52'),
('1510463504', '1506093110', '1509696932', 'Hapus data pohon akasia karena tidak sesuai', 'Admin', '2017-11-12 05:06:24'),
('1511534116', '1506093110', '1509696932', 'Testing', 'Admin', '2017-11-24 14:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `created` date NOT NULL,
  `expire` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `user_id`, `created`, `expire`) VALUES
(44, '65e3769afea6dcaad27d94db76912e', '1508740699', '2017-10-30', '2017-10-30 01:52:01'),
(45, '7134ebd442e8270247e555e16f7529', '1508740699', '2017-11-03', '2017-11-03 01:24:12'),
(46, '045d64c60cb30ddbbaba6bf8890463', '1508740699', '2017-11-03', '2017-11-03 01:54:57'),
(47, '52e39965d37749903ced91c49d41d0', '1509696932', '2017-11-07', '2017-11-07 03:32:00'),
(48, 'b74e7c2b6d9400a2a04992d6b723c5', '1510028374', '2017-11-07', '2017-11-07 04:20:07'),
(49, '5bdc9c6a4902d40f7998705553268f', '1510028374', '2017-11-07', '2017-11-07 14:40:59'),
(50, 'a6a532850236e3757ff70f62cfb5c2', '1510028374', '2017-11-07', '2017-11-07 14:48:30'),
(51, '44c9b30f7a5334e5c1c81ad08781cd', '1510028374', '2017-11-07', '2017-11-07 22:06:39'),
(52, '7744c81568c3b46b92201ecc3ed863', '1510028374', '2017-11-07', '2017-11-07 22:09:59'),
(53, '716a46cd886011931a5f7ff4a28c50', '1510028374', '2017-11-07', '2017-11-07 22:13:30'),
(54, '7586e4e6385238f81361d466079987', '1510028374', '2017-11-07', '2017-11-07 22:18:55'),
(55, '853418c5f931ed3fdf3da0fe2a7bdf', '1510028374', '2017-11-07', '2017-11-07 22:20:14'),
(56, '99a8625179cf3caf3f597500ba8369', '1510028374', '2017-11-07', '2017-11-07 22:21:39'),
(57, 'ff5e3002be05abc10324780ce16d5e', '1510028374', '2017-11-07', '2017-11-07 22:25:00'),
(58, 'f58029f6b339f9247fa86c0f6d03d4', '1510028374', '2017-11-07', '2017-11-07 22:30:03'),
(59, '1f6d49fe0b92e98346e1374f77ed93', '1510028374', '2017-11-07', '2017-11-07 22:38:36'),
(60, '9a42156c0655788236cc929bc49593', '1510028374', '2017-11-08', '2017-11-07 23:10:23'),
(61, 'cbe6cd70834949d542485ce69a96b8', '1510028374', '2017-11-10', '2017-11-10 07:12:57'),
(62, 'beec9a9d767db6dc976bb757656db4', '1510028374', '2017-11-10', '2017-11-10 07:14:40'),
(63, 'ae6d72e0ca9a57672ae4470d43ad8a', '1510028374', '2017-11-10', '2017-11-10 07:15:30'),
(64, '11e871f06e85edfe4d75f97023a035', '1510028374', '2017-11-10', '2017-11-10 07:17:04'),
(65, '88be863f741a28fe6a46dbeaf6ae88', '1510028374', '2017-11-10', '2017-11-10 07:18:06'),
(66, 'c078c53f4eced7a9837c72a52721d0', '1510028374', '2017-11-10', '2017-11-10 11:28:25'),
(67, '4c2ae9913ef0a6a9579cdbbcf64d6d', '1510028374', '2017-11-10', '2017-11-10 14:40:04'),
(68, 'f4d6adfe469ae3730e3513f7ba0ea7', '1510028374', '2017-11-10', '2017-11-10 15:11:00'),
(69, '211478ffdab6887db4c4d39f875bcf', '1510028374', '2017-11-10', '2017-11-10 15:15:21'),
(70, '130846f52b17a323658b836b69a953', '1510028374', '2017-11-10', '2017-11-10 15:15:50'),
(71, 'cff0bec6d9489d52db83fed38ec579', '1510028374', '2017-11-10', '2017-11-10 15:15:59'),
(72, 'dfdd7d52899d985de7d24894bdd1cf', '1510028374', '2017-11-10', '2017-11-10 15:16:54'),
(73, 'f2bc74ed5451bc8ea80a146d714368', '1510028374', '2017-11-10', '2017-11-10 15:17:40'),
(74, '8401f2f13c31f935e1d79c98cd3334', '1510028374', '2017-11-10', '2017-11-10 15:18:25'),
(75, 'c9f660b17a6bf4b663d5cb1aedc97c', '1510028374', '2017-11-10', '2017-11-10 15:18:57'),
(76, '582f053f40a7e8ab8a75fb367ea045', '1510028374', '2017-11-17', '2017-11-17 01:49:03'),
(77, '46f9f4fd36cbd0f9bf89fce49edc6a', '1509696932', '2017-11-24', '2017-11-24 06:55:42'),
(78, 'e01c719584888282071f2df7779d37', '1509696932', '2017-11-24', '2017-11-24 06:57:17'),
(79, '7cfce9272d2d3e120f75f2f884be9d', '1509696932', '2017-11-24', '2017-11-24 07:00:47'),
(80, '1ee1803d56d9b3eb8834e4d22fd28d', '1509696932', '2017-12-23', '2017-12-23 14:11:55'),
(81, '475a15a778d84d32790ff2c35666c4', '1509696932', '2018-01-07', '2018-01-07 07:48:13'),
(82, 'dd5d3d9bc14a52d9a44f4df185033a', '1515311995', '2018-01-07', '2018-01-07 08:20:55'),
(83, '6d4eaf1387e14df14f57e82f055bf7', '1515377433', '2018-01-08', '2018-01-08 02:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `tokens-admin`
--

CREATE TABLE `tokens-admin` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `created` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tokens-admin`
--

INSERT INTO `tokens-admin` (`id`, `token`, `admin_id`, `created`) VALUES
(1, '1c83da7348b9597ee284c1f95a232a', 1506389446, '2017-10-30'),
(2, '85946226fbb871e25610ef8b183b86', 1506081061, '2017-11-03'),
(3, '346cdad40d0eb5b8c7dde4bf9fbb7c', 1506081061, '2017-11-03'),
(4, '7072c31ed58b3a21bbf880c206802a', 1506093110, '2017-11-03'),
(5, '456a1370d0a45aa6c7e029c0c5f6ab', 1510324578, '2017-11-10'),
(6, '242fa97d2e9965c736410480bfc9c5', 1510324578, '2017-11-10'),
(7, 'bb7162428c99cd3b8025f06a67e1e2', 1510324578, '2017-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `uploadimage`
--

CREATE TABLE `uploadimage` (
  `id_gambar` varchar(255) NOT NULL,
  `nama_gambar` varchar(35) DEFAULT NULL,
  `tipe_gambar` varchar(10) DEFAULT NULL,
  `ket_gambar` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploadimage`
--

INSERT INTO `uploadimage` (`id_gambar`, `nama_gambar`, `tipe_gambar`, `ket_gambar`) VALUES
('1505553124', '1505553124gilang123.jpg', 'image/jpeg', 'Gambar Identitas Admin'),
('1505553230', '1505553230mgilang222.jpg', 'image/jpeg', 'Gambar Identitas Admin'),
('1505956787', '1505956787mgilang.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506081061', '1506081061klsjdf.jpg', 'image/jpeg', 'Gambar Identitas Super Admin'),
('1506081274', '1506081273ddskjfn.jpg', 'image/jpeg', 'Gambar Identitas Super Admin'),
('1506092462', '1506092461satu.jpg', 'image/jpeg', 'Gambar Identitas Admin'),
('1506093110', '1506093110admin.jpg', 'image/jpeg', 'Gambar Identitas Admin'),
('1506124253', '1506124253luffy123dd.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506124351', '1506124351luffy123ddd.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506124442', '1506124442luffy123dddd.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506124702', '1506124702luffy123ddddd.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506124732', '1506124732luffy123dddddd.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506124795', '1506124795luffy123ddddddd.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506124830', '1506124830luffy123dddddddd.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506124872', '1506124872luffy123dddddddds.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506124949', '1506124949luffy123ddddddddsd.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506125345', '1506125345luffy123ddddddddsdd.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506125528', '1506125528adsfe.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506304390', '1506304390user.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1506389447', '1506389446superadmin.jpg', 'image/jpeg', 'Gambar Identitas Super Admin'),
('1508740699', '1508740699maziz13.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1509287426', '1509287426mgilang123.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1509287533', '1509287533askldfj.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1509287802', '1509287802lkskladjfl.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1509289257', '1509289257alaksdjf.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1509289323', '1509289323sdkljfoweiljsfdio.jpg', 'image/jpeg', 'Gambar Identitas User'),
('1509290009', '1509290009asdfsdf.jpg', 'image/jpeg', 'Gambar Identitas User'),
('oRB5DOWe', 'oRB5DOWe.png', 'image/png', 'Gambar Pohon'),
('1510028374', '1510028374fathi13.jpg', 'image/jpeg', 'Gambar Identitas User'),
('fFio96nq', 'fFio96nq.jpg', 'image/jpeg', 'Gambar Pohon'),
('9JmmcZNp', '9JmmcZNp.png', 'image/png', 'Gambar Pohon'),
('LSv0wl16', 'LSv0wl16.jpg', 'image/jpeg', 'Gambar Pohon'),
('nGhQgd8j', 'nGhQgd8j.jpg', 'image/jpeg', 'Gambar Pohon'),
('YlfFHM6N', 'YlfFHM6N.jpg', 'image/jpeg', 'Gambar Pohon'),
('1510324578', '1510324578fafan21.jpg', 'image/jpeg', 'Gambar Identitas Admin'),
('InaC5Jf4', 'InaC5Jf4.jpg', 'image/jpeg', 'Gambar Pohon'),
('Fo6OmQPr', 'Fo6OmQPr.jpg', 'image/jpeg', 'Gambar Pohon'),
('Kfrarutv', 'Kfrarutv.jpg', 'image/jpeg', 'Gambar Pohon'),
('P0gP34Af', 'P0gP34Af.jpg', 'image/jpeg', 'Gambar Pohon'),
('Pn5QDmfq', 'Pn5QDmfq.jpg', 'image/jpeg', 'Gambar Pohon'),
('nDQXl2oR', 'nDQXl2oR.jpg', 'image/jpeg', 'Gambar Pohon'),
('1515311995', '1515311995admin.png', 'image/png', 'Gambar Identitas User'),
('39DzelFr', '39DzelFr.jpg', 'image/jpeg', 'Gambar Pohon'),
('1515377433', '1515377433admins.png', 'image/png', 'Gambar Identitas User'),
('hBPBNZAL', 'hBPBNZAL.png', 'image/png', 'Gambar Pohon'),
('sGsQzh7Y', 'sGsQzh7Y.png', 'image/png', 'Gambar Pohon');

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
  `salt` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nama_gambar` varchar(50) NOT NULL,
  `id_pertanyaan` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `username`, `password`, `alamat`, `gender`, `job`, `salt`, `nama_gambar`, `id_pertanyaan`) VALUES
('1515377433', 'Muhammad FG', 'tugasakhirgilang@gmail.com', 'admins', '3b050a86194765037754bc26f3b4c9b35c082dd5', 'sdlkfj', 'Male', 'Ilmuwan', 'EeH6Asff', '1515377433admins.png', ''),
('1510028374', 'Muhammad Fathi Salam', 'kerengilang0@gmail.com', 'fathi13', 'fa2210c0c6a21b0f46307309d0943cf574db32ed', 'laskdjflksadjf', 'Male', 'Ilmuwan', '!nkdLoha', '1510028374fathi13.jpg', ''),
('1515311995', 'Muhammad Admin', 'achilgilang@gmail.com', 'admin', 'cfac940ebf027a6570052aebb64c3b41eb5cee11', 'laksdjf', 'Male', 'Ilmuwan', 'kCkvhZ5r', '1515311995admin.png', ''),
('1512738362', 'xs4bl9', 'syupyan@gmail.com', 'xs4bl9', '382e0b336d409f044ea81f44dbf5697d0365b955', 'ipeyeye', 'Male', 'Ilmuwan', 'XB9JxfYL', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

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
-- Indexes for table `pesan-admin`
--
ALTER TABLE `pesan-admin`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens-admin`
--
ALTER TABLE `tokens-admin`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `captcha_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tokens-admin`
--
ALTER TABLE `tokens-admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
