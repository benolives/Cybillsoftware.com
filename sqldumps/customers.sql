INSERT INTO clients (partner_id, partner_name, name, email, phone, product_name, product_price, commission_received, subscription_type, created_at, updated_at, expires_at) VALUES
-- For Partner ID 7244
(7244, 'Sultan Hamud', 'James Muchiri', 'client1@example.com', '254700000001', 'Kaspersky Standard', 100, 10, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY),
(7244, 'Sultan Hamud', 'Hassan Munene', 'client2@example.com', '254700000002', 'Bitdefender Antivirus', 200, 20, 'annually', NOW(), NOW(), NOW() + INTERVAL 1 YEAR),
(7244, 'Sultan Hamud', 'Kelvin Gitau', 'client3@example.com', '254700000003', 'Kaspersky Plus', 150, 15, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY),
(7244, 'Sultan Hamud', 'Anastacia Ndunge', 'client4@example.com', '254700000004', 'Bitdefender Total Security', 250, 25, 'annually', NOW(), NOW(), NOW() + INTERVAL 1 YEAR),
(7244, 'Sultan Hamud', 'John Doe', 'client5@example.com', '254700000005', 'Kaspersky Premium', 300, 30, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY),

-- For Partner ID 7383
(7383, 'Kelvin Njora', 'James Muchiri', 'client6@example.com', '254700000006', 'Kaspersky Standard', 120, 12, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY),
(7383, 'Kelvin Njora', 'Hassan Munene', 'client7@example.com', '254700000007', 'Bitdefender Antivirus', 220, 22, 'annually', NOW(), NOW(), NOW() + INTERVAL 1 YEAR),
(7383, 'Kelvin Njora', 'Kelvin Gitau', 'client8@example.com', '254700000008', 'Kaspersky Plus', 180, 18, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY),
(7383, 'Kelvin Njora', 'Anastacia Ndunge', 'client9@example.com', '254700000009', 'Bitdefender Total Security', 270, 27, 'annually', NOW(), NOW(), NOW() + INTERVAL 1 YEAR),
(7383, 'Kelvin Njora', 'John Doe', 'client10@example.com', '254700000010', 'Kaspersky Premium', 330, 33, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY),

-- For Partner ID 7819
(7819, 'Annastacia', 'Client 1 for Annastacia', 'client11@example.com', '254700000011', 'Product 1', 140, 14, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY),
(7819, 'Annastacia', 'Client 2 for Annastacia', 'client12@example.com', '254700000012', 'Product 2', 240, 24, 'annually', NOW(), NOW(), NOW() + INTERVAL 1 YEAR),
(7819, 'Annastacia', 'Client 3 for Annastacia', 'client13@example.com', '254700000013', 'Product 3', 190, 19, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY),
(7819, 'Annastacia', 'Client 4 for Annastacia', 'client14@example.com', '254700000014', 'Product 4', 260, 26, 'annually', NOW(), NOW(), NOW() + INTERVAL 1 YEAR),
(7819, 'Annastacia', 'Client 5 for Annastacia', 'client15@example.com', '254700000015', 'Product 5', 320, 32, 'monthly', NOW(), NOW(), NOW() + INTERVAL 30 DAY);