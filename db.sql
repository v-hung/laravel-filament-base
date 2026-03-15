-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Mar 15, 2026 at 05:24 PM
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
(1, '{\"vi\": \"Tin mới\"}', '{\"vi\": \"tin-moi\"}', '{\"vi\": null}', 'active', '2026-02-27 23:23:13', '2026-02-27 23:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1773592923),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1773592923;', 1773592923),
('laravel-cache-boost:mcp:database-schema:mysql:contacts', 'a:3:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:1:{s:8:\"contacts\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:4:\"name\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:5:\"email\";a:1:{s:4:\"type\";s:7:\"varchar\";}s:7:\"content\";a:1:{s:4:\"type\";s:4:\"text\";}s:7:\"read_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}s:6:\"global\";a:4:{s:5:\"views\";a:0:{}s:17:\"stored_procedures\";a:0:{}s:9:\"functions\";a:0:{}s:9:\"sequences\";a:0:{}}}', 1772883692),
('laravel-cache-boost.roster.scan', 'a:2:{s:6:\"roster\";O:21:\"Laravel\\Roster\\Roster\":3:{s:13:\"\0*\0approaches\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:23:\"Laravel\\Roster\\Approach\":1:{s:11:\"\0*\0approach\";E:38:\"Laravel\\Roster\\Enums\\Approaches:ACTION\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:22:{i:0;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^4.0\";s:10:\"\0*\0package\";E:38:\"Laravel\\Roster\\Enums\\Packages:FILAMENT\";s:14:\"\0*\0packageName\";s:17:\"filament/filament\";s:10:\"\0*\0version\";s:5:\"4.6.3\";s:6:\"\0*\0dev\";b:0;}i:1;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^2.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:INERTIA\";s:14:\"\0*\0packageName\";s:25:\"inertiajs/inertia-laravel\";s:10:\"\0*\0version\";s:6:\"2.0.19\";s:6:\"\0*\0dev\";b:0;}i:2;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^2.0\";s:10:\"\0*\0package\";E:45:\"Laravel\\Roster\\Enums\\Packages:INERTIA_LARAVEL\";s:14:\"\0*\0packageName\";s:25:\"inertiajs/inertia-laravel\";s:10:\"\0*\0version\";s:6:\"2.0.19\";s:6:\"\0*\0dev\";b:0;}i:3;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.30\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:FORTIFY\";s:14:\"\0*\0packageName\";s:15:\"laravel/fortify\";s:10:\"\0*\0version\";s:6:\"1.34.0\";s:6:\"\0*\0dev\";b:0;}i:4;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.49.0\";s:6:\"\0*\0dev\";b:0;}i:5;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:7:\"v0.3.11\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PROMPTS\";s:14:\"\0*\0packageName\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:6:\"0.3.11\";s:6:\"\0*\0dev\";b:0;}i:6;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^0.1.9\";s:10:\"\0*\0package\";E:39:\"Laravel\\Roster\\Enums\\Packages:WAYFINDER\";s:14:\"\0*\0packageName\";s:17:\"laravel/wayfinder\";s:10:\"\0*\0version\";s:6:\"0.1.13\";s:6:\"\0*\0dev\";b:0;}i:7;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^0.1.9\";s:10:\"\0*\0package\";E:47:\"Laravel\\Roster\\Enums\\Packages:WAYFINDER_LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/wayfinder\";s:10:\"\0*\0version\";s:6:\"0.1.13\";s:6:\"\0*\0dev\";b:0;}i:8;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v3.7.6\";s:10:\"\0*\0package\";E:38:\"Laravel\\Roster\\Enums\\Packages:LIVEWIRE\";s:14:\"\0*\0packageName\";s:17:\"livewire/livewire\";s:10:\"\0*\0version\";s:5:\"3.7.6\";s:6:\"\0*\0dev\";b:0;}i:9;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.5.3\";s:10:\"\0*\0package\";E:33:\"Laravel\\Roster\\Enums\\Packages:MCP\";s:14:\"\0*\0packageName\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"0.5.3\";s:6:\"\0*\0dev\";b:1;}i:10;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PINT\";s:14:\"\0*\0packageName\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.27.0\";s:6:\"\0*\0dev\";b:1;}i:11;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:SAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.52.0\";s:6:\"\0*\0dev\";b:1;}i:12;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^4.3\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PEST\";s:14:\"\0*\0packageName\";s:12:\"pestphp/pest\";s:10:\"\0*\0version\";s:5:\"4.3.2\";s:6:\"\0*\0dev\";b:1;}i:13;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"12.5.8\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PHPUNIT\";s:14:\"\0*\0packageName\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:6:\"12.5.8\";s:6:\"\0*\0dev\";b:1;}i:14;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";r:20;s:14:\"\0*\0packageName\";s:16:\"@inertiajs/react\";s:10:\"\0*\0version\";s:6:\"2.3.16\";s:6:\"\0*\0dev\";b:0;}i:15;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:43:\"Laravel\\Roster\\Enums\\Packages:INERTIA_REACT\";s:14:\"\0*\0packageName\";s:16:\"@inertiajs/react\";s:10:\"\0*\0version\";s:6:\"2.3.16\";s:6:\"\0*\0dev\";b:0;}i:16;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:35:\"Laravel\\Roster\\Enums\\Packages:REACT\";s:14:\"\0*\0packageName\";s:5:\"react\";s:10:\"\0*\0version\";s:6:\"19.2.4\";s:6:\"\0*\0dev\";b:0;}i:17;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";r:55;s:14:\"\0*\0packageName\";s:30:\"@laravel/vite-plugin-wayfinder\";s:10:\"\0*\0version\";s:5:\"0.1.7\";s:6:\"\0*\0dev\";b:1;}i:18;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:44:\"Laravel\\Roster\\Enums\\Packages:WAYFINDER_VITE\";s:14:\"\0*\0packageName\";s:30:\"@laravel/vite-plugin-wayfinder\";s:10:\"\0*\0version\";s:5:\"0.1.7\";s:6:\"\0*\0dev\";b:1;}i:19;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:36:\"Laravel\\Roster\\Enums\\Packages:ESLINT\";s:14:\"\0*\0packageName\";s:6:\"eslint\";s:10:\"\0*\0version\";s:6:\"9.39.3\";s:6:\"\0*\0dev\";b:1;}i:20;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:38:\"Laravel\\Roster\\Enums\\Packages:PRETTIER\";s:14:\"\0*\0packageName\";s:8:\"prettier\";s:10:\"\0*\0version\";s:5:\"3.8.1\";s:6:\"\0*\0dev\";b:1;}i:21;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:TAILWINDCSS\";s:14:\"\0*\0packageName\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:5:\"4.2.1\";s:6:\"\0*\0dev\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:21:\"\0*\0nodePackageManager\";E:43:\"Laravel\\Roster\\Enums\\NodePackageManager:NPM\";}s:9:\"timestamp\";i:1773569556;}', 1773655956),
('laravel-cache-settings', 'a:15:{s:14:\"shop.site_name\";a:2:{s:2:\"en\";s:17:\"Duyang vietnam en\";s:2:\"vi\";s:14:\"Duyang vietnam\";}s:14:\"shop.site_logo\";a:2:{s:2:\"en\";i:7;s:2:\"vi\";i:7;}s:15:\"shop.site_email\";a:2:{s:2:\"en\";s:23:\"duyangvietnam@gmail.com\";s:2:\"vi\";s:23:\"duyangvietnam@gmail.com\";}s:15:\"shop.site_phone\";a:2:{s:2:\"en\";s:12:\"0878 989 999\";s:2:\"vi\";s:12:\"0878 989 999\";}s:17:\"shop.site_address\";a:2:{s:2:\"en\";s:73:\"1236 Nguyen Van Linh Street, Thuong Hong Ward, Hung Yen Province, Vietnam\";s:2:\"vi\";s:100:\"Số 1236 Đường Nguyễn Văn Linh, Phường Thượng Hồng,  Tỉnh Hưng Yên, Việt Nam\";}s:21:\"shop.site_description\";a:2:{s:2:\"en\";s:273:\"DUYANG VIETNAM is always ready to support and provide manufacturing solutions tailored to your needs. Please send us your information, and our team will respond promptly with details about our products, production capabilities, as well as OEM/ODM cooperation opportunities.\";s:2:\"vi\";s:310:\"DUYANG VIETNAM luôn sẵn sàng hỗ trợ và tư vấn giải pháp sản xuất phù hợp với nhu cầu của bạn. Hãy gửi thông tin, đội ngũ của chúng tôi sẽ phản hồi nhanh chóng và cung cấp chi tiết về sản phẩm, năng lực sản xuất cũng như hợp tác OEM / ODM.\";}s:13:\"shop.site_map\";a:2:{s:2:\"en\";s:410:\"<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.650484527321!2d106.08016517596784!3d20.92637699128586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a3a8610927eb%3A0x67ec5247515f5685!2sDuyang%20vietnam!5e0!3m2!1svi!2s!4v1772591618809!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>\";s:2:\"vi\";s:410:\"<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.650484527321!2d106.08016517596784!3d20.92637699128586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a3a8610927eb%3A0x67ec5247515f5685!2sDuyang%20vietnam!5e0!3m2!1svi!2s!4v1772591618809!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>\";}s:14:\"shop.bank_info\";a:2:{s:2:\"en\";a:0:{}s:2:\"vi\";a:0:{}}s:8:\"shop.faq\";a:2:{s:2:\"en\";a:5:{i:0;a:2:{s:3:\"key\";s:46:\"Does the factory support packaging and export?\";s:5:\"value\";s:178:\"Yes. We provide packaging solutions, product inspection, container loading, and transportation support according to the requirements of both domestic and international customers.\";}i:1;a:2:{s:3:\"key\";s:45:\"Does the factory accept custom manufacturing?\";s:5:\"value\";s:130:\"Yes. We offer OEM/ODM manufacturing services and can produce according to the customer\'s designs, specifications, or requirements.\";}i:2;a:2:{s:3:\"key\";s:41:\"What is the minimum order quantity (MOQ)?\";s:5:\"value\";s:130:\"The minimum order quantity depends on the type of product and production requirements. Please contact us for detailed information.\";}i:3;a:2:{s:3:\"key\";s:37:\"How long is the production lead time?\";s:5:\"value\";s:151:\"Production time depends on the order quantity and product specifications. Our team will provide a specific timeline after confirming the order details.\";}i:4;a:2:{s:3:\"key\";s:46:\"Does the factory have product quality control?\";s:5:\"value\";s:159:\"Yes. Our factory applies strict quality control processes at every stage of production to ensure that all products meet the required standards before delivery.\";}}s:2:\"vi\";a:5:{i:0;a:2:{s:3:\"key\";s:62:\"Nhà máy có hỗ trợ đóng gói và xuất khẩu không?\";s:5:\"value\";s:173:\"Có. Chúng tôi cung cấp giải pháp đóng gói, kiểm tra, đóng container và hỗ trợ vận chuyển theo yêu cầu của khách hàng trong và ngoài nước.\";}i:1;a:2:{s:3:\"key\";s:57:\"Nhà máy có nhận sản xuất theo yêu cầu không?\";s:5:\"value\";s:0:\"\";}i:2;a:2:{s:3:\"key\";s:56:\"Số lượng đặt hàng tối thiểu là bao nhiêu?\";s:5:\"value\";s:0:\"\";}i:3;a:2:{s:3:\"key\";s:34:\"Thời gian sản xuất bao lâu?\";s:5:\"value\";s:0:\"\";}i:4;a:2:{s:3:\"key\";s:63:\"Nhà máy có kiểm soát chất lượng sản phẩm không?\";s:5:\"value\";s:0:\"\";}}}s:13:\"shop.tax_code\";a:1:{s:2:\"vi\";s:10:\"0901196968\";}s:19:\"shop.representative\";a:1:{s:2:\"vi\";s:26:\"Ông Thạch Công Đồng\";}s:19:\"shop.business_field\";a:2:{s:2:\"en\";s:119:\"Manufacturing of products made from wood, bamboo, rattan, straw, and related materials for industrial and consumer use.\";s:2:\"vi\";s:136:\"Sản xuất các sản phẩm từ gỗ, tre, nứa, rơm, rạ và vật liệu liên quan phục vụ công nghiệp và tiêu dùng.\";}s:18:\"shop.working_hours\";a:2:{s:2:\"en\";a:3:{i:0;a:2:{s:3:\"key\";s:21:\"Monday – Friday😊\";s:5:\"value\";s:19:\"8:00 AM – 5:00 PM\";}i:1;a:2:{s:3:\"key\";s:8:\"Saturday\";s:5:\"value\";s:20:\"8:00 AM – 12:00 AM\";}i:2;a:2:{s:3:\"key\";s:6:\"Sunday\";s:5:\"value\";s:6:\"Closed\";}}s:2:\"vi\";a:3:{i:0;a:2:{s:3:\"key\";s:24:\"Thứ Hai – Thứ Sáu\";s:5:\"value\";s:15:\"08:00 – 17:00\";}i:1;a:2:{s:3:\"key\";s:11:\"Thứ Bảy\";s:5:\"value\";s:15:\"08:00 – 12:00\";}i:2;a:2:{s:3:\"key\";s:12:\"Chủ Nhật\";s:5:\"value\";s:6:\"Nghỉ\";}}}s:12:\"shop.gallery\";a:2:{s:2:\"en\";a:5:{i:0;i:36;i:1;i:37;i:2;i:38;i:3;i:39;i:4;i:40;}s:2:\"vi\";a:5:{i:0;i:36;i:1;i:37;i:2;i:38;i:3;i:39;i:4;i:40;}}s:7:\"__types\";a:2:{s:14:\"shop.site_logo\";s:5:\"image\";s:12:\"shop.gallery\";s:5:\"image\";}}', 1773679385),
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:121:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"View:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:12:\"ViewAny:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"Create:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"Update:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"Delete:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"Restore:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"ForceDelete:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:19:\"ForceDeleteAny:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"RestoreAny:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:14:\"Replicate:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:12:\"Reorder:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:9:\"View:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:12:\"ViewAny:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:11:\"Create:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:11:\"Update:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:11:\"Delete:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:12:\"Restore:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:16:\"ForceDelete:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:19:\"ForceDeleteAny:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:15:\"RestoreAny:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:14:\"Replicate:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:12:\"Reorder:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:9:\"View:Blog\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:12:\"ViewAny:Blog\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:11:\"Create:Blog\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:11:\"Update:Blog\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:11:\"Delete:Blog\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:12:\"Restore:Blog\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:16:\"ForceDelete:Blog\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:19:\"ForceDeleteAny:Blog\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:15:\"RestoreAny:Blog\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:14:\"Replicate:Blog\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:12:\"Reorder:Blog\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:9:\"View:Post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:12:\"ViewAny:Post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:11:\"Create:Post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:11:\"Update:Post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:11:\"Delete:Post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:12:\"Restore:Post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:16:\"ForceDelete:Post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:19:\"ForceDeleteAny:Post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:15:\"RestoreAny:Post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:14:\"Replicate:Post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:12:\"Reorder:Post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:9:\"View:Page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:12:\"ViewAny:Page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:11:\"Create:Page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:11:\"Update:Page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:11:\"Delete:Page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:12:\"Restore:Page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:16:\"ForceDelete:Page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:19:\"ForceDeleteAny:Page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:15:\"RestoreAny:Page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:14:\"Replicate:Page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:12:\"Reorder:Page\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:10:\"View:Order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:13:\"ViewAny:Order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:12:\"Create:Order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:12:\"Update:Order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:12:\"Delete:Order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:13:\"Restore:Order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:17:\"ForceDelete:Order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:20:\"ForceDeleteAny:Order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:16:\"RestoreAny:Order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:15:\"Replicate:Order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:13:\"Reorder:Order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:14:\"View:OrderItem\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:17:\"ViewAny:OrderItem\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:16:\"Create:OrderItem\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:16:\"Update:OrderItem\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:16:\"Delete:OrderItem\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:17:\"Restore:OrderItem\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:21:\"ForceDelete:OrderItem\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:24:\"ForceDeleteAny:OrderItem\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:20:\"RestoreAny:OrderItem\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:19:\"Replicate:OrderItem\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:17:\"Reorder:OrderItem\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:15:\"View:Collection\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:18:\"ViewAny:Collection\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:17:\"Create:Collection\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:17:\"Update:Collection\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:81;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:17:\"Delete:Collection\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:82;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:18:\"Restore:Collection\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:83;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:22:\"ForceDelete:Collection\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:84;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:25:\"ForceDeleteAny:Collection\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:85;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:21:\"RestoreAny:Collection\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:86;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:20:\"Replicate:Collection\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:87;a:4:{s:1:\"a\";i:88;s:1:\"b\";s:18:\"Reorder:Collection\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:88;a:4:{s:1:\"a\";i:89;s:1:\"b\";s:12:\"View:Product\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:89;a:4:{s:1:\"a\";i:90;s:1:\"b\";s:15:\"ViewAny:Product\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:90;a:4:{s:1:\"a\";i:91;s:1:\"b\";s:14:\"Create:Product\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:91;a:4:{s:1:\"a\";i:92;s:1:\"b\";s:14:\"Update:Product\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:92;a:4:{s:1:\"a\";i:93;s:1:\"b\";s:14:\"Delete:Product\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:93;a:4:{s:1:\"a\";i:94;s:1:\"b\";s:15:\"Restore:Product\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:94;a:4:{s:1:\"a\";i:95;s:1:\"b\";s:19:\"ForceDelete:Product\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:95;a:4:{s:1:\"a\";i:96;s:1:\"b\";s:22:\"ForceDeleteAny:Product\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:96;a:4:{s:1:\"a\";i:97;s:1:\"b\";s:18:\"RestoreAny:Product\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:97;a:4:{s:1:\"a\";i:98;s:1:\"b\";s:17:\"Replicate:Product\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:98;a:4:{s:1:\"a\";i:99;s:1:\"b\";s:15:\"Reorder:Product\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:99;a:4:{s:1:\"a\";i:100;s:1:\"b\";s:13:\"View:Showcase\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:100;a:4:{s:1:\"a\";i:101;s:1:\"b\";s:16:\"ViewAny:Showcase\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:101;a:4:{s:1:\"a\";i:102;s:1:\"b\";s:15:\"Create:Showcase\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:102;a:4:{s:1:\"a\";i:103;s:1:\"b\";s:15:\"Update:Showcase\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:103;a:4:{s:1:\"a\";i:104;s:1:\"b\";s:15:\"Delete:Showcase\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:104;a:4:{s:1:\"a\";i:105;s:1:\"b\";s:16:\"Restore:Showcase\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:105;a:4:{s:1:\"a\";i:106;s:1:\"b\";s:20:\"ForceDelete:Showcase\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:106;a:4:{s:1:\"a\";i:107;s:1:\"b\";s:23:\"ForceDeleteAny:Showcase\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:107;a:4:{s:1:\"a\";i:108;s:1:\"b\";s:19:\"RestoreAny:Showcase\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:108;a:4:{s:1:\"a\";i:109;s:1:\"b\";s:18:\"Replicate:Showcase\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:109;a:4:{s:1:\"a\";i:110;s:1:\"b\";s:16:\"Reorder:Showcase\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:110;a:4:{s:1:\"a\";i:111;s:1:\"b\";s:21:\"ViewAny:ProductReview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:111;a:4:{s:1:\"a\";i:112;s:1:\"b\";s:18:\"View:ProductReview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:112;a:4:{s:1:\"a\";i:113;s:1:\"b\";s:20:\"Create:ProductReview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:113;a:4:{s:1:\"a\";i:114;s:1:\"b\";s:20:\"Update:ProductReview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:114;a:4:{s:1:\"a\";i:115;s:1:\"b\";s:20:\"Delete:ProductReview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:115;a:4:{s:1:\"a\";i:116;s:1:\"b\";s:21:\"Restore:ProductReview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:116;a:4:{s:1:\"a\";i:117;s:1:\"b\";s:25:\"ForceDelete:ProductReview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:117;a:4:{s:1:\"a\";i:118;s:1:\"b\";s:28:\"ForceDeleteAny:ProductReview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:118;a:4:{s:1:\"a\";i:119;s:1:\"b\";s:24:\"RestoreAny:ProductReview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:119;a:4:{s:1:\"a\";i:120;s:1:\"b\";s:23:\"Replicate:ProductReview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:120;a:4:{s:1:\"a\";i:121;s:1:\"b\";s:21:\"Reorder:ProductReview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:3:\"web\";}}}', 1773656617);

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
(1, '{\"en\": \"\", \"vi\": \"Móc gỗ\"}', '{\"en\": \"\", \"vi\": \"moc-go\"}', '{\"en\": \"\", \"vi\": \"Sản xuất từ gỗ tự nhiên và gỗ công nghiệp, xử lý bề mặt kỹ lưỡng, đảm bảo độ bền và tính thẩm mỹ. Bao gồm móc treo gỗ, phụ kiện nội thất.\"}', 'active', '2026-03-02 06:41:18', '2026-03-15 07:52:47'),
(2, '{\"en\": \"\", \"vi\": \"Móc Sắt\"}', '{\"en\": \"\", \"vi\": \"moc-sat\"}', '{\"en\": \"\", \"vi\": \"Sản xuất từ gỗ tự nhiên và gỗ công nghiệp, xử lý bề mặt kỹ lưỡng, đảm bảo độ bền và tính thẩm mỹ. Bao gồm móc treo gỗ, phụ kiện nội thất.\"}', 'active', '2026-03-03 05:01:07', '2026-03-15 07:52:54'),
(3, '{\"en\": \"\", \"vi\": \"Móc nhựa\"}', '{\"en\": \"\", \"vi\": \"moc-nhua\"}', '{\"en\": \"\", \"vi\": \"Sản xuất từ gỗ tự nhiên và gỗ công nghiệp, xử lý bề mặt kỹ lưỡng, đảm bảo độ bền và tính thẩm mỹ. Bao gồm móc treo gỗ, phụ kiện nội thất.\"}', 'active', '2026-03-03 05:01:19', '2026-03-15 07:52:56'),
(4, '{\"en\": \"\", \"vi\": \"Nền Gỗ Nhà\"}', '{\"en\": \"\", \"vi\": \"nen-go-nha\"}', '{\"en\": \"\", \"vi\": \"Sản xuất từ gỗ tự nhiên và gỗ công nghiệp, xử lý bề mặt kỹ lưỡng, đảm bảo độ bền và tính thẩm mỹ. Bao gồm móc treo gỗ, phụ kiện nội thất.\"}', 'active', '2026-03-03 05:45:38', '2026-03-15 07:52:58'),
(5, '{\"en\": \"\", \"vi\": \"Nền Vườn \"}', '{\"en\": \"\", \"vi\": \"nen-vuon\"}', '{\"en\": \"\", \"vi\": \"Sản xuất từ gỗ tự nhiên và gỗ công nghiệp, xử lý bề mặt kỹ lưỡng, đảm bảo độ bền và tính thẩm mỹ. Bao gồm móc treo gỗ, phụ kiện nội thất.\"}', 'active', '2026-03-03 05:45:48', '2026-03-15 07:53:00');

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
(6, NULL, '7e563999d2a62d1b82ec1e1b5bf84cbdbb5879b8', 'f126a28f-6b3d-475e-83e2-e3e17355c839.jpg', 'image/jpeg', 7952908, 4096, 2286, 4, '{\"original_name\": \"7e563999d2a62d1b82ec1e1b5bf84cbdbb5879b8.jpg\"}', '{\"Post_image_thumb\": {\"width\": 300, \"height\": 167, \"file_name\": \"b56e2135-4408-43b5-919b-e242f902e1b7-thumb.jpg\", \"generated_at\": \"2026-02-28 06:25:13\"}}', '2026-02-27 23:25:12', '2026-02-27 23:25:13'),
(7, NULL, 'logo', 'd32024d6-ccf4-4da6-8fbe-8274331c0498.png', 'image/png', 1625, 193, 28, 8, '{\"caption\": \"\", \"alt_text\": \"\", \"original_name\": \"Type=Main.png\"}', '[]', '2026-02-28 01:28:59', '2026-03-01 08:42:28'),
(8, NULL, 'e6c5787eb052c580ce17917e529208e4c0f46ec5', '8c94292f-374a-4848-8973-8b02003bd57c.jpg', 'image/jpeg', 2262836, 2048, 2048, 6, '{\"original_name\": \"e6c5787eb052c580ce17917e529208e4c0f46ec5.jpg\"}', '{\"Product_images_thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"8ceee387-ba1e-4bdf-9065-2e9a225b8e82-thumb.jpg\", \"generated_at\": \"2026-03-04 02:24:06\"}}', '2026-03-01 07:34:36', '2026-03-03 19:24:06'),
(9, NULL, '5bba7b68c4d86f2160216aca09c791b7996f359f', 'e080c7ae-7ac2-45a9-a105-fc9b689eca2c.jpg', 'image/jpeg', 59400, 449, 370, 9, '{\"original_name\": \"5bba7b68c4d86f2160216aca09c791b7996f359f.jpg\"}', '[]', '2026-03-02 06:19:45', '2026-03-02 06:19:45'),
(10, NULL, '021b7615866d560d7c3059c43de2dbc1c733ac19', '799ca195-1422-462c-8123-5da3bcd75fed.jpg', 'image/jpeg', 2817796, 2048, 2048, 9, '{\"original_name\": \"021b7615866d560d7c3059c43de2dbc1c733ac19.jpg\"}', '[]', '2026-03-02 06:19:45', '2026-03-02 06:19:45'),
(11, NULL, 'a3fa495e7cd7f0f7b69bb6068f3d183d5bcbd324', '5dd53b2a-9362-4d91-8128-c42da66ac208.jpg', 'image/jpeg', 2823393, 2048, 2048, 9, '{\"original_name\": \"a3fa495e7cd7f0f7b69bb6068f3d183d5bcbd324.jpg\"}', '[]', '2026-03-02 06:19:45', '2026-03-02 06:19:45'),
(12, NULL, '039e703958319fdbb65073e4c71617e80613a6ac', '881adc69-eade-4d99-b63f-13424493826d.jpg', 'image/jpeg', 2848535, 2048, 2048, 9, '{\"original_name\": \"039e703958319fdbb65073e4c71617e80613a6ac.jpg\"}', '[]', '2026-03-02 06:19:45', '2026-03-02 06:19:45'),
(13, NULL, '31bbdfd72dabc42ce0f484ed673a9eeed04b7058', 'b80b29f1-54a5-45c4-9848-cadc01629251.jpg', 'image/jpeg', 2810155, 2048, 2048, 9, '{\"original_name\": \"31bbdfd72dabc42ce0f484ed673a9eeed04b7058.jpg\"}', '[]', '2026-03-02 06:19:45', '2026-03-02 06:19:45'),
(14, NULL, '6ae6a8154b8da77d5497136c18e9cf950cb465fc', '196a1a4c-e587-4769-9bf4-79dba3d6871f.jpg', 'image/jpeg', 2295717, 2048, 2048, 6, '{\"original_name\": \"6ae6a8154b8da77d5497136c18e9cf950cb465fc.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"466215c5-954a-4be9-96bf-6a17bcc47a98-thumb.jpg\", \"generated_at\": \"2026-03-02 13:24:40\"}}', '2026-03-02 06:24:40', '2026-03-02 06:24:40'),
(15, NULL, '5a3cf0419bb4081aeab37817439286ed84ab4a9e', '91fc82b9-800a-4b0a-91d3-74eb8c2844c3.jpg', 'image/jpeg', 2369474, 2048, 2048, 6, '{\"original_name\": \"5a3cf0419bb4081aeab37817439286ed84ab4a9e.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"9d6e9acb-2df1-4ac5-a6e6-865c6e23bbdc-thumb.jpg\", \"generated_at\": \"2026-03-03 12:48:51\"}}', '2026-03-03 05:48:51', '2026-03-03 05:48:51'),
(16, NULL, '5fcb1ad8aff20a1a9fb65a57cf8b4281d7241dc0', 'efc0bd4c-818a-4c0b-8f66-aef254f7eb51.jpg', 'image/jpeg', 2345502, 2048, 2048, 6, '{\"original_name\": \"5fcb1ad8aff20a1a9fb65a57cf8b4281d7241dc0.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"1e03364f-6c8c-4a02-b098-06c592a646de-thumb.jpg\", \"generated_at\": \"2026-03-03 12:49:15\"}}', '2026-03-03 05:49:15', '2026-03-03 05:49:15'),
(17, NULL, 'b612c9b432fdc4433a5f08cd57ccd4d70349ff17 (1)', '10130174-f160-4be2-afd5-b54f9efbc43a.jpg', 'image/jpeg', 2222867, 2048, 2048, 6, '{\"original_name\": \"b612c9b432fdc4433a5f08cd57ccd4d70349ff17 (1).jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"a30b924b-cd47-4cd1-b748-5dc4361eb5fc-thumb.jpg\", \"generated_at\": \"2026-03-03 12:57:05\"}}', '2026-03-03 05:57:05', '2026-03-03 05:57:05'),
(18, NULL, '526a70dca49582b88c4598820336312a9fd43e95', 'd8369cad-6c16-4e79-9deb-c8512823d1f3.jpg', 'image/jpeg', 2092102, 2048, 2048, 6, '{\"original_name\": \"526a70dca49582b88c4598820336312a9fd43e95.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"184dfdcd-34ad-4294-9c72-0d76844b598e-thumb.jpg\", \"generated_at\": \"2026-03-03 12:58:44\"}}', '2026-03-03 05:58:44', '2026-03-03 05:58:44'),
(19, NULL, 'd09371d8d3c38a892b0b7737b6833038a24fccec', '759fe7fd-cb4d-4a0f-bfd7-e50b59a5d429.jpg', 'image/jpeg', 2327548, 2048, 2048, 6, '{\"original_name\": \"d09371d8d3c38a892b0b7737b6833038a24fccec.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"cc8ee581-52d2-448e-b241-93c117a5f7d0-thumb.jpg\", \"generated_at\": \"2026-03-03 12:59:09\"}}', '2026-03-03 05:59:09', '2026-03-03 05:59:09'),
(20, NULL, 'fa618adb51d3d70aaf107893f73c75de08d7081f', '8a6d2e30-b7dd-4d23-80be-138ee3e4f859.jpg', 'image/jpeg', 2431464, 2048, 2048, 6, '{\"original_name\": \"fa618adb51d3d70aaf107893f73c75de08d7081f.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 400, \"file_name\": \"5c714d15-14a0-4a1c-b997-16afb4cfd9f5-thumb.jpg\", \"generated_at\": \"2026-03-03 12:59:28\"}}', '2026-03-03 05:59:28', '2026-03-03 05:59:28'),
(21, NULL, '0ba21c9b65cab097d45b9f0223d46b2e3a36533d', '3ac1092e-8ada-4903-9fe8-34ee227dd8d8.jpg', 'image/jpeg', 2593577, 2336, 1824, 6, '{\"original_name\": \"0ba21c9b65cab097d45b9f0223d46b2e3a36533d.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 312, \"file_name\": \"ea9332b5-2f69-4725-9fb5-598ab9097988-thumb.jpg\", \"generated_at\": \"2026-03-03 13:03:31\"}}', '2026-03-03 06:03:31', '2026-03-03 06:03:31'),
(22, NULL, '9fdb59f22192e23f462b098875dc4028acfbec2c', 'b74116ae-cc05-4d3c-9722-799837ddae18.png', 'image/png', 2046055, 1024, 1536, 6, '{\"original_name\": \"9fdb59f22192e23f462b098875dc4028acfbec2c.png\"}', '{\"thumb\": {\"width\": 267, \"height\": 400, \"file_name\": \"49c6a7d7-b1c0-4cef-be60-35796719c9e7-thumb.png\", \"generated_at\": \"2026-03-03 13:05:35\"}}', '2026-03-03 06:05:35', '2026-03-03 06:05:35'),
(23, NULL, 'a83d42efd7c1a0a940b92bd7a567433086619d5a', '1d438d82-2b9c-4ded-8a5c-7cdbe8303457.jpg', 'image/jpeg', 2683674, 2240, 1888, 6, '{\"original_name\": \"a83d42efd7c1a0a940b92bd7a567433086619d5a.jpg\"}', '{\"thumb\": {\"width\": 400, \"height\": 337, \"file_name\": \"8d7cedf5-f2e3-4170-889c-8d43eb0ca17f-thumb.jpg\", \"generated_at\": \"2026-03-03 13:07:58\"}}', '2026-03-03 06:07:58', '2026-03-03 06:07:58'),
(24, NULL, '17009799db827ffdf98ca25ee7d8c4e063b086a3', '02cab8d0-2d99-404e-8fe7-6bbe5a35159b.jpg', 'image/jpeg', 7748106, 4096, 2286, 4, '{\"original_name\": \"17009799db827ffdf98ca25ee7d8c4e063b086a3.jpg\"}', '{\"thumb\": {\"width\": 300, \"height\": 167, \"file_name\": \"aca9d34d-3f26-4688-82ba-12f546513880-thumb.jpg\", \"generated_at\": \"2026-03-03 13:16:42\"}}', '2026-03-03 06:16:41', '2026-03-03 06:16:42'),
(25, NULL, '7e563999d2a62d1b82ec1e1b5bf84cbdbb5879b8 (1)', '87f8196a-3872-4364-8ae1-d49d791e1e22.jpg', 'image/jpeg', 7952908, 4096, 2286, 4, '{\"original_name\": \"7e563999d2a62d1b82ec1e1b5bf84cbdbb5879b8 (1).jpg\"}', '{\"thumb\": {\"width\": 300, \"height\": 167, \"file_name\": \"954edf3d-c0b9-44df-ab94-8511f4763833-thumb.jpg\", \"generated_at\": \"2026-03-03 13:18:33\"}}', '2026-03-03 06:18:33', '2026-03-03 06:18:33'),
(26, NULL, 'b373a1330a04231203ac6d2be2d4c707918c1f18', '61a1110c-d706-48d4-8276-5ad8f678126d.jpg', 'image/jpeg', 1083923, 1376, 767, 4, '{\"original_name\": \"b373a1330a04231203ac6d2be2d4c707918c1f18.jpg\"}', '{\"thumb\": {\"width\": 300, \"height\": 167, \"file_name\": \"23b279dc-4fb1-465f-bbc1-0811e5cad2ba-thumb.jpg\", \"generated_at\": \"2026-03-03 13:24:32\"}}', '2026-03-03 06:24:32', '2026-03-03 06:24:32'),
(27, NULL, '4a76d5a95f0bbe507886a27bd3fab76e7427894b', '59ca2375-61c0-4df5-9318-61522a092c2e.png', 'image/png', 1205197, 1152, 896, 6, '{\"original_name\": \"4a76d5a95f0bbe507886a27bd3fab76e7427894b.png\"}', '{\"Product_images_thumb\": {\"width\": 400, \"height\": 311, \"file_name\": \"bae9175f-49b6-4f9b-8e80-be2eaac0ce33-thumb.png\", \"generated_at\": \"2026-03-09 16:18:03\"}}', '2026-03-09 09:17:53', '2026-03-09 09:18:03'),
(28, NULL, '0a9bfee0a5dffefe7909e9310a0a844cd957846c', 'af1be88d-4d98-4dde-a986-61a99d88515d.jpg', 'image/jpeg', 2496408, 2336, 1824, 6, '{\"original_name\": \"0a9bfee0a5dffefe7909e9310a0a844cd957846c.jpg\"}', '{\"Product_images_thumb\": {\"width\": 400, \"height\": 312, \"file_name\": \"1212fc70-c8c5-494b-af54-794ea3eff209-thumb.jpg\", \"generated_at\": \"2026-03-09 16:18:03\"}}', '2026-03-09 09:17:53', '2026-03-09 09:18:03'),
(29, NULL, '29a00070270fc5c97a517e84d73b8ab5211ae87f', 'c0aff48c-c0f5-47a5-acd5-a9bfd4c4b8ab.png', 'image/png', 1316614, 1152, 896, 6, '{\"original_name\": \"29a00070270fc5c97a517e84d73b8ab5211ae87f.png\"}', '{\"Product_images_thumb\": {\"width\": 400, \"height\": 311, \"file_name\": \"d6777395-3703-439a-8a62-837b407b8e96-thumb.png\", \"generated_at\": \"2026-03-09 16:18:03\"}}', '2026-03-09 09:17:54', '2026-03-09 09:18:04'),
(30, NULL, '3703c665e74e51eb4bb29b5159738ec42e1d76ba', '990c50e2-e32a-4080-87e2-65642232a99f.jpg', 'image/jpeg', 7430346, 4096, 2286, 4, '{\"original_name\": \"3703c665e74e51eb4bb29b5159738ec42e1d76ba.jpg\"}', '{\"Post_image_thumb\": {\"width\": 300, \"height\": 167, \"file_name\": \"6608d9d7-9dbd-4bb3-8a45-6e604f9cb58f-thumb.jpg\", \"generated_at\": \"2026-03-12 16:01:50\"}}', '2026-03-12 09:01:41', '2026-03-12 09:01:50'),
(31, NULL, '9b084a6a44882d90c45fcf4b6354a44072ddafcd', 'fb8924ee-0874-4a27-baec-9d31340a0dc5.jpg', 'image/jpeg', 8798735, 4096, 2286, 4, '{\"original_name\": \"9b084a6a44882d90c45fcf4b6354a44072ddafcd.jpg\"}', '{\"Post_image_thumb\": {\"width\": 300, \"height\": 167, \"file_name\": \"e3c64d5b-070c-4960-bf70-58018ac41412-thumb.jpg\", \"generated_at\": \"2026-03-13 12:48:46\"}}', '2026-03-12 09:21:17', '2026-03-13 05:48:46'),
(32, NULL, '50b8a907fd92d1f8fea4ab1503bf21ec622002e7', '6aa41cff-f259-460f-8f44-05a03b2b7a17.jpg', 'image/jpeg', 8402667, 4096, 2286, 10, '{\"original_name\": \"50b8a907fd92d1f8fea4ab1503bf21ec622002e7.jpg\"}', '[]', '2026-03-13 05:21:47', '2026-03-13 05:21:47'),
(33, NULL, '19235f544e6c9f2085ba77dd87344aa28ea14eb0', 'f07a8466-42a3-4cf7-8ede-5045b6ecd20f.jpg', 'image/jpeg', 8430099, 4096, 2286, 10, '{\"original_name\": \"19235f544e6c9f2085ba77dd87344aa28ea14eb0.jpg\"}', '[]', '2026-03-13 05:27:42', '2026-03-13 05:27:42'),
(34, NULL, 'd0cb8afa7f607cbc44d59758abf067873d07107a', 'dba697ef-9651-4f86-b0f7-f90854f8cbc3.jpg', 'image/jpeg', 9084115, 4096, 2286, 10, '{\"original_name\": \"d0cb8afa7f607cbc44d59758abf067873d07107a.jpg\"}', '[]', '2026-03-13 05:34:07', '2026-03-13 05:34:07'),
(35, NULL, '828df44a15a4f16450678af6454b7a5e11179011', 'd36e4ddb-4ae3-4bd0-a455-39da6a817521.jpg', 'image/jpeg', 2504847, 3168, 1344, 10, '{\"original_name\": \"828df44a15a4f16450678af6454b7a5e11179011.jpg\"}', '[]', '2026-03-13 05:37:21', '2026-03-13 05:37:21'),
(36, NULL, '5', '181a618e-c899-4f9f-9a3b-70396a28bba3.jpg', 'image/jpeg', 2381498, 4000, 2667, 11, '{\"original_name\": \"5.jpg\"}', '[]', '2026-03-15 09:41:05', '2026-03-15 09:41:05'),
(37, NULL, '4', '69c23ca2-9f1d-459b-acda-b5c71a091644.jpg', 'image/jpeg', 5270910, 4096, 2770, 11, '{\"original_name\": \"4.jpg\"}', '[]', '2026-03-15 09:41:05', '2026-03-15 09:41:05'),
(38, NULL, '3', '327b7c5c-c757-4220-8561-57ef842b8410.jpg', 'image/jpeg', 5988594, 4096, 2296, 11, '{\"original_name\": \"3.jpg\"}', '[]', '2026-03-15 09:41:05', '2026-03-15 09:41:05'),
(39, NULL, '2', '24877d4a-44cc-46d9-bf3d-e5d3a8526b99.jpg', 'image/jpeg', 8756301, 4000, 3500, 11, '{\"original_name\": \"2.jpg\"}', '[]', '2026-03-15 09:41:05', '2026-03-15 09:41:05'),
(40, NULL, '1', '08df0bf0-2e1f-4241-a7b7-9b1279666149.jpg', 'image/jpeg', 3293087, 4096, 2296, 11, '{\"original_name\": \"1.jpg\"}', '[]', '2026-03-15 09:41:05', '2026-03-15 09:41:05');

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
(2, 6, 'App\\Models\\Post', 1, 'image', 0, NULL, NULL),
(11, 14, 'App\\Models\\Product', 2, 'images', 0, NULL, NULL),
(12, 15, 'App\\Models\\Product', 3, 'images', 0, NULL, NULL),
(13, 16, 'App\\Models\\Product', 4, 'images', 0, NULL, NULL),
(16, 17, 'App\\Models\\Product', 5, 'images', 0, NULL, NULL),
(17, 18, 'App\\Models\\Product', 6, 'images', 0, NULL, NULL),
(18, 19, 'App\\Models\\Product', 7, 'images', 0, NULL, NULL),
(19, 20, 'App\\Models\\Product', 8, 'images', 0, NULL, NULL),
(20, 21, 'App\\Models\\Product', 9, 'images', 0, NULL, NULL),
(23, 22, 'App\\Models\\Product', 10, 'images', 0, NULL, NULL),
(26, 25, 'App\\Models\\Post', 3, 'image', 0, NULL, NULL),
(27, 26, 'App\\Models\\Post', 4, 'image', 0, NULL, NULL),
(31, 8, 'App\\Models\\Product', 1, 'images', 0, NULL, NULL),
(33, 27, 'App\\Models\\Product', 11, 'images', 1, NULL, NULL),
(34, 28, 'App\\Models\\Product', 11, 'images', 2, NULL, NULL),
(35, 29, 'App\\Models\\Product', 11, 'images', 3, NULL, NULL),
(36, 23, 'App\\Models\\Product', 11, 'images', 0, NULL, NULL),
(55, 33, 'App\\Models\\Page', 2, 'image', 0, NULL, NULL),
(59, 32, 'App\\Models\\Page', 1, 'image', 0, NULL, NULL),
(64, 32, 'App\\Models\\Page', 3, 'image', 0, NULL, NULL),
(69, 34, 'App\\Models\\Page', 4, 'image', 0, NULL, NULL),
(72, 35, 'App\\Models\\Page', 5, 'image', 0, NULL, NULL),
(84, 31, 'App\\Models\\Post', 2, 'image_id', 0, NULL, NULL),
(86, 24, 'App\\Models\\Post', 2, 'image', 0, NULL, NULL),
(88, 13, 'App\\Models\\Collection', 1, 'image', 0, NULL, NULL),
(90, 12, 'App\\Models\\Collection', 2, 'image', 0, NULL, NULL),
(92, 11, 'App\\Models\\Collection', 3, 'image', 0, NULL, NULL),
(94, 10, 'App\\Models\\Collection', 4, 'image', 0, NULL, NULL),
(96, 9, 'App\\Models\\Collection', 5, 'image', 0, NULL, NULL);

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
(4, 'Bài viết', 'posts', NULL, '2026-02-27 23:24:46', '2026-02-27 23:27:16'),
(6, 'Sản phẩm', 'products', NULL, '2026-02-27 23:31:49', '2026-02-27 23:53:23'),
(8, 'Cài đặt', 'settings', NULL, '2026-02-28 01:28:54', '2026-03-01 08:42:08'),
(9, 'Danh mục sản phẩm', 'collections', NULL, '2026-03-02 06:19:25', '2026-03-13 05:22:59'),
(10, 'Trang', 'pages', NULL, '2026-03-13 05:21:42', '2026-03-13 05:22:48'),
(11, 'gallery', 'settings/gallery', 8, '2026-03-15 09:40:27', '2026-03-15 09:40:27');

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
(29, '2026_03_03_131057_create_product_reviews_table', 2),
(30, '2026_03_03_142145_add_specifications_to_products_table', 3),
(31, '2026_03_04_025738_create_contacts_table', 4),
(32, '2026_03_04_062915_add_type_to_settings_table', 5),
(33, '2026_03_12_135826_add_blocks_to_posts_table', 6),
(34, '2026_03_13_121013_add_page_type_to_pages_table', 7);

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
(1, 'App\\Models\\User', 1);

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
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft' COMMENT 'draft, reviewing, published, rejected',
  `page_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'regular' COMMENT 'regular: accessible by slug and shown in lists; system: special pages like home, about',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'View:Role', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(2, 'ViewAny:Role', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(3, 'Create:Role', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(4, 'Update:Role', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(5, 'Delete:Role', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(6, 'Restore:Role', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(7, 'ForceDelete:Role', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(8, 'ForceDeleteAny:Role', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(9, 'RestoreAny:Role', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(10, 'Replicate:Role', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(11, 'Reorder:Role', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(12, 'View:User', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(13, 'ViewAny:User', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(14, 'Create:User', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(15, 'Update:User', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(16, 'Delete:User', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(17, 'Restore:User', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(18, 'ForceDelete:User', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(19, 'ForceDeleteAny:User', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(20, 'RestoreAny:User', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(21, 'Replicate:User', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(22, 'Reorder:User', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(23, 'View:Blog', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(24, 'ViewAny:Blog', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(25, 'Create:Blog', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(26, 'Update:Blog', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(27, 'Delete:Blog', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(28, 'Restore:Blog', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(29, 'ForceDelete:Blog', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(30, 'ForceDeleteAny:Blog', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(31, 'RestoreAny:Blog', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(32, 'Replicate:Blog', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(33, 'Reorder:Blog', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(34, 'View:Post', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(35, 'ViewAny:Post', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(36, 'Create:Post', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(37, 'Update:Post', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(38, 'Delete:Post', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(39, 'Restore:Post', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(40, 'ForceDelete:Post', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(41, 'ForceDeleteAny:Post', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(42, 'RestoreAny:Post', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(43, 'Replicate:Post', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(44, 'Reorder:Post', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(45, 'View:Page', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(46, 'ViewAny:Page', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(47, 'Create:Page', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(48, 'Update:Page', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(49, 'Delete:Page', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(50, 'Restore:Page', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(51, 'ForceDelete:Page', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(52, 'ForceDeleteAny:Page', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(53, 'RestoreAny:Page', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(54, 'Replicate:Page', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(55, 'Reorder:Page', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(56, 'View:Order', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(57, 'ViewAny:Order', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(58, 'Create:Order', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(59, 'Update:Order', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(60, 'Delete:Order', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(61, 'Restore:Order', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(62, 'ForceDelete:Order', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(63, 'ForceDeleteAny:Order', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(64, 'RestoreAny:Order', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(65, 'Replicate:Order', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(66, 'Reorder:Order', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(67, 'View:OrderItem', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(68, 'ViewAny:OrderItem', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(69, 'Create:OrderItem', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(70, 'Update:OrderItem', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(71, 'Delete:OrderItem', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(72, 'Restore:OrderItem', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(73, 'ForceDelete:OrderItem', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(74, 'ForceDeleteAny:OrderItem', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(75, 'RestoreAny:OrderItem', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(76, 'Replicate:OrderItem', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(77, 'Reorder:OrderItem', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(78, 'View:Collection', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(79, 'ViewAny:Collection', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(80, 'Create:Collection', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(81, 'Update:Collection', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(82, 'Delete:Collection', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(83, 'Restore:Collection', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(84, 'ForceDelete:Collection', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(85, 'ForceDeleteAny:Collection', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(86, 'RestoreAny:Collection', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(87, 'Replicate:Collection', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(88, 'Reorder:Collection', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(89, 'View:Product', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(90, 'ViewAny:Product', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(91, 'Create:Product', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(92, 'Update:Product', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(93, 'Delete:Product', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(94, 'Restore:Product', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(95, 'ForceDelete:Product', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(96, 'ForceDeleteAny:Product', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(97, 'RestoreAny:Product', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(98, 'Replicate:Product', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(99, 'Reorder:Product', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(100, 'View:Showcase', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(101, 'ViewAny:Showcase', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(102, 'Create:Showcase', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(103, 'Update:Showcase', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(104, 'Delete:Showcase', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(105, 'Restore:Showcase', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(106, 'ForceDelete:Showcase', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(107, 'ForceDeleteAny:Showcase', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(108, 'RestoreAny:Showcase', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(109, 'Replicate:Showcase', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(110, 'Reorder:Showcase', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(111, 'ViewAny:ProductReview', 'web', '2026-03-03 06:40:50', '2026-03-03 06:40:50'),
(112, 'View:ProductReview', 'web', '2026-03-03 06:40:50', '2026-03-03 06:40:50'),
(113, 'Create:ProductReview', 'web', '2026-03-03 06:40:50', '2026-03-03 06:40:50'),
(114, 'Update:ProductReview', 'web', '2026-03-03 06:40:50', '2026-03-03 06:40:50'),
(115, 'Delete:ProductReview', 'web', '2026-03-03 06:40:50', '2026-03-03 06:40:50'),
(116, 'Restore:ProductReview', 'web', '2026-03-03 06:40:50', '2026-03-03 06:40:50'),
(117, 'ForceDelete:ProductReview', 'web', '2026-03-03 06:40:50', '2026-03-03 06:40:50'),
(118, 'ForceDeleteAny:ProductReview', 'web', '2026-03-03 06:40:50', '2026-03-03 06:40:50'),
(119, 'RestoreAny:ProductReview', 'web', '2026-03-03 06:40:50', '2026-03-03 06:40:50'),
(120, 'Replicate:ProductReview', 'web', '2026-03-03 06:40:50', '2026-03-03 06:40:50'),
(121, 'Reorder:ProductReview', 'web', '2026-03-03 06:40:50', '2026-03-03 06:40:50');

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
  `blocks` json DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft' COMMENT 'draft, reviewing, published, rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `description`, `content`, `blocks`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"vi\": \"Cập Nhật Tiến Độ Sản Xuất Đơn Hàng\"}', '{\"vi\": \"cap-nhat-tien-do-san-xuat-don-hang\"}', '{\"vi\": \"Thông tin về quá trình sản xuất, kiểm tra chất lượng và hoàn thiện đơn hàng trước khi xuất xưởng.\"}', '{\"vi\": \"<p></p>\"}', NULL, 'published', '2026-02-27 23:25:19', '2026-02-27 23:25:19'),
(2, '{\"en\": \"\", \"vi\": \"Hoạt Động Đóng Gói & Xuất Hàng\"}', '{\"en\": \"\", \"vi\": \"hoat-dong-dong-goi-xuat-hang\"}', '{\"en\": \"\", \"vi\": \"Environmentalists have consistently raised concerns about the beauty industry\'s ecological impact, citing problems like excessive packaging and the incorporation of harmful chemicals in its products.\"}', '{\"en\": \"\", \"vi\": \"<div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;right&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;T\\\\u1ea1i DUYANG VIETNAM, c\\\\u00f4ng \\\\u0111o\\\\u1ea1n \\\\u0111\\\\u00f3ng g\\\\u00f3i v\\\\u00e0 xu\\\\u1ea5t h\\\\u00e0ng \\\\u0111\\\\u00f3ng vai tr\\\\u00f2 quan tr\\\\u1ecdng trong to\\\\u00e0n b\\\\u1ed9 chu\\\\u1ed7i s\\\\u1ea3n xu\\\\u1ea5t, nh\\\\u1eb1m \\\\u0111\\\\u1ea3m b\\\\u1ea3o s\\\\u1ea3n ph\\\\u1ea9m \\\\u0111\\\\u01b0\\\\u1ee3c b\\\\u00e0n giao \\\\u0111\\\\u1ebfn \\\\u0111\\\\u1ed1i t\\\\u00e1c trong tr\\\\u1ea1ng th\\\\u00e1i an to\\\\u00e0n, nguy\\\\u00ean v\\\\u1eb9n v\\\\u00e0 \\\\u0111\\\\u00fang ti\\\\u00eau chu\\\\u1ea9n k\\\\u1ef9 thu\\\\u1eadt. M\\\\u1ed7i l\\\\u00f4 h\\\\u00e0ng tr\\\\u01b0\\\\u1edbc khi r\\\\u1eddi kh\\\\u1ecfi nh\\\\u00e0 m\\\\u00e1y \\\\u0111\\\\u1ec1u \\\\u0111\\\\u01b0\\\\u1ee3c ki\\\\u1ec3m tra k\\\\u1ef9 l\\\\u01b0\\\\u1ee1ng v\\\\u1ec1 ch\\\\u1ea5t l\\\\u01b0\\\\u1ee3ng, s\\\\u1ed1 l\\\\u01b0\\\\u1ee3ng, quy c\\\\u00e1ch \\\\u0111\\\\u00f3ng g\\\\u00f3i v\\\\u00e0 \\\\u0111i\\\\u1ec1u ki\\\\u1ec7n v\\\\u1eadn chuy\\\\u1ec3n, \\\\u0111\\\\u1ea3m b\\\\u1ea3o \\\\u0111\\\\u00e1p \\\\u1ee9ng \\\\u0111\\\\u1ea7y \\\\u0111\\\\u1ee7 y\\\\u00eau c\\\\u1ea7u c\\\\u1ee7a kh\\\\u00e1ch h\\\\u00e0ng c\\\\u0169ng nh\\\\u01b0 ti\\\\u00eau chu\\\\u1ea9n s\\\\u1ea3n xu\\\\u1ea5t \\\\u0111\\\\u00e3 \\\\u0111\\\\u1ec1 ra.\\\\nCh\\\\u00fang t\\\\u00f4i \\\\u00e1p d\\\\u1ee5ng quy tr\\\\u00ecnh \\\\u0111\\\\u00f3ng g\\\\u00f3i chuy\\\\u00ean nghi\\\\u1ec7p, ph\\\\u00f9 h\\\\u1ee3p v\\\\u1edbi t\\\\u1eebng lo\\\\u1ea1i s\\\\u1ea3n ph\\\\u1ea9m v\\\\u00e0 \\\\u0111\\\\u1eb7c th\\\\u00f9 v\\\\u1eadn chuy\\\\u1ec3n. V\\\\u1eadt li\\\\u1ec7u \\\\u0111\\\\u00f3ng g\\\\u00f3i \\\\u0111\\\\u01b0\\\\u1ee3c l\\\\u1ef1a ch\\\\u1ecdn c\\\\u1ea9n th\\\\u1eadn nh\\\\u1eb1m b\\\\u1ea3o v\\\\u1ec7 s\\\\u1ea3n ph\\\\u1ea9m tr\\\\u01b0\\\\u1edbc c\\\\u00e1c t\\\\u00e1c \\\\u0111\\\\u1ed9ng trong qu\\\\u00e1 tr\\\\u00ecnh l\\\\u01b0u kho v\\\\u00e0 v\\\\u1eadn chuy\\\\u1ec3n, \\\\u0111\\\\u1eb7c bi\\\\u1ec7t \\\\u0111\\\\u1ed1i v\\\\u1edbi c\\\\u00e1c \\\\u0111\\\\u01a1n h\\\\u00e0ng xu\\\\u1ea5t kh\\\\u1ea9u \\\\u0111\\\\u01b0\\\\u1eddng d\\\\u00e0i. T\\\\u00f9y theo y\\\\u00eau c\\\\u1ea7u, s\\\\u1ea3n ph\\\\u1ea9m c\\\\u00f3 th\\\\u1ec3 \\\\u0111\\\\u01b0\\\\u1ee3c \\\\u0111\\\\u00f3ng g\\\\u00f3i theo ti\\\\u00eau chu\\\\u1ea9n ri\\\\u00eang c\\\\u1ee7a kh\\\\u00e1ch h\\\\u00e0ng, \\\\u0111\\\\u1ea3m b\\\\u1ea3o t\\\\u00ednh \\\\u0111\\\\u1ed3ng b\\\\u1ed9 v\\\\u00e0 thu\\\\u1eadn ti\\\\u1ec7n trong qu\\\\u00e1 tr\\\\u00ecnh ti\\\\u1ebfp nh\\\\u1eadn, ph\\\\u00e2n ph\\\\u1ed1i v\\\\u00e0 s\\\\u1eed d\\\\u1ee5ng.&quot;,&quot;image_id&quot;:30}\\\" data-id=\\\"two_column\\\"></div><div data-type=\\\"customBlock\\\" data-config=\\\"{&quot;image_position&quot;:&quot;left&quot;,&quot;title&quot;:null,&quot;text&quot;:&quot;Trong qu\\\\u00e1 tr\\\\u00ecnh \\\\u0111\\\\u00f3ng g\\\\u00f3i, t\\\\u1eebng s\\\\u1ea3n ph\\\\u1ea9m \\\\u0111\\\\u01b0\\\\u1ee3c ki\\\\u1ec3m tra l\\\\u1ea7n cu\\\\u1ed1i v\\\\u1ec1 b\\\\u1ec1 m\\\\u1eb7t, k\\\\u1ebft c\\\\u1ea5u v\\\\u00e0 \\\\u0111\\\\u1ed9 ho\\\\u00e0n thi\\\\u1ec7n tr\\\\u01b0\\\\u1edbc khi \\\\u0111\\\\u01b0a v\\\\u00e0o quy tr\\\\u00ecnh \\\\u0111\\\\u00f3ng th\\\\u00f9ng. M\\\\u1ed7i ki\\\\u1ec7n h\\\\u00e0ng \\\\u0111\\\\u1ec1u \\\\u0111\\\\u01b0\\\\u1ee3c ph\\\\u00e2n lo\\\\u1ea1i, ghi nh\\\\u00e3n v\\\\u00e0 m\\\\u00e3 h\\\\u00f3a r\\\\u00f5 r\\\\u00e0ng, gi\\\\u00fap vi\\\\u1ec7c ki\\\\u1ec3m so\\\\u00e1t v\\\\u00e0 truy xu\\\\u1ea5t th\\\\u00f4ng tin tr\\\\u1edf n\\\\u00ean ch\\\\u00ednh x\\\\u00e1c v\\\\u00e0 thu\\\\u1eadn ti\\\\u1ec7n. \\\\u0110i\\\\u1ec1u n\\\\u00e0y g\\\\u00f3p ph\\\\u1ea7n \\\\u0111\\\\u1ea3m b\\\\u1ea3o t\\\\u00ednh minh b\\\\u1ea1ch v\\\\u00e0 \\\\u1ed5n \\\\u0111\\\\u1ecbnh trong to\\\\u00e0n b\\\\u1ed9 qu\\\\u00e1 tr\\\\u00ecnh xu\\\\u1ea5t h\\\\u00e0ng.\\\\n\\\\u0110\\\\u1ed9i ng\\\\u0169 v\\\\u1eadn h\\\\u00e0nh c\\\\u1ee7a DUYANG VIETNAM ph\\\\u1ed1i h\\\\u1ee3p ch\\\\u1eb7t ch\\\\u1ebd trong kh\\\\u00e2u chu\\\\u1ea9n b\\\\u1ecb xu\\\\u1ea5t x\\\\u01b0\\\\u1edfng, t\\\\u1eeb s\\\\u1eafp x\\\\u1ebfp h\\\\u00e0ng h\\\\u00f3a, t\\\\u1ed1i \\\\u01b0u kh\\\\u00f4ng gian container \\\\u0111\\\\u1ebfn ki\\\\u1ec3m tra \\\\u0111i\\\\u1ec1u ki\\\\u1ec7n v\\\\u1eadn chuy\\\\u1ec3n. Quy tr\\\\u00ecnh b\\\\u1ed1c x\\\\u1ebfp \\\\u0111\\\\u01b0\\\\u1ee3c th\\\\u1ef1c hi\\\\u1ec7n theo ti\\\\u00eau chu\\\\u1ea9n nh\\\\u1eb1m h\\\\u1ea1n ch\\\\u1ebf t\\\\u1ed1i \\\\u0111a r\\\\u1ee7i ro, \\\\u0111\\\\u1ea3m b\\\\u1ea3o h\\\\u00e0ng h\\\\u00f3a \\\\u0111\\\\u01b0\\\\u1ee3c c\\\\u1ed1 \\\\u0111\\\\u1ecbnh ch\\\\u1eafc ch\\\\u1eafn v\\\\u00e0 an to\\\\u00e0n trong su\\\\u1ed1t qu\\\\u00e1 tr\\\\u00ecnh v\\\\u1eadn chuy\\\\u1ec3n.&quot;,&quot;image_id&quot;:31}\\\" data-id=\\\"two_column\\\"></div><p>Bên cạnh đó, chúng tôi duy trì hệ thống quản lý sản xuất và logistics đồng bộ, giúp theo dõi tiến độ xuất hàng, kiểm soát lịch trình vận chuyển và đảm bảo giao hàng đúng kế hoạch. Sự phối hợp chặt chẽ giữa các bộ phận sản xuất, kiểm soát chất lượng và vận chuyển giúp DUYANG VIETNAM duy trì hoạt động xuất hàng ổn định, chính xác và hiệu quả.</p><p>Với định hướng phát triển bền vững và chuyên nghiệp, DUYANG VIETNAM không ngừng cải tiến quy trình đóng gói và xuất hàng nhằm nâng cao hiệu quả chuỗi cung ứng, đảm bảo chất lượng sản phẩm và củng cố niềm tin của đối tác trong và ngoài nước. Chúng tôi cam kết duy trì sự ổn định, đúng tiến độ và tiêu chuẩn trong mọi lô hàng, góp phần xây dựng mối quan hệ hợp tác lâu dài và bền vững.</p>\"}', NULL, 'published', '2026-03-03 06:16:56', '2026-03-13 06:05:56'),
(3, '{\"vi\": \"Cập Nhật Vận Chuyển & Giao Hàng\"}', '{\"vi\": \"cap-nhat-van-chuyen-giao-hang\"}', '{\"vi\": \"The beauty industry has faced sustained criticism for its failure to embrace inclusivity and diversity, leaving many individuals feeling excluded from conventional beauty norms.\"}', '{\"vi\": \"<p></p>\"}', NULL, 'published', '2026-03-03 06:18:38', '2026-03-03 06:18:38'),
(4, '{\"vi\": \"10.000+ Chiếc Móc Được Xuất Xưởng Đến Khách Hàng\"}', '{\"vi\": \"10000-chiec-moc-duoc-xuat-xuong-den-khach-hang\"}', '{\"vi\": \"Environmentalists have consistently raised concerns about the beauty industry\'s ecological impact, citing problems like excessive packaging and the incorporation of harmful chemicals in its products.\"}', '{\"vi\": \"<p></p>\"}', NULL, 'published', '2026-03-03 06:24:36', '2026-03-03 06:24:36');

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

--
-- Dumping data for table `post_blog`
--

INSERT INTO `post_blog` (`id`, `post_id`, `blog_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL);

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
  `specifications` json DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `has_variant` tinyint(1) NOT NULL DEFAULT '0',
  `compare_at_price` decimal(15,2) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `featured_position` int NOT NULL DEFAULT '0',
  `stock_quantity` int NOT NULL DEFAULT '0',
  `sales_count` int NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active, inactive, out_of_stock, coming_soon, discontinued',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `content`, `specifications`, `price`, `has_variant`, `compare_at_price`, `is_featured`, `featured_position`, `stock_quantity`, `sales_count`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"\", \"vi\": \"Móc Kim Loại Đầu Vòng\"}', '{\"en\": \"\", \"vi\": \"moc-kim-loai-dau-vong\"}', '{\"en\": \"\"}', '{\"en\": \"\", \"vi\": \"<p></p>\"}', '{\"en\": null, \"vi\": {\"123\": \"123\"}}', 0.00, 0, NULL, 0, 0, 0, 0, 'active', '2026-02-27 23:22:58', '2026-03-03 19:24:06'),
