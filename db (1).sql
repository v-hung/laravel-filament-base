-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Mar 25, 2026 at 06:15 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json NOT NULL,
  `slug` json NOT NULL,
  `description` json DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active, inactive, archived',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"vi\": \"Tin mới\"}', '{\"vi\": \"tin-moi\"}', '{\"vi\": null}', 'active', '2026-02-27 09:23:13', '2026-02-27 09:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json NOT NULL,
  `slug` json NOT NULL,
  `description` json DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active, inactive, archived',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `title`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Wooden Hook\", \"vi\": \"Móc Gỗ\", \"zh_CN\": \"木制挂钩\"}', '{\"en\": \"wooden-hook\", \"vi\": \"moc-go\", \"zh_CN\": \"mu-zhi-gua-gou\"}', '{\"en\": \"Hooks made from natural wood, durable and stylish, perfect for hanging clothes or decorations.\", \"vi\": \"Móc được làm bằng gỗ tự nhiên, bền đẹp, thích hợp treo quần áo hoặc đồ trang trí.\", \"zh_CN\": \"由天然木材制成的挂钩，耐用美观，非常适合悬挂衣物或装饰品。\"}', 'active', '2026-03-01 16:41:18', '2026-03-14 17:52:47'),
(2, '{\"en\": \"Metal Hook\", \"vi\": \"Móc Sắt\", \"zh_CN\": \"金属挂钩\"}', '{\"en\": \"metal-hook\", \"vi\": \"moc-sat\", \"zh_CN\": \"jin-shu-gua-gou\"}', '{\"en\": \"Hooks made of sturdy metal, strong enough to hold heavy items or tools.\", \"vi\": \"Móc bằng sắt chắc chắn, chịu lực tốt, dùng treo đồ nặng hoặc dụng cụ.\", \"zh_CN\": \"由坚固金属制成的挂钩，承重能力强，适合悬挂重物或工具。\"}', 'active', '2026-03-02 15:01:07', '2026-03-14 17:52:54'),
(3, '{\"en\": \"Plastic Hook\", \"vi\": \"Móc Nhựa\", \"zh_CN\": \"塑料挂钩\"}', '{\"en\": \"plastic-hook\", \"vi\": \"moc-nhua\", \"zh_CN\": \"su-liao-gua-gou\"}', '{\"en\": \"Hooks made from premium plastic, lightweight and convenient, suitable for hanging light items.\", \"vi\": \"Móc làm từ nhựa cao cấp, nhẹ, tiện dụng, phù hợp treo vật dụng nhẹ.\", \"zh_CN\": \"由优质塑料制成的挂钩，轻便实用，适合悬挂轻物。\"}', 'active', '2026-03-02 15:01:19', '2026-03-14 17:52:56'),
(4, '{\"en\": \"Wooden Flooring\", \"vi\": \"Gỗ Nền Nhà\", \"zh_CN\": \"木地板\"}', '{\"en\": \"wooden-flooring\", \"vi\": \"go-nen-nha\", \"zh_CN\": \"mu-di-ban\"}', '{\"en\": \"Natural wood used for flooring, durable and elegant, enhancing the beauty of any space.\", \"vi\": \"Gỗ tự nhiên dùng làm sàn nhà, bền chắc, tạo vẻ đẹp sang trọng cho không gian.\", \"zh_CN\": \"用于地板的天然木材，耐用且优雅，为空间增添美感。\"}', 'active', '2026-03-02 15:45:38', '2026-03-14 17:52:58'),
(5, '{\"en\": \"Garden Flooring\", \"vi\": \"Nền Vườn\", \"zh_CN\": \"花园地面\"}', '{\"en\": \"garden-flooring\", \"vi\": \"nen-vuon\", \"zh_CN\": \"hua-yuan-di-mian\"}', '{\"en\": \"Outdoor flooring, ideal for gardens or patios, weather-resistant and easy to maintain.\", \"vi\": \"Sàn ngoài trời, thích hợp cho vườn, sân chơi, bền với thời tiết và dễ bảo trì.\", \"zh_CN\": \"户外地面，适用于花园或庭院，耐候且易于维护。\"}', 'active', '2026-03-02 15:45:48', '2026-03-14 17:53:00'),
(6, '{\"en\": \"Premium Hanger Line\", \"vi\": \"Dòng Sản Phẩm Cao Cấp\", \"zh_CN\": \"高端衣架系列\"}', '{\"en\": \"premium-hanger-line\", \"vi\": \"dong-san-pham-cao-cap\", \"zh_CN\": \"premium-hanger-line\"}', '{\"en\": \"Premium hanger line specially designed for vests, suits, high-fashion apparel, and showrooms, featuring a sturdy structure, smooth finish, and excellent garment shaping capabilities. Ideal for fashion brands, high-end boutiques, and custom manufacturing.\", \"vi\": \"Dòng móc treo cao cấp được thiết kế chuyên dụng cho vest, suit, thời trang cao cấp và showroom, với kết cấu chắc chắn, bề mặt hoàn thiện mịn và khả năng giữ form trang phục tốt. Phù hợp cho thương hiệu thời trang, cửa hàng cao cấp và sản xuất theo yêu cầu\", \"zh_CN\": \"高端衣架系列专为马甲、西装、高级时装和展厅设计，结构坚固，表面光滑，能很好地保持服装的形状。适用于时尚品牌、高端精品店和定制生产。\"}', 'unlisted', '2026-03-24 07:19:42', '2026-03-24 21:08:47'),
(7, '{\"en\": \"Standard Product Line\", \"vi\": \"Dòng Sản Phẩm Tiêu Chuẩn\", \"zh_CN\": \"标准产品线\"}', '{\"en\": \"standard-product-line\", \"vi\": \"dong-san-pham-tieu-chuan\", \"zh_CN\": \"standard-product-line\"}', '{\"en\": \"The standard hanger line is suitable for hanging regular clothes, for home use, stores, and large-scale production. Optimized design for daily use, stable durability, and reasonable cost.\", \"vi\": \"Dòng móc treo tiêu chuẩn phù hợp cho treo quần áo thông thường, gia đình, cửa hàng và sản xuất số lượng lớn. Thiết kế tối ưu cho sử dụng hàng ngày, độ bền ổn định và chi phí hợp lý.\", \"zh_CN\": \"标准衣架系列适用于悬挂普通衣物，适用于家庭、商店和大规模生产。优化设计，适合日常使用，耐用性稳定，价格合理。\"}', 'unlisted', '2026-03-24 20:50:40', '2026-03-24 20:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `width` int UNSIGNED DEFAULT NULL,
  `height` int UNSIGNED DEFAULT NULL,
  `folder_id` bigint UNSIGNED DEFAULT NULL,
  `custom_properties` json DEFAULT NULL,
  `generated_conversions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `uuid`, `name`, `file_name`, `mime_type`, `size`, `width`, `height`, `folder_id`, `custom_properties`, `generated_conversions`, `created_at`, `updated_at`) VALUES
(8, NULL, 'e6c5787eb052c580ce17917e529208e4c0f46ec5', '8c94292f-374a-4848-8973-8b02003bd57c.jpg', 'image/jpeg', 2262836, 2048, 2048, 6, '{\"original_name\": \"e6c5787eb052c580ce17917e529208e4c0f46ec5.jpg\"}', '{\"Product_images_thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"82d7e6be-0c3d-4a3d-862d-c533fdcb24c0-thumb.jpg\", \"generated_at\": \"2026-03-25 04:18:22\"}}', '2026-02-28 17:34:36', '2026-03-24 21:18:22'),
(9, NULL, '5bba7b68c4d86f2160216aca09c791b7996f359f', 'e080c7ae-7ac2-45a9-a105-fc9b689eca2c.jpg', 'image/jpeg', 59400, 449, 370, 9, '{\"original_name\": \"5bba7b68c4d86f2160216aca09c791b7996f359f.jpg\"}', '[]', '2026-03-01 16:19:45', '2026-03-01 16:19:45'),
(10, NULL, '021b7615866d560d7c3059c43de2dbc1c733ac19', '799ca195-1422-462c-8123-5da3bcd75fed.jpg', 'image/jpeg', 2817796, 2048, 2048, 9, '{\"original_name\": \"021b7615866d560d7c3059c43de2dbc1c733ac19.jpg\"}', '[]', '2026-03-01 16:19:45', '2026-03-01 16:19:45'),
(11, NULL, 'a3fa495e7cd7f0f7b69bb6068f3d183d5bcbd324', '5dd53b2a-9362-4d91-8128-c42da66ac208.jpg', 'image/jpeg', 2823393, 2048, 2048, 9, '{\"original_name\": \"a3fa495e7cd7f0f7b69bb6068f3d183d5bcbd324.jpg\"}', '[]', '2026-03-01 16:19:45', '2026-03-01 16:19:45'),
(12, NULL, '039e703958319fdbb65073e4c71617e80613a6ac', '881adc69-eade-4d99-b63f-13424493826d.jpg', 'image/jpeg', 2848535, 2048, 2048, 9, '{\"original_name\": \"039e703958319fdbb65073e4c71617e80613a6ac.jpg\"}', '[]', '2026-03-01 16:19:45', '2026-03-01 16:19:45'),
(13, NULL, '31bbdfd72dabc42ce0f484ed673a9eeed04b7058', 'b80b29f1-54a5-45c4-9848-cadc01629251.jpg', 'image/jpeg', 2810155, 2048, 2048, 9, '{\"original_name\": \"31bbdfd72dabc42ce0f484ed673a9eeed04b7058.jpg\"}', '[]', '2026-03-01 16:19:45', '2026-03-01 16:19:45'),
(14, NULL, '6ae6a8154b8da77d5497136c18e9cf950cb465fc', '196a1a4c-e587-4769-9bf4-79dba3d6871f.jpg', 'image/jpeg', 2295717, 2048, 2048, 6, '{\"original_name\": \"6ae6a8154b8da77d5497136c18e9cf950cb465fc.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"466215c5-954a-4be9-96bf-6a17bcc47a98-thumb.jpg\", \"generated_at\": \"2026-03-02 13:24:40\"}}', '2026-03-01 16:24:40', '2026-03-01 16:24:40'),
(15, NULL, '5a3cf0419bb4081aeab37817439286ed84ab4a9e', '91fc82b9-800a-4b0a-91d3-74eb8c2844c3.jpg', 'image/jpeg', 2369474, 2048, 2048, 6, '{\"original_name\": \"5a3cf0419bb4081aeab37817439286ed84ab4a9e.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"9d6e9acb-2df1-4ac5-a6e6-865c6e23bbdc-thumb.jpg\", \"generated_at\": \"2026-03-03 12:48:51\"}}', '2026-03-02 15:48:51', '2026-03-02 15:48:51'),
(16, NULL, '5fcb1ad8aff20a1a9fb65a57cf8b4281d7241dc0', 'efc0bd4c-818a-4c0b-8f66-aef254f7eb51.jpg', 'image/jpeg', 2345502, 2048, 2048, 6, '{\"original_name\": \"5fcb1ad8aff20a1a9fb65a57cf8b4281d7241dc0.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"1e03364f-6c8c-4a02-b098-06c592a646de-thumb.jpg\", \"generated_at\": \"2026-03-03 12:49:15\"}}', '2026-03-02 15:49:15', '2026-03-02 15:49:15'),
(17, NULL, 'b612c9b432fdc4433a5f08cd57ccd4d70349ff17 (1)', '10130174-f160-4be2-afd5-b54f9efbc43a.jpg', 'image/jpeg', 2222867, 2048, 2048, 6, '{\"original_name\": \"b612c9b432fdc4433a5f08cd57ccd4d70349ff17 (1).jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"a30b924b-cd47-4cd1-b748-5dc4361eb5fc-thumb.jpg\", \"generated_at\": \"2026-03-03 12:57:05\"}}', '2026-03-02 15:57:05', '2026-03-02 15:57:05'),
(18, NULL, '526a70dca49582b88c4598820336312a9fd43e95', 'd8369cad-6c16-4e79-9deb-c8512823d1f3.jpg', 'image/jpeg', 2092102, 2048, 2048, 6, '{\"original_name\": \"526a70dca49582b88c4598820336312a9fd43e95.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"184dfdcd-34ad-4294-9c72-0d76844b598e-thumb.jpg\", \"generated_at\": \"2026-03-03 12:58:44\"}}', '2026-03-02 15:58:44', '2026-03-02 15:58:44'),
(19, NULL, 'd09371d8d3c38a892b0b7737b6833038a24fccec', '759fe7fd-cb4d-4a0f-bfd7-e50b59a5d429.jpg', 'image/jpeg', 2327548, 2048, 2048, 6, '{\"original_name\": \"d09371d8d3c38a892b0b7737b6833038a24fccec.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"cc8ee581-52d2-448e-b241-93c117a5f7d0-thumb.jpg\", \"generated_at\": \"2026-03-03 12:59:09\"}}', '2026-03-02 15:59:09', '2026-03-02 15:59:09'),
(20, NULL, 'fa618adb51d3d70aaf107893f73c75de08d7081f', '8a6d2e30-b7dd-4d23-80be-138ee3e4f859.jpg', 'image/jpeg', 2431464, 2048, 2048, 6, '{\"original_name\": \"fa618adb51d3d70aaf107893f73c75de08d7081f.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"5c714d15-14a0-4a1c-b997-16afb4cfd9f5-thumb.jpg\", \"generated_at\": \"2026-03-03 12:59:28\"}}', '2026-03-02 15:59:28', '2026-03-02 15:59:28'),
(21, NULL, '0ba21c9b65cab097d45b9f0223d46b2e3a36533d', '3ac1092e-8ada-4903-9fe8-34ee227dd8d8.jpg', 'image/jpeg', 2593577, 2336, 1824, 6, '{\"original_name\": \"0ba21c9b65cab097d45b9f0223d46b2e3a36533d.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 312, \"file_name\": \"ea9332b5-2f69-4725-9fb5-598ab9097988-thumb.jpg\", \"generated_at\": \"2026-03-03 13:03:31\"}}', '2026-03-02 16:03:31', '2026-03-02 16:03:31'),
(22, NULL, '9fdb59f22192e23f462b098875dc4028acfbec2c', 'b74116ae-cc05-4d3c-9722-799837ddae18.png', 'image/png', 2046055, 1024, 1536, 6, '{\"original_name\": \"9fdb59f22192e23f462b098875dc4028acfbec2c.png\"}', '{\"thumb\": {\"width\": 267, \"height\": 400, \"file_name\": \"49c6a7d7-b1c0-4cef-be60-35796719c9e7-thumb.png\", \"generated_at\": \"2026-03-03 13:05:35\"}}', '2026-03-02 16:05:35', '2026-03-02 16:05:35'),
(23, NULL, 'a83d42efd7c1a0a940b92bd7a567433086619d5a', '1d438d82-2b9c-4ded-8a5c-7cdbe8303457.jpg', 'image/jpeg', 2683674, 2240, 1888, 6, '{\"original_name\": \"a83d42efd7c1a0a940b92bd7a567433086619d5a.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 337, \"file_name\": \"8d7cedf5-f2e3-4170-889c-8d43eb0ca17f-thumb.jpg\", \"generated_at\": \"2026-03-03 13:07:58\"}}', '2026-03-02 16:07:58', '2026-03-02 16:07:58'),
(27, NULL, '4a76d5a95f0bbe507886a27bd3fab76e7427894b', '59ca2375-61c0-4df5-9318-61522a092c2e.png', 'image/png', 1205197, 1152, 896, 6, '{\"original_name\": \"4a76d5a95f0bbe507886a27bd3fab76e7427894b.png\"}', '{\"Product_images_thumb\": {\"width\": 400, \"height\": 311, \"file_name\": \"d8301eb7-10c3-4989-a87c-1f5ac6d5fcf7-thumb.png\", \"generated_at\": \"2026-03-24 12:52:49\"}}', '2026-03-08 19:17:53', '2026-03-24 05:52:49'),
(28, NULL, '0a9bfee0a5dffefe7909e9310a0a844cd957846c', 'af1be88d-4d98-4dde-a986-61a99d88515d.jpg', 'image/jpeg', 2496408, 2336, 1824, 6, '{\"original_name\": \"0a9bfee0a5dffefe7909e9310a0a844cd957846c.jpg\"}', '{\"Product_images_thumb\": {\"width\": 400, \"height\": 312, \"file_name\": \"1212fc70-c8c5-494b-af54-794ea3eff209-thumb.jpg\", \"generated_at\": \"2026-03-09 16:18:03\"}}', '2026-03-08 19:17:53', '2026-03-08 19:18:03'),
(29, NULL, '29a00070270fc5c97a517e84d73b8ab5211ae87f', 'c0aff48c-c0f5-47a5-acd5-a9bfd4c4b8ab.png', 'image/png', 1316614, 1152, 896, 6, '{\"original_name\": \"29a00070270fc5c97a517e84d73b8ab5211ae87f.png\"}', '{\"Product_images_thumb\": {\"width\": 400, \"height\": 311, \"file_name\": \"d6777395-3703-439a-8a62-837b407b8e96-thumb.png\", \"generated_at\": \"2026-03-09 16:18:03\"}}', '2026-03-08 19:17:54', '2026-03-08 19:18:04'),
(41, NULL, 'Logo (1)', '99fd834d-452b-48c2-b482-4121ffa3f2d9.png', 'image/png', 2682, 288, 28, 8, '{\"original_name\": \"Logo (1).png\"}', '[]', '2026-03-21 02:53:28', '2026-03-21 02:53:28'),
(42, NULL, 'home-about', 'c406570c-9d12-4e9d-9308-eec5de2c6cca.jpg', 'image/jpeg', 952188, 4096, 2286, 12, '{\"caption\": \"\", \"alt_text\": \"\", \"original_name\": \"8a02dfc2f2a777264608482735d8b6e56a09f3b4 (1).jpg\"}', '[]', '2026-03-23 07:32:31', '2026-03-23 18:51:36'),
(43, NULL, 'home-banner', '845e8011-29a0-473f-811d-b0a8d8027e8b.jpg', 'image/jpeg', 285922, 3168, 1344, 12, '{\"caption\": \"\", \"alt_text\": \"\", \"original_name\": \"c8c064e91517fff5acaf0cca2cb10605dc1e0d78 (1).jpg\"}', '[]', '2026-03-23 07:32:31', '2026-03-23 18:51:29'),
(44, NULL, 'home-cta', '44c3b1f9-dffc-4866-8379-d176b6fdef7a.jpg', 'image/jpeg', 1096371, 4096, 2286, 12, '{\"caption\": \"\", \"alt_text\": \"\", \"original_name\": \"54120f3a2596d466e8f3a42a352c8fa689ca07ae (1).jpg\"}', '[]', '2026-03-23 07:32:31', '2026-03-23 18:50:34'),
(75, NULL, 'Couch', '6fccfa13-2fca-47bf-bad7-5c5b9179cf83.svg', 'image/svg+xml', 1528, NULL, NULL, 13, '{\"original_name\": \"Couch.svg\"}', '[]', '2026-03-23 08:06:09', '2026-03-23 08:06:09'),
(76, NULL, 'Leaf', '1bdb6ba7-9334-43d7-bc73-49ee458f3931.svg', 'image/svg+xml', 1404, NULL, NULL, 13, '{\"original_name\": \"Leaf.svg\"}', '[]', '2026-03-23 08:06:09', '2026-03-23 08:06:09'),
(77, NULL, 'Hammer', 'd6b6f1e7-f70d-4984-b687-648dbe8dcb2e.svg', 'image/svg+xml', 2194, NULL, NULL, 13, '{\"original_name\": \"Hammer.svg\"}', '[]', '2026-03-23 08:06:32', '2026-03-23 08:06:32'),
(78, NULL, 'Truck', '6017757b-9da3-45f7-a5c8-3fb3f66a8a07.svg', 'image/svg+xml', 2580, NULL, NULL, 13, '{\"original_name\": \"Truck.svg\"}', '[]', '2026-03-23 08:06:32', '2026-03-23 08:06:32'),
(79, NULL, '202603232137', 'dc57d224-681d-48b5-a263-65e3f1721e72.mp4', 'video/mp4', 4320115, NULL, NULL, 12, '{\"original_name\": \"202603232137.mp4\"}', '[]', '2026-03-23 08:36:48', '2026-03-23 08:36:48'),
(80, NULL, '2c691c1e9d8aba43612f99b796c0067c32f591b7 (1)', '03280f80-50c0-4e60-93e4-a4345466d01c.jpg', 'image/jpeg', 605576, 4096, 2286, 15, '{\"original_name\": \"2c691c1e9d8aba43612f99b796c0067c32f591b7 (1).jpg\"}', '[]', '2026-03-23 18:48:29', '2026-03-23 18:48:29'),
(81, NULL, 'fbacd8b89c05587b3f5f88df595d6435f41c4a53 (2)', 'edb9a9a6-7bbf-412f-8dcd-af6db5cd63ef.jpg', 'image/jpeg', 140784, 1358, 1137, 15, '{\"caption\": \"\", \"alt_text\": \"\", \"original_name\": \"fbacd8b89c05587b3f5f88df595d6435f41c4a53 (1) 1 (1).jpg\"}', '[]', '2026-03-23 18:48:29', '2026-03-24 05:01:48'),
(82, NULL, 'fbacd8b89c05587b3f5f88df595d6435f41c4a53 (1) (1)', '9c1466a0-12f9-44cc-81cd-57b156a57ebf.jpg', 'image/jpeg', 111300, 1353, 1135, 15, '{\"caption\": \"\", \"alt_text\": \"\", \"original_name\": \"fbacd8b89c05587b3f5f88df595d6435f41c4a53 (1) 2 (1).jpg\"}', '[]', '2026-03-23 18:48:29', '2026-03-24 05:01:55'),
(83, NULL, '972d3169d15d0bc7451f6b3b544f19585e9be9c6 (1)', 'e3d95706-c79e-48cf-bee6-cfe05621bc72.jpg', 'image/jpeg', 676862, 4096, 2286, 15, '{\"original_name\": \"972d3169d15d0bc7451f6b3b544f19585e9be9c6 (1).jpg\"}', '[]', '2026-03-23 18:48:29', '2026-03-23 18:48:29'),
(84, NULL, 'c3ec49a024bcaf2d66c3476707a1565084f4e476 (1)', '5de01ada-3920-4142-a1a2-6d48b6c57e43.jpg', 'image/jpeg', 547621, 4096, 2286, 15, '{\"original_name\": \"c3ec49a024bcaf2d66c3476707a1565084f4e476 (1).jpg\"}', '[]', '2026-03-23 18:48:29', '2026-03-23 18:48:29'),
(85, NULL, 'd0cb8afa7f607cbc44d59758abf067873d07107a (1)', '6081418b-78fe-4bde-9780-06c4afea3c39.jpg', 'image/jpeg', 1231002, 4096, 2286, 16, '{\"original_name\": \"d0cb8afa7f607cbc44d59758abf067873d07107a (1).jpg\"}', '[]', '2026-03-24 02:23:03', '2026-03-24 02:23:03'),
(86, NULL, '36f5c9a54db993899aca6e263a4165708fe4f6d9 (1)', '66ef6da4-92a0-4a5f-8e71-203f0aad1ff7.jpg', 'image/jpeg', 676318, 4096, 2286, 16, '{\"original_name\": \"36f5c9a54db993899aca6e263a4165708fe4f6d9 (1).jpg\"}', '[]', '2026-03-24 02:24:04', '2026-03-24 02:24:04'),
(87, NULL, '769d14b3ba2cc29b339468873931c43d25d37f32 (1)', 'b09243b6-1b6b-4a82-bf5a-28d32bc7ca8b.jpg', 'image/jpeg', 998423, 4096, 2286, 16, '{\"original_name\": \"769d14b3ba2cc29b339468873931c43d25d37f32 (1).jpg\"}', '[]', '2026-03-24 02:27:34', '2026-03-24 02:27:34'),
(88, NULL, 'SealCheck', '8afd4a24-29ba-452a-9fab-e0253beb6939.svg', 'image/svg+xml', 3794, NULL, NULL, 17, '{\"original_name\": \"SealCheck.svg\"}', '[]', '2026-03-24 02:29:16', '2026-03-24 02:29:16'),
(89, NULL, 'ClockCountdown', 'b27d2ff3-ef42-45a1-8cc1-a141cf603f68.svg', 'image/svg+xml', 3326, NULL, NULL, 17, '{\"original_name\": \"ClockCountdown.svg\"}', '[]', '2026-03-24 02:29:28', '2026-03-24 02:29:28'),
(90, NULL, 'Leaf', '4dd20d10-4748-41a4-bc33-2f0847bcb2e6.svg', 'image/svg+xml', 1404, NULL, NULL, 17, '{\"original_name\": \"Leaf.svg\"}', '[]', '2026-03-24 02:29:28', '2026-03-24 02:29:28'),
(91, NULL, 'UserFocus', 'c5bb1d17-7e21-4b13-b5e9-c186a3ac5e4d.svg', 'image/svg+xml', 3505, NULL, NULL, 17, '{\"original_name\": \"UserFocus.svg\"}', '[]', '2026-03-24 02:29:28', '2026-03-24 02:29:28'),
(92, NULL, '9b084a6a44882d90c45fcf4b6354a44072ddafcd (1)', '39215976-1eb5-4fa2-8305-20405e2ffb7f.jpg', 'image/jpeg', 1163661, 4096, 2286, 16, '{\"original_name\": \"9b084a6a44882d90c45fcf4b6354a44072ddafcd (1).jpg\"}', '[]', '2026-03-24 02:34:03', '2026-03-24 02:34:03'),
(93, NULL, '2c691c1e9d8aba43612f99b796c0067c32f591b7 (1)', '8255dfe1-b6fe-4067-a63b-04be07a939a4.jpg', 'image/jpeg', 605576, 4096, 2286, 16, '{\"original_name\": \"2c691c1e9d8aba43612f99b796c0067c32f591b7 (1).jpg\"}', '[]', '2026-03-24 02:34:50', '2026-03-24 02:34:50'),
(94, NULL, '27c0341eb06be024cb0e74e0c36e1a55144c5a5c (1)', '1b1936c3-add7-47fe-a0cf-66939110474f.png', 'image/png', 509984, 1152, 896, 16, '{\"original_name\": \"27c0341eb06be024cb0e74e0c36e1a55144c5a5c (1).png\"}', '[]', '2026-03-24 02:35:37', '2026-03-24 02:35:37'),
(95, NULL, '98f2cfd6e447c41f815de9b5c32b0edcdb6a6ca6 (1)', 'a311f365-afd5-410c-ad19-0ab08ac934e4.jpg', 'image/jpeg', 72065, 1376, 767, 16, '{\"original_name\": \"98f2cfd6e447c41f815de9b5c32b0edcdb6a6ca6 (1).jpg\"}', '[]', '2026-03-24 02:36:11', '2026-03-24 02:36:11'),
(96, NULL, 'Hammer', 'e85dd35a-829d-4c45-8fbf-d37e74de96c0.svg', 'image/svg+xml', 2194, NULL, NULL, 17, '{\"original_name\": \"Hammer.svg\"}', '[]', '2026-03-24 02:38:07', '2026-03-24 02:38:07'),
(97, NULL, 'Truck', 'a58f45d1-e31e-42cf-a7d1-866f18e4224a.svg', 'image/svg+xml', 2580, NULL, NULL, 17, '{\"original_name\": \"Truck.svg\"}', '[]', '2026-03-24 02:38:07', '2026-03-24 02:38:07'),
(98, NULL, 'Couch', '51a0e939-2b4f-4414-8136-d21439b3ad42.svg', 'image/svg+xml', 1528, NULL, NULL, 17, '{\"original_name\": \"Couch.svg\"}', '[]', '2026-03-24 02:38:23', '2026-03-24 02:38:23'),
(99, NULL, '328bb4d2d573f5b8aac9e8e2b8ff2e1af8772676 (1)', 'b322ffe9-10bc-4d5f-8ab3-5489ba725f74.jpg', 'image/jpeg', 1050782, 4096, 2286, 18, '{\"original_name\": \"328bb4d2d573f5b8aac9e8e2b8ff2e1af8772676 (1).jpg\"}', '[]', '2026-03-24 02:47:52', '2026-03-24 02:47:52'),
(100, NULL, '3703c665e74e51eb4bb29b5159738ec42e1d76ba (1)', '59974461-bbfa-411a-89c9-776f1843b213.jpg', 'image/jpeg', 628742, 4096, 2286, 18, '{\"original_name\": \"3703c665e74e51eb4bb29b5159738ec42e1d76ba (1).jpg\"}', '[]', '2026-03-24 02:47:52', '2026-03-24 02:47:52'),
(101, NULL, '9b084a6a44882d90c45fcf4b6354a44072ddafcd (2) (1)', '8dfd3f09-bb9e-4db6-895f-6cbb0b1ba9d1.jpg', 'image/jpeg', 1163661, 4096, 2286, 18, '{\"original_name\": \"9b084a6a44882d90c45fcf4b6354a44072ddafcd (2) (1).jpg\"}', '[]', '2026-03-24 02:47:52', '2026-03-24 02:47:52'),
(102, NULL, '50b8a907fd92d1f8fea4ab1503bf21ec622002e7 (1)', '7e7a91fe-240f-4a52-a319-3ecd9ab1355d.jpg', 'image/jpeg', 910460, 4096, 2286, 18, '{\"original_name\": \"50b8a907fd92d1f8fea4ab1503bf21ec622002e7 (1).jpg\"}', '[]', '2026-03-24 02:49:03', '2026-03-24 02:49:03'),
(103, NULL, 'f88442345734d3241b2059edcf7251153d0799b4 (1)', 'a70aa98c-c2ef-4096-a3fb-5f1a4b149250.jpg', 'image/jpeg', 547892, 4096, 2286, 18, '{\"original_name\": \"f88442345734d3241b2059edcf7251153d0799b4 (1).jpg\"}', '[]', '2026-03-24 02:51:36', '2026-03-24 02:51:36'),
(104, NULL, 'ClockCountdown', '4501086d-ceb2-4620-afbf-1072d70cc2ee.svg', 'image/svg+xml', 3326, NULL, NULL, 19, '{\"original_name\": \"ClockCountdown.svg\"}', '[]', '2026-03-24 02:57:03', '2026-03-24 02:57:03'),
(105, NULL, 'Leaf', 'c91777ca-f016-49e7-9147-cc5ebcb70233.svg', 'image/svg+xml', 1404, NULL, NULL, 19, '{\"original_name\": \"Leaf.svg\"}', '[]', '2026-03-24 02:57:03', '2026-03-24 02:57:03'),
(106, NULL, 'SealCheck', '0c9436a1-6e71-47cb-838f-773f79a66ce1.svg', 'image/svg+xml', 3794, NULL, NULL, 19, '{\"original_name\": \"SealCheck.svg\"}', '[]', '2026-03-24 02:57:03', '2026-03-24 02:57:03'),
(107, NULL, 'UserFocus', '477d9f2d-948e-47cd-bb67-00b231c0dccf.svg', 'image/svg+xml', 3505, NULL, NULL, 19, '{\"original_name\": \"UserFocus.svg\"}', '[]', '2026-03-24 02:57:03', '2026-03-24 02:57:03'),
(108, NULL, '5508c9d43b26fe55cfa4cb35fd16710d7d2aabe9 (1)', 'ba8ee209-7e7b-49cd-8662-52822de0c212.jpg', 'image/jpeg', 674370, 4096, 2731, 20, '{\"original_name\": \"5508c9d43b26fe55cfa4cb35fd16710d7d2aabe9 (1).jpg\"}', '[]', '2026-03-24 03:04:14', '2026-03-24 03:04:14'),
(109, NULL, 'ea6c5c66a29c98bb8c43923e0899fbc6a2d84627 (1)', 'f2a1351a-da71-4a96-9314-f7c31d7a911e.jpg', 'image/jpeg', 380455, 4096, 2731, 20, '{\"original_name\": \"ea6c5c66a29c98bb8c43923e0899fbc6a2d84627 (1).jpg\"}', '[]', '2026-03-24 03:04:14', '2026-03-24 03:04:14'),
(110, NULL, '9697dd70e8601a7bfa33fde0773c4ae39a8d282c (1)', '9876b3b3-0800-4241-87a5-484e196bba24.jpg', 'image/jpeg', 571071, 4096, 2730, 20, '{\"original_name\": \"9697dd70e8601a7bfa33fde0773c4ae39a8d282c (1).jpg\"}', '[]', '2026-03-24 03:04:14', '2026-03-24 03:04:14'),
(111, NULL, '838f0005edea431fa48350c9945d565c7c0b458c (1) (1)', '243fc7fa-a233-4e85-9b55-ac25a24e2529.jpg', 'image/jpeg', 645110, 4096, 2731, 20, '{\"original_name\": \"838f0005edea431fa48350c9945d565c7c0b458c (1) (1).jpg\"}', '[]', '2026-03-24 03:04:14', '2026-03-24 03:04:14'),
(112, NULL, '50b8a907fd92d1f8fea4ab1503bf21ec622002e7 (1)', 'de637ce1-9523-45b6-b2cd-ca4abf6a0d7a.jpg', 'image/jpeg', 910460, 4096, 2286, 21, '{\"original_name\": \"50b8a907fd92d1f8fea4ab1503bf21ec622002e7 (1).jpg\"}', '[]', '2026-03-24 03:37:00', '2026-03-24 03:37:00'),
(113, NULL, '828df44a15a4f16450678af6454b7a5e11179011 (1)', 'aee200eb-310d-485a-98d2-e14c0bc50a39.jpg', 'image/jpeg', 178342, 3168, 1344, 22, '{\"original_name\": \"828df44a15a4f16450678af6454b7a5e11179011 (1).jpg\"}', '[]', '2026-03-24 06:29:54', '2026-03-24 06:29:54'),
(114, NULL, 'fbacd8b89c05587b3f5f88df595d6435f41c4a53 (1) 3 (1)', '5923b49a-755b-4151-a8c5-f62c77619735.jpg', 'image/jpeg', 201927, 1347, 1139, 22, '{\"original_name\": \"fbacd8b89c05587b3f5f88df595d6435f41c4a53 (1) 3 (1).jpg\"}', '[]', '2026-03-24 06:32:03', '2026-03-24 06:32:03'),
(115, NULL, 'fbacd8b89c05587b3f5f88df595d6435f41c4a53 (1) 2 (2) (1)', '18267262-962e-415d-b36b-81dbddaef1a6.jpg', 'image/jpeg', 154714, 1357, 1136, 22, '{\"original_name\": \"fbacd8b89c05587b3f5f88df595d6435f41c4a53 (1) 2 (2) (1).jpg\"}', '[]', '2026-03-24 06:32:03', '2026-03-24 06:32:03'),
(116, NULL, 'fbacd8b89c05587b3f5f88df595d6435f41c4a53 (1) 3 (1)', 'a587c71c-cf09-4ddd-8507-ca7dbdf264f7.jpg', 'image/jpeg', 201927, 1347, 1139, 9, '{\"original_name\": \"fbacd8b89c05587b3f5f88df595d6435f41c4a53 (1) 3 (1).jpg\"}', '[]', '2026-03-24 07:19:35', '2026-03-24 07:19:35'),
(117, NULL, 'fbacd8b89c05587b3f5f88df595d6435f41c4a53 (1) 2 (2) (1)', 'ebd0c301-eb9e-4849-9e49-347c09df59f9.jpg', 'image/jpeg', 154714, 1357, 1136, 9, '{\"original_name\": \"fbacd8b89c05587b3f5f88df595d6435f41c4a53 (1) 2 (2) (1).jpg\"}', '[]', '2026-03-24 07:19:35', '2026-03-24 07:19:35'),
(118, NULL, '7e563999d2a62d1b82ec1e1b5bf84cbdbb5879b8 (1)', '127c84ef-72a6-4e59-8355-0251db22867a.jpg', 'image/jpeg', 846195, 4096, 2286, 10, '{\"original_name\": \"7e563999d2a62d1b82ec1e1b5bf84cbdbb5879b8 (1).jpg\"}', '[]', '2026-03-24 09:53:04', '2026-03-24 09:53:04'),
(119, NULL, 'b373a1330a04231203ac6d2be2d4c707918c1f18 (1)', '2a6e6255-023f-4e55-ae10-78ce43bf5078.jpg', 'image/jpeg', 173245, 1376, 767, 10, '{\"original_name\": \"b373a1330a04231203ac6d2be2d4c707918c1f18 (1).jpg\"}', '[]', '2026-03-24 09:53:04', '2026-03-24 09:53:04'),
(120, NULL, '733038e64fba97b9c3c5703d0a174140afc4e1e6 (1)', '57115c7c-95e4-4fbd-8a9c-ff39dbf07c2c.jpg', 'image/jpeg', 794260, 4096, 2286, 10, '{\"original_name\": \"733038e64fba97b9c3c5703d0a174140afc4e1e6 (1).jpg\"}', '[]', '2026-03-24 09:53:04', '2026-03-24 09:53:04'),
(121, NULL, '3703c665e74e51eb4bb29b5159738ec42e1d76ba (1)', 'e391ee5f-6080-428a-ab2c-9dbfbfc43fa5.jpg', 'image/jpeg', 628742, 4096, 2286, 10, '{\"caption\": \"\", \"alt_text\": \"\", \"original_name\": \"3703c665e74e51eb4bb29b5159738ec42e1d76ba (1).jpg\"}', '[]', '2026-03-24 10:08:17', '2026-03-24 10:08:25'),
(122, NULL, '9b084a6a44882d90c45fcf4b6354a44072ddafcd (1)', '516818b1-7d63-4b31-b6cc-ecf62af865cc.jpg', 'image/jpeg', 1163661, 4096, 2286, 10, '{\"original_name\": \"9b084a6a44882d90c45fcf4b6354a44072ddafcd (1).jpg\"}', '[]', '2026-03-24 10:08:17', '2026-03-24 10:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `mediables`
--

CREATE TABLE `mediables` (
  `id` bigint UNSIGNED NOT NULL,
  `media_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `collection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mediables`
--

INSERT INTO `mediables` (`id`, `media_id`, `model_type`, `model_id`, `collection`, `sort_order`, `created_at`, `updated_at`) VALUES
(12, 15, 'App\\Models\\Product', 3, 'images', 0, NULL, NULL),
(13, 16, 'App\\Models\\Product', 4, 'images', 0, NULL, NULL),
(16, 17, 'App\\Models\\Product', 5, 'images', 0, NULL, NULL),
(17, 18, 'App\\Models\\Product', 6, 'images', 0, NULL, NULL),
(18, 19, 'App\\Models\\Product', 7, 'images', 0, NULL, NULL),
(19, 20, 'App\\Models\\Product', 8, 'images', 0, NULL, NULL),
(20, 21, 'App\\Models\\Product', 9, 'images', 0, NULL, NULL),
(23, 22, 'App\\Models\\Product', 10, 'images', 0, NULL, NULL),
(33, 27, 'App\\Models\\Product', 11, 'images', 1, NULL, NULL),
(34, 28, 'App\\Models\\Product', 11, 'images', 2, NULL, NULL),
(35, 29, 'App\\Models\\Product', 11, 'images', 3, NULL, NULL),
(36, 23, 'App\\Models\\Product', 11, 'images', 0, NULL, NULL),
(90, 12, 'App\\Models\\Collection', 2, 'image', 0, NULL, NULL),
(92, 11, 'App\\Models\\Collection', 3, 'image', 0, NULL, NULL),
(94, 10, 'App\\Models\\Collection', 4, 'image', 0, NULL, NULL),
(96, 9, 'App\\Models\\Collection', 5, 'image', 0, NULL, NULL),
(421, 13, 'App\\Models\\Collection', 1, 'image', 0, NULL, NULL),
(425, 27, 'App\\Models\\Product', 2, 'images', 1, NULL, NULL),
(426, 14, 'App\\Models\\Product', 2, 'images', 0, NULL, NULL),
(439, 80, 'App\\Models\\Page', 1, 'image_ids', 0, NULL, NULL),
(440, 81, 'App\\Models\\Page', 1, 'image_ids', 1, NULL, NULL),
(441, 82, 'App\\Models\\Page', 1, 'image_ids', 2, NULL, NULL),
(442, 83, 'App\\Models\\Page', 1, 'image_ids', 3, NULL, NULL),
(443, 84, 'App\\Models\\Page', 1, 'image_ids', 4, NULL, NULL),
(447, 121, 'App\\Models\\Page', 9, 'image_id', 0, NULL, NULL),
(472, 120, 'App\\Models\\Page', 9, 'image', 0, NULL, NULL),
(487, 118, 'App\\Models\\Page', 10, 'image', 0, NULL, NULL),
(496, 119, 'App\\Models\\Page', 11, 'image', 0, NULL, NULL),
(504, 116, 'App\\Models\\Collection', 7, 'image', 0, NULL, NULL),
(510, 117, 'App\\Models\\Collection', 6, 'image', 0, NULL, NULL),
(517, 14, 'App\\Models\\Product', 1, 'images', 0, NULL, NULL),
(518, 8, 'App\\Models\\Product', 1, 'images', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media_folders`
--

CREATE TABLE `media_folders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_folders`
--

INSERT INTO `media_folders` (`id`, `name`, `path`, `parent_id`, `created_at`, `updated_at`) VALUES
(4, 'Bài viết', 'posts', NULL, '2026-02-27 09:24:46', '2026-02-27 09:27:16'),
(6, 'Sản phẩm', 'products', NULL, '2026-02-27 09:31:49', '2026-02-27 09:53:23'),
(8, 'Cài đặt', 'settings', NULL, '2026-02-27 11:28:54', '2026-02-28 18:42:08'),
(9, 'Danh mục sản phẩm', 'collections', NULL, '2026-03-01 16:19:25', '2026-03-12 15:22:59'),
(10, 'Trang', 'pages', NULL, '2026-03-12 15:21:42', '2026-03-12 15:22:48'),
(12, 'home', 'pages/home', 10, '2026-03-23 05:35:11', '2026-03-23 05:35:11'),
(13, 'icons', 'pages/home/icons', 12, '2026-03-23 07:33:06', '2026-03-23 07:33:06'),
(15, 'gallery', 'pages/home/gallery', 12, '2026-03-23 09:11:42', '2026-03-23 09:11:42'),
(16, 'partner', 'pages/partner', 10, '2026-03-24 02:22:57', '2026-03-24 02:22:57'),
(17, 'icons', 'pages/partner/icons', 16, '2026-03-24 02:28:01', '2026-03-24 02:28:01'),
(18, 'about', 'pages/about', 10, '2026-03-24 02:47:44', '2026-03-24 02:47:44'),
(19, 'icons', 'pages/about/icons', 18, '2026-03-24 02:56:35', '2026-03-24 02:56:35'),
(20, 'team', 'pages/about/team', 18, '2026-03-24 03:04:06', '2026-03-24 03:04:06'),
(21, 'contact', 'pages/contact', 10, '2026-03-24 03:36:53', '2026-03-24 03:36:53'),
(22, 'shop', 'pages/shop', 10, '2026-03-24 05:31:36', '2026-03-24 05:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(10, '{\"en\": \"Header\", \"vi\": \"Đầu trang\", \"zh_CN\": \"标题\"}', 'header', 0, 'active', '2026-03-15 23:19:06', '2026-03-24 09:37:51'),
(11, '{\"en\": \"Footer\", \"vi\": \"Chân trang\", \"zh_CN\": \"Footer\"}', 'footer', 0, 'active', '2026-03-24 21:48:09', '2026-03-24 21:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `title` json NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'custom',
  `linkable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkable_id` bigint UNSIGNED DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `parent_id`, `title`, `url`, `target`, `icon`, `type`, `linkable_type`, `linkable_id`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(284, 10, NULL, '{\"en\": \"Home\", \"vi\": \"Trang Chủ\", \"zh_CN\": \"首页\"}', '/', '_self', NULL, 'pages', 'App\\Models\\Page', 1, 0, 1, '2026-03-24 10:43:18', '2026-03-24 10:43:18'),
(285, 10, NULL, '{\"en\": \"Partner\", \"vi\": \"Đối Tác tin cậy\", \"zh_CN\": \"可信合作伙伴\"}', '/partner', '_self', NULL, 'pages', 'App\\Models\\Page', 4, 1, 1, '2026-03-24 10:43:18', '2026-03-24 10:43:18'),
(286, 10, NULL, '{\"en\": \"Shop\", \"vi\": \"Sản phẩm\", \"zh_CN\": \"制品\"}', '/shop', '_self', NULL, 'pages', 'App\\Models\\Page', 7, 2, 1, '2026-03-24 10:43:18', '2026-03-24 10:43:18'),
(287, 10, NULL, '{\"en\": \"About\", \"vi\": \"Về chúng tôi\", \"zh_CN\": \"关于我们\"}', '/about', '_self', NULL, 'pages', 'App\\Models\\Page', 2, 3, 1, '2026-03-24 10:43:18', '2026-03-24 10:43:18'),
(288, 10, 287, '{\"en\": \"Packaging & Shipping Operations\", \"vi\": \"Hoạt Động Đóng Gói & Xuất Hàng\", \"zh_CN\": \"包装与发货操作\"}', '/pages/hoat-dong-dong-goi-xuat-hang', '_self', NULL, 'pages', 'App\\Models\\Page', 9, 4, 1, '2026-03-24 10:43:18', '2026-03-24 10:43:18'),
(289, 10, 287, '{\"en\": \"Order Production Progress Update\", \"vi\": \"Cập Nhật Tiến Độ Sản Xuất Đơn Hàng\", \"zh_CN\": \"订单生产进度更新\"}', '/pages/cap-nhat-tien-do-san-xuat-don-hang', '_self', NULL, 'pages', 'App\\Models\\Page', 10, 5, 1, '2026-03-24 10:43:18', '2026-03-24 10:43:18'),
(290, 10, 287, '{\"en\": \"Shipping & Delivery Updates\", \"vi\": \"Cập Nhật Vận Chuyển & Giao Hàng\", \"zh_CN\": \"运输与配送更新\"}', '/pages/cap-nhat-van-chuyen-giao-hang', '_self', NULL, 'pages', 'App\\Models\\Page', 11, 6, 1, '2026-03-24 10:43:18', '2026-03-24 10:43:18'),
(291, 10, NULL, '{\"en\": \"Contact\", \"vi\": \"Liên hệ\", \"zh_CN\": \"联系我们\"}', '/contact', '_self', NULL, 'pages', 'App\\Models\\Page', 3, 7, 1, '2026-03-24 10:43:18', '2026-03-24 10:43:18'),
(512, 11, NULL, '{\"en\": \"Product\", \"vi\": \"Sản phẩm\", \"zh_CN\": \"产品\"}', '#', '_self', NULL, 'custom', NULL, NULL, 0, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(513, 11, 512, '{\"en\": \"Wooden hooks\", \"vi\": \"Móc gỗ\", \"zh_CN\": \"木挂钩\"}', '/shop?category=moc-go', '_self', NULL, 'collections', 'App\\Models\\Collection', 1, 1, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(514, 11, 512, '{\"en\": \"Plastic hooks\", \"vi\": \"Móc nhựa\", \"zh_CN\": \"塑料挂钩\"}', '/shop?category=moc-nhua', '_self', NULL, 'collections', 'App\\Models\\Collection', 3, 2, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(515, 11, 512, '{\"en\": \"Iron hooks\", \"vi\": \"Móc Sắt\", \"zh_CN\": \"铁挂钩\"}', '/shop?category=moc-sat', '_self', NULL, 'collections', 'App\\Models\\Collection', 2, 3, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(516, 11, NULL, '{\"en\": \"Information\", \"vi\": \"Thông tin\", \"zh_CN\": \"信息\"}', '#', '_self', NULL, 'custom', NULL, NULL, 4, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(517, 11, 516, '{\"en\": \"About\", \"vi\": \"Về chúng tôi\", \"zh_CN\": \"关于我们\"}', '/about', '_self', NULL, 'pages', 'App\\Models\\Page', 2, 5, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(518, 11, 516, '{\"en\": \"Order Production Progress Update\", \"vi\": \"Cập Nhật Tiến Độ Sản Xuất Đơn Hàng\", \"zh_CN\": \"订单生产进度更新\"}', '/pages/cap-nhat-tien-do-san-xuat-don-hang', '_self', NULL, 'pages', 'App\\Models\\Page', 10, 6, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(519, 11, 516, '{\"en\": \"Factory News\", \"vi\": \"Tin tức nhà máy\", \"zh_CN\": \"工厂新闻\"}', '#', '_self', NULL, 'custom', NULL, NULL, 7, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(520, 11, NULL, '{\"en\": \"Support\", \"vi\": \"Hỗ trợ\", \"zh_CN\": \"支持\"}', '#', '_self', NULL, 'custom', NULL, NULL, 8, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(521, 11, 520, '{\"en\": \"Contact\", \"vi\": \"Liên hệ\", \"zh_CN\": \"联系我们\"}', '/contact', '_self', NULL, 'pages', 'App\\Models\\Page', 3, 9, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(522, 11, 520, '{\"en\": \"Question\", \"vi\": \"Câu hỏi\", \"zh_CN\": \"问题\"}', '#', '_self', NULL, 'custom', NULL, NULL, 10, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(523, 11, 520, '{\"en\": \"Policy\", \"vi\": \"Chính sách\", \"zh_CN\": \"政策\"}', '#', '_self', NULL, 'custom', NULL, NULL, 11, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(524, 11, NULL, '{\"en\": \"Connect with us\", \"vi\": \"Kết nối với chúng tôi\", \"zh_CN\": \"联系我们\"}', '#', '_self', NULL, 'custom', NULL, NULL, 12, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(525, 11, 524, '{\"en\": \"Email\", \"vi\": \"Email\", \"zh_CN\": \"电子邮件\"}', '#', '_self', NULL, 'custom', NULL, NULL, 13, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(526, 11, 524, '{\"en\": \"Facebook\", \"vi\": \"Facebook\", \"zh_CN\": \"脸书\"}', '#', '_self', NULL, 'custom', NULL, NULL, 14, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41'),
(527, 11, 524, '{\"en\": \"WhatsApp\", \"vi\": \"WhatsApp\", \"zh_CN\": \"WhatsApp\"}', '#', '_self', NULL, 'custom', NULL, NULL, 15, 1, '2026-03-24 21:56:41', '2026-03-24 21:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_14_170933_add_two_factor_columns_to_users_table', 1),
(5, '2025_09_16_144550_create_permission_tables', 1),
(6, '2025_09_16_145615_add_is_admin_to_users_table', 1),
(7, '2025_09_17_020556_create_media_folders_table', 1),
(8, '2025_09_17_065037_create_media_table', 1),
(9, '2025_09_17_066916_create_mediables_table', 1),
(10, '2025_09_17_070011_create_posts_table', 1),
(11, '2025_09_17_070953_create_pages_table', 1),
(12, '2025_09_17_071023_create_products_table', 1),
(13, '2025_09_17_080332_create_settings_table', 1),
(14, '2025_09_17_083935_create_blogs_table', 1),
(15, '2025_09_17_083941_create_collections_table', 1),
(16, '2025_09_17_084203_create_product_collection_table', 1),
(17, '2025_09_17_084211_create_post_blog_table', 1),
(18, '2025_09_19_104123_create_carts_table', 1),
(19, '2025_09_19_104202_create_cart_items_table', 1),
(20, '2025_09_19_104305_create_provinces_table', 1),
(21, '2025_09_19_104555_create_wards_table', 1),
(22, '2025_09_20_183250_create_product_options_table', 1),
(23, '2025_09_20_183644_create_product_option_values_table', 1),
(24, '2025_09_20_183755_create_product_variants_table', 1),
(25, '2025_09_20_183842_create_product_variant_values_table', 1),
(26, '2025_11_23_110207_create_orders_table', 1),
(27, '2025_11_23_110214_create_order_items_table', 1),
(28, '2025_11_25_062957_create_showcases_table', 1),
(29, '2026_03_03_131057_create_product_reviews_table', 1),
(30, '2026_03_04_025738_create_contacts_table', 1),
(31, '2026_03_16_124114_create_menus_table', 1),
(32, '2026_03_16_124115_create_menu_items_table', 1),
(33, '2026_03_19_154721_add_sections_to_pages_table', 2),
(35, '2026_03_21_095842_add_features_and_policies_to_products_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(11, 'App\\Models\\User', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` bigint UNSIGNED DEFAULT NULL,
  `ward_id` bigint UNSIGNED DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending, paid, shipped, completed, canceled',
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'bank_transfer, cash_delivery',
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending, paid, failed, refunded, canceled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json NOT NULL,
  `slug` json NOT NULL,
  `description` json DEFAULT NULL,
  `content` json DEFAULT NULL,
  `sections` json DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft' COMMENT 'draft, reviewing, published, rejected',
  `page_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'regular',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `description`, `content`, `sections`, `status`, `page_type`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Home\", \"vi\": \"Trang Chủ\", \"zh_CN\": \"首页\"}', '{\"en\": \"home\", \"vi\": \"home\", \"zh_CN\": \"home\"}', '{\"zh_CN\": \"\"}', '{\"zh_CN\": \"\"}', '{\"en\": {\"cta\": {\"title\": \"Why Choose Our Factory\", \"image_id\": 44, \"description\": \"We provide stable, high-quality, and long-term manufacturing solutions for domestic and international partners.\"}, \"post\": {\"title\": \"News\", \"description\": \"Updates on production activities, order progress, and the latest factory shipment information\"}, \"about\": {\"label\": \"About Us\", \"title\": \"Quality Foundation – Creating Sustainable Value\", \"features\": [{\"label\": \"Sustainable Materials\", \"image_id\": 76}, {\"label\": \"Designed for Everyday Life\", \"image_id\": 75}, {\"label\": \"Crafted by Experts\", \"image_id\": 77}, {\"label\": \"Convenient Delivery & Support\", \"image_id\": 78}], \"image_id\": 42, \"description\": \"We are a factory specializing in the production of wood, plastic, and industrial material products, serving both domestic and export markets. With a modern machinery system, a closed-loop production process, and an experienced technical team, we are committed to delivering products that meet high standards for durability, precision, and finishing quality.\\nContinuously improving technology and optimizing processes, we aim to provide efficient, stable, and long-term manufacturing solutions for our partners, from standard products to custom processing (OEM / ODM).\"}, \"banner\": {\"image_id\": 79}, \"banner2\": {\"title\": \"Large-Scale Production Capacity\", \"image_id\": 43, \"description\": \"We operate a modern production system with the capacity to fulfill large-volume orders for domestic and export markets. With a closed-loop production process, strict quality control, and an experienced technical team, we ensure every product meets high standards for durability, precision, and finishing.\"}, \"featured\": {\"title\": \"Latest Products from the Factory\", \"description\": \"We continuously research, improve, and launch new product lines to meet diverse market demands. With modern machinery and strict quality control processes, each product achieves a high level of finish, durability, and suitability for practical use as well as large-scale production.\\nProduct lines ranging from standard wooden hangers, custom-designed hangers, to engineered wood-plastic components are manufactured uniformly, ensuring stability and precision before shipment.\"}, \"collections\": {\"title\": \"Product Categories by Material\", \"description\": \"Explore product lines categorized by manufacturing material, helping customers easily select solutions that fit their usage needs and technical standards. We offer a diverse range of products from metal, plastic, to wood, catering to both standard products and custom manufacturing (OEM / ODM).\"}, \"inspiration\": {\"title\": \"Decoration Inspiration\", \"image_ids\": [80, 81, 82, 83, 84]}}, \"vi\": {\"cta\": {\"title\": \"Vì Sao Chọn Nhà Máy Của Chúng Tôi\", \"image_id\": 44, \"description\": \"Chúng tôi cung cấp giải pháp sản xuất ổn định, chất lượng cao và lâu dài cho đối tác trong và ngoài nước.\"}, \"post\": {\"title\": \"Tin tức\", \"description\": \"Cập nhật các hoạt động sản xuất, tiến độ đơn hàng và thông tin xuất xưởng mới nhất từ nhà máy\"}, \"about\": {\"label\": \"Về Chúng Tôi\", \"title\": \"Nền Tảng Chất Lượng – Tạo Nên Giá Trị Bền Vững\", \"features\": [{\"label\": \"Vật liệu bền vững\", \"image_id\": 76}, {\"label\": \"Thiết kế cho cuộc sống hàng ngày\", \"image_id\": 75}, {\"label\": \"Chế tác bởi đội ngũ chuyên gia\", \"image_id\": 77}, {\"label\": \"Giao hàng & hỗ trợ thuận tiện\", \"image_id\": 78}], \"image_id\": 42, \"description\": \"Chúng tôi là nhà máy chuyên sản xuất các sản phẩm từ gỗ, nhựa và vật liệu công nghiệp, phục vụ thị trường trong nước và xuất khẩu. Với hệ thống máy móc hiện đại, quy trình sản xuất khép kín và đội ngũ kỹ thuật giàu kinh nghiệm, chúng tôi cam kết mang đến những sản phẩm đạt tiêu chuẩn cao về độ bền, tính chính xác và chất lượng hoàn thiện.\\nKhông ngừng cải tiến công nghệ và tối ưu quy trình, chúng tôi hướng đến việc cung cấp giải pháp sản xuất hiệu quả, ổn định và lâu dài cho đối tác, từ sản phẩm tiêu chuẩn đến gia công theo yêu cầu (OEM / ODM).\"}, \"banner\": {\"image_id\": 79}, \"banner2\": {\"title\": \"Năng Lực Sản Xuất Quy Mô Lớn\", \"image_id\": 43, \"description\": \"Chúng tôi vận hành hệ thống sản xuất hiện đại với khả năng đáp ứng đơn hàng số lượng lớn cho thị trường trong nước và xuất khẩu. Với quy trình sản xuất khép kín, kiểm soát chất lượng chặt chẽ và đội ngũ kỹ thuật giàu kinh nghiệm, chúng tôi đảm bảo mỗi sản phẩm đạt tiêu chuẩn cao về độ bền, tính chính xác và độ hoàn thiện.\"}, \"featured\": {\"title\": \"Sản Phẩm Mới Nhất Từ Nhà Máy\", \"description\": \"Chúng tôi liên tục nghiên cứu, cải tiến và đưa vào sản xuất các dòng sản phẩm mới nhằm đáp ứng nhu cầu đa dạng của thị trường. Với hệ thống máy móc hiện đại và quy trình kiểm soát chất lượng chặt chẽ, mỗi sản phẩm đều đạt độ hoàn thiện cao, bền bỉ và phù hợp cho sử dụng thực tế cũng như sản xuất số lượng lớn.\\nCác dòng sản phẩm từ móc treo gỗ tiêu chuẩn, móc theo thiết kế riêng đến các chi tiết gia công gỗ – nhựa kỹ thuật đều được sản xuất đồng bộ, đảm bảo tính ổn định và độ chính xác trước khi xuất xưởng.\"}, \"collections\": {\"title\": \"Danh Mục Sản Phẩm Theo Vật Liệu\", \"description\": \"Khám phá các dòng sản phẩm được phân loại theo vật liệu sản xuất, giúp khách hàng dễ dàng lựa chọn giải pháp phù hợp với nhu cầu sử dụng và tiêu chuẩn kỹ thuật. Chúng tôi cung cấp đa dạng sản phẩm từ kim loại, nhựa đến gỗ, đáp ứng từ sản phẩm tiêu chuẩn đến gia công theo yêu cầu (OEM / ODM).\"}, \"inspiration\": {\"title\": \"Cảm Hứng Trang Trí\", \"image_ids\": [80, 81, 82, 83, 84]}}, \"zh_CN\": {\"cta\": {\"title\": \"为何选择我们的工厂\", \"image_id\": 44, \"description\": \"我们为国内外合作伙伴提供稳定、高质量、长期的制造解决方案。\"}, \"post\": {\"title\": \"新闻\", \"description\": \"关于生产活动、订单进度以及工厂最新出货信息的更新\"}, \"about\": {\"label\": \"关于我们\", \"title\": \"品质基石 – 创造可持续价值\", \"features\": [{\"label\": \"可持续材料\", \"image_id\": 76}, {\"label\": \"为日常生活而设计\", \"image_id\": 75}, {\"label\": \"专家匠心制作\", \"image_id\": 77}, {\"label\": \"便捷的交付与支持\", \"image_id\": 78}], \"image_id\": 42, \"description\": \"我们是一家专业生产木材、塑料和工业材料产品的工厂，服务于国内和出口市场。凭借现代化的机械设备、封闭式生产流程和经验丰富的技术团队，我们致力于提供在耐用性、精确性和成品质量方面达到高标准的产品。\\n我们不断改进技术和优化流程，旨在为合作伙伴提供高效、稳定、长期的制造解决方案，从标准产品到定制加工（OEM / ODM）。\"}, \"banner\": {\"image_id\": 79}, \"banner2\": {\"title\": \"大规模生产能力\", \"image_id\": 43, \"description\": \"我们运营着一个现代化的生产系统，能够满足国内和出口市场的大批量订单需求。凭借封闭式生产流程、严格的质量控制和经验丰富的技术团队，我们确保每一件产品都达到高标准的耐用性、精确性和成品质量。\"}, \"featured\": {\"title\": \"工厂最新产品\", \"description\": \"我们不断研发、改进并推出新产品系列，以满足多样化的市场需求。凭借现代化的机械设备和严格的质量控制流程，每一件产品都达到了高完成度、耐用性，并适合实际使用和批量生产。\\n从标准木质衣架、定制设计衣架到工程木塑部件等产品系列，均实现同步生产，确保出厂前的稳定性和精确性。\"}, \"collections\": {\"title\": \"按材质分类的产品目录\", \"description\": \"探索按生产材料分类的产品系列，帮助客户轻松选择符合其使用需求和技术标准的产品。我们提供从金属、塑料到木材的各种产品，满足标准产品和定制加工（OEM / ODM）的需求。\"}, \"inspiration\": {\"title\": \"装饰灵感\", \"image_ids\": [80, 81, 82, 83, 84]}}}', 'published', 'system', '2026-03-19 08:40:36', '2026-03-24 05:34:31'),
(2, '{\"en\": \"About\", \"vi\": \"Về chúng tôi\", \"zh_CN\": \"关于我们\"}', '{\"en\": \"about\", \"vi\": \"about\", \"zh_CN\": \"about\"}', '{\"zh_CN\": \"\"}', '{\"zh_CN\": \"\"}', '{\"en\": {\"hero\": {\"title\": \"About Us\", \"image_id\": 102, \"description\": \"From idea to reality, we craft homes that reflect your personality.\"}, \"team\": {\"title\": \"Meet The Developers\", \"members\": [{\"name\": \"Nguyen Viet Hung\", \"role\": \"General Director\", \"image_id\": 108, \"social_links\": {\"FB\": \"#\", \"Zalo\": \"#\"}}, {\"name\": \"Pham Van Duong\", \"role\": \"Operations\", \"image_id\": 109, \"social_links\": []}, {\"name\": \"Ngo Thanh Tung\", \"role\": \"Technician\", \"image_id\": 111, \"social_links\": {\"FB\": \"#\"}}, {\"name\": \"Nguyen Quoc An\", \"role\": \"Consultant\", \"image_id\": 110, \"social_links\": {\"FB\": \"#\"}}]}, \"vision\": {\"title\": \"Vision\", \"image_id\": 100, \"description\": \"DUYANG VIETNAM\'s vision is to become a reputable, professional, and sustainably developing factory for the production and processing of wood, metal, and plastic products in the region. We aim to build a modern, stable, and flexible production system capable of meeting diverse market demands, both domestically and internationally.\\nThrough continuous investment in technology, process improvement, and human resource development, DUYANG VIETNAM aspires to become a long-term and reliable manufacturing partner for global businesses, brands, and distributors. We are committed to providing efficient, cost-optimized manufacturing solutions that ensure quality and align with the sustainable development trends of modern industry.\\nIn the future, DUYANG VIETNAM will continue to expand its production capacity, enhance quality standards, optimize its management system, and develop high-value product lines, thereby solidifying its position in the industrial manufacturing sector and the global supply chain.\"}, \"mission\": {\"title\": \"Mission\", \"image_id\": 101, \"description\": \"DUYANG VIETNAM\'s mission is to provide stable, efficient, and reliable manufacturing solutions for domestic and international partners. We focus on building a modern production system, strictly controlling each stage to ensure products meet high technical standards, stable durability, and consistency across all orders.\\nWe continuously optimize production processes, improve technology, and enhance productivity to help partners optimize costs, shorten production times, and increase business efficiency. With flexible OEM/ODM processing capabilities, DUYANG VIETNAM partners with clients in product development, design refinement, and efficient, accurate large-scale production.\\nFurthermore, we emphasize reputation, responsibility, and transparency in cooperation. DUYANG VIETNAM\'s goal is not only to supply products but also to build long-term, sustainable, and mutually beneficial partnerships within the global supply chain.\"}, \"who_we_are\": {\"title\": \"Who We Are\", \"image_id\": 99, \"description\": \"DUYANG VIETNAM is a factory specializing in the production and processing of products made from wood, metal, and plastic, serving both domestic and export markets. With a modern production system, a closed-loop process, and an experienced technical team, we provide stable, precise, and suitable manufacturing solutions for large-scale production as well as custom processing (OEM / ODM).\\nWe are committed to delivering products that meet quality standards, high durability, and consistency in every order.\"}, \"core_values\": {\"title\": \"Core Values\", \"values\": [{\"title\": \"Precision Manufacturing\", \"image_id\": 104, \"description\": \"Focusing on accuracy, stability, and technical standards in every production stage.\"}, {\"title\": \"Sustainable Quality\", \"image_id\": 106, \"description\": \"Using certified materials, strict control to ensure durable, stable, and consistent products.\"}, {\"title\": \"Continuous Improvement\", \"image_id\": 105, \"description\": \"Constantly upgrading technology, optimizing processes, and enhancing production efficiency.\"}, {\"title\": \"Long-term Partnership\", \"image_id\": 107, \"description\": \"Building on integrity, aiming for sustainable and mutually beneficial relationships with partners.\"}]}, \"development\": {\"title\": \"Development\", \"image_id\": 103, \"description\": \"From its initial manufacturing foundation, DUYANG VIETNAM continuously invests in technology, machinery, and process improvements to enhance production capacity. We are expanding our product portfolio, optimizing quality, and gradually establishing our position in the industrial manufacturing sector.\\nWith a long-term development orientation, we continue to raise production standards, expand markets, and provide efficient, stable manufacturing solutions for our partners in the future.\"}}, \"vi\": {\"hero\": {\"title\": \"Về chúng tôi\", \"image_id\": 102, \"description\": \"Từ ý tưởng đến hiện thực, chúng tôi kiến ​​tạo những ngôi nhà phản ánh cá tính của bạn.\"}, \"team\": {\"title\": \"Gặp Gỡ Những Người Phát Triển\", \"members\": [{\"name\": \"Nguyễn Việt Hùng\", \"role\": \"Tổng giám đốc\", \"image_id\": 108, \"social_links\": {\"FB\": \"#\", \"Zalo\": \"#\"}}, {\"name\": \"Phạm Văn Dương\", \"role\": \"Vận Hành\", \"image_id\": 109, \"social_links\": []}, {\"name\": \"Ngô Thanh Tùng\", \"role\": \"Kỹ thuật viên\", \"image_id\": 111, \"social_links\": {\"FB\": \"#\"}}, {\"name\": \"Nguyễn Quốc An\", \"role\": \"Tư vấn viên\", \"image_id\": 110, \"social_links\": {\"FB\": \"#\"}}]}, \"vision\": {\"title\": \"Tầm Nhìn\", \"image_id\": 100, \"description\": \"Tầm nhìn của DUYANG VIETNAM là trở thành nhà máy sản xuất và gia công các sản phẩm từ gỗ, kim loại và nhựa uy tín, chuyên nghiệp và phát triển bền vững tại khu vực. Chúng tôi hướng đến việc xây dựng một hệ thống sản xuất hiện đại, ổn định và linh hoạt, có khả năng đáp ứng đa dạng nhu cầu của thị trường trong nước cũng như quốc tế.\\nThông qua việc không ngừng đầu tư vào công nghệ, cải tiến quy trình và nâng cao chất lượng nguồn nhân lực, DUYANG VIETNAM mong muốn trở thành đối tác sản xuất lâu dài và đáng tin cậy của các doanh nghiệp, thương hiệu và nhà phân phối toàn cầu. Chúng tôi cam kết mang đến các giải pháp sản xuất hiệu quả, tối ưu chi phí, đảm bảo chất lượng và phù hợp với xu hướng phát triển bền vững của ngành công nghiệp hiện đại.\\nTrong tương lai, DUYANG VIETNAM tiếp tục mở rộng năng lực sản xuất, nâng cao tiêu chuẩn chất lượng, tối ưu hệ thống quản lý và phát triển các dòng sản phẩm có giá trị cao, góp phần khẳng định vị thế của doanh nghiệp trong lĩnh vực sản xuất công nghiệp và chuỗi cung ứng toàn cầu.\"}, \"mission\": {\"title\": \"Sứ Mệnh\", \"image_id\": 101, \"description\": \"Sứ mệnh của DUYANG VIETNAM là mang đến các giải pháp sản xuất ổn định, hiệu quả và đáng tin cậy cho đối tác trong và ngoài nước. Chúng tôi tập trung xây dựng hệ thống sản xuất hiện đại, kiểm soát chặt chẽ từng công đoạn nhằm đảm bảo sản phẩm đạt tiêu chuẩn kỹ thuật cao, độ bền ổn định và tính đồng đều trong mọi đơn hàng.\\nChúng tôi không ngừng tối ưu quy trình sản xuất, cải tiến công nghệ và nâng cao năng suất nhằm giúp đối tác tối ưu chi phí, rút ngắn thời gian sản xuất và nâng cao hiệu quả kinh doanh. Với năng lực gia công linh hoạt theo yêu cầu (OEM / ODM), DUYANG VIETNAM đồng hành cùng khách hàng trong việc phát triển sản phẩm, hoàn thiện thiết kế và đưa vào sản xuất quy mô lớn một cách hiệu quả và chính xác.\\nBên cạnh đó, chúng tôi đề cao uy tín, trách nhiệm và sự minh bạch trong hợp tác. Mục tiêu của DUYANG VIETNAM không chỉ là cung cấp sản phẩm, mà còn xây dựng mối quan hệ hợp tác lâu dài, bền vững và cùng phát triển với đối tác trong chuỗi cung ứng toàn cầu.\"}, \"who_we_are\": {\"title\": \"Chúng Tôi Là Ai\", \"image_id\": 99, \"description\": \"DUYANG VIETNAM là nhà máy chuyên sản xuất và gia công các sản phẩm từ gỗ, kim loại và nhựa, phục vụ thị trường trong nước và xuất khẩu. Với hệ thống sản xuất hiện đại, quy trình khép kín và đội ngũ kỹ thuật giàu kinh nghiệm, chúng tôi cung cấp các giải pháp sản xuất ổn định, chính xác và phù hợp cho sản xuất quy mô lớn cũng như gia công theo yêu cầu (OEM / ODM).\\nChúng tôi cam kết mang đến sản phẩm đạt tiêu chuẩn chất lượng, độ bền cao và tính đồng đều trong từng đơn hàng.\"}, \"core_values\": {\"title\": \"Giá Trị Cốt Lõi\", \"values\": [{\"title\": \"Sản xuất chính xác\", \"image_id\": 104, \"description\": \"Tập trung vào độ chính xác, tính ổn định và tiêu chuẩn kỹ thuật trong từng công đoạn sản xuất.\"}, {\"title\": \"Chất lượng bền vững\", \"image_id\": 106, \"description\": \"Sử dụng vật liệu đạt chuẩn, kiểm soát chặt chẽ để đảm bảo sản phẩm bền, ổn định - đồng đều.\"}, {\"title\": \"Cải tiến liên tục\", \"image_id\": 105, \"description\": \"Không ngừng nâng cấp công nghệ, tối ưu quy trình và nâng cao hiệu quả sản xuất.\"}, {\"title\": \"Hợp tác lâu dài\", \"image_id\": 107, \"description\": \"Lấy uy tín làm nền tảng, hướng đến mối quan hệ hợp tác bền vững và phát triển cùng đối tác.\"}]}, \"development\": {\"title\": \"Sự Phát Triển\", \"image_id\": 103, \"description\": \"Từ nền tảng sản xuất ban đầu, DUYANG VIETNAM không ngừng đầu tư vào công nghệ, máy móc và cải tiến quy trình nhằm nâng cao năng lực sản xuất. Chúng tôi mở rộng danh mục sản phẩm, tối ưu chất lượng và từng bước khẳng định vị thế trong lĩnh vực sản xuất công nghiệp.\\nVới định hướng phát triển dài hạn, chúng tôi tiếp tục nâng cao tiêu chuẩn sản xuất, mở rộng thị trường và mang đến các giải pháp sản xuất hiệu quả, ổn định cho đối tác trong tương lai.\"}}, \"zh_CN\": {\"hero\": {\"title\": \"关于我们\", \"image_id\": 102, \"description\": \"从构思到实现，我们为您打造彰显个性的家。\"}, \"team\": {\"title\": \"认识我们的开发者\", \"members\": [{\"name\": \"阮越雄\", \"role\": \"总经理\", \"image_id\": 108, \"social_links\": {\"FB\": \"#\", \"Zalo\": \"#\"}}, {\"name\": \"范文阳\", \"role\": \"运营\", \"image_id\": 109, \"social_links\": []}, {\"name\": \"吴清松\", \"role\": \"技术员\", \"image_id\": 111, \"social_links\": {\"FB\": \"#\"}}, {\"name\": \"阮国安\", \"role\": \"顾问\", \"image_id\": 110, \"social_links\": {\"FB\": \"#\"}}]}, \"vision\": {\"title\": \"愿景\", \"image_id\": 100, \"description\": \"DUYANG VIETNAM 的愿景是成为该地区一家信誉良好、专业且可持续发展的木材、金属和塑料制品生产加工厂。我们的目标是建立一个现代化、稳定且灵活的生产体系，能够满足国内和国际市场的多样化需求。\\n通过不断投资于技术、改进流程和发展人力资源，DUYANG VIETNAM 渴望成为全球企业、品牌和分销商的长期可靠的制造合作伙伴。我们致力于提供高效、成本优化且符合现代工业可持续发展趋势的制造解决方案。\\n未来，DUYANG VIETNAM 将继续扩大生产能力，提高质量标准，优化管理体系，并开发高附加值产品线，从而巩固其在工业制造领域和全球供应链中的地位。\"}, \"mission\": {\"title\": \"使命\", \"image_id\": 101, \"description\": \"DUYANG VIETNAM 的使命是为国内外合作伙伴提供稳定、高效、可靠的制造解决方案。我们专注于建立现代化的生产体系，严格控制每个环节，以确保产品达到高技术标准、稳定的耐用性和所有订单的一致性。\\n我们不断优化生产流程，改进技术，提高生产效率，以帮助合作伙伴优化成本、缩短生产周期并提高业务效益。凭借灵活的 OEM/ODM 加工能力，DUYANG VIETNAM 在产品开发、设计完善和高效、精确的大规模生产方面与客户合作。\\n此外，我们重视合作中的信誉、责任和透明度。DUYANG VIETNAM 的目标不仅是提供产品，更是与合作伙伴建立长期、可持续且共同发展的关系，共同融入全球供应链。\"}, \"who_we_are\": {\"title\": \"我们是谁\", \"image_id\": 99, \"description\": \"DUYANG VIETNAM 是一家专业生产和加工木材、金属和塑料制品的工厂，服务于国内和出口市场。凭借现代化的生产系统、封闭式流程和经验丰富的技术团队，我们为大规模生产和定制加工（OEM / ODM）提供稳定、精确且合适的制造解决方案。\\n我们致力于提供符合质量标准、高耐用性且在每笔订单中都保持一致性的产品。\"}, \"core_values\": {\"title\": \"核心价值观\", \"values\": [{\"title\": \"精密制造\", \"image_id\": 104, \"description\": \"在每个生产环节中注重精度、稳定性和技术标准。\"}, {\"title\": \"可持续品质\", \"image_id\": 106, \"description\": \"使用认证材料，严格控制，确保产品耐用、稳定且一致。\"}, {\"title\": \"持续改进\", \"image_id\": 105, \"description\": \"不断升级技术，优化流程，提高生产效率。\"}, {\"title\": \"长期合作\", \"image_id\": 107, \"description\": \"以诚信为基础，致力于与合作伙伴建立可持续的、共同发展的关系。\"}]}, \"development\": {\"title\": \"发展\", \"image_id\": 103, \"description\": \"从最初的生产基础出发，DUYANG VIETNAM 不断投资于技术、机械和流程改进，以提高生产能力。我们正在扩大产品组合，优化质量，并逐步确立在工业制造领域的地位。\\n凭借长期的发展方向，我们将继续提高生产标准，拓展市场，并在未来为合作伙伴提供高效、稳定的制造解决方案。\"}}}', 'published', 'system', '2026-03-19 08:40:36', '2026-03-24 03:35:10'),
(3, '{\"en\": \"Contact\", \"vi\": \"Liên hệ\", \"zh_CN\": \"联系我们\"}', '{\"en\": \"contact\", \"vi\": \"contact\", \"zh_CN\": \"contact\"}', '{\"zh_CN\": \"\"}', '{\"zh_CN\": \"\"}', '{\"en\": {\"faq\": {\"faq\": {\"What is the production lead time?\": \"Production lead time depends on the order quantity and product specifications. Our team will provide a specific timeframe after confirming order details.\", \"Does the factory control product quality?\": \"Yes. Our factory implements strict quality control processes at every stage of production to ensure all products meet standards before delivery.\", \"What is the Minimum Order Quantity (MOQ)?\": \"The minimum order quantity depends on the product type and manufacturing requirements. Please contact us for detailed information.\", \"Does the factory accept custom manufacturing?\": \"Yes. We offer OEM/ODM manufacturing services and can produce according to customer designs, specifications, or requirements.\", \"Does the factory support packaging and export?\": \"Yes. We provide packaging solutions, product inspection, container loading, and shipping support for both domestic and international customers.\"}, \"title\": \"Information to Know Before Cooperating\", \"description\": \"Answers to common questions about manufacturing, processing, packaging, and shipping at DUYANG VIETNAM.\"}, \"map\": {\"embed\": \"<iframe src=\\\\\\\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.650484527321!2d106.08016517596784!3d20.92637699128586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a3a8610927eb%3A0x67ec5247515f5685!2sDuyang%20vietnam!5e0!3m2!1svi!2s!4v1772591618809!5m2!1svi!2s\\\\\\\" width=\\\\\\\"600\\\\\\\" height=\\\\\\\"450\\\\\\\" style=\\\\\\\"border:0;\\\\\\\" allowfullscreen=\\\\\\\"\\\\\\\" loading=\\\\\\\"lazy\\\\\\\" referrerpolicy=\\\\\\\"no-referrer-when-downgrade\\\\\\\"></iframe>\"}, \"hero\": {\"title\": \"Contact Us\", \"image_id\": 112, \"description\": \"DUYANG VIETNAM is always ready to support and advise on production solutions that suit your needs. Please send us your information, our team will respond quickly and provide details about products, production capacity, as well as OEM/ODM cooperation.\"}, \"info\": {\"email\": \"duyangvietnam@gmail.com\", \"phone\": \"0878 989 999\", \"address\": \"No. 1236 Nguyen Van Linh Street, Thuong Hong Ward, Hung Yen Province, Vietnam\", \"tax_code\": \"0901196968\", \"business_field\": \"Manufacturing products from wood, bamboo, rattan, straw, hay, and related materials for industrial and consumer use.\", \"representative\": \"Mr. Thach Cong Dong\"}, \"working_hours\": {\"working_hours\": {\"Sunday\": \"Closed\", \"Saturday\": \"08:00 – 12:00\", \"Monday – Friday\": \"08:00 – 17:00\"}}}, \"vi\": {\"faq\": {\"faq\": {\"Thời gian sản xuất là bao lâu?\": \"Thời gian sản xuất phụ thuộc vào số lượng đơn hàng và thông số sản phẩm. Đội ngũ của chúng tôi sẽ cung cấp thời gian cụ thể sau khi xác nhận chi tiết đơn hàng.\", \"Nhà máy có nhận sản xuất theo yêu cầu không?\": \"Có. Chúng tôi cung cấp dịch vụ sản xuất OEM/ODM và có thể sản xuất theo thiết kế, thông số kỹ thuật hoặc yêu cầu của khách hàng.\", \"ố lượng đặt hàng tối thiểu (MOQ) là bao nhiêu?\": \"Số lượng đặt hàng tối thiểu phụ thuộc vào loại sản phẩm và yêu cầu sản xuất. Vui lòng liên hệ với chúng tôi để biết thông tin chi tiết.\", \"Nhà máy có hỗ trợ đóng gói và xuất khẩu không?\": \"Có. Chúng tôi cung cấp các giải pháp đóng gói, kiểm tra sản phẩm, đóng container và hỗ trợ vận chuyển theo yêu cầu của cả khách hàng trong nước và quốc tế.\", \"Nhà máy có kiểm soát chất lượng sản phẩm không?\": \"Có. Nhà máy của chúng tôi áp dụng quy trình kiểm soát chất lượng nghiêm ngặt ở mọi giai đoạn sản xuất để đảm bảo tất cả sản phẩm đạt tiêu chuẩn trước khi giao hàng.\"}, \"title\": \"Thông Tin Cần Biết Trước Khi Hợp Tác\", \"description\": \"Giải đáp các câu hỏi phổ biến về sản xuất, gia công, đóng gói và xuất hàng tại DUYANG VIETNAM.\"}, \"map\": {\"embed\": \"<iframe src=\\\\\\\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.650484527321!2d106.08016517596784!3d20.92637699128586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a3a8610927eb%3A0x67ec5247515f5685!2sDuyang%20vietnam!5e0!3m2!1svi!2s!4v1772591618809!5m2!1svi!2s\\\\\\\" width=\\\\\\\"600\\\\\\\" height=\\\\\\\"450\\\\\\\" style=\\\\\\\"border:0;\\\\\\\" allowfullscreen=\\\\\\\"\\\\\\\" loading=\\\\\\\"lazy\\\\\\\" referrerpolicy=\\\\\\\"no-referrer-when-downgrade\\\\\\\"></iframe>\"}, \"hero\": {\"title\": \"Liên Hệ Với Chúng Tôi\", \"image_id\": 112, \"description\": \"DUYANG VIETNAM luôn sẵn sàng hỗ trợ và tư vấn giải pháp sản xuất phù hợp với nhu cầu của bạn. Hãy gửi thông tin, đội ngũ của chúng tôi sẽ phản hồi nhanh chóng và cung cấp chi tiết về sản phẩm, năng lực sản xuất cũng như hợp tác OEM / ODM.\"}, \"info\": {\"email\": \"duyangvietnam@gmail.com\", \"phone\": \"0878 989 999\", \"address\": \"Số 1236 Đường Nguyễn Văn Linh, Phường Thượng Hồng,  Tỉnh Hưng Yên, Việt Nam\", \"tax_code\": \"0901196968\", \"business_field\": \"Sản xuất các sản phẩm từ gỗ, tre, nứa, rơm, rạ và vật liệu liên quan phục vụ công nghiệp và tiêu dùng.\", \"representative\": \"Ông Thạch Công Đồng\"}, \"working_hours\": {\"working_hours\": {\"Thứ Bảy\": \"08:00 – 12:00\", \"Chủ Nhật\": \"Nghỉ\", \"Thứ Hai – Thứ Sáu\": \"08:00 – 17:00\"}}}, \"zh_CN\": {\"faq\": {\"faq\": {\"生产周期是多久？\": \"生产周期取决于订单数量和产品规格。在确认订单详情后，我们的团队将提供具体的时间。\", \"工厂是否接受定制生产？\": \"是的。我们提供 OEM/ODM 生产服务，可根据客户的设计、规格或要求进行生产。\", \"工厂是否控制产品质量？\": \"是的。我们的工厂在生产的每个阶段都实施严格的质量控制流程，以确保所有产品在交付前都符合标准。\", \"最低起订量 (MOQ) 是多少？\": \"最低起订量取决于产品类型和生产要求。请联系我们获取详细信息。\", \"工厂是否支持包装和出口？\": \"是的。我们为国内外客户提供包装解决方案、产品检验、集装箱装载和运输支持。\"}, \"title\": \"合作前须知\", \"description\": \"解答关于 DUYANG VIETNAM 生产、加工、包装和发货的常见问题。\"}, \"map\": {\"embed\": \"<iframe src=\\\\\\\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.650484527321!2d106.08016517596784!3d20.92637699128586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a3a8610927eb%3A0x67ec5247515f5685!2sDuyang%20vietnam!5e0!3m2!1svi!2s!4v1772591618809!5m2!1svi!2s\\\\\\\" width=\\\\\\\"600\\\\\\\" height=\\\\\\\"450\\\\\\\" style=\\\\\\\"border:0;\\\\\\\" allowfullscreen=\\\\\\\"\\\\\\\" loading=\\\\\\\"lazy\\\\\\\" referrerpolicy=\\\\\\\"no-referrer-when-downgrade\\\\\\\"></iframe>\"}, \"hero\": {\"title\": \"联系我们\", \"image_id\": 112, \"description\": \"DUYANG VIETNAM 随时准备支持并根据您的需求提供合适的生产解决方案。请发送您的信息，我们的团队将迅速响应并提供有关产品、生产能力以及 OEM/ODM 合作的详细信息。\"}, \"info\": {\"email\": \"duyangvietnam@gmail.com\", \"phone\": \"0878 989 999\", \"address\": \"越南兴安省兴安市上红坊阮文灵路1236号\", \"tax_code\": \"0901196968\", \"business_field\": \"生产木材、竹子、藤条、稻草、干草及相关材料的工业和消费品。\", \"representative\": \"石功同先生\"}, \"working_hours\": {\"working_hours\": {\"周六\": \"08:00 – 12:00\", \"周日\": \"休息\", \"周一至周五\": \"08:00 – 17:00\"}}}}', 'published', 'system', '2026-03-19 08:40:36', '2026-03-24 03:47:47'),
(4, '{\"en\": \"Partner\", \"vi\": \"Đối Tác tin cậy\", \"zh_CN\": \"可信合作伙伴\"}', '{\"en\": \"partner\", \"vi\": \"partner\", \"zh_CN\": \"partner\"}', '{\"zh_CN\": \"\"}', '{\"zh_CN\": \"\"}', '{\"en\": {\"hero\": {\"title\": \"Why Choose Us as Your Manufacturing Partner\", \"image_id\": 85, \"description\": \"From vision to reality, we create homes that reflect your personality\"}, \"stats\": {\"items\": [{\"unit\": null, \"label\": \"Products Developed & Manufactured\", \"value\": \"500+\"}, {\"unit\": null, \"label\": null, \"value\": \"20K+\"}, {\"unit\": \"/5\", \"label\": \"Product Quality & Stability Ratings\", \"value\": \"4.8\"}, {\"unit\": \"Years\", \"label\": \"Industrial Manufacturing & Processing Experience\", \"value\": \"7+\"}]}, \"design\": {\"title\": \"Product Design & Development\", \"image_id\": 92, \"description\": \"At DUYANG VIETNAM, we focus on designs optimized for manufacturing and practical application. Our technical team collaborates closely with clients to develop products that are suitable in terms of structure, materials, and technical standards.\\nWe offer custom design and manufacturing solutions (OEM/ODM), from standard products to bespoke customizations, ensuring consistency, accuracy, and large-scale production capabilities. Each product is thoroughly researched to optimize usability, durability, and production costs.\"}, \"process\": {\"title\": \"Circular Production Process\", \"features\": [{\"title\": \"Controlled Materials\", \"image_id\": 90}, {\"title\": \"Optimized for Production & Use\", \"image_id\": 98}, {\"title\": \"Precision Machining\", \"image_id\": 96}, {\"title\": \"Production & Delivery Management\", \"image_id\": 97}], \"image_id\": 95, \"description\": \"At DUYANG VIETNAM, we implement optimized production processes to efficiently utilize raw materials, minimize waste, and maintain production stability. Each stage is strictly controlled, from incoming materials, processing, finishing, to packaging, ensuring products meet quality standards before shipment.\\nWe are committed to a sustainable production model, optimizing resources and enhancing long-term efficiency, thereby delivering stable value to our partners and the market.\"}, \"direction\": {\"title\": \"Development Direction\", \"image_id\": 87, \"description\": \"At DUYANG VIETNAM, we focus on building sustainable manufacturing capabilities through technology investment, process optimization, and product quality enhancement. All activities are geared towards increasing efficiency, ensuring accuracy, and maintaining stability in large-scale production.\\nWe continuously research materials, improve techniques, and expand processing capabilities to meet the growing demands of domestic and international partners. With a long-term development vision, DUYANG VIETNAM is committed to providing efficient, reliable, and sustainable manufacturing solutions for our clients.\"}, \"materials\": {\"title\": \"Sustainable Materials\", \"image_id\": 94, \"description\": \"At DUYANG VIETNAM, we prioritize the selection and control of material sources to ensure durability, stability, and efficiency in production. From wood and metal to plastics, all materials are chosen according to quality standards and are suitable for long-term manufacturing.\\nWe aim to use materials efficiently, optimize processes, and minimize waste in production, contributing to the development of sustainable and stable manufacturing solutions for our partners.\"}, \"innovation\": {\"title\": \"INNOVATION\", \"image_id\": 86, \"description\": \"At DUYANG VIETNAM, innovation is the cornerstone of our development and production processes. We continuously invest in technology, modern machinery, and process improvements to enhance production efficiency, accuracy, and product quality.\\nWith an experienced technical team and a mindset of continuous improvement, we aim to create optimal manufacturing solutions that meet the ever-increasing demands of both domestic and international markets. Innovation is not just a strategy; it is DUYANG VIETNAM\'s long-term commitment to delivering sustainable value to our partners.\"}, \"core_values\": {\"title\": \"Core Values\", \"values\": [{\"title\": \"Precision Manufacturing\", \"image_id\": 89, \"description\": \"Focusing on accuracy, stability, and technical standards in every production stage.\"}, {\"title\": \"Sustainable Quality\", \"image_id\": 88, \"description\": \"Using certified materials and strict control to ensure durable, stable, and consistent products.\"}, {\"title\": \"Continuous Improvement\", \"image_id\": 90, \"description\": \"Constantly upgrading technology, optimizing processes, and enhancing production efficiency.\"}, {\"title\": \"Long-Term Partnership\", \"image_id\": 91, \"description\": \"Building on trust, aiming for sustainable cooperative relationships and mutual growth with partners.\"}]}, \"improvement\": {\"title\": \"Spirit of Improvement\", \"image_id\": 93, \"description\": \"At DUYANG VIETNAM, we are always committed to continuous improvement in production, from technology and processes to materials. Our goal is to enhance efficiency, ensure consistent quality, and optimize costs for our partners.\\nWe focus on developing sustainable manufacturing solutions that align with practical requirements and large-scale production capabilities, while maintaining flexibility in custom manufacturing (OEM/ODM).\"}}, \"vi\": {\"hero\": {\"title\": \"Vì sao lên chọn chúng tôi làm đơn vị sản xuất\", \"image_id\": 85, \"description\": \"Từ tầm nhìn đến thực tế, chúng tôi tạo ra những ngôi nhà phản ánh cá tính của bạn\"}, \"stats\": {\"items\": [{\"unit\": null, \"label\": \"Sản phẩm đã phát triển & sản xuất\", \"value\": \"500+\"}, {\"unit\": null, \"label\": null, \"value\": \"20K+\"}, {\"unit\": \"/5\", \"label\": \"Đánh giá chất lượng & độ ổn định sản phẩm\", \"value\": \"4.8\"}, {\"unit\": \"Năm\", \"label\": \"Kinh nghiệm sản xuất & gia công công nghiệp\", \"value\": \"7+\"}]}, \"design\": {\"title\": \"Thiết Kế & Phát Triển Sản Phẩm\", \"image_id\": 92, \"description\": \"Tại DUYANG VIETNAM, chúng tôi tập trung vào thiết kế tối ưu cho sản xuất và ứng dụng thực tế. Đội ngũ kỹ thuật phối hợp chặt chẽ với khách hàng để phát triển sản phẩm phù hợp về kết cấu, vật liệu và tiêu chuẩn kỹ thuật.\\nChúng tôi cung cấp giải pháp thiết kế và gia công theo yêu cầu (OEM / ODM), từ sản phẩm tiêu chuẩn đến tùy chỉnh riêng, đảm bảo tính đồng bộ, độ chính xác và khả năng sản xuất quy mô lớn. Mỗi sản phẩm đều được nghiên cứu kỹ nhằm tối ưu hiệu quả sử dụng, độ bền và chi phí sản xuất.\"}, \"process\": {\"title\": \"Quy Trình Sản Xuất Tuần Hoàn\", \"features\": [{\"title\": \"Vật liệu được kiểm soát\", \"image_id\": 90}, {\"title\": \"Tối ưu cho sản xuất & sử dụng\", \"image_id\": 98}, {\"title\": \"Gia công chính xác\", \"image_id\": 96}, {\"title\": \"Quản lý sản xuất & giao hàng\", \"image_id\": 97}], \"image_id\": 95, \"description\": \"Tại DUYANG VIETNAM, chúng tôi áp dụng quy trình sản xuất tối ưu nhằm sử dụng hiệu quả nguyên vật liệu, giảm thiểu lãng phí và duy trì tính ổn định trong sản xuất. Mỗi công đoạn đều được kiểm soát chặt chẽ từ nguyên liệu đầu vào, gia công, hoàn thiện đến đóng gói, đảm bảo sản phẩm đạt tiêu chuẩn chất lượng trước khi xuất xưởng.\\nChúng tôi hướng đến mô hình sản xuất bền vững, tối ưu tài nguyên và nâng cao hiệu quả lâu dài, mang lại giá trị ổn định cho đối tác và thị trường.\"}, \"direction\": {\"title\": \"Định Hướng Phát Triển\", \"image_id\": 87, \"description\": \"Tại DUYANG VIETNAM, chúng tôi tập trung xây dựng năng lực sản xuất bền vững thông qua việc đầu tư công nghệ, tối ưu quy trình và nâng cao chất lượng sản phẩm. Mọi hoạt động đều hướng đến mục tiêu tăng hiệu suất, đảm bảo độ chính xác và duy trì tính ổn định trong sản xuất quy mô lớn.\\nChúng tôi không ngừng nghiên cứu vật liệu, cải tiến kỹ thuật và mở rộng khả năng gia công nhằm đáp ứng yêu cầu ngày càng cao của đối tác trong và ngoài nước. Với định hướng phát triển lâu dài, DUYANG VIETNAM cam kết mang đến giải pháp sản xuất hiệu quả, tin cậy và bền vững cho khách hàng.\"}, \"materials\": {\"title\": \"Vật liệu bền vững\", \"image_id\": 94, \"description\": \"Tại DUYANG VIETNAM, chúng tôi chú trọng lựa chọn và kiểm soát nguồn vật liệu nhằm đảm bảo độ bền, tính ổn định và hiệu quả trong sản xuất. Từ gỗ, kim loại đến nhựa, tất cả đều được lựa chọn theo tiêu chuẩn chất lượng và phù hợp cho sản xuất lâu dài.\\nChúng tôi hướng đến việc sử dụng vật liệu hiệu quả, tối ưu quy trình và giảm thiểu lãng phí trong sản xuất, góp phần xây dựng giải pháp sản xuất bền vững và ổn định cho đối tác.\"}, \"innovation\": {\"title\": \"SỰ ĐỔI MỚI\", \"image_id\": 86, \"description\": \"Tại DUYANG VIETNAM, đổi mới là nền tảng trong quá trình phát triển và sản xuất. Chúng tôi không ngừng đầu tư vào công nghệ, máy móc hiện đại và cải tiến quy trình nhằm nâng cao hiệu quả sản xuất, độ chính xác và chất lượng sản phẩm.\\nVới đội ngũ kỹ thuật giàu kinh nghiệm cùng tư duy cải tiến liên tục, chúng tôi hướng đến việc tạo ra các giải pháp sản xuất tối ưu, đáp ứng yêu cầu ngày càng cao của thị trường trong nước và quốc tế. Đổi mới không chỉ là chiến lược, mà là cam kết lâu dài của DUYANG VIETNAM trong việc mang đến giá trị bền vững cho đối tác.\"}, \"core_values\": {\"title\": \"Giá Trị Cốt Lõi\", \"values\": [{\"title\": \"Sản xuất chính xác\", \"image_id\": 89, \"description\": \"Tập trung vào độ chính xác, tính ổn định và tiêu chuẩn kỹ thuật trong từng công đoạn sản xuất.\"}, {\"title\": \"Chất lượng bền vững\", \"image_id\": 88, \"description\": \"Sử dụng vật liệu đạt chuẩn, kiểm soát chặt chẽ để đảm bảo sản phẩm bền, ổn định - đồng đều.\"}, {\"title\": \"Cải tiến liên tục\", \"image_id\": 90, \"description\": \"Không ngừng nâng cấp công nghệ, tối ưu quy trình và nâng cao hiệu quả sản xuất.\"}, {\"title\": \"Hợp tác lâu dài\", \"image_id\": 91, \"description\": \"Lấy uy tín làm nền tảng, hướng đến mối quan hệ hợp tác bền vững và phát triển cùng đối tác.\"}]}, \"improvement\": {\"title\": \"Tinh Thần Cải Tiến\", \"image_id\": 93, \"description\": \"Tại DUYANG VIETNAM, chúng tôi luôn hướng đến việc cải tiến liên tục trong sản xuất, từ công nghệ, quy trình đến vật liệu. Mục tiêu của chúng tôi là nâng cao hiệu quả, đảm bảo chất lượng ổn định và tối ưu chi phí cho đối tác.\\nChúng tôi tập trung phát triển các giải pháp sản xuất bền vững, phù hợp với yêu cầu thực tế và khả năng sản xuất quy mô lớn, đồng thời duy trì sự linh hoạt trong gia công theo yêu cầu (OEM / ODM).\"}}, \"zh_CN\": {\"hero\": {\"title\": \"为何选择我们作为您的生产商\", \"image_id\": 85, \"description\": \"从愿景到现实，我们创造反映您个性的家园\"}, \"stats\": {\"items\": [{\"unit\": null, \"label\": \"已开发和生产的产品\", \"value\": \"500+\"}, {\"unit\": null, \"label\": null, \"value\": \"20K+\"}, {\"unit\": \"/5\", \"label\": \"产品质量与稳定性评分\", \"value\": \"4.8\"}, {\"unit\": \"年\", \"label\": \"工业制造与加工经验\", \"value\": \"7+\"}]}, \"design\": {\"title\": \"产品设计与开发\", \"image_id\": 92, \"description\": \"在 DUYANG VIETNAM，我们专注于为制造和实际应用优化的设计。我们的技术团队与客户密切合作，开发在结构、材料和技术标准方面都合适的产品。\\n我们提供定制设计和制造解决方案（OEM/ODM），从标准产品到定制化服务，确保一致性、精度和大规模生产能力。每件产品都经过深入研究，以优化使用效率、耐用性和生产成本。\"}, \"process\": {\"title\": \"循环生产流程\", \"features\": [{\"title\": \"受控材料\", \"image_id\": 90}, {\"title\": \"优化生产与使用\", \"image_id\": 98}, {\"title\": \"精密加工\", \"image_id\": 96}, {\"title\": \"生产与交付管理\", \"image_id\": 97}], \"image_id\": 95, \"description\": \"在 DUYANG VIETNAM，我们实施优化的生产流程，以高效利用原材料、减少浪费并维持生产稳定性。每个环节都受到严格控制，从原材料进厂、加工、精加工到包装，确保产品在出厂前达到质量标准。\\n我们致力于可持续的生产模式，优化资源并提高长期效率，从而为合作伙伴和市场带来稳定的价值。\"}, \"direction\": {\"title\": \"发展方向\", \"image_id\": 87, \"description\": \"在 DUYANG VIETNAM，我们专注于通过技术投资、流程优化和产品质量提升来建立可持续的制造能力。所有活动都旨在提高效率、确保精度并维持大规模生产的稳定性。\\n我们不断研究材料、改进技术并扩大加工能力，以满足国内外合作伙伴日益增长的需求。凭借长期的发展愿景，DUYANG VIETNAM 致力于为客户提供高效、可靠和可持续的制造解决方案。\"}, \"materials\": {\"title\": \"可持续材料\", \"image_id\": 94, \"description\": \"在 DUYANG VIETNAM，我们优先选择和控制原材料来源，以确保生产的耐用性、稳定性和效率。从木材、金属到塑料，所有材料都根据质量标准进行选择，并适用于长期制造。\\n我们致力于高效利用材料、优化流程并减少生产浪费，为合作伙伴的可持续和稳定制造解决方案做出贡献。\"}, \"innovation\": {\"title\": \"创新\", \"image_id\": 86, \"description\": \"在 DUYANG VIETNAM，创新是我们发展和生产过程的基石。我们不断投资于技术、现代化机械和工艺改进，以提高生产效率、精度和产品质量。\\n凭借经验丰富的技术团队和持续改进的思维，我们致力于创造最佳的制造解决方案，以满足国内外市场日益增长的需求。创新不仅仅是一项战略，更是 DUYANG VIETNAM 为合作伙伴提供可持续价值的长期承诺。\"}, \"core_values\": {\"title\": \"核心价值观\", \"values\": [{\"title\": \"精密制造\", \"image_id\": 89, \"description\": \"在每个生产环节都注重精度、稳定性和技术标准。\"}, {\"title\": \"可持续品质\", \"image_id\": 88, \"description\": \"使用认证材料并进行严格控制，以确保产品耐用、稳定且一致。\"}, {\"title\": \"持续改进\", \"image_id\": 90, \"description\": \"不断升级技术、优化流程并提高生产效率。\"}, {\"title\": \"长期合作\", \"image_id\": 91, \"description\": \"以信任为基础，寻求与合作伙伴建立可持续的合作关系并共同发展。\"}]}, \"improvement\": {\"title\": \"改进精神\", \"image_id\": 93, \"description\": \"在 DUYANG VIETNAM，我们始终致力于生产的持续改进，涵盖技术、流程和材料。我们的目标是提高效率、确保质量稳定并为合作伙伴优化成本。\\n我们专注于开发可持续的制造解决方案，以适应实际需求和大规模生产能力，同时保持定制制造（OEM/ODM）的灵活性。\"}}}', 'published', 'system', '2026-03-19 08:40:36', '2026-03-24 02:39:47'),
(7, '{\"en\": \"Shop\", \"vi\": \"Sản phẩm\", \"zh_CN\": \"制品\"}', '{\"en\": \"shop\", \"vi\": \"shop\", \"zh_CN\": \"shop\"}', '{\"zh_CN\": \"\"}', '{\"zh_CN\": \"\"}', '{\"en\": {\"hero\": {\"title\": \"Discover All Products\", \"image_id\": 113}, \"banners\": [{\"title\": \"Premium Collection\", \"image_id\": 114, \"description\": \"The premium hanger line is specially designed for vests, suits, high-fashion, and showrooms, featuring a sturdy structure, smooth finish, and excellent garment shaping capabilities. Ideal for fashion brands, luxury boutiques, and custom manufacturing.\", \"collection_id\": 1}, {\"title\": \"Standard Collection\", \"image_id\": 115, \"description\": \"The standard hanger line is suitable for hanging everyday clothing, for home use, shops, and bulk production. Optimized design for daily use, stable durability, and reasonable cost.\", \"collection_id\": 2}]}, \"vi\": {\"hero\": {\"title\": \"Khám Phá Tất Cả Sản Phẩm\", \"image_id\": 113}, \"banners\": [{\"title\": \"Dòng Sản Phẩm Cao Cấp\", \"image_id\": 114, \"description\": \"Dòng móc treo cao cấp được thiết kế chuyên dụng cho vest, suit, thời trang cao cấp và showroom, với kết cấu chắc chắn, bề mặt hoàn thiện mịn và khả năng giữ form trang phục tốt. Phù hợp cho thương hiệu thời trang, cửa hàng cao cấp và sản xuất theo yêu cầu.\", \"collection_id\": 1}, {\"title\": \"Dòng Sản Phẩm Tiêu Chuẩn\", \"image_id\": 115, \"description\": \"Dòng móc treo tiêu chuẩn phù hợp cho treo quần áo thông thường, gia đình, cửa hàng và sản xuất số lượng lớn. Thiết kế tối ưu cho sử dụng hàng ngày, độ bền ổn định và chi phí hợp lý.\", \"collection_id\": 2}]}, \"zh_CN\": {\"hero\": {\"title\": \"探索所有产品\", \"image_id\": 113}, \"banners\": [{\"title\": \"高端系列\", \"image_id\": 114, \"description\": \"高端衣架系列专为西装、套装、高级时装和展厅设计，结构坚固，表面光滑，能很好地保持服装的形状。适用于时尚品牌、高端精品店和定制生产。\", \"collection_id\": 1}, {\"title\": \"标准系列\", \"image_id\": 115, \"description\": \"标准衣架系列适用于悬挂日常服装，适合家庭使用、商店和批量生产。设计优化，适合日常使用，耐用性稳定，价格合理。\", \"collection_id\": 2}]}}', 'published', 'system', '2026-03-19 08:40:36', '2026-03-24 06:50:35');
INSERT INTO `pages` (`id`, `title`, `slug`, `description`, `content`, `sections`, `status`, `page_type`, `created_at`, `updated_at`) VALUES
(9, '{\"en\": \"Packaging & Shipping Operations\", \"vi\": \"Hoạt Động Đóng Gói & Xuất Hàng\", \"zh_CN\": \"包装与发货操作\"}', '{\"en\": \"packaging-shipping-operations\", \"vi\": \"hoat-dong-dong-goi-xuat-hang\", \"zh_CN\": \"baozhuang-yu-fahuo-caozuo\"}', '{\"en\": \"Packaging process, final inspection, and shipping of products to domestic and international partners.\", \"vi\": \"Quy trình đóng gói, kiểm tra cuối cùng và vận chuyển sản phẩm đến đối tác trong và ngoài nước.\", \"zh_CN\": \"产品包装、最终检验及向国内外合作伙伴发货的流程。\"}', '{\"en\": \"<div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;right&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;At DUYANG VIETNAM, the packaging and shipping stage plays a crucial role in the entire production chain, ensuring products are delivered to partners in a safe, intact, and technically compliant condition. Each batch of goods is meticulously inspected for quality, quantity, packaging specifications, and shipping conditions before leaving the factory, ensuring it fully meets customer requirements and established production standards.\\\\nWe apply professional packaging processes suitable for each type of product and transportation characteristics. Packaging materials are carefully selected to protect products from impacts during storage and transit, especially for long-distance export orders. Depending on the requirements, products can be packaged according to specific customer standards, ensuring uniformity and convenience in receiving, distribution, and usage.&quot;,&quot;image_id&quot;:121}\\\" data-id=\\\"two_column\\\"></div><div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;left&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;During the packaging process, each product undergoes a final inspection of its surface, structure, and finish before being packed into cartons. Each shipment is clearly categorized, labeled, and coded, making inspection and information retrieval accurate and convenient. This contributes to transparency and stability throughout the entire shipping process.\\\\nThe DUYANG VIETNAM operations team collaborates closely in the export preparation phase, from arranging goods, optimizing container space, to inspecting shipping conditions. The loading process is carried out according to standards to minimize risks, ensuring goods are securely fixed and safe during transit.&quot;,&quot;image_id&quot;:122}\\\" data-id=\\\"two_column\\\"></div><p>Additionally, we maintain a synchronized production and logistics management system, enabling tracking of shipping progress, control of transportation schedules, and ensuring on-time delivery. Close coordination between production, quality control, and shipping departments helps DUYANG VIETNAM maintain stable, accurate, and efficient shipping operations.</p><p>With a focus on sustainable and professional development, DUYANG VIETNAM continuously improves its packaging and shipping processes to enhance supply chain efficiency, ensure product quality, and strengthen the trust of domestic and international partners. We are committed to maintaining stability, punctuality, and standards in every shipment, contributing to building long-term and sustainable cooperative relationships.</p>\", \"vi\": \"<div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;right&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;T\\\\u1ea1i DUYANG VIETNAM, c\\\\u00f4ng \\\\u0111o\\\\u1ea1n \\\\u0111\\\\u00f3ng g\\\\u00f3i v\\\\u00e0 xu\\\\u1ea5t h\\\\u00e0ng \\\\u0111\\\\u00f3ng vai tr\\\\u00f2 quan tr\\\\u1ecdng trong to\\\\u00e0n b\\\\u1ed9 chu\\\\u1ed7i s\\\\u1ea3n xu\\\\u1ea5t, nh\\\\u1eb1m \\\\u0111\\\\u1ea3m b\\\\u1ea3o s\\\\u1ea3n ph\\\\u1ea9m \\\\u0111\\\\u01b0\\\\u1ee3c b\\\\u00e0n giao \\\\u0111\\\\u1ebfn \\\\u0111\\\\u1ed1i t\\\\u00e1c trong tr\\\\u1ea1ng th\\\\u00e1i an to\\\\u00e0n, nguy\\\\u00ean v\\\\u1eb9n v\\\\u00e0 \\\\u0111\\\\u00fang ti\\\\u00eau chu\\\\u1ea9n k\\\\u1ef9 thu\\\\u1eadt. M\\\\u1ed7i l\\\\u00f4 h\\\\u00e0ng tr\\\\u01b0\\\\u1edbc khi r\\\\u1eddi kh\\\\u1ecfi nh\\\\u00e0 m\\\\u00e1y \\\\u0111\\\\u1ec1u \\\\u0111\\\\u01b0\\\\u1ee3c ki\\\\u1ec3m tra k\\\\u1ef9 l\\\\u01b0\\\\u1ee1ng v\\\\u1ec1 ch\\\\u1ea5t l\\\\u01b0\\\\u1ee3ng, s\\\\u1ed1 l\\\\u01b0\\\\u1ee3ng, quy c\\\\u00e1ch \\\\u0111\\\\u00f3ng g\\\\u00f3i v\\\\u00e0 \\\\u0111i\\\\u1ec1u ki\\\\u1ec7n v\\\\u1eadn chuy\\\\u1ec3n, \\\\u0111\\\\u1ea3m b\\\\u1ea3o \\\\u0111\\\\u00e1p \\\\u1ee9ng \\\\u0111\\\\u1ea7y \\\\u0111\\\\u1ee7 y\\\\u00eau c\\\\u1ea7u c\\\\u1ee7a kh\\\\u00e1ch h\\\\u00e0ng c\\\\u0169ng nh\\\\u01b0 ti\\\\u00eau chu\\\\u1ea9n s\\\\u1ea3n xu\\\\u1ea5t \\\\u0111\\\\u00e3 \\\\u0111\\\\u1ec1 ra.\\\\nCh\\\\u00fang t\\\\u00f4i \\\\u00e1p d\\\\u1ee5ng quy tr\\\\u00ecnh \\\\u0111\\\\u00f3ng g\\\\u00f3i chuy\\\\u00ean nghi\\\\u1ec7p, ph\\\\u00f9 h\\\\u1ee3p v\\\\u1edbi t\\\\u1eebng lo\\\\u1ea1i s\\\\u1ea3n ph\\\\u1ea9m v\\\\u00e0 \\\\u0111\\\\u1eb7c th\\\\u00f9 v\\\\u1eadn chuy\\\\u1ec3n. V\\\\u1eadt li\\\\u1ec7u \\\\u0111\\\\u00f3ng g\\\\u00f3i \\\\u0111\\\\u01b0\\\\u1ee3c l\\\\u1ef1a ch\\\\u1ecdn c\\\\u1ea9n th\\\\u1eadn nh\\\\u1eb1m b\\\\u1ea3o v\\\\u1ec7 s\\\\u1ea3n ph\\\\u1ea9m tr\\\\u01b0\\\\u1edbc c\\\\u00e1c t\\\\u00e1c \\\\u0111\\\\u1ed9ng trong qu\\\\u00e1 tr\\\\u00ecnh l\\\\u01b0u kho v\\\\u00e0 v\\\\u1eadn chuy\\\\u1ec3n, \\\\u0111\\\\u1eb7c bi\\\\u1ec7t \\\\u0111\\\\u1ed1i v\\\\u1edbi c\\\\u00e1c \\\\u0111\\\\u01a1n h\\\\u00e0ng xu\\\\u1ea5t kh\\\\u1ea9u \\\\u0111\\\\u01b0\\\\u1eddng d\\\\u00e0i. T\\\\u00f9y theo y\\\\u00eau c\\\\u1ea7u, s\\\\u1ea3n ph\\\\u1ea9m c\\\\u00f3 th\\\\u1ec3 \\\\u0111\\\\u01b0\\\\u1ee3c \\\\u0111\\\\u00f3ng g\\\\u00f3i theo ti\\\\u00eau chu\\\\u1ea9n ri\\\\u00eang c\\\\u1ee7a kh\\\\u00e1ch h\\\\u00e0ng, \\\\u0111\\\\u1ea3m b\\\\u1ea3o t\\\\u00ednh \\\\u0111\\\\u1ed3ng b\\\\u1ed9 v\\\\u00e0 thu\\\\u1eadn ti\\\\u1ec7n trong qu\\\\u00e1 tr\\\\u00ecnh ti\\\\u1ebfp nh\\\\u1eadn, ph\\\\u00e2n ph\\\\u1ed1i v\\\\u00e0 s\\\\u1eed d\\\\u1ee5ng.&quot;,&quot;image_id&quot;:121}\\\" data-id=\\\"two_column\\\"></div><div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;left&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;Trong qu\\\\u00e1 tr\\\\u00ecnh \\\\u0111\\\\u00f3ng g\\\\u00f3i, t\\\\u1eebng s\\\\u1ea3n ph\\\\u1ea9m \\\\u0111\\\\u01b0\\\\u1ee3c ki\\\\u1ec3m tra l\\\\u1ea7n cu\\\\u1ed1i v\\\\u1ec1 b\\\\u1ec1 m\\\\u1eb7t, k\\\\u1ebft c\\\\u1ea5u v\\\\u00e0 \\\\u0111\\\\u1ed9 ho\\\\u00e0n thi\\\\u1ec7n tr\\\\u01b0\\\\u1edbc khi \\\\u0111\\\\u01b0a v\\\\u00e0o quy tr\\\\u00ecnh \\\\u0111\\\\u00f3ng th\\\\u00f9ng. M\\\\u1ed7i ki\\\\u1ec7n h\\\\u00e0ng \\\\u0111\\\\u1ec1u \\\\u0111\\\\u01b0\\\\u1ee3c ph\\\\u00e2n lo\\\\u1ea1i, ghi nh\\\\u00e3n v\\\\u00e0 m\\\\u00e3 h\\\\u00f3a r\\\\u00f5 r\\\\u00e0ng, gi\\\\u00fap vi\\\\u1ec7c ki\\\\u1ec3m so\\\\u00e1t v\\\\u00e0 truy xu\\\\u1ea5t th\\\\u00f4ng tin tr\\\\u1edf n\\\\u00ean ch\\\\u00ednh x\\\\u00e1c v\\\\u00e0 thu\\\\u1eadn ti\\\\u1ec7n. \\\\u0110i\\\\u1ec1u n\\\\u00e0y g\\\\u00f3p ph\\\\u1ea7n \\\\u0111\\\\u1ea3m b\\\\u1ea3o t\\\\u00ednh minh b\\\\u1ea1ch v\\\\u00e0 \\\\u1ed5n \\\\u0111\\\\u1ecbnh trong to\\\\u00e0n b\\\\u1ed9 qu\\\\u00e1 tr\\\\u00ecnh xu\\\\u1ea5t h\\\\u00e0ng.\\\\n\\\\u0110\\\\u1ed9i ng\\\\u0169 v\\\\u1eadn h\\\\u00e0nh c\\\\u1ee7a DUYANG VIETNAM ph\\\\u1ed1i h\\\\u1ee3p ch\\\\u1eb7t ch\\\\u1ebd trong kh\\\\u00e2u chu\\\\u1ea9n b\\\\u1ecb xu\\\\u1ea5t x\\\\u01b0\\\\u1edfng, t\\\\u1eeb s\\\\u1eafp x\\\\u1ebfp h\\\\u00e0ng h\\\\u00f3a, t\\\\u1ed1i \\\\u01b0u kh\\\\u00f4ng gian container \\\\u0111\\\\u1ebfn ki\\\\u1ec3m tra \\\\u0111i\\\\u1ec1u ki\\\\u1ec7n v\\\\u1eadn chuy\\\\u1ec3n. Quy tr\\\\u00ecnh b\\\\u1ed1c x\\\\u1ebfp \\\\u0111\\\\u01b0\\\\u1ee3c th\\\\u1ef1c hi\\\\u1ec7n theo ti\\\\u00eau chu\\\\u1ea9n nh\\\\u1eb1m h\\\\u1ea1n ch\\\\u1ebf t\\\\u1ed1i \\\\u0111a r\\\\u1ee7i ro, \\\\u0111\\\\u1ea3m b\\\\u1ea3o h\\\\u00e0ng h\\\\u00f3a \\\\u0111\\\\u01b0\\\\u1ee3c c\\\\u1ed1 \\\\u0111\\\\u1ecbnh ch\\\\u1eafc ch\\\\u1eafn v\\\\u00e0 an to\\\\u00e0n trong su\\\\u1ed1t qu\\\\u00e1 tr\\\\u00ecnh v\\\\u1eadn chuy\\\\u1ec3n.&quot;,&quot;image_id&quot;:122}\\\" data-id=\\\"two_column\\\"></div><p>Bên cạnh đó, chúng tôi duy trì hệ thống quản lý sản xuất và logistics đồng bộ, giúp theo dõi tiến độ xuất hàng, kiểm soát lịch trình vận chuyển và đảm bảo giao hàng đúng kế hoạch. Sự phối hợp chặt chẽ giữa các bộ phận sản xuất, kiểm soát chất lượng và vận chuyển giúp DUYANG VIETNAM duy trì hoạt động xuất hàng ổn định, chính xác và hiệu quả.</p><p>Với định hướng phát triển bền vững và chuyên nghiệp, DUYANG VIETNAM không ngừng cải tiến quy trình đóng gói và xuất hàng nhằm nâng cao hiệu quả chuỗi cung ứng, đảm bảo chất lượng sản phẩm và củng cố niềm tin của đối tác trong và ngoài nước. Chúng tôi cam kết duy trì sự ổn định, đúng tiến độ và tiêu chuẩn trong mọi lô hàng, góp phần xây dựng mối quan hệ hợp tác lâu dài và bền vững.</p>\", \"zh_CN\": \"<div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;right&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;\\\\u5728 DUYANG VIETNAM\\\\uff0c\\\\u5305\\\\u88c5\\\\u548c\\\\u53d1\\\\u8d27\\\\u9636\\\\u6bb5\\\\u5728\\\\u6574\\\\u4e2a\\\\u751f\\\\u4ea7\\\\u94fe\\\\u4e2d\\\\u8d77\\\\u7740\\\\u81f3\\\\u5173\\\\u91cd\\\\u8981\\\\u7684\\\\u4f5c\\\\u7528\\\\uff0c\\\\u786e\\\\u4fdd\\\\u4ea7\\\\u54c1\\\\u4ee5\\\\u5b89\\\\u5168\\\\u3001\\\\u5b8c\\\\u597d\\\\u4e14\\\\u7b26\\\\u5408\\\\u6280\\\\u672f\\\\u6807\\\\u51c6\\\\u7684\\\\u72b6\\\\u6001\\\\u4ea4\\\\u4ed8\\\\u7ed9\\\\u5408\\\\u4f5c\\\\u4f19\\\\u4f34\\\\u3002\\\\u6bcf\\\\u6279\\\\u8d27\\\\u7269\\\\u5728\\\\u79bb\\\\u5f00\\\\u5de5\\\\u5382\\\\u524d\\\\u90fd\\\\u4f1a\\\\u7ecf\\\\u8fc7\\\\u4e25\\\\u683c\\\\u7684\\\\u8d28\\\\u91cf\\\\u3001\\\\u6570\\\\u91cf\\\\u3001\\\\u5305\\\\u88c5\\\\u89c4\\\\u683c\\\\u548c\\\\u8fd0\\\\u8f93\\\\u6761\\\\u4ef6\\\\u68c0\\\\u67e5\\\\uff0c\\\\u786e\\\\u4fdd\\\\u5b8c\\\\u5168\\\\u6ee1\\\\u8db3\\\\u5ba2\\\\u6237\\\\u8981\\\\u6c42\\\\u548c\\\\u65e2\\\\u5b9a\\\\u7684\\\\u751f\\\\u4ea7\\\\u6807\\\\u51c6\\\\u3002\\\\n\\\\u6211\\\\u4eec\\\\u91c7\\\\u7528\\\\u4e13\\\\u4e1a\\\\u7684\\\\u5305\\\\u88c5\\\\u6d41\\\\u7a0b\\\\uff0c\\\\u9002\\\\u7528\\\\u4e8e\\\\u6bcf\\\\u79cd\\\\u4ea7\\\\u54c1\\\\u7c7b\\\\u578b\\\\u548c\\\\u8fd0\\\\u8f93\\\\u7279\\\\u6027\\\\u3002\\\\u5305\\\\u88c5\\\\u6750\\\\u6599\\\\u7ecf\\\\u8fc7\\\\u7cbe\\\\u5fc3\\\\u6311\\\\u9009\\\\uff0c\\\\u4ee5\\\\u4fdd\\\\u62a4\\\\u4ea7\\\\u54c1\\\\u5728\\\\u50a8\\\\u5b58\\\\u548c\\\\u8fd0\\\\u8f93\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u514d\\\\u53d7\\\\u51b2\\\\u51fb\\\\uff0c\\\\u7279\\\\u522b\\\\u662f\\\\u5bf9\\\\u4e8e\\\\u957f\\\\u9014\\\\u51fa\\\\u53e3\\\\u8ba2\\\\u5355\\\\u3002\\\\u6839\\\\u636e\\\\u8981\\\\u6c42\\\\uff0c\\\\u4ea7\\\\u54c1\\\\u53ef\\\\u4ee5\\\\u6309\\\\u7167\\\\u5ba2\\\\u6237\\\\u7684\\\\u7279\\\\u5b9a\\\\u6807\\\\u51c6\\\\u8fdb\\\\u884c\\\\u5305\\\\u88c5\\\\uff0c\\\\u786e\\\\u4fdd\\\\u5728\\\\u63a5\\\\u6536\\\\u3001\\\\u5206\\\\u9500\\\\u548c\\\\u4f7f\\\\u7528\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u7684\\\\u7edf\\\\u4e00\\\\u6027\\\\u548c\\\\u4fbf\\\\u5229\\\\u6027\\\\u3002&quot;,&quot;image_id&quot;:121}\\\" data-id=\\\"two_column\\\"></div><div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;left&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;\\\\u5728\\\\u5305\\\\u88c5\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\uff0c\\\\u6bcf\\\\u4ef6\\\\u4ea7\\\\u54c1\\\\u5728\\\\u88c5\\\\u7bb1\\\\u524d\\\\u90fd\\\\u4f1a\\\\u7ecf\\\\u8fc7\\\\u8868\\\\u9762\\\\u3001\\\\u7ed3\\\\u6784\\\\u548c\\\\u5b8c\\\\u5de5\\\\u60c5\\\\u51b5\\\\u7684\\\\u6700\\\\u7ec8\\\\u68c0\\\\u9a8c\\\\u3002\\\\u6bcf\\\\u6279\\\\u8d27\\\\u7269\\\\u90fd\\\\u7ecf\\\\u8fc7\\\\u6e05\\\\u6670\\\\u7684\\\\u5206\\\\u7c7b\\\\u3001\\\\u6807\\\\u8bb0\\\\u548c\\\\u7f16\\\\u7801\\\\uff0c\\\\u4f7f\\\\u68c0\\\\u67e5\\\\u548c\\\\u4fe1\\\\u606f\\\\u68c0\\\\u7d22\\\\u51c6\\\\u786e\\\\u4fbf\\\\u6377\\\\u3002\\\\u8fd9\\\\u6709\\\\u52a9\\\\u4e8e\\\\u5728\\\\u6574\\\\u4e2a\\\\u53d1\\\\u8d27\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u4fdd\\\\u6301\\\\u900f\\\\u660e\\\\u5ea6\\\\u548c\\\\u7a33\\\\u5b9a\\\\u6027\\\\u3002\\\\nDUYANG VIETNAM \\\\u7684\\\\u8fd0\\\\u8425\\\\u56e2\\\\u961f\\\\u5728\\\\u51fa\\\\u53e3\\\\u51c6\\\\u5907\\\\u9636\\\\u6bb5\\\\u7d27\\\\u5bc6\\\\u5408\\\\u4f5c\\\\uff0c\\\\u4ece\\\\u5b89\\\\u6392\\\\u8d27\\\\u7269\\\\u3001\\\\u4f18\\\\u5316\\\\u96c6\\\\u88c5\\\\u7bb1\\\\u7a7a\\\\u95f4\\\\u5230\\\\u68c0\\\\u67e5\\\\u8fd0\\\\u8f93\\\\u6761\\\\u4ef6\\\\u3002\\\\u88c5\\\\u8f7d\\\\u8fc7\\\\u7a0b\\\\u6309\\\\u7167\\\\u6807\\\\u51c6\\\\u8fdb\\\\u884c\\\\uff0c\\\\u4ee5\\\\u6700\\\\u5927\\\\u9650\\\\u5ea6\\\\u5730\\\\u51cf\\\\u5c11\\\\u98ce\\\\u9669\\\\uff0c\\\\u786e\\\\u4fdd\\\\u8d27\\\\u7269\\\\u5728\\\\u8fd0\\\\u8f93\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u7262\\\\u56fa\\\\u56fa\\\\u5b9a\\\\u4e14\\\\u5b89\\\\u5168\\\\u3002&quot;,&quot;image_id&quot;:122}\\\" data-id=\\\"two_column\\\"></div><p>此外，我们维护一个同步的生产和物流管理系统，能够跟踪发货进度、控制运输计划并确保按时交货。生产、质量控制和运输部门之间的紧密协调有助于 DUYANG VIETNAM 保持稳定、准确和高效的发货操作。</p><p>凭借可持续和专业的发发展方向，DUYANG VIETNAM 不断改进其包装和发货流程，以提高供应链效率、确保产品质量并加强国内外合作伙伴的信任。我们致力于在每批货物中保持稳定、准时和符合标准，为建立长期可持续的合作关系做出贡献。</p>\"}', '{\"en\": \"\"}', 'published', 'regular', '2026-03-24 09:54:47', '2026-03-24 10:28:32'),
(10, '{\"en\": \"Order Production Progress Update\", \"vi\": \"Cập Nhật Tiến Độ Sản Xuất Đơn Hàng\", \"zh_CN\": \"订单生产进度更新\"}', '{\"en\": \"order-production-progress-update\", \"vi\": \"cap-nhat-tien-do-san-xuat-don-hang\", \"zh_CN\": \"order-production-progress-update\"}', '{\"en\": \"Information about the production process, quality inspection, and order completion before shipment.\", \"vi\": \"Thông tin về quá trình sản xuất, kiểm tra chất lượng và hoàn thiện đơn hàng trước khi xuất xưởng.\", \"zh_CN\": \"关于生产过程、质量检验和订单完成发货前的信息。\"}', '{\"en\": \"<div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;right&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;At DUYANG VIETNAM, the packaging and shipping stage plays a crucial role in the entire production chain, ensuring products are delivered to partners in a safe, intact, and technically compliant condition. Each batch of goods is meticulously inspected for quality, quantity, packaging specifications, and shipping conditions before leaving the factory, ensuring it fully meets customer requirements and established production standards.\\\\nWe apply professional packaging processes suitable for each type of product and transportation characteristics. Packaging materials are carefully selected to protect products from impacts during storage and transit, especially for long-distance export orders. Depending on the requirements, products can be packaged according to specific customer standards, ensuring uniformity and convenience in receiving, distribution, and usage.&quot;,&quot;image_id&quot;:121}\\\" data-id=\\\"two_column\\\"></div><div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;left&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;During the packaging process, each product undergoes a final inspection of its surface, structure, and finish before being packed into cartons. Each shipment is clearly categorized, labeled, and coded, making inspection and information retrieval accurate and convenient. This contributes to transparency and stability throughout the entire shipping process.\\\\nThe DUYANG VIETNAM operations team collaborates closely in the export preparation phase, from arranging goods, optimizing container space, to inspecting shipping conditions. The loading process is carried out according to standards to minimize risks, ensuring goods are securely fixed and safe during transit.&quot;,&quot;image_id&quot;:122}\\\" data-id=\\\"two_column\\\"></div><p>Additionally, we maintain a synchronized production and logistics management system, enabling tracking of shipping progress, control of transportation schedules, and ensuring on-time delivery. Close coordination between production, quality control, and shipping departments helps DUYANG VIETNAM maintain stable, accurate, and efficient shipping operations.</p><p>With a focus on sustainable and professional development, DUYANG VIETNAM continuously improves its packaging and shipping processes to enhance supply chain efficiency, ensure product quality, and strengthen the trust of domestic and international partners. We are committed to maintaining stability, punctuality, and standards in every shipment, contributing to building long-term and sustainable cooperative relationships.</p>\", \"vi\": \"<div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;right&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;T\\\\u1ea1i DUYANG VIETNAM, c\\\\u00f4ng \\\\u0111o\\\\u1ea1n \\\\u0111\\\\u00f3ng g\\\\u00f3i v\\\\u00e0 xu\\\\u1ea5t h\\\\u00e0ng \\\\u0111\\\\u00f3ng vai tr\\\\u00f2 quan tr\\\\u1ecdng trong to\\\\u00e0n b\\\\u1ed9 chu\\\\u1ed7i s\\\\u1ea3n xu\\\\u1ea5t, nh\\\\u1eb1m \\\\u0111\\\\u1ea3m b\\\\u1ea3o s\\\\u1ea3n ph\\\\u1ea9m \\\\u0111\\\\u01b0\\\\u1ee3c b\\\\u00e0n giao \\\\u0111\\\\u1ebfn \\\\u0111\\\\u1ed1i t\\\\u00e1c trong tr\\\\u1ea1ng th\\\\u00e1i an to\\\\u00e0n, nguy\\\\u00ean v\\\\u1eb9n v\\\\u00e0 \\\\u0111\\\\u00fang ti\\\\u00eau chu\\\\u1ea9n k\\\\u1ef9 thu\\\\u1eadt. M\\\\u1ed7i l\\\\u00f4 h\\\\u00e0ng tr\\\\u01b0\\\\u1edbc khi r\\\\u1eddi kh\\\\u1ecfi nh\\\\u00e0 m\\\\u00e1y \\\\u0111\\\\u1ec1u \\\\u0111\\\\u01b0\\\\u1ee3c ki\\\\u1ec3m tra k\\\\u1ef9 l\\\\u01b0\\\\u1ee1ng v\\\\u1ec1 ch\\\\u1ea5t l\\\\u01b0\\\\u1ee3ng, s\\\\u1ed1 l\\\\u01b0\\\\u1ee3ng, quy c\\\\u00e1ch \\\\u0111\\\\u00f3ng g\\\\u00f3i v\\\\u00e0 \\\\u0111i\\\\u1ec1u ki\\\\u1ec7n v\\\\u1eadn chuy\\\\u1ec3n, \\\\u0111\\\\u1ea3m b\\\\u1ea3o \\\\u0111\\\\u00e1p \\\\u1ee9ng \\\\u0111\\\\u1ea7y \\\\u0111\\\\u1ee7 y\\\\u00eau c\\\\u1ea7u c\\\\u1ee7a kh\\\\u00e1ch h\\\\u00e0ng c\\\\u0169ng nh\\\\u01b0 ti\\\\u00eau chu\\\\u1ea9n s\\\\u1ea3n xu\\\\u1ea5t \\\\u0111\\\\u00e3 \\\\u0111\\\\u1ec1 ra.\\\\nCh\\\\u00fang t\\\\u00f4i \\\\u00e1p d\\\\u1ee5ng quy tr\\\\u00ecnh \\\\u0111\\\\u00f3ng g\\\\u00f3i chuy\\\\u00ean nghi\\\\u1ec7p, ph\\\\u00f9 h\\\\u1ee3p v\\\\u1edbi t\\\\u1eebng lo\\\\u1ea1i s\\\\u1ea3n ph\\\\u1ea9m v\\\\u00e0 \\\\u0111\\\\u1eb7c th\\\\u00f9 v\\\\u1eadn chuy\\\\u1ec3n. V\\\\u1eadt li\\\\u1ec7u \\\\u0111\\\\u00f3ng g\\\\u00f3i \\\\u0111\\\\u01b0\\\\u1ee3c l\\\\u1ef1a ch\\\\u1ecdn c\\\\u1ea9n th\\\\u1eadn nh\\\\u1eb1m b\\\\u1ea3o v\\\\u1ec7 s\\\\u1ea3n ph\\\\u1ea9m tr\\\\u01b0\\\\u1edbc c\\\\u00e1c t\\\\u00e1c \\\\u0111\\\\u1ed9ng trong qu\\\\u00e1 tr\\\\u00ecnh l\\\\u01b0u kho v\\\\u00e0 v\\\\u1eadn chuy\\\\u1ec3n, \\\\u0111\\\\u1eb7c bi\\\\u1ec7t \\\\u0111\\\\u1ed1i v\\\\u1edbi c\\\\u00e1c \\\\u0111\\\\u01a1n h\\\\u00e0ng xu\\\\u1ea5t kh\\\\u1ea9u \\\\u0111\\\\u01b0\\\\u1eddng d\\\\u00e0i. T\\\\u00f9y theo y\\\\u00eau c\\\\u1ea7u, s\\\\u1ea3n ph\\\\u1ea9m c\\\\u00f3 th\\\\u1ec3 \\\\u0111\\\\u01b0\\\\u1ee3c \\\\u0111\\\\u00f3ng g\\\\u00f3i theo ti\\\\u00eau chu\\\\u1ea9n ri\\\\u00eang c\\\\u1ee7a kh\\\\u00e1ch h\\\\u00e0ng, \\\\u0111\\\\u1ea3m b\\\\u1ea3o t\\\\u00ednh \\\\u0111\\\\u1ed3ng b\\\\u1ed9 v\\\\u00e0 thu\\\\u1eadn ti\\\\u1ec7n trong qu\\\\u00e1 tr\\\\u00ecnh ti\\\\u1ebfp nh\\\\u1eadn, ph\\\\u00e2n ph\\\\u1ed1i v\\\\u00e0 s\\\\u1eed d\\\\u1ee5ng.&quot;,&quot;image_id&quot;:121}\\\" data-id=\\\"two_column\\\"></div><div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;left&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;Trong qu\\\\u00e1 tr\\\\u00ecnh \\\\u0111\\\\u00f3ng g\\\\u00f3i, t\\\\u1eebng s\\\\u1ea3n ph\\\\u1ea9m \\\\u0111\\\\u01b0\\\\u1ee3c ki\\\\u1ec3m tra l\\\\u1ea7n cu\\\\u1ed1i v\\\\u1ec1 b\\\\u1ec1 m\\\\u1eb7t, k\\\\u1ebft c\\\\u1ea5u v\\\\u00e0 \\\\u0111\\\\u1ed9 ho\\\\u00e0n thi\\\\u1ec7n tr\\\\u01b0\\\\u1edbc khi \\\\u0111\\\\u01b0a v\\\\u00e0o quy tr\\\\u00ecnh \\\\u0111\\\\u00f3ng th\\\\u00f9ng. M\\\\u1ed7i ki\\\\u1ec7n h\\\\u00e0ng \\\\u0111\\\\u1ec1u \\\\u0111\\\\u01b0\\\\u1ee3c ph\\\\u00e2n lo\\\\u1ea1i, ghi nh\\\\u00e3n v\\\\u00e0 m\\\\u00e3 h\\\\u00f3a r\\\\u00f5 r\\\\u00e0ng, gi\\\\u00fap vi\\\\u1ec7c ki\\\\u1ec3m so\\\\u00e1t v\\\\u00e0 truy xu\\\\u1ea5t th\\\\u00f4ng tin tr\\\\u1edf n\\\\u00ean ch\\\\u00ednh x\\\\u00e1c v\\\\u00e0 thu\\\\u1eadn ti\\\\u1ec7n. \\\\u0110i\\\\u1ec1u n\\\\u00e0y g\\\\u00f3p ph\\\\u1ea7n \\\\u0111\\\\u1ea3m b\\\\u1ea3o t\\\\u00ednh minh b\\\\u1ea1ch v\\\\u00e0 \\\\u1ed5n \\\\u0111\\\\u1ecbnh trong to\\\\u00e0n b\\\\u1ed9 qu\\\\u00e1 tr\\\\u00ecnh xu\\\\u1ea5t h\\\\u00e0ng.\\\\n\\\\u0110\\\\u1ed9i ng\\\\u0169 v\\\\u1eadn h\\\\u00e0nh c\\\\u1ee7a DUYANG VIETNAM ph\\\\u1ed1i h\\\\u1ee3p ch\\\\u1eb7t ch\\\\u1ebd trong kh\\\\u00e2u chu\\\\u1ea9n b\\\\u1ecb xu\\\\u1ea5t x\\\\u01b0\\\\u1edfng, t\\\\u1eeb s\\\\u1eafp x\\\\u1ebfp h\\\\u00e0ng h\\\\u00f3a, t\\\\u1ed1i \\\\u01b0u kh\\\\u00f4ng gian container \\\\u0111\\\\u1ebfn ki\\\\u1ec3m tra \\\\u0111i\\\\u1ec1u ki\\\\u1ec7n v\\\\u1eadn chuy\\\\u1ec3n. Quy tr\\\\u00ecnh b\\\\u1ed1c x\\\\u1ebfp \\\\u0111\\\\u01b0\\\\u1ee3c th\\\\u1ef1c hi\\\\u1ec7n theo ti\\\\u00eau chu\\\\u1ea9n nh\\\\u1eb1m h\\\\u1ea1n ch\\\\u1ebf t\\\\u1ed1i \\\\u0111a r\\\\u1ee7i ro, \\\\u0111\\\\u1ea3m b\\\\u1ea3o h\\\\u00e0ng h\\\\u00f3a \\\\u0111\\\\u01b0\\\\u1ee3c c\\\\u1ed1 \\\\u0111\\\\u1ecbnh ch\\\\u1eafc ch\\\\u1eafn v\\\\u00e0 an to\\\\u00e0n trong su\\\\u1ed1t qu\\\\u00e1 tr\\\\u00ecnh v\\\\u1eadn chuy\\\\u1ec3n.&quot;,&quot;image_id&quot;:122}\\\" data-id=\\\"two_column\\\"></div><p>Bên cạnh đó, chúng tôi duy trì hệ thống quản lý sản xuất và logistics đồng bộ, giúp theo dõi tiến độ xuất hàng, kiểm soát lịch trình vận chuyển và đảm bảo giao hàng đúng kế hoạch. Sự phối hợp chặt chẽ giữa các bộ phận sản xuất, kiểm soát chất lượng và vận chuyển giúp DUYANG VIETNAM duy trì hoạt động xuất hàng ổn định, chính xác và hiệu quả.</p><p>Với định hướng phát triển bền vững và chuyên nghiệp, DUYANG VIETNAM không ngừng cải tiến quy trình đóng gói và xuất hàng nhằm nâng cao hiệu quả chuỗi cung ứng, đảm bảo chất lượng sản phẩm và củng cố niềm tin của đối tác trong và ngoài nước. Chúng tôi cam kết duy trì sự ổn định, đúng tiến độ và tiêu chuẩn trong mọi lô hàng, góp phần xây dựng mối quan hệ hợp tác lâu dài và bền vững.</p>\", \"zh_CN\": \"<div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;right&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;\\\\u5728 DUYANG VIETNAM\\\\uff0c\\\\u5305\\\\u88c5\\\\u548c\\\\u53d1\\\\u8d27\\\\u9636\\\\u6bb5\\\\u5728\\\\u6574\\\\u4e2a\\\\u751f\\\\u4ea7\\\\u94fe\\\\u4e2d\\\\u8d77\\\\u7740\\\\u81f3\\\\u5173\\\\u91cd\\\\u8981\\\\u7684\\\\u4f5c\\\\u7528\\\\uff0c\\\\u786e\\\\u4fdd\\\\u4ea7\\\\u54c1\\\\u4ee5\\\\u5b89\\\\u5168\\\\u3001\\\\u5b8c\\\\u597d\\\\u4e14\\\\u7b26\\\\u5408\\\\u6280\\\\u672f\\\\u6807\\\\u51c6\\\\u7684\\\\u72b6\\\\u6001\\\\u4ea4\\\\u4ed8\\\\u7ed9\\\\u5408\\\\u4f5c\\\\u4f19\\\\u4f34\\\\u3002\\\\u6bcf\\\\u6279\\\\u8d27\\\\u7269\\\\u5728\\\\u79bb\\\\u5f00\\\\u5de5\\\\u5382\\\\u524d\\\\u90fd\\\\u4f1a\\\\u7ecf\\\\u8fc7\\\\u4e25\\\\u683c\\\\u7684\\\\u8d28\\\\u91cf\\\\u3001\\\\u6570\\\\u91cf\\\\u3001\\\\u5305\\\\u88c5\\\\u89c4\\\\u683c\\\\u548c\\\\u8fd0\\\\u8f93\\\\u6761\\\\u4ef6\\\\u68c0\\\\u67e5\\\\uff0c\\\\u786e\\\\u4fdd\\\\u5b8c\\\\u5168\\\\u6ee1\\\\u8db3\\\\u5ba2\\\\u6237\\\\u8981\\\\u6c42\\\\u548c\\\\u65e2\\\\u5b9a\\\\u7684\\\\u751f\\\\u4ea7\\\\u6807\\\\u51c6\\\\u3002\\\\n\\\\u6211\\\\u4eec\\\\u91c7\\\\u7528\\\\u4e13\\\\u4e1a\\\\u7684\\\\u5305\\\\u88c5\\\\u6d41\\\\u7a0b\\\\uff0c\\\\u9002\\\\u7528\\\\u4e8e\\\\u6bcf\\\\u79cd\\\\u4ea7\\\\u54c1\\\\u7c7b\\\\u578b\\\\u548c\\\\u8fd0\\\\u8f93\\\\u7279\\\\u6027\\\\u3002\\\\u5305\\\\u88c5\\\\u6750\\\\u6599\\\\u7ecf\\\\u8fc7\\\\u7cbe\\\\u5fc3\\\\u6311\\\\u9009\\\\uff0c\\\\u4ee5\\\\u4fdd\\\\u62a4\\\\u4ea7\\\\u54c1\\\\u5728\\\\u50a8\\\\u5b58\\\\u548c\\\\u8fd0\\\\u8f93\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u514d\\\\u53d7\\\\u51b2\\\\u51fb\\\\uff0c\\\\u7279\\\\u522b\\\\u662f\\\\u5bf9\\\\u4e8e\\\\u957f\\\\u9014\\\\u51fa\\\\u53e3\\\\u8ba2\\\\u5355\\\\u3002\\\\u6839\\\\u636e\\\\u8981\\\\u6c42\\\\uff0c\\\\u4ea7\\\\u54c1\\\\u53ef\\\\u4ee5\\\\u6309\\\\u7167\\\\u5ba2\\\\u6237\\\\u7684\\\\u7279\\\\u5b9a\\\\u6807\\\\u51c6\\\\u8fdb\\\\u884c\\\\u5305\\\\u88c5\\\\uff0c\\\\u786e\\\\u4fdd\\\\u5728\\\\u63a5\\\\u6536\\\\u3001\\\\u5206\\\\u9500\\\\u548c\\\\u4f7f\\\\u7528\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u7684\\\\u7edf\\\\u4e00\\\\u6027\\\\u548c\\\\u4fbf\\\\u5229\\\\u6027\\\\u3002&quot;,&quot;image_id&quot;:121}\\\" data-id=\\\"two_column\\\"></div><div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;left&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;\\\\u5728\\\\u5305\\\\u88c5\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\uff0c\\\\u6bcf\\\\u4ef6\\\\u4ea7\\\\u54c1\\\\u5728\\\\u88c5\\\\u7bb1\\\\u524d\\\\u90fd\\\\u4f1a\\\\u7ecf\\\\u8fc7\\\\u8868\\\\u9762\\\\u3001\\\\u7ed3\\\\u6784\\\\u548c\\\\u5b8c\\\\u5de5\\\\u60c5\\\\u51b5\\\\u7684\\\\u6700\\\\u7ec8\\\\u68c0\\\\u9a8c\\\\u3002\\\\u6bcf\\\\u6279\\\\u8d27\\\\u7269\\\\u90fd\\\\u7ecf\\\\u8fc7\\\\u6e05\\\\u6670\\\\u7684\\\\u5206\\\\u7c7b\\\\u3001\\\\u6807\\\\u8bb0\\\\u548c\\\\u7f16\\\\u7801\\\\uff0c\\\\u4f7f\\\\u68c0\\\\u67e5\\\\u548c\\\\u4fe1\\\\u606f\\\\u68c0\\\\u7d22\\\\u51c6\\\\u786e\\\\u4fbf\\\\u6377\\\\u3002\\\\u8fd9\\\\u6709\\\\u52a9\\\\u4e8e\\\\u5728\\\\u6574\\\\u4e2a\\\\u53d1\\\\u8d27\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u4fdd\\\\u6301\\\\u900f\\\\u660e\\\\u5ea6\\\\u548c\\\\u7a33\\\\u5b9a\\\\u6027\\\\u3002\\\\nDUYANG VIETNAM \\\\u7684\\\\u8fd0\\\\u8425\\\\u56e2\\\\u961f\\\\u5728\\\\u51fa\\\\u53e3\\\\u51c6\\\\u5907\\\\u9636\\\\u6bb5\\\\u7d27\\\\u5bc6\\\\u5408\\\\u4f5c\\\\uff0c\\\\u4ece\\\\u5b89\\\\u6392\\\\u8d27\\\\u7269\\\\u3001\\\\u4f18\\\\u5316\\\\u96c6\\\\u88c5\\\\u7bb1\\\\u7a7a\\\\u95f4\\\\u5230\\\\u68c0\\\\u67e5\\\\u8fd0\\\\u8f93\\\\u6761\\\\u4ef6\\\\u3002\\\\u88c5\\\\u8f7d\\\\u8fc7\\\\u7a0b\\\\u6309\\\\u7167\\\\u6807\\\\u51c6\\\\u8fdb\\\\u884c\\\\uff0c\\\\u4ee5\\\\u6700\\\\u5927\\\\u9650\\\\u5ea6\\\\u5730\\\\u51cf\\\\u5c11\\\\u98ce\\\\u9669\\\\uff0c\\\\u786e\\\\u4fdd\\\\u8d27\\\\u7269\\\\u5728\\\\u8fd0\\\\u8f93\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u7262\\\\u56fa\\\\u56fa\\\\u5b9a\\\\u4e14\\\\u5b89\\\\u5168\\\\u3002&quot;,&quot;image_id&quot;:122}\\\" data-id=\\\"two_column\\\"></div><p>此外，我们维护一个同步的生产和物流管理系统，能够跟踪发货进度、控制运输计划并确保按时交货。生产、质量控制和运输部门之间的紧密协调有助于 DUYANG VIETNAM 保持稳定、准确和高效的发货操作。</p><p>凭借可持续和专业的发发展方向，DUYANG VIETNAM 不断改进其包装和发货流程，以提高供应链效率、确保产品质量并加强国内外合作伙伴的信任。我们致力于在每批货物中保持稳定、准时和符合标准，为建立长期可持续的合作关系做出贡献。</p>\"}', NULL, 'published', 'regular', '2026-03-24 10:29:05', '2026-03-24 10:42:02'),
(11, '{\"en\": \"Shipping & Delivery Updates\", \"vi\": \"Cập Nhật Vận Chuyển & Giao Hàng\", \"zh_CN\": \"运输与配送更新\"}', '{\"en\": \"shipping-delivery-updates\", \"vi\": \"cap-nhat-van-chuyen-giao-hang\", \"zh_CN\": \"shipping-delivery-updates\"}', '{\"en\": \"Information on delivery schedules, container departures, and shipping progress to customers.\", \"vi\": \"Thông tin về lịch trình giao hàng, xuất container và tiến độ vận chuyển đến khách hàng.\", \"zh_CN\": \"有关交货时间表、集装箱离港和客户运输进度的信息。\"}', '{\"en\": \"<div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;right&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;At DUYANG VIETNAM, the packaging and shipping stage plays a crucial role in the entire production chain, ensuring products are delivered to partners in a safe, intact, and technically compliant condition. Each batch of goods is meticulously inspected for quality, quantity, packaging specifications, and shipping conditions before leaving the factory, ensuring it fully meets customer requirements and established production standards.\\\\nWe apply professional packaging processes suitable for each type of product and transportation characteristics. Packaging materials are carefully selected to protect products from impacts during storage and transit, especially for long-distance export orders. Depending on the requirements, products can be packaged according to specific customer standards, ensuring uniformity and convenience in receiving, distribution, and usage.&quot;,&quot;image_id&quot;:121}\\\" data-id=\\\"two_column\\\"></div><div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;left&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;During the packaging process, each product undergoes a final inspection of its surface, structure, and finish before being packed into cartons. Each shipment is clearly categorized, labeled, and coded, making inspection and information retrieval accurate and convenient. This contributes to transparency and stability throughout the entire shipping process.\\\\nThe DUYANG VIETNAM operations team collaborates closely in the export preparation phase, from arranging goods, optimizing container space, to inspecting shipping conditions. The loading process is carried out according to standards to minimize risks, ensuring goods are securely fixed and safe during transit.&quot;,&quot;image_id&quot;:122}\\\" data-id=\\\"two_column\\\"></div><p>Additionally, we maintain a synchronized production and logistics management system, enabling tracking of shipping progress, control of transportation schedules, and ensuring on-time delivery. Close coordination between production, quality control, and shipping departments helps DUYANG VIETNAM maintain stable, accurate, and efficient shipping operations.</p><p>With a focus on sustainable and professional development, DUYANG VIETNAM continuously improves its packaging and shipping processes to enhance supply chain efficiency, ensure product quality, and strengthen the trust of domestic and international partners. We are committed to maintaining stability, punctuality, and standards in every shipment, contributing to building long-term and sustainable cooperative relationships.</p>\", \"vi\": \"<div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;right&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;T\\\\u1ea1i DUYANG VIETNAM, c\\\\u00f4ng \\\\u0111o\\\\u1ea1n \\\\u0111\\\\u00f3ng g\\\\u00f3i v\\\\u00e0 xu\\\\u1ea5t h\\\\u00e0ng \\\\u0111\\\\u00f3ng vai tr\\\\u00f2 quan tr\\\\u1ecdng trong to\\\\u00e0n b\\\\u1ed9 chu\\\\u1ed7i s\\\\u1ea3n xu\\\\u1ea5t, nh\\\\u1eb1m \\\\u0111\\\\u1ea3m b\\\\u1ea3o s\\\\u1ea3n ph\\\\u1ea9m \\\\u0111\\\\u01b0\\\\u1ee3c b\\\\u00e0n giao \\\\u0111\\\\u1ebfn \\\\u0111\\\\u1ed1i t\\\\u00e1c trong tr\\\\u1ea1ng th\\\\u00e1i an to\\\\u00e0n, nguy\\\\u00ean v\\\\u1eb9n v\\\\u00e0 \\\\u0111\\\\u00fang ti\\\\u00eau chu\\\\u1ea9n k\\\\u1ef9 thu\\\\u1eadt. M\\\\u1ed7i l\\\\u00f4 h\\\\u00e0ng tr\\\\u01b0\\\\u1edbc khi r\\\\u1eddi kh\\\\u1ecfi nh\\\\u00e0 m\\\\u00e1y \\\\u0111\\\\u1ec1u \\\\u0111\\\\u01b0\\\\u1ee3c ki\\\\u1ec3m tra k\\\\u1ef9 l\\\\u01b0\\\\u1ee1ng v\\\\u1ec1 ch\\\\u1ea5t l\\\\u01b0\\\\u1ee3ng, s\\\\u1ed1 l\\\\u01b0\\\\u1ee3ng, quy c\\\\u00e1ch \\\\u0111\\\\u00f3ng g\\\\u00f3i v\\\\u00e0 \\\\u0111i\\\\u1ec1u ki\\\\u1ec7n v\\\\u1eadn chuy\\\\u1ec3n, \\\\u0111\\\\u1ea3m b\\\\u1ea3o \\\\u0111\\\\u00e1p \\\\u1ee9ng \\\\u0111\\\\u1ea7y \\\\u0111\\\\u1ee7 y\\\\u00eau c\\\\u1ea7u c\\\\u1ee7a kh\\\\u00e1ch h\\\\u00e0ng c\\\\u0169ng nh\\\\u01b0 ti\\\\u00eau chu\\\\u1ea9n s\\\\u1ea3n xu\\\\u1ea5t \\\\u0111\\\\u00e3 \\\\u0111\\\\u1ec1 ra.\\\\nCh\\\\u00fang t\\\\u00f4i \\\\u00e1p d\\\\u1ee5ng quy tr\\\\u00ecnh \\\\u0111\\\\u00f3ng g\\\\u00f3i chuy\\\\u00ean nghi\\\\u1ec7p, ph\\\\u00f9 h\\\\u1ee3p v\\\\u1edbi t\\\\u1eebng lo\\\\u1ea1i s\\\\u1ea3n ph\\\\u1ea9m v\\\\u00e0 \\\\u0111\\\\u1eb7c th\\\\u00f9 v\\\\u1eadn chuy\\\\u1ec3n. V\\\\u1eadt li\\\\u1ec7u \\\\u0111\\\\u00f3ng g\\\\u00f3i \\\\u0111\\\\u01b0\\\\u1ee3c l\\\\u1ef1a ch\\\\u1ecdn c\\\\u1ea9n th\\\\u1eadn nh\\\\u1eb1m b\\\\u1ea3o v\\\\u1ec7 s\\\\u1ea3n ph\\\\u1ea9m tr\\\\u01b0\\\\u1edbc c\\\\u00e1c t\\\\u00e1c \\\\u0111\\\\u1ed9ng trong qu\\\\u00e1 tr\\\\u00ecnh l\\\\u01b0u kho v\\\\u00e0 v\\\\u1eadn chuy\\\\u1ec3n, \\\\u0111\\\\u1eb7c bi\\\\u1ec7t \\\\u0111\\\\u1ed1i v\\\\u1edbi c\\\\u00e1c \\\\u0111\\\\u01a1n h\\\\u00e0ng xu\\\\u1ea5t kh\\\\u1ea9u \\\\u0111\\\\u01b0\\\\u1eddng d\\\\u00e0i. T\\\\u00f9y theo y\\\\u00eau c\\\\u1ea7u, s\\\\u1ea3n ph\\\\u1ea9m c\\\\u00f3 th\\\\u1ec3 \\\\u0111\\\\u01b0\\\\u1ee3c \\\\u0111\\\\u00f3ng g\\\\u00f3i theo ti\\\\u00eau chu\\\\u1ea9n ri\\\\u00eang c\\\\u1ee7a kh\\\\u00e1ch h\\\\u00e0ng, \\\\u0111\\\\u1ea3m b\\\\u1ea3o t\\\\u00ednh \\\\u0111\\\\u1ed3ng b\\\\u1ed9 v\\\\u00e0 thu\\\\u1eadn ti\\\\u1ec7n trong qu\\\\u00e1 tr\\\\u00ecnh ti\\\\u1ebfp nh\\\\u1eadn, ph\\\\u00e2n ph\\\\u1ed1i v\\\\u00e0 s\\\\u1eed d\\\\u1ee5ng.&quot;,&quot;image_id&quot;:121}\\\" data-id=\\\"two_column\\\"></div><div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;left&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;Trong qu\\\\u00e1 tr\\\\u00ecnh \\\\u0111\\\\u00f3ng g\\\\u00f3i, t\\\\u1eebng s\\\\u1ea3n ph\\\\u1ea9m \\\\u0111\\\\u01b0\\\\u1ee3c ki\\\\u1ec3m tra l\\\\u1ea7n cu\\\\u1ed1i v\\\\u1ec1 b\\\\u1ec1 m\\\\u1eb7t, k\\\\u1ebft c\\\\u1ea5u v\\\\u00e0 \\\\u0111\\\\u1ed9 ho\\\\u00e0n thi\\\\u1ec7n tr\\\\u01b0\\\\u1edbc khi \\\\u0111\\\\u01b0a v\\\\u00e0o quy tr\\\\u00ecnh \\\\u0111\\\\u00f3ng th\\\\u00f9ng. M\\\\u1ed7i ki\\\\u1ec7n h\\\\u00e0ng \\\\u0111\\\\u1ec1u \\\\u0111\\\\u01b0\\\\u1ee3c ph\\\\u00e2n lo\\\\u1ea1i, ghi nh\\\\u00e3n v\\\\u00e0 m\\\\u00e3 h\\\\u00f3a r\\\\u00f5 r\\\\u00e0ng, gi\\\\u00fap vi\\\\u1ec7c ki\\\\u1ec3m so\\\\u00e1t v\\\\u00e0 truy xu\\\\u1ea5t th\\\\u00f4ng tin tr\\\\u1edf n\\\\u00ean ch\\\\u00ednh x\\\\u00e1c v\\\\u00e0 thu\\\\u1eadn ti\\\\u1ec7n. \\\\u0110i\\\\u1ec1u n\\\\u00e0y g\\\\u00f3p ph\\\\u1ea7n \\\\u0111\\\\u1ea3m b\\\\u1ea3o t\\\\u00ednh minh b\\\\u1ea1ch v\\\\u00e0 \\\\u1ed5n \\\\u0111\\\\u1ecbnh trong to\\\\u00e0n b\\\\u1ed9 qu\\\\u00e1 tr\\\\u00ecnh xu\\\\u1ea5t h\\\\u00e0ng.\\\\n\\\\u0110\\\\u1ed9i ng\\\\u0169 v\\\\u1eadn h\\\\u00e0nh c\\\\u1ee7a DUYANG VIETNAM ph\\\\u1ed1i h\\\\u1ee3p ch\\\\u1eb7t ch\\\\u1ebd trong kh\\\\u00e2u chu\\\\u1ea9n b\\\\u1ecb xu\\\\u1ea5t x\\\\u01b0\\\\u1edfng, t\\\\u1eeb s\\\\u1eafp x\\\\u1ebfp h\\\\u00e0ng h\\\\u00f3a, t\\\\u1ed1i \\\\u01b0u kh\\\\u00f4ng gian container \\\\u0111\\\\u1ebfn ki\\\\u1ec3m tra \\\\u0111i\\\\u1ec1u ki\\\\u1ec7n v\\\\u1eadn chuy\\\\u1ec3n. Quy tr\\\\u00ecnh b\\\\u1ed1c x\\\\u1ebfp \\\\u0111\\\\u01b0\\\\u1ee3c th\\\\u1ef1c hi\\\\u1ec7n theo ti\\\\u00eau chu\\\\u1ea9n nh\\\\u1eb1m h\\\\u1ea1n ch\\\\u1ebf t\\\\u1ed1i \\\\u0111a r\\\\u1ee7i ro, \\\\u0111\\\\u1ea3m b\\\\u1ea3o h\\\\u00e0ng h\\\\u00f3a \\\\u0111\\\\u01b0\\\\u1ee3c c\\\\u1ed1 \\\\u0111\\\\u1ecbnh ch\\\\u1eafc ch\\\\u1eafn v\\\\u00e0 an to\\\\u00e0n trong su\\\\u1ed1t qu\\\\u00e1 tr\\\\u00ecnh v\\\\u1eadn chuy\\\\u1ec3n.&quot;,&quot;image_id&quot;:122}\\\" data-id=\\\"two_column\\\"></div><p>Bên cạnh đó, chúng tôi duy trì hệ thống quản lý sản xuất và logistics đồng bộ, giúp theo dõi tiến độ xuất hàng, kiểm soát lịch trình vận chuyển và đảm bảo giao hàng đúng kế hoạch. Sự phối hợp chặt chẽ giữa các bộ phận sản xuất, kiểm soát chất lượng và vận chuyển giúp DUYANG VIETNAM duy trì hoạt động xuất hàng ổn định, chính xác và hiệu quả.</p><p>Với định hướng phát triển bền vững và chuyên nghiệp, DUYANG VIETNAM không ngừng cải tiến quy trình đóng gói và xuất hàng nhằm nâng cao hiệu quả chuỗi cung ứng, đảm bảo chất lượng sản phẩm và củng cố niềm tin của đối tác trong và ngoài nước. Chúng tôi cam kết duy trì sự ổn định, đúng tiến độ và tiêu chuẩn trong mọi lô hàng, góp phần xây dựng mối quan hệ hợp tác lâu dài và bền vững.</p>\", \"zh_CN\": \"<div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;right&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;\\\\u5728 DUYANG VIETNAM\\\\uff0c\\\\u5305\\\\u88c5\\\\u548c\\\\u53d1\\\\u8d27\\\\u9636\\\\u6bb5\\\\u5728\\\\u6574\\\\u4e2a\\\\u751f\\\\u4ea7\\\\u94fe\\\\u4e2d\\\\u8d77\\\\u7740\\\\u81f3\\\\u5173\\\\u91cd\\\\u8981\\\\u7684\\\\u4f5c\\\\u7528\\\\uff0c\\\\u786e\\\\u4fdd\\\\u4ea7\\\\u54c1\\\\u4ee5\\\\u5b89\\\\u5168\\\\u3001\\\\u5b8c\\\\u597d\\\\u4e14\\\\u7b26\\\\u5408\\\\u6280\\\\u672f\\\\u6807\\\\u51c6\\\\u7684\\\\u72b6\\\\u6001\\\\u4ea4\\\\u4ed8\\\\u7ed9\\\\u5408\\\\u4f5c\\\\u4f19\\\\u4f34\\\\u3002\\\\u6bcf\\\\u6279\\\\u8d27\\\\u7269\\\\u5728\\\\u79bb\\\\u5f00\\\\u5de5\\\\u5382\\\\u524d\\\\u90fd\\\\u4f1a\\\\u7ecf\\\\u8fc7\\\\u4e25\\\\u683c\\\\u7684\\\\u8d28\\\\u91cf\\\\u3001\\\\u6570\\\\u91cf\\\\u3001\\\\u5305\\\\u88c5\\\\u89c4\\\\u683c\\\\u548c\\\\u8fd0\\\\u8f93\\\\u6761\\\\u4ef6\\\\u68c0\\\\u67e5\\\\uff0c\\\\u786e\\\\u4fdd\\\\u5b8c\\\\u5168\\\\u6ee1\\\\u8db3\\\\u5ba2\\\\u6237\\\\u8981\\\\u6c42\\\\u548c\\\\u65e2\\\\u5b9a\\\\u7684\\\\u751f\\\\u4ea7\\\\u6807\\\\u51c6\\\\u3002\\\\n\\\\u6211\\\\u4eec\\\\u91c7\\\\u7528\\\\u4e13\\\\u4e1a\\\\u7684\\\\u5305\\\\u88c5\\\\u6d41\\\\u7a0b\\\\uff0c\\\\u9002\\\\u7528\\\\u4e8e\\\\u6bcf\\\\u79cd\\\\u4ea7\\\\u54c1\\\\u7c7b\\\\u578b\\\\u548c\\\\u8fd0\\\\u8f93\\\\u7279\\\\u6027\\\\u3002\\\\u5305\\\\u88c5\\\\u6750\\\\u6599\\\\u7ecf\\\\u8fc7\\\\u7cbe\\\\u5fc3\\\\u6311\\\\u9009\\\\uff0c\\\\u4ee5\\\\u4fdd\\\\u62a4\\\\u4ea7\\\\u54c1\\\\u5728\\\\u50a8\\\\u5b58\\\\u548c\\\\u8fd0\\\\u8f93\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u514d\\\\u53d7\\\\u51b2\\\\u51fb\\\\uff0c\\\\u7279\\\\u522b\\\\u662f\\\\u5bf9\\\\u4e8e\\\\u957f\\\\u9014\\\\u51fa\\\\u53e3\\\\u8ba2\\\\u5355\\\\u3002\\\\u6839\\\\u636e\\\\u8981\\\\u6c42\\\\uff0c\\\\u4ea7\\\\u54c1\\\\u53ef\\\\u4ee5\\\\u6309\\\\u7167\\\\u5ba2\\\\u6237\\\\u7684\\\\u7279\\\\u5b9a\\\\u6807\\\\u51c6\\\\u8fdb\\\\u884c\\\\u5305\\\\u88c5\\\\uff0c\\\\u786e\\\\u4fdd\\\\u5728\\\\u63a5\\\\u6536\\\\u3001\\\\u5206\\\\u9500\\\\u548c\\\\u4f7f\\\\u7528\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u7684\\\\u7edf\\\\u4e00\\\\u6027\\\\u548c\\\\u4fbf\\\\u5229\\\\u6027\\\\u3002&quot;,&quot;image_id&quot;:121}\\\" data-id=\\\"two_column\\\"></div><div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;left&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;\\\\u5728\\\\u5305\\\\u88c5\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\uff0c\\\\u6bcf\\\\u4ef6\\\\u4ea7\\\\u54c1\\\\u5728\\\\u88c5\\\\u7bb1\\\\u524d\\\\u90fd\\\\u4f1a\\\\u7ecf\\\\u8fc7\\\\u8868\\\\u9762\\\\u3001\\\\u7ed3\\\\u6784\\\\u548c\\\\u5b8c\\\\u5de5\\\\u60c5\\\\u51b5\\\\u7684\\\\u6700\\\\u7ec8\\\\u68c0\\\\u9a8c\\\\u3002\\\\u6bcf\\\\u6279\\\\u8d27\\\\u7269\\\\u90fd\\\\u7ecf\\\\u8fc7\\\\u6e05\\\\u6670\\\\u7684\\\\u5206\\\\u7c7b\\\\u3001\\\\u6807\\\\u8bb0\\\\u548c\\\\u7f16\\\\u7801\\\\uff0c\\\\u4f7f\\\\u68c0\\\\u67e5\\\\u548c\\\\u4fe1\\\\u606f\\\\u68c0\\\\u7d22\\\\u51c6\\\\u786e\\\\u4fbf\\\\u6377\\\\u3002\\\\u8fd9\\\\u6709\\\\u52a9\\\\u4e8e\\\\u5728\\\\u6574\\\\u4e2a\\\\u53d1\\\\u8d27\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u4fdd\\\\u6301\\\\u900f\\\\u660e\\\\u5ea6\\\\u548c\\\\u7a33\\\\u5b9a\\\\u6027\\\\u3002\\\\nDUYANG VIETNAM \\\\u7684\\\\u8fd0\\\\u8425\\\\u56e2\\\\u961f\\\\u5728\\\\u51fa\\\\u53e3\\\\u51c6\\\\u5907\\\\u9636\\\\u6bb5\\\\u7d27\\\\u5bc6\\\\u5408\\\\u4f5c\\\\uff0c\\\\u4ece\\\\u5b89\\\\u6392\\\\u8d27\\\\u7269\\\\u3001\\\\u4f18\\\\u5316\\\\u96c6\\\\u88c5\\\\u7bb1\\\\u7a7a\\\\u95f4\\\\u5230\\\\u68c0\\\\u67e5\\\\u8fd0\\\\u8f93\\\\u6761\\\\u4ef6\\\\u3002\\\\u88c5\\\\u8f7d\\\\u8fc7\\\\u7a0b\\\\u6309\\\\u7167\\\\u6807\\\\u51c6\\\\u8fdb\\\\u884c\\\\uff0c\\\\u4ee5\\\\u6700\\\\u5927\\\\u9650\\\\u5ea6\\\\u5730\\\\u51cf\\\\u5c11\\\\u98ce\\\\u9669\\\\uff0c\\\\u786e\\\\u4fdd\\\\u8d27\\\\u7269\\\\u5728\\\\u8fd0\\\\u8f93\\\\u8fc7\\\\u7a0b\\\\u4e2d\\\\u7262\\\\u56fa\\\\u56fa\\\\u5b9a\\\\u4e14\\\\u5b89\\\\u5168\\\\u3002&quot;,&quot;image_id&quot;:122}\\\" data-id=\\\"two_column\\\"></div><p>此外，我们维护一个同步的生产和物流管理系统，能够跟踪发货进度、控制运输计划并确保按时交货。生产、质量控制和运输部门之间的紧密协调有助于 DUYANG VIETNAM 保持稳定、准确和高效的发货操作。</p><p>凭借可持续和专业的发发展方向，DUYANG VIETNAM 不断改进其包装和发货流程，以提高供应链效率、确保产品质量并加强国内外合作伙伴的信任。我们致力于在每批货物中保持稳定、准时和符合标准，为建立长期可持续的合作关系做出贡献。</p>\"}', '{\"zh_CN\": null}', 'published', 'regular', '2026-03-24 10:42:21', '2026-03-24 10:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(221, 'View:Role', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(222, 'ViewAny:Role', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(223, 'Create:Role', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(224, 'Update:Role', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(225, 'Delete:Role', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(226, 'Restore:Role', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(227, 'ForceDelete:Role', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(228, 'ForceDeleteAny:Role', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(229, 'RestoreAny:Role', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(230, 'Replicate:Role', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(231, 'Reorder:Role', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(232, 'View:User', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(233, 'ViewAny:User', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(234, 'Create:User', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(235, 'Update:User', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(236, 'Delete:User', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(237, 'Restore:User', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(238, 'ForceDelete:User', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(239, 'ForceDeleteAny:User', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(240, 'RestoreAny:User', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(241, 'Replicate:User', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(242, 'Reorder:User', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(243, 'View:Blog', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(244, 'ViewAny:Blog', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(245, 'Create:Blog', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(246, 'Update:Blog', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(247, 'Delete:Blog', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(248, 'Restore:Blog', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(249, 'ForceDelete:Blog', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(250, 'ForceDeleteAny:Blog', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(251, 'RestoreAny:Blog', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(252, 'Replicate:Blog', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(253, 'Reorder:Blog', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(254, 'View:Post', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(255, 'ViewAny:Post', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(256, 'Create:Post', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(257, 'Update:Post', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(258, 'Delete:Post', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(259, 'Restore:Post', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(260, 'ForceDelete:Post', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(261, 'ForceDeleteAny:Post', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(262, 'RestoreAny:Post', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(263, 'Replicate:Post', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(264, 'Reorder:Post', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(265, 'View:Page', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(266, 'ViewAny:Page', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(267, 'Create:Page', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(268, 'Update:Page', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(269, 'Delete:Page', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(270, 'Restore:Page', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(271, 'ForceDelete:Page', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(272, 'ForceDeleteAny:Page', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(273, 'RestoreAny:Page', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(274, 'Replicate:Page', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(275, 'Reorder:Page', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(276, 'View:Order', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(277, 'ViewAny:Order', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(278, 'Create:Order', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(279, 'Update:Order', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(280, 'Delete:Order', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(281, 'Restore:Order', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(282, 'ForceDelete:Order', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(283, 'ForceDeleteAny:Order', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(284, 'RestoreAny:Order', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(285, 'Replicate:Order', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(286, 'Reorder:Order', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(287, 'View:OrderItem', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(288, 'ViewAny:OrderItem', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(289, 'Create:OrderItem', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(290, 'Update:OrderItem', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(291, 'Delete:OrderItem', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(292, 'Restore:OrderItem', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(293, 'ForceDelete:OrderItem', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(294, 'ForceDeleteAny:OrderItem', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(295, 'RestoreAny:OrderItem', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(296, 'Replicate:OrderItem', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(297, 'Reorder:OrderItem', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(298, 'View:Collection', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(299, 'ViewAny:Collection', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(300, 'Create:Collection', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(301, 'Update:Collection', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(302, 'Delete:Collection', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(303, 'Restore:Collection', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(304, 'ForceDelete:Collection', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(305, 'ForceDeleteAny:Collection', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(306, 'RestoreAny:Collection', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(307, 'Replicate:Collection', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(308, 'Reorder:Collection', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(309, 'View:Product', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(310, 'ViewAny:Product', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(311, 'Create:Product', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(312, 'Update:Product', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(313, 'Delete:Product', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(314, 'Restore:Product', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(315, 'ForceDelete:Product', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(316, 'ForceDeleteAny:Product', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(317, 'RestoreAny:Product', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(318, 'Replicate:Product', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(319, 'Reorder:Product', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(320, 'View:Showcase', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(321, 'ViewAny:Showcase', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(322, 'Create:Showcase', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(323, 'Update:Showcase', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(324, 'Delete:Showcase', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(325, 'Restore:Showcase', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(326, 'ForceDelete:Showcase', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(327, 'ForceDeleteAny:Showcase', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(328, 'RestoreAny:Showcase', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(329, 'Replicate:Showcase', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(330, 'Reorder:Showcase', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(331, 'ViewAny:Contact', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(332, 'View:Contact', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(333, 'Create:Contact', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(334, 'Update:Contact', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(335, 'Delete:Contact', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(336, 'Restore:Contact', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(337, 'ForceDelete:Contact', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(338, 'ForceDeleteAny:Contact', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(339, 'RestoreAny:Contact', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(340, 'Replicate:Contact', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(341, 'Reorder:Contact', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(342, 'ViewAny:Menu', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(343, 'View:Menu', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(344, 'Create:Menu', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(345, 'Update:Menu', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(346, 'Delete:Menu', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(347, 'Restore:Menu', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(348, 'ForceDelete:Menu', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(349, 'ForceDeleteAny:Menu', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(350, 'RestoreAny:Menu', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(351, 'Replicate:Menu', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(352, 'Reorder:Menu', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(353, 'View:MediaManager', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(354, 'View:ShopSettings', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(355, 'View:SystemSettings', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(356, 'View:EcommerceStats', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(357, 'View:RecentOrders', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(358, 'View:RevenueChart', 'web', '2026-03-15 23:10:25', '2026-03-15 23:10:25'),
(359, 'View:MenuItem', 'web', '2026-03-15 23:26:34', '2026-03-15 23:26:34'),
(360, 'ViewAny:MenuItem', 'web', '2026-03-15 23:26:34', '2026-03-15 23:26:34'),
(361, 'Create:MenuItem', 'web', '2026-03-15 23:26:34', '2026-03-15 23:26:34'),
(362, 'Update:MenuItem', 'web', '2026-03-15 23:26:34', '2026-03-15 23:26:34'),
(363, 'Delete:MenuItem', 'web', '2026-03-15 23:26:34', '2026-03-15 23:26:34'),
(364, 'Restore:MenuItem', 'web', '2026-03-15 23:26:34', '2026-03-15 23:26:34'),
(365, 'ForceDelete:MenuItem', 'web', '2026-03-15 23:26:34', '2026-03-15 23:26:34'),
(366, 'ForceDeleteAny:MenuItem', 'web', '2026-03-15 23:26:34', '2026-03-15 23:26:34'),
(367, 'RestoreAny:MenuItem', 'web', '2026-03-15 23:26:34', '2026-03-15 23:26:34'),
(368, 'Replicate:MenuItem', 'web', '2026-03-15 23:26:34', '2026-03-15 23:26:34'),
(369, 'Reorder:MenuItem', 'web', '2026-03-15 23:26:34', '2026-03-15 23:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` json NOT NULL,
  `slug` json NOT NULL,
  `description` json DEFAULT NULL,
  `content` json DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft' COMMENT 'draft, reviewing, published, rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_blog`
--

CREATE TABLE `post_blog` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `blog_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json NOT NULL,
  `slug` json NOT NULL,
  `description` json DEFAULT NULL,
  `content` json DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `has_variant` tinyint(1) NOT NULL DEFAULT '0',
  `compare_at_price` decimal(15,2) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `featured_position` int NOT NULL DEFAULT '0',
  `stock_quantity` int NOT NULL DEFAULT '0',
  `sales_count` int NOT NULL DEFAULT '0',
  `specifications` json DEFAULT NULL,
  `features` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `policies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active, inactive, out_of_stock, coming_soon, discontinued',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `content`, `price`, `has_variant`, `compare_at_price`, `is_featured`, `featured_position`, `stock_quantity`, `sales_count`, `specifications`, `features`, `policies`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Metal Hook with Loop\", \"vi\": \"Móc Kim Loại Đầu Vòng\", \"zh_CN\": \"带环金属挂钩\"}', '{\"en\": \"metal-hook-with-loop\", \"vi\": \"moc-kim-loai-dau-vong\", \"zh_CN\": \"metal-hook-with-loop\"}', '{\"en\": \"High-quality natural wood hook, exquisitely crafted with a smooth surface and a luxurious natural wood brown color. Suitable for hanging clothes, bags, or as an interior decoration item. The product is environmentally friendly, durable, and brings natural beauty to your living space.\", \"vi\": \"Móc gỗ tự nhiên cao cấp, được chế tác tinh xảo, bề mặt nhẵn mịn, màu nâu gỗ tự nhiên sang trọng. Thích hợp treo quần áo, túi xách hoặc dùng làm vật trang trí nội thất. Sản phẩm thân thiện môi trường, bền chắc và mang lại vẻ đẹp tự nhiên cho không gian sống của bạn.\", \"zh_CN\": \"高品质天然木质挂钩，工艺精湛，表面光滑，色泽为奢华的天然木棕色。适合悬挂衣物、包袋或作为室内装饰品。产品环保耐用，为您的生活空间带来自然之美。\"}', '{\"vi\": \"<p></p>\", \"zh\": \"\"}', 0.00, 0, NULL, 0, 0, 0, 0, '{\"en\": {\"Color\": \"Natural wood brown, can be varnished\", \"Material\": \"High-quality natural wood, durable and environmentally friendly\", \"Dimensions\": \"Length 15cm x Width 3cm x Height 2cm\"}, \"vi\": {\"Màu sắc\": \"Màu nâu gỗ tự nhiên, có thể sơn phủ bóng\", \"Chất liệu\": \"Gỗ tự nhiên cao cấp, bền và thân thiện môi trường\", \"Kích thước\": \"Dài 15cm x Rộng 3cm x Cao 2cm\"}, \"zh_CN\": {\"尺寸\": \"长15厘米 x 宽3厘米 x 高2厘米\", \"材质\": \"高品质天然木材，耐用且环保\", \"颜色\": \"天然木棕色，可上光漆\"}}', '{\"vi\":\"Móc gỗ chắc chắn, chịu lực tốt, bề mặt nhẵn mịn, thiết kế đơn giản nhưng sang trọng, thích hợp treo quần áo, túi xách hoặc trang trí nội thất.\",\"en\":\"Sturdy wooden hook, good load-bearing capacity, smooth surface, simple yet elegant design, suitable for hanging clothes, bags, or interior decoration.\",\"zh_CN\":\"坚固的木质挂钩，承重能力强，表面光滑，设计简约而优雅，适合悬挂衣物、包袋或室内装饰。\"}', '{\n  \"vi\": \"Sản phẩm kiểm tra kỹ trước khi giao, đảm bảo không nứt vỡ. Khuyến nghị bảo quản nơi khô ráo, tránh va đập mạnh. Hỗ trợ tư vấn đổi sản phẩm nếu lỗi do vận chuyển.\",\n  \"en\": \"Product is carefully checked before delivery to ensure it is not cracked or broken. Recommended to keep in a dry place and avoid strong impact. Support available for replacement if damaged during shipping.\",\n  \"zh_CN\": \"产品在发货前经过仔细检查，确保没有开裂或破损。建议存放在干燥处，避免强烈碰撞。如在运输过程中损坏，可提供更换支持。\"\n}', 'active', '2026-02-27 09:22:58', '2026-03-24 21:18:22'),
(2, '{\"en\": \"Wooden Clothes Clip Hook\", \"vi\": \"Móc Gỗ Kẹp Quần Áo\", \"zh_CN\": \"木质衣夹挂钩\"}', '{\"en\": \"wooden-clothes-clip-hook\", \"vi\": \"moc-go-kep-quan-ao\", \"zh_CN\": \"muo-zi-yi-jia-gua-gou\"}', '{\"en\": \"Premium natural wooden hook with smooth surface and warm brown color. Suitable for hanging clothes, scarves, bags, or as interior decoration.\", \"vi\": \"Móc gỗ tự nhiên cao cấp, bề mặt nhẵn mịn, màu nâu ấm sang trọng. Thích hợp treo quần áo, khăn, túi xách hoặc làm vật trang trí nội thất.\", \"zh_CN\": \"高品质天然木质挂钩，表面光滑，温暖的棕色。适合挂衣物、围巾、包包或作为室内装饰。\"}', '{\"vi\": \"<p></p>\"}', 0.00, 0, NULL, 0, 0, 0, 0, '{\"en\": {\"Color\": \"Natural wood brown, can be varnished\", \"Material\": \"High-quality natural wood, durable and environmentally friendly\", \"Dimensions\": \"Length 15cm x Width 3cm x Height 2cm\"}, \"vi\": {\"Màu sắc\": \"Màu nâu gỗ tự nhiên, có thể sơn phủ bóng\", \"Chất liệu\": \"Gỗ tự nhiên cao cấp, bền và thân thiện môi trường\", \"Kích thước\": \"Dài 15cm x Rộng 3cm x Cao 2cm\"}, \"zh_CN\": {\"尺寸\": \"长15厘米 x 宽3厘米 x 高2厘米\", \"材质\": \"高品质天然木材，耐用且环保\", \"颜色\": \"天然木棕色，可上光漆\"}}', '{\"vi\":\"Móc gỗ chắc chắn, chịu lực tốt, bề mặt nhẵn mịn, thiết kế đơn giản nhưng sang trọng, thích hợp treo quần áo, túi xách hoặc trang trí nội thất.\",\"en\":\"Sturdy wooden hook, good load-bearing capacity, smooth surface, simple yet elegant design, suitable for hanging clothes, bags, or interior decoration.\",\"zh_CN\":\"坚固的木质挂钩，承重能力强，表面光滑，设计简约而优雅，适合悬挂衣物、包袋或室内装饰。\"}', '{\n  \"vi\": \"Sản phẩm kiểm tra kỹ trước khi giao, đảm bảo không nứt vỡ. Khuyến nghị bảo quản nơi khô ráo, tránh va đập mạnh. Hỗ trợ tư vấn đổi sản phẩm nếu lỗi do vận chuyển.\",\n  \"en\": \"Product is carefully checked before delivery to ensure it is not cracked or broken. Recommended to keep in a dry place and avoid strong impact. Support available for replacement if damaged during shipping.\",\n  \"zh_CN\": \"产品在发货前经过仔细检查，确保没有开裂或破损。建议存放在干燥处，避免强烈碰撞。如在运输过程中损坏，可提供更换支持。\"\n}', 'active', '2026-03-02 15:46:12', '2026-03-02 15:46:12'),
(3, '{\"en\": \"Premium Wooden Vest Hanger\", \"vi\": \"Móc Vest Gỗ Cao Cấp\", \"zh_CN\": \"高档木质西装衣架\"}', '{\"en\": \"premium-wooden-vest-hanger\", \"vi\": \"moc-vest-go-cao-cap\", \"zh_CN\": \"gao-dang-mu-zhi-xi-zhuang-yi-jia\"}', '{\"en\": \"Wooden hanger specially designed for vests, with a smooth surface that maintains the shape of garments. Elegant, durable, and eco-friendly, keeping your wardrobe tidy.\", \"vi\": \"Móc gỗ thiết kế dành riêng cho vest, bề mặt nhẵn mịn, giữ form áo tốt. Sản phẩm sang trọng, bền chắc và thân thiện với môi trường, giúp tủ quần áo luôn gọn gàng.\", \"zh_CN\": \"专为西装设计的木质衣架，表面光滑，保持衣物形状。高档、耐用且环保，让衣柜整洁有序。\"}', '{\"vi\": \"<p></p>\"}', 0.00, 0, NULL, 0, 0, 0, 0, '{\"en\": {\"Color\": \"Natural wood brown, can be varnished\", \"Material\": \"High-quality natural wood, durable and environmentally friendly\", \"Dimensions\": \"Length 15cm x Width 3cm x Height 2cm\"}, \"vi\": {\"Màu sắc\": \"Màu nâu gỗ tự nhiên, có thể sơn phủ bóng\", \"Chất liệu\": \"Gỗ tự nhiên cao cấp, bền và thân thiện môi trường\", \"Kích thước\": \"Dài 15cm x Rộng 3cm x Cao 2cm\"}, \"zh_CN\": {\"尺寸\": \"长15厘米 x 宽3厘米 x 高2厘米\", \"材质\": \"高品质天然木材，耐用且环保\", \"颜色\": \"天然木棕色，可上光漆\"}}', '{\"vi\":\"Móc gỗ chắc chắn, chịu lực tốt, bề mặt nhẵn mịn, thiết kế đơn giản nhưng sang trọng, thích hợp treo quần áo, túi xách hoặc trang trí nội thất.\",\"en\":\"Sturdy wooden hook, good load-bearing capacity, smooth surface, simple yet elegant design, suitable for hanging clothes, bags, or interior decoration.\",\"zh_CN\":\"坚固的木质挂钩，承重能力强，表面光滑，设计简约而优雅，适合悬挂衣物、包袋或室内装饰。\"}', '{\n  \"vi\": \"Sản phẩm kiểm tra kỹ trước khi giao, đảm bảo không nứt vỡ. Khuyến nghị bảo quản nơi khô ráo, tránh va đập mạnh. Hỗ trợ tư vấn đổi sản phẩm nếu lỗi do vận chuyển.\",\n  \"en\": \"Product is carefully checked before delivery to ensure it is not cracked or broken. Recommended to keep in a dry place and avoid strong impact. Support available for replacement if damaged during shipping.\",\n  \"zh_CN\": \"产品在发货前经过仔细检查，确保没有开裂或破损。建议存放在干燥处，避免强烈碰撞。如在运输过程中损坏，可提供更换支持。\"\n}', 'active', '2026-03-02 15:48:53', '2026-03-02 15:48:53'),
(4, '{\"en\": \"Slim Wooden Hanger\", \"vi\": \"Móc Gỗ Dáng Mỏng\", \"zh_CN\": \"纤细木质衣架\"}', '{\"en\": \"slim-wooden-hanger\", \"vi\": \"moc-go-dang-mong\", \"zh_CN\": \"xian-xi-mu-zhi-yi-jia\"}', '{\"en\": \"Slim wooden hanger designed to save wardrobe space, with a smooth surface, durable and eco-friendly. Ideal for shirts, light vests, and other garments.\", \"vi\": \"Móc gỗ thiết kế dáng mỏng, tiết kiệm không gian tủ quần áo, bề mặt nhẵn mịn, bền chắc và thân thiện môi trường. Thích hợp treo áo sơ mi, vest nhẹ và các loại quần áo khác.\", \"zh_CN\": \"纤细木质衣架设计节省衣柜空间，表面光滑，耐用且环保。适合挂衬衫、轻西装及其他衣物。\"}', '{\"vi\": \"<p></p>\"}', 0.00, 0, NULL, 0, 0, 0, 0, '{\"en\": {\"Color\": \"Natural wood brown, can be varnished\", \"Material\": \"High-quality natural wood, durable and environmentally friendly\", \"Dimensions\": \"Length 15cm x Width 3cm x Height 2cm\"}, \"vi\": {\"Màu sắc\": \"Màu nâu gỗ tự nhiên, có thể sơn phủ bóng\", \"Chất liệu\": \"Gỗ tự nhiên cao cấp, bền và thân thiện môi trường\", \"Kích thước\": \"Dài 15cm x Rộng 3cm x Cao 2cm\"}, \"zh_CN\": {\"尺寸\": \"长15厘米 x 宽3厘米 x 高2厘米\", \"材质\": \"高品质天然木材，耐用且环保\", \"颜色\": \"天然木棕色，可上光漆\"}}', '{\"vi\":\"Móc gỗ chắc chắn, chịu lực tốt, bề mặt nhẵn mịn, thiết kế đơn giản nhưng sang trọng, thích hợp treo quần áo, túi xách hoặc trang trí nội thất.\",\"en\":\"Sturdy wooden hook, good load-bearing capacity, smooth surface, simple yet elegant design, suitable for hanging clothes, bags, or interior decoration.\",\"zh_CN\":\"坚固的木质挂钩，承重能力强，表面光滑，设计简约而优雅，适合悬挂衣物、包袋或室内装饰。\"}', '{\n  \"vi\": \"Sản phẩm kiểm tra kỹ trước khi giao, đảm bảo không nứt vỡ. Khuyến nghị bảo quản nơi khô ráo, tránh va đập mạnh. Hỗ trợ tư vấn đổi sản phẩm nếu lỗi do vận chuyển.\",\n  \"en\": \"Product is carefully checked before delivery to ensure it is not cracked or broken. Recommended to keep in a dry place and avoid strong impact. Support available for replacement if damaged during shipping.\",\n  \"zh_CN\": \"产品在发货前经过仔细检查，确保没有开裂或破损。建议存放在干燥处，避免强烈碰撞。如在运输过程中损坏，可提供更换支持。\"\n}', 'active', '2026-03-02 15:49:18', '2026-03-02 15:49:18'),
(5, '{\"en\": \"Classic Wooden Clip Hanger\", \"vi\": \"Móc Gỗ Kẹp Classic\", \"zh_CN\": \"经典木质夹衣架\"}', '{\"en\": \"classic-wooden-clip-hanger\", \"vi\": \"moc-go-kep-classic\", \"zh_CN\": \"jing-dian-mu-zhi-jia-yi-jia\"}', '{\"en\": \"Traditional wooden clip hanger, sturdy and durable, suitable for hanging clothes, skirts, or small accessories. Simple design emphasizing classic elegance.\", \"vi\": \"Móc gỗ kiểu kẹp truyền thống, chắc chắn và bền bỉ, thích hợp treo quần áo, váy hoặc các phụ kiện nhỏ. Thiết kế đơn giản, nhấn mạnh tính cổ điển và sang trọng.\", \"zh_CN\": \"传统木质夹衣架，坚固耐用，适合挂衣物、裙子或小配件。设计简约，凸显经典优雅风格。\"}', '{\"en\": \"\", \"vi\": \"<p></p>\"}', 0.00, 0, NULL, 0, 0, 0, 0, '{\"en\": {\"Color\": \"Natural wood brown, can be varnished\", \"Material\": \"High-quality natural wood, durable and environmentally friendly\", \"Dimensions\": \"Length 15cm x Width 3cm x Height 2cm\"}, \"vi\": {\"Màu sắc\": \"Màu nâu gỗ tự nhiên, có thể sơn phủ bóng\", \"Chất liệu\": \"Gỗ tự nhiên cao cấp, bền và thân thiện môi trường\", \"Kích thước\": \"Dài 15cm x Rộng 3cm x Cao 2cm\"}, \"zh_CN\": {\"尺寸\": \"长15厘米 x 宽3厘米 x 高2厘米\", \"材质\": \"高品质天然木材，耐用且环保\", \"颜色\": \"天然木棕色，可上光漆\"}}', '{\"vi\":\"Móc gỗ chắc chắn, chịu lực tốt, bề mặt nhẵn mịn, thiết kế đơn giản nhưng sang trọng, thích hợp treo quần áo, túi xách hoặc trang trí nội thất.\",\"en\":\"Sturdy wooden hook, good load-bearing capacity, smooth surface, simple yet elegant design, suitable for hanging clothes, bags, or interior decoration.\",\"zh_CN\":\"坚固的木质挂钩，承重能力强，表面光滑，设计简约而优雅，适合悬挂衣物、包袋或室内装饰。\"}', '{\n  \"vi\": \"Sản phẩm kiểm tra kỹ trước khi giao, đảm bảo không nứt vỡ. Khuyến nghị bảo quản nơi khô ráo, tránh va đập mạnh. Hỗ trợ tư vấn đổi sản phẩm nếu lỗi do vận chuyển.\",\n  \"en\": \"Product is carefully checked before delivery to ensure it is not cracked or broken. Recommended to keep in a dry place and avoid strong impact. Support available for replacement if damaged during shipping.\",\n  \"zh_CN\": \"产品在发货前经过仔细检查，确保没有开裂或破损。建议存放在干燥处，避免强烈碰撞。如在运输过程中损坏，可提供更换支持。\"\n}', 'active', '2026-03-02 15:57:08', '2026-03-02 15:57:53'),
(6, '{\"en\": \"Standard Wooden Hanger\", \"vi\": \"Móc Gỗ Tiêu Chuẩn\", \"zh_CN\": \"标准木质衣架\"}', '{\"en\": \"standard-wooden-hanger\", \"vi\": \"moc-go-tieu-chuan\", \"zh_CN\": \"biao-zhun-mu-zhi-yi-jia\"}', '{\"en\": \"Standard wooden hanger, sturdy and easy to use. Suitable for hanging shirts, light jackets, and everyday garments, keeping your wardrobe organized.\", \"vi\": \"Móc gỗ thiết kế tiêu chuẩn, bền chắc và dễ sử dụng. Phù hợp treo áo sơ mi, áo khoác nhẹ và các loại quần áo hàng ngày, giúp tủ quần áo gọn gàng.\", \"zh_CN\": \"标准木质衣架，坚固易用。适合挂衬衫、轻便外套及日常衣物，让衣柜整齐有序。\"}', '{\"vi\": \"<p></p>\"}', 0.00, 0, NULL, 0, 0, 0, 0, '{\"en\": {\"Color\": \"Natural wood brown, can be varnished\", \"Material\": \"High-quality natural wood, durable and environmentally friendly\", \"Dimensions\": \"Length 15cm x Width 3cm x Height 2cm\"}, \"vi\": {\"Màu sắc\": \"Màu nâu gỗ tự nhiên, có thể sơn phủ bóng\", \"Chất liệu\": \"Gỗ tự nhiên cao cấp, bền và thân thiện môi trường\", \"Kích thước\": \"Dài 15cm x Rộng 3cm x Cao 2cm\"}, \"zh_CN\": {\"尺寸\": \"长15厘米 x 宽3厘米 x 高2厘米\", \"材质\": \"高品质天然木材，耐用且环保\", \"颜色\": \"天然木棕色，可上光漆\"}}', '{\"vi\":\"Móc gỗ chắc chắn, chịu lực tốt, bề mặt nhẵn mịn, thiết kế đơn giản nhưng sang trọng, thích hợp treo quần áo, túi xách hoặc trang trí nội thất.\",\"en\":\"Sturdy wooden hook, good load-bearing capacity, smooth surface, simple yet elegant design, suitable for hanging clothes, bags, or interior decoration.\",\"zh_CN\":\"坚固的木质挂钩，承重能力强，表面光滑，设计简约而优雅，适合悬挂衣物、包袋或室内装饰。\"}', '{\n  \"vi\": \"Sản phẩm kiểm tra kỹ trước khi giao, đảm bảo không nứt vỡ. Khuyến nghị bảo quản nơi khô ráo, tránh va đập mạnh. Hỗ trợ tư vấn đổi sản phẩm nếu lỗi do vận chuyển.\",\n  \"en\": \"Product is carefully checked before delivery to ensure it is not cracked or broken. Recommended to keep in a dry place and avoid strong impact. Support available for replacement if damaged during shipping.\",\n  \"zh_CN\": \"产品在发货前经过仔细检查，确保没有开裂或破损。建议存放在干燥处，避免强烈碰撞。如在运输过程中损坏，可提供更换支持。\"\n}', 'active', '2026-03-02 15:58:47', '2026-03-02 15:58:47'),
(7, '{\"en\": \"Premium Wooden Hanger with Horizontal Bar\", \"vi\": \"Móc Gỗ Cao Cấp Thanh Ngang\", \"zh_CN\": \"高档木质横杆衣架\"}', '{\"en\": \"premium-wooden-hanger-with-horizontal-bar\", \"vi\": \"moc-go-cao-cap-thanh-ngang\", \"zh_CN\": \"gao-dang-mu-zhi-heng-gan-yi-jia\"}', '{\"en\": \"Premium wooden hanger with sturdy horizontal bar, suitable for hanging pants, skirts, or garments that require shape retention. Smooth surface, elegant and durable, keeping your wardrobe organized.\", \"vi\": \"Móc gỗ cao cấp với thanh ngang chắc chắn, thích hợp treo quần, váy hoặc các loại quần áo cần giữ form. Bề mặt nhẵn mịn, sang trọng và bền bỉ, giúp tủ quần áo gọn gàng.\", \"zh_CN\": \"高档木质衣架配坚固横杆，适合挂裤子、裙子或需要保持形状的衣物。表面光滑，优雅耐用，让衣柜整洁有序。\"}', '{\"vi\": \"<p></p>\"}', 0.00, 0, NULL, 0, 0, 0, 0, '{\"en\": {\"Color\": \"Natural wood brown, can be varnished\", \"Material\": \"High-quality natural wood, durable and environmentally friendly\", \"Dimensions\": \"Length 15cm x Width 3cm x Height 2cm\"}, \"vi\": {\"Màu sắc\": \"Màu nâu gỗ tự nhiên, có thể sơn phủ bóng\", \"Chất liệu\": \"Gỗ tự nhiên cao cấp, bền và thân thiện môi trường\", \"Kích thước\": \"Dài 15cm x Rộng 3cm x Cao 2cm\"}, \"zh_CN\": {\"尺寸\": \"长15厘米 x 宽3厘米 x 高2厘米\", \"材质\": \"高品质天然木材，耐用且环保\", \"颜色\": \"天然木棕色，可上光漆\"}}', '{\"vi\":\"Móc gỗ chắc chắn, chịu lực tốt, bề mặt nhẵn mịn, thiết kế đơn giản nhưng sang trọng, thích hợp treo quần áo, túi xách hoặc trang trí nội thất.\",\"en\":\"Sturdy wooden hook, good load-bearing capacity, smooth surface, simple yet elegant design, suitable for hanging clothes, bags, or interior decoration.\",\"zh_CN\":\"坚固的木质挂钩，承重能力强，表面光滑，设计简约而优雅，适合悬挂衣物、包袋或室内装饰。\"}', '{\n  \"vi\": \"Sản phẩm kiểm tra kỹ trước khi giao, đảm bảo không nứt vỡ. Khuyến nghị bảo quản nơi khô ráo, tránh va đập mạnh. Hỗ trợ tư vấn đổi sản phẩm nếu lỗi do vận chuyển.\",\n  \"en\": \"Product is carefully checked before delivery to ensure it is not cracked or broken. Recommended to keep in a dry place and avoid strong impact. Support available for replacement if damaged during shipping.\",\n  \"zh_CN\": \"产品在发货前经过仔细检查，确保没有开裂或破损。建议存放在干燥处，避免强烈碰撞。如在运输过程中损坏，可提供更换支持。\"\n}', 'active', '2026-03-02 15:59:11', '2026-03-02 15:59:11'),
(8, '{\"en\": \"Mahogany Wooden Vest Hanger\", \"vi\": \"Móc Vest Gỗ Mahogany\", \"zh_CN\": \"红木西装衣架\"}', '{\"en\": \"mahogany-wooden-vest-hanger\", \"vi\": \"moc-vest-go-mahogany\", \"zh_CN\": \"hong-mu-xi-zhuang-yi-jia\"}', '{\"en\": \"Premium Mahogany wooden hanger, specially designed for vests, with a smooth surface that maintains garment shape. Elegant, durable, and eco-friendly, keeping your wardrobe organized.\", \"vi\": \"Móc gỗ Mahogany cao cấp, thiết kế chuyên dụng cho vest, bề mặt nhẵn mịn, giữ form áo tốt. Sản phẩm sang trọng, bền chắc và thân thiện môi trường, giúp tủ quần áo luôn gọn gàng.\", \"zh_CN\": \"高档红木衣架，专为西装设计，表面光滑，保持衣物形状。高档、耐用且环保，让衣柜整洁有序。\"}', '{\"vi\": \"<p></p>\"}', 0.00, 0, NULL, 0, 0, 0, 0, '{\"en\": {\"Color\": \"Natural wood brown, can be varnished\", \"Material\": \"High-quality natural wood, durable and environmentally friendly\", \"Dimensions\": \"Length 15cm x Width 3cm x Height 2cm\"}, \"vi\": {\"Màu sắc\": \"Màu nâu gỗ tự nhiên, có thể sơn phủ bóng\", \"Chất liệu\": \"Gỗ tự nhiên cao cấp, bền và thân thiện môi trường\", \"Kích thước\": \"Dài 15cm x Rộng 3cm x Cao 2cm\"}, \"zh_CN\": {\"尺寸\": \"长15厘米 x 宽3厘米 x 高2厘米\", \"材质\": \"高品质天然木材，耐用且环保\", \"颜色\": \"天然木棕色，可上光漆\"}}', '{\"vi\":\"Móc gỗ chắc chắn, chịu lực tốt, bề mặt nhẵn mịn, thiết kế đơn giản nhưng sang trọng, thích hợp treo quần áo, túi xách hoặc trang trí nội thất.\",\"en\":\"Sturdy wooden hook, good load-bearing capacity, smooth surface, simple yet elegant design, suitable for hanging clothes, bags, or interior decoration.\",\"zh_CN\":\"坚固的木质挂钩，承重能力强，表面光滑，设计简约而优雅，适合悬挂衣物、包袋或室内装饰。\"}', '{\n  \"vi\": \"Sản phẩm kiểm tra kỹ trước khi giao, đảm bảo không nứt vỡ. Khuyến nghị bảo quản nơi khô ráo, tránh va đập mạnh. Hỗ trợ tư vấn đổi sản phẩm nếu lỗi do vận chuyển.\",\n  \"en\": \"Product is carefully checked before delivery to ensure it is not cracked or broken. Recommended to keep in a dry place and avoid strong impact. Support available for replacement if damaged during shipping.\",\n  \"zh_CN\": \"产品在发货前经过仔细检查，确保没有开裂或破损。建议存放在干燥处，避免强烈碰撞。如在运输过程中损坏，可提供更换支持。\"\n}', 'active', '2026-03-02 15:59:33', '2026-03-02 15:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_collection`
--

CREATE TABLE `product_collection` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `collection_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_options`
--

CREATE TABLE `product_options` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_option_values`
--

CREATE TABLE `product_option_values` (
  `id` bigint UNSIGNED NOT NULL,
  `product_option_id` bigint UNSIGNED NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `reviewer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `reviewer_name`, `reviewer_email`, `rating`, `comment`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Việt Hùng', 'viet.hung.2898@gmail.com', 5, 'Toẹt vời', 1, '2026-03-02 16:53:28', '2026-03-02 16:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_values`
--

CREATE TABLE `product_variant_values` (
  `id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `product_option_value_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(11, 'super_admin', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21'),
(12, 'customer', 'web', '2026-03-15 23:09:21', '2026-03-15 23:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(221, 11),
(222, 11),
(223, 11),
(224, 11),
(225, 11),
(226, 11),
(227, 11),
(228, 11),
(229, 11),
(230, 11),
(231, 11),
(232, 11),
(233, 11),
(234, 11),
(235, 11),
(236, 11),
(237, 11),
(238, 11),
(239, 11),
(240, 11),
(241, 11),
(242, 11),
(243, 11),
(244, 11),
(245, 11),
(246, 11),
(247, 11),
(248, 11),
(249, 11),
(250, 11),
(251, 11),
(252, 11),
(253, 11),
(254, 11),
(255, 11),
(256, 11),
(257, 11),
(258, 11),
(259, 11),
(260, 11),
(261, 11),
(262, 11),
(263, 11),
(264, 11),
(265, 11),
(266, 11),
(267, 11),
(268, 11),
(269, 11),
(270, 11),
(271, 11),
(272, 11),
(273, 11),
(274, 11),
(275, 11),
(276, 11),
(277, 11),
(278, 11),
(279, 11),
(280, 11),
(281, 11),
(282, 11),
(283, 11),
(284, 11),
(285, 11),
(286, 11),
(287, 11),
(288, 11),
(289, 11),
(290, 11),
(291, 11),
(292, 11),
(293, 11),
(294, 11),
(295, 11),
(296, 11),
(297, 11),
(298, 11),
(299, 11),
(300, 11),
(301, 11),
(302, 11),
(303, 11),
(304, 11),
(305, 11),
(306, 11),
(307, 11),
(308, 11),
(309, 11),
(310, 11),
(311, 11),
(312, 11),
(313, 11),
(314, 11),
(315, 11),
(316, 11),
(317, 11),
(318, 11),
(319, 11),
(320, 11),
(321, 11),
(322, 11),
(323, 11),
(324, 11),
(325, 11),
(326, 11),
(327, 11),
(328, 11),
(329, 11),
(330, 11),
(331, 11),
(332, 11),
(333, 11),
(334, 11),
(335, 11),
(336, 11),
(337, 11),
(338, 11),
(339, 11),
(340, 11),
(341, 11),
(342, 11),
(343, 11),
(344, 11),
(345, 11),
(346, 11),
(347, 11),
(348, 11),
(349, 11),
(350, 11),
(351, 11),
(352, 11),
(359, 11),
(360, 11),
(361, 11),
(362, 11),
(363, 11),
(364, 11),
(365, 11),
(366, 11),
(367, 11),
(368, 11),
(369, 11);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('LDNiN6GFqRm6QCa5oo1yjoX3HYbgmvTofvmvKxxj', 11, '172.18.0.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoieXoxMTYxWjNtaFl0VnFsU1BPdjVWYjNxdkpmOXFwUGZMV0xUYmNZNSI7czo2OiJsb2NhbGUiO3M6MjoidmkiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQ0OiJodHRwczovL2xhcmF2ZWwtZmlsYW1lbnQtYmFzZS5kZGV2LnNpdGUvc2hvcCI7czo1OiJyb3V0ZSI7czo0OiJzaG9wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjhlNGM1YzY4ZGM3YjFjZWZiZTgyODIyZThjY2QwNDBlMTMxMjRhMWY4YTYxNjhmYjM5NWI3MDYxNjgwYTI1NzUiO3M6NjoidGFibGVzIjthOjM6e3M6NDA6ImE1MTZjYjQzM2Q1NGNiMzc2Mjg0YzIxZmM0ZTRmYWE1X2NvbHVtbnMiO2E6NTp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjQ6Im5hbWUiO3M6NToibGFiZWwiO3M6NDoiVMOqbiI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NDoic2x1ZyI7czo1OiJsYWJlbCI7czoxNToixJDGsOG7nW5nIGThuqtuIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMToiaXRlbXNfY291bnQiO3M6NToibGFiZWwiO3M6MTA6IlPhu5EgbeG7pWMiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjY6InN0YXR1cyI7czo1OiJsYWJlbCI7czoxMzoiVHLhuqFuZyB0aMOhaSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTE6Ik5nw6B5IHThuqFvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9fXM6NDA6ImQ4YzIyMWE1NTYzNjQ2OGJjZDRhNGFjZTYxZTQ4ZmIzX2NvbHVtbnMiO2E6Njp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjU6InRpdGxlIjtzOjU6ImxhYmVsIjtzOjExOiJUacOqdSDEkeG7gSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NDoic2x1ZyI7czo1OiJsYWJlbCI7czoxNToixJDGsOG7nW5nIGThuqtuIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo1OiJpbWFnZSI7czo1OiJsYWJlbCI7czoxMToiSMOsbmgg4bqjbmgiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjY6InN0YXR1cyI7czo1OiJsYWJlbCI7czoxMzoiVHLhuqFuZyB0aMOhaSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTE6Ik5nw6B5IHThuqFvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9aTo1O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjE4OiJOZ8OgeSBj4bqtcCBuaOG6rXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO319czo0MDoiOGZhYzZlYjFjZWMyNjgwM2IzZjdmYjQ0MGEyNzExMWJfY29sdW1ucyI7YTo2OntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NDoibmFtZSI7czo1OiJsYWJlbCI7czo0OiJUw6puIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo0OiJzbHVnIjtzOjU6ImxhYmVsIjtzOjE1OiLEkMaw4budbmcgZOG6q24iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjY6ImltYWdlcyI7czo1OiJsYWJlbCI7czoxMToiSMOsbmgg4bqjbmgiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjY6InN0YXR1cyI7czo1OiJsYWJlbCI7czoxMzoiVHLhuqFuZyB0aMOhaSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTE6Ik5nw6B5IHThuqFvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9aTo1O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjE4OiJOZ8OgeSBj4bqtcCBuaOG6rXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO319fXM6ODoiZmlsYW1lbnQiO2E6MDp7fXM6NzoiaW5lcnRpYSI7YTowOnt9fQ==', 1774419204);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `group`, `key`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'shop', 'site_name', NULL, '{\"en\": \"Duyang vietnam en\", \"vi\": \"Duyang vietnam\"}', '2026-02-27 11:21:58', '2026-03-21 02:53:31'),
(2, 'shop', 'site_logo', 'image', '{\"en\": 41, \"vi\": 41}', '2026-02-27 11:21:58', '2026-03-21 02:53:31'),
(3, 'shop', 'site_email', NULL, '{\"en\": \"duyangvietnam@gmail.com\", \"vi\": \"duyangvietnam@gmail.com\"}', '2026-02-27 11:21:58', '2026-03-21 02:53:31'),
(4, 'shop', 'site_phone', NULL, '{\"en\": \"0878 989 999\", \"vi\": \"0878 989 999\"}', '2026-02-27 11:21:58', '2026-03-21 02:53:31'),
(5, 'shop', 'site_address', NULL, '{\"en\": \"1236 Nguyen Van Linh Street, Thuong Hong Ward, Hung Yen Province, Vietnam\", \"vi\": \"Số 1236 Đường Nguyễn Văn Linh, Phường Thượng Hồng,  Tỉnh Hưng Yên, Việt Nam\"}', '2026-02-27 11:21:58', '2026-03-21 02:53:31'),
(6, 'shop', 'site_description', NULL, '{\"en\": \"DUYANG VIETNAM is always ready to support and provide manufacturing solutions tailored to your needs. Please send us your information, and our team will respond promptly with details about our products, production capabilities, as well as OEM/ODM cooperation opportunities.\", \"vi\": \"DUYANG VIETNAM luôn sẵn sàng hỗ trợ và tư vấn giải pháp sản xuất phù hợp với nhu cầu của bạn. Hãy gửi thông tin, đội ngũ của chúng tôi sẽ phản hồi nhanh chóng và cung cấp chi tiết về sản phẩm, năng lực sản xuất cũng như hợp tác OEM / ODM.\"}', '2026-02-27 11:21:58', '2026-03-21 02:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `showcases`
--

CREATE TABLE `showcases` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'testimonial, partner',
  `title` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `content` json DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active, archived',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 'Super Admin', 'admin@admin.com', '2026-03-15 23:09:21', '$2y$12$/xndr2gOZAYm1B64ibtSyOwPZaJxgaMe7DEZPInvHZFk33Z00snJu', 1, NULL, NULL, NULL, 'dFyTJm2oPhLWo7pLQdS5p1S69MrtL1sNYmgHz8yajQ9bws8omAVk2hb2So9l', '2026-03-15 23:09:21', '2026-03-15 23:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_folder_id_foreign` (`folder_id`);

--
-- Indexes for table `mediables`
--
ALTER TABLE `mediables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mediables_media_id_foreign` (`media_id`),
  ADD KEY `mediables_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `media_folders`
--
ALTER TABLE `media_folders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_folders_path_unique` (`path`),
  ADD KEY `media_folders_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_slug_unique` (`slug`);

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
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_province_id_foreign` (`province_id`),
  ADD KEY `orders_ward_id_foreign` (`ward_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_blog`
--
ALTER TABLE `post_blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_blog_post_id_foreign` (`post_id`),
  ADD KEY `post_blog_blog_id_foreign` (`blog_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_collection`
--
ALTER TABLE `product_collection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_collection_product_id_foreign` (`product_id`),
  ADD KEY `product_collection_collection_id_foreign` (`collection_id`);

--
-- Indexes for table `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_options_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_option_values`
--
ALTER TABLE `product_option_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_option_values_product_option_id_foreign` (`product_option_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_product_id_is_approved_index` (`product_id`,`is_approved`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variant_values`
--
ALTER TABLE `product_variant_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_values_product_variant_id_foreign` (`product_variant_id`),
  ADD KEY `product_variant_values_product_option_value_id_foreign` (`product_option_value_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provinces_code_unique` (`code`);

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
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- Indexes for table `showcases`
--
ALTER TABLE `showcases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wards_code_unique` (`code`),
  ADD KEY `wards_province_id_foreign` (`province_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `mediables`
--
ALTER TABLE `mediables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=519;

--
-- AUTO_INCREMENT for table `media_folders`
--
ALTER TABLE `media_folders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=528;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_blog`
--
ALTER TABLE `post_blog`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_collection`
--
ALTER TABLE `product_collection`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_options`
--
ALTER TABLE `product_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_option_values`
--
ALTER TABLE `product_option_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variant_values`
--
ALTER TABLE `product_variant_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `showcases`
--
ALTER TABLE `showcases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wards`
--
ALTER TABLE `wards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `media_folders` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `mediables`
--
ALTER TABLE `mediables`
  ADD CONSTRAINT `mediables_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media_folders`
--
ALTER TABLE `media_folders`
  ADD CONSTRAINT `media_folders_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `media_folders` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE SET NULL;

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
  ADD CONSTRAINT `orders_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ward_id_foreign` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_blog`
--
ALTER TABLE `post_blog`
  ADD CONSTRAINT `post_blog_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_blog_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_collection`
--
ALTER TABLE `product_collection`
  ADD CONSTRAINT `product_collection_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_collection_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_options`
--
ALTER TABLE `product_options`
  ADD CONSTRAINT `product_options_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_option_values`
--
ALTER TABLE `product_option_values`
  ADD CONSTRAINT `product_option_values_product_option_id_foreign` FOREIGN KEY (`product_option_id`) REFERENCES `product_options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variant_values`
--
ALTER TABLE `product_variant_values`
  ADD CONSTRAINT `product_variant_values_product_option_value_id_foreign` FOREIGN KEY (`product_option_value_id`) REFERENCES `product_option_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_values_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wards`
--
ALTER TABLE `wards`
  ADD CONSTRAINT `wards_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
