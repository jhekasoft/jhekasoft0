-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 27 2012 г., 14:35
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `jh_pages`
--

INSERT INTO `jh_pages` (`id`, `name`, `par_id`, `datetime`, `title`, `author`, `text`, `image`, `show`) VALUES
(1, 'about', 0, '2012-10-26 00:00:00', 'О сайте', '', 'О сайте<br />\r\nО сайте', '', 'yes'),
(2, 'about-history', 1, '2012-10-26 00:00:00', 'История', '', 'История', '', 'yes'),
(3, 'video', 0, '2012-10-27 00:00:00', 'Видео', '', '<p>Все мои видео-ролики можно найти на <a href="https://www.youtube.com/user/jhekasoft">канале Youtube</a>.</p>\r\n\r\n<p>Новые и интересные видео я буду выкладывать здесь.</p>\r\n\r\n<div class="content_information">\r\n<ul>\r\n<li>Скринкаст <a href="/pages/show/video-instead">INSTEAD для создателей игр</a></li>\r\n</ul>\r\n</div>', '', 'yes'),
(4, 'video-instead', 3, '2012-10-01 00:00:00', 'Скринкаст «INSTEAD для создателей игр»', '', '<p>\r\n<a href="http://instead.syscall.ru">INSTEAD</a> (INterpreter of Simple TExt ADventure) — интерпретатор простых текстовых приключенческих игр, которые по жанру являются смесью визуальной новеллы и текстового квеста. Общее название жанра таких игр — Интерактивная литература (Interactive fiction) (<a href="http://instead.syscall.ru/wiki/ru/start">источник</a>).\r\n</p>\r\n\r\n<div>\r\n<iframe width="640" height="360" src="http://www.youtube.com/embed/0kqaztf_QgU?list=PLE33D9A8F51860EA1&amp;hl=ru_RU" frameborder="0" allowfullscreen></iframe>\r\n</div>\r\n<p>&nbsp;</p>\r\n\r\n<div>\r\n<iframe width="640" height="360" src="http://www.youtube.com/embed/rB7uf0vpsag?list=PLE33D9A8F51860EA1&amp;hl=ru_RU" frameborder="0" allowfullscreen></iframe>\r\n</div>\r\n<p>&nbsp;</p>\r\n\r\n<div>\r\n<iframe width="640" height="360" src="http://www.youtube.com/embed/_oS1768NLjs?list=PLE33D9A8F51860EA1&amp;hl=ru_RU" frameborder="0" allowfullscreen></iframe>\r\n</div>', '', 'yes'),
(5, 'sound', 0, '2012-10-27 00:00:00', 'Звук', '', '<p>Мои некоторые аудиозаписи можно найти на <a href="soundcloud.com/jhekasoft">SoundCloud</a>.</p>\n\n<p>Здесь будет выложен полный список всех моих записей.</p>\n\n<div class="content_information">\n<div>Билет 33 — О кодировках (песня, которая была на сайте перед открытием)</div>\n            <audio controls>\n              <source src="/files/audio/bilet33/about_encodings.mp3">\n              <source src="/files/audio/bilet33/about_encodings.ogg">\n              Тут должна была быть песенка(<a href="/files/audio/bilet33/about_encodings.mp3">mp3</a> |\n              <a href="/files/audio/bilet33/about_encodings.ogg">ogg</a>). Но ваш браузер не смог её воспроизвести :(\n            </audio>\n</div>', '', 'yes'),
(6, 'blog', 0, '2012-10-27 00:00:00', 'Блог', '', '<p>Скоро здесь откроется мой бложек.</p>\n\n<p>А пока можно почитать <a href="http://jhekasoft.livejournal.com">уютненькую жежешечку</a>.</p>', '', 'yes');

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
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `jh_software`
--

