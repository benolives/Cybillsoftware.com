CREATE TABLE IF NOT EXISTS `kaspersky_products` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,  -- Internal AUTO_INCREMENT field
    `product_api_id` INT(11) NOT NULL,     -- External API product ID
    `name` VARCHAR(255) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `description` TEXT,
    `last_updated_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),                    -- Internal auto-increment ID as primary key
    UNIQUE (`product_api_id`)              -- Ensure the external API ID is unique
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;