-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 04:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_hours` int(11) NOT NULL,
  `no_of_lectures` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `price`, `image`, `no_of_hours`, `no_of_lectures`, `created_at`, `updated_at`) VALUES
(1, 'Course97', 'Autem dolorem unde perferendis aut eum nisi occaecati. Soluta dolorum officiis est sunt vitae. Id quia aut consequatur ducimus id.', 237, 'https://lorempixel.com/640/480/cats/?65314', 82, 45, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(2, 'Course83', 'Voluptatem quam id quidem nulla atque et. Omnis sit et voluptatem sit.', 341, 'https://lorempixel.com/640/480/cats/?22006', 3, 32, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(3, 'Course78', 'Soluta dolor amet officia explicabo commodi in soluta quo. Voluptas id autem voluptate quas dolorem rerum. Illum facere ea quis omnis commodi.', 184, 'https://lorempixel.com/640/480/cats/?91638', 13, 80, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(4, 'Course92', 'Qui suscipit tempora quae labore atque asperiores et qui. Aut ut placeat totam saepe qui earum. Nihil voluptas saepe nesciunt qui sint.', 515, 'https://lorempixel.com/640/480/cats/?72449', 72, 91, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(5, 'Course91', 'Et nobis qui recusandae eos autem. Non non expedita sint non corporis. Nihil vitae nemo deleniti ut ducimus. Eligendi quae vitae corrupti illo.', 216, 'https://lorempixel.com/640/480/cats/?10884', 49, 83, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(6, 'Course70', 'Cumque enim sint quisquam sunt quisquam in. Tempore dolor vitae atque beatae. Omnis similique quam et et numquam beatae fugiat. Unde repellendus dolorum consequatur asperiores eos.', 224, 'https://lorempixel.com/640/480/cats/?16175', 2, 12, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(7, 'Course66', 'Esse omnis ut non voluptas consectetur et vel nam. Assumenda ut animi sapiente et eligendi. Minima et nihil eos. Sit necessitatibus consectetur harum.', 670, 'https://lorempixel.com/640/480/cats/?23977', 81, 20, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(8, 'Course96', 'Non veniam accusamus sit incidunt sint explicabo. Accusamus quis dolor impedit a consequatur pariatur. Ut et facilis unde eos asperiores.', 579, 'https://lorempixel.com/640/480/cats/?56216', 65, 88, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(9, 'Course83', 'Perferendis quibusdam qui accusamus qui natus. Fugit dolores tempora in rem corrupti. Iste voluptates molestiae laudantium quasi iste excepturi. Eveniet nostrum laudantium est et at.', 463, 'https://lorempixel.com/640/480/cats/?74108', 32, 76, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(10, 'Course99', 'Recusandae aut sint vel aut. Dolor et et ut consequatur nesciunt. Dignissimos eum in consectetur ea.', 860, 'https://lorempixel.com/640/480/cats/?62096', 10, 79, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(11, 'Course13', 'Quae deleniti atque repudiandae quia. Sed consectetur eius natus aut dolore maxime.', 750, 'https://lorempixel.com/640/480/cats/?30123', 10, 55, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(13, 'coursee1', 'llooorem', 1000000, NULL, 10, 5, '2023-11-23 19:36:27', '2023-11-23 19:36:27'),
(14, 'course2', 'llooorem', 1000000, NULL, 10, 5, '2023-11-23 19:37:37', '2023-11-23 19:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `user_id`, `course_id`) VALUES
(2, 4, 1),
(5, 5, 10),
(6, 8, 1),
(7, 12, 1),
(8, 10, 2),
(9, 8, 2),
(10, 3, 3),
(11, 4, 3),
(12, 2, 4),
(13, 15, 4),
(14, 3, 4),
(15, 7, 4),
(16, 13, 5),
(17, 2, 5),
(18, 13, 6),
(19, 7, 7),
(20, 12, 8),
(21, 13, 8),
(22, 10, 9),
(23, 4, 9),
(24, 13, 9),
(25, 3, 9),
(26, 15, 10),
(27, 1, 10),
(28, 13, 10),
(29, 4, 10),
(30, 2, 10),
(31, 10, 1),
(32, 1, 2),
(33, 15, 2),
(34, 1, 3),
(35, 15, 3),
(36, 10, 3),
(37, 6, 3),
(38, 6, 4),
(39, 1, 5),
(40, 6, 5),
(41, 2, 6),
(42, 11, 6),
(43, 1, 6),
(44, 15, 6),
(45, 8, 6),
(46, 10, 7),
(47, 11, 7),
(48, 11, 8),
(49, 10, 8),
(50, 15, 9),
(51, 12, 10),
(52, 6, 10),
(56, 20, 2),
(57, 21, 13),
(58, 21, 14),
(59, 22, 13),
(60, 24, 13),
(61, 23, 14),
(62, 25, 14),
(63, 26, 14),
(64, 27, 13);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2023_11_21_101607_create_courses_table', 1),
(4, '2023_11_21_101752_ceate_enrollment_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Student55', 'Gulgowski', 'weissnat.freddy@example.org', '$2y$10$R4hoyXyQ0IfN9/tk1mJ9fe/Xy3Lx/nwGI9.uHYD/FIhcR1tnZYYEe', 'Student', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(2, 'Student2', 'Sawayn', 'elenor.carter@example.org', '$2y$10$ONQeIqcwqf3ab2ETo.M6OeWVfEYZG3FSs4By35AxZ3Qh1Sel3jKL6', 'Student', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(3, 'Student76', 'Schroeder', 'danielle12@example.org', '$2y$10$bYdqVzHs6RzTD74QSxK7m.GlUI9fMoZMfzRVFbsk72PPbOmmNcpzu', 'Student', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(4, 'Teacher3', 'Terry', 'jgreen@example.com', '$2y$10$qKqAEmOXYAzOy6laXgcTPOkSweqli9WzNlLQn1iXTHptyc6DXyAqW', 'Teacher', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(5, 'Teacher33', 'Labadie', 'hudson.elliott@example.net', '$2y$10$1.rR1trkWN45vyJUHDLOqe6OpT8a7lENor28mYYryBcNyCpWPM.Qa', 'Teacher', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(6, 'Student41', 'Schmidt', 'glynch@example.net', '$2y$10$4iqgmg2ySWaaTJvp4x/D/evR6KBbkuTjK4y3nYcUGxhiU/2.19s2.', 'Student', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(7, 'Teacher84', 'Marks', 'dfisher@example.com', '$2y$10$6zMy0EbS6asJ7R9Q7PCdeem3U/AWc8eKZi4tg7iaGRbQGaFNbHh3e', 'Teacher', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(8, 'Student64', 'O\'Reilly', 'streich.lorenzo@example.org', '$2y$10$ka9KqH0FidtL2i2h/YTZyuKAuYE52cq/pd9lNM24bqIhEPeodkLNa', 'Student', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(9, 'Teacher79', 'Heathcote', 'vallie69@example.org', '$2y$10$yjPsvIVfLFBe2wqy3xeSbu3fxNvwU1yvmb9IKkScJkLo0m8e/0RRi', 'Teacher', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(10, 'Student78', 'Wehner', 'gbruen@example.org', '$2y$10$Tw5K7yscZlsEZ.Qn4CuoXeZTV8NzdoItDTVPjmzMCDD7fkiw8Y.6e', 'Student', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(11, 'Student93', 'Kunde', 'vonrueden.joanne@example.org', '$2y$10$IrJwjIex72nJi7Pxw/aHXeDPBO23UACeMtgPengZEfvE7hYSxq4MG', 'Student', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(12, 'Student34', 'Crooks', 'wilton.schinner@example.org', '$2y$10$OHZ6L7wLCpVmuVS1pfc9BOmEWEX3h8rZlr2yCzQxhjmRspTuGrMw.', 'Student', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(13, 'Teacher82', 'Marquardt', 'mariana.willms@example.net', '$2y$10$kXuK4R8PsWrcMdcrDRoZTe3ADbKXoObnpALIbxMZH3PpwBGP/3A1S', 'Teacher', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(14, 'Teacher78', 'Runte', 'nathanael57@example.net', '$2y$10$NwtJpD/zAmsRLrUsPw77du5dpFHCieyvVq2Vs9GdYLikxMdLihiiO', 'Teacher', NULL, '2023-11-23 12:03:35', '2023-11-23 12:03:35'),
(15, 'Omar Ahmed', 'El Gazzar', 'omarahmed@gmail.com', '$2y$10$BsKn/nejK/pXbzavZfBK5e7LsEg.TLfwhtRXXCVZqZ4ujJ2KyXrey', 'Teacher', NULL, '2023-11-23 12:03:35', '2023-11-23 17:56:50'),
(19, 'omar', 'Ahmed', 'omarahmedelgazzar60@gmail.com', '$2y$10$r6xrrl2c6e1D88Cj.LuW4.XIOkFvdScfq7hW76XyVfTBtO/dxW.za', 'Student', NULL, '2023-11-23 18:16:09', '2023-11-23 18:16:09'),
(20, 'omar', 'Ahmed', 'omarahmedelgazzar6009@gmail.com', '$2y$10$g18N47.3klJiC7kQNdn2Yuz4WMXgXsH0YSNPP/Xl6DHM/RLn3iglO', 'Student', NULL, '2023-11-23 18:17:56', '2023-11-23 18:17:56'),
(21, 'Omar Ahmed', 'El Gazzar', 'omarahdmed@gmail.com', '$2y$10$9agMLdP3bWPgI5/jjDsonu/xouKU5ER6TUNfZ3atweaP555JBpjAK', 'Teacher', NULL, '2023-11-23 19:33:43', '2023-11-24 12:26:38'),
(22, 'S1', 'Ahmed', 'omaraazzar60@gmail.com', '$2y$10$hbfX878sqxqAWQgLuhT1MeBwJ/zSjiUxQ6CRm7oq5vRkSlpG9MNS2', 'Student', NULL, '2023-11-23 19:43:52', '2023-11-23 19:43:52'),
(23, 'S2', 'Ahmed', 'omasdvraazzar60@gmail.com', '$2y$10$wt42kPi5PX9DPZjjjQU8aOOqSFgE4iEXuWHyvw9c.h8GeKx0P4iLS', 'Student', NULL, '2023-11-23 19:44:16', '2023-11-23 19:44:16'),
(24, 'S3', 'Ahmed', 'omasdvraaxzzar60@gmail.com', '$2y$10$tpvL.MS1J/0l1X6tZx2.4.1gZkwcevWwWQWEy1/6LJO33RE5Mfvw.', 'Student', NULL, '2023-11-23 19:44:31', '2023-11-23 19:44:31'),
(25, 'S4', 'Ahmed', 'masdvraaxzzar60@gmail.com', '$2y$10$Kz0uPiTt3Qw8c8w6Nq7ww.qZ7hEHz7swicPFe/2EqW7QXe5ktNjD.', 'Student', NULL, '2023-11-23 19:44:47', '2023-11-23 19:44:47'),
(26, 'T1', 'Ahmed', 'sdgd@hmail', '$2y$10$YqoJqHFCFTA7iCPlNcvyneBilTUv5GkNq1VLY/QD6DcI9bENacdnG', 'Teacher', NULL, '2023-11-23 20:10:20', '2023-11-23 20:10:20'),
(27, 'T2', 'Ahmed', 'sdgd@hmailcv', '$2y$10$NQrLZMf/Y4sRVatIuYTPWuIMXWTyzfmTjN9wJzsftqeoHpApJo0zi', 'Teacher', NULL, '2023-11-23 20:10:48', '2023-11-23 20:10:48'),
(28, 'T2', 'Ahmed', 'sdgd@hmail.cv', '$2y$10$jJCC7OF4Qnnc4jfyFKdZ9ujnG/uRN9u2wccl6TMOPFw1DVj.FXi3K', 'Teacher', NULL, '2023-11-24 11:50:07', '2023-11-24 11:50:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollment_user_id_foreign` (`user_id`),
  ADD KEY `enrollment_course_id_foreign` (`course_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `enrollment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
