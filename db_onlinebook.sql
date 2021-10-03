/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : db_onlinebook

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 02/10/2021 07:56:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for film
-- ----------------------------
DROP TABLE IF EXISTS `film`;
CREATE TABLE `film`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tgl_tayang` datetime NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `genre_id` int NULL DEFAULT NULL,
  `thumbnail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `harga` int NULL DEFAULT NULL,
  `durasi` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of film
-- ----------------------------
INSERT INTO `film` VALUES (2, '2021-09-21 00:00:00', 'BLACK WIDOW', 1, '6157ad9c0cbba6157ad9c0cbbd.jpg', 'Sebuah film tentang Natasha Romanoff (Scarlett Johansson) dan kisah petualangan antara film Civil War dan Infinity War. Natasha Romanoff (Scarlett Johansson) kembali ke kampung halamannya di Rusia untuk menyelesaikan misi berbahaya. Natasha bertemu dengan keluarga dari masa lalunya untuk melawan seorang musuh berbahaya bernama Taskmaster. A film about Natasha Romanoff in her quests between the films Civil War and Infinity War.', 30000, 120);
INSERT INTO `film` VALUES (7, '2021-09-29 00:00:00', 'SHANG-CHI AND THE LEGEND OF THE TEN RINGS', 2, '6157ad90b73236157ad90b7325.jpg', 'Shang-Chi (Simu Liu) harus menghadapi masa lalunya sebelum ia memilih untuk meninggalkan dan bergabung ke dalam sebuah organisasi bernama Ten Rings. Shang-Chi, the master of unarmed weaponry-based Kung Fu, is forced to confront his past after being drawn into the Ten Rings organization.', 30000, 120);
INSERT INTO `film` VALUES (8, '2021-09-29 00:00:00', 'BANG DREAM! EPISODE OF ROSELIA I: PROMISE', 2, '6157a246e45506157a246e4551.jpg', 'Are you prepared to fully devote yourselves to Roselia?? To reach the stage of \"FES.\", Yukina Minato decides to form a band. Each holding their own convictions, the members of the band come together. The five girls now begin their journey to the top as Roselia. This is the story of their \"promise\" made to each other, From the start of the band to their challenge towards FUTURE WORLD FES!', 30000, 130);
INSERT INTO `film` VALUES (9, '2021-09-29 00:00:00', 'BLACKPINK: THE MOVIE', 2, '6157a398bdbed6157a398bdbee.jpg', 'Grup wanita yang dicintai oleh dunia, \'BLACKPINK\' merayakan ulang tahun ke-5 debut mereka dengan merilis BLACKPINK THE MOVIE, ini juga merupakan hadiah spesial untuk \'BLINKs\'?fandom tercinta BLACKPINK? untuk mengingat kembali kenangan lama dan menikmati penampilan penuh gairah dalam semangat pesta. BLACKPINK?yang terdiri dari JISOO, JENNIE, ROSE, dan LISA?telah berkembang pesat sejak mereka pertama kali muncul di dunia pada 8 Agustus 2016, bersama dengan fandomnya \'BLINK.\' Sesibuk apa pun selama lima tahun terakhir, semua kenangan, kesenangan di atas panggung, dan momen bersinar mereka telah dikemas \'seperti hadiah untuk semua penggemar\' di BLACKPINK THE MOVIE. Film ini terdiri dari beragam urutan yang berfokus pada setiap anggota BLACKPINK, beberapa di antaranya adalah: \'The Room of Memories\'; segmen berbagi kenangan lima tahun sejak debut BLACKPINK, \'Beauty\'; rekaman menarik dari keempat anggota dengan karakteristik mereka yang berbeda, \'Wawancara Eksklusif\'; sebuah pesan untuk para penggemar. Selain itu, panggung khas BLACKPINK yang melampaui kebangsaan dan gender yang memikat dunia dengan penampilan luar biasa memenuhi layar dengan kehadiran yang maksimal. \'THE SHOW\' (2021), \'IN YOUR AREA\' (2018), dan selusin lagu hit lainnya dari BLACKPINK akan ditampilkan di layar untuk memberikan pengalaman menyentuh kepada para penggemar seolah-olah mereka benar-benar berada di acara fan meeting dan konser langsungnya.', 30000, 120);

-- ----------------------------
-- Table structure for genre
-- ----------------------------
DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of genre
-- ----------------------------
INSERT INTO `genre` VALUES (1, 'Comedy');
INSERT INTO `genre` VALUES (2, 'Romance');

-- ----------------------------
-- Table structure for keranjang
-- ----------------------------
DROP TABLE IF EXISTS `keranjang`;
CREATE TABLE `keranjang`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `uniqid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tiket_id` int NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of keranjang
-- ----------------------------
INSERT INTO `keranjang` VALUES (7, NULL, 7, 10);
INSERT INTO `keranjang` VALUES (8, NULL, 8, 10);
INSERT INTO `keranjang` VALUES (13, NULL, 12, 10);

-- ----------------------------
-- Table structure for kursi
-- ----------------------------
DROP TABLE IF EXISTS `kursi`;
CREATE TABLE `kursi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor_kursi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `abjad` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kelas_studio` int NULL DEFAULT NULL COMMENT '\r\n1:standar,2:premium, 3: max movie',
  `tersedia` int NULL DEFAULT NULL COMMENT '1: true',
  `last_cart` datetime NULL DEFAULT NULL COMMENT '>30m exp',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kursi
-- ----------------------------
INSERT INTO `kursi` VALUES (1, '1', 'A', 1, 1, '2021-10-02 07:55:08');
INSERT INTO `kursi` VALUES (3, '2', 'A', 1, 1, NULL);

-- ----------------------------
-- Table structure for tiket
-- ----------------------------
DROP TABLE IF EXISTS `tiket`;
CREATE TABLE `tiket`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `atas_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_hp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `transaksi_id` int NULL DEFAULT NULL,
  `film_id` int NULL DEFAULT NULL,
  `kursi_id` int NULL DEFAULT NULL,
  `is_cart` int NULL DEFAULT NULL COMMENT '1:true',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tiket
-- ----------------------------
INSERT INTO `tiket` VALUES (9, 'Customer', '081249118805', NULL, 7, 1, 1);
INSERT INTO `tiket` VALUES (10, 'Customer', '081249118805', NULL, 7, 1, 1);
INSERT INTO `tiket` VALUES (11, 'Customer', '081249118805', NULL, 7, 1, 1);
INSERT INTO `tiket` VALUES (12, 'Customer', '081249118805', 17, 2, 1, 0);

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_transaksi` date NOT NULL DEFAULT current_timestamp,
  `total` int NOT NULL,
  `metode_bayar` int NOT NULL COMMENT '1 : cash; 2 : debit',
  `telah_dibayar` int NOT NULL DEFAULT 0 COMMENT '1 : sudah',
  `user_id` int NULL DEFAULT NULL,
  `bukti_bayar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `anggota_id`(`nomor_transaksi`) USING BTREE,
  INDEX `buku_id`(`tgl_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (17, 'TX/10/2021/0000', '2021-10-02', 30000, 2, 0, 10, '6157ae0d320bb6157ae0d320c7.jpg');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `nomor_ktp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_hp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role` int NULL DEFAULT NULL COMMENT '1: admin;3customer',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'fairus', 'fairuzminannafis@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, 1);
INSERT INTO `user` VALUES (10, 'Customer', 'customer@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '081249118805', 3);

SET FOREIGN_KEY_CHECKS = 1;
