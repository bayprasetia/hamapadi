-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Jun 2025 pada 16.42
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
-- Database: `hamapadi_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `basis_pengetahuan`
--

CREATE TABLE `basis_pengetahuan` (
  `id` int(11) NOT NULL,
  `idpenyakit` varchar(10) DEFAULT NULL,
  `idgejala` varchar(10) DEFAULT NULL,
  `bobot` float DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `basis_pengetahuan`
--

INSERT INTO `basis_pengetahuan` (`id`, `idpenyakit`, `idgejala`, `bobot`) VALUES
(32, 'K01', 'G5', 1),
(33, 'K01', 'G6', 1),
(34, 'K01', 'G7', 1),
(35, 'K01', 'G2', 1),
(36, 'K01', 'G3', 1),
(37, 'K01', 'G4', 1),
(38, 'K01', 'G14', 1),
(39, 'K02', 'G12', 1),
(40, 'K02', 'G2', 1),
(41, 'K02', 'G9', 1),
(42, 'K02', 'G10', 1),
(43, 'K02', 'G13', 1),
(44, 'K02', 'G8', 1),
(45, 'K02', 'G11', 1),
(46, 'K03', 'G20', 1),
(47, 'K03', 'G7', 1),
(48, 'K03', 'G35', 1),
(49, 'K03', 'G13', 1),
(50, 'K03', 'G8', 1),
(51, 'K03', 'G11', 1),
(52, 'K03', 'G32', 1),
(53, 'K04', 'G31', 1),
(54, 'K04', 'G20', 1),
(55, 'K04', 'G27', 1),
(56, 'K04', 'G21', 1),
(57, 'K04', 'G26', 1),
(58, 'K04', 'G15', 1),
(59, 'K04', 'G7', 1),
(60, 'K04', 'G16', 1),
(61, 'K04', 'G3', 1),
(62, 'K04', 'G10', 1),
(63, 'K04', 'G4', 1),
(64, 'K05', 'G31', 1),
(65, 'K05', 'G20', 1),
(66, 'K05', 'G29', 1),
(67, 'K05', 'G27', 1),
(68, 'K05', 'G36', 1),
(69, 'K05', 'G3', 1),
(70, 'K05', 'G13', 1),
(71, 'K05', 'G17', 1),
(72, 'K05', 'G8', 1),
(73, 'K05', 'G11', 1),
(93, 'K07', 'G31', 1),
(94, 'K07', 'G15', 1),
(95, 'K07', 'G16', 1),
(96, 'K07', 'G9', 1),
(97, 'K07', 'G10', 1),
(98, 'K07', 'G123', 1),
(99, 'K07', 'G13', 1),
(100, 'K07', 'G17', 1),
(101, 'K07', 'G11', 1),
(102, 'K07', 'G28', 1),
(118, 'K06', 'G20', 1),
(119, 'K06', 'G38', 1),
(120, 'K06', 'G5', 1),
(121, 'K06', 'G6', 1),
(122, 'K06', 'G12', 1),
(123, 'K06', 'G26', 1),
(124, 'K06', 'G15', 1),
(125, 'K06', 'G34', 1),
(126, 'K06', 'G7', 1),
(127, 'K06', 'G16', 1),
(128, 'K06', 'G35', 1),
(129, 'K06', 'G9', 1),
(130, 'K06', 'G10', 1),
(131, 'K06', 'G4', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_konsultasi`
--

