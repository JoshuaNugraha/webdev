# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: booblestudio.com (MySQL 5.5.5-10.3.30-MariaDB-cll-lve)
# Database: u1507805_ptk
# Generation Time: 2021-12-02 06:32:35 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `description`)
VALUES
	(1,'Admin','Admin'),
	(2,'Mahasiswa','Mahasiswa'),
	(4,'Ketua Program Stdy','Ketua Program Stdy'),
	(5,'Loket / Operator','Loket / Operator Setiap Prodi'),
	(6,'Dosen','Dosen'),
	(7,'Pimpian','Pimpinan');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jadwal_ujian
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jadwal_ujian`;

CREATE TABLE `jadwal_ujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_ujian` varchar(255) DEFAULT NULL,
  `persyaratan` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `alasan_tolak` text DEFAULT NULL,
  `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_judul` int(11) DEFAULT NULL,
  `nilai_pembimbing1` varchar(11) DEFAULT NULL,
  `nilai_pembimbing2` varchar(11) DEFAULT NULL,
  `nilai_penguji1` varchar(11) DEFAULT NULL,
  `nilai_penguji2` varchar(11) DEFAULT NULL,
  `nilai_penguji3` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idjudul` (`id_judul`),
  CONSTRAINT `idjudul` FOREIGN KEY (`id_judul`) REFERENCES `tbl_data_judul` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `jadwal_ujian` WRITE;
/*!40000 ALTER TABLE `jadwal_ujian` DISABLE KEYS */;

