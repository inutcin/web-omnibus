DROP TABLE IF EXISTS `o_O_projects`;

CREATE TABLE IF NOT EXISTS `o_O_projects`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `ctime` DATETIME NOT NULL,
    `mtime` DATETIME NOT NULL,
    `name` CHAR(255),
    PRIMARY KEY (`id`),
    KEY `ctime` (`ctime`),
    KEY `mtime` (`mtime`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT 'Проекты';

