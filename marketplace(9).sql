-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2025 at 11:22 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

DROP TABLE IF EXISTS `captcha`;
CREATE TABLE IF NOT EXISTS `captcha` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sitekey` varchar(225) NOT NULL,
  `secret` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_product_unique` (`user_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '2025-11-26 06:17:07', '2025-11-26 06:17:09'),
(2, 1, 11, 1, '2025-11-26 06:19:05', '2025-11-28 20:21:20'),
(4, 3, 1, 10, '2025-11-27 20:11:50', '2025-11-28 22:51:05'),
(5, 3, 11, 2, '2025-11-27 20:34:27', '2025-11-28 22:51:10'),
(7, 2, 2, 1, '2025-12-01 01:04:33', '2025-12-01 01:04:33'),
(9, 8, 2, 2, '2025-12-01 01:14:13', '2025-12-04 06:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

DROP TABLE IF EXISTS `gambar`;
CREATE TABLE IF NOT EXISTS `gambar` (
  `id_prod` int NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`id_prod`, `gambar`) VALUES
(1, 'uploads/1764095792_Screenshot 2025-11-23 102116.png'),
(2, 'uploads/1764095803_Screenshot 2025-11-23 101552.png');

-- --------------------------------------------------------

--
-- Table structure for table `google`
--

DROP TABLE IF EXISTS `google`;
CREATE TABLE IF NOT EXISTS `google` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` varchar(225) NOT NULL,
  `client_secret` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

DROP TABLE IF EXISTS `harga`;
CREATE TABLE IF NOT EXISTS `harga` (
  `id_prod` int NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id_prod`, `harga`) VALUES
(5, 1300000.00),
(1, 1.05),
(2, 1.41),
(1, 1.05),
(2, 1.41),
(11, 13000000.00),
(12, 9000000.00),
(13, 3500000.00),
(14, 8500000.00),
(15, 5000000.00),
(16, 75000.00),
(17, 180000.00),
(18, 1200000.00),
(19, 1250000.00),
(20, 650000.00),
(21, 200000.00),
(22, 320000.00),
(23, 450000.00),
(24, 650000.00),
(25, 500000.00),
(26, 350000.00),
(27, 150000.00),
(28, 850000.00),
(29, 250000.00),
(30, 450000.00),
(31, 750000.00),
(32, 300000.00),
(33, 90000.00),
(34, 180000.00),
(35, 1100000.00),
(36, 220000.00),
(37, 9000000.00),
(38, 300000.00),
(39, 400000.00),
(40, 650000.00),
(41, 120000.00),
(42, 150000.00),
(43, 120000.00),
(44, 85000.00),
(45, 750000.00),
(46, 90000.00),
(47, 320000.00),
(48, 180000.00),
(49, 180000.00),
(50, 550000.00),
(51, 250000.00),
(52, 650000.00),
(53, 150000.00),
(54, 120000.00),
(55, 200000.00),
(56, 650000.00),
(57, 350000.00),
(58, 150000.00),
(59, 950000.00),
(60, 180000.00),
(61, 12000000.00),
(62, 18500000.00),
(63, 550000.00),
(64, 14500000.00),
(65, 15000000.00),
(66, 250000.00),
(67, 275000.00),
(68, 950000.00),
(69, 750000.00),
(70, 400000.00),
(71, 180000.00),
(72, 320000.00),
(73, 700000.00),
(74, 1200000.00),
(75, 850000.00),
(76, 450000.00),
(77, 150000.00),
(78, 650000.00),
(79, 300000.00),
(80, 500000.00),
(81, 600000.00),
(82, 350000.00),
(83, 120000.00),
(84, 180000.00),
(85, 900000.00),
(86, 400000.00),
(87, 1300000.00),
(88, 250000.00),
(89, 150000.00),
(90, 1200000.00),
(91, 250000.00),
(92, 300000.00),
(93, 180000.00),
(94, 150000.00),
(95, 400000.00),
(96, 200000.00),
(97, 350000.00),
(98, 220000.00),
(99, 250000.00),
(100, 450000.00),
(101, 500000.00),
(102, 550000.00),
(103, 600000.00),
(104, 120000.00),
(105, 200000.00),
(106, 850000.00),
(107, 500000.00),
(108, 300000.00),
(109, 650000.00),
(110, 700000.00),
(111, 3200000.00),
(112, 13500000.00),
(113, 2500000.00),
(114, 10000000.00),
(115, 9000000.00),
(116, 150000.00),
(117, 220000.00),
(118, 1200000.00),
(119, 900000.00),
(120, 400000.00),
(121, 350000.00),
(122, 320000.00),
(123, 800000.00),
(124, 1000000.00),
(125, 450000.00),
(126, 400000.00),
(127, 180000.00),
(128, 250000.00),
(129, 300000.00),
(130, 500000.00),
(131, 600000.00),
(132, 750000.00),
(133, 150000.00),
(134, 200000.00),
(135, 900000.00),
(136, 400000.00),
(137, 1200000.00),
(138, 250000.00),
(139, 150000.00),
(140, 1200000.00),
(141, 250000.00),
(142, 300000.00),
(143, 180000.00),
(144, 150000.00),
(145, 400000.00),
(146, 200000.00),
(147, 350000.00),
(148, 220000.00),
(149, 250000.00),
(150, 450000.00);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_prod` int NOT NULL,
  `kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_prod`, `kategori`) VALUES
(2, 'Barang Gajelas'),
(11, 'Elektronik'),
(12, 'Elektronik'),
(13, 'Elektronik'),
(14, 'Elektronik'),
(15, 'Elektronik'),
(16, 'Pakaian'),
(17, 'Pakaian'),
(18, 'Sepatu'),
(19, 'Sepatu'),
(20, 'Tas'),
(21, 'Aksesoris'),
(22, 'Pakaian'),
(23, 'Furniture'),
(24, 'Furniture'),
(25, 'Peralatan Rumah Tangga'),
(26, 'Peralatan Rumah Tangga'),
(27, 'Pakaian'),
(28, 'Sepatu'),
(29, 'Tas'),
(30, 'Aksesoris'),
(31, 'Elektronik'),
(32, 'Elektronik'),
(33, 'Aksesoris'),
(34, 'Pakaian'),
(35, 'Sepatu'),
(36, 'Tas'),
(37, 'Elektronik'),
(38, 'Elektronik'),
(39, 'Elektronik'),
(40, 'Elektronik'),
(41, 'Elektronik'),
(42, 'Peralatan Rumah Tangga'),
(43, 'Pakaian'),
(44, 'Pakaian'),
(45, 'Sepatu'),
(46, 'Tas'),
(47, 'Pakaian'),
(48, 'Aksesoris'),
(49, 'Pakaian'),
(50, 'Tas'),
(51, 'Aksesoris'),
(52, 'Sepatu'),
(53, 'Pakaian'),
(54, 'Aksesoris'),
(55, 'Peralatan Rumah Tangga'),
(56, 'Peralatan Rumah Tangga'),
(57, 'Tas'),
(58, 'Elektronik'),
(59, 'Sepatu'),
(60, 'Pakaian'),
(61, 'Elektronik'),
(62, 'Elektronik'),
(63, 'Elektronik'),
(64, 'Elektronik'),
(65, 'Elektronik'),
(66, 'Pakaian'),
(67, 'Pakaian'),
(68, 'Sepatu'),
(69, 'Sepatu'),
(70, 'Tas'),
(71, 'Aksesoris'),
(72, 'Pakaian'),
(73, 'Furniture'),
(74, 'Furniture'),
(75, 'Elektronik'),
(76, 'Elektronik'),
(77, 'Pakaian'),
(78, 'Sepatu'),
(79, 'Tas'),
(80, 'Aksesoris'),
(81, 'Elektronik'),
(82, 'Elektronik'),
(83, 'Aksesoris'),
(84, 'Pakaian'),
(85, 'Sepatu'),
(86, 'Tas'),
(87, 'Elektronik'),
(88, 'Elektronik'),
(89, 'Elektronik'),
(90, 'Elektronik'),
(91, 'Elektronik'),
(92, 'Elektronik'),
(93, 'Pakaian'),
(94, 'Pakaian'),
(95, 'Sepatu'),
(96, 'Tas'),
(97, 'Pakaian'),
(98, 'Aksesoris'),
(99, 'Pakaian'),
(100, 'Tas'),
(101, 'Aksesoris'),
(102, 'Sepatu'),
(103, 'Pakaian'),
(104, 'Aksesoris'),
(105, 'Elektronik'),
(106, 'Elektronik'),
(107, 'Tas'),
(108, 'Elektronik'),
(109, 'Sepatu'),
(110, 'Pakaian'),
(111, 'Elektronik'),
(112, 'Elektronik'),
(113, 'Elektronik'),
(114, 'Elektronik'),
(115, 'Elektronik'),
(116, 'Pakaian'),
(117, 'Pakaian'),
(118, 'Sepatu'),
(119, 'Sepatu'),
(120, 'Tas'),
(121, 'Aksesoris'),
(122, 'Pakaian'),
(123, 'Furniture'),
(124, 'Furniture'),
(125, 'Elektronik'),
(126, 'Elektronik'),
(127, 'Pakaian'),
(128, 'Sepatu'),
(129, 'Tas'),
(130, 'Aksesoris'),
(131, 'Elektronik'),
(132, 'Elektronik'),
(133, 'Aksesoris'),
(134, 'Pakaian'),
(135, 'Sepatu'),
(136, 'Tas'),
(137, 'Elektronik'),
(138, 'Elektronik'),
(139, 'Elektronik'),
(140, 'Elektronik'),
(141, 'Elektronik'),
(142, 'Elektronik'),
(143, 'Pakaian'),
(144, 'Pakaian'),
(145, 'Sepatu'),
(146, 'Tas'),
(147, 'Pakaian'),
(148, 'Aksesoris'),
(149, 'Pakaian'),
(150, 'Tas');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role_id` int NOT NULL DEFAULT '3',
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `password`, `role_id`, `remember_token`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', '11', '$2y$12$fb0.1lG7BnkeZwTDqcXtSeoLqSTZa4nO3IxCpXL167NkHJ6qbG2RK', 1, NULL),
(2, 'izza', 'wibowo', 'izza arya', 'izzairzy123@gmail.com', '8384', '$2y$12$PhCn2AHzMSv577tVC0.HfeEsaxFr3Aw.gZ.qQ/bu52HJVFBBkHHgK', 3, NULL),
(3, 'tasudg', 'asd', 'user', 'user@gmail.com', '123123', '$2y$12$rxjJcj92E6ILykPKS8SeE.jYfUcurMHbfYTC7AKcojWlVa0iSNbBm', 3, NULL),
(4, 'asdas', 'asdasd', 'piyxox', 'kasir@gmail.com', 'w23', '$2y$12$mGut5qBmz7DVz/bbvRnfFedOidcaOs/em..fbXHaXBLQYgvD0n59i', 3, NULL),
(5, '4234435', '355345', '4354', '35@sfsdf', '345435', '$2y$12$ZDIzD4EUUxbQSyMLIr07.umNnSjXuMS2bHHabdPp9687PvuHB80sS', 3, NULL),
(6, 'asdas3244', 'asd', 'ads', 'hahvdd@dghvdf', '324', '$2y$12$7xi1moB1YIivBBMQKaoh6OjDB4Kz4OWHsl/WhNFoMvizvAr4ig4MK', 3, NULL),
(7, 'adada', 'adsdadasd', 'asdasdads', 'kuntul@gmail.com', '123343432', '$2y$12$8HTjLIMQY7IAM7nMuhcyAObUpcuPmsSL33UWhtpn9W64cohtcJ2h.', 3, NULL),
(8, 'asdasd', 'wibowo', 'asdasd', 'ayam@gmail.com', '083843002693', '$2y$12$RlsXgaEN8cwU4dfTgdaNNOj0.JELElQDvObw5mUaVO90C9D9UfyZ2', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login2_addresses`
--

DROP TABLE IF EXISTS `login2_addresses`;
CREATE TABLE IF NOT EXISTS `login2_addresses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `address_line` text NOT NULL,
  `additional_info` text NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `city_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login2_addresses`
--

INSERT INTO `login2_addresses` (`id`, `user_id`, `full_name`, `phone`, `province`, `city`, `district`, `postal_code`, `address_line`, `additional_info`, `is_default`, `created_at`, `updated_at`, `city_id`) VALUES
(4, 2, 'sdf', '324', 'DI YOGYAKARTA', 'YOGYAKARTA', 'JETIS', '234', 'aadsadasd', 'sdf', 0, '2025-12-08 07:23:48', '2025-12-08 07:23:48', '419'),
(5, 2, 'aaaa', '08123', 'BANTEN', 'CILEGON', 'PULOMERAK', '55431', 'sasdadadasdzxczscascasc', 'sacascasczcszczsczcssacas', 0, '2025-12-01 00:50:40', '2025-12-01 00:50:40', NULL),
(6, 8, 'dasdasdasd', '2131231', 'MALUKU', 'AMBON', 'SIRIMAU', '55323', 'erwrwer', 'werwerewr', 0, '2025-12-01 01:19:28', '2025-12-01 01:19:28', NULL),
(7, 8, 'adawdawd', '324324', 'KEPULAUAN RIAU', 'NATUNA', 'BUNGURAN TIMUR', '643231', 'werwrewer', 'werwerwer', 0, '2025-12-01 01:20:11', '2025-12-01 01:20:11', NULL),
(8, 3, 'weqweqwe', '21323123', 'NANGGROE ACEH DARUSSALAM (NAD)', 'LANGSA', 'LANGSA KOTA', '231312', 'qwqeqeqwe', 'weqweq', 0, '2025-12-01 01:28:18', '2025-12-01 01:28:18', NULL),
(9, 3, 'adqwdqwd', 'wqeqweqwe', 'PAPUA', 'JAYAPURA', 'SENTANI', '23123', 'qwqwdq', 'qwdqdqwd', 0, '2025-12-01 01:28:38', '2025-12-01 01:28:38', NULL),
(11, 7, 'sfd', '234', 'KALIMANTAN TIMUR', 'KUTAI TIMUR', 'MUARA WAHAU', '32', 'fsd', 'sdf', 0, '2025-12-08 01:41:10', '2025-12-08 01:41:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `midtrans`
--

DROP TABLE IF EXISTS `midtrans`;
CREATE TABLE IF NOT EXISTS `midtrans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_token` varchar(255) NOT NULL,
  `server_token` varchar(255) NOT NULL,
  `merchant_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

DROP TABLE IF EXISTS `otp`;
CREATE TABLE IF NOT EXISTS `otp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor` varchar(20) NOT NULL,
  `otp` int NOT NULL,
  `waktu` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `nomor`, `otp`, `waktu`) VALUES
