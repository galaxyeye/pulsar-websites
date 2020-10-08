-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: official_website_0_0_1
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acos`
--

USE `official_website_0_0_1`;

DROP TABLE IF EXISTS `acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int DEFAULT NULL,
  `rght` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(64) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_full` varchar(64) NOT NULL,
  `city_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=929 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (913,'BJ','Wangjing','BJ - Wangjing',2),(895,'SH','Gubei','SH - Gubei',1),(902,'SH','Huqingping Minhang','SH - Huqingping & Minhang',1),(921,'GZ','Zhu Jiang New Town','GZ - Zhu Jiang New Town',3),(917,'BJ','Jingshun Rd. Near ISB School','BJ - Jingshun Rd. Near ISB School',2),(911,'BJ','Lufthansa','BJ - Lufthansa',2),(900,'SH','Xintiandi','SH - Xintiandi',1),(893,'SH','Downtown','SH - Downtown',1),(920,'GZ','Tian He','GZ - Tian He',3),(909,'BJ','Dongzhimen','BJ - Dongzhimen',2),(898,'SH','Lianyang','SH - Lianyang',1),(925,'GZ','Bai Yun','GZ - Bai Yun',3),(922,'GZ','Hai Zhu','GZ - Hai Zhu',3),(926,'GZ','Li Wang','GZ - Li Wang',3),(908,'BJ','Chaoyang Park','BJ - Chaoyang Park',2),(904,'SH','Other Areas in Pudong','SH - Other Areas in Pudong',1),(912,'BJ','Sanlitun','BJ - Sanlitun',2),(897,'SH','Jinqiao','SH - Jinqiao',1),(916,'BJ','Airport Expressway','BJ - Airport Expressway',2),(910,'BJ','Lido','BJ - Lido',2),(899,'SH','Lujiazui','SH - Lujiazui',1),(914,'BJ','Jianguomen','BJ - Jianguomen',2),(906,'BJ','CBD','BJ - CBD',2),(924,'GZ','Yue Xiu','GZ - Yue Xiu',3),(915,'BJ','Olympic Village','BJ - Olympic Village',2),(923,'GZ','Er Sha Island','GZ - Er Sha Island',3),(903,'SH','Kangqiao','SH - Kangqiao',1),(907,'BJ','Changan Avenue','BJ - Changan Avenue',2),(927,'GZ','Pan Yu','GZ - Pan Yu',3),(928,'GZ','Zeng Cheng','GZ - Zeng Cheng',3),(894,'SH','Former French Concession','SH - Former French Concession',1),(918,'BJ','Jingshun Rd. Near WAB School','BJ - Jingshun Rd. Near WAB School',2),(896,'SH','Hongqiao','SH - Hongqiao',1),(901,'SH','Xujiahui','SH - Xujiahui',1);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aros` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int DEFAULT NULL,
  `rght` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aros_acos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int unsigned NOT NULL,
  `aco_id` int unsigned NOT NULL,
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `name_zh` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `root` int unsigned NOT NULL,
  `children` int unsigned NOT NULL,
  `layer` int unsigned NOT NULL,
  `order` int unsigned NOT NULL,
  `code` int NOT NULL DEFAULT '0',
  `is_open` tinyint NOT NULL,
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
-- Table structure for table `common`
--

DROP TABLE IF EXISTS `common`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `common` (
  `id` int NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `dashboards`
--

DROP TABLE IF EXISTS `dashboards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboards` (
  `id` int NOT NULL,
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
-- Table structure for table `geos`
--

DROP TABLE IF EXISTS `geos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `geos` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `parent_id` int NOT NULL,
  `lft` int NOT NULL,
  `rght` int NOT NULL,
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
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `categoryDisplay` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `duty` text NOT NULL,
  `condition` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (11,'partner','合伙人','首席科学家',NULL,NULL,'\n                1、负责柏拉图大数据基础平台的总体规划，包括业务场景和技术实现路径；<br />\n                2、负责互联网规模自动数据提取和知识图谱构建的技术攻坚；<br />\n                3、负责研究和应用电子商务、互联网金融等领域的模型构建知识和技术；<br />\n                4、负责数据分析和建模项目的业务需求和技术实现；<br />\n                5、负责数据模型等数据产品的策略分析和报告等事宜；<br />\n                6、负责大数据团队的管理<br />\n            ','\n                1、硕士及以上学历，数学、物理、统计、机器学习、计算机类专业背景；<br />\n                2、7年以上数据挖掘或机器学习领域经验，至少掌握一门编程语言C++/Java；<br />\n                3、熟悉各类模型分类与回归算法，熟悉各类变量筛选与降维算法，了解hadoop、hive、分布式仓库者优先考虑；<br />\n                4、有电商运营决策、金融信用风险建模经验者优先，有海量数据挖掘的项目经验者优先；<br />\n                5、有互联网数据挖掘经验、金融行业用户评分建模经验优先；<br />\n                6、具备良好的专业背景、逻辑能力好，有较强的创新思维、执行力和沟通能力。<br />\n            '),(12,'partner','合伙人','首席工程师',NULL,NULL,'\n                1、负责柏拉图 Web As A Database 平台内核开发和技术攻关；<br />\n                2、负责柏拉图的总体框架、 SQL 引擎、分布式网页渲染引擎的开发和维护；<br />\n                3、研究学习数据库领域的前沿技术，并投入生产使用；<br />\n                4、熟悉机器学习主流算法及其实现；<br />\n            ','\n                1、5年以上大型系统研发经验；精通 c/c++，java，bash 等编程语言，有丰富的大型后端高并发服务器系统的经验；具备快速阅读大型开源项目，着手修改的能力；<br />\n                2、熟悉 chrome 浏览器内核原理，熟悉 cef/selenium；<br />\n                3、熟悉 SQL 引擎，理解分布式数据库系统原理；对 h2database, Apache Calcite 有深入了解或开发经验的优先；<br />\n                4、熟悉一种或多种主流数据库(H2/MySQL/MongoDB/Oracle/HBase)的系统架构；<br />\n                5、具备强大的自我驱动力，保持持续学习技术的热情，乐于团队合作和技术分享；<br />\n            '),(13,'sales','营销类','销售经理',NULL,NULL,'\n    1、完成公司互联网数据产品及其定制化服务的销售任务，负责销售回款跟踪，与客户建立并维系长期良好的合作关系；<br/>\n    2、主导并完成销售过程，包括：客户开发、沟通、解决方案、商务谈判、合同流程、售后、回款；<br/>\n    3、开拓并培养新客户，维系稳定老客户。\n    ','\n    1、3年以上实际销售工作经验，有大数据行业/新零售行业解决方案经验者优先，有FMCG、互联网、4A资源者优先；<br/>\n    2、对数据产品及服务有理想有热情；<br/>\n    3、有责任心/快速学习能力，能适应快速变化；<br/>\n    4、目标导向，具有良好的沟通协作能力；<br/>\n    5、有CDP，SCRM销售经验，对用户运营了解。\n    '),(14,'sales','营销类','销售副总监',NULL,NULL,'\n    1、根据公司发展目标制订年度销售计划，并分解制定季度、月度销售策略；<br/>\n    2、以目标为导向，根据销售策略领导下属贯彻执行，完成任务；<br/>\n    3、建立健全销售团队的管理体系及工作流程并有效执行；<br/>\n    4、完成个人及团队销售业绩，熟悉大数据资源，并将自大数据价值及优势传达给客户；<br/>\n    5、与直接客户建立沟通/合作关系，具备打通直接客户的市场、品牌、媒介人员沟通管道的能力，并有效建立与客户有效合作；<br/>\n    6、负责销售团队的考核与管理工作。<br/>\n    ','1、大学本科学历或以上，市场营销、传播、广告等相关专业；<br/>\n    2、具有5年以上互联网或数据相关行业销售工作经验，有独立开发大客户的成熟经验，3年以上的销售团队管理经验；具有本行业销售者经验优先；<br/>\n    3、有极强商业sense及商业及市场洞察能力，人际变化敏锐度很高，执行到位及时，能够快速捕捉到目标客户，并达成合作；<br/>\n    4、具有极强的人际沟通影响力，能够独立地完成客户开发，主导商务谈判，能够与客户保持较持久、良好、深入的合作关系；<br/>\n    5、具有完成销售目标的绝对执行力、抗压能力较强，能够进行有效的自我调节；<br/>\n    6、责任心强，具有优秀的道德人品，相对稳定的工作履历，有事业野心。<br/>'),(15,'sales','营销类','销售经理',NULL,NULL,'\n    1、完成公司互联网数据产品及其定制化服务的销售任务，负责销售回款跟踪，与客户建立并维系长期良好的合作关系；<br/>\n    2、主导并完成销售过程，包括：客户开发、沟通、解决方案、商务谈判、合同流程、售后、回款；<br/>\n    3、开拓并培养新客户，维系稳定老客户。\n    ','\n    1、3年以上实际销售工作经验，有大数据行业/新零售行业解决方案经验者优先，有FMCG、互联网、4A资源者优先；<br/>\n    2、对数据产品及服务有理想有热情；<br/>\n    3、有责任心/快速学习能力，能适应快速变化；<br/>\n    4、目标导向，具有良好的沟通协作能力；<br/>\n    5、有CDP，SCRM销售经验，对用户运营了解。\n    '),(16,'sales','营销类','销售总监',NULL,NULL,'\n    1、挖掘客户的市场，完成公司互联网数据产品及其定制化服务的销售任务，负责销售回款跟踪，与客户建立并维系长期良好的合作关系；<br/>\n    2、主导并完成销售过程，包括：客户开发、沟通、解决方案、商务谈判、合同流程、售后、回款；<br/>\n    3、开拓并培养新客户，维系稳定老客户。<br/>\n    4、销售团队的人员与业绩管理，创建一个高效的团队动态。\n    ','\n    1、6年的业务发展和客户管理经验，或在相关行业从事市场营销相关职能有FMCG、制造、汽车行业服务经验者优先；<br/>\n    2、有责任心/快速学习能力，能适应快速变化；<br/>\n    3、目标导向，具有良好的沟通协作能力；<br/>\n    4、有较强商业及市场洞察能力，人际变化敏锐度高，能够快速捕捉到目标客户，并达成合作。\n    '),(17,'sales','营销类','高级销售经理',NULL,NULL,'\n    1、服务公司快消大客户，推进公司既有大数据解决方案在大客户市场部，研发部和销售部门等的销售和推广；<br/>\n    2、积极自主开拓目标行业中大型客户，集中于日化美妆，母婴健康，食品饮料，零售渠道等目标行业；<br/>\n    3、有效维护客勤关系，积极向上及横向拓展中大型客户关系网络；<br/>\n    4、有效管理客户预期，并高效协同内部项目和产品部门的交付；<br/>\n    5、独立完成销售过程，包括：客户开发、沟通、解决方案、商务谈判、合同流程、售后、回款；\n    ','\n    1、本科以上学历，市场/营销相关专业优先；<br/>\n    2、2年以上销售开拓工作经验，有独立开拓能力；<br/>\n    3、有快消（日化美妆/食品饮料/母婴健康/零售渠道）、互联网等行业服务经验者优先；<br/>\n    4、性格外向积极乐观，快速学习能力；<br/>\n    5、具有良好的沟通协作能力，有解决方案销售经验优佳。\n    '),(18,'sales','营销类','售前经理',NULL,NULL,'\n    1、协助销售人员完成售前工作，包括：定制方案、重要客户会议、产品／技术客户交流等。支持销售人员进行方案销售、投招标文件撰写等销售活动；<br/>\n    2、持续行业产品竞争分析及市场动态信息收集，提供标准化、模块化的解决方案，并定期更新；<br/>\n    3、根据项目需求，协调产品技术团队进行方案开发和落地；<br/>\n    4、协助内部人员、客户进行知识培训等；<br/>\n    5、协助市场部人员提供市场活动相关材料。\n    ','\n    1、本科及以上学历，经济学、统计学、社会学、商业分析或相关专业；<br/>\n    2、5年以上咨询、行业研究、数据分析、解决方案等相关工作经验，熟悉售前支持业务流程；<br/>\n    3、具有较强的大数据分析或市场研究经验，大数据产品需求分析能力、问题分析及解决能力、产品解决方案设计制作能力，会使用脑图、项目管理等工具；<br/>\n    4、具有良好的沟通表达和人际理解能力，能与客户进行技术交流和需求引导、产品培训及宣讲；<br/>\n    5、具备独立完成PPT制作，报告撰写能力；<br/>\n    6、有市场咨询、行业研究、解决方案工作经验背景优先。\n    '),(19,'engineering','技术类','项目经理',NULL,NULL,'\n    1、负责企业定制化大数据项目管理，能够提供大数据平台建设、数据管理平台建设，以及基于平台上的大数据分析解决方案；<br/>\n    2、负责项目用户需求分析、挖掘、细化出项目需求，负责项目相关产出物、文档、汇报材料的统筹和质量把控；<br/>\n    3、负责项目团队管理，可以带领项目成员按时完成设计及开发工作；<br/>\n    4、负责项目开发进程管理，能够组织项目组技术选型攻关、组织技术团队完成技术工作；<br/>\n    5、积极响应客户需求，提升客户满意度。\n    ','\n    1、本科以上学历，计算机软件相关专业背景优先；<br/>\n    2、熟悉大数据生态和相关开源项目，需要具备大数据相关项目管理经验；<br/>\n    3、优秀的沟通能力与团队协作能力，良好的审美和文档能力；<br/>\n    4、具备良好的时间观念、质量意识；<br/>\n    5、具备快消行业/乳业/食品饮料类优先；<br/>\n    6、有市场洞察、品牌资产、客群分析、产品R&D、会员运营相关项目经验优先。<br/>\n    '),(20,'engineering','技术类','大数据工程师',NULL,NULL,'\n    1、基于HADOOP的中台系统建设，参与完成企业级数据平台设计与实施；<br/>\n    2、参与数仓、DMP、数据分析系统、推荐系统的应用开发； <br/>\n    3、大数据相关系统调研、优化和功能开发。\n    ','\n    1、本科或以上学历，计算机相关专业，有操作系统、数据库等专业知识基础；<br/>\n    2、良好的系统分析、代码编写能力；<br/>\n    3、有较强的学习能力和思考问题能力，责任心强，有良好的沟通适应能力；<br/>\n    4、熟悉Java，熟悉IO、多线程、RPC等基础技术；<br/>\n    5、熟悉一个以上大数据计算框架（Hadoop、Spark、Storm、Flink等）；<br/>\n    6、并较熟悉一个以上大数据数据库或查询引擎（HBase、Hive、Cassandra、ElasticSearch等）。<br/><br/>\n    优先条件: <br/>\n    1、具备数仓开发经验者优先。<br/>\n    2、具备JAVA WEB开发经验者优先。<br/>\n    '),(21,'engineering','技术类','高级爬虫工程师',NULL,NULL,'\n    1、负责各类电商平台和app端数据抓取和平台搭建；<br/>\n    2、负责对爬取数据进行分类和解析；<br/>\n    3、负责开发高性能抓取架构，支持业务发展；<br/>\n    4、负责爬虫技术公关和平台运维相关工作。<br/>\n    ','\n    1、本科及以上学历，三年及以上相关工作经验；<br/>\n    2、熟悉linux平台，熟练掌握java/shell/http协议，熟悉HTML、DOM、XPath，掌握git、maven、svn等工具和实践，注重工程规范；<br/>\n    3、熟悉app端数据抓取（有逆向、脱壳等经验），掌握Apktool、dex2jar、JD-GUI等工具，抓取过主流电商平台和主流app软件；<br/>\n    4、至少1年的分布式爬虫开发经验，熟悉浏览器内核，有cef、webkit开发经验优先；<br/>\n    5、有安卓/iOS相关开发经验者优先；<br/>\n    6、性格开朗、善于沟通，有良好的自我驱动学习能力，注重效率和团队意识，有团队管理经验优先。<br/>\n    '),(22,'engineering','技术类','高级JAVA工程师（平台建设）',NULL,NULL,'\n    1、参与面向企业的PaaS平台系统的后台模块设计和开发；<br/>\n    2、参与业务原始需求讨论、需求分析， 进行系统框架和核心模块的详细设计， 转化为开发任务；<br/>\n    3、根据开发规范编写各种开发文档及项目文档\n    ','\n    1、计算机相关专业本科， 五年以上工作经验；<br/>\n    2、linux和Java基础扎实，有丰富的Java开发经验， 熟悉JVM调试工具、linux调试工具优先；<br/>\n    3、熟练使用SpringMVC/SpringBoot/Spring cloud/Mybatis等框架， 对网络、IO、多线程、高并发等有实践经验优先；<br/>\n    4、掌握MySQL、Redis、activeMQ、kafka等常见存储系统/组件的使用，有深入了解相关组件底层模型和优化经验者优先；<br/>\n    5、有Spark/Hbase/Elasticsearch等开发经验者优先；<br/>\n    6、积极主动，能承受压力，良好的团队意识，善于沟通，工作仔细，责任心强；<br/>\n    7、此外，我们希望你是一位有潜力和热情的工程师：<br/>\n      a. 良好的设计和编码品味，热爱后端技术，有较强的学习能力，有强烈的求知欲、好奇心和进取心；<br/>\n      b. 良好的技术敏感度和产品sense，能及时关注和学习业界最新的后端技术，以技术反哺驱动业务；<br/>\n      c. 良好的服务意识、责任心、较强的学习能力，优秀的团队沟通与协作能力。'),(23,'engineering','技术类','高级JAVA工程师（项目交付）',NULL,NULL,'\n    1、参与制定和实施重大技术决策和技术方案；<br/>\n    2、指导研发团队开发工作，负责核心和关键技术的预研与攻关，系统优化，协助解决项目开发和产品研发过程中的技术难题；<br/>\n    3、根据产品和项目需求，分析、设计与实现系统架构方案，对相关产品或项目系统架构方案，总体设计进行评审及改进，控制产品系统架构和设计质量；<br/>\n    4、负责软件测试、集成、交付等过程中所需的接口规范和技术支持；<br/>\n    5、进行项目技术资源调配，进度、成本控制和项目任务分解分派；从技术侧对项目的成果进行把关。<br/>\n    ','\n    1、丰富的JAVA EE相关经验（Spring系列），熟悉使用大数据相关组件：elasticsearch,hadoop, hdfs, yarn, spark;<br/>\n    2、带过项目或者开发团队，有不错的技术规划和管理能力；<br/>\n    3、有宏观把控能力，能迅速判断最有利的技术实现方式，对接产品及需求部门沟通顺畅；<br/>\n    4、愿意思考和尝试，有从0到1的能力。\n    '),(24,'engineering','技术类','高级大数据工程师',NULL,NULL,'\n    1、深入研究支撑大数据业务相关技术，持续优化服务架构；<br />\n    2、深度参与数据处理和存储的业务系统的设计与实施；<br/>\n    3、分布式存储计算框架的bug修正、二次开发及性能优化；<br/>\n    4、大数据技术前瞻性研究与实现；<br/>\n    5、大数据相关产品调研、优化和功能开发。\n    ','\n    1、本科或以上学历，计算机相关专业，有操作系统、数据库等专业知识基础；<br/>\n    2、良好的系统分析、代码编写能力；<br/>\n    3、需要有较强的学习能力和思考问题能力，责任心强，有良好的沟通适应能力；<br/>\n    4、熟悉Java，熟悉IO、多线程、RPC等基础技术；<br/>\n    5、实践并较熟悉以下大数据工具，Hadoop、Spark、HBase、ElasticSearch，且有两年以上相关工作经验。\n    '),(25,'engineering','技术类','大数据技术经理/主管',NULL,NULL,'\n    1、具备良好的业务沟通能力， 能分析客户业务需求；<br/>\n    2、整合公司的技术平台产品， 进行可落地的架构规划设计、技术实现方案设计；<br/>\n    3、参与企业大数据平台实施、数据模型设计及开发，配合制定开发计划、编写开发文档、部署方案等；<br/>\n    4、负责项目交付过程的技术管理、团队人员管理，保证项目交付质量。\n    ','\n    1、有扎实的计算机基础，良好的沟通能力、技术架构设计能力；<br/>\n    2、5年以上大数据领域相关项目开发经验， 2年以上项目管理与团队管理经验， 有To B企业服务经验优先；<br/>\n    3、熟练并掌握大数据/分布式计算框架，如hive、Elasticsearch、presto、oracle，了解olap技术优先 ；<br/>\n    4、熟练掌握传统关系型数据库， 熟悉spring cloud 微服务架构；<br/>\n    5、熟悉并掌握Linux环境下的开发、运维以及调试优先；<br/>\n    6、优秀的沟通能力、文档能力， 有较强的学习能力和主动思考能力。\n    '),(26,'engineering','技术类','全栈工程师',NULL,NULL,'\n    1、负责完成业务系统开发，支持业务需求的研发；负责完成产品的迭代升级以及底层架构的升级研发；<br/>\n    2、完成数据洞察任务，并能持续优化分析与处理；<br/>\n    3、对接自研大数据平台相关服务，具有良好的架构思维；<br/>\n    4、完成模块缺陷修复，包括同行复审指出的代码缺陷、测试过程中发现的问题、模块使用中报告的问题等。\n    ','\n    1、有扎实的Java基础知识，实际的Java项目开发工作经验，有较好的编码能力；<br/>\n    2、熟悉Linux、Git，并熟悉常用的命令与参数含义；<br/>\n    3、熟练掌握大数据计算框架hadoop和spark，对hbase和hive组件有较好的认识；<br/>\n    4、熟悉spring cloud相关微服务框架，了解web编程模型，并有实践经验；<br/>\n    5、有较强的学习能力和思考能力，能主动完成需求对接；<br/>\n    6、具备良好的编码习惯和较强的文档编写能力。<br/>\n        \n    以下条件优先考虑：<br/>\n    1、熟练掌握查询引擎Elasticsearch、presto、kylin，对存储特性理解透彻；<br/>\n    2、兼具大数据开发、web开发经验各2年以上，对数据敏感；<br/>\n    3、有中台PaaS平台产品服务设计或应用经验。\n    '),(27,'analyst','数据分析类','数据分析经理',NULL,NULL,'\n    1、带领团队服务制造、快消、汽车、零售等行业知名大客户，负责需求沟通、研究方案设计、项目管理和最终交付；<br/>\n    2、基于需求理解，整合使用大数据和分析工具完成深度洞察的商业分析报告，为客户提供切实可行的商业建议；<br/>\n    3、总结沉淀项目经验，设计商业解决方案，并驱动内部分析产品的研发与优化；<br/>\n    4、管理和培养分析师团队，制定团队管理与工作计划，完成团队KPI。\n    ','\n    1、了解制造、快消、互联网、零售等行业，有极强的商业sense和数据sense，善于利用数据挖掘商业价值，帮助企业解答商业问题；<br/>\n    2、熟练掌握各类研究方法，思维逻辑严密，搭建清晰的研究框架，能针对数据分析结论提出有指导意义的商业建议；<br/>\n    3、优秀的沟通协调能力，抗压性强，自我驱动力强，结果导向；<br/>\n    4、3年以上相关工作经验，其中1年以上团队管理经验，优秀者可适当放宽；<br/>\n    5、有互联网数据分析、市场研究、咨询行业背景者优先。\n    '),(28,'analyst','数据分析类','数据分析师',NULL,NULL,'\n    1、与客户沟通，理解、细化客户的数据分析需求，了解客户对数据需求背后的目的，更好地为客户提供解决方案。需求范围包括：企业网络舆情、品牌网络口碑、消费者洞察、社会化运营数据、产品体验和创新等；<br/>\n    2、根据商业背景和相关行业背景，搭建清晰的研究框架，设计研究方案，将客户需求落地；<br/>\n    3、基于多维大数据以及不同数据特点，使用公司自有大数据分析工具，洞悉数据背后的信息，满足客户的分析需求；结合自身和团队的研究经验，基于数据洞察结果提出合理的解决方案和意见，提升数据价值；<br/>\n    4、承担分析报告撰写的主笔工作。\n    ','\n    1、有3年以上的咨询公司、广告/公关公司或大型企业市场研究或用户研究部门工作背景；<br/>\n    2、对制造、快消、互联网、零售等行业及商业模式有一定的了解，对数据有较高的敏锐性；<br/>\n    3、具备数据操作能力，熟练使用excel，熟练使用SPSS等至少一种统计软件；<br/>\n    4、具备独立完成PPT制作，良好的英文写作能力，能撰写英文分析报告；<br/>\n    5、良好的沟通与表达能力，能与客户对接需求。\n    '),(29,'analyst','数据分析类','商业分析经理',NULL,NULL,'\n    1、带领团队服务快消、零售、互联网等行业知名大客户，负责需求沟通、研究方案设计、项目管理和最终交付；<br/>\n    2、基于需求理解，整合使用大数据和分析工具完成深度洞察的商业分析报告，为客户提供切实可行的商业建议；<br/>\n    3、总结沉淀项目经验，设计商业解决方案，并驱动内部分析产品的研发与优化；<br/>\n    4、管理和培养分析师团队，制定团队管理与工作计划，完成团队KPI。\n    ','\n    1、了解制造、快消、互联网、零售等行业，有极强的商业sense和数据sense，善于利用数据挖掘商业价值，帮助企业解答商业问题；<br/>\n    2、熟练掌握各类研究方法，思维逻辑严密，搭建清晰的研究框架，能针对数据分析结论提出有指导意义的商业建议；<br/>\n    3、优秀的沟通协调能力，抗压性强，自我驱动力强，结果导向；<br/>\n    4、5年以上相关工作经验，其中2年以上团队管理经验，优秀者可适当放宽；<br/>\n    5、大学本科或以上学历，商科、数学、统计、计算机等相关专业优先；<br/>\n    6、有互联网数据分析、市场研究、咨询行业背景者优先。\n    '),(30,'pm','产品类','产品经理',NULL,NULL,'\n    1、负责重点客户产品需求沟通，撰写需求文档，与研发团队配合推动产品开发及上线；<br/>\n    2、负责大数据应用市场信息及竞争产品信息的收集与分析，结合客户需求进行产品规划和设计，并与研发配合推动产品上线；<br/>\n    3、负责产品市场销售相关文档的撰写，配合销售部门、市场部门做好产品售前、运营推广策划。\n    ','\n    1、3年以上互联网产品设计相关工作经验，熟练掌握Axure RP等原型工具；<br/>\n    2、有大客户沟通经验，互联网行业优先；<br/>\n    3、执行力强，有产品迭代管理经验；<br/>\n    4、有优秀的沟通表达与写作能力；<br/>\n    5、有媒介投放、媒介评估等商业应用产品经验者优先；<br/>\n    6、有市场营销和市场研究相关经验者优先。\n    '),(31,'pm','产品类','数据平台产品经理',NULL,NULL,'\n    1、对接各项目对数据服务/数据应用/数据可视化等需求，针对需求进行平台规划和设计，挖掘使用场景；<br/>\n    2、跟进内部数据中台产品版本迭代，与开发团队密切协作，把控需求，协调进度，确保产品按时保质上线；<br/>\n    3、能够独立完成产品规划，输出产品需求文档、产品操作手册、产品白皮书等，推动内部对产品的使用运营工作；<br/>\n    4、定期对自身产品、整体行业、竞争对手等进行数据分析和评估；<br/>\n    ','\n    1、本科学历及以上，3年平台或数据产品经理工作经验；<br/>\n    2、对数据可视化、服务化有自己独特的见解，对数据仓库、数据治理、数据模型有经验者优先；<br/>\n    3、有较强的数据思维、逻辑思维及平台抽象化能力，目标感强，熟悉SQL语言；<br/>\n    4、具备一定的IT能力或相关专业背景者优先。\n    '),(32,'pm','产品类','数据产品经理',NULL,NULL,'\n    1、负责toB互联网数据产品的产品规划和设计工作；<br/>\n    2、结合数据价值、用户需求、ROI等评估产品机会，完成产品市场调研、需求分析、原型设计，与数据、算法、开发团队紧密合作推进产品按时上线 ；<br/>\n    3、持续关注并研究产品运营数据、行业同类产品动态，用数据指导产品迭代；<br/>\n    4、与售前/销售/项目团队协同工作，做好产品售前支持、运营推广策划，对产品落地负责；\n    ','\n    1、本科以上学历，3年以上互联网产品经验，计算机、数学、统计学等相关专业；<br/>\n    2、具备良好的数据敏感度和业务视野，能结合业务和数据，给予决策建议；<br/>\n    3、熟悉互联网数据分析方法论，对数据采集架构、NLP算法有一定了解；<br/>\n    4、责任心强、跨团队合作能力强，具备良好的沟通协调和自我驱动能力，能承担一定压力。\n    '),(33,'other','其他类别','政府关系总监',NULL,NULL,'\n    1、负责政府相关主要部门的关系挖掘、维护和日常联络；<br/>\n    2、针对公司情况，分析与研究国家各级政府科技政策，及时向公司提供科技项目政策信息；<br/>\n    3、日常性跟踪政府各渠道科技项目申报信息，结合公司具体情况，有针对性地及时申报；<br/>\n    4、整合公司内部资源，独立完成申报材料的撰写与统筹，高效率、高质量地完成申报工作；<br/>\n    5、负责组织公司的知识产权、资质的申报和管理。\n    ','\n    1、5年以上各类科技项目资助申报工作经验；<br/>\n    2、乐观、积极、开朗，具有较好的各级政府关系的开拓及维护能力；<br/>\n    3、熟悉国家级、省级、市级项目、县区级科技政策及其配套政策，熟知有关法规体系、申报要求和流程；<br/>\n    4、有较好的竞争性项目的运作、培育、拿单的能力；<br/>\n    5、全日制本科及以上学历，有政府工作背景者优先考虑。\n   ');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `users` VALUES (14,'Ao4it-95393@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','eheAh-18464','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:47','2011-02-18 01:16:38'),(1,'root@logoloto.com','d32089aae03f0e7f918c320db9718b1fbe5bb4a0','Matrix','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',1,4,'::ffff:127.0.1.1',0,'2011-01-12 15:40:38','2013-12-07 14:28:47'),(8,'kPcjg-99309@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','B8nFx-47356','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:42','2011-02-18 01:08:42'),(2,'system@logoloto.com','4a996e33ab26e668e52f94add44f8df1505cee8f','system','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-01-12 15:40:52','2013-09-09 20:25:14'),(9,'xuezhong@qiwur.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','DisTB-51721','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:43','2015-03-30 12:18:31'),(6,'mqJp6-70490@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','BwGtJ-16906','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:05','2015-03-30 12:18:31'),(21,'PNrOQ-53720@logoloto.com','4a996e33ab26e668e52f94add44f8df1505cee8f','fn2Ba-89410','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.0.1',0,'2013-09-10 04:25:10','2015-03-30 12:18:31'),(15,'HWTJq-34561@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','NsdNa-21084','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:48','2011-02-18 01:15:05'),(16,'5HNEZ-58722@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','ZsQTk-72937','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:49','2011-02-18 01:14:55'),(13,'test001@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','test001','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',3,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:47','2011-02-18 01:19:09'),(17,'GumZZ-58259@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','IElm9-50164','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:50','2011-02-18 01:12:58'),(10,'vg2fx-20313@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','1XMUQ-28200','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:44','2015-03-30 12:18:31'),(12,'kj08m-36925@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','Rz9Om-14405','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:46','2013-09-09 19:58:57'),(4,'yueming@gmail.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','yueming','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-01-12 15:40:54','2011-02-16 08:20:34'),(20,'r5FAF-78714@logoloto.com','4a996e33ab26e668e52f94add44f8df1505cee8f','vyFKB-28709','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2013-09-10 04:22:49','2013-09-09 20:25:18'),(18,'yQzSJ-82323@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','JjIfC-73108','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:50','2011-02-18 01:10:20'),(5,'bot@qiwu_data_engine.com','4a996e33ab26e668e52f94add44f8df1505cee8f','liujing','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-16 15:26:38','2013-11-06 12:32:45'),(11,'rjjZx-76330@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','c4Mln-17078','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:45','2011-02-18 01:08:45'),(3,'ivincent.zhang@gmail.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','vincent','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',3,4,'::ffff:127.0.1.1',0,'2011-01-12 15:40:53','2011-02-16 08:30:29'),(7,'CKAoF-24425@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','4Lfxp-29807','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.1.1',0,'2011-02-18 09:08:41','2015-03-30 12:18:31'),(19,'TMgrK-53478@logoloto.com','4a996e33ab26e668e52f94add44f8df1505cee8f','DBJVh-25710','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.0.1',0,'2013-09-10 04:17:13','2015-03-30 12:18:31'),(22,'h1wNe-50375@logoloto.com','4a996e33ab26e668e52f94add44f8df1505cee8f','eGEcn-52534','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.0.1',0,'2013-12-07 22:09:40','2015-03-30 12:18:31'),(23,'github@example.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','ZXtJl-97677','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'ACTIVATED',4,4,'::ffff:127.0.0.1',0,'2013-12-07 22:15:11','2015-07-01 06:57:12'),(24,'SwSEy-59801@logoloto.com','83c6a76776a90a2c4251ffa6cb8a23d3fef55989','X6mAh-16784','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2013-12-07 22:18:10','2013-12-07 14:18:10'),(25,'gTRIY-76752@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','OkgsB-42586','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2015-01-26 15:56:59','2015-01-26 07:56:59'),(26,'7ZF7Q-64045@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','e8aa7-89569','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2015-01-26 16:15:19','2015-01-26 08:15:19'),(27,'7BE6Q-92545@logoloto.com','2331324ff7250c56f4440c38a8cebca04d8cc4f9','hp11l-22399','avatars/predefined/default.gif','avatars/predefined/default_big.gif',0,0,0,'CREATED',4,4,'::ffff:127.0.0.1',0,'2015-01-26 16:15:29','2015-07-01 06:56:29');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

