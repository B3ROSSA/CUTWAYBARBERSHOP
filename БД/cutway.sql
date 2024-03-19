-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 18 2024 г., 10:36
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cutway`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appointments`
--

CREATE TABLE `appointments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `barber_id` int NOT NULL,
  `service_id` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `barber_id`, `service_id`, `date`, `time`) VALUES
(1, 3, 9, 1, '2024-03-16', '10:35:00');

-- --------------------------------------------------------

--
-- Структура таблицы `barbers`
--

CREATE TABLE `barbers` (
  `id` int NOT NULL,
  `img_barber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `barbers`
--

INSERT INTO `barbers` (`id`, `img_barber`, `name`, `description`) VALUES
(9, '65ecdbaa44600.jpeg', 'Иван', 'Опытный барбер с 10 летним стажем, специализируется на классических мужских стрижках и бритье бритвой. Внимателен к деталям и всегда стремится к идеальному результату.\r\n'),
(10, '65ecdbbcc667c.jpeg', 'Алексей', 'Творческий барбер с уникальным стилем и видением моды. Владеет техникой стрижки под настроение и всегда готов предложить Вам нестандартные решения.\r\n'),
(11, '65ecdbce08709.jpeg', 'Дмитрий', 'Мастер бородатого и усатого стиля, обладает умением создавать индивидуальные образы для каждого клиента. Отличается высокой точностью и профессионализмом.\r\n'),
(12, '65ecdbe3037b1.jpeg', 'Сергей', 'Энергичный барбер с отличными коммуникативными навыками. Умеет быстро находить общий язык с клиентами и создавать уюьтную атмосферу в нашем прекрасном барбершопе.\r\n'),
(13, '65ecdc250fe32.jpeg', 'Николай', 'Специалист по модным мужским стрижкам и ухаживающим процедурам для волос и бороды. Он обладает тонким вкусом и всегда следит за последними тенденциями в мире мужской моды. Николай также является опытным консультантом пО уходу за волосами и бородой, помогая клиентам подобрать индивидуальные средства для ухода.\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `type`, `img_name`) VALUES
(11, 'interior', '65eca6f1ec38d.png'),
(12, 'interior', '65eca6f6ca7b6.png'),
(13, 'interior', '65eca6fb13f36.png'),
(14, 'haircut', '65eca711cfc48.jpeg'),
(15, 'haircut', '65eca7157cadf.jpeg'),
(16, 'haircut', '65eca7194edd1.jpeg'),
(17, 'haircut', '65eca71d6c4c5.jpeg'),
(18, 'haircut', '65eca720df784.jpeg'),
(21, 'haircut', '65eca7475ef29.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `pricelist`
--

CREATE TABLE `pricelist` (
  `id` int NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pricelist`
--

INSERT INTO `pricelist` (`id`, `service_name`, `service_cost`) VALUES
(1, 'Мужская стрижка', '1200'),
(10, 'Моделирование бороды', '1200'),
(11, 'Детская стрижка', '1000'),
(12, 'Королевское бритьё', '1500'),
(13, 'Эпиляция воском/1 зона', '700'),
(14, 'Камуфляж седых волос', '800'),
(15, 'Стрижка машинкой', '950'),
(16, 'Бритьё головы', '1200');

-- --------------------------------------------------------

--
-- Структура таблицы `stocks`
--

CREATE TABLE `stocks` (
  `id` int NOT NULL,
  `img_stock` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `stocks`
--

INSERT INTO `stocks` (`id`, `img_stock`, `title`, `body`) VALUES
(11, '65ecd204ca02b.png', 'Подарочные сертификаты', 'Бессрочные подарочные сертификаты, номинал которых можно потратить как на услуги. Сертификаты можно приобрести у менеджера в нашем барбершопе. Важно: скидки и акции не суммируются, при оплате сертификатом скидки не действуют.'),
(12, '65ecba35be543.png', 'Подарочные сертификаты', 'Бессрочные подарочные сертификаты, номинал которых можно потратить как на услуги. Сертификаты можно приобрести у менеджера в нашем барбершопе. Важно: скидки и акции не суммируются, при оплате сертификатом скидки не действуют.'),
(13, '65ecd2326b907.png', 'Приведи друга', 'Вместе - выгоднее! :) Приводите к нам друга, который ранее не был у нас, и получайте бесплатную стрижку. Важно: скидки и акции не суммируются, друг должен быть в филиале впервые и визиты на обе стрижки должны быть в один день.\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `surname`, `name`, `email`, `phone`, `password`, `isAdmin`) VALUES
(1, 'berya', 'Пуртов', 'Евгений', 'berossa@list.ru', '+7 (995) 846-67-92', 'e6053eb8d35e02ae40beeeacef203c1a', 1),
(2, 'test123', 'Фамилия', 'Имя', 'b3rossa@gmail.com', '+7 (111) 111-11-11', 'e6053eb8d35e02ae40beeeacef203c1a', 0),
(3, 'blenpucl', 'Ясюченя', 'Александра', 'za846871@gmail.com', '+7 (999) 999-99-99', 'e6053eb8d35e02ae40beeeacef203c1a', 0),
(4, 'NEWUSER', 'Усольцев', 'Борис', 'usolcev.04@mail.ru', '+7 (999) 999-99-99', 'e6053eb8d35e02ae40beeeacef203c1a', 0),
(5, 'admin', 'Администратор', '', 'admin@mail.ru', '+7 (000) 000-00-00', 'e020590f0e18cd6053d7ae0e0a507609', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `barber_id` (`barber_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Индексы таблицы `barbers`
--
ALTER TABLE `barbers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pricelist`
--
ALTER TABLE `pricelist`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `barbers`
--
ALTER TABLE `barbers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `pricelist`
--
ALTER TABLE `pricelist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`barber_id`) REFERENCES `barbers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `pricelist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