CREATE TABLE `detail_konsultasi` (
  `idkonsultasi` int(11) DEFAULT NULL,
  `idgejala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penyakit`
--

CREATE TABLE `detail_penyakit` (
  `idkonsultasi` int(11) DEFAULT NULL,
  `idpenyakit` int(11) DEFAULT NULL,
  `persentase` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `idgejala` varchar(10) NOT NULL,
  `nmgejala` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`idgejala`, `nmgejala`) VALUES
('G10', 'Menyerang Buku pada malai'),
('G11', 'Pemasakan makanan terhambat'),
('G12', 'Butiran menjadi Hampa'),
('G123', 'Menyerang Pelepah'),
('G13', 'Menyerang tangkai malai'),
('G14', 'Menyerang pelepah yang membentuk anakan'),
('G15', 'Jumlah gabah menurun'),
('G16', 'Kualitas Gabah kurang baik'),
('G17', 'Menyerang titik tumbuh padi'),
('G2', 'Malai'),
('G20', 'Batang berisi cairan kehitaman'),
('G21', 'Daun Mengering'),
('G22', 'Daun Mati'),
('G23', 'Daun terkulai'),
('G24', 'Akar membusuk'),
('G25', 'Menyerang semua bagian tanaman'),
('G26', 'Daun menjadi pendek'),
('G27', 'Batang menjadi sempit'),
('G28', 'Tanaman berwana hijau kekuningan'),
('G29', 'Batang menjadi pendek'),
('G3', 'Menyerang Buah yang baru tumbuh'),
('G30', 'Buku-Buku menjadi pendek'),
('G31', 'Anakan banyak tapi kecil'),
('G32', 'Pertumbuhan tanaman kurang sempurna'),
('G33', 'Daun menguning dan kecoklatan'),
('G34', 'Jumlah tunas berkurang'),
('G35', 'Malai menjadi kecil'),
('G36', 'Malai tidak berisi'),
('G37', 'Bercak daun membesar'),
('G38', 'Bercak kehitaman pada pelepah'),
('G4', 'Menyerang pada Kecambah'),
('G5', 'Biji bercak coklat tetapi tetap berisi'),
('G6', 'Biji Kecambah busuk'),
('G7', 'Kecambah mati'),
('G8', 'Padi dewasa busuk dan kering'),
('G9', 'Menyerang Bagian daun'),
('G99', 'daun muda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `idpenyakit` varchar(10) NOT NULL,
  `nmpenyakit` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `solusi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`idpenyakit`, `nmpenyakit`, `keterangan`, `solusi`) VALUES
('K01', 'Bercak dan Daun Coklat', NULL, '1. Jarak tanam yang tidak terlalu rapat terutama saat \r\nmusim hujan. \r\n2. Jika perlu gunakan cara tanam sistem legowo. \r\n3. Jangan gunakan urea yang berlebih dan imbangi \r\ndengan unsur K. \r\n4. Aplikasi fungisida pada daun tanaman padi, \r\ncontoh: antracol, dithane, dan fungisida kontak \r\nlain sebagai pencegahnya. Jika sudah terserang gunakan fungisida sistemik seperti score, anvil, \r\nfolicur, Nativo, opus, indar dll. \r\n5. Penanaman varietas tahan, seperti Ciherang dan \r\nMembrano. \r\n6. Pemupukan berimbang yang lengkap, yaitu 250 \r\nkg urea, 100 kg SP36, dan 100 kg KCl per ha. \r\n7. Penyemprotan fungisida dengan bahan aktif \r\ndifenoconazol, azoxistrobin, belerang, \r\ndifenokonazol, tebukonazol, karbendazim, metil \r\ntiofanat, atau klorotalonil.'),
('K02', 'Blas', NULL, '1. Membakar sisa jerami \r\n2. Menggenangi sawah \r\n3. Menanam bibit varietas unggul Sentani, \r\nCimandiri, IR-48, IR-36 \r\n4. Pemberian pupuk N disaat pertengahan fase \r\nvegetatif dan fase pembentukan bulir \r\n5. Pemberian GLIO diawal tanam'),
('K03', 'Pelepah Daun', NULL, '1. Pengaturan jarak tanam yang tidak terlalu rapat \r\n2. Pemupukan berimbang \r\n3. Pengairan berselang \r\n4. Sanitasi sisa tanaman dan gulma di sekitar sawah \r\n5. Aplikasi fungisida berbahan aktif benomyl, \r\ndifenoconazol, mankozeb, dan validamycin'),
('K04', 'Fusarium', NULL, '1. Merenggangkan jarak tanam \r\n2. Menelupkan bibit kedalam air campuran \r\nPOCNASA \r\n3. Sebarkan GLIO dilahan'),
('K05', 'Kresek Hawar daun', NULL, '1. Perbaikan cara bercocok tanam, melalui: \r\n2. Pengolahan tanah secara optimal \r\n3. Pengaturan pola tanam dan waktu tanam \r\nserempak dalam satu hamparan \r\n4. Pergiliran tanam dan varietas tahan \r\n5. Penanaman varietas unggul dari benih yang sehat \r\n6. Pengaturan jarak tanam \r\n7. Pemupukan berimbang (N,P, K dan unsur mikro) \r\nsesuai dengan fase pertumbuhan dan musim \r\n8. Pengaturan sistem pengairan sesuai dengan fase \r\npertumbuhan tanaman. \r\n9. Sanitasi lingkungan \r\n10. Pemanfaatan agensia hayati Corynebacterium \r\n11. Penyemprotan bakterisida anjuran yang efektif \r\ndan diizinkan secara bijaksana berdasarkan hasil \r\npengamatan.'),
('K06', 'Kerdil', NULL, '1. Menggunakan bibit unggul \r\n2. Pengendalian sumber virus dengan membersikan \r\ngulma sekitar tanamana padi \r\n3. Bercocok tanaman dengan tepat \r\n4. Pengendalian biologi dapat dilakukan  \r\npemenanfaatan musuh dari tanaman yang \r\ndisebabkan virus kerdil tersebut \r\n5. Penyemprotan pertisida dan insektisida'),
('K07', 'Tungro', NULL, '1. Menggunakan varietas tahan, seperti Tukad \r\nUnda, Tukad Balian, Tukad Petanu, Bondoyudo, \r\ndan Kalimas \r\n2. Mencabut dan membakar tanaman terinfeksi, jika \r\nserangan belum parah. \r\n3. Tanam benih langsung (Tabela): Infeksi tungro \r\nbiasanya lebih rendah pada tabela karena lebih \r\ntingginya populasi tanaman (bila dibandingkan \r\ntanam pindah). Dengan demikian wereng \r\ncenderung mencari dan makan serta menyerang \r\ntanaman yang lebih rendah populasinya. \r\n4. Menanam padi saat populasi wereng hijau dan \r\ntungro rendah \r\n5. Menanam secara serempak \r\n6. Rotasi tanaman dengan tanaman lain selain padi. \r\n7. Mengendalikan wereng hijau sebagai vektornya \r\ndengan penyemprotan insektisida yang berbahan \r\naktif abamectin.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$Af3x78UYViFDMVooh0aO8OUbFhre7NTDaHbx8TaWBagjFV4oGyNIu', 'admin'),
(2, 'bayu', '$2y$10$b1gHusvHUIuyupll5d3wAOPGrdNqxB3gCSm63/ubsDO7HhVkg7Cti', 'user'),
(3, 'abror', '$2y$10$0sujQqp03/Reweq.AT4eGuIT3bFkKM/Pt6MQIy8JOmdbLS2.UvM0m', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpenyakit` (`idpenyakit`),
  ADD KEY `idgejala` (`idgejala`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`idgejala`) USING BTREE;

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`idpenyakit`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  ADD CONSTRAINT `basis_pengetahuan_ibfk_1` FOREIGN KEY (`idpenyakit`) REFERENCES `penyakit` (`idpenyakit`),
  ADD CONSTRAINT `basis_pengetahuan_ibfk_2` FOREIGN KEY (`idgejala`) REFERENCES `gejala` (`idgejala`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
