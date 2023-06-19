-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2021 at 04:55 AM
-- Server version: 10.3.28-MariaDB-log-cll-lve
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bryngrgz_tradefx`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_style` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dark',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acnt_type_active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstName`, `lastName`, `email`, `email_verified_at`, `password`, `phone`, `dashboard_style`, `remember_token`, `acnt_type_active`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Tester', 'Test', 'super@happ.com', NULL, '$2y$10$DD2x5QqEARQhc9YA3G2PG.0V9rchuxgGgSO/WDgsobCnOO2ukz2z6', '3444444', 'light', NULL, 'active', 'active', 'Super Admin', '2021-03-10 12:55:53', '2021-04-03 17:01:04'),
(2, 'Admin', 'test', 'admin@happ.com', NULL, '$2y$10$ly8phqbtzKvYoeT.axkZdu98ckXBnmEKmzVogLLy90a.8ROKV0eze', '99494948', 'Dark', NULL, 'active', NULL, 'Admin', '2021-03-11 13:05:41', '2021-03-11 14:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_refered` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `total_activated` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `earnings` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(255) NOT NULL,
  `ref_key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `ref_key`, `title`, `description`, `created_at`, `updated_at`) VALUES
(5, 'SMsJr1', 'SAVDOLAR', 'Bizning so`zimizni qabul qilmang, bu erda ba`zi mijozlarimiz biz haqimizda nima deyishlari kerak', '2020-08-22 11:13:00', '2020-08-22 11:37:15'),
(6, 'toe3Ew', 'Ayni paytda savdo', 'Toʻliq investitsiyalar qatori bilan investitsiya gʻoyalaringizni amalga oshiring. Onlayn savdoda haqiqiy imtiyoz va mukofotlardan bahramand boʻling..', '2020-08-22 11:29:36', '2020-08-22 11:29:36'),
(7, 'jJwh78', 'Biz pulni qaytarib olish so`rovini zudlik bilan ko`rib chiqamiz', 'Toʻliq investitsiyalar qatori bilan investitsiya gʻoyalaringizni amalga oshiring. Onlayn savdoda haqiqiy imtiyoz va mukofotlardan bahramand boʻling..', '2020-08-22 11:30:22', '2020-08-22 11:30:22'),
(8, 'SLxaB2', 'Kelajakka investitsiya qiling', 'Toʻliq investitsiyalar qatori bilan investitsiya gʻoyalaringizni amalga oshiring. Onlayn savdoda haqiqiy imtiyoz va mukofotlardan bahramand boʻling..', '2020-08-22 11:30:55', '2020-08-22 11:30:55'),
(9, 'BkP8pH', 'Yo`lda savdo qilish', 'Yo`lda savdo qilish soddalashtirilgan va savdo qilish oson', '2020-08-22 11:31:38', '2020-08-22 11:31:38'),
(10, 'W6gTBN', 'Sotib olish, sotish, savdo qilish, investitsiya qilish soddalashtirildi', 'Toʻliq investitsiyalar qatori bilan investitsiya gʻoyalaringizni amalga oshiring. Onlayn savdoda haqiqiy imtiyoz va mukofotlardan bahramand boʻling..', '2020-08-22 11:31:55', '2020-08-22 11:31:55'),
(11, 'anvs8c', 'Haqida', 'onlayn savdo sizning №1 kriptovalyuta investitsiya portfelini boshqarish tizimidir', '2020-08-22 11:32:29', '2020-08-22 11:32:29'),
(12, 'epJ4LI', 'BIZ INNOVATSIYA QILAMIZ', 'Yaratuvchi yondashuv va yangiliklar tufayli taklif qilingan muammolarga yechim topishdir', '2020-08-22 11:33:32', '2020-08-22 11:33:32'),
(13, '5hbB6X', 'LITSENZIYA SERTIFIKATLANGAN', 'Xalqaro sifat standartlariga muvofiq sertifikatlangan mahsulotlar va xizmatlarni taklif qiladi.,', '2020-08-22 11:33:55', '2020-08-22 11:33:55'),
(14, 'Zrhm3I', 'BIZ PROFISSIONALMIZ', 'Eng yuqori sifatli, mutaxassislik va professionalizm asosida faoliyat olib boradi.,', '2020-08-22 11:34:11', '2020-08-22 11:34:11'),
(15, 'yTKhlt', 'SARMOYA VA INVESTITSIYA', ' moliyalashtirishning muhim aspektlari bo`lib, o`tgan pulni xalqaro banklar, fondlar yoki boshqalar orqali investitsiyalar bilan to`plashni va kapitalni oshirishni ifodalaydi,', '2020-08-22 11:34:26', '2020-08-22 11:34:26'),
(16, 'u0Ervr', 'BIZNING XIZMATLARIMIZ', 'Nima uchun bizni tanlashingiz kerak', '2020-08-22 11:34:56', '2020-08-22 11:34:56'),
(17, 'Dwu6Bv', 'BARQAROR VA OMONATDOR', 'xizmatlarimiz va mahsulotlarimizning ishonchli, sifatli va qondirilganligini ta`minlashga xizmat qiladi.', '2020-08-22 11:35:22', '2020-08-22 11:35:22'),
(18, 'eMo1d2', 'TEZ VA XAVFSIZ O`TKAZISHLAR', 'Bizning xizmatlarimiz tez va xavfsizlik prinsiplari asosida xodimlarimiz tomonidan bajariladi. Bizning maqsadimiz, mijozlarimizning mablag`larini qisqa va xavfsiz davranda o`tkazish orqali ularga samarali va foydali xizmat ko`rsatishdir', '2020-08-22 11:35:42', '2020-08-22 11:35:42'),
(19, 'kEJPm3', 'TAKLIF BONUSI DASTURI', 'Bizning kompaniyamizning tavsiya bonusi dasturi, mijozlarga bir nechta do`stlarini taklif qilgan har bir mijoz uchun bonus beradi.', '2020-08-22 11:35:59', '2020-08-22 11:35:59'),
(20, 'bBSnFV', 'XALQARO VALYUTALAR BILAN ISHLASH', 'Bizning ko`p valyutali qo`llab quvvatlash imkoniyati, xalqaro bizneslar uchun muhimdir. Bu imkoniyat orqali, xalqaro mijozlar xohlagan valyutalarda to`lovlarini amalga oshirishi mumkin, shuningdek, xalqaro kontraktlarni yoki savdo operatsiyalarini boshqarishda ham yordam beradi.', '2020-08-22 11:36:17', '2020-08-22 11:36:17'),
(21, 'DUK9pc', '24/7 MIJOZLARNI QO`LLAB-QUVVATLASH', ' Bizning 24/7 mijozlarga qo`llab-quvvatlash xizmatimiz, tushunchalar, savollar va muammolar bilan bog`liq tushunchalarni yechish, yordam berish, ko`rsatish va shikoyatlarni bartaraf qilishda yordam beradi', '2020-08-22 11:36:31', '2020-08-22 11:36:31'),
(22, 'VaeiMW', 'MUKAMMAL XAVFSIZLIK', 'Bizning kompaniyamiz uchun mukammal xavfsizlik, eng yuqori darajada maqsadga muvofiq himoya tizimlarini o`z ichiga oladi. Bu, mijozlarimizning ma`lumotlarini, shaxsiy ma`lumotlarini, moliyaviy axborotlarini va boshqa xavfsizlik ko`rsatkichlarini ta`minlashga qaratilgan', '2020-08-22 11:36:49', '2020-08-22 11:36:49'),
(23, 'vr6Xw0', 'BIZNING INVESTITSIYA REJAMIZ', 'Biz bilan qanday sarmoya kiritishni xohlayotganingizni tanlang', '2020-08-22 11:37:43', '2020-08-22 11:37:43'),
(25, 'OtEicb', 'SO‘NGI OPERATSIYALAR', 'Bizning maqsadimiz har kim investor bo`lishi uchun investitsiya qilishni soddalashtirishdir. Buni hisobga olgan holda, biz platformamizda taklif qilayotgan investitsiyalarni tanlaymiz...', '2020-08-22 11:38:06', '2020-08-22 11:38:06'),
(26, 'OLZt1I', 'TEZ-TEZ SO`RALADIGAN SAVOLLAR', 'Bizning maqsadimiz har kim investor bo`lishi uchun investitsiya qilishni soddalashtirishdir. Buni hisobga olgan holda, biz platformamizda taklif qilayotgan investitsiyalarni tanlaymiz...', '2020-08-22 11:38:56', '2021-03-12 14:29:50'),
(27, 'U7zpEj', 'QABUL QILAMIZ', 'qabul qilamiz', '2020-08-22 11:39:43', '2020-08-22 11:39:43'),
(29, '9sNF7G', 'BIZ BILAN BOG`LANISH', 'Bizga xabar yuboring va biz imkon qadar tezroq javob beramiz', '2020-08-22 11:40:06', '2020-08-22 11:40:06'),
(30, '52GPRA', 'MANZIL', 'Fergana-86, Uzbekistan ', '2020-08-22 11:40:19', '2020-08-22 11:40:19'),
(31, '0EXbji', 'TELEFON RAQAMI', '+998(XY)XXX XX XX', '2020-08-22 11:40:36', '2020-09-14 10:13:57'),
(32, 'HLgyaQ', 'EMAIL', 'support@gmail.com', '2020-08-22 11:41:14', '2020-08-22 12:23:55'),
(33, 'ETsdbc', 'Website Description in Footer', 'Onlayn savdo va investitsiya platformasi, mijozlarga xalqaro moliyalashtirish bozori va savdo birikmalariga kirish imkonini taqdim etadi. Saytning asosiy maqsadi mijozlarga qulay va xavfsiz yolda moliyalashtirish va savdo amaliyotlarini amalga oshirishdir.', '2020-08-22 11:42:05', '2020-08-22 11:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `cp_transactions`
--

CREATE TABLE `cp_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `txn_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Item_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_paid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_tele_id` int(11) DEFAULT NULL,
  `amount1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_p_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_pv_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_m_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_ipn_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_debug_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cp_transactions`
--

INSERT INTO `cp_transactions` (`id`, `txn_id`, `item_name`, `Item_number`, `amount_paid`, `user_plan`, `user_id`, `user_tele_id`, `amount1`, `amount2`, `currency1`, `currency2`, `status`, `status_text`, `type`, `cp_p_key`, `cp_pv_key`, `cp_m_id`, `cp_ipn_secret`, `cp_debug_email`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jdjjjkdkd', 'kkdhdjjdjjkd', 'Victory ID', 'dhhdhd', 'support@onlintrade.com', '2021-03-11 12:46:45', '2021-03-15 12:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `txn_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `uname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `ref_key`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, '8yZ6FC', 'Qanday qilib olib tashlashim mumkin', 'Bu qanday qilib olib qo`yiladi', '2021-03-11 14:31:42', '2021-03-11 14:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(255) NOT NULL,
  `ref_key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `ref_key`, `title`, `description`, `img_path`, `created_at`, `updated_at`) VALUES
(3, '57VnOE', 'Slider1', 'This is carosel 1', 'upload-2.jpg1617292439', '2020-08-23 12:08:38', '2021-04-01 15:53:59'),
(4, 'dC6ZaA', 'Slider2', 'This is slider 2', '2.jpg', '2020-08-23 12:09:00', '2020-08-23 12:09:00'),
(5, '9kHash', 'Slider3', 'This is slider 3', '3.jpg', '2020-08-23 12:09:16', '2020-08-23 12:09:16'),
(6, 'CcW52g', 'Slider4', 'This is Slider 4', '4.jpg', '2020-08-23 12:09:38', '2020-08-23 12:09:38'),
(7, '96i7xH', 'Slider5', 'This is slider 5', '5.jpg', '2020-08-23 12:09:55', '2020-08-23 12:09:55'),
(8, 'DPd1Kn', 'Testimonial 1', 'Testimonial 1', 'testimonial-1.jpg', '2020-08-23 12:24:52', '2020-08-23 12:24:52'),
(9, 'ZqCgDz', 'Testimonial 2', 'Testimonial 2', 'testimonial-2.jpg', '2020-08-23 12:25:07', '2020-08-25 14:57:06'),
(10, 'zNNAgD', 'Testimonial 3', 'Testimonial 3', 'testimonial-3.jpg', '2020-08-23 12:25:22', '2020-08-23 12:25:22'),
(11, '2v0Ut5', 'Testimonial 4', 'Testimonial 4', 'GyDN8Rtestimonial-4.jpg1617380709', '2020-08-23 12:25:37', '2021-04-02 16:25:09'),
(12, '4Rp9Wz', 'Testimonial 5', 'Testimonial 5', 'upload-testimonial-5.jpg1617356092', '2020-08-23 12:25:54', '2021-04-02 09:34:52'),
(13, 'tXf1Zz', 'Testimonial 1', 'Testimonial 1', 'QmSJjKtestimonial-1.jpg1617381068', '2020-08-25 14:52:57', '2021-04-02 16:31:08');

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
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_03_09_142220_create_sessions_table', 1),
(7, '2021_03_10_082445_create_admins_table', 2),
(8, '2021_03_10_082519_create_agents_table', 2),
(9, '2021_03_10_082715_create_assets_table', 2),
(10, '2021_03_10_082817_create_contents_table', 2),
(11, '2021_03_10_083110_create_cp_transactions_table', 2),
(12, '2021_03_10_083324_create_deposits_table', 2),
(13, '2021_03_10_083400_create_faqs_table', 2),
(14, '2021_03_10_083510_create_images_table', 2),
(15, '2021_03_10_083557_create_mt4_details_table', 2),
(16, '2021_03_10_083627_create_notifications_table', 2),
(17, '2021_03_10_083824_create_plans_table', 2),
(18, '2021_03_10_083850_create_settings_table', 2),
(19, '2021_03_10_083936_create_testimonies_table', 2),
(20, '2021_03_10_084009_create_tp__transactions_table', 2),
(21, '2021_03_10_084031_create_upgrades_table', 2),
(22, '2021_03_10_084120_create_userlogs_table', 2),
(23, '2021_03_10_084140_create_user_plans_table', 2),
(24, '2021_03_10_084235_create_wdmethods_table', 2),
(25, '2021_03_10_084300_create_withdrawals_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mt4_details`
--

CREATE TABLE `mt4_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `mt4_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mt4_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leverage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(2, 9, 'Bu yangi pochta Victory, qabul qiling', '2021-03-12 12:38:30', '2021-03-12 12:38:30');

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
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maxr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expected_return` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `increment_interval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `increment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `increment_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `price`, `min_price`, `max_price`, `minr`, `maxr`, `gift`, `expected_return`, `type`, `increment_interval`, `increment_type`, `increment_amount`, `expiration`, `created_at`, `updated_at`) VALUES
(1, 'Starter', '50', '50', '50', '60', '70', '0', NULL, 'Main', 'Hourly', 'Fixed', '4', 'One month', '2021-03-11 11:10:23', '2021-03-23 10:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1AUkyf4Ce8quM4dDpBUZOCjvrp2KrbANWF5GyIir', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYzZGTnNyd0ZUbm9NV1BHVmtOb2wxU2dSOE1LdGUzdU5sa2F1VFNmdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617675939),
('2jXZQCLfwsySQskGljfWRBjZ84A1XkGgz1p9qDap', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUN5c3UzNGJ4SXhYSlJqSmRyUVlXMUJIMXdvZVFxa1F3bGlLeG40QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617671725),
('3FqsR31rIeMQyQcZoLl2gvGr3YX75S1nJydT5Kxf', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV3N0eXhCNE9sckVPc1M0ZXhvMjU2Mlo3MHFYd1lFdEJ2R1paUzNaQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617698115),
('3yYjV6NAqeVY0novNPCkAm1xGDzFwojZZzrs7Q7I', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGxCcHRXUGtjRFJyVUNjYU1HQ0NVMjlwVHBocjk5T0hqMG1zUEU2WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617682509),
('4GYzhNldiISxK2UUaEz5BqzO25YoglkwtS0Yun0d', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTktsUENmWDlZNzc0QnlOdGVzcU9aMVNNaWdOcG5vaGRwUEo0VUI1UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617679221),
('4srkKGlhkK7YlrccIe19lXV7fERMu2qSWYF3TOKU', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQVlpeVIzalNlaVRMaGZkVHYzTFU1dDZJQUpkeTJ5b2xkd3NYSVRvdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617681336),
('5fR29dAagWMmU6PpegOahTTENbT1a8rf8ha5VpOE', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVG1wdFQwVFNlRnFyZ3BnV2p4N3V3T1hhQWJaZDlBeHpMeE94MWdBZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617680120),
('5OLhyHYHUUmaDTwGSmob9xakwOQ7HibPib8KYr2J', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibkN3V3NYekRWQTk4bHRGbkpkVEVSSll6NTZPZU9ObTBiMHZ0N1VLbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617672943),
('6DpKVmeSKdc1f9ILIjjG84MfyjMKeox8U2dzKvzY', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibFljbjFKOE50ejBCY3lWa0VvSTQzS1JiVXVTUmZVaFpSRkZQbmk2RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617678048),
('6H4ITQTSu3ccFrahMaHgk1OlVxdpdby2YGVd9l52', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWh5MzREMVNRWWxobFQ2Z3dnUWQ4cWwySEJwbDBhSUU0MW93cEJGWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617696614),
('7Mi5m44cBR58qACUQxQyc0lneh7xpP2RbRxxtNzd', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmVzT0VUQ1p4TEIzQlZDUmN4Q0F6NlVXMldDOWhFbUI0ZVlxeENlUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617681011),
('7umzyUKa6fWtrL20hsVn4NKLo2ZreZUnRPSYXlkY', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0JYYWRrQTNaQnllNUZ2UWtFdWNvdWhXOE5ETHdXTmVheU92czlJRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617693938),
('7zR90j4OB0ar7H46HN5wdbVt1vJCPCVLD1SoDSue', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3k2SmFwQ1RrcVNUWjhMR0RNTmxWZktUaWQxRzduZ21Bc0hyTGhMcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617681944),
('81MSRhkpDh1tmY4sVlBpZQAaQgEmzDIct7UE8kRr', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTXdPejAxdWh2eGwzZVkwcUN2M3AzNzJNcms1b2kxbzF0VzlBTm5FbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617690049),
('9PON2NPmdVrDwJUDD7itAW2os3HjhnIEoAeHGPcL', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidE4zTkxxU01ZVExPM1VkaDUySnZpa0JWa2FlNWM0Y3hNcUxOVTJvbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617682851),
('9sLyZv68KfCZUAo8BBX1E95bxeEmuFfh3lN3hXf0', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjBKWlU1dnBVTFBIcExiZ3NJZFJyVlY3NG9COFpQVmtTa3ZHY1QyNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617678945),
('Aea3La2dtzLTdDfx0LKESgqHqlK9QWlLzQhhqhMA', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekNsZXhRcHlWQjNzdVVGRXFPWXVTNjlqWWE5Sm13UFBBZzNoZmlqUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617677708),
('ajQvj4SlOMzwZ4tZDmRrIFceFzSvb3FnDo25sT1V', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVE5MjdkeTZnWjFMemxOdFJPZm5OU2xuQmtiMHlFbVVlcmtURUFEVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617675335),
('Ana4doz6bhCgnY5ufLrlTy7g8hdZiMzEaONaw1vX', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibWcxUk5oZ21HelFkaUhGdENKUlk1T0JDRG1TRlJscXVaSU5INGlKUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617695417),
('B2RPOKw33zN09Ej4J978DOfvPFvRD7rrboG6gMsI', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZnhPU0JoQ2o0SVBnZGp3VkZmaXBkM25tM0E3bDlwcnpoQkVKbWJDNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617683739),
('Br2YyZF1Ts54e9VKiIaVejgjS1Qn90fRhGtsYxcY', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0s3bndoaXF5TUtYTlJ4R1djblhiVVV3RVBEOTlzYURGSVZMWFVWQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617684949),
('C0V1yUrTkpyABBcht8SQAHZRIQDCvcdk7bAbpCYl', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFY5ZFlLSVp6ZzVXWlZJbGFXMzFMR1hLUTNETjlTVmdxbmFrbjdJcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617682227),
('cj2VYrS2KrLtpo8kaZu84YmBGh8jK98plVE5r2xn', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWo0MkZMdmU2SVpzNmxZNUgyQmQwMnYySUJBZldUdTBlOE9rZU5vdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617687350),
('clTMx6ALpIfSDvggva6TB9psszNNNmUshf9zuxSo', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDB1M2FBOVZ2V3lBaExQaXdjTmNveXhNZWZLYzlydTl2UHVRYzBJNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617691505),
('cnu8n0Zm7xzGHIZaXvPIdxjNKLMy64shRANkhYlC', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib3NxVFFMWjA5c0dicVlGR3J2c1p5Q3hDTDllb1hrV3gxN0NlcnlqTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617664810),
('crpMYWsgiVFln4B1eYusG1llrFfhLN9ytjDQyzKx', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibkxOWmR5UzFSVGFKOUduN0RKaUN1QmREZmptcEdqaFJnaDBzVlNEZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617685511),
('cWUt0RJagNJFug3thxeRE5BI83qgMtT8Qgowx2jH', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWEhQeW91TXRGeVMyZ3J6RXhzeGFpeDZ1RUpDcUlRajBHRGpKUmhlRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617696938),
('dAW6OzwV8SsyhcHw6hMvmj62MBdkJi0OasqtreSh', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXZUellPelVCeXlhMnlVSVFBME5wd2pUanBRc3RCeVpJQjZNZkdwZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617677451),
('Dksr7N8vtiVz7UGH9VHLK1vKY3Cx5w4DRe0KnW3V', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYk1XTGZ1Y05ZZ2xId3Vjd2s2c2kyMkdvNndlZ2Q0ZkYzbEVDeklFcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617670219),
('DPNjl55pohcC03urWG5JZcLlAk7diRhjgqh48YOc', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV252d1hvNjBtVnQxdWFIRDVKMWJKeDVBY1RnSmx4R1I1QnNBaTllUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617672314),
('DuZ8e3Jpehk4HDCK62HcNNFl7lyOHXw3yk8JWHPa', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicHA5QmJNOVBRUzNlOEM5MmdjcGN3YTJRTFI2SkpEZG45bGhPSWVHZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617687638),
('EKzh3stneMfTYvyGG7qsyZWtXNv64vzWtSb70mav', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia294aURxbXYxUzNRWlc0Y0RPMHhyVFJPaGdPenNuNmpXaGxnd0FwUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617679552),
('eo0LkLu14bkwc5HGH1vMdfPBuzqp5e63ybb1hcXQ', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGNEa3lUWW04T3BWaER6dFJXN05aTXN4U2RFd04zVzc1ZGc2aWpzeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617673239),
('f2r1bY9y3uyY6eORIzfRXu9CH7eq6w8zFptKAb7m', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV3JXczVhSHVwOGtQVVdKaE5hY2hsNG5ZbEpLVGpoWUFoenhvN2VtYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617692140),
('f3EgtFQKDiGEWdeatULS9SV9l9B8t4qD9r9erpQg', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnZFMVRDRFI5WE05a1EyVzVDRWZBcjVBSUlOYUFKZVdpTnhCbkhKMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617681611),
('f3lNlK90cz56x8UHgrLboKfXCM3G14rT0uDM8PsC', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXgzQVlBN21rc2NCU0hOc0RobG5ESFZCQ2NDNjJMQ3RmZHdXZTJ1RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617671446),
('f53TAfL5wBAB3bt69ycCxSm9SRne8tnjbcNMqxj8', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2RpTWFYRnkzM3M4RHVMZTJLR01WVWlvVW9PT2hNVHhpWFVNVThLeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617686436),
('f6AvlNlyR91vWwa68NV7BA4bvDFbJLzHE5noXWa1', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmJ5RTNDWlVtbnNmV1RKVlVRMVB5bkpRckRzSUxFZjdoNkV5a2ZoSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617686110),
('FmCWtsBj7DsDXhq4mlwbagDSwJWXgOYyKD1rPVCD', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieHVsOW5ldU5SMnJvTmZ3dUFWR1A0aFNTeFd1b3Vlc3R6RTZ1Tlk4TSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617694547),
('FzsIyanwVuJrz4B6OkEXTMULYTrRS1NVOK3bOaSf', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGE1ZXNIM3lCZ25GV25GTWJrVFZWUXdQQ095WGxhNkdWdWJsYTFUUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617674426),
('gEYE8jVT3UpRfAQ2tMGAWUwhZjulcovZm8WwnqLP', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVNXa0NUNXNiRHZuR2hwY0Y3ZjRyUGUzdG11bVBHOWZTcno2RURDNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617675624),
('hcmeA14jvtTEbN2dDHPgFCqbvzISgcnz5MboRECc', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUl5bE9xRXBLQTN0dlJWM0FDRW8xMUV1OUREdUhTMGtIMmUxYTNxNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617689433),
('hihc6qUIFOcuPJ44atRSpw7sayVXNmsgdMDlipAS', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUY2bVFTWFZyZ1RIMkV4Y1RqYXRWdEdpckIyak00bWUyczduRTlwMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617684021),
('hmXegBKJO97WsDdoK25oSyBG5Uj9HCH49PkMeOLT', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQW5lQ3MzWWFvN1NjSTRSRmh1OFk1ODR4czdUc2x2QWVKUDdZaGFieSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617672024),
('HOO9zJ1gWH4GivLBE4Ol4m0YmSW56sJulM61H2M0', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0ZmdFg4Q3B4V2x0Z1VhT3Z3alMyNUZGRTh4dUVodnI3MElLTU1jZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617696009),
('iiXXpVlbwH1OGxz8L3T1Ze61qTdcmID9dc9ub3AX', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjNLS2E4YUxrdHVVMHZHNXNXY2l0OU44TkpWSTdvNXRadEJVa2dKMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617673831),
('iLHiQWEhGXl9uGgoiv9o26UkqzaNF2LuLTMl3l5q', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMTFTRTJZZ0l4THdzTUkyZTBKRmVPTlVTd3V1VGd4M3pVOEduQ21rYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617685846),
('IMYbqhAyd21bANNAoasjy9WD9Nn3ItUat6lYCmK1', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienFudDg2S3lFdXJ1TnFwN25kd1FKZ3l3eXZvOWNCQ3lsTHF1SlUzQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617689146),
('IVyvbN0pDXAvMxs2h9kio2pRPmfMJ2RN7y3EvVWe', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZml3aEJaUmVNR1djdHVFU1BmUUtFU2xaZzE1bFpOUXlCOHlTbVVBTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617672616),
('j43K38GO9hCtkWzhqEJWInRoqWEItQ2M5uo66x81', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWtrY0tiRkNzQXRrbWlSeGdJekZwTVRFZG1ZUWhoOUNaOTh6dE1oSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617698718),
('J9HexBbBtyQXMqit3qKTLRt3nEckLAknODplNnxT', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2xXSUZFQlhhMko4YXd5a0NsTVlYdjhQNmtTTmRNUUcwYlNEMjRpWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617667209),
('jB02fFphyImIBrU7sdLk1aqk4bDQQCTEqHbddcIP', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiODdlMFBGQVBSaW4xSUdmVTFiZDVCODZ0c3VQRU9VRldBb293eFo2VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617693312),
('JFGVeXt415sQs8QF61rvDtFh17jc7MiijyqQjtGn', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFZWakd1WEpqODNLVWltR3V3UXRXUllhUVk3b2lORGxPZGZuTUE3MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617678344),
('jGTv3mECDaHTwLJEFUZGGiPBQKhTsGBkmxUVwwxt', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWlpRTkhBWXdsR1pWcURUSVJ2VzBOeHROMmJXQUprWGNnODNQa3BreCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617666930),
('jIGUsgLjAPqYX0tmgGun5vfmig9oq18zlM6SvTQo', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWEM2bFo5cWI4bU1heDdzRU1PSWxLejRVRDFsajRhM2JJc3hFclBycyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617677112),
('jwqciWjghDA3n6aXMKvW3Oyv6KOUBEbOm5jXqMpc', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1YwS3JHVUtHMUM0RTh6Y0FScmFHdGNaV2Vxbm9zYVhJYlUzeDVvMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617668130),
('keEI7a6CjVMKLvtQaW1G1HtuHKXCqmkAd9kBpYD5', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1pFaHNwNmRWcXdCU2NLbGNCb1BWSWtnZDZmMkZqeW9DeG5ReHM3cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617671130),
('krdatKvWPhkf3lzloJUgoTfIBvgOuQA8Wlcwz8De', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDZtTGRSME5DbDZPUlpBeDZxczk4TTY2c0FlQ2h2RDJHNkM1dEpkUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617699009),
('L1OedExkCZ6WAABQcxuWEImVywstU4I2SCfLqopo', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTdrR09Hc1kweHpTZE82NHBqendKM0t6UWJadmVONldNNEtNQU8wTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617689709),
('LIodq3ks2SlQAUplkI4YeJIjrRD9Bnn5UWJFWdLZ', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkVuZFJwcHZtcUU2VmVlTFJtUHk3QkVPRmp6V2NIU0t6andaNTEzeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617665731),
('LRPL8eIpSqTUlYk9zN4kOHLiAGoxqNRChw6NKlgN', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0JDeGxaYjhtbTMxcHJ1UlFFVHY4WHhpZFpURk5IRDg4SFdhcEhLSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617697246),
('lRvsHDYVYTS2jdwfF0BrmFlEl9rmTtPk47GWBQLb', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblA1UVJrakFkZ2hobURUS1pxMWxoZDJnSFhyNnBkSWZESFpKaU1EaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617675027),
('MGKcaTebs8T9JtJQVTvQQXnPubu3c5yJ1eGJDsiy', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWlVTGZpY21Rb2MwclBabXgyOU51Yk9vQXFkRUtjYWhxbGxhSXZRQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617680450),
('MiQKOJzLnVuHcbirjhJnTbVuGOStDFkW1Qi6XgeO', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjJzWDA2WGlSY2VjeEVtekhzYlVOMzUyajVuWnNIeVJrZkdvWlRZZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617684615),
('n43MkZmRHcLmBYR3oezHzgIq3C5OvKI3Uk2R7A6p', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFl6YWRLb3RiRnNtM1JkU2k2ZEtPd0lWaFQxenNpS210TzNhZnQ0UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617686714),
('NaLlqY5eZ5nNdegkFgUuZio2V06H9PzhUgMTxKUN', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGVhV3NRbWRBdzhCdjNWYklJT21DRDc1TlNkd3JmRkgwN2t4VVBmWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617683407),
('nfbIC1Ka8YwdcU6U9u6XcKvvqd7l45eKVoCdYFVL', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2VzYlJDdXd3NDVCQkxadWJuYXdFUjVwQ1pFaUM1RnRoUXpKdkhhUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617691815),
('nFZUmNdFbVTqU6q3EMJkHdH6caHn5mi3VL4cP83b', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVdOYWI0bWRKQzFObGxlSHNCT0prTUJLZmtEVUdMa1pXWDVQMlAyQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617666010),
('nHMX9zOMAcXhoXkQi20K9Z6qDkNsMxEBTJrei0d2', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibDJzQWhKbnJ6M2FKSVVQSklualpWTEszNE1DQ3BXbkdUZGc4a3dOOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617694213),
('NK0QRGH5NvWaqRBTCFlLRnPwsHGBoSWL8tqmwJJe', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0hpaGRha2FVUlQ0Tkk5cVd6c05wenZLcjFPekhRU1RZNGRyQXIyYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617688229),
('nTq2me68vCNGzrmg5xqXtyLKhGLWDzIj4Ge5mlBz', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieEIzWkwzdzI0a0o0TTB3Z3Q1MlNDQ1c1STJnQWV0dUVSRUlHU2V1byI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617670526),
('nwNOEOdExv5NqodbwpkVhsFtnLpaXMqOE2kMx0rp', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnMyMU54QWZmbWdiVkYwTjRCREQ0cWN0eTlBekozYVRidDdzeW1NbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617665129),
('O21yFWjUt0n2rXMKWTmFqWKiRhRsNNclawWSIsRG', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGcyTjJIMHdSdGpSTjlmNmZOTDNXbjRxelV4cWRlOEEwWEo4T1VPYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617676241),
('oBnlpYN7jB7Ok8JgxiaWjy4C9orBkj48phMBESMQ', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUh0THZFRU1ySWIyVmFkMG00bXhMV1NhQWM0cnFURUNFS3RsS1lwbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617667815),
('oiSmmz3cwxmKN9Yn2wDpiCLVEsMkyijb6Jb4NXxb', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiemhMZ2hqa1plYjdua2FQNGhFaUFjeU45RVh4REtlRVJiaGJBVTlBVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617690637),
('Ok5OilUD5GHHN3gsDi9hXBKrinbOGDkxxPTEFKVJ', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlR5MWZucmltRDR4RUQ2a2xJMFBlUEw2TURlbUNiRzRBdHZjSVNHViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617669330),
('ovu5cC37TLlaJzMx03HcurMtKgB3Nand1pUPOS2u', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVlXcDVJcG5ibFQ5N202ZjhQOXI0Y3E3WU1MQXc5YUl0YWdxR0w1OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617687030),
('p6wmgFBYXVKbZ6HWhW9d3qBkKAM5vnjGDIe4MOwD', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlhZSzVuazZsSkE4M243WWRJMFI0YWZKZWQ1OTZZVnBBUlFtU3FNZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617696307),
('PFUA98rsos6evlt4hnB9wJoivsIFEjDRoqZnsFZP', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1R1VEFHNU5ZeTgza1RNMWp1RGdOMmwySHRuUkd3SENsNHVZUFU1RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617679836),
('PlexQIXirhcAEXYfvNPDAmZhfCmgEJwvHOeHqaZU', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGpnZ0NGZUxORE5vU3FwRjFsOW9YMk41WTVGNU9UbEZtUkZDTW5QTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617688809),
('pRP41U89iVofcSQVaVugliOIGdG5GrNsGxClN28Q', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUVzRHM1TVpuN0xQQWx5NTdWb3J5dnZkVTdzRURTMWtoeUZwalBrUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617673542),
('pVBdx0UA7EUiMNVqp7Oxq8zOlgeQr02qyVdY5Qhx', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiclhmQlRkNEZSbEV5NVRXeU5HbG1KeXdFMlVDY05sQmJ5QkcwTEJhSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617680733),
('QBxiitsY4RPhnvZVXVlTSZceswDv9ced9qQi2R9M', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiamtlbzdsamt4QTZmSDk5NEl2dEtmVDlUY05RV05nZlIwUmZEb0JoTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617669038),
('QGaVOzyvssrIxu57gUGVP5bQl608kbZiHDVitkaO', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0hGVUhVZEJXWGZSeEZvSWZRSHZBNnNVbjd0cmFWV3FuZFdkTExGUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617684346),
('QJdLlvNkFJbxDDIwZ6ODcwYJgaUEsXmDThxZPpp3', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieWxrUVJWSHlEY0dSY3pFY2JuTUh2S0p3Rlp1NkhZSndjMENud1FnZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617692412),
('QmBpz0gMdcWcQatzuVW64cLJ34TlFOSsQCAja5s5', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUtoMDBkcW9xQ1BjVGJWVFpwREpoc1BLRUtNVFh0SXcyS2pvdWtsTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617666624),
('qxPhRtGkqpfU59JBNR69ZH9cFkr1FSXN1YCuo3TZ', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmNocE1jU3R2VDA2dXhGR0hicFhrbnI0Y29qSDNlVXhuNTlZRGM5ZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617667510),
('rlVZe7Hu6LSQp0oXbcU1rbiSpct6kfT4azwLUSeR', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1FXQklOZUpwT0JLNXhqWWRtOWNERWtrY2pQelo2d3FqcTdDejM2NCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617688534),
('rX36iU4EayFmZqWOGt6LnqKBILDPm1qLf79x9mfZ', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZU1IcEJLNzRWOHFSYWd6clNSMFc5TWpScjJFREtLUjVLTWhJQnpaUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617695732),
('S1vgz5vlC63AQAFRGrPGs1cWknqQ4P1X5V97sYgU', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3RaUHliUU1VWFN0clhJQjM3OTJKQ2NjMlhIT0ZkWmtNTjk5eldnSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617685233),
('s8owMnPJ2GokxAsR1gCi6EnRdjFrNdHQcpVXu6Wc', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic0o5Z05iR0N0OVZMTGsyQnpsSno5S1VITVdtZVBQTTAzanh4dGthTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617669622),
('SaiE9MEad7cVTn4uDhR8wwMoe3hjRusZLeVEu6Pu', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1V5Z0RwUXlQYVpJa001cVhiYkZCaUNGUERONWp5VkZvOWtNYzhOUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617676814),
('SBLgsODrVjlPxm3FEO9TmfyV15f4LIKYBSB5YYL5', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicmRUeEdRamtSdGRuVkhla25KVzRwbUczRlpocnVCVENoT2Rpeng4SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617693652),
('T7QHV7Me5F1sBGzQtcsH6JnDSqt3xc6rwjmi78VZ', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmhzbHIya0pCaXBHanQwOTNoaW5TUDh2d0dPYkpGbGJ6cDM0aEN6cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617676511),
('TQSqz031jCD7qA5vziXFj74L9xMkCv1DSPKmkWIc', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicFFtZ3NmMjROM3hrckI3YnJWN09RNEhnSmIzT0VBZVFrSFJRQzlVaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617674121),
('uAZLRP5aBPs7BuhdW9Tr0xy6TKk2v7ON1SmbYuxr', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiakFNVjl1R21Pd2hydGYzTm90M25kSTBtR0MwM0FOYnBiR29Ec2FPMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617687950),
('ucSUumuqpNap0GVBZKQNKLQCvhNa4i6Vj943rXIw', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGpPU1pEVjRvbmVVaDl0dW5iZkpETk5sVlFzMG5LRG5ad0d1OG0zUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617683115),
('uoxpwtbBN7glkbsMI2cCrsp2McmIyfCCtiWYSjNc', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzhTWTRLUW1qdFhBeWt3dUE1eDFmaktabXFWb0oxREJmQ0tPTnZwZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617690336),
('VlJpw1LkzwrUmAJyWLt4Efe9uKLpZJMvZRdgIVF8', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZm52YTJIbE9kZ0dDcGNiVnhsV2ZhTUptU0pBc1ZBQkhkSGZUdW1aSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617674716),
('VNgRk95iFHGIGOZTea92zWpjLpFuZE5WBdWdURGu', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDMzVnNmTFJ0TjcyeUl3Y1MxMzRCYTJ4dFF3TDI1aUlEVXk4ZTlpeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617665449),
('VRsVVwn1ldWdjP0of2OayoiYxU7qFloCUaIhTfTq', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0FlT091bjd1eXBqZElmZnk4M25hM3lhaXpFazF1M0VyZERtWmRYQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617693044),
('vV5gsXqUy1R5GNvY3HXegXGyrbVozv5Bv4Kz706N', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXRrbzV0ckpMOGw1V1huY1l4ZEFVMVU5ajVZYjIwVjFweU1hbjFpTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617697834),
('wERHE358m5tBIAMJtBXDksUNga96prX4mkxmLRIj', 19, '197.210.54.59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:85.0) Gecko/20100101 Firefox/85.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiampGRmRRbXQzZmJtMXlxZWsxUXA4OTlQeTVPR1dwTmZvbHVhSkFuciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxOTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJDBJR3AvbnE0cEsuSXJZYzRLaklEMXVXeU5VcUdLS21sYzZjN1NjVXk3YTA4ZU1ZV0hvUHlTIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCQwSUdwL25xNHBLLklyWWM0S2pJRDF1V3lOVXFHS0ttbGM2YzdTY1V5N2EwOGVNWVdIb1B5UyI7fQ==', 1617696154),
('WhmMUYO3K7uSOucquTiSPYc6wFc77ZJC2f8OUffC', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHhIbFYwcXMzZ2R5WXFjMXdQZmdTaFJiR3VXWUtzU1FaRHJDS2xRZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617697541),
('YdBr1nKyod4Nppd0CT8Qvte2F70GzDTvLrmgmUbW', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3JCcnllM3gyblZ4TTBZckhwYndhWjJTODgzR09KYUNTMDMwbmVEeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617691217),
('yEkJR54vSQuQoku3UGPlHNZNY5Rpb8VDfkgzeXF8', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0pYOWpwdmxwTTg5Y213NXpGNER5ZnloVk9uWlhERlJPR1A2M1FsYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617690947),
('ym63TbeZUWl3dJKrAHzXt5k2octyEGtEDpvrK9uo', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVDdzbFBUa0hxekNOajlOcGx3eE1Gbno3UTFKODFWcGFqeVFzMXFPTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617698445),
('zH8jQpe3K7zouGY3GmYjC8pt1eKe8CxBydcs34u7', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibnlFQjFnaFRFRWJWOHBZcm55T3dtVmdmbVg1Rjh1OHdKYXVGNzZPZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617668448),
('Zhosv74vssndBnWnmH0BPZsik2WT95M4WJOsfryn', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieHFZZ1paRnBTZE9zN1RWbk1sdGw1V0tVdkpncDJKMGZScER4ekRmYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617666314),
('ZNMnOmMfSH9YkhWFIhIyQTxH4Rcx79X3Jh4t5Xy3', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjFpcG4zTDdNdTUxQU1Ud2tuaWY3bk9RTmZmQmRERjdiWTN1dE5zNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617695140),
('zreHTTjeXan6HTdhk0EKHZaPJt3pwVMtGDDdtEON', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHVjYWpoSjNPcDdYV0libGNGbDhYTTJPdnB2QUY4em1rdmpKb2tRTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617669923),
('zReOpgL8dqkL3NDGvuwm1zj0BXRtmTDzqlLE2rFl', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialBha0RLamZycU1PVDFWUkdQTmNVMUNEek1QanN3bUsyVnpFb1ZTZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617670848),
('ZVdyDqAv5ZSik1GSxZfegT2D1ftg3B7hq6FJ573m', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHpKMWlFcGo3QWdDOHI0UWFvWURQc0NEMWhtWHdqQTh6TmZxeUFQMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617668704),
('zwBKsqtiePrB9pkmBGpLsYKsIKJPfGFGCe0nn2jW', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiempCYnp5WHFnTzRCOG9tYllwSmhkbjBwbEs2ZXEybW5ST2J1ZnhhayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617692715),
('zX8rOBRLPFq7HT8DZ9TB1wy1JUB4D3ckx20CjRNF', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlhxRFk2NTh6cjJoSXpDNzNneXoxVmZvNjVWNUU1elI2bmM5N0F3NCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617678606),
('ZXg0KaH7VfkCI9zCCNSTLdl8Nq890f3PAujqgrr3', NULL, '198.54.116.212', 'Wget/1.12 (linux-gnu)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDlQMmxEb1l1bFVRTmRzOGVQc3JUbURRYXFKMnFIMWhqRXRkWDRnTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb25saW5lZnguYnJ5bmFtaWNzLnh5ei9jcm9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1617694850);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eth_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ltc_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_s_k` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_p_k` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_cs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_ci` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_translate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weekend_trade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_commission5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signup_bonus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `files_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tawk_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_2fa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `enable_kyc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `enable_with` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_verification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `withdrawal_option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'auto',
  `dashboard_option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_preference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_annoc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_fee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthlyfee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quarterlyfee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yearlyfee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `newupdate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `description`, `currency`, `s_currency`, `bank_name`, `account_name`, `account_number`, `eth_address`, `btc_address`, `ltc_address`, `payment_mode`, `location`, `s_s_k`, `s_p_k`, `pp_cs`, `pp_ci`, `keywords`, `site_title`, `site_address`, `logo`, `favicon`, `trade_mode`, `google_translate`, `weekend_trade`, `contact_email`, `referral_commission`, `referral_commission1`, `referral_commission2`, `referral_commission3`, `referral_commission4`, `referral_commission5`, `signup_bonus`, `files_key`, `tawk_to`, `enable_2fa`, `enable_kyc`, `enable_with`, `enable_verification`, `withdrawal_option`, `dashboard_option`, `site_preference`, `enable_annoc`, `commission_type`, `commission_fee`, `monthlyfee`, `quarterlyfee`, `yearlyfee`, `newupdate`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'E-Trade', 'We are online', '$', 'USD', 'International BNK', 'Admin account c', '99388383', 'sdjkbhfff', 'ksjhhjhdjd', 'jjhhdhdhd', '123567', 'Local', 'sk_test_4eC39HqLyjWDarjtT1zdp7dc', 'pk_test_TYooMQauvdEDq54NiTphI7jx', 'jijdjkdkdk', 'iidjdjdj', 'E-Trade, forex, cfd,', 'Welcome to E-Trade', 'https://onlinefx.brynamics.xyz/', 'upload-logo.png1617292120', 'upload-favicon.png1617293031', 'on', 'on', 'true', 'support@onlintrader.com', '40', '30', '20', '10', '5', '1', '0', 'OT_viXHf', 'tawk to code', 'no', 'yes', 'false', 'false', 'manual', 'dark', 'Web dashboard only', 'on', NULL, NULL, '30', '40', '80', 'Welcome to E-Trade version 3 with a lot of Security Features', NULL, NULL, '2021-04-02 20:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `testimonies`
--

CREATE TABLE `testimonies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `what_is_said` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonies`
--

INSERT INTO `testimonies` (`id`, `ref_key`, `position`, `name`, `what_is_said`, `picture`, `created_at`, `updated_at`) VALUES
(2, 'mZVhqO', 'Bosh direktor', 'Rustamov T', 'Men bu platformani yaxshi ko`raman', 'upload-testimonial-1.jpg1617292794', '2021-04-01 15:00:56', '2021-04-01 15:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `tp__transactions`
--

CREATE TABLE `tp__transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tp__transactions`
--

INSERT INTO `tp__transactions` (`id`, `plan`, `user`, `amount`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Starter', 9, '50', 'Plan purchase', '2021-03-11 11:29:46', '2021-03-11 11:29:46'),
(2, 'Credit', 13, '100', 'Deposit', '2021-03-11 13:53:32', '2021-03-11 13:53:32'),
(3, 'Credit', 9, '10', 'Deposit', '2021-03-11 13:53:57', '2021-03-11 13:53:57'),
(4, 'Credit', 9, '10', 'Ref_Bonus', '2021-03-11 13:55:43', '2021-03-11 13:55:43'),
(5, 'Starter', 9, '20', 'ROI', '2021-03-11 14:03:06', '2021-03-11 14:03:06'),
(6, 'Credit', 9, '50', 'Deposit', '2021-03-12 13:34:08', '2021-03-12 13:34:08'),
(7, 'Credit', 18, '100', 'Deposit', '2021-03-19 12:58:10', '2021-03-19 12:58:10'),
(8, 'Credit', 19, '100', 'Deposit', '2021-03-22 09:33:39', '2021-03-22 09:33:39'),
(9, 'Starter', 19, '50', 'Plan purchase', '2021-03-22 09:34:27', '2021-03-22 09:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `upgrades`
--

CREATE TABLE `upgrades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(11) DEFAULT NULL,
  `times` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE `userlogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(11) DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_style` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dark',
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acnt_type_active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eth_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ltc_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_bal` int(11) NOT NULL DEFAULT 0,
  `roi` int(11) NOT NULL DEFAULT 0,
  `bonus` int(11) NOT NULL DEFAULT 0,
  `ref_bonus` int(11) NOT NULL DEFAULT 0,
  `signup_bonus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auto_trade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonus_released` int(11) NOT NULL DEFAULT 0,
  `ref_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_verify` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entered_at` datetime DEFAULT NULL,
  `activated_at` datetime DEFAULT NULL,
  `last_growth` datetime DEFAULT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `trade_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `act_session` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `dob`, `address`, `country`, `phone`, `dashboard_style`, `bank_name`, `account_name`, `account_number`, `acnt_type_active`, `btc_address`, `eth_address`, `ltc_address`, `plan`, `user_plan`, `account_bal`, `roi`, `bonus`, `ref_bonus`, `signup_bonus`, `auto_trade`, `bonus_released`, `ref_by`, `ref_link`, `id_card`, `passport`, `account_verify`, `entered_at`, `activated_at`, `last_growth`, `status`, `trade_mode`, `act_session`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(19, 'Test User', 'test1234@happ.com', '2021-03-19 13:11:26', '$2y$10$0IGp/nq4pK.IrYc4KjID1uWyNUqGKKmlc6c7ScUy7a08eMYWHoPyS', NULL, NULL, '1998-06-18', 'Midreds', 'Nigeria', '8377373', 'dark', NULL, NULL, NULL, NULL, 'jhjdhhdhdhhdhd', NULL, NULL, '1', '2', 300, 0, 0, 0, 'received', NULL, 0, NULL, 'http://127.0.0.1:8000//ref/19', 'upload-2.jpg1617297783', 'upload-4.jpg1617297783', 'Under review', '2021-03-22 10:34:28', NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, '2021-03-19 13:10:29', '2021-04-02 22:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_plans`
--

CREATE TABLE `user_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inv_duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `activated_at` datetime DEFAULT NULL,
  `last_growth` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wdmethods`
--

CREATE TABLE `wdmethods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maximum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charges_fixed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charges_percentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wdmethods`
--

INSERT INTO `wdmethods` (`id`, `name`, `minimum`, `maximum`, `charges_fixed`, `charges_percentage`, `duration`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bitcoin', '10', '10000', '0', '2', 'Instant', 'withdrawal', 'enabled', '2021-03-11 11:53:32', '2021-03-11 11:53:32'),
(2, 'Ethereum', '10', '2100', '0', '0', 'Instant', 'withdrawal', 'enabled', '2021-03-22 10:36:03', '2021-03-22 10:36:03'),
(3, 'Litecoin', '100', '10000', '0', '0', 'Instant', 'withdrawal', 'enabled', '2021-03-22 10:36:33', '2021-03-22 10:36:33'),
(4, 'Bank transfer', '10', '2100', '0', '0', 'Instant', 'withdrawal', 'enabled', '2021-03-22 10:37:08', '2021-03-22 10:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `txn_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `uname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_deduct` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_transactions`
--
ALTER TABLE `cp_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mt4_details`
--
ALTER TABLE `mt4_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonies`
--
ALTER TABLE `testimonies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp__transactions`
--
ALTER TABLE `tp__transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upgrades`
--
ALTER TABLE `upgrades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogs`
--
ALTER TABLE `userlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_plans`
--
ALTER TABLE `user_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wdmethods`
--
ALTER TABLE `wdmethods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `cp_transactions`
--
ALTER TABLE `cp_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mt4_details`
--
ALTER TABLE `mt4_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonies`
--
ALTER TABLE `testimonies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tp__transactions`
--
ALTER TABLE `tp__transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `upgrades`
--
ALTER TABLE `upgrades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlogs`
--
ALTER TABLE `userlogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_plans`
--
ALTER TABLE `user_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wdmethods`
--
ALTER TABLE `wdmethods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
