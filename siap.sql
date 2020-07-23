-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jul 2020 pada 15.38
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siap`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `id_account` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `id_login` varchar(15) NOT NULL,
  `update_data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`id_account`, `username`, `id_login`, `update_data`) VALUES
('5ef4a12ae5785', 'admin', '5ef4a12ae5783', '2020-06-25 13:05:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `kode_akun` varchar(10) NOT NULL,
  `nama_akun` varchar(255) NOT NULL,
  `update_data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(15) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `data_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` varchar(15) NOT NULL,
  `id_account` varchar(15) NOT NULL,
  `log` text NOT NULL,
  `update_data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `id_account`, `log`, `update_data`) VALUES
('5ef57b48abf9b', '5ef4a12ae5785', 'admin was successful login on Friday, 26-06-2020 11:36:24', '2020-06-26 04:36:24'),
('5ef57bcd75637', '5ef4a12ae5785', 'admin was successful change photo profile on Friday, 26-06-2020 11:38:37', '2020-06-26 04:38:37'),
('5ef58cabb075e', '5ef4a12ae5785', 'admin was successful login on Friday, 26-06-2020 12:50:35', '2020-06-26 05:50:35'),
('5ef590fed265e', '5ef4a12ae5785', 'admin was successful login on Friday, 26-06-2020 13:09:02', '2020-06-26 06:09:02'),
('5ef60a0245726', '5ef4a12ae5785', 'admin was successful login on Friday, 26-06-2020 21:45:22', '2020-06-26 14:45:22'),
('5ef60a38e78bf', '5ef4a12ae5785', 'admin was successful change photo profile on Friday, 26-06-2020 21:46:16', '2020-06-26 14:46:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_login` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` varchar(15) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `update_data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_login`, `password`, `id_role`, `status`, `update_data`) VALUES
('5ef4a12ae5783', '$2y$10$FK5.G91EVOErTwwzA5vdLOSvGkxd.SrQuWTRZKKiE/LinNDgY5tpi', '5ef49b3c63cff', '1', '2020-06-26 06:08:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` varchar(15) NOT NULL,
  `nama_mitra` varchar(255) NOT NULL,
  `type` enum('Supplier','Client','Client & Supplier') NOT NULL,
  `badan_usaha` enum('Perorangan','PT','CV','Firma','Koperasi') NOT NULL,
  `email` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `alamat_1` text NOT NULL,
  `alamat_2` text NOT NULL,
  `kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kode_pos` varchar(8) NOT NULL,
  `negara` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `data_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `id_profile` varchar(15) NOT NULL,
  `id_account` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nrg` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `data_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id_profile`, `id_account`, `nama`, `nrg`, `telp`, `foto`, `data_update`) VALUES
('5ef4a12b1b57d', '5ef4a12ae5785', 'Dian Purwanto', '123456789', '085736745916', '5ef4a12ae5785.jpg', '2020-06-26 14:46:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_account`
--

CREATE TABLE `role_account` (
  `id_role` varchar(15) NOT NULL,
  `role` varchar(100) NOT NULL,
  `data_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role_account`
--

INSERT INTO `role_account` (`id_role`, `role`, `data_update`) VALUES
('5ef49b3c63cff', 'Administrator', '2020-06-25 12:42:57'),
('5ef49b44b491f', 'Owner', '2020-06-25 12:42:57'),
('5ef49b4c1eb6b', 'Accounting', '2020-06-25 12:42:57'),
('5ef49b5314fc9', 'Admin', '2020-06-25 12:42:57'),
('5ef49bfeabf92', 'User', '2020-06-25 14:26:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_akun`
--

CREATE TABLE `status_akun` (
  `id_status_akun` int(3) NOT NULL,
  `kode_akun` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `update_data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `type_agen`
--

CREATE TABLE `type_agen` (
  `id_type` int(3) NOT NULL,
  `type` varchar(255) NOT NULL,
  `update_data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `usaha`
--

CREATE TABLE `usaha` (
  `id_usaha` varchar(15) NOT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `id_kategori` varchar(15) NOT NULL,
  `id_jenis_usaha` varchar(15) NOT NULL,
  `badan_usaha` enum('Perorangan','PT','CV','Firma','Koperasi') NOT NULL,
  `pic` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `npwp` varchar(30) NOT NULL,
  `website` varchar(255) NOT NULL,
  `alamat_1` text NOT NULL,
  `alamat_2` text NOT NULL,
  `kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `negara` varchar(255) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `data_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indeks untuk tabel `role_account`
--
ALTER TABLE `role_account`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `status_akun`
--
ALTER TABLE `status_akun`
  ADD PRIMARY KEY (`id_status_akun`);

--
-- Indeks untuk tabel `type_agen`
--
ALTER TABLE `type_agen`
  ADD PRIMARY KEY (`id_type`);

--
-- Indeks untuk tabel `usaha`
--
ALTER TABLE `usaha`
  ADD PRIMARY KEY (`id_usaha`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `status_akun`
--
ALTER TABLE `status_akun`
  MODIFY `id_status_akun` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `type_agen`
--
ALTER TABLE `type_agen`
  MODIFY `id_type` int(3) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
