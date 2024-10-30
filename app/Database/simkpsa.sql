-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 06:08 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simkpsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `desc` varchar(255) NOT NULL,
  `nominal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `date`, `desc`, `nominal`) VALUES
(19, '2024-10-08', 'Modal', '30000000.00'),
(20, '2024-09-11', 'Modal', '30000000.00'),
(21, '2024-10-28', 'Modal', '15000000.00'),
(22, '2024-10-16', 'Modal', '11111111.00'),
(23, '2025-01-15', 'Modal', '40000.00'),
(24, '2024-05-14', 'Modal', '44444444.00'),
(25, '2024-10-28', 'Listrik', '2000000.00'),
(26, '2024-10-29', 'Modal', '11111111.00');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `totalisator_awal` decimal(15,2) NOT NULL,
  `totalisator_akhir` decimal(15,2) NOT NULL,
  `sales` decimal(15,2) NOT NULL,
  `price_unit` decimal(10,2) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `dipping1` decimal(15,2) NOT NULL,
  `dipping2` decimal(15,2) DEFAULT NULL,
  `dipping3` decimal(15,2) DEFAULT NULL,
  `dipping4` decimal(15,2) NOT NULL,
  `pengiriman` enum('yes','no') NOT NULL,
  `pumptes` enum('yes','no') NOT NULL,
  `besartes` decimal(15,2) DEFAULT NULL,
  `losses` decimal(15,2) DEFAULT NULL,
  `besar_pengiriman` decimal(15,2) DEFAULT NULL,
  `waktupengiriman` enum('Pagi','Siang','Malam') DEFAULT NULL,
  `stok_terpakai` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `tanggal`, `totalisator_awal`, `totalisator_akhir`, `sales`, `price_unit`, `total`, `dipping1`, `dipping2`, `dipping3`, `dipping4`, `pengiriman`, `pumptes`, `besartes`, `losses`, `besar_pengiriman`, `waktupengiriman`, `stok_terpakai`) VALUES
(5, '2024-10-01', '297388.26', '298749.04', '1360.78', '12000.00', '16329360.00', '122.70', NULL, NULL, '55.20', 'no', 'no', NULL, '0.93', NULL, NULL, '1359.85'),
(9, '2024-10-28', '298749.04', '299500.00', '750.96', '11000.00', '8260560.00', '55.20', NULL, NULL, '10.00', 'no', 'no', NULL, '-159.64', NULL, NULL, '910.60');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2024-10-22-045253', 'App\\Database\\Migrations\\Pengguna', 'default', 'App', 1729573018, 1),
(3, '2024-10-24-070542', 'App\\Database\\Migrations\\Produk', 'default', 'App', 1729753639, 2),
(4, '2024-10-24-073726', 'App\\Database\\Migrations\\Expense', 'default', 'App', 1729755589, 3),
(7, '2024-10-24-073917', 'App\\Database\\Migrations\\Income', 'default', 'App', 1729945935, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama`) VALUES
(1, 'admin', '$2y$10$ijsOilc8JPmp6JUb9Ex0oOkDjGoSTJO38AMSAGT90XTjPMNhXnsjy', 'Pertashop 3P.45301');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `harga_jual` decimal(15,2) NOT NULL,
  `harga_beli` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `harga_jual`, `harga_beli`) VALUES
(1, '12000.00', '11000.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tanggal` (`tanggal`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
