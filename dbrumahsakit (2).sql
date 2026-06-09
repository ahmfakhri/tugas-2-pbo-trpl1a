-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 09, 2026 at 07:54 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbrumahsakit`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `usia` int NOT NULL,
  `lama_rawat` int NOT NULL,
  `biaya_kamar_per_hari` decimal(15,2) NOT NULL,
  `jenis_pasien` enum('BPJS','ASURANSI','UMUM') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama`, `usia`, `lama_rawat`, `biaya_kamar_per_hari`, `jenis_pasien`) VALUES
(1, 'Ahmad Fauzi', 30, 4, '500000.00', 'BPJS'),
(2, 'Dewi Lestari', 25, 3, '450000.00', 'BPJS'),
(3, 'Rudi Hartono', 45, 7, '600000.00', 'BPJS'),
(4, 'Nina Marlina', 32, 2, '550000.00', 'BPJS'),
(5, 'Bambang Sutrisno', 50, 5, '700000.00', 'BPJS'),
(6, 'Putri Ayu', 27, 4, '800000.00', 'ASURANSI'),
(7, 'Fajar Nugroho', 36, 6, '900000.00', 'ASURANSI'),
(8, 'Intan Permata', 29, 3, '750000.00', 'ASURANSI'),
(9, 'Rizky Ramadhan', 41, 8, '850000.00', 'ASURANSI'),
(10, 'Salsa Nabila', 34, 5, '950000.00', 'ASURANSI'),
(11, 'Yoga Pratama', 22, 2, '400000.00', 'UMUM'),
(12, 'Maya Sari', 38, 4, '500000.00', 'UMUM'),
(13, 'Doni Saputra', 31, 3, '450000.00', 'UMUM'),
(14, 'Wulan Cahya', 26, 6, '550000.00', 'UMUM'),
(15, 'Arif Setiawan', 47, 5, '650000.00', 'UMUM'),
(16, 'Lukman Hakim', 40, 4, '700000.00', 'BPJS'),
(17, 'Siti Rahma', 28, 2, '500000.00', 'ASURANSI'),
(18, 'Eko Prasetyo', 35, 7, '600000.00', 'UMUM'),
(19, 'Fitri Handayani', 24, 3, '450000.00', 'BPJS'),
(20, 'Dimas Anggara', 33, 5, '800000.00', 'ASURANSI'),
(21, 'Ahmad Fauzi', 30, 4, '500000.00', 'BPJS'),
(22, 'Dewi Lestari', 25, 3, '450000.00', 'BPJS'),
(23, 'Rudi Hartono', 45, 7, '600000.00', 'BPJS'),
(24, 'Nina Marlina', 32, 2, '550000.00', 'BPJS'),
(25, 'Bambang Sutrisno', 50, 5, '700000.00', 'BPJS'),
(26, 'Putri Ayu', 27, 4, '800000.00', 'ASURANSI'),
(27, 'Fajar Nugroho', 36, 6, '900000.00', 'ASURANSI'),
(28, 'Intan Permata', 29, 3, '750000.00', 'ASURANSI'),
(29, 'Rizky Ramadhan', 41, 8, '850000.00', 'ASURANSI'),
(30, 'Salsa Nabila', 34, 5, '950000.00', 'ASURANSI'),
(31, 'Yoga Pratama', 22, 2, '400000.00', 'UMUM'),
(32, 'Maya Sari', 38, 4, '500000.00', 'UMUM'),
(33, 'Doni Saputra', 31, 3, '450000.00', 'UMUM'),
(34, 'Wulan Cahya', 26, 6, '550000.00', 'UMUM'),
(35, 'Arif Setiawan', 47, 5, '650000.00', 'UMUM'),
(36, 'Lukman Hakim', 40, 4, '700000.00', 'BPJS'),
(37, 'Siti Rahma', 28, 2, '500000.00', 'ASURANSI'),
(38, 'Eko Prasetyo', 35, 7, '600000.00', 'UMUM'),
(39, 'Fitri Handayani', 24, 3, '450000.00', 'BPJS'),
(40, 'Dimas Anggara', 33, 5, '800000.00', 'ASURANSI');

-- --------------------------------------------------------

--
-- Table structure for table `pasien_asuransi`
--

