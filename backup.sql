-- MySQL dump 10.13  Distrib 8.0.40, for macos15.2 (arm64)
--
-- Host: localhost    Database: cake_1000
-- ------------------------------------------------------
-- Server version	9.0.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `body` text,
  `published` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `likes_count` int NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (20,2,'Super Smash Bros','Another-test-article','25 years ago, Nintendo changed forever when Mario and Pikachu beat the snot out of each other for the first time. And it wasn’t some imaginative playground game or notebook scribbles, it was a real, official, Nintendo-sanctioned clobbering! Today marks the 25th anniversary of Super Smash Bros. hitting North America on Nintendo 64, launching the franchise that would eventually culminate in the best-selling fighting game of all time. So on Smash’s birthday, let’s celebrate gaming’s biggest crossover, and speculate about where the franchise could possibly go next after the literally “ultimate” last entry.\r\n\r\nIt still blows my mind that Nintendo approved a game where its most recognizable, family-friendly faces get punched by other company icons, especially considering that Smash 64’s prototype was called Dragon King: The Fighting Game, featuring no Nintendo characters at all. But when series creator Masahiro Sakurai thought the game would be more successful with Nintendo characters, the company surprisingly agreed. The uber-protective Nintendo has a cute explanation for how its all-stars can fight, as Smash 64’s opening cutscene shows plush toys of Mario, DK, and Samus coming to life in a child’s playroom. Super Smash Bros. Melee replaced the plush toys with trophies, which eventually led to Smash for Wii U and 3DS’ amiibo, which led to hundreds of dollars leaving my bank account. But however Nintendo needs to justify it, it’s just awesome the idea got the green light.\r\n\r\n\r\n',0,'2024-07-10 21:30:59','2024-09-27 11:08:44',0,'ac4d1fc9824876ce756406f0525d50c57ded4b2a666f6dfe40a6ac5c3563fad9 8.03.40 AM.avif'),(49,2,'StarCraft 2','efsefsefsefsefsefsefesfefefsef','As I play Legacy ofs the Void, I\'m amazed how much more fun I\'m having now, with the newest version of a six-year-old real-time strategy game, than I did when it was new. Maybe it\'s the framing: Wings of Liberty had to live up to the genre-redefining StarCraft and Brood War. Legacy of the Void just has to be a great new edition of StarCraft 2, and it does that very well. Legacy of the Void offers a lot of new things, especially to people who may have been frustrated with the focus on ladder play and high-level competition that defined early StarCraft 2. Without compromising the competitive side, there are more things than ever for casual players to enjoy once the campaign is over.\r\nCo-op missions are a hugely pleasant surprise, thanks to demanding mission design and unique heroes who provide their own twist on the three races. There\'s one particularly clever mission where you and your co-op buddy control a base at the center of the map, and must fend off attacks from two sides while you sally forth and intercept enemy freight convoys. It might be the single best mission in StarCraft 2 since Wings of Liberty\'s dusk-til-dawn zombie battle.\r\n\r\nArmy variations and progression bonuses tweak the experience each time through. Playing as the mechanized Terran engineer Swann, for example, is a completely different experience from controlling any other Terran army. Swann only has access to expensive, high-tech armored units and defenses, which means his army is incredibly powerful, but gulps down resources like no other. Learning to use each hero, and trying harder difficulty levels, make co-op much more than a gimmick.\r\n\r\nCo-op is extended to traditional PvP multiplayer, and though I\'m not sure Archon Mode will change anyone\'s mind about StarCraft multiplayer, it\'s certainly a fun option. Sharing control of a single base and army with a friend is a more social, and sometimes more hilariously frustrating way to play the same fast-paced, unforgiving RTS that StarCraft has always been. I can\'t say I\'ve ever been fully on the same page with an ally, and Archon mode has caused me more mis-cast spells than it has created clutch plays, but I\'ve enjoyed myself with each outing. It doesn\'t turn StarCraft into an accessible, easy-to-learn game, but it does make it less lonely and isolating to play competitively.\r\n',0,'2024-09-27 11:11:12','2024-12-16 01:07:01',0,'CIGT53U8ZP6M1509744317189.avif'),(50,2,'Resident Evil 4','Resident-Evil-4-Review','In light of the high-quality remakes of Resident Evil 2 and 3 released in 2019 and 2020, it felt like a safe bet that Capcom would do an equally admirable job of rebuilding Resident Evil 4. Even so, when I hit the start button on this 2023 remake of the legendary 2005 action-horror game I wasn’t prepared for how forcefully it would knock my knees out from under me and suplex me headfirst into 16 hours of sustained tension and exhilaration. This fully revitalised campaign dramatically one-ups the original in almost every conceivable way. Its Spanish countryside setting is substantially more sinister, its pacing has been tightened to the point where hardly a single minute is wasted, and its controls have been modernised in order to allow its signature dynamic shooting mechanics to really shine. I’ve been waiting 18 years for a game to thrill me in the same way as Resident Evil 4; as it turns out, this whole time I’ve just been waiting for another Resident Evil 4.\r\n\r\nThe original Resident Evil 4 is a landmark installment in Capcom’s seminal survival-horror series that, for many, would need no introduction. However, considering it came out back when we assumed that Episode III would be the last Star Wars film and iPhones didn’t even exist yet, I should probably give it some context. At the time it was a big deal for Resident Evil to switch from the series’ traditional fixed-camera perspectives to a then radical over-the-shoulder viewpoint that brought us uncomfortably close to the gore and put the emphasis on reflexes and precision targeting, and as a result Resident Evil 4 was an action-horror epic without peer. Its influence has subsequently been felt in countless other third-person classics like Gears of War, Dead Space, and The Last of Us, and now its original DNA has been extracted, synthesized, and injected into a state-of-the-art host game, mutating it into a menacing new monster that\'s breathtaking to behold and immensely intimidating to encounter.\r\n\r\n\r\n',0,'2024-10-03 13:00:31','2024-11-26 11:19:05',0,'r4.webp');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles_tags`
--

DROP TABLE IF EXISTS `articles_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles_tags` (
  `article_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`article_id`,`tag_id`),
  KEY `tag_key` (`tag_id`),
  CONSTRAINT `articles_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  CONSTRAINT `articles_tags_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles_tags`
--

LOCK TABLES `articles_tags` WRITE;
/*!40000 ALTER TABLE `articles_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles_users`
--

DROP TABLE IF EXISTS `articles_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `articles_users_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles_users`
--

