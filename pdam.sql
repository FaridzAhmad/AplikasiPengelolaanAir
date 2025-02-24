-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 08:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `rt` varchar(10) DEFAULT NULL,
  `rw` varchar(10) DEFAULT NULL,
  `desa_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `users_id`, `nama`, `rt`, `rw`, `desa_id`, `kecamatan_id`, `no_hp`, `foto`) VALUES
(4, 2, 'Budi', '01', '01', 4, 6, '0888', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE `desa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kecamatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`id`, `nama`, `kecamatan_id`) VALUES
(1, 'Prawoto', 1),
(2, 'Pakem', 1),
(3, 'Wegil', 1),
(4, 'Kuwawur', 1),
(5, 'Baleadi', 1),
(6, 'Wotan', 1),
(7, 'Kedungwinong', 1),
(8, 'Porangparing', 1),
(9, 'Sukolilo', 1),
(10, 'Baturejo', 1),
(11, 'Gadudero', 1),
(12, 'Sumbersoko', 1),
(13, 'Tompegunung', 1),
(14, 'Kedumulyo', 1),
(15, 'Kasiyan', 1),
(16, 'Cengkalsewu', 1),
(17, 'Jimbaran', 2),
(18, 'Durensawit', 2),
(19, 'Slungkep', 2),
(20, 'Beketel', 2),
(21, 'Purwokerto', 2),
(22, 'Sumbersari', 2),
(23, 'Brati', 2),
(24, 'Jatiroto', 2),
(25, 'Kayen', 2),
(26, 'Rogomulyo', 2),
(27, 'Srikaton', 2),
(28, 'Pasuruhan', 2),
(29, 'Pesagi', 2),
(30, 'Trimulyo', 2),
(31, 'Talun', 2),
(32, 'Boloagung', 2),
(33, 'Sundoluhur', 2),
(34, 'Pakis', 3),
(35, 'Maitan', 3),
(36, 'Wukirsari', 3),
(37, 'Sinomwidodo', 3),
(38, 'Keben', 3),
(39, 'Larangan', 3),
(40, 'Tambakromo', 3),
(41, 'Mojomulyo', 3),
(42, 'Karangawen', 3),
(43, 'Mangunrekso', 3),
(44, 'Tambaharjo', 3),
(45, 'Tambahagung', 3),
(46, 'Sitirejo', 3),
(47, 'Kedalingan', 3),
(48, 'Karangmulyo', 3),
(49, 'Karangwono', 3),
(50, 'Angkatan Lor', 3),
(51, 'Angkatan Kidul', 3),
(52, 'Pohgading', 4),
(53, 'Gunungpanti', 4),
(54, 'Godo', 4),
(55, 'Kropak', 4),
(56, 'Karangsumber', 4),
(57, 'Guyangan', 4),
(58, 'Sugihan', 4),
(59, 'Kebolampang', 4),
(60, 'Tlogorejo', 4),
(61, 'Pagendisan', 4),
(62, 'Pekalongan', 4),
(63, 'Danyangmulyo', 4),
(64, 'Kudur', 4),
(65, 'Padangan', 4),
(66, 'Blingijati', 4),
(67, 'Mintorahayu', 4),
(68, 'Kebowan', 4),
(69, 'Winong', 4),
(70, 'Klecoregonang', 4),
(71, 'Bumiharjo', 4),
(72, 'Tawangrejo', 4),
(73, 'Bringinwareng', 4),
(74, 'Sumbermulyo', 4),
(75, 'Degan', 4),
(76, 'Serutsadang', 4),
(77, 'Pulorejo', 4),
(78, 'Karangkonang', 4),
(79, 'Tanggel', 4),
(80, 'Wirun', 4),
(81, 'Sarimulyo', 4),
(82, 'Bodeh', 5),
(83, 'Karangwotan', 5),
(84, 'Kepohkencono', 5),
(85, 'Wateshaji', 5),
(86, 'Lumbungmas', 5),
(87, 'Mojoagung', 5),
(88, 'Sitimulyo', 5),
(89, 'Kletek', 5),
(90, 'Terteg', 5),
(91, 'Mencon', 5),
(92, 'Puncakwangi', 5),
(93, 'Pelemgede', 5),
(94, 'Tanjungsekar', 5),
(95, 'Triguno', 5),
(96, 'Jetak', 5),
(97, 'Grogolsari', 5),
(98, 'Karangrejo', 5),
(99, 'Plosorejo', 5),
(100, 'Sokopuluhan', 5),
(101, 'Tegalwero', 5),
(102, 'Boto', 6),
(103, 'Trikoyo', 6),
(104, 'Sumberan', 6),
(105, 'Mojolampir', 6),
(106, 'Mantingan', 6),
(107, 'Ronggo', 6),
(108, 'Sumberagung', 6),
(109, 'Sidoluhur', 6),
(110, 'Srikaton', 6),
(111, 'Arumanis', 6),
(112, 'Tegalarum', 6),
(113, 'Sidomukti', 6),
(114, 'Mojoluhur', 6),
(115, 'Kebonturi', 6),
(116, 'Lundo', 6),
(117, 'Sukorukun', 6),
(118, 'Sumberejo', 6),
(119, 'Manjang', 6),
(120, 'Tamansari', 6),
(121, 'Sumberarum', 6),
(122, 'Sriwedari', 6),
(123, 'Tlogomojo', 7),
(124, 'Ngening', 7),
(125, 'Raci', 7),
(126, 'Ketitangwetan', 7),
(127, 'Bumimulyo', 7),
(128, 'Jembangan', 7),
(129, 'Klayusiwalan', 7),
(130, 'Bulumulyo', 7),
(131, 'Sukoagung', 7),
(132, 'Tompomulyo', 7),
(133, 'Kuniran', 7),
(134, 'Gunungsari', 7),
(135, 'Kedalon', 7),
(136, 'Gajahkumpul', 7),
(137, 'Batursari', 7),
(138, 'Lengkong', 7),
(139, 'Mangunlegi', 7),
(140, 'Pecangaan', 7),
(141, 'Sejomulyo', 8),
(142, 'Bringin', 8),
(143, 'Ketip', 8),
(144, 'Pekuwon', 8),
(145, 'Karang', 8),
(146, 'Karangrejo', 8),
(147, 'Bumirejo', 8),
(148, 'Kedungpancing', 8),
(149, 'Jepuro', 8),
(150, 'Tluwah', 8),
(151, 'Doropayung', 8),
(152, 'Mintomulyo', 8),
(153, 'Gadingrejo', 8),
(154, 'Margomulyo', 8),
(155, 'Langgenharjo', 8),
(156, 'Genengmulyo', 8),
(157, 'Agungmulyo', 8),
(158, 'Bakaran Kulon', 8),
(159, 'Bakaran Wetan', 8),
(160, 'Dukutalit', 8),
(161, 'Growong Kidul', 8),
(162, 'Growong Lor', 8),
(163, 'Kauman', 8),
(164, 'Pajeksan', 8),
(165, 'Kudukeras', 8),
(166, 'Kebonsawahan', 8),
(167, 'Bajomulyo', 8),
(168, 'Bendar', 8),
(169, 'Trimulyo', 8),
(170, 'Kedungmulyo', 9),
(171, 'Ngastorejo', 9),
(172, 'Karangrowo', 9),
(173, 'Sonorejo', 9),
(174, 'Sendangsoko', 9),
(175, 'Tlogorejo', 9),
(176, 'Sidoarum', 9),
(177, 'Tondomulyo', 9),
(178, 'Bungasrejo', 9),
(179, 'Glonggong', 9),
(180, 'Kalimulyo', 9),
(181, 'Tambahmulyo', 9),
(182, 'Tondokerto', 9),
(183, 'Sembaturagung', 9),
(184, 'Dukuhmulyo', 9),
(185, 'Puluhan Tengah', 9),
(186, 'Mantingan Tengah', 9),
(187, 'Jatisari', 9),
(188, 'Karangrejo Lor', 9),
(189, 'Sidomulyo', 9),
(190, 'Tanjungsari', 9),
(191, 'Jakenan', 9),
(192, 'Plosojenar', 9),
(193, 'Pati Wetan', 10),
(194, 'Pati Kidul', 10),
(195, 'Pati Lor', 10),
(196, 'Parenggan', 10),
(197, 'Kalidoro', 10),
(198, 'Panjunan', 10),
(199, 'Gajahmati', 10),
(200, 'Mustokoharjo', 10),
(201, 'Semampir', 10),
(202, 'Blaru', 10),
(203, 'Plangitan', 10),
(204, 'Puri', 10),
(205, 'Winong', 10),
(206, 'Ngarus', 10),
(207, 'Sidoharjo', 10),
(208, 'Sarirejo', 10),
(209, 'Geritan', 10),
(210, 'Dengkek', 10),
(211, 'Sugiharjo', 10),
(212, 'Widorokandang', 10),
(213, 'Payang', 10),
(214, 'Kutoharjo', 10),
(215, 'Sidokerto', 10),
(216, 'Mulyoharjo', 10),
(217, 'Tambaharjo', 10),
(218, 'Tambahsari', 10),
(219, 'Ngepungrojo', 10),
(220, 'Purworejo', 10),
(221, 'Sinoman', 10),
(222, 'Wuwur', 11),
(223, 'Karaban', 11),
(224, 'Tlogoayu', 11),
(225, 'Bogotanjung', 11),
(226, 'Kuryokalangan', 11),
(227, 'Gabus', 11),
(228, 'Tanjunganom', 11),
(229, 'Sunggingwarno', 11),
(230, 'Penanggungan', 11),
(231, 'Tambahmulyo', 11),
(232, 'Sugihrejo', 11),
(233, 'Mojolawaran', 11),
(234, 'Sambirejo', 11),
(235, 'Pantirejo', 11),
(236, 'Tanjang', 11),
(237, 'Gebang', 11),
(238, 'Plumbungan', 11),
(239, 'Babalan', 11),
(240, 'Koripandriyo', 11),
(241, 'Soko', 11),
(242, 'Gempolsari', 11),
(243, 'Banjarsari', 11),
(244, 'Mintobasuki', 11),
(245, 'Kosekan', 11),
(246, 'Jambean Kidul', 12),
(247, 'Wangunrejo', 12),
(248, 'Bumirejo', 12),
(249, 'Sokokulon', 12),
(250, 'Jimbaran', 12),
(251, 'Ngawen', 12),
(252, 'Margorejo', 12),
(253, 'Penambuhan', 12),
(254, 'Langenharjo', 12),
(255, 'Dadirejo', 12),
(256, 'Sukoharjo', 12),
(257, 'Badegan', 12),
(258, 'Pegandan', 12),
(259, 'Sokobubuk', 12),
(260, 'Banyuurip', 12),
(261, 'Mataraman', 12),
(262, 'Langse', 12),
(263, 'Muktiharjo', 12),
(264, 'Bermi', 13),
(265, 'Kedungbulus', 13),
(266, 'Semirejo', 13),
(267, 'Wonosekar', 13),
(268, 'Gembong', 13),
(269, 'Plukaran', 13),
(270, 'Bageng', 13),
(271, 'Pohgading', 13),
(272, 'Klakahkasihan', 13),
(273, 'Ketanggan', 13),
(274, 'Sitiluhur', 13),
(275, 'Tamansari', 14),
(276, 'Sambirejo', 14),
(277, 'Tlogorejo', 14),
(278, 'Purwosari', 14),
(279, 'Regaloh', 14),
(280, 'Wonorejo', 14),
(281, 'Tlogosari', 14),
(282, 'Sumbermulyo', 14),
(283, 'Guwo', 14),
(284, 'Tanjungsari', 14),
(285, 'Lahar', 14),
(286, 'Suwatu', 14),
(287, 'Cabak', 14),
(288, 'Klumpit', 14),
(289, 'Gunungsari', 14),
(290, 'Bumiayu', 15),
(291, 'Margorejo', 15),
(292, 'Tawangharjo', 15),
(293, 'Ngurensiti', 15),
(294, 'Sukoharjo', 15),
(295, 'Panggungroyom', 15),
(296, 'Jontro', 15),
(297, 'Suwaduk', 15),
(298, 'Wedarijaksa', 15),
(299, 'Pagerharjo', 15),
(300, 'Ngurenrejo', 15),
(301, 'Bangsalrejo', 15),
(302, 'Sidoharjo', 15),
(303, 'Jetak', 15),
(304, 'Jatimulyo', 15),
(305, 'Tlogoharum', 15),
(306, 'Kepoh', 15),
(307, 'Tluwuk', 15),
(308, 'Tegalarum', 16),
(309, 'Soneyan', 16),
(310, 'Tanjungrejo', 16),
(311, 'Sidomukti', 16),
(312, 'Pohijo', 16),
(313, 'Kertomulyo', 16),
(314, 'Langgenharjo', 16),
(315, 'Pangkalan', 16),
(316, 'Bulumanis Kidul', 16),
(317, 'Bulumanis Lor', 16),
(318, 'Sekarjalak', 16),
(319, 'Kajen', 16),
(320, 'Ngemplak Kidul', 16),
(321, 'Purworejo', 16),
(322, 'Purwodadi', 16),
(323, 'Ngemplak Lor', 16),
(324, 'Waturoyo', 16),
(325, 'Cebolek Kidul', 16),
(326, 'Tunjungrejo', 16),
(327, 'Margoyoso', 16),
(328, 'Margotohu Kidul', 16),
(329, 'Semerak', 16),
(330, 'Jrahi', 17),
(331, 'Giling', 17),
(332, 'Gulangpongge', 17),
(333, 'Jepalo', 17),
(334, 'Sidomulyo', 17),
(335, 'Sampok', 17),
(336, 'Pesagen', 17),
(337, 'Gadu', 17),
(338, 'Gajihan', 17),
(339, 'Perdopo', 17),
(340, 'Gunungwungkal', 17),
(341, 'Bancak', 17),
(342, 'Jembulwunut', 17),
(343, 'Ngetuk', 17),
(344, 'Sumberrejo', 17),
(345, 'Medani', 18),
(346, 'Sentul', 18),
(347, 'Plaosan', 18),
(348, 'Payak', 18),
(349, 'Sirahan', 18),
(350, 'Mojo', 18),
(351, 'Karangsari', 18),
(352, 'Bleber', 18),
(353, 'Ngawen', 18),
(354, 'Ngablak', 18),
(355, 'Gesengan', 18),
(356, 'Gerit', 18),
(357, 'Sumur', 18),
(358, 'Pondowan', 19),
(359, 'Kedungsari', 19),
(360, 'Margomulyo', 19),
(361, 'Pakis', 19),
(362, 'Sendangrejo', 19),
(363, 'Jepat Kidul', 19),
(364, 'Tunggulsari', 19),
(365, 'Jepat Lor', 19),
(366, 'Tendas', 19),
(367, 'Keboromo', 19),
(368, 'Sambiroto', 19),
(369, 'Tayu Wetan', 19),
(370, 'Tayu Kulon', 19),
(371, 'Pundenrejo', 19),
(372, 'Kedungbang', 19),
(373, 'Bendokaton Kidul', 19),
(374, 'Purwokerto', 19),
(375, 'Bulungan', 19),
(376, 'Luwang', 19),
(377, 'Dororejo', 19),
(378, 'Kalikalong', 19),
(379, 'Wedusan', 20),
(380, 'Dumpil', 20),
(381, 'Ngagel', 20),
(382, 'Bakalan', 20),
(383, 'Kenanti', 20),
(384, 'Alasdowo', 20),
(385, 'Banyutowo', 20),
(386, 'Dukuhseti', 20),
(387, 'Grogolan', 20),
(388, 'Kembang', 20),
(389, 'Tegalombo', 20),
(390, 'Puncel', 20),
(391, 'Kajar', 21),
(392, 'Trangkil', 21),
(393, 'Pasucen', 21),
(394, 'Tegalharjo', 21),
(395, 'Mojoagung', 21),
(396, 'Ketanen', 21),
(397, 'Karanglegi', 21),
(398, 'Karangwage', 21),
(399, 'Kadilangu', 21),
(400, 'Tlutup', 21),
(401, 'Krandan', 21),
(402, 'Kertomulyo', 21),
(403, 'Rejoagung', 21),
(404, 'Guyangan', 21),
(405, 'Sambilawang', 21),
(406, 'Asempapan', 21);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama`) VALUES
(1, 'Sukolilo'),
(2, 'Kayen'),
(3, 'Tambakromo'),
(4, 'Winong'),
(5, 'Pucakwangi'),
(6, 'Jaken'),
(7, 'Batangan'),
(8, 'Juwana'),
(9, 'Jakenan'),
(10, 'Pati'),
(11, 'Gabus'),
(12, 'Margorejo'),
(13, 'Gembong'),
(14, 'Tlogowungu'),
(15, 'Wedarijaksa'),
(16, 'Margoyoso'),
(17, 'Gunungwungkal'),
(18, 'Cluwak'),
(19, 'Tayu'),
(20, 'Dukuhseti'),
(21, 'Trangkil');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `rt` varchar(10) DEFAULT NULL,
  `rw` varchar(10) DEFAULT NULL,
  `desa_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `users_id`, `nama`, `rt`, `rw`, `desa_id`, `kecamatan_id`, `no_hp`, `foto`) VALUES
(1, 4, 'Siti Aminah', '03', '04', 5, 10, '081298765432', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `users_id`, `nama`, `nip`, `no_hp`, `foto`) VALUES
(1, 3, 'Ahmad Fauzi', '1987654321', '081234567890', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama`) VALUES
(1, 'admin'),
(2, 'petugas'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `roles_id`) VALUES
(2, 'admin@gmail.com', '$2y$10$lj3WOc/2LAOeRRWR8pyfPO3dc7l9QxlzDg.ZTVrMdOwA6Cp5gMgMi', 1),
(3, 'petugas@gmail.com', '$2y$10$L3fIe2tT8apphzWAVouq5e5TeWeiA5b4v1XgxwskIcyVHj.027WGu', 2),
(4, 'user@gmail.com', '$2y$10$gNkrXLO4kw.HiFPeT.hnUuPGeeNLVYcJEzjvEQaSPmKEwwVp38BO6', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `desa_id` (`desa_id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`);

--
-- Indexes for table `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roles_id` (`roles_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `desa`
--
ALTER TABLE `desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331822;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_ibfk_3` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `desa`
--
ALTER TABLE `desa`
  ADD CONSTRAINT `desa_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
