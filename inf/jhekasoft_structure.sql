-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 09 2012 г., 00:25
-- Версия сервера: 5.5.28-log
-- Версия PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `jhekasoft`
--

-- --------------------------------------------------------

--
-- Структура таблицы `jh_final_countdown_emails`
--

CREATE TABLE IF NOT EXISTS `jh_final_countdown_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `server_info` longtext NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Структура таблицы `jh_pages`
--

CREATE TABLE IF NOT EXISTS `jh_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `par_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `show` enum('no','yes') NOT NULL DEFAULT 'no',
  `show_share` enum('no','yes') NOT NULL DEFAULT 'yes',
  `show_comments` enum('no','yes') NOT NULL DEFAULT 'no',
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Структура таблицы `jh_software`
--

CREATE TABLE IF NOT EXISTS `jh_software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `short_text` text NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `archive` enum('yes','no') NOT NULL DEFAULT 'no',
  `show` enum('no','yes') NOT NULL DEFAULT 'no',
  `type` enum('software','game') NOT NULL DEFAULT 'software',
  `author_id` int(11) NOT NULL,
  `platform_linux` enum('0','1') NOT NULL DEFAULT '0',
  `platform_android` enum('0','1') NOT NULL DEFAULT '0',
  `platform_www` enum('0','1') NOT NULL DEFAULT '0',
  `platform_windows` enum('0','1') NOT NULL DEFAULT '0',
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
