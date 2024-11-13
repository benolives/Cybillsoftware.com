CREATE TABLE payment_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone VARCHAR(15) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    reference VARCHAR(255) DEFAULT NULL,
    description VARCHAR(255) DEFAULT NULL,
    merchant_request_id VARCHAR(255) DEFAULT NULL,
    checkout_request_id VARCHAR(255) DEFAULT NULL,
    status ENUM('requested', 'completed', 'failed') DEFAULT 'requested',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

