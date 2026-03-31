-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Мар 31 2026 г., 13:07
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
-- Структура таблицы `homeworks`
--

CREATE TABLE `homeworks` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `homework_date` date DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `target_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `target_value` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `homeworks`
--

INSERT INTO `homeworks` (`id`, `title`, `homework_date`, `file_path`, `target_type`, `target_value`, `created_at`) VALUES
(13, 'Кинематика - начало', '2026-03-31', 'uploads/homeworks/1774753456_Домашнее задание 1-ПП.pdf', 'student', 'Петров Петр', '2026-03-29 03:04:16'),
(14, 'Кинематика - конец', '2026-04-02', 'uploads/homeworks/1774753468_Домашнее задание 2-ПП.pdf', 'student', 'Петров Петр', '2026-03-29 03:04:28'),
(15, 'Алгебра', '2026-03-31', 'uploads/homeworks/1774754407_Домашнее задание 1-ИИ.pdf', 'student', 'Иванов Иван', '2026-03-29 03:20:07'),
(16, 'Динамика', '2026-03-30', 'uploads/homeworks/1774755429_Домашнее задание 3-ПП.pdf', 'student', 'Петров Петр', '2026-03-29 03:37:09'),
(17, 'Термодинамика', '2026-04-01', 'uploads/homeworks/1774755442_Домашнее задание 4-ПП.pdf', 'student', 'Петров Петр', '2026-03-29 03:37:22'),
(18, 'МКТ', '2026-04-01', 'uploads/homeworks/1774756067_Домашнее задание 2-ПП.pdf', 'student', 'Петров Петр', '2026-03-29 03:47:47'),
(19, 'Сила Архимеда', '2026-04-01', 'uploads/homeworks/1774761349_Домашнее задание 3-ПП.pdf', 'group', '1', '2026-03-29 05:15:49'),
(20, 'Геометрия', '2026-04-03', 'uploads/homeworks/1774761476_Домашнее задание 1-ИИ.pdf', 'group', '2', '2026-03-29 05:17:56'),
(21, 'Ященко', '2026-04-03', 'uploads/homeworks/1774763955_photo_2026-03-29 09.08.14.jpeg', 'student', 'Ященко Ященко', '2026-03-29 05:59:15');

-- --------------------------------------------------------

--
-- Структура таблицы `homework_submissions`
--

CREATE TABLE `homework_submissions` (
  `id` int NOT NULL,
  `homework_id` int DEFAULT NULL,
  `student_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `completed_tasks` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `homework_submissions`
--

INSERT INTO `homework_submissions` (`id`, `homework_id`, `student_name`, `status`, `completed_tasks`, `created_at`) VALUES
(9, 14, 'Петров Петр', 'проверено', 0, '2026-03-29 03:05:23'),
(10, 13, 'Петров Петр', 'проверено', 0, '2026-03-29 03:05:46'),
(11, 15, 'Иванов Иван', 'проверено', 55, '2026-03-29 03:26:00'),
(12, 16, 'Петров Петр', 'проверено', 80, '2026-03-29 03:43:43'),
(13, 17, 'Петров Петр', 'проверено', 60, '2026-03-29 03:44:11'),
(14, 18, 'Петров Петр', 'проверено', 80, '2026-03-29 03:48:05'),
(15, 19, 'Александр Александр', 'проверено', 80, '2026-03-29 05:17:14'),
(16, 20, 'Гоша Гоша', 'проверено', 70, '2026-03-29 05:18:11'),
(17, 20, 'Вова Вова', 'проверено', 30, '2026-03-29 05:42:01');

-- --------------------------------------------------------

--
-- Структура таблицы `submission_files`
--

