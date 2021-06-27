-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 27, 2021 at 12:47 PM
-- Server version: 10.4.18-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u361882519_bonku`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2021_05_20_111420_create_transaksi_table', 1),
(9, '2021_05_20_111910_create_rincian_transaksi_table', 1),
(10, '2021_05_20_112039_create_produk_table', 1),
(11, '2021_05_25_022709_add_harga_to_produk_table', 2),
(12, '2014_10_12_100000_create_password_resets_table', 3),
(14, '2021_05_31_062832_move_jumlah_index_in_rincian_transaksi', 4),
(15, '2021_06_01_021739_modify_all_decimal_to_integer_transaksi_table', 5),
(16, '2021_06_01_022056_modify_all_decimal_to_integer_rincian_transaksi_table', 6),
(18, '2021_06_01_022340_modify_all_decimal_to_integer_produk_table', 7),
(19, '2021_06_01_031510_modify_keterangan_to_nullable_transaksi_table', 7),
(20, '2021_06_01_041457_add_satuan_to_rincian_transaksi_table', 8),
(21, '2021_06_04_062357_create_pengeluaran_table', 9),
(22, '2021_06_05_095529_add_user_email_to_rincian_transaksi_table', 10),
(23, '2021_06_16_092542_create_pendapatan_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan`
--

CREATE TABLE `pendapatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendapatan`
--

