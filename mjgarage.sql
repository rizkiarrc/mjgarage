-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22 Jan 2023 pada 04.52
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mjgarage`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) COLLATE utf8_bin NOT NULL,
  `email` varchar(128) COLLATE utf8_bin NOT NULL,
  `password` varchar(256) COLLATE utf8_bin NOT NULL,
  `tanggal_daftar` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `tanggal_daftar`) VALUES
(6, 'Oktias Brasserie', 'oktias@example.com', '$2y$10$bukj6K8mCwxdgZy5Dl6kbefjfDDOvHnw3C2b4H9fvVv8zISIRZoe2', '0000-00-00'),
(11, 'admin', 'admin@id.com', '$2y$10$aJ3J9hZWZhAAY7Zq/j3s4uIiF.CeWMcHXUDavNDdG9gK1.qQ7UPS2', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `header_transaksi`
--

CREATE TABLE IF NOT EXISTS `header_transaksi` (
  `id_pembelian` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_transaksi` varchar(128) COLLATE utf8_bin NOT NULL,
  `nama` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `alamat` text COLLATE utf8_bin NOT NULL,
  `telepon` varchar(30) COLLATE utf8_bin NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `status` varchar(30) COLLATE utf8_bin NOT NULL,
  `rekening_pembayaran` varchar(255) COLLATE utf8_bin NOT NULL,
  `rekening_pelanggan` varchar(255) COLLATE utf8_bin NOT NULL,
  `bukti_bayar` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `header_transaksi`
--

INSERT INTO `header_transaksi` (`id_pembelian`, `id_user`, `id_transaksi`, `nama`, `email`, `alamat`, `telepon`, `tanggal_transaksi`, `status`, `rekening_pembayaran`, `rekening_pelanggan`, `bukti_bayar`, `id_rekening`, `nama_bank`) VALUES
(9, 5, '22012023JWDHX518', 'akun', 'akun@contoh.com', 'jln. kinibalu raya b 183 kel. harapan jaya kec. bekasi utara kota bekasi jawa barat 17124', '089699314332', '2023-01-22', 'Konfirmasi', '123456777', 'akun', '60214c260318605df280e7bfd38780931.jpg', 7, 'asd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(128) COLLATE utf8_bin NOT NULL,
  `url` varchar(128) COLLATE utf8_bin NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `url`, `urutan`) VALUES
