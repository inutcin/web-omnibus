DROP TABLE IF EXISTS `o_O_access_types`;

CREATE TABLE IF NOT EXISTS `o_O_access_types`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `ctime` DATETIME NOT NULL,
    `mtime` DATETIME NOT NULL,
    `name` CHAR(128),
    `order` SMALLINT(5),
    `default_access_name` CHAR(128),
    PRIMARY KEY (`id`),
    KEY `order` (`order`),
    KEY `ctime` (`ctime`),
    KEY `mtime` (`mtime`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT 'Типы доступов';

INSERT INTO `o_O_access_types`(`id`,`name`,`default_access_name`,`order`) 
VALUES(1, 'FTP','Default FTP access','100');
INSERT INTO `o_O_access_types`(`id`,`name`,`default_access_name`,`order`) 
VALUES(2, 'CMS','Default CMS access','200');
INSERT INTO `o_O_access_types`(`id`,`name`,`default_access_name`,`order`) 
VALUES(3, 'Control panel','Default control panel access','300');
INSERT INTO `o_O_access_types`(`id`,`name`,`default_access_name`,`order`) 
VALUES(4, 'SSH','Default SSH access','400');
INSERT INTO `o_O_access_types`(`id`,`name`,`default_access_name`,`order`) 
VALUES(5, 'SSL','Default SSL certificate','500');
INSERT INTO `o_O_access_types`(`id`,`name`,`default_access_name`,`order`) 
VALUES(6, 'MySQL','Default MySQL access','600');
INSERT INTO `o_O_access_types`(`id`,`name`,`default_access_name`,`order`) 
VALUES(7, 'Master mail','Master mail access','700');
INSERT INTO `o_O_access_types`(`id`,`name`,`default_access_name`,`order`) 
VALUES(8, 'Mail','Slave mail access','800');
INSERT INTO `o_O_access_types`(`id`,`name`,`default_access_name`,`order`) 
VALUES(9, 'IMAP','Default IMAP acess','900');
INSERT INTO `o_O_access_types`(`id`,`name`,`default_access_name`,`order`) 
VALUES(10, 'POP','Default POP acess','1000');
INSERT INTO `o_O_access_types`(`id`,`name`,`default_access_name`,`order`) 
VALUES(11, 'SMTP','Default SMTP acess','1100');





