-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 25 sep. 2025 à 22:21
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cofat`
--

-- --------------------------------------------------------

--
-- Structure de la table `application_settings`
--

CREATE TABLE `application_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_applications_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `internship_applications_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `application_settings`
--

INSERT INTO `application_settings` (`id`, `job_applications_enabled`, `internship_applications_enabled`, `created_at`, `updated_at`) VALUES
(1, 0, 0, '2025-06-24 10:47:03', '2025-06-24 10:47:03');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(2, 'raslen kalboussi', 'rkalboussi15@gmail.com', 'kkkkkkkkkkkkkkkkkkkkkkkkkkkk', '2025-06-24 11:55:38', '2025-06-24 11:55:38'),
(3, 'raslen kalboussi', 'rkalboussi15@gmail.com', 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', '2025-06-24 11:55:43', '2025-06-24 11:55:43'),
(4, 'raslen kalboussi', 'rkalboussi15@gmail.com', 'tttttttttttttttttttttttttttttttttt', '2025-06-24 11:55:52', '2025-06-24 11:55:52');

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cin` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `age` int(11) GENERATED ALWAYS AS (timestampdiff(YEAR,`birth_date`,curdate())) VIRTUAL,
  `genre` enum('male','female') NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `education_level` enum('primaire','college','lycee','bac','bac_1','bac_2','bac_3','bac_4','bac_5','bac_6') NOT NULL,
  `hire_date` date NOT NULL,
  `seniority` int(11) GENERATED ALWAYS AS (timestampdiff(YEAR,`hire_date`,curdate())) VIRTUAL,
  `category` enum('direct','indirect') NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`id`, `cin`, `full_name`, `birth_date`, `genre`, `phone_number`, `address`, `education_level`, `hire_date`, `category`, `avatar`, `created_at`, `updated_at`) VALUES
(3, '12345678', 'raslen kalboussi', '2003-06-18', 'male', '29098543', 'alam sbikha kairouan', 'bac_3', '2023-06-27', 'direct', 'avatars/RI8sH0ynxoEco6B5sxq8mYQBnVkTGAy76PARaoIR.png', '2025-06-20 11:42:07', '2025-06-24 09:16:34'),
(4, '08856631', 'raslen kalboussi', '2003-06-18', 'male', '29098543', 'alam sbikha kairouan', 'bac_3', '2023-01-04', 'indirect', 'avatars/3oNf6lrzH7SmnbQ13TXSJ2UhOdAtSl167aRv9jS1.png', '2025-06-21 10:19:02', '2025-06-21 10:19:02'),
(5, '10203060', 'raslen kalboussi', '2003-06-18', 'male', '29098543', 'alam sbikha kairouan', 'bac_3', '2021-08-24', 'indirect', 'avatars/yW45Gh9RL8CDTavqf2gQWmoVAsq55DKLYYxfqa8D.png', '2025-06-21 10:23:44', '2025-06-21 10:23:44'),
(6, '14254854', 'raslen kalboussi', '2003-06-18', 'male', '29098543', 'alam sbikha kairouan', 'bac_3', '2020-02-20', 'direct', 'avatars/pnhcIHNS0QlNFX5mu0WrAGEi2Rwzjy0ImuYZOq9V.jpg', '2025-06-21 13:27:23', '2025-06-22 11:36:32'),
(15, '11999669', 'raslen kalboussi', '2003-06-18', 'male', '29098543', 'alam sbikha kairouan', 'bac_3', '2020-06-12', 'indirect', 'avatars/7u6iudq3yB6zZljVM7bwU9v0VG8h09ogRLLuNKiB.png', '2025-07-08 08:10:30', '2025-07-08 08:10:30'),
(16, '10203161', 'raslen kalboussi', '2004-07-12', 'male', '29098543', 'alam sbikha kairouan', 'bac_3', '2021-02-10', 'indirect', NULL, '2025-07-08 08:11:37', '2025-07-08 08:11:37'),
(17, '12536592', 'raslen kalboussi', '2002-08-15', 'male', '29098543', 'alam sbikha kairouan', 'bac_2', '2022-06-25', 'direct', 'avatars/T4Kpu6eMa2SmPzR23BYTwjUbioQIBNJzdz3PlrzZ.jpg', '2025-07-08 08:12:38', '2025-07-08 08:12:38');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `internship_applications`
--

