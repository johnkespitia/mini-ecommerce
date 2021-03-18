ALTER TABLE `documents`
	ADD COLUMN `provider` VARCHAR(250) NULL DEFAULT NULL AFTER `date_expiration`;