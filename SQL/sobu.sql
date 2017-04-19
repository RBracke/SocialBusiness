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
	`password` varchar(50) default '21232f297a57a5a743894a0e4a801fc3', /* = admin*/
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
	`date_time` datetime,
	`receipant` int(5),
	`sender` int(5),
	PRIMARY KEY (`message_id`),
	FOREIGN KEY (`receipant`) REFERENCES `user`(`user_id`),
	FOREIGN KEY (`sender`) REFERENCES `user`(`user_id`)
);

CREATE TABLE IF NOT EXISTS `in_building` (
	`in_building_id` int(11) AUTO_INCREMENT,
	`user_id` int(11),
	`in_building_now` tinyint(1) DEFAULT '0',
	`time_check` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`in_building_id`),
	FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

INSERT INTO `rights` (`rights_id`, `info`, `check_in_out`, `messages`) VALUES
(1, 0, 0, 0),
(2, 0, 0, 1),
(3, 0, 1, 0),
(4, 0, 1, 1),
(5, 1, 0, 0),
(6, 1, 0, 1),
(7, 1, 1, 0),
(8, 1, 1, 1);

INSERT INTO `user` (`user_id`, `name`, `nin`, `address`, `gender`, `email`, `date_of_birth`, `martial_status`, `password`, `phone_number`, `function`, `rights_id`, `admin`, `start_date`) VALUES
(1, 'Ruben De Admin', 86022402508, 'wijnegemstenweg 112e', 1, 'Ruben@admin.com', '1996-12-24', 'married', '21232f297a57a5a743894a0e4a801fc3', 494456865, 'Boss', 8, 1, '2017-04-01'), /*password = admin*/
(2, 'Kenzo De Admin', 60061812456, 'kenzotlaan 11', 1, 'kenzo@admin.com', '1997-12-24', 'married', '21232f297a57a5a743894a0e4a801fc3', 488656154, 'Boss', 8, 1, '2017-03-01'),
(3, 'joske', 44121181161, 'josdreef 24', 1, 'jos@hotmail.com', '1990-05-25', 'single', '21232f297a57a5a743894a0e4a801fc3', 568799563, 'Employee', 5, 0, '2012-08-01'),
(4, 'josefien',42082713590, 'nieuwdreef 54', 0, 'josefien@hotmail.com', '1992-06-25', 'in relationship', '21232f297a57a5a743894a0e4a801fc3', 675419824, 'cleaning lady', 1, 0, '2010-08-25'),
(5, 'jef',2806122056, 'boonhoek 88', 1, 'jef@hotmail.com', '1988-11-25', 'divorced', '21232f297a57a5a743894a0e4a801fc3', 5423647526, 'cook', 1, 0, '2008-11-25'),
(6, 'jan',4568254005, 'bredabaan 3', 1, 'jan@hotmail.com', '1999-11-15', 'single', '21232f297a57a5a743894a0e4a801fc3', 584441258, 'IT-guy', 6, 0, '2015-01-11');

INSERT INTO `in_building` (`in_building_id`, `user_id`, `in_building_now`, `time_check`) VALUES
(33, 1, 1, '2017-04-11 15:51:28'),
(34, 1, 0, '2017-04-11 15:51:30'),
(35, 1, 1, '2017-04-11 15:51:39'),
(36, 1, 0, '2017-04-11 15:51:40'),
(37, 1, 1, '2017-04-11 15:51:41'),
(38, 1, 0, '2017-04-11 16:08:21'),
(39, 1, 1, '2017-04-11 16:08:22'),
(40, 1, 0, '2017-04-11 16:09:05');
