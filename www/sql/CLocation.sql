DROP TABLE IF EXISTS `o_O_locations`;

CREATE TABLE IF NOT EXISTS `o_O_locations`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `ctime` DATETIME NOT NULL,
    `mtime` DATETIME NOT NULL,
    `project_id` INT(11),
    `type_id` INT(11),
    `name` CHAR(255),
    PRIMARY KEY (`id`),
    KEY `ctime` (`ctime`),
    KEY `mtime` (`mtime`),
    KEY `project_id`(`project_id`),
    KEY `type_id`(`type_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT 'Площадки';

