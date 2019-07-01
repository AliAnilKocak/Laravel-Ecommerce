-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 Haz 2019, 16:24:08
-- Sunucu sürümü: 10.1.37-MariaDB
-- PHP Sürümü: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `laravel_ecommerce`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Elektronik', 'Elektronik', NULL, '2019-05-11 12:16:36', '2019-05-11 12:16:36', NULL),
(2, 'Bilgisayar/Tablet', 'bilgisayar-tablet', 1, '2019-05-11 12:16:36', '2019-05-11 12:16:36', NULL),
(3, 'Foto/Kamera', 'foto-kamera', 1, '2019-05-11 12:16:36', '2019-05-11 12:16:36', NULL),
(4, 'Telefon', 'telefon', 1, '2019-05-11 12:16:36', '2019-05-11 12:16:36', NULL),
(5, 'Beyaz Eşya', 'beyaz-esya', 1, '2019-05-11 12:16:36', '2019-05-11 12:16:36', NULL),
(6, 'Kitap', 'Kitap', NULL, '2019-05-11 12:16:36', '2019-05-11 12:16:36', NULL),
(7, 'Roman', 'roman', 6, '2019-05-11 12:16:36', '2019-05-11 12:16:36', NULL),
(8, 'Tarih', 'tarih', 6, '2019-05-11 12:16:37', '2019-05-11 12:16:37', NULL),
(9, 'Kişisel Gelişim', 'kisisel-gelisim', 6, '2019-05-11 12:16:37', '2019-05-11 12:16:37', NULL),
(10, 'Ders Kitabı', 'ders-kitabı', 6, '2019-05-11 12:16:37', '2019-05-11 12:16:37', NULL),
(11, 'Dergi', 'Dergi', NULL, '2019-05-11 12:16:37', '2019-05-11 12:16:37', NULL),
(12, 'Mobilya', 'Mobilya', NULL, '2019-05-11 12:16:37', '2019-05-11 12:16:37', NULL),
(13, 'Dekorasyon', 'Dekorasyon', NULL, '2019-05-11 12:16:37', '2019-05-11 12:16:37', NULL),
(14, 'Kozmetik', 'Kozmetik', NULL, '2019-05-11 12:16:37', '2019-05-11 12:16:37', NULL),
(15, 'Kişisel Bakım', 'Kişisel Bakım', NULL, '2019-05-11 12:16:37', '2019-05-11 12:16:37', NULL),
(16, 'Giyim ve Moda', 'Giyim ve Moda', NULL, '2019-05-11 12:16:37', '2019-05-11 12:16:37', NULL),
(17, 'Anne ve Çocuk', 'Anne ve Çocuk', NULL, '2019-05-11 12:16:37', '2019-05-11 12:16:37', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category_product`
--

CREATE TABLE `category_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `category_product`
--

INSERT INTO `category_product` (`id`, `category_id`, `product_id`) VALUES
(2, 1, 1),
(4, 2, 1),
(5, 1, 11),
(8, 1, 23),
(9, 1, 14),
(10, 1, 18),
(11, 1, 25);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_05_09_185038_create_category_table', 1),
(4, '2019_05_11_115537_create_product_table', 2),
(5, '2019_05_11_121843_create_category_product_table', 3),
(6, '2019_05_11_233753_create_product_detail_table', 4),
(8, '2019_05_12_190235_create_user_table', 5),
(9, '2019_05_18_232220_create_shoppingcart_table', 6),
(10, '2019_05_19_130842_create_shopping_carts_table', 7),
(11, '2019_05_19_131217_create_shoppingcartproduct_table', 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(6,3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `product`
--

INSERT INTO `product` (`id`, `name`, `slug`, `description`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fugiat optio et.', 'fugiat-optio-et', 'Reiciendis nobis occaecati minus dolorem accusamus et laboriosam tempora dignissimos laborum qui incidunt rerum enim inventore aut accusamus et ipsum itaque.', '45.000', '2019-05-12 05:23:05', '2019-05-19 21:41:53', NULL),
(2, 'Quia suscipit.', 'quia-suscipit', 'Veniam est est voluptas dolor voluptas maxime quaerat harum minima excepturi suscipit quia quos est consequatur laboriosam.', '2.330', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(3, 'Sit sed.', 'sit-sed', 'Architecto recusandae iure similique tenetur doloremque labore qui vel nesciunt et voluptates ratione.', '14.289', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(4, 'Rerum officia voluptas.', 'rerum-officia-voluptas', 'Dignissimos ex sit possimus minima reprehenderit aliquid et deleniti libero quo quidem dolores quia possimus dolores sed velit ipsum neque at sed est illo et autem possimus veritatis excepturi.', '9.795', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(5, 'Voluptatem ab sed.', 'voluptatem-ab-sed', 'Ea qui dicta accusamus dolore odio pariatur fuga fuga sequi inventore dignissimos accusamus aut aut quam accusantium incidunt quia omnis eveniet et sit soluta.', '16.059', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(6, 'Ullam ducimus recusandae.', 'ullam-ducimus-recusandae', 'Voluptatum explicabo et hic sapiente dolorem repellat tenetur non iure quis dolores saepe quae illum officia magni omnis inventore sed excepturi.', '10.659', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(7, 'Nobis aut dignissimos.', 'nobis-aut-dignissimos', 'Explicabo ea molestias ut non autem sit autem nulla fugit error et accusamus voluptatem voluptas eaque ipsam deserunt ut est reprehenderit odit consequuntur odit.', '4.939', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(8, 'Corporis commodi quisquam.', 'corporis-commodi-quisquam', 'Libero cupiditate ut hic fugiat cupiditate aut animi quam earum velit deleniti dolores.', '6.829', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(9, 'Nostrum ex.', 'nostrum-ex', 'Eaque aliquid in voluptatum et velit quia eaque qui earum voluptatem sint perferendis est vero officia optio harum dolorem.', '18.148', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(10, 'Ut quod aut.', 'ut-quod-aut', 'Officia facere earum est aut id vitae eum voluptatem architecto qui quaerat exercitationem animi perferendis tenetur quia consectetur.', '14.824', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(11, 'Facere laboriosam.', 'facere-laboriosam', 'Soluta sit reiciendis et dolorem tempore voluptas sed perspiciatis fuga odio fugiat deserunt consequuntur et quo officia explicabo similique et in sapiente ut excepturi dolor ex eum modi.', '4.171', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(12, 'Non nesciunt officia.', 'non-nesciunt-officia', 'Et voluptatem quisquam voluptatem est expedita quo blanditiis veritatis ut ducimus praesentium exercitationem reprehenderit ut et sit.', '7.281', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(13, 'Reprehenderit nam vel.', 'reprehenderit-nam-vel', 'Id aut asperiores earum ea non quam alias officiis et architecto id earum et voluptatem perferendis labore quo corporis et officia sit.', '15.633', '2019-05-12 05:23:05', '2019-05-12 05:23:05', NULL),
(14, 'At accusantium in.', 'at-accusantium-in', 'Possimus ipsa qui ab temporibus voluptates et soluta enim eum quia dolore sequi dolorem qui odio incidunt doloribus dolorem quod molestiae quae doloribus ut itaque.', '8.826', '2019-05-12 05:23:06', '2019-05-12 05:23:06', NULL),
(15, 'Facere ullam.', 'facere-ullam', 'Ea sunt et id nesciunt quo unde saepe corrupti cumque dolores fuga voluptatem eaque et reprehenderit dicta qui quasi dolore reiciendis neque.', '10.338', '2019-05-12 05:23:06', '2019-05-12 05:23:06', NULL),
(16, 'Incidunt eos.', 'incidunt-eos', 'Sit saepe nulla aperiam ab velit perspiciatis ullam ullam aut perspiciatis quo facilis eos voluptas hic dolor enim et eum qui.', '11.074', '2019-05-12 05:23:06', '2019-05-12 05:23:06', NULL),
(17, 'Tenetur non suscipit.', 'tenetur-non-suscipit', 'Omnis reprehenderit laboriosam repudiandae rerum veniam sit perferendis non explicabo et delectus est quaerat.', '5.259', '2019-05-12 05:23:06', '2019-05-12 05:23:06', NULL),
(18, 'Vitae atque.', 'vitae-atque', 'Vel sapiente magni omnis labore iure recusandae odio rerum quod velit dolor error nihil omnis ut non accusamus eligendi impedit earum aspernatur aut culpa minus aperiam.', '15.566', '2019-05-12 05:23:06', '2019-05-12 05:23:06', NULL),
(19, 'Ipsum ut amet.', 'ipsum-ut-amet', 'Labore est aut et voluptatibus qui aut quia eos minima vel vel dicta corporis nulla iure ea delectus velit officia exercitationem.', '3.772', '2019-05-12 05:23:06', '2019-05-12 05:23:06', NULL),
(20, 'Quaerat incidunt.', 'quaerat-incidunt', 'Voluptatum earum dolores minima consequuntur cupiditate perferendis dolor dolorem sit temporibus maxime aut veniam consequatur alias quos.', '4.929', '2019-05-12 05:23:06', '2019-05-12 05:23:06', NULL),
(21, 'Ullam veritatis.', 'ullam-veritatis', 'Rem enim rem consequatur corrupti unde ratione dolorum necessitatibus amet ut rerum adipisci quae ullam.', '4.215', '2019-05-12 05:23:06', '2019-05-12 05:23:06', NULL),
(22, 'Delectus non.', 'delectus-non', 'Itaque suscipit in quod aspernatur et incidunt est itaque est eum qui adipisci saepe vel et architecto ut aut.', '7.770', '2019-05-12 05:23:06', '2019-05-12 05:23:06', NULL),
(23, 'Omnis nostrum.', 'omnis-nostrum', 'Quae at culpa possimus mollitia est beatae aut aliquam laborum vel eligendi temporibus natus.', '13.100', '2019-05-12 05:23:07', '2019-05-12 05:23:07', NULL),
(24, 'Velit voluptatem.', 'velit-voluptatem', 'Facere vero non maiores rerum nam voluptatum mollitia non deleniti quis unde sit molestias ratione.', '1.230', '2019-05-12 05:23:07', '2019-05-12 05:23:07', NULL),
(25, 'Eos in.', 'eos-in', 'Provident sequi perferendis iusto ullam eius vitae cum aspernatur fuga laborum aut qui ut voluptas itaque sint autem in praesentium ut natus voluptates ratione.', '13.719', '2019-05-12 05:23:07', '2019-05-12 05:23:07', NULL),
(26, 'Possimus ducimus.', 'possimus-ducimus', 'Et qui deserunt illum omnis quis dolor repellendus animi atque eum beatae pariatur minus praesentium aut cum dolores ut rerum deserunt ut libero earum incidunt expedita officiis ut.', '5.308', '2019-05-12 05:23:07', '2019-05-12 05:23:07', NULL),
(27, 'Rerum ut.', 'rerum-ut', 'Dolorem et maxime qui dolorem ab voluptas minima facere distinctio incidunt labore nemo porro sunt nostrum voluptatibus sed ut facilis laborum sapiente fuga.', '18.303', '2019-05-12 05:23:07', '2019-05-12 05:23:07', NULL),
(28, 'Quos quo.', 'quos-quo', 'Ad id cupiditate dolorem et in placeat a cupiditate non ea quisquam voluptas iusto ducimus dolorum autem enim cupiditate et nam fuga necessitatibus incidunt veniam nesciunt.', '1.467', '2019-05-12 05:23:07', '2019-05-12 05:23:07', NULL),
(29, 'Vel est.', 'vel-est', 'Natus quos voluptatem rerum ratione pariatur numquam autem beatae officiis quia quo qui et architecto nobis.', '12.947', '2019-05-12 05:23:07', '2019-05-12 05:23:07', NULL),
(30, 'Voluptatem et.', 'voluptatem-et', 'Eligendi quia iure perferendis nisi sunt asperiores distinctio eos aliquam optio possimus inventore exercitationem sunt labore ipsam asperiores rerum maxime unde saepe quia suscipit et perspiciatis explicabo.', '1.682', '2019-05-12 05:23:07', '2019-05-12 05:23:07', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_detail`
--

CREATE TABLE `product_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `show_slider` tinyint(1) NOT NULL DEFAULT '0',
  `show_day_opportunity` tinyint(1) NOT NULL DEFAULT '0',
  `show_featured` tinyint(1) NOT NULL DEFAULT '0',
  `show_bestselling` tinyint(1) NOT NULL DEFAULT '0',
  `show_reduced` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `product_detail`
--

INSERT INTO `product_detail` (`id`, `product_id`, `show_slider`, `show_day_opportunity`, `show_featured`, `show_bestselling`, `show_reduced`) VALUES
(1, 1, 1, 0, 0, 1, 0),
(2, 2, 0, 0, 1, 0, 0),
(3, 3, 1, 1, 1, 1, 1),
(4, 4, 0, 0, 1, 0, 0),
(5, 5, 0, 0, 1, 1, 0),
(6, 6, 0, 0, 0, 1, 0),
(7, 7, 1, 1, 0, 0, 0),
(8, 8, 0, 0, 1, 1, 1),
(9, 9, 0, 1, 0, 0, 1),
(10, 10, 1, 1, 0, 1, 1),
(11, 11, 1, 1, 0, 0, 1),
(12, 12, 1, 0, 1, 1, 1),
(13, 13, 1, 1, 0, 1, 1),
(14, 14, 1, 1, 1, 1, 1),
(15, 15, 0, 0, 1, 0, 1),
(16, 16, 1, 1, 1, 0, 1),
(17, 17, 1, 1, 0, 0, 0),
(18, 18, 1, 1, 1, 0, 0),
(19, 19, 0, 1, 1, 1, 1),
(20, 20, 1, 1, 1, 0, 0),
(21, 21, 0, 0, 1, 0, 0),
(22, 22, 1, 1, 0, 0, 0),
(23, 23, 1, 1, 0, 1, 0),
(24, 24, 1, 1, 1, 0, 0),
(25, 25, 0, 0, 1, 1, 0),
(26, 26, 0, 0, 0, 0, 1),
(27, 27, 1, 0, 1, 0, 0),
(28, 28, 0, 0, 0, 0, 0),
(29, 29, 1, 1, 1, 0, 0),
(30, 30, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `shoppingcart_product`
--

CREATE TABLE `shoppingcart_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `shoppingcart_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `shopping_carts`
--

CREATE TABLE `shopping_carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_key` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `full_name`, `email`, `password`, `activation_key`, `is_active`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ali Anıl Koçak', 'alianilkocak@gmail.com', '$2y$10$o.1iZmMi.EbGQPwqCaX5rOZ0Vk2XpoO1Vo2sIer9vs7CyExScWxw.', 'tHDGUhA51mxK9amCwab9BWWEVI3FnuLJSl3b2XvnA9GxGtwZhDZwvgT0hcbM', 0, 'AB7IpVuFhK0TcNG6aKcW0E0Cx3XWg86Olf2FAs2ZbJaV2vofmpghWzZ83LH9', '2019-05-18 09:44:42', '2019-05-18 14:06:58', NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_product_category_id_foreign` (`category_id`),
  ADD KEY `category_product_product_id_foreign` (`product_id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_detail_product_id_unique` (`product_id`);

--
-- Tablo için indeksler `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shoppingcart_user_id_foreign` (`user_id`);

--
-- Tablo için indeksler `shoppingcart_product`
--
ALTER TABLE `shoppingcart_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shoppingcart_product_shoppingcart_id_foreign` (`shoppingcart_id`),
  ADD KEY `shoppingcart_product_product_id_foreign` (`product_id`);

--
-- Tablo için indeksler `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `shoppingcart_product`
--
ALTER TABLE `shoppingcart_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `shopping_carts`
--
ALTER TABLE `shopping_carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `product_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `shoppingcart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `shoppingcart_product`
--
ALTER TABLE `shoppingcart_product`
  ADD CONSTRAINT `shoppingcart_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shoppingcart_product_shoppingcart_id_foreign` FOREIGN KEY (`shoppingcart_id`) REFERENCES `shoppingcart` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
