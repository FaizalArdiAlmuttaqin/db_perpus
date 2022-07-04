-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2019 at 07:48 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `no_agt` int(5) UNSIGNED ZEROFILL NOT NULL,
  `nm_agt` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` bigint(12) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`no_agt`, `nm_agt`, `alamat`, `telp`) VALUES
(00001, 'fazal ardi', 'Neraka', 087881321960),
(00002, 'Putra Muhammad', 'Surga', 082114499279);

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kd_buku` varchar(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `jml_hal` int(11) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `stok` int(11) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kd_buku`, `judul`, `pengarang`, `jml_hal`, `penerbit`, `tahun_terbit`, `tgl_masuk`, `stok`, `genre`, `kategori`) VALUES
('B0001', 'Petualangan Bobo', 'putra', 100, 'gramedia', 2017, '2019-06-22', 40, 'Lainnya', 'Komik'),
('B0002', 'Laskar Pelangi', 'Andrea Hirata', 529, 'Bentang Pustaka', 2005, '2019-06-22', 5, 'Fiksi', 'Novel');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `kd_pinjam` varchar(5) NOT NULL,
  `kd_buku` varchar(5) NOT NULL,
  `no_agt` int(5) UNSIGNED ZEROFILL NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_dikembalikan` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` text,
  `denda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`kd_pinjam`, `kd_buku`, `no_agt`, `tgl_pinjam`, `tgl_kembali`, `tgl_dikembalikan`, `status`, `keterangan`, `denda`) VALUES
('P0001', 'B0001', 00001, '2019-06-01', '2019-06-02', '2019-06-22', 'kembali', 'telat 20 hari', 40000),
('P0002', 'B0002', 00001, '2019-06-22', '2019-06-25', '2019-06-23', 'kembali', '-', 0),
('P0003', 'B0002', 00002, '2019-06-23', '2019-06-25', '2019-06-23', 'kembali', '-', 0);

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `kurang_stok` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
UPDATE buku SET stok = stok-1 WHERE kd_buku = new.kd_buku;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER UPDATE ON `peminjaman` FOR EACH ROW BEGIN
UPDATE buku SET stok = stok + 1 WHERE kd_buku = new.kd_buku;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`no_agt`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kd_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`kd_pinjam`),
  ADD KEY `kd_buku` (`kd_buku`),
  ADD KEY `no_agt` (`no_agt`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `no_agt` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`no_agt`) REFERENCES `anggota` (`no_agt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`kd_buku`) REFERENCES `buku` (`kd_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
