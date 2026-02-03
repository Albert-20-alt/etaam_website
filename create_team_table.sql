-- Script SQL pour créer la table team_members si elle n'existe pas

CREATE TABLE IF NOT EXISTS `team_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `quote` text DEFAULT NULL,
  `bio_1` text DEFAULT NULL,
  `bio_2` text DEFAULT NULL,
  `social_linkedin` varchar(500) DEFAULT '#',
  `social_twitter` varchar(500) DEFAULT '#',
  `social_facebook` varchar(500) DEFAULT '#',
  `skills` text DEFAULT NULL COMMENT 'JSON array of skills',
  `education` text DEFAULT NULL COMMENT 'JSON array of education',
  `history` text DEFAULT NULL COMMENT 'JSON array of history',
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
