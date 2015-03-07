CREATE DATABASE  IF NOT EXISTS `qiwur_nutch_ui` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `qiwur_nutch_ui`;
-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: qiwur_nutch_ui
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'controllers',1,602),(2,1,NULL,NULL,'Pages',2,7),(3,2,NULL,NULL,'display',3,4),(4,2,NULL,NULL,'serialize',5,6),(5,1,NULL,NULL,'Messages',8,21),(6,5,NULL,NULL,'admin_index',9,10),(7,5,NULL,NULL,'admin_view',11,12),(8,5,NULL,NULL,'assessor_index',13,14),(9,5,NULL,NULL,'assessor_view',15,16),(10,5,NULL,NULL,'assessor_add',17,18),(11,5,NULL,NULL,'serialize',19,20),(12,1,NULL,NULL,'Common',22,37),(13,12,NULL,NULL,'listCities',23,24),(14,12,NULL,NULL,'click',25,26),(15,12,NULL,NULL,'kissyPictureUpload',27,28),(16,12,NULL,NULL,'bmap',29,30),(17,12,NULL,NULL,'bmarker',31,32),(18,12,NULL,NULL,'ajaxPictureUpload',33,34),(19,12,NULL,NULL,'serialize',35,36),(20,1,NULL,NULL,'Lmails',38,77),(21,20,NULL,NULL,'preview',39,40),(22,20,NULL,NULL,'admin_index',41,42),(23,20,NULL,NULL,'admin_add',43,44),(24,20,NULL,NULL,'admin_eadd',45,46),(25,20,NULL,NULL,'admin_confirm',47,48),(26,20,NULL,NULL,'admin_preview',49,50),(27,20,NULL,NULL,'admin_edit',51,52),(28,20,NULL,NULL,'admin_view',53,54),(29,20,NULL,NULL,'admin_del',55,56),(30,20,NULL,NULL,'admin_ajaxDel',57,58),(31,20,NULL,NULL,'admin_delBatch',59,60),(32,20,NULL,NULL,'admin_ajaxConfirm',61,62),(33,20,NULL,NULL,'admin_confirmBatch',63,64),(34,20,NULL,NULL,'viewMandomTussand',65,66),(35,20,NULL,NULL,'printMandomTussand',67,68),(36,20,NULL,NULL,'sendMandomTussandTest',69,70),(37,20,NULL,NULL,'subscribe',71,72),(38,20,NULL,NULL,'unsubscribe',73,74),(39,20,NULL,NULL,'serialize',75,76),(40,1,NULL,NULL,'Groups',78,89),(41,40,NULL,NULL,'admin_index',79,80),(42,40,NULL,NULL,'admin_view',81,82),(43,40,NULL,NULL,'admin_add',83,84),(44,40,NULL,NULL,'admin_edit',85,86),(45,40,NULL,NULL,'serialize',87,88),(46,1,NULL,NULL,'CompoundLayouts',90,103),(47,46,NULL,NULL,'admin_index',91,92),(48,46,NULL,NULL,'admin_view',93,94),(49,46,NULL,NULL,'admin_add',95,96),(50,46,NULL,NULL,'admin_edit',97,98),(51,46,NULL,NULL,'admin_delete',99,100),(52,46,NULL,NULL,'serialize',101,102),(53,1,NULL,NULL,'Properties',104,127),(54,53,NULL,NULL,'index',105,106),(55,53,NULL,NULL,'view',107,108),(56,53,NULL,NULL,'areatical',109,110),(57,53,NULL,NULL,'alphabetical',111,112),(58,53,NULL,NULL,'admin_index',113,114),(59,53,NULL,NULL,'admin_view',115,116),(60,53,NULL,NULL,'admin_add',117,118),(61,53,NULL,NULL,'admin_edit',119,120),(62,53,NULL,NULL,'admin_delete',121,122),(63,53,NULL,NULL,'serialize',123,124),(64,1,NULL,NULL,'Settings',128,137),(65,64,NULL,NULL,'admin_index',129,130),(66,64,NULL,NULL,'admin_view',131,132),(67,64,NULL,NULL,'admin_edit',133,134),(68,64,NULL,NULL,'serialize',135,136),(69,1,NULL,NULL,'Comments',138,143),(70,69,NULL,NULL,'assessor_add',139,140),(71,69,NULL,NULL,'serialize',141,142),(72,1,NULL,NULL,'Tags',144,159),(73,72,NULL,NULL,'assessor_orders',145,146),(74,72,NULL,NULL,'admin_index',147,148),(75,72,NULL,NULL,'admin_view',149,150),(76,72,NULL,NULL,'admin_add',151,152),(77,72,NULL,NULL,'admin_edit',153,154),(78,72,NULL,NULL,'admin_delete',155,156),(79,72,NULL,NULL,'serialize',157,158),(80,1,NULL,NULL,'Users',160,235),(81,80,NULL,NULL,'mine',161,162),(82,80,NULL,NULL,'admin_index',163,164),(83,80,NULL,NULL,'admin_view',165,166),(84,80,NULL,NULL,'admin_activate',167,168),(85,80,NULL,NULL,'admin_performance',169,170),(86,80,NULL,NULL,'checkLogin',171,172),(87,80,NULL,NULL,'checkEmail',173,174),(88,80,NULL,NULL,'checkNickname',175,176),(89,80,NULL,NULL,'register',177,178),(90,80,NULL,NULL,'register_ok',179,180),(91,80,NULL,NULL,'ajaxRegister',181,182),(92,80,NULL,NULL,'testRegister',183,184),(93,80,NULL,NULL,'activate',185,186),(94,80,NULL,NULL,'retrievePassword',187,188),(95,80,NULL,NULL,'resetPassword',189,190),(96,80,NULL,NULL,'securimage',191,192),(97,80,NULL,NULL,'admin_login',193,194),(98,80,NULL,NULL,'manager_login',195,196),(99,80,NULL,NULL,'assessor_login',197,198),(100,80,NULL,NULL,'tracer_login',199,200),(101,80,NULL,NULL,'account_login',201,202),(102,80,NULL,NULL,'admin_logout',203,204),(103,80,NULL,NULL,'manager_logout',205,206),(104,80,NULL,NULL,'assessor_logout',207,208),(105,80,NULL,NULL,'tracer_logout',209,210),(106,80,NULL,NULL,'account_logout',211,212),(107,80,NULL,NULL,'login',213,214),(108,80,NULL,NULL,'logout',215,216),(109,80,NULL,NULL,'loginService',217,218),(110,80,NULL,NULL,'logoutService',219,220),(111,80,NULL,NULL,'autoLogin',221,222),(112,80,NULL,NULL,'autoLogout',223,224),(113,80,NULL,NULL,'admin_removeAccount',225,226),(114,80,NULL,NULL,'admin_changeGroup',227,228),(115,80,NULL,NULL,'admin_edit',229,230),(116,80,NULL,NULL,'admin_sendUsersRegisterMail',231,232),(117,80,NULL,NULL,'serialize',233,234),(118,1,NULL,NULL,'Schools',236,255),(119,118,NULL,NULL,'index',237,238),(120,118,NULL,NULL,'areatical',239,240),(121,118,NULL,NULL,'alphabetical',241,242),(122,118,NULL,NULL,'admin_index',243,244),(123,118,NULL,NULL,'admin_view',245,246),(124,118,NULL,NULL,'admin_add',247,248),(125,118,NULL,NULL,'admin_edit',249,250),(126,118,NULL,NULL,'admin_delete',251,252),(127,118,NULL,NULL,'serialize',253,254),(128,1,NULL,NULL,'Websites',256,269),(129,128,NULL,NULL,'admin_index',257,258),(130,128,NULL,NULL,'admin_view',259,260),(131,128,NULL,NULL,'admin_add',261,262),(132,128,NULL,NULL,'admin_edit',263,264),(133,128,NULL,NULL,'admin_delete',265,266),(134,128,NULL,NULL,'serialize',267,268),(135,1,NULL,NULL,'PropertyImages',270,285),(136,135,NULL,NULL,'admin_index',271,272),(137,135,NULL,NULL,'admin_view',273,274),(138,135,NULL,NULL,'admin_add',275,276),(139,135,NULL,NULL,'admin_edit',277,278),(140,135,NULL,NULL,'admin_delete',279,280),(141,135,NULL,NULL,'serialize',281,282),(142,1,NULL,NULL,'Bills',286,307),(143,142,NULL,NULL,'admin_index',287,288),(144,142,NULL,NULL,'admin_view',289,290),(145,142,NULL,NULL,'account_index',291,292),(146,142,NULL,NULL,'account_view',293,294),(147,142,NULL,NULL,'account_ajaxAdd',295,296),(148,142,NULL,NULL,'account_edit',297,298),(149,142,NULL,NULL,'account_markInformed',299,300),(150,142,NULL,NULL,'account_links',301,302),(151,142,NULL,NULL,'partner_view',303,304),(152,142,NULL,NULL,'serialize',305,306),(153,1,NULL,NULL,'Areas',308,323),(154,153,NULL,NULL,'admin_index',309,310),(155,153,NULL,NULL,'admin_view',311,312),(156,153,NULL,NULL,'admin_edit',313,314),(157,153,NULL,NULL,'admin_save',315,316),(158,153,NULL,NULL,'admin_del',317,318),(159,153,NULL,NULL,'loadChildren',319,320),(160,153,NULL,NULL,'serialize',321,322),(161,1,NULL,NULL,'Notes',324,337),(162,161,NULL,NULL,'index',325,326),(163,161,NULL,NULL,'inbox',327,328),(164,161,NULL,NULL,'outbox',329,330),(165,161,NULL,NULL,'checkNew',331,332),(166,161,NULL,NULL,'markRead',333,334),(167,161,NULL,NULL,'serialize',335,336),(168,1,NULL,NULL,'Compounds',338,365),(169,168,NULL,NULL,'index',339,340),(170,168,NULL,NULL,'view',341,342),(171,168,NULL,NULL,'areatical',343,344),(172,168,NULL,NULL,'alphabetical',345,346),(173,168,NULL,NULL,'admin_index',347,348),(174,168,NULL,NULL,'admin_view',349,350),(175,168,NULL,NULL,'admin_add',351,352),(176,168,NULL,NULL,'admin_edit',353,354),(177,168,NULL,NULL,'admin_delete',355,356),(178,168,NULL,NULL,'serialize',357,358),(179,1,NULL,NULL,'Portals',366,373),(180,179,NULL,NULL,'index',367,368),(181,179,NULL,NULL,'admin_index',369,370),(182,179,NULL,NULL,'serialize',371,372),(183,1,NULL,NULL,'System',374,447),(184,183,NULL,NULL,'commonClearCache',375,376),(185,183,NULL,NULL,'testSMS',377,378),(186,183,NULL,NULL,'floatTest',379,380),(187,183,NULL,NULL,'testSMS2',381,382),(188,183,NULL,NULL,'testSemophere',383,384),(189,183,NULL,NULL,'view',385,386),(190,183,NULL,NULL,'testSoap',387,388),(191,183,NULL,NULL,'updateCachePrizeQuantity',389,390),(192,183,NULL,NULL,'updatePrizeWinners',391,392),(193,183,NULL,NULL,'fixOliviaPrizeBug',393,394),(194,183,NULL,NULL,'testLoadGmAd',395,396),(195,183,NULL,NULL,'testCurl',397,398),(196,183,NULL,NULL,'fp',399,400),(197,183,NULL,NULL,'fixDefaultDest',401,402),(198,183,NULL,NULL,'ipv6',403,404),(199,183,NULL,NULL,'t',405,406),(200,183,NULL,NULL,'admin_listCreatedUsers',407,408),(201,183,NULL,NULL,'editor',409,410),(202,183,NULL,NULL,'admin_seo',411,412),(203,183,NULL,NULL,'disableAdWithoutPrize',413,414),(204,183,NULL,NULL,'insert',415,416),(205,183,NULL,NULL,'reportBrowserEnv',417,418),(206,183,NULL,NULL,'reportClose',419,420),(207,183,NULL,NULL,'report',421,422),(208,183,NULL,NULL,'simpleJSONDecode',423,424),(209,183,NULL,NULL,'simpleJSONEncode',425,426),(210,183,NULL,NULL,'phpinfo',427,428),(211,183,NULL,NULL,'sendHelloMail',429,430),(212,183,NULL,NULL,'sendTestEdmMail',431,432),(213,183,NULL,NULL,'simpleUserEvent',433,434),(214,183,NULL,NULL,'simpleGetJson',435,436),(215,183,NULL,NULL,'w',437,438),(216,183,NULL,NULL,'r',439,440),(217,183,NULL,NULL,'d',441,442),(218,183,NULL,NULL,'help',443,444),(219,183,NULL,NULL,'serialize',445,446),(220,1,NULL,NULL,'CompoundImages',448,461),(221,220,NULL,NULL,'admin_index',449,450),(222,220,NULL,NULL,'admin_view',451,452),(223,220,NULL,NULL,'admin_add',453,454),(224,220,NULL,NULL,'admin_edit',455,456),(225,220,NULL,NULL,'admin_delete',457,458),(226,220,NULL,NULL,'serialize',459,460),(227,53,NULL,NULL,'admin_add_alone',125,126),(228,1,NULL,NULL,'Landlords',462,487),(229,228,NULL,NULL,'index',463,464),(230,228,NULL,NULL,'view',465,466),(231,228,NULL,NULL,'add',467,468),(232,228,NULL,NULL,'edit',469,470),(233,228,NULL,NULL,'delete',471,472),(234,228,NULL,NULL,'admin_index',473,474),(235,228,NULL,NULL,'admin_view',475,476),(236,228,NULL,NULL,'admin_add',477,478),(237,228,NULL,NULL,'admin_mark_read',479,480),(238,228,NULL,NULL,'admin_edit',481,482),(239,228,NULL,NULL,'admin_delete',483,484),(240,228,NULL,NULL,'serialize',485,486),(241,1,NULL,NULL,'Articles',488,505),(242,241,NULL,NULL,'index',489,490),(243,241,NULL,NULL,'view',491,492),(244,241,NULL,NULL,'admin_index',493,494),(245,241,NULL,NULL,'admin_view',495,496),(246,241,NULL,NULL,'admin_add',497,498),(247,241,NULL,NULL,'admin_edit',499,500),(248,241,NULL,NULL,'admin_delete',501,502),(249,241,NULL,NULL,'serialize',503,504),(250,1,NULL,NULL,'Enquiries',506,533),(251,250,NULL,NULL,'index',507,508),(252,250,NULL,NULL,'view',509,510),(253,250,NULL,NULL,'arrange',511,512),(254,250,NULL,NULL,'add',513,514),(255,250,NULL,NULL,'edit',515,516),(256,250,NULL,NULL,'delete',517,518),(257,250,NULL,NULL,'admin_index',519,520),(258,250,NULL,NULL,'admin_view',521,522),(259,250,NULL,NULL,'admin_add',523,524),(260,250,NULL,NULL,'admin_markRead',525,526),(261,250,NULL,NULL,'admin_edit',527,528),(262,250,NULL,NULL,'admin_delete',529,530),(263,250,NULL,NULL,'serialize',531,532),(264,168,NULL,NULL,'map',359,360),(265,135,NULL,NULL,'admin_watermark',283,284),(266,1,NULL,NULL,'Webpages',534,549),(267,266,NULL,NULL,'admin_index',535,536),(268,266,NULL,NULL,'view',537,538),(269,266,NULL,NULL,'analysis',539,540),(270,266,NULL,NULL,'admin_add',541,542),(271,266,NULL,NULL,'admin_edit',543,544),(272,266,NULL,NULL,'admin_delete',545,546),(273,266,NULL,NULL,'serialize',547,548),(274,1,NULL,NULL,'MaxPropertyIndexPages',550,559),(275,274,NULL,NULL,'admin_index',551,552),(276,274,NULL,NULL,'admin_view',553,554),(277,274,NULL,NULL,'admin_add',555,556),(278,274,NULL,NULL,'serialize',557,558),(279,1,NULL,NULL,'MaxCompoundIndexPages',560,573),(280,279,NULL,NULL,'admin_index',561,562),(281,279,NULL,NULL,'admin_view',563,564),(282,279,NULL,NULL,'admin_add',565,566),(283,279,NULL,NULL,'admin_edit',567,568),(284,279,NULL,NULL,'admin_delete',569,570),(285,279,NULL,NULL,'serialize',571,572),(286,1,NULL,NULL,'MaxCompoundViewPages',574,587),(287,286,NULL,NULL,'admin_index',575,576),(288,286,NULL,NULL,'admin_view',577,578),(289,286,NULL,NULL,'admin_add',579,580),(290,286,NULL,NULL,'admin_edit',581,582),(291,286,NULL,NULL,'admin_delete',583,584),(292,286,NULL,NULL,'serialize',585,586),(293,168,NULL,NULL,'admin_bind',361,362),(294,168,NULL,NULL,'admin_unbind',363,364),(295,1,NULL,NULL,'MaxPropertyViewPages',588,601),(296,295,NULL,NULL,'admin_index',589,590),(297,295,NULL,NULL,'admin_view',591,592),(298,295,NULL,NULL,'admin_add',593,594),(299,295,NULL,NULL,'admin_edit',595,596),(300,295,NULL,NULL,'admin_delete',597,598),(301,295,NULL,NULL,'serialize',599,600);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(64) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_full` varchar(64) NOT NULL,
  `city_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=929 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (913,'BJ','Wangjing','BJ - Wangjing',2),(895,'SH','Gubei','SH - Gubei',1),(902,'SH','Huqingping & Minhang','SH - Huqingping & Minhang',1),(921,'GZ','Zhu Jiang New Town','GZ - Zhu Jiang New Town',3),(917,'BJ','Jingshun Rd. Near ISB School','BJ - Jingshun Rd. Near ISB School',2),(911,'BJ','Lufthansa','BJ - Lufthansa',2),(900,'SH','Xintiandi','SH - Xintiandi',1),(893,'SH','Downtown','SH - Downtown',1),(920,'GZ','Tian He','GZ - Tian He',3),(909,'BJ','Dongzhimen','BJ - Dongzhimen',2),(898,'SH','Lianyang','SH - Lianyang',1),(925,'GZ','Bai Yun','GZ - Bai Yun',3),(922,'GZ','Hai Zhu','GZ - Hai Zhu',3),(926,'GZ','Li Wang','GZ - Li Wang',3),(908,'BJ','Chaoyang Park','BJ - Chaoyang Park',2),(904,'SH','Other Areas in Pudong','SH - Other Areas in Pudong',1),(912,'BJ','Sanlitun','BJ - Sanlitun',2),(897,'SH','Jinqiao','SH - Jinqiao',1),(916,'BJ','Airport Expressway','BJ - Airport Expressway',2),(910,'BJ','Lido','BJ - Lido',2),(899,'SH','Lujiazui','SH - Lujiazui',1),(914,'BJ','Jianguomen','BJ - Jianguomen',2),(906,'BJ','CBD','BJ - CBD',2),(924,'GZ','Yue Xiu','GZ - Yue Xiu',3),(915,'BJ','Olympic Village','BJ - Olympic Village',2),(923,'GZ','Er Sha Island','GZ - Er Sha Island',3),(903,'SH','Kangqiao','SH - Kangqiao',1),(907,'BJ','Changan Avenue','BJ - Changan Avenue',2),(927,'GZ','Pan Yu','GZ - Pan Yu',3),(928,'GZ','Zeng Cheng','GZ - Zeng Cheng',3),(894,'SH','Former French Concession','SH - Former French Concession',1),(918,'BJ','Jingshun Rd. Near WAB School','BJ - Jingshun Rd. Near WAB School',2),(896,'SH','Hongqiao','SH - Hongqiao',1),(901,'SH','Xujiahui','SH - Xujiahui',1);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`) USING BTREE,
  KEY `rght` (`rght`) USING BTREE,
  KEY `parent_id` (`parent_id`) USING BTREE,
  KEY `model` (`model`) USING BTREE,
  KEY `alias` (`alias`) USING BTREE,
  KEY `foreign_key` (`foreign_key`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros`
