-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SESSION.sql_mode, SESSION sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `archive`
-- -------------------------------------------
DROP TABLE IF EXISTS `archive`;
CREATE TABLE IF NOT EXISTS `archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(225) NOT NULL,
  `model_id` int(11) NOT NULL,
  `date_created` timestamp(4) NOT NULL DEFAULT CURRENT_TIMESTAMP(4) ON UPDATE CURRENT_TIMESTAMP(4),
  `description` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `audit`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit`;
CREATE TABLE IF NOT EXISTS `audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `details` varchar(225) DEFAULT NULL,
  `fileupload_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `auth_assignment`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_item`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_item_child`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_rule`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `cms`
-- -------------------------------------------
DROP TABLE IF EXISTS `cms`;
CREATE TABLE IF NOT EXISTS `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) NOT NULL,
  `fileupload_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date_createad` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `department`
-- -------------------------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `department` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `department_UNIQUE` (`department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `event`
-- -------------------------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `occasion_id` smallint(5) unsigned NOT NULL,
  `event_classification_id` tinyint(3) unsigned NOT NULL,
  `event_type_id` tinyint(3) unsigned NOT NULL,
  `match_system_id` tinyint(3) unsigned NOT NULL,
  `event` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venue_id` tinyint(3) unsigned NOT NULL,
  `event_category_id` tinyint(3) unsigned NOT NULL,
  `event_status_id` tinyint(3) unsigned DEFAULT '1',
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `min_team` tinyint(3) unsigned DEFAULT '3',
  `max_team` tinyint(3) unsigned DEFAULT '12',
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_one_occasion_id_many_event` (`occasion_id`,`event`),
  KEY `event_event_category_id` (`event_category_id`),
  KEY `event_occasion_id_idx` (`occasion_id`),
  KEY `event_event_status_id_idx` (`event_status_id`),
  KEY `event_venue_id_idx` (`venue_id`),
  KEY `event_event_type_id` (`event_type_id`),
  KEY `event_event_classification_id` (`event_classification_id`),
  CONSTRAINT `event_event_category_id` FOREIGN KEY (`event_category_id`) REFERENCES `event_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_event_classification_id` FOREIGN KEY (`event_classification_id`) REFERENCES `event_classification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_event_status_id` FOREIGN KEY (`event_status_id`) REFERENCES `event_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_event_type_id` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_occasion_id` FOREIGN KEY (`occasion_id`) REFERENCES `occasion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_venue_id` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `event_category`
-- -------------------------------------------
DROP TABLE IF EXISTS `event_category`;
CREATE TABLE IF NOT EXISTS `event_category` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_UNIQUE` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `event_classification`
-- -------------------------------------------
DROP TABLE IF EXISTS `event_classification`;
CREATE TABLE IF NOT EXISTS `event_classification` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `classification` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `classification_UNIQUE` (`classification`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `event_round`
-- -------------------------------------------
DROP TABLE IF EXISTS `event_round`;
CREATE TABLE IF NOT EXISTS `event_round` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` mediumint(8) unsigned NOT NULL,
  `round` tinyint(3) unsigned NOT NULL,
  `round_status_id` tinyint(3) unsigned DEFAULT '1',
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_one_event_id_many_round` (`event_id`,`round`) USING BTREE,
  KEY `event_event_id_idx` (`event_id`),
  KEY `event_round_round_status_id_idx` (`round_status_id`),
  CONSTRAINT `event_round_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_round_round_status_id` FOREIGN KEY (`round_status_id`) REFERENCES `round_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `event_round_match`
-- -------------------------------------------
DROP TABLE IF EXISTS `event_round_match`;
CREATE TABLE IF NOT EXISTS `event_round_match` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_team1_round_id` bigint(20) unsigned DEFAULT NULL,
  `event_team2_round_id` bigint(20) unsigned DEFAULT NULL,
  `team1_score` tinyint(3) unsigned DEFAULT NULL,
  `team2_score` tinyint(3) unsigned DEFAULT NULL,
  `match_status_id` tinyint(3) unsigned DEFAULT '1',
  `datetime_start` datetime DEFAULT NULL,
  `datetime_end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `erm_event_team1_round_idx` (`event_team1_round_id`),
  KEY `erm_event_team2_round_idx` (`event_team2_round_id`),
  CONSTRAINT `erm_event_team1_round` FOREIGN KEY (`event_team1_round_id`) REFERENCES `event_team_round` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `erm_event_team2_round` FOREIGN KEY (`event_team2_round_id`) REFERENCES `event_team_round` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `event_status`
-- -------------------------------------------
DROP TABLE IF EXISTS `event_status`;
CREATE TABLE IF NOT EXISTS `event_status` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `status_UNIQUE` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `event_team`
-- -------------------------------------------
DROP TABLE IF EXISTS `event_team`;
CREATE TABLE IF NOT EXISTS `event_team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` tinyint(3) unsigned NOT NULL,
  `event_id` mediumint(8) unsigned NOT NULL,
  `place_id` tinyint(3) unsigned DEFAULT NULL,
  `final_place_id` tinyint(3) unsigned DEFAULT NULL,
  `total_wins` tinyint(3) unsigned DEFAULT NULL,
  `total_draws` tinyint(3) unsigned DEFAULT NULL,
  `total_losses` tinyint(3) unsigned DEFAULT NULL,
  `total_score` tinyint(3) unsigned DEFAULT NULL,
  `total_time` time DEFAULT NULL,
  `seed_number` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_one_event_id_many_team_id` (`event_id`,`team_id`),
  KEY `event_team_team_idx` (`team_id`),
  KEY `event_team_event_id_idx` (`event_id`),
  KEY `event_team_place_id_idx` (`place_id`),
  KEY `event_team_final_place_id_idx` (`final_place_id`),
  CONSTRAINT `event_team_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_team_final_place_id` FOREIGN KEY (`final_place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_team_place_id` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_team_team_id` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `event_team_player`
-- -------------------------------------------
DROP TABLE IF EXISTS `event_team_player`;
CREATE TABLE IF NOT EXISTS `event_team_player` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_team_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `year_id` tinyint(3) unsigned DEFAULT NULL,
  `section_id` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_one_event_team_id_many_player_id` (`event_team_id`,`player_id`),
  KEY `etp_event_team_id_idx` (`event_team_id`),
  KEY `etp_player_id_idx` (`player_id`),
  KEY `etp_year_id_idx` (`year_id`),
  KEY `etp_section_id_idx` (`section_id`),
  CONSTRAINT `etp_event_team_id` FOREIGN KEY (`event_team_id`) REFERENCES `event_team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `etp_player_id` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `etp_section_id` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `etp_year_id` FOREIGN KEY (`year_id`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `event_team_round`
-- -------------------------------------------
DROP TABLE IF EXISTS `event_team_round`;
CREATE TABLE IF NOT EXISTS `event_team_round` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_team_id` int(10) unsigned NOT NULL,
  `event_round_id` int(10) unsigned NOT NULL,
  `match_result_id` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_one_event_team_id_many_event_round_id` (`event_team_id`,`event_round_id`),
  KEY `etr_event_team_id_idx` (`event_team_id`),
  KEY `etr_event_team_round_id_idx` (`event_round_id`),
  KEY `etr_match_result_id_idx` (`match_result_id`),
  CONSTRAINT `etr_event_round_id` FOREIGN KEY (`event_round_id`) REFERENCES `event_round` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `etr_event_team_id` FOREIGN KEY (`event_team_id`) REFERENCES `event_team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `etr_match_result_id` FOREIGN KEY (`match_result_id`) REFERENCES `match_result` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `event_type`
-- -------------------------------------------
DROP TABLE IF EXISTS `event_type`;
CREATE TABLE IF NOT EXISTS `event_type` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `event_type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `event_classification_id` tinyint(3) unsigned NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_type_UNIQUE` (`event_type`),
  KEY `event_type_event_classification_id_idx` (`event_classification_id`,`event_type`) USING BTREE,
  CONSTRAINT `event_type_event_classification_id` FOREIGN KEY (`event_classification_id`) REFERENCES `event_classification` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `fileupload`
-- -------------------------------------------
DROP TABLE IF EXISTS `fileupload`;
CREATE TABLE IF NOT EXISTS `fileupload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL,
  `file_name` varchar(225) NOT NULL,
  `file_extension` varchar(225) NOT NULL,
  `type` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `gallery`
-- -------------------------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occasion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gallery_name` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `gender`
-- -------------------------------------------
DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `gender` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gender_UNIQUE` (`gender`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='	';

-- -------------------------------------------
-- TABLE `match_result`
-- -------------------------------------------
DROP TABLE IF EXISTS `match_result`;
CREATE TABLE IF NOT EXISTS `match_result` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `result` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `result_UNIQUE` (`result`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `match_status`
-- -------------------------------------------
DROP TABLE IF EXISTS `match_status`;
CREATE TABLE IF NOT EXISTS `match_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `status_UNIQUE` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `match_system`
-- -------------------------------------------
DROP TABLE IF EXISTS `match_system`;
CREATE TABLE IF NOT EXISTS `match_system` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `system_UNIQUE` (`system`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `occasion`
-- -------------------------------------------
DROP TABLE IF EXISTS `occasion`;
CREATE TABLE IF NOT EXISTS `occasion` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` tinyint(3) unsigned NOT NULL,
  `occasion` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_one_occasion_many_date_created` (`occasion`,`date_created`) USING BTREE,
  KEY `occasion_department_id_idx` (`department_id`),
  CONSTRAINT `occasion_department_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `occasion_team`
-- -------------------------------------------
DROP TABLE IF EXISTS `occasion_team`;
CREATE TABLE IF NOT EXISTS `occasion_team` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `occasion_id` smallint(5) unsigned NOT NULL,
  `team_id` tinyint(3) unsigned NOT NULL,
  `team_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `overall_place_id` tinyint(3) unsigned DEFAULT NULL,
  `final_overall_place_id` tinyint(3) unsigned DEFAULT NULL,
  `overall_wins` tinyint(3) unsigned DEFAULT NULL,
  `overall_draws` tinyint(3) unsigned DEFAULT NULL,
  `overall_losses` tinyint(3) unsigned DEFAULT NULL,
  `overall_time` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_one_occasion_id_many_team_id` (`occasion_id`,`team_id`),
  KEY `occasion_team_team_id_idx` (`team_id`),
  KEY `occasion_team_ocassion_id_idx` (`occasion_id`),
  KEY `occasion_team_overall_place_id_idx` (`overall_place_id`),
  KEY `occasion_team_final_overall_place_id_idx` (`final_overall_place_id`),
  CONSTRAINT `occasion_team_final_overall_place_id` FOREIGN KEY (`final_overall_place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `occasion_team_ocassion_id` FOREIGN KEY (`occasion_id`) REFERENCES `occasion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `occasion_team_overall_place_id` FOREIGN KEY (`overall_place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `occasion_team_team_id` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='			';

-- -------------------------------------------
-- TABLE `place`
-- -------------------------------------------
DROP TABLE IF EXISTS `place`;
CREATE TABLE IF NOT EXISTS `place` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `place` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `place_UNIQUE` (`place`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `player`
-- -------------------------------------------
DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `gender_id` tinyint(3) unsigned NOT NULL,
  `sub_department_id` tinyint(3) unsigned NOT NULL,
  `contact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `player_sub_department_id_idx` (`sub_department_id`),
  KEY `player_gender_id_idx` (`gender_id`),
  CONSTRAINT `player_gender_id` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `player_sub_department_id` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `role`
-- -------------------------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `round_status`
-- -------------------------------------------
DROP TABLE IF EXISTS `round_status`;
CREATE TABLE IF NOT EXISTS `round_status` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `status_UNIQUE` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `section`
-- -------------------------------------------
DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `section` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `section_UNIQUE` (`section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `sub_department`
-- -------------------------------------------
DROP TABLE IF EXISTS `sub_department`;
CREATE TABLE IF NOT EXISTS `sub_department` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `sub_department` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_department_UNIQUE` (`sub_department`),
  UNIQUE KEY `fk_one_department_many_sub_department` (`department_id`,`sub_department`),
  KEY `sub_department_department_id_idx` (`department_id`),
  CONSTRAINT `sub_department_department_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `team`
-- -------------------------------------------
DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `team` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `year_UNIQUE` (`team`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `user`
-- -------------------------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` tinyint(3) unsigned NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '5',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `venue`
-- -------------------------------------------
DROP TABLE IF EXISTS `venue`;
CREATE TABLE IF NOT EXISTS `venue` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `venue` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `venue_UNIQUE` (`venue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `year`
-- -------------------------------------------
DROP TABLE IF EXISTS `year`;
CREATE TABLE IF NOT EXISTS `year` (
  `id` tinyint(3) unsigned NOT NULL,
  `year` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `year_UNIQUE` (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE DATA archive
-- -------------------------------------------
INSERT INTO `archive` (`id`,`model_name`,`model_id`,`date_created`,`description`,`status`,`user_id`) VALUES
('1','events','17','2018-02-21 19:50:11.6679',NULL,'1','2');
INSERT INTO `archive` (`id`,`model_name`,`model_id`,`date_created`,`description`,`status`,`user_id`) VALUES
('2','events','16','2018-02-21 19:50:32.8411',NULL,'1','2');
INSERT INTO `archive` (`id`,`model_name`,`model_id`,`date_created`,`description`,`status`,`user_id`) VALUES
('3','occasion','7','2018-02-21 22:24:49.2877',NULL,'1','2');
INSERT INTO `archive` (`id`,`model_name`,`model_id`,`date_created`,`description`,`status`,`user_id`) VALUES
('4','occasion','6','2018-02-21 22:25:19.3198',NULL,'1','2');



-- -------------------------------------------
-- TABLE DATA audit
-- -------------------------------------------
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('1','1',NULL,NULL,NULL,'2','2017-12-04 02:14:24',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('2','1',NULL,NULL,NULL,'1','2017-12-04 02:14:30','2017-12-03 18:14:30');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('3','1',NULL,NULL,NULL,'2','2017-12-04 02:14:34',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('4','12',NULL,NULL,NULL,'1','2017-12-06 18:03:26','2017-12-06 10:03:26');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('5','1',NULL,NULL,NULL,'2','2017-12-18 18:52:26',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('6','2',NULL,NULL,NULL,'1','2017-12-18 18:52:38','2017-12-18 10:52:38');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('7','2',NULL,NULL,NULL,'2','2018-01-02 21:30:31',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('8','1',NULL,NULL,NULL,'1','2018-01-02 21:30:43','2018-01-02 13:30:43');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('9','1',NULL,NULL,NULL,'1','2018-02-20 22:57:13','2018-02-20 15:57:13');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('10','1',NULL,NULL,NULL,'2','2018-02-20 23:05:02',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('11','2',NULL,NULL,NULL,'1','2018-02-20 23:05:13','2018-02-20 16:05:13');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('12','2',NULL,NULL,NULL,'2','2018-02-20 23:05:37',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('13','1',NULL,NULL,NULL,'1','2018-02-20 23:35:44','2018-02-20 16:35:43');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('14','1',NULL,NULL,NULL,'2','2018-02-21 00:09:06',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('15','2',NULL,NULL,NULL,'1','2018-02-21 00:09:15','2018-02-20 17:09:15');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('16','2',NULL,NULL,NULL,'2','2018-02-21 00:24:07',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('17','1',NULL,NULL,NULL,'1','2018-02-21 00:24:29','2018-02-20 17:24:29');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('18','1',NULL,NULL,NULL,'2','2018-02-21 11:51:16',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('19','1',NULL,NULL,NULL,'1','2018-02-21 11:51:31','2018-02-21 04:51:31');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('20','1',NULL,NULL,NULL,'2','2018-02-21 15:51:27',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('21','2',NULL,NULL,NULL,'1','2018-02-21 15:51:55','2018-02-21 08:51:55');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('22','2',NULL,NULL,NULL,'2','2018-02-21 18:12:34',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('23','1',NULL,NULL,NULL,'1','2018-02-21 18:12:45','2018-02-21 11:12:45');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('24','1',NULL,NULL,NULL,'2','2018-02-21 18:20:53',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('25','2',NULL,NULL,NULL,'1','2018-02-21 18:21:04','2018-02-21 11:21:04');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('26','2','Update Occasion : occc1',NULL,NULL,'5','2018-02-21 19:33:16',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('27','2',NULL,NULL,NULL,'2','2018-02-21 19:51:13',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('28','1',NULL,NULL,NULL,'1','2018-02-21 19:51:33','2018-02-21 12:51:33');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('29','1',NULL,NULL,NULL,'2','2018-02-21 22:24:20',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('30','2',NULL,NULL,NULL,'1','2018-02-21 22:24:31','2018-02-21 15:24:31');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('31','2',NULL,NULL,NULL,'2','2018-02-21 22:35:41',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('32','1',NULL,NULL,NULL,'1','2018-02-21 22:35:48','2018-02-21 15:35:48');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('33','1',NULL,NULL,NULL,'2','2018-02-21 23:00:05',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('34','1',NULL,NULL,NULL,'1','2018-02-21 23:00:16','2018-02-21 16:00:16');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('35','1',NULL,NULL,NULL,'2','2018-02-21 23:00:20',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('36','2',NULL,NULL,NULL,'1','2018-02-21 23:00:27','2018-02-21 16:00:27');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('37','2',NULL,NULL,NULL,'2','2018-02-21 23:30:16',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('38','1',NULL,NULL,NULL,'1','2018-02-21 23:30:29','2018-02-21 16:30:29');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('39','1',NULL,NULL,NULL,'2','2018-02-21 23:35:28',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('40','1',NULL,NULL,NULL,'1','2018-02-21 23:35:41','2018-02-21 16:35:41');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('41','1',NULL,NULL,NULL,'2','2018-02-21 23:35:45',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('42','2',NULL,NULL,NULL,'1','2018-02-21 23:35:51','2018-02-21 16:35:51');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('43','2',NULL,NULL,NULL,'2','2018-02-21 23:36:15',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('44','1',NULL,NULL,NULL,'1','2018-02-21 23:36:26','2018-02-21 16:36:26');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('45','1',NULL,NULL,NULL,'2','2018-02-22 00:42:29',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('46','2',NULL,NULL,NULL,'1','2018-02-22 00:42:44','2018-02-21 17:42:44');
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('47','2',NULL,NULL,NULL,'2','2018-02-22 00:49:48',NULL);
INSERT INTO `audit` (`id`,`user_id`,`details`,`fileupload_id`,`type`,`status`,`date_created`,`date_updated`) VALUES
('48','1',NULL,NULL,NULL,'1','2018-02-22 00:49:57','2018-02-21 17:49:57');



-- -------------------------------------------
-- TABLE DATA auth_assignment
-- -------------------------------------------
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('admin','1',NULL);
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('organizer','12',NULL);
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('organizer','2',NULL);



-- -------------------------------------------
-- TABLE DATA auth_item
-- -------------------------------------------
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('admin','1',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('create-backup','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('create-event','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('create-event-team','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('create-location','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('create-occasion','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('create-player','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('create-team','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('create-user','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('create-venue','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('delete-backup','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('delete-event','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('delete-event-team','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('delete-location','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('delete-occasion','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('delete-player','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('delete-team','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('delete-user','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('delete-venue','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('index-occasion','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('organizer','1',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('restore-backup','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('update-backup','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('update-event','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('update-event-team','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('update-location','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('update-occasion','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('update-player','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('update-team','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('update-user','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('update-venue','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-audit','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-backup','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-cms','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-event','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-event-team','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-gallery','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-location','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-occasion','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-player','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-report','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-team','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-user','2',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('view-venue','2',NULL,NULL,NULL,NULL,NULL);



-- -------------------------------------------
-- TABLE DATA auth_item_child
-- -------------------------------------------
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','create-backup');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','create-user');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','delete-backup');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','delete-user');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','restore-backup');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','update-backup');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','update-user');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','view-audit');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','view-backup');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','view-cms');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','view-gallery');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','view-report');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','view-user');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','create-event');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','create-event-team');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','create-location');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','create-occasion');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','create-player');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','create-team');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','create-venue');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','delete-event');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','delete-event-team');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','delete-location');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','delete-occasion');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','delete-player');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','delete-team');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','delete-venue');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','update-event');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','update-event-team');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','update-location');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','update-occasion');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','update-player');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','update-team');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','update-venue');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','view-event');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','view-event-team');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','view-location');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','view-occasion');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','view-player');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','view-report');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','view-team');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('organizer','view-venue');



-- -------------------------------------------
-- TABLE DATA cms
-- -------------------------------------------
INSERT INTO `cms` (`id`,`content`,`fileupload_id`,`type`,`date_createad`) VALUES
('12','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

','0','1',NULL);
INSERT INTO `cms` (`id`,`content`,`fileupload_id`,`type`,`date_createad`) VALUES
('13','THIS IS UNOFFICIAL CONTENT','0','1',NULL);
INSERT INTO `cms` (`id`,`content`,`fileupload_id`,`type`,`date_createad`) VALUES
('14','test','0','1',NULL);
INSERT INTO `cms` (`id`,`content`,`fileupload_id`,`type`,`date_createad`) VALUES
('15','adadads','0','1',NULL);
INSERT INTO `cms` (`id`,`content`,`fileupload_id`,`type`,`date_createad`) VALUES
('16','SAMPLE CONTENT','0','2',NULL);



-- -------------------------------------------
-- TABLE DATA department
-- -------------------------------------------
INSERT INTO `department` (`id`,`department`) VALUES
('1','CENTRAL COUNCIL');
INSERT INTO `department` (`id`,`department`) VALUES
('4','EDUCATION');
INSERT INTO `department` (`id`,`department`) VALUES
('2','IBM');
INSERT INTO `department` (`id`,`department`) VALUES
('3','ICSLIS');



-- -------------------------------------------
-- TABLE DATA event
-- -------------------------------------------
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('7','1','2','4','3','Basketball Men 2017','Basketball Men 2017 Desc','1','2','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('9','1','2','4','3','Basketball Women 2017','Basketball Women 2017 Desc','1','3','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('14','1','2','9','3','Chess Women 2017','Chess Men 2017 Desc','3','2','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('16','1','2','9','3','Chess Womens','Chess','2','3','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('26','6','1','2','1','6','sdasdasd','2','2','1','2018-03-06','2018-03-06','3','12');



-- -------------------------------------------
-- TABLE DATA event_category
-- -------------------------------------------
INSERT INTO `event_category` (`id`,`category`,`description`) VALUES
('1','All',NULL);
INSERT INTO `event_category` (`id`,`category`,`description`) VALUES
('2','Men',NULL);
INSERT INTO `event_category` (`id`,`category`,`description`) VALUES
('3','Women',NULL);



-- -------------------------------------------
-- TABLE DATA event_classification
-- -------------------------------------------
INSERT INTO `event_classification` (`id`,`classification`,`description`) VALUES
('1','Academic',NULL);
INSERT INTO `event_classification` (`id`,`classification`,`description`) VALUES
('2','Sports',NULL);
INSERT INTO `event_classification` (`id`,`classification`,`description`) VALUES
('3','Cultural',NULL);



-- -------------------------------------------
-- TABLE DATA event_status
-- -------------------------------------------
INSERT INTO `event_status` (`id`,`status`,`description`) VALUES
('1','Waiting',NULL);
INSERT INTO `event_status` (`id`,`status`,`description`) VALUES
('2','In progress',NULL);
INSERT INTO `event_status` (`id`,`status`,`description`) VALUES
('3','Finished',NULL);



-- -------------------------------------------
-- TABLE DATA event_team
-- -------------------------------------------
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('2','9','7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);



-- -------------------------------------------
-- TABLE DATA event_type
-- -------------------------------------------
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('1','Scrabbles','1',NULL);
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('2','Poster Making','1',NULL);
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('3','Masining na Pagkukuwento','1',NULL);
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('4','Basketball','2',NULL);
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('5','Volleyball','2',NULL);
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('6','Track and Field','2',NULL);
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('7','Shotput','2',NULL);
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('8','Table Tennis','2',NULL);
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('9','Chess','2',NULL);
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('10','Cheer Dance','3',NULL);
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('11','Solo Singing','3',NULL);
INSERT INTO `event_type` (`id`,`event_type`,`event_classification_id`,`description`) VALUES
('12','Acoustic','3',NULL);



-- -------------------------------------------
-- TABLE DATA fileupload
-- -------------------------------------------
INSERT INTO `fileupload` (`id`,`gallery_id`,`file_name`,`file_extension`,`type`,`status`,`date_created`,`date_updated`) VALUES
('3','1','26105243_1385722628203979_992962010_n.jpg','image/jpeg',NULL,'0','2018-02-21 11:05:33','0000-00-00 00:00:00');
INSERT INTO `fileupload` (`id`,`gallery_id`,`file_name`,`file_extension`,`type`,`status`,`date_created`,`date_updated`) VALUES
('4','0','26056687_1385722571537318_887855529_n.jpg','image/jpeg','cms','0','2018-02-21 11:38:22','0000-00-00 00:00:00');
INSERT INTO `fileupload` (`id`,`gallery_id`,`file_name`,`file_extension`,`type`,`status`,`date_created`,`date_updated`) VALUES
('5','0','26056687_1385722571537318_887855529_n.jpg','image/jpeg','cms-img-1','0','2018-02-21 11:39:52','0000-00-00 00:00:00');
INSERT INTO `fileupload` (`id`,`gallery_id`,`file_name`,`file_extension`,`type`,`status`,`date_created`,`date_updated`) VALUES
('6','0','26803744_2266195516731252_929575500_n.jpg','image/jpeg','cms-img-2','0','2018-02-21 12:46:16','0000-00-00 00:00:00');
INSERT INTO `fileupload` (`id`,`gallery_id`,`file_name`,`file_extension`,`type`,`status`,`date_created`,`date_updated`) VALUES
('7','0','26056687_1385722571537318_887855529_n.jpg','image/jpeg','cms-img-1','0','2018-02-21 15:47:27','0000-00-00 00:00:00');
INSERT INTO `fileupload` (`id`,`gallery_id`,`file_name`,`file_extension`,`type`,`status`,`date_created`,`date_updated`) VALUES
('8','0','26105243_1385722628203979_992962010_n.jpg','image/jpeg','cms-img-1','0','2018-02-21 15:47:47','0000-00-00 00:00:00');
INSERT INTO `fileupload` (`id`,`gallery_id`,`file_name`,`file_extension`,`type`,`status`,`date_created`,`date_updated`) VALUES
('9','4','remedial.jpg','image/jpeg',NULL,'0','2018-02-21 18:13:19','0000-00-00 00:00:00');
INSERT INTO `fileupload` (`id`,`gallery_id`,`file_name`,`file_extension`,`type`,`status`,`date_created`,`date_updated`) VALUES
('10','0','DSC (15).JPG',NULL,'cms-img-2','0','2018-02-21 23:32:33','0000-00-00 00:00:00');
INSERT INTO `fileupload` (`id`,`gallery_id`,`file_name`,`file_extension`,`type`,`status`,`date_created`,`date_updated`) VALUES
('11','0','26056687_1385722571537318_887855529_n.jpg','image/jpeg','cms-img-2','0','2018-02-21 23:32:59','0000-00-00 00:00:00');
INSERT INTO `fileupload` (`id`,`gallery_id`,`file_name`,`file_extension`,`type`,`status`,`date_created`,`date_updated`) VALUES
('12','5','26803744_2266195516731252_929575500_n.jpg','image/jpeg',NULL,'0','2018-02-21 23:36:46','0000-00-00 00:00:00');



-- -------------------------------------------
-- TABLE DATA gallery
-- -------------------------------------------
INSERT INTO `gallery` (`id`,`occasion_id`,`user_id`,`gallery_name`,`status`,`date_created`,`date_updated`) VALUES
('1','7','1','test','0','2017-11-14 21:13:02','0000-00-00 00:00:00');
INSERT INTO `gallery` (`id`,`occasion_id`,`user_id`,`gallery_name`,`status`,`date_created`,`date_updated`) VALUES
('2','8','1','sample gallery','0','2017-11-14 21:14:51','0000-00-00 00:00:00');
INSERT INTO `gallery` (`id`,`occasion_id`,`user_id`,`gallery_name`,`status`,`date_created`,`date_updated`) VALUES
('3','41','2','jump','0','2018-02-21 17:59:38','0000-00-00 00:00:00');
INSERT INTO `gallery` (`id`,`occasion_id`,`user_id`,`gallery_name`,`status`,`date_created`,`date_updated`) VALUES
('4','42','2','sample1','0','2018-02-21 18:11:19','0000-00-00 00:00:00');
INSERT INTO `gallery` (`id`,`occasion_id`,`user_id`,`gallery_name`,`status`,`date_created`,`date_updated`) VALUES
('5','43','2','testing','0','2018-02-21 23:36:09','0000-00-00 00:00:00');



-- -------------------------------------------
-- TABLE DATA gender
-- -------------------------------------------
INSERT INTO `gender` (`id`,`gender`) VALUES
('2','Female');
INSERT INTO `gender` (`id`,`gender`) VALUES
('1','Male');



-- -------------------------------------------
-- TABLE DATA match_result
-- -------------------------------------------
INSERT INTO `match_result` (`id`,`result`,`description`) VALUES
('1','No results yet',NULL);
INSERT INTO `match_result` (`id`,`result`,`description`) VALUES
('2','Win',NULL);
INSERT INTO `match_result` (`id`,`result`,`description`) VALUES
('3','Loss',NULL);
INSERT INTO `match_result` (`id`,`result`,`description`) VALUES
('4','Draw',NULL);
INSERT INTO `match_result` (`id`,`result`,`description`) VALUES
('5','Default',NULL);
INSERT INTO `match_result` (`id`,`result`,`description`) VALUES
('6','Disqualified',NULL);



-- -------------------------------------------
-- TABLE DATA match_status
-- -------------------------------------------
INSERT INTO `match_status` (`id`,`status`,`description`) VALUES
('1','Waiting',NULL);
INSERT INTO `match_status` (`id`,`status`,`description`) VALUES
('2','In progress',NULL);
INSERT INTO `match_status` (`id`,`status`,`description`) VALUES
('3','Finished',NULL);



-- -------------------------------------------
-- TABLE DATA match_system
-- -------------------------------------------
INSERT INTO `match_system` (`id`,`system`,`description`) VALUES
('1','Single Elimination',NULL);
INSERT INTO `match_system` (`id`,`system`,`description`) VALUES
('2','Double Elimination',NULL);
INSERT INTO `match_system` (`id`,`system`,`description`) VALUES
('3','Round Robin',NULL);
INSERT INTO `match_system` (`id`,`system`,`description`) VALUES
('4','Plain Ranking',NULL);



-- -------------------------------------------
-- TABLE DATA occasion
-- -------------------------------------------
INSERT INTO `occasion` (`id`,`department_id`,`occasion`,`description`,`date_start`,`date_end`,`date_created`) VALUES
('1','1','CCA Foundation Day','Founding Day of the City College of Angeles','2010-10-10','2010-10-10','2010-10-10 00:00:00');
INSERT INTO `occasion` (`id`,`department_id`,`occasion`,`description`,`date_start`,`date_end`,`date_created`) VALUES
('2','1','CCA Foundation Day','Founding Day of the City College of Angeles','2011-11-11','2011-11-11','2011-11-11 00:00:00');
INSERT INTO `occasion` (`id`,`department_id`,`occasion`,`description`,`date_start`,`date_end`,`date_created`) VALUES
('3','3','sadad','asd','0000-00-00','0000-00-00','0000-00-00 00:00:00');
INSERT INTO `occasion` (`id`,`department_id`,`occasion`,`description`,`date_start`,`date_end`,`date_created`) VALUES
('4','1','we','awe','0000-00-00','2020-01-07','0000-00-00 00:00:00');
INSERT INTO `occasion` (`id`,`department_id`,`occasion`,`description`,`date_start`,`date_end`,`date_created`) VALUES
('5','3','edi wow events','something','1996-09-09','2020-01-07','0000-00-00 00:00:00');
INSERT INTO `occasion` (`id`,`department_id`,`occasion`,`description`,`date_start`,`date_end`,`date_created`) VALUES
('6','2','wada','asda','0000-00-00','2020-01-07','0000-00-00 00:00:00');
INSERT INTO `occasion` (`id`,`department_id`,`occasion`,`description`,`date_start`,`date_end`,`date_created`) VALUES
('43','1','testing',NULL,'1970-01-01','1970-01-01','2018-02-21 04:36:09');



-- -------------------------------------------
-- TABLE DATA role
-- -------------------------------------------
INSERT INTO `role` (`id`,`role`) VALUES
('1','Administrator');
INSERT INTO `role` (`id`,`role`) VALUES
('2','Central Council');
INSERT INTO `role` (`id`,`role`) VALUES
('3','Education');
INSERT INTO `role` (`id`,`role`) VALUES
('4','IBM');
INSERT INTO `role` (`id`,`role`) VALUES
('5','ICSLIS');



-- -------------------------------------------
-- TABLE DATA round_status
-- -------------------------------------------
INSERT INTO `round_status` (`id`,`status`,`description`) VALUES
('1','Waiting',NULL);
INSERT INTO `round_status` (`id`,`status`,`description`) VALUES
('2','In Progress',NULL);
INSERT INTO `round_status` (`id`,`status`,`description`) VALUES
('3','Finished',NULL);



-- -------------------------------------------
-- TABLE DATA sub_department
-- -------------------------------------------
INSERT INTO `sub_department` (`id`,`sub_department`,`department_id`) VALUES
('3','EDUCATION','1');
INSERT INTO `sub_department` (`id`,`sub_department`,`department_id`) VALUES
('1','IBM','1');
INSERT INTO `sub_department` (`id`,`sub_department`,`department_id`) VALUES
('2','ISCLIS','1');
INSERT INTO `sub_department` (`id`,`sub_department`,`department_id`) VALUES
('4','Accounting','2');
INSERT INTO `sub_department` (`id`,`sub_department`,`department_id`) VALUES
('5','Entrepreneurship','2');
INSERT INTO `sub_department` (`id`,`sub_department`,`department_id`) VALUES
('6','Tourism','2');
INSERT INTO `sub_department` (`id`,`sub_department`,`department_id`) VALUES
('8','CS','3');
INSERT INTO `sub_department` (`id`,`sub_department`,`department_id`) VALUES
('7','IS','3');
INSERT INTO `sub_department` (`id`,`sub_department`,`department_id`) VALUES
('9','LIS','3');
INSERT INTO `sub_department` (`id`,`sub_department`,`department_id`) VALUES
('10','BPE','4');
INSERT INTO `sub_department` (`id`,`sub_department`,`department_id`) VALUES
('11','BTTE','4');



-- -------------------------------------------
-- TABLE DATA team
-- -------------------------------------------
INSERT INTO `team` (`id`,`team`) VALUES
('9','1st Year');
INSERT INTO `team` (`id`,`team`) VALUES
('10','2nd Year');
INSERT INTO `team` (`id`,`team`) VALUES
('11','3rd Year');
INSERT INTO `team` (`id`,`team`) VALUES
('12','4th Year');
INSERT INTO `team` (`id`,`team`) VALUES
('1','Accounting');
INSERT INTO `team` (`id`,`team`) VALUES
('7','BPE');
INSERT INTO `team` (`id`,`team`) VALUES
('8','BTTE');
INSERT INTO `team` (`id`,`team`) VALUES
('13','Bye');
INSERT INTO `team` (`id`,`team`) VALUES
('5','CS');
INSERT INTO `team` (`id`,`team`) VALUES
('2','Entrepreneurship');
INSERT INTO `team` (`id`,`team`) VALUES
('4','IS');
INSERT INTO `team` (`id`,`team`) VALUES
('6','LIS');
INSERT INTO `team` (`id`,`team`) VALUES
('3','Tourism');



-- -------------------------------------------
-- TABLE DATA user
-- -------------------------------------------
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`role`,`status`,`created_at`,`updated_at`) VALUES
('1','admin123','jCJziKTRWckwNV9KGPGK8VSxkqjtrgae','$2y$13$T0MSFgtp4lOcytjCoR.U2.xuZg/EFIEYVlUqoM0M9X8GaaIERYMki',NULL,'ajmzamora@gmail.com','0','10','1501224956','1511070462');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`role`,`status`,`created_at`,`updated_at`) VALUES
('2','admin','jCJziKTRWckwNV9KGPGK8VSxkqjtrgae','$2y$13$T0MSFgtp4lOcytjCoR.U2.xuZg/EFIEYVlUqoM0M9X8GaaIERYMki',NULL,'admin123@admin.com','1','9','1501224969','1519233057');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`role`,`status`,`created_at`,`updated_at`) VALUES
('3','Mj','jCJziKTRWckwNV9KGPGK8VSxkqjtrgae','$2y$13$T0MSFgtp4lOcytjCoR.U2.xuZg/EFIEYVlUqoM0M9X8GaaIERYMki','KX2QVonhMno5Rqt7FfRWW4R6YwA_D028_1511064588','mj@mj.com','0','10','1511050456','1511064588');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`role`,`status`,`created_at`,`updated_at`) VALUES
('11','asdfasdf','jCJziKTRWckwNV9KGPGK8VSxkqjtrgae','$2y$13$T0MSFgtp4lOcytjCoR.U2.xuZg/EFIEYVlUqoM0M9X8GaaIERYMki',NULL,'asdf@asdf.com','2','9','1511649852','1519233119');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`role`,`status`,`created_at`,`updated_at`) VALUES
('12','ajmajm','hsy3CTMhDMfbv3jKSNLipEzwSH0aChvx','$2y$13$e2LWyk.t0gRbV73qRZ9OAe8LMhMvhv5OsOVwXYbu.92biaXUH4Hl2',NULL,'ajm@ajm.com','2','9','1512324994','1519233848');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`role`,`status`,`created_at`,`updated_at`) VALUES
('13','dennisb','PGZiyJa8HGZ-NhYIulvu6A4lj25rAFth','$2y$13$SZ7NynQ338SucWikFo7Bn.YqNZDD8Wq73D9vElEBBuVQEagi6gTZy',NULL,'dbc0429@gmail.com','2','5','1519139172','1519139172');



-- -------------------------------------------
-- TABLE DATA venue
-- -------------------------------------------
INSERT INTO `venue` (`id`,`venue`,`description`) VALUES
('1','Gym',NULL);
INSERT INTO `venue` (`id`,`venue`,`description`) VALUES
('2','Classroom',NULL);
INSERT INTO `venue` (`id`,`venue`,`description`) VALUES
('3','Library',NULL);
INSERT INTO `venue` (`id`,`venue`,`description`) VALUES
('4','Parking Lot',NULL);
INSERT INTO `venue` (`id`,`venue`,`description`) VALUES
('5','Lobby',NULL);
INSERT INTO `venue` (`id`,`venue`,`description`) VALUES
('6','Center Stage',NULL);



-- -------------------------------------------
-- TABLE DATA year
-- -------------------------------------------
INSERT INTO `year` (`id`,`year`) VALUES
('1','1st');
INSERT INTO `year` (`id`,`year`) VALUES
('2','2nd');
INSERT INTO `year` (`id`,`year`) VALUES
('3','3rd');
INSERT INTO `year` (`id`,`year`) VALUES
('4','4th');



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
SET SESSION sql_mode = @OLD_SQL_MODE;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