INSERT INTO `jadwal_ujian` (`id`, `jenis_ujian`, `persyaratan`, `tanggal`, `status`, `alasan_tolak`, `last_update`, `id_judul`, `nilai_pembimbing1`, `nilai_pembimbing2`, `nilai_penguji1`, `nilai_penguji2`, `nilai_penguji3`)
VALUES
	(1,'Seminar Proposal','1_1636281128.pdf','2021-11-07',3,NULL,'2021-11-08 02:20:42',1,'1-80','1-85','1-85','1-85','1-90'),
	(2,'Seminar Hasil','2_1636299307.pdf','2021-11-08',3,'saa=dasdasdasd','2021-11-08 02:21:06',1,NULL,NULL,NULL,NULL,NULL),
	(3,'Ujian Tutup','3_1636281973.pdf','2021-11-09',3,NULL,'2021-11-08 02:21:41',1,NULL,NULL,NULL,NULL,NULL),
	(5,'Seminar Proposal','5_1636312147.pdf','2021-11-10',3,NULL,'2021-11-08 03:09:52',2,NULL,NULL,NULL,NULL,NULL),
	(6,'Seminar Hasil','6_1636312153.pdf','2021-11-12',3,NULL,'2021-11-08 03:10:07',2,NULL,NULL,NULL,NULL,NULL),
	(7,'Ujian Tutup','7_1636312159.pdf','2021-11-23',3,NULL,'2021-11-23 16:08:37',2,NULL,NULL,NULL,NULL,NULL),
	(8,'Pendaftaran Prelium','8_1637251826.pdf','2021-11-23',3,'asdmnaksdasda','2021-11-19 00:10:53',3,NULL,NULL,NULL,NULL,NULL),
	(9,'Gagasan Awal',NULL,NULL,0,NULL,'2021-11-18 23:19:25',3,NULL,NULL,NULL,NULL,NULL),
	(10,'Seminar Proposal',NULL,NULL,0,NULL,'2021-11-18 23:19:25',3,NULL,NULL,NULL,NULL,NULL),
	(11,'Seminar Hasil',NULL,NULL,0,NULL,'2021-11-18 23:19:25',3,NULL,NULL,NULL,NULL,NULL),
	(12,'Ujian Tutup',NULL,NULL,0,NULL,'2021-11-18 23:19:25',3,NULL,NULL,NULL,NULL,NULL),
	(13,'Promosi',NULL,NULL,0,NULL,'2021-11-18 23:19:25',3,NULL,NULL,NULL,NULL,NULL),
	(14,'Seminar Proposal','14_1637828573.pdf','2021-11-26',3,'asdaskjdaasdasda','2021-11-25 15:34:47',4,'1-90',NULL,NULL,NULL,NULL),
	(15,'Seminar Hasil',NULL,NULL,0,NULL,'2021-11-25 15:16:10',4,NULL,NULL,NULL,NULL,NULL),
	(16,'Ujian Tutup',NULL,NULL,0,NULL,'2021-11-25 15:16:10',4,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `jadwal_ujian` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table login_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table mahasiswa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` enum('S2','S3') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nohp` varchar(30) DEFAULT NULL,
  `np` varchar(30) DEFAULT NULL,
  `prodi` int(11) DEFAULT NULL,
  `kekhususan` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_user` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `mahasiswa` WRITE;
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;

INSERT INTO `mahasiswa` (`id`, `jenis`, `nama`, `email`, `nohp`, `np`, `prodi`, `kekhususan`, `created_at`, `last_update`, `last_user`, `created_by`)
VALUES
	(1,'S2','Yusril Asrul','yusril24102001@gmail.com','089580056642','1200011',4,'Teknik Komputer','2021-11-07 11:15:43','2021-11-07 11:22:56',1,1),
	(2,'S2','Abiyyah Raihaanah','abiyyah@gmail.com','081212121212','1200012',4,'Teknik Komputer','2021-11-07 11:16:46','2021-11-07 11:22:44',1,1),
	(3,'S3','testing mhs s3 001','tests3001@gmail.com','08123000001','7371001',1,'Psikis','2021-11-17 18:36:40','2021-11-17 18:36:40',1,1),
	(4,'S2','Ahmad Muflih','muflih@gmail.com','089123123123','878788878',6,'Pendidikan Teknik Informatika ','2021-11-25 15:09:25','2021-11-25 15:09:25',1,1);

/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menu
# ------------------------------------------------------------

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
  `oto_4` int(11) DEFAULT 0,
  `oto_5` int(11) DEFAULT 0,
  `oto_6` int(11) DEFAULT 0,
  `oto_7` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;

INSERT INTO `menu` (`id`, `nm_menu`, `icon`, `url`, `jns_url`, `parent`, `oto_1`, `oto_2`, `oto_3`, `oto_4`, `oto_5`, `oto_6`, `oto_7`)
VALUES
	(1,'Dashboard','fa fa-tachometer-alt','dashboard',1,0,1,0,0,0,0,0,0),
	(3,'Users','','users',1,4,1,0,0,0,0,0,0),
	(4,'Master','fa fa-folder','',1,0,1,0,0,0,0,0,0),
	(5,'Informasi','fa fa-info-circle','',1,0,1,1,0,1,1,1,0),
	(6,'Laporan','fa fa-file',NULL,1,0,1,0,0,1,1,1,0),
	(7,'Verifikasi','fa fa-check','verifikasi-judul-mahasiswa',1,0,0,0,0,1,0,0,0),
	(8,'Input','fa fa-edit','',1,0,0,1,0,1,0,1,0),
	(37,'Program Studi',NULL,'master-prodi',1,4,1,0,0,0,0,0,0),
	(38,'Data Ketua Prodi',NULL,'master-ketua-prodi',1,4,1,0,0,0,0,0,0),
	(39,'Loket / Operator',NULL,'master-loket',1,4,1,0,0,0,0,0,0),
	(41,'Mahasiswa S2',NULL,'master-mahasiswa?key=2',1,4,1,0,0,0,0,0,0),
	(42,'Mahasiswa S3',NULL,'master-mahasiswa?key=3',1,4,1,0,0,0,0,0,0),
	(44,'Jdwl Seminar Semua Prodi',NULL,'jadwal-seminar-semua-prodi',1,5,1,1,0,1,1,1,0),
	(45,'Jdwl Seminar Sendiri',NULL,'jadwal-seminar-sendiri',1,5,0,1,0,0,0,0,0),
	(46,'Nilai Seminar',NULL,'nilai-seminar',1,5,0,1,0,0,0,0,0),
	(47,'Judul Yang Diterima',NULL,'judul-yg-diterima',1,5,0,1,0,0,0,0,0),
	(48,'Judul Yang Ditawarkan',NULL,'judul-yang-ditawarkan',1,8,1,1,0,0,0,0,0),
	(49,'Persyaratan Mengikuti Ujian',NULL,'persyaratan-ujian',1,8,1,1,0,0,0,0,0),
	(50,'Dosen',NULL,'master-dosen',1,4,1,0,0,0,0,0,0),
	(52,'Persuratan','fa fa-list','',1,0,1,0,0,0,1,0,0),
	(53,'Pendaftaran Seminar','fa fa-users','',1,0,1,0,0,0,1,0,0),
	(54,'Pendaftaran S2',NULL,'pendaftaran-seminar?s=2',1,53,1,0,0,0,1,0,0),
	(55,'Pendaftaran S3',NULL,'pendaftaran-seminar?s=3',1,53,1,0,0,0,1,0,0),
	(56,'Input Nilai Seminar',NULL,'input-nilai-seminar',1,8,1,0,0,1,0,1,0),
	(57,'Laporan Rekap Nilai Setiap Mahasiswa',NULL,'rekap-nilai-mahasiswa',1,6,1,0,0,1,1,1,0),
	(58,'Persyaratan Ujian',NULL,'master-persyaratan-ujian',1,4,1,0,0,0,0,0,0);

/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pengaturan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pengaturan`;

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `login_banner` varchar(255) DEFAULT NULL,
  `seminar_proposal_s2` varchar(255) DEFAULT NULL,
  `seminar_hasil_s2` varchar(255) DEFAULT NULL,
  `ujian_tutup_s2` varchar(255) DEFAULT NULL,
  `pendaftaran_prelium` varchar(255) DEFAULT NULL,
  `gagasan_awal` varchar(255) DEFAULT NULL,
  `seminar_proposal` varchar(255) DEFAULT NULL,
  `seminar_hasil` varchar(255) DEFAULT NULL,
  `ujian_tutup` varchar(255) DEFAULT NULL,
  `promosi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pengaturan` WRITE;
/*!40000 ALTER TABLE `pengaturan` DISABLE KEYS */;

INSERT INTO `pengaturan` (`id`, `app_name`, `logo`, `favicon`, `keterangan`, `login_banner`, `seminar_proposal_s2`, `seminar_hasil_s2`, `ujian_tutup_s2`, `pendaftaran_prelium`, `gagasan_awal`, `seminar_proposal`, `seminar_hasil`, `ujian_tutup`, `promosi`)
VALUES
	(1,'PTK UNM','logo.jpg','logo.png','Pendaftaran Seminar','medicine-capsules.jpg','SEMINAR_PROPOSAL_S2_1637246273.pdf','SEMINAR_HASIL_S2_1637246521.pdf','UJIAN_TUTUP_S2_1637246528.pdf','PENDAFTARAN_PRELIUM_1637247142.jpg','GAGASAN_AWAL_1637247083.pdf','SEMINAR_PROPOSAL_1637247190.png','SEMINAR_HASIL_1637247095.pdf','UJIAN_TUTUP_1637247106.pdf','PROMOSI_1637247115.pdf');

/*!40000 ALTER TABLE `pengaturan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_data_judul
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_data_judul`;

CREATE TABLE `tbl_data_judul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul1` varchar(500) DEFAULT NULL,
  `keterangan1` text DEFAULT NULL,
  `judul2` varchar(500) DEFAULT NULL,
  `keterangan2` text DEFAULT NULL,
  `judul3` varchar(500) DEFAULT NULL,
  `keterangan3` text DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0 pengajuan, 1 ditolak, 2 verifikasi, 3 selesai',
  `tgl_verifikasi` date DEFAULT NULL,
  `persyaratan` varchar(100) DEFAULT NULL,
  `judul` varchar(500) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `diajukan_oleh` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pembimbing1` int(11) DEFAULT NULL COMMENT 'dosen',
  `pembimbing2` int(11) DEFAULT NULL COMMENT 'dosen',
  `penguji1` int(11) DEFAULT NULL COMMENT 'dosen',
  `penguji2` int(11) DEFAULT NULL COMMENT 'dosen',
  `penguji3` int(11) DEFAULT NULL,
  `alasan_tolak` text DEFAULT NULL,
  `alasan_tolak_persyaratan` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengaju` (`diajukan_oleh`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_data_judul` WRITE;
/*!40000 ALTER TABLE `tbl_data_judul` DISABLE KEYS */;

INSERT INTO `tbl_data_judul` (`id`, `judul1`, `keterangan1`, `judul2`, `keterangan2`, `judul3`, `keterangan3`, `status`, `tgl_verifikasi`, `persyaratan`, `judul`, `keterangan`, `diajukan_oleh`, `created_by`, `last_user`, `created_at`, `last_update`, `pembimbing1`, `pembimbing2`, `penguji1`, `penguji2`, `penguji3`, `alasan_tolak`, `alasan_tolak_persyaratan`)
VALUES
	(1,'Ini Judul Seminar 1','<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates placeat sunt accusamus ipsam harum consequuntur adipisci doloremque, quibusdam esse saepe explicabo dolor similique id possimus reprehenderit sit sequi magni necessitatibus corporis beatae animi? Aperiam voluptatem exercitationem maxime totam! Maiores, nulla, iure! Animi quia officia qui consequatur, perferendis nisi pariatur omnis? Facere quis dolorem, eaque recusandae consectetur repudiandae repellat ea eos similique? Alias beatae eum veritatis dolore minima voluptatem saepe, quasi aliquam impedit omnis facilis voluptates consequuntur sequi ullam consectetur quos harum repellat, fuga, dolorum, vitae nostrum dolores? Quod, in velit ea nulla quisquam eligendi, voluptate, ipsa cupiditate sint ipsum, deleniti!<br></p>','Ini Judul Seminar 2','<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates placeat sunt accusamus ipsam harum consequuntur adipisci doloremque, quibusdam esse saepe explicabo dolor similique id possimus reprehenderit sit sequi magni necessitatibus corporis beatae animi? Aperiam voluptatem exercitationem maxime totam! Maiores, nulla, iure! Animi quia officia qui consequatur, perferendis nisi pariatur omnis? Facere quis dolorem, eaque recusandae consectetur repudiandae repellat ea eos similique? Alias beatae eum veritatis dolore minima voluptatem saepe, quasi aliquam impedit omnis facilis voluptates consequuntur sequi ullam consectetur quos harum repellat, fuga, dolorum, vitae nostrum dolores? Quod, in velit ea nulla quisquam eligendi, voluptate, ipsa cupiditate sint ipsum, deleniti!<br></p>','Ini Judul seminar 3','<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates placeat sunt accusamus ipsam harum consequuntur adipisci doloremque, quibusdam esse saepe explicabo dolor similique id possimus reprehenderit sit sequi magni necessitatibus corporis beatae animi? Aperiam voluptatem exercitationem maxime totam! Maiores, nulla, iure! Animi quia officia qui consequatur, perferendis nisi pariatur omnis? Facere quis dolorem, eaque recusandae consectetur repudiandae repellat ea eos similique? Alias beatae eum veritatis dolore minima voluptatem saepe, quasi aliquam impedit omnis facilis voluptates consequuntur sequi ullam consectetur quos harum repellat, fuga, dolorum, vitae nostrum dolores? Quod, in velit ea nulla quisquam eligendi, voluptate, ipsa cupiditate sint ipsum, deleniti!<br></p>',2,NULL,NULL,'Ini Judul Seminar 1','<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates placeat sunt accusamus ipsam harum consequuntur adipisci doloremque, quibusdam esse saepe explicabo dolor similique id possimus reprehenderit sit sequi magni necessitatibus corporis beatae animi? Aperiam voluptatem exercitationem maxime totam! Maiores, nulla, iure! Animi quia officia qui consequatur, perferendis nisi pariatur omnis? Facere quis dolorem, eaque recusandae consectetur repudiandae repellat ea eos similique? Alias beatae eum veritatis dolore minima voluptatem saepe, quasi aliquam impedit omnis facilis voluptates consequuntur sequi ullam consectetur quos harum repellat, fuga, dolorum, vitae nostrum dolores? Quod, in velit ea nulla quisquam eligendi, voluptate, ipsa cupiditate sint ipsum, deleniti!<br></p>',21,21,23,'2021-11-07 11:21:38','2021-11-07 16:06:09',1,2,1,2,3,NULL,NULL),
	(2,'Query Builder Class','<p>Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Pariatur nobis obcaecati aspernatur laudantium doloremque excepturi quaerat voluptate asperiores quas, repellat. Numquam, aut, quae, temporibus doloremque quis, vero quia veniam laboriosam nihil suscipit optio nisi laudantium ad porro repellendus. Molestiae iure laboriosam iste explicabo nemo cumque recusandae nihil numquam debitis voluptatum quidem, vero natus dolorem quas culpa excepturi ducimus atque nobis quasi ab quis quaerat consequatur. Laboriosam hic quidem temporibus iure blanditiis nulla quaerat itaque reprehenderit amet recusandae impedit vero, inventore pariatur quasi dolorum optio atque totam ea accusamus, officiis qui odio aliquam eius. Labore, asperiores, excepturi. Reiciendis dignissimos, laborum quo. Atque, laboriosam consectetur veniam corporis quae ad aut distinctio praesentium natus dolore nulla nesciunt tempore veritatis nobis eligendi porro velit! Suscipit magni, error exercitationem est, saepe pariatur eos quam sunt, doloribus vitae eligendi consequuntur, eaque obcaecati eum. Ut sequi dolores nulla atque est exercitationem sed tempore debitis dicta eligendi sapiente illo consequuntur excepturi, eveniet aperiam cumque ipsam itaque reiciendis, rem! Cumque totam vitae magni rem sunt earum temporibus distinctio nulla amet natus, nemo blanditiis sequi? Hic nemo quaerat mollitia officiis cumque, quia vel tempora saepe, aperiam assumenda asperiores facere, eligendi perspiciatis maxime amet eveniet? Dicta obcaecati voluptatem quae explicabo incidunt?<br></p>','Use Bootstrap’s JavaScript modal plugin to add dialogs to your site for lightboxes, user notifications, or completely custom content.','<p>Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Pariatur nobis obcaecati aspernatur laudantium doloremque excepturi quaerat voluptate asperiores quas, repellat. Numquam, aut, quae, temporibus doloremque quis, vero quia veniam laboriosam nihil suscipit optio nisi laudantium ad porro repellendus. Molestiae iure laboriosam iste explicabo nemo cumque recusandae nihil numquam debitis voluptatum quidem, vero natus dolorem quas culpa excepturi ducimus atque nobis quasi ab quis quaerat consequatur. Laboriosam hic quidem temporibus iure blanditiis nulla quaerat itaque reprehenderit amet recusandae impedit vero, inventore pariatur quasi dolorum optio atque totam ea accusamus, officiis qui odio aliquam eius. Labore, asperiores, excepturi. Reiciendis dignissimos, laborum quo. Atque, laboriosam consectetur veniam corporis quae ad aut distinctio praesentium natus dolore nulla nesciunt tempore veritatis nobis eligendi porro velit! Suscipit magni, error exercitationem est, saepe pariatur eos quam sunt, doloribus vitae eligendi consequuntur, eaque obcaecati eum. Ut sequi dolores nulla atque est exercitationem sed tempore debitis dicta eligendi sapiente illo consequuntur excepturi, eveniet aperiam cumque ipsam itaque reiciendis, rem! Cumque totam vitae magni rem sunt earum temporibus distinctio nulla amet natus, nemo blanditiis sequi? Hic nemo quaerat mollitia officiis cumque, quia vel tempora saepe, aperiam assumenda asperiores facere, eligendi perspiciatis maxime amet eveniet? Dicta obcaecati voluptatem quae explicabo incidunt?<br></p>',' How to add an ORDER BY clause using CodeIgniter\'s','<p>Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Pariatur nobis obcaecati aspernatur laudantium doloremque excepturi quaerat voluptate asperiores quas, repellat. Numquam, aut, quae, temporibus doloremque quis, vero quia veniam laboriosam nihil suscipit optio nisi laudantium ad porro repellendus. Molestiae iure laboriosam iste explicabo nemo cumque recusandae nihil numquam debitis voluptatum quidem, vero natus dolorem quas culpa excepturi ducimus atque nobis quasi ab quis quaerat consequatur. Laboriosam hic quidem temporibus iure blanditiis nulla quaerat itaque reprehenderit amet recusandae impedit vero, inventore pariatur quasi dolorum optio atque totam ea accusamus, officiis qui odio aliquam eius. Labore, asperiores, excepturi. Reiciendis dignissimos, laborum quo. Atque, laboriosam consectetur veniam corporis quae ad aut distinctio praesentium natus dolore nulla nesciunt tempore veritatis nobis eligendi porro velit! Suscipit magni, error exercitationem est, saepe pariatur eos quam sunt, doloribus vitae eligendi consequuntur, eaque obcaecati eum. Ut sequi dolores nulla atque est exercitationem sed tempore debitis dicta eligendi sapiente illo consequuntur excepturi, eveniet aperiam cumque ipsam itaque reiciendis, rem! Cumque totam vitae magni rem sunt earum temporibus distinctio nulla amet natus, nemo blanditiis sequi? Hic nemo quaerat mollitia officiis cumque, quia vel tempora saepe, aperiam assumenda asperiores facere, eligendi perspiciatis maxime amet eveniet? Dicta obcaecati voluptatem quae explicabo incidunt?<br></p>',2,NULL,NULL,'Use Bootstrap’s JavaScript modal plugin to add dialogs to your site for lightboxes, user notifications, or completely custom content.','<p>Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Pariatur nobis obcaecati aspernatur laudantium doloremque excepturi quaerat voluptate asperiores quas, repellat. Numquam, aut, quae, temporibus doloremque quis, vero quia veniam laboriosam nihil suscipit optio nisi laudantium ad porro repellendus. Molestiae iure laboriosam iste explicabo nemo cumque recusandae nihil numquam debitis voluptatum quidem, vero natus dolorem quas culpa excepturi ducimus atque nobis quasi ab quis quaerat consequatur. Laboriosam hic quidem temporibus iure blanditiis nulla quaerat itaque reprehenderit amet recusandae impedit vero, inventore pariatur quasi dolorum optio atque totam ea accusamus, officiis qui odio aliquam eius. Labore, asperiores, excepturi. Reiciendis dignissimos, laborum quo. Atque, laboriosam consectetur veniam corporis quae ad aut distinctio praesentium natus dolore nulla nesciunt tempore veritatis nobis eligendi porro velit! Suscipit magni, error exercitationem est, saepe pariatur eos quam sunt, doloribus vitae eligendi consequuntur, eaque obcaecati eum. Ut sequi dolores nulla atque est exercitationem sed tempore debitis dicta eligendi sapiente illo consequuntur excepturi, eveniet aperiam cumque ipsam itaque reiciendis, rem! Cumque totam vitae magni rem sunt earum temporibus distinctio nulla amet natus, nemo blanditiis sequi? Hic nemo quaerat mollitia officiis cumque, quia vel tempora saepe, aperiam assumenda asperiores facere, eligendi perspiciatis maxime amet eveniet? Dicta obcaecati voluptatem quae explicabo incidunt?<br></p>',22,22,23,'2021-11-08 03:04:42','2021-11-08 03:05:25',1,2,2,1,3,NULL,NULL),
	(3,'Tetsing Hari ini 1','<p>adasdas<br></p>','Tetsing Hari ini 2','<p>asdasdas<br></p>','Tetsing Hari ini 3','<p>sdadsad<br></p>',2,NULL,NULL,'Tetsing Hari ini 2','<p>asdasdas<br></p>',28,28,29,'2021-11-18 23:18:46','2021-11-18 23:19:25',1,1,2,2,2,NULL,NULL),
	(4,'Mengembangkan Teknologi Applkasi Berbasis Sistem Terintegrasi Antar Jurusan di Universitas Negri Makassar','<p>Lorem ipsum dolor sit, amet consectetur, adipisicing elit. Odit, ratione voluptatibus sequi, quidem delectus incidunt voluptates nemo recusandae facilis asperiores deleniti, reiciendis rem. Nulla dolor cumque sunt, aliquam, tempore temporibus pariatur dolorum? Velit quas voluptates dicta fuga et? Error nobis debitis, sed ipsa ut nisi dignissimos inventore provident. Consequuntur doloremque necessitatibus neque quasi, veritatis architecto exercitationem blanditiis, dignissimos ab, quod, odio! Fugiat veniam dolore totam, ratione cumque temporibus fugit possimus sint vero quisquam ullam pariatur necessitatibus dolorem maiores eum animi maxime quia reprehenderit dolores, perferendis laborum laboriosam, tempore magni? Voluptates odio tenetur dignissimos sequi voluptatem quos similique facilis perspiciatis, dolor.<br></p>','judul 2','<p>Lorem ipsum dolor sit, amet consectetur, adipisicing elit. Odit, ratione voluptatibus sequi, quidem delectus incidunt voluptates nemo recusandae facilis asperiores deleniti, reiciendis rem. Nulla dolor cumque sunt, aliquam, tempore temporibus pariatur dolorum? Velit quas voluptates dicta fuga et? Error nobis debitis, sed ipsa ut nisi dignissimos inventore provident. Consequuntur doloremque necessitatibus neque quasi, veritatis architecto exercitationem blanditiis, dignissimos ab, quod, odio! Fugiat veniam dolore totam, ratione cumque temporibus fugit possimus sint vero quisquam ullam pariatur necessitatibus dolorem maiores eum animi maxime quia reprehenderit dolores, perferendis laborum laboriosam, tempore magni? Voluptates odio tenetur dignissimos sequi voluptatem quos similique facilis perspiciatis, dolor.<br></p>','judul 3','<p>Lorem ipsum dolor sit, amet consectetur, adipisicing elit. Odit, ratione voluptatibus sequi, quidem delectus incidunt voluptates nemo recusandae facilis asperiores deleniti, reiciendis rem. Nulla dolor cumque sunt, aliquam, tempore temporibus pariatur dolorum? Velit quas voluptates dicta fuga et? Error nobis debitis, sed ipsa ut nisi dignissimos inventore provident. Consequuntur doloremque necessitatibus neque quasi, veritatis architecto exercitationem blanditiis, dignissimos ab, quod, odio! Fugiat veniam dolore totam, ratione cumque temporibus fugit possimus sint vero quisquam ullam pariatur necessitatibus dolorem maiores eum animi maxime quia reprehenderit dolores, perferendis laborum laboriosam, tempore magni? Voluptates odio tenetur dignissimos sequi voluptatem quos similique facilis perspiciatis, dolor.<br></p>',2,NULL,NULL,'Mengembangkan Teknologi Applkasi Berbasis Sistem Terintegrasi Antar Jurusan di Universitas Negri Makassar','<p>Lorem ipsum dolor sit, amet consectetur, adipisicing elit. Odit, ratione voluptatibus sequi, quidem delectus incidunt voluptates nemo recusandae facilis asperiores deleniti, reiciendis rem. Nulla dolor cumque sunt, aliquam, tempore temporibus pariatur dolorum? Velit quas voluptates dicta fuga et? Error nobis debitis, sed ipsa ut nisi dignissimos inventore provident. Consequuntur doloremque necessitatibus neque quasi, veritatis architecto exercitationem blanditiis, dignissimos ab, quod, odio! Fugiat veniam dolore totam, ratione cumque temporibus fugit possimus sint vero quisquam ullam pariatur necessitatibus dolorem maiores eum animi maxime quia reprehenderit dolores, perferendis laborum laboriosam, tempore magni? Voluptates odio tenetur dignissimos sequi voluptatem quos similique facilis perspiciatis, dolor.<br></p>',32,32,31,'2021-11-25 15:15:41','2021-11-25 15:16:10',1,2,1,2,3,NULL,NULL);

/*!40000 ALTER TABLE `tbl_data_judul` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_dosen
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_dosen`;

CREATE TABLE `tbl_dosen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nohp` varchar(50) DEFAULT NULL,
  `nip` varchar(200) DEFAULT NULL,
  `jkl` varchar(200) DEFAULT NULL,
  `agama` varchar(200) DEFAULT NULL,
  `status_kawin` varchar(200) DEFAULT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  `perguruan_tinggi` varchar(200) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_user` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_dosen` WRITE;
/*!40000 ALTER TABLE `tbl_dosen` DISABLE KEYS */;

INSERT INTO `tbl_dosen` (`id`, `nama`, `email`, `nohp`, `nip`, `jkl`, `agama`, `status_kawin`, `jabatan`, `perguruan_tinggi`, `alamat`, `created_at`, `last_update`, `last_user`, `created_by`)
VALUES
	(1,'Dosen 1','dosen1@gmail.com','081212121212','1000001',NULL,'Isla','Belum Menikah','','','-','2021-11-07 11:19:47','2021-11-07 11:19:47',1,1),
	(2,'Dosen 2','dosen2@gmail.com','081212121212','1000002',NULL,'Islam','Belum Menikah','','','0','2021-11-07 11:20:12','2021-11-07 11:20:12',1,1),
	(3,'Dosen 3','dosen3@gmail.com','089580056642','1000003',NULL,'Islam','Belum Menikah','','','-','2021-11-07 11:20:43','2021-11-07 11:20:43',1,1);

/*!40000 ALTER TABLE `tbl_dosen` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_jdl_seminar
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_jdl_seminar`;

CREATE TABLE `tbl_jdl_seminar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `jns` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_jdl_seminar` WRITE;
/*!40000 ALTER TABLE `tbl_jdl_seminar` DISABLE KEYS */;

INSERT INTO `tbl_jdl_seminar` (`id`, `judul`, `jns`, `created_at`, `last_update`, `last_user`)
VALUES
	(1,'Magister Arsitektur (M.Arch.)','S3','2021-10-21 21:02:20','2021-11-17 18:28:11',1),
	(2,'Magister Counseling Psychology','S3','2021-10-23 17:34:00','2021-11-17 18:28:08',1),
	(3,'Magister di Bidang Human Resources','S3','2021-10-23 17:34:17','2021-11-17 18:33:12',1),
	(4,'Magister Desain Interior','S2','2021-10-23 17:34:27','2021-11-17 18:28:00',1),
	(5,'Magister Desain Grafis','S2','2021-10-24 19:08:13','2021-11-17 18:28:01',1),
	(6,'Pendidikan Teknologi Kejuruan','S2','2021-11-25 15:05:40','2021-11-25 15:06:07',1);

/*!40000 ALTER TABLE `tbl_jdl_seminar` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_jurusan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_jurusan`;

CREATE TABLE `tbl_jurusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `singkatan` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_user` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tbl_ketua_prodi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_ketua_prodi`;

CREATE TABLE `tbl_ketua_prodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nohp` varchar(50) DEFAULT NULL,
  `nik` varchar(200) DEFAULT NULL,
  `jkl` varchar(200) DEFAULT NULL,
  `agama` varchar(200) DEFAULT NULL,
  `status_kawin` varchar(200) DEFAULT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  `perguruan_tinggi` varchar(200) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `prodi` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_user` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_ketua_prodi` WRITE;
/*!40000 ALTER TABLE `tbl_ketua_prodi` DISABLE KEYS */;

INSERT INTO `tbl_ketua_prodi` (`id`, `nama`, `email`, `nohp`, `nik`, `jkl`, `agama`, `status_kawin`, `jabatan`, `perguruan_tinggi`, `alamat`, `prodi`, `created_at`, `last_update`, `last_user`, `created_by`)
VALUES
	(1,'Prodi MDI 1','prodimdi1@gmail.com','081212121212','73281237128312',NULL,'Islam','Belum Menikah','','','-',4,'2021-11-07 11:18:19','2021-11-07 11:18:19',1,1),
	(2,'Testing Prodi MA','tpma@gmail.com','832052054752452','74652345244',NULL,'','Belum Menikah','','','asdsad',1,'2021-11-18 23:17:00','2021-11-18 23:17:00',1,1),
	(3,'Prof Dr. Muis Mappalotteng','muis@gmail.com','0812312345678','625383242342',NULL,'Islam','Menikah','','Universitas Negri Makassar','-',6,'2021-11-25 15:08:00','2021-11-25 15:08:00',1,1);

/*!40000 ALTER TABLE `tbl_ketua_prodi` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_loket
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_loket`;

CREATE TABLE `tbl_loket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nohp` varchar(50) DEFAULT NULL,
  `nik` varchar(200) DEFAULT NULL,
  `jkl` varchar(200) DEFAULT NULL,
  `agama` varchar(200) DEFAULT NULL,
  `status_kawin` varchar(200) DEFAULT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  `perguruan_tinggi` varchar(200) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `prodi` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_user` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_loket` WRITE;
/*!40000 ALTER TABLE `tbl_loket` DISABLE KEYS */;

INSERT INTO `tbl_loket` (`id`, `nama`, `email`, `nohp`, `nik`, `jkl`, `agama`, `status_kawin`, `jabatan`, `perguruan_tinggi`, `alamat`, `prodi`, `created_at`, `last_update`, `last_user`, `created_by`)
VALUES
	(1,'Loket MDI 1','loketmdi1@gmail.com','081212121212','3762454243',NULL,'Islam','Belum Menikah','','','-',4,'2021-11-07 11:19:06','2021-11-07 11:19:06',1,1),
	(2,'loket ma','loketma@gmail.com','2390235894','452452',NULL,'','Belum Menikah','','','d',1,'2021-11-19 00:09:09','2021-11-19 00:09:09',1,1),
	(3,'Ulfa','ulfa@gmail.com','9876545613123','23542736423',NULL,'','Belum Menikah','','','-',6,'2021-11-25 15:20:43','2021-11-25 15:20:43',1,1);

/*!40000 ALTER TABLE `tbl_loket` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `pass_text`, `first_name`, `last_name`, `address`, `email`, `phone`, `active`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `fid`, `last_user`, `last_update`)
VALUES
	(1,'127.0.0.1','admin','$2y$10$cmXUwb01A0pA1Z5SkBIGKujlYzOwAbccBIhjBhLYM6bCWztAEKsP2','123456','Administrator','',NULL,'Admin@gmail.com','',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1638426456,NULL,1,'2021-10-23 20:03:52'),
	(21,'127.0.0.1','yusril24102001@gmail.com','$2y$10$/PgoPFUtQ8Qmsqj.EeKUDe75Lg8D2aCesZ4kkWL4cvnxVfLaZfISu','123456','Yusril Asrul','',NULL,'yusril24102001@gmail.com','089580056642',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1636254943,1637827390,1,1,'2021-11-07 11:22:56'),
	(22,'127.0.0.1','abiyyah@gmail.com','$2y$10$lnDyezsidumw/lMnPWNYSeAwfrxVxV3/rHCrJZO7D07dNeDmmAso.','123456','Abiyyah Raihaanah','',NULL,'abiyyah@gmail.com','081212121212',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1636255006,1636312229,2,1,'2021-11-07 11:22:44'),
	(23,'127.0.0.1','prodimdi1@gmail.com','$2y$10$PiSUTUUouXaGPidAMu9WT.4pySEKC7tIA3AKcZqIAYvQM8tn4Axq6','123456','Prodi MDI 1','',NULL,'prodimdi1@gmail.com','081212121212',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1636255099,1637248547,1,1,'2021-11-07 11:18:19'),
	(24,'127.0.0.1','loketmdi1@gmail.com','$2y$10$dr40j8UHiqA8eSMit6lMvO09qH9IWYno7Q1gSbaFDXuuNxLVMMlfa','123456','Loket MDI 1','',NULL,'loketmdi1@gmail.com','081212121212',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1636255146,1636312168,1,1,'2021-11-07 11:19:06'),
	(25,'127.0.0.1','dosen1@gmail.com','$2y$10$rMDjjYwPCth37DkXy4.NeeTxiTJ3Hpjd4ERln2WLKZWZ5C7g8jH6m','123456','Dosen 1','',NULL,'dosen1@gmail.com','081212121212',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1636255188,1637829215,1,1,'2021-11-07 11:19:47'),
	(26,'127.0.0.1','dosen2@gmail.com','$2y$10$0xYIgpAEzRX0cFIEj2BOIeL8lsFc3tdl8fT93mPeKLtlw/Xi6QGVm','123456','Dosen 2','',NULL,'dosen2@gmail.com','081212121212',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1636255212,NULL,2,1,'2021-11-07 11:20:12'),
	(27,'127.0.0.1','dosen3@gmail.com','$2y$10$czT/UyEw5.Ln3UV2uVwLEOD0QzXqLkwRgEcE0QsRhlwfuR9JFDKmO','123456','Dosen 3','',NULL,'dosen3@gmail.com','089580056642',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1636255243,NULL,3,1,'2021-11-07 11:20:43'),
	(28,'127.0.0.1','tests3001@gmail.com','$2y$10$oGw8gEqbth/AWS0yWHFCGucbq8TZyzdUYoymtEr8WJvNDVjDYcfqG','123456','testing mhs s3 001','',NULL,'tests3001@gmail.com','08123000001',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1637145400,1637251887,3,1,'2021-11-17 18:36:40'),
	(29,'127.0.0.1','tpma@gmail.com','$2y$10$sMe0ppwL/68ZW35.PC19UOkp84tyfdr/Fa3I9MJnn7qeEJEVLo3WC','123456','Testing Prodi MA','',NULL,'tpma@gmail.com','832052054752452',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1637248621,1637248748,2,1,'2021-11-18 23:17:00'),
	(30,'127.0.0.1','loketma@gmail.com','$2y$10$FHxn/5oq/0ziF9xU6KMToepRJiu8zsF1pgqg4FBVuBmdtV3HwZrw.','123456','loket ma','',NULL,'loketma@gmail.com','2390235894',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1637251749,1637251838,2,1,'2021-11-19 00:09:09'),
	(31,'180.252.198.26','muis@gmail.com','$2y$10$4dMewboHczR6hAAilKBwx.wtHPSjgCHhyXC/ozbx1GDRgjKg8MwOm','123456','Prof Dr. Muis Mappalotteng','',NULL,'muis@gmail.com','0812312345678',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1637827680,1637828151,3,1,'2021-11-25 16:08:00'),
	(32,'180.252.198.26','muflih@gmail.com','$2y$10$Pxv1ZgdZ5L11vsLHFpzi7.cz4r/hXwTSz3sHIFgI4S/gxA8wk1FU6','123456','Ahmad Muflih','',NULL,'muflih@gmail.com','089123123123',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1637827765,1638426301,4,1,'2021-11-25 16:09:25'),
	(33,'180.252.198.26','ulfa@gmail.com','$2y$10$h9QC3sRziUu5HXS3jBIIa.8rhIZFrWKtaaXhTfsn.E/iXCPgX0aly','123456','Ulfa','',NULL,'ulfa@gmail.com','9876545613123',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1637828443,1637828588,3,1,'2021-11-25 16:20:43');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_groups
# ------------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`)
VALUES
	(1,1,1),
	(21,21,2),
	(22,22,2),
	(23,23,4),
	(24,24,5),
	(25,25,6),
	(26,26,6),
	(27,27,6),
	(28,28,2),
	(29,29,4),
	(30,30,5),
	(31,31,4),
	(32,32,2),
	(33,33,5);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
