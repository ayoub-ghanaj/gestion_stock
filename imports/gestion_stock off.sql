-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 31 août 2022 à 11:12
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `bill`
--

CREATE TABLE `bill` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wearhouse_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(250) DEFAULT NULL,
  `title` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `bill`
--

INSERT INTO `bill` (`id`, `user_id`, `description`, `bill_price`, `created_at`, `updated_at`, `wearhouse_id`, `company_name`, `title`, `type`) VALUES
(1, 1, 'ijoijijoio', 13.00, '2022-08-30 13:40:45', '2022-08-30 13:40:45', 1, 'jiojiojoijo', 'jijoijoijo', 'take'),
(2, 1, 'ijoijijoio', 13.00, '2022-08-30 13:42:29', '2022-08-30 13:42:29', 1, 'jiojiojoijo', 'jijoijoijo', 'take'),
(3, 1, 'ijoijijoio', 13.00, '2022-08-30 13:43:17', '2022-08-30 13:43:17', 1, 'jiojiojoijo', 'jijoijoijo', 'take'),
(4, 1, 'ijoijijoio', 13.00, '2022-08-30 13:43:19', '2022-08-30 13:43:19', 1, 'jiojiojoijo', 'jijoijoijo', 'take'),
(5, 1, 'ijoijijoio', 13.00, '2022-08-30 13:45:39', '2022-08-30 13:45:39', 1, 'jiojiojoijo', 'jijoijoijo', 'take'),
(6, 1, 'lklkllmmlkm', 13.00, '2022-08-30 14:45:00', '2022-08-30 14:45:00', 1, 'iomkmkmkl', 'mkmklml', 'take'),
(7, 1, 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', 4.00, '2022-08-30 15:04:08', '2022-08-30 15:04:08', 5, 'czczxczcczc', 'zcxzxc', 'take'),
(8, 1, '-', 12221.00, '2022-08-30 15:11:35', '2022-08-30 15:11:35', 1, '-', 'initial stock', 'ADD'),
(9, 1, '-', 9098.00, '2022-08-30 15:11:51', '2022-08-30 15:11:51', 1, '-', 'initial stock', 'ADD'),
(10, 1, '-', 96040.00, '2022-08-30 15:12:53', '2022-08-30 15:12:53', 1, '-', 'initial stock', 'ADD'),
(11, 1, 'kkllklkjlk', 728820.00, '2022-08-30 15:13:26', '2022-08-30 15:13:26', 1, 'jkmlm', 'lklklk', 'take');

-- --------------------------------------------------------

--
-- Structure de la table `cargo`
--

CREATE TABLE `cargo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wearhouse_id` bigint(20) UNSIGNED NOT NULL,
  `cargo_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo_count` int(255) NOT NULL DEFAULT 0,
  `cargo_price` double(8,2) NOT NULL,
  `cargo_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'storage/cargos_logos/defaultcar.png',
  `cargo_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cargo`
--

INSERT INTO `cargo` (`id`, `wearhouse_id`, `cargo_name`, `cargo_count`, `cargo_price`, `cargo_logo`, `cargo_status`, `created_at`, `updated_at`) VALUES
(8, 1, 'cargo', 170, 1.00, 'storage/cargos_logos/1660741714.png', '1', '2022-08-17 12:08:34', '2022-08-17 12:08:34'),
(9, 1, '6688', 9884, 1.00, 'storage/cargos_logos/1660742778.png', '1', '2022-08-17 12:26:18', '2022-08-17 12:26:18'),
(10, 1, 'kljlj', 8998896, 1.00, 'storage/cargos_logos/1660743380.png', '1', '2022-08-17 12:36:20', '2022-08-17 12:36:20'),
(11, 1, '080', 98098, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-17 12:38:00', '2022-08-17 12:38:00'),
(12, 1, 'ijojoi', 787, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-18 11:57:07', '2022-08-18 11:57:07'),
(13, 1, 'yyyyyyyyy', 88, 1.00, 'storage/cargos_logos/defaultcar.png', '0', '2022-08-18 11:57:16', '2022-08-21 15:21:01'),
(14, 15, 'jijijiiojj', 0, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-22 08:56:40', '2022-08-22 08:56:40'),
(15, 16, 'kljkl', 88, 1.00, 'storage/cargos_logos/defaultcar.png', '0', '2022-08-22 09:09:35', '2022-08-22 09:10:43'),
(16, 16, '54654', 6545, 1.00, 'storage/cargos_logos/defaultcar.png', '0', '2022-08-22 09:14:26', '2022-08-22 09:14:34'),
(17, 3, 'cargo1', 66, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 07:47:26', '2022-08-24 07:47:26'),
(18, 21, 'kkk', 9, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:12:41', '2022-08-24 08:12:41'),
(19, 21, 'kkk', 9, 1.00, 'storage/cargos_logos/defaultcar.png', '0', '2022-08-24 08:12:41', '2022-08-24 08:12:50'),
(20, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:00', '2022-08-24 08:13:00'),
(21, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:00', '2022-08-24 08:13:00'),
(22, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:01', '2022-08-24 08:13:01'),
(23, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:01', '2022-08-24 08:13:01'),
(24, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:02', '2022-08-24 08:13:02'),
(25, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:03', '2022-08-24 08:13:03'),
(26, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:03', '2022-08-24 08:13:03'),
(27, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:04', '2022-08-24 08:13:04'),
(28, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:04', '2022-08-24 08:13:04'),
(29, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:05', '2022-08-24 08:13:05'),
(30, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:05', '2022-08-24 08:13:05'),
(31, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:06', '2022-08-24 08:13:06'),
(32, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:06', '2022-08-24 08:13:06'),
(33, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:07', '2022-08-24 08:13:07'),
(34, 21, 'kk', 998, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:13:07', '2022-08-24 08:13:07'),
(35, 22, 'kjjoi', 8809, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:28:03', '2022-08-24 08:28:03'),
(36, 5, 'jkji', 5, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-24 08:29:22', '2022-08-24 08:29:22'),
(37, 1, 'klkkm', 12221, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-30 15:04:40', '2022-08-30 15:04:40'),
(38, 1, 'klkkm', 12221, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-30 15:06:12', '2022-08-30 15:06:12'),
(39, 1, 'klkkm', 12221, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-30 15:11:35', '2022-08-30 15:11:35'),
(40, 1, 'kllkmmlk', 9098, 1.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-30 15:11:51', '2022-08-30 15:11:51'),
(41, 1, 'kjkllmmlklk', 9809800, 80980.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-30 15:12:36', '2022-08-30 15:12:36'),
(42, 1, '90890809', 98, 980.00, 'storage/cargos_logos/defaultcar.png', '1', '2022-08-30 15:12:53', '2022-08-30 15:12:53');

-- --------------------------------------------------------

--
-- Structure de la table `employers`
--

CREATE TABLE `employers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `wearhouse_id` bigint(20) UNSIGNED NOT NULL,
  `rank` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employers`
--

INSERT INTO `employers` (`id`, `user_id`, `wearhouse_id`, `rank`, `role`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Creator', 'Owner', NULL, NULL),
(2, 1, 2, 1, 'Creator', 'Owner', NULL, NULL),
(3, 1, 3, 1, 'Creator', 'Owner', NULL, NULL),
(7, 1, 4, 1, 'Creator', 'Owner', NULL, NULL),
(8, 1, 5, 1, 'Creator', 'Owner', NULL, NULL),
(9, 1, 6, 1, 'Creator', 'Owner', NULL, NULL),
(10, 1, 7, 1, 'Creator', 'Owner', NULL, NULL),
(11, 1, 8, 1, 'Creator', 'Owner', NULL, NULL),
(13, 1, 9, 1, 'Creator', 'Owner', NULL, NULL),
(14, 1, 10, 1, 'Creator', 'Owner', NULL, NULL),
(15, 1, 11, 1, 'Creator', 'Owner', NULL, NULL),
(16, 1, 12, 1, 'Creator', 'Owner', NULL, NULL),
(17, 1, 13, 1, 'Creator', 'Owner', NULL, NULL),
(18, 1, 14, 1, 'Creator', 'Owner', NULL, NULL),
(19, 2, 1, 2, 'manager', 'co-owner', '2022-08-18 13:38:18', '2022-08-22 07:30:22'),
(21, 3, 1, 3, 'manager', 'co-owner', '2022-08-21 09:45:07', '2022-08-22 07:30:32'),
(22, 1, 15, 1, 'Creator', 'Owner', NULL, NULL),
(23, 5, 16, 1, 'Creator', 'Owner', NULL, NULL),
(24, 1, 16, 2, 'manager', 'co-owner', '2022-08-22 09:09:55', '2022-08-22 09:10:03'),
(25, 1, 17, 1, 'Creator', 'Owner', NULL, NULL),
(26, 4, 17, 2, 'manager', 'dridor', '2022-08-22 09:37:25', '2022-08-22 09:37:41'),
(27, 4, 18, 1, 'Creator', 'Owner', NULL, NULL),
(29, 2, 3, 2, 'manager', 'co-owner', '2022-08-24 07:46:21', '2022-08-24 07:46:51'),
(30, 3, 3, 3, 'manager', 'co-owner', '2022-08-24 07:46:40', '2022-08-24 07:46:40'),
(31, 1, 19, 1, 'Creator', 'Owner', NULL, NULL),
(32, 2, 16, 3, 'manager', 'co-owner', '2022-08-24 08:06:12', '2022-08-24 08:06:12'),
(33, 1, 20, 1, 'Creator', 'Owner', '2022-08-24 09:06:29', NULL),
(34, 2, 21, 1, 'Creator', 'Owner', '2022-08-24 09:10:23', NULL),
(35, 1, 21, 2, 'manager', 'co-owner', '2022-08-24 08:10:41', '2022-08-24 08:10:57'),
(36, 2, 22, 1, 'Creator', 'Owner', '2022-08-24 09:27:50', NULL),
(37, 3, 5, 2, 'manager', 'co-owner', '2022-08-24 08:29:45', '2022-08-24 08:29:45'),
(38, 2, 23, 1, 'Creator', 'Owner', '2022-08-24 13:07:22', NULL),
(39, 2, 24, 1, 'Creator', 'Owner', '2022-08-24 13:07:37', NULL),
(40, 1, 24, 3, 'manager', 'co-owner', '2022-08-24 12:07:49', '2022-08-24 12:07:49'),
(41, 1, 23, 2, 'manager', 'co-owner', '2022-08-24 12:08:05', '2022-08-24 12:08:05'),
(42, 5, 23, 3, 'manager', 'co-owner', '2022-08-24 12:11:17', '2022-08-24 12:11:17'),
(43, 1, 25, 1, 'Creator', 'Owner', '2022-08-25 11:46:19', NULL),
(44, 1, 26, 1, 'Creator', 'Owner', '2022-08-30 11:08:40', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_15_091359_create_garage_table', 1),
(6, '2022_08_15_091550_create_cargo_table', 1),
(7, '2022_08_15_091567_operation', 1),
(8, '2022_08_15_091704_create_links_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cargo_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ammount` int(255) NOT NULL,
  `operation_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`id`, `cargo_id`, `user_id`, `type`, `ammount`, `operation_status`, `created_at`, `updated_at`, `bill_id`) VALUES
(4, 8, 1, 'creation', 420, 1, '2022-08-17 12:08:34', '2022-08-17 12:08:34', 0),
(5, 9, 1, 'creation', 9890, 1, '2022-08-17 12:26:18', '2022-08-17 12:26:18', 0),
(6, 10, 1, 'creation', 8998900, 1, '2022-08-17 12:36:20', '2022-08-17 12:36:20', 0),
(7, 11, 1, 'creation', 98098, 1, '2022-08-17 12:38:00', '2022-08-17 12:38:00', 0),
(8, 12, 1, 'creation', 787, 1, '2022-08-18 11:57:07', '2022-08-18 11:57:07', 0),
(9, 13, 1, 'creation', 88, 1, '2022-08-18 11:57:16', '2022-08-18 11:57:16', 0),
(10, 9, 1, 'take', 1, 1, '2022-08-18 13:30:15', '2022-08-18 13:30:15', 0),
(11, 8, 1, 'add', 88468, 1, '2022-08-18 13:39:03', '2022-08-18 13:39:03', 0),
(12, 8, 1, 'take', 88880, 1, '2022-08-18 13:39:18', '2022-08-18 13:39:18', 0),
(13, 8, 1, 'add', 91, 1, '2022-08-21 15:25:29', '2022-08-21 15:25:29', 0),
(14, 8, 1, 'take', 9, 1, '2022-08-21 15:25:38', '2022-08-21 15:25:38', 0),
(15, 8, 1, 'add', 99, 1, '2022-08-21 15:25:44', '2022-08-21 15:25:44', 0),
(16, 8, 1, 'take', 189, 1, '2022-08-21 15:27:27', '2022-08-21 15:27:27', 0),
(17, 8, 1, 'add', 55, 1, '2022-08-21 15:28:38', '2022-08-21 15:28:38', 0),
(18, 8, 1, 'take', 55, 1, '2022-08-21 15:28:42', '2022-08-21 15:28:42', 0),
(19, 8, 1, 'take', 99, 1, '2022-08-21 15:32:48', '2022-08-21 15:32:48', 0),
(20, 8, 1, 'add', 99999990, 1, '2022-08-21 15:32:53', '2022-08-21 15:32:53', 0),
(21, 8, 1, 'take', 99999990, 1, '2022-08-21 15:32:56', '2022-08-21 15:32:56', 0),
(22, 8, 1, 'add', 97768, 1, '2022-08-21 15:35:28', '2022-08-21 15:35:28', 0),
(23, 8, 1, 'take', 97768, 1, '2022-08-22 08:30:13', '2022-08-22 08:30:13', 0),
(24, 8, 1, 'add', 787880, 1, '2022-08-22 08:30:21', '2022-08-22 08:30:21', 0),
(25, 8, 1, 'take', 1, 1, '2022-08-22 08:34:01', '2022-08-22 08:34:01', 0),
(26, 8, 1, 'take', 787879, 1, '2022-08-22 08:37:26', '2022-08-22 08:37:26', 0),
(27, 8, 1, 'add', 5665, 1, '2022-08-22 08:37:40', '2022-08-22 08:37:40', 0),
(28, 14, 1, 'creation', 111, 1, '2022-08-22 08:56:40', '2022-08-22 08:56:40', 0),
(29, 14, 1, 'take', 111, 1, '2022-08-22 08:56:53', '2022-08-22 08:56:53', 0),
(30, 15, 5, 'creation', 88, 1, '2022-08-22 09:09:35', '2022-08-22 09:09:35', 0),
(31, 16, 1, 'creation', 6545, 1, '2022-08-22 09:14:26', '2022-08-22 09:14:26', 0),
(32, 8, 1, 'take', 5665, 1, '2022-08-22 14:46:03', '2022-08-22 14:46:03', 0),
(33, 8, 1, 'add', 5654, 1, '2022-08-22 14:46:20', '2022-08-22 14:46:20', 0),
(34, 8, 1, 'add', 1, 1, '2022-08-22 14:52:24', '2022-08-22 14:52:24', 0),
(35, 17, 1, 'creation', 66, 1, '2022-08-24 07:47:26', '2022-08-24 07:47:26', 0),
(36, 8, 1, 'take', 22, 1, '2022-08-24 07:54:27', '2022-08-24 07:54:27', 0),
(37, 8, 1, 'add', 367, 1, '2022-08-24 07:54:50', '2022-08-24 07:54:50', 0),
(38, 8, 1, 'add', 367, 1, '2022-08-24 07:54:51', '2022-08-24 07:54:51', 0),
(39, 8, 1, 'take', 367, 1, '2022-08-24 07:55:08', '2022-08-24 07:55:08', 0),
(40, 8, 1, 'add', 1000, 1, '2022-08-24 07:55:22', '2022-08-24 07:55:22', 0),
(41, 8, 1, 'add', 1000, 1, '2022-08-24 07:55:48', '2022-08-24 07:55:48', 0),
(42, 18, 1, 'creation', 9, 1, '2022-08-24 08:12:41', '2022-08-24 08:12:41', 0),
(43, 19, 1, 'creation', 9, 1, '2022-08-24 08:12:41', '2022-08-24 08:12:41', 0),
(44, 20, 1, 'creation', 998, 1, '2022-08-24 08:13:00', '2022-08-24 08:13:00', 0),
(45, 21, 1, 'creation', 998, 1, '2022-08-24 08:13:00', '2022-08-24 08:13:00', 0),
(46, 22, 1, 'creation', 998, 1, '2022-08-24 08:13:01', '2022-08-24 08:13:01', 0),
(47, 23, 1, 'creation', 998, 1, '2022-08-24 08:13:01', '2022-08-24 08:13:01', 0),
(48, 24, 1, 'creation', 998, 1, '2022-08-24 08:13:02', '2022-08-24 08:13:02', 0),
(49, 25, 1, 'creation', 998, 1, '2022-08-24 08:13:03', '2022-08-24 08:13:03', 0),
(50, 26, 1, 'creation', 998, 1, '2022-08-24 08:13:03', '2022-08-24 08:13:03', 0),
(51, 27, 1, 'creation', 998, 1, '2022-08-24 08:13:04', '2022-08-24 08:13:04', 0),
(52, 28, 1, 'creation', 998, 1, '2022-08-24 08:13:04', '2022-08-24 08:13:04', 0),
(53, 29, 1, 'creation', 998, 1, '2022-08-24 08:13:05', '2022-08-24 08:13:05', 0),
(54, 30, 1, 'creation', 998, 1, '2022-08-24 08:13:05', '2022-08-24 08:13:05', 0),
(55, 31, 1, 'creation', 998, 1, '2022-08-24 08:13:06', '2022-08-24 08:13:06', 0),
(56, 32, 1, 'creation', 998, 1, '2022-08-24 08:13:06', '2022-08-24 08:13:06', 0),
(57, 33, 1, 'creation', 998, 1, '2022-08-24 08:13:07', '2022-08-24 08:13:07', 0),
(58, 34, 1, 'creation', 998, 1, '2022-08-24 08:13:07', '2022-08-24 08:13:07', 0),
(59, 35, 2, 'creation', 8809, 1, '2022-08-24 08:28:03', '2022-08-24 08:28:03', 0),
(60, 36, 1, 'creation', 9, 1, '2022-08-24 08:29:22', '2022-08-24 08:29:22', 0),
(61, 8, 1, 'add', 1, 1, '2022-08-24 08:42:19', '2022-08-24 08:42:19', 0),
(62, 8, 1, 'take', 8001, 1, '2022-08-24 08:42:32', '2022-08-24 08:42:32', 0),
(63, 8, 1, 'add', 2147483647, 1, '2022-08-24 08:45:49', '2022-08-24 08:45:49', 0),
(64, 8, 1, 'add', 1, 1, '2022-08-24 08:45:54', '2022-08-24 08:45:54', 0),
(65, 8, 1, 'add', 454451, 1, '2022-08-24 08:46:09', '2022-08-24 08:46:09', 0),
(66, 8, 1, 'add', 999999991, 1, '2022-08-24 08:46:19', '2022-08-24 08:46:19', 0),
(67, 8, 1, 'add', 2147483647, 1, '2022-08-24 08:46:29', '2022-08-24 08:46:29', 0),
(68, 8, 1, 'add', 2147483647, 1, '2022-08-24 08:46:42', '2022-08-24 08:46:42', 0),
(69, 8, 1, 'add', 1, 1, '2022-08-24 08:46:48', '2022-08-24 08:46:48', 0),
(70, 8, 1, 'take', 1, 1, '2022-08-24 09:15:45', '2022-08-24 09:15:45', 0),
(71, 8, 1, 'add', 1, 1, '2022-08-24 09:22:41', '2022-08-24 09:22:41', 0),
(72, 8, 1, 'take', 1, 1, '2022-08-24 09:24:20', '2022-08-24 09:24:20', 0),
(73, 8, 1, 'take', 1, 1, '2022-08-24 09:25:23', '2022-08-24 09:25:23', 0),
(74, 8, 1, 'take', 999, 1, '2022-08-24 09:28:07', '2022-08-24 09:28:07', 0),
(75, 8, 1, 'add', 1001, 1, '2022-08-24 09:28:14', '2022-08-24 09:28:14', 0),
(76, 8, 1, 'take', 21474647, 1, '2022-08-24 09:28:37', '2022-08-24 09:28:37', 0),
(77, 8, 1, 'add', 21474621, 1, '2022-08-24 09:34:47', '2022-08-24 09:34:47', 0),
(78, 8, 1, 'add', 26, 1, '2022-08-24 09:34:56', '2022-08-24 09:34:56', 0),
(79, 9, 1, 'take', 1, 1, '2022-08-24 09:57:39', '2022-08-24 09:57:39', 0),
(80, 8, 1, 'take', 2147483433, 1, '2022-08-24 09:58:12', '2022-08-24 09:58:12', 0),
(81, 8, 1, 'take', 13, 1, '2022-08-30 13:43:17', '2022-08-30 13:43:17', 3),
(82, 8, 1, 'take', 13, 1, '2022-08-30 13:43:19', '2022-08-30 13:43:19', 4),
(83, 8, 1, 'take', 13, 1, '2022-08-30 13:45:39', '2022-08-30 13:45:39', 5),
(84, 8, 1, 'take', 5, 1, '2022-08-30 14:45:00', '2022-08-30 14:45:00', 6),
(85, 9, 1, 'take', 4, 1, '2022-08-30 14:45:00', '2022-08-30 14:45:00', 6),
(86, 10, 1, 'take', 4, 1, '2022-08-30 14:45:00', '2022-08-30 14:45:00', 6),
(87, 36, 1, 'take', 4, 1, '2022-08-30 15:04:08', '2022-08-30 15:04:08', 7),
(88, 39, 1, 'creation', 12221, 1, '2022-08-30 15:11:35', '2022-08-30 15:11:35', 8),
(89, 40, 1, 'creation', 9098, 1, '2022-08-30 15:11:51', '2022-08-30 15:11:51', 9),
(90, 42, 1, 'creation', 98, 1, '2022-08-30 15:12:53', '2022-08-30 15:12:53', 10),
(91, 41, 1, 'take', 9, 1, '2022-08-30 15:13:26', '2022-08-30 15:13:26', 11);

--
-- Déclencheurs `operation`
--
DELIMITER $$
CREATE TRIGGER `make_operation_insert` BEFORE INSERT ON `operation` FOR EACH ROW BEGIN
IF new.type = 'take' THEN
	SET @val = 0;
	SELECT cargo_count INTO @val FROM cargo WHERE id = new.cargo_id LIMIT 1;
	IF @val >= new.ammount THEN
		UPDATE cargo set cargo_count = cargo_count - new.ammount  WHERE id = new.cargo_id ;
    ELSE
		SIGNAL SQLSTATE '66420' SET MESSAGE_TEXT = 'Warning: the cargo selected don''t have enough stock ';
	END IF;
ELSEIF new.type = 'add' THEN
	UPDATE cargo set cargo_count = cargo_count + new.ammount  WHERE id = new.cargo_id ;
ELSEIF new.type = 'creation' THEN
	SET @a='';
ELSE
	SIGNAL SQLSTATE '66425' SET MESSAGE_TEXT = 'Warning: the operation type is not valid ';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'storage/users_logos/default.png',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ayoub', 'storage/users_logos/1661099870.png', 'ayoub@gmail.com', NULL, '$2y$10$anaEbVqyXkSQdcKLS.jt6eriG8K2XU3dpjuwcL4MY9zfcSrN9LRZW', NULL, '2022-08-17 09:39:23', '2022-08-21 15:37:50'),
(2, 'ayoubhh', 'storage/users_logos/default.png', 'ayoubhh@gmail.com', NULL, '$2y$10$U0xqKvU5ZU1emhgKVG9sn.Ymz86CLPa4ZG.qokwUi9Av3D1e0f1Ay', NULL, '2022-08-17 10:16:41', '2022-08-17 10:16:41'),
(3, 'ayoub11', 'storage/users_logos/default.png', 'ayoub11@gmail.com', NULL, '$2y$10$s9NiqhyVGzz23iImoLWzCe.i/Tn4zYI7lytJsq/pUevquCdMOLs5q', NULL, '2022-08-17 14:35:28', '2022-08-17 14:35:28'),
(4, 'tester', 'storage/users_logos/default.png', 'tester@gmail.com', NULL, '$2y$10$rsEX7TvojlRi7N4zDGM3lekkgqpQWAjno1sk0grMhFrfqFSDkhwhW', NULL, '2022-08-22 09:05:19', '2022-08-22 09:05:19'),
(5, 'tester1', 'storage/users_logos/default.png', 'tester1@gmail.com', NULL, '$2y$10$NWjeq9xnn2ERyEJ4A5HJ9.idlYa8CD7fXL2DtNZI0i.TsStI74nZC', NULL, '2022-08-22 09:05:54', '2022-08-22 09:05:54');

-- --------------------------------------------------------

--
-- Structure de la table `wearhouse`
--

CREATE TABLE `wearhouse` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `wearhouse_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wearhouse_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'storage/garages_logos/default-garage.png',
  `status` int(11) NOT NULL,
  `wearhouse_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `wearhouse`
--

INSERT INTO `wearhouse` (`id`, `creator_id`, `wearhouse_name`, `wearhouse_logo`, `status`, `wearhouse_title`, `created_at`, `updated_at`) VALUES
(1, 1, 'pizziria', 'storage/garages_logos/1660732821.png', 1, 'papakhonz', '2022-08-17 09:40:21', '2022-08-17 09:40:21'),
(2, 1, 'ppahon', 'storage/garages_logos/default-garage.png', 0, 'hhlhblklk', '2022-08-17 09:41:39', '2022-08-24 07:45:59'),
(3, 1, 'jkj', 'storage/garages_logos/default-garage.png', 0, 'hbh', '2022-08-17 10:15:04', '2022-08-24 08:27:39'),
(4, 1, 'gara', 'storage/garages_logos/default-garage.png', 1, 'hhuhuoh', '2022-08-18 08:18:10', '2022-08-18 08:18:10'),
(5, 1, 'ojiijiopj', 'storage/garages_logos/default-garage.png', 1, 'jiijioj', '2022-08-18 08:18:16', '2022-08-18 08:18:16'),
(6, 1, 'jojoo', 'storage/garages_logos/default-garage.png', 1, 'jojoijj', '2022-08-18 08:25:07', '2022-08-18 08:25:07'),
(7, 1, 'jk;l;', 'storage/garages_logos/default-garage.png', 1, 'k;lk', '2022-08-18 08:31:56', '2022-08-18 08:31:56'),
(8, 1, ';lkmkmkl;m', 'storage/garages_logos/default-garage.png', 1, 'mkmkk', '2022-08-18 08:32:14', '2022-08-18 08:32:14'),
(9, 1, 'ijio', 'storage/garages_logos/default-garage.png', 1, 'iooi', '2022-08-18 12:01:05', '2022-08-18 12:01:05'),
(10, 1, 'ijii', 'storage/garages_logos/default-garage.png', 1, 'iooijo', '2022-08-18 12:01:11', '2022-08-18 12:01:11'),
(11, 1, 'jkj', 'storage/garages_logos/default-garage.png', 0, 'hj]', '2022-08-18 12:01:14', '2022-08-21 15:12:36'),
(12, 1, 'kbhjkhjh', 'storage/garages_logos/default-garage.png', 0, 'hkjhk', '2022-08-18 12:01:19', '2022-08-21 14:59:21'),
(13, 1, 'jipjiij', 'storage/garages_logos/default-garage.png', 0, 'oiojio', '2022-08-18 12:01:28', '2022-08-21 10:24:47'),
(14, 1, 'jnljjknj', 'storage/garages_logos/default-garage.png', 0, 'nknjjk', '2022-08-18 12:01:32', '2022-08-21 10:24:43'),
(15, 1, 'jkj', 'storage/garages_logos/default-garage.png', 1, 'jkj', '2022-08-21 15:12:43', '2022-08-21 15:12:43'),
(16, 5, 'noo', 'storage/garages_logos/default-garage.png', 1, 'ooii', '2022-08-22 09:08:23', '2022-08-22 09:08:23'),
(17, 1, 'jlhlj', 'storage/garages_logos/default-garage.png', 0, 'khkjh', '2022-08-22 09:31:45', '2022-08-22 09:38:33'),
(18, 4, 'klkkjlk', 'storage/garages_logos/default-garage.png', 1, 'kljkljlk', '2022-08-22 10:13:08', '2022-08-22 10:13:08'),
(19, 1, 'apstrlp', 'storage/garages_logos/default-garage.png', 1, 'app', '2022-08-24 08:04:23', '2022-08-24 08:04:23'),
(20, 1, 'test', 'storage/garages_logos/default-garage.png', 0, 'jjjj', '2022-08-24 08:06:29', '2022-08-24 08:09:50'),
(21, 2, 'kkk', 'storage/garages_logos/default-garage.png', 1, 'kkk', '2022-08-24 08:10:23', '2022-08-24 08:10:23'),
(22, 2, 'klkl', 'storage/garages_logos/default-garage.png', 1, 'kllk', '2022-08-24 08:27:50', '2022-08-24 08:27:50'),
(23, 2, 'ayoub&ayoubhh', 'storage/garages_logos/default-garage.png', 1, 'test', '2022-08-24 12:07:22', '2022-08-24 12:07:22'),
(24, 2, 'ayoubhh', 'storage/garages_logos/default-garage.png', 1, 'ayoub user', '2022-08-24 12:07:37', '2022-08-24 12:07:37'),
(25, 1, 'kkhjhjh', 'storage/garages_logos/1661427979.png', 1, 'jjlklk', '2022-08-25 10:46:19', '2022-08-25 10:46:19'),
(26, 1, 'jijijij', 'storage/garages_logos/default-garage.png', 1, 'jini', '2022-08-30 10:08:40', '2022-08-30 10:08:40');

--
-- Déclencheurs `wearhouse`
--
DELIMITER $$
CREATE TRIGGER `make_Link_insert` AFTER INSERT ON `wearhouse` FOR EACH ROW BEGIN
   insert into links(garage_id,user_id,rank,role,title) VALUES(new.id,new.creator_id,1,'Creator','Owner');
END
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `garage_id` (`wearhouse_id`);

--
-- Index pour la table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargo_garage_id_foreign` (`wearhouse_id`);

--
-- Index pour la table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `links_user_id_foreign` (`user_id`),
  ADD KEY `links_garage_id_foreign` (`wearhouse_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operation_cargo_id_foreign` (`cargo_id`),
  ADD KEY `operation_user_id_foreign` (`user_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `wearhouse`
--
ALTER TABLE `wearhouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `garage_creator_id_foreign` (`creator_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `wearhouse`
--
ALTER TABLE `wearhouse`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`wearhouse_id`) REFERENCES `wearhouse` (`id`);

--
-- Contraintes pour la table `cargo`
--
ALTER TABLE `cargo`
  ADD CONSTRAINT `cargo_garage_id_foreign` FOREIGN KEY (`wearhouse_id`) REFERENCES `wearhouse` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `employers`
--
ALTER TABLE `employers`
  ADD CONSTRAINT `links_garage_id_foreign` FOREIGN KEY (`wearhouse_id`) REFERENCES `wearhouse` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `links_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `operation_cargo_id_foreign` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `operation_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`),
  ADD CONSTRAINT `operation_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `wearhouse`
--
ALTER TABLE `wearhouse`
  ADD CONSTRAINT `garage_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
