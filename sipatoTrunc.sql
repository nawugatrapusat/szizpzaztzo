/*
SQLyog Ultimate v9.20 
MySQL - 5.5.16 : Database - sipato
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `pass` varbinary(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

/*Table structure for table `ambiluang` */

DROP TABLE IF EXISTS `ambiluang`;

CREATE TABLE `ambiluang` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ambiluang` */

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `namaBank` varchar(100) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bank` */

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `client` */

/*Table structure for table `clientprice` */

DROP TABLE IF EXISTS `clientprice`;

CREATE TABLE `clientprice` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idClient` int(10) DEFAULT NULL,
  `idProduct` int(10) DEFAULT NULL,
  `hargaJual` varchar(10) NOT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `clientprice` */

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `noHp` varchar(20) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `employee` */

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `log` */

/*Table structure for table `pengeluaran` */

DROP TABLE IF EXISTS `pengeluaran`;

CREATE TABLE `pengeluaran` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `namaPengeluaran` varchar(100) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengeluaran` */

/*Table structure for table `pengeluarantrx` */

DROP TABLE IF EXISTS `pengeluarantrx`;

CREATE TABLE `pengeluarantrx` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `pengeluarantrx` */

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
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
  `totalBayar` varchar(20) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`,`noFaktur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `penjualan` */

/*Table structure for table `penjualandetail` */

DROP TABLE IF EXISTS `penjualandetail`;

CREATE TABLE `penjualandetail` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `idPenjualan` varchar(20) DEFAULT NULL,
  `idProduct` varchar(20) DEFAULT NULL,
  `hargaBeli` varchar(20) DEFAULT NULL,
  `hargaJual` varchar(20) DEFAULT NULL,
  `jumlah` varchar(20) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penjualandetail` */

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `product` */

/*Table structure for table `tukarfaktur` */

DROP TABLE IF EXISTS `tukarfaktur`;

CREATE TABLE `tukarfaktur` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tukarfaktur` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
