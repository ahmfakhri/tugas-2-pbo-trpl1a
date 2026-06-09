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
  `id_pasien` varchar(10) NOT NULL,
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
('P001', 'Ahmad Fauzi', 30, 4, '500000.00', 'BPJS'),
('P002', 'Dewi Lestari', 25, 3, '450000.00', 'BPJS'),
('P003', 'Rudi Hartono', 45, 7, '600000.00', 'BPJS'),
('P004', 'Nina Marlina', 32, 2, '550000.00', 'BPJS'),
('P005', 'Bambang Sutrisno', 50, 5, '700000.00', 'BPJS'),
('P006', 'Putri Ayu', 27, 4, '800000.00', 'ASURANSI'),
('P007', 'Fajar Nugroho', 36, 6, '900000.00', 'ASURANSI'),
('P008', 'Intan Permata', 29, 3, '750000.00', 'ASURANSI'),
('P009', 'Rizky Ramadhan', 41, 8, '850000.00', 'ASURANSI'),
('P010', 'Salsa Nabila', 34, 5, '950000.00', 'ASURANSI'),
('P011', 'Yoga Pratama', 22, 2, '400000.00', 'UMUM'),
('P012', 'Maya Sari', 38, 4, '500000.00', 'UMUM'),
('P013', 'Doni Saputra', 31, 3, '450000.00', 'UMUM'),
('P014', 'Wulan Cahya', 26, 6, '550000.00', 'UMUM'),
('P015', 'Arif Setiawan', 47, 5, '650000.00', 'UMUM'),
('P016', 'Lukman Hakim', 40, 4, '700000.00', 'BPJS'),
('P017', 'Siti Rahma', 28, 2, '500000.00', 'ASURANSI'),
('P018', 'Eko Prasetyo', 35, 7, '600000.00', 'UMUM'),
('P019', 'Fitri Handayani', 24, 3, '450000.00', 'BPJS'),
('P020', 'Dimas Anggara', 33, 5, '800000.00', 'ASURANSI'),
('P021', 'Ahmad Fauzi', 30, 4, '500000.00', 'BPJS'),
('P022', 'Dewi Lestari', 25, 3, '450000.00', 'BPJS'),
('P023', 'Rudi Hartono', 45, 7, '600000.00', 'BPJS'),
('P024', 'Nina Marlina', 32, 2, '550000.00', 'BPJS'),
('P025', 'Bambang Sutrisno', 50, 5, '700000.00', 'BPJS'),
('P026', 'Putri Ayu', 27, 4, '800000.00', 'ASURANSI'),
('P027', 'Fajar Nugroho', 36, 6, '900000.00', 'ASURANSI'),
('P028', 'Intan Permata', 29, 3, '750000.00', 'ASURANSI'),
('P029', 'Rizky Ramadhan', 41, 8, '850000.00', 'ASURANSI'),
('P030', 'Salsa Nabila', 34, 5, '950000.00', 'ASURANSI'),
('P031', 'Yoga Pratama', 22, 2, '400000.00', 'UMUM'),
('P032', 'Maya Sari', 38, 4, '500000.00', 'UMUM'),
('P033', 'Doni Saputra', 31, 3, '450000.00', 'UMUM'),
('P034', 'Wulan Cahya', 26, 6, '550000.00', 'UMUM'),
('P035', 'Arif Setiawan', 47, 5, '650000.00', 'UMUM'),
('P036', 'Lukman Hakim', 40, 4, '700000.00', 'BPJS'),
('P037', 'Siti Rahma', 28, 2, '500000.00', 'ASURANSI'),
('P038', 'Eko Prasetyo', 35, 7, '600000.00', 'UMUM'),
('P039', 'Fitri Handayani', 24, 3, '450000.00', 'BPJS'),
('P040', 'Dimas Anggara', 33, 5, '800000.00', 'ASURANSI');

-- --------------------------------------------------------

--
-- Table structure for table `pasien_asuransi`
--

