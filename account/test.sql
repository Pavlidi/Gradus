-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Мар 26 2026 г., 07:45
-- Версия сервера: 8.0.44
-- Версия PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users_info`
--

CREATE TABLE `users_info` (
  `id` int NOT NULL,
  `parent_lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent_firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent_middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent_phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `student_lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `student_firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `student_middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `student_phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `student_class` int DEFAULT NULL,
  `study_format` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `group_number` int DEFAULT NULL,
  `subject_1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent_password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `student_password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '314159265'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users_info`
--

INSERT INTO `users_info` (`id`, `parent_lastname`, `parent_firstname`, `parent_middlename`, `parent_phone`, `student_lastname`, `student_firstname`, `student_middlename`, `student_phone`, `student_class`, `study_format`, `group_number`, `subject_1`, `parent_password`, `student_password`, `admin_password`) VALUES
(1, 'Павлидий', 'Сергей', '', '', 'Павлидий', 'Адриан', '', '', 0, 'Индивидуально', 0, '', NULL, NULL, '314159265'),
(2, 'Павлидий', 'Карина', 'Вадимовна', '+79965450493', 'Павлидий', 'Сергей', 'Сергеевич', '+79681748319', 1, 'Группа', 1, 'Математика', NULL, NULL, '314159265'),
(3, '', '', '', '', 'Павлидий', 'Карина', '', '', 0, 'Группа', 1, 'Математика', NULL, NULL, '314159265'),
(4, '', '', '', '', 'Цветков', 'Саша', '', '', 0, 'Группа', 2, 'Физика', NULL, NULL, '314159265'),
(5, '', '', '', '', 'Кислицин', 'Арсений', '', '', 11, 'Индивидуально', 0, 'Физика', NULL, NULL, '314159265'),
(6, '', '', '', '', 'Кислицин', 'Арсений', '', '', 11, 'Индивидуально', 0, 'Математика', NULL, NULL, '314159265'),
(7, '', '', '', '', 'Кислицин', 'Арсений', '', '', 11, 'Группа', 2, 'Половое воспитание', NULL, NULL, '314159265');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