INSERT INTO `pendapatan` (`id`, `deskripsi`, `total`, `keterangan`, `user_email`, `created_at`, `updated_at`) VALUES
(1, 'beli bensin', 25000, 'bensin motor', 'nandha-owner@bonqu.online', '2021-06-16 09:38:26', '2021-06-16 10:05:48'),
(3, 'Total jualan', 100000, NULL, 'nandha.walrost@gmail.com', '2021-06-17 17:50:47', NULL),
(4, 'Total hari ini', 900000, NULL, 'rosita09@gmail.com', '2021-06-26 17:42:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `deskripsi`, `total`, `keterangan`, `user_email`, `created_at`, `updated_at`) VALUES
(2, 'belanja produk', 1000000, 'buku catatan, dll.', 'nandha-owner@bonqu.online', '2021-06-04 07:10:35', NULL),
(3, 'beli kipas', 200000, 'biar ga panas', 'nandha-owner@bonqu.online', '2021-06-11 11:37:40', '2021-06-11 12:59:06'),
(5, 'beli sapu', 20000, NULL, 'test@bonqu.online', '2021-06-11 11:42:50', NULL),
(6, 'beli karpet', 20000, NULL, 'nandha-owner@bonqu.online', '2021-05-12 11:59:31', NULL),
(7, 'beli bubur', 10000, NULL, 'nandha-owner@bonqu.online', '2021-06-13 09:19:57', NULL),
(8, 'belanja bulanan', 200000, NULL, 'nandha-owner@bonqu.online', '2021-06-13 09:20:06', NULL),
(9, 'sarapan', 10000, NULL, 'nandha-owner@bonqu.online', '2021-06-14 02:30:33', NULL),
(10, 'ngeteh', 3000, NULL, 'nandha-owner@bonqu.online', '2021-06-14 02:30:44', NULL),
(11, 'Beli rokok', 22000, NULL, 'missclaraqueen@gmail.com', '2021-06-18 22:01:42', NULL),
(12, 'Beli plastik', 60000, NULL, 'rosita09@gmail.com', '2021-06-26 17:43:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jumlah_minimum` int(11) NOT NULL,
  `jumlah_maksimum` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `satuan` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `jumlah`, `jumlah_minimum`, `jumlah_maksimum`, `harga`, `satuan`, `user_email`, `created_at`, `updated_at`) VALUES
(9, 'buku tulis', 2, 1, 9999, 2000, 'pcs', 'nandha-owner@bonqu.online', '2021-06-02 08:03:54', NULL),
(10, 'tempat pensil', 500, 1, 99999, 100000, 'pcs', 'nandha-owner@bonqu.online', '2021-06-02 08:05:01', NULL),
(11, 'ibanez rg350', 4, 1, 40, 3400000, 'pcs', 'test@bonqu.online', '2021-06-05 09:16:46', '2021-06-05 09:27:57'),
(12, 'fender stratocaster classic', 2, 1, 2, 79000000, 'pcs', 'test@bonqu.online', '2021-06-05 09:20:54', NULL),
(13, 'drawing pen', 20, 1, 999, 10000, 'pcs', 'nandha-owner@bonqu.online', '2021-06-05 13:11:39', NULL),
(14, 'kabel jack daddario', 30, 1, 9999, 120000, 'pcs', 'test@bonqu.online', '2021-06-08 08:59:05', NULL),
(15, 'solar guitar', 2, 1, 99999, 8000000, 'pcs', 'test@bonqu.online', '2021-06-08 09:21:43', NULL),
(16, 'ibanez gio', 50, 1, 9999, 3000000, 'pcs', 'test@bonqu.online', '2021-06-08 09:23:00', NULL),
(17, 'squier affinity', 23, 1, 99999, 3400000, 'pcs', 'test@bonqu.online', '2021-06-08 09:24:12', NULL),
(18, 'digitech death metal', 5, 1, 9999, 700000, 'pcs', 'test@bonqu.online', '2021-06-08 09:24:46', NULL),
(19, 'pick dunlop', 400, 1, 9999, 14000, 'pcs', 'test@bonqu.online', '2021-06-08 09:25:37', NULL),
(20, 'seymour duncan invader neck', 4, 1, 99999, 1100000, 'pcs', 'test@bonqu.online', '2021-06-08 09:26:49', NULL),
(21, 'seymour duncan inv (pasang)', 5, 1, 999, 1800000, 'pasang', 'test@bonqu.online', '2021-06-08 09:27:33', NULL),
(22, 'pick fender (lusinan)', 6, 1, 999999, 34000, 'lusin', 'test@bonqu.online', '2021-06-08 09:28:27', NULL),
(23, 'santan', 0, 0, 0, 20000, 'kg', 'rosita@gmail.com', '2021-06-16 04:51:19', '2021-06-16 04:56:27'),
(24, 'kelapa busuk', 0, 0, 0, 0, '-', 'rosita@gmail.com', '2021-06-16 04:52:45', NULL),
(25, 'kelapa', 1000, 0, 0, 10000, 'biji', 'rosita@gmail.com', '2021-06-16 04:57:19', '2021-06-17 15:05:30'),
(26, 'Earidium Gen 1', 1, 1, 10, 119000, '119000', 'nandha.walrost@gmail.com', '2021-06-18 07:17:34', NULL),
(28, 'Sate', 0, 0, 0, 3000, 'Tusuk', 'missclaraqueen@gmail.com', '2021-06-18 21:56:23', NULL),
(29, 'Susu jahe', 0, 0, 0, 8000, 'Gelas', 'missclaraqueen@gmail.com', '2021-06-18 21:57:47', NULL),
(30, 'Teh jus', 0, 0, 0, 5000, 'Gelas', 'missclaraqueen@gmail.com', '2021-06-18 22:02:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rincian_transaksi`
--

CREATE TABLE `rincian_transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rincian_transaksi`
--

INSERT INTO `rincian_transaksi` (`id`, `id_transaksi`, `nama_produk`, `jumlah`, `satuan`, `harga`, `sub_total`, `user_email`, `created_at`, `updated_at`) VALUES
(58, '29', 'buku tulis', 1, 'pcs', 2000, 2000, 'nandha-owner@bonqu.online', '2021-06-07 07:47:05', NULL),
(59, '34', 'ibanez rg350', 2, 'pcs', 3400000, 6800000, 'test@bonqu.online', '2021-06-07 09:57:26', NULL),
(60, '34', 'fender stratocaster classic', 1, 'pcs', 79000000, 79000000, 'test@bonqu.online', '2021-06-07 09:57:47', NULL),
(61, '35', 'ibanez rg350', 1, 'pcs', 3400000, 3400000, 'test@bonqu.online', '2021-06-07 09:59:20', NULL),
(63, '36', 'fender stratocaster classic', 4, 'pcs', 79000000, 316000000, 'test@bonqu.online', '2021-06-07 13:23:16', NULL),
(64, '36', 'ibanez rg350', 1, 'pcs', 3400000, 3400000, 'test@bonqu.online', '2021-06-07 13:33:48', NULL),
(65, '38', 'fender stratocaster classic', 4, 'pcs', 79000000, 316000000, 'test@bonqu.online', '2021-06-12 08:06:06', NULL),
(66, '37', 'tempat pensil', 4, 'pcs', 100000, 400000, 'nandha-owner@bonqu.online', '2021-06-14 12:34:20', NULL),
(67, '37', 'buku tulis', 1, 'pcs', 2000, 2000, 'nandha-owner@bonqu.online', '2021-06-14 12:34:25', NULL),
(68, '39', 'tempat pensil', 2, 'pcs', 100000, 200000, 'nandha-owner@bonqu.online', '2021-06-15 06:58:58', NULL),
(69, '39', 'drawing pen', 1, 'pcs', 10000, 10000, 'nandha-owner@bonqu.online', '2021-06-15 06:59:29', NULL),
(70, '40', 'buku tulis', 9, 'pcs', 2000, 18000, 'nandha-owner@bonqu.online', '2021-06-15 07:01:05', NULL),
(71, '41', 'drawing pen', 1, 'pcs', 10000, 10000, 'nandha-owner@bonqu.online', '2021-06-15 07:03:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_harga` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `total_kembali` int(11) NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama_pelanggan`, `total_harga`, `total_bayar`, `total_kembali`, `user_email`, `keterangan`, `created_at`, `updated_at`) VALUES
(34, NULL, 85800000, 100000000, 14200000, 'test@bonqu.online', NULL, NULL, '2021-06-07 09:58:38'),
(35, 'badu', 3400000, 3400000, 0, 'test@bonqu.online', NULL, NULL, '2021-06-07 09:59:27'),
(36, NULL, 316000000, 0, 0, 'test@bonqu.online', NULL, NULL, '2021-06-07 13:33:48'),
(37, 'walrost', 402000, 500000, 98000, 'nandha-owner@bonqu.online', 'orang arya graha', NULL, '2021-06-15 06:27:35'),
(38, NULL, 0, 0, 0, 'test@bonqu.online', NULL, NULL, '2021-06-12 08:06:06'),
(39, NULL, 210000, 210000, 0, 'nandha-owner@bonqu.online', 'kirim ke kedaung', NULL, '2021-06-15 06:59:37'),
(40, NULL, 18000, 20000, 2000, 'nandha-owner@bonqu.online', NULL, NULL, '2021-06-15 07:01:13'),
(41, NULL, 10000, 10000, 0, 'nandha-owner@bonqu.online', NULL, NULL, '2021-06-15 07:03:28'),
(42, NULL, 0, 0, 0, 'rosita@gmail.com', 'total penjualan hari ini', NULL, '2021-06-16 05:29:51'),
(50, NULL, 0, 0, 0, 'nandha.walrost@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nandha', 'nandha-owner@bonqu.online', NULL, '$2y$10$D5lAahxJzUevNzXLU/r7m.7GV.2uwDSpniOMFt6F7ZTMItMrT0X7y', 'CtOpAVVV7LjUiqTfx3oF7GCNwE2iwMbWZuqT4kuAXXBzVaVQ36G9zLA3DVOA', '2021-06-04 01:49:39', '2021-06-04 01:49:39'),
(2, 'test user', 'test@bonqu.online', NULL, '$2y$10$byM9c6EIhp58F7IcRXnr3uTXXV6SQJPEbqv09OhT3loBfOZBftgsG', NULL, '2021-06-05 02:15:33', '2021-06-05 02:15:33'),
(3, 'rosita', 'rosita@gmail.com', NULL, '$2y$10$DuW6q6JwlIDCBc7J4Nkci.qkDKay1RKQHUSx4XvZ1TWDwBD9PNBQe', 'yLYAqbx462j1Q2JQwN30DLNZ1om5FnWCjQK6gXvrScXOjtja1RJhe5E4Vv0m', '2021-06-15 20:30:55', '2021-06-15 20:30:55'),
(4, 'earidium', 'nandha.walrost@gmail.com', NULL, '$2y$10$Go75h8aUBFjYT.mYA11fqesknamQs8X350p6nwm2poN/QeAwF09di', NULL, '2021-06-17 08:22:50', '2021-06-17 08:22:50'),
(5, 'Angkringan Miss Cetar', 'missclaraqueen@gmail.com', NULL, '$2y$10$3pEj47XPca1YpjU1u2Y.lutc0sXOHW46zEarBs5vE1OR/ZPsc53zm', NULL, '2021-06-18 14:46:26', '2021-06-18 14:46:26'),
(6, 'mitha', 'mithaseptiani@bonqu.online', NULL, '$2y$10$1iS4mEW7SbCRtxwGhvEK0ecbtHtYUwVXHioVX.PwJgpFiC6qijOf6', NULL, '2021-06-19 15:52:08', '2021-06-19 15:52:08'),
(7, 'avi', 'avi@bonqu.online', NULL, '$2y$10$uXbM.rT.4HOGTvbir45A4.NOEWY8IRBDyMJl0XU3ea.rInXaxdF7C', NULL, '2021-06-20 04:03:56', '2021-06-20 04:03:56'),
(8, 'rosita', 'rosita09@gmail.com', NULL, '$2y$10$HRRLs5g8a/ZWHfYu8k1gDeFtCPMuTdkSLr.OraK9M/qmEYc6CbByO', NULL, '2021-06-26 10:36:57', '2021-06-26 10:36:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rincian_transaksi`
--
ALTER TABLE `rincian_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `rincian_transaksi`
--
ALTER TABLE `rincian_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
