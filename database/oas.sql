-- phpMyAdmin SQL Dump
-- Database: `oas`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Database: `oas`
--
CREATE DATABASE IF NOT EXISTS `oas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `oas`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@oas.com', '2024-01-01 10:00:00');
-- Password: password

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `previous_school` varchar(100) DEFAULT NULL,
  `percentage_10th` decimal(5,2) DEFAULT NULL,
  `percentage_12th` decimal(5,2) DEFAULT NULL,
  `course_applied` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `id_proof` varchar(255) DEFAULT NULL,
  `marksheet_10th` varchar(255) DEFAULT NULL,
  `marksheet_12th` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `cuee_marks` int(11) DEFAULT NULL,
  `result_status` enum('Pass','Fail','Pending') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `application_id` (`application_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `description` text,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `duration`, `description`, `status`) VALUES
(1, 'Bachelor of Computer Science', '4 Years', 'Comprehensive computer science program', 'Active'),
(2, 'Bachelor of Business Administration', '3 Years', 'Business and management program', 'Active'),
(3, 'Bachelor of Arts', '3 Years', 'Liberal arts program', 'Active'),
(4, 'Master of Computer Applications', '2 Years', 'Advanced computer applications', 'Active'),
(5, 'Master of Business Administration', '2 Years', 'Advanced business management', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
