-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 08:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `site_link` varchar(255) NOT NULL,
  `logo` varchar(700) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `visibility` enum('public','private') DEFAULT 'public',
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `site_name`, `description`, `site_link`, `logo`, `category`, `created_at`, `visibility`, `submitted_by`) VALUES
(138, 'DeepSeek - Into the Unknown', '', 'https://chat.deepseek.com/', 'https://www.google.com/s2/favicons?sz=256&domain=chat.deepseek.com', 'ChatBot', '2025-03-08 07:26:15', 'private', NULL),
(139, 'Google Translate', '', 'https://translate.google.com/', 'https://www.google.com/s2/favicons?sz=256&domain=translate.google.com', 'Translator', '2025-03-08 07:29:11', 'public', NULL),
(140, 'Coursera', '', 'https://www.coursera.org/courses?query=free', 'https://www.google.com/s2/favicons?sz=256&domain=www.coursera.org', 'Course', '2025-03-08 07:30:19', 'public', NULL),
(141, 'Great Learning ', '', 'https://www.mygreatlearning.com/', 'https://www.google.com/s2/favicons?sz=256&domain=www.mygreatlearning.com', 'Course', '2025-03-08 07:31:01', 'public', NULL),
(142, ' TypingClub', '', 'https://www.edclub.com/sportal/', 'https://www.google.com/s2/favicons?sz=256&domain=www.edclub.com', 'Typing', '2025-03-08 07:31:48', 'public', NULL),
(143, 'WsCube Tech ', '', 'https://www.wscubetech.com/', 'https://www.google.com/s2/favicons?sz=256&domain=www.wscubetech.com', 'Course', '2025-03-08 07:34:06', 'public', NULL),
(144, 'SEOStudio ', '', 'https://seostudio.tools/', 'https://www.google.com/s2/favicons?sz=256&domain=seostudio.tools', 'Youtube Tools', '2025-03-08 07:51:16', 'public', NULL),
(145, 'Rollout', '', 'https://rollout.site/generate', 'https://www.google.com/s2/favicons?sz=256&domain=rollout.site', 'Web Genrator', '2025-03-08 07:52:26', 'public', NULL),
(146, 'GptZero', '', 'https://gptzero.me/', 'https://www.google.com/s2/favicons?sz=256&domain=gptzero.me', 'Tools', '2025-03-08 07:54:26', 'public', NULL),
(147, 'Ryne AI ', '', 'https://ryne.ai/', 'https://www.google.com/s2/favicons?sz=256&domain=ryne.ai', 'Tools', '2025-03-08 07:55:15', 'public', NULL),
(148, 'GitHub Copilot  ', '', 'https://github.com/features/copilot?ef_id=_k_Cj0KCQiAz6q-BhCfARIsAOezPxmMHi9mJU14Jhs9uF16LaYDqsfC3TwpsjXaTIToYO3h8kVO3-e5W_caAvCXEALw_wcB_k_', 'https://www.google.com/s2/favicons?sz=256&domain=github.com', 'ChatBot', '2025-03-08 07:58:45', 'public', NULL),
(149, 'Chat Extensions - Visual Studio Code', '', 'https://marketplace.visualstudio.com/search?target=VSCode', 'https://www.google.com/s2/favicons?sz=256&domain=marketplace.visualstudio.com', 'Tools, ChatBot', '2025-03-08 08:00:00', 'public', NULL),
(150, 'Pi7 Image Tool - Compress, Resize ', '', 'https://image.pi7.org/', 'https://www.google.com/s2/favicons?sz=256&domain=image.pi7.org', 'Image resize, Tools', '2025-03-08 08:00:54', 'public', NULL),
(152, 'Visual Studio Code', '', 'https://vscode.dev/', 'https://www.google.com/s2/favicons?sz=256&domain=vscode.dev', 'vs code , online complire, ', '2025-03-08 08:08:11', 'public', NULL),
(153, 'WriteHuman', '', 'https://writehuman.ai/?via=li', 'https://www.google.com/s2/favicons?sz=256&domain=writehuman.ai', 'Tools, AI Humanizer', '2025-03-08 08:09:10', 'public', NULL),
(155, 'Remaker ai  ', '', 'https://remaker.ai/face-swap-free/', 'https://www.google.com/s2/favicons?sz=256&domain=remaker.ai', 'Face Swap Free, face chenge', '2025-03-08 08:11:06', 'private', NULL),
(156, 'AI Face Swap', '', 'https://aifaceswap.io/#face-swap-playground', 'https://www.google.com/s2/favicons?sz=256&domain=aifaceswap.io', 'AI , Face chenge ', '2025-03-08 08:12:14', 'public', NULL),
(157, 'Globe Explorer', '', 'https://explorer.globe.engineer/search?qd=[{\"index\":0,\"type\":\"top_searchbox\",\"searchbox_query\":\"html\",\"clicked_category\":null,\"search_id\":\"99e50e59-eff8-468f-89d4-283f840852f7\",\"staged_image\":null},{\"index\":1,\"type\":\"category\",\"searchbox_query\":\"\",\"clicke', 'https://www.google.com/s2/favicons?sz=256&domain=explorer.globe.engineer', 'ChatBot', '2025-03-08 15:29:04', 'public', NULL),
(158, 'InterviewAI  ', '', 'https://www.interviewai.io/?gad_source=1', 'https://www.google.com/s2/favicons?sz=256&domain=www.interviewai.io', 'AI-Powered Interviews ', '2025-03-08 15:31:13', 'public', NULL),
(159, 'jitter.video ', '', 'https://jitter.video/templates/', 'https://www.google.com/s2/favicons?sz=256&domain=jitter.video', ' Free motion graphics templates , video', '2025-03-08 15:34:16', 'public', NULL),
(161, '  shortsnoob', '', 'https://shortsnoob.com/en1', 'https://www.google.com/s2/favicons?sz=256&domain=shortsnoob.com', 'YouTube Shorts Video Download online – Shorts Downloader', '2025-03-08 15:36:07', 'public', NULL),
(162, 'Udio', '', 'https://www.udio.com/create', 'https://www.google.com/s2/favicons?sz=256&domain=www.udio.com', 'AI Music Generator , audio', '2025-03-08 15:37:01', 'public', NULL),
(163, 'Ideogram', '', 'https://ideogram.ai/t/explore', 'https://www.google.com/s2/favicons?sz=256&domain=ideogram.ai', 'photos , images generator', '2025-03-08 15:39:43', 'public', NULL),
(164, 'Relume ', '', 'https://www.relume.io/', 'https://www.google.com/s2/favicons?sz=256&domain=www.relume.io', ' — Websites designed ', '2025-03-08 15:40:25', 'public', NULL),
(165, 'Leonardo.Ai', '', 'https://app.leonardo.ai/', 'https://www.google.com/s2/favicons?sz=256&domain=app.leonardo.ai', 'video , img genarator', '2025-03-08 15:42:55', 'private', NULL),
(166, ' AKOOL', '', 'https://akool.com/apps/image-generator', 'https://www.google.com/s2/favicons?sz=256&domain=akool.com', 'Best AI Image Generator Online | ', '2025-03-08 15:44:29', 'public', NULL),
(167, 'Red Hat ', '', 'https://www.redhat.com/en', 'https://www.google.com/s2/favicons?sz=256&domain=www.redhat.com', 'We make open source technologies for the enterprise', '2025-03-11 18:18:32', 'private', NULL),
(168, 'Deepseek Ai', 'ddsfdasfs', 'https://chat.deepseek.com', 'https://www.google.com/s2/favicons?sz=256&domain=chat.deepseek.com', 'Ai Chatbot', '2025-03-11 18:23:58', 'private', 1),
(170, 'PPT', '', 'https://www.slideshare.net/slideshow/bus-interface-unitbiu-of-8086-microprocessor/206769283', 'https://www.google.com/s2/favicons?sz=256&domain=www.slideshare.net', 'ppt', '2025-03-18 18:14:31', 'public', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
