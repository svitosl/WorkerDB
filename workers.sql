-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 04 2021 г., 16:49
-- Версия сервера: 5.6.20
-- Версия PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `workers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `discharges`
--

CREATE TABLE IF NOT EXISTS `discharges` (
`id_disch` int(2) unsigned NOT NULL,
  `coff_disch` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `discharges`
--

INSERT INTO `discharges` (`id_disch`, `coff_disch`) VALUES
(1, '1-й разряд'),
(2, '2-й разряд'),
(3, '3-й разряд'),
(4, '4-й разряд'),
(5, '5-й разряд'),
(6, '6-й разряд');

-- --------------------------------------------------------

--
-- Структура таблицы `salary_worker`
--

CREATE TABLE IF NOT EXISTS `salary_worker` (
`id_wrk` int(4) unsigned NOT NULL,
  `id_wrksh` int(4) unsigned NOT NULL,
  `id_title` int(4) unsigned NOT NULL,
  `id_disch` int(2) unsigned NOT NULL,
  `surname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `midname` varchar(50) NOT NULL,
  `s_work` date NOT NULL,
  `salary` int(7) NOT NULL,
  `exp` int(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `salary_worker`
--

INSERT INTO `salary_worker` (`id_wrk`, `id_wrksh`, `id_title`, `id_disch`, `surname`, `name`, `midname`, `s_work`, `salary`, `exp`) VALUES
(1, 4, 7, 6, 'Васильев', 'Петр', 'Васильевич', '2019-03-21', 30000, 4),
(2, 4, 1, 3, 'Васильев', 'Павел', 'Петрович', '2018-10-15', 30000, 4),
(3, 3, 2, 2, 'Дмитриев', 'Иван', 'Валерьевич', '2018-09-11', 40000, 5),
(4, 1, 2, 6, 'Морозов', 'Василий', 'Викторович', '2017-11-11', 95000, 9),
(7, 3, 7, 2, 'Кузнецов', 'Олег', 'Викторович', '2019-02-01', 29999, 10),
(8, 4, 3, 3, 'Шукшин', 'Василий', 'Петрович', '2019-02-12', 30000, 5),
(9, 3, 2, 5, 'Дмитриев', 'Павел', 'Викторович', '1990-01-01', 15000, 10),
(12, 2, 5, 4, 'Волков', 'Василий', 'Викторович', '2019-03-21', 50000, 6),
(13, 2, 4, 1, 'Петров', 'Григорий', 'Иванович', '2019-03-21', 20000, 6),
(17, 3, 4, 1, 'Кузьмин', 'Святослав', 'Валерьевич', '2016-06-06', 30000, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `titles`
--

CREATE TABLE IF NOT EXISTS `titles` (
`id_title` int(4) unsigned NOT NULL,
  `name_title` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `titles`
--

INSERT INTO `titles` (`id_title`, `name_title`) VALUES
(1, 'Токарь'),
(2, 'Фрезеровщик'),
(3, 'Механик'),
(4, 'Сварщик'),
(5, 'Столяр'),
(6, 'Слесарь'),
(7, 'Проектировщик');

-- --------------------------------------------------------

--
-- Структура таблицы `workshop`
--

CREATE TABLE IF NOT EXISTS `workshop` (
`id_wrksh` int(4) unsigned NOT NULL,
  `name_wrksh` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `workshop`
--

INSERT INTO `workshop` (`id_wrksh`, `name_wrksh`) VALUES
(1, 'Ремонтный'),
(2, 'Литейный'),
(3, 'Производства готовой продукции'),
(4, 'Цех утилизации отходов');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discharges`
--
ALTER TABLE `discharges`
 ADD PRIMARY KEY (`id_disch`);

--
-- Indexes for table `salary_worker`
--
ALTER TABLE `salary_worker`
 ADD PRIMARY KEY (`id_wrk`), ADD KEY `id_wrksh` (`id_wrksh`), ADD KEY `id_title` (`id_title`), ADD KEY `id_disch` (`id_disch`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
 ADD PRIMARY KEY (`id_title`);

--
-- Indexes for table `workshop`
--
ALTER TABLE `workshop`
 ADD PRIMARY KEY (`id_wrksh`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discharges`
--
ALTER TABLE `discharges`
MODIFY `id_disch` int(2) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `salary_worker`
--
ALTER TABLE `salary_worker`
MODIFY `id_wrk` int(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
MODIFY `id_title` int(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `workshop`
--
ALTER TABLE `workshop`
MODIFY `id_wrksh` int(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
