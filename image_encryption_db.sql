-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2026 at 01:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `image_encryption_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `type`, `user`, `action`, `timestamp`) VALUES
(1, 'login', 'admin', 'Admin logged in', '2025-12-17 03:45:03'),
(2, 'update', 'staff1', 'Updated customer data', '2025-12-17 03:45:03'),
(3, 'Delete Record', 'Admin', 'Deleted consultation for sadth', '2025-12-17 04:28:09'),
(4, 'Add Record', 'Unknown', 'Added consultation for Leorne', '2025-12-17 04:29:58'),
(5, 'Update Record', 'Admin', 'Updated consultation for KAMAL VESFFW (Cost: RM7457, Next Appointment: 2026-01-14)', '2025-12-17 04:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `selected_package` varchar(100) NOT NULL,
  `preferred_date` date DEFAULT NULL,
  `preferred_time` varchar(50) DEFAULT NULL,
  `skin_type` varchar(50) DEFAULT NULL,
  `main_concerns` text DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `allergies` varchar(255) DEFAULT NULL,
  `current_medications` varchar(255) DEFAULT NULL,
  `previous_treatments` varchar(255) DEFAULT NULL,
  `lifestyle` text DEFAULT NULL,
  `consent` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `submitted_by_role` enum('admin','staff') DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`id`, `customer_id`, `staff_id`, `selected_package`, `preferred_date`, `preferred_time`, `skin_type`, `main_concerns`, `medical_history`, `allergies`, `current_medications`, `previous_treatments`, `lifestyle`, `consent`, `created_at`, `submitted_by_role`) VALUES
(1, 1, 27, 'Intense Pulsed Light (IPL) Therapy', '2025-12-16', 'Afternoon (12PM–3PM)', 'Dry', '-', '-', '-', '', '-', '-', 1, '2026-01-02 15:52:46', 'staff'),
(2, 2, 27, 'Acne Clear Injection Therapy', '2026-01-01', 'Afternoon (12PM–3PM)', 'Normal', '-', '-', '-', '-', '-', '-', 1, '2026-01-02 15:58:21', 'staff'),
(3, 4, 16, 'Skin Barrier Repair', '2025-12-16', 'Evening (3PM–6PM)', 'Sensitive', '-', '-', '-', '-', '-', '-', 1, '2026-01-02 16:10:01', 'staff'),
(4, 6, 16, 'Anti-Sensitivity Repair & Management', '2025-09-24', 'Afternoon (12PM–3PM)', 'Sensitive', '-', '-', '-', '-', '-', '-', 1, '2026-01-02 16:12:42', 'staff'),
(5, 7, 16, 'Oxygen Infused Hydration Skin Managemen', '2025-10-09', 'Morning (9AM–12PM)', 'Combination', '-', '-', '-', '-', '-', '-', 1, '2026-01-02 16:14:38', 'staff'),
(6, 8, 16, 'Eyebrow Embroidery', '2025-12-16', 'Morning (9AM–12PM)', 'Normal', '-', '-', '-', '--', '-', '-', 1, '2026-01-02 16:16:36', 'staff'),
(10, 14, 16, 'Acne Clear Injection Therapy', '2025-10-21', 'Morning (9AM–12PM)', 'Sensitive', '-', '-', '-', '-', '-', '-', 1, '2026-01-02 17:22:35', 'admin'),
(11, 15, 16, 'Eyeliner Tattoo', '2025-12-21', 'Morning (9AM–12PM)', 'Dry', '-', '-', '-', '-', '-', '-', 1, '2026-01-02 17:35:49', 'admin'),
(12, 18, 16, 'Anti-Sensitivity Repair & Management', '2025-12-20', 'Evening (3PM–6PM)', 'Oily', '-', '-', '-', '-', '-', '-', 1, '2026-01-02 17:43:54', 'admin'),
(14, 20, 16, 'Nano Moisturizing Light Therapy', '2025-12-31', 'Morning (9AM–12PM)', 'Sensitive', '-', '-', '-', '-', '-', '-', 1, '2026-01-02 19:06:00', 'admin'),
(15, 21, 27, 'Oxygen Infused Hydration Skin Managemen', '2025-12-23', 'Afternoon (12PM–3PM)', 'Dry', '-', '-', '-', '--', '-', '-', 1, '2026-01-03 06:51:32', 'staff'),
(17, 23, 27, 'Nano Moisturizing Light Therapy', '2026-01-01', 'Morning (9AM–12PM)', 'Dry', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 08:05:22', 'staff'),
(18, 28, 16, 'Laser Hair Removal', '2026-02-08', 'Morning (9AM–12PM)', 'Normal', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 09:20:03', 'admin'),
(19, 29, 16, 'Nano Moisturizing Light Therapy', '2026-01-14', 'Evening (3PM–6PM)', 'Dry', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 09:23:39', 'admin'),
(20, 30, 16, 'Anti-Sensitivity Repair & Management', '2026-01-06', 'Afternoon (12PM–3PM)', 'Oily', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 09:28:23', 'admin'),
(22, 32, 16, 'Acne Clear Injection Therapy', '2025-12-22', 'Morning (9AM–12PM)', 'Dry', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 09:54:14', 'admin'),
(23, 33, 27, 'Nano Moisturizing Light Therapy', '2026-01-13', 'Afternoon (12PM–3PM)', 'Sensitive', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 10:04:01', 'staff'),
(25, 37, 27, 'Skin Barrier Repair', '2026-01-07', 'Morning (9AM–12PM)', 'Combination', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 10:17:27', 'staff'),
(26, 38, 27, 'Eyeliner Tattoo', '2025-12-31', 'Morning (9AM–12PM)', 'Oily', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 10:26:40', 'staff'),
(27, 40, 27, 'Intense Pulsed Light (IPL) Therapy', '2026-01-07', 'Morning (9AM–12PM)', 'Normal', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 10:33:22', 'staff'),
(29, 42, 16, 'Intense Pulsed Light (IPL) Therapy', '2026-01-15', 'Morning (9AM–12PM)', 'Oily', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 10:57:34', 'admin'),
(30, 43, 16, 'Non-invasive Eyebrow Cleaning', '2026-01-18', 'Evening (3PM–6PM)', 'Oily', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 11:00:33', 'admin'),
(31, 44, 16, 'Skin Barrier Repair', '2025-12-26', 'Morning (9AM–12PM)', 'Oily', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 11:02:51', 'admin'),
(32, 45, 16, 'Intense Pulsed Light (IPL) Therapy', '2026-01-26', 'Afternoon (12PM–3PM)', 'Dry', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 11:15:54', 'admin'),
(33, 46, 16, 'HIFU Facelift Therapy', '2026-01-22', '', '', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 11:22:01', 'admin'),
(34, 47, 16, 'HIFU Facelift Therapy', '2026-01-31', 'Morning (9AM–12PM)', 'Combination', '-', '--', '-', '-', '-', '-', 1, '2026-01-03 11:23:35', 'admin'),
(35, 48, 16, 'Eyebrow Embroidery', '2026-01-20', 'Afternoon (12PM–3PM)', 'Normal', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 11:27:05', 'admin'),
(36, 49, 16, 'Non-invasive Eyebrow Cleaning', '2026-01-14', 'Morning (9AM–12PM)', 'Oily', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 11:35:10', 'admin'),
(37, 50, 16, 'Nano Moisturizing Light Therapy', '2026-01-19', 'Afternoon (12PM–3PM)', 'Combination', '-', '-', '-', '-', '-', '-', 1, '2026-01-03 11:37:42', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `emergency_contact` varchar(100) DEFAULT NULL,
  `emergency_phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `streetAddress` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `postalCode` varchar(20) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `date_of_birth`, `gender`, `emergency_contact`, `emergency_phone`, `created_at`, `streetAddress`, `city`, `state`, `postalCode`, `status`, `notes`) VALUES
