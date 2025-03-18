-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Mar 2025 pada 19.02
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
  `denda` int(11) DEFAULT NULL,
  `batas_waktu_bayar` date DEFAULT NULL,
  `status_bayar` enum('Belum Lunas','Lunas') DEFAULT 'Belum Lunas',
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id`, `invoice`, `jumlah_tagihan`, `denda`, `batas_waktu_bayar`, `status_bayar`, `tanggal_pembayaran`, `bukti_bayar`, `created_at`, `updated_at`) VALUES
(7, 'INVOICE-202503176994-032025', 0.00, NULL, '2025-03-21', 'Lunas', '2025-03-18 00:00:00', 'uploads/bukti_bayar/bukti_202503176994_1742231387.png', '2025-03-17 17:17:06', '2025-03-17 17:17:06'),
(8, 'INVOICE-202503176994-042025', 500000.00, 100000, '2025-04-20', 'Lunas', '2025-03-18 23:13:53', '1742314433_dd0372e80b58b9f953b3.png', '2025-03-17 17:23:12', '2025-03-18 18:00:16');

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
(19, 'PENGGUNA-2025-0010', '202503133150', '3320051000100010011', 'Test Pembayaran', '01', '01', 'Melati', '08888888', NULL, 'aktif'),
(21, 'PENGGUNA-2025-0011', '202503176994', 'farid@gmail.com', 'farid', '1', '1', 'Sukolilo', '0895426290208', '1742229952_0940ddaa827e81322d45.png', 'aktif');

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
(12, 'Test', 'Test', 'pengguna,petugas', '2025-03-01 14:49:35', '2025-03-02', '2025-03-09'),
(13, 'Test Pengguna', 'Hay Pengguna', 'pengguna', '2025-03-18 17:20:15', '2025-03-19', '2025-03-31');

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
(3, '202503176994', 'PETUGAS-2025-0001', 'uploads/survey/202503176994_1742231347.jpg', '2025-03-17', 'sudah disurvey', '2025-03-18', '2025-03-17 16:59:40', '2025-03-17 17:09:07');

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
  `jumlah_pakai` int(11) DEFAULT NULL,
  `jumlah_tagihan` decimal(10,2) NOT NULL,
  `periode_bulan` int(11) NOT NULL,
  `periode_tahun` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `invoice`, `id_meteran`, `meteran_awal`, `meteran_akhir`, `jumlah_pakai`, `jumlah_tagihan`, `periode_bulan`, `periode_tahun`, `created_at`, `updated_at`) VALUES
(8, 'INVOICE-202503176994-032025', '202503176994', 0, 0, 0, 0.00, 3, 2025, '2025-03-17 17:17:06', '2025-03-17 17:17:06'),
(11, 'INVOICE-202503176994-042025', '202503176994', 0, 5, 5, 500000.00, 4, 2025, '2025-03-17 17:23:12', '2025-03-17 17:23:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_awal`
--

CREATE TABLE `transaksi_awal` (
  `id` int(11) NOT NULL,
  `id_meteran` varchar(50) NOT NULL,
  `nominal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status_bayar` enum('belum bayar','sudah bayar') DEFAULT 'belum bayar',
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_awal`
--

INSERT INTO `transaksi_awal` (`id`, `id_meteran`, `nominal`, `status_bayar`, `tanggal_pembayaran`, `bukti_bayar`, `created_at`, `updated_at`) VALUES
(3, '202503176994', 500000.00, 'sudah bayar', '2025-03-19 00:59:11', 'uploads/bukti_bayar/bukti_202503176994_1742231387.png', '2025-03-17 16:45:52', '2025-03-18 17:59:11');

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
('testmeteran@gmail.com', '$2y$10$zsP.UQ7iuHOktpcSzplgheeBx1hopOGaeVrNuKnUib5.QtyDJGr9G', 3, 'PENGGUNA-2025-0010'),
('farid@gmail.com', '$2y$10$hXAIXt7xQRMpPttqGTaZTO9x/iFacTXxNA05cOgEIv7b4xXmVc9bC', 3, 'PENGGUNA-2025-0011'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `transaksi_awal`
--
ALTER TABLE `transaksi_awal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
