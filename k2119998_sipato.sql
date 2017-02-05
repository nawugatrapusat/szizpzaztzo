-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 05, 2017 at 03:55 AM
-- Server version: 5.5.54-cll
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `k2119998_sipato`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `pass` varbinary(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `pass`) VALUES
(1, 'joseph', '4e67272996df22fc9c034f7d3211dc8d');

-- --------------------------------------------------------

--
-- Table structure for table `ambiluang`
--

CREATE TABLE IF NOT EXISTS `ambiluang` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `idPenjualan` varchar(200) DEFAULT NULL,
  `idEmployeePic` varchar(20) DEFAULT NULL,
  `d` int(2) DEFAULT NULL,
  `m` int(2) DEFAULT NULL,
  `y` int(5) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `keterangan` varchar(400) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `namaBank` varchar(100) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `namaBank`, `id_admin`, `deleted`) VALUES
(1, 'mandiri', 1, 0),
(2, 'bca', 1, 0),
(3, 'cimb niaga', 1, 0),
(4, 'bni 46', 1, 0),
(5, 'bii', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(400) DEFAULT NULL,
  `noTelp` varchar(50) DEFAULT NULL,
  `noHp` varchar(50) DEFAULT NULL,
  `picPembelian` varchar(100) DEFAULT NULL,
  `picTagihan` varchar(100) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `nama`, `alamat`, `noTelp`, `noHp`, `picPembelian`, `picTagihan`, `id_admin`, `deleted`) VALUES
