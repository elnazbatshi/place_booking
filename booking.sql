-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 08:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboat_us`
--

CREATE TABLE `aboat_us`
(
    `id`          bigint(20) UNSIGNED NOT NULL,
    `email`       varchar(255) DEFAULT NULL,
    `phoneNumber` varchar(255) DEFAULT NULL,
    `address`     varchar(255) DEFAULT NULL,
    `description` text         DEFAULT NULL,
    `image`       varchar(255) DEFAULT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categoriables`
--

CREATE TABLE `categoriables`
(
    `category_id`        int(11) NOT NULL,
    `categoriables_id`   int(11) NOT NULL,
    `categoriables_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categoriables`
--

INSERT INTO `categoriables` (`category_id`, `categoriables_id`, `categoriables_type`)
VALUES (24, 1, 'App\\Models\\Slider'),
       (8, 12, 'App\\Models\\Post'),
       (9, 13, 'App\\Models\\Post'),
       (9, 14, 'App\\Models\\Post'),
       (9, 15, 'App\\Models\\Post'),
       (18, 17, 'App\\Models\\Post'),
       (21, 19, 'App\\Models\\Post'),
       (21, 22, 'App\\Models\\Post'),
       (15, 23, 'App\\Models\\Post'),
       (8, 25, 'App\\Models\\Post'),
       (8, 26, 'App\\Models\\Post'),
       (16, 27, 'App\\Models\\Post'),
       (13, 29, 'App\\Models\\Post'),
       (12, 30, 'App\\Models\\Post'),
       (18, 2, 'App\\Models\\Post'),
       (18, 9, 'App\\Models\\Post'),
       (9, 32, 'App\\Models\\Post'),
       (20, 20, 'App\\Models\\Post'),
       (10, 33, 'App\\Models\\Post'),
       (10, 34, 'App\\Models\\Post'),
       (21, 21, 'App\\Models\\Post'),
       (21, 35, 'App\\Models\\Post'),
       (21, 36, 'App\\Models\\Post'),
       (21, 37, 'App\\Models\\Post'),
       (15, 38, 'App\\Models\\Post'),
       (15, 39, 'App\\Models\\Post'),
       (17, 42, 'App\\Models\\Post'),
       (13, 44, 'App\\Models\\Post'),
       (23, 45, 'App\\Models\\Post'),
       (21, 46, 'App\\Models\\Post'),
       (21, 47, 'App\\Models\\Post'),
       (13, 48, 'App\\Models\\Post'),
       (12, 49, 'App\\Models\\Post'),
       (14, 50, 'App\\Models\\Post'),
       (17, 51, 'App\\Models\\Post'),
       (17, 52, 'App\\Models\\Post'),
       (21, 53, 'App\\Models\\Post'),
       (19, 54, 'App\\Models\\Post');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories`
(
    `id`         int(10) UNSIGNED NOT NULL,
    `title`      varchar(255) NOT NULL,
    `type_id`    bigint(20) UNSIGNED NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `img_src`    varchar(255) DEFAULT NULL,
    `desc`       varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `type_id`, `created_at`, `updated_at`, `img_src`, `desc`)
VALUES (24, 'صفحه اول', 3, '2023-01-09 15:04:59', '2023-01-09 15:04:59', 'http://127.0.0.1:8000/uploads/mehr.jpg',
        NULL),
       (25, 'سالن ها', 9, '2022-12-31 07:51:29', '2022-12-31 07:51:29', NULL, NULL),
       (26, 'گالری', 9, '2022-12-31 07:51:41', '2022-12-31 07:51:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us`
(
    `id`          bigint(20) UNSIGNED NOT NULL,
    `name`        varchar(255) NOT NULL,
    `email`       varchar(255) NOT NULL,
    `phoneNumber` varchar(255) NOT NULL,
    `subject`     varchar(255) NOT NULL,
    `message`     varchar(255) NOT NULL,
    `status`      enum('pending','answered') NOT NULL DEFAULT 'answered',
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phoneNumber`, `subject`, `message`, `status`, `created_at`,
                          `updated_at`)
VALUES (3, 'elnaz', 'elnaze60@gmail.com', '09380764490', 'sghsikksll, wkdwjdkwd w wdwdwdwd',
        'با سلام و درود خدمت همه عزیزان', 'answered', '0000-00-00 00:00:00', '2023-01-09 03:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `uuid`       varchar(255) NOT NULL,
    `connection` text         NOT NULL,
    `queue`      text         NOT NULL,
    `payload`    longtext     NOT NULL,
    `exception`  longtext     NOT NULL,
    `failed_at`  timestamp    NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `url`        text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `url`, `created_at`, `updated_at`)
VALUES (1, 'http://127.0.0.1:8000/storage/logos/Frame%20230.png', '2022-09-04 12:58:52', '2022-09-04 12:58:52'),
       (2, 'http://127.0.0.1:8000/storage/logos/631061d74e1ce1662018007.png', '2022-09-04 12:58:52',
        '2022-09-04 12:58:52'),
       (3, 'http://127.0.0.1:8000/storage/logos/630d0d63809591661799779.png', '2022-09-04 12:58:52',
        '2022-09-04 12:58:52'),
       (4, 'http://127.0.0.1:8000/storage/logos/Frame%20230.png', '2022-09-04 12:59:57', '2022-09-04 12:59:57'),
       (5, 'http://127.0.0.1:8000/storage/logos/631061d74e1ce1662018007.png', '2022-09-04 12:59:57',
        '2022-09-04 12:59:57'),
       (6, '', '2022-09-11 14:09:53', '2022-09-11 14:09:53'),
       (7, 'https://sccm.ir/uploads/logos/1662632562_Frame%20229.png', '2022-09-11 14:09:53', '2022-09-11 14:09:53'),
       (8, 'https://sccm.ir/uploads/logos/1662632562_Frame%20229.png', '2022-09-11 14:23:37', '2022-09-11 14:23:37'),
       (9, 'https://sccm.ir/uploads/logos/1662632562_Frame%20229.png', '2022-09-11 14:24:19', '2022-09-11 14:24:19'),
       (10, 'https://sccm.ir/uploads/logos/1662632562_Frame%20229.png', '2022-09-11 14:33:15', '2022-09-11 14:33:15'),
       (11, 'https://sccm.ir/uploads/logos/1662632562_Frame%20229.png', '2022-09-11 14:38:07', '2022-09-11 14:38:07'),
       (12, 'https://sccm.ir/uploads/logos/1662632562_Frame%20229.png', '2022-09-11 14:58:04', '2022-09-11 14:58:04'),
       (13, 'https://sccm.ir/uploads/logos/1662632562_Frame%20229.png', '2022-09-11 14:58:33', '2022-09-11 14:58:33'),
       (14, 'http://127.0.0.1:8000/storage/logos/Frame%20230.png', '2022-09-12 01:25:52', '2022-09-12 01:25:52'),
       (15, 'http://127.0.0.1:8000/storage/logos/631061d74e1ce1662018007.png', '2022-09-12 01:25:52',
        '2022-09-12 01:25:52'),
       (16,
        'https://sccm.ir/uploads/Desktop/%D8%A8%D8%B1%D9%86%D8%A7%D9%85%D9%87%20%D9%BE%D9%86%D8%AC%D9%85%20%D8%AA%D9%88%D8%B3%D8%B9%D9%87.pdf',
        '2022-09-12 05:25:26', '2022-09-12 05:25:26'),
       (17,
        'https://sccm.ir/uploads/Desktop/%D8%A8%D8%B1%D9%86%D8%A7%D9%85%D9%87%20%D9%BE%D9%86%D8%AC%D9%85%20%D8%AA%D9%88%D8%B3%D8%B9%D9%87.pdf',
        '2022-09-12 05:25:49', '2022-09-12 05:25:49'),
       (18,
        'https://sccm.ir/uploads/Desktop/%D8%A7%D9%84%DA%AF%D9%88%DB%8C%20%D9%BE%D8%A7%DB%8C%D9%87%E2%80%8C%DB%8C%20%D8%A7%D8%B3%D9%84%D8%A7%D9%85%DB%8C%20%D8%A7%DB%8C%D8%B1%D8%A7%D9%86%DB%8C%20%D9%BE%DB%8C%D8%B4%D8%B1%D9%81%D8%AA.pdf',
        '2022-09-12 05:35:47', '2022-09-12 05:35:47'),
       (19, 'http://127.0.0.1:8000/storage/logos/Frame%20230.png', '2022-09-19 03:32:47', '2022-09-19 03:32:47'),
       (20, 'http://127.0.0.1:8000/storage/logos/631061d74e1ce1662018007.png', '2022-09-19 03:32:47',
        '2022-09-19 03:32:47'),
       (21, 'http://127.0.0.1:8000/storage/logos/Frame%20230.png', '2022-09-28 12:41:06', '2022-09-28 12:41:06'),
       (22, 'http://127.0.0.1:8000/storage/logos/631061d74e1ce1662018007.png', '2022-09-28 12:41:06',
        '2022-09-28 12:41:06'),
       (23,
        'https://sccm.ir/uploads/Desktop/%DA%A9%D9%88%D9%88%DB%8C%D8%AF%2019%20%DA%86%D9%87%20%D8%A8%D8%B1%20%D8%B3%D8%B1%20%D8%B5%D9%86%D8%B9%D8%AA%20%DA%A9%D8%AA%D8%A7%D8%A8%20%D8%A2%D9%88%D8%B1%D8%AF%2014010107.pdf',
        '2022-09-29 06:20:31', '2022-09-29 06:20:31'),
       (24,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D8%B1%D8%A7%DB%8C%D9%86%D8%AF/%D9%BE%DA%98%D9%88%D9%87%D8%B4/%DA%A9%D9%88%D9%88%DB%8C%D8%AF%2019%20%DA%86%D9%87%20%D8%A8%D8%B1%20%D8%B3%D8%B1%20%D8%B5%D9%86%D8%B9%D8%AA%20%DA%A9%D8%AA%D8%A7%D8%A8%20%D8%A2%D9%88%D8%B1%D8%AF%2014010107.pdf',
        '2022-10-01 17:40:16', '2022-10-01 17:40:16'),
       (25,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D8%B1%D8%A7%DB%8C%D9%86%D8%AF/%DA%AF%D8%B2%D8%A7%D8%B1%D8%B4/%D8%A7%D8%B1%D8%B2%DB%8C%D8%A7%D8%A8%DB%8C%20%D8%AF%D8%B3%D8%AA%D9%88%D8%B1%D8%A7%D9%84%D8%B9%D9%85%D9%84%20%D8%A7%D8%AC%D8%B1%D8%A7%DB%8C%20%D8%B3%DB%8C%D8%A7%D8%B3%D8%AA%20%D9%87%D8%A7%DB%8C%20%D8%AA%D9%88%D8%B3%D8%B9%D9%87%20%D9%81%D8%B1%D9%87%D9%86%DA%AF%20%D9%88%20%D9%87%D9%86%D8%B1%20%D8%AF%D8%B1%20%D8%B4%D8%A8%DA%A9%D9%87%20%D9%85%D9%84%DB%8C%20%D8%A7%D8%B7%D9%84%D8%A7%D8%B9%D8%A7%D8%AA%2014010116.pdf',
        '2022-10-02 05:25:55', '2022-10-02 05:25:55'),
       (26,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D8%B1%D8%A7%DB%8C%D9%86%D8%AF/%D8%AA%D8%B1%D8%AC%D9%85%D9%87/%D8%A7%D8%B9%D9%84%D8%A7%D9%85%DB%8C%D9%87%E2%80%8C%D8%A7%DB%8C%20%D8%A8%D8%B1%D8%A7%DB%8C%20%D8%A2%DB%8C%D9%86%D8%AF%D9%87%20%D8%A7%DB%8C%D9%86%D8%AA%D8%B1%D9%86%D8%AA%2014010230.pdf',
        '2022-10-02 05:26:19', '2022-10-02 05:26:19'),
       (27,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D8%B1%D8%A7%DB%8C%D9%86%D8%AF/%D8%B3%D9%86%D8%AF/%D8%A8%D8%B1%D9%86%D8%A7%D9%85%D9%87%20%D8%A8%D8%B3%D8%B7%20%D9%88%20%D8%AA%D8%B1%D9%88%DB%8C%D8%AC%20%D8%AD%D9%84%D9%82%D9%87%20%D9%87%D8%A7%DB%8C%20%D9%85%DB%8C%D8%A7%D9%86%DB%8C%2014010602.pdf',
        '2022-10-02 05:26:41', '2022-10-02 05:26:41'),
       (28,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D8%B1%D8%A7%DB%8C%D9%86%D8%AF/%D8%B3%D9%86%D8%AF/%D8%B3%D9%86%D8%AF%20%D8%AC%D9%87%D8%A7%D8%AF%20%D8%AA%D8%A8%DB%8C%DB%8C%D9%86%2014010226.pdf',
        '2022-10-02 05:26:59', '2022-10-02 05:26:59'),
       (29,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D9%BE%D8%B4%D8%AA%DB%8C%D8%A8%D8%A7%D9%86/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D8%A8%D8%A7%D9%84%D8%A7%D8%AF%D8%B3%D8%AA%DB%8C/%D8%A8%D8%B1%D9%86%D8%A7%D9%85%D9%87%20%D9%BE%D9%86%D8%AC%D9%85%20%D8%AA%D9%88%D8%B3%D8%B9%D9%87.pdf',
        '2022-10-02 05:32:39', '2022-10-02 05:32:39'),
       (30,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D9%BE%D8%B4%D8%AA%DB%8C%D8%A8%D8%A7%D9%86/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D8%A8%D8%A7%D9%84%D8%A7%D8%AF%D8%B3%D8%AA%DB%8C/%D9%82%D8%A7%D9%86%D9%88%D9%86%20%D8%A7%D8%B3%D8%A7%D8%B3%DB%8C%20%D8%AC%D9%85%D9%87%D9%88%D8%B1%DB%8C%20%D8%A7%D8%B3%D9%84%D8%A7%D9%85%DB%8C%20%D8%A7%DB%8C%D8%B1%D8%A7%D9%86%201401.pdf',
        '2022-10-02 05:34:48', '2022-10-02 05:34:48'),
       (31,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D9%BE%D8%B4%D8%AA%DB%8C%D8%A8%D8%A7%D9%86/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D8%A8%D8%A7%D9%84%D8%A7%D8%AF%D8%B3%D8%AA%DB%8C/%D8%A7%D9%84%DA%AF%D9%88%DB%8C%20%D9%BE%D8%A7%DB%8C%D9%87%E2%80%8C%DB%8C%20%D8%A7%D8%B3%D9%84%D8%A7%D9%85%DB%8C%20%D8%A7%DB%8C%D8%B1%D8%A7%D9%86%DB%8C%20%D9%BE%DB%8C%D8%B4%D8%B1%D9%81%D8%AA.pdf',
        '2022-10-02 05:35:09', '2022-10-02 05:35:09'),
       (32,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D9%BE%D8%B4%D8%AA%DB%8C%D8%A8%D8%A7%D9%86/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D8%A8%D8%A7%D9%84%D8%A7%D8%AF%D8%B3%D8%AA%DB%8C/%D8%B3%D9%86%D8%AF%20%D8%B1%D8%A7%D9%87%D8%A8%D8%B1%D8%AF%DB%8C%20%D8%AC%D9%85%D9%87%D9%88%D8%B1%DB%8C%20%D8%A7%D8%B3%D9%84%D8%A7%D9%85%DB%8C%20%D8%A7%DB%8C%D8%B1%D8%A7%D9%86%20%D8%AF%D8%B1%20%D9%81%D8%B6%D8%A7%DB%8C%20%D9%85%D8%AC%D8%A7%D8%B2%DB%8C-%20%D8%A7%D9%87%D8%AF%D8%A7%D9%81%20%D9%88%20%D8%A7%D9%82%D8%AF%D8%A7%D9%85%D8%A7%D8%AA%20%DA%A9%D9%84%D8%A7%D9%86.pdf',
        '2022-10-02 05:35:30', '2022-10-02 05:35:30'),
       (33,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D9%BE%D8%B4%D8%AA%DB%8C%D8%A8%D8%A7%D9%86/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D8%A8%D8%A7%D9%84%D8%A7%D8%AF%D8%B3%D8%AA%DB%8C/%D8%A8%D8%B1%D9%86%D8%A7%D9%85%D9%87%20%D9%BE%D9%86%D8%AC%D9%85%20%D8%AA%D9%88%D8%B3%D8%B9%D9%87.pdf',
        '2022-10-09 05:56:26', '2022-10-09 05:56:26'),
       (34,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D9%BE%D8%B4%D8%AA%DB%8C%D8%A8%D8%A7%D9%86/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D8%A8%D8%A7%D9%84%D8%A7%D8%AF%D8%B3%D8%AA%DB%8C/%D9%82%D8%A7%D9%86%D9%88%D9%86%20%D8%A7%D8%B3%D8%A7%D8%B3%DB%8C%20%D8%AC%D9%85%D9%87%D9%88%D8%B1%DB%8C%20%D8%A7%D8%B3%D9%84%D8%A7%D9%85%DB%8C%20%D8%A7%DB%8C%D8%B1%D8%A7%D9%86%201401.pdf',
        '2022-10-09 05:56:50', '2022-10-09 05:56:50'),
       (35,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D9%BE%D8%B4%D8%AA%DB%8C%D8%A8%D8%A7%D9%86/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D8%A8%D8%A7%D9%84%D8%A7%D8%AF%D8%B3%D8%AA%DB%8C/%D8%A7%D9%84%DA%AF%D9%88%DB%8C%20%D9%BE%D8%A7%DB%8C%D9%87%E2%80%8C%DB%8C%20%D8%A7%D8%B3%D9%84%D8%A7%D9%85%DB%8C%20%D8%A7%DB%8C%D8%B1%D8%A7%D9%86%DB%8C%20%D9%BE%DB%8C%D8%B4%D8%B1%D9%81%D8%AA.pdf',
        '2022-10-09 05:57:17', '2022-10-09 05:57:17'),
       (36,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D9%BE%D8%B4%D8%AA%DB%8C%D8%A8%D8%A7%D9%86/%D8%A7%D8%B3%D9%86%D8%A7%D8%AF%20%D8%A8%D8%A7%D9%84%D8%A7%D8%AF%D8%B3%D8%AA%DB%8C/%D8%B3%D9%86%D8%AF%20%D8%B1%D8%A7%D9%87%D8%A8%D8%B1%D8%AF%DB%8C%20%D8%AC%D9%85%D9%87%D9%88%D8%B1%DB%8C%20%D8%A7%D8%B3%D9%84%D8%A7%D9%85%DB%8C%20%D8%A7%DB%8C%D8%B1%D8%A7%D9%86%20%D8%AF%D8%B1%20%D9%81%D8%B6%D8%A7%DB%8C%20%D9%85%D8%AC%D8%A7%D8%B2%DB%8C-%20%D8%A7%D9%87%D8%AF%D8%A7%D9%81%20%D9%88%20%D8%A7%D9%82%D8%AF%D8%A7%D9%85%D8%A7%D8%AA%20%DA%A9%D9%84%D8%A7%D9%86.pdf',
        '2022-10-09 05:57:33', '2022-10-09 05:57:33'),
       (37, 'http://127.0.0.1:8000/storage/logos/Frame%20230.png', '2022-10-10 15:46:07', '2022-10-10 15:46:07'),
       (38, 'http://127.0.0.1:8000/storage/logos/631061d74e1ce1662018007.png', '2022-10-10 15:46:07',
        '2022-10-10 15:46:07'),
       (39, 'http://127.0.0.1:8000/storage/logos/Frame%20230.png', '2022-10-10 15:48:37', '2022-10-10 15:48:37'),
       (40, 'http://127.0.0.1:8000/storage/logos/631061d74e1ce1662018007.png', '2022-10-10 15:48:37',
        '2022-10-10 15:48:37'),
       (41,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D8%B1%D8%A7%DB%8C%D9%86%D8%AF/%D9%BE%DA%98%D9%88%D9%87%D8%B4/%DA%A9%D9%88%D9%88%DB%8C%D8%AF%2019%20%DA%86%D9%87%20%D8%A8%D8%B1%20%D8%B3%D8%B1%20%D8%B5%D9%86%D8%B9%D8%AA%20%DA%A9%D8%AA%D8%A7%D8%A8%20%D8%A2%D9%88%D8%B1%D8%AF%2014010107.pdf',
        '2022-10-10 15:52:36', '2022-10-10 15:52:36'),
       (42,
        'https://sccm.ir/uploads/Desktop/%D8%A7%D9%84%DA%AF%D9%88%DB%8C%20%D9%BE%D8%A7%DB%8C%D9%87%E2%80%8C%DB%8C%20%D8%A7%D8%B3%D9%84%D8%A7%D9%85%DB%8C%20%D8%A7%DB%8C%D8%B1%D8%A7%D9%86%DB%8C%20%D9%BE%DB%8C%D8%B4%D8%B1%D9%81%D8%AA.pdf',
        '2022-10-10 15:52:58', '2022-10-10 15:52:58'),
       (43,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D8%B1%D8%A7%DB%8C%D9%86%D8%AF/%DA%AF%D8%B2%D8%A7%D8%B1%D8%B4/%D8%A7%D8%B1%D8%B2%DB%8C%D8%A7%D8%A8%DB%8C%20%D8%AF%D8%B3%D8%AA%D9%88%D8%B1%D8%A7%D9%84%D8%B9%D9%85%D9%84%20%D8%A7%D8%AC%D8%B1%D8%A7%DB%8C%20%D8%B3%DB%8C%D8%A7%D8%B3%D8%AA%20%D9%87%D8%A7%DB%8C%20%D8%AA%D9%88%D8%B3%D8%B9%D9%87%20%D9%81%D8%B1%D9%87%D9%86%DA%AF%20%D9%88%20%D9%87%D9%86%D8%B1%20%D8%AF%D8%B1%20%D8%B4%D8%A8%DA%A9%D9%87%20%D9%85%D9%84%DB%8C%20%D8%A7%D8%B7%D9%84%D8%A7%D8%B9%D8%A7%D8%AA%2014010116.pdf',
        '2022-10-10 15:53:38', '2022-10-10 15:53:38'),
       (44,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D8%B1%D8%A7%DB%8C%D9%86%D8%AF/%D8%AA%D8%B1%D8%AC%D9%85%D9%87/%D8%A7%D8%B9%D9%84%D8%A7%D9%85%DB%8C%D9%87%E2%80%8C%D8%A7%DB%8C%20%D8%A8%D8%B1%D8%A7%DB%8C%20%D8%A2%DB%8C%D9%86%D8%AF%D9%87%20%D8%A7%DB%8C%D9%86%D8%AA%D8%B1%D9%86%D8%AA%2014010230.pdf',
        '2022-10-10 15:53:54', '2022-10-10 15:53:54'),
       (45,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D8%B1%D8%A7%DB%8C%D9%86%D8%AF/%D8%B3%D9%86%D8%AF/%D8%A8%D8%B1%D9%86%D8%A7%D9%85%D9%87%20%D8%A8%D8%B3%D8%B7%20%D9%88%20%D8%AA%D8%B1%D9%88%DB%8C%D8%AC%20%D8%AD%D9%84%D9%82%D9%87%20%D9%87%D8%A7%DB%8C%20%D9%85%DB%8C%D8%A7%D9%86%DB%8C%2014010602.pdf',
        '2022-10-10 15:54:24', '2022-10-10 15:54:24'),
       (46,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D8%B1%D8%A7%DB%8C%D9%86%D8%AF/%D8%B3%D9%86%D8%AF/%D8%B3%D9%86%D8%AF%20%D8%AC%D9%87%D8%A7%D8%AF%20%D8%AA%D8%A8%DB%8C%DB%8C%D9%86%2014010226.pdf',
        '2022-10-10 15:54:39', '2022-10-10 15:54:39'),
       (47,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%88%D8%A7%D9%87%D9%86%DA%AF/%D8%B5%D9%88%D8%AA%201.mp3',
        '2022-11-24 10:44:48', '2022-11-24 10:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries`
(
    `id`         int(10) UNSIGNED NOT NULL,
    `title`      varchar(255) NOT NULL,
    `img_src`    text         NOT NULL,
    `status`     tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location_infos`
--

CREATE TABLE `location_infos`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `name`       varchar(255) NOT NULL,
    `index`      varchar(255) NOT NULL,
    `address`    varchar(255) NOT NULL,
    `phone`      varchar(255) NOT NULL,
    `cat_id`     int(10) UNSIGNED NOT NULL,
    `desc`       text         NOT NULL,
    `image`      longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`image`)),
    `video`      longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`video`)),
    `files`      longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`files`)),
    `status`     enum('1','0') NOT NULL DEFAULT '1',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_infos`
--

INSERT INTO `location_infos` (`id`, `name`, `index`, `address`, `phone`, `cat_id`, `desc`, `image`, `video`, `files`,
                              `status`, `created_at`, `updated_at`)
VALUES (8, 'location3', '2323', 'qdqwdqwq', '232323', 26, '<p>dfzsdf</p>',
        '[\"http:\\/\\/127.0.0.1:8000\\/uploads\\/mehr%20copy%201.jpg\"]',
        '[\"http:\\/\\/127.0.0.1:8000\\/uploads\\/bi-fold-square-brochure-mockup_69509-538.webp\"]',
        '[\"http:\\/\\/127.0.0.1:8000\\/uploads\\/mehr%20copy%201.jpg\",\"http:\\/\\/127.0.0.1:8000\\/uploads\\/mehr.jpg\"]',
        '1', '2023-01-03 08:14:24', '2023-01-04 04:40:16'),
       (9, 'location3', '2323', 'qdqwdqwq', '232323', 25, '<p>dfzsdf</p>',
        '[\"http:\\/\\/127.0.0.1:8000\\/uploads\\/mehr%20copy%201.jpg\"]',
        '[\"http:\\/\\/127.0.0.1:8000\\/uploads\\/bi-fold-square-brochure-mockup_69509-538.webp\"]',
        '[\"http:\\/\\/127.0.0.1:8000\\/uploads\\/mehr%20copy%201.jpg\",\"http:\\/\\/127.0.0.1:8000\\/uploads\\/mehr.jpg\"]',
        '0', '2023-01-03 08:15:03', '2023-01-03 15:01:02'),
       (10, 'location3', '2323', 'qdqwdqwq', '232323', 25, '<p>dfzsdf</p>',
        '[\"http:\\/\\/127.0.0.1:8000\\/uploads\\/mehr%20copy%201.jpg\"]',
        '[\"http:\\/\\/127.0.0.1:8000\\/uploads\\/05%20-%20%D9%85%D8%B9%DB%8C%D8%A7%D8%B1%D9%87%D8%A7%DB%8C%20%D8%A7%D9%86%D8%AA%D8%AE%D8%A7%D8%A8%20%D8%B2%D8%A8%D8%A7%D9%86%20%D8%A8%D8%B1%D9%86%D8%A7%D9%85%D9%87%20%D9%86%D9%88%DB%8C%D8%B3%DB%8C%20%D8%AF%D8%B1%D8%B3%D8%AA.mp4\"]',
        '[\"http:\\/\\/127.0.0.1:8000\\/uploads\\/mehr%20copy%201.jpg\"]', '0', '2023-01-03 08:15:15',
        '2023-01-03 16:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus`
(
    `id`          bigint(20) UNSIGNED NOT NULL,
    `name`        varchar(255) NOT NULL,
    `logo_image`  varchar(255) DEFAULT NULL,
    `status`      tinyint(1) NOT NULL DEFAULT 1,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL,
    `description` text         DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `logo_image`, `status`, `created_at`, `updated_at`, `description`)
VALUES (2, 'header', 'uploads/logos/1673262872_logo.png', 1, '2022-08-29 01:40:37', '2023-01-09 07:44:32', NULL),
       (3, 'footer', 'uploads/logos/1664869047_Frame 229.png', 1, '2022-08-29 07:25:51', '2022-12-06 09:45:58',
        '<p><strong>مرکز راهبردی فرهنگ و رسانه</strong></p><p>[حرکت] انقلابی باید باشد، بنیانی باید حرکت بشود، در عین حال برخاسته‌ی از اندیشه و حکمت باشد. فرهنگ واقعاً زیربنا است؛ خیلی از این خطاهایی که ما در بخش‌های مختلف انجام می‌دهیم، ناشی از فرهنگ حاکم بر ذهن ما است.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `menu_id`    bigint(20) UNSIGNED NOT NULL,
    `title`      varchar(255) NOT NULL,
    `index`      int(11) NOT NULL,
    `parent_id`  bigint(20) UNSIGNED DEFAULT NULL,
    `link`       varchar(255) NOT NULL,
    `status`     tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `icon`       varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `index`, `parent_id`, `link`, `status`, `created_at`, `updated_at`,
                          `icon`)
VALUES (86, 2, 'خانه', 0, NULL, '#', 1, '2023-01-09 08:16:39', '2023-01-09 08:16:39', NULL),
       (87, 2, 'صفحات', 0, NULL, '#', 1, '2023-01-09 08:17:01', '2023-01-09 08:17:01', '1'),
       (88, 2, 'درباره ما', 0, NULL, '#', 1, '2023-01-09 08:23:21', '2023-01-09 08:23:21', '2'),
       (89, 2, 'خدمات', 0, NULL, '#', 1, '2023-01-09 08:23:29', '2023-01-09 08:23:29', '3'),
       (90, 2, 'وبلاگ', 0, NULL, '#', 1, '2023-01-09 08:23:50', '2023-01-09 08:23:50', '4'),
       (91, 2, 'وبلاگ1', 0, 90, '#', 1, '2023-01-09 08:24:01', '2023-01-09 08:24:01', '4'),
       (92, 2, 'وبلاگ2', 0, 90, '#', 1, '2023-01-09 08:24:20', '2023-01-09 08:24:20', '4');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations`
(
    `id`        int(10) UNSIGNED NOT NULL,
    `migration` varchar(255) NOT NULL,
    `batch`     int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (1, '2014_10_12_000000_create_users_table', 1),
       (2, '2014_10_12_100000_create_password_resets_table', 1),
       (3, '2019_08_19_000000_create_failed_jobs_table', 1),
       (4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
       (5, '2022_06_23_203605_create_permission_tables', 1),
       (6, '2022_07_06_125230_create_menus_table', 1),
       (7, '2022_07_06_125331_create_menu_items_table', 1),
       (8, '2022_07_20_125151_create_type_category_table', 1),
       (9, '2022_07_21_084002_create_posts_table', 1),
       (10, '2022_07_21_130146_create_categories_table', 1),
       (11, '2022_07_21_130451_create_categoriables_table', 1),
       (12, '2022_07_21_161343_create_files_table', 1),
       (13, '2022_07_21_171649_create_post_file_table', 1),
       (14, '2022_08_18_104037_create_modules_table', 1),
       (15, '2022_09_03_095936_create_slider_table', 1),
       (19, '2022_10_01_074345_create_settings_table', 2),
       (20, '2022_12_01_113324_add_icon_to_menu_item_table', 2),
       (21, '2022_12_09_075047_create_contact_us_table', 2),
       (69, '2022_12_14_093605_create_subject_categories_table', 3),
       (70, '2022_12_14_100527_add_type_to_type_category_table', 3),
       (71, '2022_12_14_205242_create_aboat_us_table', 3),
       (72, '2022_12_16_214635_galleries', 3),
       (73, '2022_12_17_082114_create_location_infos_table', 3),
       (77, '2022_12_18_101314_add_content_to_subject_table', 4),
       (78, '2022_12_19_104544_add_image_to_category_table', 4),
       (80, '2022_12_25_110202_create_orders_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions`
(
    `permission_id` bigint(20) UNSIGNED NOT NULL,
    `model_type`    varchar(255) NOT NULL,
    `model_id`      bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles`
(
    `role_id`    bigint(20) UNSIGNED NOT NULL,
    `model_type` varchar(255) NOT NULL,
    `model_id`   bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`)
VALUES (1, 'App\\Models\\User', 1),
       (2, 'App\\Models\\User', 20),
       (4, 'App\\Models\\User', 19),
       (4, 'App\\Models\\User', 20);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `name`       varchar(255) NOT NULL,
    `content`    varchar(255) NOT NULL,
    `img_src`    varchar(255) NOT NULL,
    `status`     tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `multi_morph_posts`
--

CREATE TABLE `multi_morph_posts`
(
    `id`          int(10) UNSIGNED NOT NULL,
    `title`       varchar(255) NOT NULL,
    `content`     text         NOT NULL,
    `semiContent` text         NOT NULL,
    `tags`        longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
    `imageIndex`  varchar(255) NOT NULL,
    `status`      enum('active','deactivate','admin choice') NOT NULL DEFAULT 'active',
    `privacy`     enum('public','private') NOT NULL DEFAULT 'public',
    `audio`       text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `video`       text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `updated_at`  timestamp    NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp (),
    `created_at`  timestamp    NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders`
(
    `id`          bigint(20) UNSIGNED NOT NULL,
    `location_id` bigint(20) UNSIGNED NOT NULL,
    `user_id`     bigint(20) UNSIGNED NOT NULL,
    `start`       timestamp    NOT NULL DEFAULT current_timestamp(),
    `end`         timestamp    NOT NULL DEFAULT current_timestamp(),
    `desc`        varchar(255) NOT NULL,
    `code_order`  varchar(255) NOT NULL,
    `form_data`   varchar(255) NOT NULL,
    `status`      enum('active','deactivate','pending') NOT NULL DEFAULT 'pending',
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `location_id`, `user_id`, `start`, `end`, `desc`, `code_order`, `form_data`, `status`,
                      `created_at`, `updated_at`)
VALUES (1, 8, 19, '2023-01-10 14:53:51', '2023-01-03 14:53:51', '', '1', '1', 'active', NULL, '2023-01-09 15:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets`
(
    `email`      varchar(255) NOT NULL,
    `token`      varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `name`       varchar(255) NOT NULL,
    `guard_name` varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`)
VALUES (1, 'manage users', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (2, 'create users', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (3, 'view users', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (4, 'update users', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (5, 'delete users', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (6, 'manage role', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (7, 'create role', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (8, 'view role', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (9, 'update role', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (10, 'delete role', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (11, 'manage menu', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (12, 'create menu', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (13, 'view menu', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (14, 'update menu', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (15, 'delete menu', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (16, 'manage menu item', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (17, 'create menu item', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (18, 'view menu item', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (19, 'update menu item', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (20, 'delete menu item', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (21, 'manage category', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (22, 'create category', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (23, 'view category', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (24, 'update category', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (25, 'delete category', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (26, 'manage type category', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (27, 'create type category', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (28, 'view type category', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (29, 'update type category', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (30, 'delete type category', 'web', '2022-09-04 12:55:38', '2022-09-04 12:55:38'),
       (31, 'manage module', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (32, 'create module', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (33, 'view module', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (34, 'update module', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (35, 'delete module', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (36, 'manage post', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (37, 'create post', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (38, 'view post', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (39, 'update post', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (40, 'delete post', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (41, 'manage permission', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (42, 'create permission', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (43, 'view permission', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (44, 'update permission', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (45, 'delete permission', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (46, 'viwe files', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens`
(
    `id`             bigint(20) UNSIGNED NOT NULL,
    `tokenable_type` varchar(255) NOT NULL,
    `tokenable_id`   bigint(20) UNSIGNED NOT NULL,
    `name`           varchar(255) NOT NULL,
    `token`          varchar(64)  NOT NULL,
    `abilities`      text DEFAULT NULL,
    `last_used_at`   timestamp NULL DEFAULT NULL,
    `created_at`     timestamp NULL DEFAULT NULL,
    `updated_at`     timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts`
(
    `id`           int(10) UNSIGNED NOT NULL,
    `title`        text NOT NULL,
    `content`      text NOT NULL,
    `semiContent`  text NOT NULL,
    `tags`         longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
    `imageIndex`   text NOT NULL,
    `status`       enum('active','deactivate','admin choice') NOT NULL DEFAULT 'active',
    `privacy`      enum('public','private') NOT NULL DEFAULT 'public',
    `video`        text CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
    `audio`        text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `categoryType` int(11) DEFAULT NULL,
    `view_count`   int(11) DEFAULT NULL,
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `semiContent`, `tags`, `imageIndex`, `status`, `privacy`, `video`,
                     `audio`, `categoryType`, `view_count`, `created_at`, `updated_at`)
VALUES (2, 'برگزیدگان جشنواره‌های مدولباس تسهیلات دریافت می‌کنند',
        '<p>به گزارش خبرنگار مهر، سیدمجید امامی مسئول کارگروه مد و لباس با اشاره به اعطای تسهیلات چهار درصدی به برگزیدگان جشنواره‌های مد و لباس، گفت: از سوی کارگروه به برگزیدگان تا ۵۰۰ میلیون تومان تسهیلات اعطا می‌شود.</p><p>وی افزود: از طراحان حوزه مد و لباس بر اساس فرهنگ بومی منطقه حمایت خواهیم کرد و همچنین از برترین‌های جشنواره‌های استانی مد و لباس کشور برای ورود به دوازدهمین جشنواره مد و لباس فجر که اواخر امسال برگزار می‌شود، پشتیبانی می‌کنیم.</p><p>مسئول کارگروه مد و لباس با اشاره به ویژگی‌های جشنواره دوازدهم مد و لباس فجر گفت: مهمترین ویژگی و محور اصلی شرکت و مشارکت در جشنواره دوازدهم، ویژندها و گروه‌های لباس و گروه‌های کاری، هنری و فرهنگی است که توانسته اند اثری و لباسی را وارد بازار کنند، نه اینکه صرفاً نقاشی خاصی کشیده باشد.</p>',
        '<p>مسئول کارگروه مد و لباس از برگزاری جشنواره دوازدهم مد و لباس فجر در پایان سال خبر داد و گفت</p>',
        '[\"\\u0645\\u062f_\\u0648_\\u0644\\u0628\\u0627\\u0633\",\"\\u062a\\u0633\\u0647\\u06cc\\u0644\\u0627\\u062a\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/02.%20%D8%A7%D8%AE%D8%A8%D8%A7%D8%B1%20%DA%A9%D9%86%D8%A7%D8%B1%20%D8%A7%D8%B3%D9%84%D8%A7%DB%8C%D8%AF%D8%B1/3.jpg',
        'active', 'public', NULL, NULL, NULL, 0, '2022-09-04 12:59:57', '2022-11-03 14:10:41'),
       (9, 'تحول انقلابی برای بازسازی ساختار ضروری است.',
        '<p>محمد مهدی اسماعیلی روز پنجشنبه در هجدهمین نشست دبیران هم‌اندیشی دانشگاه‌های کشور که در مجتمع شهدای سلامت مشهد برگزار شد، بر اهمیت تغییر ریل گذاری حوزه های مختلف فرهنگی تاکید کرد و گفت: بر این باورم که باید برای اقدامات فرهنگی تغییر ریل صورت گیرد تا فضای فرهنگی در مسیر دستیابی به آرمان های متعالی انقلاب اسلامی قرار گیرد.<br>وی در ادامه افزود: داشته های فرهنگی باید در راستا و حمایت از اهداف انقلاب اسلامی باشد نه آنکه در نقطه مقابل با این اهداف متعالی قرار گیرد، از سوی دیگر بازسازی فرهنگی به معنای ادغام مجموعه های فرهنگی در یکدیگر نیست بلکه باید در ساختارهای فرهنگی تحول انقلابی صورت بگیرد.<br>وی گفت: باید با برنامه‌ریزی مدون شرایطی فراهم کرد که با توجه به بودجه ای که برای ترویج معارف اسلامی و هویت ایرانی اسلامی موجود است، بهترین خروجی ممکن را شاهد باشیم.</p>',
        '<p>محمد مهدی اسماعیلی روز پنجشنبه در هجدهمین نشست دبیران هم‌اندیشی دانشگاه‌های کشور</p>',
        '[\"\\u0628\\u0627\\u0632\\u0633\\u0627\\u0632\\u06cc\",\"\\u0633\\u0627\\u062e\\u062a\\u0627\\u0631\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/02.%20%D8%A7%D8%AE%D8%A8%D8%A7%D8%B1%20%DA%A9%D9%86%D8%A7%D8%B1%20%D8%A7%D8%B3%D9%84%D8%A7%DB%8C%D8%AF%D8%B1/1.jpg',
        'active', 'public', NULL, NULL, NULL, 10, '2022-09-05 03:33:41', '2022-11-03 04:18:54'),
       (17, 'نقشه مهندسی فرهنگی ملاک باشد، دوگانگی ایجاد نمی شود.',
        '<p>آیت‌الله لطف‌الله دژکام شنبه ۲۸ خرداد در جلسه شورای فرهنگ عمومی فارس با بیان اینکه دشمن به دنبال تبدیل مباحث فرهنگی به یک مسئله و مشکل است، عنوان کرد: دشمن به دنبال سازماندهی سرویس‌های خود برای تبدیل کردن مباحث فرهنگی ما به یک معضل است، بدین معنا که دشمن تمام امکانات خود را به کار گرفته تا فرهنگ به یک مسئله امنیتی تبدیل شود و ماجرا را به گونه‌ای دیگر مدیریت می‌کنند، لذا ما هم باید با همه امکانات به مقابله برویم.</p><p>او همچنین بیان کرد: در حوزه جنگ ترکیبی که عرصه‌های فرهنگی، امنیتی، اقتصادی و سیاسی با هم تداخل پیدا می‌کنند، خیلی زیرکی می‌خواهد که ما بحث فرهنگی را منطبق با نیازهای دیگر عرصه‌ها جلو ببریم.</p><p>وی بیان کرد: اگر نقشه مهندسی فرهنگی ملاک کار قرار دهیم دوگانگی بین فرهنگ و دیگر فاکتورها ایجاد نمی‌شود چون دشمن درصدد ایجاد دوگانگی بین فرهنگ و دیگر امور است‌.</p>',
        '<p>دشمن تمام امکانات خود را به کار گرفته تا</p>',
        '[\"\\u0646\\u0642\\u0634\\u0647_\\u0645\\u0647\\u0646\\u062f\\u0633\\u06cc\",\"\\u0641\\u0631\\u0647\\u0646\\u06af\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/02.%20%D8%A7%D8%AE%D8%A8%D8%A7%D8%B1%20%DA%A9%D9%86%D8%A7%D8%B1%20%D8%A7%D8%B3%D9%84%D8%A7%DB%8C%D8%AF%D8%B1/2.jpg',
        'active', 'private', NULL, NULL, NULL, 38, '2022-09-12 01:29:02', '2022-11-06 09:01:06'),
       (19, 'جهاد تبیین و نقش اساتید در دانشگاه اسلامی',
        '<p>دومین کارگاه هم‌اندیشی و دانش‌افزایی «جهاد تبیین و نقش اساتید در دانشگاه اسلامی»، ۲۳ خردادماه ۱۴۰۱ با حضور رئیس دانشگاه و جمعی از اعضای هیات علمی، در سالن جلسات مجتمع فرهنگی امام خمینی (ره) دانشگاه برگزار شد.</p><p>این سلسه کارگاه‌ها، ذیل دبیرخانه جهاد تبیین و اقدام دانشگاه علم و صنعت ایران و با هدف اجرایی‌سازی سند دانشگاه اسلامی در دانشگاه علم و صنعت ایران و در راستای تحقق تمدن اسلامی با هویت اسلامی-ایرانی، با مشارکت و دعوت از اساتید جوان انقلابی دانشگاه برگزار می‌شود.</p><p>در ابتدای این جلسه و پس از سرود ملی جمهوری اسلامی ایران و تلاوت آیاتی از کلام الله مجید، دکتر انبیاء (رئیس دانشگاه)، در خصوص اهمیت و ضرورت اسلامی شدن دانشگاه، نکاتی را پیرامون برخی مفاد سند دانشگاه اسلامی مصوب سال ۱۳۹۲ شورای عالی انقلاب فرهنگی، متذکر شد. وی با بیان این مطلب که نشان چندانی از اجرایی شدن این سند در دانشگاه‌ها در دست ندارد، اظهار داشت: احتمالا در اجرایی‌سازی این سند، یا همت کافی نشده یا به خلأهایی برخورد کرده بودند ولی اکنون همت کشور و بویژه نظر وزیر علوم، تحقیقات و فناوری این است که موضوع اسلامی شدن دانشگاه‌ها هر چه بیشتر جدی گرفته شود.</p><p>وی افزود: شورای عالی انقلاب فرهنگی، شورای دیگری با نام اسلامی شدن دانشگاه‌های بزرگ را ذیل خود دارد که دانشگاه علم و صنعت ایران به عنوان یکی از سه دانشگاه در مجموعه وزارت علوم و وزارت بهداشت، عضو این شوراست.</p><p>رئیس دانشگاه با تاکید بر اینکه برای اسلامی شدن دانشگاه‌ها ملازماتی نیاز است، تصریح کرد: اگر بپذیریم نیروی انسانی دانشگاه‌ها، یکی از عناصر مهم اسلامی کردن دانشگاه‌هاست؛ دانشگاه علم و صنعت ایران، از حیث اساتید دانشگاه، غنی‌ترین و قوی‌ترین دانشگاه در سطح کشور است. تقریبا صد در صد اساتید دانشگاه علم و صنعت ایران، هم علمی هستند و هم انقلابی و ما در این بُعد و در این مقطع زمانی، کمبودی نداریم اما ملازمات دیگر نیز نیاز است که بدیهی است باید از دل این جلسات، شناسایی و ابزار کار شود. وی تصریح کرد: این نهضت باید مداوم باشد چرا که شبهاتی که دیگران مطرح می‌کنند، همیشه بوده و هست لذا نباید باب اسلامی شدن دانشگاه‌ها را بست و این جلسات نیز باید مستمر باشند.</p><p>دکتر انبیاء با تاکید بر اینکه برای اسلامی شدن دانشگاه‌ها همه ما مسئولیت داریم و ابتدا باید موضوع، تبیین و سپس اقدام شود، گفت: ما در اسلامی کردن دانشگاه، ثابت‌قدم و جدی هستیم و در این راستا، ستاد تبیین و اقدام را در دانشگاه به ریاست مهندس نقره‌کار شکل داده‌ایم.</p>',
        '<p>دومین کارگاه هم‌اندیشی و دانش‌افزایی «جهاد تبیین و نقش اساتید در دانشگاه اسلامی»، ۲۳ خردادماه ۱۴۰۱ با حضور رئیس دانشگاه و جمعی از اعضای هیات علمی، در سالن جلسات مجتمع فرهنگی امام خمینی (ره) دانشگاه برگزار شد.</p>',
        NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/03.%20%D9%86%D8%B4%D8%B3%D8%AA/1.jpg',
        'admin choice', 'public', NULL, NULL, 5, 8, '2022-09-12 01:41:44', '2022-10-18 04:48:05'),
       (20, 'کووید 19 چه بر سر صنعت کتاب آورد',
        '<p>صنعت نشر به عنوان یکی از صنایع خالق و فرهنگ بنیان در سطح دنیا مورد توجه است. گسترش همه گیری کرونا و به دنبال آن تغییر در نوع مصرف محصوالت فرهنگی نگرانی هایی نسبت به همه صنایع از جمله صنعت نشر به وجود آورده است. اگرچه بررسی اثر کرونا بر صنعت نشر، نیازمند بررسی چند کشور در وضعیت های متفاوت و جمعبندی نهایی است اما توجه به وضعیت دو کشور انگلیس و ایاالت م تحده ، می تواند درک مناسبی به فعالین این حوزه ارائه دهد.</p>',
        '<p>در&nbsp;این&nbsp;گزارش&nbsp;به&nbsp;بررسی&nbsp;کرونا&nbsp;بر&nbsp;صنعت&nbsp;کتاب&nbsp;پرداختیم.</p>',
        '[\"\\u06a9\\u062a\\u0627\\u0628\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/04.%20%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/5.jpg',
        'active', 'private', NULL, NULL, 4, 29, '2022-09-12 01:45:26', '2022-11-24 10:50:47'),
       (21, 'نشست فرهنگی اساتید دانشگاه با موضوع \"بررسی تحولات اخیر روسیه و اوکراین',
        '<p>نشست فرهنگی اساتید دانشگاه با موضوع \"بررسی تحولات اخیر روسیه و اوکراین\" توسط آقای دکتر علی علیزاده (عضو هیات علمی دانشگاه دفاع ملی و کارشناس تحولات بین المللی) در روز دوشنبه ۲۳ اسفند ۱۴۰۰ به شکل مجازی برگزار گردید.</p><p>آقای دکتر علیزاده با اشاره به تاریخچه اختلافات روسیه و غرب در مورد عضویت کشور اوکراین در پیمان امنیتی ناتو و همچنین تاکید بر اشتراکات فرهنگی و مذهبی مردم اوکراین با کشور روسیه، به اهمیت ژئوپولتیک این کشور در منطقه پرداخت.</p><p>ایشان با تاکید به ظرفیت های اقتصادی بسیار بالای کشور اوکراین و نقشی که این کشور در توازن قدرت در منطقه می تواند بازی کند، به احتمال گسترش این بحران در منطقه تاکید کرده و خواستار هوشیاری و امادگی کشور ایران در این خصوص شدند.</p><p>آقای دکتر علیزاده در پایان با تبیین شرایط منطقه و احتمالات پیش روی این بحران به پرسش های حاضرین در این جلسه مجازی پاسخ گفتند.</p>',
        '<p>با&nbsp;توجه&nbsp;به تاریخچه اختلافات روسیه و غرب در مورد عضویت کشور اوکراین در پیمان امنیتی ناتو و همچنین تاکید بر اشتراکات فرهنگی و مذهبی مردم اوکراین با کشور روسیه، به اهمیت ژئوپولتیک این کشور در منطقه پرداختیم.</p>',
        '[\"\\u0628\\u0631\\u0648\\u0646_\\u0645\\u0631\\u0632\\u06cc\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/03.%20%D9%86%D8%B4%D8%B3%D8%AA/2.jpg',
        'admin choice', 'public', NULL, NULL, 5, 9, '2022-09-12 02:51:02', '2022-10-18 04:15:50'),
       (22, 'نشست فرهنگی مجازی با موضوع رابطه علم و دین',
        '<p>در این نشست که با حضور اساتید، کارمندان و علاقمندان به این موضوع تشکیل شده بود آقای دکتر منصوری لاریجانی با اشاره به آیات قران، انسان را جهان اکبر دانستند و به نمونه هایی از عظمت انسان پرداختند.</p><p>ایشان در ادامه به این نکته اشاره کردند که باید علوم تعلیمی با علوم باطنی تطبیق داده شود تا ما به مقام عالم ربّانی برسیم.</p><p>یکی از هدف های انقلاب اسلامی هم این بود که در دانشگاه ها علوم به سمت حکمت بنیان سوق داده شود.</p><p>آقای دکتر لاریجانی علم و دین را دارای تعارض ندانسته و این دو را دارای قلمرو مشترک تبیین کردند.</p><p>در پایان ایشان به پرسش های شرکت کنندگان پاسخ دادند.</p>',
        '<p>در این نشست که با حضور اساتید، کارمندان و علاقمندان به این موضوع تشکیل شده بود آقای دکتر منصوری لاریجانی با اشاره به آیات قران، انسان را جهان اکبر دانستند و به نمونه هایی از عظمت انسان پرداختند.</p>',
        '[\"\\u0648\\u062d\\u062f\\u062a_\\u062d\\u0648\\u0632\\u0647_\\u0648_\\u062f\\u0627\\u0646\\u0634\\u06af\\u0627\\u0647\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/03.%20%D9%86%D8%B4%D8%B3%D8%AA/3.jpg',
        'active', 'public', NULL, NULL, 5, 6, '2022-09-12 02:52:49', '2022-10-24 14:39:01'),
       (23, 'برنامه توسعه هفتم',
        '<p>قانون برنامهٔ پنجم <a href=\"https://fa.wikipedia.org/wiki/%D8%A8%D8%B1%D9%86%D8%A7%D9%85%D9%87_%D8%AA%D9%88%D8%B3%D8%B9%D9%87_%D8%A7%DB%8C%D8%B1%D8%A7%D9%86\">توسعه ایران</a>، پنجمین قانون توسعه پس از پیروزی <a href=\"https://fa.wikipedia.org/wiki/%D8%A7%D9%86%D9%82%D9%84%D8%A7%D8%A8_%D8%A7%D8%B3%D9%84%D8%A7%D9%85%DB%8C_%D8%A7%DB%8C%D8%B1%D8%A7%D9%86\">انقلاب ۵۷ ایران</a> است. این قانون برای تحقق سند <a href=\"https://fa.wikipedia.org/wiki/%DA%86%D8%B4%D9%85_%D8%A7%D9%86%D8%AF%D8%A7%D8%B2\">چشم انداز</a> ۱۴۰۴ تدوین شده است. این قانون ۲۳۵ ماده دارد و مادهٔ ۲۳۵ آن اعلام می‌کند که این قانون تا سال ۱۳۹۴ خورشیدی اعتبار دارد.</p>',
        '<p>..</p>', NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/05.%20%D8%A7%D8%B3%D9%86%D8%A7%D8%AF/1.jpg',
        'active', 'public', NULL, NULL, 7, 10, '2022-09-12 03:05:54', '2022-10-26 05:49:13'),
       (25, 'الزامات راهبردی عرصه تولید دانش‌بنیان',
        '<p>با&nbsp;توجه&nbsp;به&nbsp;اهمیت&nbsp;مطلب&nbsp;گزارشی&nbsp;آماده&nbsp;شده&nbsp;است.</p>',
        '<p>نباید&nbsp;اقتصاد&nbsp;دانش&nbsp;بنیان&nbsp;را&nbsp;به&nbsp;استارت&nbsp;اپ&nbsp;فروکاست.</p>', NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/04.%20%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/2.jpg',
        'active', 'public', NULL, NULL, 4, 18, '2022-09-12 03:46:48', '2022-11-24 10:51:29'),
       (26, 'ارزیابی دستورالعمل اجرای سیاست های توسعه فرهنگ و هنر در شبکه ملی اطلاعات',
        '<p>راهنما: متون داخل کادر، متن طرح و متون خارج از کادر، نکات ناظر به متن و سرفصل مرتبط آن است.</p>',
        '<p>هسته مقاومت، از اجتماع تعدادی از افراد جوانان انقالبی که بر مدار ایمان به غیب و حول فرمان امام، با هدف سرنگونی نظامهای طاغوتی و بسط عملی توحید، فعالیت گروهی و تشكیالتی انجام می دهند، شكل می گیرد. ....</p>',
        '[\"\\u0634\\u0628\\u06a9\\u0647_\\u0645\\u0644\\u06cc_\\u0627\\u0637\\u0644\\u0627\\u0639\\u0627\\u062a\",\"\\u0633\\u06cc\\u0627\\u0633\\u062a\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/04.%20%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/2.jpg',
        'active', 'public', NULL, NULL, 4, 12, '2022-09-12 05:22:59', '2022-10-26 16:44:04'),
       (27, 'قانون اساسی جمهوری اسلامی ایران 1401',
        '<p>متن پیشرو مصوب مجلس شورای اسلامی به سال هزار و چهارصد و یک می باشد.</p>',
        '<p>قانون اساسی جمهوری اسلامی در سال 1357 نوشته شده و به هر ده سال به تصویب مجلس شورای اسلامی گذاشته می شود.</p>',
        '[\"\\u0645\\u062c\\u0644\\u0633\",\"\\u0642\\u0627\\u0646\\u0648\\u0646_\\u0627\\u0633\\u0627\\u0633\\u06cc\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/05.%20%D8%A7%D8%B3%D9%86%D8%A7%D8%AF/2.jpg',
        'active', 'public', NULL, NULL, 7, 11, '2022-09-12 05:25:05', '2022-10-26 05:49:14'),
       (29, 'برنامه تحول وزیر فرهنگ و ارشاد اسلامی',
        '<p>محمد&nbsp;مهدی&nbsp;اسماعیلی&nbsp;برنامه&nbsp;چهار&nbsp;ساله&nbsp;خود&nbsp;را&nbsp;شرح&nbsp;داد.</p>',
        '<p>برنامه&nbsp;جهان&nbsp;آرا</p>',
        '[\"\\u062a\\u062d\\u0648\\u0644-\\u0633\\u0627\\u062e\\u062a\\u0627\\u0631-\\u0641\\u0631\\u0647\\u0646\\u06af\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%85%D8%A7%D9%87%D9%86%DA%AF/%D8%B9%DA%A9%D8%B3%20%D8%B4%D8%A7%D8%AE%D8%B5%201.jpg',
        'deactivate', 'public',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%85%D8%A7%D9%87%D9%86%DA%AF/1.mp4',
        NULL, 6, 3, '2022-09-24 02:52:19', '2022-11-27 11:28:41'),
       (30, 'قران، حلقه وصل',
        '<p>طبق گزارش مصرف فرهنگی خانوار در ۱۳۹۹، به‌طور میانگین ۱۳ دقیقه مطالعهٔ کتب غیردرسی سهم ایرانیان است. سرانهٔ مطالعهٔ ماهانه به‌طور متوسط ۸ ساعت و ١٨ دقیقه است. از این مقدار ۲ ساعت و ٣٢ دقیقه به مطالعهٔ قرآن و ادعیه و ۶ ساعت و ٣٢ دقیقه به مطالعهٔ کتب غیردرسی اختصاص دارد.</p><p>در طرح آمارگیری از فرهنگ رفتاری خانوار، خواندن قرآن و ادعیه از اولویت‌‌های افراد است. رمان، داستان‌های کوتاه بزرگ‌سالان، روان‌شناسی و تربیتی و موضوعات دینی در رتبه‌های بعدی قرار گرفته‌اند.</p><p>پیمایش میزان انس مردم با قرآن کریم در جلسهٔ صد و هجدهم مجمع مشورتی شورای توسعهٔ فرهنگ قرآنی در آبان ۱۴۰۰ برگزار شد. در این پیمایش، سرانهٔ قرائت در کشور برابر با ۱۰۹دقیقه در هفته و ۱۵دقیقه در روز عنوان شد. قرائت در شیعیان و اهل‌سنت و نیز در بین اقوام مختلف تقریباً همین مقدار بود و از این نظر تنوعی نداشت.</p><p>طبق آمار پیمایش <strong>PEW 2012</strong>، سرانهٔ مطالعهٔ دینی در کشورهای همسایه مانند عراق برابر با ۴۶درصد و اردن برابر با ۵۲درصد است. درصد مهمی از مسلمانان مصر، اندونزی نیز مطالعهٔ قرآن را در برنامه روزانه خود قرار داده‌اند.</p>',
        '<p>مسلمانان&nbsp;چقدر&nbsp;قرآن&nbsp;می&nbsp;خوانند.</p>', '[\"\\u0642\\u0631\\u0622\\u0646\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%82%D8%B4%20%D9%86%DA%AF%D8%A7%D8%B1/3.jpg0000644',
        'deactivate', 'public', NULL, NULL, 6, 6, '2022-09-24 03:49:46', '2022-11-24 10:53:31'),
       (32, 'اعلامیه ای برای آینده اینترنت',
        '<p>این&nbsp;متن&nbsp;توسط&nbsp;»دفتر فضای سایبر و سیاست دیجیتال« وزارت امورخارجه آمریکا&nbsp;منتشر&nbsp;و&nbsp;توسط&nbsp;مرکز&nbsp;راهبردی&nbsp;فرهنگ&nbsp;و&nbsp;رسانه&nbsp;ترجمه&nbsp;شده&nbsp;است.</p>',
        '<p>این&nbsp;متن&nbsp;توسط&nbsp;»دفتر فضای سایبر و سیاست دیجیتال« وزارت امورخارجه آمریکا&nbsp;منتشر&nbsp;و&nbsp;توسط&nbsp;مرکز&nbsp;راهبردی&nbsp;فرهنگ&nbsp;و&nbsp;رسانه&nbsp;ترجمه&nbsp;شده&nbsp;است.</p>',
        '[\"\\u0627\\u06cc\\u0646\\u062a\\u0631\\u0646\\u062a\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/04.%20%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/4.jpg',
        'active', 'public', NULL, NULL, 4, 19, '2022-09-28 12:45:31', '2022-10-26 16:44:05'),
       (33, 'برنامه بسط و ترویج حلقه های میانی',
        '<p>رهبر معظم انقالب، در دیدار با دانشجویان مورخ 1398/03/01&nbsp;موضوع حلقه&nbsp;های میانی را به&nbsp;عنوان سازوکار تحقق غایت انقلاب اسلامی یعنی تحقق تمدن نوین اسالمی عنوان کردند. به تعبیر ایشان، حلقه&nbsp;های میانی راهکار ایجاد حرکت عمومی منضبط با محوریت جوانان به سمت چشم&nbsp;انداز انقلاب اسلامی است. حلقه&nbsp;های میانی که متشکل از جوانانی از دل مردم، دغدغه&nbsp;مند و نخبه هستند، کلید به&nbsp;میدان&nbsp;آوردن ظرفیت&nbsp;های جدید و ایجاد اجماع در جامعه هستند. این حلقه&nbsp;ها هم نقش مهمی در تحقق دولت اسلامی دارند؛ از&nbsp;این&nbsp;جهت که مطالبه&nbsp;گر، ناظر بر دولت (به معنای عام)، زبان گویای مشکلات مردم و ارائه&nbsp;دهنده راهکارهای خلاقانه برای حل مسائل هستند، و هم نقش ویژهای در تحقق جامعه اسالمی دارند؛ به این معنا که الگویی برای تک&nbsp;تک آحاد مردم در زمینه جهاد مخلصانه در مسیر پیشرفت اسلامی-ایرانی و تحقق آرمانهای بلند الهی هستند. متأسفانه با گذشت بیش از سه سال از ایده مهم رهبر معظم انقالب درخصوص سازوکار تحقق تمدن نوین اسالمی، هنوز تشکیل و فعالیت حلقه&nbsp;های میانی در ابتدای مسیر خود قرار دارد. نوشته پیش رو در پی ارائه برنامه&nbsp;ای جهت بسط و ترویج حلقه&nbsp;های میانی است. پیشنهاد میشود به&nbsp;منظور روشن&nbsp;شدن ابعاد و جایگاه مسئله، گفتمان رهبر معظم انقلاب در ارتباط با موضوع »تمدن نوین اسالمی«، »بیانیه گام دوم انقالب اسالمی« و »بیانات در دیدار با دانشجویان مورخ 1398/03/01» مطالعه شود.</p>',
        '<p>سازوکار تحقق غایت انقلاب اسلامی</p>', NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/04.%20%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/3.jpg',
        'active', 'public', NULL, NULL, 4, 1, '2022-09-28 13:34:45', '2022-10-26 16:44:07'),
       (34, 'سند جهاد تبیین',
        '<p>جمهور ی اسالمی، در پی حکمرانی مبتنی بر مبانی معنوی است و مهمتر ین غایت آن یعنی تشکیل تمدن نوین اسالمی، از جنس فرهنگ، گفتمان و هدایت دلها است؛ لذا مقوله بیان و تبیین یکی از اساسیتر ین پیشرانهای نیل بهغایت مذکور است. رهبر معظم انقالب با ترسیم صحنه نبرد و اقدامات سخت و نرم دشمن، »جهاد تبیین« را بهمنظور خنثیساز ی توطئهها و تحقق آرمانها در کشور مطرح فرمودند. تبیین میتواند در دو حوزه حقیقت و واقعیت محقق شود. تبیین حقیقت در راستای نهادینه کردن و مطالبهگر ی آرمانها و تبیین واقعیت در راستای رفع شبهات و ارائه تصویر درست از صحنه نبرد و مسائل تار یخی و روز است. نوشته پیش رو، در پی ایجاد بستر ی برای گفتمانساز ی و ترویج صحیح جهاد تبیین از مسیر خیزش مردمی بهمنظور نیل به تمدن نوین اسالمی است.</p>',
        '<p>مأموریت، تعریف، فرایند، اهداف، سیاستها، راهبردها و اقدامات</p>',
        '[\"\\u062c\\u0647\\u0627\\u062f_\\u062a\\u0628\\u06cc\\u06cc\\u0646\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/04.%20%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/3.jpg',
        'active', 'public', NULL, NULL, 4, 4, '2022-09-28 13:36:33', '2022-10-26 16:44:09'),
       (35, 'خانواده سالم',
        '<p>این وبینار مجازی در روز دوشنبه ۱۸ اسفند ماه ۱۳۹۹ و با سخنرانی حجت الاسلام و المسلمین جناب آقای سید جواد بهشتی برگزار شد.</p><p>سوابق سخنران:</p><p>مؤلف ۱۰ عنوان کتاب</p><p>مدیرکل دفتر قرآن و عترت وزارت آموزش و پرورش در امور عترت و نماز</p><p>مشاور وزیر آموزش و پرورش در امور عترت و نماز</p><p>از تدوین‌گران محتوایی «درس‌هایی از قرآن» حجت‌الاسلام قرائتی</p><p>کارشناس برجسته و مشاور فرهنگی و علمی ستاد اقامه نماز کشور</p><p>کارشناس برنامه های فرهنگی و دینی به ویژه در عرصه برنامه‌های قرآنی صدا و سیما</p>',
        '<p>به همت دفتر ترویج فعالیت های قرآن و عترت و مدیریت ارتباطات فرهنگی و اجتماعی معاونت فرهنگی دانشگاه علم و صنعت ایران وبینار مجازی نشست فرهنگی قران و خانواده سالم برگزار گردید.</p>',
        '[\"\\u062e\\u0627\\u0646\\u0648\\u0627\\u062f\\u0647\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/03.%20%D9%86%D8%B4%D8%B3%D8%AA/4.jpg',
        'active', 'public', NULL, NULL, 5, 8, '2022-09-28 13:44:42', '2022-10-24 14:39:12'),
       (36, 'گزارش سومین  وبینار مجموعه( طرحی برای فردای بهتر) با نام \" طراحی آینده، زندگی پساکرونا\"',
        '<p>گزارش سومین وبینار مجموعه( طرحی برای فردای بهتر) با نام \" طراحی آینده، زندگی پساکرونا\"</p><p>توسط دکتر شاهین فرهنگ</p><p>پنجشنبه ۹۹/۲/۱۸ ساعت ۱۷:۰۰ الی ۱۹:۰۰</p><p>در ابتدا و پس از قرائت قران و پخش سرود ملی و کلیپ های مناسبتی، وبینار با خیر مقدم آقای دکتر شیرزادی، مدیر محترم مرکز مشاوره و سلامت دانشگاه آغاز گردید.</p><p>ایشان پس از تبریک میلاد امام حسن (ع) و تشکر از فعالیت ها و حمایت های آقای دکتر ارجمندی، معاون فرهنگی واجتماعی دانشگاه، به اقدامات صورت گرفته در مرکز مشاوره دانشگاه، در خصوص شرایط پیش آمده پرداخت. که راه اندازی مرکز مشاوره تلفنی رایگان، یکی از اقدامات این مرکز برای کمک به همه اعضاء دانشگاه می باشد.</p><p>پس از آقای دکتر شیرزادی، آقای دکتر شاهین فرهنگ، روانشناس و پژوهشگر، سخنان خود را آغاز نمودند.</p><p>ایشان در ابتدا با اشاره به حضور خود در جبهه های جنگ ایران و عراق، یادی کردند از دوستانی که شربت شهادت نوشیده و دیگر بین ما نیستند.</p><p>سپس در ادامه با اشاره به داستانی از مثنوی، قصه دیدار لیلی و مجنون را مطرح کرده و به این نتیجه رسیدند که عاشق واقعی نباید لحظه ای از معشوقش غافل شده و با همه وجود به دنبال هدف هایش باشد.</p><p>در قسمت بعدی ایشان با اشاره به شرایط پیش آمده، بیماری کرونا را یک بزنگاه تاریخی دانست، که ما باید برای پس از آن خود را آماده کنیم.</p><p>درست است که تعدادی از انسان ها در این مورد دچار آسیب شدند و حتی جانشان را از دست دادند، اما بیماری کرونا به هر حال تمام می شود و بهتر است ما برای شرایط پس از کرونا آمده شویم. این آزمونی است که پس از آن ما متوجه درس هایش می شویم.</p><p>دکتر فرهنگ، بدست آوردن و از دست دادن را از الزامات رشد دانسته و به برنامه یزی برای بعد از بیماری کرونا تاکید کردند.</p><p>سپس ایشان به این نکته اشاره کردند که ما وقتی وارد صَفی می شویم، آرام آرام به قسمت های جلو صف می رسیم. در مورد هدف های زندگی هم باید صبور باشیم تا کم کم مراحل رشد تا طی کنیم.</p><p>در ادامه و با اشاره با داستان \"آلیس در سرزمین عجایب\" به این نکته اشاره کردند که وقتی در زندگی نمی دانیم کجا می خواهیم برویم، فرقی نمی کند از کدام سمت برویم. تردیدها همیشه به ما آسیب می زند.</p><p>همه ی ما فِرفِره را دیده ایم. فِرفِره بعد از حرکت بسیار، در نهایت همان جایی هست که در آغاز بوده و این حکایت بعضی از ما انسان هاست که هدف مشخصی برای کارهایمان نداریم و به همین دلیل رشدی هم اتفاق نمی افتد. بر اساس آماری که دانشگاه استنفورد ارائه کرده، حدود نود و هفت درصد مردم دنیا هدف مشخصی در زندگی ندارند.</p><p>دکتر فرهنگ با اشاره به وجود بادهای موافق و مخالف در دریا، رسیدن به مقصد را نتیجه حرکت کشتی و قرار گرفتن در مسیر باد موافق دانستند. کشتی هایی که از جای خود حرکت نمی کنند، وجود باد موافق و مخالف برای آنها معنایی ندارد.</p><p>در ادامه ایشان از شرکت کنندگان در وبینار خواستند تا پنج هدف خود در زندگی را بر اساس اولویت بنویسند. سپس اشاره کردند که اولویت دادن به خواسته ها به ما کمک می کند تا توجه بیشتری به هدف هایمان داشته باشیم. بعضی از ما نمی توانیم به سادگی هدف های زندگی مان را بنویسیم، به این دلیل که بیشتر روی چیزهایی که نمی خواهیم متمرکز شده ایم تا چیزهایی که می خواهیم.</p><p>سپس تاکید کردند برای رسیدن به موفقیت باید به این سه نکته توجه کنیم: مقصد / هدف / آرزو</p><p>مقصد خواسته من است، ما می توانیم مقصدمان از زندگی را آرامش، خوشبختی، کمال، موفقیت و ... قرار دهیم. ما باید مقصد را به هدف و سپس به آرزو تبدیل کنیم. مقصد به خودی خود دست یافتنی نیست.مقصد باید واضح و شفاف باشد.آرزوها نیز تیرهای در کمان هستند که باید پرتاب شوند تا به هدف برسند. هدف را باید از دل آرزوها بیرون آورد.</p><p>اما هدف چیست: هدف خواسته ایست دقیق و روشن، که بمحض اعلام و بارها پس از آن ذهن ما را درگیر می کند تا به آن برسیم. هدف هر چقدر دقیق تر تعریف شده باشد، احتمال رسیدن به آن بیشتر است.</p><p>در زندگی هر وقت دقیقا چیزی را خواسته ایم به آن رسیده ایم. فقط باید تا حد امکان هدف را مشخص تر کنیم. هدف مثل برگ ی چکّی می ماند که باید حتما تاریخ و مبلغ آن را به شکل دقیق بنویسیم تا نقد شود.</p><p>ایشان در ادامه اشاره کردند که، انسان های موفق به خواسته هاشون تکیه می کنند و انسان های ناموفق به داشته هاشون. اگر ما به خواسته هامون تکیه کنیم، کم کم داشته ها را پیدا می کنیم.</p><p>دکتر فرهنگ با مثال هایی از زندگی اشخاصی که نقص عضو داشتند، اما توانستند کارهای بزرگی انجام دهند، ادامه دادند که این اتفاق ها تنها با داشتن هدف و پشتکار اتفاق افتاده است. ما باید به بهترین شکل از داشته هامون استفاده کنیم.</p><p>ایشان سه ویژگی را برای اهداف مشخص کردند. اولین ویژگی این است که اهداف ما باید روشن و دقیق باشند.چه می خواهیم و کی می خواهیم؟</p><p>دومین ویژگی اهداف این است که باید شکرگزار باشیم، ولی به کم راضی نشویم. در واقع اهداف بلندی را برای خود تعریف کنیم.حضرت علی(ع) فرمودند: به آنچه دارید شاکر و به آنچه می خواهید مشتاق باشید. ما انسان ها مخلوقات گران قیمت خداوندیم و لایق بهترین داشته ها.</p><p>سومین ویژگی اهداف این است که باید هم به موضوعات مادّی ما توجه کند و هم به موضوعات معنوی. اهداف ما نباید یک بعدی باشد.</p><p>سپس ایشان به سه فیلتر برای رسیدن به اهداف اشاره کردند. یک: اهمیت و ضرورت هدف دو: استعداد در هدف سه: علاقمندی.</p><p>دکتر فرهنگ با اشاره به اهمیت داشتن پشتکار، سه ویژگی را برای داشتن آن برشمردند.</p><p>یک: با مقدار کم شروع کنیم دو: مدام به دامنه کار اضافه کنیم و سوم: انتهای کار را تعیین کنیم.</p><p>از آنجا که هر انسان در شبانه روز با حدود ۵۰ هزار فکر مواجه است، باید هدف های خود را بنویسید تا بتواند بر روی آنها مسلط شود.</p><p>در ضمن ما باید هدف های بلند مدت را به قسمت های کوچک تقسیم کنیم. تا با دریافت نتایج، نسبت به ادامه مسیر دلگرم شویم.</p><p>حضرت علی (ع) فرمودند: \" بزرگ فکر کنید، ولی کوچک عمل کنید\"</p><p>در قسمت بعد ایشان به دو نکته بسیار مهم اشاره کردند، که هر کسی باید همیشه بخاطر داشته باشد.</p><p>یک: یادمان باشد آدم های موفق بیشتر از آدم های ناموفق شکست خورده اند.</p><p>دو: آدم های موفق هیچ وقت تسلیم نمی شوند و کسانی که تسلیم می شوند، هیچ وقت موفق نمی شوند.</p><p>در بخش پایانی نیز ایشان به تعدادی از سوالات شرکت کنندگان پاسخ دادند.</p><p>سوالاتی نیز از مطالب سخنرانی طرح و در کانال های گروهی دانشجویی ودانشگاهی برای شرکت در مسابقه قرار گرفت. در این وبینار حدود ۳۰۰ نفر از دانشگاهیان حضور داشتند، که تعدادی از آنها به همرا خانواده در این سخنرانی شرکت داشتند.</p><p>پس از پایان این وبینار نیز، جلسه ای با شرکت دکتر فرهنگ، دکتر ارجمندی(معاون فرهنگی و اجتماعی) و دکتر شیرزادی( مدیر مرکز مشاوره و سلامت) در خصوص موضوعات فرهنگی دانشگاه برگزار شد و موارد فرهنگی مورد بحث و گفت و گو قرار گرفت.</p><p> </p>',
        '<p>در ابتدا و پس از قرائت قران و پخش سرود ملی و کلیپ های مناسبتی</p>',
        '[\"\\u0622\\u06cc\\u0646\\u062f\\u0647\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/03.%20%D9%86%D8%B4%D8%B3%D8%AA/5.jpg',
        'active', 'public', NULL, NULL, 5, 9, '2022-09-28 13:46:28', '2022-10-24 14:40:09'),
       (37, 'سلسله نشست های فرهنگی با دانشجویان خارجی',
        '<p>به گزارش روابط عمومی دانشگاه آزاد اسلامی اردبیل و به نقل از مدیر کل فرهنگی و اجتماعی این دانشگاه، در این جلسه که درقالب \"سلسله نشست های فرهنگی با دانشجویان خارجی\" تدارک دیده شده است، هریک از دانشجویان به معرفی خود پرداخته و نقطه نظرات خود را بیان کردند.<br>این دانشجویان فضای علمی خوب، اساتید مجرب، امکانات رفاهی مناسب و برخورد پدرانه همه مسئولان دانشگاه را از مزایای واحد اردبیل عنوان کرده و نواقصات جزئی در مورد خوابگاه را بیان کردند که بلا فاصله با حضور در محل خوابگاه این موارد هم برطرف شد.<br>در این جلسه حجت الاسلام جلیلی مسئول نهاد رهبری دانشگاه ضمن خوش آمد گویی به این دانشجویان گفت: فرصت بهره مندی از تعامل فرهنگی کشور ها به وسیله دانشجویان غیر ایرانی حاصل شده و بسیار حائز اهمیت است و امیدوارم دانشجویان نیز از این فرصت و ظرفیت های فاخر فرهنگی بین کشور ها استفاده کرده و داشته های کشور خود را به یکدیگر معرفی کنند.<br>محمد تقی معصومی، معاون فرهنگی دانشجویی دانشگاه هم با ابراز خرسندی از حضور این دانشجویان برای تحصیل در واحد اردبیل گفت: فرصت تحصیل در شهر اردبیل به عنوان شهر دینی و مذهبی یک فرصت برای کسب معارف عمیق دینی و اسلامی درکنار تحصیل دانشگاهی است.<br>وی ادامه داد: بعد از ماه مبارک رمضان در قالب یک تور سیاحتی، ظرفیت ها و مکانهای دیدنی شهر اردبیل برای این دانشجویان معرفی خواهد شد.</p>',
        '<p>به گزارش روابط عمومی دانشگاه آزاد اسلامی اردبیل</p>', '[\"\\u0641\\u0631\\u0647\\u0646\\u06af\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/03.%20%D9%86%D8%B4%D8%B3%D8%AA/6.jpg',
        'active', 'public', NULL, NULL, 5, 9, '2022-09-28 13:47:53', '2022-10-18 04:15:55'),
       (38, 'الگوی پایه‌ی اسلامی ایرانی پیشرفت', '<p>منتشر&nbsp;شده&nbsp;توسط&nbsp;…</p>',
        '<p>ترسم&nbsp;دورنما،&nbsp;آن&nbsp;هم&nbsp;برای&nbsp;برنامه&nbsp;و&nbsp;افق&nbsp;پیشرفت&nbsp;یک&nbsp;کشور&nbsp;در&nbsp;یک&nbsp;کلمه&nbsp;یعنی</p>',
        NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/05.%20%D8%A7%D8%B3%D9%86%D8%A7%D8%AF/1.jpg',
        'active', 'public', NULL, NULL, 7, 7, '2022-09-28 14:06:13', '2022-10-26 05:49:16'),
       (39, 'سند راهبردی جمهوری اسلامی ایران در فضای مجازی- اهداف و اقدامات کلان',
        '<p>منتشر&nbsp;شده&nbsp;توسط&nbsp;مرکز&nbsp;ملی&nbsp;فضای&nbsp;مجازی</p>',
        '<p>سند راهبردي جمهوري اسالمي ايران در فضاي مجازي در افق 1111 در چهار بخش ارزشها، چشمانداز، اهداف و اقدامات کالن تنظيم شده است. اين سند از طريق مطالعه اسناد راهبردي و چشمانداز ساير کشورها در حوزه فضاي مجازي، تحليل وضع موجود و مطلوب، تحليل اسناد باالدستي )قانون اساسي، سند چشمانداز و احکام مقام معظم رهبري)مدظلهالعالي( براي شوراي عالي فضاي مجازي کشور( و اخذ نظر مراکز علمي، پژوهشي و دانشگاهي کشور و دستگاههاي دولتي و حکومتي و سازمانهاي مرتبط با فضاي مجازي تنظيم شده است. دو بخش ارزشها و چشمانداز اين سند، در هفتادويکمين جلسه مورخ 71/30/7033 و دو بخش اهداف و اقدامات کالن آن در هشتادوچهارمين جلسه مورخ 77/30/7037 شوراي عالي به تصويب رسيد</p>',
        NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/05.%20%D8%A7%D8%B3%D9%86%D8%A7%D8%AF/1.jpg',
        'active', 'public', NULL, NULL, 7, 3, '2022-09-28 14:08:24', '2022-10-26 05:49:17'),
       (42, 'تحلیل کلان طرح حمایت از حقوق کاربران و خدمات پایه کاربردی فضای مجازی',
        '<p>وضعیت کنونی حکمرانی و سیاستگذاری فضای مجازی ایران به عللی همچون «تشتّت و تعارض نهادی»، «ناپایداری سیاست های کلان»، «عدم انعطاف در سیاست های خرد»، «غلبه نگاه فنی-تکنیکی در امر حکمرانی» و «بی توجهی نسبت به زمینه های اجتماعی در امر سیاستگذاری» با نقطه مطلوب فاصله زیادی دارد؛ لذا بازطراحی ساختار کلان نهادی-تقنینی ضروری است. در بازطراحی ساختار مذکور باید ملاحظاتی همچون پرهیز از افزایش زاویه هنجاری حاکمیت-مردم، پرهیز از دامن زدن به تکثر نهادی و نیز انجام تفکیک نهادی دولایه  سیاستگذاری کلان و خرد موردتوجه قرار گیرد؛ بنابراین لازم است که طرح مجلس با نام «حمایت از حقوق کاربران و خدمات پایه کاربردی فضای مجازی» مورد تجدیدنظر اساسی قرار گیرد.</p><h3><strong>ضرورت و اهداف پژوهش</strong></h3><p>اهمیت روزافزون و نقش پررنگ فضای مجازی در زیست فردی و اجتماعی انسان ها سبب شده که حکمرانی فضای مجازی به یکی از ابعاد بسیار مهم حکمرانی تبدیل شود. بررسی قوانین مجلس شورای اسلامی نشان  می دهد که به غیراز قوانین ناکارآمدی مانند، قانون جرائم رایانه ای (مصوب ۱۳۸۸)، قانون اثرگذاری در این زمینه وجود ندارد. مصوبات شورای عالی فضای مجازی نیز به علل مختلف ازجمله فقدان ضمانت اجرایی لازم، نتوانسته این خلا را پوشش دهد؛ همچنین رشد و توسعه سرویس ها و پلتفرم های چندملیتی که ازلحاظ قدرت اقتصادی، سیاسی و فرهنگی می توانند اقتدار دولت های ملی-محلی را به چالش بکشند، سبب شده که چالش های مختلفی بر سر راه حکمرانی ملی نسبت به فضای مجازی شکل بگیرد. علاوه بر مسائل فوق که در تمام کشورها کم وبیش به چشم می خورد، چالش های خاصی همچون تعارض و تشتّت نهادی وجود دارد که گریبان گیر نظام حکمرانی فضای مجازی ایران شده است. طرح مجلس با نام «حمایت از حقوق کاربران و خدمات پایه کاربردی فضای مجازی» (نسخه ۲۶ تیرماه ۱۴۰۰) تلاش کرده تا این خلا را جبران نماید. این طرح دارای اشکالات اساسی است که ممکن است چالش های مذکور را تشدید نماید. پژوهش حاضر، تحلیلی کلان از ساختار نهادی و تقنینی مطلوب کشور ارائه می نماید، سپس نسبت طرح مجلس با آن را بررسی می کند و درنهایت، پیشنهادهایی برای اصلاح این طرح ارائه می نماید.</p><h3><strong>علل ناکامی نظام حکمرانی فضای مجازی در رسیدن به اهداف</strong></h3><p>حکمرانی فضای مجازی را می توان در سه لایه زیرساختی (ارتباطی و اطلاعاتی)، خدمات (سرویس ها و پلتفرم ها) و محتوا تصویر کرد. بررسی  سیاستگذاری و حکمرانی جمهوری اسلامی ایران در این سه ساحت نشان می دهد که نظام حکمرانی فضای مجازی در رسیدن به اهداف تعیین شده برای آن چندان موفق نبوده است. علل این ناکامی را می توان در مسائل زیر دسته بندی کرد:</p><ul><li><strong>تشتّت و تعارض نهادی:</strong> در ساختار نهادی کنونی تشتّت و تعارض نهادی زیادی به چشم می خورد. تاسیس شورای عالی فضای مجازی و نهادهای وابسته به آن همچون مرکز ملی فضای مجازی نیز نتوانسته به نحو مؤثری مسائل حکمرانی فضای مجازی را سامان دهد. همچنین این شورا معمولا از سوی دولت به عنوان تهدیدی برای اختیاراتش شناخته می شود و به همین علت دولت‎ معمولا همکاری لازم با آن را ندارد؛</li><li><strong>ناپایداری در سیاست های کلان و عدم انعطاف در سیاست های&nbsp;خرد: </strong>پویایی و ناپایداری عرصه فضای مجازی اقتضا می کند که در سیاست های خرد انعطاف و چابکی لازم وجود داشته باشد. به همین علت لازم است که سیاست های کلان حاکم بر شیوه تنظیم ‎گری در نهاد تقنینی عالی به تصویب برسد و اختیار تنظیم گری و وضع مقررات جزئی تر به یک نهاد تنظیم گر سپرده شود؛</li><li><strong>غلبه نگاه فنی-تکنیکی و غفلت از سایر منظرهای حکمرانی:</strong> نگاه حاکم بر بخش عمده ای از نظام حکمرانی نسبت به فضای مجازی نگاهی فنی- تکنیکی است که سبب شده آسیب های متعددی در شیوه حکمرانی نسبت به فضای مجازی ایجاد شود. بر این اساس، اولا حکمرانی به منظر فنی-تکنیکی آن تقلیل داده می شود و ثانیا از ابعاد مهمی از سرویس ها و پلتفرم های فضای مجازی (خصوصاً ابعاد فرهنگی و اجتماعی آن ها) غفلت می شود؛</li><li><strong>بی</strong> <strong>توجهی نسبت به زمینه های اجتماعی و افکار عمومی در امر سیاست‎گذاری: </strong>در بسیاری از موارد در امر سیاستگذاری فضای مجازی، مردم و کاربران نادیده انگاشته می شوند و به اقتضائات، نیازها و علائق آن ها کم توجهی می شود. این نقیصه سبب می شود که به مرور سرمایه های اجتماعی نظام با خطر آسیب مواجه شود؛</li><li><strong>نزاع منافع بین سیاست گذاران و ذی‎نفعان مختلف:</strong> منافع مالی دولت و سایر ذی نفعان عیان و پنهانی که در امر سیاست‎گذاری دخیل هستند، سبب شده که نزاع سختی بر سر منافع در این زمینه شکل بگیرد. علاوه بر مسائل اقتصادی در حوزه ترافیک خارجی و داخلی، کشمکش های سیاسی متعددی بین نهادهای سیاست گذار و مجری در این عرصه وجود دارد که سبب شده در عصر همگرایی رسانه ای، نوعی «واگرایی نهادی» به وجود آید.</li></ul><h3><strong>ملاحظات موردتوجه در طراحی ساختار مطلوب</strong></h3><p>در طراحی ساختار مطلوب باید ملاحظات زیر موردتوجه قرار گیرد:</p><ul><li>راه حل سیاستی نباید زاویه هنجاری حاکمیت_مردم را افزایش دهد. همچنین هنجارهای حاکمیتی باید فاصله متعادلی با هنجارهای واقعی جامعه داشته باشد؛</li><li>از دامن زدن به تکثر نهادی و ایجاد تشتّت و تعارض نهادی بیشتر پرهیز شود و به جای آن از ظرفیت های نهادی بالقوه و بالفعل موجود استفاده شود؛</li><li>تا حد امکان نهاد ابر تنظیم ‎گر (Super Regulator) حاکمیتی باشد و خارج از دولت شکل بگیرد؛</li><li>با توجه به اقتضائات متفاوت دو لایه کلان و خرد سیاست‎گذاری لازم است که تفکیک نهادی نیز در این عرصه صورت گیرد؛ یعنی لایه کلان سیاست‎گذاری به یک نهاد و لایه خرد به نهاد دیگر واگذار شود.</li></ul><h3><strong>راه حل پیشنهادی به منظور  سیاستگذاری خرد و کلان</strong></h3><p>با توجه به ملاحظات بیان شده، برای سیاست‎گذاری کلان می توان به سازوکارهایی همچون سازوکار شورای عالی تکیه کرد، اما در  سیاستگذاری خرد به نهادی پویا، چابک و تخصصی نیاز است. بر این اساس، طراحی نهادی سه سطحی زیر پیشنهاد می شود:</p><ol><li>«نهاد تقنینی عالی» که اصول، چهارچوب ها و خطوط کلی عمل نهادهای تنظیم گر را مشخص نماید؛ «شورای عالی فضای مجازی» این نقش را بر عهده دارد؛</li><li>«نهاد ابرتنظیم گر» با اختیارات تقنینی مشخص که در چهارچوب خطوط کلی معین شده برای آن از طریق ابزارهای مختلف تنظیم گری اعم از ابزارهای تقنینی، اقتصادی و غیره، به همه ابعاد حکمرانی فضای مجازی-اعم از فنی، زیرساختی، اقتصادی، اجتماعی و فرهنگی- می پردازد. این نهاد ذیل نهاد تقنینی عالی فعالیت می کند و به آن پاسخگوست؛ «مرکز ملی فضای مجازی» این نقش را بر عهده دارد؛</li><li>نهادهای اجرایی و تنظیم گران بخشی که بر اساس چهارچوبی که نهاد ابر تنظیم گر وضع می کند، عمل خواهند کرد.</li></ol><p>طرح مجلس باید مبتنی بر این ساختار، مورد تجدیدنظر اساسی قرار گیرد و بر این اساس، اولا طراحی نهادی فوق مبنای کار قرار گیرد و ثانیا کلیه مداخلات جزئی موجود در آن حذف شود.</p><h3><strong>نسبت «طرح مجلس» و «راه حل پیشنهادی»</strong></h3><p>نسبت و تفاوت طرح مجلس با راه حل پیشنهادی فوق در قالب دو منظر ارائه خواهد شد:</p><ul><li><strong>از منظر ایده محوری طرح مجلس</strong>: در طرح مجلس یک نهاد عالی تقنینی جدید (کمیسیون عالی تنظیم مقررات) به دو نهاد عالی تقنینی پیشین (مجلس شورای اسلامی و شورای عالی فضای مجازی) افزوده شده است. به عللی می توان این نهاد تقنینی جدید را فی‎نفسه اثربخش تر از شورای عالی فضای مجازی دانست، اما درعین حال وجود آن به تشتّت و تعارض نهادی دامن می‎زند. عدم وجود یک سازمان ابرتنظیم گر، اصلی ترین خلا در زمینه حکمرانی فضای مجازی است که در طرح مجلس تدبیر صحیحی برای آن صورت نگرفته است. لازم به ذکر است که «کمیسیون عالی تنظیم مقررات» به علت ساختار شورایی آن نمی تواند نقش تنظیم گر یا ابرتنظیم گر را عهده دار شود؛</li><li><strong>از منظر مداخلات جزئی مدون در طرح مجلس</strong>: در طرح مجلس، مداخلات جزئی فراوانی وجود دارد. بر اساس مدل مطلوبی که ترسیم شد، نهاد تقنینی عالی نباید به مداخلات جزئی بپردازد، زیرا اولاً در عمل، دولت به ورودهای جزئی مجلس اعتنا نمی کند و در صورت فشار بیش ازحد، به راه حل های فرا قوه ای نظیر شورای عالی سران قوا متمسک می شود و ثانیاً ورودهای جزئی وابسته به اقتضائات زمانی-مکانی و شرایط اجتماعی و فرهنگی متعدد است.</li></ul><h3><strong>جمع بندی</strong></h3><p>اهمیت روزافزون و نقش پررنگ فضای مجازی در زیست فردی و اجتماعی انسان ها سبب شده که حکمرانی فضای مجازی به یکی از ابعاد بسیار مهم حکمرانی تبدیل شود. در این پژوهش با بررسی مسائله سیاستی، به چالش های مهم حکمرانی و  سیاستگذاری فضای مجازی اشاره شد؛ سپس بر اساس آن، ساختار نهادی-تقنینی مطلوب در این حوزه پیشنهاد شد. بر اساس این ساختار، شورای عالی فضای مجازی نقش نهاد سیاست گذار عالی و مرکز ملی فضای مجازی نقش ابرتنظیم گر را بر عهده دارد. سپس طرح مجلس با این ساختار مقایسه شد و بر اساس آن پیشنهاد شد که اولا ساختار نهادی ارائه شده در طرح مجلس مبتنی بر این ایده اصلاح شود و ثانیا کلیه مداخلات جزئی طرح مجلس (مداخلاتی که بر عهده تنظیم گر است) حذف شود.</p>',
        '<p>ضعیت کنونی حکمرانی و سیاستگذاری فضای مجازی ایران به عللی همچون «تشتّت و تعارض نهادی»، «ناپایداری سیاست های کلان»، «عدم انعطاف در سیاست های خرد»، «غلبه نگاه فنی-تکنیکی در امر حکمرانی» و «بی توجهی نسبت به زمینه های اجتماعی در امر سیاستگذاری» با نقطه مطلوب فاصله زیادی دارد؛ لذا بازطراحی ساختار کلان نهادی-تقنینی ضروری است. در بازطراحی ساختار مذکور باید ملاحظاتی همچون پرهیز از افزایش زاویه هنجاری حاکمیت-مردم، پرهیز از دامن زدن به تکثر نهادی و نیز انجام تفکیک نهادی دولایه سیاستگذاری کلان و خرد موردتوجه قرار گیرد؛ بنابراین لازم است که طرح مجلس با نام «حمایت از حقوق کاربران و خدمات پایه کاربردی فضای مجازی» مورد تجدیدنظر اساسی قرار گیرد.</p>',
        '[\"\\u0641\\u0636\\u0627\\u06cc_\\u0645\\u062c\\u0627\\u0632\\u06cc\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/05.%20%D8%A7%D8%B3%D9%86%D8%A7%D8%AF/3.jpg',
        'active', 'public', NULL, NULL, 7, 6, '2022-10-09 06:10:35', '2022-10-26 05:49:18'),
       (44, 'حافظ؛ ستاره فرهنگ ایرانی',
        '<p>چگونه&nbsp;باید&nbsp;این&nbsp;قله&nbsp;فرهنگ&nbsp;ایرانی&nbsp;را&nbsp;زنده&nbsp;کرد&nbsp;؟</p>',
        '<p>بیانات&nbsp;رهبر&nbsp;انقلاب</p>', NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%85%D8%A7%D9%87%D9%86%DA%AF/%D8%B9%DA%A9%D8%B3%20%D8%B4%D8%A7%D8%AE%D8%B5%20%D8%AD%D8%A7%D9%81%D8%B8.jpg0000644',
        'active', 'public',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%85%D8%A7%D9%87%D9%86%DA%AF/%D8%AD%D8%A7%D9%81%D8%B8.mp4',
        NULL, 6, 1, '2022-10-10 16:06:57', '2022-10-25 01:34:21'),
       (45, 'سند بازسازی انقلابی ساختار فرهنگی کشور نهایی شد.',
        '<p>در اولین قدم با انتشار فراخوان توسط وزیر محترم فرهنگ و ارشاد اسلامی به عموم مردم، اقدام به جمع آوری نظرات مردم نمود..</p>',
        '<p>مرکز راهبردی فرهنگ و رسانه در راستای اهداف خود، بعد از فرمان مقام معظم رهبری مبنی بر بازسازی انقلابی ساختار فرهنگی کشور، آغاز به تدوین پیش نویس این برنامه نمود.</p>',
        '[\"\\u0641\\u0631\\u0647\\u0646\\u06af\",\"\\u0633\\u0627\\u062e\\u062a\\u0627\\u0631\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A7%D8%AE%D8%A8%D8%A7%D8%B1/%D8%A7%D8%AE%D8%A8%D8%A7%D8%B1%20%D9%85%D8%B1%DA%A9%D8%B2/%D8%B9%DA%A9%D8%B3%201.jpg',
        'active', 'public', NULL, NULL, NULL, 7, '2022-10-12 13:09:24', '2022-11-06 08:42:50'),
       (46, 'جلسه  مدیران و کارشناسان رسانه و فضای مجازی حوزه و مرکز ملی فضای مجازی  کشور در قم برگزار شد.',
        '<p><strong>حوزه/ جلسه&nbsp; مدیران و کارشناسان رسانه و فضای مجازی حوزه و مرکز ملی فضای مجازی&nbsp; کشور در قم برگزار شد.</strong></p><p>به گزارش خبرنگار&nbsp;<a href=\"https://www.hawzahnews.com/\">خبرگزاری حوزه</a>، نشست مدیران و کارشناسان رسانه و فضای مجازی حوزه و نمایندگان برخی نهادهای حوزوی با مرکز ملی فضای مجازی صبح امروز پنج‌شنبه ۵ خرداد در سالن آیت الله حائری مرکز مدیریت حوزه های علمیه در قم برگزار شد.</p><p><strong>* ماجرای شکل‌گیری شورای عالی فضای مجازی کشور</strong></p><p>قاسم خالدی معاون فرهنگی، اجتماعی و امور محتوایی مرکز ملی فضای مجازی در این نشست به سیر شکل‌گیری شورای عالی و مرکز ملی فضای مجازی کشور اشاره کرد و بیان داشت: با عبور از وبِ۱ به وبِ۲ و رواج وبلاگ‌نویسی، تحول بزرگی در کشور شکل گرفت. البته برخی از مسئولان وقت کشور برداشت دقیقی از ماجرا نداشتند اما همان ایام، رهبر معظم انقلاب با اشاره به فرصت‌ها و تهدیدهای این موضوع برای جامعه تاکید کرده بودند که مورد توجه جوانان قرار خواهد گرفت.</p><p>وی فقدان یک قرارگاه برای تمرکز فعالیت‌ها در عرصه نت را خلأ آن دوران دانست و اظهار داشت: در همان ایام دوگانه فرصت و تهدید بودن اینترنت مطرح شد که برخی عامدانه و برخی سهوا به آن دامن می‌زدند اما خروجی جلسات در سطح کلان کشور منجر به شکل‌گیری شورای عالی فضای مجازی و مرکز ملی فضای مجازی شد و در یکی از جلسات مربوط به این موضوع در همان سال‌ها بود که رهبری فرمودند: اهمیت فضای مجازی به اندازه انقلاب اسلامی است.</p><p>خالدی افزود: برای بسیاری از شوراهایی که تشکیل می‌شود یک دبیرخانه در نظر می‌گیرند اما به جهت اهمیتی که این موضوع داشت، یک «مرکز» شکل گرفت تا کارها را با قوت بیشتری پیش ببرد.</p><p> </p><p><strong>* دولت‌ها به شورای عالی فضای مجازی بها نمی‌دهند</strong></p><p>معاون مرکز ملی فضای مجازی گفت: البته در دولت‌های مختلف، این شورا و این مرکز از جایگاه ویژه خود برخوردار نبوده است.</p><p>وی در ادامه با بیان دیدگاه‌های رهبر معظم انقلاب نسبت به این مرکز، بیان داشت: در پیوست حکم ایشان و در پی‌نوشت‌هایی که در مصوبات مختلف شورای عالی فضای مجازی داشتند، کاملا نگاهشان به شورای عالی فضای مجازی و مرکز ملی مشخص است و ماموریت‌ها کاملا واضح است که عبارت از تقسیم کار بین دستگاه‌ها، هماهنگی بین دستگاه‌ها ، نظارت و ارزیابی بر آنچه که در این حوزه در کشور اتفاق می‌افتد ، ترسیم نقشه راه جمهوری اسلامی توسط شورای عالی فضای مجازی و مدیریت و رهبری آن توسط مرکز ملی فضای مجازی است. و ماموریت های عملیاتی نیز در عرصه تولید محتوا بر عهده مرکز ملی گذاشتند اما باید اعلام کنیم ما طی نه سال گذشته نتوانستیم مرکز ملی فضای مجازی را آن طوری که مقام معظم رهبری تاکید داشتند به جایگاه خودش یعنی قرارگاه فرماندهی فضای مجازی برسانیم.</p><p><strong>* نمره قبولی نمی‌گیریم</strong></p><p>وی افزود: مرکز ملی وشورای عالی فضای مجازی در حوزه پر کردن خلأهای قانونی و اسناد بالا دستی این حوزه به عنوان کارشناس نمره خوبی دارد. چون توانسته است خلأها را خوب شناسایی کند و برای آنها سندنویسی کند اما در اینکه چه کسی به این سندها عمل می‌کند و آن را عملیاتی می‌کند و نقش مرکز ملی به عنوان ناظر و ارزیاب چیست؟ قطعا در این مورد نمره قبولی نمی‌گیرد.</p><p> </p><p><strong>* نسبت بین دین و فضای مجازی؛ مهم اما مغفول</strong></p><p>خالدی به نسبت بین دین و فضای مجازی اشاره کرد و گفت: یکی از نکات بسیار مهمی که مغفول مانده و یک ماموریت بسیار مهم دارد و آن هم بحث دین است و ما نتوانستیم این موضوع اصلی را در فضای مجازی تبیین کنیم و یک اقدام مؤثر داشته باشیم؛ تا ندانیم نسبت دین با فضای چیست و این نسبت را چگونه باید برقرار کنیم، هیچ کاری موفق نخواهد شد.</p><p>وی در پایان گفت: اقدامات خوبی شکل گرفته و زحمات بسیار زیادی در این سال‌ها انجام شده، اما برآیند این زحمات و اقدامات، برآیند قابل قبولی نیست.</p><p> </p><p><strong>* همه می‌خواهند همه کارها را انجام دهند!</strong></p><p>در ابتدای این نشست حجت‌الاسلام محمدرضا برته مسئول مرکز رسانه و فضای مجازی حوزه‌های علمیه موضوع نشست را ظرفیت‌شناسی و آشنایی با فرصت‌ها و توانمندی‌های مراکز حوزوی در عرصه تولید محتوا و رسیدن به فرایندهای مشترک با مرکز ملی فضای مجازی کشور دانست و ابراز داشت: حوزه علمیه به معنای عامش یعنی تمام نهادهای حوزوی، رسالت بزرگی در عرصه دین و دینداری دارد و باید کارهای جدی انجام بگیرد.</p><p>وی اظهار داشت:‌ گاهی تعدد نهادها منجر به این می‌شود که همه می‌خواهند همه کارها را انجام دهند و عملا تقسیم کار و تمرکز بر روی مزیت‌های نسبی انجام نمی‌گیرد که این نشست‌ها می‌تواند تا حدی این آسیب را بکاهد و تعریف پروژه‌های مشترک را به دنبال داشته باشد.</p><p>در این جلسه کارشناسان به بیان دیدگاه های خود پرداختند و ضمن بیان ظرفیت‌ها و مزیت‌های نسبی خود در عرصه فضای مجازی، به آسیب‌شناسی مرکز ملی فضای مجازی کشور پرداختند و بر ضرورت بازتعریف مأموریت و کنشگری این مرکز برای عبور از موانع موجود و ایجاد فرصت‌های نوین تاکید کردند.</p><p>خبرنگار: رضا ابدالی</p><p> </p>',
        '<p>به گزارش خبرنگار&nbsp;<a href=\"https://www.hawzahnews.com/\">خبرگزاری حوزه</a>، نشست مدیران و کارشناسان رسانه و فضای مجازی حوزه و نمایندگان برخی نهادهای حوزوی با مرکز ملی فضای مجازی صبح امروز پنج‌شنبه ۵ خرداد در سالن آیت الله حائری مرکز مدیریت حوزه های علمیه در قم برگزار شد.</p>',
        NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D9%86%D8%B4%D8%B3%D8%AA/%D9%86%D8%B4%D8%B3%D8%AA%20%D8%AE%D8%A7%D8%B1%D8%AC/%D9%86%D8%B4%D8%B3%D8%AA%207.jpg',
        'active', 'public', NULL, NULL, 5, 1, '2022-10-12 13:22:05', '2022-10-12 19:39:17');
INSERT INTO `posts` (`id`, `title`, `content`, `semiContent`, `tags`, `imageIndex`, `status`, `privacy`, `video`,
                     `audio`, `categoryType`, `view_count`, `created_at`, `updated_at`)
VALUES (47, 'انفجار مشاغل در فضای مجازی',
        '<p>رئیس مرکز ملی فضای مجازی گفت: در آینده نزدیک با انفجار مشاغل در فضای مجازی روبرو هستیم و با اجرای پروژه‌هایی مثل اینترنت اشیاء و با سرمایه‌گذاری‌هایی که در کشورهای بزرگ مثل سرمایه‌گذاری هزار میلیارد دلاری آمریکا برای صنعت نیمه هادی در حال انجام است، به زودی شاهد انفجار سخت‌افزاری در فضای مجازی نیز خواهیم بود.</p><p>به گزارش ایسنا از مرکز ملی فضای مجازی، سید ابوالحسن فیروزآبادی - دبیر شورای عالی و رئیس مرکز ملی فضای مجازی کشور با حضور در شورای اداری و شورای فضای مجازی استان مازندران اظهار کرد: فضای مجازی ابعاد متعددی دارد و به عنوان پیشران سایر بخش‌های کشور، توسعه آن از ضررویات زندگی امروز در جهان محسوب می‌شود.</p><p>وی با اشاره به این که باید از فرصت‌های فضای مجازی استفاده کرده و از تهدیدها و آسیب‌های آن جلوگیری کرد، ادامه داد: فضای مجازی برای مردم فرصت‌ساز بوده و فعالیت‌های بسیاری توسط مردم در این فضا شکل گرفته است، بنابراین دولت وظیفه دارد به مردم در این فضا کمک کند و اگر این فرصت برای مردم فراهم نشود، سکوهای خارجی با ارزش‌ها، هنجارها و قوانین خود مردم ایران را در خدمت خواهند گرفت.</p><p>فیروزآبادی با بیان این که شعار تضعیف دولت‌ها در فضای مجازی صحیح نیست، تاکید کرد: دولت در حقیقت خادم مردم است و فضای مجازی هم یک فضای اجتماعی است، بنابراین همه کاربران در این فضا می‌توانند تبدیل به فعال اقتصادی، فرهنگی، اجتماعی، آموزشی و صنفی شوند. از طرفی با توجه به ظهور پدیده‌هایی همچون توسعه رسانه‌های اجتماعی و تشکل های مردم نهاد در این فضا، باید نوع نگرش ما در دولت مطابق با مقتضیات این فضا اصلاح شود.</p><p>دبیر شورای عالی فضای مجازی در ادامه تشریح کرد: صاحبان سکوها، می‌توانند میلیون‌ها نفر را ساماندهی کنند و سبک زندگی کاربران خود را شکل دهند، به همین دلیل ما توصیه داریم تا آنجایی که ممکن است سکوها و برنامه‌ها در داخل کشور طراحی شود تا توان ملی ما در اختیار سکوهای خارجی قرار نگیرد و نیازهای بانکی، آموزشی،رسانه ای، فرهنگی، اجتماعی و حتی بیمه ای شهروندان بر روی سکوهای خارجی تامین نشود.</p><p> وی با تاکید بر دولت به مثابه پلت فرم تصریح کرد: دولت باید شرایطی فراهم کند تا هر فردی که می‌خواهد فعالیتی در فضای مجازی داشته باشد، بتواند از سکوهای داخلی استفاده کند و این اقدام منشاء اشتغال بسیار در کشور و رونق اقتصادی خواهد بود.</p><p>فیروز آبادی گفت: متاسفانه نه تنها در برخی مواقع شاهد تسهیل فعالیت مردم در این فضا از سوی دولت ها نبودیم بلکه با نوعی انفعال روبرو هستیم و متولی مشخصی در بسیاری از حوزه هایی که در فضای واقعی قوانین و چارچوب های مشخص دارند نداریم.<br> </p><p><strong>نبود بخش خصوصی توانمند در حوزه فضای مجازی</strong></p><p>دبیر شورای عالی فضای مجازی اعلام کرد: در بسیاری از کشورها بخش خصوصی به دنبال بهره‌مندی از فرصت‌هاست اما در ایران بخش خصوصی توانمند در این حوزه نداریم که این مهم باعث شده که در زمینه شکل گیری سکوها ضعف داشته باشیم و بعضا با عدم وجود قانون و مقرره صحیح در این فضا روبرو باشیم که باید هرچه سریعتر در مسیر اصلاح آن و استفاده از پتانسیل های موجود در کشور گام برداشته شود.</p><p>وی با اشاره به این که فضای مجازی توسعه دهنده اقتصاد جهانی است، افزود: در حال حاضر ۲۴۰۰ هزار نفر در یک شبکه خارجی در داخل فعالیت دارند که اگر این فعالان در سکوی داخلی هدایت و حمایت شوند، بازار اقتصادی رونق خواهد یافت. این در حالی است که در شبکه‌های خارجی نظام پرداخت و احراز هویت وجود ندارد که درصورت فعال‌سازی سکوهای داخلی و ایجاد این نظام ها بر روی آنها ما شاهد افزایش بیشتر رونق اقتصاد کشور خواهیم بود.</p><p>رئیس مرکز ملی فضای مجازی گفت: در آینده نزدیک با انفجار مشاغل در فضای مجازی روبروه ستیم و با اجرای پروژه هایی مثل اینترنت اشیا و با سرمایه گذاری هایی که در کشورهای بزرگ همچون سرمایه گذاری هزار میلیارد دلاری در آمریکا برای صنعت نیمه هادی در حال انجام است، به زودی شاهد انفجار سخت افزاری در فضای مجازی نیز خواهیم بود که این ها برای بکارگیری در زندگی بشری نیاز به نرم‌افزارهای کاربردی دارند که در هر کشور باید توسط مردم آن کشور بومی سازی شود و اگر در ساختار دولتی این اصلاحات انجام نشود، فقط مصرف کننده بوده و پیرو سبک زندگی غربی خواهیم شد.</p><p>وی با اشاره به این که ضمن توجه به آسیب‌های این فضا همچون اخبار جعلی و ایمن سازی آن باید فرصت‌های آن مورد توجه باشد، اظهار کرد: از جمله خصوصیات این فضا که در ایران فرصت ساز خواهد بود، نرم افزار، جوان پسندی و دانش بنیان بودن آن است که ما در عصر تاریخی در ایران قرار داریم که سرشار از جوانان تحصیل کرده و خلاق است که دولت باید به جای ایجاد موانع بر سر راه آنها با تمام ارکان خود به فکر ایجاد فعالیت های سالم برای آنها باشد چراکه در غیر این صورت نظام سیلویی دولت به پایان راه خود نزدیک شده و وارد نظام شبکه ای می شود.</p><p>رئیس مرکز ملی فضای مجازی تاکید کرد: ایجاد اشتغال در این حوزه سرمایه گذاری بسیاری پایینی نیاز دارد و این به دلیل شرایط فعلی کشور که رشد دارایی و سرمایه در آن پایین است، بسیار حائز اهمیت است، چرا که علاوه بر این، بازگشت سرمایه در آن نیز بسیار سریع بوده و زیر یک سال اتفاق خواهد افتاد.<br> </p><p>دبیر شورای عالی فضای مجازی گفت: دولت الکترونیکی، فقط مجازی کردن خدمات نیست و پس از آمادگی الکترونیکی نیاز به همه گیری آن است که ما در آمادگی الکترونیکی متوقف شده ایم؛ در حالی که مردم با استفاده از فضای مجازی همه گیری آن را از طریق سیستم‌های هوشمند در دسترس خود ایجاد کردند، بنابراین دولت باید متناسب با این تحولی که در جامعه اتفاق افتاده، بستر لازم برای فعال‌سازی مردم در این فضا به غیر از حوزه‌های سرگرمی و خبری را ایجاد کند.</p><p> </p>',
        '<p>به گزارش ایسنا از مرکز ملی فضای مجازی، سید ابوالحسن فیروزآبادی - دبیر شورای عالی و رئیس مرکز ملی فضای مجازی کشور با حضور در شورای اداری و شورای فضای مجازی استان مازندران اظهار کرد: فضای مجازی ابعاد متعددی دارد و به عنوان پیشران سایر بخش‌های کشور، توسعه آن از ضررویات زندگی امروز در جهان محسوب می‌شود.</p>',
        NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D9%86%D8%B4%D8%B3%D8%AA/%D9%86%D8%B4%D8%B3%D8%AA%20%D8%AE%D8%A7%D8%B1%D8%AC/%D9%86%D8%B4%D8%B3%D8%AA%208.jpg',
        'active', 'public', NULL, NULL, 5, 9, '2022-10-12 13:23:08', '2022-10-25 01:33:43'),
       (48, 'اصلاح یک فرهنگ غلط', '<p>بیانات&nbsp;مقام&nbsp;معظم&nbsp;رهبری</p>',
        '<p>مسئله&nbsp;تولید&nbsp;و&nbsp;اقتصاد&nbsp;که&nbsp;کشور&nbsp;را&nbsp;چند&nbsp;سال&nbsp;معطل&nbsp;خود&nbsp;نگه&nbsp;داشته&nbsp;است،&nbsp;لنگ&nbsp;یک&nbsp;مسئله&nbsp;فرهنگی&nbsp;است!</p>',
        '[\"\\u0641\\u0631\\u0647\\u0646\\u06af\",\"\\u0627\\u0635\\u0644\\u0627\\u062d\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%85%D8%A7%D9%87%D9%86%DA%AF/%D8%B9%DA%A9%D8%B3%20%D8%B4%D8%A7%D8%AE%D8%B5%20%D9%81%D8%B1%D9%87%D9%86%DA%AF%20%D8%BA%D9%84%D8%B7.jpg',
        'active', 'public',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%85%D8%A7%D9%87%D9%86%DA%AF/%D8%B9%DA%A9%D8%B3%20%D8%B4%D8%A7%D8%AE%D8%B5%20%D9%81%D8%B1%D9%87%D9%86%DA%AF%20%D8%BA%D9%84%D8%B7.jpg',
        NULL, 6, 1, '2022-10-12 13:27:13', '2022-10-15 08:54:03'),
       (49, 'آیا سینما در مسیر سالم شدن قدم برمی‌دارد؟',
        '<p>دههٔ هفتاد دههٔ باشکوه هالیوود بود؛ دهه‌ای که&nbsp; فیلمی چون پدرخوانده را در کارنامه خود دارد. اما این دهه آغازگر موج جدیدی از فیلم‌هایی نیز بود که به صراحت به موضوع روابط نامشروع، انتقام و خشونت بی‌حدوحصر می‌پرداختند. در فیلم‌های این دهه سه شاخص صحنه‌های ترسناک، خشونت و روابط جنسی به اوج خود رسید.</p><p>دههٔ هشتاد آغاز ورود هیولاها، دایناسورها و موجوات ماورایی و ارواح به سینما بود. پارک ژوراسیک اسپیلبرگ&nbsp;نمونه‌ای از این فیلم‌ها بود.</p><p>اواخر دهه نود ماتریکس&nbsp;پا به دنیای هالیوود گذاشت؛ فیلمی که دروازهٔ ورود فیلم‌های آخرالزمانی به سینما بود.</p><p>در این نمودار، خشونت، برهنگی و صحنه‌های ترسناک در سینمای هالیوود، کم‌رنگ‌تر شده و توهین و مصرف مواد مخدر تقریباً هیچ رشد و نزولی نداشته است. اما آمار موجود در روزنامه گاردین ۲۰۱۶ با آمار سایت <strong>IMDB</strong> تناقض دارد. طبق آمار این روزنامه، برهنه شدن بازیگران زن در مقابل دوربین، سه‌برابر بیشتر از بازیگران مرد بود.</p>',
        '<p>دههٔ هفتاد دههٔ باشکوه هالیوود</p>', NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%82%D8%B4%20%D9%86%DA%AF%D8%A7%D8%B1/2.jpg0000644',
        'active', 'public', NULL, NULL, 6, NULL, '2022-10-12 13:29:45', '2022-10-19 08:59:42'),
       (50, 'همه چیز در خدمت فرهنگ !',
        '<p>آیا&nbsp;این&nbsp;مسئله&nbsp;نقظه&nbsp;قوت&nbsp;فرهنگ&nbsp;است&nbsp;؟<br>این&nbsp;ظرفیت&nbsp;عظیم&nbsp;چه&nbsp;مقدار&nbsp;کار&nbsp;می&nbsp;طلبد؟</p>',
        '<p>بیانات&nbsp;مقام&nbsp;معظم&nbsp;رهبری</p>', NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%88%D8%A7%D9%87%D9%86%DA%AF/1.jpg',
        'active', 'public', NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%88%D8%A7%D9%87%D9%86%DA%AF/%D8%B5%D9%88%D8%AA%201.mp3',
        6, NULL, '2022-10-12 13:32:05', '2022-10-25 01:33:56'),
       (51, 'گونه شناسی و تحلیل کمی مسائل مخاطبان و کاربران اینستاگرام در ایران',
        '<p><strong>ضرورت و اهداف پژوهش</strong></p><p>رشد روزافزون اینستاگرام که مبتنی بر ارسال و به اشتراک گذاری عکس و ویدئو است، نشانه افزایش جذابیت رسانه های اجتماعی تصویری و افزایش علاقمندی کاربران به آن ها محسوب می شود. اینستاگرام تنها عرصه بازنمایی زندگی شخصی نیست، بلکه به محلی برای بیان دیدگاه های سیاسی، مذهبی و پیگیری کسب و کار تجاری و بازاریابی تبدیل شده است. همچنین اینستاگرام برخلاف سایر شبکه های اجتماعی نظیر فیسبوک، توییتر، یوتیوب و… در ایران به طور مطلق فیلتر نیست. یکی از دلایل محبوبیت اینستاگرام در سال های اخیر نیز می تواند همین مورد باشد. با توجه به محبوبیت اینستاگرام در ایران و تعداد بالای کاربران آن، ضروری است که ابعاد مختلف مصرف این رسانه مورد تحقیق و تحلیل قرار بگیرد.</p><p>با توجه به ویژگی های منحصربه فرد شبکه اجتماعی اینستاگرام، طیف متنوعی از کاربران با ویژگی های فردی، اجتماعی و فرهنگی مختلف از آن استفاده می کنند. هدف اصلی مطالعه حاضر، بررسی میزان مصرف اینستاگرامی و تحلیل سبک زندگی کاربران در اینستاگرام و گونه شناسی مخاطبان و کاربران اینستاگرام در ایران می باشد.</p><p><strong>روش شناسی پژوهش</strong></p><p>در مطالعه حاضر برای دستیابی به هدف مذکور از روش کمی پیمایش و از تکنیک پرسشنامه برای گردآوری داده ها استفاده شده است. جامعه آماری مطالعه حاضر کلیه کاربران شبکه اجتماعی اینستاگرام در کشور است. در مطالعه حاضر نمونه آماری تعداد کاربران شبکه اجتماعی برای شهر تهران ۳۸۴ نفر و برای مراکز سایر استان ها ۶۰۰ نفر می باشد.</p><p><strong>اینستاگرام؛ رسانه ای مغفول در مطالعات پیشین</strong></p><p>مطالعات داخلی به گونه شناسی کاربران اینترنت و شبکه&nbsp; های اجتماعی و به طور خاص کاربران فیسبوک، تلگرام و یوتیوب پرداخته اند. با توجه به ماهیت متفاوت اینستاگرام (از منظر تصویری بودن) در مطالعات داخلی انگیزه کاربران اینستاگرام مورد بررسی قرار نگرفته است و گونه شناسی از کاربران اینستاگرام و فراوانی تیپ های مختلف کاربران وجود ندارد. مطالعات تجربی انجام شده در کشور بر انگیزه استفاده از شبکه های مجازی و اینترنت تاکید دارندکه از مهم ترین این انگیزه ها می توان به «تقویت و توسعه ارتباطات اجتماعی»، «ابراز احساسات و عواطف»، «پرسه زنی مجازی در قالب گذران اوقات فراغت و سَرَک کشی به عرصه عمومی-خصوصی کاربران فضای مجازی»، «آزادی بیان و خود افشاگری» و «اطلاع یابی و اطلاع رسانی» اشاره کرد.</p><p><strong>میزان استفاده کاربران از اینستاگرام</strong></p><p>میزان استفاده کاربران از شبکه اجتماعی اینستاگرام روزانه تقریبا ۱۰۴ دقیقه است که تقریبا ۳۹% کاربران کمتر از یک ساعت، تقریبا ۳۹% کاربران بین یک تا سه ساعت و تقریبا ۲۲% کاربران بیش از سه ساعت از این شبکه ی اجتماعی استفاده می کنند. بر طبق آمارهای داخلی به دست آمده از شبکه های اجتماعی ۲.۹% کاربران فقط از یک شبکه اجتماعی،۲۹.۷% کاربران از دو شبکه اجتماعی، ۵۳.۸% کاربران از سه شبکه اجتماعی شامل (تلگرام، واتس آپ و اینستاگرام) و ۱۳.۵% کاربران از بیش از سه شبکه اجتماعی استفاده می کنند.</p><p>کاربران شبکه های اجتماعی طیفی از منفعل مصرف کننده تا فعال تولید کننده را شکل می دهند. به طوری که ۲۵.۸% منفعل هستند و میزان فعالیت کمی به عنوان مصرف کننده دارند. ۲۱.۷% آن ها منفعل و تا حدود زیادی مصرف کننده محتوا هستند. ۲۳.۴% آن ها تا حدودی فعال و به عنوان مصرف کننده محتوا شناخته می شوند،۱۷.۳% کاربران فعال و تا حدود کمی تولید کننده محتوا هستند و ۱۱.۸% کاملا فعال و تولیدکننده محتوا شناخته می شوند.</p><p><strong>گونه شناسی کاربران شبکه اجتماعی اینستاگرام بر مبنای انگیزه</strong></p><p>متخصصان ارتباطات،کاربران رسانه های نوین و شبکه های اجتماعی را بر مبنای «مشارکت و سبک مشارکت کاربران»، «کنشگری در شبکه های اجتماعی»، «مصرف شبکه اجتماعی»، «انگیزه محور یا انگیزه استفاده از شبکه اجتماعی» گونه شناسی می کنند. در مطالعه حاضر کاربران شبکه اجتماعی اینستاگرام بر مبنای انگیزه استفاده گونه شناسی شده است.</p><p><strong>کاربران ابزاری</strong>: هدف و انگیزه اصلی این گروه از استفاده از اینستاگرام خرید کالا یا بررسی قیمت ها و کسب درآمد، فروش کالا یا امور فعالیت مرتبط با کار یا تولید است.</p><p><strong>کاربران تعامل گرا</strong>: این کاربران شبکه اجتماعی اینستاگرام دسته بزرگی از کاربران هستند، رفتار آن ها به لحاظ مکالمات جزئی با دیگران تفریحی و میزان مشارکت آن ها بالا است.</p><p><strong>کاربران اطلاع یاب</strong>: کاربرانی که با انگیزه شناختی به گردآوری اخبار و اطلاعات اجتماعی، سیاسی، فرهنگی در گستره ملی و محلی می پردازند.</p><p><strong>کاربران رابطه ساز</strong>: گروهی هستند که به آسانی رابطه دوستی برقرار می کنند و این گروه در «نوشتن نامه و یا پیام»، «تماس با دیگران» و «جستجوی دوستان جدید» فعال تر هستند. تقریبا ۱۵% کاربران، از اینستاگرام برای «تعامل با گروه های دوستی و برقراری دوستی با جنس مخالف» استفاده می کنند.</p><p><strong>کاربران منتقد</strong>: کاربرانی که به بیان دیدگاه های انتقادی اجتماعی، سیاسی و مذهبی خود می پردازند.</p><p><strong>کاربران افشاگر</strong>: کاربرانی که به افشاگری و بازنمایی خود در زمینه های سبک زندگی یا زیبایی شناختی می پردازند.</p><p><strong>کاربران پرسه زن</strong>: کاربرانی که مایل اند اوقات فراغت خود را به گشت وگذار و تماشا در فضای سایبری بگذرانند.</p><p><strong>کاربران هنردوست</strong>: کاربرانی که در اینستاگرام به فعالیت هایی مانند گوش دادن به موسیقی آنلاین و مشاهده آنلاین فیلم و کلیپ های هنری می پردازند.</p><p><strong>کاربران خودشیفته</strong>: این کاربران وقایع مهم زندگی در قالب عکس و فیلم به اشتراک می گذارند و اینستاگرام را فضایی برای بازنمایی زندگی روزمره خود می دانند.</p><p><strong>کاربران تخصص گرا</strong>: کاربرانی که از اینستاگرام برای کسب آموزش در حوزه خاص استفاده می کنند.</p><p><strong>کاربران کنجکاو</strong>: کاربرانی که از اینستاگرام برای زیر نظر گرفتن زندگی دیگران و اغلب با نام جعلی استفاده می کنند.</p><p><strong>کاربران مسئولیت گرا</strong>: کاربرانی که از اینستاگرام برای عضویت در پویش های اجتماعی استفاده می کنند.</p><p><strong>پیشنهاد ها و اقدامات جهت مدیریت اینستاگرام</strong></p><p>به طور میانگین کاربران فضای مجازی ماهانه ۴۰ هزار تومان برای استفاده از فضای مجازی هزینه می کنند. بر این مبنا دولت باید نقش مهمی در سیاست گذاری، مدیریت شبکه اجتماعی و اقتصاد یا هزینه کرد برای شبکه های اجتماعی داشته باشد و از این ظرفیت برای درآمدزایی استفاده کند.</p><p>اگر کاربران اینستاگرام را بر مبنای مواجهه با آسیب طیف بندی کنیم، دو گروه افراد آسیب زا و افراد آسیب پذیر وجود دارد که مستلزم مدیریت اجتماعی می باشند. با توجه به این اختصاص بخشی از درآمد دولت از اینستاگرام و دیگر شبکه های اجتماعی به مدیریت و حل آسیب های اجتماعی از این شبکه ها ضروری است.</p><p>یکی از مهمترین دلایل استفاده از شبکه های اجتماعی خارجی اعتماد کاربران ایرانی به آن ها و ارائه خدمات فنی قومی است. اگر شبکه های اجتماعی داخلی از نظر فنی و خدمات دهی قوی ظاهر شوند و نیز خدمات و محتوای بومی ارائه کنند که شبکه های خارجی قادر به ارائه این خدمات و سرویس ها به کاربران ایرانی نباشند، می توانند در بین کاربران مورد اقبال واقع شوند.تقریبا ۱۵% کاربران، از اینستاگرام برای «کسب درآمد، فروش کالا یا فعالیت مرتبط با کار یا تولید» استفاده می کنند. بنابراین می توان با توانمندسازی خرده فروش ها و تولیدکنندگان نظیر روستاییان یا عشایر، به شبکه های اجتماعی اینستاگرام در افزایش بازدهی تولید و خدمات کمک کرد.</p><p>یکی از مهمترین کارکردهای شبکه اجتماعی اینستاگرام بعد آموزشی آن است. تقریبا ۲۴% کاربران، از اینستاگرام برای «کسب آموزش در حرفه خاص نظیر زبان، آرایشگری، پزشکی، مکانیکی و…» استفاده می کنند. گاهی ارائه آموزش های پزشکی و زیبایی ممکن است همراه با زیان های جبران ناپذیری برای کاربران باشد. بنابراین ارائه گواهی خدمات الکترونیک برای آموزش در حوزه های خاص ضروری به نظر می رسد.</p><p><strong>جمع بندی</strong></p><p>شبکه های اجتماعی به ویژه اینستاگرام به دلیل خصوصیات منحصربه فردش بسیار مورد توجه کاربران قرار گرفته است. عدم فیلتر بودن اینستاگرام در ایران در کنار خصوصیات این شبکه باعث محبوبیت آن شده است. بنابراین ضروری است که ابعاد مختلف مصرف این رسانه مورد تحقیق و تحلیل قرار بگیرد.</p><p>در این پژوهش، کاربران اینستاگرام بر مبنای انگیزه استفاده به گونه های کاربران ابزاری، تعامل گرا، اطلاع یاب، منتقد، افشاگر، خودشیفته، تخصص گرا و… تقسیم می شوند و به کمک بررسی آماری میزان استفاده کاربران از این شبکه ارائه شده است. از جمله اقدامات مدیریتی پیشنهاد شده در این پژوهش این است که با توجه به ظرفیت ها و محبوبیت این شبکه اجتماعی، دولت می تواند اقداماتی را در راستای درآمدزایی و بهره گیری هرچه بهتر از این شبکه اجتماعی انجام دهد. همچنین با توجه به آسیب های اینستاگرام بر گروهی از افراد بخشی از این درآمدها صرف مدیریت و حل آسیب های اجتماعی آن شود.</p><p>این مطالعه در&nbsp;<a href=\"https://iranthinktanks.com/research-institute-of-islamic-culture-and-art/\">پژوهشکده فرهنگ و هنر اسلامی</a>&nbsp;توسط&nbsp;<a href=\"https://iranthinktanks.com/author/mehdi-shahbazi/\">مهدی شهبازی</a>&nbsp;و به سفارش سازمان تبلیغات اسلامی در سال ۱۳۹۹ انجام شده است.</p>',
        '<p> </p><p>رسانه های اجتماعی نسبت به رسانه های سنتی از محبوبیت بیشتری برخودار هستند. از جمله دلایل محبوبیت آن نسبت به رسانه های سنتی می توان به دسترسی آسان، تعاملی بودن، بالا بودن سرعت تولید و تبادل محتوا، سرعت بالای تغییر اطلاعات در آن، چندرسانه ای بودن و دسترس پذیری سایر کاربران اشاره کرد. با تغییر محیط زندگی، رسانه های اجتماعی و تعاملی فرصت های خوبی را برای تولید و مصرف محتوا ایجاد کرده اند. از میان رسانه های اجتماعی، اینستاگرام با ارائه خدمات اشتراک گذاری تصویر، موفقیت بسیاری کسب کرده است و توانسته کاربران یا به اصطلاح دنبال کنندگان بسیاری را به خود جلب کند. اینستاگرام در ایران به دلیل فیلتر نبودن و به عنوان محلی برای بیان دیدگاه های سیاسی، مذهبی و پیگیری کسب وکار تجاری و بازاریابی دارای محبوبیت فراوانی است.</p>',
        NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/05.%20%D8%A7%D8%B3%D9%86%D8%A7%D8%AF/3.jpg',
        'active', 'public', NULL, NULL, 7, NULL, '2022-10-12 13:35:09', '2022-10-26 05:49:19'),
       (52, 'بررسی چالش های صدا و سیمای جمهوری اسلامی ایران و مکانیسم های تحول',
        '<p><strong>ضرورت و اهداف پژوهش</strong></p><p>امروزه رسانه ها در سراسر دنیا تاثیر عمده ای بر دیدگاه های سیاسی، سلیقه های فرهنگی، تمایلات اجتماعی و … دارند. سازمان صدا و سیمای جمهوری اسلامی ایران، سازمانی رسانه ای است که بر اساس قانون اساسی تنها متولی قانونی پخش برنامه های رادیویی و تلویزیونی در جمهوری اسلامی ایران است. رسالت این سازمان با توجه به شرایط خاص کشور با سایر رقبا کاملا متفاوت است؛ از یک سو، حساسیت فعالیت های خبری و اطلاع رسانی همراه با آگاهی بخشی لازم برای مخاطبان از ضروریات فعالیت های این سازمان است و از سوی دیگر این سازمان در رقابتی نابرابر با سایر رسانه های سطح جهانی هم در حوزه آگاهی بخشی و هم در حوزه سرگرمی قرار گرفته است. از مهم ترین وظایف رسانه ها به روشن ساختن افکار عمومی و بالا بردن سطح معلومات و دانش مردم در زمینه های مختلف زندگی می توان اشاره نمود. صدا و سیمای ایران به عنوان یک رسانه ملی می کوشد تا بتواند بهترین عملکرد خود را نشان دهد. ازاین رو باید مشکلات پیش روی آن  را بررسی نمود. در این گزارش به بررسی مشکلات صداوسیما و ریشه یابی آن ها و ارائه پیشنهاداتی در جهت جذب مخاطب پرداخته شده است.</p><p><strong>مشکلات صدا و سیما و ریشه شکل گیری آن ها</strong></p><p>صداوسیما به عنوان یک رسانه ملی، بایست در جهت رفع چالش ها و رسیدن به اهداف خود گام بردارد. در این راستا به بررسی شناسایی مشکلات و ریشه های شکل گیری آن ها پرداخته شده است تا بتوان پیشنهادات مناسبی را در جهت حل آن ارائه کرد. مشکلات مربوط به صدا و سیما در دودسته مسائل مربوط به افزارها و مسائل مربوط به نیروهای اکوسیستم رسانه تقسیم می شوند. برخی از مسائل مربوط به افزارها عبارت اند از:</p><ul><li><strong>عقب ماندگی تکنولوژیک:</strong>&nbsp;عقب ماندگی تکنولوژیکی باعث کاهش سرعت انطباق صدا و سیما با دستاوردهای جدید دنیای رسانه و افزایش هزینه های مربوط به تعمیر و نگه داری از امکانات فنی می شود. ریشه عقب ماندگی تکنولوژیک صدا و سیما را می توان در طولانی بودن فرایندهای تصمیم گیری در سازمان، مدل های نامناسب قرارداد صدا و سیما با نیروهای انسانی و پیچیده بودن ساختارهای صدا و سیما جست وجو نمود.</li><li><strong>شکاف فرهنگی در نیروی انسانی:</strong>&nbsp;صدا و سیما هنوز نتوانسته است به فرهنگ سازمانی منسجمی دست پیدا کند. این تفاوت فرهنگی چنانچه به گونه ای پیش برود که مانع از گفت وگوی میان بخش های مختلف سازمان شود، سازمان را دچار بحران می کند. دلیل شکل نگرفتن یک سازمانی منسجم در صداوسیما را می توان افزایش سهمیه محور منابع انسانی و شکل گیری طیف های نیروی انسانی بر اساس فرهنگ سازی مدیران سابق بیان نمود.</li><li><strong>نیروهای بدون آموزش کافی:</strong>&nbsp;یکی از مهم ترین مشکلات صدا و سیما ناکارآمدی منابع انسانی آن است که از فقدان آموزش بهره می گیرد؛ زیرا سازوکار دانشگاه صدا و سیما نتوانسته است مشکل کارآمدسازی منابع انسانی را برطرف کند. مشکل آموزش منابع انسانی باعث می شود که علاوه بر حجم بالای منابع انسانی و به خاطر کارآمد نبودن آن ها، جذب مجدد نیرو رخ دهد که این امر باعث گسترش منابع انسانی و کاهش عملکرد مناسب آن ها می شود.</li></ul><p>برخی از مسائل مربوط به اکوسیستم رسانه نیز عبارت اند از:</p><ul><li><strong>مسائل مربوط به رقبا:</strong>&nbsp;سازمان صداوسیمای جمهوری اسلامی ایران با رقبایی جدی دست به گریبان است. این رقبای جدی شامل شبکه های ماهواره ای، VODها (سرویس هایی که به کاربران امکان تماشای ویدیوها را در زمان دلخواه می دهند) و افراد تأثیرگذار در رسانه های اجتماعی هستند. درواقع صداوسیما خواه ناخواه با رقبایی مواجه است که هرروز سهم بیشتری از مخاطبان را به خود اختصاص می دهند.</li><li><strong>مسائل مربوط به مخاطبان:</strong>&nbsp;چالش از دست دادن مخاطب در صداوسیما هرروز بیش ازپیش به مسئله تبدیل می شود. صداوسیما برای حفظ مخاطبین خود به حربه های مختلفی مانند کاهش استانداردهای فرهنگی و ایدئولوژیک متوسل شده است. صداوسیما می کوشد تا وزن برنامه های مرتبط با حوزه سرگرمی را بیشتر و بیشتر کند و تا حد امکان از بعضی از معیارهای قدیمی خود به خاطر مصلحت جذب مخاطب چشم بپوشد؛ اما این ها هرگز به جلب اعتماد مردم درباره صداوسیما منجر نشده است.</li></ul><p><strong>راهکارهای مناسب برای جذب مخاطب در صدا و سیمای ایران</strong></p><p>تاکنون تلاش های بسیاری برای ایجاد تحول در اکوسیستم رسانه ای کشور انجام شده است. این تلاش ها در بعضی موارد تا حدودی اثربخش و در بعضی موارد به طورکلی فاقد تاثیر فراوانی بوده اند. برآیند این تلاش ها نشانگر این است که اصلاح روند سازمان عملکردی پرهزینه و بسیار دشوار خواهد بود. ازاین رو باتوجه به برخی از نکات ضروری می توان در جهت اصلاحات لازم و جذب مخاطب گام برداشت. در این زمینه می توان در برخی از موارد از شبکه های پرس تی وی و بی بی سی الگو گرفت.</p><p><strong>صدا و سیمای داخلی و پرس تی وی</strong></p><p>صدا و سیمای ایران می تواند با تغییر در نحوه تولید و ارائه خبر، آگاه درنظرگرفتن مخاطب، سرعت پخش مناسب و بالا بردن کیفیت محتوایی برنامه ها رویکرد بهتری را از خود نشان دهند. این سازمان می تواند در این زمینه پرس تی وی را الگوی خود قرار دهد. نحوه تولید خبر در صدا و سیمای ایران به این صورت است که بخش های مختلف یک خبر توسط افراد گوناگونی تشکیل و تدوین می یابد؛ اما در مدل پرس تی وی تهیه گزارش از ابتدا تا تنظیم نهایی به عهده یک فرد است. فایده چنین سبکی این است که فرد احساس مسئولیت بیشتری درنتیجه کار فردی خود داشته و در صورت نقص خبر مسئولیت آن خبر بر عهده فرد مشخصی خواهد بود. همچنین صدا و سیما باید توجه داشته باشد که مخاطب درون جامعه زندگی می کند و با منابع اطلاعاتی دیگر در تماس است. درنتیجه در صورت تضاد و ناسازگاری اطلاعات با منابع دیگر مخاطب اعتماد خود را به صدا سیما از دست خواهد داد. یکی دیگر از موضوعاتی که باید موردتوجه بیشتر قرار گیرد، کیفیت برنامه ها است. درزمینه کیفیت برنامه ها باید توجه داشت که بسیاری از خبرها رسانه ملی ظاهری خبرنما دارند اما هیچ اطلاعات مفیدی به مخاطب منتقل نمی کنند؛ لذا توجه به کیفت برنامه ها اهمیت بسیاری دارد. یکی دیگر از رویکردهایی که صدا و سیما با آن مواجه است، نحوه ارائه خبر است. رویکرد صدا و سیما به این صورت است که یک خبر باید مشخص و دقیق باشد تا از رسانه های ملی اعلام شود؛ ازاین رو بسیاری از اخبار که ارزش خبری بالایی دارند به دلیل ایهام و تردید در بخش هایی از آن ها، کنار گذاشته می شوند.</p><p><strong> صدا و سیمای داخلی و بی بی سی</strong></p><p>بررسی و توجه به برنامه خبری ۶۰ دقیقه، می تواند راهکارهای زیادی برای صدا و سیمای ایران پیشنهاد دهد. یکی از نکات مهم در این زمینه ارائه مناسب خلاصه خبر است. خلاصه خبر همچون ویترینی از برنامه است. خلاصه اخبار این امکان را به مخاطب می دهد تا درباره مشاهده اخبار آن شبکه تصمیم گیری نماید. پس صداوسیما باید در چیدمان خلاصه اخبار تلاش بیشتری نماید و اخبار را برحسب دغدغه مخاطب و میزان جذابیت آن برای مخاطب شکل دهد. همچنین یکی از وظایف رسانه ملی بازتاب مسائل روز جامعه است، اما ماحصل افراط در بازتاب مسائل اجتماعی خاص همچون قاچاق و کودک همسری چیزی به جز ناامیدی و بعضا القای حس عدم امنیت در جامعه نخواهد بود. هم چنین تلویزیون می تواند با توزیع سریال هایی با تم های متفاوت و به روز مخاطب هایی با سلایق مختلف را به خود جلب نمایند. هم چنین صداوسیما باید در نحوه ارائه برنامه ها دینی و ورزشی رویکرد جدیدی بیندیشد، زیرا مخاطب نسل جدید سبک خطابه مفاهیم دینی را نمی پذیرد و نیازمند گفت وگو، مناظره و حتی مجادله است.</p><p><strong>جمع بندی</strong></p><p>سازمان صدا و سیمای جمهوری اسلامی ایران، سازمانی رسانه ای است که بر اساس قانون اساسی تنها متولی قانونی پخش برنامه های رادیویی و تلویزیونی در جمهوری اسلامی ایران است. صدا و سیما به عنوان یکی رسانه های جمعی، انتقال و هدایت دامنه گسترده ای از نمادها، هنجارها، ارزش ها و پیام ها را درون جامعه بر عهده دارد، اما این سازمان نیز مانند سازمان های دیگر نیازمند تغییر و اصلاحات مناسبی است. از مشکلات پیش روی رسانه به عقب ماندگی تکنولوژیک، فقدان وجود یک نظریه رسانه منسجم، بالا بودن تعداد منابع انسانی و ناکارآمد بودن آن ها و…است. ازاین رو صدا و سیما با یافتن ریشه این مشکلات توجه به برخی از نکات ضروری می توان رویکرد بهتری را از خود نشان دهند. صدا و سیمای ایران می تواند با اصلاح در نحوه تولید و ارائه خبر، نگاه به مخاطب، بالا بردن کیفیت محتوایی و استفاده از تم های مختلف برنامه ها در جهت اصلاح عملکرد خود و جذب مخاطب گام بردارد.</p>',
        '<p>در دنیای امروز یکی از تاثیرگذارترین و قدرتمندترین وسیله برای تبلیغ و ترویج فرهنگ ها، ایده ها و انتقال مفاهیم اجتماعی استفاده از رسانه ها است. صدا و سیما به عنوان پرمخاطب ترین سازمان رسانه ای کشور مطرح است. این سازمان نیز دارای نقاط قوت و ضعف در عملکرد خود است. ازاین رو با بررسی و تشخیص نقاط ضعف و شناخت وضع ساختار موجود سازمان صدا و سیما می توان راهکارهای مناسبی را جهت رفع و اصلاح آن ها ارائه نمود. در این بررسی می توان از ابزار و روش های مورد استفاده از شبکه های خارجی همچون پرس تی وی، بی بی سی در جهت افزایش تعداد مخاطب و اعتماد به رسانه تا جایی که تضادی با ارزش های حاکمیت ندارد، یاری جست.</p>',
        '[\"\\u0635\\u062f\\u0627_\\u0648_\\u0633\\u06cc\\u0645\\u0627\"]',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A8%D9%86%D8%B1%D9%87%D8%A7%DB%8C%20%D8%B3%D8%A7%DB%8C%D8%AA%20%D9%85%D8%B1%DA%A9%D8%B2/05.%20%D8%A7%D8%B3%D9%86%D8%A7%D8%AF/3.jpg',
        'active', 'public', NULL, NULL, 7, 1, '2022-10-12 13:36:51', '2022-10-26 05:49:21'),
       (53, 'تست',
        '<p>سلام&nbsp;بر&nbsp;شما&nbsp;دوست&nbsp;عزیز&nbsp;</p><figure class=\"image\"><img src=\"https://sccm.ir/uploads/-9223372036854775808_-210422.jpg\"></figure><p><img src=\"https://sccm.ir/uploads/-9223372036854775808_-210425.jpg\"><br> </p>',
        '<p>خلاصه&nbsp;جاش&nbsp;اینجاست&nbsp;</p>', NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%85%D8%A7%D9%87%D9%86%DA%AF/%D8%B9%DA%A9%D8%B3%20%D8%B4%D8%A7%D8%AE%D8%B5%201.jpg',
        'active', 'public', 'https://sccm.ir/uploads/Desktop/V_20180408_180112.mp4',
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%85%D8%A7%D9%87%D9%86%DA%AF/%D8%A7%D8%B5%D9%84%D8%A7%D8%AD%20%DB%8C%DA%A9%20%D9%81%D8%B1%D9%87%D9%86%DA%AF%20%D8%BA%D9%84%D8%B7.mp4',
        5, NULL, '2022-11-24 09:52:48', '2022-11-24 09:52:48'),
       (54, 'تست برآیند', '<p>متن&nbsp;</p>',
        '<p>خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیخلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیبخلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیبخلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیخلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیب&nbsp;خحسخیبخ&nbsp;سیب خلاصه&nbsp;متن&nbsp;سیب&nbsp;منسیب&nbsp;نسیجب&nbsp;مسحیب&nbsp;سخی&nbsp;بحنسیتب&nbsp;خحسخیبخ&nbsp;سیب </p>',
        NULL,
        'https://sccm.ir/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%DA%AF%D9%81%D8%AA%D9%85%D8%A7%D9%86/%D9%86%D9%88%D8%A7%D9%87%D9%86%DA%AF/1.jpg',
        'active', 'public', NULL, NULL, 4, NULL, '2022-11-24 10:44:48', '2022-11-24 10:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `post_file`
--

CREATE TABLE `post_file`
(
    `post_id`    int(10) UNSIGNED NOT NULL,
    `file_id`    bigint(20) UNSIGNED NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_file`
--

INSERT INTO `post_file` (`post_id`, `file_id`, `created_at`, `updated_at`)
VALUES (23, 33, '2022-10-09 05:56:26', '2022-10-09 05:56:26'),
       (27, 34, '2022-10-09 05:56:50', '2022-10-09 05:56:50'),
       (38, 35, '2022-10-09 05:57:17', '2022-10-09 05:57:17'),
       (39, 36, '2022-10-09 05:57:33', '2022-10-09 05:57:33'),
       (2, 39, '2022-10-10 15:48:37', '2022-10-10 15:48:37'),
       (2, 40, '2022-10-10 15:48:37', '2022-10-10 15:48:37'),
       (20, 41, '2022-10-10 15:52:36', '2022-10-10 15:52:36'),
       (25, 42, '2022-10-10 15:52:58', '2022-10-10 15:52:58'),
       (26, 43, '2022-10-10 15:53:38', '2022-10-10 15:53:38'),
       (32, 44, '2022-10-10 15:53:54', '2022-10-10 15:53:54'),
       (33, 45, '2022-10-10 15:54:24', '2022-10-10 15:54:24'),
       (34, 46, '2022-10-10 15:54:39', '2022-10-10 15:54:39'),
       (54, 47, '2022-11-24 10:44:48', '2022-11-24 10:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `name`       varchar(255) NOT NULL,
    `guard_name` varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`)
VALUES (1, 'super admin', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (2, 'user', 'web', '2022-09-04 12:55:39', '2022-09-04 12:55:39'),
       (4, 'user-site', 'web', '2022-11-05 03:43:46', '2022-11-05 03:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions`
(
    `permission_id` bigint(20) UNSIGNED NOT NULL,
    `role_id`       bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
VALUES (46, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `name`       varchar(255) NOT NULL,
    `value`      varchar(255) NOT NULL,
    `type`       varchar(255) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `type`, `created_at`, `updated_at`)
VALUES (1, 'test', 'asas', 'social', '2022-12-09 12:18:15', '2022-12-09 12:18:15'),
       (2, 'default',
        '[\"\\u062a\\u0633\\u0647\\u06cc\\u0644\\u0627\\u062a\",\"\\u0633\\u0627\\u062e\\u062a\\u0627\\u0631\"]',
        'status_keyword', NULL, '2022-12-09 16:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider`
(
    `id`         int(10) UNSIGNED NOT NULL,
    `title`      text NOT NULL,
    `content`    text NOT NULL,
    `img_src`    text NOT NULL,
    `status`     tinyint(1) NOT NULL DEFAULT 1,
    `url`        text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `content`, `img_src`, `status`, `url`, `created_at`, `updated_at`)
VALUES (1, 'سالن های حوزه هنری',
        '<p>مطالبه&nbsp;جدی&nbsp;رهبر&nbsp;انقلاب&nbsp;از&nbsp;سیاست‎&nbsp;گذاران&nbsp;فرهنگی</p>',
        'http://127.0.0.1:8000/uploads/%D9%85%D8%AD%D8%AA%D9%88%D8%A7%20%D8%A7%D9%88%D9%84%DB%8C%D9%87%20%D8%B3%D8%A7%DB%8C%D8%AA/%D8%A7%D8%B3%D9%84%D8%A7%DB%8C%D8%AF%D8%B1/slider.jpg',
        1, 'https://sccm.ir/single/9', '2022-09-06 13:39:42', '2023-01-09 15:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `subject_categories`
--

CREATE TABLE `subject_categories`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `title`      varchar(255) NOT NULL,
    `tag`        varchar(255) NOT NULL,
    `imageIndex` varchar(255) NOT NULL,
    `book_id`    int(10) UNSIGNED NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `content`    varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_category`
--

CREATE TABLE `type_category`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `name`       varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `type`       varchar(255) DEFAULT NULL,
    `image`      varchar(255) DEFAULT NULL,
    `desc`       varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_category`
--

INSERT INTO `type_category` (`id`, `name`, `created_at`, `updated_at`, `type`, `image`, `desc`)
VALUES (1, 'اخبار', NULL, '2022-09-12 00:52:12', NULL, NULL, NULL),
       (2, 'ماژول', NULL, '2022-09-12 00:49:22', NULL, NULL, NULL),
       (3, 'اسلایدر', '2022-09-05 13:18:29', '2022-09-12 00:49:38', NULL, NULL, NULL),
       (9, 'مکان', '2022-12-31 06:58:57', '2022-12-31 06:58:57', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
    `id`                bigint(20) UNSIGNED NOT NULL,
    `name`              varchar(255) NOT NULL,
    `email`             varchar(255) NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password`          varchar(255) NOT NULL,
    `remember_token`    varchar(100) DEFAULT NULL,
    `created_at`        timestamp NULL DEFAULT NULL,
    `updated_at`        timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`,
                     `updated_at`)
VALUES (1, 'SCCMAdmin', 'admin@sccm.ir', NULL, '$2y$10$SafxrUdqumNlSSFmEaN63.AnGt5iqDNVOGg2BbQ8hGDhSVoIxdXxe', NULL,
        '2022-09-04 12:55:40', '2022-09-04 12:55:40'),
       (19, 'آقای کریمی', 'tahadavoodi0@gmail.com', NULL,
        '$2y$10$065XXcOSjieSzQ6xzeRXL.2RuXnd8HZ.l3npIV4B5JsZGgjrOhEZi', NULL, '2022-11-06 08:57:59',
        '2022-11-06 08:57:59'),
       (20, 'mam', 'mamashayekhi18@gmail.com', NULL, '$2y$10$EMfOvUL2Lca81OG3NKZfGO3b4L2bOAjJJv5BDPXjC9viGkcWNTLsa',
        NULL, '2022-11-24 09:56:25', '2022-11-24 10:18:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboat_us`
--
ALTER TABLE `aboat_us`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
    ADD PRIMARY KEY (`id`),
  ADD KEY `categories_type_id_foreign` (`type_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_infos`
--
ALTER TABLE `location_infos`
    ADD PRIMARY KEY (`id`),
  ADD KEY `location_infos_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
    ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_items_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
    ADD PRIMARY KEY (`permission_id`, `model_id`, `model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
    ADD PRIMARY KEY (`role_id`, `model_id`, `model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_morph_posts`
--
ALTER TABLE `multi_morph_posts`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
    ADD PRIMARY KEY (`id`),
  ADD KEY `orders_location_id_foreign` (`location_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
    ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_file`
--
ALTER TABLE `post_file`
    ADD KEY `post_file_post_id_foreign` (`post_id`),
  ADD KEY `post_file_file_id_foreign` (`file_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
    ADD PRIMARY KEY (`permission_id`, `role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_categories`
--
ALTER TABLE `subject_categories`
    ADD PRIMARY KEY (`id`),
  ADD KEY `subject_categories_book_id_foreign` (`book_id`);

--
-- Indexes for table `type_category`
--
ALTER TABLE `type_category`
    ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `aboat_us`
--
ALTER TABLE `aboat_us`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
    MODIFY `id` int (10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
    MODIFY `id` int (10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_infos`
--
ALTER TABLE `location_infos`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int (10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `multi_morph_posts`
--
ALTER TABLE `multi_morph_posts`
    MODIFY `id` int (10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
    MODIFY `id` int (10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
    MODIFY `id` int (10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_categories`
--
ALTER TABLE `subject_categories`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_category`
--
ALTER TABLE `type_category`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
    ADD CONSTRAINT `categories_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `type_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location_infos`
--
ALTER TABLE `location_infos`
    ADD CONSTRAINT `location_infos_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
    ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON
DELETE
CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
    ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
    ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
    ADD CONSTRAINT `orders_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `location_infos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_file`
--
ALTER TABLE `post_file`
    ADD CONSTRAINT `post_file_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_file_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON
DELETE
CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
    ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON
DELETE
CASCADE;

--
-- Constraints for table `subject_categories`
--
ALTER TABLE `subject_categories`
    ADD CONSTRAINT `subject_categories_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
