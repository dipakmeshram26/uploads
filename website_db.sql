-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 08:48 PM
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
-- Database: `website_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(355) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`, `name`) VALUES
(6, 'dipakm', '$2y$10$EaGz0rZN2/nF5w1H3Y78O.4ULr2A7rBHOsnESDnkAbouMsbb7ukUy', '2025-02-20 18:59:18', ''),
(12, 'blackArch2.0', '$2y$10$LWyG8U7NnRiJNmOfLEs5P.rKIGR61t.vHjtfxA5VFrax7.6gQnBTy', '2025-02-25 18:26:46', 'BlackArch 2.0');

-- --------------------------------------------------------

--
-- Table structure for table `sub_admins`
--

CREATE TABLE `sub_admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sub_admin_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_admins`
--

INSERT INTO `sub_admins` (`id`, `name`, `email`, `password`, `created_at`, `sub_admin_name`) VALUES
(1, 'dipak meshram', 'mahitnahi2003@gmail.com', '$2y$10$poACUu4/Mt/no4FEsAPoTe9zqqw/ZVyByU7dsmDZefUY7LwS.XXmK', '2025-02-27 17:56:28', NULL),
(2, '', '', '', '2025-02-27 20:34:01', 'Anonymous');

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
(168, 'AKOOL', 'Best AI Image Generator Online | AKOOL', 'https://akool.com/apps/image-generator', 'https://www.google.com/s2/favicons?sz=256&domain=akool.com', 'image generator', '2025-03-26 05:01:37', 'public', NULL),
(169, 'Leonardo.Ai', 'Leonardo.Ai is an advanced AI-based platform that allows users to generate high-quality images, artwork, and videos. It is designed to speed up and simplify creative workflows across various industries.\n\nKey Features and Capabilities:\nAI Art Generation:\n\nCreate stunning visuals, illustrations, and videos using simple text prompts.\n\nSupports multiple artistic styles to enhance creativity.\n\nExplore AI Art Generator\n\nReal-Time Image Generation:\n\nQuickly visualize concepts with instant AI-generated images.\n\nIdeal for artists, designers, and content creators.\n\nMore Details\n\nAI-Powered Editing Tools:\n\nModify images using simple text-based commands.\n\n\"Edit with AI\" feature enables instant adjustments.\n\nLearn More\n\nPrompt Improvement Tool:\n\nEnhances simple prompts into more detailed and effective instructions.\n\nHelps generate better AI outputs.\n\nCNET Review\n\nImage Description:\n\nProvides detailed descriptions of images for better understanding and refinement.\n\nVocal Media Analysis\n\nPhotorealistic AI Photography:\n\nGenerates high-quality, realistic images for portfolios, blogs, social media, and marketing.', 'https://app.leonardo.ai/image-generation', 'https://www.google.com/s2/favicons?sz=256&domain=app.leonardo.ai', 'image generator', '2025-03-26 07:55:30', 'public', NULL),
(170, 'Relume', 'Relume — Websites designed & built faster with AI | AI website builder\nRelume is an advanced AI-driven platform designed to simplify website design and wireframing. It enables users to create professional, responsive, and visually appealing websites effortlessly.', 'https://www.relume.io/', 'https://www.google.com/s2/favicons?sz=256&domain=www.relume.io', 'website generator,web design,web sitemaps,website structure', '2025-03-26 08:09:09', 'public', NULL),
(171, 'Ideogram', 'Ideogram.AI is an advanced AI tool that generates high-quality images from text prompts. \r\n.\r\n,\r\n,\r\n.\r\n\r\n\r\n\r\n\r\nUnlike other AI art generators, Ideogram.AI excels in rendering text within images, making it perfect for creating logos, posters, typography, and creative visuals.\r\n\r\n🔹 How Ideogram.AI Works:\r\nAI Text-to-Image Generation\r\n\r\nConverts text prompts into stunning AI-generated images.\r\n\r\nSupports different styles like photorealistic, artistic, cartoon, and fantasy.\r\n\r\nText Rendering in Images\r\n\r\nAccurately generates readable and stylish text within images.\r\n\r\nIdeal for creating logos, social media posts, and graphic designs.\r\n\r\nCustomizable Styles & Themes\r\n\r\nAllows users to adjust colors, fonts, and design elements.\r\n\r\nSupports various creative and branding needs.\r\n\r\nEasy Sharing & Downloading\r\n\r\nProvides high-resolution outputs for professional use.\r\n\r\nSimple UI for generating and sharing images quickly.\r\n\r\nAI-Powered Creativity\r\n\r\nHelps designers, marketers, and content creators bring ideas to life effortlessly.', 'https://ideogram.ai/t/explore', 'https://www.google.com/s2/favicons?sz=256&domain=ideogram.ai', 'image generator,logos,poster,AI Music Generator,audio songs generator', '2025-03-26 08:12:12', 'public', NULL),
(172, 'Udio', 'Udio | AI Music Generator\nUdio is an advanced AI-driven platform that allows users to generate high-quality music from text prompts.', 'https://www.udio.com/', 'https://www.google.com/s2/favicons?sz=256&domain=www.udio.com', 'AI Music Generator,audio generator', '2025-03-26 08:24:54', 'public', NULL),
(173, 'shortsnoob', 'YouTube Shorts Video Download online – Shorts Downloader', 'https://shortsnoob.com/en1', 'https://www.google.com/s2/favicons?sz=256&domain=shortsnoob.com', 'youtube video downloader,video downloader', '2025-03-26 08:28:23', 'public', NULL),
(174, 'PixVerse', 'PixVerse is an innovative AI-powered video creation platform that transforms static images and text prompts into dynamic, engaging videos. Designed for users of all skill levels, PixVerse simplifies the video production process, making it accessible and efficient.​', 'https://app.pixverse.ai/home', 'https://www.google.com/s2/favicons?sz=256&domain=app.pixverse.ai', 'Video generator,image generator', '2025-03-26 08:31:37', 'public', NULL),
(175, 'Free motion graphics templates · Jitter', 'Jitter – AI-Powered Motion Design & Animation Tool\n🔗 Website: Jitter.video\n\n🔍 Keywords for Jitter Search:\nJitter animation tool\n\nOnline motion design software\n\nFigma animation tool\n\nBest After Effects alternative\n\nCreate GIFs and videos online\n\nFree motion graphics software\n\nWeb-based animation maker\n\nMotion design for social media\n\nAI video animation tool\n\nJitter motion graphics editor', 'https://jitter.video/templates/', 'https://www.google.com/s2/favicons?sz=256&domain=jitter.video', 'animation tool,Create GIFs,motion graphics software', '2025-03-26 08:39:08', 'public', NULL),
(176, 'InterviewAI', 'InterviewAI – AI-Powered Interview Preparation Tool \n\n**InterviewAI** is an advanced platform designed to enhance interview preparation by generating tailored mock interview questions and providing real-time feedback to users. It aims to streamline the interview process for job seekers, students, and professionals aiming to improve their performance. citeturn0search0\n\n#### **🔍 Keywords for InterviewAI Search:**  \n- InterviewAI mock interview tool  \n- AI-powered interview preparation  \n- Generate interview questions AI  \n- Real-time interview feedback  \n- AI interview practice platform  \n- Personalized mock interviews  \n- InterviewAI app download  \n- AI-driven interview coaching  \n- Practice job interviews online  \n- InterviewAI features and pricing  \nInterviewAI offers a user-friendly interface and customizable features, making it a valuable resource for individuals seeking to enhance their interview skills and confidence citeturn0search0', 'https://www.interviewai.io/?gad_source=1&gclid=Cj0KCQiAkoe9BhDYARIsAH85cDPWrAlULTNlyzAg0LgE8WCvuAaCEGl9tr55iaTf-fVP6tKC9P3VtBEaAvNVEALw_wcB', 'https://www.google.com/s2/favicons?sz=256&domain=www.interviewai.io', 'Interview tool', '2025-03-26 08:41:11', 'public', NULL),
(177, 'MagicPattern', 'MagicPattern is an AI-powered tool for generating unique patterns, gradients, and backgrounds for web, UI, and social media design.\n\n🔍 Keywords:\nMagicPattern AI design\n\nAI pattern generator\n\nCreate SVG patterns online\n\nMesh gradient generator\n\nPolka dot pattern maker\n\nGrid background creator\n\nFree online design tools\n\nMagicPattern SVG export\n\nAI-generated backgrounds\n\nMagicPattern Framer plugin', 'https://www.magicpattern.design/', 'https://www.google.com/s2/favicons?sz=256&domain=www.magicpattern.design', 'AI-generated backgrounds', '2025-03-26 08:46:03', 'public', NULL),
(178, 'Globe Explorer', 'Globe Explorer is an AI-driven search engine that provides structured, visual topic exploration with AI summaries for efficient learning.\n\n🔍 Keywords:\nGlobe Explorer AI search engine\n\nAI-powered knowledge discovery\n\nVisual topic exploration tool\n\nInteractive learning platform\n\nAI summaries for research\n\nStructured search engine\n\nAI-driven information organizer\n\nEducational AI search tool\n\nGlobe Explorer features\n\nAI knowledge platform', 'https://explorer.globe.engineer/', 'https://www.google.com/s2/favicons?sz=256&domain=explorer.globe.engineer', 'AI search engine,AI knowledge platform,AI search tool', '2025-03-26 08:49:51', 'public', NULL),
(179, 'tree-of-knowledge', 'Tree of Knowledge is an AI-driven platform that organizes human knowledge into an interactive tree structure, enabling users to explore various disciplines and their interconnections.\n\n🔍 Keywords:\nTree of Knowledge AI\n\nInteractive knowledge tree\n\nAI-powered learning platform\n\nDynamic knowledge visualization\n\nExplore human knowledge AI\n\nEducational AI tool\n\nKnowledge mapping platform\n\nTree of Knowledge features\n\nAI knowledge organizer', 'https://tree-of-knowledge.org/', 'https://www.google.com/s2/favicons?sz=256&domain=tree-of-knowledge.org', 'AI-powered learning platform', '2025-03-26 08:54:07', 'public', NULL),
(180, 'AI Face Swap', 'AI Face Swap uses deep learning to seamlessly swap faces in images and videos, offering realistic and high-quality results for entertainment, editing, and creative projects.\n\n🔍 Keywords:\nAI face swap online\n\nDeepfake face swap\n\nRealistic face swap AI\n\nFace swapping app\n\nAI-powered face changer\n\nSwap faces in video AI\n\nFace swap generator\n\nAI face swapper tool\n\nDeep learning face swap\n\nFree AI face swap editor', 'https://aifaceswap.io/#face-swap-playground', 'https://www.google.com/s2/favicons?sz=256&domain=aifaceswap.io', 'AI Face Swap,face chenger,face swaper', '2025-03-26 08:56:30', 'public', NULL),
(181, 'Face Swap Online Free', 'Remarker AI automates social media content creation, optimizing posts, hashtags, and engagement through AI-driven analysis.\n\n🔍 Keywords:\nRemarker AI\n\nAI social media content creation\n\nAI-powered content generation\n\nSocial media automation tool\n\nAI-driven sentiment analysis\n\nContent optimization AI\n\nRemarker AI features\n\nAI marketing assistant\n\nSocial media engagement AI\n\nRemarker AI platform', 'https://remaker.ai/face-swap-free/', 'https://www.google.com/s2/favicons?sz=256&domain=remaker.ai', 'ai face swap,face chenger,face swaper', '2025-03-26 09:00:17', 'public', NULL),
(182, 'Visual Studio Code', 'Welcome - Workspace - Visual Studio Code', 'https://vscode.dev/', 'https://www.google.com/s2/favicons?sz=256&domain=vscode.dev', 'online compliler', '2025-03-26 09:01:13', 'public', NULL),
(183, 'WriteHuman', 'WriteHuman: Undetectable AI and AI Humanizer\n\nWriteHuman is an AI-powered tool that transforms AI-generated text into natural, human-like writing, making it undetectable by AI detection systems.\n\n🔍 Keywords:\nWriteHuman AI\n\nAI content humanizer\n\nUndetectable AI writing\n\nBypass AI detection tools\n\nHumanize AI-generated text\n\nAI writing tool\n\nWriteHuman features\n\nAI detector bypass\n\nNatural language AI\n\nWriteHuman pricing', 'https://writehuman.ai/?via=li&utm_source=google&utm_medium=maxnov24&gad_source=1&gclid=Cj0KCQiAy8K8BhCZARIsAKJ8sfQ5ndBsZxjSRNTZlEYbYVT5AZ1RAETncAsgoTFpCvMhb8HDbKmsPZ0aAji9EALw_wcB', 'https://www.google.com/s2/favicons?sz=256&domain=writehuman.ai', 'AI Humanizer', '2025-03-26 09:03:03', 'public', NULL),
(185, 'Pi7 Image Tool', 'Pi7 Image Tool - Compress, Resize & Covert Images\n\n\n\nPi7 Image Tool – All-in-One Online Image Editing**  \n\n**Description:**  \nPi7 Image Tool is a powerful online platform that provides tools for image compression, resizing, conversion, enhancement, and editing. It helps users optimize images for websites, social media, documents, and more, ensuring high-quality visuals with minimal effort.  \n\n**📂 Categories:**  \n- Image Compression  \n- Image Resizing  \n- Image Conversion  \n- Image Enhancement  \n- Image Editing  \n- Background Editing  \n- File Optimization  \n\n**🔍 Keywords:**  \n- Pi7 Image Tool  \n- Online image compressor  \n- Resize images online  \n- Convert images to JPG/PNG/WebP  \n- Free image editing tools  \n- Compress images to 50KB  \n- Super resolution image enhancer  \n- Crop and rotate images online  \n- Image to PDF converter  \n- AI-powered image upscaler  \n- WebP to PNG/JPG converter  \n- Reduce image file size online  \n- Transparent PNG maker  \n- Photo background remover online  \n- HEIC to JPG online converter  \n- Optimize images for SEO  \n- Online watermark remover  \n- AI photo enhancer', 'https://image.pi7.org/', 'https://www.google.com/s2/favicons?sz=256&domain=image.pi7.org', 'Image Compression,Image Resizing', '2025-03-26 09:15:49', 'public', NULL),
(186, 'Chat Extensions', 'Chat Extensions', 'https://marketplace.visualstudio.com/search?target=VSCode&category=Chat&sortBy=Installs', 'https://www.google.com/s2/favicons?sz=256&domain=marketplace.visualstudio.com', 'Chat Extensions,all chatboats', '2025-03-26 09:16:55', 'public', NULL),
(187, 'GitHub Copilot', 'Copilot – AI-Powered Assistant for Productivity   \n\n \nCopilot is an AI-driven assistant designed to enhance productivity by providing smart code suggestions, automating tasks, and assisting in content creation. It integrates seamlessly into various development environments, office applications, and creative tools to streamline workflows.  \n\n**📂 Categories:**  \n- AI Code Assistance  \n- Writing & Content Generation  \n- Task Automation  \n- Office Productivity  \n- AI-Powered Chatbots  \n\n**🔍 Keywords:**  \n- Copilot AI  \n- AI code assistant  \n- AI-powered coding tool  \n- Copilot for developers  \n- AI writing assistant  \n- Automate tasks with AI  \n- AI-powered chatbot  \n- Code completion tool  \n- AI for office productivity  \n- AI-generated content', 'https://github.com/copilot', 'https://www.google.com/s2/favicons?sz=256&domain=github.com', 'ChatBot', '2025-03-26 09:18:35', 'public', NULL),
(188, 'Rollout AI', 'Rollout AI - AI Landing Page Builder & Website Builder [FREE]\n\n Rollout – AI-Powered Website Builder \n\n \nRollout is an AI-driven platform that enables users to create professional, high-performing websites and landing pages effortlessly. By utilizing advanced artificial intelligence, Rollout streamlines the web design process, allowing for quick and efficient site creation without the need for coding skills. Its intuitive chat-based interface and extensive component library make it suitable for entrepreneurs, marketers, and creatives seeking to establish an online presence swiftly.  \n\n**📂 Categories:**\n- AI Website Builders\n- Landing Page Generators\n- No-Code Development Platforms\n- Web Design Tools\n- AI Content Creation\n\n**🔍 Keywords:**\n- Rollout AI website builder\n- AI landing page generator\n- No-code website creation\n- AI-powered web design\n- Rollout site builder\n- AI content generation for websites\n- Responsive web design AI\n- Rollout AI features\n- AI website builder free\n- Rollout platform review', 'https://rollout.site/generate', 'https://www.google.com/s2/favicons?sz=256&domain=rollout.site', 'Web Genrator,website generator,web design,website structure', '2025-03-26 09:21:29', 'public', NULL),
(189, 'ChatGPT', '### **ChatGPT – AI-Powered Conversational Assistant**  \n\n**Description:**  \nChatGPT is an advanced AI chatbot developed by OpenAI that assists users with a variety of tasks, including answering questions, generating content, writing code, brainstorming ideas, and providing real-time assistance. It leverages natural language processing (NLP) to deliver human-like conversations, making it useful across multiple domains, from business and education to creativity and automation.  \n\n**📂 Categories:**  \n- **AI Chatbots** – Interactive conversational AI for communication.  \n- **Content Generation** – AI-powered writing, blogging, and scriptwriting.  \n- **Virtual Assistants** – Personal and business productivity enhancement.  \n- **Code Assistance** – AI-driven coding support and debugging.  \n- **Research & Learning** – AI-assisted information gathering and education.  \n- **Business & Productivity** – Automating workflows and business processes.  \n- **Customer Support AI** – Automated chatbot solutions for businesses.  \n- **Creative Writing & Brainstorming** – AI-powered storytelling and ideation.  \n- **Marketing & SEO** – AI-generated ad copy, SEO content, and branding.  \n- **AI for Developers** – API integrations and AI-enhanced software development.  \n- **E-Commerce & Sales Automation** – AI-driven chatbots and customer interactions.  \n- **Legal & Financial Assistance** – AI-powered document analysis and insights.  \n\n**🔍 Keywords:**  \n- ChatGPT AI chatbot  \n- OpenAI chatbot assistant  \n- AI writing and content generation  \n- AI-powered virtual assistant  \n- ChatGPT for business automation  \n- AI code generator and debugging  \n- AI for customer support chatbots  \n- ChatGPT for research and learning  \n- AI scriptwriting and storytelling  \n- AI marketing content generator  \n- ChatGPT for SEO optimization  \n- AI-powered brainstorming tool  \n- AI for software developers  \n- AI productivity and workflow automation  \n- ChatGPT for e-commerce chatbots  \n- AI-generated financial and legal insights', 'https://chatgpt.com/', 'https://www.google.com/s2/favicons?sz=256&domain=chatgpt.com', 'ChatBot', '2025-03-26 09:27:14', 'public', NULL),
(190, 'GPTZero', 'GPTZero is an AI-powered tool that detects AI-generated text in essays, articles, and academic papers, helping maintain originality and integrity.\n\n📂 Categories:\n\nAI Content Detection\n\nPlagiarism Checker\n\nAcademic Integrity\n\nWriting Analysis\n\n🔍 Keywords:\n\nAI text detector\n\nGPTZero plagiarism checker\n\nDetect AI-written content\n\nAI-generated text analysis\n\nAcademic AI checker', 'https://app.gptzero.me/', 'https://www.google.com/s2/favicons?sz=256&domain=app.gptzero.me', 'AI Content Detection,ai content Checker,AI text detector', '2025-03-26 12:47:43', 'public', NULL),
(191, 'Ryne AI', 'Ryne AI: Humanizer & AI Detector Bypass - Undetectable Tools\n\nRyne AI is an academic AI tool that helps students with studying, note-taking, essay writing, and bypassing AI detection in generated content.\n\n📂 Categories:\n\nAI Study Assistant\n\nAcademic Writing Tools\n\nAI Content Humanization\n\nNote-Taking Solutions\n\nAI Detection Bypass\n\n🔍 Keywords:\n\nAI study assistant\n\nRyne AI tool for students\n\nAI-powered academic writing\n\nAI essay generator with citations\n\nConvert AI text to human-like text\n\nBypass AI detection in writing\n\nBest AI note-taking tool\n\nRyne AI plagiarism check\n\nAI-generated content editor\n\nSmart AI learning assistant', 'https://ryne.ai/', 'https://www.google.com/s2/favicons?sz=256&domain=ryne.ai', 'AI Humanizer', '2025-03-26 12:50:40', 'public', NULL),
(192, 'SEOStudio', 'SEOStudio - 100% Free Online Tools Collection\n\nFree Online SEO Tools​\n\nKeyword Research Tools​\n\nBacklink Tracking​\n\nContent Optimization​\n\nYouTube SEO Tools​\n\nWeb Management Tools​\nSEOStudio\n+7\nchrome.google.com\n+7\nSEOStudio\n+7\n\nWeb Development Tools​\nSEOStudio\n\nImage Editing Tools​\n\nOnline Calculators​\nSEOStudio\n\nSeo Studio Tools\n\nText Analysis Tools​\n\nMeta Tag Generator​\n\nDomain Age Checker​\n\nRobots.txt Generator​\n\nHTML Beautifier​\n\nCSS Minifier​\n\nJSON Formatter​\n\nImage Converter​\n\nAge Calculator​\n\nWord Counter​\n\nArticle Rewriter', 'https://seostudio.tools/', 'https://www.google.com/s2/favicons?sz=256&domain=seostudio.tools', 'SEO Tools​,YouTube SEO Tools,Image Editing Tools​', '2025-03-26 12:58:50', 'public', NULL),
(193, 'Netlify', 'Scale & Ship Faster with a Composable Web Architecture | Netlify', 'https://www.netlify.com/', 'https://www.google.com/s2/favicons?sz=256&domain=www.netlify.com', 'web hoster', '2025-03-26 13:02:58', 'public', NULL),
(194, 'GitHub Pages', 'GitHub Pages | Websites for you and your projects, hosted directly from your GitHub repository. Just edit, push, and your changes are live.', 'https://pages.github.com/', 'https://www.google.com/s2/favicons?sz=256&domain=pages.github.com', 'web hoster', '2025-03-26 13:04:09', 'public', NULL),
(195, 'Hostinger', 'Special offer for 000webhost users - 80% off with free ssl', 'https://www.hostinger.com/special/000webhost', 'https://www.google.com/s2/favicons?sz=256&domain=www.hostinger.com', 'web hoster', '2025-03-26 13:05:11', 'public', NULL),
(196, 'InfinityFree', 'Free Web Hosting with PHP and MySQL - InfinityFree', 'https://www.infinityfree.com/', 'https://www.google.com/s2/favicons?sz=256&domain=www.infinityfree.com', 'web hoster', '2025-03-26 13:06:25', 'public', NULL),
(197, 'DeepSeek', 'DeepSeek chatbot and search engine', 'https://chat.deepseek.com/', 'https://www.google.com/s2/favicons?sz=256&domain=chat.deepseek.com', 'ChatBot', '2025-03-26 13:28:58', 'public', NULL),
(198, 'Gemini', 'Gemini chatbot', 'https://gemini.google.com/app?is_sa=1&is_sa=1&android-min-version=301356232&ios-min-version=322.0&campaign_id=bkws&utm_source=sem&utm_source=google&utm_medium=paid-media&utm_medium=cpc&utm_campaign=bkws&utm_campaign=2024enIN_gemfeb&pt=9008&mt=8&ct=p-growt', 'https://www.google.com/s2/favicons?sz=256&domain=gemini.google.com', 'ChatBot', '2025-03-26 13:29:23', 'public', NULL),
(199, 'EdClub', 'EdClub\n\nFree typing practice\n\nOnline typing tutor\n\nLearn touch typing\n\nImprove typing speed\n\nTyping lessons for beginners\n\nBest typing training tool\n\nTyping speed test online\n\nKeyboard typing exercises\n\nFast typing practice\n\nTyping games for kids', 'https://www.edclub.com/sportal/', 'https://www.google.com/s2/favicons?sz=256&domain=www.edclub.com', 'typing,typing master', '2025-03-26 13:32:01', 'public', NULL),
(200, 'BLACKBOX.AI', 'BLACKBOX.AI , this is a best chatbot', 'https://www.blackbox.ai/', 'https://www.google.com/s2/favicons?sz=256&domain=www.blackbox.ai', 'ChatBot', '2025-03-26 13:32:49', 'public', NULL),
(201, 'Microsoft 365 Copilot', 'Microsoft 365 Copilot\nMicrosoft 365 is a cloud-based productivity suite offering apps like Word, Excel, PowerPoint, Outlook, and Teams. It provides seamless collaboration, cloud storage via OneDrive, and advanced security for businesses and individuals', 'https://m365.cloud.microsoft/?auth=1', 'https://www.google.com/s2/favicons?sz=256&domain=m365.cloud.microsoft', 'pdf creater,word file,microsoft', '2025-03-26 13:35:13', 'public', NULL),
(202, 'NPCI', 'National Payments Corporation of India (NPCI) - Enabling digital payments in India', 'https://www.npci.org.in/', 'https://www.google.com/s2/favicons?sz=256&domain=www.npci.org.in', 'Government,govt sites,back seeding chenger', '2025-03-26 13:40:19', 'public', NULL),
(203, 'Shodan', 'Shodan Search Engine', 'https://www.shodan.io/', 'https://www.google.com/s2/favicons?sz=256&domain=www.shodan.io', 'Search Engine', '2025-03-26 13:40:59', 'public', NULL),
(204, 'DorkSearch', 'DorkSearch - Speed up your Google Dorking', 'https://www.dorksearch.com/', 'https://www.google.com/s2/favicons?sz=256&domain=www.dorksearch.com', 'Search Engine', '2025-03-26 13:41:20', 'public', NULL),
(205, 'Red Hat Certified', 'Red Hat Certified System Administrator', 'https://www.redhat.com/en/services/certification/rhcsa', 'https://www.google.com/s2/favicons?sz=256&domain=www.redhat.com', 'courses', '2025-03-26 13:42:34', 'public', NULL),
(206, 'Careerwalaa »', 'Careerwalaa job notification', 'https://careerwalaa.com/', 'https://www.google.com/s2/favicons?sz=256&domain=careerwalaa.com', 'jobs,internship,Course,courses,free courses', '2025-03-26 13:43:56', 'public', NULL),
(207, 'VirusTotal', 'VirusTotal \nUses of VirusTotal\nScanning Files for Malware – Check if a file contains viruses or trojans before opening.\n\nAnalyzing Suspicious URLs – Detect phishing and malicious websites before visiting.\n\nChecking Email Attachments – Verify attachments for potential threats.\n\nScanning IP Addresses & Domains – Identify if an IP or domain is flagged for malicious activity.\n\nDetecting Ransomware – Check if a file is associated with known ransomware.\n\nVerifying Software Downloads – Ensure downloaded software is safe before installation.\n\nCyber Threat Intelligence – Security professionals use it to analyze emerging threats.\n\nChecking Browser Extensions – Scan extensions for hidden malware or spyware.\n\nAnalyzing Social Media Links – Detect harmful links in messages and posts.\n\nDetecting Keyloggers & Spyware – Prevent unauthorized tracking or data theft.\n\nVerifying Shortened Links – Expand and scan shortened URLs (e.g., bit.ly, tinyurl).\n\nInvestigating Data Breaches – Check if a site or file is linked to a breach.\n\nSandbox Analysis – Execute files in a controlled environment to detect hidden threats.\n\nAPI Integration for Security Tools – Automate scans in cybersecurity software.\n\nChecking Wi-Fi Network Safety – Analyze network-related threats using IP scanning.\n\nIncident Response Investigations – Helps cybersecurity teams analyze attack sources.\n\nChecking Mobile App Safety – Scan APK files before installing them on Android devices.\n\nVerifying Cryptocurrency Addresses – Identify if an address is linked to scams or fraud.\n\nCorporate Security Monitoring – Businesses use it to assess cybersecurity risks.\n\nThreat Sharing & Research – Security experts use VirusTotal for malware research and information sharing', 'https://www.virustotal.com/gui/home/upload', 'https://www.google.com/s2/favicons?sz=256&domain=www.virustotal.com', 'security,virus,imp,viruse finder', '2025-03-26 13:47:59', 'public', NULL),
(208, 'You.com', 'You.com | AI for workplace productivity', 'https://you.com/', 'https://www.google.com/s2/favicons?sz=256&domain=you.com', 'ChatBot', '2025-03-26 13:48:25', 'public', NULL),
(209, 'NPTEL', 'FREE COURSES , AND CIRTIFICATION', 'https://archive.nptel.ac.in/noc/index.html', 'https://www.google.com/s2/favicons?sz=256&domain=archive.nptel.ac.in', 'courses,free courses', '2025-03-26 13:50:20', 'public', NULL),
(210, 'ThemeForest', 'WordPress Themes & Website Templates from ThemeForest', 'https://themeforest.net/', 'https://www.google.com/s2/favicons?sz=256&domain=themeforest.net', 'website templates,projects', '2025-03-26 13:52:11', 'public', NULL),
(211, 'CodeChef', 'CodeChef - Learn and Practice Coding with Problems', 'https://www.codechef.com/', 'https://www.google.com/s2/favicons?sz=256&domain=www.codechef.com', 'free courses,courses', '2025-03-26 13:53:11', 'public', NULL),
(212, 'Buddha and his Dhamma-Hindi', 'Buddha and his Dhamma-Hindi book pdf', 'https://drambedkarbooks.com/wp-content/uploads/2015/01/hindi-buddhaandhisdhamma-baiae_japan.pdf', 'https://www.google.com/s2/favicons?sz=256&domain=drambedkarbooks.com', 'books,pdf', '2025-03-26 13:53:48', 'public', NULL),
(213, '44books', 'मुफ्त हिंदी पुस्तकें Free Hindi Books in PDF हजारों की संख्या मे Download kare', 'https://44books.com/free-hindi-books#google_vignette', 'https://www.google.com/s2/favicons?sz=256&domain=44books.com', 'books', '2025-03-26 13:54:41', 'public', NULL),
(214, 'WsCube Tech', 'WsCube Tech: Online Certification Courses & Live Training', 'https://www.wscubetech.com/', 'https://www.google.com/s2/favicons?sz=256&domain=www.wscubetech.com', 'courses', '2025-03-26 13:55:10', 'public', NULL),
(215, 'Great Learning', 'Great Learning: Online Courses, PG Certificates and Degree Programs', 'https://www.mygreatlearning.com/', 'https://www.google.com/s2/favicons?sz=256&domain=www.mygreatlearning.com', 'Course,courses,free courses', '2025-03-26 13:56:08', 'public', NULL),
(216, 'Coursera', 'Best Free Courses & Certificates [2025] | Coursera Learn Online', 'https://www.coursera.org/courses?query=free', 'https://www.google.com/s2/favicons?sz=256&domain=www.coursera.org', 'courses,Course,free,free courses,courses,free courses', '2025-03-26 13:56:50', 'public', NULL),
(217, 'LearnVern', 'LearnVern - Free Online Courses - 8 Week Internship Certificate', 'https://www.learnvern.com/', 'https://www.google.com/s2/favicons?sz=256&domain=www.learnvern.com', 'courses,free courses', '2025-03-26 13:57:27', 'public', NULL),
(218, 'Google Translate', 'Google Translate', 'https://translate.google.com/?sl=en&tl=hi&op=translate', 'https://www.google.com/s2/favicons?sz=256&domain=translate.google.com', 'google,translator', '2025-03-26 14:00:04', 'public', NULL),
(219, 'Cyber Security Training', 'Cyber Security Training | SANS Courses, Certifications & Research', 'https://www.sans.org/apac/', 'https://www.google.com/s2/favicons?sz=256&domain=www.sans.org', 'courses,free courses', '2025-03-26 14:01:23', 'public', NULL),
(220, 'Apprenticeship Training Portal', 'Apprenticeship Training Portal', 'https://www.apprenticeshipindia.gov.in/', 'https://www.google.com/s2/favicons?sz=256&domain=www.apprenticeshipindia.gov.in', 'Government,courses,apprenticeship,govt sites,jobs,internship', '2025-03-26 14:13:56', 'public', NULL),
(221, 'HackerRank', 'HackerRank - Online Coding Tests and Technical Interviews', 'https://www.hackerrank.com/', 'https://www.google.com/s2/favicons?sz=256&domain=www.hackerrank.com', 'Course,courses', '2025-03-26 14:14:42', 'public', NULL),
(222, 'NCSC.GOV.UK', 'National Cyber Security Centre - NCSC.GOV.UK', 'https://www.ncsc.gov.uk/', 'https://www.google.com/s2/favicons?sz=256&domain=www.ncsc.gov.uk', 'Government,govt sites', '2025-03-26 14:18:52', 'public', NULL),
(223, 'Google Cloud', 'Beginner: Google Cloud Cybersecurity Certificate | Google Cloud Skills Boost', 'https://www.cloudskillsboost.google/paths/419?utm_source=cgc&utm_medium=website&utm_campaign=evergreen', 'https://www.google.com/s2/favicons?sz=256&domain=www.cloudskillsboost.google', 'courses,google', '2025-03-26 14:19:51', 'public', NULL),
(224, 'Google Cloud Skills Boost', 'Google Cloud Skills Boost', 'https://www.cloudskillsboost.google/', 'https://www.google.com/s2/favicons?sz=256&domain=www.cloudskillsboost.google', 'courses,google', '2025-03-26 14:20:49', 'public', NULL),
(225, 'Microsoft Learn', 'Microsoft Learn: Build skills that open doors in your career', 'https://learn.microsoft.com/en-us/', 'https://www.google.com/s2/favicons?sz=256&domain=learn.microsoft.com', 'courses,free courses', '2025-03-26 14:22:03', 'public', NULL),
(226, 'Red Hat', 'Red Hat - We make open source technologies for the enterprise', 'https://www.redhat.com/en', 'https://www.google.com/s2/favicons?sz=256&domain=www.redhat.com', 'courses', '2025-03-26 14:22:41', 'public', NULL),
(227, 'NOC Course', 'NOC Course', 'https://archive.nptel.ac.in/noc/noc_course.html', 'https://www.google.com/s2/favicons?sz=256&domain=archive.nptel.ac.in', 'courses,Government,govt sites', '2025-03-26 14:23:10', 'public', NULL),
(228, 'LinkedIn Learning', 'Browse Certifications | LinkedIn Learning', 'https://www.linkedin.com/learning/browse/certifications', 'https://www.google.com/s2/favicons?sz=256&domain=www.linkedin.com', 'courses,free courses', '2025-03-26 14:24:20', 'public', NULL),
(229, 'WeTransfer ', 'WeTransfer | Send Large Files Fast file ko upload krke , link bhej sakte hai , or link pr click krke , file access kr sakte hai', 'https://wetransfer.com/', 'https://www.google.com/s2/favicons?sz=256&domain=wetransfer.com', 'transfar files,files,send files', '2025-03-26 15:10:49', 'public', NULL),
(230, 'Vercel 0.dev', 'Vercel: Build and deploy the best web experiences with the Frontend Cloud', 'https://vercel.com/', 'https://www.google.com/s2/favicons?sz=256&domain=vercel.com', 'Web Genrator,website generator,web design', '2025-03-26 15:16:27', 'public', NULL),
(231, 'Claude Ai', 'Claude Ai chatbot', 'https://claude.ai/new', 'https://www.google.com/s2/favicons?sz=256&domain=claude.ai', 'ChatBot', '2025-03-26 15:25:44', 'public', NULL),
(232, 'designstripe', 'AI Ad Generator – designstripe', 'https://designstripe.com/?utm_medium=bettermeter&utm_campaign=layouts&utm_content=staticblue', 'https://www.google.com/s2/favicons?sz=256&domain=designstripe.com', 'ai ad generator', '2025-03-26 15:26:50', 'public', NULL),
(233, 'Immersity AI', 'Immersity AI | Convert Image and Video to 3D', 'https://www.immersity.ai/', 'https://www.google.com/s2/favicons?sz=256&domain=www.immersity.ai', 'Convert Image and Video', '2025-03-26 15:34:34', 'public', NULL),
(234, 'Removal.AI', 'Removal.AI: Upload Image to Create Transparent Background', 'https://removal.ai/upload/', 'https://www.google.com/s2/favicons?sz=256&domain=removal.ai', 'background remover', '2025-03-26 15:36:10', 'public', NULL),
(235, 'iconview.org', 'Open Source icon library. 100k+ icons for React, Nextjs | www.iconview.org', 'https://www.iconview.org/', 'https://www.google.com/s2/favicons?sz=256&domain=www.iconview.org', 'icons', '2025-03-26 15:36:57', 'public', NULL),
(236, 'call bomber', 'Call Bomber 2025 | Fastest Call Bomber in the World Ever Existed.', 'https://callbomber.in/index.php', 'https://www.google.com/s2/favicons?sz=256&domain=callbomber.in', 'Call Bomber,sms bomber', '2025-03-26 15:39:04', 'public', NULL),
(237, 'Indeed', 'Job Search India | Indeed', 'https://in.indeed.com/?from=gnav-jobsearch--indeedmobile', 'https://www.google.com/s2/favicons?sz=256&domain=in.indeed.com', 'jobs,internship', '2025-03-26 15:40:07', 'public', NULL),
(238, 'AirDroid Web', 'AirDroid Web', 'https://web.airdroid.com/', 'https://www.google.com/s2/favicons?sz=256&domain=web.airdroid.com', 'mobile controler,monitoring,screen sharing', '2025-03-26 16:40:23', 'public', NULL),
(239, 'DigitalDefynd', 'DigitalDefynd - World\'s Best Professional Programs', 'https://digitaldefynd.com/', 'https://www.google.com/s2/favicons?sz=256&domain=digitaldefynd.com', 'free courses,courses', '2025-03-26 16:41:28', 'public', NULL),
(240, 'SlideShare', 'Share & Discover Presentations | SlideShare', 'https://www.slideshare.net/', 'https://www.google.com/s2/favicons?sz=256&domain=www.slideshare.net', 'ppt', '2025-03-26 16:42:12', 'public', NULL),
(241, 'Alison', 'Alison | Free Online Courses & Online Learning', 'https://alison.com/', 'https://www.google.com/s2/favicons?sz=256&domain=alison.com', 'free courses,courses', '2025-03-26 16:42:50', 'public', NULL),
(242, 'icons8', 'Download 1,408,300 free icons (SVG, PNG)', 'https://icons8.com/icons', 'https://www.google.com/s2/favicons?sz=256&domain=icons8.com', 'icons', '2025-03-26 16:45:52', 'public', NULL),
(243, 'TryHackMe', 'Learn Cyber Security | TryHackMe Cyber Training', 'https://tryhackme.com/', 'https://www.google.com/s2/favicons?sz=256&domain=tryhackme.com', 'cyber,cyber security,courses,free courses', '2025-03-26 16:51:39', 'public', NULL),
(244, 'proxyium', 'Free web proxy - browse fast & anonymously', 'https://proxyium.com/', 'https://www.google.com/s2/favicons?sz=256&domain=proxyium.com', 'AI search engine,search engine,AI knowledge platform,block site visiter', '2025-03-26 16:54:04', 'public', NULL),
(245, 'Invitation Cards', 'Free Online Marathi Invitation Cards and Invitation', 'https://marathiinvites.com/', 'https://www.google.com/s2/favicons?sz=256&domain=marathiinvites.com', 'invitation,banner,patrika,wedding,pdf,word file', '2025-03-26 16:55:22', 'public', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `sub_admins`
--
ALTER TABLE `sub_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sub_admins`
--
ALTER TABLE `sub_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
