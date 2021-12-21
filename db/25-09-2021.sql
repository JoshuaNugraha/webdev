/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.17-MariaDB : Database - r_project1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `biaya` */

DROP TABLE IF EXISTS `biaya`;

CREATE TABLE `biaya` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_akun_kas` int(11) DEFAULT 0,
  `id_akun` int(11) unsigned DEFAULT 0,
  `no_ref` varchar(50) DEFAULT '',
  `tgl` date DEFAULT NULL,
  `ket` text DEFAULT '',
  `jml` int(20) DEFAULT 0,
  `pajak` int(15) DEFAULT 0,
  `bayar_nanti` int(1) DEFAULT 0,
  `last_user` int(11) DEFAULT 0,
  `last_update` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_akun_kas` (`id_akun_kas`),
  KEY `id_akun` (`id_akun`),
  KEY `last_user` (`last_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `biaya` */

/*Table structure for table `default_akun` */

DROP TABLE IF EXISTS `default_akun`;

CREATE TABLE `default_akun` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `sub` varchar(50) DEFAULT NULL,
  `nm_akun` varchar(50) DEFAULT NULL,
  `jenis` varchar(1) DEFAULT NULL,
  `tambah` varchar(10) DEFAULT NULL,
  `kurang` varchar(10) DEFAULT NULL,
  `sawal` varchar(10) DEFAULT NULL,
  `status` varchar(1) DEFAULT '1',
  `akuntansi` int(1) DEFAULT 1,
  `biaya` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=234 DEFAULT CHARSET=latin1;

/*Data for the table `default_akun` */

insert  into `default_akun`(`id`,`kode`,`sub`,`nm_akun`,`jenis`,`tambah`,`kurang`,`sawal`,`status`,`akuntansi`,`biaya`) values (114,'1-10000','','Kas / Bank','H','debit','kredit',NULL,'1',0,1),(115,'1-10000','1-10001','Kas Besar','D','debit','kredit',NULL,'1',1,1),(116,'1-10000','1-10002','Kas Kecil','D','debit','kredit',NULL,'1',1,1),(117,'1-10100','','Piutang Usaha','H','debit','kredit',NULL,'1',1,1),(118,'1-10200','','Persediaan Barang','H','debit','kredit',NULL,'1',0,1),(119,'1-10300','','Piutang Lainnya','H','debit','kredit',NULL,'1',1,1),(120,'1-10300','1-10301','Puitang Karyawan','D','debit','kredit',NULL,'1',1,1),(121,'1-10401','','Aset lancar Lainnya','H','debit','kredit',NULL,'1',1,1),(122,'1-10401','1-10402','Biaya Dibayar Dimuka','D','debit','kredit',NULL,'1',1,1),(123,'1-10500','','PPN Masukan','H','debit','kredit',NULL,'1',1,1),(124,'1-10700','','Aset Tetap','H','debit','kredit',NULL,'1',0,1),(125,'1-10700','1-10701','Tanah','D','debit','kredit',NULL,'1',1,1),(126,'1-10700','1-10702','Bangunan','D','debit','kredit',NULL,'1',0,1),(127,'1-10700','1-10703','Kendaraan','D','debit','kredit',NULL,'1',0,1),(128,'1-10700','1-10704','Mesin & Peralatan','D','debit','kredit',NULL,'1',1,1),(129,'1-10700','1-10705','Peralatan Kantor','D','debit','kredit',NULL,'1',1,1),(130,'1-10700','1-10706','Aset Lainnya','D','debit','kredit',NULL,'1',1,1),(131,'1-10750','1-10751','Akumulasi Peny. Bangunan','D','kredit','debit',NULL,'1',1,1),(132,'1-10750','1-10752','Akumulasi Peny. Kendaraan','D','kredit','debit',NULL,'1',1,1),(133,'1-10750','1-10753','Akumulasi Peny. Mesin & Peralatan','D','kredit','debit',NULL,'1',1,1),(134,'1-10750','1-10754','Akumulasi Peny. Peralatan Kantor','D','kredit','debit',NULL,'1',1,1),(135,'2-20000','','Kewajiban Jangka Pendek','H','kredit','debit',NULL,'1',0,1),(136,'2-20000','2-20100','Utang Usaha','D','kredit','debit',NULL,'1',1,1),(137,'2-20200','','Utang Lainnya','H','kredit','debit',NULL,'1',1,1),(138,'2-20200','2-20201','Utang Gaji','D','kredit','debit',NULL,'1',1,1),(139,'2-20200','2-20202','Utang Deviden','D','kredit','debit',NULL,'1',1,1),(140,'2-20200','2-20203','Pendapatan Diterima Dimuka','D','kredit','debit',NULL,'1',1,1),(141,'2-20200','2-20399','Utang Biaya','D','kredit','debit',NULL,'1',1,1),(142,'2-20400','','Kewajiban Jangka Panjang','H','kredit','debit',NULL,'1',0,1),(143,'2-20400','2-20401','Utang Bank','D','kredit','debit',NULL,'1',1,1),(144,'2-20500','','PPN Keluaran','H','kredit','debit',NULL,'1',1,1),(145,'2-20500','2-20501','Utang Pajak','D','kredit','debit',NULL,'1',1,1),(146,'2-20500','2-20502','Utang Pemegang Saham','D','kredit','debit',NULL,'1',1,1),(147,'3-30000','','Modal','H','kredit','debit',NULL,'1',0,1),(148,'3-30000','3-30001','Modal Pemilik','D','kredit','debit',NULL,'1',1,1),(149,'3-30000','3-30002','Tambahan Modal Disetor','D','kredit','debit',NULL,'1',1,1),(150,'3-30000','3-30003','Laba Tahun Ini','D','kredit','debit',NULL,'1',0,1),(151,'3-30000','3-30004','Laba Ditahan','D','kredit','debit',NULL,'1',0,1),(152,'3-30000','3-30005','Deviden','D','debit','kredit',NULL,'1',1,1),(153,'3-30000','3-30006','Prive','D','debit','kredit',NULL,'1',1,1),(154,'3-30000','3-30999','Ekuitas Saldo Awal','D','kredit','debit',NULL,'1',0,1),(155,'4-40000','','Penjualan','H','kredit','debit',NULL,'1',1,1),(156,'4-40100','','Potongan Penjualan','H','debit','kredit',NULL,'1',1,1),(157,'4-40200','','Retur Penjualan','H','debit','kredit',NULL,'1',1,1),(158,'4-40300','','Pendapatan Jasa','H','kredit','debit',NULL,'1',1,1),(159,'5-50000','','Beban Pokok Penjualan','H','debit','kredit',NULL,'1',0,1),(160,'5-50100','','Potongan Pembelian','H','kredit','debit',NULL,'1',1,1),(161,'5-50200','','Retur Pembelian','H','kredit','debit',NULL,'1',1,1),(162,'5-50300','','Biaya Pengiriman','H','debit','kredit',NULL,'1',1,1),(163,'5-50500','','Biaya Produksi','H','debit','kredit',NULL,'1',1,1),(164,'6-60000','','Biaya Operasional','H','debit','kredit',NULL,'1',0,1),(165,'6-60000','6-60001','Iklan & Promosi','D','debit','kredit',NULL,'1',0,1),(166,'6-60000','6-60002','Marketing Lainnya','D','debit','kredit',NULL,'1',0,1),(167,'6-60000','6-60003','Kerugian Barang Rusak','D','debit','kredit',NULL,'1',1,0),(168,'6-60100','','Biaya Umum & Administrasi','H','debit','kredit',NULL,'1',0,1),(169,'6-60100','6-60101','Gaji','D','debit','kredit',NULL,'1',0,1),(170,'6-60100','6-60102','Upah','D','debit','kredit',NULL,'1',0,1),(171,'6-60100','6-60103','Konsumsi','D','debit','kredit',NULL,'1',0,1),(172,'6-60100','6-60104','Lembur','D','debit','kredit',NULL,'1',0,1),(173,'6-60100','6-60105','Pengobatan','D','debit','kredit',NULL,'1',0,0),(174,'6-60100','6-60106','THR & Bonus','D','debit','kredit',NULL,'1',0,1),(175,'6-60100','6-60107','Jamsostek','D','debit','kredit',NULL,'1',0,0),(176,'6-60100','6-60108','Intensif','D','debit','kredit',NULL,'1',0,1),(177,'6-60100','6-60109','Pesangon','D','debit','kredit',NULL,'1',0,1),(178,'6-60100','6-60110','Manfaat dan Tunjangan Lain','D','debit','kredit',NULL,'1',0,1),(179,'6-60200','','Donasi','H','debit','kredit',NULL,'1',1,0),(180,'6-60200','6-60201','Hiburan','D','debit','kredit',NULL,'1',1,0),(181,'6-60200','6-60202','Bensin, Tol dan Parkir - Umum','D','debit','kredit',NULL,'1',1,1),(182,'6-60200','6-60203','Perbaikan & Pemeliharaan','D','debit','kredit',NULL,'1',1,0),(183,'6-60200','6-60204','Perjalanan Dinas - Umum','D','debit','kredit',NULL,'1',1,0),(184,'6-60200','6-60205','Admin Bank','D','debit','kredit',NULL,'1',1,0),(185,'6-60200','6-60206','Komunikasi - Umum','D','debit','kredit',NULL,'1',1,1),(186,'6-60200','6-60207','Luaran & Langganan','D','debit','kredit',NULL,'1',1,1),(187,'6-60200','6-60208','Biaya Asuransi','D','debit','kredit',NULL,'1',1,0),(188,'6-60200','6-60209','Legal & Profesional','D','debit','kredit',NULL,'1',1,0),(189,'6-60200','6-60210','Beban Manfaat Karyawan','D','debit','kredit',NULL,'1',1,0),(190,'6-60200','6-60211','Sarana Kantor','D','debit','kredit',NULL,'1',1,0),(191,'6-60200','6-60212','Pelatihan & Pengembangan','D','debit','kredit',NULL,'1',1,0),(192,'6-60200','6-60213','Beban Piutang Tak Tertagih','D','debit','kredit',NULL,'1',1,0),(193,'6-60200','6-60214','Pajak & Perizinan','D','debit','kredit',NULL,'1',1,0),(194,'6-60200','6-60215','Denda','D','debit','kredit',NULL,'1',1,0),(195,'6-60200','6-60216','Pengeluaran Barang Rusak','D','debit','kredit',NULL,'1',1,0),(196,'6-60200','6-60217','Biaya Komisi','D','debit','kredit',NULL,'1',1,0),(197,'6-60300','','Beban Kantor','H','debit','kredit',NULL,'1',1,0),(198,'6-60300','6-60301','Alat Tulis Kantor & Printing','D','debit','kredit',NULL,'1',1,0),(199,'6-60300','6-60302','Bea Materai','D','debit','kredit',NULL,'1',1,0),(200,'6-60300','6-60303','Keamanan dan Kebersihan','D','debit','kredit',NULL,'1',1,0),(201,'6-60300','6-60304','Supplies & Material','D','debit','kredit',NULL,'1',1,0),(202,'6-60400','','Biaya Sewa - Bangunan','H','debit','kredit',NULL,'1',1,1),(203,'6-60400','6-60401','Biaya Sewa - Kendaraan','D','debit','kredit',NULL,'1',1,1),(204,'6-60400','6-60402','Biaya Sewa - Operasional','D','debit','kredit',NULL,'1',1,1),(205,'6-60400','6-60403','Biaya Sewa - Lain - lain','D','debit','kredit',NULL,'1',1,1),(206,'6-60500','','Penyusutan - Bangunan','H','debit','Kredit',NULL,'1',0,1),(207,'6-60500','6-60501','Penyusutan - Perbaikan Bangunan','D','debit','Kredit',NULL,'1',0,1),(208,'6-60500','6-60502','Penyusutan - Kendaraan','D','debit','Kredit',NULL,'1',0,1),(209,'6-60500','6-60503','Penyusutan - Mesin & Peralatan','D','debit','Kredit',NULL,'1',1,1),(210,'6-60500','6-60504','Penyusutan - Peralatan Kantor','D','debit','Kredit',NULL,'1',1,1),(211,'6-60500','6-60599','Penyusutan - Aset Sewa Guna Usaha','D','debit','Kredit',NULL,'1',1,1),(212,'7-70000','','Pendapatan Bunga - Bank','H','Kredit','debit',NULL,'1',1,1),(213,'7-70000','7-70001','Pendapatan Bunga - Deposito','D','kredit','debit',NULL,'1',1,1),(214,'7-70000','7-70099','Pendapatan Lain - lain','D','kredit','debit',NULL,'1',1,1),(215,'8-80000','','Beban Bunga','H','kredit','debit',NULL,'1',1,1),(216,'8-80000','8-80001','Provisi','D','debit','kredit',NULL,'1',0,1),(217,'8-80000','8-80002','(Laba)/Rugi Pelepasan Aset Tetap','D','debit','kredit',NULL,'1',0,1),(218,'8-80100','','Penyesuaian Persediaan','H','kredit','debit',NULL,'1',0,1),(219,'8-80200','','Beban Lain - lain','H','kredit','debit',NULL,'1',1,1),(220,'9-90000','','Beban Pajak - Kini','H','debit','kredit',NULL,'1',1,1),(221,'9-90000','9-90001','Beban Pajak - Tangguhan','D','debit','kredit',NULL,'1',1,1),(222,'9-90000','9-90002','Revaluasi Bank','D','debit','kredit',NULL,'1',0,1),(223,'9-90000','9-90003','(Laba)/Rugi Selisih Kurs - Belum Direalisasikan','D','debit','kredit',NULL,'1',0,1),(224,'9-90000','9-90004','(Laba)/Rugi Selisih Kurs - Realisasikan','D','debit','kredit',NULL,'1',0,1),(225,'1-10200','1-10201','Persediaan Bahan Baku','D','debit','kredit',NULL,'1',0,1),(226,'8-80101','','Penyesuaian Persediaan Bahan','H','kredit','debit',NULL,'1',0,1),(227,'4-40100','4-40101','Potongan Produk Penjualan','D','debit','kredit',NULL,'1',1,1),(228,'5-50100','5-50101','Potongan Produk Pembelian','D','kredit','debit',NULL,'1',1,1),(229,'6-60000','6-60004','Biaya Listrik','D','debit','kredit',NULL,'1',0,1),(230,'6-60000','6-60005','Biaya PDAM/Air','D','debit','kredit',NULL,'1',0,1),(231,'6-60000','6-60006','Biaya Jaringan','D','debit','kredit',NULL,'1',0,1),(232,'6-60000','6-60007','Transportasi','D','debit','kredit',NULL,'1',0,1),(233,'2-20000','2-20101','Utang Aset','D','kredit','debit',NULL,'1',1,1);

/*Table structure for table `djurnal` */

DROP TABLE IF EXISTS `djurnal`;

CREATE TABLE `djurnal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_jurnal` int(11) unsigned DEFAULT NULL,
  `id_akun` int(11) DEFAULT NULL,
  `jml_debit` double(20,2) DEFAULT 0.00,
  `jml_kredit` double(20,2) DEFAULT 0.00,
  `last_user` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jurnal` (`id_jurnal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `djurnal` */

/*Table structure for table `djurnal_tmp` */

DROP TABLE IF EXISTS `djurnal_tmp`;

CREATE TABLE `djurnal_tmp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_jurnal` int(11) unsigned DEFAULT NULL,
  `id_akun` int(11) DEFAULT NULL,
  `jml_debit` double(20,2) DEFAULT 0.00,
  `jml_kredit` double(20,2) DEFAULT 0.00,
  `last_user` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jurnal` (`id_jurnal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `djurnal_tmp` */

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`description`) values (1,'Super Admin','Super Admin'),(2,'Admin','Admin'),(3,'Keuangan','Keuangan');

/*Table structure for table `jurnal` */

DROP TABLE IF EXISTS `jurnal`;

CREATE TABLE `jurnal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_ref` varchar(30) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `last_user` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jurnal` */

/*Table structure for table `kode_akun` */

DROP TABLE IF EXISTS `kode_akun`;

CREATE TABLE `kode_akun` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_fk` int(11) DEFAULT NULL,
  `tabel_fk` varchar(50) DEFAULT NULL,
  `kd_header` varchar(10) DEFAULT NULL,
  `kd_akun` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tipe` varchar(1) DEFAULT NULL COMMENT '1=header,2=sub,3=detail',
  `status` int(1) DEFAULT NULL,
  `debit` double(15,2) DEFAULT 0.00,
  `kredit` double(15,2) DEFAULT 0.00,
  `posting` int(1) DEFAULT 0,
  `last_user` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

/*Data for the table `kode_akun` */

insert  into `kode_akun`(`id`,`id_fk`,`tabel_fk`,`kd_header`,`kd_akun`,`nama`,`tipe`,`status`,`debit`,`kredit`,`posting`,`last_user`,`last_update`) values (1,NULL,NULL,'1-10000','','Kas / Bank','H',1,0.00,0.00,0,1,NULL),(2,NULL,NULL,'1-10000','1-10001','Kas Besar','D',1,0.00,0.00,0,1,NULL),(3,NULL,NULL,'1-10000','1-10002','Kas Kecil','D',1,0.00,0.00,0,1,NULL),(4,NULL,NULL,'1-10100','','Piutang Usaha','H',1,0.00,0.00,0,1,NULL),(5,NULL,NULL,'1-10200','','Persediaan Properti','H',1,0.00,0.00,0,1,NULL),(6,NULL,NULL,'1-10300','','Piutang Lainnya','H',1,0.00,0.00,0,1,NULL),(7,NULL,NULL,'1-10300','1-10301','Puitang Karyawan','D',1,0.00,0.00,0,1,NULL),(8,NULL,NULL,'1-10401','','Aset lancar Lainnya','H',1,0.00,0.00,0,1,NULL),(9,NULL,NULL,'1-10401','1-10402','Biaya Dibayar Dimuka','D',1,0.00,0.00,0,1,NULL),(10,NULL,NULL,'1-10500','','PPN Masukan','H',1,0.00,0.00,0,1,NULL),(11,NULL,NULL,'1-10700','','Aset Tetap','H',1,0.00,0.00,0,1,NULL),(12,NULL,NULL,'1-10700','1-10701','Tanah','D',1,0.00,0.00,0,1,NULL),(13,NULL,NULL,'1-10700','1-10702','Bangunan','D',1,0.00,0.00,0,1,NULL),(14,NULL,NULL,'1-10700','1-10703','Kendaraan','D',1,0.00,0.00,0,1,NULL),(15,NULL,NULL,'1-10700','1-10704','Mesin & Peralatan','D',1,0.00,0.00,0,1,NULL),(16,NULL,NULL,'1-10700','1-10705','Peralatan Kantor','D',1,0.00,0.00,0,1,NULL),(17,NULL,NULL,'1-10700','1-10706','Aset Lainnya','D',1,0.00,0.00,0,1,NULL),(18,NULL,NULL,'1-10750','1-10751','Akumulasi Peny. Bangunan','D',1,0.00,0.00,0,1,NULL),(19,NULL,NULL,'1-10750','1-10752','Akumulasi Peny. Kendaraan','D',1,0.00,0.00,0,1,NULL),(20,NULL,NULL,'1-10750','1-10753','Akumulasi Peny. Mesin & Peralatan','D',1,0.00,0.00,0,1,NULL),(21,NULL,NULL,'1-10750','1-10754','Akumulasi Peny. Peralatan Kantor','D',1,0.00,0.00,0,1,NULL),(22,NULL,NULL,'2-20000','','Kewajiban Jangka Pendek','H',1,0.00,0.00,0,1,NULL),(23,NULL,NULL,'2-20000','2-20100','Utang Usaha','D',1,0.00,0.00,0,1,NULL),(24,NULL,NULL,'2-20000','2-20101','Utang Aset','D',1,0.00,0.00,0,1,NULL),(25,NULL,NULL,'2-20200','','Utang Lainnya','H',1,0.00,0.00,0,1,NULL),(26,NULL,NULL,'2-20200','2-20201','Utang Gaji','D',1,0.00,0.00,0,1,NULL),(27,NULL,NULL,'2-20200','2-20202','Utang Deviden','D',1,0.00,0.00,0,1,NULL),(28,NULL,NULL,'2-20200','2-20203','Pendapatan Diterima Dimuka','D',1,0.00,0.00,0,1,NULL),(29,NULL,NULL,'2-20200','2-20399','Utang Biaya','D',1,0.00,0.00,0,1,NULL),(30,NULL,NULL,'2-20400','','Kewajiban Jangka Panjang','H',1,0.00,0.00,0,1,NULL),(31,NULL,NULL,'2-20400','2-20401','Utang Bank','D',1,0.00,0.00,0,1,NULL),(32,NULL,NULL,'2-20500','','PPN Keluaran','H',1,0.00,0.00,0,1,NULL),(33,NULL,NULL,'2-20500','2-20501','Utang Pajak','D',1,0.00,0.00,0,1,NULL),(34,NULL,NULL,'2-20500','2-20502','Utang Pemegang Saham','D',1,0.00,0.00,0,1,NULL),(35,NULL,NULL,'3-30000','','Modal','H',1,0.00,0.00,0,1,NULL),(36,NULL,NULL,'3-30000','3-30001','Modal Pemilik','D',1,0.00,0.00,0,1,NULL),(37,NULL,NULL,'3-30000','3-30002','Tambahan Modal Disetor','D',1,0.00,0.00,0,1,NULL),(38,NULL,NULL,'3-30000','3-30003','Laba Tahun Ini','D',1,0.00,0.00,0,1,NULL),(39,NULL,NULL,'3-30000','3-30004','Laba Ditahan','D',1,0.00,0.00,0,1,NULL),(40,NULL,NULL,'3-30000','3-30005','Deviden','D',1,0.00,0.00,0,1,NULL),(41,NULL,NULL,'3-30000','3-30999','Ekuitas Saldo Awal','D',1,0.00,0.00,0,1,NULL),(42,NULL,NULL,'4-40000','','Penjualan','H',1,0.00,0.00,0,1,NULL),(43,NULL,NULL,'4-40100','','Potongan Penjualan','H',1,0.00,0.00,0,1,NULL),(44,NULL,NULL,'4-40200','','Retur Penjualan','H',1,0.00,0.00,0,1,NULL),(45,NULL,NULL,'5-50000','','Beban Pokok Penjualan','H',1,0.00,0.00,0,1,NULL),(46,NULL,NULL,'5-50100','','Potongan Pembelian','H',1,0.00,0.00,0,1,NULL),(47,NULL,NULL,'5-50200','','Retur Pembelian','H',1,0.00,0.00,0,1,NULL),(48,NULL,NULL,'5-50300','','Biaya Pengiriman','H',1,0.00,0.00,0,1,NULL),(49,NULL,NULL,'5-50500','','Biaya Produksi','H',1,0.00,0.00,0,1,NULL),(50,NULL,NULL,'6-60000','','Biaya Penjualan','H',1,0.00,0.00,0,1,NULL),(51,NULL,NULL,'6-60000','6-60001','Iklan & Promosi','D',1,0.00,0.00,0,1,NULL),(52,NULL,NULL,'6-60000','6-60002','Marketing Lainnya','D',1,0.00,0.00,0,1,NULL),(53,NULL,NULL,'6-60100','','Biaya Umum & Administrasi','H',1,0.00,0.00,0,1,NULL),(54,NULL,NULL,'6-60100','6-60101','Gaji','D',1,0.00,0.00,0,1,NULL),(55,NULL,NULL,'6-60100','6-60102','Upah','D',1,0.00,0.00,0,1,NULL),(56,NULL,NULL,'6-60100','6-60103','Makanan & Transportasi','D',1,0.00,0.00,0,1,NULL),(57,NULL,NULL,'6-60100','6-60104','Lembur','D',1,0.00,0.00,0,1,NULL),(58,NULL,NULL,'6-60100','6-60105','Pengobatan','D',1,0.00,0.00,0,1,NULL),(59,NULL,NULL,'6-60100','6-60106','THR & Bonus','D',1,0.00,0.00,0,1,NULL),(60,NULL,NULL,'6-60100','6-60107','Jamsostek','D',1,0.00,0.00,0,1,NULL),(61,NULL,NULL,'6-60100','6-60108','Intensif','D',1,0.00,0.00,0,1,NULL),(62,NULL,NULL,'6-60100','6-60109','Pesangon','D',1,0.00,0.00,0,1,NULL),(63,NULL,NULL,'6-60100','6-60110','Manfaat dan Tunjangan Lain','D',1,0.00,0.00,0,1,NULL),(64,NULL,NULL,'6-60200','','Donasi','H',1,0.00,0.00,0,1,NULL),(65,NULL,NULL,'6-60200','6-60201','Hiburan','D',1,0.00,0.00,0,1,NULL),(66,NULL,NULL,'6-60200','6-60202','Bensin, Tol dan Parkir - Umum','D',1,0.00,0.00,0,1,NULL),(67,NULL,NULL,'6-60200','6-60203','Perbaikan & Pemeliharaan','D',1,0.00,0.00,0,1,NULL),(68,NULL,NULL,'6-60200','6-60204','Perjalanan Dinas - Umum','D',1,0.00,0.00,0,1,NULL),(69,NULL,NULL,'6-60200','6-60205','Admin Bank','D',1,0.00,0.00,0,1,NULL),(70,NULL,NULL,'6-60200','6-60206','Komunikasi - Umum','D',1,0.00,0.00,0,1,NULL),(71,NULL,NULL,'6-60200','6-60207','Luaran & Langganan','D',1,0.00,0.00,0,1,NULL),(72,NULL,NULL,'6-60200','6-60208','Biaya Asuransi','D',1,0.00,0.00,0,1,NULL),(73,NULL,NULL,'6-60200','6-60209','Legal & Profesional','D',1,0.00,0.00,0,1,NULL),(74,NULL,NULL,'6-60200','6-60210','Beban Manfaat Karyawan','D',1,0.00,0.00,0,1,NULL),(75,NULL,NULL,'6-60200','6-60211','Sarana Kantor','D',1,0.00,0.00,0,1,NULL),(76,NULL,NULL,'6-60200','6-60212','Pelatihan & Pengembangan','D',1,0.00,0.00,0,1,NULL),(77,NULL,NULL,'6-60200','6-60213','Beban Piutang Tak Tertagih','D',1,0.00,0.00,0,1,NULL),(78,NULL,NULL,'6-60200','6-60214','Pajak & Perizinan','D',1,0.00,0.00,0,1,NULL),(79,NULL,NULL,'6-60200','6-60215','Denda','D',1,0.00,0.00,0,1,NULL),(80,NULL,NULL,'6-60200','6-60216','Pengeluaran Barang Rusak','D',1,0.00,0.00,0,1,NULL),(81,NULL,NULL,'6-60200','6-60217','Biaya Komisi','D',1,0.00,0.00,0,1,NULL),(82,NULL,NULL,'6-60300','','Beban Kantor','H',1,0.00,0.00,0,1,NULL),(83,NULL,NULL,'6-60300','6-60301','Alat Tulis Kantor & Printing','D',1,0.00,0.00,0,1,NULL),(84,NULL,NULL,'6-60300','6-60302','Bea Materai','D',1,0.00,0.00,0,1,NULL),(85,NULL,NULL,'6-60300','6-60303','Keamanan dan Kebersihan','D',1,0.00,0.00,0,1,NULL),(86,NULL,NULL,'6-60300','6-60304','Supplies & Material','D',1,0.00,0.00,0,1,NULL),(87,NULL,NULL,'6-60400','','Biaya Sewa - Bangunan','H',1,0.00,0.00,0,1,NULL),(88,NULL,NULL,'6-60400','6-60401','Biaya Sewa - Kendaraan','D',1,0.00,0.00,0,1,NULL),(89,NULL,NULL,'6-60400','6-60402','Biaya Sewa - Operasional','D',1,0.00,0.00,0,1,NULL),(90,NULL,NULL,'6-60400','6-60403','Biaya Sewa - Lain - lain','D',1,0.00,0.00,0,1,NULL),(91,NULL,NULL,'6-60500','','Penyusutan - Bangunan','H',1,0.00,0.00,0,1,NULL),(92,NULL,NULL,'6-60500','6-60501','Penyusutan - Perbaikan Bangunan','D',1,0.00,0.00,0,1,NULL),(93,NULL,NULL,'6-60500','6-60502','Penyusutan - Kendaraan','D',1,0.00,0.00,0,1,NULL),(94,NULL,NULL,'6-60500','6-60503','Penyusutan - Mesin & Peralatan','D',1,0.00,0.00,0,1,NULL),(95,NULL,NULL,'6-60500','6-60504','Penyusutan - Peralatan Kantor','D',1,0.00,0.00,0,1,NULL),(96,NULL,NULL,'6-60500','6-60599','Penyusutan - Aset Sewa Guna Usaha','D',1,0.00,0.00,0,1,NULL),(97,NULL,NULL,'7-70000','','Pendapatan Bunga - Bank','H',1,0.00,0.00,0,1,NULL),(98,NULL,NULL,'7-70000','7-70001','Pendapatan Bunga - Deposito','D',1,0.00,0.00,0,1,NULL),(99,NULL,NULL,'7-70000','7-70099','Pendapatan Lain - lain','D',1,0.00,0.00,0,1,NULL),(100,NULL,NULL,'8-80000','','Beban Bunga','H',1,0.00,0.00,0,1,NULL),(101,NULL,NULL,'8-80000','8-80001','Provisi','D',1,0.00,0.00,0,1,NULL),(102,NULL,NULL,'8-80000','8-80002','(Laba)/Rugi Pelepasan Aset Tetap','D',1,0.00,0.00,0,1,NULL),(104,NULL,NULL,'8-80100','','Penyesuaian Persediaan','H',1,0.00,0.00,0,1,NULL),(105,NULL,NULL,'8-80200','','Beban Lain - lain','H',1,0.00,0.00,0,1,NULL),(106,NULL,NULL,'9-90000','','Beban Pajak - Kini','H',1,0.00,0.00,0,1,NULL),(107,NULL,NULL,'9-90000','9-90001','Beban Pajak - Tangguhan','D',1,0.00,0.00,0,1,NULL),(108,NULL,NULL,'9-90000','9-90002','Revaluasi Bank','D',1,0.00,0.00,0,1,NULL),(109,NULL,NULL,'9-90000','9-90003','(Laba)/Rugi Selisih Kurs - Belum Direalisasikan','D',1,0.00,0.00,0,1,NULL),(110,NULL,NULL,'9-90000','9-90004','(Laba)/Rugi Selisih Kurs - Realisasikan','D',1,0.00,0.00,0,1,NULL),(111,NULL,NULL,'3-30000','3-30006','Prive','D',1,0.00,0.00,0,1,NULL),(112,NULL,NULL,'6-60000','6-60004','Biaya Listrik','D',1,0.00,0.00,0,1,NULL),(113,NULL,NULL,'6-60000','6-60005','Biaya PDAM/Air','D',1,0.00,0.00,0,1,NULL),(114,NULL,NULL,'6-60000','6-60006','Biaya Jaringan','D',1,0.00,0.00,0,1,NULL),(115,NULL,NULL,'6-60000','6-60007','Transportasi','D',1,0.00,0.00,0,1,NULL);

/*Table structure for table `lap_jurnal` */

DROP TABLE IF EXISTS `lap_jurnal`;

CREATE TABLE `lap_jurnal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_project` int(11) DEFAULT NULL,
  `id_data` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `id_warehouse` int(11) DEFAULT NULL,
  `nomor` varchar(100) DEFAULT NULL,
  `transaksi` varchar(100) DEFAULT NULL,
  `ket` varchar(200) DEFAULT NULL,
  `kd_akun` varchar(20) DEFAULT NULL,
  `debit` double(15,2) DEFAULT NULL,
  `kredit` double(15,2) DEFAULT NULL,
  `last_user` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_data` (`id_data`),
  KEY `tgl` (`tgl`),
  KEY `transaksi` (`transaksi`),
  KEY `kd_akun` (`kd_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `lap_jurnal` */

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `login_attempts` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nm_menu` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `jns_url` int(1) DEFAULT 1 COMMENT '1=route,2=function',
  `parent` int(11) DEFAULT 0,
  `oto_1` int(1) DEFAULT 0 COMMENT 'Super Admin',
  `oto_2` int(11) DEFAULT 0 COMMENT 'Admin',
  `oto_3` int(11) DEFAULT 0 COMMENT 'Pengelola',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`id`,`nm_menu`,`icon`,`url`,`jns_url`,`parent`,`oto_1`,`oto_2`,`oto_3`) values (1,'Dashboard','fa fa-tachometer-alt','dashboard',1,0,1,1,1),(3,'Users','fa fa-users','users',1,0,1,0,0),(7,'Landing Page','fa fa-folder','',1,0,1,0,0),(22,'Data Slider','',NULL,1,7,1,0,0),(24,'Layanan','fa fa-shopping-cart','',1,0,1,0,0),(25,'Produk',NULL,'data_produk',1,24,1,0,0),(26,'Servis',NULL,'data_servis',1,24,1,0,0);

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jns` enum('Produk','Layanan') DEFAULT NULL,
  `nama` varchar(500) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `manfaat` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `produk` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `pass_text` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  `last_user` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`pass_text`,`first_name`,`last_name`,`address`,`email`,`phone`,`active`,`activation_selector`,`activation_code`,`forgotten_password_selector`,`forgotten_password_code`,`forgotten_password_time`,`remember_selector`,`remember_code`,`created_on`,`last_login`,`fid`,`last_user`,`last_update`) values (1,'127.0.0.1','admin','$2y$10$f48rq7XbfJlWa/9v8w8JkuiSKsKsliUXMHJc7Ypdyv13ECvvzZF3u','password','Administrator','',NULL,'administrator@mail.com','',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1632571764,NULL,1,'2021-09-23 12:05:16'),(9,'127.0.0.1','test@gmail.com','$2y$10$CVwJCoNs4CWF8yj1mYvQJ.dcfru5Yklj3u40qv1PG9BMiK9he4cru','password','testing','admin',NULL,'test@gmail.com','0812345789',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1632369375,NULL,2,1,'2021-09-23 11:56:15'),(10,'127.0.0.1','test2@gmail.com','$2y$10$NV0lwa3PoeNmdTqyC/hU5ecO76O8iYx1IqmNL.wvbXGN6nx3tx7jq','password','Testing','keuangan2',NULL,'test2@gmail.com','08123456789',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1632369588,NULL,10,1,'2021-09-23 12:04:51');

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `users_groups` */

insert  into `users_groups`(`id`,`user_id`,`group_id`) values (1,1,1),(9,9,2),(10,10,3);

/* Trigger structure for table `djurnal` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `ins_djur` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `ins_djur` AFTER INSERT ON `djurnal` FOR EACH ROW INSERT INTO lap_jurnal
 (id_project,id_data,tgl,nomor,transaksi,ket,kd_akun,debit,kredit,last_user,last_update)
     
     
SELECT * FROM (
  
  SELECT proyek,NEW.id_jurnal as id_data,tgl,nomor,'Jurnal Umum' as transaksi,ket,kd_akun,debit,kredit,last_user,last_update FROM (
  
           SELECT c.proyek,c.tgl,c.no_ref as nomor,c.ket,if(b.tipe='D',b.kd_akun,b.kd_header) as kd_akun,
                  a.jml_debit as debit,
                  a.jml_kredit as kredit,
                  a.last_user,a.last_update        
           FROM djurnal a
           LEFT JOIN kode_akun b on a.id_akun=b.id
           LEFT JOIN jurnal c on a.id_jurnal=c.id
           WHERE a.id=NEW.id
           
    )z order by kd_akun
         
        
)z */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