CREATE TABLE `pasien_asuransi` (
  `id_asuransi` int NOT NULL,
  `id_pasien` int NOT NULL,
  `nama_provider` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_polis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `limit_cover` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien_asuransi`
--

INSERT INTO `pasien_asuransi` (`id_asuransi`, `id_pasien`, `nama_provider`, `nomor_polis`, `limit_cover`) VALUES
(1, 6, 'Prudential', 'POL1001', '3000000.00'),
(2, 7, 'Allianz', 'POL1002', '5000000.00'),
(3, 8, 'AXA Mandiri', 'POL1003', '4000000.00'),
(4, 9, 'Sinarmas', 'POL1004', '3500000.00'),
(5, 10, 'Manulife', 'POL1005', '4500000.00'),
(6, 17, 'AIA', 'POL1006', '5000000.00'),
(7, 20, 'Prudential', 'POL1007', '6000000.00'),
(8, 26, 'Allianz', 'POL1008', '5500000.00'),
(9, 27, 'AXA Mandiri', 'POL1009', '4000000.00'),
(10, 28, 'Sinarmas', 'POL1010', '3500000.00'),
(11, 29, 'Manulife', 'POL1011', '4500000.00'),
(12, 30, 'AIA', 'POL1012', '5000000.00'),
(13, 37, 'Prudential', 'POL1013', '6000000.00'),
(14, 40, 'Allianz', 'POL1014', '5500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `pasien_bpjs`
--

CREATE TABLE `pasien_bpjs` (
  `id_bpjs` int NOT NULL,
  `id_pasien` int NOT NULL,
  `nomor_pbi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `faskes_asal` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kelas_kamar` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien_bpjs`
--

INSERT INTO `pasien_bpjs` (`id_bpjs`, `id_pasien`, `nomor_pbi`, `faskes_asal`, `kelas_kamar`) VALUES
(1, 1, 'BPJS001', 'Puskesmas Jetis', 'Kelas 1'),
(2, 2, 'BPJS002', 'Puskesmas Bantul', 'Kelas 3'),
(3, 3, 'BPJS003', 'Puskesmas Sleman', 'Kelas 2'),
(4, 4, 'BPJS004', 'Puskesmas Wonosari', 'Kelas 1'),
(5, 5, 'BPJS005', 'Puskesmas Depok', 'Kelas 3'),
(6, 16, 'BPJS006', 'Puskesmas Mlati', 'Kelas 2'),
(7, 19, 'BPJS007', 'Puskesmas Gamping', 'Kelas 1'),
(8, 21, 'BPJS008', 'Puskesmas Kasihan', 'Kelas 3'),
(9, 22, 'BPJS009', 'Puskesmas Bantul', 'Kelas 2'),
(10, 23, 'BPJS010', 'Puskesmas Sleman', 'Kelas 1'),
(11, 24, 'BPJS011', 'Puskesmas Wonosari', 'Kelas 3'),
(12, 25, 'BPJS012', 'Puskesmas Depok', 'Kelas 2'),
(13, 36, 'BPJS013', 'Puskesmas Mlati', 'Kelas 1'),
(14, 39, 'BPJS014', 'Puskesmas Gamping', 'Kelas 3');

-- --------------------------------------------------------

--
-- Table structure for table `pasien_umum`
--

CREATE TABLE `pasien_umum` (
  `id_umum` int NOT NULL,
  `id_pasien` int NOT NULL,
  `nik` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `metode_pembayaran` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien_umum`
--

INSERT INTO `pasien_umum` (`id_umum`, `id_pasien`, `nik`, `metode_pembayaran`) VALUES
(1, 11, '3401010101010001', 'Tunai'),
(2, 12, '3401010101010002', 'Transfer Bank'),
(3, 13, '3401010101010003', 'QRIS'),
(4, 14, '3401010101010004', 'Debit'),
(5, 15, '3401010101010005', 'Kartu Kredit'),
(6, 18, '3401010101010006', 'Transfer Bank'),
(7, 31, '3401010101010007', 'Tunai'),
(8, 32, '3401010101010008', 'Transfer Bank'),
(9, 33, '3401010101010009', 'QRIS'),
(10, 34, '3401010101010010', 'Debit'),
(11, 35, '3401010101010011', 'Kartu Kredit'),
(12, 38, '3401010101010012', 'Transfer Bank');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `pasien_asuransi`
--
ALTER TABLE `pasien_asuransi`
  ADD PRIMARY KEY (`id_asuransi`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `pasien_bpjs`
--
ALTER TABLE `pasien_bpjs`
  ADD PRIMARY KEY (`id_bpjs`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `pasien_umum`
--
ALTER TABLE `pasien_umum`
  ADD PRIMARY KEY (`id_umum`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pasien_asuransi`
--
ALTER TABLE `pasien_asuransi`
  MODIFY `id_asuransi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pasien_bpjs`
--
ALTER TABLE `pasien_bpjs`
  MODIFY `id_bpjs` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pasien_umum`
--
ALTER TABLE `pasien_umum`
  MODIFY `id_umum` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pasien_asuransi`
--
ALTER TABLE `pasien_asuransi`
  ADD CONSTRAINT `pasien_asuransi_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE;

--
-- Constraints for table `pasien_bpjs`
--
ALTER TABLE `pasien_bpjs`
  ADD CONSTRAINT `pasien_bpjs_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE;

--
-- Constraints for table `pasien_umum`
--
ALTER TABLE `pasien_umum`
  ADD CONSTRAINT `pasien_umum_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
