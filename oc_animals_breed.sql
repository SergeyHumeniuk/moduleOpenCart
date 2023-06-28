-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 28 2023 г., 10:58
-- Версия сервера: 5.5.62-log
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `opencart`
--

-- --------------------------------------------------------

--
-- Структура таблицы `oc_animals_breed`
--

CREATE TABLE `oc_animals_breed` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `sex` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `oc_animals_breed`
--

INSERT INTO `oc_animals_breed` (`id`, `animal_id`, `breed`, `sex`) VALUES
(1, 2, 'Абиссинская', 1),
(2, 2, 'Австралийский мист', 1),
(3, 2, 'Азиатская', 1),
(4, 3, 'Акита-ину', 1),
(5, 3, 'Алабай', 1),
(6, 3, 'Бернский зенненхунд', 1),
(7, 1, 'Среднеазиатская сухопутная', 1),
(8, 1, 'Американская болотная', 1),
(9, 1, 'Звездчатая сухопутная', 1),
(10, 4, 'Петушок', 0),
(11, 4, 'Скалярия', 0),
(12, 4, 'Анциструс', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `oc_animals_breed`
--
ALTER TABLE `oc_animals_breed`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `oc_animals_breed`
--
ALTER TABLE `oc_animals_breed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
