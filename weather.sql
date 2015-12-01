-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 30 2015 г., 01:29
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
-- Структура таблицы `weather_data`
--

CREATE TABLE IF NOT EXISTS `weather_data` (
  `id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `city_name` varchar(70) NOT NULL,
  `morning_temperature` varchar(3) DEFAULT NULL,
  `morning_temperature_from` varchar(3) DEFAULT NULL,
  `morning_temperature_to` varchar(3) DEFAULT NULL,
  `morning_image` varchar(255) NOT NULL,
  `day_temperature` varchar(3) DEFAULT NULL,
  `day_temperature_from` varchar(3) DEFAULT NULL,
  `day_temperature_to` varchar(3) DEFAULT NULL,
  `day_image` varchar(255) NOT NULL,
  `evening_temperature` varchar(3) DEFAULT NULL,
  `evening_temperature_from` varchar(3) DEFAULT NULL,
  `evening_temperature_to` varchar(3) DEFAULT NULL,
  `evening_image` varchar(255) NOT NULL,
  `night_temperature` varchar(3) DEFAULT NULL,
  `night_temperature_from` varchar(3) DEFAULT NULL,
  `night_temperature_to` varchar(3) DEFAULT NULL,
  `night_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `weather_data`
--

INSERT INTO `weather_data` (`id`, `date`, `city_id`, `city_name`, `morning_temperature`, `morning_temperature_from`, `morning_temperature_to`, `morning_image`, `day_temperature`, `day_temperature_from`, `day_temperature_to`, `day_image`, `evening_temperature`, `evening_temperature_from`, `evening_temperature_to`, `evening_image`, `night_temperature`, `night_temperature_from`, `night_temperature_to`, `night_image`) VALUES
(1, '2015-11-27', 33487, 'Черкассы', NULL, '-1', '0', 'ovc', NULL, '0', '+1', 'ovc', NULL, '-1', '0', 'ovc', '-2', NULL, NULL, 'ovc'),
(2, '2015-11-28', 33487, 'Черкассы', NULL, '-2', '+1', 'bkn_d', NULL, '+1', '+2', 'ovc', '+2', NULL, NULL, 'ovc', '+2', NULL, NULL, 'ovc_ra'),
(3, '2015-11-29', 33487, 'Черкассы', NULL, '+2', '+3', 'ovc_+ra', NULL, '+3', '+4', 'ovc_ra', NULL, '+3', '+5', 'ovc_-ra', NULL, '+1', '+3', 'ovc_-ra'),
(4, '2015-11-30', 33487, 'Черкассы', NULL, '0', '+1', 'bkn_d', NULL, '0', '+3', 'ovc', NULL, '+3', '+4', 'ovc_ra', NULL, '+2', '+4', 'ovc_-ra'),
(5, '2015-12-01', 33487, 'Черкассы', NULL, '+2', '+4', 'bkn_d', NULL, '+4', '+7', 'ovc', NULL, '+5', '+7', 'ovc_ra', NULL, '+2', '+5', 'ovc'),
(6, '2015-12-02', 33487, 'Черкассы', NULL, '+1', '+2', 'ovc', NULL, '+1', '+3', 'ovc', NULL, '+2', '+3', 'ovc', NULL, '+1', '+2', 'ovc'),
(7, '2015-12-03', 33487, 'Черкассы', NULL, '+1', '+2', 'ovc', NULL, '+2', '+6', 'ovc', NULL, '+5', '+6', 'ovc', NULL, '+3', '+5', 'ovc'),
(8, '2015-12-04', 33487, 'Черкассы', NULL, '+2', '+3', 'ovc', NULL, '+3', '+6', 'ovc', NULL, '+4', '+6', 'ovc', NULL, '+1', '+4', 'ovc'),
(9, '2015-12-05', 33487, 'Черкассы', '+1', NULL, NULL, 'ovc', NULL, '+1', '+4', 'ovc', NULL, '+2', '+4', 'ovc', NULL, '0', '+2', 'ovc'),
(10, '2015-12-06', 33487, 'Черкассы', '0', NULL, NULL, 'ovc', NULL, '0', '+3', 'ovc', NULL, '+1', '+3', 'ovc', NULL, '0', '+1', 'ovc');

-- --------------------------------------------------------

--
-- Структура таблицы `yandex`
--

CREATE TABLE IF NOT EXISTS `yandex` (
  `id` int(10) unsigned NOT NULL,
  `source_name` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yandex`
--

INSERT INTO `yandex` (`id`, `source_name`, `source`) VALUES
(1, 'forecast', 'http://export.yandex.ru/weather-ng/forecasts/'),
(3, 'cities', 'http://pogoda.yandex.ru/static/cities');

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
-- Индексы таблицы `weather_data`
--
ALTER TABLE `weather_data`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `yandex`
--
ALTER TABLE `yandex`
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
-- AUTO_INCREMENT для таблицы `weather_data`
--
ALTER TABLE `weather_data`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `yandex`
--
ALTER TABLE `yandex`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `yandex_default_values`
--
ALTER TABLE `yandex_default_values`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
