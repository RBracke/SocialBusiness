DROP DATABASE IF EXISTS `sobu`;
CREATE DATABASE IF NOT EXISTS `sobu`;
USE `sobu`;

DROP TABLE IF EXISTS `message`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `rights`;
DROP TABLE IF EXISTS `in_building`;

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
	`date_of_birth` date ,
	`online` tinyint(1) default '0',
	`martial_status` varchar(20),
	`password` varchar(50),
	`phone_number` int(15),
	`function` varchar(15),
	`rights_id` int(3) default '0',
	`admin` tinyint(1) default '0',
	`start_date` date,
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

CREATE TABLE IF NOT EXISTS `in_building` (
	`in_building_id` int(11) AUTO_INCREMENT,
	`user_id` int(11),
	`in_building_now` tinyint(1) DEFAULT NULL,
	`time_check_in` datetime DEFAULT NULL,
	`time_check_out` datetime DEFAULT NULL,
	PRIMARY KEY (`in_building_id`),
	FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

INSERT INTO `user` (`user_id`, `name`, `nin`, `address`, `gender`, `email`, `date_of_birth`, `martial_status`, `password`, `phone_number`, `function`, `rights_id`, `admin`, `start_date`) VALUES
(1, 'Ruben De Admin', 86022402508, 'wijnegemstenweg 112e', 1, 'Ruben@admin.com', '1996-12-24', 'married', '21232f297a57a5a743894a0e4a801fc3', 494456865, 'Boss', NULL, 1, '2017-04-01'), /*password = admin*/
(2, 'Kenzo De Admin', 60061812456, 'kenzotlaan 11', 1, 'kenzo@admin.com', '1997-12-24', 'married', '21232f297a57a5a743894a0e4a801fc3', 488656154, 'Boss', NULL, 1, '2017-03-01'),
(3, 'joske', 44121181161, 'josdreef 24', 1, 'jos@hotmail.com', '1990-05-25', 'single', '21232f297a57a5a743894a0e4a801fc3', 568799563, 'Employee', NULL, 0, '2012-08-01'),
(4, 'josefien',42082713590, 'nieuwdreef 54', 0, 'josefien@hotmail.com', '1992-06-25', 'in relationship', '21232f297a57a5a743894a0e4a801fc3', 675419824, 'cleaning lady', NULL, 0, '2010-08-25'),
(5, 'jef',28061220565, 'boonhoek 88', 1, 'jef@hotmail.com', '1988-11-25', 'divorced', '21232f297a57a5a743894a0e4a801fc3', 5423647526, 'cook', NULL, 0, '2008-11-25');