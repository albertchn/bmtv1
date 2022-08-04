-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Jun 2022 pada 10.24
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmt12`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `foto`, `role`) VALUES
(1, 'Irwan Saputra', 'irone_saputra', '$2y$10$NAW5qw1jE81kQ2RTv1B/2u5/3gr5KrPkGHXZYo8Prl72PWIJTlHxW', '62b413474ad26.png', 'Administrator'),
(2, 'bagas safrizan', 'bagas_sfrzn', '$2y$10$7rpKP/3UKj18pJGEX0DILOeMy6Sa1FqTkOgmcnJmAutnGUWHsp57C', '62b4150533c42.png', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_nasabah` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `saldo` int(11) NOT NULL,
  `tanggal_pembuatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `teller` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `nis` int(11) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `ibu` varchar(255) NOT NULL,
  `tanggal_ibu` date NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `jawaban` varchar(255) NOT NULL,
  `foto_ttd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`id_nasabah`, `nama`, `no_rekening`, `pin`, `saldo`, `tanggal_pembuatan`, `teller`, `foto`, `kelas`, `nis`, `tanggal_lahir`, `ibu`, `tanggal_ibu`, `pertanyaan`, `jawaban`, `foto_ttd`) VALUES
(19, 'Damayanti', 'BMT-76766662', '', 20000, '2022-06-22 09:13:52', 'riris', '62b2dd5059fde.jpg', 'XI', 11223, '2005-08-11', 'ibu', '2022-06-06', 'nama kucing', 'oreo', '62b2dd505a23a.png'),
(23, 'Bagas safrizan fadilah', 'BMT-23628540', '$2y$10$SSSIkXUJqANVlcwZfQ4du.kwkI0m9EQ.7ygwHnvTIfGMT5cpDRyMa', 250000, '2022-06-23 07:56:17', 'bagas safrizan', '62b41ca114d81.jpg', 'XII', 10717, '2003-12-23', 'siapa', '1988-08-11', 'olahraga favorit', 'turu', '62b41ca114d8d.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teller`
--

CREATE TABLE `teller` (
  `id_teller` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nis` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `teller`
--

INSERT INTO `teller` (`id_teller`, `nama`, `nis`, `password`, `kelas`, `foto`) VALUES
(36, 'bagas safrizan', 10717, '$2y$10$raVy7A1NDlzX.3cS1L1g1OSX1QW3/rtiP1fEVish74tU9758oRrYq', 'XII', '62b2d173ec64e.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `token`
--

CREATE TABLE `token` (
  `id_token` int(11) NOT NULL,
  `kode_token` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `teller` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_transaksi`, `id_nasabah`, `debit`, `kredit`, `tanggal`, `teller`, `catatan`) VALUES
(1, 'T-79955444', 23, 20000, 0, '2022-06-27 06:00:45', 'bagas safrizan', 'sedekah'),
(2, 'T-95248413', 23, 15000, 0, '2022-06-27 06:01:11', 'bagas safrizan', 'sedekah'),
(4, 'T-52173767', 19, 200000, 0, '2022-06-27 06:08:58', 'bagas safrizan', 'sedekah'),
(5, 'T-43362731', 19, 0, 150000, '2022-06-27 06:19:31', 'bagas safrizan', 'gajadi sedekah'),
(6, 'T-89260864', 23, 0, 5000, '2022-06-27 08:20:30', 'bagas safrizan', 'parkir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indexes for table `teller`
--
ALTER TABLE `teller`
  ADD PRIMARY KEY (`id_teller`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_nasabah` (`id_nasabah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_nasabah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `teller`
--
ALTER TABLE `teller`
  MODIFY `id_teller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_nasabah`) REFERENCES `rekening` (`id_nasabah`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
