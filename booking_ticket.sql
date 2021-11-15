-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Nov 2021 pada 07.39
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ctob`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `film`
--

INSERT INTO `film` (`id`, `nama`, `genre_id`, `thumbnail`, `description`, `harga`) VALUES
(2, 'BLACK WIDOW', 1, '6157ad9c0cbba6157ad9c0cbbd.jpg', 'Sebuah film tentang Natasha Romanoff (Scarlett Johansson) dan kisah petualangan antara film Civil War dan Infinity War. Natasha Romanoff (Scarlett Johansson) kembali ke kampung halamannya di Rusia untuk menyelesaikan misi berbahaya. Natasha bertemu dengan keluarga dari masa lalunya untuk melawan seorang musuh berbahaya bernama Taskmaster. A film about Natasha Romanoff in her quests between the films Civil War and Infinity War.', 30000),
(7, 'SHANG-CHI AND THE LEGEND OF THE TEN RINGS', 2, '6157ad90b73236157ad90b7325.jpg', 'Shang-Chi (Simu Liu) harus menghadapi masa lalunya sebelum ia memilih untuk meninggalkan dan bergabung ke dalam sebuah organisasi bernama Ten Rings. Shang-Chi, the master of unarmed weaponry-based Kung Fu, is forced to confront his past after being drawn into the Ten Rings organization.', 30000),
(8, 'BANG DREAM! EPISODE OF ROSELIA I: PROMISE', 2, '6157a246e45506157a246e4551.jpg', 'Are you prepared to fully devote yourselves to Roselia?? To reach the stage of \"FES.\", Yukina Minato decides to form a band. Each holding their own convictions, the members of the band come together. The five girls now begin their journey to the top as Roselia. This is the story of their \"promise\" made to each other, From the start of the band to their challenge towards FUTURE WORLD FES!', 30000),
(9, 'BLACKPINK: THE MOVIE', 2, '6157a398bdbed6157a398bdbee.jpg', 'Grup wanita yang dicintai oleh dunia, \'BLACKPINK\' merayakan ulang tahun ke-5 debut mereka dengan merilis BLACKPINK THE MOVIE, ini juga merupakan hadiah spesial untuk \'BLINKs\'?fandom tercinta BLACKPINK? untuk mengingat kembali kenangan lama dan menikmati penampilan penuh gairah dalam semangat pesta. BLACKPINK?yang terdiri dari JISOO, JENNIE, ROSE, dan LISA?telah berkembang pesat sejak mereka pertama kali muncul di dunia pada 8 Agustus 2016, bersama dengan fandomnya \'BLINK.\' Sesibuk apa pun selama lima tahun terakhir, semua kenangan, kesenangan di atas panggung, dan momen bersinar mereka telah dikemas \'seperti hadiah untuk semua penggemar\' di BLACKPINK THE MOVIE. Film ini terdiri dari beragam urutan yang berfokus pada setiap anggota BLACKPINK, beberapa di antaranya adalah: \'The Room of Memories\'; segmen berbagi kenangan lima tahun sejak debut BLACKPINK, \'Beauty\'; rekaman menarik dari keempat anggota dengan karakteristik mereka yang berbeda, \'Wawancara Eksklusif\'; sebuah pesan untuk para penggemar. Selain itu, panggung khas BLACKPINK yang melampaui kebangsaan dan gender yang memikat dunia dengan penampilan luar biasa memenuhi layar dengan kehadiran yang maksimal. \'THE SHOW\' (2021), \'IN YOUR AREA\' (2018), dan selusin lagu hit lainnya dari BLACKPINK akan ditampilkan di layar untuk memberikan pengalaman menyentuh kepada para penggemar seolah-olah mereka benar-benar berada di acara fan meeting dan konser langsungnya.', 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `genre`
--

INSERT INTO `genre` (`id`, `nama`) VALUES
(1, 'Comedy'),
(2, 'Romance');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `waktu_mulai` timestamp NULL DEFAULT NULL,
  `waktu_selesai` timestamp NULL DEFAULT NULL,
  `id_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `waktu_mulai`, `waktu_selesai`, `id_film`) VALUES
(1, '2021-11-15 01:11:48', '2021-11-15 03:11:48', 2),
(2, '2021-11-16 01:11:48', '2021-11-16 03:11:48', 2),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `uniqid` varchar(50) DEFAULT NULL,
  `tiket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kursi`
--

CREATE TABLE `kursi` (
  `id` int(11) NOT NULL,
  `nomor_kursi` varchar(255) DEFAULT NULL,
  `abjad` varchar(255) DEFAULT NULL,
  `kelas_studio` int(11) DEFAULT NULL COMMENT '\r\n1:standar,2:premium, 3: max movie',
  `tersedia` int(11) DEFAULT NULL COMMENT '1: true',
  `last_cart` datetime DEFAULT NULL COMMENT '>30m exp',
  `id_jadwal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kursi`
--

INSERT INTO `kursi` (`id`, `nomor_kursi`, `abjad`, `kelas_studio`, `tersedia`, `last_cart`, `id_jadwal`) VALUES
(1, '1', 'A', 1, 1, NULL, 2),
(3, '2', 'A', 1, 1, NULL, 2),
(4, '12', 'B', 1, 1, NULL, 2),
(5, '12', 'A', 2, 1, NULL, 2),
(6, '35', 'A', 3, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket`
--

CREATE TABLE `tiket` (
  `id` int(11) NOT NULL,
  `atas_nama` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(255) DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `id_jadwal` int(11) NOT NULL,
  `kursi_id` int(11) DEFAULT NULL,
  `is_cart` int(11) DEFAULT NULL COMMENT '1:true'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nomor_transaksi` varchar(255) NOT NULL,
  `tgl_transaksi` date NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL,
  `metode_bayar` int(11) NOT NULL COMMENT '1 : cash; 2 : debit',
  `telah_dibayar` int(11) NOT NULL DEFAULT 0 COMMENT '1 : sudah',
  `user_id` int(11) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_ktp` varchar(20) DEFAULT NULL,
  `nomor_hp` varchar(20) DEFAULT NULL,
  `role` int(11) DEFAULT NULL COMMENT '1: admin;3customer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `alamat`, `nomor_ktp`, `nomor_hp`, `role`) VALUES
(10, 'Customer', 'customer@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '081249118805', 3),
(11, 'kholiqul', 'kholiqcaem@gmail.com', 'e9c3046e31439f2018e964b7a7118468', NULL, NULL, '082244007536', 3),
(12, 'kahfi', 'kahfi@gmail.com', '64d2753197ba92f6fe30371c52d1b824', NULL, NULL, '085162614639', 3),
(13, 'nisaani', 'nisa.ani@gmail.com', 'e9c3046e31439f2018e964b7a7118468', NULL, NULL, '088888888888', 3),
(14, 'admin', 'admin@email.com', '9ed5429ac4129c33c8b366145e582e29', NULL, NULL, '00000000000', 1),
(15, 'user', 'user@email.com', 'db3fc40e6439d4d972870252ccc72f62', NULL, NULL, '00000000000', 3),
(16, 'kholiqul', 'kholiqul@email.com', '25f9e794323b453885f5181f1b624d0b', NULL, NULL, '082244007536', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `film_referencekey` (`id_film`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `kursi`
--
ALTER TABLE `kursi`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_jadwal_referencekey` (`id_jadwal`);

--
-- Indeks untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `anggota_id` (`nomor_transaksi`) USING BTREE,
  ADD KEY `buku_id` (`tgl_transaksi`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kursi`
--
ALTER TABLE `kursi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
