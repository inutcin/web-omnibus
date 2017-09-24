DROP TABLE IF EXISTS `o_O_apps`;

CREATE TABLE IF NOT EXISTS `o_O_apps`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `ctime` DATETIME NOT NULL,
    `mtime` DATETIME NOT NULL,
    `name` CHAR(128),
    `key` CHAR(32),   
    PRIMARY KEY (`id`),
    KEY `ctime` (`ctime`),
    KEY `mtime` (`mtime`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT 'Приложения';

INSERT INTO `o_O_apps`(`id`,`name`,`key`,`ctime`)
VALUES(1,'Web панель управления', 'eb712982ca3b3e9b2df63d2317e19f0d',NOW());
