DROP TABLE IF EXISTS `o_O_users`;

CREATE TABLE IF NOT EXISTS `o_O_users`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `ctime` DATETIME NOT NULL,
    `mtime` DATETIME NOT NULL,
    `username` CHAR(64),
    `password` CHAR(40),
    `session_id` CHAR(40),
    `ip` CHAR(32),
    `expires_to` DATETIME,
    PRIMARY KEY (`id`),
    KEY `ctime` (`ctime`),
    KEY `mtime` (`mtime`),
    KEY `session_id` (`session_id`),
    KEY `ip` (`session_id`),
    KEY `username` (`username`),
    KEY `expires_to`(`expires_to`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT 'Пользователи';
