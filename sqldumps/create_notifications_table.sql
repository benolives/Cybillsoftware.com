-- MySQL Dump
-- This file creates the 'notifications' table

-- Database: `benolives_cybillnew`
USE `benolives_cybillnew`;

-- Table structure for table `notifications`
CREATE TABLE `notifications` (
    `id` CHAR(36) NOT NULL PRIMARY KEY,  -- UUID field
    `type` VARCHAR(255) NOT NULL,  -- Type of notification (string)
    `notifiable_id` BIGINT UNSIGNED NOT NULL,  -- Foreign key to the user or related model
    `notifiable_type` VARCHAR(255) NOT NULL,  -- The type of model (e.g., User, Admin)
    `data` TEXT NOT NULL,  -- The JSON data for the notification
    `read_at` TIMESTAMP NULL DEFAULT NULL,  -- Timestamp to track when the notification was read
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,  -- Created timestamp
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  -- Updated timestamp
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional: Insert sample data (comment this out if you don't want sample data)
-- INSERT INTO `notifications` (`id`, `type`, `notifiable_id`, `notifiable_type`, `data`, `read_at`, `created_at`, `updated_at`)
-- VALUES
-- ('123e4567-e89b-12d3-a456-426614174000', 'App\\Notifications\\NewUserRegistered', 1, 'App\\Models\\User', '{"message": "New user registered: John Doe", "url": "/admin/users/1"}', NULL, NOW(), NOW()),
-- ('123e4567-e89b-12d3-a456-426614174001', 'App\\Notifications\\NewComment', 2, 'App\\Models\\Admin', '{"message": "Rahmad commented on Admin", "url": "/admin/comments/12"}', NULL, NOW(), NOW());

-- End of SQL dump