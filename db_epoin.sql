-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: epoin
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_datadispen`
--

DROP TABLE IF EXISTS `tb_datadispen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_datadispen` (
  `id_dispen` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelajar` int(11) NOT NULL,
  `nama_dispen` varchar(50) NOT NULL,
  `deskripsi_dispen` text NOT NULL,
  `id_guru` int(11) NOT NULL,
  `dari_kapan` time NOT NULL,
  `sampai_kapan` time NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_dispen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_datapelanggar`
--

DROP TABLE IF EXISTS `tb_datapelanggar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_datapelanggar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelajar` int(11) NOT NULL,
  `id_pelanggaran` int(11) NOT NULL,
  `poin_pelanggaran` varchar(100) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `tanggal_pelanggaran` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keterangan_pelanggaran` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_kelas`
--

DROP TABLE IF EXISTS `tb_kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_kelas` (
  `id_kelas` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_log`
--

DROP TABLE IF EXISTS `tb_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action` varchar(100) DEFAULT NULL,
  `params` text,
  `timestamp` timestamp NULL DEFAULT NULL,
  `rollback` timestamp NULL DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_pelajar`
--

DROP TABLE IF EXISTS `tb_pelajar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pelajar` (
  `id_pelajar` int(11) NOT NULL AUTO_INCREMENT,
  `nis_pelajar` varchar(50) DEFAULT NULL,
  `nama_pelajar` varchar(50) NOT NULL,
  `pass_pelajar` varchar(255) DEFAULT NULL,
  `telp_pelajar` varchar(15) DEFAULT NULL,
  `surel_pelajar` varchar(150) DEFAULT NULL,
  `foto_pelajar` varchar(255) DEFAULT NULL,
  `status_pelajar` varchar(10) DEFAULT NULL,
  `poin_pelajar` varchar(255) DEFAULT NULL,
  `level_pelajar` varchar(10) DEFAULT NULL,
  `terakhir_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kelas_pelajar` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id_pelajar`)
) ENGINE=InnoDB AUTO_INCREMENT=1728 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_pelanggaran`
--

DROP TABLE IF EXISTS `tb_pelanggaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggaran` varchar(255) NOT NULL,
  `deskripsi_pelanggaran` varchar(255) NOT NULL,
  `poin_pelanggaran` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pelanggaran`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_pengguna`
--

DROP TABLE IF EXISTS `tb_pengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `username_pengguna` varchar(25) NOT NULL,
  `pass_pengguna` varchar(255) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `foto_pengguna` varchar(255) DEFAULT NULL,
  `level_pengguna` enum('Admin','Guru','Pelajar') NOT NULL DEFAULT 'Guru',
  `telp_pengguna` varchar(15) NOT NULL,
  `surel_pengguna` varchar(100) NOT NULL,
  `terakhir_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-06 19:05:13