(9, 'Oli Motor', 'oli-motor', 1),
(10, 'Oli Mobil', 'oli-mobil', 2),
(11, 'Lampu Motor', 'lampu-motor', 3),
(12, 'Pelumas Kendaraan', 'pelumas-kendaraan', 4),
(13, 'Ban Motor', 'ban-motor', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE IF NOT EXISTS `konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `author` varchar(128) COLLATE utf8_bin NOT NULL,
  `keyword` varchar(128) COLLATE utf8_bin NOT NULL,
  `deskripsi` varchar(128) COLLATE utf8_bin NOT NULL,
  `icon` varchar(256) COLLATE utf8_bin NOT NULL,
  `logo` varchar(256) COLLATE utf8_bin NOT NULL,
  `banner` varchar(256) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `tentang` text COLLATE utf8_bin NOT NULL,
  `telepon` varchar(30) COLLATE utf8_bin NOT NULL,
  `facebook` varchar(50) COLLATE utf8_bin NOT NULL,
  `instagram` varchar(50) COLLATE utf8_bin NOT NULL,
  `alamat` text COLLATE utf8_bin NOT NULL,
  `tanggal_post` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `author`, `keyword`, `deskripsi`, `icon`, `logo`, `banner`, `email`, `tentang`, `telepon`, `facebook`, `instagram`, `alamat`, `tanggal_post`) VALUES
(2, 'Rizki', 'Toko Online Sparepart Mobil/Motor', 'CI, Website, PHP, Toko Online, Kue, Sparepart,Mobil,Motor, PHP', 'images-removebg-preview1.png', 'images-removebg-preview.png', 'banner.png', 'mjgarage@gmail.com', 'Mustika Jaya Garage adalah salah satu usaha yang menawarkan berbagai macam kebutahan otomotif, yang didirikan sejak 2019. Mustika Jaya Garage berlokasi di Mustika Jaya, yang dibuka mulai pukul 08.00 – 17.00 WIB. Sejak awal kam berdiri, Mustika Jaya Garage telah berkomitmen untuk memberikan pelayanan terbaik, antara lain:\r\n- restorasi\r\n- PDR\r\n- Polish Coating\r\n- Headlamp Cleaning\r\n- Setel Bumper\r\n.Mustika Jaya Garage juga bergabung dan bekerja sama dengan beberapa produsen di Indonesia untuk memperkuat layanan kami kepada pelanggan.', '089699314332', 'https://www.facebook.com/people/Mustika-Jaya-Garag', 'https://www.instagram.com/mustikajayagarage/', 'Jl. Mustika Jaya No.RT 06, RT.006/RW.012, Mustika Jaya, Kec. Mustika Jaya, Kota Bks, Jawa Barat 17158', '2019-10-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kode_produk` varchar(128) COLLATE utf8_bin NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8_bin NOT NULL,
  `harga` int(50) NOT NULL,
  `stok` int(50) NOT NULL,
  `ukuran` varchar(256) COLLATE utf8_bin NOT NULL,
  `berat` varchar(255) COLLATE utf8_bin NOT NULL,
  `gambar` varchar(255) COLLATE utf8_bin NOT NULL,
  `deskripsi` text COLLATE utf8_bin NOT NULL,
  `tanggal_post` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `kode_produk`, `nama_produk`, `harga`, `stok`, `ukuran`, `berat`, `gambar`, `deskripsi`, `tanggal_post`) VALUES