(2, '{\"vi\": \"Móc Gỗ Kẹp Quần Áo\"}', '{\"vi\": \"moc-go-kep-quan-ao\"}', '{\"vi\": null}', '{\"vi\": \"<p></p>\"}', NULL, 0.00, 0, NULL, 0, 0, 0, 0, 'active', '2026-03-03 05:46:12', '2026-03-03 05:46:12'),
(3, '{\"vi\": \"Móc Vest Gỗ Cao Cấp\"}', '{\"vi\": \"moc-vest-go-cao-cap\"}', '{\"vi\": null}', '{\"vi\": \"<p></p>\"}', NULL, 0.00, 0, NULL, 0, 0, 0, 0, 'active', '2026-03-03 05:48:53', '2026-03-03 05:48:53'),
(4, '{\"vi\": \"Móc Gỗ Dáng Mỏng\"}', '{\"vi\": \"moc-go-dang-mong\"}', '{\"vi\": null}', '{\"vi\": \"<p></p>\"}', NULL, 0.00, 0, NULL, 0, 0, 0, 0, 'active', '2026-03-03 05:49:18', '2026-03-03 05:49:18'),
(5, '{\"en\": \"\", \"vi\": \"Móc Gỗ Kẹp Classic\"}', '{\"en\": \"\", \"vi\": \"moc-go-kep-classic\"}', '{\"en\": \"\"}', '{\"en\": \"\", \"vi\": \"<p></p>\"}', NULL, 0.00, 0, NULL, 0, 0, 0, 0, 'active', '2026-03-03 05:57:08', '2026-03-03 05:57:53'),
(6, '{\"vi\": \"Móc Gỗ Tiêu Chuẩn\"}', '{\"vi\": \"moc-go-tieu-chuan\"}', '{\"vi\": null}', '{\"vi\": \"<p></p>\"}', NULL, 0.00, 0, NULL, 0, 0, 0, 0, 'active', '2026-03-03 05:58:47', '2026-03-03 05:58:47'),
(7, '{\"vi\": \"Móc Gỗ Cao Cấp Thanh Ngang\"}', '{\"vi\": \"moc-go-cao-cap-thanh-ngang\"}', '{\"vi\": null}', '{\"vi\": \"<p></p>\"}', NULL, 0.00, 0, NULL, 0, 0, 0, 0, 'active', '2026-03-03 05:59:11', '2026-03-03 05:59:11'),
(8, '{\"vi\": \"Móc Vest Gỗ Mahogany\"}', '{\"vi\": \"moc-vest-go-mahogany\"}', '{\"vi\": null}', '{\"vi\": \"<p></p>\"}', NULL, 0.00, 0, NULL, 0, 0, 0, 0, 'active', '2026-03-03 05:59:33', '2026-03-03 05:59:33'),
(9, '{\"vi\": \"Móc Gỗ Tiêu Chuẩn\"}', '{\"vi\": \"moc-go-tieu-chuan-2\"}', '{\"vi\": \"Thiết kế chắc chắn, hoàn thiện mịn, phù hợp treo quần áo hàng ngày và sản xuất số lượng lớn.\"}', '{\"vi\": \"<p></p>\"}', NULL, 0.00, 0, NULL, 1, 0, 0, 0, 'active', '2026-03-03 06:05:07', '2026-03-03 06:05:07'),
(10, '{\"en\": \"\", \"vi\": \"Móc Gỗ Gia Dụng\"}', '{\"en\": \"\", \"vi\": \"moc-go-gia-dung\"}', '{\"en\": \"\", \"vi\": \"Dáng móc tối ưu giữ form trang phục, bền bỉ, phù hợp cho gia đình, cửa hàng và sử dụng thường xuyên.\"}', '{\"en\": \"\", \"vi\": \"<p></p>\"}', NULL, 0.00, 0, NULL, 1, 0, 0, 0, 'active', '2026-03-03 06:05:37', '2026-03-03 06:05:39'),
(11, '{\"en\": \"\", \"vi\": \"Móc Gỗ Kẹp Quần Áo\"}', '{\"en\": \"\", \"vi\": \"moc-go-kep-quan-ao-2\"}', '{\"en\": \"\", \"vi\": \"Tích hợp kẹp chắc chắn, phù hợp treo quần, váy và trang phục cần cố định, đảm bảo ổn định khi sử dụng.\"}', '{\"en\": \"\", \"vi\": \"<p></p>\"}', '{\"en\": null, \"vi\": []}', 0.00, 0, NULL, 1, 0, 0, 0, 'active', '2026-03-03 06:08:05', '2026-03-09 09:18:04');

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
(1, 1, NULL, 'Việt Hùng', 'viet.hung.2898@gmail.com', 5, 'Toẹt vời', 1, '2026-03-03 06:53:28', '2026-03-03 06:53:28');

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
(1, 'super_admin', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20'),
(2, 'customer', 'web', '2026-02-15 00:30:20', '2026-02-15 00:30:20');

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
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1);

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
('SiPs0rS9LQRg0dxtA3S1IfUcucKtKyvTF8ND0cgM', 1, '172.18.0.6', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoieVhyM0ZMM0RRQWlXMll4dWlNdzFLUkNsclg4S3Rkc2lRZG9NVjVJQyI7czo2OiJsb2NhbGUiO3M6MjoidmkiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHBzOi8vbGFyYXZlbC1maWxhbWVudC1iYXNlLmRkZXYuc2l0ZSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjMxOGMxYjM5NTA2MzllZDQwNTBiODQ5ZmQzMTM0MjRjYzExNGViNzk0ZDdlZmE3NDYxNTIwNGIwMThjYWU4M2YiO3M6NjoidGFibGVzIjthOjM6e3M6NDA6IjY5ZmU0NDkxMTIyY2I4ZDNhYmIzMTc2ZTBiOWM4ZWY1X2NvbHVtbnMiO2E6Njp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjU6InRpdGxlIjtzOjU6ImxhYmVsIjtzOjExOiJUacOqdSDEkeG7gSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NDoic2x1ZyI7czo1OiJsYWJlbCI7czoxNToixJDGsOG7nW5nIGThuqtuIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo1OiJpbWFnZSI7czo1OiJsYWJlbCI7czoxMToiSMOsbmgg4bqjbmgiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjY6InN0YXR1cyI7czo1OiJsYWJlbCI7czoxMzoiVHLhuqFuZyB0aMOhaSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTE6Ik5nw6B5IHThuqFvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9aTo1O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjE4OiJOZ8OgeSBj4bqtcCBuaOG6rXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO319czo0MDoiZDhjMjIxYTU1NjM2NDY4YmNkNGE0YWNlNjFlNDhmYjNfY29sdW1ucyI7YTo2OntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NToidGl0bGUiO3M6NToibGFiZWwiO3M6MTE6IlRpw6p1IMSR4buBIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo0OiJzbHVnIjtzOjU6ImxhYmVsIjtzOjE1OiLEkMaw4budbmcgZOG6q24iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjU6ImltYWdlIjtzOjU6ImxhYmVsIjtzOjExOiJIw6xuaCDhuqNuaCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjM7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6Njoic3RhdHVzIjtzOjU6ImxhYmVsIjtzOjEzOiJUcuG6oW5nIHRow6FpIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiY3JlYXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMToiTmfDoHkgdOG6oW8iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjU7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6InVwZGF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTg6Ik5nw6B5IGPhuq1wIG5o4bqtdCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fX1zOjQwOiJmMTQ0MWZjODM0NDYzMTk4ODRjNGQwNzZjZjIzYTNlOV9jb2x1bW5zIjthOjQ6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo0OiJ0eXBlIjtzOjU6ImxhYmVsIjtzOjY6Ikxv4bqhaSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NToidGl0bGUiO3M6NToibGFiZWwiO3M6MTE6IlRpw6p1IMSR4buBIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo1OiJpbWFnZSI7czo1OiJsYWJlbCI7czoxMToiSMOsbmgg4bqjbmgiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjY6InN0YXR1cyI7czo1OiJsYWJlbCI7czoxMzoiVHLhuqFuZyB0aMOhaSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO319fXM6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1773595182);

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
(1, 'shop', 'site_name', NULL, '{\"en\": \"Duyang vietnam en\", \"vi\": \"Duyang vietnam\"}', '2026-02-28 01:21:58', '2026-03-15 09:43:05'),
(2, 'shop', 'site_logo', 'image', '{\"en\": 7, \"vi\": 7}', '2026-02-28 01:21:58', '2026-03-15 09:43:05'),
(3, 'shop', 'site_email', NULL, '{\"en\": \"duyangvietnam@gmail.com\", \"vi\": \"duyangvietnam@gmail.com\"}', '2026-02-28 01:21:58', '2026-03-15 09:43:05'),
(4, 'shop', 'site_phone', NULL, '{\"en\": \"0878 989 999\", \"vi\": \"0878 989 999\"}', '2026-02-28 01:21:58', '2026-03-15 09:43:05'),
(5, 'shop', 'site_address', NULL, '{\"en\": \"1236 Nguyen Van Linh Street, Thuong Hong Ward, Hung Yen Province, Vietnam\", \"vi\": \"Số 1236 Đường Nguyễn Văn Linh, Phường Thượng Hồng,  Tỉnh Hưng Yên, Việt Nam\"}', '2026-02-28 01:21:58', '2026-03-15 09:43:05'),
(6, 'shop', 'site_description', NULL, '{\"en\": \"DUYANG VIETNAM is always ready to support and provide manufacturing solutions tailored to your needs. Please send us your information, and our team will respond promptly with details about our products, production capabilities, as well as OEM/ODM cooperation opportunities.\", \"vi\": \"DUYANG VIETNAM luôn sẵn sàng hỗ trợ và tư vấn giải pháp sản xuất phù hợp với nhu cầu của bạn. Hãy gửi thông tin, đội ngũ của chúng tôi sẽ phản hồi nhanh chóng và cung cấp chi tiết về sản phẩm, năng lực sản xuất cũng như hợp tác OEM / ODM.\"}', '2026-02-28 01:21:58', '2026-03-15 09:43:05'),
(7, 'shop', 'site_map', NULL, '{\"en\": \"<iframe src=\\\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.650484527321!2d106.08016517596784!3d20.92637699128586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a3a8610927eb%3A0x67ec5247515f5685!2sDuyang%20vietnam!5e0!3m2!1svi!2s!4v1772591618809!5m2!1svi!2s\\\" width=\\\"600\\\" height=\\\"450\\\" style=\\\"border:0;\\\" allowfullscreen=\\\"\\\" loading=\\\"lazy\\\" referrerpolicy=\\\"no-referrer-when-downgrade\\\"></iframe>\", \"vi\": \"<iframe src=\\\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.650484527321!2d106.08016517596784!3d20.92637699128586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a3a8610927eb%3A0x67ec5247515f5685!2sDuyang%20vietnam!5e0!3m2!1svi!2s!4v1772591618809!5m2!1svi!2s\\\" width=\\\"600\\\" height=\\\"450\\\" style=\\\"border:0;\\\" allowfullscreen=\\\"\\\" loading=\\\"lazy\\\" referrerpolicy=\\\"no-referrer-when-downgrade\\\"></iframe>\"}', '2026-02-28 01:21:58', '2026-03-15 09:43:05'),
(8, 'shop', 'bank_info', NULL, '{\"en\": [], \"vi\": []}', '2026-02-28 01:21:58', '2026-02-28 01:21:58'),
(9, 'shop', 'faq', NULL, '{\"en\": [{\"key\": \"Does the factory support packaging and export?\", \"value\": \"Yes. We provide packaging solutions, product inspection, container loading, and transportation support according to the requirements of both domestic and international customers.\"}, {\"key\": \"Does the factory accept custom manufacturing?\", \"value\": \"Yes. We offer OEM/ODM manufacturing services and can produce according to the customer\'s designs, specifications, or requirements.\"}, {\"key\": \"What is the minimum order quantity (MOQ)?\", \"value\": \"The minimum order quantity depends on the type of product and production requirements. Please contact us for detailed information.\"}, {\"key\": \"How long is the production lead time?\", \"value\": \"Production time depends on the order quantity and product specifications. Our team will provide a specific timeline after confirming the order details.\"}, {\"key\": \"Does the factory have product quality control?\", \"value\": \"Yes. Our factory applies strict quality control processes at every stage of production to ensure that all products meet the required standards before delivery.\"}], \"vi\": [{\"key\": \"Nhà máy có hỗ trợ đóng gói và xuất khẩu không?\", \"value\": \"Có. Chúng tôi cung cấp giải pháp đóng gói, kiểm tra, đóng container và hỗ trợ vận chuyển theo yêu cầu của khách hàng trong và ngoài nước.\"}, {\"key\": \"Nhà máy có nhận sản xuất theo yêu cầu không?\", \"value\": \"\"}, {\"key\": \"Số lượng đặt hàng tối thiểu là bao nhiêu?\", \"value\": \"\"}, {\"key\": \"Thời gian sản xuất bao lâu?\", \"value\": \"\"}, {\"key\": \"Nhà máy có kiểm soát chất lượng sản phẩm không?\", \"value\": \"\"}]}', '2026-03-03 06:38:33', '2026-03-15 09:43:05'),
(10, 'shop', 'tax_code', NULL, '{\"vi\": \"0901196968\"}', '2026-03-03 07:31:51', '2026-03-15 09:43:05'),
(11, 'shop', 'representative', NULL, '{\"vi\": \"Ông Thạch Công Đồng\"}', '2026-03-03 07:31:51', '2026-03-15 09:43:05'),
(12, 'shop', 'business_field', NULL, '{\"en\": \"Manufacturing of products made from wood, bamboo, rattan, straw, and related materials for industrial and consumer use.\", \"vi\": \"Sản xuất các sản phẩm từ gỗ, tre, nứa, rơm, rạ và vật liệu liên quan phục vụ công nghiệp và tiêu dùng.\"}', '2026-03-03 07:31:51', '2026-03-15 09:43:05'),
(13, 'shop', 'working_hours', NULL, '{\"en\": [{\"key\": \"Monday – Friday😊\", \"value\": \"8:00 AM – 5:00 PM\"}, {\"key\": \"Saturday\", \"value\": \"8:00 AM – 12:00 AM\"}, {\"key\": \"Sunday\", \"value\": \"Closed\"}], \"vi\": [{\"key\": \"Thứ Hai – Thứ Sáu\", \"value\": \"08:00 – 17:00\"}, {\"key\": \"Thứ Bảy\", \"value\": \"08:00 – 12:00\"}, {\"key\": \"Chủ Nhật\", \"value\": \"Nghỉ\"}]}', '2026-03-03 07:31:51', '2026-03-15 09:43:05'),
(14, 'shop', 'gallery', 'image', '{\"en\": [36, 37, 38, 39, 40], \"vi\": [36, 37, 38, 39, 40]}', '2026-03-15 09:42:46', '2026-03-15 09:43:05');

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
(1, 'Super Admin', 'admin@admin.com', '2026-02-15 00:30:21', '$2y$12$3Aui8IC.UZFNcORyAfPD2.KhrLEP/gFU/Ql6dkEWjF3PMV6Kd6ZRq', 1, NULL, NULL, NULL, 'P5jwM9jsrSmk2NhrinU1dPJY2VZoA7oPMAsVnWRL6ZcDg7qvDhpwn48ZuMKh', '2026-02-15 00:30:21', '2026-02-15 00:30:21');

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
  ADD KEY `media_folders_parent_id_foreign` (`parent_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `mediables`
--
ALTER TABLE `mediables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `media_folders`
--
ALTER TABLE `media_folders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