INSERT INTO `jh_software` (`id`, `name`, `datetime`, `title`, `version`, `short_text`, `text`, `image`, `file`, `archive`, `show`, `type`, `author_id`, `platform_linux`, `platform_android`, `platform_www`, `platform_windows`) VALUES
(1, 'alarm', '2012-10-16 22:54:00', 'JS Alarm', '4.2.1', '<p>Программа-оповещатель.</p>', '<img src="/files/software/images/jsalarm.gif" alt="" style="float: left; margin-right: 10px; margin-bottom: 10px;">\n<p>\nОсновные функции <b>JS Alarm</b>:\n</p>\n<ul>\n<li>запуск оповещений в заданную дату, ежедневно, дни недели, дни месяца;</li>\n<li>возможность "быстрого" оповещения (просто указывается время, по истечении которого необходимо запустить оповещение);</li>\n<li>возможность оповещать о праздниках;</li>\n<li>различные способы оповещения: текст, звуковой файл (WAVE, MP3, OGG), мелодия системного динамика\n(файлы мелодий можно создавать самостоятельно), изображение, запуск файла;</li>\n<li>сообщение о пропущенных оповещениях;</li>\n<li>возможность отложить оповещение ("дремота").</li>\n</ul>\n</p>\n', 'jsalarm.gif', 'jsalarm421.zip', 'yes', 'yes', 'software', 1, '0', '0', '0', '1'),
(2, 'setwin', '2012-10-16 09:00:00', 'SetWin', '0.6.4', '<p>\nПрограмма предназначена для изменения некоторых настроек ОС Windows: подпись Корзины,\nавтозагрузка, оповещение о малом месте на диске и др. Для полного доступа\nнастроек необходимо иметь права администратора (доступ к реестру Windows).\n</p>', '<img src="/files/software/images/setwin.gif" alt="" style="float: left; margin-right: 10px; margin-bottom: 10px;">\n<p>\nПрограмма предназначена для изменения некоторых настроек ОС Windows: подпись Корзины,\nавтозагрузка, оповещение о малом месте на диске и др. Для полного доступа\nнастроек необходимо иметь права администратора (доступ к реестру Windows).\n</p>', 'setwin.gif', 'setwin_064.zip', 'yes', 'yes', 'software', 1, '0', '0', '0', '1'),
(3, 'shift', '2012-10-01 00:00:00', 'JS Shift', '0.1', '<p>Программа позволяет просмотреть в какую смену работает какой-либо человек, смены которого заранее внесены в базу программы.</p>', '<img src="/files/software/images/jsshift.gif" alt="" style="float: left; margin-right: 10px; margin-bottom: 10px;">\n\n<p><strong>Описание для парней</strong>. Программа позволяет просмотреть в какую смену работает какой-либо человек, смены которого заранее внесены в базу программы.</p>\n\n<p><strong>Описание для блондинок</strong>. Вы добавляете одну смену Вашего парня-гопника: Не работает. И всегда cможете убедиться, что он не работает.</p>\n\n<p><strong>Описание для девушек, со стандартным цветом волос</strong>. С помощью этой программы Вы можете составить расписание работы Вашего будущего парня, а потом по этому расписанию искать парня, который так работает.</p>\n\n<p><strong>Описание для рыжеволосых девушек</strong>. Вы не тупые. Сами разберётесь.</p>', 'jsshift.gif', 'jsshift_01.zip', 'yes', 'yes', 'software', 1, '0', '0', '0', '1'),
(4, 'javainformation', '2012-10-01 00:00:00', 'JavaInformation', '', '<p>Программа (мидлет) JavaInformation показывает сведения о Java–платформе вашего мобильного телефона.</p>', '<img src="/files/software/images/javainformation.gif" alt="" style="float: left; margin-right: 10px; margin-bottom: 10px;">\n\n<p>Программа (мидлет) JavaInformation показывает сведения о Java–платформе вашего мобильного телефона.</p>\n\n<p>Версия 1.0 программы предназначена для всех моделей телефонов.</p>\n\n<p>Версия 2.0 подходит для мобильных телефонов поддерживающих конфигурацию CLDC 1.0 и профиль MIDP 2.0.</p>\n\n<div><a href="/files/software/files/javainf10.zip">Скачать v1.0</a></div>\n\n<div><a href="/files/software/files/javainf20.zip">Скачать v2.0</a></div>', 'javainformation.gif', '', 'yes', 'yes', 'software', 2, '0', '0', '0', '0'),
(5, 'birthday', '2012-10-01 00:00:00', 'Birthday', '', '<p>Программа «Birthday» нужна тем, кто забывает о празднике День рождения. При запуске программы показывается сообщение с информацией об имениннике.</p>', '<img src="/files/software/images/birthday.gif" alt="" style="float: left; margin-right: 10px; margin-bottom: 10px;">\n<p>Программа «Birthday» нужна тем, кто забывает о празднике День рождения. При запуске программы показывается сообщение с информацией об имениннике.</p>', 'birthday.gif', 'birthday.zip', 'yes', 'yes', 'software', 2, '0', '0', '0', '1'),
(6, 'cdrom-project', '2012-10-01 00:00:00', 'CD-ROM Project', '', '<p>Программа открывает и закрывает лоток привода. Комбинация клавиш Ctrl+Alt+F1 откроет окно с информацией о программе и её авторе.</p>', '<img src="/files/software/images/cdrom.gif" alt="" style="float: left; margin-right: 10px; margin-bottom: 10px;">\n\n<p>Программа открывает и закрывает лоток привода.</p>\n<p>Комбинация клавиш <strong>Ctrl+Alt+F1</strong> откроет окно с информацией о программе и её авторе.</p>', 'cdrom.gif', 'cdrom.zip', 'yes', 'yes', 'software', 2, '0', '0', '0', '1'),
(7, 'profits', '2012-10-01 00:00:00', 'Profits', '', '<p>Программа выполняет настройку Windows. Комбинация клавиш Ctrl+Alt+F1 откроет окно с информацией о программе и её авторе.<p>', '<img src="/files/software/images/profits.gif" alt="" style="float: left; margin-right: 10px; margin-bottom: 10px;">\n\n<p>Программа выполняет настройку Windows.</p>\n\n<p>Комбинация клавиш <strong>Ctrl+Alt+F1</strong> откроет окно с информацией о программе и её авторе.</p>', 'profits.gif', 'profits.zip', 'yes', 'yes', 'software', 2, '0', '0', '0', '1'),
(8, 'tamagluchi', '2012-10-27 00:00:00', 'Тамаглючи', '1.1', '<p>\r\nПрограмма "Тамаглючи" создавалась для того, чтобы вспомнить когда-то популярную игру "Тамагочи". \r\nОсобенно те, кто играл в неё, будут рады испробовать её аналог на PC.\r\n</p>\r\n', '<img src="/files/software/images/tamagluchi.gif" alt="" style="float: left; margin-right: 10px; margin-bottom: 10px;">\n<p>\nПрограмма "Тамаглючи" создавалась для того, чтобы вспомнить когда-то популярную игру "Тамагочи". \nОсобенно те, кто играл в неё, будут рады испробовать её аналог на PC.\n</p>\n<p>\nЯ видел несколько аналогов "Тамагочи" на PC, но они не очень мне понравились. Люди, \nкоторые их создавали, забыли о том, что "Тамагочи" не будет работать \nвсё время на компьютере. Обычно для "Тамагочи" один день &ndash; это один год. Но для компьютерного \nаналога "Тамагочи" это слишком много. В этой версии я сделал доступным пользователю\nсамому выбрать время, в течении которого питомец постареет на один год (от 10 минут\nдо 24 часов).\n</p>\n<p>\nЯ не говорю, что мой "Тамаглючи" лучше \nостальных аналогов, такое даже невозможно. Все программы уникальны, если даже \nмоя программа чем-то лучше других аналогичных, то обязательно она и чем-то хуже. Вот так вот...\n</p>', 'tamagluchi.gif', 'tamagluchi_1_1.zip', 'yes', 'yes', 'game', 1, '0', '0', '0', '1'),
(9, 'krestiki-noliki', '2012-10-01 00:00:00', 'Крестики-нолики', '', '<p>Крестики-нолики. Попробуй выиграть. Способ есть!</p>', '<img src="/files/software/images/krestnol.gif" alt="" style="float: left; margin-right: 10px; margin-bottom: 10px;">\n\n<p>Крестики-нолики. Попробуй выиграть. Способ есть!</p>', 'krestnol.gif', 'krestnol.zip', 'yes', 'yes', 'game', 3, '0', '0', '0', '1'),
(10, 'jhekaloto', '2012-10-01 00:00:00', 'JhekaLoto', '0.1', '<p>Если вы хотите поиграть в лото, то эта программа для вас! Вам только билетики необходимо нарисовать (или напечатать), а с помощью этой проги вы будете получать случайные неповторяющиеся номера!</p>', '<img src="/files/software/images/jhekaloto.gif" alt="" style="float: left; margin-right: 10px; margin-bottom: 10px;">\n\n<p>Если вы хотите поиграть в лото, то эта программа для вас! Вам только билетики необходимо нарисовать (или напечатать), а с помощью этой проги вы будете получать случайные неповторяющиеся номера!\n\n<p>Да, кстати в комплекте идёт doc-файл с билетами!</p>\n\n<p>А ещё исходиники есть в комплекте (если кому надо) для BSD 2006 (для С++Builder).</p>\n', 'jhekaloto.gif', 'jhekaloto.zip', 'yes', 'yes', 'game', 1, '0', '0', '0', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
