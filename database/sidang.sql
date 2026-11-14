-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2026 at 02:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_sidang`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akademik`
--

CREATE TABLE `tbl_akademik` (
  `kode_akd` varchar(10) NOT NULL,
  `semester` enum('GN','GL') NOT NULL,
  `tahun` char(4) NOT NULL,
  `is_active` set('1','0') NOT NULL
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
  `nik` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kontak` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kelamin` char(1) NOT NULL,
  `img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_dosen`
--

INSERT INTO `tbl_dosen` (`nik`, `nama`, `kontak`, `email`, `kelamin`, `img`) VALUES
('000001', 'Fathulloh, S.T., M.Kom.', '088888888888', 'fathulloh@gmail.com', 'L', NULL),
('000002', 'Nurul Mega Saraswati, M.Kom.', '011111111111', 'Nurul@gmail.com', 'P', NULL),
('000003', 'Khurotul Aeni, M.Kom.', '022222222222', 'Aeni@gmail.com', 'P', NULL),
('000004', 'Asep Saeful Millah, M.Kom.', '099999999999', 'Asep@gmail.com', 'L', NULL),
('000005', 'Achmad Syauqi, M.Kom.', '033333333333', 'Syauqi@gmail.com', 'L', NULL),
('000006', 'Sorikhi, M.Kom.', '077777777777', 'Sorkh@gmail.com', 'L', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info`
--

CREATE TABLE `tbl_info` (
  `id` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `nik_pembimbing` varchar(16) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_info`
--

INSERT INTO `tbl_info` (`id`, `nim`, `nik_pembimbing`, `jurusan`) VALUES
(1, '42423033', '000005', 'Informatika'),
(3, '42423051', '000002', 'Informatika'),
(8, '42423012', '000006', 'Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kontak` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kelamin` char(1) NOT NULL,
  `img` text DEFAULT NULL
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
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `sandi` varchar(100) NOT NULL,
  `peran` char(1) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `pin` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id`, `username`, `sandi`, `peran`, `nama`, `pin`) VALUES
(15, 'eko', '3ee5e4d76f2098635fbe5b24be222ae44f8d776c', 'S', 'Eko Satrio', '111111'),
(37, '000001', '0a620481ca00b00de7eedb407a68b9163dcabae3', 'D', 'Fathulloh, S.T., M.Kom.', '12345'),
(38, '000002', '86dfb043360b0e9ef7767e6ea7ad09fb7fb81537', 'D', 'Nurul Mega Saraswati, M.Kom.', '12345'),
(39, '000003', '35510de8e4e64d24b00e396a76e868231570ac78', 'D', 'Khurotul Aeni, M.Kom.', '12345'),
(40, '000004', '8a15ca25c36d74bcc7c4ad77f284e0a2551d0344', 'D', 'Asep Saeful Millah, M.Kom.', '12345'),
(41, '000005', '786de586e258db51207eb1649d456b4a6d978df9', 'D', 'Achmad Syauqi, M.Kom.', '12345'),
(42, '000006', 'ca0d5b58fa949c5d2434696d5a67b2b6e59a8c49', 'D', 'Sorikhi, M.Kom.', '12345'),
(43, '42423012', '0f7ec6db5f002d8d7b6d61fcc061c5691c2eb290', 'M', 'Restu Ferdiansah', '12345'),
(44, '42423033', 'a847e8923f04b898574e379bc2c507bfbb5103f5', 'M', 'Asep Khairul Rahman', '12345'),
(45, '42423047', '91d3718c85480bb5696c44d84b1dcf3cbd4b2387', 'M', 'Eko Satrio', '12345'),
(46, '42423048', '694b6cf2a6b24969a03b63fa68429441b664aa00', 'M', 'Valent Bintang Kautsar', '12345'),
(47, '42423051', '1040f34976650b7220f7d4b19b78c4300c4ac5dd', 'M', 'Ibnu Kholif', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_presensi`
--

CREATE TABLE `tbl_presensi` (
  `id` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `status_kehadiran` enum('hadir','tidak_hadir') NOT NULL,
  `tgl` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `id_sidang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_presensi`
--

INSERT INTO `tbl_presensi` (`id`, `nim`, `nama`, `judul`, `nama_ruangan`, `status_kehadiran`, `tgl`, `jam_mulai`, `jam_selesai`, `id_sidang`) VALUES
(101, '42423012', 'Eko Satrio', 'Deteksi Hoax Menggunakan KNN', 'A204', 'tidak_hadir', '2026-09-30', '11:00:00', '13:00:00', 8),
(102, '42423048', 'Eko Satrio', 'Deteksi Hoax Menggunakan KNN', 'A204', 'tidak_hadir', '2026-09-30', '11:00:00', '13:00:00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ruangan`
--

CREATE TABLE `tbl_ruangan` (
  `kode_ruangan` varchar(10) NOT NULL,
  `gedung` enum('A','D') NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `kuota` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ruangan`
--

INSERT INTO `tbl_ruangan` (`kode_ruangan`, `gedung`, `nama_ruangan`, `kuota`) VALUES
('A001', 'A', 'A204', '1'),
('A002', 'A', 'A208', '10'),
('D001', 'D', 'D201', '20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sidang`
--

CREATE TABLE `tbl_sidang` (
  `id` int(11) NOT NULL,
  `kode_ruangan` varchar(10) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `nik_pembimbing` varchar(16) NOT NULL,
  `nik_penguji` varchar(16) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` enum('dijadwalkan','berlangsung','selesai') DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sidang`
--

INSERT INTO `tbl_sidang` (`id`, `kode_ruangan`, `nim`, `jurusan`, `tgl`, `nik_pembimbing`, `nik_penguji`, `jam_mulai`, `jam_selesai`, `status`, `judul`) VALUES
(14, 'A001', '42423051', 'Informatika', '2026-11-15', '000002', '000001', '07:00:00', '09:00:00', 'dijadwalkan', 'Sistem Rekapitulasi'),
(15, 'A001', '42423033', 'Informatika', '2026-11-14', '000005', '000002', '20:00:00', '23:00:00', 'dijadwalkan', 'Sistem Sistem');

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
-- Indexes for table `tbl_info`
--
ALTER TABLE `tbl_info`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tbl_presensi`
--
ALTER TABLE `tbl_presensi`
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
-- AUTO_INCREMENT for table `tbl_info`
--
ALTER TABLE `tbl_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_presensi`
--
ALTER TABLE `tbl_presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tbl_sidang`
--
ALTER TABLE `tbl_sidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