(1, 'john', 'ai230411@student.uthm.edu.my', '0152489268', '2001-02-13', 'Male', 'sara', '012323546456', '2026-01-02 15:52:46', '41, johor baru, bukit indah, 33020', 'johor baru', 'bukit indah', '33020', 'inactive', ''),
(2, 'Amy', 'ai230411@student.uthm.edu.my', '12345678', '2007-05-23', 'Female', 'sara', '012323546456', '2026-01-02 15:58:21', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(4, 'Chan Sin Pei', 'chansinpei25@gmail.com', '0163829372', '2003-10-14', '', 'sara', '012323546456', '2026-01-02 16:10:01', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(6, 'hebe', 'hebe@uthm.edu.my', '034385924', '2003-10-13', 'Female', 'sara', '012323546456', '2026-01-02 16:12:42', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(7, 'pugun', 'pugun@134gmail.com', '0213928432', '2004-10-20', 'Female', 'sara', '024325365', '2026-01-02 16:14:38', '54', 'johor baru', 'bukit indah', '33020', 'active', ''),
(8, 'jessi', 'jessi24@gmail.com', '34932859436', '2005-12-13', 'Female', 'sara', '434687697', '2026-01-02 16:16:36', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(11, 'jsj', 'jsj@gmail.com', '74432332', '2009-06-19', 'Male', 'sara', '655233434', '2026-01-02 16:33:29', '', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(12, 'jane', 'jane@gmail.com', '345679', '2001-10-16', 'Female', 'sara', '6578245', '2026-01-02 17:19:44', '41', 'johor baru', '', '', 'active', NULL),
(14, 'jec', 'jec@gmail.com', '762312235', '2010-10-07', 'Female', 'sara', '3456768789', '2026-01-02 17:22:35', '54, johor baru, bukit indah, 33020', 'johor baru', 'bukit indah', '33020', 'active', 'good'),
(15, 'ken', 'ken@gmail.com', '567899', '1998-06-26', 'Male', 'sara', '6789044', '2026-01-02 17:35:49', '41, johor baru, bukit indah, 33020', 'johor baru', 'bukit indah', '33020', 'inactive', ''),
(16, 'shah', 'shah@gmail.com', '6323254789', '2010-10-22', 'Male', 'sara', '4345767887', '2026-01-02 17:39:46', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(18, 'suze', 'suze@gmail.com', '23467899', '2001-09-14', 'Female', 'sara', '23446576898', '2026-01-02 17:43:54', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(19, 'tg', 'tg@gmail.com', '2343565677', '2026-01-12', 'Female', 'sara', '76643321265', '2026-01-02 17:50:43', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(20, 'deco', 'deco@gmail.com', '3435787899', '2003-10-15', 'Male', '', '7654433', '2026-01-02 19:06:00', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(21, 'hun', 'hun@gmail.com', '4365783465', '2006-10-18', 'Male', 'jed', '7434563', '2026-01-03 06:51:32', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(23, 'teh', 'teh@gmail.com', '56890904', '2007-11-13', 'Female', 'jed', '4345678', '2026-01-03 08:05:22', '41', 'johor baru', '', '33020', 'active', NULL),
(24, 'hen', 'hen@gmail.com', '746322165', '2002-05-06', 'Female', 'jed', '343565787', '2026-01-03 08:06:47', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(26, 'cunbe', 'cunbe@gmail.com', '785342145', '2005-11-14', 'Male', 'jed', '67674343532', '2026-01-03 09:16:34', '87', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(28, 'door', 'door@gmail.com', '32445356567', '2006-10-25', 'Other', 'sara', '4535676788', '2026-01-03 09:20:03', '56', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(29, 'chair', 'chair@gmail.com', '324455676', '2000-10-24', 'Other', 'de', '243545656', '2026-01-03 09:23:39', '35', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(30, 'table', 'table@gmail.com', '9845323213', '2006-10-11', 'Other', 'de', '76635243213', '2026-01-03 09:28:23', '35', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(31, 'book', 'book@gmail.com', '43546677', '2000-07-02', 'Other', 'de', '435567788', '2026-01-03 09:39:35', '56', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(32, 'rt', 'rt@gmail.com', '453566776', '2008-10-14', 'Other', 'jed', '4566787787', '2026-01-03 09:54:14', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(33, 'jug', 'jug@gmail.com', '435667788', '2009-06-19', 'Other', 'jed', '44535455', '2026-01-03 10:04:01', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(37, 'lap', 'lap@gmail.com', '453565667', '0000-00-00', 'Other', 'jed', '346454', '2026-01-03 10:17:27', '41', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(38, 'do', 'do@gmail.com', '4456678', '2002-06-18', 'Other', 'jed', '43565676', '2026-01-03 10:26:40', '56', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(40, 'yun', 'yun@gmail.com', '324466567', '2006-06-20', 'Other', 'jed', '34436546', '2026-01-03 10:33:22', '43', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(41, 'honor', 'honor@gmail.com', '547568679', '2009-06-16', 'Other', 'sara', '45546657678', '2026-01-03 10:41:53', '35', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(42, 'char', 'char@gmail.com', '435566567', '2004-06-15', 'Other', 'jed', '3443456565', '2026-01-03 10:57:34', '87', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(43, 'blue', 'blue@gmail.com', '24345565', '2008-10-15', 'Other', 'jed', '4546656567', '2026-01-03 11:00:33', '56', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(44, 'green', 'green@gmail.com', '2454656567', '2005-10-12', 'Other', 'jed', '234456675', '2026-01-03 11:02:51', '43', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(45, 'ty', 'ty@gmail.com', '546577', '2009-10-13', 'Other', 'sara', '354364545', '2026-01-03 11:15:54', '', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(46, 'full', 'full@gmail.com', '4356477', '2006-06-13', 'Other', 'sara', '214336457', '2026-01-03 11:22:01', '87', 'johor baru', 'bukit indah', '', 'active', NULL),
(47, 'pink', 'pink@gmail.com', '09348235', '2006-07-18', 'Other', 'de', '367899', '2026-01-03 11:23:35', '35', 'johor baru', 'bukit indah', '', 'active', NULL),
(48, 'chan', 'chan@gmail.com', '5433', '2003-06-17', 'Female', 'jed', '234645765', '2026-01-03 11:27:05', '43', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(49, 'ML', 'ml@gmail.com', '6677777', '1999-02-02', 'Male', 'sara', '56789', '2026-01-03 11:35:10', '35', 'johor baru', 'bukit indah', '33020', 'active', NULL),
(50, 'jn', 'jn@gmail.com', '456789', '2009-10-20', 'Female', 'jed', '34567899', '2026-01-03 11:37:42', '56', 'johor baru', 'bukit indah', '', 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `encryption_agreements`
--

CREATE TABLE `encryption_agreements` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `digital_signature` text DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `final_consent` tinyint(1) NOT NULL DEFAULT 0,
  `date_submitted` date NOT NULL,
  `consent_encryption` tinyint(1) DEFAULT 0,
  `consent_data_collection` tinyint(1) DEFAULT 0,
  `consent_data_processing` tinyint(1) DEFAULT 0,
  `consent_secure_storage` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `encryption_agreements`
--

INSERT INTO `encryption_agreements` (`id`, `user_id`, `full_name`, `email`, `phone`, `company`, `position`, `digital_signature`, `additional_notes`, `final_consent`, `date_submitted`, `consent_encryption`, `consent_data_collection`, `consent_data_processing`, `consent_secure_storage`) VALUES
(1, NULL, '4Ӳ?־\0??}x??o-', '??z?\n???:??\'??֧?չ1?????\0??', '????J?[?%?I,7??', '-', 'business', NULL, 'no', 1, '0000-00-00', 1, 1, 1, 1),
(2, NULL, 'rfv?!C;<|{o???', '????\"?Yf???ԖSI?? ?J*??G?M???', '?L?C?A\r??`?p??', '-', 'SALE', NULL, '-', 1, '0000-00-00', 1, 1, 1, 1),
(3, NULL, '☏??c?M?i?ޭr3	', '??g_Gp???kx<?e?v??t#\\??%?]Q?J', '????J?[?%?I,7??', '-', 'sale', NULL, 'tqsm for the treatment i love it', 1, '0000-00-00', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `treatment_records`
--

CREATE TABLE `treatment_records` (
  `id` int(11) NOT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `staff` varchar(100) DEFAULT NULL,
  `treatment` varchar(150) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `products` text DEFAULT NULL,
  `before_photo` varchar(255) DEFAULT NULL,
  `after_photo` varchar(255) DEFAULT NULL,
  `next_appointment` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatment_records`
--

INSERT INTO `treatment_records` (`id`, `customer`, `staff`, `treatment`, `category`, `date`, `price`, `notes`, `products`, `before_photo`, `after_photo`, `next_appointment`, `created_at`) VALUES
(8, 'Cherry', 'Amy', 'Non-invasive Eyebrow Cleaning', 'Eyebrow', '2025-12-09', 399.00, 'sgdf', 'hair serum, hair mask', '1303.jpg_wh300.jpg', '3078abb961c5476aa7f090ddce725244-824x600.webp', '2025-11-25', '2026-01-02 07:47:27'),
(9, 'Cherry', 'Amy', 'Non-invasive Eyebrow Cleaning', 'Facial', '2025-12-08', 399.00, 'sdfs', 'hair serum, hair mask', 'before.PNG', 'after.PNG', '2025-12-30', '2026-01-02 08:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('admin','staff') DEFAULT 'staff',
  `status` enum('pending','approved') DEFAULT 'pending',
  `verification_code` int(6) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `role`, `status`, `verification_code`, `is_verified`) VALUES
(2, 'sinpei123', 'U2FsdGVkX1/lmNhL/vpmKY43pv5aOhNbDC8PSrMCPRE=', 'ai230280@student.uthm.edu.my', '012345678', 'staff', 'pending', NULL, 0),
(3, 'joe34', 'U2FsdGVkX18VAGCk65hRa/2cbBk23+0qdOnK2MJ3lBQ=', 'ai230411@student.uthm.edu.my', '012345678', 'staff', 'pending', NULL, 0),
(4, 'joe34', 'U2FsdGVkX1+PWV9G7a462dPONhMHLlGV1DCbb/IgWcY=', 'ai230411@student.uthm.edu.my', '012345678', 'staff', 'pending', NULL, 0),
(5, 'testuser', 'U2FsdGVkX18ReM45Z+53+MegjNIbkt1mWyEYF+WzD7M=', 'test@email.com', '0123456789', 'staff', 'approved', NULL, 0),
(6, 'pei1', '$2y$10$N7IG/SsNiOW4Rc9cPmQZfuKofjSKBGyusRtdXqXN6.JUgUPWbtqkW', 'ai230280@student.uthm.edu.my', '012345678', 'staff', 'pending', NULL, 0),
(7, 'pei5', '$2y$10$GZ2QycA64pTLvHAHYX3ybuqeSZJNa9qJZgxDMMyNe6t/B48ZOaDbS', 'ai230411@student.uthm.edu.my', '012345678', 'staff', 'approved', NULL, 0),
(10, 'michelle56', '$2y$10$k1P.nJAzi2sD9c/thHc6jONhsDV4TlnotbTTaSA6ZIz108HrjPeo6', 'ai230411@student.uthm.edu.my', '01156857438', 'staff', 'pending', NULL, 0),
(12, 'jesssi23', '$2y$10$FuDukMK05EWEyEFDSWuAGueQSJyWIM2TVTI5Oasm/XOJe1QQFkdge', 'ai230411@student.uthm.edu.my', '01156857438', 'staff', 'approved', NULL, 0),
(13, 'sim56', '$2y$10$EVrCnXHkH54GcXDweD84GOJQxD/YQJWXZUaG8qdlk6mNu.yV2zBGe', 'rafidah@uthm.edu.my', '0123456789', 'staff', 'approved', NULL, 0),
(16, 'jeniffer89', '$2y$10$mdvw5SZjE69yUEGQnE09FeORI4/rseBQRp3IEiS/2ANX/T/E6Gpgq', 'jeniffer89@gmail.com', '01156857438', 'admin', 'approved', NULL, 0),
(17, 'gumbell45', '$2y$10$YJJ8/3oQZNsU7TQXEVNME.q5J1waPfi/rNgVZjWVgFfwCPn7uVUFG', 'ai230280@student.uthm.edu.my', '0123456789', 'staff', 'pending', NULL, 0),
(18, 'gubell45', '$2y$10$hWv0ws0Q6//ce12OtE/YV.Z5T0G8qJONGercUBs129dOzNTnfk0gi', 'ai230411@student.uthm.edu.my', '0123456789', 'staff', 'approved', NULL, 0),
(20, 'jesica78', '$2y$10$fKBnqE0PYQ53i49bcm0cIuM6AfBP4DNF7vQizZ2LFfdNlgd7J62W2', 'jesica78@gmail.com', '01527836784', 'staff', 'approved', NULL, 0),
(22, 'jacob56', '$2y$10$3K4MIHSd9gwftQ7DBuoct.y1.GBNwN6P.Z0CWfu0wCTxRJn3JZb/u', 'jacob56@gmail.com', '012648342', 'staff', 'approved', NULL, 0),
(23, 'Chan Sin Pei', '$2y$10$dHGG4DtWdaMNrmIiND2sCOBekE4UAUOieuJu4twjhGHdfEXOIc54q', 'chansinpei25@gmail.com', '01156857438', 'staff', 'approved', 584658, 0),
(24, 'Amy', '$2y$10$I9G.8XkwnPeUtDj0Jreaj.NCGYjIlhzfkE8Irqfnc1IFHRcwVxWuq', 'amy123@gmail.com', '0182132334', 'staff', 'approved', NULL, 0),
(25, 'MeiLing', '$2y$10$H3lVsdIGcsc4.zAR0sinEOt0BnmfjBRIIBmJVUHyn2u2yy0mD4ybS', 'meiling56@gmail.com', '019345245', 'staff', 'approved', NULL, 0),
(26, 'Joon', '$2y$10$VNoL3MXTwhYHcpuJvSc0WuR0QIG0gSgu/Lut.fHLPCLp/7toKf7xu', 'joon28@gmail.com', '0123374344', 'staff', 'approved', NULL, 0),
(27, 'Shawn', '$2y$10$Is8lAE4q9E3uvL/KCQeFAORtEG/jhUsuAfE32fI1HYwB6A9U44fq.', 'shawn67@gmail.com', '012374492', 'staff', 'approved', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `encryption_agreements`
--
ALTER TABLE `encryption_agreements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treatment_records`
--
ALTER TABLE `treatment_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `encryption_agreements`
--
ALTER TABLE `encryption_agreements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `treatment_records`
--
ALTER TABLE `treatment_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `consultations_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
