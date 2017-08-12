-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 12 2017 г., 02:43
-- Версия сервера: 10.1.21-MariaDB
-- Версия PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tasker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `tid` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_bin NOT NULL,
  `e-mail` varchar(128) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `image` varchar(128) COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`tid`, `username`, `e-mail`, `text`, `image`, `status`) VALUES
(8, 'asdf', 'asdf@asdf', 'asdf', '598df0102a8b6.jpeg', 0),
(9, 'asdf', 'asf@asdf', 'asdf', '598df0511eadf.jpeg', 0),
(10, 'adsf', 'asdf@adsf', 'asdf', '598df103b1516.jpeg', 0),
(11, 'flash', 'flash@sad.very', 'so many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to sayso many words to say', '598dfbc7d3da3.jpeg', 1),
(12, 'hello', 'my_name_is@name.com', 'very insteresting name', '598e19ea5f54d.jpeg', 0),
(13, 'he', 'lovew@w.com', 'shellcode to bind listen socket', '598e1b6aaf373.jpeg', 0),
(14, 'admin', 'admin@localhost.com', '&lt;script&gt;alert();&lt;/script&gt; &lt;!--this was added --&gt; hehe', '598e3d24a4488.jpeg', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_bin NOT NULL,
  `password` char(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`uid`, `username`, `password`) VALUES
(1, 'admin', '5512345cf798b4b378a3101206dbd8ac8cf37f44ecf71aecc1ac70bec526634b');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`tid`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
