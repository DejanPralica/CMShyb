-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.5105
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for testna
DROP DATABASE IF EXISTS `testna`;
CREATE DATABASE IF NOT EXISTS `testna` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `testna`;

-- Dumping structure for table testna.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table testna.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(50) NOT NULL AUTO_INCREMENT,
  `post_id` int(50) NOT NULL,
  `comment_time` date NOT NULL,
  `comment_body` text NOT NULL,
  `user_id` int(50) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `fk_comments_users1_idx` (`user_id`),
  KEY `fk_comment_posts_post_id` (`post_id`),
  CONSTRAINT `fk_comment_posts_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table testna.messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `recipient_user_id` int(50) NOT NULL,
  `message_title` varchar(200) NOT NULL,
  `message_time` date NOT NULL,
  `message_body` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `FK_messages_users` (`user_id`),
  KEY `FK_messages_users_2` (`recipient_user_id`),
  CONSTRAINT `FK_messages_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_messages_users_2` FOREIGN KEY (`recipient_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table testna.posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `post_name` varchar(255) NOT NULL,
  `post_time` date NOT NULL,
  `post_topic` varchar(255) NOT NULL,
  `post_body` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `fk_users_user_id` (`user_id`),
  CONSTRAINT `fk_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table testna.posts_has_categories
DROP TABLE IF EXISTS `posts_has_categories`;
CREATE TABLE IF NOT EXISTS `posts_has_categories` (
  `post_id` int(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`category_id`),
  KEY `fk_posts_has_categories_categories1_idx` (`category_id`),
  KEY `fk_posts_has_categories_posts1_idx` (`post_id`),
  CONSTRAINT `fk_posts_has_categories_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_has_categories_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table testna.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(50) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_registration_time` date NOT NULL,
  `user_country` varchar(255) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_date_of_birth` date NOT NULL,
  `user_type` enum('ADMIN','USER') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table testna.visits
DROP TABLE IF EXISTS `visits`;
CREATE TABLE IF NOT EXISTS `visits` (
  `visit` int(11) DEFAULT NULL,
  `visit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