LOCK TABLES `articles_users` WRITE;
/*!40000 ALTER TABLE `articles_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_likes`
--

DROP TABLE IF EXISTS `comment_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment_likes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_likes`
--

LOCK TABLES `comment_likes` WRITE;
/*!40000 ALTER TABLE `comment_likes` DISABLE KEYS */;
INSERT INTO `comment_likes` VALUES (1,16,2),(2,16,2),(3,43,2),(4,16,2),(5,16,2),(6,43,2),(7,47,2),(8,16,2),(9,43,2),(10,16,2),(11,16,2),(12,16,2),(13,16,2),(14,16,2),(15,16,2),(16,16,2),(17,16,2),(18,16,2),(19,6,2),(20,6,2),(21,54,2),(22,6,2),(23,46,2),(24,7,2),(25,46,2),(26,55,2),(27,55,10),(28,57,10),(29,60,2),(30,60,2),(31,6,2),(32,67,10),(33,67,10),(34,54,2),(35,60,2),(36,60,2),(37,72,2),(38,73,2),(39,74,2),(40,75,2);
/*!40000 ALTER TABLE `comment_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (16,'This is an amazing game!!! Honestly its so cool!',1,2,'2024-08-08 01:24:38','2024-08-08 01:24:38'),(43,'love it!!',1,2,'2024-08-08 05:16:08','2024-08-08 05:16:08'),(47,'My favourite player is Fox!',1,2,'2024-08-08 06:50:14','2024-08-08 06:50:14'),(48,'Honestly, This is a good game. They need to make some change to the way fox moves tho. His charchter can lag at times. Actually im making this up for testing purposes. He is my favourite character.',1,2,'2024-08-08 06:50:44','2024-08-08 06:50:44'),(53,'dwadwadawdaw',1,2,'2024-08-08 23:04:54','2024-08-08 23:04:54'),(54,'Still a legendary game!',50,2,'2024-10-03 13:01:43','2024-10-03 13:01:43'),(60,'This game is awesome!',20,10,'2024-11-25 13:00:40','2024-11-25 13:00:40'),(67,'Protos!!!!!!',49,10,'2024-11-25 13:10:37','2024-11-25 13:10:37'),(72,'yaaa',62,2,'2024-12-09 20:39:01','2024-12-09 20:39:01'),(75,'Nice!',20,2,'2025-02-02 08:23:54','2025-02-02 08:23:54');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (1,20,2,'2024-12-13 04:03:41'),(2,20,2,'2024-12-13 04:03:57'),(3,20,2,'2024-12-13 04:03:59'),(4,20,2,'2024-12-13 04:04:07'),(5,49,2,'2024-12-13 04:06:22'),(6,50,2,'2024-12-13 18:51:31'),(8,49,10,'2024-12-16 01:05:31'),(9,20,10,'2025-01-12 07:12:50');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phinxlog`
--

DROP TABLE IF EXISTS `phinxlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phinxlog` (
  `version` bigint NOT NULL,
  `migration_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phinxlog`
--

LOCK TABLES `phinxlog` WRITE;
/*!40000 ALTER TABLE `phinxlog` DISABLE KEYS */;
INSERT INTO `phinxlog` VALUES (20240731192654,'AddLikesCountToArticles','2024-08-01 01:27:00','2024-08-01 01:27:00',0),(20240801021244,'CreateLikes','2024-08-01 11:58:09','2024-08-01 11:58:09',0),(20240806195045,'CreateComments','2024-08-07 01:50:56','2024-08-07 01:50:56',0),(20240808065548,'CreateCommentLikes','2024-08-08 13:04:18','2024-08-08 13:04:18',0),(20240808080859,'CreateThumbsReactions','2024-08-08 14:09:47','2024-08-08 14:09:47',0),(20240808202851,'CreateCommentLikes','2024-08-09 02:29:01','2024-08-09 02:29:01',0),(20240813035521,'AddImageToUsers','2024-11-27 06:47:58','2024-11-27 06:47:58',0),(20240813043741,'AddImageToArticles','2024-12-10 00:56:38','2024-12-10 00:56:38',0),(20240813043821,'RemoveImageFromUsers','2024-12-10 00:56:38','2024-12-10 00:56:38',0),(20241126234749,'AddSlugToArticles','2024-12-10 01:01:04','2024-12-10 01:01:04',0),(20241128151329,'AddUserIdToLikes','2024-12-10 01:09:34','2024-12-10 01:09:34',0),(20241209202006,'AddUserEmailToLikes','2024-12-10 03:20:20','2024-12-10 03:20:20',0),(20241209210859,'AddNewIdToLikes','2024-12-10 04:09:30','2024-12-10 04:09:30',0),(20241213001427,'AddUserIdToLikes','2024-12-13 07:14:36','2024-12-13 07:14:36',0),(20241213034156,'CreateLikesTable','2024-12-13 10:46:54','2024-12-13 10:46:54',0);
/*!40000 ALTER TABLE `phinxlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(191) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'#CakePHP','2024-07-04 16:44:54','2024-07-22 06:03:20'),(5,'#SwiftUI','2024-07-10 18:57:12','2024-07-17 08:21:40'),(7,'tag#3','2024-07-17 05:23:29','2024-07-22 20:28:05');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'lilxaiv_1@hotmail.com','$2y$10$M2RabTdcfxhBoVRxZxVtMuajCvW3AQZwEt.c0l2bg51..XZFunOyS','2024-07-07 16:34:03','2024-07-09 09:42:40'),(3,'rusconitech@hotmail.com','$2y$10$YunhQHNq4TdX5egE5.u/c.B9Q5xFEDq1iZ9enEb0zjQaip.S5AjD.','2024-07-17 04:59:02','2024-07-17 05:21:27'),(9,'smokestreamxaivv@gmail.com','$2y$10$NKjus03uL9ATF1anQimGr..ttDuUGem1eDJbnjnB9oXyy39bXpUlC','2024-11-25 11:07:04','2024-11-25 11:07:04'),(10,'xaiveryr@outlook.com','$2y$10$nDRrGWA8ibwngyTnXMuS5uHq6EifLQkj9xX7tM7fCNyImuHAWh7bO','2024-11-25 12:41:44','2024-11-25 12:41:44');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-03 17:28:14
