-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 05:19 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbantrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_user`
--

CREATE TABLE `acl_user` (
  `id_acl` int(11) NOT NULL,
  `id_pegawai_pasien` varchar(16) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl_user`
--

INSERT INTO `acl_user` (`id_acl`, `id_pegawai_pasien`, `username`, `password`, `role`) VALUES
(1, '1234', 'Maria', '202cb962ac59075b964b07152d234b', 'admin'),
(2, '3456', 'ade', '202cb962ac59075b964b07152d234b70', 'pasien');

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `no_antrian` int(11) NOT NULL,
  `id_antrian` varchar(10) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_pasien` varchar(16) NOT NULL,
  `id_pegawai` varchar(16) DEFAULT NULL,
  `aktif` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`no_antrian`, `id_antrian`, `tanggal`, `id_pasien`, `id_pegawai`, `aktif`) VALUES
(1, 'A0001', '2021-06-21 03:15:25', '2434325435', '123', 'Y'),
(2, 'A0002', '2021-06-21 07:13:32', '444455', '123', 'Y'),
(3, 'A0003', '2021-06-21 10:10:08', '12345', '123', 'Y'),
(4, 'A0004', '2021-06-21 18:12:07', '111111', '123', 'Y'),
(5, 'A0005', '2021-06-21 21:11:08', '111123', '123', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` varchar(16) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `usia` int(2) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `jenis_kelamin`, `usia`, `alamat`, `email`) VALUES
('2434325435', 'ade y', 'L', 30, 'Bekasi', 'ade@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(16) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `no_telepon` int(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `no_telepon`, `alamat`, `email`) VALUES
('123', 'Maria', 988872, 'Jakarta', 'maria@gmail.com'),
('1234567', 'Ade Y', 99998888, 'bekasi', 'adey@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl_user`
--
ALTER TABLE `acl_user`
  ADD PRIMARY KEY (`id_acl`);

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`no_antrian`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acl_user`
--
ALTER TABLE `acl_user`
  MODIFY `id_acl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `no_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
