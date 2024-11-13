INSERT INTO clients (partner_id, partner_name, name, email, phone, product_name, product_price, commission_received, subscription_type, created_at, updated_at, expires_at) VALUES
-- For Partner ID 14
(14, 'Hassan Muneen', 'James Muchiri', 'client1@example.com', '254700000001', 'Kaspersky Standard', 100, 10, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY),
(14, 'Hassan Muneen', 'Hassan Munene', 'client2@example.com', '254700000002', 'Bitdefender Antivirus', 200, 20, 'annually', NOW(), NOW(), NOW() + INTERVAL 1 YEAR),
(14, 'Hassan Muneen', 'Kelvin Gitau', 'client3@example.com', '254700000003', 'Kaspersky Plus', 150, 15, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY),
(14, 'Hassan Muneen', 'Anastacia Ndunge', 'client4@example.com', '254700000004', 'Bitdefender Total Security', 250, 25, 'annually', NOW(), NOW(), NOW() + INTERVAL 1 YEAR),
(14, 'Hassan Muneen', 'John Doe', 'client5@example.com', '254700000005', 'Kaspersky Premium', 300, 30, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY);
