-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 24 2013 г., 04:07
-- Версия сервера: 5.5.31-MariaDB-log
-- Версия PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `jhekasoft`
--
CREATE DATABASE IF NOT EXISTS `jhekasoft` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jhekasoft`;

-- --------------------------------------------------------

--
-- Структура таблицы `jh_blog`
--

CREATE TABLE IF NOT EXISTS `jh_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `cut_text` text NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `show` enum('no','yes') NOT NULL DEFAULT 'no',
  `show_comments` enum('no','yes') NOT NULL DEFAULT 'no',
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Структура таблицы `jh_final_countdown_email`
--

CREATE TABLE IF NOT EXISTS `jh_final_countdown_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `server_info` longtext NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Структура таблицы `jh_page`
--

CREATE TABLE IF NOT EXISTS `jh_page` (
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
  UNIQUE KEY `id` (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

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
  UNIQUE KEY `id` (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Структура таблицы `jh_sound`
--

CREATE TABLE IF NOT EXISTS `jh_sound` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `lyrics` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `file2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Структура таблицы `jh_user`
--

CREATE TABLE IF NOT EXISTS `jh_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
