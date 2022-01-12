-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 22 Apr 2021 pada 12.39
-- Versi Server: 5.7.29-log
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ilovemas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_carat`
--

CREATE TABLE IF NOT EXISTS `tb_carat` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(10) NOT NULL,
  `c_type` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_carat`
--

INSERT INTO `tb_carat` (`c_id`, `c_name`, `c_type`) VALUES
(2, '2', '2'),
(3, '3', '2'),
(4, '4', '2'),
(5, '5', '2'),
(6, '6', '2'),
(7, '7', '2'),
(8, '8', '2'),
(9, '9', '2'),
(10, '10', '2'),
(11, '11', '2'),
(12, '12', '2'),
(13, '13', '2'),
(14, '14', '2'),
(15, '15', '2'),
(16, '16', '2'),
(17, '17', '2'),
(18, '18', '2'),
(19, '19', '2'),
(20, '20', '2'),
(21, '21', '2'),
(22, '22', '2'),
(23, '23', '2'),
(24, '24(99)', '2'),
(25, '500', '5'),
(26, '900', '5'),
(27, '925', '5'),
(28, '1000', '5'),
(29, '24(99.9)', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_formula`
--

CREATE TABLE IF NOT EXISTS `tb_formula` (
  `f_id` int(11) NOT NULL,
  `f_rti_au` double NOT NULL,
  `f_rti_pt` double NOT NULL,
  `f_rti_ag` double NOT NULL,
  `f_nol5` double NOT NULL,
  `f_1` double NOT NULL,
  `f_2_coma_5` double NOT NULL,
  `f_2` double NOT NULL,
  `f_3` double NOT NULL,
  `f_5` double NOT NULL,
  `f_10` double NOT NULL,
  `f_25` double NOT NULL,
  `f_50` double NOT NULL,
  `f_100` double NOT NULL,
  `f_250` double NOT NULL,
  `f_500` double NOT NULL,
  `f_1000` double NOT NULL,
  `f_rti_au_sell` double NOT NULL,
  `f_rti_ag_sell` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_formula`
--

INSERT INTO `tb_formula` (`f_id`, `f_rti_au`, `f_rti_pt`, `f_rti_ag`, `f_nol5`, `f_1`, `f_2_coma_5`, `f_2`, `f_3`, `f_5`, `f_10`, `f_25`, `f_50`, `f_100`, `f_250`, `f_500`, `f_1000`, `f_rti_au_sell`, `f_rti_ag_sell`) VALUES
(1, 823624, 556835, 12310, 508000, 956000, 921333, 928000, 921333, 917800, 909000, 902500, 900100, 898900, 897350, 889750, 858600, 823624, 12310);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_formulas`
--

CREATE TABLE IF NOT EXISTS `tb_formulas` (
  `f_id` int(11) NOT NULL,
  `f_name` varchar(15) NOT NULL,
  `a` double NOT NULL,
  `b` double NOT NULL,
  `c` double NOT NULL,
  `d` double NOT NULL,
  `e` double NOT NULL,
  `f` double NOT NULL,
  `g` double DEFAULT NULL,
  `h` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_formulas`
--

INSERT INTO `tb_formulas` (`f_id`, `f_name`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`) VALUES
(1, 'rti-au', 30000, 11.5, 11.5, 40000, 15000, 11.5, -10000, 20000),
(2, 'rti-pt', 27, 75, 420, 0, 0, 0, NULL, 0),
(3, 'rti-ag', -25.5, 0, 0, 0, 0, 0, NULL, 0),
(4, 'lm', 5000, 3000, 0, 0, 0, 0, NULL, 0),
(5, 'material-au', 5000, 0, 0, 0, 0, 0, 20000, 90000),
(6, 'material-ag', 0, 0, 0, 0, 0, 0, NULL, 0),
(7, 'rti-pt-low', 42, 60, 405, -15, 0, 0, NULL, 0),
(8, 'rti-ag-low', -40.5, 0, 0, 0, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_material`
--

CREATE TABLE IF NOT EXISTS `tb_material` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(15) NOT NULL,
  `m_img` varchar(15) NOT NULL,
  `m_type` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_material`
--

INSERT INTO `tb_material` (`m_id`, `m_name`, `m_img`, `m_type`) VALUES
(1, 'Diamond', 'diamond.png', 'Buy'),
(2, 'Gold', 'gold.png', 'Buy'),
(3, 'LM Baru', 'lm-baru.png', 'Buy'),
(4, 'LM Lama', 'lm-lama.png', 'Buy'),
(5, 'Silver', 'gold.png', 'Buy'),
(6, 'Platinum', 'gold.png', 'Buy'),
(7, 'Paladium', 'gold.png', 'Buy'),
(8, 'Iridium', 'diamond.png', 'Buy'),
(9, 'Rhodium', 'diamond.png', 'Buy'),
(10, 'Cust. Profesion', 'diamond.png', 'Buy'),
(13, 'LM Baru', 'lm-baru.png', 'Sell'),
(14, 'LM Lama', 'lm-lama.png', 'Sell'),
(15, 'Material Au', 'material-au.png', 'Sell'),
(16, 'Material Ag', 'material-ag.png', 'Sell'),
(17, 'UBS', 'lm-baru.png', 'Buy'),
(18, 'UBS', 'lm-baru.png', 'Sell');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_material_type`
--

CREATE TABLE IF NOT EXISTS `tb_material_type` (
  `mt_id` int(11) NOT NULL,
  `mt_name` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_material_type`
--

INSERT INTO `tb_material_type` (`mt_id`, `mt_name`) VALUES
(1, 'BRACELET'),
(2, 'RING'),
(3, 'NECKLACE'),
(4, 'PENDANT'),
(5, 'EARRINGS'),
(6, 'JEWELLERY'),
(7, 'BROOCH'),
(8, 'INDUSTRY'),
(9, 'BAR'),
(10, 'COIN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_memo`
--

CREATE TABLE IF NOT EXISTS `tb_memo` (
  `tm_id` int(11) NOT NULL,
  `tm_value` longtext NOT NULL,
  `tm_priority` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_memo`
--

INSERT INTO `tb_memo` (`tm_id`, `tm_value`, `tm_priority`) VALUES
(2, '<span style="font-size: 15px">1. Barang yang sudah dibeli/dijual merupakan barang yang sudah\r\nmendapatkan persetujuan untuk dilakukan transaksi dan tidak dapat dikembalikan.</span>', 1),
(3, '<span style="font-size: 15px;">2. Bahwa dengan ini customer menyatakan barang yang diserahkan\r\nuntuk dijual/dibeli merupakan milik customer dan /atau kepemilikan sebagaimana\r\npasal 1977 KUHPerdata, dan /atau milik pemberian kuasa atas barang yang\r\ndijual/dibeli kepada customer, dan dengan ini menyatakan menjamin (perhiasan /\r\nlogam mulia) tersebut bukan berasal dari hasil kejahatan, bukan barang hasil\r\ncurian, penipuan, tidak dalam sengketa dan /atau sita jaminan.</span>', 2),
(4, '<div style="text-align: justify;"><span style="font-size: 15px;">3. Tidak menerima penjualan/pembelian untuk anak dibawah umur 18\r\ntahun, kecuali dengan disertai surat lengap dan /atau disertai dengan\r\npersetujuan orang tua / wali secara tertulis.</span></div>', 3),
(5, '<div style="text-align: justify;"><span style="font-size: 15px;">4. Jika kemudian hari, ternyata barang (perhiasan / logam mulia)\r\ntersebut diketahui didapat dari hasil curian, penipuan, penggelapan dan lain -\r\nlain. maka atas hal tersebut sepenuhnya menjadi tanggung jawab customer secara\r\nhukum pidana atau perdata.</span></div>', 4),
(6, '<span style="font-size: 15px;">5. Customer telah membaca, memahami dan menyetujui terkait\r\nketentuan - ketentuan yang sudah ditetapkan.</span>', 5),
(7, '<div style="text-align: justify;"><span style="font-size: 15px;">6. Customer telah membaca, memahami dan menyetujui terkait\r\nketentuan - ketentuan yang sudah ditetapkan.</span></div>', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_month`
--

CREATE TABLE IF NOT EXISTS `tb_month` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_month`
--

INSERT INTO `tb_month` (`m_id`, `m_name`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_note`
--

CREATE TABLE IF NOT EXISTS `tb_note` (
  `tn_id` int(11) NOT NULL,
  `tn_value` longtext NOT NULL,
  `tn_priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaction`
--

CREATE TABLE IF NOT EXISTS `tb_transaction` (
  `t_id` int(11) NOT NULL,
  `t_no_order` varchar(225) NOT NULL,
  `t_date_created` datetime NOT NULL,
  `t_status` varchar(15) NOT NULL,
  `t_created_at` varchar(225) NOT NULL,
  `t_created_by` int(11) NOT NULL,
  `t_customer` varchar(225) DEFAULT NULL,
  `t_phone` varchar(15) NOT NULL,
  `t_note` text NOT NULL,
  `t_type` varchar(5) NOT NULL,
  `t_paid_by` varchar(225) NOT NULL,
  `t_receive_by` varchar(225) NOT NULL,
  `t_price_total` double NOT NULL,
  `t_visible` varchar(5) NOT NULL,
  `t_qtt` int(11) NOT NULL,
  `t_price_admin` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaction`
--

INSERT INTO `tb_transaction` (`t_id`, `t_no_order`, `t_date_created`, `t_status`, `t_created_at`, `t_created_by`, `t_customer`, `t_phone`, `t_note`, `t_type`, `t_paid_by`, `t_receive_by`, `t_price_total`, `t_visible`, `t_qtt`, `t_price_admin`) VALUES
(1, 'PB-2008-1', '2020-08-07 09:52:34', 'PENDING', '09:52:34', 1, '2919', '081519420323', '', 'BUY', 'RIZQI FARIS RAKHA', '1', 1179116, '1', 2, 0),
(2, 'PB-2008-2', '2020-08-07 11:23:28', 'PENDING', '11:23:28', 1, '1893', '081316283957', '', 'BUY', 'ZAHARA TIAR ANGGRAINI ', '1', 52320498.3, '1', 15, 0),
(3, 'PB-2008-3', '2020-08-07 11:27:02', 'PENDING', '11:27:02', 1, '2301', '081382630330', '', 'BUY', 'ZAINUL HAYAT S.HI', '1', 2353042, '1', 3, 0),
(4, 'PB-2008-4', '2020-08-07 11:28:06', 'PENDING', '11:28:06', 1, '2233', '081366667123', '', 'BUY', 'AAN MISPASMAJA', '1', 0, '1', 0, 0),
(5, 'PB-2008-5', '2020-08-07 11:28:14', 'PENDING', '11:28:14', 1, '7', '081219369199', '', 'BUY', 'SUWANDI', '1', 0, '1', 0, 0),
(6, 'PB-2008-6', '2020-08-07 11:28:53', 'PENDING', '11:28:53', 1, '7', '081219369199', '', 'BUY', 'SUWANDI', '1', 3579684, '1', 2, 0),
(7, 'PB-2008-7', '2020-08-07 11:33:08', 'PENDING', '11:33:08', 1, '562', '08788499178', '', 'BUY', 'ZULKARNAIN MEINARDY', '1', 10390434.4, '1', 6, 0),
(8, 'PB-2008-8', '2020-08-07 11:56:15', 'PENDING', '11:56:15', 1, '2301', '081382630330', '', 'BUY', 'ZAINUL HAYAT S.HI', '1', 0, '1', 0, 0),
(9, 'PB-2012-9', '2020-12-25 19:56:11', 'PENDING', '19:56:11', 1, '606', '081288431340', '', 'BUY', 'ZAINAL ABIDIN ', '1', 29508201.04, '1', 6, 0),
(10, 'PB-2012-10', '2020-12-25 19:56:47', 'PENDING', '19:56:47', 1, '1769', '087880100101', '', 'BUY', 'LAURA HERRY KEEGAN', '1', 27462952, '1', 6, 0),
(11, 'PB-2012-11', '2020-12-25 20:58:37', 'PENDING', '20:58:37', 1, '3042', '1234', '', 'BUY', 'ABCD', '1', 131761434.375, '1', 17, 0),
(12, 'PB-2012-12', '2020-12-26 15:36:25', 'PENDING', '15:36:25', 1, '3042', '1234', '', 'BUY', 'ABCD', '1', 8261250, '1', 1, 0),
(13, 'PB-2101-1', '2021-01-25 16:06:51', 'PENDING', '16:06:51', 1, '635', '087884158643', '', 'BUY', 'TRI JEFFREY IRFAN', '1', 826125, '1', 1, 0),
(14, 'PB-2101-2', '2021-01-26 11:21:21', 'PENDING', '11:21:21', 1, '3041', '082257996389', '', 'BUY', 'ERIK RIVA MAHARDIKA', '1', 863625, '1', 1, 0),
(15, 'PB-2101-3', '2021-01-27 11:52:21', 'PENDING', '11:52:21', 1, '3044', '1234', '', 'BUY', 'ABCD', '1', 826125, '1', 1, 0),
(16, 'PB-2101-4', '2021-01-27 11:53:57', 'PENDING', '11:53:57', 1, '3045', '2222', '', 'BUY', 'TEST', '1', 627618, '1', 1, 0),
(17, 'PB-2101-5', '2021-01-27 12:47:11', 'PENDING', '12:47:11', 1, '3045', '2222', '', 'BUY', 'TEST', '1', 826125, '1', 1, 0),
(18, 'PB-2101-6', '2021-01-27 13:14:09', 'PENDING', '13:14:09', 1, '3045', '2222', '', 'BUY', 'TEST', '1', 9197375, '1', 1, 0),
(19, 'PB-2101-7', '2021-01-27 14:01:33', 'PENDING', '14:01:33', 1, '99', '081321330073', '', 'BUY', 'ZAKI RAHMAN', '1', 826125, '1', 1, 0),
(20, 'PB-2101-8', '2021-01-27 14:20:58', 'PENDING', '14:20:58', 1, '3044', '1234', '', 'BUY', 'ABCD', '1', 826125, '1', 1, 0),
(21, 'PB-2101-9', '2021-01-27 14:27:32', 'PENDING', '14:27:32', 1, '2703', '085743722214', '', 'BUY', 'PIPIT DWI RAHAYU', '1', 1305220, '1', 2, 0),
(22, 'PB-2101-10', '2021-01-28 09:24:42', 'PENDING', '09:24:42', 1, '897', '081285795610', '', 'BUY', 'ZURVANITA', '1', 813781, '1', 1, 0),
(23, 'PB-2101-11', '2021-01-28 09:57:12', 'PENDING', '09:57:12', 1, '897', '081285795610', '', 'BUY', 'ZURVANITA', '1', 813781, '1', 1, 0),
(24, 'PB-2101-12', '2021-01-28 10:00:43', 'PENDING', '10:00:43', 1, '565', '08979009509', '', 'BUY', 'RIO WAHYU ISMAIL', '1', 813781, '1', 1, 0),
(25, 'PB-2102-13', '2021-02-02 14:10:13', 'PENDING', '14:10:13', 1, '897', '081285795610', '', 'BUY', 'ZURVANITA', '1', 110000000, '1', 1, 0),
(26, 'PB-2102-14', '2021-02-02 14:16:41', 'PENDING', '14:16:41', 1, '897', '081285795610', '', 'BUY', 'ZURVANITA', '1', 100000000, '1', 1, 0),
(27, 'PB-2102-15', '2021-02-02 19:14:53', 'PENDING', '19:14:53', 1, '2616', '08995578568', '', 'BUY', 'ZUHRO YANI', '1', 100000000, '1', 1, 0),
(28, 'PB-2102-16', '2021-02-02 19:15:08', 'PENDING', '19:15:08', 1, '7', '081219369199', '', 'BUY', 'SUWANDI', '1', 0, '1', 0, 0),
(29, 'PB-2102-17', '2021-02-03 17:06:17', 'PENDING', '17:06:17', 1, '897', '081285795610', '', 'BUY', 'ZURVANITA', '1', 118568235.9237, '1', 10, 10000),
(30, 'PB-2102-18', '2021-02-11 13:13:40', 'PENDING', '13:13:40', 1, '2966', '0813175888080', '', 'BUY', 'ZAHIR SALSABILLA', '1', 3636363, '1', 7, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaction_items`
--

CREATE TABLE IF NOT EXISTS `tb_transaction_items` (
  `ti_id` int(11) NOT NULL,
  `ti_t_id` int(11) DEFAULT NULL,
  `ti_material` varchar(15) DEFAULT NULL,
  `ti_material_type` varchar(15) DEFAULT NULL,
  `ti_carat` varchar(55) DEFAULT NULL,
  `ti_weight` varchar(55) DEFAULT NULL,
  `ti_price` varchar(55) DEFAULT NULL,
  `ti_price_total` varchar(55) DEFAULT NULL,
  `ti_date_created` datetime NOT NULL,
  `ti_high_low` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaction_items`
--

INSERT INTO `tb_transaction_items` (`ti_id`, `ti_t_id`, `ti_material`, `ti_material_type`, `ti_carat`, `ti_weight`, `ti_price`, `ti_price_total`, `ti_date_created`, `ti_high_low`) VALUES
(1, 1, 'Gold', 'BRACELET', '24(99.9)', '1', '589558', '589558', '2020-08-07 09:52:34', ''),
(2, 1, 'Gold', 'BRACELET', '24(99)', '1', '589558', '589558', '2020-08-07 09:52:34', ''),
(3, 2, 'Gold', 'BRACELET', '24(99.9)', '5.3', '894921', '4743081', '2020-08-07 11:23:28', ''),
(4, 2, 'Gold', 'BRACELET', '24(99)', '7.5', '854921', '6411908', '2020-08-07 11:23:28', ''),
(5, 2, 'UBS', '-', '', '5', '919921', '4599605', '2020-08-07 11:23:28', ''),
(6, 2, 'Silver', 'BRACELET', 'Ag 78.9 %', '5.5', '6467', '35569', '2020-08-07 11:23:28', 'high'),
(7, 2, 'Silver', 'BRACELET', 'Ag 33.3 %', '1.5', '2064', '3096', '2020-08-07 11:23:28', 'low'),
(8, 2, 'Platinum', 'BRACELET', 'Pt 78.9 %', '5.3', '284836', '1509630', '2020-08-07 11:23:28', 'high'),
(9, 2, 'Platinum', 'BRACELET', 'Pt 33.3 %', '6.5', '97675', '634887', '2020-08-07 11:23:28', 'low'),
(10, 2, 'Paladium', 'BRACELET', 'Pd 78.9 %', '5.5', '640881', '3524845', '2020-08-07 11:23:28', 'high'),
(11, 2, 'Paladium', 'BRACELET', 'Pd 33.3 %', '7.5', '247945', '1859587', '2020-08-07 11:23:28', 'low'),
(12, 2, 'Paladium', 'BRACELET', 'Pd 33.3 %', '6.5', '247945', '1611642', '2020-08-07 11:23:28', 'low'),
(13, 2, 'Iridium', 'BRACELET', 'Ir 78.9 %', '6.9', '170902', '1179223.8', '2020-08-07 11:23:28', 'high'),
(14, 2, 'Iridium', 'BRACELET', 'Ir 33.3 %', '8.1', '54097', '438185.7', '2020-08-07 11:23:28', 'low'),
(15, 2, 'Rhodium', 'BRACELET', 'Rh 78.9 %', '10.2', '712091', '7263328', '2020-08-07 11:23:28', 'high'),
(16, 2, 'Rhodium', 'BRACELET', 'Rh 29.3 %', '9.8', '244606', '2397138', '2020-08-07 11:23:28', 'low'),
(17, 2, 'Cust. Profesion', 'BRACELET', 'Au 98.9 %', '20.2', '797464', '16108772.8', '2020-08-07 11:23:28', ''),
(18, 3, 'Gold', 'BRACELET', '24(99.9)', '1', '901742', '901742', '2020-08-07 11:27:02', ''),
(19, 3, 'Gold', 'BRACELET', '24(99)', '1', '861742', '861742', '2020-08-07 11:27:02', ''),
(20, 3, 'Cust. Profesion', 'BRACELET', 'Au 72.6 %', '1', '589558', '589558', '2020-08-07 11:27:02', ''),
(21, 6, 'Gold', 'BRACELET', '24(99.9)', '2', '894921', '1789842', '2020-08-07 11:28:53', ''),
(22, 6, 'Gold', 'BRACELET', '24(99.9)', '2', '894921', '1789842', '2020-08-07 11:28:53', ''),
(23, 7, 'Gold', 'BRACELET', '24(99.9)', '0.8', '894921', '715937', '2020-08-07 11:33:08', ''),
(24, 7, 'Gold', 'BRACELET', '24(99)', '3.5', '854921', '2992224', '2020-08-07 11:33:08', ''),
(25, 7, 'UBS', '-', '', '4', '919921', '3679684', '2020-08-07 11:33:08', ''),
(26, 7, 'Iridium', 'BRACELET', 'Ir 89.9 %', '7.3', '194728', '1421514.4', '2020-08-07 11:33:08', 'high'),
(27, 7, 'Iridium', 'BRACELET', 'Ir 33.3 %', '2', '72130', '144260', '2020-08-07 11:33:08', 'high'),
(28, 7, 'Platinum', 'BRACELET', 'Pt 79.6 %', '5', '287363', '1436815', '2020-08-07 11:33:08', 'high'),
(29, 9, 'UBS', '-', '', '1', '828044', '828044', '2020-12-25 19:56:11', ''),
(30, 9, 'UBS', '-', '', '10', '828044', '8280440', '2020-12-25 19:56:11', ''),
(31, 9, 'UBS', '-', '', '8.16', '828044', '6756839.04', '2020-12-25 19:56:11', ''),
(32, 9, 'LM Baru', '-', '24', '1', '813044', '813044', '2020-12-25 19:56:11', ''),
(33, 9, 'LM Baru', '-', '24', '10', '813044', '8130440', '2020-12-25 19:56:11', ''),
(34, 9, 'LM Baru', '-', '24', '5.78', '813044', '4699394', '2020-12-25 19:56:11', ''),
(35, 10, 'LM Baru', '-', '24', '1', '813044', '813044', '2020-12-25 19:56:47', ''),
(36, 10, 'LM Baru', '-', '24', '10', '813044', '8130440', '2020-12-25 19:56:47', ''),
(37, 10, 'LM Lama', '-', '24', '1', '855544', '855544', '2020-12-25 19:56:47', ''),
(38, 10, 'LM Lama', '-', '24', '10', '855544', '8555440', '2020-12-25 19:56:47', ''),
(39, 10, 'UBS', '-', '', '1', '828044', '828044', '2020-12-25 19:56:47', ''),
(40, 10, 'UBS', '-', '', '10', '828044', '8280440', '2020-12-25 19:56:47', ''),
(41, 11, 'LM Baru', '-', '24', '10', '896125', '8961250', '2020-12-25 20:58:37', ''),
(42, 11, 'LM Lama', '-', '24', '10', '863625', '8636250', '2020-12-25 20:58:37', ''),
(43, 11, 'UBS', '-', '', '10', '836125', '8361250', '2020-12-25 20:58:37', ''),
(44, 11, 'Gold', 'BRACELET', '24(99.9)', '10', '826125', '8261250', '2020-12-25 20:58:37', ''),
(45, 11, 'Gold', 'BRACELET', '24(99)', '10', '816125', '8161250', '2020-12-25 20:58:37', ''),
(46, 11, 'Gold', 'BRACELET', '18', '10', '565083', '5650830', '2020-12-25 20:58:37', ''),
(47, 11, 'Silver', 'BRACELET', 'Ag 100 %', '10', '8371', '83710', '2020-12-25 20:58:37', 'high'),
(48, 11, 'Silver', 'BRACELET', 'Ag 100 %', '10', '6602', '66020', '2020-12-25 20:58:37', 'low'),
(49, 11, 'Platinum', 'BRACELET', 'Pt 100 %', '10', '358610', '3586100', '2020-12-25 20:58:37', 'high'),
(50, 11, 'Platinum', 'BRACELET', 'Pt 100 %', '10', '288294', '2882940', '2020-12-25 20:58:37', 'low'),
(51, 11, 'Paladium', 'BRACELET', 'Pd 100 %', '10', '909416', '9094160', '2020-12-25 20:58:37', 'high'),
(52, 11, 'Paladium', 'BRACELET', 'Pd 100 %', '10', '839100', '8391000', '2020-12-25 20:58:37', 'low'),
(53, 11, 'Iridium', 'BRACELET', 'Ir 100 %', '10', '322748', '3227480', '2020-12-25 20:58:37', 'high'),
(54, 11, 'Iridium', 'BRACELET', 'Ir 100 %', '10', '268957', '2689570', '2020-12-25 20:58:37', 'low'),
(55, 11, 'Rhodium', 'BRACELET', 'Rh 100 %', '10', '2343855', '23438550', '2020-12-25 20:58:37', 'high'),
(56, 11, 'Rhodium', 'BRACELET', 'Rh 100 %', '10', '2273539', '22735390', '2020-12-25 20:58:37', 'low'),
(57, 11, 'Cust. Profesion', 'BRACELET', 'Au 100 %', '10', '753443.4375', '7534434.375', '2020-12-25 20:58:37', ''),
(58, 12, 'Gold', 'BRACELET', '24(99.9)', '10', '826125', '8261250', '2020-12-26 15:36:25', ''),
(59, 13, 'Gold', 'BRACELET', '24(99.9)', '1', '826125', '826125', '2021-01-25 16:06:51', ''),
(60, 14, 'LM Lama', '-', '24', '1', '863625', '863625', '2021-01-26 11:21:21', ''),
(61, 15, 'Gold', 'BRACELET', '24(99.9)', '1', '826125', '826125', '2021-01-27 11:52:21', ''),
(62, 16, 'Gold', 'BRACELET', '20', '1', '627618', '627618', '2021-01-27 11:53:57', ''),
(63, 17, 'Gold', 'BRACELET', '24(99.9)', '1', '826125', '826125', '2021-01-27 12:47:11', ''),
(64, 18, 'UBS', '-', '', '11', '836125', '9197375', '2021-01-27 13:14:09', ''),
(65, 19, 'Gold', 'BRACELET', '24(99.9)', '1', '826125', '826125', '2021-01-27 14:01:33', ''),
(66, 20, 'Gold', 'BRACELET', '24(99.9)', '1', '826125', '826125', '2021-01-27 14:20:58', ''),
(67, 21, 'Gold', 'BRACELET', '24(99.9)', '1', '813781', '813781', '2021-01-27 14:27:32', ''),
(68, 21, 'Gold', 'BRACELET', '16', '1', '491439', '491439', '2021-01-27 14:27:32', ''),
(69, 22, 'Gold', 'BRACELET', '24(99.9)', '1', '813781', '813781', '2021-01-28 09:24:42', ''),
(70, 23, 'Gold', 'BRACELET', '24(99.9)', '1', '813781', '813781', '2021-01-28 09:57:12', ''),
(71, 24, 'Gold', 'BRACELET', '24(99.9)', '1', '813781', '813781', '2021-01-28 10:00:43', ''),
(72, 25, 'Diamond', '-', '-', '-', '110000000', '110000000', '2021-02-02 14:10:13', ''),
(73, 26, 'Diamond', '-', '-', '-', '100000000', '100000000', '2021-02-02 14:16:41', ''),
(74, 27, 'Diamond', '-', '-', '-', '100000000', '100000000', '2021-02-02 19:14:53', ''),
(75, 29, 'Diamond', '-', '-', '-', '100000000', '100000000', '2021-02-03 17:06:17', ''),
(76, 29, 'Gold', 'BRACELET', '24(99.9)', '1', '813781', '813781', '2021-02-03 17:06:17', ''),
(77, 29, 'LM Baru', '-', '24', '11', '873781', '9611591', '2021-02-03 17:06:17', ''),
(78, 29, 'Silver', 'BRACELET', 'Ag 1 %', '1', '85', '85', '2021-02-03 17:06:17', 'high'),
(79, 29, 'Cust. Profesion', 'BRACELET', 'Au 1 %', '2', '7378.96185', '14757.9237', '2021-02-03 17:06:17', ''),
(80, 29, 'Rhodium', 'BRACELET', 'Rh 11 %', '1', '270934', '270934', '2021-02-03 17:06:17', 'high'),
(81, 29, 'Rhodium', 'RING', 'Rh 1 %', '1', '24630', '24630', '2021-02-03 17:06:17', 'high'),
(82, 29, 'Rhodium', 'BRACELET', 'Rh 1 %', '1', '24630', '24630', '2021-02-03 17:06:17', 'high'),
(83, 29, 'Rhodium', 'BAR', 'Rh 13 %', '1', '320195', '320195', '2021-02-03 17:06:17', 'high'),
(84, 29, 'Rhodium', 'BAR', 'Rh 19 %', '16', '467977', '7487632', '2021-02-03 17:06:17', 'high'),
(85, 30, 'Iridium', 'BRACELET', 'Ir 100 %', '1', '556835', '556835', '2021-02-11 13:13:40', 'high'),
(86, 30, 'Iridium', 'BRACELET', 'Ir 100 %', '1', '473310', '473310', '2021-02-11 13:13:40', 'low'),
(87, 30, 'Iridium', 'BRACELET', 'Ir 60.8 %', '1', '287772', '287772', '2021-02-11 13:13:40', 'low'),
(88, 30, 'Iridium', 'BRACELET', 'Ir 90 %', '1', '501152', '501152', '2021-02-11 13:13:40', 'high'),
(89, 30, 'Gold', 'BRACELET', '24(99.9)', '1', '803624', '803624', '2021-02-11 13:13:40', ''),
(90, 30, 'Gold', 'BRACELET', '20', '1', '607180', '607180', '2021-02-11 13:13:40', ''),
(91, 30, 'Platinum', 'BRACELET', 'Pt 100 %', '1', '406490', '406490', '2021-02-11 13:13:40', 'high');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaction_items_sell`
--

CREATE TABLE IF NOT EXISTS `tb_transaction_items_sell` (
  `ti_id` int(11) NOT NULL,
  `ti_t_id` int(11) DEFAULT NULL,
  `ti_material` varchar(15) DEFAULT NULL,
  `ti_material_type` varchar(15) DEFAULT NULL,
  `ti_carat` varchar(55) DEFAULT NULL,
  `ti_weight` varchar(55) DEFAULT NULL,
  `ti_price` varchar(55) DEFAULT NULL,
  `ti_price_total` varchar(55) DEFAULT NULL,
  `ti_date_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaction_items_sell`
--

INSERT INTO `tb_transaction_items_sell` (`ti_id`, `ti_t_id`, `ti_material`, `ti_material_type`, `ti_carat`, `ti_weight`, `ti_price`, `ti_price_total`, `ti_date_created`) VALUES
(1, 1, 'LM Baru', '-', '24', '1', '953000', '953000', '2020-12-25 20:00:41'),
(2, 2, 'LM Baru', '-', '24', '1', '953000', '953000', '2021-01-27 13:10:35'),
(3, 3, 'LM Baru', '-', '24', '1', '953000', '953000', '2021-02-03 16:59:49'),
(4, 4, 'LM Baru', '-', '24', '11', '-2999', '-32989', '2021-02-03 17:09:46'),
(5, 4, 'LM Lama', '-', '24', '1', '951000', '951000', '2021-02-03 17:09:46'),
(6, 4, 'Material Au', '-', '24', '1', '833781', '833781', '2021-02-03 17:09:46'),
(7, 4, 'Material Au', '-', '24', '11', '833781', '9171591', '2021-02-03 17:09:46'),
(8, 4, 'UBS', '-', '', '1', '853781', '853781', '2021-02-03 17:09:46'),
(9, 4, 'LM Lama', '-', '24', '1', '951000', '951000', '2021-02-03 17:09:46'),
(10, 4, 'LM Lama', '-', '24', '1', '951000', '951000', '2021-02-03 17:09:46'),
(11, 4, 'LM Lama', '-', '24', '1', '951000', '951000', '2021-02-03 17:09:46'),
(12, 4, 'LM Lama', '-', '24', '1', '951000', '951000', '2021-02-03 17:09:46'),
(13, 4, 'LM Lama', '-', '24', '1', '951000', '951000', '2021-02-03 17:09:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaction_sell`
--

CREATE TABLE IF NOT EXISTS `tb_transaction_sell` (
  `t_id` int(11) NOT NULL,
  `t_no_order` varchar(225) NOT NULL,
  `t_date_created` datetime NOT NULL,
  `t_status` varchar(15) NOT NULL,
  `t_created_at` varchar(225) NOT NULL,
  `t_created_by` int(11) NOT NULL,
  `t_customer` varchar(225) DEFAULT NULL,
  `t_phone` varchar(15) DEFAULT NULL,
  `t_note` text NOT NULL,
  `t_type` varchar(5) NOT NULL,
  `t_paid_by` varchar(225) DEFAULT NULL,
  `t_receive_by` varchar(225) NOT NULL,
  `t_price_total` double NOT NULL,
  `t_visible` varchar(5) NOT NULL,
  `t_qtt` int(11) NOT NULL,
  `t_price_admin` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaction_sell`
--

INSERT INTO `tb_transaction_sell` (`t_id`, `t_no_order`, `t_date_created`, `t_status`, `t_created_at`, `t_created_by`, `t_customer`, `t_phone`, `t_note`, `t_type`, `t_paid_by`, `t_receive_by`, `t_price_total`, `t_visible`, `t_qtt`, `t_price_admin`) VALUES
(1, 'PJ-2012-1', '2020-12-25 20:00:41', 'PENDING', '20:00:41', 1, '2396', '083811693829', '', 'BUY', 'KWA SIOK BWEE', '1', 953000, '1', 1, 0),
(2, 'PJ-2101-1', '2021-01-27 13:10:35', 'PENDING', '13:10:35', 1, '3045', '2222', '', 'BUY', 'TEST', '1', 953000, '1', 1, 0),
(3, 'PJ-2102-2', '2021-02-03 16:59:49', 'PENDING', '16:59:49', 1, '2960', '0811849645', '', 'BUY', 'WIDYASARI RETNO PERTIWI', '1', 953000, '1', 1, 0),
(4, 'PJ-2102-3', '2021-02-03 17:09:46', 'PENDING', '17:09:46', 1, '897', '081285795610', '', 'BUY', 'ZURVANITA', '1', 16532164, '1', 10, 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(225) NOT NULL,
  `u_username` varchar(225) NOT NULL,
  `u_password` varchar(225) NOT NULL,
  `u_img` varchar(15) NOT NULL,
  `u_rule` varchar(15) NOT NULL,
  `u_token` varchar(225) NOT NULL,
  `u_date_created` datetime NOT NULL,
  `u_date_updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`u_id`, `u_name`, `u_username`, `u_password`, `u_img`, `u_rule`, `u_token`, `u_date_created`, `u_date_updated`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'cashier.png', 'Kasir', 'c4ca4238a0b923820dcc509a6f75849b', '2019-04-02 00:00:00', '2019-04-02 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_year`
--

CREATE TABLE IF NOT EXISTS `tb_year` (
  `y_id` int(11) NOT NULL,
  `y_name` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_year`
--

INSERT INTO `tb_year` (`y_id`, `y_name`) VALUES
(1, 2019),
(2, 2020),
(3, 2021);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_carat`
--
ALTER TABLE `tb_carat`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tb_formula`
--
ALTER TABLE `tb_formula`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `tb_formulas`
--
ALTER TABLE `tb_formulas`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `tb_material`
--
ALTER TABLE `tb_material`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tb_material_type`
--
ALTER TABLE `tb_material_type`
  ADD PRIMARY KEY (`mt_id`);

--
-- Indexes for table `tb_memo`
--
ALTER TABLE `tb_memo`
  ADD PRIMARY KEY (`tm_id`);

--
-- Indexes for table `tb_month`
--
ALTER TABLE `tb_month`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tb_note`
--
ALTER TABLE `tb_note`
  ADD PRIMARY KEY (`tn_id`);

--
-- Indexes for table `tb_transaction`
--
ALTER TABLE `tb_transaction`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tb_transaction_items`
--
ALTER TABLE `tb_transaction_items`
  ADD PRIMARY KEY (`ti_id`);

--
-- Indexes for table `tb_transaction_items_sell`
--
ALTER TABLE `tb_transaction_items_sell`
  ADD PRIMARY KEY (`ti_id`);

--
-- Indexes for table `tb_transaction_sell`
--
ALTER TABLE `tb_transaction_sell`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `tb_year`
--
ALTER TABLE `tb_year`
  ADD PRIMARY KEY (`y_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_carat`
--
ALTER TABLE `tb_carat`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tb_formula`
--
ALTER TABLE `tb_formula`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_formulas`
--
ALTER TABLE `tb_formulas`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_material`
--
ALTER TABLE `tb_material`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tb_material_type`
--
ALTER TABLE `tb_material_type`
  MODIFY `mt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_memo`
--
ALTER TABLE `tb_memo`
  MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_month`
--
ALTER TABLE `tb_month`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tb_note`
--
ALTER TABLE `tb_note`
  MODIFY `tn_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_transaction`
--
ALTER TABLE `tb_transaction`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tb_transaction_items`
--
ALTER TABLE `tb_transaction_items`
  MODIFY `ti_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `tb_transaction_items_sell`
--
ALTER TABLE `tb_transaction_items_sell`
  MODIFY `ti_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tb_transaction_sell`
--
ALTER TABLE `tb_transaction_sell`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_year`
--
ALTER TABLE `tb_year`
  MODIFY `y_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
