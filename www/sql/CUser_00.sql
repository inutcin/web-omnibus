ALTER TABLE `o_O_users` ADD COLUMN `last_login` DATETIME;
ALTER TABLE `o_O_users` ADD KEY `last_login`(`last_login`);
