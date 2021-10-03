-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Okt 2021 pada 16.23
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
-- Database: `booking_ticket`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `tgl_tayang` datetime DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `film`
--

INSERT INTO `film` (`id`, `tgl_tayang`, `nama`, `genre_id`, `thumbnail`, `description`, `harga`, `durasi`) VALUES
(2, '2021-09-21 00:00:00', 'BLACK WIDOW', 1, '6157ad9c0cbba6157ad9c0cbbd.jpg', 'Sebuah film tentang Natasha Romanoff (Scarlett Johansson) dan kisah petualangan antara film Civil War dan Infinity War. Natasha Romanoff (Scarlett Johansson) kembali ke kampung halamannya di Rusia untuk menyelesaikan misi berbahaya. Natasha bertemu dengan keluarga dari masa lalunya untuk melawan seorang musuh berbahaya bernama Taskmaster. A film about Natasha Romanoff in her quests between the films Civil War and Infinity War.', 30000, 120),
(7, '2021-09-29 00:00:00', 'SHANG-CHI AND THE LEGEND OF THE TEN RINGS', 2, '6157ad90b73236157ad90b7325.jpg', 'Shang-Chi (Simu Liu) harus menghadapi masa lalunya sebelum ia memilih untuk meninggalkan dan bergabung ke dalam sebuah organisasi bernama Ten Rings. Shang-Chi, the master of unarmed weaponry-based Kung Fu, is forced to confront his past after being drawn into the Ten Rings organization.', 30000, 120),
(8, '2021-09-29 00:00:00', 'BANG DREAM! EPISODE OF ROSELIA I: PROMISE', 2, '6157a246e45506157a246e4551.jpg', 'Are you prepared to fully devote yourselves to Roselia?? To reach the stage of \"FES.\", Yukina Minato decides to form a band. Each holding their own convictions, the members of the band come together. The five girls now begin their journey to the top as Roselia. This is the story of their \"promise\" made to each other, From the start of the band to their challenge towards FUTURE WORLD FES!', 30000, 130),
(9, '2021-09-29 00:00:00', 'BLACKPINK: THE MOVIE', 2, '6157a398bdbed6157a398bdbee.jpg', 'Grup wanita yang dicintai oleh dunia, \'BLACKPINK\' merayakan ulang tahun ke-5 debut mereka dengan merilis BLACKPINK THE MOVIE, ini juga merupakan hadiah spesial untuk \'BLINKs\'?fandom tercinta BLACKPINK? untuk mengingat kembali kenangan lama dan menikmati penampilan penuh gairah dalam semangat pesta. BLACKPINK?yang terdiri dari JISOO, JENNIE, ROSE, dan LISA?telah berkembang pesat sejak mereka pertama kali muncul di dunia pada 8 Agustus 2016, bersama dengan fandomnya \'BLINK.\' Sesibuk apa pun selama lima tahun terakhir, semua kenangan, kesenangan di atas panggung, dan momen bersinar mereka telah dikemas \'seperti hadiah untuk semua penggemar\' di BLACKPINK THE MOVIE. Film ini terdiri dari beragam urutan yang berfokus pada setiap anggota BLACKPINK, beberapa di antaranya adalah: \'The Room of Memories\'; segmen berbagi kenangan lima tahun sejak debut BLACKPINK, \'Beauty\'; rekaman menarik dari keempat anggota dengan karakteristik mereka yang berbeda, \'Wawancara Eksklusif\'; sebuah pesan untuk para penggemar. Selain itu, panggung khas BLACKPINK yang melampaui kebangsaan dan gender yang memikat dunia dengan penampilan luar biasa memenuhi layar dengan kehadiran yang maksimal. \'THE SHOW\' (2021), \'IN YOUR AREA\' (2018), dan selusin lagu hit lainnya dari BLACKPINK akan ditampilkan di layar untuk memberikan pengalaman menyentuh kepada para penggemar seolah-olah mereka benar-benar berada di acara fan meeting dan konser langsungnya.', 30000, 120);

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
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `uniqid` varchar(50) DEFAULT NULL,
  `tiket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `uniqid`, `tiket_id`, `user_id`) VALUES
(7, NULL, 7, 10),
(8, NULL, 8, 10),
(13, NULL, 12, 10),
(14, NULL, 13, 11),
(16, NULL, 15, 12),
(17, NULL, 16, 12),
(18, NULL, 17, 13),
(19, NULL, 18, 13),
(20, NULL, 19, 15);

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
  `last_cart` datetime DEFAULT NULL COMMENT '>30m exp'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kursi`
