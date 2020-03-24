-- MySQL dump 10.13  Distrib 8.0.16, for Linux (x86_64)
--
-- Host: 0.0.0.0    Database: ci4blog
-- ------------------------------------------------------
-- Server version	5.6.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog`
--

CREATE DATABASE `ci4blog`;
USE `ci4blog`;

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `blog` (
  `blog_id` varchar(16) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_body` longtext NOT NULL,
  `blog_created_time` datetime NOT NULL,
  `user_rand_id` varchar(45) NOT NULL,
  PRIMARY KEY (`blog_id`),
  KEY `fk_blog_user_rand_idx` (`user_rand_id`),
  CONSTRAINT `fk_blog_user_rand` FOREIGN KEY (`user_rand_id`) REFERENCES `users` (`user_rand_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES ('oSdM19FC2XfEKp6D','CodeIgniter4 Application Structure','&lt;h2&gt;Default Directories&lt;/h2&gt;&lt;p&gt;A fresh install has six directories: &lt;strong&gt;/app, /system, /public, /writable, /tests &lt;/strong&gt;and possibly&lt;strong&gt; /docs&lt;/strong&gt;. Each of these directories has a very specific part to play.&lt;/p&gt;&lt;p&gt;The app directory is where all of your application code lives. This comes with a default directory structure that works well for many applications. The following folders make up the basic contents&lt;/p&gt;&lt;blockquote&gt;&lt;p&gt;/app&lt;/p&gt;&lt;p&gt;-------- /Config &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; Stores the configuration files\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p&gt;-------- /Controllers &amp;nbsp; &amp;nbsp;Controllers determine the program flow\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p&gt;-------- /Database &amp;nbsp; &amp;nbsp; &amp;nbsp; Stores the database migrations and seeds files\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p&gt;-------- /Filters &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;Stores filter classes that can run before and after controller\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p&gt;-------- /Helpers &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;Helpers store collections of standalone functions\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p&gt;-------- /Language &amp;nbsp; &amp;nbsp; &amp;nbsp; Multiple language support reads the language strings from here\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p&gt;-------- /Libraries &amp;nbsp; &amp;nbsp; &amp;nbsp;Useful classes that don&#039;t fit in another category\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p&gt;-------- /Models &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; Models work with the database to represent the business entities.\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p&gt;-------- /ThirdParty &amp;nbsp; &amp;nbsp; ThirdParty libraries that can be used in application\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p&gt;-------- /Views &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;Views make up the HTML that is displayed to the client.&lt;/p&gt;&lt;/blockquote&gt;','2020-03-20 13:25:25','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_blog`
--

DROP TABLE IF EXISTS `cat_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cat_blog` (
  `cat_blog_id` int(16) NOT NULL AUTO_INCREMENT,
  `blog_id` varchar(16) NOT NULL,
  `cat_name` char(255) NOT NULL,
  PRIMARY KEY (`cat_blog_id`),
  KEY `blog_blog_id_fk_idx` (`blog_id`),
  KEY `cat_blog_category_fk_idx` (`cat_name`),
  CONSTRAINT `cat_blog_category_fk` FOREIGN KEY (`cat_name`) REFERENCES `category` (`cat_name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_blog`
--

LOCK TABLES `cat_blog` WRITE;
/*!40000 ALTER TABLE `cat_blog` DISABLE KEYS */;
INSERT INTO `cat_blog` VALUES (5,'oSdM19FC2XfEKp6D','Coding'),(6,'oSdM19FC2XfEKp6D','Javascript'),(7,'oSdM19FC2XfEKp6D','PHP'),(8,'oSdM19FC2XfEKp6D','Technology');
/*!40000 ALTER TABLE `cat_blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` char(255) NOT NULL,
  `cat_created_by` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  KEY `fk_cat_user_user-rand-id_idx` (`cat_created_by`),
  KEY `idx_category_cat_name` (`cat_name`),
  CONSTRAINT `fk_cat_user_user-rand-id` FOREIGN KEY (`cat_created_by`) REFERENCES `users` (`user_rand_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'coding','NPyJmFBl3iseS2ItxKqX98O7UZRYHcLv'),(2,'technology','NPyJmFBl3iseS2ItxKqX98O7UZRYHcLv'),(3,'information security','NPyJmFBl3iseS2ItxKqX98O7UZRYHcLv'),(4,'Testing','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk'),(5,'Adventure','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk'),(6,'Keyboard','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk'),(7,'keyboards','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk'),(8,'Hacking','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk'),(9,'Hackers','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk'),(10,'Validation','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk'),(11,'jquery','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk'),(12,'Javascript','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk'),(13,'PHP','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk'),(14,'Stackoverflow','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk'),(15,'Demo','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_text` longtext NOT NULL,
  `user_rand_id` varchar(45) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `fk_comments_users_idx` (`user_rand_id`),
  CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_rand_id`) REFERENCES `users` (`user_rand_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` varchar(16) NOT NULL,
  `user_rand_id` varchar(45) NOT NULL,
  `like_bool` tinyint(1) NOT NULL,
  PRIMARY KEY (`like_id`),
  KEY `fk_likes_blog_idx` (`blog_id`),
  KEY `fk_likes_users_idx` (`user_rand_id`),
  CONSTRAINT `fk_likes_users` FOREIGN KEY (`user_rand_id`) REFERENCES `users` (`user_rand_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `user_fname` varchar(45) DEFAULT NULL,
  `user_lname` varchar(45) DEFAULT NULL,
  `user_mail` varchar(45) NOT NULL,
  `user_pass` longtext NOT NULL,
  `user_rand_id` varchar(65) NOT NULL,
  `user_about` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  UNIQUE KEY `user_rand_id_UNIQUE` (`user_rand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'thiru112',NULL,NULL,'thiru.ap@gmail.com','d8578edf8458ce06fbc5bb76a58c5ca4','dGhpcnUxMTI=',NULL),(3,'johndoe',NULL,NULL,'johdoe@gmail.com','$2y$10$Qn6/z5bYiXcwZr8P0EgUle34vSS7ubSlKIzBrLaMZb4fEVYefwAe2','eoF2wmBCL8OkVXnv015zypbMQ7TKjcZf',NULL),(4,'admin','John','Doe','admin@mail.com','$2y$10$K1jB.O1jEGN4QT9MTryVdulh6whOMEt6k1dzSKmPzMSJB3Aenhxlq','5m6dvDbhlQSRMGUKoCIZza70fj2eWwAk','This is testing for Bio update!'),(5,'sample',NULL,NULL,'sample@gmail.com','$2y$10$OwtM9qrSfdzIraxdr5g.AenYlpqCPF98YueYCS1xcxPDZ3RpACFF.','zxkE4pyoYX7uAdleJQn5w8IU9tsh6KHq',NULL),(6,'santheepk','Santheep','K','santheep98@gmail.com','$2y$10$NPIkzkRxvQ4NA6zWpyE41uAh3R.LVQ27zbbPeJRU5isfpK1.koW76','NPyJmFBl3iseS2ItxKqX98O7UZRYHcLv','Blogger!!!!!!');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ci4blog'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-24 19:43:37