(15, 10, 'KP000000', 'Oli Power Stering Prestone Merah 1L', 100000, 2, '10 * 20', '960g', 'oli_power_steering_mobil_prestone2.jpg', 'Kondisi: Baru\r\nBerat Satuan: 960 g\r\nKategori: Pelumas Kendaraan\r\nEtalase: Semua Etalase', '2023-01-17'),
(16, 11, 'KP000001', 'LAMPU DEPAN BOHLAM HALOGEN MOTOR PHILIPS ESSENTIAL MOTOR 18 25 35 WATT - 25 WATT', 20000, 4, '10 x 5', '100g', 'LAMPU_DEPAN_BOHLAM_HALOGEN_MOTOR_PHILIPS_ESSENTIAL_MOTOR_18_25_35_WATT_-_25_WATT.jpg', '100% ORIGINAL PHILIPS\r\nHALOGEN YA GAN\r\n30% LEBIH TERANG\r\nTEMBUS HUJAN\r\nDIJAMIN ORIGINAL\r\nTERSEDIA 18 25 35 WATT\r\nKASIH KETERANGAN AJA GAN', '2023-01-21'),
(17, 12, 'KP000002', 'WD-40 Pelumas Anti Karat WD-40 (333ml)', 80000, 5, '20 x 5', '333ml', 'WD_40.jpg', '(ORIGNIAL 1000%)\r\n\r\nSolusi untuk bunyi berdecit / karat /serta dapat melumasi', '2023-01-21'),
(18, 13, 'KP000003', 'BAN MOTOR KENDA 100/80-17 K761 TL (TUBELESS)', 400000, 3, '100/80-17', '5kg', 'Ban_Motor.jpg', 'BAN MOTOR KENDA 100/80-17 K761 TL (TUBELESS)\r\nmade in Indonesia', '2023-01-21'),
(19, 11, 'KP000004', 'Hella Bohlam Motor M5 12V 25/25W P15d-25-1 4500K Performance', 30000, 5, '10 x 5', '200g', 'Hella_Bohlam_Motor_Performance.jpg', 'Spesifikasi:\r\n- 100% Original Official Store Hella\r\n- Tipe Soket : M5\r\n- Tegangan : 12V\r\n- Daya : 25W / 25W Standard P15d-25-1\r\n- Stylish dan outlook keren\r\n- Cahaya cerah berwarna putih-biru hingga 4500K\r\n- Visibilitas yang lebih baik dan mengurangi ketegangan mata\r\n- Umur panjang\r\n- Mampu menahan getaran dan guncangan\r\n- Pemasangan mudah\r\n- 12V, 25/25W, kaki 1\r\n- Untuk motor bebek manual dan matic.', '2023-01-21'),
(20, 10, 'KP000005', 'OLI Shell helix HX6 10W-40 | ORIGINAL | HX6 4 LITER', 275000, 4, '40 x 40', '4 liter', 'OLI_Shell_helix_HX6_10W-40_HX6_4_LITER.jpg', 'Shell Helix HX6 10W40 4L ( ORIGINAL BARCODE )\r\nAPI SN PLUS\r\nACEA A3/B3', '2023-01-21'),
(21, 12, 'KP000006', 'Chain Lube 350ml / Pelumas Oli Rantai Motor Motogard Formula USA', 30000, 4, '-', '300ml', 'Chain_Lube_350ml.jpg', 'Spesifikasi :\r\n- 100% USA Formula Technology\r\n- Anti Karat dan Friksi\r\n- Memperpanjang Umur Rantai\r\n- Menambah Performa berkendara\r\n- Berat Bersih 300ml', '2023-01-21'),
(22, 13, 'KP000007', 'Oli Mesin FASTRON', 80000, 3, '-', '1Liter', 'Oli_Mesin_Fastron_10w_-_40_pertamina_1lt.jpg', '- API Service : SN\r\n- Volume 1000 cc (1L)\r\n- SAE 10W-40\r\n- Synthetic Oil (Superior Protection &amp; Cleanliness)\r\n- Maintain Engine Cleanliness\r\n- Lower Oil Consumption\r\n- Compatible with emission system\r\n- Smoother and Quieter Drive\r\n- Protect Engine from Wear and Deposit', '2023-01-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE IF NOT EXISTS `rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(128) COLLATE utf8_bin NOT NULL,
  `nomor_rekening` varchar(128) COLLATE utf8_bin NOT NULL,
  `nama_pemilik` varchar(128) COLLATE utf8_bin NOT NULL,
  `tanggal_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `nama_bank`, `nomor_rekening`, `nama_pemilik`, `tanggal_post`) VALUES
(6, 'Mandiri', '1560016741409', 'Fikri Aulia Rahman', '2023-01-17 14:24:21'),
(7, 'OVO', '089699314332', 'Muhammad Rizki Arrachim', '2023-01-17 14:24:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` varchar(128) COLLATE utf8_bin NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_produk`, `harga`, `jumlah`, `total_harga`, `tanggal_transaksi`) VALUES
('22012023JWDHX518', 5, 16, 20000, 1, 20000, '2023-01-22 02:05:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(128) COLLATE utf8_bin NOT NULL,
  `email` varchar(128) COLLATE utf8_bin NOT NULL,
  `password` varchar(256) COLLATE utf8_bin NOT NULL,
  `alamat` text COLLATE utf8_bin NOT NULL,
  `telepon` varchar(30) COLLATE utf8_bin NOT NULL,
  `gambar` varchar(128) COLLATE utf8_bin NOT NULL,
  `tanggal_daftar` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `alamat`, `telepon`, `gambar`, `tanggal_daftar`) VALUES
(5, 'akun', 'akun@contoh.com', '$2y$10$9x9UDlcRJ.YQLUeNGotntu1v6vgLuHwEzEZlalYXn5L.yNr.6mjIO', 'jln. kinibalu raya b 183 kel. harapan jaya kec. bekasi utara kota bekasi jawa barat 17124', '089699314332', '', 1673964645);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_transaksi`
--
ALTER TABLE `header_transaksi`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`),
  ADD UNIQUE KEY `nomor_rekening` (`nomor_rekening`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `header_transaksi`
--
ALTER TABLE `header_transaksi`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
