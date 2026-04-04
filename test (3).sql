-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Апр 04 2026 г., 14:31
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
-- Структура таблицы `ege_math`
--

CREATE TABLE `ege_math` (
  `id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `subject` varchar(50) DEFAULT 'Математика ЕГЭ',
  `total_tasks` int DEFAULT '19',
  `task_1` int DEFAULT NULL,
  `task_2` int DEFAULT NULL,
  `task_3` int DEFAULT NULL,
  `task_4` int DEFAULT NULL,
  `task_5` int DEFAULT NULL,
  `task_6` int DEFAULT NULL,
  `task_7` int DEFAULT NULL,
  `task_8` int DEFAULT NULL,
  `task_9` int DEFAULT NULL,
  `task_10` int DEFAULT NULL,
  `task_11` int DEFAULT NULL,
  `task_12` int DEFAULT NULL,
  `task_13` int DEFAULT NULL,
  `task_14` int DEFAULT NULL,
  `task_15` int DEFAULT NULL,
  `task_16` int DEFAULT NULL,
  `task_17` int DEFAULT NULL,
  `task_18` int DEFAULT NULL,
  `task_19` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `ege_math`
--

INSERT INTO `ege_math` (`id`, `student_id`, `student_name`, `subject`, `total_tasks`, `task_1`, `task_2`, `task_3`, `task_4`, `task_5`, `task_6`, `task_7`, `task_8`, `task_9`, `task_10`, `task_11`, `task_12`, `task_13`, `task_14`, `task_15`, `task_16`, `task_17`, `task_18`, `task_19`) VALUES
(4, 8, 'Иванов Иван', 'Математика ЕГЭ', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 21, 'Петров Даниилка', 'Математика ЕГЭ', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `ege_physics`
--

CREATE TABLE `ege_physics` (
  `id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `subject` varchar(50) DEFAULT 'Физика ЕГЭ',
  `total_tasks` int DEFAULT '26',
  `task_1` int DEFAULT NULL,
  `task_2` int DEFAULT NULL,
  `task_3` int DEFAULT NULL,
  `task_4` int DEFAULT NULL,
  `task_5` int DEFAULT NULL,
  `task_6` int DEFAULT NULL,
  `task_7` int DEFAULT NULL,
  `task_8` int DEFAULT NULL,
  `task_9` int DEFAULT NULL,
  `task_10` int DEFAULT NULL,
  `task_11` int DEFAULT NULL,
  `task_12` int DEFAULT NULL,
  `task_13` int DEFAULT NULL,
  `task_14` int DEFAULT NULL,
  `task_15` int DEFAULT NULL,
  `task_16` int DEFAULT NULL,
  `task_17` int DEFAULT NULL,
  `task_18` int DEFAULT NULL,
  `task_19` int DEFAULT NULL,
  `task_20` int DEFAULT NULL,
  `task_21` int DEFAULT NULL,
  `task_22` int DEFAULT NULL,
  `task_23` int DEFAULT NULL,
  `task_24` int DEFAULT NULL,
  `task_25` int DEFAULT NULL,
  `task_26` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `ege_physics`
--

INSERT INTO `ege_physics` (`id`, `student_id`, `student_name`, `subject`, `total_tasks`, `task_1`, `task_2`, `task_3`, `task_4`, `task_5`, `task_6`, `task_7`, `task_8`, `task_9`, `task_10`, `task_11`, `task_12`, `task_13`, `task_14`, `task_15`, `task_16`, `task_17`, `task_18`, `task_19`, `task_20`, `task_21`, `task_22`, `task_23`, `task_24`, `task_25`, `task_26`) VALUES
(2, 24, 'Петров Даниилка', 'Физика ЕГЭ', 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 27, 'Добавляем Прогресс', 'Физика ЕГЭ', 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `homeworks`
--

CREATE TABLE `homeworks` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `homework_date` date DEFAULT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `target_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `target_value` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `homeworks`
--

INSERT INTO `homeworks` (`id`, `title`, `homework_date`, `file_path`, `target_type`, `target_value`, `created_at`, `subject`) VALUES
(13, 'Кинематика - начало', '2026-03-31', 'uploads/homeworks/1774753456_Домашнее задание 1-ПП.pdf', 'student', 'Петров Петр', '2026-03-29 03:04:16', NULL),
(14, 'Кинематика - конец', '2026-04-02', 'uploads/homeworks/1774753468_Домашнее задание 2-ПП.pdf', 'student', 'Петров Петр', '2026-03-29 03:04:28', NULL),
(15, 'Алгебра', '2026-03-31', 'uploads/homeworks/1774754407_Домашнее задание 1-ИИ.pdf', 'student', 'Иванов Иван', '2026-03-29 03:20:07', NULL),
(16, 'Динамика', '2026-03-30', 'uploads/homeworks/1774755429_Домашнее задание 3-ПП.pdf', 'student', 'Петров Петр', '2026-03-29 03:37:09', NULL),
(17, 'Термодинамика', '2026-04-01', 'uploads/homeworks/1774755442_Домашнее задание 4-ПП.pdf', 'student', 'Петров Петр', '2026-03-29 03:37:22', NULL),
(18, 'МКТ', '2026-04-01', 'uploads/homeworks/1774756067_Домашнее задание 2-ПП.pdf', 'student', 'Петров Петр', '2026-03-29 03:47:47', NULL),
(19, 'Сила Архимеда', '2026-04-01', 'uploads/homeworks/1774761349_Домашнее задание 3-ПП.pdf', 'group', '1', '2026-03-29 05:15:49', NULL),
(20, 'Геометрия', '2026-04-03', 'uploads/homeworks/1774761476_Домашнее задание 1-ИИ.pdf', 'group', '2', '2026-03-29 05:17:56', NULL),
(21, 'Ященко', '2026-04-03', 'uploads/homeworks/1774763955_photo_2026-03-29 09.08.14.jpeg', 'student', 'Ященко Ященко', '2026-03-29 05:59:15', NULL),
(22, 'Производные', '2026-04-08', 'uploads/homeworks/1775107078_Домашнее задание ГС-3.pdf', 'student', 'Петров Даниилка', '2026-04-02 05:17:58', 'Математика'),
(28, 'Тригонометрия', '2026-04-23', 'uploads/homeworks/1775122942_Снимок экрана 2026-03-16 в 13.31.48.png', 'student', 'Петров Даниилка', '2026-04-02 09:42:22', 'Математика'),
(29, 'Сила Архимеда', '2026-04-09', 'uploads/homeworks/1775195027_Домашнее задание 1-2.pdf', 'student', 'Петров Даниилка', '2026-04-03 05:43:47', 'Физика'),
(34, 'Проверка', '2026-04-09', 'uploads/homeworks/1775199419_Домашнее задание 1-ИИ.pdf', 'student', 'Петров Даниилка', '2026-04-03 06:56:59', 'Физика'),
(35, 'Тест', '2026-04-17', 'uploads/homeworks/1775203510_Домашнее задание 1-ИИ.pdf', 'student', 'Петров Даниилка', '2026-04-03 08:05:10', 'Физика'),
(36, 'Должно работать', '2026-04-09', 'uploads/homeworks/1775203609_Домашнее задание 1-ИИ.pdf', 'student', 'Петров Даниилка', '2026-04-03 08:06:49', 'Математика'),
(37, 'А теперь?', '2026-04-10', 'uploads/homeworks/1775203759_Домашнее задание 1-ИИ.pdf', 'student', 'Петров Даниилка', '2026-04-03 08:09:19', 'Математика'),
(38, 'Посмотрим', '2026-04-10', 'uploads/homeworks/1775204179_Домашнее задание 1-ИИ.pdf', 'student', 'Петров Даниилка', '2026-04-03 08:16:19', 'Математика'),
(39, 'А если несколько файлов?', '2026-04-04', 'uploads/homeworks/1775204239_Домашнее задание 1-ИИ.pdf', 'student', 'Петров Даниилка', '2026-04-03 08:17:19', 'Математика'),
(40, 'Калькулятор', '2026-04-07', 'uploads/homeworks/1775282959_1775199419_Домашнее задание 1-ИИ (1).pdf', 'student', 'Петров Даниилка', '2026-04-04 06:09:19', 'Математика'),
(41, 'Черные дыры', '2026-04-15', 'uploads/homeworks/1775283504_Домашнее задание 1-51.pdf', 'student', 'Петров Даниилка', '2026-04-04 06:18:24', 'Физика');

-- --------------------------------------------------------

--
-- Структура таблицы `homework_submissions`
--

CREATE TABLE `homework_submissions` (
  `id` int NOT NULL,
  `homework_id` int DEFAULT NULL,
  `student_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `completed_tasks` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `homework_submissions`
--

INSERT INTO `homework_submissions` (`id`, `homework_id`, `student_name`, `status`, `completed_tasks`, `created_at`, `subject`) VALUES
(9, 14, 'Петров Петр', 'проверено', 0, '2026-03-29 03:05:23', NULL),
(10, 13, 'Петров Петр', 'проверено', 0, '2026-03-29 03:05:46', NULL),
(11, 15, 'Иванов Иван', 'проверено', 55, '2026-03-29 03:26:00', NULL),
(12, 16, 'Петров Петр', 'проверено', 80, '2026-03-29 03:43:43', NULL),
(13, 17, 'Петров Петр', 'проверено', 60, '2026-03-29 03:44:11', NULL),
(14, 18, 'Петров Петр', 'проверено', 80, '2026-03-29 03:48:05', NULL),
(15, 19, 'Александр Александр', 'проверено', 80, '2026-03-29 05:17:14', NULL),
(16, 20, 'Гоша Гоша', 'проверено', 70, '2026-03-29 05:18:11', NULL),
(17, 20, 'Вова Вова', 'проверено', 30, '2026-03-29 05:42:01', NULL),
(25, 28, 'Петров Даниилка', 'проверено', 65, '2026-04-02 09:42:31', NULL),
(26, 22, 'Петров Даниилка', 'проверено', 70, '2026-04-03 05:57:19', NULL),
(27, 29, 'Петров Даниилка', 'проверено', 40, '2026-04-03 06:11:48', NULL),
(28, 34, 'Петров Даниилка', 'проверено', 77, '2026-04-03 07:56:46', NULL),
(29, 35, 'Петров Даниилка', 'проверено', 70, '2026-04-03 08:05:20', NULL),
(30, 36, 'Петров Даниилка', 'проверено', 60, '2026-04-03 08:06:56', NULL),
(31, 37, 'Петров Даниилка', 'проверено', 80, '2026-04-03 08:09:28', NULL),
(32, 38, 'Петров Даниилка', 'проверено', 60, '2026-04-03 08:16:25', 'Физика'),
(33, 39, 'Петров Даниилка', 'проверено', 100, '2026-04-03 08:17:30', 'Математика'),
(36, 40, 'Петров Даниилка', 'проверено', 66, '2026-04-04 06:16:52', 'Математика'),
(37, 41, 'Петров Даниилка', 'проверено', 20, '2026-04-04 06:18:50', 'Физика');

-- --------------------------------------------------------

--
-- Структура таблицы `oge_math`
--

CREATE TABLE `oge_math` (
  `id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `subject` varchar(50) DEFAULT 'Математика ОГЭ',
  `total_tasks` int DEFAULT '25',
  `task_1` int DEFAULT NULL,
  `task_2` int DEFAULT NULL,
  `task_3` int DEFAULT NULL,
  `task_4` int DEFAULT NULL,
  `task_5` int DEFAULT NULL,
  `task_6` int DEFAULT NULL,
  `task_7` int DEFAULT NULL,
  `task_8` int DEFAULT NULL,
  `task_9` int DEFAULT NULL,
  `task_10` int DEFAULT NULL,
  `task_11` int DEFAULT NULL,
  `task_12` int DEFAULT NULL,
  `task_13` int DEFAULT NULL,
  `task_14` int DEFAULT NULL,
  `task_15` int DEFAULT NULL,
  `task_16` int DEFAULT NULL,
  `task_17` int DEFAULT NULL,
  `task_18` int DEFAULT NULL,
  `task_19` int DEFAULT NULL,
  `task_20` int DEFAULT NULL,
  `task_21` int DEFAULT NULL,
  `task_22` int DEFAULT NULL,
  `task_23` int DEFAULT NULL,
  `task_24` int DEFAULT NULL,
  `task_25` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `oge_math`
--

INSERT INTO `oge_math` (`id`, `student_id`, `student_name`, `subject`, `total_tasks`, `task_1`, `task_2`, `task_3`, `task_4`, `task_5`, `task_6`, `task_7`, `task_8`, `task_9`, `task_10`, `task_11`, `task_12`, `task_13`, `task_14`, `task_15`, `task_16`, `task_17`, `task_18`, `task_19`, `task_20`, `task_21`, `task_22`, `task_23`, `task_24`, `task_25`) VALUES
(4, 12, 'Гоша Гоша', 'Математика ОГЭ', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 13, 'Ященко Ященко', 'Математика ОГЭ', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 14, 'Наби Наби', 'Математика ОГЭ', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 26, 'Добавляем Прогресс', 'Математика ОГЭ', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `oge_physics`
--

CREATE TABLE `oge_physics` (
  `id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `subject` varchar(50) DEFAULT 'Физика ОГЭ',
  `total_tasks` int DEFAULT '22',
  `task_1` int DEFAULT NULL,
  `task_2` int DEFAULT NULL,
  `task_3` int DEFAULT NULL,
  `task_4` int DEFAULT NULL,
  `task_5` int DEFAULT NULL,
  `task_6` int DEFAULT NULL,
  `task_7` int DEFAULT NULL,
  `task_8` int DEFAULT NULL,
  `task_9` int DEFAULT NULL,
  `task_10` int DEFAULT NULL,
  `task_11` int DEFAULT NULL,
  `task_12` int DEFAULT NULL,
  `task_13` int DEFAULT NULL,
  `task_14` int DEFAULT NULL,
  `task_15` int DEFAULT NULL,
  `task_16` int DEFAULT NULL,
  `task_17` int DEFAULT NULL,
  `task_18` int DEFAULT NULL,
  `task_19` int DEFAULT NULL,
  `task_20` int DEFAULT NULL,
  `task_21` int DEFAULT NULL,
  `task_22` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `oge_physics`
--

INSERT INTO `oge_physics` (`id`, `student_id`, `student_name`, `subject`, `total_tasks`, `task_1`, `task_2`, `task_3`, `task_4`, `task_5`, `task_6`, `task_7`, `task_8`, `task_9`, `task_10`, `task_11`, `task_12`, `task_13`, `task_14`, `task_15`, `task_16`, `task_17`, `task_18`, `task_19`, `task_20`, `task_21`, `task_22`) VALUES
(4, 9, 'Петров Петр', 'Физика ОГЭ', 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 10, 'Александр Александр', 'Физика ОГЭ', 22, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 11, 'Вова Вова', 'Физика ОГЭ', 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `submission_files`
--

CREATE TABLE `submission_files` (
  `id` int NOT NULL,
  `submission_id` int DEFAULT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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
(55, 17, 'uploads/checked/1774762932_photo_2026-03-29 09.08.14.jpeg', 'checked', '2026-03-29 05:42:12'),
(56, 18, 'uploads/solutions/69ce04af1b86c_Снимок экрана 2026-03-09 в 14.15.09.png', 'solution', '2026-04-02 05:54:55'),
(57, 18, 'uploads/solutions/69ce04af1c033_Снимок экрана 2026-03-12 в 10.51.17.png', 'solution', '2026-04-02 05:54:55'),
(58, 19, 'uploads/solutions/69ce0522e2fac_Снимок экрана 2026-02-27 в 19.38.10.png', 'solution', '2026-04-02 05:56:50'),
(59, 19, 'uploads/solutions/69ce0522e3637_Снимок экрана 2026-03-02 в 12.50.15.png', 'solution', '2026-04-02 05:56:50'),
(60, 20, 'uploads/solutions/69ce0dcda5299_Снимок экрана 2026-03-02 в 14.17.40.png', 'solution', '2026-04-02 06:33:49'),
(61, 21, 'uploads/solutions/69ce0dd1066c2_Снимок экрана 2026-03-02 в 15.37.43.png', 'solution', '2026-04-02 06:33:53'),
(62, 22, 'uploads/solutions/69ce0dd3ec2da_Снимок экрана 2026-03-09 в 14.06.36.png', 'solution', '2026-04-02 06:33:55'),
(63, 23, 'uploads/solutions/69ce0dd761b10_Снимок экрана 2026-03-02 в 12.50.15.png', 'solution', '2026-04-02 06:33:59'),
(64, 24, 'uploads/solutions/69ce103549450_Снимок экрана 2026-03-02 в 15.37.43.png', 'solution', '2026-04-02 06:44:05'),
(65, 23, 'uploads/checked/1775116254_Снимок экрана 2026-03-12 в 10.51.17.png', 'checked', '2026-04-02 07:50:54'),
(66, 25, 'uploads/solutions/69ce3a071e5bb_Снимок экрана 2026-03-09 в 14.15.09.png', 'solution', '2026-04-02 09:42:31'),
(67, 25, 'uploads/checked/1775195650_Домашнее задание 1-2.pdf', 'checked', '2026-04-03 05:54:10'),
(68, 26, 'uploads/solutions/69cf56bfc22c1_Снимок экрана 2026-03-09 в 14.06.36.png', 'solution', '2026-04-03 05:57:19'),
(69, 26, '../uploads/checked/1775196696_Group 91.png', 'checked', '2026-04-03 06:11:36'),
(70, 27, 'uploads/solutions/69cf5a241926a_Снимок экрана 2026-03-09 в 14.06.36.png', 'solution', '2026-04-03 06:11:48'),
(71, 27, '../uploads/checked/1775196780_Снимок экрана 2026-03-12 в 10.51.17.png', 'checked', '2026-04-03 06:13:00'),
(72, 28, 'uploads/solutions/69cf72becd0b0_photo_2026-03-29 09.08.14.jpeg', 'solution', '2026-04-03 07:56:46'),
(73, 28, 'uploads/solutions/69cf72becd6a9_photo_2026-03-29 09.08.27.jpeg', 'solution', '2026-04-03 07:56:46'),
(74, 29, 'uploads/solutions/69cf74c0cfae8_photo_2026-03-29 09.08.27.jpeg', 'solution', '2026-04-03 08:05:20'),
(75, 30, 'uploads/solutions/69cf7520a369a_photo_2026-03-29 09.08.27.jpeg', 'solution', '2026-04-03 08:06:56'),
(76, 31, 'uploads/solutions/69cf75b87d95a_photo_2026-03-29 09.08.14.jpeg', 'solution', '2026-04-03 08:09:28'),
(77, 32, 'uploads/solutions/69cf775974b73_photo_2026-03-29 09.08.14.jpeg', 'solution', '2026-04-03 08:16:25'),
(78, 32, 'uploads/checked/69cf776ad4ac1_Снимок экрана 2026-03-12 в 10.51.17.png', 'checked', '2026-04-03 08:16:42'),
(79, 33, 'uploads/solutions/69cf779a92911_photo_2026-03-29 09.08.14.jpeg', 'solution', '2026-04-03 08:17:30'),
(80, 33, 'uploads/solutions/69cf779a92f52_photo_2026-03-29 09.08.27.jpeg', 'solution', '2026-04-03 08:17:30'),
(81, 33, 'uploads/checked/69cf77aaa5196_photo_2026-03-29 09.08.17.jpeg', 'checked', '2026-04-03 08:17:46'),
(82, 33, 'uploads/checked/69cf77aaa55c6_photo_2026-03-29 09.08.30.jpeg', 'checked', '2026-04-03 08:17:46'),
(83, 36, 'uploads/solutions/69d0acd4dd6ba_69cf776ad4ac1_Снимок экрана 2026-03-12 в 10.51.17.png', 'solution', '2026-04-04 06:16:52'),
(84, 36, 'uploads/checked/69d0ad038b171_Снимок экрана 2026-03-24 в 15.07.28.png', 'checked', '2026-04-04 06:17:39'),
(85, 37, 'uploads/solutions/69d0ad4a24e7b_Group 91.png', 'solution', '2026-04-04 06:18:50'),
(86, 37, 'uploads/checked/69d0ad5c7bd2d_Снимок экрана 2026-03-02 в 15.37.43.png', 'checked', '2026-04-04 06:19:08');

-- --------------------------------------------------------

--
-- Структура таблицы `test_results`
--

CREATE TABLE `test_results` (
  `id` int NOT NULL,
  `student_lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `student_firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `january` int DEFAULT NULL,
  `february` int DEFAULT NULL,
  `march` int DEFAULT NULL,
  `april` int DEFAULT NULL,
  `may` int DEFAULT NULL,
  `september` int DEFAULT NULL,
  `october` int DEFAULT NULL,
  `november` int DEFAULT NULL,
  `december` int DEFAULT NULL,
  `lines_count` int DEFAULT '5',
  `step` int DEFAULT '10',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `test_results`
--

INSERT INTO `test_results` (`id`, `student_lastname`, `student_firstname`, `subject`, `january`, `february`, `march`, `april`, `may`, `september`, `october`, `november`, `december`, `lines_count`, `step`, `created_at`) VALUES
(1, 'Петров', 'Даниилка', 'Математика', NULL, NULL, 17, NULL, 86, 13, 20, 34, 58, 11, 10, '2026-04-03 08:41:07'),
(2, 'Петров', 'Даниилка', 'Физика', NULL, 13, 100, 64, 31, 41, NULL, NULL, NULL, 11, 10, '2026-04-03 12:38:53');

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
(10, '', '', '', '', 'Александр', 'Александр', '', '+7777', 0, 'Индивидуально', 9, 'Физика', NULL, NULL, '314159265', 5, 4, 4, 4),
(11, '', '', '', '', 'Вова', 'Вова', '', '', 0, 'Группа', 2, 'Физика', NULL, NULL, '314159265', 10, 8, 9, 4),
(12, '', '', '', '', 'Гоша', 'Гоша', '', '', 0, 'Группа', 2, 'Математика', NULL, NULL, '314159265', 0, 0, 0, 0),
(13, '', '', '', '', 'Ященко', 'Ященко', '', '', 0, 'Индивидуально', 0, 'Математика', NULL, NULL, '314159265', 0, 0, 0, 0),
(14, '', '', '', '', 'Наби', 'Наби', '', '', 0, 'Индивидуально', 0, 'Математика', NULL, NULL, '314159265', 0, 0, 0, 0),
(21, NULL, NULL, NULL, NULL, 'Петров', 'Даниилка', 'Олегович', '+7314', 10, 'Индивидуально', NULL, 'Математика', NULL, '123', '314159265', 11, 8, 20, 5),
(24, NULL, NULL, NULL, NULL, 'Петров', 'Даниилка', NULL, '+7314', 10, 'Индивидуально', NULL, 'Физика', NULL, NULL, '314159265', 0, 0, 8, 3),
(26, '', '', '', '', 'Добавляем', 'Прогресс', 'ОГЭМат', '', 9, 'Индивидуально', 0, 'Математика', NULL, NULL, '314159265', 0, 0, 0, 0),
(27, '', '', '', '', 'Добавляем', 'Прогресс', 'ЕГЭФизика', '', 10, 'Группа', 1, 'Физика', NULL, NULL, '314159265', 0, 0, 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ege_math`
--
ALTER TABLE `ege_math`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ege_physics`
--
ALTER TABLE `ege_physics`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `oge_math`
--
ALTER TABLE `oge_math`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oge_physics`
--
ALTER TABLE `oge_physics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `submission_files`
--
ALTER TABLE `submission_files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `test_results`
--
ALTER TABLE `test_results`
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
-- AUTO_INCREMENT для таблицы `ege_math`
--
ALTER TABLE `ege_math`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `ege_physics`
--
ALTER TABLE `ege_physics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `homework_submissions`
--
ALTER TABLE `homework_submissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `oge_math`
--
ALTER TABLE `oge_math`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `oge_physics`
--
ALTER TABLE `oge_physics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `submission_files`
--
ALTER TABLE `submission_files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT для таблицы `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
