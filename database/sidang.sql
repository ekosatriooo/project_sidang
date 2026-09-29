-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 29, 2026 at 08:00 AM
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
('000001', 'Fathulloh, S.T., M.Kom.', '088888888888', 'fathulloh@gmail.com', 'L', NULL),
('000002', 'Nurul Mega Saraswati, M.Kom.', '011111111111', 'Nurul@gmail.com', 'P', NULL),
('000003', 'Khurotul Aeni, M.Kom.', '022222222222', 'Aeni@gmail.com', 'P', NULL),
('000004', 'Asep Saeful Millah, M.Kom.', '099999999999', 'Asep@gmail.com', 'L', NULL),
('000005', 'Achmad Syauqi, M.Kom.', '033333333333', 'Syauqi@gmail.com', 'L', NULL),
('000006', 'Sorikhi, M.Kom.', '077777777777', 'Sorkh@gmail.com', 'L', NULL);

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
  `id` int NOT NULL,
  `nim` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_ruangan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status_kehadiran` enum('hadir','tidak_hadir') COLLATE utf8mb4_general_ci NOT NULL,
  `tgl` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `jenis_sidang` enum('PKL','sempro') COLLATE utf8mb4_general_ci NOT NULL,
  `id_sidang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_presensi`
--

INSERT INTO `tbl_presensi` (`id`, `nim`, `nama`, `judul`, `nama_ruangan`, `status_kehadiran`, `tgl`, `jam_mulai`, `jam_selesai`, `jenis_sidang`, `id_sidang`) VALUES
(95, '42423047', 'Ibnu Kholif', 'Prediksi Harga Sawit Menggunakan Linear Regresion', 'A204', 'tidak_hadir', '2026-09-29', '15:15:00', '16:00:00', 'sempro', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ruangan`
--

CREATE TABLE `tbl_ruangan` (
  `kode_ruangan` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `gedung` enum('A','D') COLLATE utf8mb4_general_ci NOT NULL,
  `nama_ruangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
(8, 'AKD-002', 'J-INF', 'A001', '42423047', 'Sempro', '2026-09-30', '000001', '000004', '000002', '000003', '11:00:00', '13:00:00', 'dijadwalkan', 'Deteksi Hoax Menggunakan KNN'),
(10, 'AKD-001', 'J-INF', 'A001', '42423051', 'Sempro', '2026-09-29', '000002', '000004', '000005', '000006', '15:15:00', '16:00:00', 'dijadwalkan', 'Prediksi Harga Sawit Menggunakan Linear Regresion');

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
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_presensi`
--
ALTER TABLE `tbl_presensi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `tbl_sidang`
--
ALTER TABLE `tbl_sidang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
