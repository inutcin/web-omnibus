DROP TABLE IF EXISTS `o_O_location_types`;

CREATE TABLE IF NOT EXISTS `o_O_location_types`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `ctime` DATETIME NOT NULL,
    `mtime` DATETIME NOT NULL,
    `name` CHAR(255),
    PRIMARY KEY (`id`),
    KEY `ctime` (`ctime`),
    KEY `mtime` (`mtime`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT 'Типы площадок';

INSERT INTO `o_O_location_types`(`id`,`ctime`,`name`)
VALUES (1,NOW(),'Production');
INSERT INTO `o_O_location_types`(`id`,`ctime`,`name`)
VALUES (2,NOW(),'Testing');
INSERT INTO `o_O_location_types`(`id`,`ctime`,`name`)
VALUES (3,NOW(),'Development');

