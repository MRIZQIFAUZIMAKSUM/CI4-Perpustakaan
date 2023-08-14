-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jul 2023 pada 09.24
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nis` bigint(20) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `jurusan` varchar(12) NOT NULL,
  `kelas` varchar(4) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `nis`, `fullname`, `jurusan`, `kelas`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(2, 207451, 'ALLENA RAHMA FAOHILA', 'TKJ', 'XII', '213443667', 'refg@ewd.fre', '2023-06-23 00:00:00', '2023-07-26 14:12:24'),
(3, 207452, 'AMANDA NISYA AOERORA', 'TKJ', 'XII', '', 'amanda@gmail.com', '2023-06-24 00:00:00', '2023-06-27 16:36:00'),
(4, 207453, 'ANGGITA WIBOWO', 'TKJ', 'XII', '', 'anggitawibowo96@gmail.com', '2023-06-25 00:00:00', '2023-07-13 15:27:38'),
(5, 207454, 'AULIA PITALOKA GUNAWAN', 'TKJ', 'XII', '', 'auliapitaloka@gmail.com', '2023-06-26 00:00:00', '2023-07-31 22:30:33'),
(6, 207455, 'AZHARA SALMA SAFITRI', 'TKJ', 'XII', '', '', '2023-06-27 00:00:00', '2023-06-27 00:00:00'),
(7, 207456, 'BANI FADHLIH AZKA FEBRIAN', 'TKJ', 'XII', '', '', '2023-06-28 00:00:00', '2023-06-28 00:00:00'),
(8, 207457, 'DHIRO BAHARI', 'TKJ', 'XII', '', 'dhirobahari@gmail.com', '2023-06-29 00:00:00', '2023-07-12 15:46:12'),
(9, 207458, 'DIAN TRESIANA YULIANTI', 'TKJ', 'XII', '', '', '2023-06-30 00:00:00', '2023-06-30 00:00:00'),
(10, 207459, 'DWI HILMAN FEBRIANSYAH', 'TKJ', 'XII', '', '', '2023-07-01 00:00:00', '2023-07-01 00:00:00'),
(11, 207460, 'DYAH AYU SAVITRI', 'TKJ', 'XII', '', 'fauziuser@gmail.com', '2023-07-02 00:00:00', '2023-07-06 23:20:04'),
(12, 207461, 'EKA BAGAS PRASETYA', 'TKJ', 'XII', '', '', '2023-07-03 00:00:00', '2023-07-03 00:00:00'),
(13, 207462, 'ERNESTA AULIA CAHYANI', 'TKJ', 'XII', '', '', '2023-07-04 00:00:00', '2023-07-04 00:00:00'),
(14, 207463, 'ESYA JUANG KURNIA', 'TKJ', 'XII', '', '', '2023-07-05 00:00:00', '2023-07-05 00:00:00'),
(15, 207464, 'FAD ANTIKA HAPSARI', 'TKJ', 'XII', '', '', '2023-07-06 00:00:00', '2023-07-06 00:00:00'),
(16, 207465, 'FINDA AYU KHOIRUNNISA', 'TKJ', 'XII', '', '', '2023-07-07 00:00:00', '2023-07-07 00:00:00'),
(17, 207466, 'JIHAN MAULIDAH AZZAHRA', 'TKJ', 'XII', '', '', '2023-07-08 00:00:00', '2023-07-08 00:00:00'),
(18, 207467, 'LISZA INDANA ZULFA', 'TKJ', 'XII', '', '', '2023-07-09 00:00:00', '2023-07-09 00:00:00'),
(19, 207468, 'LULU NAILA ROMADHONA', 'TKJ', 'XII', '', '', '2023-07-10 00:00:00', '2023-07-10 00:00:00'),
(20, 207469, 'MOHAMMAD FAJAR SUBECHI', 'TKJ', 'XII', '', '', '2023-07-11 00:00:00', '2023-07-11 00:00:00'),
(21, 207470, 'MUCHAMMAD YANUAR ROCHMA', 'TKJ', 'XII', '', '', '2023-07-12 00:00:00', '2023-07-12 00:00:00'),
(22, 207471, 'MUHAMMAD IQBAL', 'TKJ', 'XII', '', '', '2023-07-13 00:00:00', '2023-07-13 00:00:00'),
(23, 207472, 'MUHAMMAD IQBAL SAPUTRA', 'TKJ', 'XII', '', '', '2023-07-14 00:00:00', '2023-07-14 00:00:00'),
(24, 207473, 'MUHAMMAD RAMADITYA', 'TKJ', 'XII', '', '', '2023-07-15 00:00:00', '2023-07-15 00:00:00'),
(25, 207474, 'MUKHAMMAD AKHADDIN', 'TKJ', 'XII', '', '', '2023-07-16 00:00:00', '2023-07-16 00:00:00'),
(26, 207475, 'RADITA ZAHWA ALLIYAH', 'TKJ', 'XII', '', '', '2023-07-17 00:00:00', '2023-07-17 00:00:00'),
(27, 207476, 'RESTA SABRINA', 'TKJ', 'XII', '', '', '2023-07-18 00:00:00', '2023-07-18 00:00:00'),
(28, 207477, 'ROYAN WILDAN NURYAMAN', 'TKJ', 'XII', '', 'royan@gmail.com', '2023-07-19 00:00:00', '2023-06-26 08:29:10'),
(29, 207478, 'SHAFA MAULANA RAMADHANI', 'TKJ', 'XII', '', '', '2023-07-20 00:00:00', '2023-07-20 00:00:00'),
(30, 207479, 'SYAH IRKHAM RAMADHAN', 'TKJ', 'XII', '', '', '2023-07-21 00:00:00', '2023-07-21 00:00:00'),
(31, 207480, 'VIRGIO ARWA SANDHIKA', 'TKJ', 'XII', '', 'rizkydwisaputrr@gmail.com', '2023-07-22 00:00:00', '2023-07-18 07:26:13'),
(32, 207481, 'VITO DIMAS SAPUTRA', 'TKJ', 'XII', '', '', '2023-07-23 00:00:00', '2023-07-23 00:00:00'),
(33, 207483, 'ZAKI ARUNDAYA', 'TKJ', 'XII', '', 'zakiara@gmail.com', '2023-07-24 00:00:00', '2023-06-26 08:38:15'),
(35, 123, 'RIZKYDWIS', '', '', '08928472193', 'rizkydwisaputrar1@gmail.com', '2023-07-17 12:53:38', '2023-07-17 12:54:33'),
(36, 556356, 'ozimaksum', '', '', '082313593935', 'gaozimaksum@gmail.com', '2023-07-17 16:59:52', '2023-07-17 17:01:13'),
(37, 61771818, 'rizqimaksum', '', '', '085800001455', 'rizqimaksum123@gmail.com', '2023-07-18 06:57:16', '2023-07-18 06:58:21'),
(38, 69696, 'ozimaksum', '', '', NULL, 'blbla@gmail.com', '2023-07-18 07:37:28', '2023-07-18 07:39:08'),
(39, 455777, 'ozicobalagi', '', '', NULL, 'oziicobalagi@gmail.com', '2023-07-18 14:30:43', '2023-07-18 14:31:34'),
(40, 17829, 'zami maksum', '', '', NULL, NULL, '2023-07-20 23:05:28', '2023-07-20 23:05:28'),
(41, 425525, 'zamimaksum ozi', '', '', NULL, NULL, '2023-07-20 23:06:41', '2023-07-20 23:06:41'),
(42, 92828298, 'oziiakak', '', '', NULL, NULL, '2023-07-20 23:20:45', '2023-07-20 23:20:45'),
(43, 9090808, 'gozi', '', '', NULL, NULL, '2023-07-20 23:22:54', '2023-07-20 23:22:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `katalog`
--

CREATE TABLE `katalog` (
  `id` int(11) NOT NULL,
  `ISBN` varchar(30) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `kategori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `eksemplar` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `katalog`
