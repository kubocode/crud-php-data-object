-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Nov 2016 pada 08.09
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pdo_crud`
--
CREATE DATABASE IF NOT EXISTS `db_pdo_crud` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_pdo_crud`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `dibuat` datetime NOT NULL,
  `dimodifikasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `nama`, `dibuat`, `dimodifikasi`) VALUES
(1, 'Fashion', '2014-06-01 00:35:07', '2014-05-31 02:34:33'),
(2, 'Electronics', '2014-06-01 00:35:07', '2014-05-31 02:34:33'),
(3, 'Motors', '2014-06-01 00:35:07', '2014-05-31 02:34:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `dibuat` datetime NOT NULL,
  `dimodifikasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `nama`, `keterangan`, `harga`, `category_id`, `dibuat`, `dimodifikasi`) VALUES
(1, 'Nokia Lumia', 'Smartphone Nokia', 336, 2, '0000-00-00 00:00:00', '2016-11-13 07:00:57'),
(2, 'Google Nexus 4', 'Handphone mahal', 299, 2, '0000-00-00 00:00:00', '2016-11-13 06:59:47'),
(3, 'Samsung Galaxy S4', 'Smartphone orang kaya !', 600, 2, '0000-00-00 00:00:00', '2016-11-13 07:01:33'),
(7, 'Laptop Asus', 'Buat Coding', 399, 2, '2014-06-01 01:13:45', '2016-11-13 07:00:06'),
(8, 'Tas Distro', 'Tas Bagus', 25, 1, '2014-06-01 01:14:13', '2016-11-13 07:02:18'),
(9, 'Jam Dinding', 'Jam dinding pun tertawa', 900000, 2, '2014-06-01 01:18:36', '2016-11-13 04:53:22'),
(10, 'Sony Smart Watch', 'Jam tangan modern', 300, 2, '2014-06-06 17:10:01', '2016-11-13 07:02:38'),
(12, 'Baju Pramuka', 'Khusus bocah', 60, 1, '2014-06-06 17:12:21', '2016-11-13 06:59:25'),
(13, 'Baju Distro', 'Baju Keren Coy', 190000, 1, '2014-06-06 17:12:59', '2016-11-13 05:15:34'),
(14, 'Tes', 'Tes', 100, 3, '2016-11-12 22:47:56', '2016-11-12 15:47:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