CREATE TABLE `pasien_asuransi` (
  `id_asuransi` varchar(10) NOT NULL,
  `id_pasien` varchar(10) NOT NULL,
  `nama_provider` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_polis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `limit_cover` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien_asuransi`
--

INSERT INTO `pasien_asuransi` (`id_asuransi`, `id_pasien`, `nama_provider`, `nomor_polis`, `limit_cover`) VALUES
('AS001', 'P006', 'Prudential', 'POL1001', '3000000.00'),
('AS002', 'P007', 'Allianz', 'POL1002', '5000000.00'),
('AS003', 'P008', 'AXA Mandiri', 'POL1003', '4000000.00'),
('AS004', 'P009', 'Sinarmas', 'POL1004', '3500000.00'),
('AS005', 'P010', 'Manulife', 'POL1005', '4500000.00'),
('AS006', 'P017', 'AIA', 'POL1006', '5000000.00'),
('AS007', 'P020', 'Prudential', 'POL1007', '6000000.00'),
('AS008', 'P026', 'Allianz', 'POL1008', '5500000.00'),
('AS009', 'P027', 'AXA Mandiri', 'POL1009', '4000000.00'),
('AS010', 'P028', 'Sinarmas', 'POL1010', '3500000.00'),
('AS011', 'P029', 'Manulife', 'POL1011', '4500000.00'),
('AS012', 'P030', 'AIA', 'POL1012', '5000000.00'),
('AS013', 'P037', 'Prudential', 'POL1013', '6000000.00'),
('AS014', 'P040', 'Allianz', 'POL1014', '5500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `pasien_bpjs`
--

CREATE TABLE `pasien_bpjs` (  `id_pasien` varchar(10) NOT NULL,
  `nomor_pbi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `faskes_asal` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kelas_kamar` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien_bpjs`
--

INSERT INTO `pasien_bpjs` (`id_pasien`, `nomor_pbi`, `faskes_asal`, `kelas_kamar`) VALUES
('P001', 'BPJS001', 'Puskesmas Jetis', 'Kelas 1'),
('P002', 'BPJS002', 'Puskesmas Bantul', 'Kelas 3'),
('P003', 'BPJS003', 'Puskesmas Sleman', 'Kelas 2'),
('P004', 'BPJS004', 'Puskesmas Wonosari', 'Kelas 1'),
('P005', 'BPJS005', 'Puskesmas Depok', 'Kelas 3'),
('P016', 'BPJS006', 'Puskesmas Mlati', 'Kelas 2'),
('P019', 'BPJS007', 'Puskesmas Gamping', 'Kelas 1'),
('P021', 'BPJS008', 'Puskesmas Kasihan', 'Kelas 3'),
('P022', 'BPJS009', 'Puskesmas Bantul', 'Kelas 2'),
('P023', 'BPJS010', 'Puskesmas Sleman', 'Kelas 1'),
('P024', 'BPJS011', 'Puskesmas Wonosari', 'Kelas 3'),
('P025', 'BPJS012', 'Puskesmas Depok', 'Kelas 2'),
('P036', 'BPJS013', 'Puskesmas Mlati', 'Kelas 1'),
('P039', 'BPJS014', 'Puskesmas Gamping', 'Kelas 3');

-- --------------------------------------------------------

--
-- Table structure for table `pasien_umum`
--

CREATE TABLE `pasien_umum` (
  `id_umum` varchar(10) NOT NULL,
  `id_pasien` varchar(10) NOT NULL,
  `nik` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `metode_pembayaran` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien_umum`
--

INSERT INTO `pasien_umum` (`id_umum`, `id_pasien`, `nik`, `metode_pembayaran`) VALUES
('UM001', 'P011', '3401010101010001', 'Tunai'),
('UM002', 'P012', '3401010101010002', 'Transfer Bank'),
('UM003', 'P013', '3401010101010003', 'QRIS'),
('UM004', 'P014', '3401010101010004', 'Debit'),
('UM005', 'P015', '3401010101010005', 'Kartu Kredit'),
('UM006', 'P018', '3401010101010006', 'Transfer Bank'),
('UM007', 'P031', '3401010101010007', 'Tunai'),
('UM008', 'P032', '3401010101010008', 'Transfer Bank'),
('UM009', 'P033', '3401010101010009', 'QRIS'),
('UM010', 'P034', '3401010101010010', 'Debit'),
('UM011', 'P035', '3401010101010011', 'Kartu Kredit'),
('UM012', 'P038', '3401010101010012', 'Transfer Bank');

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
