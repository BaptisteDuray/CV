-- Adminer 4.8.1 MySQL 10.11.7-MariaDB-1:10.11.7+maria~ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `company` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `contact_number` int(11) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contact` (`id`, `firstname`, `name`, `company`, `mail`, `contact_number`, `message`, `attachment`) VALUES
(1,	'Michael',	'Schott',	'Dunder Mifflin',	'michaelschott@gmail.com',	NULL,	'Hello, this is Dunder Mifflin',	NULL),
(2,	'James',	'Peralta',	'Brooklyn 99',	'james.peralta@gmail.com',	NULL,	'Hello, this is James Peralta',	'jake-peralta-costume-6649ded39c742.webp');

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


-- 2024-05-19 11:15:15