-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3305
-- Время создания: Июл 25 2018 г., 12:25
-- Версия сервера: 5.6.34
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `parking`
--

-- --------------------------------------------------------

--
-- Структура таблицы `autos`
--

CREATE TABLE `autos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_client` int(10) UNSIGNED NOT NULL,
  `mark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `autos`
--

INSERT INTO `autos` (`id`, `id_client`, `mark`, `model`, `color`, `number`, `flag`) VALUES
(10, 11, 'Hyundai', 'Accent', 'Красный', 'А765РР34', 0),
(11, 12, 'Mazda', '3', 'Черный', 'Е456ВА34', 0),
(12, 13, 'Lada', 'Granta', 'Серебристый', 'Т445РО34', 0),
(15, 10, 'Renault', 'Kaptur', 'Белый', 'M256КО34', 0),
(17, 15, 'Nissan', 'Fuga', 'Чёрный', 'K496КО34', 1),
(18, 16, 'Skoda', 'Rapid', 'Серебристый', 'О777ОО34', 0),
(19, 17, 'Skoda', 'Octavia', 'Чёрный', 'К900КО34', 0),
(20, 18, 'Suzuki', 'Vitara', 'Голубой', 'В486КК34', 1),
(21, 18, 'Volvo', 'XC90', 'Чёрный', 'А654КЕ34', 0),
(22, 19, 'Volvo', 'S90', 'Красный', 'В677ВМ34', 0),
(23, 20, 'Mercedes-Benz', 'CLA-Класс', 'Чёрный', 'М000МА34', 0),
(24, 21, 'Infiniti', 'Q70', 'Белый', 'Е555ЕА34', 0),
(25, 14, 'Ford', 'Focus', 'Коричневый', 'А696АА34', 1),
(29, 23, 'Ford', 'Kuga', 'Чёрный', 'С227НА34', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `full_name`, `gender`, `phone`, `address`) VALUES
(10, 'Иванов И.И.', 'm', '89023592725', 'ул. Пушкина 3, кв. 41'),
(11, 'Петрова Светлана Валерьевна', 'f', '89076784567', 'ул. Александрова 4, кв.43'),
(12, 'Борисов Н.П.', 'm', '89273392374', 'пр-т Университетский 1, кв. 78'),
(13, 'Корольков А.В.', 'm', '89273456745', 'ул. Пушкина 6, кв. 89'),
(14, 'Павлова Елена Константиновна', 'f', '89055382735', 'пр-т Университетский 1, кв. 80'),
(15, 'Петров Кирилл Иванович', 'm', '89276543456', 'ул. Александрова 4, кв.43'),
(16, 'Краснова Елена Викторовна', 'f', '89096785434', 'ул. Пушкина 6, кв 90'),
(17, 'Новикова Светлана Петровна', 'f', '89023362737', 'ул. Александрова 4, кв.45'),
(18, 'Васильев П.Г.', 'm', '89053294745', 'ул. Александрова 4, кв.50'),
(19, 'Маркова Алена Игоревна', 'f', '89007676667', 'пр-т Университетский 1, кв. 90'),
(20, 'Марков Игорь Павлович', 'm', '89007766776', 'пр-т Университетский 1, кв. 90'),
(21, 'Полынин Виталий Васильевич', 'm', '89053456787', 'пр-т Университетский 1, кв. 95'),
(23, 'Петров Петр Петрович', 'm', '89011392735', 'evwe');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2018_07_19_125442_create_clients_table', 1),
(7, '2018_07_19_160714_create_autos_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `autos_number_unique` (`number`),
  ADD KEY `autos_id_client_foreign` (`id_client`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_phone_unique` (`phone`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `autos`
--
ALTER TABLE `autos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `autos`
--
ALTER TABLE `autos`
  ADD CONSTRAINT `autos_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