CREATE TABLE `submission_files` (
  `id` int NOT NULL,
  `submission_id` int DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `submission_files`
--

INSERT INTO `submission_files` (`id`, `submission_id`, `file_path`, `file_type`, `created_at`) VALUES
(22, 9, 'uploads/solutions/69c896f3102be_photo_2026-03-29 09.09.50.jpeg', 'solution', '2026-03-29 03:05:23'),
(23, 10, 'uploads/solutions/69c8970a8e176_photo_2026-03-29 09.08.27.jpeg', 'solution', '2026-03-29 03:05:46'),
(24, 9, 'uploads/checked/1774754193_photo_2026-03-29 09.09.47.jpeg', 'checked', '2026-03-29 03:16:33'),
(25, 10, 'uploads/checked/1774754244_photo_2026-03-29 09.08.30.jpeg', 'checked', '2026-03-29 03:17:24'),
(26, 11, 'uploads/solutions/69c89bc88306f_photo_2026-03-29 09.08.27.jpeg', 'solution', '2026-03-29 03:26:00'),
(27, 11, 'uploads/solutions/69c89bc8835bc_photo_2026-03-29 09.09.50.jpeg', 'solution', '2026-03-29 03:26:00'),
(28, 11, 'uploads/checked/1774754796_photo_2026-03-29 09.09.47.jpeg', 'checked', '2026-03-29 03:26:36'),
(29, 11, 'uploads/checked/1774754796_photo_2026-03-29 09.08.30.jpeg', 'checked', '2026-03-29 03:26:36'),
(30, 12, 'uploads/solutions/69c89fef1dc01_photo_2026-03-29 10.38.33.jpeg', 'solution', '2026-03-29 03:43:43'),
(31, 12, 'uploads/solutions/69c89fef1e273_photo_2026-03-29 10.38.35.jpeg', 'solution', '2026-03-29 03:43:43'),
(32, 12, 'uploads/solutions/69c89fef1e817_photo_2026-03-29 10.38.36.jpeg', 'solution', '2026-03-29 03:43:43'),
(33, 12, 'uploads/solutions/69c89fef1eda4_photo_2026-03-29 10.38.38.jpeg', 'solution', '2026-03-29 03:43:43'),
(34, 12, 'uploads/solutions/69c89fef1f258_photo_2026-03-29 10.38.40.jpeg', 'solution', '2026-03-29 03:43:43'),
(35, 13, 'uploads/solutions/69c8a00b48d9f_photo_2026-03-29 10.39.50.jpeg', 'solution', '2026-03-29 03:44:11'),
(36, 13, 'uploads/solutions/69c8a00b4afaa_photo_2026-03-29 10.39.49.jpeg', 'solution', '2026-03-29 03:44:11'),
(37, 13, 'uploads/checked/1774755882_photo_2026-03-29 10.39.50.jpeg', 'checked', '2026-03-29 03:44:42'),
(38, 13, 'uploads/checked/1774755882_photo_2026-03-29 10.39.49.jpeg', 'checked', '2026-03-29 03:44:42'),
(39, 12, 'uploads/checked/1774755895_photo_2026-03-29 10.39.35.jpeg', 'checked', '2026-03-29 03:44:55'),
(40, 12, 'uploads/checked/1774755895_photo_2026-03-29 10.39.31.jpeg', 'checked', '2026-03-29 03:44:55'),
(41, 12, 'uploads/checked/1774755895_photo_2026-03-29 10.39.32.jpeg', 'checked', '2026-03-29 03:44:55'),
(42, 12, 'uploads/checked/1774755895_photo_2026-03-29 10.39.34.jpeg', 'checked', '2026-03-29 03:44:55'),
(43, 12, 'uploads/checked/1774755895_photo_2026-03-29 10.39.30.jpeg', 'checked', '2026-03-29 03:44:55'),
(44, 14, 'uploads/solutions/69c8a0f5c7a14_photo_2026-03-29 09.09.50.jpeg', 'solution', '2026-03-29 03:48:05'),
(45, 14, 'uploads/solutions/69c8a0f5c7e78_photo_2026-03-29 09.08.27.jpeg', 'solution', '2026-03-29 03:48:05'),
(46, 14, 'uploads/checked/1774756104_photo_2026-03-29 09.08.30.jpeg', 'checked', '2026-03-29 03:48:24'),
(47, 14, 'uploads/checked/1774756104_photo_2026-03-29 09.09.47.jpeg', 'checked', '2026-03-29 03:48:24'),
(48, 15, 'uploads/solutions/69c8b5da9fa03_photo_2026-03-29 10.39.07.jpeg', 'solution', '2026-03-29 05:17:14'),
(49, 15, 'uploads/solutions/69c8b5daa006d_photo_2026-03-29 10.39.06.jpeg', 'solution', '2026-03-29 05:17:14'),
(50, 16, 'uploads/solutions/69c8b6137fcfb_photo_2026-03-29 09.08.14.jpeg', 'solution', '2026-03-29 05:18:11'),
(51, 15, 'uploads/checked/1774761555_photo_2026-03-29 10.39.50.jpeg', 'checked', '2026-03-29 05:19:15'),
(52, 15, 'uploads/checked/1774761555_photo_2026-03-29 10.39.49.jpeg', 'checked', '2026-03-29 05:19:15'),
(53, 16, 'uploads/checked/1774761575_photo_2026-03-29 09.08.14.jpeg', 'checked', '2026-03-29 05:19:35'),
(54, 17, 'uploads/solutions/69c8bba955865_photo_2026-03-29 09.08.14.jpeg', 'solution', '2026-03-29 05:42:01'),
(55, 17, 'uploads/checked/1774762932_photo_2026-03-29 09.08.14.jpeg', 'checked', '2026-03-29 05:42:12');

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
  `admin_password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '314159265',
  `lessons_total` int DEFAULT '0',
  `attendance` int DEFAULT '0',
  `homeworks_total` int DEFAULT '0',
  `homeworks_done` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users_info`
--

INSERT INTO `users_info` (`id`, `parent_lastname`, `parent_firstname`, `parent_middlename`, `parent_phone`, `student_lastname`, `student_firstname`, `student_middlename`, `student_phone`, `student_class`, `study_format`, `group_number`, `subject_1`, `parent_password`, `student_password`, `admin_password`, `lessons_total`, `attendance`, `homeworks_total`, `homeworks_done`) VALUES
(8, '', '', '', '', 'Иванов', 'Иван', '', '', 11, 'Индивидуально', 0, 'Математика', NULL, NULL, '314159265', 0, 0, 0, 0),
(9, '', '', '', '', 'Петров', 'Петр', '', '', 9, 'Индивидуально', 0, 'Физика', NULL, NULL, '314159265', 0, 0, 0, 0),
(10, '', '', '', '', 'Александр', 'Александр', '', '', 0, 'Группа', 1, 'Физика', NULL, NULL, '314159265', 5, 4, 4, 4),
(11, '', '', '', '', 'Вова', 'Вова', '', '', 0, 'Группа', 2, 'Физика', NULL, NULL, '314159265', 10, 8, 9, 4),
(12, '', '', '', '', 'Гоша', 'Гоша', '', '', 0, 'Группа', 2, 'Математика', NULL, NULL, '314159265', 0, 0, 0, 0),
(13, '', '', '', '', 'Ященко', 'Ященко', '', '', 0, 'Индивидуально', 0, 'Математика', NULL, NULL, '314159265', 0, 0, 0, 0),
(14, '', '', '', '', 'Наби', 'Наби', '', '', 0, 'Индивидуально', 0, 'Математика', NULL, NULL, '314159265', 0, 0, 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `homeworks`
--
ALTER TABLE `homeworks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `homework_submissions`
--
ALTER TABLE `homework_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `submission_files`
--
ALTER TABLE `submission_files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `homework_submissions`
--
ALTER TABLE `homework_submissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `submission_files`
--
ALTER TABLE `submission_files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
