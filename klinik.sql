-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2022 at 06:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `nipDokter` int(12) NOT NULL,
  `namaDokter` varchar(35) NOT NULL,
  `jkelaminDokter` varchar(20) NOT NULL,
  `bagian` varchar(35) NOT NULL,
  `nohpDokter` varchar(15) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`nipDokter`, `namaDokter`, `jkelaminDokter`, `bagian`, `nohpDokter`, `foto`) VALUES
(1000201, 'Dr. Ervan', 'Pria', 'Pemeriksaan Mata', '081320092008', 'foto/dokter/person_4.jpg'),
(1000202, 'Dr. Rina', 'Wanita', 'Pemeriksaan Anak', '082236787765', 'foto/dokter/bg-doctor.png'),
(1000203, 'Dr. Tenma', 'Pria', 'Konsultasi Umum', '081245887790', 'foto/dokter/person_3.jpg'),
(1000204, 'Dr. Samuel Lumbantobing', 'Pria', 'Pemeriksaan Gigi dan Mulut', '0877 9484 2252', 'foto/dokter/pexels-pixabay-220453.jpg'),
(1000205, 'Dr. Christian', 'Pria', 'Pemeriksaan Mata', '082249541875', 'foto/dokter/PasPoto.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `idKegiatan` int(3) NOT NULL,
  `namaKegiatan` varchar(35) NOT NULL,
  `ruangKegiatan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`idKegiatan`, `namaKegiatan`, `ruangKegiatan`) VALUES
(1, 'Pemeriksaan Mata', 'Poli Mata'),
(2, 'Pemeriksaan Anak', 'Poli Anak'),
(3, 'Pemeriksaan THT', 'Poli THT'),
(4, 'Pemeriksaan Gigi dan Mulut', 'Poli Gigi'),
(5, 'Konsultasi Umum', 'Poli Umum'),
(9, 'Tes Kesehatan', 'Poli Umum');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `idLaporan` int(10) NOT NULL,
  `tglLaporan` date NOT NULL,
  `namaPasien` varchar(45) NOT NULL,
  `namaDokter` varchar(45) NOT NULL,
  `namaKegiatan` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`idLaporan`, `tglLaporan`, `namaPasien`, `namaDokter`, `namaKegiatan`) VALUES
(202201001, '2022-05-11', 'Patient Zero', 'Dr. Ervan', 'Pemeriksaan Mata'),
(202201002, '2022-05-21', 'Patient Three', 'Dr. Samuel Lumbantobing', 'Pemeriksaan Gigi dan Mulut'),
(202201003, '2022-05-14', 'Patient Four', 'Dr. Rina', 'Pemeriksaan Anak'),
(202201004, '2022-05-07', 'Patient One', 'Dr. Tenma', 'Konsultasi Umum'),
(202201067, '2022-01-20', 'Klaudius', 'Dr. Tenma', 'Konsultasi Umum'),
(202201068, '2022-03-17', 'Julius', 'Dr. Ervan', 'Pemeriksaan Mata'),
(202201069, '2022-05-12', 'Kristin trululu', 'Dr. Christian', 'Pemeriksaan Mata'),
(202201070, '2022-05-02', 'Patient One', 'Dr. Tenma', 'Konsultasi Umum');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `idObat` int(10) NOT NULL,
  `namaObat` varchar(35) NOT NULL,
  `hargaObat` decimal(10,0) NOT NULL,
  `jenisObat` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`idObat`, `namaObat`, `hargaObat`, `jenisObat`) VALUES
(101001, 'Paracetamol', '10000', 'Tablet'),
(101002, 'Dermatix', '30000', 'Salep/Olesan'),
(101003, 'Tremenza', '30000', 'Sirup'),
(101004, 'Neuralgad', '50000', 'Tablet'),
(101005, 'Amoxilin', '25000', 'Sirup');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `idPasien` int(10) NOT NULL,
  `namaPasien` varchar(35) NOT NULL,
  `jkelaminPasien` varchar(10) NOT NULL,
  `usiaPasien` int(4) NOT NULL,
  `beratPasien` int(10) NOT NULL,
  `tinggiPasien` int(10) NOT NULL,
  `golDarah` varchar(4) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`idPasien`, `namaPasien`, `jkelaminPasien`, `usiaPasien`, `beratPasien`, `tinggiPasien`, `golDarah`, `foto`) VALUES
(1012, 'Patient One', 'Wanita', 25, 65, 170, 'O', 'foto/pasien/aiony-haust-3TLl_97HNJo-unsplash.jpg'),
(1013, 'Patient Three', 'Pria', 20, 50, 160, 'B', 'foto/pasien/jurica-koletic-7YVZYZeITc8-unsplash.jpg'),
(1014, 'Patient Four', 'Wanita', 34, 77, 165, 'A', 'foto/pasien/pexels-tuấn-kiệt-jr-1382731.jpg'),
(1016, 'Klaudius', 'Pria', 30, 60, 160, 'AB', 'foto/pasien/linkedin-sales-solutions-pAtA8xe_iVM-unsplash.jpg'),
(1017, 'Julius', 'Pria', 25, 65, 175, 'O', 'foto/pasien/lesly-juarez-RukI4qZGlQs-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idPegawai` int(10) NOT NULL,
  `namaPegawai` varchar(35) NOT NULL,
  `jkelaminPegawai` varchar(10) NOT NULL,
  `bagian` varchar(35) NOT NULL,
  `nohpPegawai` varchar(15) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idPegawai`, `namaPegawai`, `jkelaminPegawai`, `bagian`, `nohpPegawai`, `foto`) VALUES
(12001, 'Renaldo', 'Pria', 'Pemeriksaan Mata', '081245672312', 'foto/pegawai/person_1.jpg'),
(12002, 'Risna', 'Wanita', 'Pemeriksaan Gigi dan Mulut', '081245607865', 'foto/pegawai/oppo-HA5rQ_XfBD0-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` varchar(35) NOT NULL,
  `userNama` varchar(35) NOT NULL,
  `userPassword` text NOT NULL,
  `userRole` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userNama`, `userPassword`, `userRole`) VALUES
('admin', 'Admin Roi', '12345', 'admin'),
('adminAkun', 'UserAdmin', 'admin', 'sekuriti'),
('ohmyrafa', 'Rafaela', 'obat', 'apoteker'),
('pegawai', 'Christian', 'pegawai', 'pegawai'),
('rinadokter', 'Rina Karina', 'rina123', 'dokter'),
('roi123', 'roi', '12345', 'dokter'),
('roitua', 'Christian Roi Tua Sinaga', '12345', 'apoteker'),
('tenma01', 'Dr. Tenma', '12345', 'dokter'),
('tralala', 'Kristin tralalala', '101112', 'pegawai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`nipDokter`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`idKegiatan`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`idLaporan`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`idObat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`idPasien`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idPegawai`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `nipDokter` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000206;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `idKegiatan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `idLaporan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202201071;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `idObat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101006;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `idPasien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1024;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `idPegawai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12003;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
