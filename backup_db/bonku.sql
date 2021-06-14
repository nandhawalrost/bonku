-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2021 at 05:17 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bonku`
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
(22, '2021_06_05_095529_add_user_email_to_rincian_transaksi_table', 10);

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
(10, 'ngeteh', 3000, NULL, 'nandha-owner@bonqu.online', '2021-06-14 02:30:44', NULL);

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
(22, 'pick fender (lusinan)', 6, 1, 999999, 34000, 'lusin', 'test@bonqu.online', '2021-06-08 09:28:27', NULL);

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
(67, '37', 'buku tulis', 1, 'pcs', 2000, 2000, 'nandha-owner@bonqu.online', '2021-06-14 12:34:25', NULL);

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
(37, 'walrost', 402000, 500000, 98000, 'nandha-owner@bonqu.online', 'orang arya graha', NULL, '2021-06-14 12:38:29'),
(38, NULL, 0, 0, 0, 'test@bonqu.online', NULL, NULL, '2021-06-12 08:06:06');

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
(1, 'nandha', 'nandha-owner@bonqu.online', NULL, '$2y$10$D5lAahxJzUevNzXLU/r7m.7GV.2uwDSpniOMFt6F7ZTMItMrT0X7y', 'zqIvsV2ZjEMx58MZIFeaqMEl83h52rqubmFfzO31gQxcQ4buOVUrLQvP1uw7', '2021-06-04 01:49:39', '2021-06-04 01:49:39'),
(2, 'test user', 'test@bonqu.online', NULL, '$2y$10$byM9c6EIhp58F7IcRXnr3uTXXV6SQJPEbqv09OhT3loBfOZBftgsG', NULL, '2021-06-05 02:15:33', '2021-06-05 02:15:33');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `rincian_transaksi`
--
ALTER TABLE `rincian_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