CREATE TABLE `internship_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_type` enum('office','factory') NOT NULL,
  `cin` varchar(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `education_level` enum('high_school','vocational','bachelor','master') NOT NULL,
  `school` varchar(255) NOT NULL,
  `field_of_study` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `cv_path` varchar(255) NOT NULL,
  `cover_letter` text DEFAULT NULL,
  `terms_accepted` tinyint(1) NOT NULL,
  `status` enum('pending','under_review','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `internship_applications`
--

INSERT INTO `internship_applications` (`id`, `position_type`, `cin`, `first_name`, `last_name`, `age`, `phone`, `email`, `education_level`, `school`, `field_of_study`, `duration`, `cv_path`, `cover_letter`, `terms_accepted`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'factory', '12005216', 'ramez', 'kalboussi', 19, '29098543', 'rkalboussi15@gmail.com', 'bachelor', 'iset kairouan', 'cf', 4, 'internship_applications/cvs/KUXKWyX8WZPw01L3kTEh_1750423134.pdf', 'hhhhhhhhhhhhhhhhhhhhhhhhhhhh', 1, 'pending', '2025-06-20 11:38:54', '2025-06-22 14:43:21', NULL),
(2, 'factory', '10203060', 'raslen', 'kalboussi', 22, '29098543', 'rkalboussi15@gmail.com', 'bachelor', 'iset kairouan', 'dsi', 6, 'internship_applications/cvs/Hulb2b2oCPrLSc4TqD8S_1750591261.pdf', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 1, 'rejected', '2025-06-22 10:21:01', '2025-06-22 14:54:37', NULL),
(3, 'office', '12345678', 'raslen', 'kalboussi', 22, '29098543', 'rkalboussi15@gmail.com', 'bachelor', 'iset kairouan', 'cf', 6, 'internship_applications/cvs/OwwEbQcZP7lsTJfsfvUH_1750591286.pdf', 'gggggggggggggggggggggggggggggggggggggg', 1, 'under_review', '2025-06-22 10:21:26', '2025-07-08 07:57:35', NULL),
(4, 'factory', '11999669', 'raslen', 'kalboussi', 22, '29098543', 'rkalboussi15@gmail.com', 'vocational', 'iset kairouan', 'dsi', 4, 'internship_applications/cvs/miJUkoHDVw4SWyTaeeen_1750608632.pdf', 'sssssssssssssssssssssssss', 1, 'approved', '2025-06-22 15:10:32', '2025-07-04 06:53:07', NULL),
(5, 'office', '11999669', 'raslen', 'kalboussi', 22, '29098543', 'rkalboussi15@gmail.com', 'bachelor', 'iset kairouan', 'dsi', 4, 'internship_applications/cvs/foewu98382kcdtUI0jHr_1750767157.pdf', 'sssssssssssssssssssssssssssssssss', 1, 'under_review', '2025-06-24 11:12:37', '2025-07-01 13:24:15', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_type` enum('office','factory') NOT NULL,
  `cin` varchar(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `education_level` enum('primary','secondary','high_school','bachelor','master','phd') NOT NULL,
  `position` varchar(255) NOT NULL,
  `cv_path` varchar(255) NOT NULL,
  `cover_letter` text DEFAULT NULL,
  `terms_accepted` tinyint(1) NOT NULL,
  `status` enum('pending','under_review','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `job_applications`
--

INSERT INTO `job_applications` (`id`, `position_type`, `cin`, `first_name`, `last_name`, `age`, `phone`, `email`, `education_level`, `position`, `cv_path`, `cover_letter`, `terms_accepted`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(2, 'office', '12005216', 'raslen', 'kalboussi', 22, '29098543', 'rkalboussi15@gmail.com', 'high_school', 'hr_manager', 'job_applications/cvs/Y6m6TvUnEvbKuzG4pTaj_1750591214.pdf', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 1, 'pending', '2025-06-22 10:20:14', '2025-07-01 13:15:43', NULL),
(3, 'office', '08856631', 'raslen', 'kalboussi', 22, '29098543', 'rkalboussi15@gmail.com', 'bachelor', 'warehouse_worker', 'job_applications/cvs/wQZTbyuZqeBZPSAhgvIc_1750591231.pdf', 'ddddddddddddddddddddddddddddddddddddd', 1, 'pending', '2025-06-22 10:20:31', '2025-07-01 09:28:21', NULL),
(4, 'factory', '11999669', 'raslen', 'kalboussi', 22, '29098543', 'rkalboussi15@gmail.com', 'high_school', 'hr_manager', 'job_applications/cvs/GpsLQOP0sGQ9B4iG0uaB_1750766157.pdf', '55ddddddddddddddddddddd', 1, 'pending', '2025-06-24 10:55:57', '2025-06-27 11:52:42', NULL),
(5, 'factory', '12005216', 'ramez', 'kalboussi', 19, '29098543', 'kalbousiramez@gmail.com', 'bachelor', 'admin_assistant', 'job_applications/cvs/4y03PC5qtt19Smhr8AFW_1751026961.pdf', 'sssssssssssssssssssssssssssss', 1, 'approved', '2025-06-27 11:22:41', '2025-07-01 13:15:58', NULL),
(6, 'office', '11999669', 'ranim', 'kalboussi', 20, '29098543', 'rkalboussi15@gmail.com', 'high_school', 'hr_manager', 'job_applications/cvs/36HFhHUIFvVHSoNqNHKT_1751366978.pdf', 'ddddddddddddddddddddddddd', 1, 'approved', '2025-07-01 09:49:38', '2025-07-04 06:52:55', NULL),
(7, 'office', '11999669', 'raslen', 'kalboussi', 22, '29098543', 'rkalboussi15@gmail.com', 'high_school', 'hr_manager', 'job_applications/cvs/9DelTAepasZXWiuzaYT9_1751877440.pdf', 'ddddddddddddddddddddd', 1, 'under_review', '2025-07-07 07:37:20', '2025-07-08 08:47:47', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `reply` text DEFAULT NULL,
  `is_replied` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_05_17_114703_create__users_table', 1),
(6, '2025_05_18_082740_create_contacts_table', 1),
(7, '2025_06_10_152440_create_employees_table', 1),
(8, '2025_06_20_075019_create_internship_applications_table', 1),
(9, '2025_06_20_080440_create_job_applications_table', 1),
(10, '2025_06_20_103101_create_qualifications_table', 1),
(11, '2025_06_21_100055_add_status_to_job_applications_table', 2),
(12, '2025_06_24_114255_create_application_settings_table', 2),
(13, '2025_06_27_082230_add_role_to_users_table', 3),
(14, '2025_06_27_100315_create_messages_table', 4),
(15, '2025_06_27_121830_add_user_id_to_applications_tables', 5),
(16, '2025_07_02_083957_create_stagiaires_table', 6),
(17, '2025_09_25_194527_create_sessions_table', 7);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `trainer` varchar(255) NOT NULL,
  `note` decimal(3,1) NOT NULL,
  `next_qualification_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `qualifications`
--

INSERT INTO `qualifications` (`id`, `employee_id`, `type`, `date`, `trainer`, `note`, `next_qualification_date`, `created_at`, `updated_at`) VALUES
(24, 6, 'Comptage', '2025-06-25', 'raslen kalboussi', 9.0, NULL, '2025-06-25 11:35:45', '2025-06-25 11:35:45');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('zysUsqpYXF6cr3BhzZpP6RJlM4h3R0yqCtgpg5M8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmR6MExVQnE0eEE0VHdBbk01c3FIUjdlWkFDekhQYkNhM0hjcW53RyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758829804);

-- --------------------------------------------------------

--
-- Structure de la table `stagiaires`
--

CREATE TABLE `stagiaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cin` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `genre` enum('male','female') NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `education_level` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `school` varchar(255) NOT NULL,
  `field_of_study` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stagiaires`
--

INSERT INTO `stagiaires` (`id`, `cin`, `full_name`, `birth_date`, `genre`, `phone_number`, `education_level`, `address`, `school`, `field_of_study`, `start_date`, `end_date`, `avatar`, `created_at`, `updated_at`) VALUES
(1, '11999669', 'raslen kalboussi', '2003-06-18', 'male', '29098543', 'bac_3', 'alam sbikha kairouan', 'iset kairouan', 'dsi', '2025-06-09', '2025-07-09', 'stagiaires/avatars/cXLPmNi40yuqbGXUtScAxspri9MHH6uAc048wFoP.jpg', '2025-07-02 08:07:33', '2025-07-02 08:46:14'),
(2, '12005216', 'ramez kalboussi', '2005-08-23', 'male', '29098543', 'bac_1', 'alam sbikha kairouan', 'iset kairouan', 'cf', '2025-06-15', '2025-08-15', 'stagiaires/avatars/vbnzcS3xBvcVpUcrCmpkjTpq0iSOXC0lq845Wsbr.png', '2025-07-02 08:12:51', '2025-07-02 08:12:51'),
(3, '98985632', 'ben hloua jaouher', '2002-07-22', 'male', '50230355', 'bac_2', 'kairouan', 'imset sousse', 'IG', '2025-06-15', '2025-07-15', 'stagiaires/avatars/7wnVbAm4oJIN2T6g7xWiLLBfBexsjI5EdAwaqw9n.jpg', '2025-07-02 08:49:30', '2025-07-02 08:50:01'),
(4, '12345678', 'raslen kalboussi', '2003-06-18', 'male', '29098543', 'bac_2', 'alam sbikha kairouan', 'iset kairouan', 'dsi', '2025-06-09', '2025-08-09', NULL, '2025-07-03 11:54:49', '2025-07-08 08:05:12');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'RASLEN11', 'rkalboussi15@gmail.com', NULL, '$2y$10$zFIZcZZpX4WUUzAful2W4exNGLUH/AeruD/ZnRK40QWrpsBF/KIR.', 'bHNhoRGTGeZGDGrqc8cwrT4VzIr2fxhuS8xRB7QinPsw498dImSxGB1ojLeh', '2025-06-20 09:56:33', '2025-06-24 10:29:29', 'admin'),
(7, 'raslen kalboussi', 'kalbousiramez@gmail.com', NULL, '$2y$10$mykbbBQTWr47tXFW1NR3JuIAxAqZuNp0x9TW79AeIfv3ijhz48cNa', '6SzCP3hj71b1ydrnoYUhCv2EQ1smosSip372vV6LpXjsJjAkwvNXKe16tZFV', '2025-06-27 08:22:34', '2025-06-27 08:22:34', 'user'),
(8, 'RAMEZ11', 'rkalboussi155@gmail.com', NULL, '$2y$10$8TkdyR5dSuVWO9iCt9pUYOaVaUZQto081doPFoAey1vKV0uxqX92O', 'M9NH1iKF2kx68JSFKCGhVCUnYuxfzwYA7Dpw0KpT2QokOSPsoVZsfTMLmd0H', '2025-06-27 09:20:03', '2025-06-27 09:20:03', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `_users`
--

CREATE TABLE `_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `application_settings`
--
ALTER TABLE `application_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_cin_unique` (`cin`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `internship_applications`
--
ALTER TABLE `internship_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `internship_applications_user_id_foreign` (`user_id`);

--
-- Index pour la table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_user_id_foreign` (`user_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_admin_id_foreign` (`admin_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qualifications_employee_id_foreign` (`employee_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stagiaires_cin_unique` (`cin`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `_users`
--
ALTER TABLE `_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `application_settings`
--
ALTER TABLE `application_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `internship_applications`
--
ALTER TABLE `internship_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `_users`
--
ALTER TABLE `_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `internship_applications`
--
ALTER TABLE `internship_applications`
  ADD CONSTRAINT `internship_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `qualifications`
--
ALTER TABLE `qualifications`
  ADD CONSTRAINT `qualifications_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
