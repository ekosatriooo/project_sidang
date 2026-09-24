-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2026 at 08:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sidang`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akademik`
--

CREATE TABLE `tbl_akademik` (
  `kode_akd` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `semester` enum('GN','GL') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` set('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_akademik`
--

INSERT INTO `tbl_akademik` (`kode_akd`, `semester`, `tahun`, `is_active`) VALUES
('AKD-001', 'GL', '2026', '0'),
('AKD-002', 'GN', '2026', '1'),
('AKD-003', 'GN', '2027', '0'),
('AKD-004', 'GL', '2027', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosen`
--

CREATE TABLE `tbl_dosen` (
  `nik` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kontak` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kelamin` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_dosen`
--

INSERT INTO `tbl_dosen` (`nik`, `nama`, `kontak`, `email`, `kelamin`, `img`) VALUES
('00001', 'Seva, S.Kom', '087708506949', 'imron@gmail.com', 'L', NULL),
('00002', 'Imron', '0890182901', 'lariadav@gmail.com', 'L', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `kode_jurusan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`kode_jurusan`, `nama_jurusan`) VALUES
('J-INF', 'Informatika'),
('J-SI', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `nim` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kontak` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kelamin` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`nim`, `nama`, `kontak`, `email`, `kelamin`, `img`) VALUES
('42423012', 'Restu Ferdiansah', '085227765751', 'Restudoaibu@gmail.com', 'L', NULL),
('42423033', 'Asep Khairul Rahman', '089523376034', 'Asep@gmail.com', 'L', NULL),
('42423047', 'Eko Satrio', '087708506949', 'Eko@gmail.com', 'L', NULL),
('42423048', 'Valent Bintang Kautsar', '085780051258', 'Valent@gmail.com', 'L', NULL),
('42423051', 'Ibnu Kholif', '082267573933', 'Ibnu@gmail.com', 'L', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id` int NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sandi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `peran` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pin` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id`, `username`, `sandi`, `peran`, `nama`, `pin`) VALUES
(15, 'eko', '3ee5e4d76f2098635fbe5b24be222ae44f8d776c', 'S', 'Eko Satrio', '111111'),
(32, 'imron', '75cb554f0634180b077af036e0fae56b3935ff91', 'M', 'imron', '12345'),
(34, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'S', 'admin1', '12345'),
(35, '00001', '9d97a5892b0bf1b1af208b53e6c9f35986a0b123', 'D', 'Seva, S.Kom', '12345'),
(36, '00002', '69a957ab57545037ce9a492ad0bd89c1d7e2220d', 'D', 'Imron', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ruangan`
--

CREATE TABLE `tbl_ruangan` (
  `kode_ruangan` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `gedung` enum('A','D') COLLATE utf8mb4_general_ci NOT NULL,
  `nama_ruangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kuota` varchar(2) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ruangan`
--

INSERT INTO `tbl_ruangan` (`kode_ruangan`, `gedung`, `nama_ruangan`, `kuota`) VALUES
('A001', 'A', 'A204', '50'),
('D001', 'D', 'D201', '20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sidang`
--

CREATE TABLE `tbl_sidang` (
  `id` int NOT NULL,
  `kode_akd` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_jurusan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_ruangan` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nim` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_sidang` enum('PKL','Sempro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl` date NOT NULL,
  `nik_pembimbing_1` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `nik_pembimbing_2` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nik_penguji_1` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `nik_penguji_2` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` enum('dijadwalkan','berlangsung','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `judul` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sidang`
--

INSERT INTO `tbl_sidang` (`id`, `kode_akd`, `kode_jurusan`, `kode_ruangan`, `nim`, `jenis_sidang`, `tgl`, `nik_pembimbing_1`, `nik_pembimbing_2`, `nik_penguji_1`, `nik_penguji_2`, `jam_mulai`, `jam_selesai`, `status`, `judul`) VALUES
(1, 'AKD-002', 'J-INF', 'A001', '42423012', 'PKL', '2026-09-24', '00001', NULL, '00002', NULL, '16:00:00', '17:08:41', 'dijadwalkan', NULL),
(2, 'AKD-002', 'J-INF', 'A001', '42423047', 'Sempro', '2026-09-24', '00001', '00002', '00001', '00002', '09:53:00', '14:00:00', 'berlangsung', 'bagus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_akademik`
--
ALTER TABLE `tbl_akademik`
  ADD PRIMARY KEY (`kode_akd`);

--
-- Indexes for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  ADD PRIMARY KEY (`kode_ruangan`);

--
-- Indexes for table `tbl_sidang`
--
ALTER TABLE `tbl_sidang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_sidang`
--
ALTER TABLE `tbl_sidang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
