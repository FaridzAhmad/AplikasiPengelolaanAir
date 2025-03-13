-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Mar 2025 pada 18.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `users_id` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `rt` varchar(10) DEFAULT NULL,
  `rw` varchar(10) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `users_id`, `nama`, `rt`, `rw`, `alamat`, `no_hp`, `foto`) VALUES
(4, 'ADMIN-2025-0001', 'Budi', '01', '01', '', '0888', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `jumlah_tagihan` decimal(10,2) NOT NULL,
  `status_bayar` enum('Belum Lunas','Lunas') DEFAULT 'Belum Lunas',
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id`, `invoice`, `jumlah_tagihan`, `status_bayar`, `tanggal_pembayaran`, `bukti_bayar`, `created_at`, `updated_at`) VALUES
(3, 'INVOICE-202503133150-032025', 0.00, 'Lunas', '2025-03-13 00:00:00', 'uploads/bukti_bayar/bukti_202503133150_1741882633.jpg', '2025-03-13 16:51:18', '2025-03-13 16:51:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluhan`
--

CREATE TABLE `keluhan` (
  `id` int(11) NOT NULL,
  `id_meteran` varchar(20) NOT NULL,
  `keluhan` text NOT NULL,
  `petugas` int(11) DEFAULT NULL,
  `status` enum('review','ditolak','diterima') DEFAULT 'review',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keluhan`
--

INSERT INTO `keluhan` (`id`, `id_meteran`, `keluhan`, `petugas`, `status`, `created_at`, `foto`) VALUES
(1, '202502278322', 'Rusakk', NULL, 'review', '2025-03-03 09:37:03', ''),
(2, '202502274465', 'amoh de', NULL, 'review', '2025-03-03 09:46:38', '1741020398_02998ba099f247da2cfc.png'),
(3, '202502274465', 'mampet', NULL, 'review', '2025-03-03 16:48:43', '1741020523_49f0030ac2a61375f963.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemutusan`
--

CREATE TABLE `pemutusan` (
  `id` int(11) NOT NULL,
  `id_meteran` varchar(20) NOT NULL,
  `alasan` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` enum('pending','disetujui') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemutusan`
--

INSERT INTO `pemutusan` (`id`, `id_meteran`, `alasan`, `created_at`, `status`) VALUES
(1, '202502278321', 'Mahal', '2025-03-02 03:00:24', 'disetujui'),
(2, '202502278501', 'Tidak Ramah', '2025-03-02 15:31:27', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `users_id` varchar(50) NOT NULL,
  `id_meteran` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `rt` varchar(10) DEFAULT NULL,
  `rw` varchar(10) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status_meteran` enum('aktif','belum aktif','putus') NOT NULL DEFAULT 'belum aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `users_id`, `id_meteran`, `nik`, `nama`, `rt`, `rw`, `alamat`, `no_hp`, `foto`, `status_meteran`) VALUES
(1, 'PENGGUNA-2025-0005', '202502278321', '3320051000100003', 'Siti Aminah', '03', '04', 'Gembong', '081298765432', NULL, 'putus'),
(7, 'PENGGUNA-2025-0006', '202502278322', '33200510001000100', 'farid', '1', '1', 'Sukolilo ', '08954262902058', '1740678430_0d2b87f34e927c5ac386.png', 'aktif'),
(8, 'PENGGUNA-2025-0007', '202502274465', '3201010101010001', 'Ahmad Rozak', '01', '02', 'Jl. Merdeka No.1', '081234567890', 'ahmad.jpg', 'aktif'),
(9, 'PENGGUNA-2025-0001', '202502279297', '3201010101010002', 'Budi Santoso', '02', '03', 'Jl. Sudirman No.2', '081234567891', 'budi.jpg', 'belum aktif'),
(10, 'PENGGUNA-2025-0002', '202502273089', '3201010101010003', 'Citra Dewi', '03', '04', 'Jl. Diponegoro No.3', '081234567892', 'citra.jpg', 'aktif'),
(11, 'PENGGUNA-2025-0003', '202502277553', '3201010101010004', 'David Wijaya', '04', '05', 'Jl. Hasanuddin No.4', '081234567893', 'david.jpg', 'putus'),
(12, 'PENGGUNA-2025-0004', '202502278501', '3201010101010005', 'Eka Sari', '05', '06', 'Jl. Ahmad Yani No.5', '081234567894', 'eka.jpg', 'aktif'),
(16, 'PENGGUNA-2025-0008', '202503054153', '3320051000100011', 'Firman', '01', '01', 'Kayen', '0888881', '1741110398_f612efebed27bf673e49.png', 'belum aktif'),
(18, 'PENGGUNA-2025-0009', '202503073263', '33200510001000199', 'Test', '1', '1', 'Kajen', '0888881', '1741285560_0811194cf4adccf59a7b.png', 'belum aktif'),
(19, 'PENGGUNA-2025-0010', '202503133150', '3320051000100010011', 'Test Pembayaran', '01', '01', 'Melati', '08888888', NULL, 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `target` set('pengguna','petugas') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `awal_berlaku` date NOT NULL,
  `akhir_berlaku` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `target`, `created_at`, `awal_berlaku`, `akhir_berlaku`) VALUES
(12, 'Test', 'Test', 'pengguna,petugas', '2025-03-01 14:49:35', '2025-03-02', '2025-03-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `users_id` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `users_id`, `nama`, `alamat`, `no_hp`, `foto`) VALUES
(1, 'PETUGAS-2025-0001', 'Ahmad Fauzi', 'Gembong', '081234567890', NULL),
(3, 'PETUGAS-2025-0002', 'Firman', 'Melati', '088818181', '1741277711_97c259ebb0ab2816011a.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `nama`) VALUES
(1, 'admin'),
(2, 'petugas'),
(3, 'user'),
(4, 'teknisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `survey_awal`
--

CREATE TABLE `survey_awal` (
  `id` int(11) NOT NULL,
  `id_meteran` varchar(20) NOT NULL,
  `petugas` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal_penugasan` date NOT NULL,
  `status` enum('belum disurvey','sudah disurvey') DEFAULT 'belum disurvey',
  `tanggal_survey` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `survey_awal`
--

INSERT INTO `survey_awal` (`id`, `id_meteran`, `petugas`, `foto`, `tanggal_penugasan`, `status`, `tanggal_survey`, `created_at`, `updated_at`) VALUES
(1, '202502273089', 'PETUGAS-2025-0001', 'uploads/survey/202502273089_1741874865.png', '2025-03-12', 'sudah disurvey', '2025-03-13', '2025-03-11 19:18:11', '2025-03-13 14:07:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teknisi`
--

CREATE TABLE `teknisi` (
  `id` int(11) NOT NULL,
  `users_id` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `teknisi`
--

INSERT INTO `teknisi` (`id`, `users_id`, `nama`, `alamat`, `no_hp`, `foto`) VALUES
(2, 'TEKNISI-2025-0001', 'Teknisi', 'gissaisad', '823431', '1741451708_bb53001954e947f1a097.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `id_meteran` varchar(50) NOT NULL,
  `meteran_awal` int(11) NOT NULL,
  `meteran_akhir` int(11) NOT NULL,
  `jumlah_pakai` int(11) GENERATED ALWAYS AS (`meteran_akhir` - `meteran_awal`) STORED,
  `jumlah_tagihan` decimal(10,2) NOT NULL,
  `periode_bulan` int(11) NOT NULL,
  `periode_tahun` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `invoice`, `id_meteran`, `meteran_awal`, `meteran_akhir`, `jumlah_tagihan`, `periode_bulan`, `periode_tahun`, `created_at`, `updated_at`) VALUES
(4, 'INVOICE-202503133150-032025', '202503133150', 0, 0, 0.00, 3, 2025, '2025-03-13 16:51:18', '2025-03-13 16:51:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_awal`
--

CREATE TABLE `transaksi_awal` (
  `id` int(11) NOT NULL,
  `id_meteran` varchar(50) NOT NULL,
  `nominal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status_bayar` enum('belum bayar','sudah bayar') DEFAULT 'belum bayar',
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_awal`
--

INSERT INTO `transaksi_awal` (`id`, `id_meteran`, `nominal`, `status_bayar`, `bukti_bayar`, `tanggal_pembayaran`, `created_at`, `updated_at`) VALUES
(1, '202503133150', 500000.00, 'sudah bayar', 'uploads/bukti_bayar/bukti_202503133150_1741882633.jpg', '2025-03-13 23:51:18', '2025-03-13 14:42:40', '2025-03-13 16:51:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`email`, `password`, `roles_id`, `id`) VALUES
('admin@gmail.com', '$2y$10$lj3WOc/2LAOeRRWR8pyfPO3dc7l9QxlzDg.ZTVrMdOwA6Cp5gMgMi', 1, 'ADMIN-2025-0001'),
('budi@gmail.com', '$2y$10$HUbeQa/CqaBneLJYbXhhfORopHexEyJnNG4b3TlBv9178.vtne6XC', 3, 'PENGGUNA-2025-0001'),
('citra@gmail.com', '$2y$10$quXPwn/DKehKUsv4XtYRo.EMYx5cSr6DOpaNOhQzw0bJvBJt7pVeu', 3, 'PENGGUNA-2025-0002'),
('david@gmail.com', '$2y$10$T.aCH8UkQ4o8RcfK8K4Z4epE2mtIxAZ0EmbaG5KmhBOovmmEugSOu', 3, 'PENGGUNA-2025-0003'),
('eka@gmail.com', '$2y$10$Ya8FnTNGw/Hp7rQJFH8WreB9iZ.iadKhgjpopFm/Q4AFnoWomZY.6', 3, 'PENGGUNA-2025-0004'),
('user@gmail.com', '$2y$10$gNkrXLO4kw.HiFPeT.hnUuPGeeNLVYcJEzjvEQaSPmKEwwVp38BO6', 3, 'PENGGUNA-2025-0005'),
('farid@gmail.com', '$2y$10$F4iyQLMA/P5D7kw/VKXvK.1DEtYHOy.FSB/zCpgQwMb/OuOWIW/sC', 3, 'PENGGUNA-2025-0006'),
('ahmad@gmail.com', '$2y$10$tBuWqQd5kPqD66BrvuJtxOvMTKqVOJTG/M6i6jUJjoQ/cCYcsA7k.', 3, 'PENGGUNA-2025-0007'),
('firman@gmail.com', '$2y$10$ztkX0ZohRlPyVTCDfboyz.fMWzcE.1MjN81XgtBDQzeDPjMLOQJzy', 3, 'PENGGUNA-2025-0008'),
('test@gmail.com', '$2y$10$4o/ZWk.y/C/8E8dYRanPguF9EaedxnCtpE.0LeMKPQ1bHeQpYvJae', 3, 'PENGGUNA-2025-0009'),
('testmeteran@gmail.com', '$2y$10$zsP.UQ7iuHOktpcSzplgheeBx1hopOGaeVrNuKnUib5.QtyDJGr9G', 3, 'PENGGUNA-2025-0010'),
('petugas@gmail.com', '$2y$10$L3fIe2tT8apphzWAVouq5e5TeWeiA5b4v1XgxwskIcyVHj.027WGu', 2, 'PETUGAS-2025-0001'),
('firmanpetugas@gmail.com', '$2y$10$R7LFQ/KhDH1VWqVeX4YnvehRYyQAH9IdFwNirUpHK3BAAQh83.h2q', 2, 'PETUGAS-2025-0002'),
('teknisi@gmail.com', '$2y$10$UZ7NRun7wKEXFuzsedRmf.cvt4/HKt9v.7LFmOz.VdjxnxfGRRjmW', 4, 'TEKNISI-2025-0001');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_ibfk_1` (`users_id`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice_transaksi` (`invoice`);

--
-- Indeks untuk tabel `keluhan`
--
ALTER TABLE `keluhan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petugas` (`petugas`),
  ADD KEY `fk_keluhan_pengguna` (`id_meteran`);

--
-- Indeks untuk tabel `pemutusan`
--
ALTER TABLE `pemutusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pemutusan_pengguna` (`id_meteran`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_meteran` (`id_meteran`),
  ADD UNIQUE KEY `id_meteran_2` (`id_meteran`),
  ADD KEY `pengguna_ibfk_1` (`users_id`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id` (`users_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `survey_awal`
--
ALTER TABLE `survey_awal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_survey_meteran` (`id_meteran`),
  ADD KEY `fk_survey_petugas` (`petugas`);

--
-- Indeks untuk tabel `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid_invoice` (`invoice`),
  ADD KEY `fk_transaksi_pengguna` (`id_meteran`);

--
-- Indeks untuk tabel `transaksi_awal`
--
ALTER TABLE `transaksi_awal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaksi_awal_pengguna` (`id_meteran`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `new_id` (`id`),
  ADD KEY `roles_id` (`roles_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `keluhan`
--
ALTER TABLE `keluhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pemutusan`
--
ALTER TABLE `pemutusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `survey_awal`
--
ALTER TABLE `survey_awal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi_awal`
--
ALTER TABLE `transaksi_awal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_transaksi` FOREIGN KEY (`invoice`) REFERENCES `transaksi` (`invoice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keluhan`
--
ALTER TABLE `keluhan`
  ADD CONSTRAINT `fk_keluhan_pengguna` FOREIGN KEY (`id_meteran`) REFERENCES `pengguna` (`id_meteran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keluhan_ibfk_1` FOREIGN KEY (`petugas`) REFERENCES `petugas` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `pemutusan`
--
ALTER TABLE `pemutusan`
  ADD CONSTRAINT `fk_pemutusan_pengguna` FOREIGN KEY (`id_meteran`) REFERENCES `pengguna` (`id_meteran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `survey_awal`
--
ALTER TABLE `survey_awal`
  ADD CONSTRAINT `fk_survey_meteran` FOREIGN KEY (`id_meteran`) REFERENCES `pengguna` (`id_meteran`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_survey_petugas` FOREIGN KEY (`petugas`) REFERENCES `petugas` (`users_id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `teknisi`
--
ALTER TABLE `teknisi`
  ADD CONSTRAINT `teknisi_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pengguna` FOREIGN KEY (`id_meteran`) REFERENCES `pengguna` (`id_meteran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_awal`
--
ALTER TABLE `transaksi_awal`
  ADD CONSTRAINT `fk_transaksi_awal_pengguna` FOREIGN KEY (`id_meteran`) REFERENCES `pengguna` (`id_meteran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