(1, '082324081461', 220183, 1763749949),
(4, '3434', 262085, 1763754257),
(5, 'er345', 980570, 1763754339),
(6, '6282324081461', 626756, 1763827581),
(8, '083843002693', 713330, 1764576814);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Hello World', 'Ini adalah konten post pertama.', '2025-11-29 01:37:23', '2025-11-29 01:37:23'),
(2, 'Laravel 12', 'Belajar membuat blog dengan Laravel 12.', '2025-11-29 01:37:23', '2025-11-29 01:37:23'),
(4, 'tes', 'tessadasd', '2025-11-28 18:53:05', '2025-11-28 18:53:12'),
(5, 'Rekomendasi Gadget Terbaik 2025 untuk Belanja di E‑Blox Store', 'Jika kamu sedang mencari gadget terbaru untuk meningkatkan produktivitas, E‑Blox Store adalah pilihan marketplace terbaik di tahun 2025. Tahun ini, perkembangan teknologi sangat pesat terutama di kategori smartphone, laptop ultra‑thin, serta perangkat wearable yang semakin pintar.\r\n\r\nDi E‑Blox Store, setiap produk melewati proses kurasi sehingga hanya brand resmi dan produk original yang masuk ke katalog. Gadget seperti Samsung Galaxy S24 Ultra, Asus ROG Flow, dan Apple Vision Pro 2 menjadi favorit konsumen karena menawarkan fitur AI terintegrasi, baterai lebih efisien, serta kualitas build yang jauh lebih premium.\r\n\r\nTidak hanya itu, E‑Blox Store juga memperkenalkan fitur baru bernama Smart Recommender yang menggunakan machine learning untuk merekomendasikan produk berdasarkan perilaku belanja pelanggan. Sistem ini mampu memprediksi kebutuhan pembeli sebelum mereka menyadarinya, sehingga pengalaman berbelanja terasa jauh lebih personal dan cepat.\r\n\r\nDengan dukungan pengiriman express, garansi resmi, dan sistem pembayaran lengkap seperti e-wallet, virtual account, hingga PayLater, belanja gadget kini jauh lebih mudah dan aman. Marketplace ini juga menyediakan promo rutin seperti Flash Sale Teknologi dan Diskon Upgrade Device untuk pelanggan yang ingin menukar perangkat lama dengan model terbaru.\r\n\r\nDalam beberapa tahun terakhir, E‑Blox Store berkembang menjadi pusat belanja teknologi terbesar di Asia Tenggara dan terus memperluas ekosistem layanan mereka. Jika kamu butuh perangkat baru, pastikan cek katalog terbaru setiap hari karena stok produk high-demand biasanya cepat habis.', '2025-11-28 19:55:00', '2025-11-28 19:55:00'),
(6, 'Tips Memilih Laptop Kerja dan Gaming di 2025 – Panduan dari E‑Blox Store', 'Memilih laptop yang tepat di tahun 2025 bukan hal yang mudah, terutama karena banyaknya pilihan dari berbagai merek besar seperti Dell, Asus, Lenovo, Acer, hingga Apple. Sebagai marketplace teknologi terbaik, E‑Blox Store membagikan panduan lengkap agar pembeli bisa memilih laptop sesuai kebutuhan tanpa membuang-buang budget.\r\n\r\nUntuk pekerjaan kantor, laptop dengan prosesor Intel Core Ultra atau AMD Ryzen 9000 series sudah sangat cukup. Model seperti Asus Zenbook 15 OLED dan Lenovo Slim 7 menjadi favorit karena bobotnya ringan, daya tahan baterainya lama, serta dilengkapi fitur AI untuk mempercepat task harian seperti transkripsi audio dan rendering ringan.\r\n\r\nSementara untuk gaming, perangkat seperti Asus TUF FX 2025, Acer Predator Orion, atau MSI Stealth 2025 menjadi pilihan utama para gamer. Laptop gaming generasi terbaru kini didukung GPU Nvidia 5000 series yang jauh lebih hemat daya namun menghasilkan kinerja hingga 3x lebih cepat dalam game AAA beresolusi tinggi.\r\n\r\nSelain itu, E‑Blox Store menyarankan mempertimbangkan aspek lain seperti sistem pendingin, kualitas layar, dan daya tahan komponen. Banyak laptop murah terlihat menarik di iklan, namun performanya turun setelah beberapa bulan karena sistem thermal yang buruk. Inilah sebabnya marketplace ini menambahkan label Verified Performance di produk laptop tertentu yang sudah lulus pengujian internal.\r\n\r\nDengan membaca panduan lengkap seperti ini, kamu tidak perlu bingung lagi dalam memilih laptop terbaik untuk tahun 2025. Jangan lupa cek promo Teknologi Akhir Tahun di E‑Blox Store karena banyak laptop high-end turun harga cukup signifikan.', '2025-11-28 19:58:00', '2025-11-28 19:58:00'),
(7, 'Perkembangan AI Marketplace dan Bagaimana E‑Blox Store Menggunakannya', 'Tahun 2025 menjadi era penting bagi perkembangan Artificial Intelligence di sektor e-commerce. Banyak marketplace mulai mengimplementasikan AI untuk meningkatkan pengalaman berbelanja, namun E‑Blox Store menjadi salah satu pelopor yang benar-benar memaksimalkan teknologi tersebut.\r\n\r\nAI di marketplace ini digunakan untuk tiga hal utama: rekomendasi produk, deteksi penipuan, dan analisis perilaku pembeli. Sistem rekomendasi berbasis neural network mampu memahami pola belanja konsumen hingga 90% lebih akurat dibandingkan tahun-tahun sebelumnya. Pembeli yang sering melihat perangkat fotografi, misalnya, akan otomatis menerima katalog terbaru kamera mirrorless, lensa, dan aksesori yang relevan tanpa harus mencarinya secara manual.\r\n\r\nSelain itu, E‑Blox Store juga menggunakan AI Fraud Shield untuk memblokir transaksi yang berpotensi berbahaya. Sistem ini mampu mendeteksi anomali secara real-time sehingga meminimalisir risiko penipuan dalam transaksi digital.\r\n\r\nYang paling menarik adalah fitur MarketAI Insight, sebuah alat analisis yang membantu penjual melihat tren pasar, perkiraan permintaan produk, hingga kompetisi antar brand. Fitur ini sangat membantu UMKM yang ingin berkembang namun tidak memiliki akses ke data besar seperti perusahaan besar.\r\n\r\nDengan implementasi AI yang matang, E‑Blox Store berhasil menciptakan ekosistem marketplace yang lebih cerdas, aman, dan efisien bagi seluruh pengguna. Perkembangan ini membuktikan bahwa teknologi AI bukan hanya tren, namun masa depan dari seluruh platform e-commerce di dunia.', '2025-11-28 20:00:00', '2025-11-28 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `berat` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `berat`) VALUES
(1, 'des', 'dos', '276 gram'),
(2, 'afafdf', 'dfdsfvcv', '274 gram'),
(11, 'Smartphone Samsung Galaxy S23', 'Smartphone flagship Samsung, layar 6.1 inch, RAM 8GB.', '442 gram'),
(12, 'Laptop Asus Vivobook', 'Laptop Asus Vivobook i5, RAM 8GB, SSD 512GB.', '1286 gram'),
(13, 'Headphone Sony WH-1000XM4', 'Wireless noise-cancelling headphone.', '2106 gram'),
(14, 'Smartwatch Apple Watch Series 9', 'Smartwatch Apple terbaru, monitor detak jantung.', '770 gram'),
(15, 'TV LED LG 43 inch', 'TV LED LG Full HD 43 inci, smart TV.', '336 gram'),
(16, 'Kaos Polos Putih', 'Kaos polos bahan katun lembut, nyaman.', '2169 gram'),
(17, 'Celana Jeans Slim Fit', 'Celana jeans model slim fit trendy.', '1036 gram'),
(18, 'Sneakers Nike Air Max', 'Sepatu olahraga Nike Air Max nyaman.', '1474 gram'),
(19, 'Sepatu Adidas Superstar', 'Sepatu Adidas klasik nyaman digunakan.', '1265 gram'),
(20, 'Tas Ransel Laptop', 'Ransel multifungsi untuk laptop 15 inci.', '1800 gram'),
(21, 'Kacamata Sunglasses Aviator', 'Kacamata hitam stylish anti UV.', '2209 gram'),
(22, 'Jaket Hoodie Hitam', 'Hoodie nyaman untuk casual wear.', '2642 gram'),
(23, 'Meja Belajar Minimalis', 'Meja belajar kayu minimalis ukuran 120x60 cm.', '685 gram'),
(24, 'Kursi Kantor Ergonomis', 'Kursi kantor nyaman dengan sandaran punggung.', '1202 gram'),
(25, 'Rice Cooker Panasonic', 'Rice cooker kapasitas 1.8 liter, anti lengket.', '952 gram'),
(26, 'Blender Philips', 'Blender Philips 2L, multifungsi.', '1056 gram'),
(27, 'Kaos Polo Navy', 'Kaos polo bahan katun premium.', '2322 gram'),
(28, 'Sepatu Formal Pria', 'Sepatu kulit formal, nyaman dipakai.', '2546 gram'),
(29, 'Tas Selempang Casual', 'Tas selempang kecil untuk sehari-hari.', '2764 gram'),
(30, 'Jam Tangan Digital Casio', 'Jam tangan digital multifungsi anti air.', '281 gram'),
(31, 'Speaker Bluetooth JBL', 'Speaker portable JBL dengan bass mantap.', '1716 gram'),
(32, 'Power Bank 20000mAh', 'Power bank kapasitas besar, fast charging.', '1837 gram'),
(33, 'Topi Baseball', 'Topi baseball trendy, cocok untuk outdoor.', '1037 gram'),
(34, 'Kaos Lengan Panjang Abu', 'Kaos lengan panjang nyaman untuk musim dingin.', '2473 gram'),
(35, 'Sneakers Converse', 'Sepatu sneakers Converse klasik.', '456 gram'),
(36, 'Tas Tote Bag', 'Tote bag multifungsi untuk belanja.', '561 gram'),
(37, 'Kamera DSLR Canon 200D', 'Kamera DSLR Canon 24MP, kit lens 18-55mm.', '1336 gram'),
(38, 'Tripod Kamera', 'Tripod ringan untuk kamera DSLR/mirrorless.', '1999 gram'),
(39, 'Flashdisk 64GB', 'Flashdisk USB 3.0, cepat dan compact.', '2987 gram'),
(40, 'Harddisk Eksternal 1TB', 'Harddisk eksternal portable 1TB.', '141 gram'),
(41, 'Kipas Angin USB', 'Kipas angin mini, portable dan hemat listrik.', '341 gram'),
(42, 'Lampu LED Meja Belajar', 'Lampu LED dengan adjustable brightness.', '1183 gram'),
(43, 'Kaos Grafis', 'Kaos dengan desain grafis unik.', '1892 gram'),
(44, 'Celana Pendek Santai', 'Celana pendek santai nyaman dipakai.', '2912 gram'),
(45, 'Sepatu Slip On Casual', 'Sepatu slip on ringan dan stylish.', '2984 gram'),
(46, 'Tas Pouch Multifungsi', 'Tas pouch kecil multifungsi.', '287 gram'),
(47, 'Jaket Bomber Pria', 'Jaket bomber casual untuk pria.', '1081 gram'),
(48, 'Kacamata Sport Anti Silau', 'Kacamata olahraga dengan UV protection.', '1547 gram'),
(49, 'Kaos Hoodie', 'Kaos hoodie nyaman untuk daily wear.', '1492 gram'),
(50, 'Backpack Travel', 'Backpack multifungsi untuk traveling.', '2720 gram'),
(51, 'Jam Tangan Minimalis', 'Jam tangan analog dengan desain minimalis.', '323 gram'),
(52, 'Sneakers High Top', 'Sneakers high top casual nyaman.', '2057 gram'),
(53, 'Celana Kulot Wanita', 'Celana kulot nyaman untuk wanita.', '517 gram'),
(54, 'Topi Fedora', 'Topi fedora stylish untuk fashion.', '2114 gram'),
(55, 'Blender Mini Portable', 'Blender mini portable untuk smoothies.', '218 gram'),
(56, 'Microwave Oven', 'Microwave oven kapasitas 20L, digital.', '451 gram'),
(57, 'Tas Handbag Wanita', 'Handbag elegan wanita.', '1501 gram'),
(58, 'Speaker Mini Bluetooth', 'Speaker mini portabel, praktis.', '253 gram'),
(59, 'Sneakers Retro', 'Sepatu sneakers retro klasik.', '2463 gram'),
(60, 'Celana Panjang Santai', 'Celana panjang santai nyaman untuk sehari-hari.', '2754 gram'),
(61, 'Tablet Samsung Galaxy Tab S8', 'Tablet Samsung 11 inch, RAM 8GB, 128GB storage.', '485 gram'),
(62, 'Laptop MacBook Air M2', 'Laptop Apple M2, 8GB RAM, 256GB SSD.', '2760 gram'),
(63, 'Earbuds Xiaomi Redmi Buds', 'Wireless earbuds dengan noise cancelling.', '649 gram'),
(64, 'Kamera Mirrorless Sony Alpha 6400', 'Kamera mirrorless Sony 24MP, kit lens 16-50mm.', '664 gram'),
(65, 'TV OLED LG 55 inch', 'Smart TV OLED LG 55 inci, 4K.', '1272 gram'),
(66, 'Kaos Hoodie Abu Muda', 'Hoodie nyaman dengan desain trendy.', '1368 gram'),
(67, 'Celana Chino Pria', 'Celana chino casual untuk pria.', '2927 gram'),
(68, 'Sneakers Puma RS-X', 'Sepatu sneakers Puma nyaman untuk olahraga.', '1731 gram'),
(69, 'Sepatu Vans Old Skool', 'Sepatu klasik Vans Old Skool.', '2674 gram'),
(70, 'Tas Ransel Outdoor', 'Ransel outdoor tahan air, kapasitas besar.', '2278 gram'),
(71, 'Kacamata Sunglasses Retro', 'Kacamata hitam gaya retro, anti UV.', '367 gram'),
(72, 'Jaket Parka Pria', 'Jaket parka hangat, cocok musim dingin.', '702 gram'),
(73, 'Meja Tulis Minimalis', 'Meja tulis kayu minimalis, ukuran 100x50cm.', '2312 gram'),
(74, 'Kursi Gaming Ergonomis', 'Kursi gaming dengan sandaran punggung nyaman.', '651 gram'),
(75, 'Microwave Sharp 20L', 'Microwave Sharp kapasitas 20 liter, digital.', '2021 gram'),
(76, 'Blender Oxone 2L', 'Blender multifungsi Oxone kapasitas 2 liter.', '2252 gram'),
(77, 'Kaos Polo Hitam', 'Kaos polo bahan premium, nyaman.', '2197 gram'),
(78, 'Sepatu Formal Wanita', 'Sepatu formal kulit wanita.', '1228 gram'),
(79, 'Tas Selempang Kulit', 'Tas selempang kulit kecil stylish.', '2352 gram'),
(80, 'Jam Tangan Analog Casio', 'Jam tangan analog Casio minimalis.', '2174 gram'),
(81, 'Speaker Portable Sony', 'Speaker portable Sony, bass mantap.', '815 gram'),
(82, 'Power Bank 10000mAh', 'Power bank portable, fast charging.', '353 gram'),
(83, 'Topi Snapback', 'Topi snapback trendy untuk anak muda.', '2123 gram'),
(84, 'Kaos Lengan Panjang Navy', 'Kaos lengan panjang nyaman.', '756 gram'),
(85, 'Sneakers Reebok Classic', 'Sepatu sneakers Reebok klasik.', '212 gram'),
(86, 'Tas Backpack Sekolah', 'Tas backpack untuk sekolah/kampus.', '1594 gram'),
(87, 'Kamera Polaroid', 'Kamera polaroid untuk cetak foto instan.', '1432 gram'),
(88, 'Tripod Mini', 'Tripod mini portable untuk kamera smartphone.', '2280 gram'),
(89, 'Flashdisk 128GB', 'Flashdisk kapasitas besar USB 3.0.', '1202 gram'),
(90, 'Harddisk Eksternal 2TB', 'Harddisk eksternal portable 2TB.', '1973 gram'),
(91, 'Kipas Angin Standing', 'Kipas angin berdiri 3 speed.', '360 gram'),
(92, 'Lampu LED Standing', 'Lampu LED standing, adjustable brightness.', '1582 gram'),
(93, 'Kaos Grafis Pria', 'Kaos dengan desain grafis keren.', '931 gram'),
(94, 'Celana Pendek Olahraga', 'Celana pendek olahraga nyaman.', '2708 gram'),
(95, 'Sepatu Slip On Wanita', 'Sepatu slip on ringan dan nyaman.', '1946 gram'),
(96, 'Tas Pouch Travel', 'Tas pouch kecil untuk travel.', '1510 gram'),
(97, 'Jaket Windbreaker', 'Jaket windbreaker ringan, water resistant.', '1610 gram'),
(98, 'Kacamata Sport UV Protection', 'Kacamata sport anti silau.', '519 gram'),
(99, 'Kaos Hoodie Navy', 'Kaos hoodie nyaman daily wear.', '568 gram'),
(100, 'Backpack Laptop', 'Backpack multifungsi untuk laptop.', '1183 gram'),
(101, 'Jam Tangan Fashion Wanita', 'Jam tangan fashion untuk wanita.', '1210 gram'),
(102, 'Sneakers Casual Pria', 'Sneakers casual nyaman.', '2401 gram'),
(103, 'Celana Jeans Wanita', 'Celana jeans wanita trendy.', '2476 gram'),
(104, 'Topi Bucket', 'Topi bucket casual.', '2176 gram'),
(105, 'Blender Personal', 'Blender portable personal untuk smoothies.', '454 gram'),
(106, 'Microwave Oven Digital', 'Microwave oven digital, 25L.', '1442 gram'),
(107, 'Tas Handbag Elegan', 'Handbag elegan wanita.', '2849 gram'),
(108, 'Speaker Mini Portable', 'Speaker mini portabel.', '1120 gram'),
(109, 'Sneakers Retro Pria', 'Sneakers retro klasik pria.', '2753 gram'),
(110, 'Celana Panjang Santai Wanita', 'Celana panjang santai nyaman.', '1603 gram'),
(111, 'Smartphone Xiaomi Redmi Note 12', 'Smartphone Xiaomi, RAM 6GB, 128GB storage.', '2560 gram'),
(112, 'Laptop Lenovo IdeaPad', 'Laptop Lenovo i5, RAM 8GB, SSD 512GB.', '2092 gram'),
(113, 'Earbuds Apple Airpods', 'Wireless earbuds Apple Airpods generasi terbaru.', '2677 gram'),
(114, 'Kamera DSLR Nikon D5600', 'Kamera DSLR Nikon 24MP, kit lens 18-55mm.', '1213 gram'),
(115, 'TV LED Samsung 50 inch', 'Smart TV Samsung LED 50 inci, Full HD.', '832 gram'),
(116, 'Kaos Polos Hitam', 'Kaos polos bahan katun premium.', '422 gram'),
(117, 'Celana Chino Wanita', 'Celana chino casual wanita.', '2413 gram'),
(118, 'Sneakers Nike Air Force 1', 'Sneakers Nike nyaman dan stylish.', '2002 gram'),
(119, 'Sepatu Formal Pria Kulit', 'Sepatu kulit formal pria.', '2670 gram'),
(120, 'Tas Ransel Casual', 'Ransel casual untuk aktivitas sehari-hari.', '1444 gram'),
(121, 'Kacamata Sunglasses Modern', 'Kacamata hitam modern anti UV.', '2011 gram'),
(122, 'Jaket Hoodie Abu', 'Jaket hoodie nyaman dan stylish.', '2723 gram'),
(123, 'Meja Komputer Minimalis', 'Meja komputer minimalis kayu.', '1681 gram'),
(124, 'Kursi Kantor Minimalis', 'Kursi kantor nyaman untuk kerja.', '140 gram'),
(125, 'Rice Cooker Sharp', 'Rice cooker kapasitas 1.8L, anti lengket.', '1356 gram'),
(126, 'Blender Philips 1.5L', 'Blender Philips multifungsi 1.5L.', '459 gram'),
(127, 'Kaos Polo Putih', 'Kaos polo bahan premium, nyaman.', '1029 gram'),
(128, 'Sepatu Sandal Pria', 'Sandal pria nyaman dipakai.', '770 gram'),
(129, 'Tas Selempang Trendy', 'Tas selempang stylish dan casual.', '660 gram'),
(130, 'Jam Tangan Digital LED', 'Jam tangan digital LED multifungsi.', '893 gram'),
(131, 'Speaker Bluetooth Mini', 'Speaker Bluetooth mini portabel.', '2387 gram'),
(132, 'Power Bank 30000mAh', 'Power bank besar, fast charging.', '453 gram'),
(133, 'Topi Baseball Hitam', 'Topi baseball trendy untuk pria.', '806 gram'),
(134, 'Kaos Lengan Panjang Putih', 'Kaos lengan panjang nyaman.', '2572 gram'),
(135, 'Sneakers Adidas NMD', 'Sepatu sneakers Adidas NMD nyaman.', '1642 gram'),
(136, 'Tas Backpack Sekolah Anak', 'Tas backpack untuk anak sekolah.', '394 gram'),
(137, 'Kamera Digital Canon', 'Kamera digital Canon untuk foto harian.', '2744 gram'),
(138, 'Tripod Kamera Mini', 'Tripod portable untuk kamera.', '839 gram'),
(139, 'Flashdisk 32GB', 'Flashdisk USB 3.0 cepat.', '1661 gram'),
(140, 'Harddisk Eksternal 4TB', 'Harddisk eksternal portable 4TB.', '2792 gram'),
(141, 'Kipas Angin Meja', 'Kipas angin meja, portable.', '178 gram'),
(142, 'Lampu LED Meja Portable', 'Lampu LED meja portable.', '1114 gram'),
(143, 'Kaos Grafis Wanita', 'Kaos grafis unik untuk wanita.', '2038 gram'),
(144, 'Celana Pendek Santai Pria', 'Celana pendek santai pria.', '945 gram'),
(145, 'Sepatu Slip On Pria', 'Sepatu slip on pria nyaman.', '1414 gram'),
(146, 'Tas Pouch Gadget', 'Tas pouch untuk gadget.', '1234 gram'),
(147, 'Jaket Bomber Wanita', 'Jaket bomber stylish wanita.', '1828 gram'),
(148, 'Kacamata Anti Silau', 'Kacamata stylish anti silau.', '2439 gram'),
(149, 'Kaos Hoodie Hitam', 'Kaos hoodie hitam nyaman daily wear.', '813 gram'),
(150, 'Backpack Traveling', 'Backpack multifungsi untuk traveling.', '2446 gram'),
(151, 'x123334', 'ads', '994 gram');

-- --------------------------------------------------------

--
-- Table structure for table `qty`
--

DROP TABLE IF EXISTS `qty`;
CREATE TABLE IF NOT EXISTS `qty` (
  `id_prod` int NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `qty`
--

INSERT INTO `qty` (`id_prod`, `qty`) VALUES
(2, 2),
(5, 65),
(11, 25),
(12, 15),
(13, 30),
(14, 20),
(15, 10),
(16, 100),
(17, 80),
(18, 60),
(19, 50),
(20, 40),
(21, 70),
(22, 35),
(23, 20),
(24, 15),
(25, 25),
(26, 30),
(27, 90),
(28, 40),
(29, 25),
(30, 35),
(31, 18),
(32, 40),
(33, 50),
(34, 45),
(35, 60),
(36, 30),
(37, 12),
(38, 15),
(39, 20),
(40, 25),
(41, 30),
(42, 20),
(43, 60),
(44, 75),
(45, 40),
(46, 30),
(47, 35),
(48, 25),
(49, 50),
(50, 20),
(51, 30),
(52, 25),
(53, 40),
(54, 20),
(55, 15),
(56, 12),
(57, 30),
(58, 25),
(59, 35),
(60, 40),
(61, 15),
(62, 10),
(63, 50),
(64, 8),
(65, 5),
(66, 100),
(67, 120),
(68, 40),
(69, 60),
(70, 80),
(71, 150),
(72, 70),
(73, 20),
(74, 25),
(75, 30),
(76, 35),
(77, 90),
(78, 55),
(79, 45),
(80, 100),
(81, 25),
(82, 60),
(83, 120),
(84, 95),
(85, 50),
(86, 85),
(87, 15),
(88, 40),
(89, 200),
(90, 10),
(91, 30),
(92, 25),
(93, 80),
(94, 100),
(95, 45),
(96, 70),
(97, 60),
(98, 90),
(99, 75),
(100, 110),
(101, 50),
(102, 55),
(103, 65),
(104, 80),
(105, 20),
(106, 15),
(107, 90),
(108, 30),
(109, 60),
(110, 85),
(111, 10),
(112, 8),
(113, 50),
(114, 12),
(115, 5),
(116, 100),
(117, 80),
(118, 40),
(119, 25),
(120, 75),
(121, 60),
(122, 95),
(123, 20),
(124, 25),
(125, 30),
(126, 35),
(127, 90),
(128, 50),
(129, 70),
(130, 60),
(131, 25),
(132, 60),
(133, 120),
(134, 90),
(135, 50),
(136, 85),
(137, 15),
(138, 40),
(139, 200),
(140, 10),
(141, 30),
(142, 25),
(143, 80),
(144, 100),
(145, 45),
(146, 70),
(147, 60),
(148, 90),
(149, 75),
(150, 110);

-- --------------------------------------------------------

--
-- Table structure for table `raja_ongkir`
--

DROP TABLE IF EXISTS `raja_ongkir`;
CREATE TABLE IF NOT EXISTS `raja_ongkir` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shipping_cost` varchar(255) NOT NULL,
  `shipping_delivery` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-----------------------------------------------------------
--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Memiliki akses penuh ke sistem', '2025-10-01 10:26:10', '2025-10-01 10:26:10'),
(2, 'seller', 'Dapat menambah & mengelola produk', '2025-10-01 10:26:10', '2025-10-01 10:27:29'),
(3, 'user', 'Dapat membeli produk di marketplace', '2025-10-01 10:26:10', '2025-10-01 10:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id_slider` int NOT NULL AUTO_INCREMENT,
  `nama_slider` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_slider`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx`
--

DROP TABLE IF EXISTS `trx`;
CREATE TABLE IF NOT EXISTS `trx` (
  `id` varchar(30) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` int NOT NULL,
  `paid` int NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `grand_total` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trx`
--

INSERT INTO `trx` (`id`, `tanggal`, `total`, `paid`, `payment_method`, `grand_total`) VALUES
('TRX25120809481614841', '2025-12-08 09:48:16', 8500000, 0, 'COD', 8508000),
('TRX25120809524683049', '2025-12-08 09:52:46', 5000000, 0, 'COD', 5008000),
('TRX25120810195173163', '2025-12-08 10:19:51', 13000000, 0, 'Online', 13011000),
('TRX25120810340651677', '2025-12-08 10:34:06', 13000000, 0, 'Online', 13010000),
('TRX25120810440662330', '2025-12-08 10:44:06', 9000000, 0, 'Online', 9022000),
('TRX25120810500272667', '2025-12-08 10:50:02', 9000000, 0, 'Online', 9016000),
('TRX25120810503288797', '2025-12-08 10:50:32', 9000000, 0, 'Online', 9016000),
('TRX25120810513445115', '2025-12-08 10:51:34', 9000000, 0, 'Online', 9020000),
('TRX25120811012536647', '2025-12-08 11:01:25', 9000000, 0, 'COD', 9022000),
('TRX25120811052538413', '2025-12-08 11:05:25', 3500000, 0, 'COD', 3533000),
('TRX25120811133961282', '2025-12-08 11:13:39', 1250000, 0, 'COD', 1272000),
('TRX25120811183022420', '2025-12-08 11:18:30', 1, 0, 'COD', 8001);

-- --------------------------------------------------------

--
-- Table structure for table `trx_detail`
--

DROP TABLE IF EXISTS `trx_detail`;
CREATE TABLE IF NOT EXISTS `trx_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trx_id` varchar(30) NOT NULL,
  `id_barang` int NOT NULL,
  `qty` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `subtotal` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trx_id` (`trx_id`),
  KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trx_detail`
--

INSERT INTO `trx_detail` (`id`, `trx_id`, `id_barang`, `qty`, `harga_satuan`, `subtotal`) VALUES
(31, '0', 23, 1, 450000, 450000),
(32, '0', 14, 1, 8500000, 8500000),
(33, 'TRX25120809524683049', 15, 1, 5000000, 5000000),
(34, 'TRX25120810195173163', 11, 1, 13000000, 13000000),
(35, 'TRX25120810340651677', 11, 1, 13000000, 13000000),
(36, 'TRX25120810440662330', 12, 1, 9000000, 9000000),
(37, 'TRX25120810500272667', 12, 1, 9000000, 9000000),
(38, 'TRX25120810513445115', 12, 1, 9000000, 9000000),
(39, 'TRX25120811012536647', 12, 1, 9000000, 9000000),
(40, 'TRX25120811052538413', 13, 1, 3500000, 3500000),
(41, 'TRX25120811133961282', 19, 1, 1250000, 1250000),
(42, 'TRX25120811183022420', 2, 1, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
