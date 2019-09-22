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
  `id` bigint(20) unsigned NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- TABLE `gallery`
-- -------------------------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL,
  `occasion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `extension` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  UNIQUE KEY `fk_one_occasion_many_date_created` (`occasion`,`date_created`),
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
  `status` smallint(6) NOT NULL DEFAULT '10',
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
('16','1','2','9','3','Chess Women','Chess','2','3','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('17','1','1','1','3','test','test','1','1','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('18','1','1','3','3','test2','test2','6','1','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('19','1','1','2','3','test3','test3','5','1','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('20','1','1','1','3','team6','team6','2','1','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('21','1','1','2','3','team7','team7','5','1','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('22','1','1','3','3','team8','team8','1','1','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('23','1','1','2','3','team11','team11','2','1','1','1970-01-01','1970-01-01','3','12');
INSERT INTO `event` (`id`,`occasion_id`,`event_classification_id`,`event_type_id`,`match_system_id`,`event`,`description`,`venue_id`,`event_category_id`,`event_status_id`,`date_start`,`date_end`,`min_team`,`max_team`) VALUES
('24','1','1','1','3','team12','team12','1','2','1','1970-01-01','1970-01-01','3','12');



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
-- TABLE DATA event_round
-- -------------------------------------------
INSERT INTO `event_round` (`id`,`event_id`,`round`,`round_status_id`,`date_start`,`date_end`) VALUES
('8','24','1','1',NULL,NULL);
INSERT INTO `event_round` (`id`,`event_id`,`round`,`round_status_id`,`date_start`,`date_end`) VALUES
('9','24','2','1',NULL,NULL);
INSERT INTO `event_round` (`id`,`event_id`,`round`,`round_status_id`,`date_start`,`date_end`) VALUES
('10','24','3','1',NULL,NULL);
INSERT INTO `event_round` (`id`,`event_id`,`round`,`round_status_id`,`date_start`,`date_end`) VALUES
('11','24','4','1',NULL,NULL);
INSERT INTO `event_round` (`id`,`event_id`,`round`,`round_status_id`,`date_start`,`date_end`) VALUES
('12','24','5','1',NULL,NULL);
INSERT INTO `event_round` (`id`,`event_id`,`round`,`round_status_id`,`date_start`,`date_end`) VALUES
('13','24','6','1',NULL,NULL);
INSERT INTO `event_round` (`id`,`event_id`,`round`,`round_status_id`,`date_start`,`date_end`) VALUES
('14','24','7','1',NULL,NULL);
INSERT INTO `event_round` (`id`,`event_id`,`round`,`round_status_id`,`date_start`,`date_end`) VALUES
('15','24','8','1',NULL,NULL);
INSERT INTO `event_round` (`id`,`event_id`,`round`,`round_status_id`,`date_start`,`date_end`) VALUES
('16','24','9','1',NULL,NULL);
INSERT INTO `event_round` (`id`,`event_id`,`round`,`round_status_id`,`date_start`,`date_end`) VALUES
('17','24','10','1',NULL,NULL);
INSERT INTO `event_round` (`id`,`event_id`,`round`,`round_status_id`,`date_start`,`date_end`) VALUES
('18','24','11','1',NULL,NULL);



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
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('4','1','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'7');
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('5','2','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4');
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('6','3','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'9');
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('7','4','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3');
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('8','5','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10');
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('9','6','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'5');
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('10','7','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'11');
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('11','8','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6');
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('12','9','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8');
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('13','10','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1');
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('14','11','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2');
INSERT INTO `event_team` (`id`,`team_id`,`event_id`,`place_id`,`final_place_id`,`total_wins`,`total_draws`,`total_losses`,`total_score`,`total_time`,`seed_number`) VALUES
('17','13','24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'12');



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
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) VALUES
('1','admin123','jCJziKTRWckwNV9KGPGK8VSxkqjtrgae','$2y$13$HfBBqSexN9m7gDy0OLhPKuADWyfs6oOydMaPgjRkDGbdBroTg6F1W',NULL,'ajmzamora@gmail.com','10','1501224956','1508927591');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) VALUES
('2','admin','tzT8wGoAIjbk7QnaKNnW3zOz5I-S0wLN','$2y$13$mOMSYt.PpPkSuCcrjSmQWeMh6UUrDM4/86durp1vJ8TAygttOJHiG',NULL,'admin123@admin.com','10','1501224969','1501224969');



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
