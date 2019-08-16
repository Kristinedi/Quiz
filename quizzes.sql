-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 16, 2019 at 02:02 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.3.7-2+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizzes`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(41) NOT NULL,
  `is_correct` tinyint(1) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `text`, `is_correct`, `question_id`) VALUES
(9, 'Atbilde 1', 1, 10),
(10, 'Atbilde 2', 0, 10),
(11, 'Atbilde 3', 0, 10),
(12, 'Atbilde 4', 0, 10),
(13, 'Atbilde 5', 1, 11),
(14, 'Atbilde 6', 0, 11),
(15, 'Atbilde 7', 1, 12),
(16, 'Atbilde 8', 0, 12),
(17, 'Atb 13-1', 0, 13),
(18, 'Atb 13-2', 1, 13),
(19, 'Atb 13-3', 0, 13),
(20, 'Atb 14-1', 1, 14),
(21, 'Atb 14-2', 0, 14),
(22, 'Atb 15-1', 0, 15),
(23, 'Atb 15-2', 1, 15),
(24, 'Atb 15-3', 0, 15),
(25, 'Atb 16-1', 0, 16),
(26, 'Atb 16-2', 1, 16),
(42, 'Dog', 0, 34),
(43, 'Cat', 0, 34),
(44, 'Duck', 1, 34),
(45, 'Penguin', 0, 35),
(46, 'Eagle', 1, 35),
(47, 'Swan', 1, 35);

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `quiz_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`id`, `user_id`, `quiz_id`) VALUES
(112, 23, 35),
(113, 23, 1),
(114, 23, 2),
(115, 22, 35),
(116, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `quiz_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `quiz_id`) VALUES
(10, 'Jautājums 1', 1),
(11, 'Jautājums 2', 1),
(12, 'Jautājums 3', 1),
(13, 'Jaut 13', 2),
(14, 'Jaut 14', 2),
(15, 'Jaut 15', 2),
(16, 'Jaut 16', 2),
(34, 'Which of these is a bird?', 35),
(35, 'Which bird can fly?', 35);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`) VALUES
(35, 'Bird'),
(1, 'Tests 1'),
(2, 'Tests 2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(20, 'mmm', 'mmm@ss.ss', '$2y$10$KBR6m0n0KzcAf5zf0.IlQuc7KOTgx6/DdboleuW9fsZQjQTXCQGme'),
(21, 'Tims', 'tims@ss.ss', '$2y$10$.4gFRKN.wocyIzx9Mmg4teKnJxFMa6xzlVfA27XxuNc/dy9A9RdNC'),
(22, 'Bil', 'bil@ss.ss', '$2y$10$QaHMyTOVTmRLkiajiV4P9OxLo2szAqVtQ8/44UFq12T7WBi/DAuUe'),
(23, 'Tom', 'tom@ss.ss', '$2y$10$MoDxO7H9Z7EKdxd21yTVM.0NhewiNPcOsQjQgA/RzKso2p.ZuPLi.');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `attempt_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `attempt_id`, `question_id`, `answer_id`) VALUES
(201, 112, 34, 44),
(202, 112, 35, 46),
(203, 113, 10, 10),
(204, 113, 11, 14),
(205, 113, 12, 16),
(206, 114, 13, 18),
(207, 114, 14, 21),
(208, 114, 15, 24),
(209, 114, 16, 25),
(210, 115, 34, 42),
(211, 115, 35, 47),
(212, 116, 10, 11),
(213, 116, 11, 13),
(214, 116, 12, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_questions_id_fk` (`question_id`);

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempts_quizzes_id_fk` (`quiz_id`),
  ADD KEY `attempts_users_id_fk` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quizzes_id_fk` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quizzes_title_uindex` (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_uindex` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answers_answers_id_fk` (`answer_id`),
  ADD KEY `user_answers_questions_id_fk` (`question_id`),
  ADD KEY `user_answers_attempts_id_fk` (`attempt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_questions_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_quizzes_id_fk` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `attempts_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quizzes_id_fk` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_answers_id_fk` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`),
  ADD CONSTRAINT `user_answers_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `attempts` (`id`),
  ADD CONSTRAINT `user_answers_questions_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