(1, 'apotik roxy', 'jln.hasyim ashari 48 a , jakarta', '021-6339339', '', 'bu liliana', '', 1, 0),
(2, 'all fresh swalayan', 'jln. jendral gatot subroto 185  jakarta', '02183700945', '', 'mardiana', '', 1, 0),
(3, 'kopebi', 'jln. keb0nsirih 82 - 84 jakarta', '', '', '', '', 1, 0),
(4, 'total buah segar menteng', 'jln. sunda gdg bakmi gm lantai 1 jakarta', '021-3152011', '', '', '', 1, 0),
(5, 'total buah segar depo', 'jln. margonda raya   , depok', '021-77219894', '082817075989', '', '', 1, 0),
(6, 'total buaah segar jalan baru bogor', 'jln. kh. sholeh iskandar bogor', '0251-8355959', '082817093450', '', '', 1, 0),
(7, 'total buah segar pajajaran bogor', 'jln. raya pajajaran bogor', '0251-8378511', '', '', '', 1, 0),
(8, 'ada swalayan bogor', 'jln. raya pajajaran, bogor', '', '', '', '', 1, 0),
(9, 'total buah segar bekasi', 'jln.kh.noer ali kalimalang bekasi', '021-28519898', '', '', '', 1, 0),
(10, 'total buah segar rc.veteran', 'jln.rc.veteran rempoa, tangsel', '021-22733898', '', '', '', 1, 0),
(11, 'total buah segar debon', 'jln. wolter mongonsidi jaksel', '021-72801801', '085772042646', '', '', 1, 0),
(12, 'santa swalayan', 'jln.w.mongonsidi jakarta', '', '', '', '', 1, 0),
(13, 'rumah buah swalayan', 'gudang t8 alam sutra ', '', '', 'bu narti', '', 1, 0),
(14, 'toserba gading', 'ruko gading serpong', '021-5467138', '', '', '', 1, 0),
(15, 'apotik melawai', 'jln. sambas , jakarta', '', '0818717554', 'bu lilik', '', 1, 0),
(16, 'apotik rini', 'jln.balai pustaka timur, rawamangun , jakarta', '021-4702128', '', 'bu peni', '', 1, 0),
(17, 'apotik titi murni', 'jln.kramat raya, jakarta pusat', '021-3912735', '', 'bu ani', '', 1, 0),
(18, 'pujasari swalayan', 'jln. raya sawangan bojongsari depok', '', '', 'bu endang', '', 1, 0),
(19, 'harmony swalayan', 'jl.ceger raya  tangsel', '', '', 'mbak ira', '', 1, 0),
(20, 'aneka buana swalayan pondok labu', 'jln. rs.fatmawati jaksel', '021-7691221', '', 'bu yu;i', '', 1, 0),
(21, 'aneka buana swalayan cirendeu', 'jln. raya cirendeu thgsel', '', '', 'bu puji', '', 1, 0),
(22, 'gelael swalayan', 'jln.mt.hryono jakarta', '021-8298390', '', 'bu siska', '', 1, 0),
(23, 'gelael swalayan lampung', 'gudang ciracas', '', '081366605830', 'pak endang', '', 1, 0),
(24, 'gelael luar kota', 'gudang pusat ciracas', '', '', '', '', 1, 0),
(25, 'apotik hidup baru', 'jln.hidup baru, jaksel', '', '', '', '', 1, 0),
(26, 'toko kemanggisan', 'jln. kemanggisan ilir jakarta barat.', '', '', '', '', 1, 0),
(27, 'apotik mahakam', 'jln. mahakam , jaksel', '', '', '', '', 1, 0),
(28, 'apotik senopati', 'jln. raya senopati jaksel', '', '', '', '', 1, 0),
(29, 'apotik pela', 'jln. janur kuning jaksel', '', '', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clientprice`
--

CREATE TABLE IF NOT EXISTS `clientprice` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idClient` int(10) DEFAULT NULL,
  `idProduct` int(10) DEFAULT NULL,
  `hargaJual` varchar(10) NOT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=146 ;

--
-- Dumping data for table `clientprice`
--

INSERT INTO `clientprice` (`id`, `idClient`, `idProduct`, `hargaJual`, `id_admin`, `deleted`) VALUES
(1, 1, 0, '', 1, 0),
(2, 1, 0, '', 1, 0),
(3, 1, 0, '', 1, 0),
(4, 1, 0, '', 1, 0),
(5, 1, 0, '', 1, 0),
(6, 2, 0, '', 1, 0),
(7, 2, 0, '', 1, 0),
(8, 2, 0, '', 1, 0),
(9, 2, 0, '', 1, 0),
(10, 2, 0, '', 1, 0),
(11, 3, 0, '', 1, 0),
(12, 3, 0, '', 1, 0),
(13, 3, 0, '', 1, 0),
(14, 3, 0, '', 1, 0),
(15, 3, 0, '', 1, 0),
(16, 4, 0, '', 1, 0),
(17, 4, 0, '', 1, 0),
(18, 4, 0, '', 1, 0),
(19, 4, 0, '', 1, 0),
(20, 4, 0, '', 1, 0),
(21, 5, 0, '', 1, 0),
(22, 5, 0, '', 1, 0),
(23, 5, 0, '', 1, 0),
(24, 5, 0, '', 1, 0),
(25, 5, 0, '', 1, 0),
(26, 6, 0, '', 1, 0),
(27, 6, 0, '', 1, 0),
(28, 6, 0, '', 1, 0),
(29, 6, 0, '', 1, 0),
(30, 6, 0, '', 1, 0),
(31, 7, 0, '', 1, 0),
(32, 7, 0, '', 1, 0),
(33, 7, 0, '', 1, 0),
(34, 7, 0, '', 1, 0),
(35, 7, 0, '', 1, 0),
(36, 8, 0, '', 1, 0),
(37, 8, 0, '', 1, 0),
(38, 8, 0, '', 1, 0),
(39, 8, 0, '', 1, 0),
(40, 8, 0, '', 1, 0),
(41, 9, 0, '', 1, 0),
(42, 9, 0, '', 1, 0),
(43, 9, 0, '', 1, 0),
(44, 9, 0, '', 1, 0),
(45, 9, 0, '', 1, 0),
(46, 10, 0, '', 1, 0),
(47, 10, 0, '', 1, 0),
(48, 10, 0, '', 1, 0),
(49, 10, 0, '', 1, 0),
(50, 10, 0, '', 1, 0),
(51, 11, 0, '', 1, 0),
(52, 11, 0, '', 1, 0),
(53, 11, 0, '', 1, 0),
(54, 11, 0, '', 1, 0),
(55, 11, 0, '', 1, 0),
(56, 12, 0, '', 1, 0),
(57, 12, 0, '', 1, 0),
(58, 12, 0, '', 1, 0),
(59, 12, 0, '', 1, 0),
(60, 12, 0, '', 1, 0),
(61, 13, 0, '', 1, 0),
(62, 13, 0, '', 1, 0),
(63, 13, 0, '', 1, 0),
(64, 13, 0, '', 1, 0),
(65, 13, 0, '', 1, 0),
(66, 14, 0, '', 1, 0),
(67, 14, 0, '', 1, 0),
(68, 14, 0, '', 1, 0),
(69, 14, 0, '', 1, 0),
(70, 14, 0, '', 1, 0),
(71, 15, 0, '', 1, 0),
(72, 15, 0, '', 1, 0),
(73, 15, 0, '', 1, 0),
(74, 15, 0, '', 1, 0),
(75, 15, 0, '', 1, 0),
(76, 16, 0, '', 1, 0),
(77, 16, 0, '', 1, 0),
(78, 16, 0, '', 1, 0),
(79, 16, 0, '', 1, 0),
(80, 16, 0, '', 1, 0),
(81, 17, 0, '', 1, 0),
(82, 17, 0, '', 1, 0),
(83, 17, 0, '', 1, 0),
(84, 17, 0, '', 1, 0),
(85, 17, 0, '', 1, 0),
(86, 18, 0, '', 1, 0),
(87, 18, 0, '', 1, 0),
(88, 18, 0, '', 1, 0),
(89, 18, 0, '', 1, 0),
(90, 18, 0, '', 1, 0),
(91, 19, 0, '', 1, 0),
(92, 19, 0, '', 1, 0),
(93, 19, 0, '', 1, 0),
(94, 19, 0, '', 1, 0),
(95, 19, 0, '', 1, 0),
(96, 20, 0, '', 1, 0),
(97, 20, 0, '', 1, 0),
(98, 20, 0, '', 1, 0),
(99, 20, 0, '', 1, 0),
(100, 20, 0, '', 1, 0),
(101, 21, 0, '', 1, 0),
(102, 21, 0, '', 1, 0),
(103, 21, 0, '', 1, 0),
(104, 21, 0, '', 1, 0),
(105, 21, 0, '', 1, 0),
(106, 22, 0, '', 1, 0),
(107, 22, 0, '', 1, 0),
(108, 22, 0, '', 1, 0),
(109, 22, 0, '', 1, 0),
(110, 22, 0, '', 1, 0),
(111, 23, 0, '', 1, 0),
(112, 23, 0, '', 1, 0),
(113, 23, 0, '', 1, 0),
(114, 23, 0, '', 1, 0),
(115, 23, 0, '', 1, 0),
(116, 24, 0, '', 1, 0),
(117, 24, 0, '', 1, 0),
(118, 24, 0, '', 1, 0),
(119, 24, 0, '', 1, 0),
(120, 24, 0, '', 1, 0),
(121, 25, 0, '', 1, 0),
(122, 25, 0, '', 1, 0),
(123, 25, 0, '', 1, 0),
(124, 25, 0, '', 1, 0),
(125, 25, 0, '', 1, 0),
(126, 26, 0, '', 1, 0),
(127, 26, 0, '', 1, 0),
(128, 26, 0, '', 1, 0),
(129, 26, 0, '', 1, 0),
(130, 26, 0, '', 1, 0),
(131, 27, 0, '', 1, 0),
(132, 27, 0, '', 1, 0),
(133, 27, 0, '', 1, 0),
(134, 27, 0, '', 1, 0),
(135, 27, 0, '', 1, 0),
(136, 28, 0, '', 1, 0),
(137, 28, 0, '', 1, 0),
(138, 28, 0, '', 1, 0),
(139, 28, 0, '', 1, 0),
(140, 28, 0, '', 1, 0),
(141, 29, 0, '', 1, 0),
(142, 29, 0, '', 1, 0),
(143, 29, 0, '', 1, 0),
(144, 29, 0, '', 1, 0),
(145, 29, 0, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `noHp` varchar(20) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `nik`, `nama`, `alamat`, `noHp`, `id_admin`, `deleted`) VALUES
(1, '2015', 'rizky ', 'ciputat', '085773368279', 1, 0),
(2, '2014', 'agus supriyadi', 'pondok aren', '087887612460', 1, 0),
(3, '2010', 'jemirun', 'pamulang elok', '085880797582', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `d` varchar(2) DEFAULT NULL,
  `m` varchar(2) DEFAULT NULL,
  `y` varchar(5) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `activity` text,
  `id_admin` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `d`, `m`, `y`, `date`, `time`, `category`, `activity`, `id_admin`) VALUES
(10, '22', '01', '2017', '1485089316', '22-01-2017 19:48:36', 'Login', 'Gagal Login, Nama : cl450106x.maintenis.com, IP 202.62.18.11 - gun', NULL),
(7, '22', '01', '2017', '1485053601', '22-01-2017 09:53:21', 'Login', 'Sukses Login, Nama : cl450106x.maintenis.com, IP 182.23.91.100 - joseph', 1),
(8, '22', '01', '2017', '1485053698', '22-01-2017 09:54:58', 'Login', 'Sukses Login, Nama : cl450106x.maintenis.com, IP 182.23.91.100 - joseph', 1),
(9, '22', '01', '2017', '1485058087', '22-01-2017 11:08:07', 'Login', 'Sukses Login, Nama : cl450106x.maintenis.com, IP 182.23.91.100 - joseph', 1),
(11, '23', '01', '2017', '1485167734', '23-01-2017 17:35:34', 'Login', 'Sukses Login, Nama : cl450106x.maintenis.com, IP 202.62.18.11 - joseph', 1),
(12, '23', '01', '2017', '1485168160', '23-01-2017 17:42:40', 'simpan setting client', '{"nama":"Apotik Roxy","alamat":"Jln.Hasyim Ashari 48 A , Jakarta","noTelp":"021-6339339","noHp":"","picPembelian":"Bu Liliana","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(13, '23', '01', '2017', '1485168528', '23-01-2017 17:48:48', 'Login', 'Sukses Login, Nama : cl450106x.maintenis.com, IP 182.23.91.100 - joseph', 1),
(14, '23', '01', '2017', '1485168939', '23-01-2017 17:55:39', 'delete setting product', '{"statusAction":"sukses"}', 1),
(15, '24', '01', '2017', '1485227921', '24-01-2017 10:18:41', 'Login', 'Sukses Login, Nama : cl450106x.maintenis.com, IP 182.23.91.100 - joseph', 1),
(16, '24', '01', '2017', '1485270983', '24-01-2017 22:16:23', 'Login', 'Sukses Login, Nama : cl450106x.maintenis.com, IP 202.62.16.27 - joseph', 1),
(17, '04', '02', '2017', '1486172781', '04-02-2017 08:46:21', 'Login', 'Sukses Login, Nama : cl450106x.maintenis.com, IP 202.62.17.40 - joseph', 1),
(18, '04', '02', '2017', '1486173164', '04-02-2017 08:52:44', 'simpan setting product', '{"merek":"Grya Herba","nama":"Teh celup Jati Belanda","berat":"40","hargaBeli":"12500","scheme":"kinerja","hargaEmployee":"","hargaJual":"17500","id":"","statusAction":"sukses"}', 1),
(19, '04', '02', '2017', '1486176096', '04-02-2017 09:41:36', 'simpan setting product', '{"merek":"grya herba","nama":"Teh celup Jati Cina","berat":"40 gram","hargaBeli":"12000","scheme":"kinerja","hargaEmployee":"","hargaJual":"17500","id":"","statusAction":"sukses"}', 1),
(20, '04', '02', '2017', '1486176529', '04-02-2017 09:48:49', 'simpan setting product', '{"merek":"Tazaka","nama":"Teh celup Binahong","berat":"40 gr","hargaBeli":"12000","scheme":"kinerja","hargaEmployee":"","hargaJual":"17500","id":"","statusAction":"sukses"}', 1),
(21, '04', '02', '2017', '1486176845', '04-02-2017 09:54:05', 'simpan setting product', '{"merek":"Griya Herba","nama":"Teh celup  sarang semut","berat":"40","hargaBeli":"15000","scheme":"kinerja","hargaEmployee":"","hargaJual":"23000","id":"","statusAction":"sukses"}', 1),
(22, '04', '02', '2017', '1486176904', '04-02-2017 09:55:04', 'edit setting product', '{"merek":"Tazaka","nama":"Teh Celup Binahong","berat":"40","hargaBeli":"12000","scheme":"kinerja","hargaEmployee":"","hargaJual":"17500","id":"4","statusAction":"sukses"}', 1),
(23, '04', '02', '2017', '1486176927', '04-02-2017 09:55:27', 'edit setting product', '{"merek":"Grya Herba","nama":"Teh Celup Jati Cina","berat":"40","hargaBeli":"12000","scheme":"kinerja","hargaEmployee":"","hargaJual":"17500","id":"3","statusAction":"sukses"}', 1),
(24, '04', '02', '2017', '1486177075', '04-02-2017 09:57:55', 'simpan setting product', '{"merek":"Tazaka","nama":"Teh celup kulit manggis","berat":"40","hargaBeli":"12000","scheme":"kinerja","hargaEmployee":"","hargaJual":"17000","id":"","statusAction":"sukses"}', 1),
(25, '04', '02', '2017', '1486177191', '04-02-2017 09:59:51', 'simpan setting product', '{"merek":"Daru Syfa","nama":"Teh celup Detox Ginjal","berat":"40","hargaBeli":"11000","scheme":"kinerja","hargaEmployee":"","hargaJual":"17500","id":"","statusAction":"sukses"}', 1),
(26, '04', '02', '2017', '1486177284', '04-02-2017 10:01:24', 'simpan setting product', '{"merek":"CV. Isma","nama":"Teh celup Diabetea Insulin","berat":"40","hargaBeli":"11000","scheme":"kinerja","hargaEmployee":"","hargaJual":"20000","id":"","statusAction":"sukses"}', 1),
(27, '04', '02', '2017', '1486177435', '04-02-2017 10:03:55', 'simpan setting product', '{"merek":"Jasmine Food International","nama":"Teh celup putih White Tea","berat":"30","hargaBeli":"30000","scheme":"kinerja","hargaEmployee":"","hargaJual":"41000","id":"","statusAction":"sukses"}', 1),
(28, '04', '02', '2017', '1486178007', '04-02-2017 10:13:27', 'simpan setting product', '{"merek":"CV.Adev Natural ","nama":"Sabun kunyit ADEV","berat":"40","hargaBeli":"6500","scheme":"kinerja","hargaEmployee":"","hargaJual":"9000","id":"","statusAction":"sukses"}', 1),
(29, '04', '02', '2017', '1486178137', '04-02-2017 10:15:37', 'simpan setting product', '{"merek":"UD. Fira ","nama":"Sarang semut super quality","berat":"120","hargaBeli":"30000","scheme":"kinerja","hargaEmployee":"","hargaJual":"43000","id":"","statusAction":"sukses"}', 1),
(30, '04', '02', '2017', '1486178232', '04-02-2017 10:17:12', 'simpan setting product', '{"merek":"Tazakka","nama":"Teh celup daun kelor","berat":"40","hargaBeli":"12000","scheme":"kinerja","hargaEmployee":"","hargaJual":"17500","id":"","statusAction":"sukses"}', 1),
(31, '04', '02', '2017', '1486178389', '04-02-2017 10:19:49', 'simpan setting product', '{"merek":"Grya Herba","nama":"Teh celup Daun Saga","berat":"40","hargaBeli":"12000","scheme":"kinerja","hargaEmployee":"","hargaJual":"17500","id":"","statusAction":"sukses"}', 1),
(32, '04', '02', '2017', '1486178617', '04-02-2017 10:23:37', 'simpan setting product', '{"merek":"Inayah Abadi utk Haifa","nama":"Jahe merah Zein toples","berat":"330","hargaBeli":"15000","scheme":"kinerja","hargaEmployee":"","hargaJual":"20000","id":"","statusAction":"sukses"}', 1),
(33, '04', '02', '2017', '1486178874', '04-02-2017 10:27:54', 'simpan setting product', '{"merek":"PT. IMS International","nama":"Inolife minyak habatusauda","berat":"50","hargaBeli":"31500","scheme":"kinerja","hargaEmployee":"","hargaJual":"40000","id":"","statusAction":"sukses"}', 1),
(34, '04', '02', '2017', '1486179715', '04-02-2017 10:41:55', 'simpan setting product', '{"merek":"PT Soleram Makmur Sentosa","nama":"SBP Soya bean","berat":"250","hargaBeli":"12000","scheme":"kinerja","hargaEmployee":"","hargaJual":"16000","id":"","statusAction":"sukses"}', 1),
(35, '04', '02', '2017', '1486179954', '04-02-2017 10:45:54', 'simpan setting product', '{"merek":"Sari Bunga","nama":"Al Arobi minyak zaitun 85 kap","berat":"43","hargaBeli":"18000","scheme":"kinerja","hargaEmployee":"","hargaJual":"24500","id":"","statusAction":"sukses"}', 1),
(36, '04', '02', '2017', '1486180032', '04-02-2017 10:47:12', 'edit setting product', '{"merek":"Pt. Ims International","nama":"Inolife Minyak Habatusauda 50 kap","berat":"25","hargaBeli":"31500","scheme":"kinerja","hargaEmployee":"","hargaJual":"40000","id":"15","statusAction":"sukses"}', 1),
(37, '04', '02', '2017', '1486180137', '04-02-2017 10:48:57', 'simpan setting product', '{"merek":"CV Al Baik","nama":"Gamat Gold Jelly cucumber sea 250 ml","berat":"250","hargaBeli":"55000","scheme":"kinerja","hargaEmployee":"","hargaJual":"75000","id":"","statusAction":"sukses"}', 1),
(38, '04', '02', '2017', '1486180614', '04-02-2017 10:56:54', 'simpan setting product', '{"merek":"Al Kautsar utk Daru Syfa","nama":"Habbasay 3in1, 60 kap","berat":"30","hargaBeli":"19000","scheme":"kinerja","hargaEmployee":"","hargaJual":"25000","id":"","statusAction":"sukses"}', 1),
(39, '04', '02', '2017', '1486180693', '04-02-2017 10:58:13', 'simpan setting product', '{"merek":"Herba Bagoes Mlang","nama":"Lamandel botol ","berat":"200","hargaBeli":"20000","scheme":"kinerja","hargaEmployee":"","hargaJual":"25000","id":"","statusAction":"sukses"}', 1),
(40, '04', '02', '2017', '1486180915', '04-02-2017 11:01:55', 'simpan setting product', '{"merek":"PT.Melia Sehat Sejahtera","nama":"Propolis Melia 6 ml x 7 bh","berat":"42","hargaBeli":"250000","scheme":"kinerja","hargaEmployee":"","hargaJual":"350000","id":"","statusAction":"sukses"}', 1),
(41, '04', '02', '2017', '1486181067', '04-02-2017 11:04:27', 'simpan setting product', '{"merek":"CV Jogja Natura Herba","nama":"Susu Etawa Al shliyah","berat":"200","hargaBeli":"15000","scheme":"kinerja","hargaEmployee":"","hargaJual":"25000","id":"","statusAction":"sukses"}', 1),
(42, '04', '02', '2017', '1486181158', '04-02-2017 11:05:58', 'simpan setting product', '{"merek":"PT, Mitra Ihsan Sejahtera","nama":"Syamil anak","berat":"125","hargaBeli":"14000","scheme":"kinerja","hargaEmployee":"","hargaJual":"18000","id":"","statusAction":"sukses"}', 1),
(43, '04', '02', '2017', '1486181253', '04-02-2017 11:07:33', 'simpan setting product', '{"merek":"Salamah Food","nama":"Zaituny minyak zaitun 100 ml","berat":"100","hargaBeli":"15000","scheme":"kinerja","hargaEmployee":"","hargaJual":"20000","id":"","statusAction":"sukses"}', 1),
(44, '04', '02', '2017', '1486181369', '04-02-2017 11:09:29', 'simpan setting product', '{"merek":"Vicomas International","nama":"Habatusauda Ajwa 120 kapsul","berat":"60","hargaBeli":"28500","scheme":"kinerja","hargaEmployee":"","hargaJual":"33000","id":"","statusAction":"sukses"}', 1),
(45, '04', '02', '2017', '1486181469', '04-02-2017 11:11:09', 'simpan setting product', '{"merek":"PT.Zene Nirmala Sentosa","nama":"Garcia 60 kap","berat":"30","hargaBeli":"87000","scheme":"cashback","hargaEmployee":"87000","hargaJual":"95000","id":"","statusAction":"sukses"}', 1),
(46, '04', '02', '2017', '1486181659', '04-02-2017 11:14:19', 'simpan setting product', '{"merek":"Grya An NUR","nama":"ALEVA ","berat":"170","hargaBeli":"30000","scheme":"kinerja","hargaEmployee":"","hargaJual":"37000","id":"","statusAction":"sukses"}', 1),
(47, '04', '02', '2017', '1486181867', '04-02-2017 11:17:47', 'simpan setting product', '{"merek":"Kurmadu Nusantara Bogor","nama":"KURMADU","berat":"280","hargaBeli":"21000","scheme":"kinerja","hargaEmployee":"","hargaJual":"32500","id":"","statusAction":"sukses"}', 1),
(48, '04', '02', '2017', '1486182004', '04-02-2017 11:20:04', 'simpan setting product', '{"merek":"Kurmadu Nusantara Bogor","nama":"Kurmadu For Kids","berat":"280","hargaBeli":"21000","scheme":"kinerja","hargaEmployee":"","hargaJual":"32500","id":"","statusAction":"sukses"}', 1),
(49, '04', '02', '2017', '1486182087', '04-02-2017 11:21:27', 'simpan setting product', '{"merek":"Vicomas International","nama":"Karomah sari kurma","berat":"300","hargaBeli":"15000","scheme":"kinerja","hargaEmployee":"","hargaJual":"20000","id":"","statusAction":"sukses"}', 1),
(50, '04', '02', '2017', '1486182170', '04-02-2017 11:22:50', 'simpan setting product', '{"merek":"Jadied International","nama":"Jadird propolis sarikurma","berat":"300","hargaBeli":"20000","scheme":"kinerja","hargaEmployee":"","hargaJual":"25000","id":"","statusAction":"sukses"}', 1),
(51, '04', '02', '2017', '1486182266', '04-02-2017 11:24:26', 'simpan setting product', '{"merek":"Jadied International","nama":"Jdied lambung MASELA","berat":"125","hargaBeli":"16500","scheme":"kinerja","hargaEmployee":"","hargaJual":"21500","id":"","statusAction":"sukses"}', 1),
(52, '04', '02', '2017', '1486183454', '04-02-2017 11:44:14', 'simpan setting product', '{"merek":"PT. Borobudur","nama":"Mastin 30 kap","berat":"15","hargaBeli":"22500","scheme":"kinerja","hargaEmployee":"","hargaJual":"29500","id":"","statusAction":"sukses"}', 1),
(53, '04', '02', '2017', '1486183553', '04-02-2017 11:45:53', 'simpan setting product', '{"merek":"Griya Annur utk Bin Dawood","nama":"Madu SP Subur Pria","berat":"350","hargaBeli":"28000","scheme":"kinerja","hargaEmployee":"","hargaJual":"37500","id":"","statusAction":"sukses"}', 1),
(54, '04', '02', '2017', '1486183629', '04-02-2017 11:47:09', 'simpan setting product', '{"merek":"Al Mabruroh","nama":"Mdu subur kandungan","berat":"350","hargaBeli":"40000","scheme":"kinerja","hargaEmployee":"","hargaJual":"50000","id":"","statusAction":"sukses"}', 1),
(55, '04', '02', '2017', '1486183741', '04-02-2017 11:49:01', 'simpan setting product', '{"merek":"Kharisma Food","nama":"Madu Pahit Premium FAC","berat":"500","hargaBeli":"35500","scheme":"kinerja","hargaEmployee":"","hargaJual":"65000","id":"","statusAction":"sukses"}', 1),
(56, '04', '02', '2017', '1486183877', '04-02-2017 11:51:17', 'simpan setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al syfa Natural Honey","berat":"125 ","hargaBeli":"18000","scheme":"kinerja","hargaEmployee":"","hargaJual":"23000","id":"","statusAction":"sukses"}', 1),
(57, '04', '02', '2017', '1486183938', '04-02-2017 11:52:18', 'simpan setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al syfa Natural Honey","berat":"250","hargaBeli":"38000","scheme":"kinerja","hargaEmployee":"","hargaJual":"53000","id":"","statusAction":"sukses"}', 1),
(58, '04', '02', '2017', '1486183974', '04-02-2017 11:52:54', 'simpan setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al syfa Natural Honey","berat":"500","hargaBeli":"64000","scheme":"kinerja","hargaEmployee":"","hargaJual":"86000","id":"","statusAction":"sukses"}', 1),
(59, '04', '02', '2017', '1486185570', '04-02-2017 12:19:30', 'simpan setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al syfa Natural Honey","berat":"1000","hargaBeli":"123000","scheme":"kinerja","hargaEmployee":"","hargaJual":"153000","id":"","statusAction":"sukses"}', 1),
(60, '04', '02', '2017', '1486185697', '04-02-2017 12:21:37', 'simpan setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al Syfa Black Forest","berat":"250","hargaBeli":"70000","scheme":"kinerja","hargaEmployee":"","hargaJual":"87000","id":"","statusAction":"sukses"}', 1),
(61, '04', '02', '2017', '1486185768', '04-02-2017 12:22:48', 'simpan setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al Syfa Black Forest","berat":"500","hargaBeli":"128000","scheme":"kinerja","hargaEmployee":"","hargaJual":"160000","id":"","statusAction":"sukses"}', 1),
(62, '04', '02', '2017', '1486185906', '04-02-2017 12:25:06', 'simpan setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al Syfa Black Forest","berat":"1000","hargaBeli":"258000","scheme":"kinerja","hargaEmployee":"","hargaJual":"322000","id":"","statusAction":"sukses"}', 1),
(63, '04', '02', '2017', '1486186467', '04-02-2017 12:34:27', 'simpan setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al Syfa ACCASIA","berat":"250","hargaBeli":"70000","scheme":"kinerja","hargaEmployee":"","hargaJual":"87000","id":"","statusAction":"sukses"}', 1),
(64, '04', '02', '2017', '1486186546', '04-02-2017 12:35:46', 'simpan setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al Syfa ACCASIA ","berat":"500","hargaBeli":"128000","scheme":"kinerja","hargaEmployee":"","hargaJual":"160000","id":"","statusAction":"sukses"}', 1),
(65, '04', '02', '2017', '1486186587', '04-02-2017 12:36:27', 'simpan setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al Syfa ACCASIA","berat":"1000","hargaBeli":"258000","scheme":"kinerja","hargaEmployee":"","hargaJual":"322000","id":"","statusAction":"sukses"}', 1),
(66, '04', '02', '2017', '1486187396', '04-02-2017 12:49:56', 'simpan setting employee', '{"nik":"2015","nama":"Rizky ","alamat":"Ciputat","noHp":"085773368279","id":"","statusAction":"sukses"}', 1),
(67, '04', '02', '2017', '1486187530', '04-02-2017 12:52:10', 'simpan setting employee', '{"nik":"2014","nama":"Agus Supriyadi","alamat":"Pondok Aren","noHp":"087887612460","id":"","statusAction":"sukses"}', 1),
(68, '04', '02', '2017', '1486187619', '04-02-2017 12:53:39', 'simpan setting employee', '{"nik":"2010","nama":"Jemirun","alamat":"Pamulang Elok","noHp":"085880797582","id":"","statusAction":"sukses"}', 1),
(69, '04', '02', '2017', '1486187772', '04-02-2017 12:56:12', 'simpan setting client', '{"nama":"All Fresh Swalayan","alamat":"Jln. Jendral Gatot Subroto 185  Jakarta","noTelp":"02183700945","noHp":"","picPembelian":"Mardiana","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(70, '04', '02', '2017', '1486187919', '04-02-2017 12:58:39', 'simpan setting client', '{"nama":"KOPEBI","alamat":"Jln. Keb0nsirih 82 - 84 Jakarta","noTelp":"","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(71, '04', '02', '2017', '1486188029', '04-02-2017 13:00:29', 'simpan setting client', '{"nama":"Total Buah Segar Menteng","alamat":"Jln. Sunda Gdg Bakmi GM lantai 1 Jakarta","noTelp":"021-3152011","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(72, '04', '02', '2017', '1486188122', '04-02-2017 13:02:02', 'simpan setting client', '{"nama":"Total Buah Segar Depo","alamat":"Jln. Margonda Raya   , Depok","noTelp":"021-77219894","noHp":"082817075989","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(73, '04', '02', '2017', '1486188221', '04-02-2017 13:03:41', 'simpan setting client', '{"nama":"Total Buaah Segar Jalan Baru Bogor","alamat":"jln. KH. Sholeh Iskandar Bogor","noTelp":"0251-8355959","noHp":"082817093450","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(74, '04', '02', '2017', '1486188292', '04-02-2017 13:04:52', 'simpan setting client', '{"nama":"Total Buah Segar Pajajaran Bogor","alamat":"Jln. Raya Pajajaran Bogor","noTelp":"0251-8378511","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(75, '04', '02', '2017', '1486188394', '04-02-2017 13:06:34', 'simpan setting client', '{"nama":"Ada Swalayan Bogor","alamat":"Jln. Raya Pajajaran, Bogor","noTelp":"","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(76, '04', '02', '2017', '1486188484', '04-02-2017 13:08:04', 'simpan setting client', '{"nama":"Total Buah Segar Bekasi","alamat":"Jln.KH.Noer Ali Kalimalang Bekasi","noTelp":"021-28519898","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(77, '04', '02', '2017', '1486188586', '04-02-2017 13:09:46', 'simpan setting client', '{"nama":"Total Buah Segar RC.Veteran","alamat":"Jln.RC.Veteran Rempoa, Tangsel","noTelp":"021-22733898","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(78, '04', '02', '2017', '1486188718', '04-02-2017 13:11:58', 'simpan setting client', '{"nama":"Total Buah Segar Debon","alamat":"Jln. Wolter Mongonsidi Jaksel","noTelp":"021-72801801","noHp":"085772042646","picPembelian":"","picTagihan":"","clientPriceProduct1":"2","hargaJual1":"18000","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(79, '04', '02', '2017', '1486188857', '04-02-2017 13:14:17', 'simpan setting client', '{"nama":"Santa Swalayan","alamat":"Jln.W.Mongonsidi Jakarta","noTelp":"","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(80, '04', '02', '2017', '1486189007', '04-02-2017 13:16:47', 'simpan setting client', '{"nama":"Rumah Buah Swalayan","alamat":"Gudang T8 Alam Sutra ","noTelp":"","noHp":"","picPembelian":"Bu Narti","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(81, '04', '02', '2017', '1486189191', '04-02-2017 13:19:51', 'simpan setting client', '{"nama":"TOSERBA GADING","alamat":"Ruko Gading Serpong","noTelp":"021-5467138","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(82, '04', '02', '2017', '1486189291', '04-02-2017 13:21:31', 'simpan setting client', '{"nama":"Apotik Melawai","alamat":"Jln. Sambas , Jakarta","noTelp":"","noHp":"0818717554","picPembelian":"Bu Lilik","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(83, '04', '02', '2017', '1486189428', '04-02-2017 13:23:48', 'simpan setting client', '{"nama":"Apotik Rini","alamat":"Jln.Balai Pustaka Timur, Rawamangun , Jakarta","noTelp":"021-4702128","noHp":"","picPembelian":"Bu Peni","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(84, '04', '02', '2017', '1486189511', '04-02-2017 13:25:11', 'simpan setting client', '{"nama":"Apotik Titi Murni","alamat":"Jln.Kramat Raya, Jakarta Pusat","noTelp":"021-3912735","noHp":"","picPembelian":"Bu Ani","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(85, '04', '02', '2017', '1486189610', '04-02-2017 13:26:50', 'simpan setting client', '{"nama":"Pujasari Swalayan","alamat":"Jln. Raya Sawangan Bojongsari Depok","noTelp":"","noHp":"","picPembelian":"Bu Endang","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(86, '04', '02', '2017', '1486189692', '04-02-2017 13:28:12', 'simpan setting client', '{"nama":"Harmony Swalayan","alamat":"Jl.Ceger Raya  Tangsel","noTelp":"","noHp":"","picPembelian":"mBak Ira","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(87, '04', '02', '2017', '1486189786', '04-02-2017 13:29:46', 'simpan setting client', '{"nama":"Aneka Buana Swalayan Pondok Labu","alamat":"Jln. RS.Fatmawati Jaksel","noTelp":"021-7691221","noHp":"","picPembelian":"Bu Yu;i","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(88, '04', '02', '2017', '1486189858', '04-02-2017 13:30:58', 'simpan setting client', '{"nama":"Aneka Buana Swalayan Cirendeu","alamat":"Jln. Raya Cirendeu Thgsel","noTelp":"","noHp":"","picPembelian":"Bu Puji","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(89, '04', '02', '2017', '1486189971', '04-02-2017 13:32:51', 'simpan setting client', '{"nama":"Gelael Swalayan","alamat":"Jln.MT.Hryono Jakarta","noTelp":"021-8298390","noHp":"","picPembelian":"Bu Siska","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(90, '04', '02', '2017', '1486190042', '04-02-2017 13:34:02', 'simpan setting client', '{"nama":"Gelael Swalayan Lampung","alamat":"Gudang Ciracas","noTelp":"","noHp":"081366605830","picPembelian":"Pak Endang","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(91, '04', '02', '2017', '1486190077', '04-02-2017 13:34:37', 'simpan setting client', '{"nama":"Gelael Luar Kota","alamat":"Gudang Pusat Ciracas","noTelp":"","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(92, '04', '02', '2017', '1486190331', '04-02-2017 13:38:51', 'edit setting client', '{"nama":"Total Buah Segar Debon","alamat":"Jln. Wolter Mongonsidi Jaksel","noTelp":"021-72801801","noHp":"085772042646","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"51","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"52","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"53","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"54","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"55","id":"11","statusAction":"sukses"}', 1),
(93, '04', '02', '2017', '1486190432', '04-02-2017 13:40:32', 'simpan setting client', '{"nama":"Apotik Hidup Baru","alamat":"Jln.Hidup Baru, JAKSEL","noTelp":"","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(94, '04', '02', '2017', '1486190510', '04-02-2017 13:41:50', 'simpan setting client', '{"nama":"Toko Kemanggisan","alamat":"Jln. Kemanggisan Ilir Jakarta Barat.","noTelp":"","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(95, '04', '02', '2017', '1486190567', '04-02-2017 13:42:47', 'simpan setting client', '{"nama":"Apotik Mahakam","alamat":"Jln. Mahakam , JAKSEL","noTelp":"","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(96, '04', '02', '2017', '1486190646', '04-02-2017 13:44:06', 'simpan setting client', '{"nama":"Apotik Senopati","alamat":"Jln. Raya Senopati JAKSEL","noTelp":"","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(97, '04', '02', '2017', '1486190689', '04-02-2017 13:44:49', 'simpan setting client', '{"nama":"Apotik Pela","alamat":"Jln. Janur Kuning JAKSEL","noTelp":"","noHp":"","picPembelian":"","picTagihan":"","clientPriceProduct1":"","hargaJual1":"","idClientPrice1":"","clientPriceProduct2":"","hargaJual2":"","idClientPrice2":"","clientPriceProduct3":"","hargaJual3":"","idClientPrice3":"","clientPriceProduct4":"","hargaJual4":"","idClientPrice4":"","clientPriceProduct5":"","hargaJual5":"","idClientPrice5":"","id":"","statusAction":"sukses"}', 1),
(98, '04', '02', '2017', '1486190753', '04-02-2017 13:45:53', 'simpan setting bank', '{"namaBank":"Mandiri","id":"","statusAction":"sukses"}', 1),
(99, '04', '02', '2017', '1486190769', '04-02-2017 13:46:09', 'simpan setting bank', '{"namaBank":"BCA","id":"","statusAction":"sukses"}', 1),
(100, '04', '02', '2017', '1486190782', '04-02-2017 13:46:22', 'simpan setting bank', '{"namaBank":"CIMB Niaga","id":"","statusAction":"sukses"}', 1),
(101, '04', '02', '2017', '1486190796', '04-02-2017 13:46:36', 'simpan setting bank', '{"namaBank":"BNI 46","id":"","statusAction":"sukses"}', 1),
(102, '04', '02', '2017', '1486190829', '04-02-2017 13:47:09', 'simpan setting bank', '{"namaBank":"BII","id":"","statusAction":"sukses"}', 1),
(103, '04', '02', '2017', '1486190881', '04-02-2017 13:48:01', 'simpan setting pengeluaran', '{"namaPengeluaran":"Uang Tip","id":"","statusAction":"sukses"}', 1),
(104, '04', '02', '2017', '1486190900', '04-02-2017 13:48:20', 'simpan setting pengeluaran', '{"namaPengeluaran":"Kalender Tahunan","id":"","statusAction":"sukses"}', 1),
(105, '04', '02', '2017', '1486190919', '04-02-2017 13:48:39', 'simpan setting pengeluaran', '{"namaPengeluaran":"Seragam Kerja","id":"","statusAction":"sukses"}', 1),
(106, '04', '02', '2017', '1486190950', '04-02-2017 13:49:10', 'simpan setting pengeluaran', '{"namaPengeluaran":"Parcel","id":"","statusAction":"sukses"}', 1),
(107, '04', '02', '2017', '1486191001', '04-02-2017 13:50:01', 'simpan setting pengeluaran', '{"namaPengeluaran":"Retur Oroduk","id":"","statusAction":"sukses"}', 1),
(108, '04', '02', '2017', '1486191061', '04-02-2017 13:51:01', 'simpan setting pengeluaran', '{"namaPengeluaran":"Barang tidak sampai","id":"","statusAction":"sukses"}', 1),
(109, '04', '02', '2017', '1486191087', '04-02-2017 13:51:27', 'simpan setting pengeluaran', '{"namaPengeluaran":"bayar Listing Fee","id":"","statusAction":"sukses"}', 1),
(110, '04', '02', '2017', '1486191127', '04-02-2017 13:52:07', 'simpan setting pengeluaran', '{"namaPengeluaran":"Biaya iklan, brosur","id":"","statusAction":"sukses"}', 1),
(111, '04', '02', '2017', '1486191161', '04-02-2017 13:52:41', 'simpan setting pengeluaran', '{"namaPengeluaran":"Pemberian hadiah","id":"","statusAction":"sukses"}', 1),
(112, '04', '02', '2017', '1486191239', '04-02-2017 13:53:59', 'edit setting pengeluaran', '{"namaPengeluaran":"Retur Produk","id":"5","statusAction":"sukses"}', 1),
(113, '04', '02', '2017', '1486191269', '04-02-2017 13:54:29', 'simpan setting pengeluaran', '{"namaPengeluaran":"Pemberian Extra","id":"","statusAction":"sukses"}', 1),
(114, '04', '02', '2017', '1486191312', '04-02-2017 13:55:12', 'simpan setting pengeluaran', '{"namaPengeluaran":"Hilang atau tdk byr \\/ kabur","id":"","statusAction":"sukses"}', 1),
(115, '05', '02', '2017', '1486256049', '05-02-2017 07:54:09', 'Login', 'Sukses Login, Nama : cl450106x.maintenis.com, IP 202.62.17.44 - joseph', 1),
(116, '05', '02', '2017', '1486281973', '05-02-2017 15:06:13', 'Login', 'Sukses Login, Nama : cl450106x.maintenis.com, IP 202.62.17.44 - joseph', 1),
(117, '05', '02', '2017', '1486282220', '05-02-2017 15:10:20', 'edit setting product', '{"merek":"Jadied International","nama":"Jadied Propolis Sarikurma","berat":"300","hargaBeli":"20000","scheme":"kinerja","hargaEmployee":"","hargaJual":"25000","id":"31","statusAction":"sukses"}', 1),
(118, '05', '02', '2017', '1486282333', '05-02-2017 15:12:13', 'simpan setting product', '{"merek":"Jadied International","nama":"Jadied lambung sari kurma","berat":"125","hargaBeli":"17000","scheme":"kinerja","hargaEmployee":"","hargaJual":"21500","id":"","statusAction":"sukses"}', 1),
(119, '05', '02', '2017', '1486282420', '05-02-2017 15:13:40', 'simpan setting product', '{"merek":"Jadied International","nama":"Jadied lambung sari kurma","berat":"125","hargaBeli":"17000","scheme":"kinerja","hargaEmployee":"","hargaJual":"21500","id":"","statusAction":"sukses"}', 1),
(120, '05', '02', '2017', '1486282712', '05-02-2017 15:18:32', 'edit setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al Syfa Black Forest","berat":"1000","hargaBeli":"265000","scheme":"kinerja","hargaEmployee":"","hargaJual":"330000","id":"43","statusAction":"sukses"}', 1),
(121, '05', '02', '2017', '1486282747', '05-02-2017 15:19:07', 'delete setting product', '{"statusAction":"sukses"}', 1),
(122, '05', '02', '2017', '1486282803', '05-02-2017 15:20:03', 'edit setting product', '{"merek":"Gautama Indah Perkasa","nama":"Madu Al Syfa Accasia","berat":"1000","hargaBeli":"265000","scheme":"kinerja","hargaEmployee":"","hargaJual":"322000","id":"46","statusAction":"sukses"}', 1),
(123, '05', '02', '2017', '1486282952', '05-02-2017 15:22:32', 'simpan setting product', '{"merek":"PT. Amal Mulia Sejahtera","nama":"Sari kurma Aljazira","berat":"360","hargaBeli":"15500","scheme":"kinerja","hargaEmployee":"","hargaJual":"19500","id":"","statusAction":"sukses"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `namaPengeluaran` varchar(100) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `namaPengeluaran`, `id_admin`, `deleted`) VALUES
(1, 'uang tip', 1, 0),
(2, 'kalender tahunan', 1, 0),
(3, 'seragam kerja', 1, 0),
(4, 'parcel', 1, 0),
(5, 'retur produk', 1, 0),
(6, 'barang tidak sampai', 1, 0),
(7, 'bayar listing fee', 1, 0),
(8, 'biaya iklan, brosur', 1, 0),
(9, 'pemberian hadiah', 1, 0),
(10, 'pemberian extra', 1, 0),
(11, 'hilang atau tdk byr / kabur', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluarantrx`
--

CREATE TABLE IF NOT EXISTS `pengeluarantrx` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `idPengeluaran` int(20) DEFAULT NULL,
  `d` int(2) DEFAULT NULL,
  `m` int(2) DEFAULT NULL,
  `y` int(5) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `keterangan` varchar(400) DEFAULT NULL,
  `jumlah` varchar(20) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `no` varchar(20) DEFAULT NULL,
  `noFaktur` varchar(200) NOT NULL,
  `noPo` varchar(20) DEFAULT NULL,
  `idClient` varchar(20) DEFAULT NULL,
  `idEmployeePic` varchar(20) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `d` int(2) DEFAULT NULL,
  `m` int(2) DEFAULT NULL,
  `y` int(5) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `keterangan` varchar(400) DEFAULT NULL,
  `tipePembayaran` varchar(100) DEFAULT NULL,
  `idBank` varchar(20) DEFAULT NULL,
  `noGiro` varchar(150) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `nominal` varchar(50) DEFAULT NULL,
  `biayaLain` varchar(50) DEFAULT NULL,
  `nominalFaktur` varchar(20) DEFAULT NULL,
  `totalBayar` varchar(20) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`,`noFaktur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `penjualandetail`
--

CREATE TABLE IF NOT EXISTS `penjualandetail` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `idPenjualan` varchar(20) DEFAULT NULL,
  `idProduct` varchar(20) DEFAULT NULL,
  `hargaBeli` varchar(20) DEFAULT NULL,
  `hargaJual` varchar(20) DEFAULT NULL,
  `jumlah` varchar(20) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `produsen` varchar(100) DEFAULT NULL,
  `merek` varchar(100) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `berat` varchar(10) DEFAULT NULL,
  `hargaBeli` varchar(20) DEFAULT NULL,
  `hargaJual` varchar(20) DEFAULT NULL,
  `hargaEmployee` varchar(20) DEFAULT NULL,
  `scheme` varchar(50) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `produsen`, `merek`, `nama`, `berat`, `hargaBeli`, `hargaJual`, `hargaEmployee`, `scheme`, `id_admin`, `deleted`) VALUES
(2, NULL, 'grya herba', 'teh celup jati belanda', '40', '12500', '17500', '', 'kinerja', 1, 0),
(3, NULL, 'grya herba', 'teh celup jati cina', '40', '12000', '17500', '', 'kinerja', 1, 0),
(4, NULL, 'tazaka', 'teh celup binahong', '40', '12000', '17500', '', 'kinerja', 1, 0),
(5, NULL, 'griya herba', 'teh celup  sarang semut', '40', '15000', '23000', '', 'kinerja', 1, 0),
(6, NULL, 'tazaka', 'teh celup kulit manggis', '40', '12000', '17000', '', 'kinerja', 1, 0),
(7, NULL, 'daru syfa', 'teh celup detox ginjal', '40', '11000', '17500', '', 'kinerja', 1, 0),
(8, NULL, 'cv. isma', 'teh celup diabetea insulin', '40', '11000', '20000', '', 'kinerja', 1, 0),
(9, NULL, 'jasmine food international', 'teh celup putih white tea', '30', '30000', '41000', '', 'kinerja', 1, 0),
(10, NULL, 'cv.adev natural ', 'sabun kunyit adev', '40', '6500', '9000', '', 'kinerja', 1, 0),
(11, NULL, 'ud. fira ', 'sarang semut super quality', '120', '30000', '43000', '', 'kinerja', 1, 0),
(12, NULL, 'tazakka', 'teh celup daun kelor', '40', '12000', '17500', '', 'kinerja', 1, 0),
(13, NULL, 'grya herba', 'teh celup daun saga', '40', '12000', '17500', '', 'kinerja', 1, 0),
(14, NULL, 'inayah abadi utk haifa', 'jahe merah zein toples', '330', '15000', '20000', '', 'kinerja', 1, 0),
(15, NULL, 'pt. ims international', 'inolife minyak habatusauda 50 kap', '25', '31500', '40000', '', 'kinerja', 1, 0),
(16, NULL, 'pt soleram makmur sentosa', 'sbp soya bean', '250', '12000', '16000', '', 'kinerja', 1, 0),
(17, NULL, 'sari bunga', 'al arobi minyak zaitun 85 kap', '43', '18000', '24500', '', 'kinerja', 1, 0),
(18, NULL, 'cv al baik', 'gamat gold jelly cucumber sea 250 ml', '250', '55000', '75000', '', 'kinerja', 1, 0),
(19, NULL, 'al kautsar utk daru syfa', 'habbasay 3in1, 60 kap', '30', '19000', '25000', '', 'kinerja', 1, 0),
(20, NULL, 'herba bagoes mlang', 'lamandel botol ', '200', '20000', '25000', '', 'kinerja', 1, 0),
(21, NULL, 'pt.melia sehat sejahtera', 'propolis melia 6 ml x 7 bh', '42', '250000', '350000', '', 'kinerja', 1, 0),
(22, NULL, 'cv jogja natura herba', 'susu etawa al shliyah', '200', '15000', '25000', '', 'kinerja', 1, 0),
(23, NULL, 'pt, mitra ihsan sejahtera', 'syamil anak', '125', '14000', '18000', '', 'kinerja', 1, 0),
(24, NULL, 'salamah food', 'zaituny minyak zaitun 100 ml', '100', '15000', '20000', '', 'kinerja', 1, 0),
(25, NULL, 'vicomas international', 'habatusauda ajwa 120 kapsul', '60', '28500', '33000', '', 'kinerja', 1, 0),
(26, NULL, 'pt.zene nirmala sentosa', 'garcia 60 kap', '30', '87000', '95000', '87000', 'cashback', 1, 0),
(27, NULL, 'grya an nur', 'aleva ', '170', '30000', '37000', '', 'kinerja', 1, 0),
(28, NULL, 'kurmadu nusantara bogor', 'kurmadu', '280', '21000', '32500', '', 'kinerja', 1, 0),
(29, NULL, 'kurmadu nusantara bogor', 'kurmadu for kids', '280', '21000', '32500', '', 'kinerja', 1, 0),
(30, NULL, 'vicomas international', 'karomah sari kurma', '300', '15000', '20000', '', 'kinerja', 1, 0),
(31, NULL, 'jadied international', 'jadied propolis sarikurma', '300', '20000', '25000', '', 'kinerja', 1, 0),
(32, NULL, 'jadied international', 'jdied lambung masela', '125', '16500', '21500', '', 'kinerja', 1, 0),
(33, NULL, 'pt. borobudur', 'mastin 30 kap', '15', '22500', '29500', '', 'kinerja', 1, 0),
(34, NULL, 'griya annur utk bin dawood', 'madu sp subur pria', '350', '28000', '37500', '', 'kinerja', 1, 0),
(35, NULL, 'al mabruroh', 'mdu subur kandungan', '350', '40000', '50000', '', 'kinerja', 1, 0),
(36, NULL, 'kharisma food', 'madu pahit premium fac', '500', '35500', '65000', '', 'kinerja', 1, 0),
(37, NULL, 'gautama indah perkasa', 'madu al syfa natural honey', '125 ', '18000', '23000', '', 'kinerja', 1, 0),
(38, NULL, 'gautama indah perkasa', 'madu al syfa natural honey', '250', '38000', '53000', '', 'kinerja', 1, 0),
(39, NULL, 'gautama indah perkasa', 'madu al syfa natural honey', '500', '64000', '86000', '', 'kinerja', 1, 0),
(40, NULL, 'gautama indah perkasa', 'madu al syfa natural honey', '1000', '123000', '153000', '', 'kinerja', 1, 0),
(41, NULL, 'gautama indah perkasa', 'madu al syfa black forest', '250', '70000', '87000', '', 'kinerja', 1, 0),
(42, NULL, 'gautama indah perkasa', 'madu al syfa black forest', '500', '128000', '160000', '', 'kinerja', 1, 0),
(43, NULL, 'gautama indah perkasa', 'madu al syfa black forest', '1000', '265000', '330000', '', 'kinerja', 1, 0),
(44, NULL, 'gautama indah perkasa', 'madu al syfa accasia', '250', '70000', '87000', '', 'kinerja', 1, 0),
(45, NULL, 'gautama indah perkasa', 'madu al syfa accasia ', '500', '128000', '160000', '', 'kinerja', 1, 0),
(46, NULL, 'gautama indah perkasa', 'madu al syfa accasia', '1000', '265000', '322000', '', 'kinerja', 1, 0),
(47, NULL, 'jadied international', 'jadied lambung sari kurma', '125', '17000', '21500', '', 'kinerja', 1, 1),
(48, NULL, 'jadied international', 'jadied lambung sari kurma', '125', '17000', '21500', '', 'kinerja', 1, 0),
(49, NULL, 'pt. amal mulia sejahtera', 'sari kurma aljazira', '360', '15500', '19500', '', 'kinerja', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tukarfaktur`
--

CREATE TABLE IF NOT EXISTS `tukarfaktur` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `idPenjualan` varchar(200) DEFAULT NULL,
  `idEmployeePic` varchar(20) DEFAULT NULL,
  `d` int(2) DEFAULT NULL,
  `m` int(2) DEFAULT NULL,
  `y` int(5) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `keterangan` varchar(400) DEFAULT NULL,
  `tanggalKembali` varchar(15) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
