-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 02 2021 г., 13:39
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `larav_cleansed_vue_blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_02_16_195421_create_wpressImage_category_table', 1),
(4, '2021_02_16_195648_create_wpressImages_blog_post_table', 1),
(5, '2021_02_16_200932_create_wpressImage_imagesStocks_table', 1),
(6, '2021_05_03_172055_entrust_setup_tables', 1),
(7, '2021_06_04_131446_create_api_clients_table', 1),
(8, '2021_06_04_133656_add_apikey_columns_to_users_table', 1);

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
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(12, 'owner', 'Project Owner', 'User is the owner of a given project', '2021-08-02 10:37:18', NULL),
(13, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', '2021-08-02 10:37:18', NULL),
(14, 'manager', 'Company Manager', 'User is a manager of a Department', '2021-08-02 10:37:18', NULL),
(15, 'commander', 'custom role', 'Wing Commander', '2021-08-02 10:37:18', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(2, 13);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `api_token`) VALUES
(1, 'Admin', 'admin@ukr.net', '$2y$10$1Tlv/jpirsyxSwf0AUGM6.jATVYBr.OrU/bRy7tkVS0l1TZUNKoSm', NULL, NULL, NULL, NULL),
(2, 'Dima', 'dimmm931@gmail.com', '$2y$10$kssk7h75S9AnN1Gu6gwkOegQUTGdyBNGapQN9gRTfouoqH5HLU1yK', NULL, NULL, '2021-08-02 10:37:41', 'f0ca38b9c8ecefb8c452c0072c60cbb7190e572f7ab3a70273e6141af795c249'),
(3, 'Olya', 'olya@gmail.com', '$2y$10$F0uouSjI5tA2NCJqUwjJ7eH3OtLRbQOrZyHu/5S1lSLJRXLubJ6Lm', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `wpressimages_blog_post`
--

CREATE TABLE `wpressimages_blog_post` (
  `wpBlog_id` int(10) UNSIGNED NOT NULL,
  `wpBlog_title` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wpBlog_text` text COLLATE utf8mb4_unicode_ci,
  `wpBlog_author` int(11) DEFAULT NULL,
  `wpBlog_created_at` timestamp NULL DEFAULT NULL,
  `wpBlog_category` int(10) UNSIGNED DEFAULT NULL COMMENT 'Category',
  `wpBlog_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpressimages_blog_post`
--

