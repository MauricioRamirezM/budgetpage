-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 01:02 AM
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
-- Database: `webminds`
CREATE DATABASE IF NOT EXISTS `webminds` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `webminds`;
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `username`, `email`, `phone`, `password`) VALUES
(1, 'José Munoz', 'ricardo_123', 'ricardo@mail.com', '321598745', '$2y$10$ucDrltixkW/jkVFNb2HwUOQo8OWk3kaIBNg0uLySAVkw4ElzmuC.y'),
(2, 'Juan Perez', 'juanPerez', 'juan@nail.com', '123589745', '$2y$10$7sxeDPo/zblYbSwxkBGoC..x3jPTup5R1Ht8k/LSs2hLUZ7ixlBLe'),
(3, 'Rafaela Muniz', 'Rafa_44', 'rafa@mail.com', '123456985', '$2y$10$H2YOcz6JdYnG1YYG.VGvlu1VrUvRzFlTgnyvUkGqRHvdYEuD5ZbNG');

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `id` int(11) NOT NULL ,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `image`, `title`, `description`) VALUES
(1, '1741299089_1741226567_robot.jpg', 'Developers are embracing AI agents for software development', 'Developers worldwide are embracing AI agents in software development with overwhelming enthusiasm, according to research from Salesforce. According to Salesforce’s latest State of IT survey, an impressive 96% of developers globally believe AI agents will positively reshape the developer experience, with more than nine in ten excited about AI’s impact on their careers. Closer to home, the figures remain equally compelling, with over four in five developers in the UK and Ireland (UKI) predicting these AI agents will become indispensable tools in app development, rivaling traditional software resources.'),
(2, '1741299158_new-1.jpg', 'Microsoft Copilot continues to expose private GitHub repositories', 'In August 2024, a LinkedIn post caused alarm by alleging that ChatGPT (and, by association, Microsoft Copilot) was capable of accessing data from private GitHub repositories. Such a claim, if true, could have significant ramifications for data security and privacy. Eager to uncover the truth behind the claim, the research team at Lasso, a digital security company, undertook a thorough investigation. What they found was a digital conundrum involving cached, publicly exposed, and now private data—a phenomenon they have since dubbed “Zombie Data.”'),
(3, '1741299217_1741226650_new-3.jpg', 'Google deploys Data Science Agent to Colab users', 'Google is empowering data scientists and researchers with the deployment of the Data Science Agent to its Colab platform. For those unfamiliar, Google Colab is a free, cloud-hosted Jupyter Notebook environment allowing users to write and execute Python code within their browser. By providing free access to Google Cloud GPUs and TPUs, Colab has become a vital tool for running AI models and enhancing project collaboration with minimal infrastructure setup. Google has now announced the broader availability of its AI-powered Data Science Agent. Set to transform workflows in universities, research labs, and beyond, the tool automates some of the most repetitive and time-consuming elements of data analysis.'),
(4, '1741299240_new-4.jpg', 'Google unveils free Gemini AI coding too', 'Google Cloud is rolling out free Gemini AI coding and code review tools to software developers across the globe. The tech giant has announced the public preview of Gemini Code Assist for individuals and Gemini Code Assist for GitHub. According to Google, this launch aims to enable anyone – from students working on academic projects to startup developers testing new ideas – to enhance productivity and code quality without worrying about cost or restrictive usage limits. Gemini Code Assist for individuals offers expansive functionality powered by a tailored version of Google’s powerful Gemini 2.0 model. Gemini Code Assist supports all programming languages in the public domain and is optimised to serve users across a wide range of daily coding challenges.'),
(5, '1741299508_new-55.jpg', 'The best SEO Strategies for San Francisco Businesses in 2025', '1-. Optimize for Local Search San Francisco businesses thrive on local customers. Optimize your Google My Business profile, use local keywords, and encourage positive reviews to boost your visibility in local search results.  2-. Focus on Mobile-First Optimization With the majority of searches now happening on mobile devices, ensuring your website is mobile-friendly is crucial. Prioritize responsive design, fast loading speeds, and a seamless mobile user experience.  3-. Leverage Voice Search Voice search is on the rise. Optimize your content for natural language queries and focus on long-tail keywords to capture voice search traffic.  4-. Create High-Quality Content. Content remains king in SEO. Develop engaging, informative, and original content that addresses your audience’s needs and includes relevant keywords naturally.  5-. Implement Schema Markup\\\\r\\\\nSchema markup helps search engines understand your content better, improving your chances of appearing in rich snippets. Use schema to highlight events, reviews, products, and more.');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `technologies` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `image`, `title`, `description`, `technologies`) VALUES
(1, '1741299771_proyect-1.png', 'Travel Agency Website', 'Discover the world with our modern travel agency website! This platform provides a user-friendly experience, allowing customers to browse destinations, book trips, and find exclusive travel deals. Features include interactive maps, customer reviews, and a secure payment system for seamless trip planning.', 'html,css,javascript'),
(2, '1741299800_project-2.jpg', 'E-School Platform', 'Empower education with our online learning platform. Designed for students and teachers, this e-school system offers course management, live classes, quizzes, and progress tracking. Fully responsive and optimized for desktop &amp; mobile, making remote learning accessible to everyone.', 'javascript,php,mysql'),
(3, '1741299817_project-3.jpg', 'Admin Panel Dashboard', 'A powerful admin panel that allows businesses to manage users, track data, and control website content from one place. Built with a clean UI, this dashboard includes role-based access, analytics, notifications, and security settings to keep everything organized and secure.', 'html,css,javascript,php,mysql'),
(4, '1741300004_project-4.jpg', 'Restaurant Website', 'A beautiful and functional website for restaurants, featuring an interactive menu, online reservations, customer reviews, and delivery integration. Designed to increase orders and reservations, while offering a great user experience on mobile and desktop.', 'html,css,javascript'),
(5, '1741300029_project-5.jpg', 'Personal Portfolio', 'Showcase your work with a modern, stylish portfolio. This website highlights your skills, projects, and experience, featuring an interactive resume, testimonials, and a contact form. Perfect for freelancers, designers, and developers looking to stand out online.', 'html,css,javascript');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `client_id`, `date`, `title`, `description`) VALUES
(1, 3, '2025-03-08', 'first date', 'can you help me with a bug in my website'),
(2, 3, '2025-03-14', 'second date', 'I think I have a virus in my computer');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `icone` varchar(100) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `icone`, `title`, `description`) VALUES
(1, 'fa-screwdriver-wrench', 'Website Maintenance &amp; Support', 'Keep your website running smoothly with our maintenance and support services. We handle bug fixes, security updates, backups, and performance monitoring to ensure your site is always online and secure.'),
(2, 'fa-gauge-high', 'Website Speed Optimization', 'A slow website can hurt your business! We improve loading speed, optimize images, minify code, and enhance server performance to make your website faster and more efficient.'),
(3, 'fa-shop', 'E-Shop Development', 'Need an online store? We build custom e-commerce solutions with secure payments, product filtering, and user-friendly navigation, helping you sell your products easily and efficiently.'),
(4, 'fa-code-branch', 'Microservices Development', 'We design scalable and flexible microservices to improve your web apps. Whether you need API integration, database management, or automation, our solutions make your system modular and high-performing.'),
(5, 'fa-globe', 'Custom Website Creation', 'Build your dream website from scratch! Whether it&#039;s a business site, portfolio, or landing page, we provide modern, mobile-friendly, and SEO-optimized web solutions tailored to your needs.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `password`, `role`) VALUES
(2, 'main_admin', '256589874', '$2y$10$GCSGrl6Hx21ZEnA1nF7KBewLMVQiQzpyJfeVUUroAQ1fZI5Sg6AEK', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
