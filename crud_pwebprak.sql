-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Apr 2024 pada 14.29
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_pwebprak`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `nama`, `email`, `password`, `level`) VALUES
(1, 'joko', 'joko', 'joko@gmail.com', 'joko', 'Administrator'),
(2, 'andik', 'andik', 'andik@gmail.com', 'andik', 'Administrator'),
(3, 'dian', 'dian', 'dian@gmail.com', 'dian', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `thumbnail` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `tgl_publish` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `judul`, `content`, `thumbnail`, `author`, `tgl_publish`) VALUES
(1, 'Manfaat Olahraga Lari untuk Kesehatan dan Kebugaran Tubuh', 'Olahraga lari merupakan salah satu aktivitas fisik yang paling banyak diminati. Selain karena mudah dilakukan, ada banyak manfaat olahraga lari bagi kesehatan yang tidak boleh dihiraukan begitu saja. Hal ini karena gerakan langkah cepat dengan ritme jantung terpacu, memberikan pengaruh yang baik bagi kesehatan tubuh setiap orang.Oleh karena itu, manfaat olahraga lari ini bisa berdampak baik bagi kesehatan dan kebugaran tubuh ke depannya khususnya pada jantung, daya tahan tubuh meningkat, dan manfaat lainnya yang mungkin belum disadari sebelum melakukan aktivitas olahraga lari. Seperti apa sejumlah manfaat olahraga lari yang dimaksud? Yuk, simak penjelasan berikut ini.Manfaat Olahraga Lari untuk Kesehatan dan Kebugaran Tubuh Olahraga lari bukan sekadar aktivitas fisik saja, melainkan kunci untuk menuju kesehatan dan kebugaran tubuh yang optimal. Langkah-langkah berirama ini tidak hanya membangun kekuatan otot dan meningkatkan ketahanan kardiovaskular, namun juga menjadi peluang untuk membersihkan pikiran dari stres sehari-hari. ', 'manfaatolahragalari.jpg', 'eraspace', '2024-04-09'),
(8, 'Mengenalkan Aplikasi PacePal dan Testimoni dari Pengguna', 'Selain mudah dan tidak memerlukan banyak peralatan, olahraga lari juga dapat Anda lakukan dimana saja. ', '661373b963c4e.jpg', 'aksa', '2024-04-10'),
(10, 'kjjk', 'lj', '66139f7c8f8f1.jpg', 'kjh', '2024-04-10'),
(12, 'ccccc', 'cfcfcf', '662ce606e7bd9.jpg', 'dian', '2024-04-27'),
(13, 'hai', 'hai', '662ce798937f4.jpg', 'dian', '2024-04-27'),
(14, 'hjkh', 'jkj', '662ce96687cfa.jpg', 'dkjshkd', '2024-04-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_barang`, `stok`) VALUES
(1, 'T-shirt', 50000, 10),
(2, 'Training', 40000, 5),
(3, 'Shock', 20000, 3),
(13, 'celana', 150000, 6),
(17, 'Paket Hemat2', 100000, 2),
(20, 'pecel', 15000, 11);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
