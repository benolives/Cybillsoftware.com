CREATE TABLE b2b_payments_benolives (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    transaction_id VARCHAR(255),
    originator_conversation_id VARCHAR(255),
    conversation_id VARCHAR(255),
    amount DECIMAL(10, 2),
    account_balance DECIMAL(10, 2),
    currency_code VARCHAR(3),
    beneficiary_name VARCHAR(255),
    beneficiary_paybill VARCHAR(255),
    product_id BIGINT,
    client_id BIGINT,
    charges DECIMAL(10, 2),
    transaction_status VARCHAR(50) DEFAULT 'pending',
    result_code INT,
    result_desc TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    transaction_completed_time DATETIME,
    transaction_reference_number VARCHAR(255),
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);