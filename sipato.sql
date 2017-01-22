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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`nama`,`pass`) values (1,'gun','5161ebb0cce4b7987ba8b6935d60a180');

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `ambiluang` */

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `namaBank` varchar(100) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bank` */

insert  into `bank`(`id`,`namaBank`,`id_admin`,`deleted`) values (2,'bank bca',NULL,0),(3,'bank mandiri',NULL,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

/*Data for the table `client` */

insert  into `client`(`id`,`nama`,`alamat`,`noTelp`,`noHp`,`picPembelian`,`picTagihan`,`id_admin`,`deleted`) values (66,'toko rugi banget','ini alamat toko rugi banget','021 0998222','088666377','tutus','titis',NULL,0),(67,'apotek bangkrut 1','jalan rbangkrut raya 1','021 8827828 1','085641441144 1','rahmat 1','budi 1',NULL,0),(75,'12311','122','','','','',1,1),(76,'1','1','','','','',1,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

/*Data for the table `clientprice` */

insert  into `clientprice`(`id`,`idClient`,`idProduct`,`hargaJual`,`id_admin`,`deleted`) values (1,66,2,'300001',NULL,0),(2,66,1,'310002',NULL,0),(6,66,0,'',NULL,0),(7,66,0,'',NULL,0),(8,66,0,'',NULL,0),(9,67,5,'299001',NULL,0),(10,67,0,'',NULL,0),(11,67,0,'',NULL,0),(12,67,0,'',NULL,0),(13,67,0,'',NULL,0),(49,75,2,'22222',1,0),(50,75,0,'',1,0),(51,75,0,'',1,0),(52,75,0,'',1,0),(53,75,0,'',1,0),(54,76,0,'',1,0),(55,76,0,'',1,0),(56,76,0,'',1,0),(57,76,0,'',1,0),(58,76,0,'',1,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `employee` */

insert  into `employee`(`id`,`nik`,`nama`,`alamat`,`noHp`,`id_admin`,`deleted`) values (1,'222313','sujatmiko','alamat sujatmiko','0777444',NULL,0),(2,'884389','tono','alamat tono','0887331',NULL,0),(3,'32432','dudung','alamat dudung','0988744',NULL,0),(4,'19910201','gunawan','jalan wawn permai','088881111',NULL,0);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `log` */

insert  into `log`(`id`,`d`,`m`,`y`,`date`,`time`,`category`,`activity`,`id_admin`) values (3,'22','01','2017','1485051210','22-01-2017 09:13:30','edit penjualan','{\"noPo\":\"8890011\",\"idClient\":\"66\",\"idEmployeePic\":\"4\",\"keterangan\":\"\",\"idProduct1\":\"2\",\"jumlah1\":\"2\",\"hargaBeli1\":\"50000\",\"hargaJual1\":\"300001\",\"id1\":\"59\",\"idProduct2\":\"3\",\"jumlah2\":\"3\",\"hargaBeli2\":\"75000\",\"hargaJual2\":\"90000\",\"id2\":\"60\",\"idProduct3\":\"\",\"jumlah3\":\"\",\"hargaBeli3\":\"\",\"hargaJual3\":\"\",\"id3\":\"\",\"idProduct4\":\"\",\"jumlah4\":\"\",\"hargaBeli4\":\"\",\"hargaJual4\":\"\",\"id4\":\"\",\"idProduct5\":\"\",\"jumlah5\":\"\",\"hargaBeli5\":\"\",\"hargaJual5\":\"\",\"id5\":\"\",\"idProduct6\":\"\",\"jumlah6\":\"\",\"hargaBeli6\":\"\",\"hargaJual6\":\"\",\"id6\":\"\",\"idProduct7\":\"\",\"jumlah7\":\"\",\"hargaBeli7\":\"\",\"hargaJual7\":\"\",\"id7\":\"\",\"idProduct8\":\"\",\"jumlah8\":\"\",\"hargaBeli8\":\"\",\"hargaJual8\":\"\",\"id8\":\"\",\"idProduct9\":\"\",\"jumlah9\":\"\",\"hargaBeli9\":\"\",\"hargaJual9\":\"\",\"id9\":\"\",\"idProduct10\":\"\",\"jumlah10\":\"\",\"hargaBeli10\":\"\",\"hargaJual10\":\"\",\"id10\":\"\",\"idProduct11\":\"\",\"jumlah11\":\"\",\"hargaBeli11\":\"\",\"hargaJual11\":\"\",\"id11\":\"\",\"idProduct12\":\"\",\"jumlah12\":\"\",\"hargaBeli12\":\"\",\"hargaJual12\":\"\",\"id12\":\"\",\"idProduct13\":\"\",\"jumlah13\":\"\",\"hargaBeli13\":\"\",\"hargaJual13\":\"\",\"id13\":\"\",\"idProduct14\":\"\",\"jumlah14\":\"\",\"hargaBeli14\":\"\",\"hargaJual14\":\"\",\"id14\":\"\",\"idProduct15\":\"\",\"jumlah15\":\"\",\"hargaBeli15\":\"\",\"hargaJual15\":\"\",\"id15\":\"\",\"idProduct16\":\"\",\"jumlah16\":\"\",\"hargaBeli16\":\"\",\"hargaJual16\":\"\",\"id16\":\"\",\"idProduct17\":\"\",\"jumlah17\":\"\",\"hargaBeli17\":\"\",\"hargaJual17\":\"\",\"id17\":\"\",\"idProduct18\":\"\",\"jumlah18\":\"\",\"hargaBeli18\":\"\",\"hargaJual18\":\"\",\"id18\":\"\",\"idProduct19\":\"\",\"jumlah19\":\"\",\"hargaBeli19\":\"\",\"hargaJual19\":\"\",\"id19\":\"\",\"idProduct20\":\"\",\"jumlah20\":\"\",\"hargaBeli20\":\"\",\"hargaJual20\":\"\",\"id20\":\"\",\"idProduct21\":\"\",\"jumlah21\":\"\",\"hargaBeli21\":\"\",\"hargaJual21\":\"\",\"id21\":\"\",\"idProduct22\":\"\",\"jumlah22\":\"\",\"hargaBeli22\":\"\",\"hargaJual22\":\"\",\"id22\":\"\",\"idProduct23\":\"\",\"jumlah23\":\"\",\"hargaBeli23\":\"\",\"hargaJual23\":\"\",\"id23\":\"\",\"idProduct24\":\"\",\"jumlah24\":\"\",\"hargaBeli24\":\"\",\"hargaJual24\":\"\",\"id24\":\"\",\"idProduct25\":\"\",\"jumlah25\":\"\",\"hargaBeli25\":\"\",\"hargaJual25\":\"\",\"id25\":\"\",\"idProduct26\":\"\",\"jumlah26\":\"\",\"hargaBeli26\":\"\",\"hargaJual26\":\"\",\"id26\":\"\",\"idProduct27\":\"\",\"jumlah27\":\"\",\"hargaBeli27\":\"\",\"hargaJual27\":\"\",\"id27\":\"\",\"idProduct28\":\"\",\"jumlah28\":\"\",\"hargaBeli28\":\"\",\"hargaJual28\":\"\",\"id28\":\"\",\"idProduct29\":\"\",\"jumlah29\":\"\",\"hargaBeli29\":\"\",\"hargaJual29\":\"\",\"id29\":\"\",\"idProduct30\":\"\",\"jumlah30\":\"\",\"hargaBeli30\":\"\",\"hargaJual30\":\"\",\"id30\":\"\",\"idProduct31\":\"\",\"jumlah31\":\"\",\"hargaBeli31\":\"\",\"hargaJual31\":\"\",\"id31\":\"\",\"idProduct32\":\"\",\"jumlah32\":\"\",\"hargaBeli32\":\"\",\"hargaJual32\":\"\",\"id32\":\"\",\"idProduct33\":\"\",\"jumlah33\":\"\",\"hargaBeli33\":\"\",\"hargaJual33\":\"\",\"id33\":\"\",\"idProduct34\":\"\",\"jumlah34\":\"\",\"hargaBeli34\":\"\",\"hargaJual34\":\"\",\"id34\":\"\",\"idProduct35\":\"\",\"jumlah35\":\"\",\"hargaBeli35\":\"\",\"hargaJual35\":\"\",\"id35\":\"\",\"id\":\"23\",\"statusAction\":\"sukses\"}',1);

/*Table structure for table `pengeluaran` */

DROP TABLE IF EXISTS `pengeluaran`;

CREATE TABLE `pengeluaran` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `namaPengeluaran` varchar(100) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `pengeluaran` */

insert  into `pengeluaran`(`id`,`namaPengeluaran`,`id_admin`,`deleted`) values (1,'tips',1,0),(3,'uang makan',1,0);

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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `pengeluarantrx` */

insert  into `pengeluarantrx`(`id`,`idPengeluaran`,`d`,`m`,`y`,`date`,`time`,`id_admin`,`keterangan`,`jumlah`,`deleted`) values (33,1,20,1,2017,'1484916629','20-01-2017 19:50:29',1,'','123213',0);

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
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `penjualan` */

insert  into `penjualan`(`id`,`no`,`noFaktur`,`noPo`,`idClient`,`idEmployeePic`,`hash`,`d`,`m`,`y`,`date`,`time`,`id_admin`,`keterangan`,`tipePembayaran`,`idBank`,`noGiro`,`status`,`nominal`,`biayaLain`,`totalBayar`,`deleted`) values (23,'1','17010001','8890011','66','4','d0ee65df',17,1,2017,'1484633862','17-01-2017 13:17:42',1,'','','','','tukar faktur','','','870002',0),(29,'4','17010004','','67','3','3735b939',20,1,2017,'1484906519','20-01-2017 17:01:59',1,'',NULL,NULL,NULL,'kirim barang',NULL,NULL,'240000',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

/*Data for the table `penjualandetail` */

insert  into `penjualandetail`(`id`,`idPenjualan`,`idProduct`,`hargaBeli`,`hargaJual`,`jumlah`,`id_admin`,`deleted`) values (59,'23','2','50000','300001','2',1,0),(60,'23','3','75000','90000','3',1,0),(61,'28','6','10000','20000','10',NULL,0),(62,'28','5','150000','155000','2',NULL,0),(67,'28','1','10000','12000','2',NULL,0);

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `product` */

insert  into `product`(`id`,`produsen`,`merek`,`nama`,`berat`,`hargaBeli`,`hargaJual`,`hargaEmployee`,`scheme`,`id_admin`,`deleted`) values (1,'produsen samsung','samsung','galaxy s5','200','10000','12000','','kinerja',NULL,0),(2,'produsen acer','acer','aspire z330','100','50000','75000','','kinerja',NULL,0),(3,'produsen asus','asus','zenfone 3','150','75000','95000','90000','cashback',NULL,0),(5,'mutiara','cespleng','madu beras kencur','100','120000','155000','150000','cashback',NULL,0),(6,'ini produsen','ini merek','ini nama','222','10000','20000','','kinerja',NULL,0);

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `tukarfaktur` */

insert  into `tukarfaktur`(`id`,`idPenjualan`,`idEmployeePic`,`d`,`m`,`y`,`date`,`time`,`id_admin`,`keterangan`,`tanggalKembali`,`deleted`) values (22,'23','3',20,1,2017,'1484916394','20-01-2017 19:46:34',1,'123','25-01-2017',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
