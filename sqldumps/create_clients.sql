CREATE TABLE clients (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    partner_id BIGINT(20) UNSIGNED NOT NULL,
    partner_name VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(255) NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    product_price DECIMAL(10, 2) NOT NULL,
    commission_received DECIMAL(8, 2) NOT NULL,
    subscription_type ENUM('monthly', 'annually') NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    expires_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    KEY partner_id (partner_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

