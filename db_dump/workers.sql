-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 02 2018 г., 01:13
-- Версия сервера: 5.6.38
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `workers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `positions`
--

CREATE TABLE `positions` (
  `code` int(8) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `positions`
--

INSERT INTO `positions` (`code`, `name`) VALUES
(0, 'Не определена'),
(1, 'Директор'),
(3, 'Расхититель гробниц'),
(4, 'Повелитель молний'),
(5, 'Хранитель очага'),
(6, 'Кузнец твоего счастья'),
(7, 'Лучник'),
(8, 'Держатель лестницы');

-- --------------------------------------------------------

--
-- Структура таблицы `worker_list`
--

CREATE TABLE `worker_list` (
  `id` int(255) NOT NULL,
  `fio` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `date` date NOT NULL,
  `position` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `worker_list`
--

INSERT INTO `worker_list` (`id`, `fio`, `status`, `date`, `position`) VALUES
(30, 'Балаклава Мой Враг', 1, '2018-03-02', '0'),
(31, 'Бибиков Кирилл Виторович', 1, '2018-03-02', '1'),
(32, 'Естпопугаев Джон Вайфаевич', 1, '2018-03-02', '0'),
(33, 'Нунемерзоев Афат Дудаевич', 1, '2018-03-02', '1'),
(34, 'Агата Павловна Брррря', 1, '2018-03-04', '5'),
(35, 'Евфидрипий Азотович Спит', 1, '2018-03-09', '4'),
(36, 'Трапеция Орифлеймовна Гдебыла', 1, '2017-10-11', '4'),
(37, 'Карлик из Фильма', 1, '2018-03-27', '8'),
(38, 'Андрей Сын Андрея', 1, '2017-12-11', '6'),
(39, 'Егорка', 1, '2018-03-02', '7'),
(40, 'Человек-Молекула', 1, '2018-03-14', '3'),
(41, 'Шоколадный Джо', 1, '2018-03-14', '1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `worker_list`
--
ALTER TABLE `worker_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `worker_list`
--
ALTER TABLE `worker_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
