SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Структура таблицы `reminder_contacts`
--

CREATE TABLE IF NOT EXISTS `reminder_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `last_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  `red_val` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`user_id`,`position`,`red_val`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Дамп данных таблицы `reminder_contacts`
--

INSERT INTO `reminder_contacts` (`id`, `name`, `last_date`, `user_id`, `position`, `red_val`) VALUES
(1, 'Freddie Mercury', '2012-12-07', 29, 0, 0),
(53, 'Sherlock Holmes', '2011-02-04', 29, 4, 30),
(54, 'Hercule Poirot', '2013-02-04', 29, 6, 30),
(36, 'James Kirk', '2012-12-14', 29, 1, 60),
(55, 'Al Pacino', '2013-02-04', 29, 8, 30),
(38, 'Hugh Laurie', '2012-02-14', 29, 2, 60),
(35, 'Spock', '2012-12-14', 29, 5, 60),
(40, 'Harry Potter', '2012-12-14', 29, 7, 12),
(52, 'Morgan Freeman', '2013-02-04', 29, 3, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `reminder_users`
--

CREATE TABLE IF NOT EXISTS `reminder_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(96) DEFAULT NULL,
  `email` varchar(96) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `reminder_users`
--

INSERT INTO `reminder_users` (`id`, `login`, `password`, `email`) VALUES
(29, 'test', 'e10adc3949ba59abbe56e057f20f883e', 'test@test.test');