--

INSERT INTO `katalog` (`id`, `ISBN`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `kategori`, `eksemplar`, `created_at`, `updated_at`) VALUES
(1, '13415116', 'AYAT AYAT CINTA', 'habiburrahman el shirazy', 'md enterrtainment', 2008, 'fiksi', 10, '2023-06-22', '2023-06-22'),
(3, '8989000', 'dilan 1990', 'pidi baiq', 'gramedia', 1990, 'fiksi', 6, '2023-06-23', '2023-06-23'),
(4, '9786020639536', 'nebula ', 'tere liye', 'gramedia', 2020, 'fiksi', 1, '2023-07-12', '2023-07-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `firstname`, `lastname`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'M RIZQI', 'FAUZI MAKSUM', 'fauziadmin@gmail.com', '$2y$10$XpU84ZFnCn0WhCYr0y/6nOLcATlxuqaO0lSfpRCxZs7UPphcHEDla', '', '2023-06-22 20:25:46', '2023-06-22 20:25:46'),
(20, 'AHMAD', 'FAJRIANSYAH', 'ahmadfajriansyah@gmail.com', '$2y$10$5QXXxawn3BfeiYpCdlU9yuEWe3Q..XXxGhHssOv5GMj/Yg0QTafhq', '', '2023-07-06 22:07:13', '2023-07-06 22:07:13'),
(24, 'ANGGITA', 'WIBOWO ', 'anggitawibowo96@gmail.com', '$2y$10$PqIAWASXoCKRP9jsaL.qjunaEDelxn/m8R7.nABq2VyfnzXPMxzv.', '', '2023-07-13 15:27:38', '2023-07-13 15:27:38'),
(25, 'DHIRO', 'BAHARI ', 'dhirobahari@gmail.com', '$2y$10$Tw.ldvvDQ3CDkOr7i6dKxeo4Po0IF6K83ShH/Rpt0gHXS64UkF5X.', '', '2023-07-12 15:46:12', '2023-07-12 15:46:12'),
(26, 'ozi', 'RIZKY', 'rizkydwisaputrar@gmail.com', '$2y$10$CcvLbja0GzOShFvtskwb7eWjwRFMPuWPh/qPqwtNNRYVrH5Tj5Msu', '', '2023-07-17 12:49:31', '2023-07-17 12:49:31'),
(27, 'RIZKYDWIS', 'saputra', 'rizkydwisaputrar1@gmail.com', '$2y$10$7KgEzKCaOJCZyV2kLFFTnO06bcn2D4f/sFNJvNgEpTv8zCnSvfAPS', '', '2023-07-17 12:54:33', '2023-07-17 12:54:33'),
(28, 'ozimaksum', 'ysysgyig', 'gaozimaksum@gmail.com', '$2y$10$oV6kUzbcQvWAIxlK9KvQQOOiCzKuhyKIgKSQyWICYDzMdIXwuxUHy', '', '2023-07-17 17:01:13', '2023-07-17 17:01:13'),
(29, 'rizqimaksum', 'maksum', 'rizqimaksum123@gmail.com', '$2y$10$WNyZ4hIEcQ0sG0Xa1nRqNeyitLwTMMCN.nAjgXaO82uzMxOJYd83m', '', '2023-07-18 06:58:21', '2023-07-18 06:58:21'),
(30, 'VIRGIO', 'ARWA SANDHIKA ', 'rizkydwisaputrr@gmail.com', '$2y$10$n3MY14noZSgYon9.pIfM7OY5pnkHJ.QHK9LTYtPqt8AoSXddyPDi2', '', '2023-07-18 07:26:13', '2023-07-18 07:26:13'),
(31, 'ozimaksum', 'maksum', 'blbla@gmail.com', '$2y$10$.ToBbdT/8iAC7yPzN6sJYOBL6Pva1bkUwQ15.t4p4wyAki4PPmHKq', '', '2023-07-18 07:39:08', '2023-07-18 07:39:08'),
(32, 'ozicobalagi', 'cobalgi', 'oziicobalagi@gmail.com', '$2y$10$NPQYkLh7fCqEj.r6QZTqAOwwwhVVnaknZz3qqgNId/KtbDveCgZX.', '', '2023-07-18 14:31:34', '2023-07-18 14:31:34'),
(33, 'AULIA', 'PITALOKA GUNAWAN ', 'auliapitaloka@gmail.com', '$2y$10$5aBONZZE9Pnm8ke.Ntj3LefIGKDXOsDjZzdJ/4iMDU0OhSSEu5C.2', '', '2023-07-31 22:30:33', '2023-07-31 22:30:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `tanggal_pinjam` date DEFAULT current_timestamp(),
  `tanggal_kembali` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `member_id`, `book_id`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(30, 207453, 4, '2023-07-31', '2023-08-07', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nis`);

--
-- Indeks untuk tabel `katalog`
--
ALTER TABLE `katalog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `katalog`
--
ALTER TABLE `katalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
