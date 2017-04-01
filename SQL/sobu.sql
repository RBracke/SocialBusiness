DROP DATABASE IF EXISTS `sobu`;
CREATE DATABASE IF NOT EXISTS `sobu`;
USE `sobu`;

DROP TABLE IF EXISTS `message`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `rights`;

CREATE TABLE IF NOT EXISTS `rights` (
	`rights_id` int(11) AUTO_INCREMENT,
	`info` tinyint(1) DEFAULT '0',
	`check_in_out` tinyint(1) DEFAULT '0',
	`messages` tinyint(1) DEFAULT '0',
	PRIMARY KEY (`rights_id`)
);

CREATE TABLE IF NOT EXISTS `user` (
	`user_id` int(11) AUTO_INCREMENT,
	`name` varchar(40),
	`nin` bigint(30),
	`address` varchar(80),
	`gender` tinyint(1),
	`email` varchar(40),
	`profile_picture` varchar(10),
	`in_building` tinyint(1),
	`date_of_birth` date,
	`online` tinyint(1),
	`martial_status` varchar(20),
	`password` varchar(50),
	`phone_number` int(15),
	`function` varchar(15),
	`rights_id` int(3),
	`admin` tinyint(1),
	PRIMARY KEY (`user_id`),
	FOREIGN KEY (`rights_id`) REFERENCES `rights`(`rights_id`)
);

CREATE TABLE IF NOT EXISTS `message` (
	`message_id` int(11) AUTO_INCREMENT,
	`topic` varchar(50),
	`content` text,
	`file` varchar(50),
	`date_time` date,
	`receipant` int(5),
	`sender` int(5),
	PRIMARY KEY (`message_id`),
	FOREIGN KEY (`receipant`) REFERENCES `user`(`user_id`),
	FOREIGN KEY (`sender`) REFERENCES `user`(`user_id`)
);