--

INSERT INTO `kursi` (`id`, `nomor_kursi`, `abjad`, `kelas_studio`, `tersedia`, `last_cart`) VALUES
(1, '1', 'A', 1, 0, '2021-10-03 20:47:03'),
(3, '2', 'A', 1, 0, '2021-10-03 20:47:03'),
(4, '12', 'B', 1, 0, '2021-10-03 21:01:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket`
--

CREATE TABLE `tiket` (
  `id` int(11) NOT NULL,
  `atas_nama` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(255) DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `film_id` int(11) DEFAULT NULL,
  `kursi_id` int(11) DEFAULT NULL,
  `is_cart` int(11) DEFAULT NULL COMMENT '1:true'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tiket`
--

INSERT INTO `tiket` (`id`, `atas_nama`, `nomor_hp`, `transaksi_id`, `film_id`, `kursi_id`, `is_cart`) VALUES
(9, 'Customer', '081249118805', NULL, 7, 1, 1),
(10, 'Customer', '081249118805', NULL, 7, 1, 1),
(11, 'Customer', '081249118805', NULL, 7, 1, 1),
(12, 'Customer', '081249118805', 17, 2, 1, 0),
(13, 'kholiqul', '082244007536', 18, 2, 1, 0),
(14, 'kholiqul', '082244007536', NULL, 8, 3, 1),
(15, 'kahfi', '085162614639', 19, 9, 3, 0),
(16, 'kahfi', '085162614639', 19, 2, 3, 0),
(17, 'nisaani', '088888888888', 20, 9, 1, 0),
(18, 'nisaani', '088888888888', 20, 2, 3, 0),
(19, 'user', '00000000000', 21, 2, 4, 0);

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

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `nomor_transaksi`, `tgl_transaksi`, `total`, `metode_bayar`, `telah_dibayar`, `user_id`, `bukti_bayar`) VALUES
(17, 'TX/10/2021/0000', '2021-10-02', 30000, 2, 0, 10, '6157ae0d320bb6157ae0d320c7.jpg'),
(18, 'TX/10/2021/0017', '2021-10-03', 30000, 1, 0, 11, NULL),
(19, 'TX/10/2021/0018', '2021-10-03', 60000, 2, 0, 12, NULL),
(20, 'TX/10/2021/0019', '2021-10-03', 60000, 2, 1, 13, '6159b476aff896159b476aff8d.png'),
(21, 'TX/10/2021/0020', '2021-10-03', 30000, 2, 1, 15, '6159b7e7eb53c6159b7e7eb54b.png');

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
(11, 'kholiqul', 'kholiqcaem@gmail.com', 'e9c3046e31439f2018e964b7a7118468', NULL, NULL, '082244007536', 1),
(12, 'kahfi', 'kahfi@gmail.com', '64d2753197ba92f6fe30371c52d1b824', NULL, NULL, '085162614639', 3),
(13, 'nisaani', 'nisa.ani@gmail.com', 'e9c3046e31439f2018e964b7a7118468', NULL, NULL, '088888888888', 3),
(14, 'admin', 'admin@email.com', '9ed5429ac4129c33c8b366145e582e29', NULL, NULL, '00000000000', 1),
(15, 'user', 'user@email.com', 'db3fc40e6439d4d972870252ccc72f62', NULL, NULL, '00000000000', 3);

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
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `kursi`
--
ALTER TABLE `kursi`
  ADD PRIMARY KEY (`id`) USING BTREE;

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
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kursi`
--
ALTER TABLE `kursi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
