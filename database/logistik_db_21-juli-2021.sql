-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 21 Jul 2021 pada 04.07
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistik_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_logistik`
--

CREATE TABLE `barang_logistik` (
  `id_barang` int(3) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(4) NOT NULL,
  `satuan_barang` int(3) NOT NULL,
  `foto_barang` text NOT NULL,
  `qr_code` varchar(50) NOT NULL,
  `user_uploaded` int(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_logistik`
--

INSERT INTO `barang_logistik` (`id_barang`, `kode_barang`, `nama_barang`, `stok`, `satuan_barang`, `foto_barang`, `qr_code`, `user_uploaded`, `created_at`, `updated_at`) VALUES
(13, 'BR001', 'Seragam Dinas', 82, 1, 'c58e14ab1e4e2fc7b7226f3bb2376798.jpeg', 'BR001175.png', 1, '2021-07-14 22:15:41', NULL),
(14, 'BR002', 'Atribut POLRI', 100, 4, 'c125ba8f53f4a35e854b663e2d9a1fc9.jpeg', 'BR002108.png', 1, '2021-07-14 22:16:20', '2021-07-19 16:56:49'),
(15, 'BR031', 'Pistol', 56, 4, 'fe7bc3c76b48763caefd027041932975.jpeg', 'BR03147.png', 1, '2021-07-14 23:17:00', '2021-07-19 16:56:12'),
(16, 'BR012', 'Topi Polisi', 0, 1, 'f553797cf271950e9ed45bca9d0ed646.jpeg', 'BR012151.png', 1, '2021-07-14 23:17:44', NULL),
(17, 'BR034', 'Mobil Patroli', 40, 1, 'a8b036c98e8a0794dff558ade005a5ea.jpeg', 'BR0345.png', 1, '2021-07-14 23:18:34', NULL),
(18, 'BR040', 'Borgol', 67, 1, '3c30b6aa8fdf856347de22ca1e8a8836.jpeg', 'BR04080.png', 1, '2021-07-14 23:19:06', NULL),
(19, 'BR056', 'Perlengkapan Dokpol', 9, 4, '608da67dccac7fe6869790d4ddec028e.jpeg', 'BR056125.png', 1, '2021-07-14 23:19:55', '2021-07-20 08:52:10'),
(20, 'BR88', 'Sepatu Tugas', 70, 4, '23b6a85a3e2177af1764dfa6f2d9a246.jpeg', 'BR88196.png', 1, '2021-07-14 23:20:42', '2021-07-19 16:56:36'),
(21, 'BR010', 'Lemari', 24, 4, 'dd8158aaa2a5c1db37a443cfcf6a13b4.jpeg', 'BR010128.png', 1, '2021-07-14 23:34:26', '2021-07-19 16:56:21'),
(22, 'BR011', 'Laptop', 44, 1, '31f07a0cdb49e987c1f9e7d86c4a41c8.jpeg', 'BR011133.png', 1, '2021-07-14 23:35:00', NULL),
(23, 'BR090', 'POLICE LINE GARIS POLISI SAFETY LINE 2 inch x 300 meter', 10, 4, '7f5ec7525fc1c5cb90f021661a3db122.jpeg', 'BR090146.png', 1, '2021-07-19 16:54:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_transaksi`
--

CREATE TABLE `cart_transaksi` (
  `id_cart` int(3) NOT NULL,
  `surat_jalan` varchar(100) NOT NULL,
  `id_brg` int(3) NOT NULL,
  `jumlah_transaksi` int(4) NOT NULL,
  `jenis_transaksi` enum('keluar','masuk') NOT NULL,
  `status_barang` enum('b','r','h') NOT NULL DEFAULT 'b' COMMENT 'b = Baik, r = Rusak, h = Hilang',
  `keterangan` text NOT NULL DEFAULT '-',
  `status_transaksi` enum('T','F') NOT NULL DEFAULT 'T',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cart_transaksi`
--

INSERT INTO `cart_transaksi` (`id_cart`, `surat_jalan`, `id_brg`, `jumlah_transaksi`, `jenis_transaksi`, `status_barang`, `keterangan`, `status_transaksi`, `created_at`, `updated_at`) VALUES
(16, 'SJ0004', 17, 3, 'keluar', 'r', 'Ban pecah 4 roda', 'F', '2021-07-17 11:57:47', '2021-07-18 16:59:35'),
(17, 'SJ0004', 21, 8, 'keluar', 'b', '-', 'F', '2021-07-17 11:58:06', '2021-07-18 16:59:03'),
(18, 'SJ0004', 20, 2, 'keluar', 'b', '-', 'F', '2021-07-17 14:08:33', '2021-07-18 16:58:27'),
(19, 'SJ0004', 22, 2, 'keluar', 'b', '-', 'F', '2021-07-17 14:09:12', '2021-07-19 07:43:47'),
(28, 'SJ0005', 18, 1, 'keluar', 'b', '-', 'T', '2021-07-18 05:25:30', '2021-07-18 16:45:51'),
(30, 'SJ0005', 14, 1, 'keluar', 'b', '-', 'T', '2021-07-18 05:25:48', '2021-07-18 16:51:16'),
(31, 'SJ0005', 16, 2, 'keluar', 'b', '-', 'T', '2021-07-18 05:27:04', '2021-07-18 16:30:15'),
(35, 'SJ0004', 20, 2, 'masuk', 'b', '-', 'T', '2021-07-18 16:58:27', NULL),
(36, 'SJ0004', 21, 8, 'masuk', 'b', '-', 'T', '2021-07-18 16:59:03', NULL),
(37, 'SJ0004', 17, 3, 'masuk', 'b', '-', 'T', '2021-07-18 16:59:35', NULL),
(38, 'SJ0004', 22, 2, 'masuk', 'b', '-', 'T', '2021-07-19 07:43:47', NULL),
(39, 'SJ0005', 20, 6, 'keluar', 'b', '-', 'T', '2021-07-20 11:02:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_logistik`
--

CREATE TABLE `jenis_logistik` (
  `id_jenis` int(3) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_logistik`
--

INSERT INTO `jenis_logistik` (`id_jenis`, `jenis`, `created_at`, `updated_at`) VALUES
(3, 'Perlengkapan Dokpol (Kedokteran Kepolisian) 1', '2021-07-13 14:23:47', '2021-07-13 14:24:00'),
(4, 'Kelengkapan Perorangan (Kaporlap)', '2021-07-16 15:02:24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_logistik`
--

CREATE TABLE `satuan_logistik` (
  `id_satuan` int(3) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `id_jenis` int(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satuan_logistik`
--

INSERT INTO `satuan_logistik` (`id_satuan`, `satuan`, `id_jenis`, `created_at`, `updated_at`) VALUES
(1, 'Unit', 3, '2021-07-13 14:50:49', NULL),
(3, 'Butir 01', 3, '2021-07-13 14:52:36', '2021-07-19 10:14:15'),
(4, 'SET', 4, '2021-07-19 09:55:53', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(3) NOT NULL,
  `surat_jalan` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `no_telp` varchar(14) DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `pembuat` int(3) NOT NULL,
  `transaksi_status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1 = On Going, 2 = Validated Returns',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `surat_jalan`, `tujuan`, `no_telp`, `penerima`, `pembuat`, `transaksi_status`, `created_at`, `updated_at`) VALUES
(4, 'SJ0004', 'Satuan Reserse', '09876543', 'Ari Kurniawan Saputra', 1, '2', '2021-07-17 14:09:26', '2021-07-19 07:43:50'),
(6, 'SJ0005', 'Satuan Kerja', '09876', 'Johansyah, S.I.P', 1, '1', '2021-07-18 05:26:39', '2021-07-19 07:39:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_personel` int(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `nrp` varchar(8) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `username` varchar(18) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT '$2y$10$N33og08eYBFZlPT8unPeYe7D.xxoropy2OniU3jsN3Cb0iuUIGuae',
  `user_status` enum('admin','pimpinan','personel') NOT NULL DEFAULT 'personel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_personel`, `nama`, `pangkat`, `nrp`, `jabatan`, `no_telpon`, `username`, `password`, `user_status`) VALUES
(1, 'Administrator', '-', '-', '', '-', 'admin', '$2y$10$611DW2wlBplpEwqN5G6UG.QVwvEbop7kFWoim1Ao9UWalj2xuj2LG', 'admin'),
(17, 'JUNIZAR, S.Kom', 'Kapolda', '08999', 'Kepala', '987654', 'junizar', '$2y$10$O7PEd35gyHtGqqUcwxl8ju6WKYM5oASmoWZTfHEJ/.ts.XcDKKVJ.', 'personel'),
(18, 'ACHMAD AGUNG BRAMTIHALLEY, SE, M.M', 'Kapolda', '12345678', 'Kapolda Bandar Lampung', '0987654', 'achmad', '$2y$10$7LNnBr7GGR/AmXHANZlRUeHmbuqcXNxHwQNJjSV8M2t8YMRzqOSjO', 'pimpinan'),
(19, 'Johansyah', 'IPDA', '9999', 'Kepala Bidang Pengadaan', '09876', 'johansyah', '$2y$10$DLxYjFbFzytwTOZ/rjIpYOsuQs9dUdeMWLL3BoJ4u40xODV2mMhJK', 'personel');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_cart_transaksi_keluar3`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_cart_transaksi_keluar3` (
`id_cart` int(3)
,`surat_jalan` varchar(100)
,`kode_barang` varchar(100)
,`nama_barang` varchar(100)
,`jml_transaksi` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_grafik_transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_grafik_transaksi` (
`tgl_transaksi` varchar(10)
,`jenis_transaksi` enum('keluar','masuk')
,`jml_trans` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_inventory`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_inventory` (
`id_barang` int(3)
,`kode_barang` varchar(100)
,`nama_barang` varchar(100)
,`stok` int(4)
,`jenis` varchar(100)
,`id_satuan` int(3)
,`satuan` varchar(100)
,`foto_barang` text
,`qr_code` varchar(50)
,`user_uploaded` int(3)
,`created_at` datetime
,`updated_at` datetime
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_satuan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_satuan` (
`id_jenis` int(3)
,`jenis` varchar(100)
,`id_satuan` int(3)
,`satuan` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_transaksi_keluar`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_transaksi_keluar` (
`id_transaksi` int(3)
,`transaksi_status` enum('1','2')
,`surat_jalan` varchar(100)
,`tujuan` varchar(100)
,`no_telp` varchar(14)
,`penerima` varchar(100)
,`tgl_keluar` varchar(10)
,`jml_trans` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_transaksi_masuk`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_transaksi_masuk` (
`id_transaksi` int(3)
,`transaksi_status` enum('1','2')
,`surat_jalan` varchar(100)
,`tujuan` varchar(100)
,`no_telp` varchar(14)
,`penerima` varchar(100)
,`tgl_masuk` varchar(10)
,`jml_trans` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_cart_transaksi_keluar3`
--
DROP TABLE IF EXISTS `v_cart_transaksi_keluar3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cart_transaksi_keluar3`  AS  select `cart_transaksi`.`id_cart` AS `id_cart`,`cart_transaksi`.`surat_jalan` AS `surat_jalan`,`barang_logistik`.`kode_barang` AS `kode_barang`,`barang_logistik`.`nama_barang` AS `nama_barang`,sum(`cart_transaksi`.`jumlah_transaksi`) AS `jml_transaksi` from (`cart_transaksi` join `barang_logistik` on(`barang_logistik`.`id_barang` = `cart_transaksi`.`id_brg`)) group by `cart_transaksi`.`id_brg` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_grafik_transaksi`
--
DROP TABLE IF EXISTS `v_grafik_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_grafik_transaksi`  AS  select date_format(`transaksi`.`updated_at`,'%Y-%m-%d') AS `tgl_transaksi`,`cart_transaksi`.`jenis_transaksi` AS `jenis_transaksi`,sum(`cart_transaksi`.`jumlah_transaksi`) AS `jml_trans` from (`transaksi` join `cart_transaksi` on(`cart_transaksi`.`surat_jalan` = `transaksi`.`surat_jalan`)) group by `cart_transaksi`.`jenis_transaksi` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_inventory`
--
DROP TABLE IF EXISTS `v_inventory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_inventory`  AS  select `barang_logistik`.`id_barang` AS `id_barang`,`barang_logistik`.`kode_barang` AS `kode_barang`,`barang_logistik`.`nama_barang` AS `nama_barang`,`barang_logistik`.`stok` AS `stok`,`v_satuan`.`jenis` AS `jenis`,`v_satuan`.`id_satuan` AS `id_satuan`,`v_satuan`.`satuan` AS `satuan`,`barang_logistik`.`foto_barang` AS `foto_barang`,`barang_logistik`.`qr_code` AS `qr_code`,`barang_logistik`.`user_uploaded` AS `user_uploaded`,`barang_logistik`.`created_at` AS `created_at`,`barang_logistik`.`updated_at` AS `updated_at` from (`barang_logistik` join `v_satuan` on(`v_satuan`.`id_satuan` = `barang_logistik`.`satuan_barang`)) order by `barang_logistik`.`id_barang` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_satuan`
--
DROP TABLE IF EXISTS `v_satuan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_satuan`  AS  select `jenis_logistik`.`id_jenis` AS `id_jenis`,`jenis_logistik`.`jenis` AS `jenis`,`satuan_logistik`.`id_satuan` AS `id_satuan`,`satuan_logistik`.`satuan` AS `satuan` from (`satuan_logistik` join `jenis_logistik` on(`jenis_logistik`.`id_jenis` = `satuan_logistik`.`id_jenis`)) order by `satuan_logistik`.`id_satuan` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_transaksi_keluar`
--
DROP TABLE IF EXISTS `v_transaksi_keluar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transaksi_keluar`  AS  select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`transaksi_status` AS `transaksi_status`,`transaksi`.`surat_jalan` AS `surat_jalan`,`transaksi`.`tujuan` AS `tujuan`,`transaksi`.`no_telp` AS `no_telp`,`transaksi`.`penerima` AS `penerima`,date_format(`transaksi`.`created_at`,'%Y-%m-%d') AS `tgl_keluar`,sum(`cart_transaksi`.`jumlah_transaksi`) AS `jml_trans` from (`transaksi` join `cart_transaksi` on(`cart_transaksi`.`surat_jalan` = `transaksi`.`surat_jalan`)) where `cart_transaksi`.`jenis_transaksi` = 'keluar' group by `transaksi`.`surat_jalan` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_transaksi_masuk`
--
DROP TABLE IF EXISTS `v_transaksi_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transaksi_masuk`  AS  select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`transaksi_status` AS `transaksi_status`,`transaksi`.`surat_jalan` AS `surat_jalan`,`transaksi`.`tujuan` AS `tujuan`,`transaksi`.`no_telp` AS `no_telp`,`transaksi`.`penerima` AS `penerima`,date_format(`transaksi`.`updated_at`,'%Y-%m-%d') AS `tgl_masuk`,sum(`cart_transaksi`.`jumlah_transaksi`) AS `jml_trans` from (`transaksi` join `cart_transaksi` on(`cart_transaksi`.`surat_jalan` = `transaksi`.`surat_jalan`)) where `cart_transaksi`.`jenis_transaksi` = 'masuk' group by `transaksi`.`surat_jalan` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_logistik`
--
ALTER TABLE `barang_logistik`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `cart_transaksi`
--
ALTER TABLE `cart_transaksi`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indeks untuk tabel `jenis_logistik`
--
ALTER TABLE `jenis_logistik`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `satuan_logistik`
--
ALTER TABLE `satuan_logistik`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_personel`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_logistik`
--
ALTER TABLE `barang_logistik`
  MODIFY `id_barang` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `cart_transaksi`
--
ALTER TABLE `cart_transaksi`
  MODIFY `id_cart` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `jenis_logistik`
--
ALTER TABLE `jenis_logistik`
  MODIFY `id_jenis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `satuan_logistik`
--
ALTER TABLE `satuan_logistik`
  MODIFY `id_satuan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_personel` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
