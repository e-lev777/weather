-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 01 2015 г., 12:03
-- Версия сервера: 5.6.25-log
-- Версия PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `weather`
--

-- --------------------------------------------------------

--
-- Структура таблицы `informer`
--

CREATE TABLE IF NOT EXISTS `informer` (
  `id` int(10) unsigned NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `informer`
--

INSERT INTO `informer` (`id`, `content`) VALUES
(1, 'http://weather/informer.html');

-- --------------------------------------------------------

--
-- Структура таблицы `sources`
--

CREATE TABLE IF NOT EXISTS `sources` (
  `id` int(10) unsigned NOT NULL,
  `source_name` varchar(255) NOT NULL,
  `weather_source` varchar(255) NOT NULL,
  `cities_source` varchar(255) DEFAULT NULL,
  `default_value` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sources`
--

INSERT INTO `sources` (`id`, `source_name`, `weather_source`, `cities_source`, `default_value`) VALUES
(1, 'yandex', 'http://export.yandex.ru/weather-ng/forecasts/', 'http://pogoda.yandex.ru/static/cities', 33487);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `login` varchar(100) NOT NULL,
  `hash_password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `access` tinyint(4) NOT NULL DEFAULT '0',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `hash_password`, `email`, `active`, `access`, `reg_date`) VALUES
(11, 'admin', '462d8f9b46b783f4d4693f733e2ee11f', 'admin@gmail.com.ua', 1, 5, '2015-12-01 09:59:02');

-- --------------------------------------------------------

--
-- Структура таблицы `yandex_default_values`
--

CREATE TABLE IF NOT EXISTS `yandex_default_values` (
  `id` int(10) unsigned NOT NULL,
  `yandex_city_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yandex_default_values`
--

INSERT INTO `yandex_default_values` (`id`, `yandex_city_id`) VALUES
(1, 33487);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `informer`
--
ALTER TABLE `informer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `yandex_default_values`
--
ALTER TABLE `yandex_default_values`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `informer`
--
ALTER TABLE `informer`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `sources`
--
ALTER TABLE `sources`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `yandex_default_values`
--
ALTER TABLE `yandex_default_values`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
