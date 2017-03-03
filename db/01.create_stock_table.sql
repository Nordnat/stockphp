-- Create table for Stocks models
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` INT(11) AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL UNIQUE,
  `type` ENUM('FIFO', 'LIFO', 'UNKNOWN') NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- add index on name
CREATE INDEX `stock_name_index` ON `stocks` (`name`);
