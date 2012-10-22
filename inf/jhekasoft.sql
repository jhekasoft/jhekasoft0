-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 23 2012 г., 00:51
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `author` varchar(255) NOT NULL,
  `short_text` text NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `archive` enum('yes','no') NOT NULL DEFAULT 'no',
  `show` enum('no','yes') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `jh_software`
--

INSERT INTO `jh_software` (`id`, `name`, `datetime`, `title`, `version`, `author`, `short_text`, `text`, `image`, `file`, `archive`, `show`) VALUES
(1, 'alarm', '2012-10-16 22:54:00', 'JS Alarm', '4.2.1', 'Евгений Ефремов', '<p>\r\nОсновные функции <b>JS Alarm</b>:\r\n</p>\r\n<ul>\r\n<li>запуск оповещений в заданную дату, ежедневно, дни недели, дни месяца;</li>\r\n<li>возможность "быстрого" оповещения (просто указывается время, по истечении которого необходимо запустить оповещение);</li>\r\n<li>возможность оповещать о праздниках;</li>\r\n<li>различные способы оповещения: текст, звуковой файл (WAVE, MP3, OGG), мелодия системного динамика\r\n(файлы мелодий можно создавать самостоятельно), изображение, запуск файла;</li>\r\n<li>сообщение о пропущенных оповещениях;</li>\r\n<li>возможность отложить оповещение ("дремота").</li>\r\n</ul>\r\n<p>', '<p>\r\nОсновные функции <b>JS Alarm</b>:\r\n</p>\r\n<ul>\r\n<li>запуск оповещений в заданную дату, ежедневно, дни недели, дни месяца;</li>\r\n<li>возможность "быстрого" оповещения (просто указывается время, по истечении которого необходимо запустить оповещение);</li>\r\n<li>возможность оповещать о праздниках;</li>\r\n<li>различные способы оповещения: текст, звуковой файл (WAVE, MP3, OGG), мелодия системного динамика\r\n(файлы мелодий можно создавать самостоятельно), изображение, запуск файла;</li>\r\n<li>сообщение о пропущенных оповещениях;</li>\r\n<li>возможность отложить оповещение ("дремота").</li>\r\n</ul>\r\n<p>', '', '', 'yes', 'yes'),
(2, 'setwin', '2012-10-16 09:00:00', 'SetWin', '0.6.4', 'Евгений Ефремов', '<p>\r\nПрограмма предназначена для изменения некоторых настроек ОС Windows: подпись Корзины,\r\nавтозагрузка, оповещение о малом месте на диске и др. Для полного доступа\r\nнастроек необходимо иметь права администратора (доступ к реестру Windows).\r\n</p>', '<p>\r\nПрограмма предназначена для изменения некоторых настроек ОС Windows: подпись Корзины,\r\nавтозагрузка, оповещение о малом месте на диске и др. Для полного доступа\r\nнастроек необходимо иметь права администратора (доступ к реестру Windows).\r\n</p>', '', '', 'yes', 'yes');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