--
-- Table structure for table `solutions`
--

DROP TABLE IF EXISTS `solutions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solutions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `symbol` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solutions`
--

LOCK TABLES `solutions` WRITE;
/*!40000 ALTER TABLE `solutions` DISABLE KEYS */;
INSERT INTO `solutions` VALUES (12,'price-intelligent','价格情报','通过 Web 数据提取实现卓越的定价数据智能。','通过 Web 数据提取，通过高质量的定价数据智能定位产品并做出盈利决策。'),(13,'ecommerce','电商选品','使用 Web BI 实现电商选品决策。','通过 Web BI，分析全网电商多维度数据，实现热卖和爆款商品预测。'),(14,'marketing-channel','渠道巡检','使用 Web BI 监测产品渠道，确保渠道合法合规。','使用 Web BI 监测产品渠道，确保渠道合法合规，渠道价格定价正确。'),(15,'customer-discovery','潜在顾客生成','使用高质量的 Web 提取数据构建高质量潜在客户列表。','构建目标客户列表，通过 Web 数据提取促进收入增长并生成智能潜在客户。'),(16,'brand-monitoring','品牌监测','通过网络数据提取进行品牌监控，跟踪并保护您的品牌。','使用高质量和可靠的品牌和定价数据，确保您的品牌声誉在线受到保护。'),(17,'recruitment','招聘','通过网络数据提取，提供具有高质量人力资源和招聘数据的顶尖人才。','使用高质量的数据进行职位列表、应聘者来源、薪酬水平和市场洞察，以做出更好的招聘决策并吸引人才。'),(18,'financial','金融替代数据','使用高质量的金融 Web 数据做出利益攸关的决策。','利用来自 Web 的替代财务数据，在不断加速的市场中获取可操作的见解并做出明智的投资决策。'),(19,'rpa','业务自动化','使用 Web BI 实现业务各个方面的自动化。','通过 Web 数据提取，实现业务内部流程的自动化，并在整个业务中快速移动数据。'),(20,'product-building','构建产品','通过 Web 数据提取为数据驱动项目提供产品数据。','从 Web 中提取的高质量产品数据，可保持数据管道健康，让您专注于产品开发。'),(21,'market-research','市场调查','通过 Web 数据提取创新您的市场调查。','借助高质量和可靠的市场数据，了解您的市场、提供研究，并随时了解趋势。'),(22,'public-opinion','网络舆情','监测网络民情民意，为相关政府部门提供数据支撑。','利用来自新闻、论坛、贴吧、微博等来源的数据，为相关政府部门做出正确决策、舆情应对和政务实施提供数据支撑。'),(23,'background-check','背景调查','使用 Web BI 和知识图谱，洞察人员背景，控制合作风险。','使用 Web BI 和知识图谱，洞察合作伙伴、谈判对手、重要嘉宾、求职者等人员的背景，以控制合作风险。');
/*!40000 ALTER TABLE `solutions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-06 21:41:29
