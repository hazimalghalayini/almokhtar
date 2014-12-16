CREATE DATABASE  IF NOT EXISTS `almokhtar` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `almokhtar`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: almokhtar
-- ------------------------------------------------------
-- Server version	5.6.12-log

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `logging_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'root','f97bd588b03b5f61ed8ce467f3c7e187','2014-12-14 20:08:32','hazim.alghalayini@gmail.com');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `seq_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL,
  `user_data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`seq_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES (124,'9211b5b8652dd82bf9d3f3a2e2672c25','::1','Mozilla/5.0 (Windows NT 6.3; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0',1418741602,''),(125,'e8b8ef7a4290720ca0581399994a845c','::1','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36',1418741117,''),(126,'6c6f0bbb55ae59cb47c30fca1628f487','::1','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36',1418746645,''),(127,'497d2455f46713c3a7407379b358dda0','::1','Mozilla/5.0 (Windows NT 6.3; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0',1418746797,'');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT 'acceptable or not',
  `publishDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `FK_new_is` (`news_id`),
  CONSTRAINT `FK_new_is` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactmsg`
--

DROP TABLE IF EXISTS `contactmsg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactmsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(22) NOT NULL,
  `email` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `msg` mediumtext NOT NULL,
  `publishDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactmsg`
--

LOCK TABLES `contactmsg` WRITE;
/*!40000 ALTER TABLE `contactmsg` DISABLE KEYS */;
/*!40000 ALTER TABLE `contactmsg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(50) NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'عام','000','2014-12-15 14:16:59'),(2,'السعودية','966','2014-12-15 14:03:16'),(3,'العراق','964','2014-12-15 14:03:40'),(4,'الإمارات','971','2014-12-15 14:04:17'),(5,'الأردن','962','2014-12-15 14:05:10'),(6,'مصر','963','2014-12-15 14:16:45');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` text NOT NULL,
  `news_description` longtext NOT NULL,
  `news_picture` varchar(100) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `main_slider` int(1) NOT NULL DEFAULT '0',
  `slider_date` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT '1',
  `country_id` int(11) NOT NULL DEFAULT '1',
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`news_id`),
  KEY `news_categoryId` (`category_id`),
  CONSTRAINT `news_categoryId` FOREIGN KEY (`category_id`) REFERENCES `news_categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (87,'يسبسيبسيبسيب','<p style=\"box-sizing: border-box; border-top-left-radius: 0px !important; border-top-right-radius: 0px !important; border-bottom-right-radius: 0px !important; border-bottom-left-radius: 0px !important; margin: 0px 0px 18px; color: rgb(0, 0, 0); direction: rtl; overflow-wrap: break-word; word-wrap: break-word; white-space: normal; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 20px; orphans: auto; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; padding: 0px; border: 0px; outline: rgb(0, 0, 0); font-size: 13px; vertical-align: baseline; font-family: Tahoma, Helvetica, sans-serif; text-align: right; background: rgb(255, 255, 255);\">تم إنشاء برنامج المنح من قبل مركز اوكسفورد للدراسات الإسلامية لإتاحة المجال للخريجين للالتحاق بدراسة تعود بالفائدة على العالم الإسلامي.</p>\r\n\r\n<p style=\"box-sizing: border-box; border-top-left-radius: 0px !important; border-top-right-radius: 0px !important; border-bottom-right-radius: 0px !important; border-bottom-left-radius: 0px !important; margin: 0px 0px 18px; color: rgb(0, 0, 0); direction: rtl; overflow-wrap: break-word; word-wrap: break-word; white-space: normal; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 20px; orphans: auto; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; padding: 0px; border: 0px; outline: rgb(0, 0, 0); font-size: 13px; vertical-align: baseline; font-family: Tahoma, Helvetica, sans-serif; text-align: right; background: rgb(255, 255, 255);\">مركز اوكسفورد للدراسات الإسلامية<span style=\"background-color:Lime;\"> هو مركز مستقل </span>معترف به في جامعة اوكسفورد. تم تأسيس المركز عام 1985 من اجل تشجيع الدراسات العلمية للإسلام والعالم الإسلامي. لمزيد من المعلومات، يرجى زيارة <a >الموقع الالكتروني لمركز اوكسفورد للدراسات الإسلامية</a>.</p>\r\n\r\n<p style=\"box-sizing: border-box; border-top-left-radius: 0px !important; border-top-right-radius: 0px !important; border-bottom-right-radius: 0px !important; border-bottom-left-radius: 0px !important; margin: 0px 0px 18px; color: rgb(0, 0, 0); direction: rtl; overflow-wrap: break-word; word-wrap: break-word; white-space: normal; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 20px; orphans: auto; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; padding: 0px; border: 0px; outline: rgb(0, 0, 0); font-size: 13px; vertical-align: baseline; font-family: Tahoma, Helvetica, sans-serif; text-align: right; background: rgb(255, 255, 255);\">ستغطي المنحة 100% من رسوم الجامعة والكلية إضافة إلى مساعدة لتغطية تكاليف المعيشة (بما لا يقل عن 13,863 جنيه استرليني). وتستمر المنحة طوال فترة البرنامج.</p>\r\n\r\n<p> </p>\r\n\r\n<p> </p>','69606850454df499af3e8700f532e4e5.jpg',30,0,'0000-00-00 00:00:00',1,1,'2014-12-15 15:17:43');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_categories`
--

DROP TABLE IF EXISTS `news_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(70) NOT NULL,
  `active` varchar(10) NOT NULL DEFAULT '''yes''' COMMENT 'this is not work yet',
  `parent_category` int(11) DEFAULT '0',
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_categories`
--

LOCK TABLES `news_categories` WRITE;
/*!40000 ALTER TABLE `news_categories` DISABLE KEYS */;
INSERT INTO `news_categories` VALUES (29,'أخبار سياسية','\'yes\'',0,'2014-12-14 20:34:06'),(30,'أخبار إقتصادية','\'yes\'',0,'2014-12-14 20:34:16'),(31,'أخبار مرئية','\'yes\'',0,'2014-12-14 20:34:24'),(32,'رياضة عربية','\'yes\'',0,'2014-12-14 20:34:58'),(33,'رياضة عالمية','\'yes\'',0,'2014-12-14 20:35:08'),(34,'المال والأعمال','\'yes\'',0,'2014-12-14 20:37:44'),(35,'السياحة والسفر','\'yes\'',0,'2014-12-14 20:37:57'),(36,'الأدب','\'yes\'',0,'2014-12-14 20:38:06'),(37,'الترفية','\'yes\'',0,'2014-12-14 20:38:12');
/*!40000 ALTER TABLE `news_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter`
--

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `publish_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'من نحن','<p>&nbsp;sssssssssss</p>\n\n<p><span>sajdhasjdkh</span></p>','2014-12-15 20:42:15'),(2,'سياسة الإستخدام','<p>سياسة&nbsp;الإستخدام</p>','2014-10-10 08:35:59');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photos` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_title` varchar(250) NOT NULL,
  `photo_src` varchar(100) NOT NULL,
  `apply_comments` int(11) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photos`
--

LOCK TABLES `photos` WRITE;
/*!40000 ALTER TABLE `photos` DISABLE KEYS */;
INSERT INTO `photos` VALUES (6,'sdfsdfdsfsdfdsf','63f7b07152c3f97ba6751c987ce3bdd9.gif',0,'2014-12-15 15:30:59');
/*!40000 ALTER TABLE `photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rss` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pinterest` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `google_plus` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video_src` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video_thumb` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visual_news`
--

DROP TABLE IF EXISTS `visual_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visual_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `news_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1',
  `video_src` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video_thumb` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visual_news`
--

LOCK TABLES `visual_news` WRITE;
/*!40000 ALTER TABLE `visual_news` DISABLE KEYS */;
INSERT INTO `visual_news` VALUES (1,'asdasd','0',2,'https://www.youtube.com/watch?v=_DFwcG-CugM','http://img.youtube.com/vi/_DFwcG-CugM/1.jpg','2014-12-15 18:53:13'),(2,'asdasd','<p>sdddd<span style=\"background-color:Yellow;\">dddd</span>dddddddddddddd<strong>ddddddddddd</strong>ddddddddd</p>\n\n<p>&nbsp;</p>',1,'https://www.youtube.com/watch?v=WJj4W9ZU_gE','http://img.youtube.com/vi/WJj4W9ZU_gE/1.jpg','2014-12-15 20:15:52'),(3,'asdasd','<p>sdddd<span style=\"background-color:Yellow;\">dddd</span>dddddddddddddd<strong>ddddddddddd</strong>ddddddddd</p>\n\n<p>&nbsp;</p>',1,'https://www.youtube.com/watch?v=WJj4W9ZU_gE','http://img.youtube.com/vi/WJj4W9ZU_gE/1.jpg','2014-12-15 20:16:14');
/*!40000 ALTER TABLE `visual_news` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-16 18:28:37