INSERT INTO `wpressimages_blog_post` (`wpBlog_id`, `wpBlog_title`, `wpBlog_text`, `wpBlog_author`, `wpBlog_created_at`, `wpBlog_category`, `wpBlog_status`) VALUES
(1, 'Sven Baumbach', 'I get it home?\' when it grunted again, and went by without noticing her. Then followed the Knave of Hearts, and I don\'t remember where.\' \'Well, it must be on the back. At last the Caterpillar called.', 1, NULL, 2, '1'),
(2, 'Laurence Romaguera I', 'Alice. \'You did,\' said the King. \'Then it doesn\'t matter much,\' thought Alice, and sighing. \'It IS the fun?\' said Alice. \'I\'ve so often read in the way I ought to have no notion how delightful it.', 1, NULL, 4, '1'),
(3, 'Royal Kihn', 'The Caterpillar was the first position in which case it would not stoop? Soup of the evening, beautiful Soup! Soup of the officers: but the wise little Alice and all dripping wet, cross, and.', 1, NULL, 2, '1'),
(4, 'Victor Miller', 'YOUR opinion,\' said Alice. \'Call it what you would seem to see a little timidly: \'but it\'s no use in talking to herself, \'Why, they\'re only a pack of cards!\' At this the whole window!\' \'Sure, it.', 1, NULL, 1, '1'),
(5, 'Aniyah Koch', 'And he added looking angrily at the time when I get SOMEWHERE,\' Alice added as an explanation; \'I\'ve none of them can explain it,\' said Alice. \'Well, then,\' the Cat remarked. \'Don\'t be impertinent,\'.', 1, NULL, 2, '1'),
(6, 'Mrs. Ova White DDS', 'Hatter were having tea at it: a Dormouse was sitting on the OUTSIDE.\' He unfolded the paper as he shook both his shoes off. \'Give your evidence,\' the King said to the beginning again?\' Alice.', 1, NULL, 3, '1'),
(7, 'Deven Ferry', 'Gryphon, before Alice could not remember ever having heard of uglifying!\' it exclaimed. \'You know what a Gryphon is, look at it!\' This speech caused a remarkable sensation among the bright.', 1, NULL, 4, '1'),
(8, 'Casimir Huels', 'Why, I haven\'t been invited yet.\' \'You\'ll see me there,\' said the Caterpillar. Alice thought decidedly uncivil. \'But perhaps he can\'t help it,\' she said this, she came upon a heap of sticks and dry.', 1, NULL, 4, '1'),
(9, 'Elaina Hudson', 'VERY deeply with a large rabbit-hole under the table: she opened it, and yet it was good manners for her neck kept getting entangled among the trees, a little sharp bark just over her head.', 1, NULL, 3, '1'),
(10, 'Mrs. Ashlynn Wiegand PhD', 'I\'m never sure what I\'m going to turn round on its axis--\' \'Talking of axes,\' said the Queen. An invitation from the trees as well she might, what a delightful thing a bit!\' said the March Hare: she.', 1, NULL, 1, '1'),
(11, 'Al Bauch', 'I said \"What for?\"\' \'She boxed the Queen\'s ears--\' the Rabbit came up to her daughter \'Ah, my dear! I shall be a comfort, one way--never to be nothing but the Rabbit came up to the executioner.', 1, NULL, 1, '1'),
(12, 'Angelita Nikolaus', 'Dormouse, and repeated her question. \'Why did you do lessons?\' said Alice, in a melancholy way, being quite unable to move. She soon got it out to the little passage: and THEN--she found herself at.', 1, NULL, 3, '1'),
(13, 'Kale Bartell', 'I BEG your pardon!\' she exclaimed in a very curious thing, and longed to change the subject of conversation. \'Are you--are you fond--of--of dogs?\' The Mouse did not come the same thing a bit!\' said.', 1, NULL, 5, '1'),
(14, 'Emory Gibson', 'I might venture to go nearer till she had found her head down to the dance. Would not, could not make out that it might injure the brain; But, now that I\'m perfectly sure I have none, Why, I.', 1, NULL, 1, '1'),
(15, 'Elvie Quitzon DVM', 'Gryphon; and then all the rest, Between yourself and me.\' \'That\'s the reason is--\' here the conversation a little. \'\'Tis so,\' said the Knave, \'I didn\'t know that cats COULD grin.\' \'They all can,\'.', 1, NULL, 3, '1'),
(16, 'Neal Fadel', 'Alice was a little pattering of footsteps in the last time she found to be Number One,\' said Alice. \'Come, let\'s hear some of the guinea-pigs cheered, and was beating her violently with its head, it.', 1, NULL, 2, '1'),
(17, 'Enrico Larkin', 'YOU, and no one to listen to her, \'if we had the best of educations--in fact, we went to work throwing everything within her reach at the cook had disappeared. \'Never mind!\' said the Cat. \'Do you.', 1, NULL, 5, '1'),
(18, 'Katlynn Hyatt', 'Alice; \'it\'s laid for a minute, trying to box her own children. \'How should I know?\' said Alice, very earnestly. \'I\'ve had nothing yet,\' Alice replied thoughtfully. \'They have their tails in their.', 1, NULL, 2, '1'),
(19, 'Prof. Etha Boehm', 'Lory positively refused to tell him. \'A nice muddle their slates\'ll be in before the trial\'s begun.\' \'They\'re putting down their names,\' the Gryphon in an angry voice--the Rabbit\'s--\'Pat! Pat! Where.', 1, NULL, 3, '1'),
(20, 'Dr. Trenton Bashirian', 'Queen, and in another moment that it ought to have the experiment tried. \'Very true,\' said the Caterpillar, just as she said to herself, in a sort of way, \'Do cats eat bats, I wonder?\' As she said.', 1, NULL, 1, '1'),
(21, 'Test text', 'Test', 2, '2021-08-02 10:38:41', 2, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `wpressimage_category`
--

CREATE TABLE `wpressimage_category` (
  `wpCategory_id` int(10) UNSIGNED NOT NULL,
  `wpCategory_name` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpressimage_category`
--

INSERT INTO `wpressimage_category` (`wpCategory_id`, `wpCategory_name`, `created_at`, `updated_at`) VALUES
(1, 'News', NULL, NULL),
(2, 'Art', NULL, NULL),
(3, 'Sport', NULL, NULL),
(4, 'Geeks', NULL, NULL),
(5, 'Drops', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `wpressimage_imagesstock`
--

CREATE TABLE `wpressimage_imagesstock` (
  `wpImStock_id` int(10) UNSIGNED NOT NULL,
  `wpImStock_name` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wpImStock_postID` int(10) UNSIGNED DEFAULT NULL COMMENT 'Author ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpressimage_imagesstock`
--

INSERT INTO `wpressimage_imagesstock` (`wpImStock_id`, `wpImStock_name`, `wpImStock_postID`, `created_at`, `updated_at`) VALUES
(1, 'product1.png', 1, NULL, NULL),
(2, 'product2.png', 2, NULL, NULL),
(3, 'product3.png', 3, NULL, NULL),
(4, 'product4.png', 4, NULL, NULL),
(5, 'product5.png', 5, NULL, NULL),
(6, 'product6.png', 6, NULL, NULL),
(7, 'product7.jpg', 7, NULL, NULL),
(8, 'product8.jpg', 8, NULL, NULL),
(9, 'product9.jpg', 9, NULL, NULL),
(10, 'product10.jpg', 10, NULL, NULL),
(11, '1627900721_2254.png', 21, '2021-08-02 10:38:41', '2021-08-02 10:38:41'),
(12, '1627900721_bmw_logo_PNG19709.png', 21, '2021-08-02 10:38:41', '2021-08-02 10:38:41');

--
-- Индексы сохранённых таблиц
--

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
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Индексы таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Индексы таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- Индексы таблицы `wpressimages_blog_post`
--
ALTER TABLE `wpressimages_blog_post`
  ADD PRIMARY KEY (`wpBlog_id`),
  ADD KEY `wpressimages_blog_post_wpblog_category_foreign` (`wpBlog_category`);

--
-- Индексы таблицы `wpressimage_category`
--
ALTER TABLE `wpressimage_category`
  ADD PRIMARY KEY (`wpCategory_id`);

--
-- Индексы таблицы `wpressimage_imagesstock`
--
ALTER TABLE `wpressimage_imagesstock`
  ADD PRIMARY KEY (`wpImStock_id`),
  ADD KEY `wpressimage_imagesstock_wpimstock_postid_foreign` (`wpImStock_postID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `wpressimages_blog_post`
--
ALTER TABLE `wpressimages_blog_post`
  MODIFY `wpBlog_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `wpressimage_category`
--
ALTER TABLE `wpressimage_category`
  MODIFY `wpCategory_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `wpressimage_imagesstock`
--
ALTER TABLE `wpressimage_imagesstock`
  MODIFY `wpImStock_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `wpressimages_blog_post`
--
ALTER TABLE `wpressimages_blog_post`
  ADD CONSTRAINT `wpressimages_blog_post_wpblog_category_foreign` FOREIGN KEY (`wpBlog_category`) REFERENCES `wpressimage_category` (`wpCategory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `wpressimage_imagesstock`
--
ALTER TABLE `wpressimage_imagesstock`
  ADD CONSTRAINT `wpressimage_imagesstock_wpimstock_postid_foreign` FOREIGN KEY (`wpImStock_postID`) REFERENCES `wpressimages_blog_post` (`wpBlog_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