--

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT INTO `aros` VALUES (1,NULL,'Group',1,'',1,48),(2,1,'Group',2,'',2,3),(3,1,'Group',3,'',4,7),(4,1,'Group',4,'',8,43),(5,1,'Group',5,'',44,45),(6,1,'Group',6,'',46,47),(7,4,'User',1,'',9,10),(8,4,'User',2,'',11,12),(9,4,'User',3,'',13,14),(10,4,'User',4,'',15,16),(11,4,'User',5,'',17,18),(12,4,'User',6,'',19,20),(13,4,'User',7,'',21,22),(14,4,'User',8,'',23,24),(15,4,'User',9,'',25,26),(16,4,'User',10,'',27,28),(17,4,'User',11,'',29,30),(18,4,'User',12,'',31,32),(19,3,'User',13,'',5,6),(20,4,'User',14,'',33,34),(21,4,'User',15,'',35,36),(22,4,'User',16,'',37,38),(23,4,'User',17,'',39,40),(24,4,'User',18,'',41,42);
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL,
  `aco_id` int(10) unsigned NOT NULL,
  `_create` char(2) NOT NULL DEFAULT '0',
  `_read` char(2) NOT NULL DEFAULT '0',
  `_update` char(2) NOT NULL DEFAULT '0',
  `_delete` char(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aro_id` (`aro_id`) USING BTREE,
  KEY `aco_id` (`aco_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (1,1,1,'-1','-1','-1','-1'),(2,2,1,'1','1','1','1'),(3,3,1,'1','1','1','1'),(4,4,1,'-1','-1','-1','-1'),(5,5,1,'-1','-1','-1','-1'),(6,7,1,'1','1','1','1');
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (2,'Overview','<p><img width=\"685\" height=\"156\" alt=\"\" src=\"/app/webroot/img/uploads/fckeditor/222.jpg\" /></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">qiwur_nutch_ui is the leading provider of relocation services to mainland China. With a rich industry knowledge and experience, we handle more than 800 relocations to China every year.&nbsp;</span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">qiwur_nutch_ui is a trusted partner of organizations of every size. We provide an unmatched combination of relocation services which include immigration, international move coordination, destinations services, on-going assignment services and payroll management. Our innovative solutions simplify administration, reduce risk, contain costs and enhance the quality of relocations for our clients and their employees.&nbsp;</span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">We have the experience and capability to guide our clients through complex scenarios with confidence and high-touch service. Taking care of the employees and their families, eliminating surprises and bringing optimal efficiency are our priorities. Our highly skilled workforce and our commitment to flexibility, quality and transparency, make us the provider of choice for clients moving hundreds of employees to China.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">So far, we operate in over 20 cities and regions in mainland China, and we are growing and expending our business throughout the whole country, so as to supply with more on-the-ground support.&nbsp;</span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Seeking to offer greater value to each of our clients, we are continually investing in our ability to service you.</span></span></p>\r\n<p>&nbsp;</p>','Overview - qiwur_nutch_ui China relocation solutions','qiwur_nutch_ui, about qiwur_nutch_ui, China relocation, relocation China, China immigration, immigration to China, China visa, visa china, China work permit, China residence permit, apartment for rent in China, rent apartment in China, houses rent in China, home search in China, living in China, expats in China, Shanghai apartment for rent, rent apartment in Shanghai, Beijing apartment for rent, rent apartment in Beijing, Guangzhou apartment for rent, rent apartment in Guangzhou, Shanghai relocation, Beijing relocation, Guangzhou relocation, qiwur_nutch_ui.','Overview, About qiwur_nutch_ui, qiwur_nutch_ui provides all kinds of relocation services in China, including home search, school search, immigration, payroll and incorporation.','2013-10-05 13:06:37','2014-02-17 21:51:47'),(3,'Why qiwur_nutch_ui','<p><img width=\"685\" height=\"156\" src=\"/app/webroot/img/uploads/fckeditor/222(1).jpg\" alt=\"\" /></p>\r\n<p>&nbsp;</p>\r\n<p><strong><span style=\"color: rgb(3, 35, 14);\"><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Why Corporations Choose qiwur_nutch_ui?</span></span></span></strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"> </span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&gt; <strong>Our relocation solutions:</strong> seamless, visible, cost-effective and customized.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&gt; <strong>Our technology:</strong> safe, secure and efficient.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&gt; <strong>Our process:</strong> global, strategic, timely, accurate and compliant.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&gt; <strong>Our service rates:</strong> highly competitive.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&gt; <strong>Our consultants:</strong> skilled and experienced, honest, respectful, passionate and considerate.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&gt; <strong>Our vision:</strong> we are committed to delivering the best relocation services without compromise.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&gt; <strong>Our mission:</strong> to provide holistic, end-to-end and customized relocation solutions that increase transparency,<br />\r\n&nbsp; &nbsp;accuracy,&nbsp;</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">compliance and efficiency while reducing costs and ensuring satisfaction.</span></span></p>\r\n<div>&nbsp;</div>','Why qiwur_nutch_ui - qiwur_nutch_ui China relocation solutions','qiwur_nutch_ui, about qiwur_nutch_ui, China relocation, relocation China, China immigration, immigration to China, China visa, visa china, China work permit, China residence permit, apartment for rent in China, rent apartments in China, houses rent in China, home search in China, living in China, expats in China, Shanghai apartment for rent, rent apartment in Shanghai, Beijing apartment for rent, rent apartment in Beijing, Guangzhou apartment for rent, rent apartment in Guangzhou, Shanghai relocation, Beijing relocation, Guangzhou relocation, qiwur_nutch_ui.','Why Corporations Choose qiwur_nutch_ui? qiwur_nutch_ui provides all kinds of relocation services in China, including home search, school search, immigration, payroll and incorporation.','2013-10-05 13:28:00','2013-11-02 02:19:40'),(4,'Career','<p><img width=\"685\" height=\"156\" src=\"/app/webroot/img/uploads/fckeditor/222(7).jpg\" alt=\"\" /></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">If you are a candidate of our job offers,&nbsp;please email to: </span><span style=\"color: rgb(0, 0, 255);\"><span style=\"font-family: Arial;\">hr@qiwur_nutch_ui.com</span></span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span style=\"color: rgb(0, 0, 255);\"><u><strong>Seni</strong></u></span></span></span><span style=\"color: rgb(0, 0, 255);\"><u><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><strong>or Immigration Consultant</strong></span></span></u></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><strong>Duties:</strong></span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. To provide on-the ground support from the start of immigration process until we obtain all the relevant immigration approvals for the clients as well as their accompanying family. The scope includes timely response on any queries or requests, timely preparation of immigration documents and review all important information on work, residence, dependent and study visas / permits or any documents issued by the Authorities before returning to the client/assignees;&nbsp;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. To provide briefing and advise the clients at the origin country, prior to arrival at the destination country, of the local governmental legislation regarding the application of the various work, residence, dependent and study visas;&nbsp;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">3. To coordinate between the destination and origin country locations to obtain any specific documentation required by the relevant government agencies at destination in respect of visa and immigration matters;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. To follow all process, procedures and policies of internal work flows as determined by Management;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">5. To learn and apply our in-house database technology and data system update on a daily basis.</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><strong>Requirements:</strong></span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. College or above degree;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. Minimum 3~5 years experience on immigration service or related field;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">3. Fluent English &amp; Mandarin Chinese, &nbsp;as well as good computer skill such as Microsoft outlook, Microsoft office etc;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. Customer service oriented, careful, diligent, and with high sense of responsibility;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">5. Pleasant personality and good working attitude with positive initiative;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">6. Must be willing to travel out of office to other government bureaus when necessary and other 2nd and 3rd tier cities.&nbsp;</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><span style=\"color: rgb(0, 0, 255);\"><u><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Relocation Consultant</span></span></strong></u></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Duties:</span></span></strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. Accompany and conduct home search services with clients;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. Maintain and update property database and paper files;&nbsp;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">3. Sell Home Search Services to corporate accounts in conjunction with Corporate Sales Staff;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. Prepare detailed needs analysis for each potential client and identify suitable properties meeting their requirements;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">5. Be prepared to perform home search services to clients during evening hours and on weekends, if required;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">6. Responsible for all the follow up services to clients during the lease term;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">7. Ensure all the documents (move-in documents, lease, needs analysis, invoices, etc.) will be in the filing systems;&nbsp;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">8. Participate in customer meetings as requested;&nbsp;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">9. Ensure quality customer service is provided at all times;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">10.Ensure all the documents (health check, marriage certificate, work permit, residence licence, etc.) will be in the filling systems.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Requirement:&nbsp;</span></span></strong></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. college degree above;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. good communication skill;&nbsp;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">3. fluent English both in speaking and writing;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. At least 2 years relevant working experience;&nbsp;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">5. Service minded;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">6. Professional &amp; always ethical;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">7. Native Chinese speaker;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">8. Good cross-cultural skills.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><span style=\"color: rgb(0, 0, 255);\"><u><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Senior Relocation Consultant</span></span></strong></u></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Duties:</span></span></strong></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. Being the first point of contact for all the relocation-related matters for assignees;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. Providing consulting services to assignees as per client policies and conducting needs assessment for their relocation-related requirements, including housing preferences, household goods movement, schooling requirements, language training needs etc;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">3. Coordinating with different parties for the timely submission of client-specific reports and ensuring the accuracy of the reports;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. Processing expense payments, reviewing expenses reports and managing assignment cost analysis;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">5. Team supervision.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Requirements:</span></span></strong></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. Degree holder with at least 3+ years relocation industry experience preferred, or service Industry / HR background;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. Customer-oriented with excellent listening and consultative skills;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">3. Pro-active, well organized with good problem solving skills;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. Team player with the ability to work independently, prioritize and manage multiple projects in addition to day-to-day activities;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">5. Proficient in Microsoft environment and web applications;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">6. Excellent command of both spoken and written English, proficiency in other languages would be advantageous;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">7. Age above 27;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">8. Chinese national or foreigner;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">9. Overseas work or study experience preferred.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><span style=\"color: rgb(0, 0, 255);\"><u><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Business Development Manager</span></span></strong></u></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Duties:</span></span></strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. Maintain and grow existing customers, identify and develop new customers to expand the business;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. Achieve sales targets and objectives;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">3. Work closely with Business Development / Marketing team to close new opportunities, generates client leads and develops pipeline to meet business objectives;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. Maintain accurate, transparent records of activities through weekly and monthly reports, with customer related activities managed through CRM (Customer Relationship Management) software;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">5. Provide updates on market information and competitor&rsquo;s activities;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">6. Frequent travel required.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Requirements:</span></span></strong></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. Bachelor degree in Polymer / Materials or related subjects;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. 5 years or above sales experience in related industries;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">3. Aggressive personality and work well as a team;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. Good personality and interpersonal communication skills;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">5. Proficiency in both written and spoken English;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">6. Computer skills required for effective reporting and basic data analysis.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><span style=\"color: rgb(0, 0, 255);\"><u><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Executive Assistant</span></span></strong></u></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Duties:</span></span></strong></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. Update and manage the schedule of directors to arrange appointments, meetings and travels, etc.;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. Manage incoming and outgoing telephone calls and receive internal and external business contacts at all levels with tact;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">3. Arrange business trips for directors and their functional team as needed, including reservation of hotel, ticketing, travel document application,etc;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. Organize meetings, workshops, events, and take meeting minutes as required;&nbsp;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">5. Communicate directors\' instructions to various individuals and/or departments and convey the feedback correctly and timely;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">6. Draft, translate speeches and related documents as required;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">7. Take an active part in office admin related issues as part of the admin team;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">8. Other assignment from directors.</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></p>\r\n<p><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Requirements:</span></span></strong></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. Bachelor degree or above; Major in English preferred;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. At least 3 years secretarial experience;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">3. Fluency (written and oral) in Chinese and English is a must,Japanese is a plus;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. Good command of office software such as Word, Excel and Powerpoint;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">5. Good communication and interpersonal skills for external and internal contacts;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">6. Excellent planning, organizational and time management skills;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">7. Strong sense of responsibility, self-motivated and proactive working attitude;&nbsp;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">8. Capable to improvise with emergency;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">9. Work with patience and independence;</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">10.Ability to work well under pressure and meet strict deadlines.</span></span></p>\r\n<p>&nbsp;</p>','Job offers in qiwur_nutch_ui - qiwur_nutch_ui China relocation solutions','qiwur_nutch_ui, about qiwur_nutch_ui, job offers in qiwur_nutch_ui, China relocation, relocation China, China immigration, immigration to China, China visa, visa china, China work permit, China residence permit, apartment for rent in China, rent apartments in China, houses rent in China, home search in China, living in China, expats in China, Shanghai apartment for rent, rent apartment in Shanghai, Beijing apartment for rent, rent apartment in Beijing, Guangzhou apartment for rent, rent apartment in Guangzhou, Shanghai relocation, Beijing relocation, Guangzhou relocation, qiwur_nutch_ui.','Job offers in qiwur_nutch_ui, qiwur_nutch_ui provides all kinds of relocation services in China, including home search, school search, immigration, payroll and incorporation.','2013-10-05 13:46:33','2013-11-02 02:19:53'),(5,'Contact Us','<p><img width=\"685\" height=\"156\" alt=\"\" src=\"/app/webroot/img/uploads/fckeditor/222(5).jpg\" /></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"color: rgb(3, 35, 14);\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">qiwur_nutch_ui INTERNATIONAL</span></span></strong></span></p>\r\n<div><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Address:</span></span></strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"> Room 1204, South Building, No. 988 Dingxi Road Changning District, Shanghai 200050 China</span></span></div>\r\n<div><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Tel:</span></span></strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp; &nbsp;+86 21 5075 8626 &nbsp;&nbsp; </span></span><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Mob:</span></span></strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"> +86 181 4978 6973</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></div>\r\n<div><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></div>\r\n<div>&nbsp;</div>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. If you need information about our services of immigration, relocation or payroll,<br />\r\n</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp; &nbsp; please email to: </span><span style=\"color: rgb(0, 0, 255);\"><span style=\"font-family: Arial;\">client@qiwur_nutch_ui.com</span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. If you are landlord and want to release your properties&rsquo; information on our website,<br />\r\n</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp; &nbsp; please email to: </span><span style=\"color: rgb(0, 0, 255);\"><span style=\"font-family: Arial;\">property@qiwur_nutch_ui.com</span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: Arial; font-size: small;\">3. If you are looking for a business or media cooperation,&nbsp;<br />\r\n</span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp; &nbsp; please email to: </span><span style=\"color: rgb(0, 0, 255);\"><span style=\"font-family: Arial;\">business@qiwur_nutch_ui.com</span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. If you are a candidate of our job offers,&nbsp;<br />\r\n</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp; &nbsp; please email to: </span><span style=\"color: rgb(0, 0, 255);\"><span style=\"font-family: Arial;\">hr@qiwur_nutch_ui.com</span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<hr />\r\n<div><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><br />\r\n</span></span></div>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">1. 如果您需要我们的immigration, relocation, payroll服务<br />\r\n</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp; &nbsp; 请发送邮件至：</span><span style=\"color: rgb(0, 0, 255);\"><span style=\"font-family: Arial;\">client@qiwur_nutch_ui.com</span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">2. 如果您是业主，想通过我们来出租您的房产<br />\r\n</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp; &nbsp; 请发送邮件至：</span><span style=\"color: rgb(0, 0, 255);\"><span style=\"font-family: Arial;\">property@qiwur_nutch_ui.com</span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">3. 如果你想寻求商业合作或媒体合作<br />\r\n</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp; &nbsp; 请发送邮件至：</span><span style=\"color: rgb(0, 0, 255);\"><span style=\"font-family: Arial;\">business@qiwur_nutch_ui.com</span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">4. 如果你是人才，想加入我们的团队<br />\r\n</span></span><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp; &nbsp; 请发送邮件至：</span><span style=\"color: rgb(0, 0, 255);\"><span style=\"font-family: Arial;\">hr@qiwur_nutch_ui.com</span></span></span></p>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>','Contact us - qiwur_nutch_ui China relocation solutions','Contact us, qiwur_nutch_ui, about qiwur_nutch_ui, China relocation, relocation China, China immigration, immigration to China, China visa, visa china, China work permit, China residence permit, apartment for rent in China, rent apartments in China, houses rent in China, home search in China, living in China, expats in China, Shanghai apartment for rent, rent apartment in Shanghai, Beijing apartment for rent, rent apartment in Beijing, Guangzhou apartment for rent, rent apartment in Guangzhou, Shanghai relocation, Beijing relocation, Guangzhou relocation, qiwur_nutch_ui.','Contact us, qiwur_nutch_ui provides all kinds of relocation services in China, including home search, school search, immigration, payroll and incorporation.','2013-10-05 14:03:37','2013-12-07 20:45:50'),(6,'Immigration','<p><img width=\"685\" height=\"156\" src=\"/app/webroot/img/uploads/fckeditor/111(1).jpg\" alt=\"\" /></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">qiwur_nutch_ui provides comprehensive and seamless immigration services. We well understand the stress involved in transferring assignees to China, and our goal is to make this process smooth and simple for our clients. Our immigration services include obtaining all documents needed for your assignees and family members to visit, live or work in China.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"> </span></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Employment License</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Work visa invitation letter</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Work visa</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Work permit</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Residence permit</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Registration in the police station</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Business visa (long-term or short-term)</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Tourist visa</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>','Immigration Services - Our services - qiwur_nutch_ui China relocation solutions','Immigration, qiwur_nutch_ui, about qiwur_nutch_ui, China relocation, relocation China, China immigration, immigration to China, China visa, visa china, China employment license, China work visa, China Z visa, visa to China, visa of China, China work permit, China residence permit, immigration to Shanghai, Shanghai immigration, Beijing immigration, immigration to Beijing, Guangzhou immigration, immigration to Guangzhou, Shanghai work permit, Beijing work permit, Guangzhou work permit, Shanghai residence permit, Beijing residence permit, Guangzhou residence permit, China business visa, China F visa, China tourist visa, Shanghai apartment for rent, rent apartment in Shanghai, Beijing apartment for rent, rent apartment in Beijing, Guangzhou apartment for rent, rent apartment in Guangzhou, Shanghai relocation, Beijing relocation, Guangzhou relocation, qiwur_nutch_ui.','Immigration Services, Our services, qiwur_nutch_ui provides all kinds of relocation services in China, including home search, school search, immigration, payroll and incorporation.','2013-10-05 14:22:39','2013-12-18 17:40:05'),(7,'Relocation','<p><img width=\"685\" height=\"156\" src=\"/app/webroot/img/uploads/fckeditor/111(2).jpg\" alt=\"\" /></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Managing international relocations can be complex and time consuming. That&rsquo;s why qiwur_nutch_ui offers a spectrum of services to ensure the transitions of your assignees to China with ease and efficiency. Our experienced relocation team makes you benefit from a consistent service and the highest levels of assignee satisfaction every time.</span></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&nbsp;</span></span></span></p>\r\n<p class=\"MsoNormal\"><u><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><b><span lang=\"EN-US\">Pre-move services</span></b></span></span></u></p>\r\n<p class=\"MsoNormal\"><b><span lang=\"EN-US\"><o:p></o:p></span></b></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\">&nbsp;</p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Orientation</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Home search</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;School search</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Temporary accommodation search</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;International move coordination</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&nbsp;</span></span></span></p>\r\n<p class=\"MsoNormal\"><u><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><b><span lang=\"EN-US\">Post-move services</span></b></span></span></u></p>\r\n<p class=\"MsoNormal\"><b><span lang=\"EN-US\"><o:p></o:p></span></b></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l1 level1 lfo2\">&nbsp;</p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l1 level1 lfo2\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Settling-in</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l1 level1 lfo2\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Bank account opening</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l1 level1 lfo2\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Maid search</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l1 level1 lfo2\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Driver search</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l1 level1 lfo2\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Car renting</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l1 level1 lfo2\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Insurances purchase counseling</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&nbsp;</span></span></span></p>\r\n<p class=\"MsoNormal\"><u><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><b><span lang=\"EN-US\">Ongoing assignment services</span></b></span></span></u></p>\r\n<p class=\"MsoNormal\"><b><span lang=\"EN-US\"><o:p></o:p></span></b></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l1 level1 lfo2\">&nbsp;</p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l1 level1 lfo2\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Tenancy management</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l1 level1 lfo2\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Expense management</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l1 level1 lfo2\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Language and culture training</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>',' Relocation Services - Our services - qiwur_nutch_ui China relocation solutions','Relocation, China relocation, relocation China, Shanghai relocation, relocation in Shanghai, Beijing relocation, relocation in Beijing, Guangzhou relocation, relocation in Guangzhou, China home search, home search in Shanghai, home search in Beijing, home search in Guangzhou, orientation, China school search, temporary accommodation search, international move, settling-in, bank account opening, maid search, driver search, car rent, insurance purchasing, tenancy management, expenses management, language and culture training, China apartments, rent apartments in China, apartments for rent in China, China apartment rent, China apartments for rent, serviced apartments in China, rent serviced apartments China , living in China, expats in China, properties in China, Shanghai apartment for rent, rent apartment in Shanghai, Beijing apartment for rent, rent apartment in Beijing, Guangzhou apartment for rent, rent apartment in Guangzhou, qiwur_nutch_ui.','Relocation Services, Our services, qiwur_nutch_ui provides all kinds of relocation services in China, including home search, school search, immigration, payroll and incorporation.','2013-10-05 14:27:33','2013-11-02 02:20:32'),(8,'Payroll','<p><img width=\"685\" height=\"156\" src=\"/app/webroot/img/uploads/fckeditor/111(3).jpg\" alt=\"\" /></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">For most companies, one big challenge during an international transfer is the payroll process. qiwur_nutch_ui recognizes the importance of this key function in ensuring both the company and the assignee satisfaction. We strive to simplify the process and ease the burden of responsibility of our clients&rsquo; internal staff.&nbsp;</span></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&nbsp;</span></span></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Tax compliance counseling</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Tax gross-up</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Payslip edition</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Salary payment</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Declaration and payment of IIT (individual income tax)</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Collecting IIT certificate from Tax Bureau</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Social security charges account opening</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Social security charges calculation and payment</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>','Payroll Services - Our services - qiwur_nutch_ui China relocation solutions','Payroll, China payroll, international payroll, payroll in China, tax compliance counseling, China tax compliance counseling, tax gross-up, payslip edition, individual income tax, IIT, social security charges, China social security charges, China tax consulting, Shanghai apartment for rent, rent apartment in Shanghai, Beijing apartment for rent, rent apartment in Beijing, Guangzhou apartment for rent, rent apartment in Guangzhou, qiwur_nutch_ui.','Payroll Services, Our services, qiwur_nutch_ui provides all kinds of relocation services in China, including home search, school search, immigration, payroll and incorporation.','2013-10-05 14:29:15','2013-11-02 02:20:58'),(9,'Home Search','<p><img width=\"685\" height=\"156\" alt=\"\" src=\"/app/webroot/img/uploads/fckeditor/111(4).jpg\" /></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">Finding suitable housing is one of the most important parts of any successful relocation. Following an extensive assessment of the assignee\'s needs, the participant receives a detailed property viewing list which has been fully vetted to meet the company and individual requirements. This enables qiwur_nutch_ui to successfully complete the home search in the limited time frame.</span></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\"><span style=\"font-family: Arial;\">&nbsp;</span></span></p>\r\n<p style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\" class=\"MsoListParagraph\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Needs analysis, followed by creation of property viewing list of pre-selected properties.</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\" class=\"MsoListParagraph\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Accompanied viewing and identification of pre-selected properties.</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\" class=\"MsoListParagraph\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Tenancy Agreement negotiations.</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\" class=\"MsoListParagraph\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Execution of tenancy agreement, coordination of security deposits &amp; rent payment.</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\" class=\"MsoListParagraph\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Pre-move check 3-5 days before the check-in to confirm that the rental conditions meet the&nbsp;</span></span></span></strong></p>\r\n<p style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\" class=\"MsoListParagraph\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&nbsp; &nbsp; contractual obligations.</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p><strong> </strong></p>\r\n<p style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\" class=\"MsoListParagraph\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Accompanied check-in. </span></span></span></strong></p>\r\n<p style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\" class=\"MsoListParagraph\"><strong> </strong><strong style=\"text-indent: -21pt;\"><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Assistance with utilities applications.</span></span></span></strong></p>','Home search Services - Our services - qiwur_nutch_ui China relocation solutions','Home search in Shanghai, home search in Beijing, home search in Guangzhou, home search in China, pre-move check, inventory check, tenancy agreement negociation, propertities viewing, apartment for rent, rent apartment, home search for expats, expats living in China, China expats, Shanghai apartment for rent, rent apartment in Shanghai, Beijing apartment for rent, rent apartment in Beijing, Guangzhou apartment for rent, rent apartment in Guangzhou, qiwur_nutch_ui.','Home search Services, Our services, qiwur_nutch_ui provides all kinds of relocation services in China, including home search, school search, immigration, payroll and incorporation.','2013-10-05 14:29:58','2013-11-02 02:21:14'),(10,'Incorporation','<p><img width=\"0\" height=\"0\" src=\"/app/webroot/img/uploads/fckeditor/111(6).jpg\" alt=\"\" /><img width=\"685\" height=\"156\" src=\"/app/webroot/img/uploads/fckeditor/111(7).jpg\" alt=\"\" /></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">Over the last few decades, the world economy has undergone a rapid process of globalization. China, with its fast-developing emerging market, is a highly attractive target. Today, an increasing number of organizations are expanding their operations to China. The very first step of their adventures in China is incorporation, but for most of the people, this first step seems quite costly and a hassle. </span><span lang=\"EN\" style=\"color: rgb(34, 34, 34);\">That is why qiwur_nutch_ui is here to make this process as fast, easy and as inexpensive as possible.</span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Incorporating a Wholly Foreign Owned Enterprise (WOFE)</span></span></span></strong><span lang=\"EN-US\"><o:p></o:p></span></p>\r\n<p><strong> </strong></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Incorporating a Foreign Invested Commercial Enterprise (FICE)</span></span></span></strong></p>\r\n<p class=\"MsoListParagraph\" style=\"margin-left:21.0pt;text-indent:-21.0pt;\r\nmso-char-indent-count:0;mso-list:l0 level1 lfo1\"><strong> </strong><strong style=\"text-indent: -21pt;\"><span style=\"font-size: small;\"><span style=\"font-family: Arial;\"><span lang=\"EN-US\">&gt; &nbsp;Incorporating a Representative Office (RO)</span></span></span></strong></p>','Incorporation Services - Our services - qiwur_nutch_ui China relocation solutions','incorporation in China, China incorporation, setting up an entity in China, WOFE, Wholly Foreign Owned Enterprise , RO, FICE, Foreign Invested Commercial Enterprise , representative office in China, incorporating in china, China incorporating, setting up a company in China, setting up company, Shanghai apartment for rent, rent apartment in Shanghai, Beijing apartment for rent, rent apartment in Beijing, Guangzhou apartment for rent, rent apartment in Guangzhou,qiwur_nutch_ui.','Incorporation Services, Our services, qiwur_nutch_ui provides all kinds of relocation services in China, including home search, school search, immigration, payroll and incorporation.','2013-10-05 14:38:29','2013-11-02 02:21:28'),(11,'China Relo APP','<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"color: rgb(255, 92, 38);\"><span style=\"font-size: x-large;\"><strong>&quot;China Relo&quot; APP&nbsp; ( IOS &amp; Android )</strong></span></span><span style=\"font-size: x-large;\"><strong><br />\r\n</strong></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"color: rgb(255, 92, 38);\"><span style=\"font-size: x-large;\"><strong>-- China Relocation Guide --<br />\r\n</strong></span></span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><a target=\"_blank\" href=\"https://itunes.apple.com/app/china-relo/id827257594?ign-mpt=uo%3D5\"><img width=\"150\" height=\"25\" alt=\"\" src=\"/app/webroot/img/uploads/fckeditor/ioddl.png\" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=\"_blank\" href=\"http://www.qiwur_nutch_ui.com/files/chinarelo_1.0.apk\"><img width=\"150\" height=\"25\" alt=\"\" src=\"/app/webroot/img/uploads/fckeditor/anddl.png\" /></a></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: medium;\"><strong>&nbsp;Available In &quot;Apple Store&quot; &amp; &quot;Google Play&quot;</strong></span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<hr />\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p><img src=\"/app/webroot/img/uploads/fckeditor/app2.png\" alt=\"\" /></p>\r\n<p>&nbsp;</p>\r\n<p><a target=\"_blank\" href=\"https://play.google.com/store/apps/details?id=com.heimavista.capp.lanvue\"><br />\r\n</a></p>\r\n<p>The CHINA RELO is an indispensable APP for expats living and working in China. This China relocation guide puts all the details about China in the palm of your hand, helps you to get a thorough and inside look at the major cities in China like Shanghai, Beijing and Guangzhou &hellip;<br />\r\n&nbsp;</p>\r\n<p>Whether you want to rent apartments, serviced-apartments, villas or old houses in Shanghai, or research for international schools in Beijing, or discover restaurants and bars in Guangzhou, CHINA RELO has it.</p>\r\n<p><br />\r\nOrganized and easy- to-use format, this APP is divided into multiple sections including: housing, schooling, health care, shopping, dining, leisure and recreation, transportation, banks, travelling, pets, home cleaning&hellip; Each section provides overviews, detailed descriptions, helpful lists and websites, as well as additional resources and information.</p>\r\n<p>&nbsp;</p>\r\n<p>Please come to get this amazing APP to:</p>\r\n<p>&gt; Get massive information on Shanghai relocation, Beijing relocation and Guangzhou relocation;</p>\r\n<p>&gt; Find out how a China relocation expert might help you on China immigration, relocation, payroll and incorporating.</p>\r\n<p>&nbsp;</p>\r\n<p>CHINA RELO APP is produced by qiwur_nutch_ui International. We would like to support you at every stage of your China relocation.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>','China Relocation Guide - China Relo APP - ios & android','china relo app, china relocation guide, China immigration, immigration to China, China visa, visa china, China work permit, China residence permit, apartment for rent in China, rent apartment in China, houses rent in China, home search in China, living in China, expats in China, Shanghai apartment for rent, rent apartment in Shanghai, Beijing apartment for rent, rent apartment in Beijing, Guangzhou apartment for rent, rent apartment in Guangzhou, Shanghai relocation, Beijing relocation, Guangzhou relocation, qiwur_nutch_ui.','The China Relo is an indispensable APP for expats living and working in China. Organized and easy- to-use format, this APP is divided into multiple sections including: housing, schooling, health care, shopping, dining, leisure and recreation, transportation, banks, travelling, pets, home cleaning… Each section provides overviews, detailed descriptions, helpful lists and websites, as well as additional resources and information.','2014-03-10 12:45:05','2014-03-17 12:04:30');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `name_zh` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `root` int(10) unsigned NOT NULL,
  `children` int(10) unsigned NOT NULL,
  `layer` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `code` int(11) NOT NULL DEFAULT '0',
  `is_open` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Shanghai','上海市',0,20,1,3,0,1),(2,'Beijing','北京市',0,20,1,1,0,1),(3,'Guangzhou','广州市',0,0,1,1,0,1);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `common`
--

DROP TABLE IF EXISTS `common`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `common` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `common`
--

LOCK TABLES `common` WRITE;
/*!40000 ALTER TABLE `common` DISABLE KEYS */;
/*!40000 ALTER TABLE `common` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crawl_filters`
--

DROP TABLE IF EXISTS `crawl_filters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crawl_filters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_type` varchar(45) NOT NULL DEFAULT 'NONE',
  `url_filter` text,
  `text_filter` text,
  `parse_block_filter` text,
  `crawl_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crawl_filters`
--

LOCK TABLES `crawl_filters` WRITE;
/*!40000 ALTER TABLE `crawl_filters` DISABLE KEYS */;
INSERT INTO `crawl_filters` VALUES (1,'NONE','list.jd.com/list.html?cat=9987,653,655','{\r\n   containsAll:\"手机,平板,超级本\",\r\n   containsAny:\"数码相机,超级本,小米手机\",\r\n   notContainsAll:\"电脑,一体机,相机\",\r\n   notContainsAny:\"雅虎,谷歌,华为\"\r\n}\r\n','{\r\n   allow : [\"#content > div\", \"#paginate\"],\r\n   disallow : [\".relative\", \".shop\"]\r\n}\r\n',39,3),(3,'NONE','+http://item.jd.com/.+.html\r\n-http://item.jd.com/[1-2000000].html','{\r\n    containsAll:\"手机,平板,超级本\",\r\n    containsAny:\"数码相机,超级本,小米手机\",\r\n    notContainsAll:\"电脑,一体机,相机\",\r\n    notContainsAny:\"雅虎,谷歌,华为\"\r\n}','{\r\n    allow : [\"#content > div\", \"#paginate\"],\r\n    disallow : [\".relative\", \".shop\"]\r\n}',39,3),(8,'NONE','+http://item.jd.com/.+.html\r\n-http://item.jd.com/[1-2000000].html','{\r\n    \"containsAll\": \"三星，手机\",\r\n    \"containsAny\": \"galaxy\",\r\n    \"notContainsAll\": \"三星，平板\",\r\n    \"notContainsAny\": \"索尼，夏普\"\r\n}','{\r\n    \"allow\": [\"#content\"],\r\n    \"disallow\": [\"#comment\"]\r\n}',39,3),(9,'INDEX','+http://item.example.com/.+.html\r\n-http://item.example.com/[1-2000000].html','{\r\n    containsAll:\"Example,手机,平板,超级本\",\r\n    containsAny:\"Example,数码相机,超级本,小米手机\",\r\n    notContainsAll:\"Example,电脑,一体机,相机\",\r\n    notContainsAny:\"Example,雅虎,谷歌,华为\"\r\n}','{\r\n    \"allow\": [\"#exampleId .content > div\", \"#paginate\"],\r\n    \"disallow\": [\"#exampleId #comment\", \".shopDetail\"]\r\n}',39,3);
/*!40000 ALTER TABLE `crawl_filters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crawls`
--

DROP TABLE IF EXISTS `crawls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crawls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `rounds` int(11) NOT NULL DEFAULT '1',
  `limit` int(11) NOT NULL DEFAULT '10000',
  `finished_rounds` varchar(45) NOT NULL DEFAULT '0',
  `batchId` varchar(45) NOT NULL,
  `configId` varchar(45) NOT NULL DEFAULT 'default',
  `jobId` varchar(45) DEFAULT NULL,
  `job_type` varchar(45) NOT NULL DEFAULT 'NONE',
  `job_state` varchar(45) NOT NULL DEFAULT 'NONE',
  `job_msg` varchar(256) NOT NULL DEFAULT '',
  `job_raw_msg` varchar(1024) DEFAULT NULL,
  `seedDirectory` varchar(256) DEFAULT NULL,
  `crawlId` varchar(45) DEFAULT NULL,
  `progress` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `finished` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crawls`
--

LOCK TABLES `crawls` WRITE;
/*!40000 ALTER TABLE `crawls` DISABLE KEYS */;
INSERT INTO `crawls` VALUES (1,'vincent-crawl-20150202194511-501',1,10000,'0','','default',NULL,'','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-02 19:45:12',NULL,''),(17,'vincent-crawl-20150127180318-237',1,10000,'0','','default',NULL,'','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-01-27 18:05:36',NULL,''),(18,'vincent-crawl-20150127180318-237',1,10000,'0','','default',NULL,'','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-01-27 18:06:38',NULL,''),(19,'vincent-crawl-20150202185545-879',1,10000,'0','','default',NULL,'','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-02 18:56:04',NULL,''),(20,'vincent-crawl-20150202185545-879',1,10000,'0','','default',NULL,'','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-02 18:56:25',NULL,''),(21,'vincent-crawl-20150202185850-707',1,10000,'0','','default',NULL,'','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-02 18:58:55',NULL,''),(22,'vincent-crawl-20150202185923-598',1,10000,'1','54e09d89c9216-1424006537-3','3-22','-3-22-UPDATEDB-755494643','UPDATEDB','FINISHED','OK','{\"id\":\"-3-22-UPDATEDB-755494643\",\"type\":\"UPDATEDB\",\"confId\":\"3-22\",\"args\":{\"batch\":\"54e09d89c9216-1424006537-3\"},\"result\":{\"jobs\":{\"update-table-job_local2033321393_0005\":{\"jobID\":{\"id\":5,\"jtIdentifier\":\"local2033321393\"},\"jobName\":\"update-table\",\"counters\":{\"File Input Format Counters \":{\"BYTES_READ\":0},\"Map-Reduce Framework\":{\"MAP_OUTPUT_MATERIALIZED_BYTES\":6,\"MAP_INPUT_RECORDS\":0,\"REDUCE_SHUFFLE_BYTES\":0,\"SPILLED_RECORDS\":0,\"MAP_OUTPUT_BYTES\":0,\"COMMITTED_HEAP_BYTES\":954204160,\"CPU_MILLISECONDS\":0,\"SPLIT_RAW_BYTES\":901,\"COMBINE_INPUT_RECORDS\":0,\"REDUCE_INPUT_RECORDS\":0,\"REDUCE_INPUT_GROUPS\":0,\"COMBINE_OUTPUT_RECORDS\":0,\"PHYSICAL_MEMORY_BYTES\":0,\"REDUCE_OUTPUT_RECORDS\":0,\"VIRTUAL_MEMORY_BYTES\":0,\"MAP_OUTPUT_RECORDS\":0},\"FileSystemCounters\":{\"FILE_BYTES_READ\":5660758,\"FILE_BYTES_WRITTEN\":6539178},\"File Output Format Counters \":{\"BYTES_WRITTEN\":0}}}}},\"state\":\"FINISHED\",\"msg\":\"OK\",\"crawlId\":\"\"}','/tmp/1424006523383-0','',NULL,3,NULL,'2015-02-02 18:59:29','2015-02-15 21:21:56',''),(24,'vincent-crawl-20150215122348-906',1,10000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-15 12:24:15','2015-02-15 12:24:15',''),(25,'vincent-crawl-20150221123438-759',1,10000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-21 12:37:42','2015-02-21 12:37:42',''),(26,'vincent-crawl-20150224124358-32',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 12:48:14','2015-02-24 12:48:14',''),(27,'vincent-crawl-20150224124358-32',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 12:57:29','2015-02-24 12:57:29',''),(28,'vincent-crawl-20150224124358-32',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 12:58:19','2015-02-24 12:58:19',''),(29,'vincent-crawl-20150224124358-32',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 13:00:57','2015-02-24 13:00:57',''),(30,'vincent-crawl-20150224124358-32',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 13:01:52','2015-02-24 13:01:52',''),(31,'vincent-crawl-20150224124358-32',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 13:04:30','2015-02-24 13:04:30',''),(32,'vincent-crawl-20150224124358-32',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 13:04:53','2015-02-24 13:04:53',''),(33,'vincent-crawl-20150224130453-572',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 13:05:15','2015-02-24 13:05:15',''),(34,'vincent-crawl-20150224130601-294',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 13:06:16','2015-02-24 13:06:16',''),(35,'vincent-crawl-20150224130601-294',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 13:06:31','2015-02-24 13:06:31',''),(36,'vincent-crawl-20150224130601-294',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 13:06:41','2015-02-24 13:06:41',''),(37,'vincent-crawl-20150224130601-294',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 13:08:17','2015-02-24 13:08:17',''),(38,'vincent-crawl-20150224130601-294',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-24 13:08:56','2015-02-24 13:08:56',''),(39,'vincent-crawl-20150224130601-294',100,20000,'0','','',NULL,'NONE','NONE','','','',NULL,NULL,3,NULL,'2015-02-24 13:26:25','2015-02-27 12:02:02',''),(40,'vincent-crawl-20150225121027-77',100,20000,'0','','default',NULL,'NONE','NONE','',NULL,NULL,NULL,NULL,3,NULL,'2015-02-25 12:18:50','2015-02-25 12:18:50','');
/*!40000 ALTER TABLE `crawls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboards`
--

DROP TABLE IF EXISTS `dashboards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dashboards` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboards`
--

LOCK TABLES `dashboards` WRITE;
/*!40000 ALTER TABLE `dashboards` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extractions`
--

DROP TABLE IF EXISTS `extractions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extractions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'NOT-STARTED',
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `finished` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `crawl_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extractions`
--

LOCK TABLES `extractions` WRITE;
/*!40000 ALTER TABLE `extractions` DISABLE KEYS */;
INSERT INTO `extractions` VALUES (2,'vincent-crawl-20150224124358-32','CREATED','','2015-02-24 12:48:15','0000-00-00 00:00:00',3,26),(3,'baby-activity','NOT-STARTED','','2015-01-28 11:19:25','0000-00-00 00:00:00',3,0),(4,'vincent-crawl-20150224124358-32','CREATED','','2015-02-24 12:58:19','0000-00-00 00:00:00',3,28),(5,'vincent-crawl-20150224124358-32','CREATED','','2015-02-24 13:00:58','0000-00-00 00:00:00',3,29),(6,'vincent-crawl-20150224124358-32','CREATED','','2015-02-24 13:01:52','0000-00-00 00:00:00',3,30),(7,'vincent-crawl-20150224124358-32','CREATED','','2015-02-24 13:04:30','0000-00-00 00:00:00',3,31),(8,'vincent-crawl-20150224124358-32','CREATED','','2015-02-24 13:04:53','0000-00-00 00:00:00',3,32),(9,'vincent-crawl-20150224130453-572','CREATED','','2015-02-24 13:05:16','0000-00-00 00:00:00',3,33),(10,'vincent-crawl-20150224130601-294','CREATED','','2015-02-24 13:06:17','0000-00-00 00:00:00',3,34),(11,'vincent-crawl-20150224130601-294','CREATED','','2015-02-24 13:06:32','0000-00-00 00:00:00',3,35),(12,'vincent-crawl-20150224130601-294','CREATED','','2015-02-24 13:06:41','0000-00-00 00:00:00',3,36),(13,'vincent-crawl-20150224130601-294','CREATED','','2015-02-24 13:08:17','0000-00-00 00:00:00',3,37),(14,'vincent-crawl-20150224130601-294','CREATED','','2015-02-24 13:08:56','0000-00-00 00:00:00',3,38),(15,'vincent-crawl-20150224130601-294','CREATED','','2015-02-24 13:26:25','0000-00-00 00:00:00',3,39);
/*!40000 ALTER TABLE `extractions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geos`
--

DROP TABLE IF EXISTS `geos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geos` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geos`
--

LOCK TABLES `geos` WRITE;
/*!40000 ALTER TABLE `geos` DISABLE KEYS */;
/*!40000 ALTER TABLE `geos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `parent_id` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'root','root','2011-01-12 15:38:47','2011-01-12 15:38:47',0,1,12),(2,'superuser','superuser','2011-01-12 15:39:21','2011-01-12 15:39:21',1,2,3),(6,'system','system','2011-01-12 15:40:16','2011-01-12 15:40:16',1,10,11),(4,'user','user','2011-01-12 15:39:54','2011-01-12 15:39:54',1,6,7),(5,'enterprise','enterprise','2011-01-12 15:40:05','2011-01-12 15:40:05',1,8,9),(3,'manager','manager','2011-01-12 15:39:34','2011-01-12 15:39:34',1,4,5);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `human_actions`
--

DROP TABLE IF EXISTS `human_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `human_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL DEFAULT '1',
  `css_path` varchar(1024) NOT NULL,
  `action` varchar(45) NOT NULL,
  `keyCode` char(1) DEFAULT NULL,
  `script` text,
  `crawl_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `human_actions`
--

LOCK TABLES `human_actions` WRITE;
/*!40000 ALTER TABLE `human_actions` DISABLE KEYS */;
INSERT INTO `human_actions` VALUES (1,1,':root > div[0]','click',NULL,'',0,3),(2,1,':root > div[0]','click',NULL,'',25,3),(3,2,'#login','click',NULL,NULL,25,3),(4,1,':root > div[0]','click',NULL,NULL,39,3);
/*!40000 ALTER TABLE `human_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instances`
--

DROP TABLE IF EXISTS `instances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instances`
--

LOCK TABLES `instances` WRITE;
/*!40000 ALTER TABLE `instances` DISABLE KEYS */;
/*!40000 ALTER TABLE `instances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lmails`
--

DROP TABLE IF EXISTS `lmails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lmails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` varchar(128) NOT NULL,
  `from` varchar(2048) NOT NULL,
  `to` varchar(2048) NOT NULL,
  `reply_to` varchar(2048) DEFAULT NULL,
  `cc` varchar(2048) DEFAULT NULL,
  `bcc` varchar(2048) DEFAULT NULL,
  `subject` text NOT NULL,
  `content_html` text NOT NULL,
  `content_text` text,
  `send_as` varchar(255) DEFAULT NULL,
  `priority` int(5) NOT NULL DEFAULT '100',
  `status` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `batch_id` (`batch_id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `priority` (`priority`) USING BTREE,
  KEY `created` (`created`) USING BTREE,
  KEY `to` (`to`(333)) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lmails`
--

LOCK TABLES `lmails` WRITE;
/*!40000 ALTER TABLE `lmails` DISABLE KEYS */;
/*!40000 ALTER TABLE `lmails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nutch_configs`
--

DROP TABLE IF EXISTS `nutch_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nutch_configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `configId` varchar(256) NOT NULL,
  `force` tinyint(1) NOT NULL DEFAULT '0',
  `params` text,
  `crawl_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nutch_configs`
--

LOCK TABLES `nutch_configs` WRITE;
/*!40000 ALTER TABLE `nutch_configs` DISABLE KEYS */;
/*!40000 ALTER TABLE `nutch_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nutch_configurations`
--

DROP TABLE IF EXISTS `nutch_configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nutch_configurations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `configId` varchar(256) NOT NULL,
  `force` tinyint(1) NOT NULL DEFAULT '0',
  `params` text,
  `crawl_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nutch_configurations`
--

LOCK TABLES `nutch_configurations` WRITE;
/*!40000 ALTER TABLE `nutch_configurations` DISABLE KEYS */;
INSERT INTO `nutch_configurations` VALUES (1,'default-3',0,'{\"anchorIndexingFilter.deduplicate\":\"false\",\"crawl.gen.delay\":\"604800000\",\"db.fetch.interval.default\":\"25920000\",\"db.fetch.interval.max\":\"25920000\",\"db.fetch.retry.max\":\"3\",\"db.fetch.schedule.adaptive.dec_rate\":\"0.2\",\"db.fetch.schedule.adaptive.inc_rate\":\"0.4\",\"db.fetch.schedule.adaptive.max_interval\":\"31536000.0\",\"db.fetch.schedule.adaptive.min_interval\":\"60.0\",\"db.fetch.schedule.adaptive.sync_delta\":\"true\",\"db.fetch.schedule.adaptive.sync_delta_rate\":\"0.3\",\"db.fetch.schedule.class\":\"org.apache.nutch.crawl.DefaultFetchSchedule\",\"db.ignore.external.links\":\"false\",\"db.ignore.internal.links\":\"false\",\"db.max.anchor.length\":\"100\",\"db.max.outlinks.per.page\":\"100\",\"db.score.count.filtered\":\"false\",\"db.score.injected\":\"1.0\",\"db.score.link.external\":\"1.0\",\"db.score.link.internal\":\"1.0\",\"db.signature.class\":\"org.apache.nutch.crawl.MD5Signature\",\"db.signature.text_profile.min_token_len\":\"2\",\"db.signature.text_profile.quant_rate\":\"0.01\",\"db.update.additions.allowed\":\"true\",\"db.update.max.inlinks\":\"10000\",\"elastic.index\":\"nutch\",\"elastic.max.bulk.docs\":\"250\",\"elastic.max.bulk.size\":\"2500500\",\"elastic.port\":\"9300\",\"encodingdetector.charset.min.confidence\":\"-1\",\"fetcher.fetch.mode\":\"native\",\"fetcher.max.crawl.delay\":\"30\",\"fetcher.max.exceptions.per.queue\":\"-1\",\"fetcher.net.bandwidth\":\"1048576\",\"fetcher.parse\":\"false\",\"fetcher.queue.depth.multiplier\":\"50\",\"fetcher.queue.mode\":\"byHost\",\"fetcher.queue.use.host.settings\":\"false\",\"fetcher.server.delay\":\"5.0\",\"fetcher.server.min.delay\":\"0.0\",\"fetcher.store.content\":\"true\",\"fetcher.threads.fetch\":\"15\",\"fetcher.threads.per.queue\":\"30\",\"fetcher.throughput.threshold.check.after\":\"5\",\"fetcher.throughput.threshold.pages\":\"-1\",\"fetcher.throughput.threshold.sequence\":\"5\",\"fetcher.timelimit.mins\":\"-1\",\"fetcher.verbose\":\"false\",\"file.content.ignored\":\"true\",\"file.content.limit\":\"65536\",\"file.crawl.parent\":\"true\",\"fs.checkpoint.dir\":\"${hadoop.tmp.dir}/dfs/namesecondary\",\"fs.checkpoint.edits.dir\":\"${fs.checkpoint.dir}\",\"fs.checkpoint.period\":\"3600\",\"fs.checkpoint.size\":\"67108864\",\"fs.default.name\":\"file:///\",\"fs.file.impl\":\"org.apache.hadoop.fs.LocalFileSystem\",\"fs.ftp.impl\":\"org.apache.hadoop.fs.ftp.FTPFileSystem\",\"fs.har.impl\":\"org.apache.hadoop.fs.HarFileSystem\",\"fs.har.impl.disable.cache\":\"true\",\"fs.hdfs.impl\":\"org.apache.hadoop.hdfs.DistributedFileSystem\",\"fs.hftp.impl\":\"org.apache.hadoop.hdfs.HftpFileSystem\",\"fs.hsftp.impl\":\"org.apache.hadoop.hdfs.HsftpFileSystem\",\"fs.kfs.impl\":\"org.apache.hadoop.fs.kfs.KosmosFileSystem\",\"fs.ramfs.impl\":\"org.apache.hadoop.fs.InMemoryFileSystem\",\"fs.s3.block.size\":\"67108864\",\"fs.s3.buffer.dir\":\"${hadoop.tmp.dir}/s3\",\"fs.s3.impl\":\"org.apache.hadoop.fs.s3.S3FileSystem\",\"fs.s3.maxRetries\":\"4\",\"fs.s3.sleepTimeSeconds\":\"10\",\"fs.s3n.impl\":\"org.apache.hadoop.fs.s3native.NativeS3FileSystem\",\"fs.trash.interval\":\"0\",\"fs.webhdfs.impl\":\"org.apache.hadoop.hdfs.web.WebHdfsFileSystem\",\"ftp.content.limit\":\"65536\",\"ftp.follow.talk\":\"false\",\"ftp.keep.connection\":\"false\",\"ftp.password\":\"anonymous@example.com\",\"ftp.server.timeout\":\"100000\",\"ftp.timeout\":\"60000\",\"ftp.username\":\"anonymous\",\"generate.count.mode\":\"host\",\"generate.max.count\":\"-1\",\"generate.max.distance\":\"-1\",\"generate.update.crawldb\":\"false\",\"gora.buffer.read.limit\":\"10000\",\"gora.buffer.write.limit\":\"10000\",\"hadoop.http.authentication.kerberos.keytab\":\"${user.home}/hadoop.keytab\",\"hadoop.http.authentication.kerberos.principal\":\"HTTP/localhost@LOCALHOST\",\"hadoop.http.authentication.signature.secret.file\":\"${user.home}/hadoop-http-auth-signature-secret\",\"hadoop.http.authentication.simple.anonymous.allowed\":\"true\",\"hadoop.http.authentication.token.validity\":\"36000\",\"hadoop.http.authentication.type\":\"simple\",\"hadoop.jetty.logs.serve.aliases\":\"true\",\"hadoop.job.history.user.location\":\"${hadoop.log.dir}/history/user\",\"hadoop.logfile.count\":\"10\",\"hadoop.logfile.size\":\"10000000\",\"hadoop.native.lib\":\"true\",\"hadoop.relaxed.worker.version.check\":\"false\",\"hadoop.rpc.socket.factory.class.default\":\"org.apache.hadoop.net.StandardSocketFactory\",\"hadoop.security.authentication\":\"simple\",\"hadoop.security.authorization\":\"false\",\"hadoop.security.group.mapping\":\"org.apache.hadoop.security.ShellBasedUnixGroupsMapping\",\"hadoop.security.instrumentation.requires.admin\":\"false\",\"hadoop.security.token.service.use_ip\":\"true\",\"hadoop.security.uid.cache.secs\":\"14400\",\"hadoop.security.use-weak-http-crypto\":\"false\",\"hadoop.skip.worker.version.check\":\"false\",\"hadoop.tmp.dir\":\"/tmp/hadoop-${user.name}\",\"hadoop.util.hash.type\":\"murmur\",\"http.accept\":\"text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\",\"http.accept.language\":\"en-us,en-gb,en;q=0.7,*;q=0.3\",\"http.agent.name\":\"Qiwur Product Ontology Engine\",\"http.agent.version\":\"Nutch-2.3-SNAPSHOT\",\"http.auth.file\":\"httpclient-auth.xml\",\"http.content.limit\":\"1048576\",\"http.fetch.max.retry\":\"5\",\"http.max.delays\":\"100\",\"http.proxy.pool.update.period\":\"10000\",\"http.robots.403.allow\":\"true\",\"http.robots.obey\":\"false\",\"http.store.responsetime\":\"true\",\"http.timeout\":\"300000\",\"http.useHttp11\":\"true\",\"http.verbose\":\"false\",\"index.metadata\":\"description,keywords\",\"indexer.max.title.length\":\"100\",\"indexer.score.power\":\"0.5\",\"io.bytes.per.checksum\":\"512\",\"io.compression.codecs\":\"org.apache.hadoop.io.compress.DefaultCodec,org.apache.hadoop.io.compress.GzipCodec,org.apache.hadoop.io.compress.BZip2Codec,org.apache.hadoop.io.compress.SnappyCodec\",\"io.file.buffer.size\":\"4096\",\"io.mapfile.bloom.error.rate\":\"0.005\",\"io.mapfile.bloom.size\":\"1048576\",\"io.seqfile.compress.blocksize\":\"1000000\",\"io.seqfile.lazydecompress\":\"true\",\"io.seqfile.sorter.recordlimit\":\"1000000\",\"io.serializations\":\"org.apache.hadoop.io.serializer.WritableSerialization\",\"io.skip.checksum.errors\":\"false\",\"ipc.client.connect.max.retries\":\"10\",\"ipc.client.connection.maxidletime\":\"10000\",\"ipc.client.idlethreshold\":\"4000\",\"ipc.client.kill.max\":\"10\",\"ipc.client.tcpnodelay\":\"false\",\"ipc.server.listen.queue.size\":\"128\",\"ipc.server.tcpnodelay\":\"false\",\"lang.analyze.max.length\":\"2048\",\"lang.extraction.policy\":\"detect,identify\",\"lang.identification.only.certain\":\"false\",\"lang.ngram.max.length\":\"4\",\"lang.ngram.min.length\":\"1\",\"local.cache.size\":\"10737418240\",\"mapred.task.timeout\":\"600000\",\"metatags.names\":\"*\",\"mime.type.magic\":\"true\",\"moreIndexingFilter.indexMimeTypeParts\":\"true\",\"net.topology.impl\":\"org.apache.hadoop.net.NetworkTopology\",\"nutch.conf.uuid\":\"3c371afb-394f-4792-854b-b148707535ca\",\"nutch.master\":\"galaxyeye\",\"nutch.server.port\":\"8182\",\"parse.plugin.file\":\"parse-plugins.xml\",\"parser.caching.forbidden.policy\":\"content\",\"parser.character.encoding.default\":\"utf-8\",\"parser.html.form.use_action\":\"false\",\"parser.html.impl\":\"neko\",\"parser.skip.truncated\":\"false\",\"parser.timeout\":\"30\",\"partition.url.mode\":\"byHost\",\"plugin.auto-activation\":\"true\",\"plugin.folders\":\"plugins\",\"plugin.includes\":\"protocol-(http|crowd)|urlfilter-regex|parse-(html|tika)|index-(basic|anchor)|indexer-solr|urlnormalizer-(pass|regex|basic)|scoring-opic\",\"solr.auth\":\"false\",\"solr.commit.index\":\"true\",\"solr.commit.size\":\"250\",\"solr.mapping.file\":\"solrindex-mapping.xml\",\"solr.server.url\":\"http://localhost:8983\",\"storage.crawl.id\":\"feilong\",\"storage.data.store.class\":\"org.apache.gora.hbase.store.HBaseStore\",\"storage.schema.host\":\"host\",\"storage.schema.webpage\":\"webpage\",\"store.ip.address\":\"false\",\"topology.node.switch.mapping.impl\":\"org.apache.hadoop.net.ScriptBasedMapping\",\"topology.script.number.args\":\"100\",\"urlfilter.automaton.file\":\"automaton-urlfilter.txt\",\"urlfilter.domain.file\":\"domain-urlfilter.txt\",\"urlfilter.prefix.file\":\"prefix-urlfilter.txt\",\"urlfilter.regex.file\":\"regex-urlfilter.txt\",\"urlfilter.suffix.file\":\"suffix-urlfilter.txt\",\"urlnormalizer.loop.count\":\"1\",\"urlnormalizer.order\":\"org.apache.nutch.net.urlnormalizer.basic.BasicURLNormalizer org.apache.nutch.net.urlnormalizer.regex.RegexURLNormalizer\",\"urlnormalizer.regex.file\":\"regex-normalize.xml\",\"webinterface.private.actions\":\"false\"}',24,3);
/*!40000 ALTER TABLE `nutch_configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nutch_jobs`
--

DROP TABLE IF EXISTS `nutch_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nutch_jobs` (
  `id` int(11) NOT NULL,
  `jobId` varchar(45) DEFAULT NULL,
  `type` varchar(45) NOT NULL,
  `confId` varchar(45) NOT NULL DEFAULT 'default',
  `args` varchar(256) DEFAULT NULL,
  `state` varchar(45) NOT NULL DEFAULT 'CREATED',
  `msg` varchar(45) DEFAULT NULL,
  `crawlId` varchar(45) DEFAULT NULL,
  `result` varchar(256) DEFAULT NULL,
  `crawl_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nutch_jobs`
--

LOCK TABLES `nutch_jobs` WRITE;
/*!40000 ALTER TABLE `nutch_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `nutch_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_entities`
--

DROP TABLE IF EXISTS `page_entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `url_pattern` varchar(1024) NOT NULL DEFAULT '.+',
  `text_pattern` varchar(1024) NOT NULL DEFAULT '.+',
  `css_path` varchar(1024) NOT NULL DEFAULT ':root',
  `extraction_id` int(11) NOT NULL,
  `description` text,
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_entities`
--

LOCK TABLES `page_entities` WRITE;
/*!40000 ALTER TABLE `page_entities` DISABLE KEYS */;
INSERT INTO `page_entities` VALUES (5,'smart phone','http://item.jd.com/.+','.+',':root',12,NULL,3),(6,'smart phone','http://item.jd.com/.+','.+',':root',13,NULL,3),(7,'smart phone','http://item.jd.com/.+','.+',':root',14,NULL,3),(8,'smart phone','http://item.jd.com/.+','.+',':root',15,NULL,3);
/*!40000 ALTER TABLE `page_entities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_entity_fields`
--

DROP TABLE IF EXISTS `page_entity_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_entity_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) NOT NULL,
  `css_path` varchar(1024) NOT NULL,
  `text_extract_regex` varchar(1024) DEFAULT '.+',
  `text_validate_regex` varchar(1024) DEFAULT '.+',
  `extractor_class` varchar(1024) NOT NULL DEFAULT 'TextExtractor',
  `sql_data_type` varchar(1024) DEFAULT NULL,
  `description` text NOT NULL,
  `page_entity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_entity_fields`
--

LOCK TABLES `page_entity_fields` WRITE;
/*!40000 ALTER TABLE `page_entity_fields` DISABLE KEYS */;
INSERT INTO `page_entity_fields` VALUES (1,'title','.active > p:nth-child(2) > strong:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',1,0),(2,'address','.address','.+','.+','TextExtractor','varchar(256) default \"\"','',1,0),(3,'description','.active > p:nth-child(2) > span:nth-child(2) > b:nth-child(1)','.+','.+','RawExtractor','varchar(256) default \"\"','',1,0),(4,'gallery','#banner_detail > ul:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',1,0),(5,'location','.active > p:nth-child(2) > span:nth-child(2) > b:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',1,0),(8,'goodsProperty','.goods-property > ul','.+','.+','TextExtractor','varchar(256) default \"\"','',1,0),(9,'title','.active > p:nth-child(2) > span:nth-child(2) > b:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',1,0),(10,'title','.active > p:nth-child(2) > span:nth-child(2) > b:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',4,0),(11,'notice','.active > p:nth-child(2) > strong:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',4,0),(12,'address','.content > ul:nth-child(2) > li:nth-child(3) > span:nth-child(2)','.+','.+','TextExtractor','varchar(256) default \"\"','',4,0),(13,'description','.content > ul:nth-child(2) > li:nth-child(2) > p:nth-child(2)','.+','.+','TextExtractor','varchar(256) default \"\"','',4,0),(14,'price','#banner_detail > ul:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',1,0),(15,'title','.active > p:nth-child(2) > span:nth-child(2) > b:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',5,0),(16,'address','.active > p:nth-child(2) > strong:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',5,0),(17,'notice','#banner_detail > ul:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',9,0),(18,'description','.content > ul:nth-child(2) > li:nth-child(3) > span:nth-child(2)','.+','.+','TextExtractor','varchar(256) default \"\"','',8,0),(19,'location','.active > p:nth-child(2) > strong:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',18,0),(20,'notice','.active > p:nth-child(2) > strong:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',8,3),(24,'title','.active > p:nth-child(2) > span:nth-child(2) > b:nth-child(1)','.+','.+','TextExtractor','varchar(256) default \"\"','',8,3);
/*!40000 ALTER TABLE `page_entity_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portals`
--

DROP TABLE IF EXISTS `portals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portals` (
  `id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portals`
--

LOCK TABLES `portals` WRITE;
/*!40000 ALTER TABLE `portals` DISABLE KEYS */;
/*!40000 ALTER TABLE `portals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedulings`
--

DROP TABLE IF EXISTS `schedulings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedulings` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedulings`
--

LOCK TABLES `schedulings` WRITE;
/*!40000 ALTER TABLE `schedulings` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedulings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `searches`
--

DROP TABLE IF EXISTS `searches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `searches` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `searches`
--

LOCK TABLES `searches` WRITE;
/*!40000 ALTER TABLE `searches` DISABLE KEYS */;
/*!40000 ALTER TABLE `searches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seeds`
--

DROP TABLE IF EXISTS `seeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(1024) NOT NULL,
  `crawl_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seeds`
--

LOCK TABLES `seeds` WRITE;
/*!40000 ALTER TABLE `seeds` DISABLE KEYS */;
INSERT INTO `seeds` VALUES (2,'http://shouji.jd.com/',17),(3,'http://shouji.jd.com/',18),(4,'http://shouji.jd.com/',17),(6,'http://shouji.jd.com/',19),(7,'http://shouji.jd.com/',20),(8,'http://shouji.jd.com/',21),(9,'http://shouji.jd.com/',22),(10,'http://shouji.jd.com/',11),(11,'http://shouji.jd.com/',0),(38,'http://shouji.jd.com/',25),(44,'http://shouji.jd.com/',25),(45,'http://shouji.jd.com/',25),(46,'http://shouji.jd.com/',25),(47,'http://shouji.jd.com/',26),(48,'http://shouji.jd.com/',27),(50,'http://shouji.jd.com/',29),(51,'http://shouji.jd.com/',30),(52,'http://shouji.jd.com/',31),(53,'http://shouji.jd.com/',32),(54,'http://shouji.jd.com/',33),(55,'http://shouji.jd.com/',34),(56,'http://shouji.jd.com/',35),(57,'http://shouji.jd.com/',36),(58,'http://shouji.jd.com/',37),(59,'http://shouji.jd.com/',38),(60,'http://shouji.jd.com/',39),(64,'http://shouji.jd.com/',40),(65,'http://shouji.jd.com/',40),(69,'http://shouji.jd.com/',39);
/*!40000 ALTER TABLE `seeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('eorfmaone8s13hqvkoa8si5bj7','Config|a:3:{s:9:\"userAgent\";s:32:\"c836ed91b61dda9d2f5070186e3d3cd6\";s:4:\"time\";i:1425096243;s:7:\"timeout\";i:10;}Message|a:0:{}Auth|a:1:{s:4:\"User\";a:15:{s:2:\"id\";s:1:\"3\";s:5:\"email\";s:24:\"ivincent.zhang@gmail.com\";s:4:\"name\";s:7:\"vincent\";s:6:\"avatar\";s:30:\"avatars/predefined/default.gif\";s:10:\"avatar_big\";s:34:\"avatars/predefined/default_big.gif\";s:5:\"point\";s:1:\"0\";s:5:\"level\";s:1:\"0\";s:3:\"exp\";s:1:\"0\";s:6:\"status\";s:9:\"ACTIVATED\";s:8:\"group_id\";s:1:\"3\";s:8:\"referrer\";s:1:\"4\";s:2:\"ip\";s:16:\"::ffff:127.0.1.1\";s:10:\"statusflag\";s:1:\"0\";s:7:\"created\";s:19:\"2011-01-12 15:40:53\";s:8:\"modified\";s:19:\"2011-02-16 16:30:29\";}}',1425096243);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skey` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `svalue` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat`
--

DROP TABLE IF EXISTS `stat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat`
--

LOCK TABLES `stat` WRITE;
/*!40000 ALTER TABLE `stat` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stat_accesses`
--

DROP TABLE IF EXISTS `stat_accesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stat_accesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `param1` varchar(255) DEFAULT NULL,
  `param2` varchar(255) DEFAULT NULL,
  `param3` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `referer` varchar(4096) DEFAULT NULL,
  `uucookie` varchar(4096) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`) USING BTREE,
  KEY `ip` (`ip`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stat_accesses`
--

LOCK TABLES `stat_accesses` WRITE;
/*!40000 ALTER TABLE `stat_accesses` DISABLE KEYS */;
/*!40000 ALTER TABLE `stat_accesses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistics`
--

LOCK TABLES `statistics` WRITE;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system`
--

DROP TABLE IF EXISTS `system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system`
--

LOCK TABLES `system` WRITE;
/*!40000 ALTER TABLE `system` DISABLE KEYS */;
/*!40000 ALTER TABLE `system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(2048) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'avatars/predefined/default.gif',
  `avatar_big` varchar(2048) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'avatars/predefined/default_big.gif',
  `point` int(11) unsigned NOT NULL DEFAULT '0',
  `level` int(11) unsigned NOT NULL DEFAULT '0',
  `exp` int(11) unsigned NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'CREATED',
  `group_id` int(11) unsigned NOT NULL,
  `referrer` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `statusflag` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`) USING BTREE,
  KEY `ip` (`ip`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `created` (`created`) USING BTREE,
  KEY `modified` (`modified`) USING BTREE,
  KEY `referrer` (`referrer`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (14,'Ao4it-95393@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','eheAh-18464','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:47','2011-02-18 01:16:38'),(1,'root@logoloto.com','d32089aae03f0e7f918c320db9718b1fbe5bb4a0','Matrix','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',1,4,'::ffff:127.0.1.1',0,'2011-01-12 15:40:38','2013-12-07 14:28:47'),(8,'kPcjg-99309@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','B8nFx-47356','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:42','2011-02-18 01:08:42'),(2,'system@logoloto.com','4a996e33ab26e668e52f94add44f8df1505cee8f','system','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-01-12 15:40:52','2013-09-09 20:25:14'),(9,'dlqtd-36711@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','DisTB-51721','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:43','2011-02-18 01:08:43'),(6,'mqJp6-70490@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','BwGtJ-16906','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:05','2011-02-18 01:08:05'),(21,'PNrOQ-53720@logoloto.com','4a996e33ab26e668e52f94add44f8df1505cee8f','fn2Ba-89410','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2013-09-10 04:25:10','2013-09-09 20:25:10'),(15,'HWTJq-34561@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','NsdNa-21084','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:48','2011-02-18 01:15:05'),(16,'5HNEZ-58722@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','ZsQTk-72937','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:49','2011-02-18 01:14:55'),(13,'test001@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','test001','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',3,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:47','2011-02-18 01:19:09'),(17,'GumZZ-58259@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','IElm9-50164','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:50','2011-02-18 01:12:58'),(10,'vg2fx-20313@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','1XMUQ-28200','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:44','2011-02-18 01:08:44'),(12,'kj08m-36925@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','Rz9Om-14405','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:46','2013-09-09 19:58:57'),(4,'yueming@gmail.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','yueming','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-01-12 15:40:54','2011-02-16 08:20:34'),(20,'r5FAF-78714@logoloto.com','4a996e33ab26e668e52f94add44f8df1505cee8f','vyFKB-28709','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2013-09-10 04:22:49','2013-09-09 20:25:18'),(18,'yQzSJ-82323@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','JjIfC-73108','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:50','2011-02-18 01:10:20'),(5,'bot@qiwur_nutch_ui.com','4a996e33ab26e668e52f94add44f8df1505cee8f','liujing','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-16 15:26:38','2013-11-06 12:32:45'),(11,'rjjZx-76330@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','c4Mln-17078','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:45','2011-02-18 01:08:45'),(3,'ivincent.zhang@gmail.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','vincent','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',3,4,'::ffff:127.0.1.1',0,'2011-01-12 15:40:53','2011-02-16 08:30:29'),(7,'CKAoF-24425@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','4Lfxp-29807','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:41','2011-02-18 01:08:41'),(19,'TMgrK-53478@logoloto.com','4a996e33ab26e668e52f94add44f8df1505cee8f','DBJVh-25710','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2013-09-10 04:17:13','2013-09-09 20:25:17'),(22,'h1wNe-50375@logoloto.com','4a996e33ab26e668e52f94add44f8df1505cee8f','eGEcn-52534','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2013-12-07 22:09:40','2013-12-07 14:10:18'),(23,'AXzlV-79434@logoloto.com','83c6a76776a90a2c4251ffa6cb8a23d3fef55989','ZXtJl-97677','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.0.1',0,'2013-12-07 22:15:11','2013-12-07 14:15:42'),(24,'SwSEy-59801@logoloto.com','83c6a76776a90a2c4251ffa6cb8a23d3fef55989','X6mAh-16784','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2013-12-07 22:18:10','2013-12-07 14:18:10'),(25,'gTRIY-76752@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','OkgsB-42586','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2015-01-26 15:56:59','2015-01-26 07:56:59'),(26,'7ZF7Q-64045@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','e8aa7-89569','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2015-01-26 16:15:19','2015-01-26 08:15:19'),(27,'WCOOz-64780@logoloto.com','61bae40510ef87ecf4dfe39ac8f01dfc9adf92c8','hp11l-22399','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2015-01-26 16:15:29','2015-01-26 08:15:29');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_authorizations`
--

DROP TABLE IF EXISTS `web_authorizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_authorizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_url` varchar(2048) NOT NULL,
  `account` varchar(128) NOT NULL,
  `password_text` varchar(128) NOT NULL,
  `account_css_selector` varchar(1024) NOT NULL,
  `password_css_selector` varchar(1024) NOT NULL,
  `crawl_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_authorizations`
--

LOCK TABLES `web_authorizations` WRITE;
/*!40000 ALTER TABLE `web_authorizations` DISABLE KEYS */;
INSERT INTO `web_authorizations` VALUES (1,'https://passport.jd.com/new/login.aspx','galaxyeye','abc123','#loginname','#nloginpwd',17,3),(7,'https://passport.jd.com/new/login.aspx','galaxyeye','abc123','#loginname','#nloginpwd',17,3),(8,'https://passport.jd.com/new/login.aspx','galaxyeye','abc123','#loginname','#nloginpwd',22,3),(9,'https://passport.jd.com/new/login.aspx','galaxyeye','abc123','#loginname','#nloginpwd',25,3),(10,'https://passport.jd.com/new/login.aspx','galaxyeye','abc123','#loginname','#nloginpwd',39,3);
/*!40000 ALTER TABLE `web_authorizations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-27 12:24:35
