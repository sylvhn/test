-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for test1
CREATE DATABASE IF NOT EXISTS `test1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `test1`;

-- Dumping structure for table test1.people
CREATE TABLE IF NOT EXISTS `people` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `gender` enum('Female','Male') DEFAULT NULL,
  `parent` int(10) unsigned DEFAULT NULL,
  KEY `Index 1` (`id`),
  KEY `FK_people_people` (`parent`) USING BTREE,
  CONSTRAINT `FK_people_people` FOREIGN KEY (`parent`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table test1.people: ~11 rows (approximately)
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` (`id`, `name`, `gender`, `parent`) VALUES
	(1, 'Budi', 'Male', NULL),
	(4, 'Dedi', 'Male', 1),
	(5, 'Dodi', 'Male', 1),
	(6, 'Dede', 'Male', 1),
	(7, 'Dewi', 'Female', 1),
	(8, 'Feri', 'Male', 4),
	(9, 'Farah', 'Female', 4),
	(10, 'Gugus', 'Male', 5),
	(11, 'Gandi', 'Male', 5),
	(12, 'Hani', 'Female', 6),
	(13, 'Hana', 'Female', 6);
/*!40000 ALTER TABLE `people` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

SELECT * FROM people WHERE id=1;
SELECT * FROM people WHERE parent=1;

SELECT * FROM people WHERE parent IN (SELECT id FROM people WHERE parent = 1);

SELECT GROUP_CONCAT(NAME) AS child, parent AS parent_id FROM people WHERE parent IN (SELECT id FROM people WHERE parent=1) GROUP BY parent;

SELECT * FROM people WHERE parent IN (SELECT id FROM people WHERE parent = 1) AND gender='female';

SELECT * FROM people WHERE parent = 1 AND gender='female';

SELECT * FROM people WHERE parent IN (SELECT id FROM people WHERE parent = 1) AND gender='male';
