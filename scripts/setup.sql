CREATE USER 'twitter_user'@'localhost' identified by 'twitter_user_password';
CREATE DATABASE IF NOT EXISTS `twitter_handle` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
GRANT ALL ON twitter_database.* TO 'twitter_user'@'localhost';
USE `twitter_twitter_database`;

CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `DrJillStein` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `twitter_id` varchar(50) NOT NULL,
  `tweet` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `retrieve_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3743 ;

CREATE TABLE IF NOT EXISTS `GovGaryJohnson` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `twitter_id` varchar(50) NOT NULL,
  `tweet` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `retrieve_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=488 ;

CREATE TABLE IF NOT EXISTS `HillaryClinton` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `twitter_id` varchar(50) NOT NULL,
  `tweet` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `retrieve_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3377 ;

CREATE TABLE IF NOT EXISTS `realDonaldTrump` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `twitter_id` varchar(50) NOT NULL,
  `tweet` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `retrieve_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3372 ;

CREATE TABLE IF NOT EXISTS `SenSanders` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `twitter_id` varchar(50) NOT NULL,
  `tweet` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `retrieve_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3318 ;

